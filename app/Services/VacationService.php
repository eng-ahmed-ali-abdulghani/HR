<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\Vacation;
use App\Http\Resources\VacationResource;
use Illuminate\Support\Facades\Auth;

class VacationService
{
    public function getVactionForEmployee($employee)
    {
        $startDate = Carbon::parse($employee->start_date);
        $allowedDays = $employee->allowed_vacation_days;

        $vacations = Vacation::where('employee_id', $employee->id)->whereDate('start_date', '>=', $startDate)->orderByDesc('start_date')->get();

        $usedDays = $this->calculateUsedDays($vacations);
        $remainingDays = max(0, $allowedDays - $usedDays);

        return [
            'from_date' => $startDate->toDateString(),
            'allowed_days' => $allowedDays,
            'total_days_used' => $usedDays,
            'remaining_days' => $remainingDays,
            'vacations' => VacationResource::collection($vacations),
        ];
    }

    public function makeVacation($data, $employee)
    {
        $startDate = Carbon::parse($employee->start_date);
        $allowedDays = $employee->allowed_vacation_days;

        if ($this->vacationExists($employee->id, $data['start_date'])) {
            return $this->response(409, __('messages.vacation_booked'));
        }

        $approvedVacations = Vacation::where('employee_id', $employee->id)->where('ceo_status', 'approved')->whereDate('start_date', '>=', $startDate)->get();

        $usedDays = $this->calculateUsedDays($approvedVacations);
        $requestedDays = $this->calculateVacationDays($data['start_date'], $data['end_date']);

        if ($usedDays + $requestedDays > $allowedDays) {
            return $this->response(401, __('messages.vacation_limit_exceeded'));
        }

        Vacation::create([
            'start_date' => $data['start_date'],
            'end_date' => $data['end_date'],
            'notes' => $data['notes'] ?? null,
            'reason' => $data['reason'] ?? null,
            'type_id' => $data['type_id'],
            'replacement_employee_id' => $data['replacement_employee_id'] ?? null,
            'submitted_by_id' => Auth::id(),
            'employee_id' => $employee->id,
        ]);

        return $this->response(201, __('messages.vacation_requested'));
    }

    public function cancelledVacation($id)
    {
        $vacation = $this->checkVacation($id);
        if (is_array($vacation)) {
            return $vacation;
        }

        if ($vacation->ceo_status === 'approved') {
            return $this->response(403, __('messages.forbiden'));
        }

        $vacation->delete();
        return $this->response(200, __('messages.request_cancelled'));
    }

    public function acceptVacation($id)
    {
        $vacation = $this->checkVacation($id);
        if (is_array($vacation)) {
            return $vacation;
        }
        $authUser = Auth::user();
        $role = strtolower(optional(optional($authUser->department)->translations()->where('locale', 'en')->first())->name);

        match ($role) {
            'ceo' => $this->approve($vacation, 'ceo'),
            'hr' => $this->approve($vacation, 'hr'),
            default => $this->approve($vacation, 'leader'),
        };

        $vacation->save();

        return $this->response(201, __('messages.request_approved'));
    }

    // ====== Helpers ======

    private function checkVacation($id)
    {
        $vacation = Vacation::with('employee.department')->find($id);
        return $vacation ?: $this->response(404, __('messages.not_found'));
    }

    private function vacationExists($employeeId, $startDate)
    {
        return Vacation::where('employee_id', $employeeId)->whereDate('start_date', $startDate)->exists();
    }

    private function calculateUsedDays($vacations)
    {
        return $vacations->filter(fn($v) => $v->ceo_status === 'approved')
            ->sum(fn($v) => $this->calculateVacationDays($v->start_date, $v->end_date));
    }

    private function calculateVacationDays($startDate, $endDate)
    {
        return Carbon::parse($startDate)->diffInDays(Carbon::parse($endDate)) + 1;
    }

    private function approve(Vacation $vacation, string $role)
    {
        $vacation["{$role}_status"] = 'approved';
        $vacation["{$role}_id"] = Auth::id();
    }

    private function response($code, $message, $data = null)
    {
        return compact('code', 'message', 'data');
    }
}
