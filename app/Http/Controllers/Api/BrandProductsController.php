<?php

namespace App\Http\Controllers\Api;

use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ProductCollection;

class BrandProductsController extends Controller
{
    public function index(Request $request, Brand $brand): ProductCollection
    {
        $this->authorize('view', $brand);

        $search = $request->get('search', '');

        $products = $brand
            ->products()
            ->search($search)
            ->latest()
            ->paginate();

        return new ProductCollection($products);
    }

    public function store(Request $request, Brand $brand): ProductResource
    {
        $this->authorize('create', Product::class);

        $validated = $request->validate([
            'image' => ['nullable', 'image', 'max:1024'],
            'category_id' => ['nullable', 'exists:categories,id'],
            'code' => ['nullable', 'max:255', 'string'],
            'supplier_id' => ['nullable', 'exists:suppliers,id'],
            'name' => ['required', 'max:255', 'string'],
            'description' => ['nullable', 'max:255', 'string'],
            'unit' => ['nullable', 'max:255', 'string'],
            'unit_price' => ['required', 'numeric'],
            'cost_price' => ['nullable', 'numeric'],
            'size' => ['nullable', 'max:255', 'string'],
            'notes' => ['nullable', 'max:255', 'string'],
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('public');
        }

        $product = $brand->products()->create($validated);

        return new ProductResource($product);
    }
}
