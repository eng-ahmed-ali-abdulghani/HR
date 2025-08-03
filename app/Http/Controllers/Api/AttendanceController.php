<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;

class AttendanceController extends Controller
{
    public function show($id)
    {
        $user = User::find($id);
        $attendances = $user->attendances;


    }
}
