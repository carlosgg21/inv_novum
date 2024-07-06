<?php

namespace App\Http\Controllers\Api;

use App\Models\SalesOrder;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\SalesOrderResource;
use App\Http\Resources\SalesOrderCollection;
use App\Http\Requests\SalesOrderStoreRequest;
use App\Http\Requests\SalesOrderUpdateRequest;

class SalesOrderController extends Controller
{
    public function index(Request $request): SalesOrderCollection
    {
        $this->authorize('view-any', SalesOrder::class);

        $search = $request->get('search', '');

        $salesOrders = SalesOrder::search($search)
            ->latest()
            ->paginate();

        return new SalesOrderCollection($salesOrders);
    }

    public function store(SalesOrderStoreRequest $request): SalesOrderResource
    {
        $this->authorize('create', SalesOrder::class);

        $validated = $request->validated();

        $salesOrder = SalesOrder::create($validated);

        return new SalesOrderResource($salesOrder);
    }

    public function show(
        Request $request,
        SalesOrder $salesOrder
    ): SalesOrderResource {
        $this->authorize('view', $salesOrder);

        return new SalesOrderResource($salesOrder);
    }

    public function update(
        SalesOrderUpdateRequest $request,
        SalesOrder $salesOrder
    ): SalesOrderResource {
        $this->authorize('update', $salesOrder);

        $validated = $request->validated();

        $salesOrder->update($validated);

        return new SalesOrderResource($salesOrder);
    }

    public function destroy(Request $request, SalesOrder $salesOrder): Response
    {
        $this->authorize('delete', $salesOrder);

        $salesOrder->delete();

        return response()->noContent();
    }
}
