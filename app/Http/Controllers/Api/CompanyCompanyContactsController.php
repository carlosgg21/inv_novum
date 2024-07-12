<?php

namespace App\Http\Controllers\Api;

use App\Models\Company;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CompanyContactResource;
use App\Http\Resources\CompanyContactCollection;

class CompanyCompanyContactsController extends Controller
{
    public function index(
        Request $request,
        Company $company
    ): CompanyContactCollection {
        $this->authorize('view', $company);

        $search = $request->get('search', '');

        $companyContacts = $company
            ->companyContacts()
            ->search($search)
            ->latest()
            ->paginate();

        return new CompanyContactCollection($companyContacts);
    }

    public function store(
        Request $request,
        Company $company
    ): CompanyContactResource {
        $this->authorize('create', CompanyContact::class);

        $validated = $request->validate([
            'name' => ['required', 'max:255', 'string'],
            'last_name' => ['required', 'max:255', 'string'],
            'title' => ['nullable', 'max:255', 'string'],
            'charge_id' => ['nullable', 'exists:charges,id'],
            'boss' => ['required', 'boolean'],
            'email' => ['nullable', 'email'],
            'phone' => ['nullable', 'max:255', 'string'],
            'social_media' => ['nullable', 'max:255', 'json'],
        ]);

        $companyContact = $company->companyContacts()->create($validated);

        return new CompanyContactResource($companyContact);
    }
}
