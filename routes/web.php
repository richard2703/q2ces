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
// Route::get('/index', function () {
//     return view('inventario.indexInventario');
// });

// Route::get('/nuevo', function () {
//     return view('inventario.inventarioNuevo');
// });
// Route::get('/modifi', function () {
//     return view('inventario.inventarioModifi');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// });

// Route::get('users/export/', [UserController::class, 'export']);
Route::get('/usuarios/export', [App\Http\Controllers\UserController::class, 'export'])->name('users.export');
Route::get('/asistencia/export', [App\Http\Controllers\asistenciaController::class, 'export'])->name('asistencia.export');


// //Mantenimiento
// Route::get('/mantenimientos', function () {
//     return view('mantenimientos.mantenimientos');
// });

// Route::get('/nuevoMantenimiento', function () {
//     return view('mantenimientos.nuevoMantenimiento');
// });
// Route::get('/editarMantenimientos', function () {
//     return view('mantenimientos.editarMantenimientos');
// });

// Route::get('/verEquipos', function () {
//     return view('equipos.verEquipos');
// });

// Route::get('/altaDeAccesorios', function () { //Ruta navegador (nombre que yo le quiera poner y es la que se pega en el menu)
//     return view('accesorios.altaDeAccesorios');//Ruta en donde se encuentra el archivo
// });


// // calendario
// Route::get('/calendario', function () {
//     return view('calendario.calendario');
//  });


//Inventario
// Route::get('/dashInventario', function () {
//     return view('inventario.dashInventario');
// });
// Route::get('/indexInventario', function () {
//     return view('inventario.indexInventario');
// });

// Route::get('/detalleHerramienta', function () {
//     return view('inventario.detalleHerramienta');
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
    Route::get('/usuarios/nuevo', [App\Http\Controllers\UserController::class, 'create'])->name('users.create');
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
    Route::delete('/personal/{personal}', [App\Http\Controllers\personalController::class, 'destroy'])->name('personal.delete');
    Route::get('personal/asignar/{personal}/equipo', [App\Http\Controllers\personalController::class, 'edit'])->name('personal.equipo');
    Route::put('personal/asignar/{personal}/equipo', [App\Http\Controllers\personalController::class, 'asignacion'])->name('personal.equipo.asignacion');

    //*** catalogos */
    Route::get('/catalogos/', [App\Http\Controllers\catalogosController::class, 'index'])->name('catalogos.index');

    Route::get('/catalogos/puestos', [App\Http\Controllers\catalogosController::class, 'indexPuestos'])->name('catalogoPuestos.index');
    Route::get('/catalogos/puestos/nuevo', [App\Http\Controllers\puestoController::class, 'create'])->name('puesto.create');
    Route::post('/catalogos/puestos', [App\Http\Controllers\puestoController::class, 'store'])->name('puesto.store');
    Route::put('/catalogos/puestos/{puesto}', [App\Http\Controllers\puestoController::class, 'update'])->name('puesto.update');
    Route::delete('/catalogos/puestos/{puesto}', [App\Http\Controllers\puestoController::class, 'destroy'])->name('puesto.delete');

    Route::get('/catalogos/puestosNivel', [App\Http\Controllers\catalogosController::class, 'indexPuestosNivel'])->name('catalogoPuestosNivel.index');
    Route::get('/catalogos/puestosNivel/nuevo', [App\Http\Controllers\puestoNivelController::class, 'create'])->name('puestoNivel.create');
    Route::post('/catalogos/puestosNivel', [App\Http\Controllers\puestoNivelController::class, 'store'])->name('puestoNivel.store');
    Route::put('/catalogos/puestosNivel/{puesto}', [App\Http\Controllers\puestoNivelController::class, 'update'])->name('puestoNivel.update');
    Route::delete('/catalogos/puestosNivel/{puesto}', [App\Http\Controllers\puestoNivelController::class, 'destroy'])->name('puestoNivel.delete');

    Route::get('/catalogos/categoriasTareas', [App\Http\Controllers\catalogosController::class, 'indexCatalogoCategoriasTareas'])->name('catalogoCategoriasTareas.index');
    Route::get('/catalogos/categoriasTareas/nuevo', [App\Http\Controllers\tareaCategoriaController::class, 'create'])->name('tareaCategoria.create');
    Route::post('/catalogos/categoriasTareas', [App\Http\Controllers\tareaCategoriaController::class, 'store'])->name('tareaCategoria.store');
    Route::put('/catalogos/categoriasTareas/{tarea}', [App\Http\Controllers\tareaCategoriaController::class, 'update'])->name('tareaCategoria.update');
    Route::delete('/catalogos/categoriasTareas/{tarea}', [App\Http\Controllers\tareaCategoriaController::class, 'destroy'])->name('tareaCategoria.delete');

    Route::get('/catalogos/tiposTareas', [App\Http\Controllers\catalogosController::class, 'indexCatalogoTiposTareas'])->name('catalogoTiposTareas.index');
    Route::get('/catalogos/tiposTareas/nuevo', [App\Http\Controllers\tareaTipoController::class, 'create'])->name('tareaTipo.create');
    Route::post('/catalogos/tiposTareas', [App\Http\Controllers\tareaTipoController::class, 'store'])->name('tareaTipo.store');
    Route::put('/catalogos/tiposTareas/{tarea}', [App\Http\Controllers\tareaTipoController::class, 'update'])->name('tareaTipo.update');
    Route::delete('/catalogos/tiposTareas/{tarea}', [App\Http\Controllers\tareaTipoController::class, 'destroy'])->name('tareaTipo.delete');

    Route::get('/catalogos/ubicacionesTareas', [App\Http\Controllers\catalogosController::class, 'indexCatalogoUbicacionesTareas'])->name('catalogoUbicacionesTareas.index');
    Route::get('/catalogos/ubicacionesTareas/nuevo', [App\Http\Controllers\tareaUbicacionController::class, 'create'])->name('tareaUbicacion.create');
    Route::post('/catalogos/ubicacionesTareas', [App\Http\Controllers\tareaUbicacionController::class, 'store'])->name('tareaUbicacion.store');
    Route::put('/catalogos/ubicacionesTareas/{tarea}', [App\Http\Controllers\tareaUbicacionController::class, 'update'])->name('tareaUbicacion.update');
    Route::delete('/catalogos/ubicacionesTareas/{tarea}', [App\Http\Controllers\tareaUbicacionController::class, 'destroy'])->name('tareaUbicacion.delete');

    //Crud maquinaria
    Route::get('/maquinaria/nuevo', [App\Http\Controllers\maquinariaController::class, 'create'])->name('maquinaria.create');
    Route::post('/maquinaria', [App\Http\Controllers\maquinariaController::class, 'store'])->name('maquinaria.store');
    Route::get('/maquinaria', [App\Http\Controllers\maquinariaController::class, 'index'])->name('maquinaria.index');
    Route::get('/maquinaria/{maquinaria}', [App\Http\Controllers\maquinariaController::class, 'show'])->name('maquinaria.show');
    Route::put('/maquinaria/{maquinaria}', [App\Http\Controllers\maquinariaController::class, 'update'])->name('maquinaria.update');
    Route::put('/maquinaria/documento/update', [App\Http\Controllers\maquinariaController::class, 'updateDocumento'])->name('maquinaria.updateDocumento');
    Route::get('maquinaria/{id}/{doc}/download', [App\Http\Controllers\maquinariaController::class, 'download'])->name('maquinaria.download');
    Route::post('maquinaria/upload', [App\Http\Controllers\maquinariaController::class, 'upload'])->name('maquinaria.upload');
    Route::get('/maquinaria/{maquinaria}/edit', [App\Http\Controllers\maquinariaController::class, 'edit'])->name('maquinaria.edit');
    Route::delete('/maquinaria/{maquinaria}', [App\Http\Controllers\maquinariaController::class, 'destroy'])->name('maquinaria.delete');
    // Maquinaria Imagen Borrar
    Route::put('/maquinaria/imagen/delete', [App\Http\Controllers\maquinariaController::class, 'destroyImage'])->name('maquinaria.destroyImage');

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
    Route::post('/inventario/combustible/carga', [App\Http\Controllers\inventarioController::class, 'cargaCombustible'])->name('inventario.cargaCombustible');
    Route::post('/inventario/combustible/descarga', [App\Http\Controllers\inventarioController::class, 'descargaCombustible'])->name('inventario.descargaCombustible');

    Route::put('/inventario/combustible/carga/edit', [App\Http\Controllers\inventarioController::class, 'updateCarga'])->name('inventario.updateCarga');
    Route::put('/inventario/combustible/descarga/edit', [App\Http\Controllers\inventarioController::class, 'updateDescarga'])->name('inventario.updateDescarga');
    Route::delete('/inventario/combustible/carga/{carga}', [App\Http\Controllers\inventarioController::class, 'deleteCarga'])->name('inventario.deleteCarga');
    Route::delete('/inventario/combustible/descarga/{carga}', [App\Http\Controllers\inventarioController::class, 'deleteDescarga'])->name('inventario.deleteDescarga');

    //Crud calendario
    Route::get('/calendario', [App\Http\Controllers\calendarioController::class, 'index'])->name('calendario.index');
    Route::get('/calendario2', [App\Http\Controllers\calendarioController::class, 'index2'])->name('calendario.index2');
    Route::get('/calendario/{anio}/{mes}', [App\Http\Controllers\calendarioController::class, 'reloadCalendario'])->name('calendario.reloadCalendario');
    //Route::put('/coordiseno/detalle/riesgos/{riesgo}/recalcular', [App\Http\Controllers\detalleRiesgoController::class, 'recalcular'])->name('detalleriesgo.recalcular');

    //*** operaciones con tareas */
    Route::post('/calendario/tareas/nueva', [App\Http\Controllers\tareasController::class, 'store'])->name('tareas.store');
    Route::put('/calendario/tareas/editar', [App\Http\Controllers\tareasController::class, 'update'])->name('tareas.update');

    //*** operaciones con mantenimientos */
    Route::post('/calendario/mantenimientos/nuevo', [App\Http\Controllers\mantenimientosController::class, 'store'])->name('mantenimientos.store');
    Route::put('/calendario/mantenimientos/editar', [App\Http\Controllers\mantenimientosController::class, 'update'])->name('mantenimientos.update');

    //Mantenimiento
    Route::get('/mantenimientos', [App\Http\Controllers\mantenimientosController::class, 'index'])->name('mantenimientos.index');
    Route::get('/mantenimientos/nuevo/', [App\Http\Controllers\mantenimientosController::class, 'create'])->name('mantenimientos.create');
    Route::post('/mantenimientos/nuevo/add', [App\Http\Controllers\mantenimientosController::class, 'store'])->name('mantenimientos.store');
    Route::get('/mantenimientos/editar/{id}', [App\Http\Controllers\mantenimientosController::class, 'edit'])->name('mantenimientos.edit');
    Route::put('/mantenimiento/editar/{id}/update', [App\Http\Controllers\mantenimientosController::class, 'update'])->name('mantenimientos.update');

    //*** operaciones con reparaciones */
    Route::post('/calendario/reparaciones/nuevo', [App\Http\Controllers\reparacionesController::class, 'store'])->name('reparaciones.store');
    Route::put('/calendario/reparaciones/editar', [App\Http\Controllers\reparacionesController::class, 'update'])->name('reparaciones.update');

    //*** operaciones con solicitudes */
    Route::post('/calendario/solicitudes/nuevo', [App\Http\Controllers\solicitudesController::class, 'store'])->name('solicitudes.store');
    Route::put('/calendario/solicitudes/editar', [App\Http\Controllers\solicitudesController::class, 'update'])->name('solicitudes.update');

    //Crud personal
    Route::get('/asistencia', [App\Http\Controllers\asistenciaController::class, 'index'])->name('asistencia.index');
    Route::get('/asistencia/diaria', [App\Http\Controllers\asistenciaController::class, 'create'])->name('asistencia.create');
    Route::post('/asistencia/diaria', [App\Http\Controllers\asistenciaController::class, 'store'])->name('asistencia.store');
    Route::post('/asistencia/otrodia', [App\Http\Controllers\asistenciaController::class, 'cambioDiaAsistencia'])->name('asistencia.cambioDiaAsistencia');
    Route::post('/asistencia/otrodiaextras', [App\Http\Controllers\asistenciaController::class, 'cambioDiaExtras'])->name('asistencia.cambioDiaExtras');
    Route::get('/asistencia/horasExtra', [App\Http\Controllers\asistenciaController::class, 'horasExtra'])->name('asistencia.horasExtra');
    Route::post('/asistencia/horasExtra', [App\Http\Controllers\asistenciaController::class, 'HEstore'])->name('asistencia.HEstore');
    Route::get('/asistencia/personal/{personalId}', [App\Http\Controllers\asistenciaController::class, 'show'])->name('asistencia.show');
    Route::put('/asistencia/personal/{personalId}', [App\Http\Controllers\asistenciaController::class, 'update'])->name('asistencia.update');
    Route::get('/asistencia/corteSemanal', [App\Http\Controllers\asistenciaController::class, 'corteSemanal'])->name('asistencia.corteSemanal');

    Route::get('/asistencia/{anio}/{mes}', [App\Http\Controllers\asistenciaController::class, 'reloadAsistencia'])->name('asistencia.reloadAsistencia');
    Route::get('/asistencia/diaria/{anio}/{mes}/{dia}', [App\Http\Controllers\asistenciaController::class, 'reloadLista'])->name('asistencia.reloadLista');
    Route::get('/asistencia/horasExtra/{anio}/{mes}/{dia}', [App\Http\Controllers\asistenciaController::class, 'reloadHorasExtra'])->name('asistencia.reloadHorasExtra');
    Route::get('/asistencia/personal/{personalId}/{anio}/{mes}/{dia}', [App\Http\Controllers\asistenciaController::class, 'reloadDetalle'])->name('asistencia.reloadDetalle');
    Route::get('/asistencia/corteSemanal/{anio}/{mes}/{dia}', [App\Http\Controllers\asistenciaController::class, 'reloadcorteSemanal'])->name('asistencia.reloadcorteSemanal');
    // Route::post('/asistencia', [App\Http\Controllers\personalController::class, 'store'])->name('personal.store');
    // Route::get('/asistencia', [App\Http\Controllers\personalController::class, 'index'])->name('personal.indexPersonal');
    // Route::get('/asistencia/{personal}', [App\Http\Controllers\personalController::class, 'show'])->name('personal.show');
    // Route::put('/asistencia/{personal}', [App\Http\Controllers\personalController::class, 'update'])->name('personal.update');
    // Route::get('asistencia/{id}/{doc}', [App\Http\Controllers\personalController::class, 'download'])->name('personal.download');
    // Route::delete('/asistencia/{personal}', [App\Http\Controllers\UserController::class, 'destroy'])->name('personal.delete');

    // Caja Chica
    Route::resource('cajaChica', App\Http\Controllers\cajaChicaController::class);

    // Conceptos
    Route::resource('conceptos', App\Http\Controllers\conceptosController::class);


    Route::get('search/equipos', [App\Http\Controllers\searchController::class, 'equipos'])->name('search.equipos');
    Route::get('search/materialMantenimiento', [App\Http\Controllers\searchController::class, 'materialMantenimiento'])->name('search.materialMantenimiento');
    Route::get('search/tareasParaGrupos', [App\Http\Controllers\searchController::class, 'tareasParaGrupos'])->name('search.tareasParaGrupos');
    Route::get('search/gruposParaBitacoras', [App\Http\Controllers\searchController::class, 'gruposParaBitacoras'])->name('search.gruposParaBitacoras');


    // Tareas de bitacoras

    Route::get('/bitacoras/', [App\Http\Controllers\bitacorasController::class, 'index'])->name('bitacoras.index');
    Route::get('/bitacoras/bitacora/nuevo/', [App\Http\Controllers\bitacorasController::class, 'create'])->name('bitacoras.create');
    Route::post('/bitacoras/bitacora/nuevo', [App\Http\Controllers\bitacorasController::class, 'store'])->name('bitacoras.store');
    Route::get('/bitacoras/bitacora/editar/{id}', [App\Http\Controllers\bitacorasController::class, 'edit'])->name('bitacoras.edit');
    Route::put('/bitacoras/bitacora/editar/{bitacoras}', [App\Http\Controllers\bitacorasController::class, 'update'])->name('bitacoras.update');

    Route::get('/bitacoras/grupos', [App\Http\Controllers\grupoController::class, 'index'])->name('grupo.index');
    Route::get('/bitacoras/grupos/nuevo/', [App\Http\Controllers\grupoController::class, 'create'])->name('grupo.create');
    Route::post('/bitacoras/grupos/nuevo', [App\Http\Controllers\grupoController::class, 'store'])->name('grupo.store');
    Route::get('/bitacoras/grupos/editar/{id}', [App\Http\Controllers\grupoController::class, 'edit'])->name('grupo.edit');
    Route::put('/bitacoras/grupos/editar/{grupo}', [App\Http\Controllers\grupoController::class, 'update'])->name('grupo.update');

    Route::get('/bitacoras/tareas', [App\Http\Controllers\tareaController::class, 'index'])->name('tarea.index');
    Route::post('/bitacoras/tareas/nueva', [App\Http\Controllers\tareaController::class, 'store'])->name('tarea.store');
    Route::put('/bitacoras/tareas/editar/{tarea}', [App\Http\Controllers\tareaController::class, 'update'])->name('tarea.update');

    //*** Mtq */
    Route::get('/mtq/', [App\Http\Controllers\mtqController::class, 'dash'])->name('mtq.dash');
    Route::get('/mtq/residentes', [App\Http\Controllers\residenteController::class, 'index'])->name('residente.index');
    Route::get('/mtq/residentes/nuevo', [App\Http\Controllers\residenteController::class, 'create'])->name('residente.create');
    Route::post('/mtq/residentes', [App\Http\Controllers\residenteController::class, 'store'])->name('residente.store');
    Route::put('/mtq/residentes/{residente}', [App\Http\Controllers\residenteController::class, 'update'])->name('residente.update');
    Route::delete('/mtq/residentes/{residente}', [App\Http\Controllers\residenteController::class, 'destroy'])->name('residente.delete');


    // Route::get('/tareas', function () {
    //     return view('tareas.tareas');
    // });

    Route::get('/checkList', function () {
        return view('checkList.checkList');
    });


    Route::get('/nuevoCheck', function () {
        return view('checkList.nuevoCheck');
    });

    Route::get('/editarTareaCheck', function () {
       return view('checkList.editarTareaCheck');
   });

    Route::get('/nuevaTareaCheck', function () {
       return view('checkList.nuevaTareaCheck');
   });

//    Route::get('/indexBitacora', function () {
//        return view('bitacora.indexBitacora');
//    });


//    Route::get('/nuevoBitacora', function () {
//        return view('bitacora.nuevoBitacora');
//    });

//    Route::get('/editarBitacora', function () {
//        return view('bitacora.editarBitacora');
//    });


//    Route::get('/indexgrupo', function () {
//        return view('grupo.indexgrupo');
//    });

//    Route::get('/nuevoGrupo', function () {
//        return view('grupo.nuevoGrupo');
//    });

//    Route::get('/editarGupo', function () {
//        return view('grupo.editarGrupo');
//    });

});
