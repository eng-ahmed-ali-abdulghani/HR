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

            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
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

            // موافقات منفصلة
            'is_leader_approved' => $this->is_leader_approved,
            'leader_approved_id' => $this->leaderApprover?->id,
            'leader_approver_name' => $this->leaderApprover?->name,

            'is_hr_approved' => $this->is_hr_approved,
            'hr_approved_id' => $this->hrApprover?->id,
            'hr_approver_name' => $this->hrApprover?->name,

            'is_ceo_approved' => $this->is_ceo_approved,
            'ceo_approved_id' => $this->ceoApprover?->id,
            'ceo_approver_name' => $this->ceoApprover?->name,


            'notes' => $this->notes,

            'created_at' => $this->created_at?->toDateTimeString(),
        ];


    }
}
