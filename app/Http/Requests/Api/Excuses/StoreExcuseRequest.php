<?php

namespace App\Http\Requests\Api\Excuses;

use App\Traits\ValidationErrors;
use Illuminate\Foundation\Http\FormRequest;

class StoreExcuseRequest extends FormRequest
{
    use ValidationErrors;

    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'type_id' => 'required|exists:types,id',
            'reason' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
            'leader_approval_status' => 'boolean',
        ];
    }
}
