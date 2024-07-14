<?php

namespace App\Http\Controllers;

use App\Http\Requests\AppDefaultStoreRequest;
use App\Http\Requests\AppDefaultUpdateRequest;
use App\Models\AppDefault;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AppDefaultController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', AppDefault::class);

        $search = $request->get('search', '');

        $appDefaults = AppDefault::notManagedBy()
             ->search($search)
             ->latest()
             ->paginate(5)
             ->withQueryString();

        return view('app.app_defaults.index', compact('appDefaults', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', AppDefault::class);

        return view('app.app_defaults.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AppDefaultStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', AppDefault::class);

        $validated = $request->validated();

        $appDefault = AppDefault::create($validated);

        return redirect()
            ->route('app-defaults.edit', $appDefault)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, AppDefault $appDefault): View
    {
        $this->authorize('view', $appDefault);

        return view('app.app_defaults.show', compact('appDefault'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, AppDefault $appDefault): View
    {
        $this->authorize('update', $appDefault);

        return view('app.app_defaults.edit', compact('appDefault'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        AppDefaultUpdateRequest $request,
        AppDefault $appDefault
    ): RedirectResponse {
        $this->authorize('update', $appDefault);

        $validated = $request->validated();

        $appDefault->update($validated);

        return redirect()
            ->route('app-defaults.edit', $appDefault)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        AppDefault $appDefault
    ): RedirectResponse {
        $this->authorize('delete', $appDefault);

        $appDefault->delete();

        return redirect()
            ->route('app-defaults.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
