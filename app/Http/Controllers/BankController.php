<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\BankStoreRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\BankUpdateRequest;

class BankController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Bank::class);

        $search = $request->get('search', '');

        $banks = Bank::search($search)
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('app.banks.index', compact('banks', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Bank::class);

        return view('app.banks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BankStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Bank::class);

        $validated = $request->validated();
        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('public');
        }

        $bank = Bank::create($validated);

        return redirect()
            ->route('banks.edit', $bank)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Bank $bank): View
    {
        $this->authorize('view', $bank);

        return view('app.banks.show', compact('bank'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Bank $bank): View
    {
        $this->authorize('update', $bank);

        return view('app.banks.edit', compact('bank'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        BankUpdateRequest $request,
        Bank $bank
    ): RedirectResponse {
        $this->authorize('update', $bank);

        $validated = $request->validated();
        if ($request->hasFile('logo')) {
            if ($bank->logo) {
                Storage::delete($bank->logo);
            }

            $validated['logo'] = $request->file('logo')->store('public');
        }

        $bank->update($validated);

        return redirect()
            ->route('banks.edit', $bank)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Bank $bank): RedirectResponse
    {
        $this->authorize('delete', $bank);

        if ($bank->logo) {
            Storage::delete($bank->logo);
        }

        $bank->delete();

        return redirect()
            ->route('banks.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
