<?php

namespace App\Http\Requests;

use App\Traits\ValidationErrors;
use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    use ValidationErrors;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'position' => 'nullable|string|max:255',
            'email' => 'nullable|email|unique:users',
            'code' => 'required|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'phone' => 'required|string',
            'gender' => 'nullable|in:male,female,other',
            'age' => 'nullable|integer',
            'birth_date' => 'nullable|date',
            'allowed_vacation_days' => 'nullable|numeric',
            'sallary' => 'nullable|numeric',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date',
            'department_id' => 'required|exists:departments,id',
            'fingerprint_employee_id' => 'required|integer',
        ];
    }
}
