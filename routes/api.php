<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ReportController;;


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

/* Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
}); */

Route::group(['prefix' => 'auth'], function () {
    Route::post('/login', [AuthController::class, 'login']);

    Route::group(['middleware' => 'auth:api'], function() {
        Route::get('/logout', [AuthController::class, 'logout']);
    });
});

Route::group(['prefix' => 'user', 'middleware' => 'auth:api'], function () {
    Route::get('/profile', [UserController::class, 'profile']);
    Route::get('/puesto', [UserController::class, 'puesto']);
    Route::get('/zone/{id}', [UserController::class, 'zone']);
    Route::post('/time', [UserController::class, 'time']);
    Route::post('/comment', [UserController::class, 'comment']);
    Route::post('/apoyo', [UserController::class, 'apoyo']);
    Route::get('/report/novedad', [ReportController::class, 'novedad']);
    Route::get('/report/novedad/detail/{id}', [ReportController::class, 'novedadDetail']);
    Route::get('/report/consigna', [ReportController::class, 'consigna']);
    Route::get('/report/consigna/detail/{id}', [ReportController::class, 'consignaDetail']);
    Route::get('/report/apoyo', [ReportController::class, 'apoyo']);
    Route::get('/report/apoyo/detail/{id}', [ReportController::class, 'apoyoDetail']);
    Route::get('/report/commet/images/{id}', [ReportController::class, 'imagesCommet']);
    Route::get('/report/apoyo/images/{id}', [ReportController::class, 'imagesApoyo']);
    Route::get('/report/images/all', [ReportController::class, 'imagesAll']);

});

/* tests */
Route::get('/profile2', [UserController::class, 'user2']);
Route::get('/report/novedad2', [ReportController::class, 'novedad2']);
    Route::get('/report/condigna2', [ReportController::class, 'consigna2']);

