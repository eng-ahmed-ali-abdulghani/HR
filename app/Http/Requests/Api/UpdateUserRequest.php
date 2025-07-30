<?php

namespace App\Http\Requests\Api;

use Illuminate\Validation\Rule;
use App\Traits\ValidationErrors;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

class UpdateUserRequest extends FormRequest
{
    use ValidationErrors;

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'name' => 'nullable|string|max:100',
            'email' => 'nullable|max:100',
            'password' => 'nullable|string',
            'phone' => 'nullable', 'max:12', 'min:11', 'unique:users,phone,except,id',
            'photo' => 'nullable|file|image'
        ];
    }
}
