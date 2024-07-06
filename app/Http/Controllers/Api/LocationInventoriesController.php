<?php

namespace App\Http\Controllers\Api;

use App\Models\Location;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\InventoryResource;
use App\Http\Resources\InventoryCollection;

class LocationInventoriesController extends Controller
{
    public function index(
        Request $request,
        Location $location
    ): InventoryCollection {
        $this->authorize('view', $location);

        $search = $request->get('search', '');

        $inventories = $location
            ->inventories()
            ->search($search)
            ->latest()
            ->paginate();

        return new InventoryCollection($inventories);
    }

    public function store(
        Request $request,
        Location $location
    ): InventoryResource {
        $this->authorize('create', Inventory::class);

        $validated = $request->validate([
            'quantity_stock' => ['nullable', 'numeric'],
            'quantity_on_order' => ['nullable', 'numeric'],
            'min_qty' => ['nullable', 'numeric'],
            'max_qty' => ['nullable', 'numeric'],
        ]);

        $inventory = $location->inventories()->create($validated);

        return new InventoryResource($inventory);
    }
}
