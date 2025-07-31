<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ExcuseResource extends JsonResource
{
    /**
     * تحويل بيانات العذر إلى مصفوفة JSON
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,

            'start_date'   => optional($this->start_date)->format('Y-m-d H:i:s'),
            'end_date'     => optional($this->end_date)->format('Y-m-d H:i:s'),

            'days_count' => \Carbon\Carbon::parse($this->start_date)->diffInDays(\Carbon\Carbon::parse($this->end_date)) + 1,

            'employee_id' => $this->employee?->id,
            'employee_name' => $this->employee?->name,

            'type_id' => $this->type?->id,
            'type_name' => $this->type?->name,

            'reason' => $this->reason,

            'replacement_employee_id' => $this->replacementEmployee?->id,
           'replacement_employee_name' => $this->replacementEmployee?->name,

            'submitted_by_id' => $this->submittedBy?->id,
            'submitted_by_name' => $this->submittedBy?->name,

            'approved_by_id' => $this->approvedBy?->id,
            'approved_by_name' => $this->approvedBy?->name,

            'notes' => $this->notes,

            'is_leader_approved' => $this->is_leader_approved,

            'status' => $this->status,

            'created_at' => $this->created_at?->toDateTimeString(),
        ];

    }
}
