<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BankAccountUpdateRequest extends FormRequest
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
            'number' => ['required', 'max:255', 'string'],
            'bank_id' => ['nullable', 'exists:banks,id'],
            'type' => ['nullable', 'max:255', 'string'],
            'currency_id' => ['nullable', 'exists:currencies,id'],
        ];
    }
}
