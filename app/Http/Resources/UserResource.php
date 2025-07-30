<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            'id'           => $this->id,
            'name'         => $this->name,
            'username'     => $this->username,
            'email'        => $this->email,
            'title'        => $this->title,
            'code'         => $this->code,
            'phone'        => $this->phone,
            'gender'       => $this->gender,
            'age'          => $this->age,
            'birth_date'   => $this->birth_date,
            'vacations'    => $this->vacations,
            'sallary'      => $this->sallary,
            'start_date'   => $this->start_date,
            'end_date'     => $this->end_date,
            'department_id'=> $this->department_id,
            'company_id'   => $this->company_id,
            'user_type'    => $this->user_type,
          //  'fcm_token'    => $this->fcm_token,
            // إذا كانت هناك علاقة لصورة
            'image'        => $this->image?->photo, // تأكد من علاقة image موجودة
        ];
    }
}
