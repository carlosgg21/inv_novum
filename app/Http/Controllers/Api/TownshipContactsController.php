<?php

namespace App\Http\Controllers\Api;

use App\Models\Township;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ContactResource;
use App\Http\Resources\ContactCollection;

class TownshipContactsController extends Controller
{
    public function index(
        Request $request,
        Township $township
    ): ContactCollection {
        $this->authorize('view', $township);

        $search = $request->get('search', '');

        $contacts = $township
            ->contacts()
            ->search($search)
            ->latest()
            ->paginate();

        return new ContactCollection($contacts);
    }

    public function store(Request $request, Township $township): ContactResource
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
            'city_id' => ['nullable', 'exists:cities,id'],
        ]);

        $contact = $township->contacts()->create($validated);

        return new ContactResource($contact);
    }
}
