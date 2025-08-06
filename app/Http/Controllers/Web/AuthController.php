<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function LoginForm()
    {
        return view('login');
    }

    public function loginSubmit(Request $request)
    {
        $validated = $request->validate(['phone' => ['required', 'string', 'exists:users,phone'], 'password' => ['required', 'string', 'min:6']]);

        $user = User::where('phone', $validated['phone'])->first();
        $roleName = optional($user->department?->translations()->firstWhere('locale', 'en'))->name;
        $roleKey = Str::lower($roleName ?? '');
        $validRoles = ['ceo', 'hr', 'it'];

        if (!in_array($roleKey, $validRoles)) {
            return redirect()->back()->with('error', 'You are not authorized to access this system.');
        }
        if (Auth::attempt(['phone' => $validated['phone'], 'password' => $validated['password']])) {
            return redirect()->route('attendance.index')->with('success', 'You have logged in successfully.');
        } else {
            return redirect()->back()->with('error', 'Incorrect phone number or password.');
        }

    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }


}
