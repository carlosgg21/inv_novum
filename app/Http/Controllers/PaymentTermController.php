<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\PaymentTerm;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\PaymentTermStoreRequest;
use App\Http\Requests\PaymentTermUpdateRequest;

class PaymentTermController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', PaymentTerm::class);

        $search = $request->get('search', '');

        $paymentTerms = PaymentTerm::search($search)
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view(
            'app.payment_terms.index',
            compact('paymentTerms', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', PaymentTerm::class);

        return view('app.payment_terms.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PaymentTermStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', PaymentTerm::class);

        $validated = $request->validated();

        $paymentTerm = PaymentTerm::create($validated);

        return redirect()
            ->route('payment-terms.edit', $paymentTerm)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, PaymentTerm $paymentTerm): View
    {
        $this->authorize('view', $paymentTerm);

        return view('app.payment_terms.show', compact('paymentTerm'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, PaymentTerm $paymentTerm): View
    {
        $this->authorize('update', $paymentTerm);

        return view('app.payment_terms.edit', compact('paymentTerm'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        PaymentTermUpdateRequest $request,
        PaymentTerm $paymentTerm
    ): RedirectResponse {
        $this->authorize('update', $paymentTerm);

        $validated = $request->validated();

        $paymentTerm->update($validated);

        return redirect()
            ->route('payment-terms.edit', $paymentTerm)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        PaymentTerm $paymentTerm
    ): RedirectResponse {
        $this->authorize('delete', $paymentTerm);

        $paymentTerm->delete();

        return redirect()
            ->route('payment-terms.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
