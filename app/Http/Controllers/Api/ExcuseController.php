<?php

namespace App\Http\Controllers\Api;

use App\Models\Excuse;
use Illuminate\Http\Request;
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

    public function index(Request $request){
        $excuses = $this->excuseService->getYourExcuses($request);
        return $this->setCode(200)->setMessage('Success')->setData($excuses)->send();
    }

    public function store(StoreExcuseRequest $request)
    {
        $excuse = $this->excuseService->MakeExcuse($request);
        return $this->setCode(200)->setMessage('Success')->setData($excuse)->send();
    }

}
