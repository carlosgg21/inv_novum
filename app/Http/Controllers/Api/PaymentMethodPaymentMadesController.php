<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use App\Http\Controllers\Controller;
use App\Http\Resources\PaymentMadeResource;
use App\Http\Resources\PaymentMadeCollection;

class PaymentMethodPaymentMadesController extends Controller
{
    public function index(
        Request $request,
        PaymentMethod $paymentMethod
    ): PaymentMadeCollection {
        $this->authorize('view', $paymentMethod);

        $search = $request->get('search', '');

        $paymentMades = $paymentMethod
            ->paymentMades()
            ->search($search)
            ->latest()
            ->paginate();

        return new PaymentMadeCollection($paymentMades);
    }

    public function store(
        Request $request,
        PaymentMethod $paymentMethod
    ): PaymentMadeResource {
        $this->authorize('create', PaymentMade::class);

        $validated = $request->validate([
            'supplier_id' => ['nullable', 'exists:suppliers,id'],
            'payment_term_id' => ['nullable', 'exists:payment_terms,id'],
            'amount' => ['required', 'numeric'],
            'reference_number' => ['nullable', 'max:255', 'string'],
            'date' => ['required', 'date'],
            'purchase_order_id' => ['nullable', 'exists:purchase_orders,id'],
            'created_by' => ['nullable', 'exists:employees,id'],
            'aproved_by' => ['nullable', 'max:255', 'string'],
        ]);

        $paymentMade = $paymentMethod->paymentMades()->create($validated);

        return new PaymentMadeResource($paymentMade);
    }
}
