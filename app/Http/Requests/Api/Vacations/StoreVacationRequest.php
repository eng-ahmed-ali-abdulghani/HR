<?php

namespace App\Http\Requests\Api\Vacations;

use Illuminate\Foundation\Http\FormRequest;

class StoreVacationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'date' => 'required|date|date_format:Y-m-d',
            'note' =>'nullable|string|max:255',
            'day' =>'required',
            'type_id' =>'required|exists:types,id',
            'reason_id' =>'required|exists:reasons,id',
            'user_id' =>'required|exists:users,id',
        ];
    }
}
