<?php

namespace App\Http\Controllers\Api;

use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\CurrencyResource;
use App\Http\Resources\CurrencyCollection;
use App\Http\Requests\CurrencyStoreRequest;
use App\Http\Requests\CurrencyUpdateRequest;

class CurrencyController extends Controller
{
    public function index(Request $request): CurrencyCollection
    {
        $this->authorize('view-any', Currency::class);

        $search = $request->get('search', '');

        $currencies = Currency::search($search)
            ->latest()
            ->paginate();

        return new CurrencyCollection($currencies);
    }

    public function store(CurrencyStoreRequest $request): CurrencyResource
    {
        $this->authorize('create', Currency::class);

        $validated = $request->validated();

        $currency = Currency::create($validated);

        return new CurrencyResource($currency);
    }

    public function show(Request $request, Currency $currency): CurrencyResource
    {
        $this->authorize('view', $currency);

        return new CurrencyResource($currency);
    }

    public function update(
        CurrencyUpdateRequest $request,
        Currency $currency
    ): CurrencyResource {
        $this->authorize('update', $currency);

        $validated = $request->validated();

        $currency->update($validated);

        return new CurrencyResource($currency);
    }

    public function destroy(Request $request, Currency $currency): Response
    {
        $this->authorize('delete', $currency);

        $currency->delete();

        return response()->noContent();
    }
}
