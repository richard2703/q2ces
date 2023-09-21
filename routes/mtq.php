<?php

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

Route::group(['middleware' => 'auth'], function () {



    // Equipos MTQ    
    Route::get('mtq/inventario/dash', [App\Http\Controllers\inventarioMtqController::class, 'dash'])->name('inventarioMtq.dash');
    Route::resource('mtq/inventario', App\Http\Controllers\inventarioMtqController::class, ['except' => 'index', 'create'])->names([
        // 'index' => 'inventarioMtq.index',
        // 'create' => 'inventarioMtq.create',
        'store' => 'inventarioMtq.store',
        'show' => 'inventarioMtq.show',
        'edit' => 'inventarioMtq.edit',
        'update' => 'inventarioMtq.update',
        'destroy' => 'inventarioMtq.destroy',
    ]);
    Route::get('/mtq/inventario/index/{tipo}', [App\Http\Controllers\inventarioMtqController::class, 'index'])->name('inventarioMtq.index');
    Route::get('/mtq/inventario/create/{tipo}', [App\Http\Controllers\inventarioMtqController::class, 'create'])->name('inventarioMtq.create');


    // Route::resource('mtq', App\Http\Controllers\maquinariaMtqController::class);
    // Route::put('asignacion', [App\Http\Controllers\maquinariaMtqController::class, 'asignacion'])->name('mtq.asignacion');

    // // Crud ServiciosMtq
    // Route::resource('serviciosMtq', App\Http\Controllers\serviciosMtqController::class);
});
