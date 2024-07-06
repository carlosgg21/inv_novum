<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\PurchaseOrder;
use App\Http\Controllers\Controller;
use App\Http\Resources\PurchaseOrderItemResource;
use App\Http\Resources\PurchaseOrderItemCollection;

class PurchaseOrderPurchaseOrderItemsController extends Controller
{
    public function index(
        Request $request,
        PurchaseOrder $purchaseOrder
    ): PurchaseOrderItemCollection {
        $this->authorize('view', $purchaseOrder);

        $search = $request->get('search', '');

        $purchaseOrderItems = $purchaseOrder
            ->purchaseOrderItems()
            ->search($search)
            ->latest()
            ->paginate();

        return new PurchaseOrderItemCollection($purchaseOrderItems);
    }

    public function store(
        Request $request,
        PurchaseOrder $purchaseOrder
    ): PurchaseOrderItemResource {
        $this->authorize('create', PurchaseOrderItem::class);

        $validated = $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'quantity' => ['required', 'numeric'],
            'qty_received' => ['nullable', 'numeric'],
            'unit_price' => ['required', 'numeric'],
            'total_price' => ['required', 'numeric'],
            'noted' => ['required', 'max:255', 'string'],
        ]);

        $purchaseOrderItem = $purchaseOrder
            ->purchaseOrderItems()
            ->create($validated);

        return new PurchaseOrderItemResource($purchaseOrderItem);
    }
}
