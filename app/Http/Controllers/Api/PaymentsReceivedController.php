<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\PaymentsReceived;
use App\Http\Controllers\Controller;
use App\Http\Resources\PaymentsReceivedResource;
use App\Http\Resources\PaymentsReceivedCollection;
use App\Http\Requests\PaymentsReceivedStoreRequest;
use App\Http\Requests\PaymentsReceivedUpdateRequest;

class PaymentsReceivedController extends Controller
{
    public function index(Request $request): PaymentsReceivedCollection
    {
        $this->authorize('view-any', PaymentsReceived::class);

        $search = $request->get('search', '');

        $paymentsReceiveds = PaymentsReceived::search($search)
            ->latest()
            ->paginate();

        return new PaymentsReceivedCollection($paymentsReceiveds);
    }

    public function store(
        PaymentsReceivedStoreRequest $request
    ): PaymentsReceivedResource {
        $this->authorize('create', PaymentsReceived::class);

        $validated = $request->validated();

        $paymentsReceived = PaymentsReceived::create($validated);

        return new PaymentsReceivedResource($paymentsReceived);
    }

    public function show(
        Request $request,
        PaymentsReceived $paymentsReceived
    ): PaymentsReceivedResource {
        $this->authorize('view', $paymentsReceived);

        return new PaymentsReceivedResource($paymentsReceived);
    }

    public function update(
        PaymentsReceivedUpdateRequest $request,
        PaymentsReceived $paymentsReceived
    ): PaymentsReceivedResource {
        $this->authorize('update', $paymentsReceived);

        $validated = $request->validated();

        $paymentsReceived->update($validated);

        return new PaymentsReceivedResource($paymentsReceived);
    }

    public function destroy(
        Request $request,
        PaymentsReceived $paymentsReceived
    ): Response {
        $this->authorize('delete', $paymentsReceived);

        $paymentsReceived->delete();

        return response()->noContent();
    }
}
