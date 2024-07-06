<?php

namespace App\Http\Controllers\Api;

use App\Models\PaymentTerm;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PaymentMadeResource;
use App\Http\Resources\PaymentMadeCollection;

class PaymentTermPaymentMadesController extends Controller
{
    public function index(
        Request $request,
        PaymentTerm $paymentTerm
    ): PaymentMadeCollection {
        $this->authorize('view', $paymentTerm);

        $search = $request->get('search', '');

        $paymentMades = $paymentTerm
            ->paymentMades()
            ->search($search)
            ->latest()
            ->paginate();

        return new PaymentMadeCollection($paymentMades);
    }

    public function store(
        Request $request,
        PaymentTerm $paymentTerm
    ): PaymentMadeResource {
        $this->authorize('create', PaymentMade::class);

        $validated = $request->validate([
            'supplier_id' => ['nullable', 'exists:suppliers,id'],
            'payment_method_id' => ['nullable', 'exists:payment_methods,id'],
            'amount' => ['required', 'numeric'],
            'reference_number' => ['nullable', 'max:255', 'string'],
            'date' => ['required', 'date'],
            'purchase_order_id' => ['nullable', 'exists:purchase_orders,id'],
            'created_by' => ['nullable', 'exists:employees,id'],
            'aproved_by' => ['nullable', 'max:255', 'string'],
        ]);

        $paymentMade = $paymentTerm->paymentMades()->create($validated);

        return new PaymentMadeResource($paymentMade);
    }
}
