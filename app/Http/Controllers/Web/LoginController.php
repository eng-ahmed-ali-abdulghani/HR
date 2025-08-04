<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function LoginForm()
    {
        return view('login');
    }

    public function loginSubmit(Request $request)
    {
        $credentials = $request->only('phone', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->route('admin')->with('success', 'You Logged In Successfully!');
        } else {
            return redirect()->back()->with('error', 'The Phone Or Password Is Incorrect');
        }
    }
}
