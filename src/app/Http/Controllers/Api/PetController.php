<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePetRequest;
use App\Http\Requests\UpdatePetRequest;
use App\Http\Resources\PetResource;
use App\Models\Pet;
use App\Services\PetService;
use Illuminate\Http\Request;

class PetController extends Controller
{
    public function __construct(private PetService $service)
    {
        $this->authorizeResource(Pet::class, 'pet');
    }

    public function index(Request $request)
    {
        return PetResource::collection($this->service->list($request->all()));
    }

    public function show(Pet $pet)
    {
        return new PetResource($pet);
    }

    public function store(StorePetRequest $request)
    {
        $pet = $this->service->create($request->validated());
        return new PetResource($pet);
    }

    public function update(UpdatePetRequest $request, Pet $pet)
    {
        return new PetResource($this->service->update($pet, $request->validated()));
    }

    public function destroy(Pet $pet)
    {
        $this->service->delete($pet);
        return response()->noContent();
    }
}
