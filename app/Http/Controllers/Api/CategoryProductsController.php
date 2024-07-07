<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ProductCollection;

class CategoryProductsController extends Controller
{
    public function index(
        Request $request,
        Category $category
    ): ProductCollection {
        $this->authorize('view', $category);

        $search = $request->get('search', '');

        $products = $category
            ->products()
            ->search($search)
            ->latest()
            ->paginate();

        return new ProductCollection($products);
    }

    public function store(Request $request, Category $category): ProductResource
    {
        $this->authorize('create', Product::class);

        $validated = $request->validate([
            'image' => ['nullable', 'image', 'max:1024'],
            'brand_id' => ['nullable', 'exists:brands,id'],
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

        $product = $category->products()->create($validated);

        return new ProductResource($product);
    }
}
