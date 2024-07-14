<?php

namespace App\Http\Controllers\Api;

use App\Models\Inventory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PurchaseOrderItemResource;
use App\Http\Resources\PurchaseOrderItemCollection;

class InventoryPurchaseOrderItemsController extends Controller
{
    public function index(
        Request $request,
        Inventory $inventory
    ): PurchaseOrderItemCollection {
        $this->authorize('view', $inventory);

        $search = $request->get('search', '');

        $purchaseOrderItems = $inventory
            ->purchaseOrderItems()
            ->search($search)
            ->latest()
            ->paginate();

        return new PurchaseOrderItemCollection($purchaseOrderItems);
    }

    public function store(
        Request $request,
        Inventory $inventory
    ): PurchaseOrderItemResource {
        $this->authorize('create', PurchaseOrderItem::class);

        $validated = $request->validate([
            'quantity' => ['required', 'numeric'],
            'qty_received' => ['nullable', 'numeric'],
            'unit_price' => ['required', 'numeric'],
            'total_price' => ['required', 'numeric'],
            'noted' => ['required', 'max:255', 'string'],
        ]);

        $purchaseOrderItem = $inventory
            ->purchaseOrderItems()
            ->create($validated);

        return new PurchaseOrderItemResource($purchaseOrderItem);
    }
}
