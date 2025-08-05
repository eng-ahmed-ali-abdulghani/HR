<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponseHelper;
use App\Http\Controllers\Controller;
use App\Services\AttendanceService;


class AttendanceController extends Controller
{
    use ApiResponseHelper;

    public $attendanceService;

    public function __construct(AttendanceService $attendanceService)
    {
        $this->attendanceService = $attendanceService;
    }

    public function show($id)
    {
        $data = $this->attendanceService->getAttendanceByUser($id);
        return $this->setCode($data['code'])->setMessage($data['message'])->setData($data['data'])->send();
    }
}
