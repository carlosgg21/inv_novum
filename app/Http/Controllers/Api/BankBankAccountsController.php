<?php

namespace App\Http\Controllers\Api;

use App\Models\Bank;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\BankAccountResource;
use App\Http\Resources\BankAccountCollection;

class BankBankAccountsController extends Controller
{
    public function index(Request $request, Bank $bank): BankAccountCollection
    {
        $this->authorize('view', $bank);

        $search = $request->get('search', '');

        $bankAccounts = $bank
            ->bankAccounts()
            ->search($search)
            ->latest()
            ->paginate();

        return new BankAccountCollection($bankAccounts);
    }

    public function store(Request $request, Bank $bank): BankAccountResource
    {
        $this->authorize('create', BankAccount::class);

        $validated = $request->validate([
            'number' => ['required', 'max:255', 'string'],
            'type' => ['nullable', 'max:255', 'string'],
            'currency_id' => ['nullable', 'exists:currencies,id'],
        ]);

        $bankAccount = $bank->bankAccounts()->create($validated);

        return new BankAccountResource($bankAccount);
    }
}
