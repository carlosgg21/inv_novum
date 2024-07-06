<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PurchaseOrderItemResource;
use App\Http\Resources\PurchaseOrderItemCollection;

class ProductPurchaseOrderItemsController extends Controller
{
    public function index(
        Request $request,
        Product $product
    ): PurchaseOrderItemCollection {
        $this->authorize('view', $product);

        $search = $request->get('search', '');

        $purchaseOrderItems = $product
            ->purchaseOrderItems()
            ->search($search)
            ->latest()
            ->paginate();

        return new PurchaseOrderItemCollection($purchaseOrderItems);
    }

    public function store(
        Request $request,
        Product $product
    ): PurchaseOrderItemResource {
        $this->authorize('create', PurchaseOrderItem::class);

        $validated = $request->validate([
            'quantity' => ['required', 'numeric'],
            'qty_received' => ['nullable', 'numeric'],
            'unit_price' => ['required', 'numeric'],
            'total_price' => ['required', 'numeric'],
            'noted' => ['required', 'max:255', 'string'],
        ]);

        $purchaseOrderItem = $product->purchaseOrderItems()->create($validated);

        return new PurchaseOrderItemResource($purchaseOrderItem);
    }
}
