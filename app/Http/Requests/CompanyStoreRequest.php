<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyStoreRequest extends FormRequest
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
            'logo' => ['image', 'max:1024', 'nullable'],
            'code' => ['nullable', 'max:255', 'string'],
            'name' => ['required', 'max:255', 'string'],
            'acronym' => ['nullable', 'max:255', 'string'],
            'slogan' => ['nullable', 'max:255', 'string'],
            'phone' => ['nullable', 'max:255', 'string'],
            'email' => ['nullable', 'email'],
            'web_site' => ['nullable', 'max:255', 'string'],
            'social_media' => ['nullable', 'max:255', 'json'],
            'address' => ['nullable', 'max:255', 'string'],
            'qr_code' => ['image', 'max:1024', 'nullable'],
        ];
    }
}
