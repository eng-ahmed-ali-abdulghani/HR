<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Resources\Json\JsonResource;

class ExcuseResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        Carbon::setLocale(App::currentLocale());
        $carbonDate = Carbon::parse($this->date);
        return [
            'id' => $this->id,
            'date' => $this->date,
            'day' =>  $carbonDate->translatedFormat('l'),
            'month' => $carbonDate->translatedFormat('F'),
            'time' => $this->hours,
            'type' => $this->type->name,
            'reason' => $this->reason->name,
            'note'=>$this->note,
            'mession'=>$this->mission ,
            'leader_approve'=>$this->leader_approve ,
            'status' => App::currentLocale() =='ar' ? $this->statu->name_ar : $this->statu->name_en,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
