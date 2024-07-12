<?php

namespace App\Http\Controllers\Api;

use App\Models\City;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\AddressResource;
use App\Http\Resources\AddressCollection;

class CityAddressesController extends Controller
{
    public function index(Request $request, City $city): AddressCollection
    {
        $this->authorize('view', $city);

        $search = $request->get('search', '');

        $addresses = $city
            ->addresses()
            ->search($search)
            ->latest()
            ->paginate();

        return new AddressCollection($addresses);
    }

    public function store(Request $request, City $city): AddressResource
    {
        $this->authorize('create', Address::class);

        $validated = $request->validate([
            'address' => ['required', 'max:255', 'string'],
            'zip_code' => ['nullable', 'max:255', 'string'],
            'country_id' => ['nullable', 'exists:countries,id'],
            'addressable_id' => ['required', 'max:255'],
            'addressable_type' => ['required', 'max:255', 'string'],
            'township_id' => ['nullable', 'exists:townships,id'],
            'zip_code' => ['nullable', 'max:255', 'string'],
            'default' => ['nullable', 'boolean'],
        ]);

        $address = $city->addresses()->create($validated);

        return new AddressResource($address);
    }
}
