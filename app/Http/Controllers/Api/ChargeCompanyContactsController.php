<?php

namespace App\Http\Controllers\Api;

use App\Models\Charge;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CompanyContactResource;
use App\Http\Resources\CompanyContactCollection;

class ChargeCompanyContactsController extends Controller
{
    public function index(
        Request $request,
        Charge $charge
    ): CompanyContactCollection {
        $this->authorize('view', $charge);

        $search = $request->get('search', '');

        $companyContacts = $charge
            ->companyContacts()
            ->search($search)
            ->latest()
            ->paginate();

        return new CompanyContactCollection($companyContacts);
    }

    public function store(
        Request $request,
        Charge $charge
    ): CompanyContactResource {
        $this->authorize('create', CompanyContact::class);

        $validated = $request->validate([
            'name' => ['required', 'max:255', 'string'],
            'last_name' => ['required', 'max:255', 'string'],
            'title' => ['nullable', 'max:255', 'string'],
            'boss' => ['required', 'boolean'],
            'email' => ['nullable', 'email'],
            'phone' => ['nullable', 'max:255', 'string'],
            'social_media' => ['nullable', 'max:255', 'json'],
        ]);

        $companyContact = $charge->companyContacts()->create($validated);

        return new CompanyContactResource($companyContact);
    }
}
