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
Route::get('/index', function () {
    return view('inventario.indexInventario');
});

Route::get('/nuevo', function () {
    return view('inventario.inventarioNuevo');
});
Route::get('/modifi', function () {
    return view('inventario.inventarioModifi');
});

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

// Route::get('/altaDeAccesorios', function () {
//     return view('accesorios.altaDeAccesorios');
// });

// Route::get('/indexAccesorios', function () {
//     return view('accesorios.indexAccesorios');
// });


//Inventario
Route::get('/dashInventario', function () {
    return view('inventario.dashInventario');
});
Route::get('/indexInventario', function () {
    return view('inventario.indexInventario');
});

Route::get('/detalleHerramienta', function () {
    return view('inventario.detalleHerramienta');
});

// Route::get('/dashCombustible', function () {
//     return view('inventario.dashCombustible');
// });






// Route::get('/altaObra', function () {
//     return view('obra.altaObra');
// });

// Route::get('/vistaObra', function () {
//     return view('obra.vistaObra');
// });

// Route::get('/altaDePersonal', function () {
//     return view('personal.altaDePersonal');
// });

// Route::get('/detalleDePersonal', function () {
//     return view('personal.detalleDePersonal');
// });

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
    Route::get('/obras/{obras}/edit', [App\Http\Controllers\obrasController::class, 'edit'])->name('obras.edit');
    Route::delete('/obras/{obras}', [App\Http\Controllers\obrasController::class, 'destroy'])->name('obras.delete');
    Route::put('/obras/{obras}', [App\Http\Controllers\obrasController::class, 'update'])->name('obras.update');

    //Crud personal
    Route::get('/personal/nuevo', [App\Http\Controllers\personalController::class, 'create'])->name('personal.create');
    Route::post('/personal', [App\Http\Controllers\personalController::class, 'store'])->name('personal.store');
    Route::get('/personal', [App\Http\Controllers\personalController::class, 'index'])->name('personal.index');
    // Route::get('/personal', [App\Http\Controllers\personalController::class, 'index'])->name('personal.indexPersonal');
    Route::get('/personal/{personal}', [App\Http\Controllers\personalController::class, 'show'])->name('personal.show');
    Route::put('/personal/{personal}', [App\Http\Controllers\personalController::class, 'update'])->name('personal.update');
    Route::get('personal/{id}/{doc}', [App\Http\Controllers\personalController::class, 'download'])->name('personal.download');
    Route::delete('/personal/{personal}', [App\Http\Controllers\UserController::class, 'destroy'])->name('personal.delete');

    //Crud maquinaria
    Route::get('/maquinaria/nuevo', [App\Http\Controllers\maquinariaController::class, 'create'])->name('maquinaria.create');
    Route::post('/maquinaria', [App\Http\Controllers\maquinariaController::class, 'store'])->name('maquinaria.store');
    Route::get('/maquinaria', [App\Http\Controllers\maquinariaController::class, 'index'])->name('maquinaria.index');
    Route::get('/maquinaria/{maquinaria}', [App\Http\Controllers\maquinariaController::class, 'show'])->name('maquinaria.show');
    Route::put('/maquinaria/{maquinaria}', [App\Http\Controllers\maquinariaController::class, 'update'])->name('maquinaria.update');
    Route::get('maquinaria/{id}/{doc}', [App\Http\Controllers\maquinariaController::class, 'download'])->name('maquinaria.download');
    Route::get('/maquinaria/{maquinaria}/edit', [App\Http\Controllers\maquinariaController::class, 'edit'])->name('maquinaria.edit');
    Route::delete('/maquinaria/{maquinaria}', [App\Http\Controllers\maquinariaController::class, 'destroy'])->name('maquinaria.delete');

    //Crud accesorios
    Route::get('/accesorios/nuevo', [App\Http\Controllers\accesoriosController::class, 'create'])->name('accesorios.create');
    Route::post('/accesorios', [App\Http\Controllers\accesoriosController::class, 'store'])->name('accesorios.store');
    Route::get('/accesorios', [App\Http\Controllers\accesoriosController::class, 'index'])->name('accesorios.index');
    Route::get('/accesorios/{accesorios}', [App\Http\Controllers\accesoriosController::class, 'show'])->name('accesorios.show');
    Route::put('/accesorios/{accesorios}', [App\Http\Controllers\accesoriosController::class, 'update'])->name('accesorios.update');
    Route::get('/accesorios/{accesorios}/edit', [App\Http\Controllers\accesoriosController::class, 'edit'])->name('accesorios.edit');
    Route::delete('/accesorios/{accesorios}', [App\Http\Controllers\accesoriosController::class, 'destroy'])->name('accesorios.delete');

    //Crud Inventario
    Route::get('/inventarios', [App\Http\Controllers\inventarioController::class, 'dash'])->name('inventario.dash');
    Route::get('/inventario/{tipo}', [App\Http\Controllers\inventarioController::class, 'index'])->name('inventario.index');
    Route::get('/inventario/producto/nuevo', [App\Http\Controllers\inventarioController::class, 'create'])->name('inventario.create');
    Route::post('/inventario', [App\Http\Controllers\inventarioController::class, 'store'])->name('inventario.store');
    Route::put('/inventario/{producto}/restock', [App\Http\Controllers\inventarioController::class, 'restock'])->name('inventario.restock');
    Route::put('/inventario/{producto}/mover', [App\Http\Controllers\inventarioController::class, 'mover'])->name('inventario.mover');
    Route::get('/inventario/producto/{inventario}', [App\Http\Controllers\inventarioController::class, 'show'])->name('inventario.show');
    Route::get('/inventario/producto/{inventario}/edit', [App\Http\Controllers\inventarioController::class, 'edit'])->name('inventario.edit');
    Route::put('/inventario/{inventario}', [App\Http\Controllers\inventarioController::class, 'update'])->name('inventario.update');

    Route::post('/inventario/combustible', [App\Http\Controllers\inventarioController::class, 'dashCombustible'])->name('inventario.dashCombustible');
    Route::put('/inventario/combustible/carga', [App\Http\Controllers\inventarioController::class, 'cargaCombustible'])->name('inventario.cargaCombustible');
    Route::put('/inventario/combustible/descarga', [App\Http\Controllers\inventarioController::class, 'descargaCombustible'])->name('inventario.descargaCombustible');

    Route::put('/inventario/combustible/carga/edit', [App\Http\Controllers\inventarioController::class, 'updateCarga'])->name('inventario.updateCarga');
    Route::put('/inventario/combustible/descarga/edit', [App\Http\Controllers\inventarioController::class, 'updateDescarga'])->name('inventario.updateDescarga');
    Route::delete('/inventario/combustible/carga/{carga}', [App\Http\Controllers\inventarioController::class, 'deleteCarga'])->name('inventario.deleteCarga');
    Route::delete('/inventario/combustible/descarga/{carga}', [App\Http\Controllers\inventarioController::class, 'deleteDescarga'])->name('inventario.deleteDescarga');
});
