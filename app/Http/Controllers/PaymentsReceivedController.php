<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Customer;
use App\Models\Employee;
use Illuminate\View\View;
use App\Models\SalesOrder;
use App\Models\PaymentTerm;
use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use App\Models\PaymentsReceived;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\PaymentsReceivedStoreRequest;
use App\Http\Requests\PaymentsReceivedUpdateRequest;

class PaymentsReceivedController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', PaymentsReceived::class);

        $search = $request->get('search', '');

        $paymentsReceiveds = PaymentsReceived::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.payments_receiveds.index',
            compact('paymentsReceiveds', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', PaymentsReceived::class);

        $paymentMethods = PaymentMethod::pluck('name', 'id');
        $paymentTerms = PaymentTerm::pluck('description', 'id');
        $invoices = Invoice::pluck('number', 'id');
        $salesOrders = SalesOrder::pluck('number', 'id');
        $customers = Customer::pluck('name', 'id');
        $employees = Employee::pluck('name', 'id');

        return view(
            'app.payments_receiveds.create',
            compact(
                'paymentMethods',
                'paymentTerms',
                'invoices',
                'salesOrders',
                'customers',
                'employees'
            )
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(
        PaymentsReceivedStoreRequest $request
    ): RedirectResponse {
        $this->authorize('create', PaymentsReceived::class);

        $validated = $request->validated();

        $paymentsReceived = PaymentsReceived::create($validated);

        return redirect()
            ->route('payments-receiveds.edit', $paymentsReceived)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(
        Request $request,
        PaymentsReceived $paymentsReceived
    ): View {
        $this->authorize('view', $paymentsReceived);

        return view('app.payments_receiveds.show', compact('paymentsReceived'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(
        Request $request,
        PaymentsReceived $paymentsReceived
    ): View {
        $this->authorize('update', $paymentsReceived);

        $paymentMethods = PaymentMethod::pluck('name', 'id');
        $paymentTerms = PaymentTerm::pluck('description', 'id');
        $invoices = Invoice::pluck('number', 'id');
        $salesOrders = SalesOrder::pluck('number', 'id');
        $customers = Customer::pluck('name', 'id');
        $employees = Employee::pluck('name', 'id');

        return view(
            'app.payments_receiveds.edit',
            compact(
                'paymentsReceived',
                'paymentMethods',
                'paymentTerms',
                'invoices',
                'salesOrders',
                'customers',
                'employees'
            )
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        PaymentsReceivedUpdateRequest $request,
        PaymentsReceived $paymentsReceived
    ): RedirectResponse {
        $this->authorize('update', $paymentsReceived);

        $validated = $request->validated();

        $paymentsReceived->update($validated);

        return redirect()
            ->route('payments-receiveds.edit', $paymentsReceived)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        PaymentsReceived $paymentsReceived
    ): RedirectResponse {
        $this->authorize('delete', $paymentsReceived);

        $paymentsReceived->delete();

        return redirect()
            ->route('payments-receiveds.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
