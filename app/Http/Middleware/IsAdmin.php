<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $user = $request->user();
            if($user && $user->user_type =="admin"){
                return $next($request);
            }
            else{
                $errorMessage = __('messages.forbiden');
                return redirect()->route('login')->with('error',$errorMessage);
            }
    }
}
