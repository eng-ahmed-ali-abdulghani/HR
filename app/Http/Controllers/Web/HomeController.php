<?php

namespace App\Http\Controllers\Web;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index ()
    {
        $user = auth()->user();
        $users_count = User::where('user_type','user')->count();

        // dd($users_count);
        return view('dachboard.index',compact('user', 'users_count'));
    }
}
