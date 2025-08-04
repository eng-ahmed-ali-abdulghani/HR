<?php

namespace App\Http\Requests\Api\Excuses;

use App\Traits\ValidationErrors;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreExcuseRequest extends FormRequest
{
    use ValidationErrors;

    public function authorize(): bool
    {
        $user = Auth::user();

        // الموظف اللي داخل الطلب
        $requestedEmployeeId = $this->input('employee_id');

        // لو هو نفسه الموظف اللي بيطلب
        if ($user->id === $requestedEmployeeId) {
            return true;
        }

        // لو عنده صلاحيات HR أو CEO مثلاً
        $roleName = optional($user->department?->translations()->where('locale', 'en')->first())->name;
        $role = strtolower($roleName);

        $allowedRoles = ['hr', 'ceo'];

        return in_array($role, $allowedRoles);
    }

    public function rules(): array
    {
        return [
            'employee_id' => 'required|exists:users,id',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
            'type_id' => 'required|exists:types,id',
            'reason' => 'nullable|string',
            'replacement_employee_id' => 'required|exists:users,id|different:employee_id',
            'notes' => 'nullable|string',
        ];
    }

    public function failedAuthorization()
    {
        abort(403, __('messages.unauthorized_action'));
    }
}
