<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DeductionResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,

            'deduction_days' => $this->deduction_days,

            'reason' => $this->reason,
            'notes' => $this->notes,
            'is_automatic' => $this->is_automatic,

            // موافقات القائد
            'leader_status' => $this->leader_status,
            'leader_id' => $this->leader?->id,
            'leader_name' => $this->leader?->name,

            // موافقات HR
            'hr_status' => $this->hr_status,
            'hr_id' => $this->hr?->id,
            'hr_name' => $this->hr?->name,

            // موافقات CEO
            'ceo_status' => $this->ceo_status,
            'ceo_id' => $this->ceo?->id,
            'ceo_name' => $this->ceo?->name,

            // بيانات الموظف
            'employee_id' => $this->employee?->id,
            'employee_name' => $this->employee?->name,

            // نوع الخصم
            'type_id' => $this->type?->id,
            'type_name' => $this->type?->name,

            // من قام بتقديم الخصم
            'submitted_by_id' => $this->submittedBy?->id,
            'submitted_by_name' => $this->submittedBy?->name,

            'created_at' => $this->created_at?->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at?->format('Y-m-d H:i:s'),
        ];
    }
}
