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
    return view('equipos.dashboard');
});

Route::get('/verEquipos', function () {
    return view('equipos.verEquipos');
});

Route::get('/altaObra', function () {
    return view('obra.altaObra');
});

Route::get('/vistaObra', function () {
    return view('obra.vistaObra');
});

Route::get('/altaDePersonal', function () {
    return view('personal.altaDePersonal');
});

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
});
