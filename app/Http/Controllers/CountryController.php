<?php

namespace App\Http\Controllers;

use App\Http\Requests\CountryStoreRequest;
use App\Http\Requests\CountryUpdateRequest;
use App\Models\Country;
use App\Models\Currency;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Country::class);

        $search = $request->get('search', '');

        $countries = Country::withTrashed()
            ->search($search)
            ->orderByRaw('CASE WHEN deleted_at IS NULL THEN 0 ELSE 1 END, name ASC')
            ->paginate(10)
            ->withQueryString();

        return view('app.countries.index', compact('countries', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Country::class);

        $currencies = Currency::pluck('name', 'id');

        return view('app.countries.create', compact('currencies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CountryStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Country::class);

        $validated = $request->validated();

        $country = Country::create($validated);

        return redirect()
            ->route('countries.edit', $country)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Country $country): View
    {
        $this->authorize('view', $country);

        return view('app.countries.show', compact('country'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Country $country): View
    {
        $this->authorize('update', $country);

        $currencies = Currency::pluck('name', 'id');

        return view('app.countries.edit', compact('country', 'currencies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        CountryUpdateRequest $request,
        Country $country
    ): RedirectResponse {
        $this->authorize('update', $country);

        $validated = $request->validated();

        $country->update($validated);

        return redirect()
            ->route('countries.edit', $country)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Country $country
    ): RedirectResponse {
        $this->authorize('delete', $country);

        $country->delete();

        return redirect()
            ->route('countries.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
