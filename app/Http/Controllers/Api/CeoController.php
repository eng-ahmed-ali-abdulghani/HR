<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\DeductionRequest;
use App\Http\Resources\UserResource;
use App\Models\Deduction;
use App\Models\Department;
use App\Models\User;
use App\Services\ExcuseService;
use App\Services\VacationService;
use Illuminate\Support\Facades\Auth;

class CeoController extends Controller
{
    use ApiResponseHelper;

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

    public function makeDeduction(DeductionRequest $request)
    {
        $data = $request->validated();
        Deduction::create([
            'deduction_days' => $data['deduction_days'], 'employee_id' => $data['employee_id'],
            'type_id' => $data['type_id'], 'reason' => $data['reason'],
            'notes' => $data['notes'], 'submitted_by_id' => Auth::id(),
            'leader_status' => 'approved', 'leader_id' => Auth::id(),
        ]);
        return $this->setCode(200)->setMessage('تم اضافة الخصم بنجاح ')->send();
    }

}
