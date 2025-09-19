<?php

namespace App\Swagger\Schemas;

/**
 * @OA\Schema(
 *     schema="Vaccination",
 *     type="object",
 *     title="Vaccination",
 *     description="Vaccination resource",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="pet_id", type="integer", example=1),
 *     @OA\Property(property="serial_number", type="string", example="5YY9D-A8ff"),
 *     @OA\Property(property="country", type="string", example="USA"),
 *     @OA\Property(property="vaccinated_at", type="string", format="date", example="2025-09-19"),
 *     @OA\Property(property="valid_days", type="integer", example=365),
 *     @OA\Property(property="created_at", type="string", format="date-time"),
 *     @OA\Property(property="updated_at", type="string", format="date-time")
 * )
 */
class Vaccination {}
