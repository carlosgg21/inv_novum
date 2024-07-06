<?php

namespace App\Http\Controllers\Api;

use App\Models\Charge;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\ChargeResource;
use App\Http\Resources\ChargeCollection;
use App\Http\Requests\ChargeStoreRequest;
use App\Http\Requests\ChargeUpdateRequest;

class ChargeController extends Controller
{
    public function index(Request $request): ChargeCollection
    {
        $this->authorize('view-any', Charge::class);

        $search = $request->get('search', '');

        $charges = Charge::search($search)
            ->latest()
            ->paginate();

        return new ChargeCollection($charges);
    }

    public function store(ChargeStoreRequest $request): ChargeResource
    {
        $this->authorize('create', Charge::class);

        $validated = $request->validated();

        $charge = Charge::create($validated);

        return new ChargeResource($charge);
    }

    public function show(Request $request, Charge $charge): ChargeResource
    {
        $this->authorize('view', $charge);

        return new ChargeResource($charge);
    }

    public function update(
        ChargeUpdateRequest $request,
        Charge $charge
    ): ChargeResource {
        $this->authorize('update', $charge);

        $validated = $request->validated();

        $charge->update($validated);

        return new ChargeResource($charge);
    }

    public function destroy(Request $request, Charge $charge): Response
    {
        $this->authorize('delete', $charge);

        $charge->delete();

        return response()->noContent();
    }
}
