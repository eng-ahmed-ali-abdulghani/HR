<?php

namespace App\Http\Requests;

use App\Traits\ValidationErrors;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    use ValidationErrors;

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'phone' => 'required|string|exists:users,phone',
            'password' => 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
            'phone.required' => 'رقم الجوال مطلوب.',
            'phone.exists' => 'رقم الجوال غير مسجل لدينا.',
            'phone.string' => 'رقم الجوال يجب أن يكون نصًا.',

            'password.required' => 'كلمة المرور مطلوبة.',
            'password.string' => 'كلمة المرور يجب أن تكون نصًا.',
        ];
    }
}
