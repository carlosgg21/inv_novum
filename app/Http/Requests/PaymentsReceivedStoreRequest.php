<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentsReceivedStoreRequest extends FormRequest
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
            'amount' => ['required', 'numeric'],
            'payment_method_id' => ['nullable', 'exists:payment_methods,id'],
            'payment_term_id' => ['nullable', 'exists:payment_terms,id'],
            'invoice_id' => ['nullable', 'exists:invoices,id'],
            'sales_order_id' => ['nullable', 'exists:sales_orders,id'],
            'date' => ['required', 'date'],
            'notes' => ['nullable', 'max:255', 'string'],
            'customer_id' => ['nullable', 'exists:customers,id'],
            'received_id' => ['nullable', 'exists:employees,id'],
        ];
    }
}
