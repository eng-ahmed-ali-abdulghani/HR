<?php

namespace App\Http\Requests;

use App\Traits\ValidationErrors;
use Illuminate\Foundation\Http\FormRequest;

class DeductionRequest extends FormRequest
{
    use ValidationErrors;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'deduction_days' => ['required', 'numeric', 'between:0.01,99.99'],
            'employee_id' => ['required', 'exists:users,id'],
            'type_id' => ['required', 'exists:types,id'],
            'reason' => ['required', 'string', 'max:255'],
            'notes' => ['nullable', 'string', 'max:255']
        ];
    }
}
