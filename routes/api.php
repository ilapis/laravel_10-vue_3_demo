<?php

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

Route::group(['prefix' => 'v1', 'namespace' => '\App\Http\Controllers\API\V1'], function () {

    Route::group(['prefix' => 'auth'], function () {
        Route::post('login', 'AuthController@login')->name('login');
        Route::post('register', 'AuthController@register')->name('register');

        Route::middleware('auth.jwt')->group(function () {
            Route::post('logout', 'AuthController@logout')->name('logout');
            Route::post('refresh', 'AuthController@refresh')->name('refresh');
        });
    });

    Route::get('/language/enabled', 'LanguageController@enabled');

    Route::middleware('auth.jwt')->group(function () {
        Route::resource('language', 'LanguageController')->only([
            'index', 'show', 'store', 'update', 'destroy'
        ]);

        Route::resource('translation', 'TranslationController')->only([
            'index', 'show', 'store', 'update', 'destroy'
        ]);
        //Route::post('/translation', 'TranslationController@store');
        //Route::put('/translation/{translation}', 'TranslationController@update');
        //Route::delete('/translation/{translation}', 'TranslationController@destroy');
    });
});
