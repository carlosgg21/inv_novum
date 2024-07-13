<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Employee;
use App\Models\Currency;
use Illuminate\View\View;
use App\Models\SalesOrder;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\InvoiceStoreRequest;
use App\Http\Requests\InvoiceUpdateRequest;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Invoice::class);

        $search = $request->get('search', '');
$sst =  setting('invoice.start_with_default_value');
$df =  app_default('invoice.invoice_number_start');
dd($sst, $df);
        $invoices = Invoice::search($search)
            ->excludeStatuses(['cancelled', 'closed'])
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.invoices.index', compact('invoices', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Invoice::class);

        $salesOrders = SalesOrder::pluck('number', 'id');
        $employees = Employee::pluck('name', 'id');
        $currencies = Currency::pluck('name', 'id');

        return view(
            'app.invoices.create',
            compact('salesOrders', 'employees', 'currencies')
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(InvoiceStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Invoice::class);

        $validated = $request->validated();

        $invoice = Invoice::create($validated);

        return redirect()
            ->route('invoices.edit', $invoice)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Invoice $invoice): View
    {
        $this->authorize('view', $invoice);

        return view('app.invoices.show', compact('invoice'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Invoice $invoice): View
    {
        $this->authorize('update', $invoice);

        $salesOrders = SalesOrder::pluck('number', 'id');
        $employees = Employee::pluck('name', 'id');
        $currencies = Currency::pluck('name', 'id');

        return view(
            'app.invoices.edit',
            compact('invoice', 'salesOrders', 'employees', 'currencies')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        InvoiceUpdateRequest $request,
        Invoice $invoice
    ): RedirectResponse {
        $this->authorize('update', $invoice);

        $validated = $request->validated();

        $invoice->update($validated);

        return redirect()
            ->route('invoices.edit', $invoice)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Invoice $invoice
    ): RedirectResponse {
        $this->authorize('delete', $invoice);

        $invoice->delete();

        return redirect()
            ->route('invoices.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
