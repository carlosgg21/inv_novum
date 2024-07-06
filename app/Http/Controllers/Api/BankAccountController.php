<?php

namespace App\Http\Controllers\Api;

use App\Models\BankAccount;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\BankAccountResource;
use App\Http\Resources\BankAccountCollection;
use App\Http\Requests\BankAccountStoreRequest;
use App\Http\Requests\BankAccountUpdateRequest;

class BankAccountController extends Controller
{
    public function index(Request $request): BankAccountCollection
    {
        $this->authorize('view-any', BankAccount::class);

        $search = $request->get('search', '');

        $bankAccounts = BankAccount::search($search)
            ->latest()
            ->paginate();

        return new BankAccountCollection($bankAccounts);
    }

    public function store(BankAccountStoreRequest $request): BankAccountResource
    {
        $this->authorize('create', BankAccount::class);

        $validated = $request->validated();

        $bankAccount = BankAccount::create($validated);

        return new BankAccountResource($bankAccount);
    }

    public function show(
        Request $request,
        BankAccount $bankAccount
    ): BankAccountResource {
        $this->authorize('view', $bankAccount);

        return new BankAccountResource($bankAccount);
    }

    public function update(
        BankAccountUpdateRequest $request,
        BankAccount $bankAccount
    ): BankAccountResource {
        $this->authorize('update', $bankAccount);

        $validated = $request->validated();

        $bankAccount->update($validated);

        return new BankAccountResource($bankAccount);
    }

    public function destroy(
        Request $request,
        BankAccount $bankAccount
    ): Response {
        $this->authorize('delete', $bankAccount);

        $bankAccount->delete();

        return response()->noContent();
    }
}
