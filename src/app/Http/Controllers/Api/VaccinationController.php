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

    public function index(Request $request)
    {
        return VaccinationResource::collection($this->service->list($request->all()));
    }

    public function show(Vaccination $vaccination)
    {
        return new VaccinationResource($vaccination);
    }

    public function store(StoreVaccinationRequest $request)
    {
        $vaccination = $this->service->create($request->validated());
        return new VaccinationResource($vaccination);
    }

    public function update(UpdateVaccinationRequest $request, Vaccination $vaccination)
    {
        return new VaccinationResource($this->service->update($vaccination, $request->validated()));
    }

    public function destroy(Vaccination $vaccination)
    {
        $this->service->delete($vaccination);
        return response()->noContent();
    }
}
