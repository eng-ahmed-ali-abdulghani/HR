<?php

namespace App\Http\Requests;

use App\Traits\ValidationErrors;
use Illuminate\Foundation\Http\FormRequest;

class GetTypeRequest extends FormRequest
{
    use ValidationErrors;

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'type' => 'nullable|in:vacation,excuse,deductions',
        ];
    }
}
