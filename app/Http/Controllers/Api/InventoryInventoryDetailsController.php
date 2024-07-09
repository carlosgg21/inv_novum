<?php

namespace App\Http\Controllers\Api;

use App\Models\Inventory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\InventoryDetailResource;
use App\Http\Resources\InventoryDetailCollection;

class InventoryInventoryDetailsController extends Controller
{
    public function index(
        Request $request,
        Inventory $inventory
    ): InventoryDetailCollection {
        $this->authorize('view', $inventory);

        $search = $request->get('search', '');

        $inventoryDetails = $inventory
            ->inventoryDetails()
            ->search($search)
            ->latest()
            ->paginate();

        return new InventoryDetailCollection($inventoryDetails);
    }

    public function store(
        Request $request,
        Inventory $inventory
    ): InventoryDetailResource {
        $this->authorize('create', InventoryDetail::class);

        $validated = $request->validate([
            'batch_number' => ['nullable', 'max:255', 'string'],
            'expire_date' => ['nullable', 'date'],
            'unit_cost' => ['nullable', 'numeric'],
        ]);

        $inventoryDetail = $inventory->inventoryDetails()->create($validated);

        return new InventoryDetailResource($inventoryDetail);
    }
}
