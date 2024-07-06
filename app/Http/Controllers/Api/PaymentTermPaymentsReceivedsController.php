<?php

namespace App\Http\Controllers\Api;

use App\Models\PaymentTerm;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PaymentsReceivedResource;
use App\Http\Resources\PaymentsReceivedCollection;

class PaymentTermPaymentsReceivedsController extends Controller
{
    public function index(
        Request $request,
        PaymentTerm $paymentTerm
    ): PaymentsReceivedCollection {
        $this->authorize('view', $paymentTerm);

        $search = $request->get('search', '');

        $paymentsReceiveds = $paymentTerm
            ->paymentsReceiveds()
            ->search($search)
            ->latest()
            ->paginate();

        return new PaymentsReceivedCollection($paymentsReceiveds);
    }

    public function store(
        Request $request,
        PaymentTerm $paymentTerm
    ): PaymentsReceivedResource {
        $this->authorize('create', PaymentsReceived::class);

        $validated = $request->validate([
            'amount' => ['required', 'numeric'],
            'payment_method_id' => ['nullable', 'exists:payment_methods,id'],
            'invoice_id' => ['nullable', 'exists:invoices,id'],
            'sales_order_id' => ['nullable', 'exists:sales_orders,id'],
            'date' => ['required', 'date'],
            'notes' => ['nullable', 'max:255', 'string'],
            'customer_id' => ['nullable', 'exists:customers,id'],
            'received_id' => ['nullable', 'exists:employees,id'],
        ]);

        $paymentsReceived = $paymentTerm
            ->paymentsReceiveds()
            ->create($validated);

        return new PaymentsReceivedResource($paymentsReceived);
    }
}
