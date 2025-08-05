<?php

namespace App\Http\Controllers\Api;


use App\Http\Requests\ChangeStatusRequest;
use App\Services\ExcuseService;
use App\Helpers\ApiResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Excuses\StoreExcuseRequest;

class ExcuseController extends Controller
{
    use ApiResponseHelper;

    protected $excuseService;

    public function __construct(ExcuseService $excuseService)
    {
        $this->excuseService = $excuseService;
    }

    public function index()
    {
        $data = $this->excuseService->getAllExcuses();
        return $this->setCode($data['code'])->setMessage($data['message'])->setData($data['data'])->send();
    }

    public function store(StoreExcuseRequest $request)
    {
        $data = $this->excuseService->makeExcuse($request->validated());
        return $this->setCode($data['code'])->setMessage($data['message'])->setData($data['data'])->send();
    }

    public function show($id)
    {
        $excuses = $this->excuseService->getExcuseForEmployee($id);
        return $this->setCode(200)->setMessage('Success')->setData($excuses)->send();
    }

    public function update(ChangeStatusRequest $request, $id)
    {
        $data = $this->excuseService->changeStatusExcuse($request->validated(), $id);
        return $this->setCode($data['code'])->setMessage($data['message'])->send();
    }

    public function destroy($id)
    {
        $data = $this->excuseService->cancelledExcuse($id);
        return $this->setCode($data['code'])->setMessage($data['message'])->setData($data['data'])->send();
    }
}
