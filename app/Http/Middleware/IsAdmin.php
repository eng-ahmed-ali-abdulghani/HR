<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{

    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        $roleName = optional($user->department?->translations()->firstWhere('locale', 'en'))->name;

        $roleKey = Str::lower($roleName ?? '');

        // الأدوار المسموح بها فقط
        $validRoles = ['ceo', 'hr', 'it'];


        if (in_array($roleKey, $validRoles)) {
            return $next($request);
        } else {
            $errorMessage = __('messages.forbiden');
            return redirect()->route('login')->with('error', $errorMessage);
        }
    }
}
