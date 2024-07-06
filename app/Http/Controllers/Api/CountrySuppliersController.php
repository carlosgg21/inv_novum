<?php

namespace App\Http\Controllers\Api;

use App\Models\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\SupplierResource;
use App\Http\Resources\SupplierCollection;

class CountrySuppliersController extends Controller
{
    public function index(
        Request $request,
        Country $country
    ): SupplierCollection {
        $this->authorize('view', $country);

        $search = $request->get('search', '');

        $suppliers = $country
            ->suppliers()
            ->search($search)
            ->latest()
            ->paginate();

        return new SupplierCollection($suppliers);
    }

    public function store(Request $request, Country $country): SupplierResource
    {
        $this->authorize('create', Supplier::class);

        $validated = $request->validate([
            'name' => ['required', 'max:255', 'string'],
            'phone' => ['nullable', 'max:255', 'string'],
            'email' => ['nullable', 'email'],
            'note' => ['nullable', 'max:255', 'string'],
            'address' => ['nullable', 'max:255', 'string'],
        ]);

        $supplier = $country->suppliers()->create($validated);

        return new SupplierResource($supplier);
    }
}
