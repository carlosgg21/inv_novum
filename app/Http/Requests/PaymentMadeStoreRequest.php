<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentMadeStoreRequest extends FormRequest
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
            'supplier_id' => ['nullable', 'exists:suppliers,id'],
            'payment_method_id' => ['nullable', 'exists:payment_methods,id'],
            'payment_term_id' => ['nullable', 'exists:payment_terms,id'],
            'amount' => ['required', 'numeric'],
            'reference_number' => ['nullable', 'max:255', 'string'],
            'date' => ['required', 'date'],
            'purchase_order_id' => ['nullable', 'exists:purchase_orders,id'],
            'created_by' => ['nullable', 'exists:employees,id'],
            'aproved_by' => ['nullable', 'max:255', 'string'],
        ];
    }
}
