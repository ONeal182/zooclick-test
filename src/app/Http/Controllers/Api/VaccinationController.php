<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreVaccinationRequest;
use App\Http\Requests\UpdateVaccinationRequest;
use App\Http\Resources\VaccinationResource;
use App\Models\Vaccination;
use App\Services\VaccinationService;
use Illuminate\Http\Request;

class VaccinationController extends Controller
{
    public function __construct(private VaccinationService $service)
    {
        $this->authorizeResource(Vaccination::class, 'vaccination');
    }

    /**
     * @OA\Get(
     *     path="/api/vaccination",
     *     summary="Get paginated list of vaccinations",
     *     tags={"Vaccination"},
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(name="page", in="query", description="Page number", required=false, @OA\Schema(type="integer", example=1)),
     *     @OA\Parameter(name="per_page", in="query", description="Items per page", required=false, @OA\Schema(type="integer", example=10)),
     *     @OA\Parameter(name="pet_id", in="query", description="Filter by pet ID", required=false, @OA\Schema(type="integer", example=1)),
     *     @OA\Parameter(name="serial_number", in="query", description="Filter by serial number", required=false, @OA\Schema(type="string", example="5YY9D-A8ff")),
     *     @OA\Parameter(name="vaccinated_at", in="query", description="Filter by vaccination date", required=false, @OA\Schema(type="string", format="date", example="2025-09-19")),
     *     @OA\Parameter(name="valid_days", in="query", description="Filter by valid_days", required=false, @OA\Schema(type="integer", example=365)),
     *     @OA\Parameter(name="country", in="query", description="Filter by country", required=false, @OA\Schema(type="string", example="USA")),
     *     @OA\Response(
     *         response=200,
     *         description="Paginated list of vaccinations",
     *         @OA\JsonContent(
     *             @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/Vaccination")),
     *             @OA\Property(property="links", type="object"),
     *             @OA\Property(property="meta", type="object")
     *         )
     *     )
     * )
     */
    public function index(Request $request)
    {
        return VaccinationResource::collection($this->service->list($request->all()));
    }

    /**
     * @OA\Get(
     *     path="/api/vaccination/{id}",
     *     summary="Get vaccination by ID",
     *     tags={"Vaccination"},
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Vaccination found", @OA\JsonContent(ref="#/components/schemas/Vaccination")),
     *     @OA\Response(response=404, description="Vaccination not found"),
     *     @OA\Response(response=401, description="Unauthorized. Bearer token missing or invalid")
     * )
     */
    public function show(Vaccination $vaccination)
    {
        return new VaccinationResource($vaccination);
    }

    /**
     * @OA\Post(
     *     path="/api/vaccination",
     *     summary="Create new vaccination",
     *     tags={"Vaccination"},
     *     security={{"sanctum":{}}},
     *     @OA\RequestBody(required=true, @OA\JsonContent(ref="#/components/schemas/Vaccination")),
     *     @OA\Response(response=201, description="Vaccination created", @OA\JsonContent(ref="#/components/schemas/Vaccination")),
     *     @OA\Response(response=422, description="Validation error"),
     *     @OA\Response(response=401, description="Unauthorized. Bearer token missing or invalid")
     * )
     */
    public function store(StoreVaccinationRequest $request)
    {
        $vaccination = $this->service->create($request->validated());
        return (new VaccinationResource($vaccination))->response()->setStatusCode(201);
    }

    /**
     * @OA\Put(
     *     path="/api/vaccination/{id}",
     *     summary="Update vaccination",
     *     tags={"Vaccination"},
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\RequestBody(@OA\JsonContent(ref="#/components/schemas/Vaccination")),
     *     @OA\Response(response=200, description="Vaccination updated", @OA\JsonContent(ref="#/components/schemas/Vaccination")),
     *     @OA\Response(response=404, description="Vaccination not found"),
     *     @OA\Response(response=401, description="Unauthorized. Bearer token missing or invalid")
     * )
     */
    public function update(UpdateVaccinationRequest $request, Vaccination $vaccination)
    {
        return new VaccinationResource(
            $this->service->update($vaccination, $request->validated())
        );
    }

    /**
     * @OA\Delete(
     *     path="/api/vaccination/{id}",
     *     summary="Delete vaccination",
     *     tags={"Vaccination"},
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=204, description="Vaccination deleted"),
     *     @OA\Response(response=404, description="Vaccination not found"),
     *     @OA\Response(response=401, description="Unauthorized. Bearer token missing or invalid")
     * )
     */
    public function destroy(Vaccination $vaccination)
    {
        $this->service->delete($vaccination);
        return response()->noContent();
    }
}
