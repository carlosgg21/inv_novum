<?php

namespace App\Http\Controllers;

use App\Http\Requests\SupplierStoreRequest;
use App\Http\Requests\SupplierUpdateRequest;
use App\Models\Country;
use App\Models\Supplier;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Supplier::class);

        $search = $request->get('search', '');

        $suppliers = Supplier::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.suppliers.index', compact('suppliers', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Supplier::class);

        $countries = Country::pluck('name', 'id');

        return view('app.suppliers.create', compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SupplierStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Supplier::class);

        $validated = $request->validated();

        if (!empty($validated['note'])) {
            $userName = auth()->user()->name;
            $timestamp = now()->toDateTimeString();
            $validated['note'] .= " [{$timestamp} by {$userName}]";
        }

        $supplier = Supplier::create($validated);

        return redirect()
            ->route('suppliers.edit', $supplier)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Supplier $supplier): View
    {
        $this->authorize('view', $supplier);

        return view('app.suppliers.show', compact('supplier'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Supplier $supplier): View
    {
        $this->authorize('update', $supplier);

        $countries = Country::pluck('name', 'id');

        return view('app.suppliers.edit', compact('supplier', 'countries'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update( SupplierUpdateRequest $request,Supplier $supplier): RedirectResponse 
    {
        $this->authorize('update', $supplier);

        $validated = $request->validated();

        if (!empty($validated['note'])) {
            $userName = auth()->user()->name;
            $timestamp = now()->toDateTimeString();
            $validated['note'] .= " [{$timestamp} by {$userName}]";
        }

        $supplier->update($validated);

        return redirect()
            ->route('suppliers.edit', $supplier)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Supplier $supplier
    ): RedirectResponse {
        $this->authorize('delete', $supplier);

        $supplier->delete();

        return redirect()
            ->route('suppliers.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
