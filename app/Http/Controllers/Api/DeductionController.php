<?php

namespace App\Http\Controllers\Api;


use App\Helpers\ApiResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\DeductionRequest;
use App\Services\DeductionService;

class DeductionController extends Controller
{
    use ApiResponseHelper;

    public $deductionService;

    public function __construct(DeductionService $deductionService)
    {
        $this->deductionService = $deductionService;
    }

    public function index()
    {
        $data = $this->deductionService->getAllDeductionsForAllEmployees();
        return $this->setCode($data['code'])->setMessage($data['message'])->setData($data['data'])->send();
    }

    public function store(DeductionRequest $request)
    {
        $data = $this->deductionService->makeDeduction($request->validated());
        return $this->setCode($data['code'])->setMessage($data['message'])->setData($data['data'])->send();
    }

    public function show($employeeId)
    {
        $data = $this->deductionService->getDeductionByEmployee($employeeId);
        return $this->setCode($data['code'])->setMessage($data['message'])->setData($data['data'])->send();
    }

    public function destroy($id)
    {
        $data = $this->deductionService->cancelledDeduction($id);
        return $this->setCode($data['code'])->setMessage($data['message'])->setData($data['data'])->send();
    }
}
