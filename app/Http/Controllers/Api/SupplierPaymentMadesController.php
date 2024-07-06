<?php

namespace App\Http\Controllers\Api;

use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PaymentMadeResource;
use App\Http\Resources\PaymentMadeCollection;

class SupplierPaymentMadesController extends Controller
{
    public function index(
        Request $request,
        Supplier $supplier
    ): PaymentMadeCollection {
        $this->authorize('view', $supplier);

        $search = $request->get('search', '');

        $paymentMades = $supplier
            ->paymentMades()
            ->search($search)
            ->latest()
            ->paginate();

        return new PaymentMadeCollection($paymentMades);
    }

    public function store(
        Request $request,
        Supplier $supplier
    ): PaymentMadeResource {
        $this->authorize('create', PaymentMade::class);

        $validated = $request->validate([
            'payment_method_id' => ['nullable', 'exists:payment_methods,id'],
            'payment_term_id' => ['nullable', 'exists:payment_terms,id'],
            'amount' => ['required', 'numeric'],
            'reference_number' => ['nullable', 'max:255', 'string'],
            'date' => ['required', 'date'],
            'purchase_order_id' => ['nullable', 'exists:purchase_orders,id'],
            'created_by' => ['nullable', 'exists:employees,id'],
            'aproved_by' => ['nullable', 'max:255', 'string'],
        ]);

        $paymentMade = $supplier->paymentMades()->create($validated);

        return new PaymentMadeResource($paymentMade);
    }
}
