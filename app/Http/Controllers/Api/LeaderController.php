<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\DeductionRequest;
use App\Http\Resources\UserResource;
use App\Models\Department;
use App\Models\User;
use App\Services\DeductionService;
use App\Services\ExcuseService;
use App\Services\VacationService;
use Illuminate\Support\Facades\Auth;

class LeaderController extends Controller
{
    use ApiResponseHelper;

    public function getEmployees()
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
            'total_employees' => $employees->count(),
            'total_pending_vacations' => $totalVacations,
            'total_pending_excuses' => $totalExcuses,
            'total_pending_requests' => $totalRequests,
            'employees' => UserResource::collection($sortedEmployees),
        ];
        return $this->setCode(201)->setMessage(__('messages.leader_employees_fetched'))->setData($data)->send();

    }

    public function acceptVacation($id, VacationService $vacationService)
    {
        $data = $vacationService->acceptVacation($id);
        return $this->setCode($data['code'])->setMessage($data['message'])->send();
    }

    public function acceptExcuse($id, ExcuseService $excuseService)
    {
        $data = $excuseService->acceptExcuse($id);
        return $this->setCode($data['code'])->setMessage($data['message'])->send();
    }

    public function getVacationForUser($id, VacationService $vacationService)
    {
        $employee = $this->checkExistEmployee($id);
        if (!$employee) {
            return $this->setCode(404)->setMessage(__('messages.not_found'))->send();
        }
        $vacations = $vacationService->getVactionForEmployee($employee);
        return $this->setCode(200)->setMessage('Success')->setData($vacations)->send();
    }

    public function getExcuseForUser($id, ExcuseService $excuseService)
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

    public function makeDeduction(DeductionRequest $request, DeductionService $deductionService)
    {
        $data = $deductionService->makeDeduction($request->validated());
        return $this->setCode($data['code'])->setMessage($data['message'])->send();
    }
}
