<?php

namespace App\Http\Controllers;

use App\Models\Prefix;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\PrefixStoreRequest;
use App\Http\Requests\PrefixUpdateRequest;

class PrefixController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Prefix::class);

        $search = $request->get('search', '');

        $prefixes = Prefix::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.prefixes.index', compact('prefixes', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Prefix::class);

        return view('app.prefixes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PrefixStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Prefix::class);

        $validated = $request->validated();

        $prefix = Prefix::create($validated);

        return redirect()
            ->route('prefixes.edit', $prefix)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Prefix $prefix): View
    {
        $this->authorize('view', $prefix);

        return view('app.prefixes.show', compact('prefix'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Prefix $prefix): View
    {
        $this->authorize('update', $prefix);

        return view('app.prefixes.edit', compact('prefix'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        PrefixUpdateRequest $request,
        Prefix $prefix
    ): RedirectResponse {
        $this->authorize('update', $prefix);

        $validated = $request->validated();

        $prefix->update($validated);

        return redirect()
            ->route('prefixes.edit', $prefix)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Prefix $prefix): RedirectResponse
    {
        $this->authorize('delete', $prefix);

        $prefix->delete();

        return redirect()
            ->route('prefixes.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
