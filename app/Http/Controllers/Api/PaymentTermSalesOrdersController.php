<?php

namespace App\Http\Controllers\Api;

use App\Models\PaymentTerm;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\SalesOrderResource;
use App\Http\Resources\SalesOrderCollection;

class PaymentTermSalesOrdersController extends Controller
{
    public function index(
        Request $request,
        PaymentTerm $paymentTerm
    ): SalesOrderCollection {
        $this->authorize('view', $paymentTerm);

        $search = $request->get('search', '');

        $salesOrders = $paymentTerm
            ->salesOrders()
            ->search($search)
            ->latest()
            ->paginate();

        return new SalesOrderCollection($salesOrders);
    }

    public function store(
        Request $request,
        PaymentTerm $paymentTerm
    ): SalesOrderResource {
        $this->authorize('create', SalesOrder::class);

        $validated = $request->validate([
            'number' => ['nullable', 'max:255', 'string'],
            'order_date' => ['required', 'date'],
            'customer_id' => ['nullable', 'exists:customers,id'],
            'status' => ['required', 'in:entered,not entered'],
            'prefix' => ['nullable', 'max:255', 'string'],
            'invoice_date' => ['nullable', 'date'],
            'taxes' => ['nullable', 'numeric'],
            'discount' => ['nullable', 'numeric'],
            'miscellaneous' => ['nullable', 'numeric'],
            'freight' => ['nullable', 'numeric'],
            'order_total' => ['nullable', 'numeric'],
            'sold_by' => ['nullable', 'exists:employees,id'],
            'payment_method_id' => ['nullable', 'exists:payment_methods,id'],
            'notes' => ['nullable', 'max:255', 'string'],
            'internal_notes' => ['nullable', 'max:255', 'string'],
            'approved_by' => ['nullable', 'max:255', 'string'],
        ]);

        $salesOrder = $paymentTerm->salesOrders()->create($validated);

        return new SalesOrderResource($salesOrder);
    }
}
