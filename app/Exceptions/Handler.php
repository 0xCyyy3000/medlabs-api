<?php

namespace App\Exceptions;

use Throwable;
use InvalidArgumentException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    protected function shouldReturnJson($request, Throwable $e): bool
    {
        return parent::shouldReturnJson($request, $e) || $request->is('api/*');
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Throwable               $exception
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Throwable
     */

    public function render($request, Throwable $e)
    {
        $rendered = parent::render($request, $e);

        if (env('APP_DEBUG')) {
            return $rendered;
        }

        $error = [];

        switch (true) {
            case (is_a($e, NotFoundHttpException::class)):
                $error = [
                    'message' => $e->getMessage() ?? "Error",
                    'type'    => 'NotFoundHttpException',
                    'code'    => $rendered->getStatusCode()
                ];
                break;
            case (is_a($e, ModelNotFoundException::class)):
                $error = [
                    'message' => "No resource was found.",
                    'type'    => 'ModelNotFoundException',
                    'code'    => $rendered->getStatusCode()
                ];
                break;
            case (is_a($e, InvalidArgumentException::class)):
                $error = [
                    'message' => $e->getMessage() ?? "Error",
                    'type'    => 'InvalidArgumentException',
                    'code'    => $rendered->getStatusCode()
                ];
                break;
            case (is_a($e, ValidationException::class)):
                $error = [
                    'message' => $e->getMessage() ?? "Error",
                    'type'    => 'ValidationException',
                    'code'    => $rendered->getStatusCode()
                ];
                break;
            case (is_a($e, BadRequestHttpException::class)):
                $error = [
                    'message' => $e->getMessage() ?? "Error",
                    'type'    => 'BadRequestHttpException',
                    'code'    => $rendered->getStatusCode()
                ];
                break;
            case (is_a($e, UnprocessableEntityHttpException::class)):
                $error = [
                    'message' => $e->getMessage() ?? "Error",
                    'type'    => 'UnprocessableEntityHttpException',
                    'code'    => $rendered->getStatusCode()
                ];
                break;
            case (is_a($e, UnauthorizedHttpException::class)):
                $error = [
                    'message' => $e->getMessage() ?? "Error",
                    'type'    => 'UnauthorizedHttpException',
                    'code'    => $rendered->getStatusCode()
                ];
                break;
            case (is_a($e, AuthenticationException::class)):
                $error = [
                    'message' => $e->getMessage() ?? "Error",
                    'type'    => 'AuthenticationException',
                    'code'    => $rendered->getStatusCode()
                ];
                break;
            case (is_a($e, AccessDeniedHttpException::class)):
                $error = [
                    'message' => $e->getMessage() ?? "Error",
                    'type'    => 'AccessDeniedHttpException',
                    'code'    => $rendered->getStatusCode()
                ];
                break;
            default:
                $error =  $error = [
                    'message' => $e->getMessage() ?? "Error",
                    'type'    => 'ErrorException',
                    'code'    => $rendered->getStatusCode()
                ];
        }

        return response()->json(["error" => $error], $rendered->getStatusCode());
    }
}
