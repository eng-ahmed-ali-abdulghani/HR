<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Helpers\ApiResponseHelper;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Api\UpdateUserRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AuthController extends Controller
{
    use ApiResponseHelper;

    public function Login(LoginRequest $request)
    {
        $data = $request->validated();
        if (!Auth::attempt(['phone' => $data['phone'], 'password' => $data['password']])) {
            return response()->json(['status' => false, 'message' => (__('auth.failed')), 'code' => 401], 401);
        }
        $user = User::where('phone', $data['phone'])->first();
        $user['token']= $user->createToken('auth_token')->plainTextToken;
        return $this->setCode(200)->setMessage('User Logeed in Successfully')->setData(new UserResource($user))->send();
    }

    public function update(UpdateUserRequest $request, UserService $userService)
    {
        try {
            $user = $userService->update($request);
            return $this->setCode(200)->setMessage(__('auth.update success'))->setData(new UserResource($user))->send();
        } catch (ModelNotFoundException $exception) {
            return $this->setCode(404)->setMessage(__('auth.user not found'))->send();
        }
    }

    public function logout(Request $request)
    {
        $user = $request->user();
        $user->tokens()->delete();
        return $this->setCode(200)->setMessage(__('auth.logout'))->send();
    }
}
