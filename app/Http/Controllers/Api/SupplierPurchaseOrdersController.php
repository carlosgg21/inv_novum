<?php

namespace App\Http\Controllers\Api;

use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PurchaseOrderResource;
use App\Http\Resources\PurchaseOrderCollection;

class SupplierPurchaseOrdersController extends Controller
{
    public function index(
        Request $request,
        Supplier $supplier
    ): PurchaseOrderCollection {
        $this->authorize('view', $supplier);

        $search = $request->get('search', '');

        $purchaseOrders = $supplier
            ->purchaseOrders()
            ->search($search)
            ->latest()
            ->paginate();

        return new PurchaseOrderCollection($purchaseOrders);
    }

    public function store(
        Request $request,
        Supplier $supplier
    ): PurchaseOrderResource {
        $this->authorize('create', PurchaseOrder::class);

        $validated = $request->validate([
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
            'payment_method_id' => ['nullable', 'exists:payment_methods,id'],
            'payment_term_id' => ['nullable', 'exists:payment_terms,id'],
            'condition_id' => ['required', 'exists:conditions,id'],
            'billable' => ['required', 'boolean'],
        ]);

        $purchaseOrder = $supplier->purchaseOrders()->create($validated);

        return new PurchaseOrderResource($purchaseOrder);
    }
}
