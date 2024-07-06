<?php

namespace App\Http\Controllers\Api;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\BrandResource;
use App\Http\Resources\BrandCollection;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\BrandStoreRequest;
use App\Http\Requests\BrandUpdateRequest;

class BrandController extends Controller
{
    public function index(Request $request): BrandCollection
    {
        $this->authorize('view-any', Brand::class);

        $search = $request->get('search', '');

        $brands = Brand::search($search)
            ->latest()
            ->paginate();

        return new BrandCollection($brands);
    }

    public function store(BrandStoreRequest $request): BrandResource
    {
        $this->authorize('create', Brand::class);

        $validated = $request->validated();
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('public');
        }

        $brand = Brand::create($validated);

        return new BrandResource($brand);
    }

    public function show(Request $request, Brand $brand): BrandResource
    {
        $this->authorize('view', $brand);

        return new BrandResource($brand);
    }

    public function update(
        BrandUpdateRequest $request,
        Brand $brand
    ): BrandResource {
        $this->authorize('update', $brand);

        $validated = $request->validated();

        if ($request->hasFile('image')) {
            if ($brand->image) {
                Storage::delete($brand->image);
            }

            $validated['image'] = $request->file('image')->store('public');
        }

        $brand->update($validated);

        return new BrandResource($brand);
    }

    public function destroy(Request $request, Brand $brand): Response
    {
        $this->authorize('delete', $brand);

        if ($brand->image) {
            Storage::delete($brand->image);
        }

        $brand->delete();

        return response()->noContent();
    }
}
