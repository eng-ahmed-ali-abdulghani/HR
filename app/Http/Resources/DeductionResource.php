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
            'is_approved' => $this->is_approved,

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
