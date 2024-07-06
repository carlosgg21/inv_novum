<?php

namespace App\Http\Controllers\Api;

use App\Models\SalesOrder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PaymentsReceivedResource;
use App\Http\Resources\PaymentsReceivedCollection;

class SalesOrderPaymentsReceivedsController extends Controller
{
    public function index(
        Request $request,
        SalesOrder $salesOrder
    ): PaymentsReceivedCollection {
        $this->authorize('view', $salesOrder);

        $search = $request->get('search', '');

        $paymentsReceiveds = $salesOrder
            ->paymentsReceiveds()
            ->search($search)
            ->latest()
            ->paginate();

        return new PaymentsReceivedCollection($paymentsReceiveds);
    }

    public function store(
        Request $request,
        SalesOrder $salesOrder
    ): PaymentsReceivedResource {
        $this->authorize('create', PaymentsReceived::class);

        $validated = $request->validate([
            'amount' => ['required', 'numeric'],
            'payment_method_id' => ['nullable', 'exists:payment_methods,id'],
            'payment_term_id' => ['nullable', 'exists:payment_terms,id'],
            'invoice_id' => ['nullable', 'exists:invoices,id'],
            'date' => ['required', 'date'],
            'notes' => ['nullable', 'max:255', 'string'],
            'customer_id' => ['nullable', 'exists:customers,id'],
            'received_id' => ['nullable', 'exists:employees,id'],
        ]);

        $paymentsReceived = $salesOrder
            ->paymentsReceiveds()
            ->create($validated);

        return new PaymentsReceivedResource($paymentsReceived);
    }
}
