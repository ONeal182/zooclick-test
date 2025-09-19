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

    /**
     * @OA\Get(
     *     path="/api/pet",
     *     summary="Get paginated list of pets",
     *     tags={"Pet"},
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(name="page", in="query", description="Page number", required=false, @OA\Schema(type="integer", example=1)),
     *     @OA\Parameter(name="per_page", in="query", description="Items per page", required=false, @OA\Schema(type="integer", example=10)),
     *     @OA\Parameter(name="name", in="query", description="Filter by pet name", required=false, @OA\Schema(type="string", example="Lucky")),
     *     @OA\Parameter(name="type", in="query", description="Filter by pet type", required=false, @OA\Schema(type="string", example="dog")),
     *     @OA\Response(
     *         response=200,
     *         description="Paginated list of pets",
     *         @OA\JsonContent(
     *             @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/Pet")),
     *             @OA\Property(property="links", type="object"),
     *             @OA\Property(property="meta", type="object")
     *         )
     *     )
     * )
     */
    public function index(Request $request)
    {
        return PetResource::collection($this->service->list($request->all()));
    }

    /**
     * @OA\Get(
     *     path="/api/pet/{id}",
     *     summary="Get pet by ID",
     *     tags={"Pet"},
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Pet found", @OA\JsonContent(ref="#/components/schemas/Pet")),
     *     @OA\Response(response=401, description="Unauthorized. Bearer token missing or invalid"),
     *     @OA\Response(response=404, description="Pet not found")
     * )
     */
    public function show(Pet $pet)
    {
        return new PetResource($pet);
    }

    /**
     * @OA\Post(
     *     path="/api/pet",
     *     summary="Create new pet",
     *     tags={"Pet"},
     *     security={{"sanctum":{}}},
     *     @OA\RequestBody(required=true, @OA\JsonContent(ref="#/components/schemas/Pet")),
     *     @OA\Response(response=201, description="Pet created", @OA\JsonContent(ref="#/components/schemas/Pet")),
     *     @OA\Response(response=422, description="Validation error"),
     *     @OA\Response(response=401, description="Unauthorized. Bearer token missing or invalid")
     * )
     */
    public function store(StorePetRequest $request)
    {
        $pet = $this->service->create($request->validated());
        return (new PetResource($pet))->response()->setStatusCode(201);
    }

    /**
     * @OA\Put(
     *     path="/api/pet/{id}",
     *     summary="Update pet",
     *     tags={"Pet"},
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\RequestBody(@OA\JsonContent(ref="#/components/schemas/Pet")),
     *     @OA\Response(response=200, description="Pet updated", @OA\JsonContent(ref="#/components/schemas/Pet")),
     *     @OA\Response(response=404, description="Pet not found"),
     *     @OA\Response(response=401, description="Unauthorized. Bearer token missing or invalid")
     * )
     */
    public function update(UpdatePetRequest $request, Pet $pet)
    {
        return new PetResource($this->service->update($pet, $request->validated()));
    }

    /**
     * @OA\Delete(
     *     path="/api/pet/{id}",
     *     summary="Delete pet",
     *     tags={"Pet"},
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=204, description="Pet deleted"),
     *     @OA\Response(response=404, description="Pet not found"),
     *     @OA\Response(response=401, description="Unauthorized. Bearer token missing or invalid")
     * )
     */
    public function destroy(Pet $pet)
    {
        $this->service->delete($pet);
        return response()->noContent();
    }
}
