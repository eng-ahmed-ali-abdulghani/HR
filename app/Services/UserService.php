<?php

namespace App\Services;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserService
{
    public function getAllUsers(): array
    {
        $users = User::latest()->get();

        return $this->response(200, 'Users retrieved successfully.', UserResource::collection($users));
    }

    public function storeUser($data): array
    {
        $user = User::create([
            ...$data->except(['password']),
            'password' => Hash::make($data['password']),
        ]);

        return $this->response(201, 'User created successfully.', new UserResource($user->fresh()));
    }

    public function getUserByID($id): array
    {
        try {
            $user = User::findOrFail($id);
            return $this->response(200, 'User retrieved successfully.', new UserResource($user));
        } catch (ModelNotFoundException) {
            return $this->response(404, 'User not found.');
        }
    }

    public function updateUser($id, $data): array
    {
        try {
            $user = User::findOrFail($id);
            $user->update($data);
            return $this->response(200, 'User updated successfully.', new UserResource($user->fresh()));
        } catch (ModelNotFoundException) {
            return $this->response(404, 'User not found.');
        }
    }

    public function destroy($id): array
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();
            return $this->response(200, 'User deleted successfully.');
        } catch (ModelNotFoundException) {
            return $this->response(404, 'User not found.');
        }
    }

    private function response(int $code, string $message, $data = null): array
    {
        return [
            'code' => $code,
            'message' => $message,
            'data' => $data,
        ];
    }
}
