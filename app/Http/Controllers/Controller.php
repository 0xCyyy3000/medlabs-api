<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use OpenApi\Attributes as OA;

#[
    OA\Info(
        version: "1.0",
        description: "This is the documentation for the API",
        title: "Med Labs API Documentation",
    ),

    OA\Server(url: "", description: "This is the documentation for the API"),
    OA\SecurityScheme(securityScheme: 'bearerAuth', type: "http", name: "Authorization", in: "header", scheme: "bearer"),
]

#[OA\Schema(
    schema: "BadRequest",
    properties: [
        new OA\Property(property: 'message', type: 'string', example: "Bad Request"),
        new OA\Property(property: 'type', type: 'string', example: "BadRequestHttpException"),
        new OA\Property(property: 'status', type: 'integer', example: 401),
    ]
)]


#[OA\Schema(
    schema: "Unauthenticated",
    properties: [
        new OA\Property(property: 'message', type: 'string', example: "Unauthenticated"),
        new OA\Property(property: 'type', type: 'string', example: "AuthenticationException"),
        new OA\Property(property: 'status', type: 'integer', example: 401),
    ]
)]

#[OA\Schema(
    schema: "NotFound",
    properties: [
        new OA\Property(property: 'message', type: 'string', example: "Not Found"),
        new OA\Property(property: 'type', type: 'string', example: "NotFoundHttpException"),
        new OA\Property(property: 'status', type: 'integer', example: 404),
    ]
)]

#[OA\Schema(
    schema: "UnprocessableEntity",
    properties: [
        new OA\Property(property: 'message', type: 'string', example: "Unprocessable Content"),
        new OA\Property(property: 'type', type: 'string', example: "UnprocessableEntityException"),
        new OA\Property(property: 'status', type: 'integer', example: 422),
    ]
)]

#[OA\Schema(
    schema: "ServerError",
    properties: [
        new OA\Property(property: 'message', type: 'string', example: "Internal Server Error"),
        new OA\Property(property: 'type', type: 'string', example: "ErrorException"),
        new OA\Property(property: 'status', type: 'integer', example: 500),
    ]
)]
class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}
