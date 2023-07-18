<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
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
/*
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/
Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [App\Http\Controllers\API\AuthController::class, 'login'])->name('login');
    Route::post('register', [App\Http\Controllers\API\AuthController::class, 'register'])->name('register');

    Route::middleware('auth.jwt')->group(function () {
        Route::post('logout', [App\Http\Controllers\API\AuthController::class, 'logout']);
        Route::post('refresh', [App\Http\Controllers\API\AuthController::class, 'refresh'])->name('refresh');
    });

});
