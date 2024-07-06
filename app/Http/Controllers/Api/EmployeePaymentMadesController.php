<?php

namespace App\Http\Controllers\Api;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PaymentMadeResource;
use App\Http\Resources\PaymentMadeCollection;

class EmployeePaymentMadesController extends Controller
{
    public function index(
        Request $request,
        Employee $employee
    ): PaymentMadeCollection {
        $this->authorize('view', $employee);

        $search = $request->get('search', '');

        $paymentMades = $employee
            ->paymentMades()
            ->search($search)
            ->latest()
            ->paginate();

        return new PaymentMadeCollection($paymentMades);
    }

    public function store(
        Request $request,
        Employee $employee
    ): PaymentMadeResource {
        $this->authorize('create', PaymentMade::class);

        $validated = $request->validate([
            'supplier_id' => ['nullable', 'exists:suppliers,id'],
            'payment_method_id' => ['nullable', 'exists:payment_methods,id'],
            'payment_term_id' => ['nullable', 'exists:payment_terms,id'],
            'amount' => ['required', 'numeric'],
            'reference_number' => ['nullable', 'max:255', 'string'],
            'date' => ['required', 'date'],
            'purchase_order_id' => ['nullable', 'exists:purchase_orders,id'],
            'aproved_by' => ['nullable', 'max:255', 'string'],
        ]);

        $paymentMade = $employee->paymentMades()->create($validated);

        return new PaymentMadeResource($paymentMade);
    }
}
