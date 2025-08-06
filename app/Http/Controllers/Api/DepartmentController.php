<?php

namespace App\Http\Controllers\Api;


use App\Helpers\ApiResponseHelper;
use App\Models\Department;
use App\Services\DepartmentService;
use App\Services\UserService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DepartmentController extends Controller
{
    use ApiResponseHelper;

    protected DepartmentService $departmentService;

    public function __construct(DepartmentService $departmentService)
    {
        $this->departmentService = $departmentService;
    }

    public function index()
    {
        $response = $this->departmentService->getAllDepartments();
        return $this->buildResponse($response);
    }

}
