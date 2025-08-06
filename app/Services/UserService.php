<?php

namespace App\Services;

use App\Helpers\ApiResponseHelper;
use App\Helpers\UploadImage;
use App\Http\Requests\Api\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Traits\MergeObjects;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Arr;

class UserService
{
    use ApiResponseHelper;
    use UploadImage;
    use ApiResponseHelper;
    use MergeObjects;

    public function getAllUsers(): array
    {
        $users = User::latest()->get();
        return $this->response(200, 'Users retrieved successfully.', UserResource::collection($users));
    }

    public function storeUser($data): array
    {
        $user = User::create([
            ...Arr::except($data, ['password']),
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

    public function updateAuthUser(UpdateUserRequest $request)
    {
        try {
            $user = Auth::user();

            // Handle image upload
            $newImageName = $this->handleModelImage($request, 'Users_images', $user);

            // Update user fields
            $user->update([
                'name' => $request->get('name', $user->name),
                'email' => $request->get('email', $user->email),
                'password' => $request->password ? Hash::make($request->password) : $user->password,
                'phone' => $request->get('phone', $user->phone),
                'age' => $request->get('age', $user->age),
            ]);

            // Update or create image record if there's a new image
            if ($newImageName) {
                $this->updateOrCreateImage($user, $newImageName);
            }

            // Prepare and return user data
            $imagePath = $newImageName ? config('app.photo_url') . $newImageName : ($user->image ? $user->image->photo : null);
            return $this->toArray($user, null, $imagePath);

        } catch (UniqueConstraintViolationException $exception) {
            return $this->setCode(422)->setMessage(__('validation.unique'))->send();
        }
    }

}
