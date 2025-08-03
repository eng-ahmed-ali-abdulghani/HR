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

            // موافقات فردية
            'is_leader_approved' => $this->is_leader_approved,
            'leader_approved_id' => $this->leaderApprover?->id,
            'leader_approver_name' => $this->leaderApprover?->name,

            'is_hr_approved' => $this->is_hr_approved,
            'hr_approved_id' => $this->hrApprover?->id,
            'hr_approver_name' => $this->hrApprover?->name,

            'is_ceo_approved' => $this->is_ceo_approved,
            'ceo_approved_id' => $this->ceoApprover?->id,
            'ceo_approver_name' => $this->ceoApprover?->name,


            'employee_id' => $this->employee?->id,
            'employee_name' => $this->employee?->name,

            'type_id' => $this->type?->id,
            'type_name' => $this->type?->name,

            'submitted_by_id' => $this->submittedBy?->id,
            'submitted_by_name' => $this->submittedBy?->name,

            'created_at' => $this->created_at?->format('Y-m-d H:i:s'),

            'updated_at' => $this->updated_at?->format('Y-m-d H:i:s'),
        ];
    }
}
