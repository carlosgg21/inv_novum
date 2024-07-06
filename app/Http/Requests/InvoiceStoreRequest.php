<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InvoiceStoreRequest extends FormRequest
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
            'sales_order_id' => ['required', 'exists:sales_orders,id'],
            'number' => ['nullable', 'max:255', 'string'],
            'date' => ['required', 'date'],
            'status' => ['required', 'max:255', 'string'],
            'total_amount' => ['nullable', 'numeric'],
            'employee_id' => ['nullable', 'exists:employees,id'],
            'currency_id' => ['required', 'exists:currencies,id'],
            'year' => ['nullable', 'max:255', 'string'],
            'mount' => ['nullable', 'numeric'],
            'notes' => ['nullable', 'max:255', 'string'],
        ];
    }
}
