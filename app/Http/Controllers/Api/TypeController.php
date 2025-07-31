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

    public function GetType(Request $request)
    {
        $request->validate(['type' => 'required|string|exists:types,type']);
        $types = Type::where('type', $request->type)->get();
        return $this->setCode(200)->setMessage('Success')->setData(TypeResource::collection($types))->send();
    }

}
