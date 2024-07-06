<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PrefixUpdateRequest extends FormRequest
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
            'name' => ['required', 'max:255', 'string'],
            'display' => ['nullable', 'max:255', 'string'],
            'used_in' => [
                'nullable',
                'in:invoice,sales_order,purchase_order,customer,employee',
            ],
            'star_number' => ['nullable', 'numeric'],
            'description' => ['nullable', 'max:255', 'string'],
        ];
    }
}
