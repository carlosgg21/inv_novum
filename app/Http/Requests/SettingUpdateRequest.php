<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingUpdateRequest extends FormRequest
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
            'group' => ['nullable', 'max:255', 'string'],
            'name' => ['required', 'max:255', 'string'],
            'value' => ['required', 'max:255', 'string'],
            'manager_by' => ['required', 'numeric'],
            'type' => ['required', 'max:255', 'string'],
            'description' => ['nullable', 'max:255', 'string'],
        ];
    }
}
