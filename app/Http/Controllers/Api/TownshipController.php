<?php

namespace App\Http\Controllers\Api;

use App\Models\Township;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\TownshipResource;
use App\Http\Resources\TownshipCollection;
use App\Http\Requests\TownshipStoreRequest;
use App\Http\Requests\TownshipUpdateRequest;

class TownshipController extends Controller
{
    public function index(Request $request): TownshipCollection
    {
        $this->authorize('view-any', Township::class);

        $search = $request->get('search', '');

        $townships = Township::search($search)
            ->latest()
            ->paginate();

        return new TownshipCollection($townships);
    }

    public function store(TownshipStoreRequest $request): TownshipResource
    {
        $this->authorize('create', Township::class);

        $validated = $request->validated();

        $township = Township::create($validated);

        return new TownshipResource($township);
    }

    public function show(Request $request, Township $township): TownshipResource
    {
        $this->authorize('view', $township);

        return new TownshipResource($township);
    }

    public function update(
        TownshipUpdateRequest $request,
        Township $township
    ): TownshipResource {
        $this->authorize('update', $township);

        $validated = $request->validated();

        $township->update($validated);

        return new TownshipResource($township);
    }

    public function destroy(Request $request, Township $township): Response
    {
        $this->authorize('delete', $township);

        $township->delete();

        return response()->noContent();
    }
}
