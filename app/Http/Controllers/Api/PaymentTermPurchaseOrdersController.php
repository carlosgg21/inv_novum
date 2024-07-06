<?php

namespace App\Http\Controllers\Api;

use App\Models\PaymentTerm;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PurchaseOrderResource;
use App\Http\Resources\PurchaseOrderCollection;

class PaymentTermPurchaseOrdersController extends Controller
{
    public function index(
        Request $request,
        PaymentTerm $paymentTerm
    ): PurchaseOrderCollection {
        $this->authorize('view', $paymentTerm);

        $search = $request->get('search', '');

        $purchaseOrders = $paymentTerm
            ->purchaseOrders()
            ->search($search)
            ->latest()
            ->paginate();

        return new PurchaseOrderCollection($purchaseOrders);
    }

    public function store(
        Request $request,
        PaymentTerm $paymentTerm
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
            'miscellaneus' => ['nullable', 'numeric'],
            'shipping_date' => ['nullable', 'date'],
            'shippin_tracking_number' => ['nullable', 'max:255', 'string'],
            'shipping_cost' => ['nullable', 'numeric'],
            'received_date' => ['nullable', 'date'],
            'payment_method_id' => ['nullable', 'exists:payment_methods,id'],
            'condition_id' => ['required', 'exists:conditions,id'],
            'billable' => ['required', 'boolean'],
        ]);

        $purchaseOrder = $paymentTerm->purchaseOrders()->create($validated);

        return new PurchaseOrderResource($purchaseOrder);
    }
}
