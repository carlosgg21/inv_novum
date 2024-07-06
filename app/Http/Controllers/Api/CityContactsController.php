<?php

namespace App\Http\Controllers\Api;

use App\Models\City;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ContactResource;
use App\Http\Resources\ContactCollection;

class CityContactsController extends Controller
{
    public function index(Request $request, City $city): ContactCollection
    {
        $this->authorize('view', $city);

        $search = $request->get('search', '');

        $contacts = $city
            ->contacts()
            ->search($search)
            ->latest()
            ->paginate();

        return new ContactCollection($contacts);
    }

    public function store(Request $request, City $city): ContactResource
    {
        $this->authorize('create', Contact::class);

        $validated = $request->validate([
            'identication' => ['nullable', 'max:255', 'string'],
            'name' => ['required', 'max:255', 'string'],
            'last_name' => ['required', 'max:255', 'string'],
            'phone' => ['nullable', 'max:255', 'string'],
            'email' => ['nullable', 'email'],
            'address' => ['nullable', 'max:255', 'string'],
            'country_id' => ['nullable', 'exists:countries,id'],
            'township_id' => ['nullable', 'exists:townships,id'],
        ]);

        $contact = $city->contacts()->create($validated);

        return new ContactResource($contact);
    }
}
