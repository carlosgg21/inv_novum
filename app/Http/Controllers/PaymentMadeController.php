<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Models\Employee;
use Illuminate\View\View;
use App\Models\PaymentMade;
use App\Models\PaymentTerm;
use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use App\Models\PurchaseOrder;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\PaymentMadeStoreRequest;
use App\Http\Requests\PaymentMadeUpdateRequest;

class PaymentMadeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', PaymentMade::class);

        $search = $request->get('search', '');

        $paymentMades = PaymentMade::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.payment_mades.index',
            compact('paymentMades', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', PaymentMade::class);

        $suppliers = Supplier::pluck('name', 'id');
        $paymentMethods = PaymentMethod::pluck('name', 'id');
        $paymentTerms = PaymentTerm::pluck('description', 'id');
        $purchaseOrders = PurchaseOrder::pluck('number', 'id');
        $employees = Employee::pluck('name', 'id');

        return view(
            'app.payment_mades.create',
            compact(
                'suppliers',
                'paymentMethods',
                'paymentTerms',
                'purchaseOrders',
                'employees'
            )
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PaymentMadeStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', PaymentMade::class);

        $validated = $request->validated();

        $paymentMade = PaymentMade::create($validated);

        return redirect()
            ->route('payment-mades.edit', $paymentMade)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, PaymentMade $paymentMade): View
    {
        $this->authorize('view', $paymentMade);

        return view('app.payment_mades.show', compact('paymentMade'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, PaymentMade $paymentMade): View
    {
        $this->authorize('update', $paymentMade);

        $suppliers = Supplier::pluck('name', 'id');
        $paymentMethods = PaymentMethod::pluck('name', 'id');
        $paymentTerms = PaymentTerm::pluck('description', 'id');
        $purchaseOrders = PurchaseOrder::pluck('number', 'id');
        $employees = Employee::pluck('name', 'id');

        return view(
            'app.payment_mades.edit',
            compact(
                'paymentMade',
                'suppliers',
                'paymentMethods',
                'paymentTerms',
                'purchaseOrders',
                'employees'
            )
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        PaymentMadeUpdateRequest $request,
        PaymentMade $paymentMade
    ): RedirectResponse {
        $this->authorize('update', $paymentMade);

        $validated = $request->validated();

        $paymentMade->update($validated);

        return redirect()
            ->route('payment-mades.edit', $paymentMade)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        PaymentMade $paymentMade
    ): RedirectResponse {
        $this->authorize('delete', $paymentMade);

        $paymentMade->delete();

        return redirect()
            ->route('payment-mades.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
