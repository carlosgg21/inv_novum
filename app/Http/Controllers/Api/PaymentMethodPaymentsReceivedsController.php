<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use App\Http\Controllers\Controller;
use App\Http\Resources\PaymentsReceivedResource;
use App\Http\Resources\PaymentsReceivedCollection;

class PaymentMethodPaymentsReceivedsController extends Controller
{
    public function index(
        Request $request,
        PaymentMethod $paymentMethod
    ): PaymentsReceivedCollection {
        $this->authorize('view', $paymentMethod);

        $search = $request->get('search', '');

        $paymentsReceiveds = $paymentMethod
            ->paymentsReceiveds()
            ->search($search)
            ->latest()
            ->paginate();

        return new PaymentsReceivedCollection($paymentsReceiveds);
    }

    public function store(
        Request $request,
        PaymentMethod $paymentMethod
    ): PaymentsReceivedResource {
        $this->authorize('create', PaymentsReceived::class);

        $validated = $request->validate([
            'amount' => ['required', 'numeric'],
            'payment_term_id' => ['nullable', 'exists:payment_terms,id'],
            'invoice_id' => ['nullable', 'exists:invoices,id'],
            'sales_order_id' => ['nullable', 'exists:sales_orders,id'],
            'date' => ['required', 'date'],
            'notes' => ['nullable', 'max:255', 'string'],
            'customer_id' => ['nullable', 'exists:customers,id'],
            'received_id' => ['nullable', 'exists:employees,id'],
        ]);

        $paymentsReceived = $paymentMethod
            ->paymentsReceiveds()
            ->create($validated);

        return new PaymentsReceivedResource($paymentsReceived);
    }
}
