<?php

namespace App\Http\Controllers\Api;

use App\Models\Township;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\AddressResource;
use App\Http\Resources\AddressCollection;

class TownshipAddressesController extends Controller
{
    public function index(
        Request $request,
        Township $township
    ): AddressCollection {
        $this->authorize('view', $township);

        $search = $request->get('search', '');

        $addresses = $township
            ->addresses()
            ->search($search)
            ->latest()
            ->paginate();

        return new AddressCollection($addresses);
    }

    public function store(Request $request, Township $township): AddressResource
    {
        $this->authorize('create', Address::class);

        $validated = $request->validate([
            'address' => ['required', 'max:255', 'string'],
            'zip_code' => ['nullable', 'max:255', 'string'],
            'country_id' => ['nullable', 'exists:countries,id'],
            'addressable_id' => ['required', 'max:255'],
            'city_id' => ['nullable', 'exists:cities,id'],
            'addressable_type' => ['required', 'max:255', 'string'],
            'zip_code' => ['nullable', 'max:255', 'string'],
            'default' => ['nullable', 'boolean'],
        ]);

        $address = $township->addresses()->create($validated);

        return new AddressResource($address);
    }
}
