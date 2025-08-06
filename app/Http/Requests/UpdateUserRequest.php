<?php

namespace App\Http\Requests;

use App\Helpers\ApiResponseHelper;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    use ApiResponseHelper;

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        $user = $this->route('users');

        return [
            'name' => 'nullable|string|max:255',
            'position' => 'nullable|string|max:255',
            'email' => 'nullable|email|unique:users,email,' . $user->id,
            'code' => 'nullable|unique:users,code,' . $user->id,
            'phone' => 'nullable|string',
            'gender' => 'nullable|in:male,female,other',
            'age' => 'nullable|integer',
            'birth_date' => 'nullable|date',
            'allowed_vacation_days' => 'nullable|numeric',
            'sallary' => 'nullable|numeric',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'department_id' => 'nullable|exists:departments,id',
            'fingerprint_employee_id' => 'nullable|integer',
        ];
    }
}
