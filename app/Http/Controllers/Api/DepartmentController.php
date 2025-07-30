<?php

namespace App\Http\Controllers\Api;


use App\Helpers\ApiResponseHelper;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DepartmentController extends Controller
{
    use ApiResponseHelper;

    // Fetch all departments
    public function index()
    {
        $departments = Department::all();
        return $this->setCode(200)->setMessage('Success')->setData($departments)->send();
    }

    // Fetch a specific department by ID
    public function show($id)
    {
        $department = Department::with('users')->find($id);
        if (!$department) {
            return $this->setCode(404)->setMessage('Department not found')->send();
        }
        return $this->setCode(200)->setMessage('Success')->setData($department)->send();
    }
}
