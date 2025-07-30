<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponseHelper;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    use ApiResponseHelper;

    public function home()
    {
        return $this->setCode(200)->setMessage('Success')->setData(['types' => $types, 'reasons' => $reasons])->send();
    }
}
