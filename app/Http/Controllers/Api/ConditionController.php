<?php

namespace App\Http\Controllers\Api;

use App\Models\Condition;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\ConditionResource;
use App\Http\Resources\ConditionCollection;
use App\Http\Requests\ConditionStoreRequest;
use App\Http\Requests\ConditionUpdateRequest;

class ConditionController extends Controller
{
    public function index(Request $request): ConditionCollection
    {
        $this->authorize('view-any', Condition::class);

        $search = $request->get('search', '');

        $conditions = Condition::search($search)
            ->latest()
            ->paginate();

        return new ConditionCollection($conditions);
    }

    public function store(ConditionStoreRequest $request): ConditionResource
    {
        $this->authorize('create', Condition::class);

        $validated = $request->validated();

        $condition = Condition::create($validated);

        return new ConditionResource($condition);
    }

    public function show(
        Request $request,
        Condition $condition
    ): ConditionResource {
        $this->authorize('view', $condition);

        return new ConditionResource($condition);
    }

    public function update(
        ConditionUpdateRequest $request,
        Condition $condition
    ): ConditionResource {
        $this->authorize('update', $condition);

        $validated = $request->validated();

        $condition->update($validated);

        return new ConditionResource($condition);
    }

    public function destroy(Request $request, Condition $condition): Response
    {
        $this->authorize('delete', $condition);

        $condition->delete();

        return response()->noContent();
    }
}
