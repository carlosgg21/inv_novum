<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TownshipUpdateRequest extends FormRequest
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
            'city_id' => ['nullable', 'exists:cities,id'],
            'code' => ['nullable', 'max:255', 'string'],
            'name' => ['required', 'max:255', 'string'],
            'zip_code' => ['nullable', 'max:255', 'string'],
        ];
    }
}
