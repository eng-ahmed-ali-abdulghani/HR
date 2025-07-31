<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\{Vacation, Deduction};
use Carbon\Carbon;
use App\Models\Excuse;

class HomeController extends Controller
{
    use ApiResponseHelper;

    public function home()
    {
        $employee = auth()->user();

        $start_date = $employee->start_date;
        $allowed_vacation_days = $employee->allowed_vacation_days;
        $now = Carbon::now();

        // الإجازات
        $vacations = Vacation::with(['type', 'replacementEmployee', 'submittedBy', 'approvedBy'])->where('employee_id', $employee->id)
            ->whereDate('start_date', '>=', $start_date)->orderBy('start_date', 'desc')->get();

        $totalDays = $vacations->sum(fn($vac) => Carbon::parse($vac->start_date)->diffInDays(Carbon::parse($vac->end_date)) + 1);
        $remainingDays = max(0, $allowed_vacation_days - $totalDays);

        // الأعذار
        $excuses = Excuse::with(['employee', 'type', 'submittedBy'])
            ->where('employee_id', $employee->id)
            ->whereDate('start_date', '>=', $start_date)
            ->orderBy('start_date', 'desc')
            ->get();

        $monthlyExcusesCount = $excuses->filter(function ($excuse) use ($now) {
            $start = Carbon::parse($excuse->start_date);
            return $start->month === $now->month && $start->year === $now->year;
        })->count();

        // الخصومات
        $deductions = Deduction::where('employee_id', $employee->id)
            ->whereDate('created_at', '>=', $start_date)
            ->get();

        $monthlyDeductionsCount = $deductions->filter(function ($deduction) use ($now) {
            return $deduction->created_at->month === $now->month && $deduction->created_at->year === $now->year;
        })->count();

        $data = [
            'from_date' => $start_date->toDateString(),

            'allowed_vacation_days' => $allowed_vacation_days,
            'total_vacation_days_used' => $totalDays,
            'remaining_vacation_days' => $remainingDays,

            'monthly_excuses_count' => $monthlyExcusesCount,
            'total_excuses_count' => $excuses->count(),

            'monthly_deductions_count' => $monthlyDeductionsCount,
            'total_deductions_count' => $deductions->count(),
        ];
        return $this->setCode(200)->setMessage('Success')->setData($data)->send();
    }


}
