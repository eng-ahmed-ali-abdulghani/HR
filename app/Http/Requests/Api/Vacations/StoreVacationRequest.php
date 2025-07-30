<?php

namespace App\Http\Requests\Api\Vacations;

use App\Traits\ValidationErrors;
use Illuminate\Foundation\Http\FormRequest;

class StoreVacationRequest extends FormRequest
{
    use ValidationErrors;

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
            'type_id' => 'required|exists:types,id',
            'reason' => 'nullable|string',
            'replacement_employee_id' => 'required|exists:users,id|different:employee_id',
            'notes' => 'nullable|string',
        ];

    }
}
