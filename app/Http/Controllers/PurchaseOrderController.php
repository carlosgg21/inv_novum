<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\View\View;
use App\Models\Condition;
use App\Models\PaymentTerm;
use Illuminate\Http\Request;
use App\Models\PurchaseOrder;
use App\Models\PaymentMethod;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\PurchaseOrderStoreRequest;
use App\Http\Requests\PurchaseOrderUpdateRequest;

class PurchaseOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', PurchaseOrder::class);

        $search = $request->get('search', '');

        $purchaseOrders = PurchaseOrder::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.purchase_orders.index',
            compact('purchaseOrders', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', PurchaseOrder::class);

        $suppliers = Supplier::pluck('name', 'id');
        $paymentMethods = PaymentMethod::pluck('name', 'id');
        $paymentTerms = PaymentTerm::pluck('description', 'id');
        $conditions = Condition::pluck('name', 'id');

        return view(
            'app.purchase_orders.create',
            compact('suppliers', 'paymentMethods', 'paymentTerms', 'conditions')
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PurchaseOrderStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', PurchaseOrder::class);

        $validated = $request->validated();

        $purchaseOrder = PurchaseOrder::create($validated);

        return redirect()
            ->route('purchase-orders.edit', $purchaseOrder)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, PurchaseOrder $purchaseOrder): View
    {
        $this->authorize('view', $purchaseOrder);

        return view('app.purchase_orders.show', compact('purchaseOrder'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, PurchaseOrder $purchaseOrder): View
    {
        $this->authorize('update', $purchaseOrder);

        $suppliers = Supplier::pluck('name', 'id');
        $paymentMethods = PaymentMethod::pluck('name', 'id');
        $paymentTerms = PaymentTerm::pluck('description', 'id');
        $conditions = Condition::pluck('name', 'id');

        return view(
            'app.purchase_orders.edit',
            compact(
                'purchaseOrder',
                'suppliers',
                'paymentMethods',
                'paymentTerms',
                'conditions'
            )
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        PurchaseOrderUpdateRequest $request,
        PurchaseOrder $purchaseOrder
    ): RedirectResponse {
        $this->authorize('update', $purchaseOrder);

        $validated = $request->validated();

        $purchaseOrder->update($validated);

        return redirect()
            ->route('purchase-orders.edit', $purchaseOrder)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        PurchaseOrder $purchaseOrder
    ): RedirectResponse {
        $this->authorize('delete', $purchaseOrder);

        $purchaseOrder->delete();

        return redirect()
            ->route('purchase-orders.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
