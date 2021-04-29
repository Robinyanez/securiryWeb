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
    Route::post('/time', [UserController::class, 'time']);
    Route::post('/comment', [UserController::class, 'comment']);
    Route::post('/apoyo', [UserController::class, 'apoyo']);
    Route::get('/report/novedad', [ReportController::class, 'novedad']);
    Route::get('/report/consigna', [ReportController::class, 'consigna']);

});

/* tests */
Route::get('/profile2', [UserController::class, 'user2']);
Route::get('/report/novedad2', [ReportController::class, 'novedad2']);
    Route::get('/report/condigna2', [ReportController::class, 'consigna2']);

