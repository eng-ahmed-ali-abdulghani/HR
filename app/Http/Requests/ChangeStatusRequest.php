<?php

namespace App\Http\Requests;

use App\Traits\ValidationErrors;
use Illuminate\Foundation\Http\FormRequest;

class ChangeStatusRequest extends FormRequest
{
    use ValidationErrors;

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'status' => 'required|string|in:approved,rejected',
        ];
    }
}
