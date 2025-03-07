<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStaffScheduleRequest extends FormRequest
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
            'user_id' => 'required|exists:users,id',
            'shift_start' => 'required|date_format:Y-m-d H:i:s|after_or_equal:now',
            'shift_end' => 'required|date_format:Y-m-d H:i:s|after:shift_start',
        ];
    }
}
