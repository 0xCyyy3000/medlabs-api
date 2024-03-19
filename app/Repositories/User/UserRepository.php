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
                    new OA\Property(property: 'firstname', type: 'string', example: 'John'),
                    new OA\Property(property: 'lastname', type: 'string', example: 'Doe'),
                    new OA\Property(property: 'email', type: 'string', example: 'john@example.com'),
                    new OA\Property(property: 'status', type: 'string', example: 'ACTIVE'),
                    new OA\Property(property: 'role', type: 'string', example: 'TENANT'),
                    new OA\Property(property: 'owner_id', type: 'integer', example: null),
                    new OA\Property(property: 'phone', type: 'string', example: "123-456-6789"),
                    new OA\Property(property: 'country', type: 'string', example: "Philippines"),
                    new OA\Property(property: 'state', type: 'string', example: "Leyte"),
                    new OA\Property(property: 'city', type: 'string', example: "Tacloban City"),
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
        new OA\Property(property: 'firstname', type: 'string', example: 'John'),
        new OA\Property(property: 'lastname', type: 'string', example: 'Doe'),
        new OA\Property(property: 'email', type: 'string', example: 'john@example.com'),
        new OA\Property(property: 'status', type: 'string', example: 'ACTIVE'),
        new OA\Property(property: 'role', type: 'string', example: 'TENANT'),
        new OA\Property(property: 'owner_id', type: 'integer', example: null),
        new OA\Property(property: 'phone', type: 'string', example: "123-456-6789"),
        new OA\Property(property: 'country', type: 'string', example: "Philippines"),
        new OA\Property(property: 'state', type: 'string', example: "Leyte"),
        new OA\Property(property: 'city', type: 'string', example: "Tacloban City"),
        new OA\Property(property: 'created_at', type: 'datetime', example: '2022-08-27T16:14:46.000000Z'),
    ]
)]

interface UserRepository extends Repository
{

    // Write something awesome :)
}
