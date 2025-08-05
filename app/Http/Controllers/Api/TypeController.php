<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\GetTypeRequest;
use App\Helpers\ApiResponseHelper;
use App\Http\Controllers\Controller;
use App\Services\TypeService;

class TypeController extends Controller
{
    use ApiResponseHelper;

    public $typeService;

    public function __construct(TypeService $typeService)
    {
        $this->typeService = $typeService;
    }

    public function index(GetTypeRequest $request)
    {
        $data = $this->typeService->getType($request->type);
        return $this->setCode($data['code'])->setMessage($data['message'])->setData($data['data'])->send();
    }

}
