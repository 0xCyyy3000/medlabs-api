<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/hello-world', function () {
    return response()->json([
        'message' => "Hello world!",
    ]);
});


Route::get('/', function () {
    return [
        'name' => "Med Labs API",
        'version' =>  app()->version(),
        'documentation' => '/api/documentation',
        'php_version' => phpversion()
    ];
});
