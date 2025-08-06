<?php

namespace App\Services;


use App\Http\Resources\UserResource;
use App\Models\User;

class UserService
{

    public function getAllUsers()
    {
        $users = User::latest()->get();
        return [
            'code' => 200,
            'message' => 'Get Data Successful',
            'date' => UserResource::collection($users),
        ];
    }

    public function storeUser($data)
    {
        User::create([
            ...$data->except(['password']),
            'password' => Hash::make($data['password']),
        ]);
        return [
            'code' => 201,
            'message' => 'Create User Successful',
            'data' => null,
        ];
    }

    public function getUserByID($id)
    {
        $user = User::find($id);
        if (!$user) {
            return [
                'code' => 404,
                'message' => ' User Not Found',
                'data' => null,
            ];
        }
        return [
            'code' => 201,
            'message' => 'Get User Successful',
            'data' => new UserResource($user),
        ];
    }
}
