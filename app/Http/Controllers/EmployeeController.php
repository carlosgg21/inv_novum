<?php

namespace App\Http\Controllers;

use App\Models\Charge;
use App\Models\Employee;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\EmployeeStoreRequest;
use App\Http\Requests\EmployeeUpdateRequest;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Employee::class);

        $search = $request->get('search', '');

        $employees = Employee::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.employees.index', compact('employees', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Employee::class);

        $charges = Charge::pluck('name', 'id');

        return view('app.employees.create', compact('charges'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmployeeStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Employee::class);

        $validated = $request->validated();
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('public');
        }

        if ($request->hasFile('qr_code')) {
            $validated['qr_code'] = $request->file('qr_code')->store('public');
        }

        $employee = Employee::create($validated);

        return redirect()
            ->route('employees.edit', $employee)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Employee $employee): View
    {
        $this->authorize('view', $employee);

        return view('app.employees.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Employee $employee): View
    {
        $this->authorize('update', $employee);

        $charges = Charge::pluck('name', 'id');

        return view('app.employees.edit', compact('employee', 'charges'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        EmployeeUpdateRequest $request,
        Employee $employee
    ): RedirectResponse {
        $this->authorize('update', $employee);

        $validated = $request->validated();
        if ($request->hasFile('image')) {
            if ($employee->image) {
                Storage::delete($employee->image);
            }

            $validated['image'] = $request->file('image')->store('public');
        }

        if ($request->hasFile('qr_code')) {
            if ($employee->qr_code) {
                Storage::delete($employee->qr_code);
            }

            $validated['qr_code'] = $request->file('qr_code')->store('public');
        }

        $employee->update($validated);

        return redirect()
            ->route('employees.edit', $employee)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Employee $employee
    ): RedirectResponse {
        $this->authorize('delete', $employee);

        if ($employee->image) {
            Storage::delete($employee->image);
        }

        if ($employee->qr_code) {
            Storage::delete($employee->qr_code);
        }

        $employee->delete();

        return redirect()
            ->route('employees.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
