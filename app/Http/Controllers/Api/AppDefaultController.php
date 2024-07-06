<?php

namespace App\Http\Controllers\Api;

use App\Models\AppDefault;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\AppDefaultResource;
use App\Http\Resources\AppDefaultCollection;
use App\Http\Requests\AppDefaultStoreRequest;
use App\Http\Requests\AppDefaultUpdateRequest;

class AppDefaultController extends Controller
{
    public function index(Request $request): AppDefaultCollection
    {
        $this->authorize('view-any', AppDefault::class);

        $search = $request->get('search', '');

        $appDefaults = AppDefault::search($search)
            ->latest()
            ->paginate();

        return new AppDefaultCollection($appDefaults);
    }

    public function store(AppDefaultStoreRequest $request): AppDefaultResource
    {
        $this->authorize('create', AppDefault::class);

        $validated = $request->validated();

        $appDefault = AppDefault::create($validated);

        return new AppDefaultResource($appDefault);
    }

    public function show(
        Request $request,
        AppDefault $appDefault
    ): AppDefaultResource {
        $this->authorize('view', $appDefault);

        return new AppDefaultResource($appDefault);
    }

    public function update(
        AppDefaultUpdateRequest $request,
        AppDefault $appDefault
    ): AppDefaultResource {
        $this->authorize('update', $appDefault);

        $validated = $request->validated();

        $appDefault->update($validated);

        return new AppDefaultResource($appDefault);
    }

    public function destroy(Request $request, AppDefault $appDefault): Response
    {
        $this->authorize('delete', $appDefault);

        $appDefault->delete();

        return response()->noContent();
    }
}
