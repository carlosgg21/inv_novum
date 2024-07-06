<?php

namespace App\Http\Controllers;

use App\Models\Charge;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\ChargeStoreRequest;
use App\Http\Requests\ChargeUpdateRequest;

class ChargeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Charge::class);

        $search = $request->get('search', '');

        $charges = Charge::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.charges.index', compact('charges', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Charge::class);

        return view('app.charges.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ChargeStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Charge::class);

        $validated = $request->validated();

        $charge = Charge::create($validated);

        return redirect()
            ->route('charges.edit', $charge)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Charge $charge): View
    {
        $this->authorize('view', $charge);

        return view('app.charges.show', compact('charge'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Charge $charge): View
    {
        $this->authorize('update', $charge);

        return view('app.charges.edit', compact('charge'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        ChargeUpdateRequest $request,
        Charge $charge
    ): RedirectResponse {
        $this->authorize('update', $charge);

        $validated = $request->validated();

        $charge->update($validated);

        return redirect()
            ->route('charges.edit', $charge)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Charge $charge): RedirectResponse
    {
        $this->authorize('delete', $charge);

        $charge->delete();

        return redirect()
            ->route('charges.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
