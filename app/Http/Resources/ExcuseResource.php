<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class ExcuseResource extends JsonResource
{
    /**
     * تحويل بيانات العذر إلى مصفوفة JSON
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,

            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'days_count' => Carbon::parse($this->start_date)->diffInDays(Carbon::parse($this->end_date)) + 1,

            // الموظف
            'employee_id' => $this->employee?->id,
            'employee_name' => $this->employee?->name,

            // نوع العذر
            'type_id' => $this->type?->id,
            'type_name' => $this->type?->name,

            'reason' => $this->reason,

            // الموظف البديل
            'replacement_employee_id' => $this->replacementEmployee?->id,
            'replacement_employee_name' => $this->replacementEmployee?->name,

            // من قدم الطلب
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
