<?php

namespace App\Helpers;

use Illuminate\Support\Facades\File;

trait UploadImage
{

    public function uploadImage($request, $folder, $currentImage = null)
    {
        if ($request->hasFile('photo')) {
            if ($currentImage && File::exists(str_replace(config('app.photo_url'), "", $currentImage))) {
                File::delete(str_replace(config('app.photo_url'), "", $currentImage));
            }
            $image = $request->file('photo');
            $ext = strtolower($image->getClientOriginalExtension());
            $name = "uploads/$folder/" . time() . ".$ext";
            $image->move("uploads/$folder/", $name);
            return $name;
        }
        return null;
    }

    public function handleModelImage($request, $folder, $model)
    {
        $currentImage = $model->image ? $model->image->photo : null;
        return $this->uploadImage($request, $folder, $currentImage);
    }

    public function updateOrCreateImage($model, $imageName)
    {
        $imageData = ['photo' => config('app.photo_url') . $imageName];

        if ($model->image) {
            $model->image()->update($imageData);
        } else {
            $model->image()->create($imageData);
        }
    }
}
