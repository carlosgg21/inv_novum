<?php

namespace App\Http\Controllers\Api;

use App\Models\Inventory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\InventoryResource;
use App\Http\Resources\InventoryCollection;
use App\Http\Requests\InventoryStoreRequest;
use App\Http\Requests\InventoryUpdateRequest;

class InventoryController extends Controller
{
    public function index(Request $request): InventoryCollection
    {
        $this->authorize('view-any', Inventory::class);

        $search = $request->get('search', '');

        $inventories = Inventory::search($search)
            ->latest()
            ->paginate();

        return new InventoryCollection($inventories);
    }

    public function store(InventoryStoreRequest $request): InventoryResource
    {
        $this->authorize('create', Inventory::class);

        $validated = $request->validated();

        $inventory = Inventory::create($validated);

        return new InventoryResource($inventory);
    }

    public function show(
        Request $request,
        Inventory $inventory
    ): InventoryResource {
        $this->authorize('view', $inventory);

        return new InventoryResource($inventory);
    }

    public function update(
        InventoryUpdateRequest $request,
        Inventory $inventory
    ): InventoryResource {
        $this->authorize('update', $inventory);

        $validated = $request->validated();

        $inventory->update($validated);

        return new InventoryResource($inventory);
    }

    public function destroy(Request $request, Inventory $inventory): Response
    {
        $this->authorize('delete', $inventory);

        $inventory->delete();

        return response()->noContent();
    }
}
