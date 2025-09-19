<?php

namespace App\Swagger\Schemas;

/**
 * @OA\Schema(
 *     schema="Pet",
 *     type="object",
 *     title="Pet",
 *     description="Pet resource",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="name", type="string", example="Lucky"),
 *     @OA\Property(property="type", type="string", example="dog"),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2025-09-19T12:00:00Z"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2025-09-19T12:00:00Z")
 * )
 */
class Pet {}
