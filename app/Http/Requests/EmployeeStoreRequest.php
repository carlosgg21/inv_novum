<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeStoreRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'image' => ['nullable', 'image', 'max:1024'],
            'identification' => ['required', 'max:255', 'string'],
            'name' => ['required', 'max:255', 'string'],
            'last_name' => ['required', 'max:255', 'string'],
            'charge_id' => ['nullable', 'exists:charges,id'],
            'phone' => ['nullable', 'max:255', 'string'],
            'email' => ['nullable', 'email'],
            'hiddeng_date' => ['nullable', 'date'],
            'discharge_date' => ['nullable', 'date'],
            'brithday' => ['nullable', 'date'],
            'qr_code' => ['image', 'max:1024', 'nullable'],
            'observation' => ['nullable', 'max:255', 'string'],
        ];
    }
}
