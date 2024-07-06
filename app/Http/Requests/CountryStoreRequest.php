<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CountryStoreRequest extends FormRequest
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
            'code' => ['required', 'max:255', 'string'],
            'name' => ['required', 'max:255', 'string'],
            'iso' => ['nullable', 'max:255', 'string'],
            'time_zone' => ['nullable', 'max:255', 'string'],
            'flag' => ['nullable', 'max:255', 'string'],
            'currency_id' => ['nullable', 'exists:currencies,id'],
        ];
    }
}
