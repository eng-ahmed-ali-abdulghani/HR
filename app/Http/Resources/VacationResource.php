<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VacationResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,

            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'days_count' => Carbon::parse($this->start_date)->diffInDays(Carbon::parse($this->end_date)) + 1,

            'employee_id' => $this->employee?->id,
            'employee_name' => $this->employee?->name,

            'type_id' => $this->type?->id,
            'type_name' => $this->type?->name,

            'reason' => $this->reason,

            'replacement_employee_id' => $this->replacementEmployee?->id,
            'replacement_employee_name' => $this->replacementEmployee?->name,

            'submitted_by_id' => $this->submittedBy?->id,
            'submitted_by_name' => $this->submittedBy?->name,

            // الموافقات
            'leader_status' => $this->leader_status,
            'leader_id' => $this->leader?->id,
            'leader_name' => $this->leader?->name,

            'hr_status' => $this->hr_status,
            'hr_id' => $this->hr?->id,
            'hr_name' => $this->hr?->name,

            'ceo_status' => $this->ceo_status,
            'ceo_id' => $this->ceo?->id,
            'ceo_name' => $this->ceo?->name,

            'notes' => $this->notes,

            'created_at' => $this->created_at?->toDateTimeString(),
        ];
    }
}
