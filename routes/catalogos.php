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

	//Recursos Humanos
	Route::get('/puestos', [App\Http\Controllers\catalogosController::class, 'indexPuestos'])->name('catalogoPuestos.index');
	Route::resource('puesto', App\Http\Controllers\puestoController::class);

	Route::get('/puestosNivel', [App\Http\Controllers\catalogosController::class, 'indexPuestosNivel'])->name('catalogoPuestosNivel.index');
	Route::resource('puestoNivel', App\Http\Controllers\puestoNivelController::class);

	Route::resource('tiposDocs', App\Http\Controllers\tiposDocsController::class);

	Route::resource('/docs', App\Http\Controllers\docsController::class);

	Route::get('/catalogos/tiposEquipo', [App\Http\Controllers\catalogosController::class, 'indexCatalogoTiposEquipo'])->name('catalogoTiposEquipo.index');
	Route::resource('tipoEquipo', App\Http\Controllers\tipoEquipoController::class);

	//Inventario
	Route::get('/catalogos/tiposUniforme', [App\Http\Controllers\catalogosController::class, 'indexCatalogoTipoUniforme'])->name('catalogoTipoUniforme.index');
	Route::resource('tipoUniforme', App\Http\Controllers\tipoUniformeController::class);

	Route::get('/marcas', [App\Http\Controllers\catalogosController::class, 'indexCatalogoMarca'])->name('catalogoMarca.index');
	Route::resource('marca', App\Http\Controllers\marcaController::class);

	Route::get('/proveedores', [App\Http\Controllers\catalogosController::class, 'indexCatalogoProveedor'])->name('catalogoProveedor.index');
	Route::resource('proveedor', App\Http\Controllers\proveedorController::class);

	Route::get('/catalogos/proveedores/categorias', [App\Http\Controllers\catalogosController::class, 'indexCatalogoProveedorCategoria'])->name('catalogoProveedorCategoria.index');
	Route::get('/proveedores/categorias/nuevo', [App\Http\Controllers\proveedorCategoriaController::class, 'create'])->name('proveedorCategoria.create');
	Route::post('/proveedores/categorias', [App\Http\Controllers\proveedorCategoriaController::class, 'store'])->name('proveedorCategoria.store');
	Route::put('/proveedores/categorias/{proveedorCategoria}', [App\Http\Controllers\proveedorCategoriaController::class, 'update'])->name('proveedorCategoria.update');
	Route::delete('/proveedores/categorias/{proveedorCategoria}', [App\Http\Controllers\proveedorCategoriaController::class, 'destroy'])->name('proveedorCategoria.destroy');

	Route::get('/catalogos/tiposRefaccion', [App\Http\Controllers\catalogosController::class, 'indexCatalogoTipoRefaccion'])->name('catalogoTipoRefaccion.index');
	Route::resource('refaccionTipo', App\Http\Controllers\refaccionTipoController::class);

	Route::resource('lugares', App\Http\Controllers\lugaresController::class);

	Route::resource('ubicaciones', App\Http\Controllers\ubicacionesController::class);

	//Maquinaria
	Route::get('/catalogos/categoriasMaquinaria', [App\Http\Controllers\catalogosController::class, 'indexCatalogoCategoriasMaquinaria'])->name('catalogoCategoriasMaquinaria.index');
	Route::resource('maquinariaCategoria', App\Http\Controllers\maquinariaCategoriaController::class);

	Route::get('/catalogos/tiposMaquinaria', [App\Http\Controllers\catalogosController::class, 'indexCatalogoTiposMaquinaria'])->name('catalogoTiposMaquinaria.index');
	Route::resource('maquinariaTipo', App\Http\Controllers\maquinariaTipoController::class);

	Route::get('/catalogos/refacciones', [App\Http\Controllers\catalogosController::class, 'indexCatalogoRefacciones'])->name('catalogoRefacciones.index');
	Route::resource('refacciones', App\Http\Controllers\RefaccionesController::class);

	//Mantenimientos y Servicios
	Route::get('catalogos/categoriasTareas', [App\Http\Controllers\catalogosController::class, 'indexCatalogoCategoriasTareas'])->name('catalogoCategoriasTareas.index');
	Route::resource('tareaCategoria', App\Http\Controllers\tareaCategoriaController::class);

	Route::get('/tiposTareas', [App\Http\Controllers\catalogosController::class, 'indexCatalogoTiposTareas'])->name('catalogoTiposTareas.index');
	Route::resource('tareaTipo', App\Http\Controllers\tareaTipoController::class);

	Route::get('/catalogos/ubicacionesTareas', [App\Http\Controllers\catalogosController::class, 'indexCatalogoUbicacionesTareas'])->name('catalogoUbicacionesTareas.index');
	Route::resource('tareaUbicacion', App\Http\Controllers\tareaUbicacionController::class);

	Route::resource('tiposServicios', App\Http\Controllers\tiposServiciosController::class);

	Route::resource('serviciosMtq', App\Http\Controllers\serviciosMtqController::class);

	Route::get('/tiposValorTarea', [App\Http\Controllers\catalogosController::class, 'indexCatalogoTiposValorTarea'])->name('catalogoTiposValorTarea.index');
	Route::resource('tipoValorTarea', App\Http\Controllers\tipoValorTareaController::class);

	Route::get('/catalogos/tiposMantenimiento', [App\Http\Controllers\catalogosController::class, 'indexCatalogoTiposMantenimiento'])->name('catalogoTiposMantenimiento.index');
	Route::resource('tipoMantenimiento', App\Http\Controllers\tipoMantenimientoController::class);


	//Caja Chica y Servicios

	Route::get('/catalogos/conceptos', [App\Http\Controllers\catalogosController::class, 'indexCatalogoConceptos'])->name('catalogoConceptos.index');
	Route::resource('conceptos', App\Http\Controllers\conceptosController::class);

	Route::get('/catalogos/comprobantes', [App\Http\Controllers\catalogosController::class, 'indexCatalogoComprobantes'])->name('catalogoComprobantes.index');
	Route::resource('comprobante', App\Http\Controllers\comprobanteController::class);

	Route::resource('conceptosServicios', App\Http\Controllers\conceptosServiciosTrasporteController::class);

	Route::resource('tipoAlmacen', App\Http\Controllers\tipoAlmacenController::class);

	Route::resource('almacenTiraderos', App\Http\Controllers\almacenTiraderosController::class);
});
