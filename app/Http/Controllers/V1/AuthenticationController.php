<?php

namespace App\Http\Controllers\V1;

use Illuminate\Http\Response;
use OpenApi\Attributes as OA;
use App\Http\Controllers\Controller;
use App\Services\Authentication\AuthenticationServiceImplement;
use App\Http\Requests\Authentication\AuthenticateEmailPostRequest;
use App\Http\Requests\Authentication\AuthenticateSignUpPostRequest;

class AuthenticationController extends Controller
{
    private $authenticationService;
    public function __construct(AuthenticationServiceImplement $authenticationService)
    {
        $this->authenticationService = $authenticationService;
    }


    #[OA\Post(
        path: "/api/v1/authenticate/email",
        summary: "Authenticate email",
        security: [
            [
                'bearerAuth' => []
            ]
        ],
        tags: ["Authentication"],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(ref: "#/components/schemas/SignIn")
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

    public function authenticateEmail(AuthenticateEmailPostRequest $request)
    {
        $payload = $request->all();
        $account = $this->authenticationService->authenticateEmail($payload);

        return response()->json($account);
    }

    #[OA\Post(
        path: "/api/v1/sign-up",
        summary: "Register to the app",
        security: [
            [
                'bearerAuth' => []
            ]
        ],
        tags: ["Authentication"],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(ref: "#/components/schemas/SignUp")
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

    public function signUp(AuthenticateSignUpPostRequest $request)
    {
        $payload = $request->all();
        $account = $this->authenticationService->signUp($payload);

        return response()->json($account, Response::HTTP_CREATED);
    }
}
