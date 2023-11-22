<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;
use App\Helpers\Validaciones;
use App\Helpers\Calculos;
use App\Models\calendarioPrincipal;
use App\Models\mantenimientos;
use App\Models\gastosMantenimiento;
use App\Models\mantenimientoImagen;
use App\Models\maquinaria;
use App\Models\tipoMantenimiento;
use App\Models\inventario;
use App\Models\inventarioMovimientos;
use App\Models\personal;

class mantenimientosController extends Controller {
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function index( Request $request ) {

        abort_if ( Gate::denies( 'mantenimiento_index' ), '404' );

        $estatus = $request->input( 'estatus', '0' );

        //** mantenimientos del mes seleccionado */
        $vctMantenimientos = mantenimientos::select(
            'mantenimientos.*',
            DB::raw( 'estados.nombre AS estado' ),
            DB::raw( 'tipoMantenimiento.nombre AS tipoMantenimiento' ),
            DB::raw( "CONCAT(maquinaria.identificador,' - ', maquinaria.nombre)as maquinaria" ),
            DB::raw( 'maquinaria.identificador AS maquinariaCodigo' )
        )
        ->join( 'estados', 'estados.id', '=', 'mantenimientos.estadoId' )
        ->join( 'maquinaria', 'maquinaria.id', '=', 'mantenimientos.maquinariaId' )
        ->join( 'tipoMantenimiento', 'tipoMantenimiento.id', '=', 'mantenimientos.tipoMantenimientoId' );
        // ->where( 'mantenimientos.fechaInicio', '>=', $dteMesInicio )
        // ->where( 'mantenimientos.fechaInicio', '<=', $dteMesFin )

        if ( $estatus !== '0' ) {
            $vctMantenimientos = $vctMantenimientos->where( 'mantenimientos.estadoId', $estatus );
        }

        $vctMantenimientos = $vctMantenimientos->orderBy( 'estados.id', 'asc' )
        ->orderBy( 'mantenimientos.fechaInicio', 'desc' )->paginate( 10 );

        return view( 'mantenimientos.mantenimientos', compact( 'vctMantenimientos' ) );
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function create() {
        abort_if ( Gate::denies( 'mantenimiento_create' ), '404' );

        $vctTipos = tipoMantenimiento::select( 'tipoMantenimiento.*' )->orderBy( 'tipoMantenimiento.nombre', 'asc' )->get();
        // dd( $vctTipos );
        return view( 'mantenimientos.nuevoMantenimiento', compact( 'vctTipos' ) );
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */

    public function store( Request $request ) {
        abort_if ( Gate::denies( 'mantenimiento_create' ), '404' );

        $objCalculos = new Calculos();
        // dd( $request );

        $request->validate( [
            'titulo' => 'required|max:250',
            'maquinariaId' => 'required',
            'tipoMantenimientoId' => 'required',
            // 'comentario' => 'required|max:500',
            'fechaInicio' => 'required|date|date_format:Y-m-d',

        ], [
            'titulo.required' => 'El campo nombre es obligatorio.',
            'tipoMantenimientoId.required' => 'El campo tipo de mantenimiento es obligatorio.',
            'maquinariaId.required' => 'El campo maquinaria es obligatorio.',
            'titulo.max' => 'El campo título excede el límite de caracteres permitidos.',
            // 'comentario.max' => 'El campo comentarios excede el límite de caracteres permitidos.',
            'fechaInicio' => 'El campo de fecha de inicio del mantenimiento es obligatorio',
            'fechaInicio.date_format' => 'El campo fecha de nacimiento tiene un formato inválido.',
        ] );

        $mantenimiento = $request->all();
        $tipoManto = tipoMantenimiento::where( 'id', '=', $mantenimiento[ 'tipoMantenimientoId' ] )->first();

        $mantenimiento[ 'comentario' ] = ( is_null( $mantenimiento[ 'comentario' ] ) == false?$mantenimiento[ 'comentario' ]:'Sin indicaciones para el mantenimiento' );
        $mantenimiento[ 'codigo' ] = $tipoManto->codigo;
        $mantenimiento[ 'start' ] = strtoupper( $mantenimiento[ 'fechaInicio' ] );

        // dd( 'evento', $mantenimiento );

        $mantenimiento = mantenimientos::create( $mantenimiento );

        // Actualización del kilometraje o Horometro;
        $objCalculos->updateKilometrajeMaquinaria( $request[ 'maquinariaId' ], $request[ 'usoKom' ], $proviene = 'Mantenimiento' )  ;

        // $events = calendarioPrincipal::create( $mantenimiento );
        Session::flash( 'message', 1 );

        return redirect()->route( 'mantenimientos.edit', $mantenimiento->id )->with( 'success', 'Mantenimiento creado correctamente, continue con el proceso.' );
    }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */

    public function show( $id ) {
        abort_if ( Gate::denies( 'mantenimiento_show' ), '404' );

        $mantenimiento = mantenimientos::select( 'mantenimientos.*',
        DB::raw( "CONCAT(maquinaria.identificador,' - ', maquinaria.nombre)as maquinaria" ), )
        ->join( 'maquinaria', 'maquinaria.id', '=', 'mantenimientos.maquinariaId' )
        ->where( 'mantenimientos.id', '=', $id )->first();

        $gastos = gastosMantenimiento::select(
            'gastosMantenimiento.*',
            DB::raw( 'inventario.nombre as articulo' ),
            DB::raw( 'inventario.numparte as numparte' ),
            DB::raw( 'inventario.modelo as modelo' ),
            DB::raw( 'marca.nombre AS marca' ),
            DB::raw( 'inventario.valor as valor ' )
        )
        ->leftjoin( 'inventario', 'inventario.id', '=', 'gastosMantenimiento.inventarioId' )
        ->leftjoin( 'marca', 'marca.id', '=', 'inventario.marcaId' )
        ->leftjoin( 'manoDeObra', 'manoDeObra.id', '=', 'gastosMantenimiento.manoObraId' )
        ->where( 'mantenimientoId', '=', $id )->get();

        $fotos = mantenimientoImagen::where( 'mantenimientoId', $id )->get();
        $maquinaria = maquinaria::where( 'id', '=', $mantenimiento->maquinariaId )->first();

        $vctTipos = tipoMantenimiento::select( 'tipoMantenimiento.*' )->orderBy( 'tipoMantenimiento.nombre', 'asc' )->get();

        $vctCoordinadores = personal::getPersonalPorNivel( 3 );
        $vctMecanicos = personal::getPersonalPorNivel( 4 );
        $vctResponsables = personal::getPersonalPorNivel( 5, true );

        // dd( $mantenimiento, $maquinaria );

        return view( 'mantenimientos.detalleMantenimiento', compact( 'mantenimiento', 'gastos', 'vctTipos', 'fotos', 'maquinaria', 'vctMecanicos', 'vctCoordinadores', 'vctResponsables' ) );

    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */

    public function edit( $id ) {
        abort_if ( Gate::denies( 'mantenimiento_edit' ), '404' );

        $mantenimiento = mantenimientos::select( 'mantenimientos.*',
        DB::raw( "CONCAT(maquinaria.identificador,' - ', maquinaria.nombre)as maquinaria" ), )
        ->join( 'maquinaria', 'maquinaria.id', '=', 'mantenimientos.maquinariaId' )
        ->where( 'mantenimientos.id', '=', $id )->first();

        $gastos = gastosMantenimiento::select(
            'gastosMantenimiento.*',
            DB::raw( 'inventario.nombre as articulo' ),
            DB::raw( 'inventario.numparte as numparte' ),
            DB::raw( 'inventario.modelo as modelo' ),
            DB::raw( 'marca.nombre AS marca' ),
            DB::raw( 'inventario.valor as valor ' )
        )
        ->leftjoin( 'inventario', 'inventario.id', '=', 'gastosMantenimiento.inventarioId' )
        ->leftjoin( 'manoDeObra', 'manoDeObra.id', '=', 'gastosMantenimiento.manoObraId' )
        ->leftjoin( 'marca', 'marca.id', '=', 'inventario.marcaId' )
        ->where( 'mantenimientoId', '=', $id )->get();

        $fotos = mantenimientoImagen::where( 'mantenimientoId', $id )->get();
        $maquinaria = maquinaria::where( 'id', '=', $mantenimiento->maquinariaId )->first();

        $vctTipos = tipoMantenimiento::select( 'tipoMantenimiento.*' )->orderBy( 'tipoMantenimiento.nombre', 'asc' )->get();

        $vctCoordinadores = personal::getPersonalPorNivel( 3 );
        $vctMecanicos = personal::getPersonalPorNivel( 4 );
        $vctResponsables = personal::getPersonalPorNivel( 5, true );

        // dd( $gastos, $mantenimiento, $maquinaria, $vctMecanicos );

        return view( 'mantenimientos.editarMantenimiento', compact( 'mantenimiento', 'gastos', 'vctTipos', 'fotos', 'maquinaria', 'vctMecanicos', 'vctCoordinadores', 'vctResponsables' ) );
    }

    /**
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */

    public function update( Request $request ) {

        // dd( $request );

        abort_if ( Gate::denies( 'mantenimiento_edit' ), '404' );

        if ( $request[ 'guardar' ] != 0 ) {
            $objValida = new Validaciones();
            $objCalculos = new Calculos();

            $request->validate( [
                'titulo' => 'required|max:250',
                'maquinariaId' => 'required',
                'tipoMantenimientoId' => 'required',
                // 'comentario' => 'required|max:500',
                'fechaInicio' => 'required|date|date_format:Y-m-d',

            ], [
                'titulo.required' => 'El campo nombre es obligatorio.',
                'titulo.max' => 'El campo título excede el límite de caracteres permitidos.',
                'tipoMantenimientoId.required' => 'El campo tipo de mantenimiento es obligatorio.',
                'maquinariaId.required' => 'El campo maquinaria es obligatorio.',
                // 'comentario.max' => 'El campo comentarios excede el límite de caracteres permitidos.',
                'fechaInicio' => 'El campo de fecha de inicio del mantenimiento es obligatorio',
                'fechaInicio.date_format' => 'El campo fecha de nacimiento tiene un formato inválido.',
            ] );

            $data = $request->all();

            $mantto = mantenimientos::where( 'id', $data[ 'mantenimientoId' ] )->first();

            if ( is_null( $mantto ) == false ) {

                $data[ 'costo' ] =  $data[ 'total' ];

                //*** manejo del estatus de la tarea cuando se cambia su estatus inicial*/
                if ( $mantto->estadoId <= 1 && $mantto->fechaReal == '0000-00-00' ) {
                    if ( $data[ 'estadoId' ] > 1 ) {
                        $data[ 'fechaReal' ] =  date( 'Y-m-d' );
                    }
                }
                //*** manejo del estatus de la tarea cuando se cambia su estatus final*/
                if ( $data[ 'estadoId' ] == 3 ) {
                    $data[ 'fechaReal' ] =  date( 'Y-m-d' );
                }

                $data[ 'estadoId' ] =  $data[ 'estadoId' ];

                // dd( $data );
                $mantto->update( $data );

                //*** trabajamos con los items de piezas registradas y no registradas */
                $vctRegistrados = $objValida->preparaArreglo( gastosMantenimiento::where( 'mantenimientoId', '=', $mantto->id )->pluck( 'id' )->toArray() );
                $vctArreglo = $objValida->preparaArreglo( $request[ 'gastoId' ] );

                // dd( $request, $data, $vctRegistrados, $vctArreglo );

                //*** Preguntamos si existen registros en el arreglo */
                if ( is_array( $vctArreglo ) && count( $vctArreglo ) > 0 ) {

                    //** buscamos si el registrado esta en el arreglo, de no ser asi se elimina */
                    if ( is_array( $vctRegistrados ) && count( $vctRegistrados ) > 0 ) {
                        for (
                            $i = 0; $i < count( $vctRegistrados );
                            $i++
                        ) {
                            $intValor = ( int ) $vctRegistrados[ $i ];

                            if ( in_array( $intValor, $vctArreglo ) == false ) {
                                /*** no existe y se debe de eliminar */
                                gastosMantenimiento::destroy( $vctRegistrados[ $i ] );
                                // dd( 'Borrando por que se quito el gasto del Mantenimiento' );
                            } else {
                                /*** existe el registro */
                                // dd( 'Sigue vivo en el arreglo' );
                            }
                        }
                    }

                    //*** trabajamos el resto */
                    for (
                        $i = 0; $i < count( $request[ 'gastoId' ] );
                        $i++
                    ) {
                        if ( $request[ 'gastoId' ][ $i ] != '' ) {
                            //** Actualizacion de registro */
                            $objGasto =  gastosMantenimiento::where( 'id', '=', $request[ 'gastoId' ][ $i ] )->first();

                            if ( $objGasto && $objGasto->id > 0 ) {
                                $objGasto->mantenimientoId  = $mantto->id;
                                $objGasto->inventarioId  = $request[ 'inventarioId' ][ $i ];
                                $objGasto->manoObraId  = $request[ 'manoObraId' ][ $i ];
                                $objGasto->cantidad  =  $request[ 'cantidad' ][ $i ];
                                $objGasto->concepto  =  $request[ 'concepto' ][ $i ];
                                $objGasto->numeroParte  =  $request[ 'numeroParte' ][ $i ];
                                $objGasto->seccion  =  $request[ 'seccion' ][ $i ];
                                $objGasto->costo  = $request[ 'costo' ][ $i ];
                                $objGasto->total =  $request[ 'cantidad' ][ $i ] * $request[ 'costo' ][ $i ];
                                $objGasto->save();
                                // dd( 'Actualizando gasto de Mantenimiento' );
                            }
                        } else {

                            //** No existe en bd */
                            $blnAgregar = false;
                            if ( $request[ 'inventarioId' ][ $i ] != '' && strtoupper( str_replace( ' ', '', trim( $request[ 'seccion' ][ $i ] ) ) ) != 'MANODEOBRA' ) {
                                $blnAgregar = true;
                            } elseif ( $request[ 'manoObraId' ][ $i ] != '' && strtoupper( str_replace( ' ', '', trim( $request[ 'seccion' ][ $i ] ) ) ) == 'MANODEOBRA' ) {
                                $blnAgregar = true;
                            }

                            if ( $blnAgregar == true ) {
                                $objGasto = new gastosMantenimiento();
                                $objGasto->mantenimientoId  = $mantto->id;
                                $objGasto->inventarioId  = $request[ 'inventarioId' ][ $i ];
                                $objGasto->manoObraId  = $request[ 'manoObraId' ][ $i ];
                                ;
                                $objGasto->cantidad  =  $request[ 'cantidad' ][ $i ];
                                $objGasto->concepto  =  $request[ 'concepto' ][ $i ];
                                $objGasto->numeroParte  =  $request[ 'numeroParte' ][ $i ];
                                $objGasto->seccion  =  $request[ 'seccion' ][ $i ];
                                $objGasto->costo  = $request[ 'costo' ][ $i ];
                                $objGasto->total =  $request[ 'cantidad' ][ $i ] * $request[ 'costo' ][ $i ];
                                $objGasto->save();
                                // dd( 'Guardando gastos de Mantenimiento' );
                            }
                        }
                    }
                } else {
                    //*** se deben de eliminar todos los registrados */
                    if ( is_array( $vctRegistrados ) && count( $vctRegistrados ) > 0 ) {
                        for (
                            $i = 0; $i < count( $vctRegistrados );
                            $i++
                        ) {
                            gastosMantenimiento::destroy( $vctRegistrados[ $i ] );
                            // dd( 'Borrando todo gasto de Mantenimiento' );
                        }
                    }
                }

                //*** obtenemos el total de todos los gastos */
                $objGasto = gastosMantenimiento::where( 'mantenimientoId', '=', $mantto->id )->selectRaw( 'SUM(total) as totalGral' )->groupBy( 'mantenimientoId' )->first();

                if ( $objGasto ) {
                    $mantto->subtotal = $objGasto->totalGral;
                    $mantto->iva = $objGasto->totalGral * 0.16;
                    $mantto->costo = $objGasto->totalGral * 1.16;
                    $mantto->update();
                }

                /*** trabajamos las imagenes */

                $eliminarFotos = json_decode( $request->arrayFotosPersistente );
                // dd( $data[ 'bitacoraId' ] );
                // $maquinaria->update( $data );

                if ( $eliminarFotos != null ) {
                    for (
                        $i = 0; $i < count( $eliminarFotos );
                        $i++
                    ) {
                        // dd( $eliminarFotos[ $i ]->id );
                        $test = mantenimientoImagen::where( 'id', $eliminarFotos[ $i ]->id )->delete();
                        // dd( $test );
                    }
                }
                /*** directorio contenedor de su información */
                $pathMaquinaria = str_pad( $data[ 'identificador' ], 4, '0', STR_PAD_LEFT );
                //*** folio consecutivo del checklist */
                $intFolio = str_pad( $mantto->id, 4, '0', STR_PAD_LEFT );

                if ( $request->hasFile( 'ruta' ) ) {
                    $intNum = 1;
                    foreach ( $request->file( 'ruta' ) as $ruta ) {
                        $imagen[ 'mantenimientoId' ] = $mantto->id;
                        $imagen[ 'maquinariaId' ] = $mantto->maquinariaId;
                        $imagen[ 'ruta' ] = $intFolio . '_' . time() . '_' . 'Imagen' . str_pad( $intNum, 2, '0', STR_PAD_LEFT ) . '.' . $ruta->getClientOriginalExtension();
                        // dd( $imagen, '/public/maquinaria/' . $pathMaquinaria. '/mantenimientos/'.$mantto->codigo.'/' . $intFolio .'_'. time() . '_' . 'Imagen'. str_pad( $intNum, 2, '0', STR_PAD_LEFT ) .'.'. $ruta->getClientOriginalExtension() );
                        $ruta->storeAs( '/public/maquinaria/' . $pathMaquinaria . '/mantenimientos/' . $mantto->codigo, $imagen[ 'ruta' ] );
                        mantenimientoImagen::create( $imagen );
                        $intNum += 1;
                    }
                }

                if ( $data[ 'guardar' ] == 1 ) {
                    //*** cambiamos el estatus del mantenimiento */
                    $mantto->estadoId = 2;
                    $mantto->update();
                } elseif ( $data[ 'guardar' ] == 2 ) {
                    //*** terminamos el mantenimiento y cerramos el inventario */
                    $mantto->estadoId = 3;
                    $mantto->update();

                    $vctItems = gastosMantenimiento::select(
                        'gastosMantenimiento.*',
                        DB::raw( 'inventario.id as productoId' ),
                        DB::raw( 'inventario.nombre as articulo' ),
                        DB::raw( 'inventario.numparte as numparte' ),
                        DB::raw( 'inventario.modelo as modelo' ),
                        DB::raw( 'inventario.valor as valor ' )
                    )
                    ->leftjoin( 'inventario', 'inventario.id', '=', 'gastosMantenimiento.inventarioId' )
                    ->where( 'gastosMantenimiento.inventarioId', '!=', 'null' )
                    ->where( 'mantenimientoId', '=',  $mantto->id )->get();
                    // dd( $vctItems );

                    if ( $vctItems ) {

                        foreach ( $vctItems as   $item ) {

                            //*** existe el producto en inventario */
                            $producto = inventario::where( 'id', $item->productoId )->first();
                            if ( $producto ) {
                                //*** restamos la cantidad */
                                $producto->cantidad = $producto->cantidad -  $item->cantidad;
                                $producto->save();

                                //*** generamos el movimiento */
                                $movimiento = new inventarioMovimientos();
                                $movimiento->mantenimientoId = $mantto->id;
                                $movimiento->inventarioId = $item->productoId;
                                $movimiento->movimiento = 2;
                                $movimiento->cantidad =  $item->cantidad;
                                $movimiento->precioUnitario = $item->costo;
                                $movimiento->total = $item->total;
                                $movimiento->usuarioId = auth()->user()->id;
                                $movimiento->save();
                            }

                        }
                    }

                }

                // dd( 'calculo de todo el gasto de Mantenimiento',  $objGasto );

                Session::flash( 'message', 1 );
            }
        }
        return redirect()->route( 'mantenimientos.index' );
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */

    public function destroy( $id ) {
        abort_if ( Gate::denies( 'mantenimiento_destroy' ), '404' );
        //
    }
}
