<?php

namespace App\Http\Controllers\Api;

use App\Models\SalesOrder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\SalesOrderItemResource;
use App\Http\Resources\SalesOrderItemCollection;

class SalesOrderSalesOrderItemsController extends Controller
{
    public function index(
        Request $request,
        SalesOrder $salesOrder
    ): SalesOrderItemCollection {
        $this->authorize('view', $salesOrder);

        $search = $request->get('search', '');

        $salesOrderItems = $salesOrder
            ->salesOrderItems()
            ->search($search)
            ->latest()
            ->paginate();

        return new SalesOrderItemCollection($salesOrderItems);
    }

    public function store(
        Request $request,
        SalesOrder $salesOrder
    ): SalesOrderItemResource {
        $this->authorize('create', SalesOrderItem::class);

        $validated = $request->validate([
            'quantity' => ['required', 'numeric'],
            'unit_price' => ['required', 'numeric'],
            'total_price' => ['required', 'numeric'],
            'notes' => ['nullable', 'max:255', 'string'],
            'product_id' => ['required', 'exists:products,id'],
        ]);

        $salesOrderItem = $salesOrder->salesOrderItems()->create($validated);

        return new SalesOrderItemResource($salesOrderItem);
    }
}
