<?php

namespace App\Http\Controllers\Api;

use App\Models\SalesOrder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\InvoiceResource;
use App\Http\Resources\InvoiceCollection;

class SalesOrderInvoicesController extends Controller
{
    public function index(
        Request $request,
        SalesOrder $salesOrder
    ): InvoiceCollection {
        $this->authorize('view', $salesOrder);

        $search = $request->get('search', '');

        $invoices = $salesOrder
            ->invoices()
            ->search($search)
            ->latest()
            ->paginate();

        return new InvoiceCollection($invoices);
    }

    public function store(
        Request $request,
        SalesOrder $salesOrder
    ): InvoiceResource {
        $this->authorize('create', Invoice::class);

        $validated = $request->validate([
            'number' => ['nullable', 'max:255', 'string'],
            'date' => ['required', 'date'],
            'status' => ['required', 'max:255', 'string'],
            'total_amount' => ['nullable', 'numeric'],
            'employee_id' => ['nullable', 'exists:employees,id'],
            'year' => ['nullable', 'max:255', 'string'],
            'currency_id' => ['required', 'exists:currencies,id'],
            'month' => ['nullable', 'numeric'],
            'notes' => ['nullable', 'max:255', 'string'],
            'prefix' => ['nullable', 'max:255', 'string'],
        ]);

        $invoice = $salesOrder->invoices()->create($validated);

        return new InvoiceResource($invoice);
    }
}
