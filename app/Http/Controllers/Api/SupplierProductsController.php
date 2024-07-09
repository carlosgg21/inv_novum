<?php
namespace App\Http\Controllers\Api;

use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
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

    public function store(
        Request $request,
        Supplier $supplier,
        Product $product
    ): Response {
        $this->authorize('update', $supplier);

        $supplier->products()->syncWithoutDetaching([$product->id]);

        return response()->noContent();
    }

    public function destroy(
        Request $request,
        Supplier $supplier,
        Product $product
    ): Response {
        $this->authorize('update', $supplier);

        $supplier->products()->detach($product);

        return response()->noContent();
    }
}
