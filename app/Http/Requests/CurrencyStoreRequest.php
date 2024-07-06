<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CurrencyStoreRequest extends FormRequest
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
            'acronym' => ['nullable', 'max:255', 'string'],
            'name' => ['required', 'max:255', 'string'],
            'sign' => ['nullable', 'max:255', 'string'],
            'code' => ['nullable', 'max:255', 'string'],
            'flag' => ['nullable', 'max:255', 'string'],
        ];
    }
}
