<?php

namespace App\Http\Controllers\Api;

use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ProductCollection;

class SupplierProductsController extends Controller
{
    public function index(
        Request $request,
        Supplier $supplier
    ): ProductCollection {
        $this->authorize('view', $supplier);

        $search = $request->get('search', '');

        $products = $supplier
            ->products()
            ->search($search)
            ->latest()
            ->paginate();

        return new ProductCollection($products);
    }

    public function store(Request $request, Supplier $supplier): ProductResource
    {
        $this->authorize('create', Product::class);

        $validated = $request->validate([
            'image' => ['nullable', 'image', 'max:1024'],
            'brand_id' => ['nullable', 'exists:brands,id'],
            'category_id' => ['nullable', 'exists:categories,id'],
            'code' => ['nullable', 'max:255', 'string'],
            'name' => ['required', 'max:255', 'string'],
            'description' => ['nullable', 'max:255', 'string'],
            'unit' => ['nullable', 'max:255', 'string'],
            'unit_price' => ['required', 'numeric'],
            'cost_price' => ['nullable', 'numeric'],
            'size' => ['nullable', 'max:255', 'string'],
            'notes' => ['nullable', 'max:255', 'string'],
            'qty_stock' => ['nullable', 'numeric'],
            'qty_on_order' => ['nullable', 'numeric'],
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('public');
        }

        $product = $supplier->products()->create($validated);

        return new ProductResource($product);
    }
}
