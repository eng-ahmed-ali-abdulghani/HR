<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\TypeResource;
use App\Models\Type;
use App\Helpers\ApiResponseHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    use ApiResponseHelper;

    public function index(Request $request)
    {
        $request->validate(['type' => 'required|string|exists:types,type']);
        $types = Type::where('type', $request->type)->latest()->get();
        $data = [
            'code' => 200,
            'message' => 'Get Data',
            'data' => TypeResource::collection($types)
        ];
        return $this->setCode($data['code'])->setMessage($data['message'])->setData($data['data'])->send();
    }

}
