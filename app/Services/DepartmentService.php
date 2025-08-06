<?php

namespace App\Services;


use App\Helpers\ApiResponseHelper;
use App\Http\Resources\DepartmentResource;
use App\Models\Department;

class DepartmentService
{
    use ApiResponseHelper;

    public function getAllDepartments(): array
    {
        $departments = Department::latest()->get();
        return $this->response(200, 'Departments retrieved successfully.', DepartmentResource::collection($departments));
    }

}
