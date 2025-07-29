<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\Reason;
use App\Models\Type;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    use ApiResponseHelper;
    public function home ()
    {
        $types = Type::get();
        $reasons = Reason::get();
        return $this->setCode(200)->setMessage('Success')->setData(['types'=>$types,'reasons'=>$reasons])->send();

    }
}
