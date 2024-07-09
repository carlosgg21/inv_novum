<?php
namespace App\Http\Controllers\Api;

use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\SupplierCollection;

class ProductSuppliersController extends Controller
{
    public function index(
        Request $request,
        Product $product
    ): SupplierCollection {
        $this->authorize('view', $product);

        $search = $request->get('search', '');

        $suppliers = $product
            ->suppliers()
            ->search($search)
            ->latest()
            ->paginate();

        return new SupplierCollection($suppliers);
    }

    public function store(
        Request $request,
        Product $product,
        Supplier $supplier
    ): Response {
        $this->authorize('update', $product);

        $product->suppliers()->syncWithoutDetaching([$supplier->id]);

        return response()->noContent();
    }

    public function destroy(
        Request $request,
        Product $product,
        Supplier $supplier
    ): Response {
        $this->authorize('update', $product);

        $product->suppliers()->detach($supplier);

        return response()->noContent();
    }
}
