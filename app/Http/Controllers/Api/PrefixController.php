<?php

namespace App\Http\Controllers\Api;

use App\Models\Prefix;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\PrefixResource;
use App\Http\Resources\PrefixCollection;
use App\Http\Requests\PrefixStoreRequest;
use App\Http\Requests\PrefixUpdateRequest;

class PrefixController extends Controller
{
    public function index(Request $request): PrefixCollection
    {
        $this->authorize('view-any', Prefix::class);

        $search = $request->get('search', '');

        $prefixes = Prefix::search($search)
            ->latest()
            ->paginate();

        return new PrefixCollection($prefixes);
    }

    public function store(PrefixStoreRequest $request): PrefixResource
    {
        $this->authorize('create', Prefix::class);

        $validated = $request->validated();

        $prefix = Prefix::create($validated);

        return new PrefixResource($prefix);
    }

    public function show(Request $request, Prefix $prefix): PrefixResource
    {
        $this->authorize('view', $prefix);

        return new PrefixResource($prefix);
    }

    public function update(
        PrefixUpdateRequest $request,
        Prefix $prefix
    ): PrefixResource {
        $this->authorize('update', $prefix);

        $validated = $request->validated();

        $prefix->update($validated);

        return new PrefixResource($prefix);
    }

    public function destroy(Request $request, Prefix $prefix): Response
    {
        $this->authorize('delete', $prefix);

        $prefix->delete();

        return response()->noContent();
    }
}
