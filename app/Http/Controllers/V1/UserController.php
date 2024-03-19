<?php

namespace App\Http\Controllers\V1;

use Illuminate\Http\Response;
use OpenApi\Attributes as OA;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserPostRequest;
use App\Http\Requests\User\UserPatchRequest;
use App\Repositories\User\UserRepositoryImplement;

class UserController extends Controller
{
    private $repository;

    public function __construct(UserRepositoryImplement $userRepository)
    {
        $this->repository = $userRepository;
    }

    #[OA\Get(
        path: "/api/v1/users",
        summary: "Display all Users",
        security: [
            [
                'bearerAuth' => []
            ]
        ],
        tags: ["User"],
        responses: [
            new OA\Response(
                response: Response::HTTP_OK,
                description: "Successful",
                content: new OA\JsonContent(ref: "#/components/schemas/Users")
            ),
            new OA\Response(
                response: Response::HTTP_UNAUTHORIZED,
                description: "Unauthenticated",
                content: new OA\JsonContent(ref: "#/components/schemas/Unauthenticated")
            ),
            new OA\Response(
                response: Response::HTTP_UNPROCESSABLE_ENTITY,
                description: "UnprocessableEntity",
                content: new OA\JsonContent(ref: "#/components/schemas/UnprocessableEntity")
            ),
            new OA\Response(
                response: Response::HTTP_NOT_FOUND,
                description: "Not found",
                content: new OA\JsonContent(ref: "#/components/schemas/NotFound")
            ),
            new OA\Response(
                response: Response::HTTP_INTERNAL_SERVER_ERROR,
                description: "Server error",
                content: new OA\JsonContent(ref: "#/components/schemas/ServerError")
            ),
        ]
    )]

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'users' => $this->repository->all(),
            'meta'  => []
        ], Response::HTTP_OK);
    }

    #[OA\Post(
        path: "/api/v1/users",
        summary: "Create User",
        security: [
            [
                'bearerAuth' => []
            ]
        ],
        tags: ["User"],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(ref: "#/components/schemas/UserPostRequest")
        ),
        responses: [
            new OA\Response(
                response: Response::HTTP_OK,
                description: "Successful",
                content: new OA\JsonContent(ref: "#/components/schemas/User")
            ),
            new OA\Response(
                response: Response::HTTP_UNAUTHORIZED,
                description: "Unauthenticated",
                content: new OA\JsonContent(ref: "#/components/schemas/Unauthenticated")
            ),
            new OA\Response(
                response: Response::HTTP_UNPROCESSABLE_ENTITY,
                description: "UnprocessableEntity",
                content: new OA\JsonContent(ref: "#/components/schemas/UnprocessableEntity")
            ),
            new OA\Response(
                response: Response::HTTP_NOT_FOUND,
                description: "Not found",
                content: new OA\JsonContent(ref: "#/components/schemas/NotFound")
            ),
            new OA\Response(
                response: Response::HTTP_INTERNAL_SERVER_ERROR,
                description: "Server error",
                content: new OA\JsonContent(ref: "#/components/schemas/ServerError")
            ),
        ]
    )]

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserPostRequest $request)
    {
        try {
            return response()->json($this->repository->create($request->all()), Response::HTTP_CREATED);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    #[OA\Get(
        path: "/api/v1/user/{user_id}",
        summary: "Display User",
        security: [
            [
                'bearerAuth' => []
            ]
        ],
        tags: ["User"],
        responses: [
            new OA\Response(
                response: Response::HTTP_OK,
                description: "Successful",
                content: new OA\JsonContent(ref: "#/components/schemas/User")
            ),
            new OA\Response(
                response: Response::HTTP_UNAUTHORIZED,
                description: "Unauthenticated",
                content: new OA\JsonContent(ref: "#/components/schemas/Unauthenticated")
            ),
            new OA\Response(
                response: Response::HTTP_UNPROCESSABLE_ENTITY,
                description: "UnprocessableEntity",
                content: new OA\JsonContent(ref: "#/components/schemas/UnprocessableEntity")
            ),
            new OA\Response(
                response: Response::HTTP_NOT_FOUND,
                description: "Not found",
                content: new OA\JsonContent(ref: "#/components/schemas/NotFound")
            ),
            new OA\Response(
                response: Response::HTTP_INTERNAL_SERVER_ERROR,
                description: "Server error",
                content: new OA\JsonContent(ref: "#/components/schemas/ServerError")
            ),
        ]
    )]

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            return $this->repository->findOrFail($id);
        } catch (\Throwable $th) {
            throw $th;
        }
    }


    #[OA\Patch(
        path: "/api/v1/users",
        summary: "Update User",
        security: [
            [
                'bearerAuth' => []
            ]
        ],
        tags: ["User"],
        // requestBody: new OA\RequestBody(
        //     required: false,
        //     content: new OA\JsonContent(ref: "#/components/schemas/UserPatchRequest")
        // ),
        parameters: [
            new OA\Parameter(name: "name", example: "John Doe", description: "The name of the user", required: false),
            new OA\Parameter(name: "email", example: "john@example.com", description: "Email of the user", required: false),
            new OA\Parameter(name: "password", example: "123456", description: "The name of the User", required: false),
            new OA\Parameter(name: "password_confirmation", example: "123456", description: "The name of the User", required: false)
        ],
        responses: [
            new OA\Response(
                response: Response::HTTP_OK,
                description: "Successful",
                content: new OA\JsonContent(ref: "#/components/schemas/User")
            ),
            new OA\Response(
                response: Response::HTTP_UNAUTHORIZED,
                description: "Unauthenticated",
                content: new OA\JsonContent(ref: "#/components/schemas/Unauthenticated")
            ),
            new OA\Response(
                response: Response::HTTP_UNPROCESSABLE_ENTITY,
                description: "UnprocessableEntity",
                content: new OA\JsonContent(ref: "#/components/schemas/UnprocessableEntity")
            ),
            new OA\Response(
                response: Response::HTTP_NOT_FOUND,
                description: "Not found",
                content: new OA\JsonContent(ref: "#/components/schemas/NotFound")
            ),
            new OA\Response(
                response: Response::HTTP_INTERNAL_SERVER_ERROR,
                description: "Server error",
                content: new OA\JsonContent(ref: "#/components/schemas/ServerError")
            ),
        ]
    )]

    /**
     * Update the specified resource in storage.
     */
    public function update(UserPatchRequest $request, string $id)
    {
        try {
            return $this->repository->update($id, $request->all());
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            return $this->repository->delete($id);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
