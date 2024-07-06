<?php

namespace App\Http\Controllers\Api;

use App\Models\Currency;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\BankAccountResource;
use App\Http\Resources\BankAccountCollection;

class CurrencyBankAccountsController extends Controller
{
    public function index(
        Request $request,
        Currency $currency
    ): BankAccountCollection {
        $this->authorize('view', $currency);

        $search = $request->get('search', '');

        $bankAccounts = $currency
            ->bankAccounts()
            ->search($search)
            ->latest()
            ->paginate();

        return new BankAccountCollection($bankAccounts);
    }

    public function store(
        Request $request,
        Currency $currency
    ): BankAccountResource {
        $this->authorize('create', BankAccount::class);

        $validated = $request->validate([
            'number' => ['required', 'max:255', 'string'],
            'bank_id' => ['nullable', 'exists:banks,id'],
            'type' => ['nullable', 'max:255', 'string'],
        ]);

        $bankAccount = $currency->bankAccounts()->create($validated);

        return new BankAccountResource($bankAccount);
    }
}
