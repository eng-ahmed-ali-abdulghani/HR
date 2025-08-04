<?php

namespace App\Http\Controllers\Api;


use App\Models\Excuse;
use App\Services\ExcuseService;
use App\Helpers\ApiResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Excuses\StoreExcuseRequest;
use Illuminate\Support\Facades\Auth;

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
        $employee = auth()->user();
        $excuses = $this->excuseService->getExcuseForEmployee($employee);
        return $this->setCode(200)->setMessage('Success')->setData($excuses)->send();
    }

    public function store(StoreExcuseRequest $request)
    {
        $data = $this->excuseService->makeExcuse($request->validated());
        return $this->setCode($data['code'])->setMessage($data['message'])->setData($data['data'])->send();
    }

    public function destroy($id)
    {
        $data = $this->excuseService->cancelledExcuse($id);
        return $this->setCode($data['code'])->setMessage($data['message'])->setData($data['data'])->send();
    }
}
