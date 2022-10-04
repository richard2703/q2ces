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

Route::get('/', function () {
    return view('welcome');
});

/* Mis rutas */

Route::get('/dashboard', function () {
    return view('dashboard');
});

// Route::get('/altaDeEquipos', function () {
//     return view('equipos.altaDeEquipos');
// });

// Route::get('/detalleEquipo', function () {
//     return view('equipos.detalleEquipo');
// });

// Route::get('/verEquipos', function () {
//     return view('equipos.verEquipos');
// });

Route::get('/altaDeAccesorios', function () {
    return view('accesorios.altaDeAccesorios');
});

Route::get('/indexAccesorios', function () {
    return view('accesorios.indexAccesorios');
});



// Route::get('/altaObra', function () {
//     return view('obra.altaObra');
// });

// Route::get('/vistaObra', function () {
//     return view('obra.vistaObra');
// });

// Route::get('/altaDePersonal', function () {
//     return view('personal.altaDePersonal');
// });

Route::get('/detalleDePersonal', function () {
    return view('personal.detalleDePersonal');
});




Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/usuarios/nuevo', [App\Http\Controllers\userController::class, 'create'])->name('users.create');
    Route::post('/usuarios', [App\Http\Controllers\UserController::class, 'store'])->name('users.store');
    Route::get('/usuarios', [App\Http\Controllers\UserController::class, 'index'])->name('users.index');
    Route::get('/usuarios/{user}', [App\Http\Controllers\UserController::class, 'show'])->name('users.show');
    Route::get('/users/{user}/edit', [App\Http\Controllers\UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [App\Http\Controllers\UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [App\Http\Controllers\UserController::class, 'destroy'])->name('users.delete');

    Route::resource('permissions', App\Http\Controllers\PermissionController::class);
    Route::resource('roles', App\Http\Controllers\RoleController::class);

    //Crud Obras
    Route::get('/obras/nuevo', [App\Http\Controllers\obrasController::class, 'create'])->name('obras.create');
    Route::post('/obras', [App\Http\Controllers\obrasController::class, 'store'])->name('obras.store');
    Route::get('/obras', [App\Http\Controllers\obrasController::class, 'index'])->name('obras.index');
    Route::get('/obras/{obras}', [App\Http\Controllers\obrasController::class, 'show'])->name('obras.show');

    //Crud personal
    Route::get('/personal/nuevo', [App\Http\Controllers\personalController::class, 'create'])->name('personal.create');
    Route::post('/personal', [App\Http\Controllers\personalController::class, 'store'])->name('personal.store');
    Route::get('/personal', [App\Http\Controllers\personalController::class, 'index'])->name('personal.index');
    Route::get('/personal/{personal}', [App\Http\Controllers\personalController::class, 'show'])->name('personal.show');

    //Crud maquinaria
    Route::get('/maquinaria/nuevo', [App\Http\Controllers\maquinariaController::class, 'create'])->name('maquinaria.create');
    Route::post('/maquinaria', [App\Http\Controllers\maquinariaController::class, 'store'])->name('maquinaria.store');
    Route::get('/maquinaria', [App\Http\Controllers\maquinariaController::class, 'index'])->name('maquinaria.index');
    Route::get('/maquinaria/{maquinaria}', [App\Http\Controllers\maquinariaController::class, 'show'])->name('maquinaria.show');
});
