<?php

namespace App\Http\Requests\Api\Excuses;

use App\Traits\ValidationErrors;
use Illuminate\Foundation\Http\FormRequest;

class StoreExcuseRequest extends FormRequest
{
    use ValidationErrors;
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'date' => 'required|date|date_format:Y-m-d',
            'note' =>'nullable|string|max:255',
            'type_id' =>'required|exists:types,id',
            'reason_id' =>'required|exists:reasons,id',
            'user_id' =>'required|exists:users,id',
        ];
    }
}
