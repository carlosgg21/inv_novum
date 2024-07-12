<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddressUpdateRequest extends FormRequest
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
            'address' => ['required', 'max:255', 'string'],
            'zip_code' => ['nullable', 'max:255', 'string'],
            'country_id' => ['nullable', 'exists:countries,id'],
            'addressable_id' => ['required', 'max:255'],
            'city_id' => ['nullable', 'exists:cities,id'],
            'addressable_type' => ['required', 'max:255', 'string'],
            'township_id' => ['nullable', 'exists:townships,id'],
            'zip_code' => ['nullable', 'max:255', 'string'],
            'default' => ['nullable', 'boolean'],
        ];
    }
}
