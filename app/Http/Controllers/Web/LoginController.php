<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm ()
    {
        return view('dachboard.Pages.Login.login');
    }
    public function login(Request $request)
    {
        $credentials = $request->only('phone', 'password');
        // dd($credentials);
        if (Auth::attempt($credentials)) {
            // Session::put('user', $data['name']);
            return redirect()->route('admin')->with('success', 'You Logged In Successfully!');
        }
        else {
            return redirect()->back()->with('error','The Phone Or Password Is Incorrect');
        }
    }
}
