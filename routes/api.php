<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;


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
    Route::get('/profile', [UserController::class, 'user']);
    Route::post('/time', [UserController::class, 'time']);
    Route::post('/comment', [UserController::class, 'comment']);
});

/* tests */
Route::get('/profile2', [UserController::class, 'user2']);

