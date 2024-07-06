<?php

namespace App\Http\Controllers\Api;

use App\Models\Condition;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PurchaseOrderResource;
use App\Http\Resources\PurchaseOrderCollection;

class ConditionPurchaseOrdersController extends Controller
{
    public function index(
        Request $request,
        Condition $condition
    ): PurchaseOrderCollection {
        $this->authorize('view', $condition);

        $search = $request->get('search', '');

        $purchaseOrders = $condition
            ->purchaseOrders()
            ->search($search)
            ->latest()
            ->paginate();

        return new PurchaseOrderCollection($purchaseOrders);
    }

    public function store(
        Request $request,
        Condition $condition
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
            'payment_term_id' => ['nullable', 'exists:payment_terms,id'],
            'billable' => ['required', 'boolean'],
        ]);

        $purchaseOrder = $condition->purchaseOrders()->create($validated);

        return new PurchaseOrderResource($purchaseOrder);
    }
}
