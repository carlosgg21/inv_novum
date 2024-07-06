<?php

namespace App\Http\Controllers\Api;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PaymentsReceivedResource;
use App\Http\Resources\PaymentsReceivedCollection;

class EmployeePaymentsReceivedsController extends Controller
{
    public function index(
        Request $request,
        Employee $employee
    ): PaymentsReceivedCollection {
        $this->authorize('view', $employee);

        $search = $request->get('search', '');

        $paymentsReceiveds = $employee
            ->paymentsReceiveds()
            ->search($search)
            ->latest()
            ->paginate();

        return new PaymentsReceivedCollection($paymentsReceiveds);
    }

    public function store(
        Request $request,
        Employee $employee
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
            'customer_id' => ['nullable', 'exists:customers,id'],
        ]);

        $paymentsReceived = $employee->paymentsReceiveds()->create($validated);

        return new PaymentsReceivedResource($paymentsReceived);
    }
}
