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
        // قراءة اسم الـ URI الحالي
        $uri = $this->path();

        // تحديد الجدول واسم الحقل حسب وجود الكلمات
        if (str_contains($uri, 'excuse')) {
            $idField = 'excuse_id';
            $table = 'excuses';
        } else {
            $idField = 'vacation_id';
            $table = 'vacations';
        }

        return [
            $idField => "required|exists:{$table},id",
            'status' => 'required|string|in:approved,rejected',
        ];
    }
}
