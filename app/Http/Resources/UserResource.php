<?php

namespace App\Http\Resources;

use App\Models\Vacation;
use App\Models\Excuse;
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
            'birth_date'   =>optional($this->birth_date)->format('Y-m-d H:i:s'),
            'sallary'      => $this->sallary,
            'start_date'   => optional($this->start_date)->format('Y-m-d H:i:s'),
            'end_date'     => optional($this->end_date)->format('Y-m-d H:i:s'),

            'department_id'=> $this->department->id,
            'department_name'=> $this->department->name,

            'company_id'=> $this->department->company->id,
            'company_name'=> $this->department->company->name,

            'user_type'    => $this->user_type,
          //  'fcm_token'    => $this->fcm_token,
            // إذا كانت هناك علاقة لصورة
            'image'        =>  $this->image->photo??null, // تأكد من علاقة image موجودة

            'is_vacation_pending' => Vacation::where('employee_id', $this->id)->where('is_ceo_approved', 'pending')->exists(),

            'is_excuse_pending' => Excuse::where('employee_id', $this->id)->where('is_ceo_approved', 'pending')->exists(),

            'token'=>$this->token??null,
        ];
    }
}
