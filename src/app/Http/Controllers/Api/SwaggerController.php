<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

/**
 * @OA\Info(
 *     title="ZooClick API",
 *     version="1.0.0",
 *     description="API documentation for Pet and Vaccination management"
 * )
 *
 * @OA\Server(
 *     url=L5_SWAGGER_CONST_HOST,
 *     description="Server"
 * )
 *
 * @OA\SecurityScheme(
 *     securityScheme="sanctum",
 *     type="http",
 *     scheme="bearer",
 *     bearerFormat="JWT",
 *     description="Введите только сам токен (например: 3|xxxx...). Swagger автоматически добавит 'Bearer '"
 * )
 */
class SwaggerController extends Controller
{
    
}
