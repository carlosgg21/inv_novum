<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CityUpdateRequest extends FormRequest
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
            'country_id' => ['required', 'exists:countries,id'],
            'code' => ['nullable', 'max:255', 'string'],
            'name' => ['required', 'max:255', 'string'],
            'acronym' => ['nullable', 'max:255', 'string'],
            'zip_code' => ['nullable', 'max:255', 'string'],
        ];
    }
}
