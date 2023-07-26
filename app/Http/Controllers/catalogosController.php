<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use App\Models\puesto;
use App\Models\puestoNivel;
use App\Models\tareaCategoria;
use App\Models\tareaTipo;
use App\Models\tareaUbicacion;
use App\Models\tipoUniforme;
use App\Models\marca;
use App\Models\proveedor;
use App\Models\proveedorCategoria;

class catalogosController extends Controller {
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function index() {
        abort_if ( Gate::denies( 'catalogos_index' ), 403 );
        return view( 'catalogos.dashCatalogos' );
    }

    public function indexPuestos() {
        abort_if ( Gate::denies( 'puesto_index' ), 403 );

        $records = puesto::select( 'puesto.*', 'puestoNivel.nombre as puestoNivel' )
        ->leftJoin( 'puestoNivel', 'puestoNivel.id', '=', 'puesto.puestoNivelId' )
        ->orderBy( 'nombre', 'asc' )->paginate( 10 );

        $vctNiveles = puestoNivel::orderBy( 'nombre', 'asc' )->get();
        // dd( $puestos );
        return view( 'catalogos.puestos', compact( 'records', 'vctNiveles' ) );
    }

    public function indexPuestosNivel() {
        abort_if ( Gate::denies( 'catalogos_index' ), 403 );

        $records = puestoNivel::orderBy( 'nombre', 'asc' )->paginate( 10 );
        return view( 'catalogos.puestosNivel', compact( 'records' ) );
    }

    public function indexCatalogoCategoriasTareas() {
        abort_if ( Gate::denies( 'catalogos_index' ), 403 );

        $records = tareaCategoria::orderBy( 'nombre', 'asc' )->paginate( 10 );
        // dd( $puestos );
        return view( 'catalogos.tareaCategorias', compact( 'records' ) );
    }

    public function indexCatalogoTiposTareas() {
        abort_if ( Gate::denies( 'catalogos_index' ), 403 );

        $records = tareaTipo::orderBy( 'nombre', 'asc' )->paginate( 10 );
        // dd( $puestos );
        return view( 'catalogos.tareaTipos', compact( 'records' ) );
    }

    public function indexCatalogoUbicacionesTareas() {
        abort_if ( Gate::denies( 'catalogos_index' ), 403 );

        $records = tareaUbicacion::orderBy( 'nombre', 'asc' )->paginate( 10 );
        // dd( $puestos );
        return view( 'catalogos.tareaUbicaciones', compact( 'records' ) );
    }

    public function indexCatalogoTipoUniforme () {
        abort_if ( Gate::denies( 'catalogos_index' ), 403 );

        $records = tipoUniforme::orderBy( 'nombre', 'asc' )->paginate( 10 );
        // dd( $puestos );
        return view( 'catalogos.uniformeTipos', compact( 'records' ) );
    }

    public function indexCatalogoMarca () {
        abort_if ( Gate::denies( 'catalogos_index' ), 403 );

        $records = marca::orderBy( 'nombre', 'asc' )->paginate( 10 );
        // dd( $puestos );
        return view( 'catalogos.marcas', compact( 'records' ) );
    }

    public function indexCatalogoProveedorCategoria () {
        abort_if ( Gate::denies( 'catalogos_index' ), 403 );

        $records = proveedorCategoria::orderBy( 'nombre', 'asc' )->paginate( 10 );
        // dd( $puestos );
        return view( 'catalogos.proveedorCategoria', compact( 'records' ) );
    }

    public function indexCatalogoProveedor () {
        abort_if ( Gate::denies( 'catalogos_index' ), 403 );

        $records = proveedor::select( 'proveedor.*', 'proveedorCategoria.nombre as categoria' )
        ->leftJoin( 'proveedorCategoria', 'proveedorCategoria.id', '=', 'proveedor.categoriaId' )
        ->orderBy( 'nombre', 'asc' )->paginate( 10 );
        $vctCategorias = proveedorCategoria::orderBy( 'nombre', 'asc' )->get();
        // dd( $puestos );
        return view( 'catalogos.proveedores', compact( 'records', 'vctCategorias' ) );
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function create() {
        //
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */

    public function store( Request $request ) {
        //
    }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */

    public function show( $id ) {
        //
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */

    public function edit( $id ) {
        //
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */

    public function update( Request $request, $id ) {
        //
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */

    public function destroy( $id ) {
        //
    }
}
