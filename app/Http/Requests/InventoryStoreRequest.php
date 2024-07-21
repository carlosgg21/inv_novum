<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InventoryStoreRequest extends FormRequest
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
            'product_id'               => ['required', 'exists:products,id'],
            'quantity'                 => ['nullable', 'numeric'],
            'cost_price'               => ['required', 'numeric'],
            'sell_price'               => ['required', 'numeric'],
            'quantity_on_order'        => ['nullable', 'numeric'],
            'supplier_id'              => ['nullable', 'exists:suppliers,id'],
            'location_id'              => ['nullable', 'exists:locations,id'],
            'batch_number'             => ['nullable', 'max:255', 'string'],
            'expire_date'              => ['nullable', 'date'],
            'shipping_cost'            => ['nullable', 'numeric'],
            'shipping_tracking_number' => ['nullable', 'max:255', 'string'],
            'received_date'            => ['nullable', 'date'],
            'billable'                 => ['nullable'],
            'payment_method_id'        => ['nullable', 'exists:payment_methods,id'],
            'payment_term_id'          => ['nullable', 'exists:payment_terms,id'],
            'notes'                    => ['nullable', 'max:500'],
        ];
    }
}
