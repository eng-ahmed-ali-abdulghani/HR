<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\ChangeStatusRequest;
use App\Http\Requests\DeductionRequest;
use App\Models\User;
use App\Services\DeductionService;
use App\Services\ExcuseService;
use App\Services\VacationService;

class CeoController extends Controller
{
    use ApiResponseHelper;

    public function changeStatusVacation(ChangeStatusRequest $request, VacationService $vacationService)
    {
        $data = $vacationService->changeStatusVacation($request->validated());
        return $this->setCode($data['code'])->setMessage($data['message'])->send();
    }

    public function changeStatusExcuse(ChangeStatusRequest $request, ExcuseService $excuseService)
    {
        $data = $excuseService->changeStatusExcuse($request->validated());
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
