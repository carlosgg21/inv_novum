<?php

namespace App\Http\Controllers\Api;

use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\InvoiceResource;
use App\Http\Resources\InvoiceCollection;
use App\Http\Requests\InvoiceStoreRequest;
use App\Http\Requests\InvoiceUpdateRequest;

class InvoiceController extends Controller
{
    public function index(Request $request): InvoiceCollection
    {
        $this->authorize('view-any', Invoice::class);

        $search = $request->get('search', '');

        $invoices = Invoice::search($search)
            ->latest()
            ->paginate();

        return new InvoiceCollection($invoices);
    }

    public function store(InvoiceStoreRequest $request): InvoiceResource
    {
        $this->authorize('create', Invoice::class);

        $validated = $request->validated();

        $invoice = Invoice::create($validated);

        return new InvoiceResource($invoice);
    }

    public function show(Request $request, Invoice $invoice): InvoiceResource
    {
        $this->authorize('view', $invoice);

        return new InvoiceResource($invoice);
    }

    public function update(
        InvoiceUpdateRequest $request,
        Invoice $invoice
    ): InvoiceResource {
        $this->authorize('update', $invoice);

        $validated = $request->validated();

        $invoice->update($validated);

        return new InvoiceResource($invoice);
    }

    public function destroy(Request $request, Invoice $invoice): Response
    {
        $this->authorize('delete', $invoice);

        $invoice->delete();

        return response()->noContent();
    }
}
