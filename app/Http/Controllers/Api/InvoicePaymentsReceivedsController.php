<?php

namespace App\Http\Controllers\Api;

use App\Models\Invoice;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PaymentsReceivedResource;
use App\Http\Resources\PaymentsReceivedCollection;

class InvoicePaymentsReceivedsController extends Controller
{
    public function index(
        Request $request,
        Invoice $invoice
    ): PaymentsReceivedCollection {
        $this->authorize('view', $invoice);

        $search = $request->get('search', '');

        $paymentsReceiveds = $invoice
            ->paymentsReceiveds()
            ->search($search)
            ->latest()
            ->paginate();

        return new PaymentsReceivedCollection($paymentsReceiveds);
    }

    public function store(
        Request $request,
        Invoice $invoice
    ): PaymentsReceivedResource {
        $this->authorize('create', PaymentsReceived::class);

        $validated = $request->validate([
            'amount' => ['required', 'numeric'],
            'payment_method_id' => ['nullable', 'exists:payment_methods,id'],
            'payment_term_id' => ['nullable', 'exists:payment_terms,id'],
            'sales_order_id' => ['nullable', 'exists:sales_orders,id'],
            'date' => ['required', 'date'],
            'notes' => ['nullable', 'max:255', 'string'],
            'customer_id' => ['nullable', 'exists:customers,id'],
            'received_id' => ['nullable', 'exists:employees,id'],
        ]);

        $paymentsReceived = $invoice->paymentsReceiveds()->create($validated);

        return new PaymentsReceivedResource($paymentsReceived);
    }
}
