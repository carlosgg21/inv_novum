<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InventoryUpdateRequest extends FormRequest
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
            'supplier_id'       => ['nullable', 'exists:suppliers,id'],
            'product_id'        => ['nullable', 'exists:products,id'],
            'location_id'       => ['nullable', 'exists:locations,id'],
            'quantity'          => ['nullable', 'numeric'],
            'quantity_on_order' => ['nullable', 'numeric'],
            'batch_number'      => ['nullable', 'max:255', 'string'],
            'expire_date'       => ['nullable', 'date'],
        ];
    }
}
