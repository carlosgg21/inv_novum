<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Employee;
use Illuminate\View\View;
use App\Models\SalesOrder;
use App\Models\PaymentTerm;
use App\Models\Product;
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
            ->paginate(10)
            ->withQueryString();

        return view('app.sales_orders.index', compact('salesOrders', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', SalesOrder::class);

        $customers = Customer::orderBy('name')->get(['id', 'name', 'payment_method_id', 'payment_term_id']);
        // dd($customers->toArray());
        // $customers = Customer::orderBy('name')->pluck('name', 'id');
        $employees = Employee::orderBy('name')->pluck('name', 'id');
        $paymentMethods = PaymentMethod::pluck('name', 'id');
        $paymentTerms = PaymentTerm::pluck('description', 'id');
        $products = Product::available()->get(['id', 'name', 'description', 'unit_price', 'qty']);

        $uthorized = app_default('sales_order.so_authorized_approve') ?? '';     
        $authorizedEmployee = $uthorized ? Employee::withSpecificCharges(json_decode($uthorized, true))->pluck('name', 'id')
                                                : Employee::orderBy('name')->pluck('name', 'id');
       
        return view(
            'app.sales_orders.create',
            compact('customers', 'employees', 'paymentMethods', 'paymentTerms', 'products', 'authorizedEmployee')
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    // public function store(SalesOrderStoreRequest $request): RedirectResponse
    {
        dd($request->input());
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

        $defaultContact = $salesOrder->customer->getDefaultContact();
        // dump($salesOrder->customer->contacts->toArray());
        // dump($salesOrder->customer->toArray());
        // dd($defaultContact);
        // dd($salesOrder->customer);
        return view('app.sales_orders.show', compact('salesOrder', 'defaultContact'));
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
