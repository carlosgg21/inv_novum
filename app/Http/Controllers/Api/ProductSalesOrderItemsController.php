<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\SalesOrderItemResource;
use App\Http\Resources\SalesOrderItemCollection;

class ProductSalesOrderItemsController extends Controller
{
    public function index(
        Request $request,
        Product $product
    ): SalesOrderItemCollection {
        $this->authorize('view', $product);

        $search = $request->get('search', '');

        $salesOrderItems = $product
            ->salesOrderItems()
            ->search($search)
            ->latest()
            ->paginate();

        return new SalesOrderItemCollection($salesOrderItems);
    }

    public function store(
        Request $request,
        Product $product
    ): SalesOrderItemResource {
        $this->authorize('create', SalesOrderItem::class);

        $validated = $request->validate([
            'quantity' => ['required', 'numeric'],
            'unit_price' => ['required', 'numeric'],
            'total_price' => ['required', 'numeric'],
            'notes' => ['nullable', 'max:255', 'string'],
        ]);

        $salesOrderItem = $product->salesOrderItems()->create($validated);

        return new SalesOrderItemResource($salesOrderItem);
    }
}
