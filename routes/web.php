<?php

use App\Http\Controllers\RouteController;
use App\Http\Controllers\VehicleController;
use Illuminate\Support\Facades\Route;
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

Route::get('/', [RouteController::class, 'index']);

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/dashboard', [RouteController::class, 'dashboard'])->name('dashboard');
    Route::get('/cotizador', [RouteController::class, 'cotizador'])->name('cotizador');
    //Route::get('/informacion-vehiculos', [RouteController::class, 'informacion_vehiculos'])->name('info-vehiculos');
    // Route::get('/vehiculos', [VehicleController::class, 'index'])->name('vehiculos.get');
    Route::resource('vehiculos', VehicleController::class)->parameters(['vehiculos' => 'id'])->names('vehiculos');
    //Route::get('/vehiculos/filtered/{year}', [VehicleController::class, 'vehiclesFiltered'])->name('vehiculos.filtered');

});
