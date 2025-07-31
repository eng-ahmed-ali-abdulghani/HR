<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\Vacation;
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

        // استعلام الإجازات
        $vacations = Vacation::with(['type', 'replacementEmployee', 'submittedBy', 'approvedBy'])->where('employee_id', $employee->id)
            ->whereDate('start_date', '>=', $start_date)->orderBy('start_date', 'desc')->get();

        // حساب عدد الأيام المستخدمة
        $totalDays = $vacations->sum(fn($vac) => Carbon::parse($vac->start_date)->diffInDays(Carbon::parse($vac->end_date)) + 1
        );

        $remainingDays = max(0, $allowed_vacation_days - $totalDays);

        // استعلام الأعذار
        $excuses = Excuse::with(['employee', 'type', 'submittedBy'])->where('employee_id', $employee->id)
            ->whereDate('start_date', '>=', $start_date)->orderBy('start_date', 'desc')->get();

        // عدد الأعذار في الشهر الحالي
        $monthlyExcusesCount = $excuses->filter(function ($excuse) use ($now) {
            $start = Carbon::parse($excuse->start_date);
            return $start->month === $now->month && $start->year === $now->year;
        })->count();

        return response()->json([
            'from_date' => $start_date->toDateString(),
            'allowed_days' => $allowed_vacation_days,
            'total_days_used' => $totalDays,
            'remaining_days' => $remainingDays,
            'monthly_excuses_count' => $monthlyExcusesCount,
            'total_excuses_count' => $excuses->count(),
            // 'vacations' => VacationResource::collection($vacations),
            // 'excuses' => ExcuseResource::collection($excuses),
        ]);
    }


}
