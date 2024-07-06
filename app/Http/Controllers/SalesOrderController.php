<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Employee;
use Illuminate\View\View;
use App\Models\SalesOrder;
use App\Models\PaymentTerm;
use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\SalesOrderStoreRequest;
use App\Http\Requests\SalesOrderUpdateRequest;

class SalesOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', SalesOrder::class);

        $search = $request->get('search', '');

        $salesOrders = SalesOrder::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.sales_orders.index', compact('salesOrders', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', SalesOrder::class);

        $customers = Customer::pluck('name', 'id');
        $employees = Employee::pluck('name', 'id');
        $paymentMethods = PaymentMethod::pluck('name', 'id');
        $paymentTerms = PaymentTerm::pluck('description', 'id');

        return view(
            'app.sales_orders.create',
            compact('customers', 'employees', 'paymentMethods', 'paymentTerms')
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SalesOrderStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', SalesOrder::class);

        $validated = $request->validated();

        $salesOrder = SalesOrder::create($validated);

        return redirect()
            ->route('sales-orders.edit', $salesOrder)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, SalesOrder $salesOrder): View
    {
        $this->authorize('view', $salesOrder);

        return view('app.sales_orders.show', compact('salesOrder'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, SalesOrder $salesOrder): View
    {
        $this->authorize('update', $salesOrder);

        $customers = Customer::pluck('name', 'id');
        $employees = Employee::pluck('name', 'id');
        $paymentMethods = PaymentMethod::pluck('name', 'id');
        $paymentTerms = PaymentTerm::pluck('description', 'id');

        return view(
            'app.sales_orders.edit',
            compact(
                'salesOrder',
                'customers',
                'employees',
                'paymentMethods',
                'paymentTerms'
            )
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        SalesOrderUpdateRequest $request,
        SalesOrder $salesOrder
    ): RedirectResponse {
        $this->authorize('update', $salesOrder);

        $validated = $request->validated();

        $salesOrder->update($validated);

        return redirect()
            ->route('sales-orders.edit', $salesOrder)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        SalesOrder $salesOrder
    ): RedirectResponse {
        $this->authorize('delete', $salesOrder);

        $salesOrder->delete();

        return redirect()
            ->route('sales-orders.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
