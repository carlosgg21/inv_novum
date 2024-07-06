<?php

namespace App\Http\Controllers\Api;

use App\Models\Currency;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\InvoiceResource;
use App\Http\Resources\InvoiceCollection;

class CurrencyInvoicesController extends Controller
{
    public function index(
        Request $request,
        Currency $currency
    ): InvoiceCollection {
        $this->authorize('view', $currency);

        $search = $request->get('search', '');

        $invoices = $currency
            ->invoices()
            ->search($search)
            ->latest()
            ->paginate();

        return new InvoiceCollection($invoices);
    }

    public function store(Request $request, Currency $currency): InvoiceResource
    {
        $this->authorize('create', Invoice::class);

        $validated = $request->validate([
            'sales_order_id' => ['required', 'exists:sales_orders,id'],
            'number' => ['nullable', 'max:255', 'string'],
            'date' => ['required', 'date'],
            'status' => ['required', 'max:255', 'string'],
            'total_amount' => ['nullable', 'numeric'],
            'employee_id' => ['nullable', 'exists:employees,id'],
            'year' => ['nullable', 'max:255', 'string'],
            'mount' => ['nullable', 'numeric'],
            'notes' => ['nullable', 'max:255', 'string'],
        ]);

        $invoice = $currency->invoices()->create($validated);

        return new InvoiceResource($invoice);
    }
}
