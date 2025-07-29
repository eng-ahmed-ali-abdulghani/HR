<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Helpers\ApiResponseHelper;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Api\LoginRequest;
use App\Http\Requests\Api\UpdateUserRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AuthController extends Controller
{
    use ApiResponseHelper;

    public function Login(Request $request)
    {
        if (!Auth::attempt(['phone' => $request->phone, 'password' => $request->password])) {
            return response()->json(['status' => false, 'message' => (__('auth.failed')), 'code' => 401], 401);
        }
        $user = User::where('phone', $request->phone)->first();
        $token = $user->createToken("API TOKEN")->plainTextToken;
        $user->company_name = $user->company ? $user->company->name : null;
        $user->department_name = $user->department ? $user->department->name : null;
        $user->shift_start = $user->shift ? $user->shift->start : null;
        $user->shift_end = $user->shift ? $user->shift->end : null;
        $user->token = $token;
        return $this->setCode(200)->setMessage('User Logeed in Successfully')->setData($user)->send();
    }

    public function update(UpdateUserRequest $request, UserService $userService)
    {
        try {
            $user = $userService->update($request);
            return $this->setCode(200)->setMessage(__('auth.update success'))->setData($user)->send();
        } catch (ModelNotFoundException $exception) {
            return $this->setCode(404)->setMessage(__('auth.user not found'))->send();
        }
    }

    public function logout(Request $request)
    {
        $user = $request->user();
        $user->tokens()->delete();
        return $this->setCode(200)->setMessage(__('auth.logout'))->send();
    }//End Method
}
