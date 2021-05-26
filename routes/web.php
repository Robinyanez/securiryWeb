<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\ZoneController;
use App\Http\Controllers\PuestoController;
use App\Http\Controllers\CargoController;

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

Route::middleware(['auth'])->prefix('/admin')->name('admin.')->group(function(){
/* Route::prefix('/admin')->name('admin.')->group(function(){ */
    /* Index */
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    /* Reports */
    Route::get('/report/timeVigilant', [ReportController::class, 'timeVigilat'])->name('report.time.vigilant');
    Route::get('/report/timeSupervidor', [ReportController::class, 'timeSupervisor'])->name('report.time.supervisor');
    Route::get('/report/novedad', [ReportController::class, 'novedad'])->name('report.novedad');
    Route::get('/report/consigna', [ReportController::class, 'consigna'])->name('report.consigna');
    Route::get('/report/recomendacion', [ReportController::class, 'recomendacion'])->name('report.recomendacion');
    Route::get('/report/reclamo', [ReportController::class, 'reclamo'])->name('report.reclamo');
    Route::get('/report/denuncia', [ReportController::class, 'denuncia'])->name('report.denuncia');
    Route::get('/report/asalto', [ReportController::class, 'asalto'])->name('report.asalto');
    Route::get('/report/sospechoso', [ReportController::class, 'sospechoso'])->name('report.sospechoso');
    Route::get('/report/herido', [ReportController::class, 'herido'])->name('report.herido');
    Route::get('/report/incendio', [ReportController::class, 'incendio'])->name('report.incendio');
    Route::get('/report/manifestacion', [ReportController::class, 'manifestacion'])->name('report.manifestacion');
    Route::get('/report/ausencia', [ReportController::class, 'ausencia'])->name('report.ausencia');
    Route::get('/report/apoyo', [ReportController::class, 'apoyo'])->name('report.apoyo');
    Route::get('/report/hombre_vivo', [ReportController::class, 'hombreVivo'])->name('report.hombre.vivo');
    /* Inmports data */
    Route::post('/import-client', [ClientController::class, 'importCli'])->name('import.client');
    Route::post('/import-user', [UserController::class, 'importUser'])->name('import.user');
    Route::post('/import-zone', [ZoneController::class, 'importZone'])->name('import.zone');
    Route::post('/import-country', [CountryController::class, 'importCountry'])->name('import.country');
    Route::post('/import-puesto', [PuestoController::class, 'importPuesto'])->name('import.puesto');
    Route::post('/import-cargo', [CargoController::class, 'importCargo'])->name('import.cargo');
    /* Profile */
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::get('/notification', [UserController::class, 'allNotification'])->name('notification');
    Route::post('/markNotification', [UserController::class, 'markNotification'])->name('markNotification');
    /* Cruds */
    Route::resources([
        'user'      => UserController::class,
        'client'    => ClientController::class,
        'zone'      => ZoneController::class,
        'country'   => CountryController::class,
        'puesto'    => PuestoController::class,
        'cargo'    => CargoController::class,
    ]);
});
