<?php

namespace App\Http\Controllers\Api;

use App\Models\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ContactResource;
use App\Http\Resources\ContactCollection;

class CountryContactsController extends Controller
{
    public function index(Request $request, Country $country): ContactCollection
    {
        $this->authorize('view', $country);

        $search = $request->get('search', '');

        $contacts = $country
            ->contacts()
            ->search($search)
            ->latest()
            ->paginate();

        return new ContactCollection($contacts);
    }

    public function store(Request $request, Country $country): ContactResource
    {
        $this->authorize('create', Contact::class);

        $validated = $request->validate([
            'identification' => ['nullable', 'max:255', 'string'],
            'name' => ['required', 'max:255', 'string'],
            'last_name' => ['required', 'max:255', 'string'],
            'phone' => ['nullable', 'max:255', 'string'],
            'email' => ['nullable', 'email'],
            'address' => ['nullable', 'max:255', 'string'],
            'city_id' => ['nullable', 'exists:cities,id'],
            'township_id' => ['nullable', 'exists:townships,id'],
        ]);

        $contact = $country->contacts()->create($validated);

        return new ContactResource($contact);
    }
}
