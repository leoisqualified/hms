<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEHRRequest extends FormRequest
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
            'diagnosis' => 'sometimes|string|nullable',
            'allergies' => 'sometimes|string|nullable',
            'medications' => 'sometimes|string|nullable',
            'medical_history' => 'sometimes|string|nullable',
            'lab_results' => 'sometimes|json|nullable',
            'radiology_reports' => 'sometimes|json|nullable',
        ];
    }
}
