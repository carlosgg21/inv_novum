<?php

namespace App\Http\Controllers\Api;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PaymentsReceivedResource;
use App\Http\Resources\PaymentsReceivedCollection;

class CustomerPaymentsReceivedsController extends Controller
{
    public function index(
        Request $request,
        Customer $customer
    ): PaymentsReceivedCollection {
        $this->authorize('view', $customer);

        $search = $request->get('search', '');

        $paymentsReceiveds = $customer
            ->paymentsReceiveds()
            ->search($search)
            ->latest()
            ->paginate();

        return new PaymentsReceivedCollection($paymentsReceiveds);
    }

    public function store(
        Request $request,
        Customer $customer
    ): PaymentsReceivedResource {
        $this->authorize('create', PaymentsReceived::class);

        $validated = $request->validate([
            'amount' => ['required', 'numeric'],
            'payment_method_id' => ['nullable', 'exists:payment_methods,id'],
            'payment_term_id' => ['nullable', 'exists:payment_terms,id'],
            'invoice_id' => ['nullable', 'exists:invoices,id'],
            'sales_order_id' => ['nullable', 'exists:sales_orders,id'],
            'date' => ['required', 'date'],
            'notes' => ['nullable', 'max:255', 'string'],
            'received_id' => ['nullable', 'exists:employees,id'],
        ]);

        $paymentsReceived = $customer->paymentsReceiveds()->create($validated);

        return new PaymentsReceivedResource($paymentsReceived);
    }
}
