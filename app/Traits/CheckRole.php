<?php

namespace App\Traits;
use Illuminate\Support\Str;


trait CheckRole
{


    public function handleApprovalByUserRole($model, $user, string $status): void
    {
        $roleName = optional($user->department?->translations()->firstWhere('locale', 'en'))->name;

        $roleKey = Str::lower($roleName ?? '');

        // الأدوار المسموح بها فقط
        $validRoles = ['ceo', 'hr', 'leader'];

        $finalRole = in_array($roleKey, $validRoles) ? $roleKey : 'leader';

        $this->setApprovalByRole($model, $finalRole, $user->id, $status);

        $model->save();
    }

    private function setApprovalByRole($model, string $role, int $userId, string $status): void
    {
        $model["{$role}_status"] = $status;  // "approved" or "rejected"
        $model["{$role}_id"] = $userId;
    }



}
