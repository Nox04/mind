<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Api Routes
|--------------------------------------------------------------------------
|
| Here is where you can register Api routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your Api!
|
*/

Route::prefix('auth')->group(function () {
   Route::post('register', 'Api\AuthController@register');
});

Route::middleware('auth:api')->group(function () {
    Route::apiResources([
        'user.diary-entry' => 'Api\DiaryEntryController',
    ]);
});

Route::fallback(function () {
    return response()->json(['message' => 'Not Found.'], 404);
})->name('api.fallback.404');
