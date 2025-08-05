<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponseHelper;
use App\Http\Controllers\Controller;
use App\Services\AttendanceService;
use Illuminate\Http\Request;


class AttendanceController extends Controller
{
    use ApiResponseHelper;

    public $attendanceService;

    public function __construct(AttendanceService $attendanceService)
    {
        $this->attendanceService = $attendanceService;
    }

    public function index(Request $request)
    {
        $validated = $request->validate(['date' => ['nullable', 'date_format:Y-m-d']]);
        if (isset($validated['date'])) {
            $data = $this->attendanceService->getAttendancesByDate($validated['date']);
        } else {
            $data = $this->attendanceService->getAttendanceForAllEmployees();
        }
        return $this->setCode($data['code'])->setMessage($data['message'])->setData($data['data'])->send();
    }

    public function show($id)
    {
        $data = $this->attendanceService->getAttendanceByEmployee($id);
        return $this->setCode($data['code'])->setMessage($data['message'])->setData($data['data'])->send();
    }
}
