<?php

namespace App\Http\Controllers;

use App\Models\Condition;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\ConditionStoreRequest;
use App\Http\Requests\ConditionUpdateRequest;

class ConditionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Condition::class);

        $search = $request->get('search', '');

        $conditions = Condition::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.conditions.index', compact('conditions', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Condition::class);

        return view('app.conditions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ConditionStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Condition::class);

        $validated = $request->validated();

        $condition = Condition::create($validated);

        return redirect()
            ->route('conditions.edit', $condition)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Condition $condition): View
    {
        $this->authorize('view', $condition);

        return view('app.conditions.show', compact('condition'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Condition $condition): View
    {
        $this->authorize('update', $condition);

        return view('app.conditions.edit', compact('condition'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        ConditionUpdateRequest $request,
        Condition $condition
    ): RedirectResponse {
        $this->authorize('update', $condition);

        $validated = $request->validated();

        $condition->update($validated);

        return redirect()
            ->route('conditions.edit', $condition)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Condition $condition
    ): RedirectResponse {
        $this->authorize('delete', $condition);

        $condition->delete();

        return redirect()
            ->route('conditions.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
