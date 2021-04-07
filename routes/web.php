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

/* Route::group(['prefix' => 'admin', 'middleware' => 'auth', 'admin'], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/report/vigilant', [HomeController::class, 'reportVigilat'])->name('report.vigilant');
    Route::get('/report/supervidor', [HomeController::class, 'reportSupervisor'])->name('report.supervisor');
}); */

Route::prefix('/admin')->name('admin.')->middleware('auth')->group(function(){
    /* Index */
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    /* Reports */
    Route::get('/report/timeVigilant', [ReportController::class, 'timeVigilat'])->name('report.time.vigilant');
    Route::get('/report/timeSupervidor', [ReportController::class, 'timeSupervisor'])->name('report.time.supervisor');
    Route::get('/report/novedad', [ReportController::class, 'novedad'])->name('report.novedad');
    Route::get('/report/consgina', [ReportController::class, 'consgina'])->name('report.consgina');
    /* Inmports data */
    Route::post('/import-client', [ClientController::class, 'importCli'])->name('import.client');
    Route::post('/import-user', [UserController::class, 'importUser'])->name('import.user');
    /* Cruds */
    Route::resources([
        'user' => UserController::class,
        'client' => ClientController::class,
    ]);
});



/* Route::prefix('/admin')->name('admin.')->group(function(){
}); */
