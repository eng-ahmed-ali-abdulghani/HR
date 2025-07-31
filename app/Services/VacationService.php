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
        $start_date = $employee->start_date;
        $allowed_vacation_days = $employee->allowed_vacation_days;

        $vacations = Vacation::with(['type', 'replacementEmployee', 'submittedBy', 'approvedBy'])
            ->where('employee_id', $employee->id)
            ->whereDate('start_date', '>=', $start_date)
            ->orderBy('start_date', 'desc')
            ->get();

        // احتساب فقط الإجازات المعتمدة (موافقة)
        $approvedVacations = $vacations->where('status', 'approved');

        $totalDays = $approvedVacations->sum(function ($vacation) {
            $start = \Carbon\Carbon::parse($vacation->start_date);
            $end = \Carbon\Carbon::parse($vacation->end_date);
            return $start->diffInDays($end) + 1;
        });

        $remainingDays = max(0, $allowed_vacation_days - $totalDays);

        return [
            'from_date' => $start_date->toDateString(),
            'allowed_days' => $allowed_vacation_days,
            'total_days_used' => $totalDays, // فقط الإجازات المعتمدة
            'remaining_days' => $remainingDays,
            'vacations' => VacationResource::collection($vacations), // كل الإجازات للعرض
        ];
    }


    public function store($data)
    {
        $vacation = Vacation::create([
            'start_date' => $data['start_date'], 'end_date' => $data['end_date'],
            'notes' => $data['notes'], 'reason' => $data['reason'],
            'type_id' => $data['type_id'],
            'replacement_employee_id' => $data['replacement_employee_id'],
            'submitted_by_id' => Auth::id(), 'employee_id' => Auth::id(),
        ]);

        return new VacationResource($vacation);
    }

    public function destroy($id)
    {
        $vacation = Vacation::find($id);
        $vacation->delete();
    }


}
