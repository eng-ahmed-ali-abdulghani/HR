<?php

namespace App\Http\Controllers\Api;

use App\Models\Type;
use Illuminate\Http\Request;
use App\Helpers\ApiResponseHelper;
use App\Http\Controllers\Controller;

class TypeController extends Controller
{
    use ApiResponseHelper;
    public function index ()
    {
        $types = Type::all();
        return $this->setCode(200)->setMessage('Success')->setData($types)->send();
    }
}
