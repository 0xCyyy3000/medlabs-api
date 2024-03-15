<?php

namespace App\Repositories\User;

use LaravelEasyRepository\Repository;
use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "Users",
    properties: [
        new OA\Property(
            property: "users",
            type: "array",
            items: new OA\Items(
                type: "object",
                properties: [
                    new OA\Property(property: 'id', type: 'integer', example: 1),
                    new OA\Property(property: 'name', type: 'string', example: 'John Doe'),
                    new OA\Property(property: 'email', type: 'string', example: 'john@example.com'),
                    new OA\Property(property: 'created_at', type: 'datetime', example: '2022-08-27T16:14:46.000000Z'),
                ],
            ),
        ),
        new OA\Property(
            property: "metadata",
            type: "object",
            properties: [
                new OA\Property(property: 'count', type: 'integer', example: 1),
                new OA\Property(property: 'offset', type: 'integer', example: 0),
                new OA\Property(property: 'limit', type: 'string', example: 20),
                new OA\Property(property: 'sort', type: 'array', example: ['+id'], items: new OA\Items()),
            ]
        )
    ]
)]


#[OA\Schema(
    schema: "User",
    properties: [
        new OA\Property(property: 'id', type: 'integer', example: 1),
        new OA\Property(property: 'name', type: 'string', example: 'John Doe'),
        new OA\Property(property: 'email', type: 'string', example: 'john@example.com'),
        new OA\Property(property: 'created_at', type: 'datetime', example: '2022-08-27T16:14:46.000000Z'),
    ]
)]

interface UserRepository extends Repository
{

    // Write something awesome :)
}
