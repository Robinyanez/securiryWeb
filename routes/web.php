<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ReportController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* Route::get('/', function () {
    return view('welcome');
}); */

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::group(['prefix' => 'admin', 'middleware' => 'auth', 'admin'], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/report/vigilant', [HomeController::class, 'reportVigilat'])->name('report.vigilant');
    Route::get('/report/supervidor', [HomeController::class, 'reportSupervisor'])->name('report.supervisor');
});

Route::prefix('/admin')->name('admin.')->middleware('auth')->group(function(){
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/report/vigilant', [ReportController::class, 'indexVigilat'])->name('report.vigilant');
    Route::get('/report/supervidor', [ReportController::class, 'indexSupervisor'])->name('report.supervisor');
    Route::get('/report/client', [ReportController::class, 'indexSupervisor'])->name('report.client');

    Route::resources([
        'user' => UserController::class,
        'client' => ClientController::class,
    ]);
});



/* Route::prefix('/admin')->name('admin.')->group(function(){
}); */
