<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AttendanceController extends Controller
{
    use ApiResponseHelper;

    public function show($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'الموظف غير موجود'], 404);
        }

        $attendances = DB::table('attendances')
            ->selectRaw('DATE(timestamp) as date')
            ->selectRaw('MIN(CASE WHEN type = "checkin" THEN timestamp END) as checkin_time')
            ->selectRaw('MAX(CASE WHEN type = "checkout" THEN timestamp END) as checkout_time')
            ->where('employee_id', $id)
            ->groupBy(DB::raw('DATE(timestamp)'))
            ->orderBy('date', 'desc')
            ->get()
            ->map(function ($row) {
                return [
                    'date' => $row->date,
                    'checkin_time' => $row->checkin_time ? Carbon::parse($row->checkin_time)->format('H:i') : null,
                    'checkout_time' => $row->checkout_time ? Carbon::parse($row->checkout_time)->format('H:i') : null,
                ];
            });

        return $this->setCode(200)->setMessage('Success')->setData($attendances)->send();

    }
}
