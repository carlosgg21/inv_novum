<?php

namespace App\Http\Controllers\Api;

use App\Models\PaymentMade;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\PaymentMadeResource;
use App\Http\Resources\PaymentMadeCollection;
use App\Http\Requests\PaymentMadeStoreRequest;
use App\Http\Requests\PaymentMadeUpdateRequest;

class PaymentMadeController extends Controller
{
    public function index(Request $request): PaymentMadeCollection
    {
        $this->authorize('view-any', PaymentMade::class);

        $search = $request->get('search', '');

        $paymentMades = PaymentMade::search($search)
            ->latest()
            ->paginate();

        return new PaymentMadeCollection($paymentMades);
    }

    public function store(PaymentMadeStoreRequest $request): PaymentMadeResource
    {
        $this->authorize('create', PaymentMade::class);

        $validated = $request->validated();

        $paymentMade = PaymentMade::create($validated);

        return new PaymentMadeResource($paymentMade);
    }

    public function show(
        Request $request,
        PaymentMade $paymentMade
    ): PaymentMadeResource {
        $this->authorize('view', $paymentMade);

        return new PaymentMadeResource($paymentMade);
    }

    public function update(
        PaymentMadeUpdateRequest $request,
        PaymentMade $paymentMade
    ): PaymentMadeResource {
        $this->authorize('update', $paymentMade);

        $validated = $request->validated();

        $paymentMade->update($validated);

        return new PaymentMadeResource($paymentMade);
    }

    public function destroy(
        Request $request,
        PaymentMade $paymentMade
    ): Response {
        $this->authorize('delete', $paymentMade);

        $paymentMade->delete();

        return response()->noContent();
    }
}
