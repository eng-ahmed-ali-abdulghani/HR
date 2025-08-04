<?php

namespace App\Http\Controllers\Api;

use App\Services\VacationService;
use App\Helpers\ApiResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Vacations\StoreVacationRequest;
use Illuminate\Support\Facades\Auth;

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
        $employee = auth()->user();
        $vacations = $this->vacationService->getVactionForEmployee($employee);
        return $this->setCode(200)->setMessage('Success')->setData($vacations)->send();
    }

    public function store(StoreVacationRequest $request)
    {
        $employee = Auth::user();
        $data = $this->vacationService->makeVacation($request->validated(), $employee);
        return $this->setCode($data['code'])->setMessage($data['message'])->setData($data['data'])->send();
    }

    public function destroy($id)
    {
        $data = $this->vacationService->cancelledVacation($id);
        return $this->setCode($data['code'])->setMessage($data['message'])->setData($data['data'])->send();
    }

}
