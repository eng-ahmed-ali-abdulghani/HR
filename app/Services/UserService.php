<?php

namespace App\Services;


use App\Models\User;
use App\Models\Image;
use App\Helpers\UploadImage;
use App\Traits\MergeObjects;
use App\Helpers\ApiResponseHelper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Api\UpdateUserRequest;
use Illuminate\Database\UniqueConstraintViolationException;


class UserService
{
    use UploadImage;
    use ApiResponseHelper;
    use MergeObjects;

    public function getUser($user_id)
    {
        $user = User::where('id', $user_id)->with('image')->first();
        $formattedUser = $user->toArray();
        // If the user has an image, extract the URL and add it to the user object
        if ($user->image) {
            $formattedUser['photo'] = $user->image->photo;
        } else {
            $formattedUser['photo'] = null;
        }
        // Remove the 'image' key from the user object
        unset($formattedUser['image']);
        return $formattedUser;
    }

    public function update(UpdateUserRequest $request)
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


    public function delete(int $user_id)
    {
        // Get the associated image record
        $image = Image::where('imageable_type', User::class)
            ->where('imageable_id', $user_id)
            ->first();

        // Check if the image exists and delete it
        if ($image) {
            // Delete the image file from storage if it exists
            if (File::exists(str_replace(config('app.photo_url'), '', $image->photo))) {
                File::delete(str_replace(config('app.photo_url'), '', $image->photo));
            }

            // Delete the image record from the database
            $image->delete();
        }

        User::find($user_id)->delete();
        return $this->setCode(200)->setMessage('Success')->send();
    }
}


