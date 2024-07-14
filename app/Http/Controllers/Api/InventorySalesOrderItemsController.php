<?php

namespace App\Http\Controllers\Api;

use App\Models\Inventory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\SalesOrderItemResource;
use App\Http\Resources\SalesOrderItemCollection;

class InventorySalesOrderItemsController extends Controller
{
    public function index(
        Request $request,
        Inventory $inventory
    ): SalesOrderItemCollection {
        $this->authorize('view', $inventory);

        $search = $request->get('search', '');

        $salesOrderItems = $inventory
            ->salesOrderItems()
            ->search($search)
            ->latest()
            ->paginate();

        return new SalesOrderItemCollection($salesOrderItems);
    }

    public function store(
        Request $request,
        Inventory $inventory
    ): SalesOrderItemResource {
        $this->authorize('create', SalesOrderItem::class);

        $validated = $request->validate([
            'quantity' => ['required', 'numeric'],
            'unit_price' => ['required', 'numeric'],
            'total_price' => ['required', 'numeric'],
            'notes' => ['nullable', 'max:255', 'string'],
        ]);

        $salesOrderItem = $inventory->salesOrderItems()->create($validated);

        return new SalesOrderItemResource($salesOrderItem);
    }
}
