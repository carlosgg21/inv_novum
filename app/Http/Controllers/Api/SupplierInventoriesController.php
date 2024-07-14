<?php

namespace App\Http\Controllers\Api;

use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\InventoryResource;
use App\Http\Resources\InventoryCollection;

class SupplierInventoriesController extends Controller
{
    public function index(
        Request $request,
        Supplier $supplier
    ): InventoryCollection {
        $this->authorize('view', $supplier);

        $search = $request->get('search', '');

        $inventories = $supplier
            ->inventories()
            ->search($search)
            ->latest()
            ->paginate();

        return new InventoryCollection($inventories);
    }

    public function store(
        Request $request,
        Supplier $supplier
    ): InventoryResource {
        $this->authorize('create', Inventory::class);

        $validated = $request->validate([
            'location_id' => ['required', 'exists:locations,id'],
            'quantity' => ['nullable', 'numeric'],
            'quantity_on_order' => ['nullable', 'numeric'],
        ]);

        $inventory = $supplier->inventories()->create($validated);

        return new InventoryResource($inventory);
    }
}
