<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use App\Http\Controllers\Controller;
use App\Http\Resources\PurchaseOrderResource;
use App\Http\Resources\PurchaseOrderCollection;

class PaymentMethodPurchaseOrdersController extends Controller
{
    public function index(
        Request $request,
        PaymentMethod $paymentMethod
    ): PurchaseOrderCollection {
        $this->authorize('view', $paymentMethod);

        $search = $request->get('search', '');

        $purchaseOrders = $paymentMethod
            ->purchaseOrders()
            ->search($search)
            ->latest()
            ->paginate();

        return new PurchaseOrderCollection($purchaseOrders);
    }

    public function store(
        Request $request,
        PaymentMethod $paymentMethod
    ): PurchaseOrderResource {
        $this->authorize('create', PurchaseOrder::class);

        $validated = $request->validate([
            'supplier_id' => ['required', 'exists:suppliers,id'],
            'number' => ['nullable', 'max:255', 'string'],
            'order_date' => ['required', 'date'],
            'total_amount' => ['required', 'numeric'],
            'status' => ['required', 'in:entered,not entered'],
            'taxes' => ['nullable', 'numeric'],
            'discount' => ['nullable', 'numeric'],
            'miscellaneous' => ['nullable', 'numeric'],
            'shipping_date' => ['nullable', 'date'],
            'shippin_tracking_number' => ['nullable', 'max:255', 'string'],
            'shipping_cost' => ['nullable', 'numeric'],
            'received_date' => ['nullable', 'date'],
            'payment_term_id' => ['nullable', 'exists:payment_terms,id'],
            'condition_id' => ['required', 'exists:conditions,id'],
            'billable' => ['required', 'boolean'],
        ]);

        $purchaseOrder = $paymentMethod->purchaseOrders()->create($validated);

        return new PurchaseOrderResource($purchaseOrder);
    }
}
