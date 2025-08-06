<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Services\AttendanceService;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    use ApiResponseHelper;

    public $attendanceService;

    public function __construct(AttendanceService $attendanceService)
    {
        $this->attendanceService = $attendanceService;
    }

    public function home()
    {
        $user = Auth::user();
        $now = Carbon::now();
        $today = $now->startOfDay();
        $startOfMonth = $now->copy()->startOfMonth();
        $endOfMonth = $now->copy()->endOfMonth();

        // حضور اليوم
        $todayAttendance = DB::table('attendances')->selectRaw('
                            MIN(CASE WHEN type = "checkin" THEN timestamp END) as checkin_time,
                            MAX(CASE WHEN type = "checkout" THEN timestamp END) as checkout_time
                        ')->where('employee_id', $user->id)->whereDate('timestamp', $today)->first();

        $checkinTime = $todayAttendance->checkin_time ? Carbon::parse($todayAttendance->checkin_time) : null;
        $checkoutTime = $todayAttendance->checkout_time ? Carbon::parse($todayAttendance->checkout_time) : null;

        $workMinutesToday = ($checkinTime && $checkoutTime) ? $checkoutTime->diffInMinutes($checkinTime) : 0;
        $workHoursToday = round($workMinutesToday / 60, 2);

        // بيانات الشهر
        $monthlyAttendance = DB::table('attendances')->selectRaw('DATE(timestamp) as date,
                                MIN(CASE WHEN type = "checkin" THEN timestamp END) as checkin_time,
                                MAX(CASE WHEN type = "checkout" THEN timestamp END) as checkout_time'
                            )->where('employee_id', $user->id)->whereBetween('timestamp', [$startOfMonth, $endOfMonth])
                                ->groupBy(DB::raw('DATE(timestamp)'))->get();

        $attendanceDays = $monthlyAttendance->count();

        $totalMinutesWorked = $monthlyAttendance->sum(function ($day) {
            $checkin = $day->checkin_time ? Carbon::parse($day->checkin_time) : null;
            $checkout = $day->checkout_time ? Carbon::parse($day->checkout_time) : null;
            return ($checkin && $checkout) ? $checkout->diffInMinutes($checkin) : 0;
        });

        $totalWorkHours = round($totalMinutesWorked / 60, 2);

        $daysPassedThisMonth = $now->day;
        $absenceDays = max(0, $daysPassedThisMonth - $attendanceDays);

        return [
            'code' => 200,
            'message' => __('messages.attendance_summary'),
            'data' => [
                'today' => [
                    'checkin' => $checkinTime?->format('h:i A'),
                    'checkout' => $checkoutTime?->format('h:i A'),
                    'work_hours' => $workHoursToday,
                ],
                'monthly' => [
                    'attendance_days' => $attendanceDays,
                    'absence_days' => $absenceDays,
                    'total_work_hours' => $totalWorkHours,
                ],
                'auth_user' => new UserResource($user),
            ],
        ];
    }


}
