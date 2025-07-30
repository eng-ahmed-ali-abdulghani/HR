<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{

    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();
        if ($user && $user->user_type === "admin") {
            return $next($request);
        } else {
            $errorMessage = __('messages.forbiden');
            return redirect()->route('login')->with('error', $errorMessage);
        }
    }
}
