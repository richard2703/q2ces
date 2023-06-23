<?php

namespace App\Http\Controllers;

use App\Models\cajaChica;
use App\Http\Controllers\Controller;
use App\Models\conceptos;
use App\Models\maquinaria;
use App\Models\obras;
use App\Models\personal;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Helpers\Calculos;

class cajaChicaController extends Controller {
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function index() {
        abort_if ( Gate::denies( 'cajachica_index' ), 403 );

        // $registros = cajaChica::get();
        $registros = cajaChica::join( 'personal', 'cajaChica.personal', 'personal.id' )
        ->join( 'obras', 'cajaChica.obra', 'obras.id' )
        ->join( 'maquinaria', 'cajaChica.equipo', 'maquinaria.id' )
        ->join( 'conceptos', 'cajaChica.concepto', 'conceptos.id' )
        ->select(
            'cajaChica.id',
            'dia',
            'conceptos.codigo',
            'conceptos.nombre as cnombre',
            'comprobante',
            'ncomprobante',
            'personal.nombres as pnombre',
            'personal.apellidoP as papellidoP',
            'cliente',
            'obras.nombre as obra',
            'maquinaria.identificador',
            'maquinaria.nombre as maquinaria',
            'cantidad',
            'cajaChica.tipo',
            'cajaChica.total'
        )->orderby( 'dia', 'desc' )->orderby( 'id', 'desc' )
        ->paginate( 15 );

        $vctTipos = [ 1, 2 ];

        $last = cajaChica::whereIn( 'cajaChica.tipo',   $vctTipos )
        ->orderby( 'dia', 'desc' )
        ->orderby( 'id', 'desc' )->first();

        $lastTotal = 0;
        if ( $last ) {
            $lastTotal = $last->total;
        }

        // dd( $last );
        // tomas::join( 'examenes', 'tomas.examenes_id', 'examenes.id' )
        // ->select( 'examenes.id', 'examenes.nombre', 'tomas.estatus', 'tomas.id as toma' )
        // ->where( 'tomas.tickets_id', $ticket->id )
        // ->paginate( 10 );
        // Dia, concepto, comprabante, numero de comprobante, cliente, obra, equipo, personal, cantidad, tipo
        return view( 'cajaChica.indexCajaChica', compact( 'registros', 'lastTotal' ) );
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function create() {
        abort_if ( Gate::denies( 'cajachica_create' ), 403 );

        $conceptos = conceptos::get();
        $personal = personal::get();
        $obras = obras::get();
        $maquinaria = maquinaria::get();
        // dd( $maquinaria );
        return view( 'cajaChica.nuevoMovimiento', compact( 'conceptos', 'personal', 'obras', 'maquinaria' ) );
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */

    public function store( Request $request ) {
        abort_if ( Gate::denies( 'cajachica_create' ), 403 );

        // dd( $request );

        $last = cajaChica::orderby( 'dia', 'desc' )->orderby( 'id', 'desc' )->first();

        if ( $last ) {
            $decTotal = $last->total;
        } else {
            $decTotal = 0;
        }

        if ( $request->tipo == 1 || $request->tipo == 2 ) {
            //*** para ingreso o egreso */
            if ( $request->tipo == 1 ) {
                $total = $decTotal + $request->cantidad;
            } else {
                $total = $decTotal - $request->cantidad;
            }
        } else {
            //*** todos los demas */
            $total = 0;
        }
        // dd( $decTotal, $total );

        $ultimo = cajaChica::create( $request->only( 'dia', 'concepto', 'comprobante', 'ncomprobante', 'cliente', 'obra', 'equipo', 'personal', 'tipo', 'cantidad', 'comentario', ) + [ 'total' => $total ] );
        Session::flash( 'message', 1 );
        return redirect()->action( [ cajachicaController::class, 'index' ] );
    }

    /**
    * Display the specified resource.
    *
    * @param  \App\Models\cajaChica  $cajaChica
    * @return \Illuminate\Http\Response
    */

    public function show( cajaChica $cajaChica ) {
        //
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Models\cajaChica  $cajaChica
    * @return \Illuminate\Http\Response
    */

    public function edit( cajaChica $cajaChica ) {
        abort_if ( Gate::denies( 'cajachica_edit' ), 403 );

        // dd( $cajaChica );

        $conceptos = conceptos::get();
        $personal = personal::get();
        $obras = obras::get();
        $maquinaria = maquinaria::get();
        return view( 'cajaChica.editMovimiento', compact( 'conceptos', 'personal', 'obras', 'maquinaria', 'cajaChica' ) );

        // {
        // {
        //     \Carbon\Carbon::parse( $tarea->fechaInicio )->format( 'd/m/Y' ) }
        // }
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Models\cajaChica  $cajaChica
    * @return \Illuminate\Http\Response
    */

    public function update( Request $request, cajaChica $cajaChica ) {
        abort_if ( Gate::denies( 'cajachica_edit' ), 403 );

        //*** Arreglo para buscar ingresos y egresos */
        $vctTipos = [ 1, 2 ];
        $blnCrearPivote = false;
        $objCalculos = new Calculos();

        //*** obtenemos la informacion del registro antes de modificar  */
        $objRecord = cajaChica::select( '*' )->where( 'id', '=',  $cajaChica->id )->first();

        if ( $objRecord->tipo <= 2 &&  $request[ 'tipo' ] > 2 ) {
            //*** se dio un cambio de tipo  */
            $blnCrearPivote = true;
        }

        // dd( $objRecord->tipo. ' = '. $cajaChica->tipo );

        $cajaChica->update( $request->only( 'dia', 'concepto', 'comprobante', 'ncomprobante', 'cliente', 'obra', 'equipo', 'personal', 'tipo', 'cantidad', 'comentario', 'total' ) );

        if ( $request[ 'tipo' ] == 1 || $request[ 'tipo' ] == 2 ) {
            //*** ejecutamos el recalculo general */
            $objCalculos->RecalcularCajaChica( $cajaChica->id );

        } else {
            $cajaChica->total = 0;
            $cajaChica->update();

            //*** se realiza el recalculo con pivote */
            if ( $blnCrearPivote == true ) {

                //*** preguntamos por el movimiento anterior a este tipo */
                //*** buscamos el registro anterior inmediato */
                $objAnterior = cajaChica::select( '*' )
                ->where( 'cajaChica.dia', '<=', $objRecord->dia )
                ->where( 'id', '!=', $cajaChica->id )
                ->where( 'id', '<', $cajaChica->id )
                ->whereIn( 'cajaChica.tipo',   $vctTipos )
                ->orderBy( 'cajaChica.id', 'desc' )->first();

                $intPivote = 0;

                if ( $objAnterior ) {
                    //*** hay un anterior */
                    $intPivote = $objAnterior->id;
                } else {
                    //** no hay anterior */
                    $objSiguiente = cajaChica::select( '*' )
                    ->where( 'cajaChica.dia', '>=', $objRecord->dia )
                    ->where( 'id', '!=', $cajaChica->id )
                    ->where( 'id', '>', $cajaChica->id )
                    ->whereIn( 'cajaChica.tipo',   $vctTipos )
                    ->orderBy( 'cajaChica.id', 'asc' )->first();

                    $intPivote = $objSiguiente->id;

                    if ( $objSiguiente ) {
                        //*** hay un posterior */
                        $intPivote = $objSiguiente->id;
                    } else {
                        //*** Es el unico registro */
                        $intPivote = 0;
                    }
                }

                //*** ejecutamos el recalculo general */
                if ( $intPivote > 0 ) {
                    $objCalculos->RecalcularCajaChica( $intPivote );
                }

            }

        }

        Session::flash( 'message', 1 );
        return redirect()->action( [ cajachicaController::class, 'index' ] );
        dd( 'update' );
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Models\cajaChica  $cajaChica
    * @return \Illuminate\Http\Response
    */

    public function destroy( cajaChica $cajaChica ) {
        abort_if ( Gate::denies( 'cajachica_destroy' ), 403 );

        dd( 'destroy' );
    }
}
