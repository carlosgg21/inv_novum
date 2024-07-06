<?php

namespace App\Http\Controllers\Api;

use App\Models\Currency;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CountyResource;
use App\Http\Resources\CountyCollection;

class CurrencyCountiesController extends Controller
{
    public function index(
        Request $request,
        Currency $currency
    ): CountyCollection {
        $this->authorize('view', $currency);

        $search = $request->get('search', '');

        $counties = $currency
            ->counties()
            ->search($search)
            ->latest()
            ->paginate();

        return new CountyCollection($counties);
    }

    public function store(Request $request, Currency $currency): CountyResource
    {
        $this->authorize('create', County::class);

        $validated = $request->validate([
            'name' => ['required', 'max:255', 'string'],
            'code' => ['required', 'max:255', 'string'],
            'iso' => ['nullable', 'max:255', 'string'],
            'time_zone' => ['nullable', 'max:255', 'string'],
            'flag' => ['nullable', 'max:255', 'string'],
        ]);

        $county = $currency->counties()->create($validated);

        return new CountyResource($county);
    }
}
