<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\Department;
use App\Models\Excuse;
use App\Models\User;
use App\Models\Vacation;
use App\Services\ExcuseService;
use App\Services\VacationService;
use Illuminate\Support\Facades\Auth;

class LeaderController extends Controller
{
    use ApiResponseHelper;

    public function getLeaderEmployees()
    {
        $departments = Department::with(['employees' => function ($query) {
            $query->withCount([
                'vacations as pending_vacations_count' => function ($q) {
                    $q->where('ceo_status', 'pending');
                },
                'excuses as pending_excuses_count' => function ($q) {
                    $q->where('ceo_status', 'pending');
                },
            ]);
        }])->where('leader_id', Auth::id())->latest()->get();

        // تجميع الموظفين من كل الأقسام
        $employees = $departments->flatMap(function ($dept) {
            return $dept->employees;
        });

        // ترتيب الموظفين حسب مجموع الطلبات المعلقة (إجازة + إذن)
        $sortedEmployees = $employees->sortByDesc(function ($employee) {
            return $employee->pending_vacations_count + $employee->pending_excuses_count;
        })->values(); // إعادة الفهرسة

        // حساب الإجماليات
        $totalVacations = $employees->sum('pending_vacations_count');
        $totalExcuses = $employees->sum('pending_excuses_count');
        $totalRequests = $totalVacations + $totalExcuses;

        $data = [
            'employees' => UserResource::collection($sortedEmployees),
            'total_employees' => $employees->count(),
            'total_pending_vacations' => $totalVacations,
            'total_pending_excuses' => $totalExcuses,
            'total_pending_requests' => $totalRequests,
        ];
        return $this->setCode(201)->setMessage(__('Success'))->setData($data)->send();

    }


    public function acceptRequestVacation($id)
    {
        $vacation = Vacation::with('employee.department')->where('id', $id)->where('ceo_status', 'pending')->first();
        return $this->acceptRequest($vacation);
    }

    public function acceptRequestExcuse($id)
    {
        $excuse = Excuse::with('employee.department')->where('id', $id)->where('ceo_status', 'pending')->first();
        return $this->acceptRequest($excuse);
    }

    private function acceptRequest($model)
    {
        if (!$model) {
            return $this->setCode(404)->setMessage(__('messages.not_found'))->send();
        }

        $department = $model->employee->department ?? null;

        if (!$department || $department->leader_id !== Auth::id()) {
            return $this->setCode(403)->setMessage(__('messages.forbidden'))->send();
        }
        // تحديث الحقول المشتركة
        $model->is_leader_approved = 'approved';
        $model->leader_approved_id = Auth::id();
        $model->save();

        return $this->setCode(201)->setMessage(__('success'))->send();
    }

    public function getRequestVacationForUser($id, VacationService $vacationService)
    {
        $employee = $this->checkExistEmployee($id);
        if (!$employee) {
            return $this->setCode(404)->setMessage(__('messages.not_found'))->send();
        }
        $vacations = $vacationService->getVactionForEmployee($employee);
        return $this->setCode(200)->setMessage('Success')->setData($vacations)->send();
    }

    public function getRequestExcuseForUser($id, ExcuseService $excuseService)
    {
        $employee = $this->checkExistEmployee($id);
        if (!$employee) {
            return $this->setCode(404)->setMessage(__('messages.not_found'))->send();
        }
        $excuses = $excuseService->getExcuseForEmployee($employee);
        return $this->setCode(200)->setMessage('Success')->setData($excuses)->send();
    }

    private function checkExistEmployee($id)
    {
        return User::where('id', $id)->first();
    }
}
