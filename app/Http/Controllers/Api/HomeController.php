<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponseHelper;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\{Vacation, Deduction};
use Carbon\Carbon;
use App\Models\Excuse;

class HomeController extends Controller
{
    use ApiResponseHelper;


    public function home()
    {
        $employee = auth()->user();

        $start_date = Carbon::parse($employee->start_date); // تأكد من أنه Carbon
        $allowed_vacation_days = $employee->allowed_vacation_days;
        $now = Carbon::now();

        /**
         * الإجازات
         */
        $vacations = Vacation::where('employee_id', $employee->id)->whereDate('start_date', '>=', $start_date)->orderByDesc('start_date')->get();

        $totalDays = $vacations->sum(fn($vac) =>
            Carbon::parse($vac->start_date)->diffInDays(Carbon::parse($vac->end_date)) + 1
        );

        $remainingDays = max(0, $allowed_vacation_days - $totalDays);

        /**
         * الأعذار
         */
        $excuses = Excuse::where('employee_id', $employee->id)
            ->whereDate('start_date', '>=', $start_date)
            ->orderByDesc('start_date')
            ->get();

        $monthlyExcusesCount = $excuses->filter(function ($excuse) use ($now) {
            return Carbon::parse($excuse->start_date)->isSameMonth($now);
        })->count();

        /**
         * الخصومات
         */
        $deductions = Deduction::where('employee_id', $employee->id)
            ->whereDate('created_at', '>=', $start_date)
            ->get();

        $monthlyDeductionsCount = $deductions->filter(function ($deduction) use ($now) {
            return $deduction->created_at->isSameMonth($now);
        })->count();

        /**
         * التجهيز للإرسال
         */

        $attendance = DB::table('attendances')
            ->selectRaw('MIN(CASE WHEN type = "checkin" THEN timestamp END) as checkin_time')
            ->selectRaw('MAX(CASE WHEN type = "checkout" THEN timestamp END) as checkout_time')
            ->whereDate('timestamp', Carbon::today()->toDateString())
            ->where('employee_id', $employee->id)
            ->first();


        return $this->setCode(200)->setMessage('Success')->setData([

            'from_date' => $start_date->toDateString(),

            'allowed_vacation_days' => $allowed_vacation_days,
            'total_vacation_days_used' => $totalDays,
            'remaining_vacation_days' => $remainingDays,

            'monthly_excuses_count' => $monthlyExcusesCount,
            'total_excuses_count' => $excuses->count(),

            'monthly_deductions_count' => $monthlyDeductionsCount,
            'total_deductions_count' => $deductions->count(),

            'date' => Carbon::today()->toDateString(),
            'checkin_time' => $attendance->checkin_time ? Carbon::parse($attendance->checkin_time)->format('H:i') : null,
            'checkout_time' => $attendance->checkout_time ? Carbon::parse($attendance->checkout_time)->format('H:i') : null,

        ])->send();
    }


}
