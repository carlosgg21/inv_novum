<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
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
            'image' => ['nullable', 'image', 'max:1024'],
            'brand_id' => ['nullable', 'exists:brands,id'],
            'category_id' => ['nullable', 'exists:categories,id'],
            'code' => ['nullable', 'max:255', 'string'],
            'supplier_id' => ['nullable', 'exists:suppliers,id'],
            'name' => ['required', 'max:255', 'string'],
            'description' => ['nullable', 'max:255', 'string'],
            'unit' => ['nullable', 'max:255', 'string'],
            'unit_price' => ['required', 'numeric'],
            'cost_price' => ['nullable', 'numeric'],
            'size' => ['nullable', 'max:255', 'string'],
            'notes' => ['nullable', 'max:255', 'string'],
            'qty_stock' => ['nullable', 'numeric'],
            'qty_on_order' => ['nullable', 'numeric'],
        ];
    }
}
