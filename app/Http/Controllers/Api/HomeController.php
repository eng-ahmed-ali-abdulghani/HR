<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponseHelper;
use App\Http\Controllers\Controller;
use App\Services\AttendanceService;
use Illuminate\Support\Facades\Auth;

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
        $data = $this->attendanceService->getAttendanceByUser(Auth::id());
        return $this->setCode($data['code'])->setMessage($data['message'])->setData($data['data'])->send();
    }


}
