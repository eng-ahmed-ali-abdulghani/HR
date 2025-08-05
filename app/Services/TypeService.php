<?php

namespace App\Services;


use App\Http\Resources\TypeResource;
use App\Models\Type;

class TypeService
{

    public function getType($type)
    {
        $types = Type::where('type', $type)->latest()->get();
        return [
            'code' => 200,
            'message' => 'Get Data',
            'data' => TypeResource::collection($types)
        ];
    }

}
