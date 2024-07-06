<?php

namespace App\Http\Controllers\Api;

use App\Models\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\AddressResource;
use App\Http\Resources\AddressCollection;

class CountryAddressesController extends Controller
{
    public function index(Request $request, Country $country): AddressCollection
    {
        $this->authorize('view', $country);

        $search = $request->get('search', '');

        $addresses = $country
            ->addresses()
            ->search($search)
            ->latest()
            ->paginate();

        return new AddressCollection($addresses);
    }

    public function store(Request $request, Country $country): AddressResource
    {
        $this->authorize('create', Address::class);

        $validated = $request->validate([
            'address' => ['required', 'max:255', 'string'],
            'zip_code' => ['nullable', 'max:255', 'string'],
            'addressable_id' => ['required', 'max:255'],
            'city_id' => ['nullable', 'exists:cities,id'],
            'addressable_type' => ['required', 'max:255', 'string'],
            'township_id' => ['nullable', 'exists:townships,id'],
        ]);

        $address = $country->addresses()->create($validated);

        return new AddressResource($address);
    }
}
