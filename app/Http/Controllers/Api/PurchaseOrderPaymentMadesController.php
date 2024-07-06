<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\PurchaseOrder;
use App\Http\Controllers\Controller;
use App\Http\Resources\PaymentMadeResource;
use App\Http\Resources\PaymentMadeCollection;

class PurchaseOrderPaymentMadesController extends Controller
{
    public function index(
        Request $request,
        PurchaseOrder $purchaseOrder
    ): PaymentMadeCollection {
        $this->authorize('view', $purchaseOrder);

        $search = $request->get('search', '');

        $paymentMades = $purchaseOrder
            ->paymentMades()
            ->search($search)
            ->latest()
            ->paginate();

        return new PaymentMadeCollection($paymentMades);
    }

    public function store(
        Request $request,
        PurchaseOrder $purchaseOrder
    ): PaymentMadeResource {
        $this->authorize('create', PaymentMade::class);

        $validated = $request->validate([
            'supplier_id' => ['nullable', 'exists:suppliers,id'],
            'payment_method_id' => ['nullable', 'exists:payment_methods,id'],
            'payment_term_id' => ['nullable', 'exists:payment_terms,id'],
            'amount' => ['required', 'numeric'],
            'reference_number' => ['nullable', 'max:255', 'string'],
            'date' => ['required', 'date'],
            'created_by' => ['nullable', 'exists:employees,id'],
            'aproved_by' => ['nullable', 'max:255', 'string'],
        ]);

        $paymentMade = $purchaseOrder->paymentMades()->create($validated);

        return new PaymentMadeResource($paymentMade);
    }
}
