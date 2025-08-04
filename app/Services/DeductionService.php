<?php

namespace App\Services;

use App\Models\Deduction;
use Illuminate\Support\Facades\Auth;

class DeductionService
{
    public function makeDeduction($data)
    {
        $authUser = Auth::user();

        $deduction = Deduction::create(['deduction_days' => $data['deduction_days'],
            'employee_id' => $data['employee_id'], 'type_id' => $data['type_id'],
            'reason' => $data['reason'], 'notes' => $data['notes'],
            'submitted_by_id' => $authUser->id,
        ]);
        $role = strtolower(optional(optional($authUser->department)->translations()->where('locale', 'en')->first())->name);

        if ($role === 'ceo') {
            $deduction->ceo_status = 'approved';
            $deduction->ceo_id = $authUser->id;
        } elseif ($role === 'hr') {
            $deduction->hr_status = 'approved';
            $deduction->hr_id = $authUser->id;
        } else {
            $deduction->leader_status = 'approved';
            $deduction->leader_id = $authUser->id;
        }
        $deduction->save();
        return [
            'code' => 200,
            'message' => __('messages.deduction_created'),
            'data' => null,
        ];
    }
}
