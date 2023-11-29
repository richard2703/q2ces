<?php

namespace App\Http\Controllers;

use App\Models\inventarioMtq;
use App\Http\Controllers\Controller;
use App\Models\inventarioMovimientosMtq;
use App\Models\maquinaria;
use App\Models\marca;
use App\Models\proveedor;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class inventarioMtqController extends Controller {

    public function dash() {
        abort_if ( Gate::denies( 'inventario_mtq_index' ), 403 );

        return view( 'MTQ.inventarioDashMtq' );
    }

    public function index( $tipo ) {
        abort_if ( Gate::denies( 'inventario_mtq_index' ), 403 );
        $inventarios = inventarioMtq::where( 'tipo',  $tipo )->orderBy( 'created_at', 'desc' )->paginate( 15 );

        if ( $inventarios->isEmpty() == true ) {
            $inventarios = null;
        }

        return view( 'MTQ.indexInventarioMtq', compact( 'inventarios', 'tipo' ) );

    }

    public function create( $tipo ) {
        abort_if ( Gate::denies( 'inventario_mtq_create' ), 403 );

        // $vctTipos = tipoUniforme::all();
        $vctMarcas = marca::all()->sortBy( 'nombre', SORT_STRING );
        $vctProveedores = proveedor::all()->sortBy( 'nombre', SORT_STRING );

        return view( 'MTQ.inventarioNuevoMtq', compact( 'tipo', 'vctMarcas', 'vctProveedores' ) );
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */

    public function store( Request $request ) {
        abort_if ( Gate::denies( 'inventario_create' ), 403 );
        // dd( $request );
        $data = $request->all();

        if ( isset( $data[ 'restock' ] ) ) {
            for ( $i = 0; $i < count( $request[ 'restock' ][ 'id' ] );
            $i++ ) {
                $record = inventarioMtq::where( 'id', $data[ 'restock' ][ 'id' ][ $i ] )->first();
                $nuevaLista = collect();
                $record->update( $data );

                if ( $request[ 'restock' ][ 'id' ][ $i ] ) {
                    $array = [
                        'id' => $request[ 'restock' ][ 'id' ][ $i ],
                        'cantidad' => ( $record[ 'cantidad' ] + $request[ 'restock' ][ 'cantidad' ][ $i ] ),
                        'valor' => ( $request[ 'restock' ][ 'costo' ][ $i ] / $request[ 'restock' ][ 'cantidad' ][ $i ] )
                    ];
                    // dd( $array );
                    $objResidente = inventarioMtq::updateOrCreate( [ 'id' => $array[ 'id' ] ], $array );
                    // dd( $i, $array, $objResidente );

                    $nuevaLista->push( $objResidente->id );
                    if ( $objResidente->id > 0 ) {
                        $objMovimiento = new inventarioMovimientosMtq();
                        $objMovimiento->movimiento = 1;
                        $objMovimiento->inventarioId = $objResidente->id;
                        $objMovimiento->cantidad = $request[ 'restock' ][ 'cantidad' ][ $i ];
                        $objMovimiento->precioUnitario = ( $request[ 'restock' ][ 'costo' ][ $i ] / $request[ 'restock' ][ 'cantidad' ][ $i ] );
                        $objMovimiento->total = $request[ 'restock' ][ 'costo' ][ $i ];
                        $objMovimiento->usuarioId = $request[ 'restock' ][ 'usuarioId' ][ 0 ];
                        $objMovimiento->Save();
                    }
                }
            }
        }

        // $request->validate( [
        //     'nombre' => 'required|max:250',
        //     // 'marca' => 'nullable|max:250',
        //     'modelo' => 'nullable|max:250',
        //     // 'proveedor' => 'nullable|max:200',
        //     'numparte' => 'nullable|max:250',
        //     'cantidad' => 'required|numeric',
        //     'valor' => 'required|numeric',
        //     'reorden' => 'nullable|numeric',
        //     'maximo' => 'nullable|numeric',
        // ], [
        //     'nombre.required' => 'El campo nombre es obligatorio.',
        //     'nombre.max' => 'El campo nombre excede el límite de caracteres permitidos.',
        //     // 'marca.max' => 'El campo marca excede el límite de caracteres permitidos.',
        //     'modelo.max' => 'El campo modelo excede el límite de caracteres permitidos.',
        //     // 'proveedor.max' => 'El campo proveedor excede el límite de caracteres permitidos.',
        //     'numparte.max' => 'El campo número de parte excede el límite de caracteres permitidos.',
        //     'cantidad.numeric' => 'El campo cantidad debe de ser numérico.',
        //     'valor.numeric' => 'El campo valor debe de ser numérico.',
        //     'reorden.numeric' => 'El campo valor debe de ser numérico.',
        //     'maximo.numeric' => 'El campo valor debe de ser numérico.',
        // ] );
        $producto = $request->all();
        // $objProducto = inventario::create( $producto );
        if ( isset( $request[ 'nuevo' ] ) ) {
            for ( $i = 0; $i < count( $request[ 'nuevo' ][ 'tipo' ] );
            $i++ ) {

                if ( $request[ 'nuevo' ][ 'tipo' ][ $i ] ) {
                    $objResidente = new inventarioMtq();
                    $objResidente->nombre = $request[ 'nuevo' ][ 'nombre' ][ $i ];
                    $objResidente->marcaId = $request[ 'nuevo' ][ 'marcaId' ][ $i ];
                    $objResidente->modelo = $request[ 'nuevo' ][ 'modelo' ][ $i ];
                    $objResidente->proveedorId = $request[ 'nuevo' ][ 'proveedorId' ][ $i ];
                    $objResidente->numparte = $request[ 'nuevo' ][ 'numparte' ][ $i ];
                    $objResidente->cantidad = $request[ 'nuevo' ][ 'cantidad' ][ $i ];
                    $objResidente->valor = $request[ 'nuevo' ][ 'valor' ][ $i ] / $request[ 'nuevo' ][ 'cantidad' ][ $i ];
                    $objResidente->reorden = $request[ 'nuevo' ][ 'reorden' ][ $i ];
                    $objResidente->maximo = $request[ 'nuevo' ][ 'maximo' ][ $i ];
                    $objResidente->tipo = $request[ 'nuevo' ][ 'tipo' ][ $i ];
                    $objResidente->unidad = $request[ 'nuevo' ][ 'unidad' ][ $i ];
                    $objResidente->imagen = isset( $request[ 'nuevo' ][ 'imagen' ][ $i ] ) && $request[ 'nuevo' ][ 'imagen' ][ $i ] !== null
                    ? time() . '_' . 'imagen.' . $request[ 'nuevo' ][ 'imagen' ][ $i ]->getClientOriginalExtension()
                    : null;
                    // $objResidente->usuarioId = $request[ 'usuarioId' ][ $i ];
                    //  $objResidente->puesto = $request[ 'rpuesto' ][ $i ];
                    $objResidente->save();

                    if ( $objResidente->id > 0 ) {
                        $objMovimiento = new inventarioMovimientosMtq();
                        $objMovimiento->movimiento = 1;
                        $objMovimiento->inventarioId = $objResidente->id;
                        $objMovimiento->cantidad = $objResidente->cantidad;
                        $objMovimiento->precioUnitario = $objResidente->valor;
                        $objMovimiento->total = ( $objResidente->valor * $objResidente->cantidad );
                        $objMovimiento->usuarioId = $request[ 'nuevo' ][ 'usuarioId' ][ 0 ];
                        $objMovimiento->Save();
                    }
                }

                if ( isset( $request[ 'nuevo' ][ 'imagen' ][ $i ] ) ) {
                    // Se ha subido un archivo en la posición $i del array 'imagen'
                    $producto[ 'nuevo' ][ 'imagen' ][ $i ] = time() . '_' . 'imagen.' . $request[ 'nuevo' ][ 'imagen' ][ $i ]->getClientOriginalExtension();
                    $request[ 'nuevo' ][ 'imagen' ][ $i ]->storeAs( '/public/inventario/' . $producto[ 'nuevo' ][ 'tipo' ][ $i ], $producto[ 'nuevo' ][ 'imagen' ][ $i ] );
                } else {
                    // No se subió ningún archivo en la posición $i del array 'imagen'
                }
            }
        }

        Session::flash( 'message', 1 );
        if ( isset( $request[ 'nuevo' ] ) ) {
            return redirect()->route( 'inventarioMtq.index', $producto[ 'nuevo' ][ 'tipo' ] );
        } else {
            return redirect()->route( 'inventarioMtq.index', $data[ 'restock' ][ 'tipo' ] );
        }
    }

    /**
    * Display the specified resource.
    *
    * @param  \App\Models\inventarioMtq  $inventarioMtq
    * @return \Illuminate\Http\Response
    */

    public function show( inventarioMtq $inventario ) {
        abort_if ( Gate::denies( 'inventario_mtq_show' ), 403 );
        // dd( $inventario );
        $vctDesde = maquinaria::all();
        $vctHasta = maquinaria::all();
        $vctMarcas = marca::all()->sortBy( 'nombre' );
        $vctProveedores = proveedor::all()->sortBy( 'nombre' );
        $vctMaquinaria = maquinaria::all()->sortBy( 'nombre' );
        // dd( $vctDesde );
        $inventario = inventarioMtq::where( 'id', $inventario->id )->first();
        // dd( $inventario );

        return view( 'MTQ.detalleInventarioMtq ', compact( 'inventario', 'vctDesde', 'vctHasta', 'vctMarcas', 'vctProveedores', 'vctMaquinaria' ) );
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Models\inventarioMtq  $inventarioMtq
    * @return \Illuminate\Http\Response
    */

    public function edit( inventarioMtq $inventarioMtq ) {
        //
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Models\inventarioMtq  $inventarioMtq
    * @return \Illuminate\Http\Response
    */

    public function update( Request $request, inventarioMtq $inventario ) {
        abort_if ( Gate::denies( 'inventario_mtq_edit' ), 403 );
        $data = $request->all();

        if ( $request->hasFile( 'imagen' ) ) {
            $data[ 'imagen' ] = time() . '_' . 'imagen.' . $request->file( 'imagen' )->getClientOriginalExtension();
            $request->file( 'imagen' )->storeAs( '/public/inventario/' . $data[ 'tipo' ], $data[ 'imagen' ] );
        }

        $inventario->update( $data );

        Session::flash( 'message', 1 );
        // dd( $request );
        return redirect()->route( 'inventarioMtq.index', $inventario->tipo );
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Models\inventarioMtq  $inventarioMtq
    * @return \Illuminate\Http\Response
    */

    public function destroy( inventarioMtq $inventarioMtq ) {
        //
    }

    public function movimiento( Request $request, inventarioMtq $producto ) {
        abort_if ( Gate::denies( 'inventario_edit' ), 403 );
        $movimiento = $request->all();
        // dd( $request );
        $objMovimiento = new inventarioMovimientosMtq();
        $objMovimiento->movimiento = $movimiento[ 'movimiento' ];
        $objMovimiento->inventarioId = $movimiento[ 'inventarioId' ];
        $objMovimiento->usuarioId = $movimiento[ 'usuarioId' ];
        $objMovimiento->cantidad = $movimiento[ 'cantidad' ];
        $objMovimiento->comentario = $movimiento[ 'comentario' ];
        if ( $movimiento[ 'costo' ] === null ) {
            $objMovimiento->precioUnitario = 0;
            $objMovimiento->total = 0;
        } else {
            $objMovimiento->precioUnitario = ( $movimiento[ 'costo' ] / $movimiento[ 'cantidad' ] );
            $objMovimiento->total = $movimiento[ 'costo' ];
        }

        $prodcucto2 = inventarioMtq::select( '*' )->where( 'id', '=', $movimiento[ 'inventarioId' ] )->first();
        $objMovimiento->Save();

        if ( $movimiento[ 'movimiento' ] == 1 ) {
            $prodcucto2->cantidad = ( $prodcucto2->cantidad + $movimiento[ 'cantidad' ] );
            $prodcucto2->valor =  ( $movimiento[ 'costo' ] / $movimiento[ 'cantidad' ] );
            $prodcucto2->save();
        } else if ( $movimiento[ 'movimiento' ] == 2 ) {
            $prodcucto2->cantidad = ( $prodcucto2->cantidad - $movimiento[ 'cantidad' ] );
            $prodcucto2->save();
        }

        Session::flash( 'message', 1 );
        return redirect()->route( 'inventarioMtq.index', $prodcucto2->tipo );
    }
}
