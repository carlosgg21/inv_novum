<?php

namespace App\Http\Controllers\Api;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\InvoiceResource;
use App\Http\Resources\InvoiceCollection;

class EmployeeInvoicesController extends Controller
{
    public function index(
        Request $request,
        Employee $employee
    ): InvoiceCollection {
        $this->authorize('view', $employee);

        $search = $request->get('search', '');

        $invoices = $employee
            ->invoices()
            ->search($search)
            ->latest()
            ->paginate();

        return new InvoiceCollection($invoices);
    }

    public function store(Request $request, Employee $employee): InvoiceResource
    {
        $this->authorize('create', Invoice::class);

        $validated = $request->validate([
            'sales_order_id' => ['required', 'exists:sales_orders,id'],
            'number' => ['nullable', 'max:255', 'string'],
            'date' => ['required', 'date'],
            'status' => ['required', 'max:255', 'string'],
            'total_amount' => ['nullable', 'numeric'],
            'year' => ['nullable', 'max:255', 'string'],
            'currency_id' => ['required', 'exists:currencies,id'],
            'month' => ['nullable', 'numeric'],
            'notes' => ['nullable', 'max:255', 'string'],
            'prefix' => ['nullable', 'max:255', 'string'],
        ]);

        $invoice = $employee->invoices()->create($validated);

        return new InvoiceResource($invoice);
    }
}
