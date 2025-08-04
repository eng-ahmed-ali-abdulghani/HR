<?php

namespace App\Traits;


trait CheckRole
{

    public function approveByUserRole($saveModel, $user)
    {
        $roleName = optional($user->department?->translations()->where('locale', 'en')->first())->name;

        $role = strtolower($roleName ?? '');

        $validRoles = ['ceo', 'hr', 'leader'];

        $finalRole = in_array($role, $validRoles) ? $role : 'leader';

        $this->approveRole($saveModel, $finalRole, $user->id);

        $saveModel->save();
    }


    private function approveRole($model, string $role, int $userId): void
    {
        $model["{$role}_status"] = 'approved';
        $model["{$role}_id"] = $userId;
    }


}
