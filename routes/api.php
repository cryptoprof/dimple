<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Public routes
Route::post('/login', [App\Http\Controllers\AuthController::class,'login']);
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/logout', [App\Http\Controllers\AuthController::class,'logout']);
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

});
Route::group(['prefix' => '/v1', 'namespace' => 'App\Http\Controllers\Api\V1', 'as' => 'api.'], function () {
    Route::group(['middleware' => ['auth:sanctum','role:admin']], function () {
        Route::resource('users', 'UsersController');
    });
    Route::group(['middleware' => ['auth:sanctum']], function () {
        Route::resource('projects', 'projectsController');
    });
});
