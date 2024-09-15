<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerStoreRequest extends FormRequest
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
            'name'              => ['required', 'max:255', 'string'],
            'phone'             => ['required', 'max:255', 'string'],
            'email'             => ['required', 'email'],
            'payment_method_id' => ['required'],
            'payment_term_id'   => ['required'],
            'notes'             => ['nullable', 'string'],
        ];
    }
}
