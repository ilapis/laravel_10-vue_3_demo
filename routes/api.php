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
Route::middleware('locale')->group(function () {
    Route::group(['prefix' => 'v1', 'namespace' => '\App\Http\Controllers\API\V1'], function () {

        Route::group(['prefix' => 'auth'], function () {
            Route::post('login', 'AuthController@login')->name('login');
            Route::post('register', 'AuthController@register')->name('register');

            Route::middleware('auth.jwt')->group(function () {
                Route::post('logout', 'AuthController@logout')->name('logout');
                Route::post('refresh', 'AuthController@refresh')->name('refresh');
            });
        });

        Route::get('language/enabled', 'LanguageController@enabled');
        Route::get('translation/locale/{language_code}', 'TranslationController@locale')->name('language_locale_list');

        Route::middleware(['auth:sanctum', 'precognitive'])->group(function () {

            Route::get('language/all', 'LanguageController@all');
            Route::resource('language', 'LanguageController')->only([
                'index', 'show', 'store', 'update', 'destroy',
            ]);

            Route::resource('translation', 'TranslationController')->only([
                'index', 'show', 'store', 'update', 'destroy',
            ]);

            Route::get('user/enabled', [App\Http\Controllers\API\V1\UserController::class, 'enabled']);
            Route::resource('user', 'UserController')->only([
                'index', 'show', 'store', 'update', 'destroy',
            ]);

            Route::resource('abilities', 'AbilityController')->only([
                'index',
            ]);

            Route::resource('article', 'ArticleController')->only([
                'index', 'show', 'store', 'update', 'destroy',
            ]);
        });
    });
});
