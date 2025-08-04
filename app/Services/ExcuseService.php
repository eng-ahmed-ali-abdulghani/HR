<?php

namespace App\Services;

use App\Models\Excuse;
use App\Http\Resources\ExcuseResource;
use App\Models\User;
use App\Traits\CheckRole;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class ExcuseService
{
    use  CheckRole;

    public function getAllExcuses()
    {
        $allExcuses = Excuse::orderByDesc('start_date')->get();
        return [
            'code' => 200,
            'message' => 'Showing all excuses because employee not found.',
            'excuses' => ExcuseResource::collection($allExcuses),
        ];
    }

    public function getExcuseForEmployee($employee)
    {
        $startDate = Carbon::parse($employee->start_date);
        $now = Carbon::now();

        $allExcuses = Excuse::where('employee_id', $employee->id)->whereDate('start_date', '>=', $startDate)->orderByDesc('start_date')->get();

        $monthlyExcusesCount = $allExcuses->filter(fn($excuse) => $excuse->start_date instanceof Carbon &&
            $excuse->start_date->isSameMonth($now)
        )->count();

        return [
            'from_date' => $startDate->toDateString(),
            'monthly_excuses_count' => $monthlyExcusesCount,
            'total_excuses_count' => $allExcuses->count(),
            'excuses' => ExcuseResource::collection($allExcuses),
        ];
    }

    public function makeExcuse($data)
    {
        $employee = User::find($data['employee_id']);

        $excuseExists = Excuse::where('employee_id', $employee->id)
            ->where('start_date', $data['start_date'])
            ->exists();

        if ($excuseExists) {
            return [
                'code' => 409,
                'message' => __('messages.vacation_booked'),
                'data' => null
            ];
        }

        Excuse::create([
            'start_date' => $data['start_date'],
            'end_date' => $data['end_date'],
            'notes' => $data['notes'] ?? null,
            'reason' => $data['reason'] ?? null,
            'type_id' => $data['type_id'],
            'replacement_employee_id' => $data['replacement_employee_id'] ?? null,
            'submitted_by_id' => Auth::id(),
            'employee_id' => $employee->id,
        ]);

        return [
            'code' => 201,
            'message' => __('messages.excuse_requested'),
            'data' => null
        ];
    }

    public function cancelledExcuse($id)
    {
        $excuse = $this->checkExcuse($id);
        if (is_array($excuse)) return $excuse;

        if ($excuse->ceo_status === 'approved') {
            return [
                'code' => 403,
                'message' => __('messages.forbiden'),
                'data' => null
            ];
        }

        $excuse->delete();
        return [
            'code' => 200,
            'message' => __('messages.request_cancelled'),
            'data' => null
        ];
    }

    public function changeStatusExcuse($data, $excuse)
    {
        $authUser = Auth::user();
        $this->handleApprovalByUserRole($excuse, $authUser, $data['status']);
        return [
            'code' => 201,
            'message' => __('messages.request_approved'),
            'data' => null
        ];
    }

    // ===== Helpers =====

    private function checkExcuse($id)
    {
        $excuse = Excuse::with('employee.department')->find($id);
        return $excuse ?: [
            'code' => 404,
            'message' => __('messages.not_found'),
            'data' => null
        ];
    }

}
