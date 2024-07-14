<?php

namespace App\Http\Controllers;

use App\Http\Requests\InventoryStoreRequest;
use App\Http\Requests\InventoryUpdateRequest;
use App\Models\Inventory;
use App\Models\Location;
use App\Models\Product;
use App\Models\Supplier;
use App\Repositories\InventoryRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class InventoryController extends Controller
{
    protected $inventoryRepository;

    public function __construct(InventoryRepository $inventoryRepository)
    {
        $this->inventoryRepository = $inventoryRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Inventory::class);

        $search = $request->get('search', '');
       $data = $this->inventoryRepository->getInventories();
       $inventories = $data->map(function ($items, $productId) {
        $productDetails = $items->first()->product;
        return [
            'product' => $productDetails,
            'inventories' => $items,
        ];
    });
// dd($groupedInventories);
// dd($data->get()->groupBy('product_id')->toArray());
        // $inventories = $this->inventoryRepository->getInventories()->paginate(5);
        // $inventories = $this->inventoryRepository->getInventories()->get()->groupBy('product_id');
//  dd($inventories->toArray());
//Inventory::search($search)
//             ->latest()
//             ->paginate(5)
//             ->withQueryString();

        return view('app.inventories.index', compact('inventories', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Inventory::class);

        $suppliers = Supplier::pluck('name', 'id');
        $products = Product::pluck('name', 'id');
        $locations = Location::pluck('name', 'id');

        return view(
            'app.inventories.create',
            compact('suppliers', 'products', 'locations')
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(InventoryStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Inventory::class);

        $validated = $request->validated();

        $inventory = Inventory::create($validated);

        return redirect()
            ->route('inventories.edit', $inventory)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Inventory $inventory): View
    {
        $this->authorize('view', $inventory);

        return view('app.inventories.show', compact('inventory'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Inventory $inventory): View
    {
        $this->authorize('update', $inventory);

        $suppliers = Supplier::pluck('name', 'id');
        $products = Product::pluck('name', 'id');
        $locations = Location::pluck('name', 'id');

        return view(
            'app.inventories.edit',
            compact('inventory', 'suppliers', 'products', 'locations')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        InventoryUpdateRequest $request,
        Inventory $inventory
    ): RedirectResponse {
        $this->authorize('update', $inventory);

        $validated = $request->validated();

        $inventory->update($validated);

        return redirect()
            ->route('inventories.edit', $inventory)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Inventory $inventory
    ): RedirectResponse {
        $this->authorize('delete', $inventory);

        $inventory->delete();

        return redirect()
            ->route('inventories.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
