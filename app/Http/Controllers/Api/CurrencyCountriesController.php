<?php

namespace App\Http\Controllers\Api;

use App\Models\Currency;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CountryResource;
use App\Http\Resources\CountryCollection;

class CurrencyCountriesController extends Controller
{
    public function index(
        Request $request,
        Currency $currency
    ): CountryCollection {
        $this->authorize('view', $currency);

        $search = $request->get('search', '');

        $countries = $currency
            ->countries()
            ->search($search)
            ->latest()
            ->paginate();

        return new CountryCollection($countries);
    }

    public function store(Request $request, Currency $currency): CountryResource
    {
        $this->authorize('create', Country::class);

        $validated = $request->validate([
            'code' => ['required', 'max:255', 'string'],
            'name' => ['required', 'max:255', 'string'],
            'iso' => ['nullable', 'max:255', 'string'],
            'time_zone' => ['nullable', 'max:255', 'string'],
            'flag' => ['nullable', 'max:255', 'string'],
        ]);

        $country = $currency->countries()->create($validated);

        return new CountryResource($country);
    }
}
