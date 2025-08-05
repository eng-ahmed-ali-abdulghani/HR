<?php

namespace App\Services;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AttendanceService
{
    public function getAttendanceForAllEmployees()
    {
        $attendances = DB::table('attendances')->selectRaw('
                        employee_id,
                        DATE(timestamp) as date,
                        MIN(CASE WHEN type = "checkin" THEN timestamp END) as checkin_time,
                        MAX(CASE WHEN type = "checkout" THEN timestamp END) as checkout_time
                    ')
            ->groupBy('employee_id', DB::raw('DATE(timestamp)'))
            ->orderByDesc('date')
            ->get()
            ->map(function ($row) {
                $user = User::find($row->employee_id); // جلب اسم الموظف
                return [
                    'employee_id' => $row->employee_id,
                    'employee_name' => $user?->name,
                    'date' => $row->date,
                    'checkin_time' => $row->checkin_time ? Carbon::parse($row->checkin_time)->format('H:i') : null,
                    'checkout_time' => $row->checkout_time ? Carbon::parse($row->checkout_time)->format('H:i') : null,
                ];
            });

        return [
            'code' => 200,
            'message' => __('messages.success'),
            'data' => $attendances
        ];
    }


    public function getAttendancesByDate($date)
    {
        try {
            $parsedDate = Carbon::parse($date)->toDateString(); // yyyy-mm-dd
        } catch (\Exception $e) {
            return [
                'code' => 400,
                'message' => 'صيغة التاريخ غير صحيحة',
                'data' => null
            ];
        }
        $attendances = DB::table('attendances')->selectRaw('
                        employee_id,
                        DATE(timestamp) as date,
                        MIN(CASE WHEN type = "checkin" THEN timestamp END) as checkin_time,
                        MAX(CASE WHEN type = "checkout" THEN timestamp END) as checkout_time
                    ')
            ->whereDate('timestamp', $parsedDate)
            ->groupBy('employee_id', DB::raw('DATE(timestamp)'))
            ->orderBy('employee_id')
            ->get()
            ->map(function ($row) {
                $user = User::find($row->employee_id);

                return [
                    'employee_id' => $row->employee_id,
                    'employee_name' => $user?->name,
                    'date' => $row->date,
                    'checkin_time' => $row->checkin_time ? Carbon::parse($row->checkin_time)->format('H:i') : null,
                    'checkout_time' => $row->checkout_time ? Carbon::parse($row->checkout_time)->format('H:i') : null,
                ];
            });

        return [
            'code' => 200,
            'message' => 'تم جلب الحضور بنجاح',
            'data' => $attendances
        ];
    }


    public function getAttendanceByEmployee($id)
    {
        $user = User::find($id);

        if (!$user) {
            return [
                'code' => 404,
                'message' => __('messages.user_not_found'),
                'data' => null
            ];
        }
        $attendances = DB::table('attendances')->selectRaw('DATE(timestamp) as date,
                     MIN(CASE WHEN type = "checkin" THEN timestamp END) as checkin_time,
                     MAX(CASE WHEN type = "checkout" THEN timestamp END) as checkout_time')
            ->where('employee_id', $id)->groupBy(DB::raw('DATE(timestamp)'))
            ->orderByDesc('date')->get()
            ->map(function ($row) {
                return [
                    'date' => $row->date,
                    'checkin_time' => $row->checkin_time ? Carbon::parse($row->checkin_time)->format('H:i') : null,
                    'checkout_time' => $row->checkout_time ? Carbon::parse($row->checkout_time)->format('H:i') : null,
                ];
            });

        return [
            'code' => 200,
            'message' => __('messages.success'),
            'data' => $attendances
        ];
    }
}
