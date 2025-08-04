<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\ChangeStatusRequest;
use App\Models\User;
use App\Models\Vacation;
use App\Services\VacationService;
use App\Helpers\ApiResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Vacations\StoreVacationRequest;

class VacationController extends Controller
{
    use ApiResponseHelper;

    protected $vacationService;

    public function __construct(VacationService $vacationService)
    {
        $this->vacationService = $vacationService;
    }

    public function index()
    {
        $data = $this->vacationService->getAllVactions();
        return $this->setCode(200)->setMessage($data['message'])->setData($data['data'])->send();
    }

    public function store(StoreVacationRequest $request)
    {
        $data = $this->vacationService->makeVacation($request->validated());
        return $this->setCode($data['code'])->setMessage($data['message'])->setData($data['data'])->send();
    }

    public function show($id)
    {
        $employee = User::where('id', $id)->first();
        if (!$employee) {
            return $this->setCode(404)->setMessage(__('messages.not_found'))->send();
        }
        $vacations = $this->vacationService->getVactionForEmployee($employee);
        return $this->setCode(200)->setMessage('Success')->setData($vacations)->send();
    }

    public function update(ChangeStatusRequest $request, $id)
    {
        $vacation = Vacation::where('id', $id)->first();
        if (!$vacation) {
            return $this->setCode(404)->setMessage(__('messages.not_found'))->send();
        }
        $data = $this->vacationService->changeStatusVacation($request->validated(), $vacation);
        return $this->setCode($data['code'])->setMessage($data['message'])->send();
    }

    public function destroy($id)
    {
        $data = $this->vacationService->cancelledVacation($id);
        return $this->setCode($data['code'])->setMessage($data['message'])->setData($data['data'])->send();
    }


}
