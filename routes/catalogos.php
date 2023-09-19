<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes Catalogos
|--------------------------------------------------------------------------
|
| Aqui estan todas las Rutas de los diferentes catalogos.
| Todas son creadas con resource para hacer mas comoda la lectura
| 
|
*/

Route::prefix('catalogos')->middleware('auth')->group(function () {

	Route::get('/catalogos/puestos', [App\Http\Controllers\catalogosController::class, 'indexPuestos'])->name('catalogoPuestos.index');
	// Route::get('/catalogos/puestos/nuevo', [App\Http\Controllers\puestoController::class, 'create'])->name('puesto.create');
	// Route::post('/catalogos/puestos', [App\Http\Controllers\puestoController::class, 'store'])->name('puesto.store');
	// Route::put('/catalogos/puestos/{puesto}', [App\Http\Controllers\puestoController::class, 'update'])->name('puesto.update');
	// Route::delete('/catalogos/puestos/{puesto}', [App\Http\Controllers\puestoController::class, 'destroy'])->name('puesto.delete');
	Route::resource('puesto', App\Http\Controllers\puestoController::class);

	Route::get('/catalogos/puestosNivel', [App\Http\Controllers\catalogosController::class, 'indexPuestosNivel'])->name('catalogoPuestosNivel.index');
	// Route::get('/catalogos/puestosNivel/nuevo', [App\Http\Controllers\puestoNivelController::class, 'create'])->name('puestoNivel.create');
	// Route::post('/catalogos/puestosNivel', [App\Http\Controllers\puestoNivelController::class, 'store'])->name('puestoNivel.store');
	// Route::put('/catalogos/puestosNivel/{puesto}', [App\Http\Controllers\puestoNivelController::class, 'update'])->name('puestoNivel.update');
	// Route::delete('/catalogos/puestosNivel/{puesto}', [App\Http\Controllers\puestoNivelController::class, 'destroy'])->name('puestoNivel.delete');
	Route::resource('puestoNivel', App\Http\Controllers\puestoNivelController::class);
});
