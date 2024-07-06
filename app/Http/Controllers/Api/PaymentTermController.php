<?php

namespace App\Http\Controllers\Api;

use App\Models\PaymentTerm;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\PaymentTermResource;
use App\Http\Resources\PaymentTermCollection;
use App\Http\Requests\PaymentTermStoreRequest;
use App\Http\Requests\PaymentTermUpdateRequest;

class PaymentTermController extends Controller
{
    public function index(Request $request): PaymentTermCollection
    {
        $this->authorize('view-any', PaymentTerm::class);

        $search = $request->get('search', '');

        $paymentTerms = PaymentTerm::search($search)
            ->latest()
            ->paginate();

        return new PaymentTermCollection($paymentTerms);
    }

    public function store(PaymentTermStoreRequest $request): PaymentTermResource
    {
        $this->authorize('create', PaymentTerm::class);

        $validated = $request->validated();

        $paymentTerm = PaymentTerm::create($validated);

        return new PaymentTermResource($paymentTerm);
    }

    public function show(
        Request $request,
        PaymentTerm $paymentTerm
    ): PaymentTermResource {
        $this->authorize('view', $paymentTerm);

        return new PaymentTermResource($paymentTerm);
    }

    public function update(
        PaymentTermUpdateRequest $request,
        PaymentTerm $paymentTerm
    ): PaymentTermResource {
        $this->authorize('update', $paymentTerm);

        $validated = $request->validated();

        $paymentTerm->update($validated);

        return new PaymentTermResource($paymentTerm);
    }

    public function destroy(
        Request $request,
        PaymentTerm $paymentTerm
    ): Response {
        $this->authorize('delete', $paymentTerm);

        $paymentTerm->delete();

        return response()->noContent();
    }
}
