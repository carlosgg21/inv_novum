<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PurchaseOrderUpdateRequest extends FormRequest
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
            'supplier_id' => ['required', 'exists:suppliers,id'],
            'number' => ['nullable', 'max:255', 'string'],
            'order_date' => ['required', 'date'],
            'total_amount' => ['required', 'numeric'],
            'status' => ['required', 'in:entered,not entered'],
            'taxes' => ['nullable', 'numeric'],
            'discount' => ['nullable', 'numeric'],
            'miscellaneous' => ['nullable', 'numeric'],
            'shipping_date' => ['nullable', 'date'],
            'shippin_tracking_number' => ['nullable', 'max:255', 'string'],
            'shipping_cost' => ['nullable', 'numeric'],
            'received_date' => ['nullable', 'date'],
            'payment_method_id' => ['nullable', 'exists:payment_methods,id'],
            'payment_term_id' => ['nullable', 'exists:payment_terms,id'],
            'condition_id' => ['required', 'exists:conditions,id'],
            'billable' => ['required', 'boolean'],
        ];
    }
}
