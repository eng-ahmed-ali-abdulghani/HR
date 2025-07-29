<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Helpers\ApiResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\Reason;

class ReasonController extends Controller
{
    use ApiResponseHelper;
    public function index ()
    {
        $reasons = Reason::all();
        return $this->setCode(200)->setMessage('Success')->setData($reasons)->send();
    }
}
