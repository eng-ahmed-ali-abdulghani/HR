<?php

namespace App\Services;

use App\Models\Deduction;
use App\Traits\CheckRole;
use Illuminate\Support\Facades\Auth;

class DeductionService
{
    use  CheckRole;

    public function makeDeduction($data)
    {
        $authUser = Auth::user();

        $deduction = Deduction::create(['deduction_days' => $data['deduction_days'],
            'employee_id' => $data['employee_id'], 'type_id' => $data['type_id'],
            'reason' => $data['reason'], 'notes' => $data['notes'],
            'submitted_by_id' => $authUser->id,
        ]);
        $this->handleApprovalByUserRole($deduction, $authUser, 'approved');
        return [
            'code' => 200,
            'message' => __('messages.deduction_created'),
            'data' => null,
        ];
    }
}
