<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePatientRequest extends FormRequest
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
            'user_id' => 'required|exits:users, id',
            'date_of_birth' => 'required|date',
            'gender' => 'required|in: male, female, other',
            'blood_type' => 'nullable|string',
            'emergency_contacts' => 'nullable|string',
            'insurance_id' => 'nullable|string|unique:patients, insurance_id',
            'address' => 'nullable|string'
        ];
    }
}
