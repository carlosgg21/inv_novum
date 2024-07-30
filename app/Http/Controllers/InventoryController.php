<?php

namespace App\Http\Controllers;

use App\Http\Requests\InventoryStoreRequest;
use App\Http\Requests\InventoryUpdateRequest;
use App\Models\Inventory;
use App\Models\Location;
use App\Models\PaymentMethod;
use App\Models\PaymentTerm;
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
        $inventories = $data->map(function ($items) {
            $productDetails = $items->first()->product;

            return [
                'product'     => $productDetails,
                'inventories' => $items,
            ];
        });
    //    dd($inventories->toArray());
        return view('app.inventories.index', compact('inventories', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Inventory::class);

        $suppliers = Supplier::pluck('name', 'id');
        $products = Product::all()->pluck('name', 'id')->map(function ($name, $id) {
            $product = Product::find($id);

            return $product->code.' - '.$name;
        });
        $locations = Location::pluck('name', 'id');
        $paymentMethod = PaymentMethod::pluck('name', 'id');
        $paymentTerm = PaymentTerm::pluck('code', 'id');

        return view(
            'app.inventories.create',
            compact('suppliers', 'products', 'locations', 'paymentMethod', 'paymentTerm')
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(InventoryStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Inventory::class);

        $validated = $request->validated();

        try {
            $inventory = $this->inventoryRepository->entryInventory($validated);

            return redirect()
                ->route('inventories.edit', $inventory)
                ->withSuccess(__('crud.common.created'));
        } catch (\Exception $e) {
            return redirect()
                ->route('inventories.index')
                ->withErrors(__('crud.common.error').': '.$e->getMessage());
        }
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
        $products = Product::all()->pluck('name', 'id')->map(function ($name, $id) {
            $product = Product::find($id);

            return $product->code.' - '.$name;
        });
        $locations = Location::pluck('name', 'id');
        $paymentMethod = PaymentMethod::pluck('name', 'id');
        $paymentTerm = PaymentTerm::pluck('code', 'id');

        return view(
            'app.inventories.edit',
            compact('inventory', 'suppliers', 'products', 'locations', 'paymentMethod', 'paymentTerm')
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
