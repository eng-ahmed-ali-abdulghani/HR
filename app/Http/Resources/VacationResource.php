<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Resources\Json\JsonResource;

class VacationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,

            'start_date' => $this->start_date,

            'end_date' => $this->end_date,

            'days_count' => \Carbon\Carbon::parse($this->start_date)->diffInDays(\Carbon\Carbon::parse($this->end_date)) + 1,

            'employee' => [
                'id' => $this->employee?->id,
                'name' => $this->employee?->name,
            ],

            'type' => [
                'id' => $this->type?->id,
                'name' => $this->type?->name,
            ],

            'reason' => $this->reason,

            'replacement_employee' => [
                'id' => $this->replacementEmployee?->id,
                'name' => $this->replacementEmployee?->name,
            ],

            'submitted_by' => [
                'id' => $this->submittedBy?->id,
                'name' => $this->submittedBy?->name,
            ],

            'approved_by' => [
                'id' => $this->approvedBy?->id,
                'name' => $this->approvedBy?->name,
            ],

            'notes' => $this->notes,

            'is_leader_approved' => $this->is_leader_approved,

            'status' => $this->status,

            'created_at' => $this->created_at?->toDateTimeString(),
        ];
    }
}
