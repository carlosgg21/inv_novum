<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\CurrencyStoreRequest;
use App\Http\Requests\CurrencyUpdateRequest;

class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Currency::class);

        $search = $request->get('search', '');

        $currencies = Currency::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.currencies.index', compact('currencies', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Currency::class);

        return view('app.currencies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CurrencyStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Currency::class);

        $validated = $request->validated();

        $currency = Currency::create($validated);

        return redirect()
            ->route('currencies.edit', $currency)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Currency $currency): View
    {
        $this->authorize('view', $currency);

        return view('app.currencies.show', compact('currency'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Currency $currency): View
    {
        $this->authorize('update', $currency);

        return view('app.currencies.edit', compact('currency'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        CurrencyUpdateRequest $request,
        Currency $currency
    ): RedirectResponse {
        $this->authorize('update', $currency);

        $validated = $request->validated();

        $currency->update($validated);

        return redirect()
            ->route('currencies.edit', $currency)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Currency $currency
    ): RedirectResponse {
        $this->authorize('delete', $currency);

        $currency->delete();

        return redirect()
            ->route('currencies.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
