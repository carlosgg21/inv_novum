<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SalesOrderStoreRequest extends FormRequest
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
            'number' => ['nullable', 'max:255', 'string'],
            'order_date' => ['required', 'date'],
            'customer_id' => ['nullable', 'exists:customers,id'],
            'status' => ['required', 'in:entered,not entered'],
            'prefix' => ['nullable', 'max:255', 'string'],
            'invoice_date' => ['nullable', 'date'],
            'taxes' => ['nullable', 'numeric'],
            'discount' => ['nullable', 'numeric'],
            'miscellanues' => ['nullable', 'numeric'],
            'freight' => ['nullable', 'numeric'],
            'order_total' => ['nullable', 'numeric'],
            'sold_by' => ['nullable', 'exists:employees,id'],
            'payment_method_id' => ['nullable', 'exists:payment_methods,id'],
            'payment_term_id' => ['nullable', 'exists:payment_terms,id'],
            'notes' => ['nullable', 'max:255', 'string'],
            'internal_notes' => ['nullable', 'max:255', 'string'],
            'approved_by' => ['nullable', 'max:255', 'string'],
        ];
    }
}
