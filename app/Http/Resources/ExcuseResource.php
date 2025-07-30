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

            'start_date' => $this->start_date->format('Y-m-d H:i'),
            'end_date' => $this->end_date->format('Y-m-d H:i'),

            'type' => [
                'id' => $this->type->id ?? null,
                'name' => $this->type->name ?? null,
            ],

            'reason' => $this->reason,
            'notes' => $this->notes,

            'leader_approval_status' => $this->leader_approval_status,
            'status' => $this->status,
            'is_due_to_official_mission' => $this->is_due_to_official_mission,

            'employee' => [
                'id' => $this->employee->id ?? null,
                'name' => $this->employee->name ?? null,
                'email' => $this->employee->email ?? null,
            ],

            'submitted_by' => [
                'id' => $this->submittedBy->id ?? null,
                'name' => $this->submittedBy->name ?? null,
                'email' => $this->submittedBy->email ?? null,
            ],

            'created_at' => $this->created_at->format('Y-m-d H:i'),
        ];
    }
}
