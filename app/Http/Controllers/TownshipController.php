<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Township;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\TownshipStoreRequest;
use App\Http\Requests\TownshipUpdateRequest;

class TownshipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Township::class);

        $search = $request->get('search', '');

        $townships = Township::search($search)
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('app.townships.index', compact('townships', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Township::class);

        $cities = City::pluck('name', 'id');

        return view('app.townships.create', compact('cities'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TownshipStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Township::class);

        $validated = $request->validated();

        $township = Township::create($validated);

        return redirect()
            ->route('townships.edit', $township)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Township $township): View
    {
        $this->authorize('view', $township);

        return view('app.townships.show', compact('township'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Township $township): View
    {
        $this->authorize('update', $township);

        $cities = City::pluck('name', 'id');

        return view('app.townships.edit', compact('township', 'cities'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        TownshipUpdateRequest $request,
        Township $township
    ): RedirectResponse {
        $this->authorize('update', $township);

        $validated = $request->validated();

        $township->update($validated);

        return redirect()
            ->route('townships.edit', $township)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Township $township
    ): RedirectResponse {
        $this->authorize('delete', $township);

        $township->delete();

        return redirect()
            ->route('townships.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
