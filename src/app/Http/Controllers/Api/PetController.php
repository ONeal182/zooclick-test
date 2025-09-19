<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PetResource;
use App\Models\Pet;
use App\Services\PetService;
use Illuminate\Http\Request;

class PetController extends Controller
{
    public function __construct(private PetService $service) {}

    public function index(Request $request)
    {
        return PetResource::collection($this->service->list($request->all()));
    }

    public function show(int $id)
    {
        return new PetResource($this->service->show($id));
    }

    public function store(Request $request)
    {
        $pet = $this->service->create($request->all());
        return new PetResource($pet);
    }

    public function update(Request $request, Pet $pet)
    {
        return new PetResource($this->service->update($pet, $request->all()));
    }

    public function destroy(Pet $pet)
    {
        $this->service->delete($pet);
        return response()->noContent();
    }
}
