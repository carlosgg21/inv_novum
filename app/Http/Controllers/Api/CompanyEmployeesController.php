<?php

namespace App\Http\Controllers\Api;

use App\Models\Company;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\EmployeeResource;
use App\Http\Resources\EmployeeCollection;

class CompanyEmployeesController extends Controller
{
    public function index(
        Request $request,
        Company $company
    ): EmployeeCollection {
        $this->authorize('view', $company);

        $search = $request->get('search', '');

        $employees = $company
            ->employees()
            ->search($search)
            ->latest()
            ->paginate();

        return new EmployeeCollection($employees);
    }

    public function store(Request $request, Company $company): EmployeeResource
    {
        $this->authorize('create', Employee::class);

        $validated = $request->validate([
            'image' => ['nullable', 'image', 'max:1024'],
            'identification' => ['required', 'max:255', 'string'],
            'name' => ['required', 'max:255', 'string'],
            'last_name' => ['required', 'max:255', 'string'],
            'charge_id' => ['nullable', 'exists:charges,id'],
            'phone' => ['nullable', 'max:255', 'string'],
            'email' => ['nullable', 'email'],
            'hiddeng_date' => ['nullable', 'date'],
            'discharge_date' => ['nullable', 'date'],
            'brithday' => ['nullable', 'date'],
            'qr_code' => ['image', 'max:1024', 'nullable'],
            'observation' => ['nullable', 'max:255', 'string'],
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('public');
        }

        if ($request->hasFile('qr_code')) {
            $validated['qr_code'] = $request->file('qr_code')->store('public');
        }

        $employee = $company->employees()->create($validated);

        return new EmployeeResource($employee);
    }
}
