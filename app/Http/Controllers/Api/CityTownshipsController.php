<?php

namespace App\Http\Controllers\Api;

use App\Models\City;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\TownshipResource;
use App\Http\Resources\TownshipCollection;

class CityTownshipsController extends Controller
{
    public function index(Request $request, City $city): TownshipCollection
    {
        $this->authorize('view', $city);

        $search = $request->get('search', '');

        $townships = $city
            ->townships()
            ->search($search)
            ->latest()
            ->paginate();

        return new TownshipCollection($townships);
    }

    public function store(Request $request, City $city): TownshipResource
    {
        $this->authorize('create', Township::class);

        $validated = $request->validate([
            'code' => ['nullable', 'max:255', 'string'],
            'name' => ['required', 'max:255', 'string'],
            'zip_code' => ['nullable', 'max:255', 'string'],
        ]);

        $township = $city->townships()->create($validated);

        return new TownshipResource($township);
    }
}
