<?php

use App\Http\Controllers\V1\AuthenticationController;
use App\Http\Controllers\V1\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(env('APP_ENV') === 'local' ? [] : ['middleware' => 'client'], function () {
    Route::get('/', function () {
        return [
            'name' => "Med Labs API",
            'version' =>  app()->version(),
            'documentation' => '/api/documentation',
            'php_version' => phpversion()
        ];
    });


    Route::group(['prefix' => '/v1', 'namespace' => '\App\Http\Controllers\V1'], function () {
        Route::post('/authenticate/email', [AuthenticationController::class, 'authenticateEmail']);
        Route::post('/sign-up', [AuthenticationController::class, 'signUp']);

        Route::prefix('/users')->group(function () {
            Route::get('/', [UserController::class, 'index']);
            Route::post('/', [UserController::class, 'store']);
            Route::get('/{user_id}', [UserController::class, 'show']);
            Route::patch('/{user_id}', [UserController::class, 'update']);
            Route::delete('/{user_id}', [UserController::class, 'destroy']);
        });
    });
});
