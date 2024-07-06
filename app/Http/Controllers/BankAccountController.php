<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\Currency;
use Illuminate\View\View;
use App\Models\BankAccount;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\BankAccountStoreRequest;
use App\Http\Requests\BankAccountUpdateRequest;

class BankAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', BankAccount::class);

        $search = $request->get('search', '');

        $bankAccounts = BankAccount::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.bank_accounts.index',
            compact('bankAccounts', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', BankAccount::class);

        $banks = Bank::pluck('name', 'id');
        $currencies = Currency::pluck('name', 'id');

        return view('app.bank_accounts.create', compact('banks', 'currencies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BankAccountStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', BankAccount::class);

        $validated = $request->validated();

        $bankAccount = BankAccount::create($validated);

        return redirect()
            ->route('bank-accounts.edit', $bankAccount)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, BankAccount $bankAccount): View
    {
        $this->authorize('view', $bankAccount);

        return view('app.bank_accounts.show', compact('bankAccount'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, BankAccount $bankAccount): View
    {
        $this->authorize('update', $bankAccount);

        $banks = Bank::pluck('name', 'id');
        $currencies = Currency::pluck('name', 'id');

        return view(
            'app.bank_accounts.edit',
            compact('bankAccount', 'banks', 'currencies')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        BankAccountUpdateRequest $request,
        BankAccount $bankAccount
    ): RedirectResponse {
        $this->authorize('update', $bankAccount);

        $validated = $request->validated();

        $bankAccount->update($validated);

        return redirect()
            ->route('bank-accounts.edit', $bankAccount)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        BankAccount $bankAccount
    ): RedirectResponse {
        $this->authorize('delete', $bankAccount);

        $bankAccount->delete();

        return redirect()
            ->route('bank-accounts.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
