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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('comercial.home');
});

Route::get('/quienesSomos', [App\Http\Controllers\comercial\comercialController::class, 'indexQuienesSomos'])->name('quienesSomos.index');



Route::group(['middleware' => 'auth'], function () {

    // Route::get('/usuarios/export', [App\Http\Controllers\UserController::class, 'export'])->name('users.export');
    // Route::get('/asistencia/export', [App\Http\Controllers\asistenciaController::class, 'export'])->name('asistencia.export');
    // Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

});
