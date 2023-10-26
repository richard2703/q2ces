<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Carbon;
use App\Models\asistencia;
use App\Models\personal;
use App\Exports\CorteSemanalExport;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Excel as ExcelExcel;
// use App\Helpers\Validaciones;
use App\Helpers\Calendario;
// use App\Helpers\Calculos;
use App\Models\tipoHoraExtra;
use stdClass;

class asistenciaController extends Controller {

    public function index( $intAnio = null, $intMes = null, $intDia = null ) {
        abort_if ( Gate::denies( 'asistencia_index' ), '403' );

        // dd( $intAnio, $intMes, $intDia );

        $objCalendario = new Calendario();

        $data = request()->all();
        if ( is_array( $data ) == true && count( $data ) > 0 ) {
            $intMes = $data[ 'intMes' ];
            $intAnio = $data[ 'intAnio' ];
            $intDia = date( 'd' );
            //$data[ 'intDia' ];
        } else {
            $intMes = date( 'm' );
            $intAnio = date( 'Y' );
            $intDia = date( 'd' );
        }

        $dteMesInicio = $intAnio . '-' . $intMes . '-01';
        $dteMesFin = $intAnio . '-' . $intMes . '-' . $objCalendario->getTotalDaysInMonth( $intMes, $intAnio );

        $usuario = personal::where( 'userId', auth()->user()->id )->first();

        //*** listado de asistencias del personal */
        $personal = personal::select(
            'personal.id',
            'personal.nombres',
            'personal.apellidoP',
            'personal.apellidoM',
            DB::raw( "CONCAT(personal.nombres,' ', personal.apellidoP,' ', personal.apellidoM)as personal" ),
            DB::raw( 'puesto.nombre AS puesto' ),
            DB::raw( 'nomina.nomina AS numNomina' ),
            DB::raw( 'userEstatus.nombre AS estatus' ),
            DB::raw( 'userEstatus.color AS estatusColor' ),
            DB::raw( 'COUNT( if ( asistencia.asistenciaId = 1, 1, null ) ) as asistencias' ),
            DB::raw( 'COUNT( if ( asistencia.asistenciaId = 2, 1, null ) ) as faltas' ),
            DB::raw( 'COUNT( if ( asistencia.asistenciaId = 3, 1, null ) ) as incapacidades' ),
            DB::raw( 'COUNT( if ( asistencia.asistenciaId = 4, 1, null ) ) as vacaciones' ),
            DB::raw( 'COUNT( if ( asistencia.asistenciaId = 5, 1, null ) ) as descansos' ),
            DB::raw( 'SUM( asistencia.horasExtra )as extras' ),
            DB::raw( 'SUM( asistencia.totalHorasExtra )as horasExtras' ),
            DB::raw( 'COUNT( asistencia.id )as dias' )
        )
        ->join( 'nomina', 'nomina.personalId', '=', 'personal.id' )
        ->join( 'asistencia', 'asistencia.personalId', '=', 'personal.id' )
        ->join( 'userEstatus', 'userEstatus.id', '=', 'personal.estatusId' )
        ->join( 'puesto', 'puesto.id', '=', 'nomina.puestoId' )
        ->join( 'puestoNivel', 'puestoNivel.id', '=', 'puesto.puestoNivelId' )
        ->where( 'puestoNivel.requiereAsistencia', '=', '1' )
        ->where( 'personal.estatusId', '=', '1' )
        ->whereBetween( 'asistencia.fecha',   [ $dteMesInicio, $dteMesFin ] )
        ->groupBy( 'asistencia.personalId' )
        ->orderBy( 'personal.apellidoP', 'asc' )->get();

        //*** lista de asistencia */
        $listaAsistencia = personal::select(
            'personal.id',
            'personal.nombres',
            'personal.apellidoP',
            'personal.apellidoM',
            DB::raw( "CONCAT(personal.nombres,' ', personal.apellidoP,' ', personal.apellidoM)as personal" ),
            DB::raw( 'puesto.nombre AS puesto' ),
            DB::raw( 'puestoNivel.nombre AS puestoNivel' ),
            DB::raw( 'nomina.nomina AS numNomina' ),
            DB::raw( 'userEstatus.nombre AS estatus' ),
            DB::raw( 'userEstatus.color AS estatusColor' )
        )
        ->join( 'nomina', 'nomina.personalId', '=', 'personal.id' )
        ->join( 'userEstatus', 'userEstatus.id', '=', 'personal.estatusId' )
        ->join( 'puesto', 'puesto.id', '=', 'nomina.puestoId' )
        ->join( 'puestoNivel', 'puestoNivel.id', '=', 'puesto.puestoNivelId' )
        ->where( 'puestoNivel.requiereAsistencia', '=', '1' )
        ->where( 'personal.estatusId', '=', '1' )
        ->orderBy( 'personal.apellidoP', 'asc' )->get();

        // dd( $intAnio, $intMes, $intDia, $listaAsistencia );
        return view( 'asistencias.indexAsistencias', compact( 'usuario', 'personal', 'listaAsistencia', 'intDia', 'intMes', 'intAnio' ) );
    }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */

    public function reloadAsistencia( $intAnio, $intMes ) {
        // dd( $intAnio, $intMes );

        return redirect()->action( [ asistenciaController::class, 'index' ], [ 'intAnio' => $intAnio, 'intMes' => $intMes ] );
    }

    public function cambioMesAsistencia( Request $request ) {

        $data = request()->all();

        // dd( $data );

        if ( $data[ 'fechaAsistencia' ] != '' ) {
            $dtFecha = date_create( date( 'Y-m-d', strtotime( $data[ 'fechaAsistencia' ] ) ) );
            // dd( $data[ 'fechaAsistencia' ], $dtFecha );
            return redirect()->action( [ asistenciaController::class, 'index' ], [ 'intAnio' => $dtFecha->format( 'Y' ), 'intMes' => $dtFecha->format( 'm' ) ] );
        }
    }

    public function cambioDiaAsistencia( Request $request ) {

        $data = request()->all();
        if ( $data[ 'fechaAsistencia' ] != '' ) {
            $dtFecha = date_create( date( 'Y-m-d', strtotime( $data[ 'fechaAsistencia' ] ) ) );
            return redirect()->action( [ asistenciaController::class, 'create' ], [ 'intAnio' => $dtFecha->format( 'Y' ), 'intMes' => $dtFecha->format( 'm' ), 'intDia' => $dtFecha->format( 'd' ) ] );
        }
    }

    public function cambioDiaExtras( Request $request ) {

        $data = request()->all();
        if ( $data[ 'fechaAsistencia' ] != '' ) {
            $dtFecha = date_create( date( 'Y-m-d', strtotime( $data[ 'fechaAsistencia' ] ) ) );
            return redirect()->action( [ asistenciaController::class, 'horasExtra' ], [ 'intAnio' => $dtFecha->format( 'Y' ), 'intMes' => $dtFecha->format( 'm' ), 'intDia' => $dtFecha->format( 'd' ) ] );
        }
    }

    /**
    * Carga del personal para asistencia diaria
    *
    * @param [ type ] $intAnio
    * @param [ type ] $intMes
    * @param [ type ] $intDia
    * @return void
    */

    public function create( Request $request, $intAnio = null, $intMes = null, $intDia = null ) {
        abort_if ( Gate::denies( 'asistencia_create' ), '403' );

        $objCalendario = new Calendario();

        $data = request()->all();
        // dd( request()->all() );
        if ( is_array( $data ) == true && count( $data ) > 0 ) {
            $intMes = $data[ 'intMes' ];
            $intAnio = $data[ 'intAnio' ];
            $intDia = $data[ 'intDia' ];
        } else {
            $intMes = date( 'm' );
            $intAnio = date( 'Y' );
            $intDia = date( 'd' );
        }

        $strDate = $intAnio . '-' . $intMes . '-' . $intDia;

        $usuario = personal::where( 'userId', auth()->user()->id )->first();

        $personal = personal::select(
            'personal.*',
            DB::raw( 'puesto.nombre AS puesto' ),
            DB::raw( 'puestoNivel.nombre AS puestoNivel' ),
            DB::raw( 'userEstatus.nombre AS estatus' ),
            DB::raw( 'userEstatus.color AS estatusColor' ),
            DB::raw( 'nomina.nomina AS numNomina' ),
            DB::raw( 'nomina.hEntrada AS horarioEntrada' ),
            DB::raw( 'nomina.hSalida AS horarioSalida' ),
            DB::raw( 'nomina.hEntradaSabado AS horarioEntradaSabado' ),
            DB::raw( 'nomina.hSalidaSabado AS horarioSalidaSabado' ),
            DB::raw( 'nomina.ingreso AS fechaIngreso' ),
        )
        ->join( 'nomina', 'nomina.personalId', '=', 'personal.id' )
        ->join( 'puesto', 'puesto.id', '=', 'nomina.puestoId' )
        ->join( 'puestoNivel', 'puestoNivel.id', '=', 'puesto.puestoNivelId' )
        ->join( 'userEstatus', 'userEstatus.id', '=', 'personal.estatusId' )
        ->where( 'puestoNivel.requiereAsistencia', '=', '1' )
        ->where( 'userEstatus.id', '=', '1' )
        ->where( 'nomina.ingreso', '<=', $strDate )
        ->orderBy( 'personal.apellidoP', 'asc' )->get();

        $dteMesInicio = $intAnio . '-' . $intMes . '-01';
        $dteMesFin = $intAnio . '-' . $intMes . '-' . $objCalendario->getTotalDaysInMonth( $intMes, $intAnio );

        $asistencias = personal::select(
            'personal.*', 'asistencia.*',
            DB::raw( 'puesto.nombre AS puesto' ),
            DB::raw( 'puestoNivel.nombre AS puestoNivel' ),
            DB::raw( 'userEstatus.nombre AS estatus' ),
            DB::raw( 'userEstatus.color AS estatusColor' ),
            DB::raw( 'nomina.nomina AS numNomina' ),
            DB::raw( 'nomina.hEntrada AS horarioEntrada' ),
            DB::raw( 'nomina.hSalida AS horarioSalida' ),
            DB::raw( 'nomina.hEntradaSabado AS horarioEntradaSabado' ),
            DB::raw( 'nomina.hSalidaSabado AS horarioSalidaSabado' ),
            DB::raw( 'nomina.ingreso AS fechaIngreso' ),
            DB::raw( 'asistencia.id AS recordId' ),
            DB::raw( 'asistencia.entradaAnticipada' ),
        )
        ->join( 'nomina', 'nomina.personalId', '=', 'personal.id' )
        ->join( 'puesto', 'puesto.id', '=', 'nomina.puestoId' )
        ->join( 'puestoNivel', 'puestoNivel.id', '=', 'puesto.puestoNivelId' )
        ->join( 'userEstatus', 'userEstatus.id', '=', 'personal.estatusId' )
        ->join( 'asistencia', 'asistencia.personalId', '=', 'personal.id' )
        ->where( 'puestoNivel.requiereAsistencia', '=', '1' )
        ->where( 'userEstatus.id', '=', '1' )
        ->where( 'nomina.ingreso', '<=', $strDate )
        ->where( 'asistencia.fecha', '=', $strDate )
        ->orderBy( 'personal.apellidoP', 'asc' )->get();

        //*** validamos si ya se tomo asistencia para enviar la orden de actualización en bloque */
        $blnAsistenciaRegistrada = ( $asistencias->IsEmpty() == true ?false:true )  ;

        // dd( $personal, $asistencias, $blnAsistenciaRegistrada,  $asistencias->IsEmpty() );

        return view( 'asistencias.asistenciaDiaria', compact( 'usuario', 'personal', 'asistencias', 'intDia', 'intMes', 'intAnio', 'blnAsistenciaRegistrada' ) );
    }

    public function reloadLista( $intAnio, $intMes, $intDia ) {
        // dd( $intAnio, $intMes, $intDia );
        return redirect()->action( [ asistenciaController::class, 'create' ], [ 'intAnio' => $intAnio, 'intMes' => $intMes, 'intDia' => $intDia ] );
    }

    /**
    * Registra la asistencia del día
    *
    * @param Request $request
    * @return void
    */

    public function store( Request $request ) {
        abort_if ( Gate::denies( 'asistencia_create' ), '403' );

        $vctDebug = array();

        // dd( $request );
        $i = 0;
        if ( $request[ 'blnAsistenciaRegistrada' ] == true ) {
            //*** Hay registros, es el cierre */
            $vctIds = array();
            foreach ( $request[ 'recordId' ]as $value ) {

                $objRecord = asistencia::where( 'id', '=', $request[ 'recordId' ][ $i ] )->first();
                if ( $objRecord ) {

                    $vctDebug[] = $request->$value[ 0 ][ 0 ] ;

                    $objRecord->asistenciaId = $request->$value[ 0 ];
                    $objRecord->entradaAnticipada =  ( $request->$value[ 0 ] == 1 ?  $request[ 'entradaAnticipada' ][ $i ]:0 );
                    $objRecord->hEntrada = ( $request->$value[ 0 ] == 1 ?  $request[ 'hEntrada' ][ $i ]:null );
                    $objRecord->hSalida = ( $request->$value[ 0 ] == 1 ?   $request[ 'hSalida' ][ $i ]:null );

                    //*** calculamos tiempo extra anticipado */
                    $objRecord->horasAnticipada = 0;

                    $dteHorario =   Carbon::parse( $request[ 'horarioEntrada' ][ $i ] );
                    $dteHoraEntrada =  Carbon::parse( $request[ 'hEntrada' ][ $i ] );

                    if ( $request[ 'entradaAnticipada' ][ $i ] == 1 ) {
                        $intMinutos = 0;

                        //*** preguntamos si la entrada es menor que la hora salida */
                        if ( $dteHoraEntrada < $dteHorario ) {
                            $intMinutos = $dteHoraEntrada->diffInMinutes( $dteHorario ) ;
                            $vctDebug[] = 'Tengo tiempo anticipado '. $intMinutos . ' minutos' ;
                        } else {
                            $vctDebug[] = 'No tengo tiempo anticipado' ;
                        }

                        $objRecord->horasAnticipada = $intMinutos;
                    }

                    //*** calculamos tiempo de retraso de entrada */
                    $objRecord->horasRetraso = 0;

                    //*** preguntamos si la entrada es menor que la hora salida */
                    if ( $dteHoraEntrada > $dteHorario ) {
                        $objRecord->horasRetraso = $dteHoraEntrada->diffInMinutes( $dteHorario ) ;
                        $vctDebug[] = 'Tengo un retraso de '. $objRecord->horasRetraso . ' minutos' ;
                    } else {
                        $vctDebug[] = 'Sin retraso' ;
                    }

                    $dteHorarioSalida = null;
                    $dteHoraSalida = null;

                    //*** obtenemos los minutos de diferencia */
                    if ( is_null( $request[ 'horarioSalida' ][ $i ] ) == false &&  is_null( $request[ 'hSalida' ][ $i ] ) == false ) {

                        $intMinutos = 0;
                        $dteHorarioSalida =   Carbon::parse( $request[ 'horarioSalida' ][ $i ] );
                        $dteHoraSalida =  Carbon::parse( $request[ 'hSalida' ][ $i ] );

                        //*** preguntamos si la salida es mayor que la hora salida */
                        if ( $dteHoraSalida > $dteHorarioSalida ) {
                            $intMinutos = $dteHoraSalida->diffInMinutes( $dteHorarioSalida ) ;
                            // $objAsistencia->tipoHoraExtraId = $request[ 'tipoHoraExtraId' ][ $i ];
                            $vctDebug[] = 'Tengo tiempo extra '. $intMinutos . ' minutos' ;
                        } else {
                            $vctDebug[] = 'No tengo tiempo extra'  ;
                            // $objAsistencia->tipoHoraExtraId = 1;
                        }

                        //*** validamos el descuento de tiempo de retraso */
                        if ( $objRecord->horasRetraso > 0 ) {
                            $vctDebug[] = 'Se aplica descuento de tiempo por retraso de entrada'  ;
                            $objRecord->horasExtra = ( $intMinutos - $objRecord->horasRetraso );

                        } else {
                            $vctDebug[] = 'Sin descuento de tiempo por retraso de entrada'  ;
                            $objRecord->horasExtra = $intMinutos;
                        }

                    } else {
                        //*** se marca en 0 y se marca que no aplica */
                        $vctDebug[] = 'No tengo tiempo extra definido todavia'  ;
                        $objRecord->horasExtra = 0;
                        $objRecord->totalHorasExtra = 0;
                    }

                    //*** obtenemos las horas extras a pagar */
                    $intHoras = ( int ) (( $objRecord->horasExtra + $objRecord->horasAnticipada ) / 60 );
                    $intHorasFraccionadas = ( ( $objRecord->horasExtra + $objRecord->horasAnticipada ) >= 35 ? 1 : 0 );
                    $objRecord->totalHorasExtra = $intHoras + $intHorasFraccionadas;

                    $objRecord->hSalida = $request[ 'hSalida' ][ $i ];

                    $vctDebug[] = $objRecord  ;
                    $objRecord->save();
                    // $vctIds[] = $objRecord;
                }

                $i += 1;
            }

            // dd( $vctIds );

        } else {
            //*** no hay registros, es la apertura */
            foreach ( $request[ 'personalId' ] as $value ) {
                // dd( $request->$value[ 0 ] );

                $objAsistencia = new asistencia();
                $objAsistencia->personalId = $request[ 'personalId' ][ $i ];
                $objAsistencia->asistenciaId = $request->$value[ 0 ];
                $objAsistencia->fecha = $request[ 'fecha' ];
                $objAsistencia->horasExtra = $request[ 'horasExtra' ];
                $objAsistencia->hEntrada = $request[ 'hEntrada' ][ $i ];
                $objAsistencia->hSalida = $request[ 'hSalida' ][ $i ];
                // $objAsistencia->tipoHoraExtraId = 1;
                $objAsistencia->save();
                // dd( $objAsistencia );
                $i += 1;
            }

        }

        // dd( $vctDebug, $request );

        return redirect()->action( [ asistenciaController::class, 'index' ], [ 'intAnio' => $request[ 'intAnio' ], 'intMes' => $request[ 'intMes' ] ] );
    }

    /**
    * Registra las horas extras del día
    *
    * @param Request $request
    * @return void
    */

    public function horasExtra() {
        abort_if ( Gate::denies( 'asistencia_edit' ), '403' );

        $objCalendario = new Calendario();

        $data = request()->all();
        if ( is_array( $data ) == true && count( $data ) > 0 ) {
            $intMes = $data[ 'intMes' ];
            $intAnio = $data[ 'intAnio' ];
            $intDia = $data[ 'intDia' ];
        } else {
            $intMes = date( 'm' );
            $intAnio = date( 'Y' );
            $intDia = date( 'd' );
        }

        $strDate = $intAnio . '-' . $intMes . '-' . $intDia;

        $usuario = personal::where( 'userId', auth()->user()->id )->first();
        $asistencias = personal::select(
            'personal.*', 'asistencia.*',
            DB::raw( "CONCAT(personal.nombres,' ', personal.apellidoP,' ', personal.apellidoM)as personal" ),
            DB::raw( 'puesto.nombre AS puesto' ),
            DB::raw( 'puestoNivel.nombre AS puestoNivel' ),
            DB::raw( 'userEstatus.nombre AS estatus' ),
            DB::raw( 'userEstatus.color AS estatusColor' ),
            DB::raw( 'nomina.nomina AS numNomina' ),
            DB::raw( 'nomina.hSalidaSabado AS horarioSalidaSabado' ),
            DB::raw( 'nomina.hSalida AS horarioSalida' ),
            DB::raw( 'nomina.ingreso AS fechaIngreso' ),
            DB::raw( 'asistencia.id AS recordId' ),
            DB::raw( 'asistencia.id AS asistenciaId' ),
            DB::raw( 'asistencia.entradaAnticipada' ),
        )
        ->join( 'nomina', 'nomina.personalId', '=', 'personal.id' )
        ->join( 'puesto', 'puesto.id', '=', 'nomina.puestoId' )
        ->join( 'puestoNivel', 'puestoNivel.id', '=', 'puesto.puestoNivelId' )
        ->join( 'userEstatus', 'userEstatus.id', '=', 'personal.estatusId' )
        ->join( 'asistencia', 'asistencia.personalId', '=', 'personal.id' )
        ->where( 'puestoNivel.requiereAsistencia', '=', '1' )
        ->where( 'personal.estatusId', '=', '1' )
        ->where( 'asistencia.asistenciaId', '=', '1' )
        ->where( 'asistencia.fecha', '=', $strDate )
        ->orderBy( 'personal.apellidoP', 'asc' )->get();

        //*** lista de asistencia */
        $listaAsistencia = personal::select(
            'personal.id',
            'personal.nombres',
            'personal.apellidoP',
            'personal.apellidoM',
            DB::raw( "CONCAT(personal.nombres,' ', personal.apellidoP,' ', personal.apellidoM)as personal" ),
            DB::raw( 'puesto.nombre AS puesto' ),
            DB::raw( 'puestoNivel.nombre AS puestoNivel' ),
            DB::raw( 'nomina.nomina AS numNomina' ),
            DB::raw( 'userEstatus.nombre AS estatus' ),
            DB::raw( 'userEstatus.color AS estatusColor' )
        )
        ->join( 'nomina', 'nomina.personalId', '=', 'personal.id' )
        ->join( 'userEstatus', 'userEstatus.id', '=', 'personal.estatusId' )
        ->join( 'puesto', 'puesto.id', '=', 'nomina.puestoId' )
        ->join( 'puestoNivel', 'puestoNivel.id', '=', 'puesto.puestoNivelId' )
        ->where( 'puestoNivel.requiereAsistencia', '=', '1' )
        ->where( 'userEstatus.id', '=', '1' )
        ->orderBy( 'personal.apellidoP', 'asc' )->get();

        $vctTiposHoras = tipoHoraExtra::all();

        $dteMesInicio = $intAnio . '-' . $intMes . '-01';
        $dteMesFin = $intAnio . '-' . $intMes . '-' . $objCalendario->getTotalDaysInMonth( $intMes, $intAnio );

        // dd( $asistencias, $listaAsistencia );

        return view( 'asistencias.horasExtra', compact( 'usuario', 'asistencias', 'listaAsistencia', 'vctTiposHoras', 'intDia', 'intMes', 'intAnio' ) );
    }

    public function reloadHorasExtra( $intAnio, $intMes, $intDia ) {
        // dd( $intAnio, $intMes, $intDia );
        return redirect()->action( [ asistenciaController::class, 'horasExtra' ], [ 'intAnio' => $intAnio, 'intMes' => $intMes, 'intDia' => $intDia ] );
    }

    public function HEstore( Request $request ) {
        // dd( $request );
        abort_if ( Gate::denies( 'asistencia_edit' ), '403' );

        $vctItems =   array();
        for (
            $i = 0; $i < count( $request[ 'asistenciaId' ] );
            $i++
        ) {
            if ( $request[ 'asistenciaId' ][ $i ] != '' ) {
                //** Actualizacion de registro */
                $objAsistencia =  asistencia::where( 'id', '=', $request[ 'asistenciaId' ][ $i ] )->first();

                if ( $objAsistencia ) {

                    $dteHorario = null;
                    $dteHoraSalida = null;

                    //*** obtenemos los minutos de diferencia */
                    if ( is_null( $request[ 'horarioSalida' ][ $i ] ) == false &&  is_null( $request[ 'hSalida' ][ $i ] ) == false ) {

                        $intMinutos = 0;
                        $dteHorario =   Carbon::parse( $request[ 'horarioSalida' ][ $i ] );
                        $dteHoraSalida =  Carbon::parse( $request[ 'hSalida' ][ $i ] );

                        //*** preguntamos si la salida es mayor que la hora salida */
                        if ( $dteHoraSalida > $dteHorario ) {
                            $intMinutos = $dteHoraSalida->diffInMinutes( $dteHorario ) ;
                            // $objAsistencia->tipoHoraExtraId = $request[ 'tipoHoraExtraId' ][ $i ];
                            // dd( 'Soy mayor '. $intMinutos . ' minutos' );
                        } else {
                            //  dd( 'Soy menor' );
                            // $objAsistencia->tipoHoraExtraId = 1;
                        }

                        $objAsistencia->horasExtra = $intMinutos;

                    } else {
                        //*** se marca en 0 y se marca que no aplica */
                        $objAsistencia->horasExtra = 0;
                        //$objAsistencia->tipoHoraExtraId = 1;

                    }

                    //*** obtenemos las horas extras a pagar */
                    $intHoras = ( int ) (( $objAsistencia->horasExtra + $objAsistencia->horasAnticipada ) / 60 );
                    $intHorasFraccionadas = ( ( $objAsistencia->horasExtra + $objAsistencia->horasAnticipada ) >= 35 ? 1 : 0 );
                    $objAsistencia->totalHorasExtra = $intHoras + $intHorasFraccionadas;

                    $objAsistencia->hSalida = $request[ 'hSalida' ][ $i ];

                    $objAsistencia->save();
                    $vctItems [] = $objAsistencia;

                    // dd( $request[ 'horarioSalida' ][ $i ],  $dteHorario, $request[ 'hSalida' ][ $i ], $dteHoraSalida, $objAsistencia );

                }
            } else {
                // dd( 'No hay id' );
            }
        }

        // dd( $vctItems );

        return redirect()->action( [ asistenciaController::class, 'index' ], [ 'intAnio' => $request[ 'intAnio' ], 'intMes' => $request[ 'intMes' ] ] );
    }

    /**
    * Detalle de la semana de trabajo de un empleado de personal
    *
    * @param personal $personal
    * @return void
    */

    public function show( $personalId, $intAnio = null, $intMes = null, $intDia = null ) {

        abort_if ( Gate::denies( 'asistencia_show' ), '403' );

        $objCalendario = new Calendario();

        $data = request()->all();
        if ( is_array( $data ) == true && count( $data ) > 0 ) {
            $intMes = $data[ 'intMes' ];
            $intAnio = $data[ 'intAnio' ];
            $intDia = $data[ 'intDia' ];
        } else {
            $intMes = date( 'm' );
            $intAnio = date( 'Y' );
            $intDia = date( 'd' );
        }

        $strDate = $intAnio . '-' . $intMes . '-' . $intDia;
        $vctFechas =  $objCalendario->getSemanaTrabajo( date_create( $strDate ), 3 );
        $strFechaInicioPeriodo = $vctFechas[ 0 ]->format( 'Y-m-d' );
        $strFechaFinPeriodo = $vctFechas[ 1 ]->format( 'Y-m-d' );

        $usuario = personal::where( 'userId', auth()->user()->id )->first();
        $personal = personal::select(
            'personal.*',
            DB::raw( "CONCAT(personal.nombres,' ', personal.apellidoP,' ', personal.apellidoM)as personal" ),
            DB::raw( 'puesto.nombre AS puesto' ),
            DB::raw( 'nomina.hEntrada AS horarioEntrada' ),
            DB::raw( 'nomina.hSalida AS horarioSalida' ),
            DB::raw( 'nomina.hEntradaSabado AS horarioEntradaSabado' ),
            DB::raw( 'nomina.hSalidaSabado AS horarioSalidaSabado' ),
            DB::raw( 'nomina.nomina AS numNomina' ),
        )
        ->join( 'nomina', 'nomina.personalId', '=', 'personal.id' )
        ->join( 'puesto', 'puesto.id', '=', 'nomina.puestoId' )
        ->join( 'puestoNivel', 'puestoNivel.id', '=', 'puesto.puestoNivelId' )
        ->where( 'personal.id', $personalId )->first();

        $asistencias = personal::select(
            DB::raw( 'personal.id AS personalId' ),
            'personal.nombres',
            'personal.apellidoP',
            'personal.apellidoM',
            DB::raw( 'nomina.nomina AS numNomina' ),
            DB::raw( "CONCAT(personal.nombres,' ', personal.apellidoP,' ', personal.apellidoM)as personal" ),
            DB::raw( 'puestoNivel.nombre AS puesto' ),
            DB::raw( 'asistencia.id AS id' ),
            'asistencia.horasExtra',
            'asistencia.horasAnticipada',
            'asistencia.fecha',
            'asistencia.asistenciaId',
            'asistencia.comentario',
            // 'asistencia.tipoHoraExtraId',
            DB::raw( 'nomina.hEntrada AS horarioEntrada' ),
            DB::raw( 'nomina.hSalida AS horarioSalida' ),
            DB::raw( 'nomina.hEntradaSabado AS horarioEntradaSabado' ),
            DB::raw( 'nomina.hSalidaSabado AS horarioSalidaSabado' ),
            DB::raw( 'asistencia.entradaAnticipada' ),
            'asistencia.hEntrada',
            'asistencia.hSalida'
        )
        ->join( 'nomina', 'nomina.personalId', '=', 'personal.id' )
        ->join( 'asistencia', 'asistencia.personalId', '=', 'personal.id' )
        ->join( 'puesto', 'puesto.id', '=', 'nomina.puestoId' )
        ->join( 'puestoNivel', 'puestoNivel.id', '=', 'puesto.puestoNivelId' )
        ->where( 'puestoNivel.requiereAsistencia', '=', '1' )
        ->where( 'asistencia.personalId', '=', $personal->id )
        ->whereBetween( 'asistencia.fecha',   [ $strFechaInicioPeriodo, $strFechaFinPeriodo ] )
        ->orderBy( 'asistencia.fecha', 'asc' )->get();

        $dteMesInicio = $intAnio . '-' . $intMes . '-01';
        $dteMesFin = $intAnio . '-' . $intMes . '-' . $objCalendario->getTotalDaysInMonth( $intMes, $intAnio );
        $vctTiposHoras = tipoHoraExtra::all();

        // dd( $asistencias, $intAnio, $intMes, $intDia, $strDate, $vctFechas[ 0 ], $vctFechas[ 1 ] );

        return view( 'asistencias.asistenciaDetalle',  compact( 'usuario', 'personal', 'asistencias', 'vctTiposHoras', 'intDia', 'intMes', 'intAnio', 'strFechaInicioPeriodo', 'strFechaFinPeriodo' ) );
    }

    public function reloadDetalle( $personalId, $intAnio, $intMes, $intDia ) {
        // dd( $personalId, $intAnio, $intMes, $intDia );
        return redirect()->action( [ asistenciaController::class, 'show' ], [ 'personalId' => $personalId, 'intAnio' => $intAnio, 'intMes' => $intMes, 'intDia' => $intDia ] );
    }

    public function corteSemanal( $intAnio = null, $intMes = null, $intDia = null ) {
        abort_if ( Gate::denies( 'asistencia_execute_corte_semanal' ), '403' );

        abort_if ( Gate::denies( 'asistencia_index' ), '403' );
        $objCalendario = new Calendario();

        $data = request()->all();
        if ( is_array( $data ) == true && count( $data ) > 0 ) {
            $intMes = $data[ 'intMes' ];
            $intAnio = $data[ 'intAnio' ];
            $intDia = $data[ 'intDia' ];
        } else {
            $intMes = date( 'm' );
            $intAnio = date( 'Y' );
            $intDia = date( 'd' );
        }

        $strDate = $intAnio . '-' . $intMes . '-' . $intDia;
        $vctFechas =  $objCalendario->getSemanaTrabajo( date_create( $strDate ), 3 );
        $strFechaInicioPeriodo = $vctFechas[ 0 ]->format( 'Y-m-d' );
        $strFechaFinPeriodo = $vctFechas[ 1 ]->format( 'Y-m-d' );

        // dd( $strDate, $vctFechas, $strFechaInicioPeriodo, $strFechaFinPeriodo );

        $usuario = personal::where( 'userId', auth()->user()->id )->first();
        // $personal = personal::where( 'id', $personalId )->first();

        $asistencias = personal::select(
            DB::raw( 'personal.id AS personalId' ),
            DB::raw( "CONCAT( personal.apellidoP,' ', personal.apellidoM,', ',personal.nombres)as personal" ),
            DB::raw( 'puestoNivel.nombre AS puesto' ),
            DB::raw( 'asistencia.id AS id' ),
            DB::raw( 'asistencia.asistenciaId as tipoAsistenciaId' ),
            'asistencia.horasExtra',
            'asistencia.horasAnticipada',
            'asistencia.horasRetraso',
            'asistencia.fecha',
            DB::raw( 'nomina.diario AS sueldo' ),
            DB::raw( 'nomina.nomina AS numeroNomina' ),
            DB::raw( 'tipoAsistencia.color AS tipoAsistenciaColor' ),
            DB::raw( 'tipoAsistencia.nombre AS tipoAsistenciaNombre' ),
            DB::raw( 'tipoAsistencia.esAsistencia AS esAsistencia' ),
            // DB::raw( 'tipoHoraExtra.color AS horaExtraColor' ),
            // DB::raw( 'tipoHoraExtra.valor AS horaExtraCosto' ),
            // DB::raw( 'tipoHoraExtra.nombre AS horaExtraNombre' ),
            DB::raw( 'userEstatus.nombre AS estatus' ),
            DB::raw( 'userEstatus.color AS estatusColor' ),
            DB::raw( 'asistencia.entradaAnticipada' ),
        )
        ->join( 'nomina', 'nomina.personalId', '=', 'personal.id' )
        ->join( 'asistencia', 'asistencia.personalId', '=', 'personal.id' )
        ->join( 'tipoAsistencia', 'tipoAsistencia.id', '=', 'asistencia.asistenciaId' )
        // ->join( 'tipoHoraExtra', 'tipoHoraExtra.id', '=', 'asistencia.tipoHoraExtraId' )
        ->join( 'userEstatus', 'userEstatus.id', '=', 'personal.estatusId' )
        ->join( 'puesto', 'puesto.id', '=', 'nomina.puestoId' )
        ->join( 'puestoNivel', 'puestoNivel.id', '=', 'puesto.puestoNivelId' )
        ->where( 'puestoNivel.requiereAsistencia', '=', '1' )
        // ->where( 'asistencia.personalId', '=', 12 )
        ->whereBetween( 'asistencia.fecha',   [ $strFechaInicioPeriodo, $strFechaFinPeriodo ] )
        ->orderBy( 'personal.apellidoP', 'asc' )
        ->orderBy( 'asistencia.personalId', 'asc' )
        ->orderBy( 'asistencia.fecha', 'asc' )->get();

        //*** lista de asistencia */
        $listaAsistencia = personal::select(
            'personal.id',
            'personal.nombres',
            'personal.apellidoP',
            'personal.apellidoM',
            DB::raw( 'puestoNivel.nombre AS puesto' ),
            DB::raw( "CONCAT(personal.nombres,' ', personal.apellidoP,' ', personal.apellidoM)as personal" ),
            DB::raw( 'puestoNivel.nombre AS puesto' ),
            DB::raw( 'nomina.nomina AS numNomina' ),
            DB::raw( 'userEstatus.nombre AS estatus' ),
            DB::raw( 'userEstatus.color AS estatusColor' )
        )
        ->join( 'nomina', 'nomina.personalId', '=', 'personal.id' )
        ->join( 'puesto', 'puesto.id', '=', 'nomina.puestoId' )
        ->join( 'puestoNivel', 'puestoNivel.id', '=', 'puesto.puestoNivelId' )
        ->join( 'userEstatus', 'userEstatus.id', '=', 'personal.estatusId' )
        ->where( 'puestoNivel.requiereAsistencia', '=', '1' )
        ->orderBy( 'personal.apellidoP', 'asc' )->get();

        $dteMesInicio = $intAnio . '-' . $intMes . '-01';
        $dteMesFin = $intAnio . '-' . $intMes . '-' . $objCalendario->getTotalDaysInMonth( $intMes, $intAnio );

        $vctAsistencias = array();
        $vctEmpleado = array();
        $vctPagos = array();
        $intDiaTrabajado = 0;
        $strEmpleado = null;
        $intEmpleado = null;

        $vctDebug = array();
        $intCont = 0;
        $intTotalAsistencias = count( $asistencias )-1;

        foreach ( $asistencias as $key => $item ) {

            $vctDebug[] = $intCont .'.- ' .$item->personal ;
            // $vctDebug[] = $item;

            if ( $intCont == $intTotalAsistencias ) {
                $vctDebug[] = 'Es el final iniciando...';
            }

            $vctDebug[] = '*** Creamos el primer objeto para trabajar y se asigna a ' . $intDiaTrabajado . ' - '. $strEmpleado;
            if ( $intDiaTrabajado == 0 && $strEmpleado == null ) {
                $vctDebug[] = '*** Creamos el primer objeto para trabajar y se asigna a ' . $item->personal;
                $objDia = new stdClass;
            } else {
                //*** el objeto sigue vivo */
                $vctDebug[] = 'Seguimos con el objeto ' .  $item->personal  ;
            }

            if ( $intDiaTrabajado == 0 && $strEmpleado == null ) {
                $vctDebug[] = '-> Trabajamos con el Primer registro de empleado a trabajar : ' . $item->personal ;
                unset( $vctPagos );
                $strEmpleado = $item->personal;
                $objDia->numEmpleado = str_pad( $item->numeroNomina, 4, '0', STR_PAD_LEFT );
                $objDia->empleado = $item->personal;
                $objDia->puesto = $item->puesto;
                $objDia->sueldo = $item->sueldo;
                $objDia->estatus = $item->estatus;
                $objDia->estatusColor = $item->estatusColor;

                $objPagos = new stdClass;
                $objPagos->fecha = $item->fecha;
                $objPagos->horasExtra = $item->horasExtra;
                $objPagos->horasAnticipada = $item->horasAnticipada;
                $objPagos->horasRetraso = $item->horasRetraso;
                $objPagos->tipoAsistencia = $item->tipoAsistenciaId;
                $objPagos->esAsistencia = $item->esAsistencia;
                $objPagos->entradaAnticipada = $item->entradaAnticipada;
                $objPagos->tipoAsistenciaColor = $item->tipoAsistenciaColor;
                $objPagos->tipoAsistenciaNombre = $item->tipoAsistenciaNombre;
                $vctPagos[] = $objPagos;

                $intDiaTrabajado += 1;
                $vctDebug[] = '<- Terminamos con el Primer registro de empleado a trabajar : ' . $item->personal ;
            } else  if ( ( $intDiaTrabajado == 6 ) && ( $strEmpleado ==  $item->personal ) ) {
                $vctDebug[] = '-> Ultimo registro del empleado del periodo en los casos ' . $item->personal;
                $objPagos = new stdClass;
                $objPagos->fecha = $item->fecha;
                $objPagos->horasExtra = $item->horasExtra;
                $objPagos->horasAnticipada = $item->horasAnticipada;
                $objPagos->horasRetraso = $item->horasRetraso;
                $objPagos->tipoAsistencia = $item->tipoAsistenciaId;
                $objPagos->esAsistencia = $item->esAsistencia;
                $objPagos->entradaAnticipada = $item->entradaAnticipada;
                $objPagos->tipoAsistenciaColor = $item->tipoAsistenciaColor;
                $objPagos->tipoAsistenciaNombre = $item->tipoAsistenciaNombre;
                $vctPagos[] = $objPagos;

                $objDia->pagos  = $vctPagos;
                $vctAsistencias[] =  $objDia;

                $intDiaTrabajado = 0;
                $strEmpleado = null;
                unset( $vctPagos );
                $vctDebug[] = '<- Terminamos las asistencias de la semana de ' . $item->personal;

            } else  if ( ( $intDiaTrabajado > 0 &&  $intDiaTrabajado < 6 ) &&  ( $strEmpleado ==  $item->personal ) ) {
                $vctDebug[] = '-> Seguimos con el siguiente dia y verificamos que se trate de la misma persona ' . $item->personal;

                $objPagos = new stdClass;
                $objPagos->fecha = $item->fecha;
                $objPagos->horasExtra = $item->horasExtra;
                $objPagos->horasAnticipada = $item->horasAnticipada;
                $objPagos->horasRetraso = $item->horasRetraso;
                $objPagos->tipoAsistencia = $item->tipoAsistenciaId;
                $objPagos->esAsistencia = $item->esAsistencia;
                $objPagos->entradaAnticipada = $item->entradaAnticipada;
                $objPagos->tipoAsistenciaColor = $item->tipoAsistenciaColor;
                $objPagos->tipoAsistenciaNombre = $item->tipoAsistenciaNombre;
                $vctPagos[] = $objPagos;
                $intDiaTrabajado += 1;
                $vctDebug[] = $objPagos;

                if ( $intCont == $intTotalAsistencias ) {
                    $vctDebug[] = 'Es el final ' . $intCont;

                    $objDia->pagos  = $vctPagos;
                    $vctAsistencias[] =  $objDia;
                }

            } else {
                $vctDebug[] = '-> El empleado ya no tiene registros de asistencia y hay que cerrar su objeto ' . $item->personal;
                $objDia->pagos  = $vctPagos;
                $vctAsistencias[] =  $objDia;

                // dd( 'Entre al cierre forzoso ',  $intDiaTrabajado, $objDia );
                $vctDebug[] = '-> Creamos el siguiente objeto para ' . $item->personal;
                $intDiaTrabajado = 0;
                $strEmpleado = null;
                unset( $vctPagos );
                $objDia = new stdClass;

                $strEmpleado = $item->personal;
                $intDiaTrabajado = 1;

                $objDia->numEmpleado = str_pad( $item->numeroNomina, 4, '0', STR_PAD_LEFT );
                $objDia->empleado = $item->personal;
                $objDia->puesto = $item->puesto;
                $objDia->sueldo = $item->sueldo;
                $objDia->estatus = $item->estatus;
                $objDia->estatusColor = $item->estatusColor;

                $objPagos = new stdClass;
                $objPagos->fecha = $item->fecha;
                $objPagos->horasExtra = $item->horasExtra;
                $objPagos->horasAnticipada = $item->horasAnticipada;
                $objPagos->horasRetraso = $item->horasRetraso;
                $objPagos->tipoAsistencia = $item->tipoAsistenciaId;
                $objPagos->esAsistencia = $item->esAsistencia;
                $objPagos->entradaAnticipada = $item->entradaAnticipada;
                $objPagos->tipoAsistenciaColor = $item->tipoAsistenciaColor;
                $objPagos->tipoAsistenciaNombre = $item->tipoAsistenciaNombre;
                $vctPagos[] = $objPagos;

            }
            $intCont += 1;
        }

        // dd( $asistencias, $vctDebug, $vctAsistencias );
        //   dd( $vctAsistencias, $asistencias, $intAnio, $intMes, $intDia, $strDate, $vctFechas[ 0 ], $vctFechas[ 1 ], );

        return view( 'asistencias.corteSemanal',  compact( 'usuario', 'vctAsistencias',   'asistencias', 'listaAsistencia', 'intDia', 'intMes', 'intAnio', 'strFechaInicioPeriodo', 'strFechaFinPeriodo' ) );
    }

    /**
    * Realiza el calculo del corte semanal a partir de los parametros de la fecha entregada
    *
    * @param [ type ] $intAnio
    * @param [ type ] $intMes
    * @param [ type ] $intDia
    * @return void vctAsistencias
    */
    public static function getCalculoCorteSemanal( $intAnio, $intMes, $intDia ) {
        $vctResultado = array();

        $vctResultado = asistencia::all();
        $objCalendario = new Calendario();

        $data = request()->all();
        if ( is_array( $data ) == true && count( $data ) > 0 ) {
            $intMes = $data[ 'intMes' ];
            $intAnio = $data[ 'intAnio' ];
            $intDia = $data[ 'intDia' ];
        } else {
            $intMes = date( 'm' );
            $intAnio = date( 'Y' );
            $intDia = date( 'd' );
        }

        $strDate = $intAnio . '-' . $intMes . '-' . $intDia;
        $vctFechas =  $objCalendario->getSemanaTrabajo( date_create( $strDate ), 3 );
        $strFechaInicioPeriodo = $vctFechas[ 0 ]->format( 'Y-m-d' );
        $strFechaFinPeriodo = $vctFechas[ 1 ]->format( 'Y-m-d' );

        // dd( $strDate, $vctFechas, $strFechaInicioPeriodo, $strFechaFinPeriodo );

        $asistencias = personal::select(
            DB::raw( 'personal.id AS personalId' ),
            DB::raw( "CONCAT( personal.apellidoP,' ', personal.apellidoM,', ',personal.nombres)as personal" ),
            DB::raw( 'puestoNivel.nombre AS puesto' ),
            DB::raw( 'asistencia.id AS id' ),
            DB::raw( 'asistencia.asistenciaId as tipoAsistenciaId' ),
            'asistencia.horasExtra',
            'asistencia.horasAnticipada',
            'asistencia.horasRetraso',
            'asistencia.fecha',
            DB::raw( 'nomina.diario AS sueldo' ),
            DB::raw( 'nomina.nomina AS numeroNomina' ),
            DB::raw( 'tipoAsistencia.color AS tipoAsistenciaColor' ),
            DB::raw( 'tipoAsistencia.nombre AS tipoAsistenciaNombre' ),
            DB::raw( 'tipoAsistencia.esAsistencia AS esAsistencia' ),
            DB::raw( 'userEstatus.nombre AS estatus' ),
            DB::raw( 'userEstatus.color AS estatusColor' ),
            DB::raw( 'asistencia.entradaAnticipada' ),
        )
        ->join( 'nomina', 'nomina.personalId', '=', 'personal.id' )
        ->join( 'asistencia', 'asistencia.personalId', '=', 'personal.id' )
        ->join( 'tipoAsistencia', 'tipoAsistencia.id', '=', 'asistencia.asistenciaId' )
        // ->join( 'tipoHoraExtra', 'tipoHoraExtra.id', '=', 'asistencia.tipoHoraExtraId' )
        ->join( 'userEstatus', 'userEstatus.id', '=', 'personal.estatusId' )
        ->join( 'puesto', 'puesto.id', '=', 'nomina.puestoId' )
        ->join( 'puestoNivel', 'puestoNivel.id', '=', 'puesto.puestoNivelId' )
        ->where( 'puestoNivel.requiereAsistencia', '=', '1' )
        // ->where( 'asistencia.personalId', '=', 23 )
        ->whereBetween( 'asistencia.fecha',   [ $strFechaInicioPeriodo, $strFechaFinPeriodo ] )
        ->orderBy( 'personal.apellidoP', 'asc' )
        ->orderBy( 'asistencia.personalId', 'asc' )
        ->orderBy( 'asistencia.fecha', 'asc' )->get();

        //*** lista de asistencia */
        $listaAsistencia = personal::select(
            'personal.id',
            'personal.nombres',
            'personal.apellidoP',
            'personal.apellidoM',
            DB::raw( 'puestoNivel.nombre AS puesto' ),
            DB::raw( "CONCAT(personal.nombres,' ', personal.apellidoP,' ', personal.apellidoM)as personal" ),
            DB::raw( 'puestoNivel.nombre AS puesto' ),
            DB::raw( 'nomina.nomina AS numNomina' ),
            DB::raw( 'userEstatus.nombre AS estatus' ),
            DB::raw( 'userEstatus.color AS estatusColor' )
        )
        ->join( 'nomina', 'nomina.personalId', '=', 'personal.id' )
        ->join( 'puesto', 'puesto.id', '=', 'nomina.puestoId' )
        ->join( 'puestoNivel', 'puestoNivel.id', '=', 'puesto.puestoNivelId' )
        ->join( 'userEstatus', 'userEstatus.id', '=', 'personal.estatusId' )
        ->where( 'puestoNivel.requiereAsistencia', '=', '1' )
        ->orderBy( 'personal.apellidoP', 'asc' )->get();

        $dteMesInicio = $intAnio . '-' . $intMes . '-01';
        $dteMesFin = $intAnio . '-' . $intMes . '-' . $objCalendario->getTotalDaysInMonth( $intMes, $intAnio );

        $vctAsistencias = array();
        $vctEmpleado = array();
        $vctDebug = array();
        $vctPagos = array();
        $intDia = 0;
        $strEmpleado = null;
        $intEmpleado = null;
        $intCont = 0;
        $intTotalAsistencias = count( $asistencias )-1;

        foreach ( $asistencias as $key => $item ) {

            if ( $intDia == 0 && $strEmpleado == null ) {
                $vctDebug[] = $intCont . '.- Creamos el primer objeto';
                $objDia = new stdClass;
            } else {
                //*** el objeto sigue vivo */
                $vctDebug[] = $intCont . ".- Seguimos con el objeto: $strEmpleado Día->$intDia " ;
            }

            if ( $intDia == 0 && $strEmpleado == null ) {
                $vctDebug[] = $intCont . ".- Asignamos al primer objeto a $item->personal";
                unset( $vctPagos );
                $strEmpleado = $item->personal;
                $objDia->numEmpleado = str_pad( $item->numeroNomina, 4, '0', STR_PAD_LEFT );
                $objDia->empleado = $item->personal;
                $objDia->puesto = $item->puesto;
                $objDia->sueldo = $item->sueldo;
                $objDia->costoHoraExtra = number_format( ( $item->sueldo / 8 ), 2 );
                $objDia->estatus = $item->estatus;
                $objDia->estatusColor = $item->estatusColor;

                $objPagos = new stdClass;
                $objPagos->fecha = $item->fecha;
                $objPagos->tiempoExtra = $item->horasExtra;
                $objPagos->tiempoAnticipado = $item->horasAnticipada;
                $objPagos->tiempoRetraso = $item->horasRetraso;
                $objPagos->tipoAsistencia = $item->tipoAsistenciaId;
                $objPagos->esAsistencia = $item->esAsistencia;
                $objPagos->entradaAnticipada = $item->entradaAnticipada;
                $objPagos->tipoAsistenciaColor = $item->tipoAsistenciaColor;
                $objPagos->tipoAsistenciaNombre = $item->tipoAsistenciaNombre;

                $vctDebug[] = $intCont . '.- Todo el tiempo extra ( anticipado y excedente )';
                $intMinutosTotalesDia = ( int ) $item->horasExtra ;
                if ( $item->entradaAnticipada == 1 && $item->horasAnticipada > 0 ) {
                    $intMinutosTotalesDia += $item->horasAnticipada ;
                }

                $objPagos->horas =  ( int )( $intMinutosTotalesDia / 60 );
                $objPagos->minutos =  ( int )( $intMinutosTotalesDia % 60 );
                $objPagos->tiempo =  str_pad( $objPagos->horas, 2, '0', STR_PAD_LEFT ) . ':' . str_pad( $objPagos->minutos, 2, '0', STR_PAD_LEFT ) ;

                $vctDebug[] = $intCont . '.- Obtención del tiempo de retraso de ingreso';
                $objPagos->horasRetraso =  0;
                $objPagos->minutosRetraso = 0;
                $intMinutosRetrasoDia = 0;
                if ( $item->horasRetraso > 0 ) {
                    $objPagos->horasRetraso = ( int ) ( $item->horasRetraso / 60 );
                    $objPagos->minutosRetraso = ( $item->horasRetraso % 60 );
                }
                $objPagos->retraso =  str_pad( $objPagos->horasRetraso, 2, '0', STR_PAD_LEFT ) . ':' . str_pad( $objPagos->minutosRetraso, 2, '0', STR_PAD_LEFT ) ;

                $vctDebug[] = $intCont . '.- completar una hora fraccionaria, deberá de ser mayor o igual a 35 minutos';
                $objPagos->horasExtras =  ( $objPagos->horas + ( $objPagos->minutos >= 35 ? 1 : 0 ) ) ;

                $vctDebug[] = $intCont . '.- Para el calculo de horas extras con descuento realizamos el descuento del tiempo extra menos el tiempo de retraso';
                $intTiempoDescuento = 0;
                $objPagos->horasDescuento = 0;
                $objPagos->minutosDescuento = 0;
                $objPagos->horasExtrasDescuento = $objPagos->horasExtras;

                $vctDebug[] = $intCont . '.- inicialmente es el pago normal ';

                if ( $item->horasRetraso > 0 ) {
                    $intTiempoDescuento = ( $intMinutosTotalesDia -  $item->horasRetraso );
                    $objPagos->horasDescuento =  ( int ) ( $intTiempoDescuento / 60 );
                    $objPagos->minutosDescuento = ( $intTiempoDescuento % 60 );
                    $objPagos->horasExtrasDescuento =  ( $objPagos->horasDescuento + ( $objPagos->minutosDescuento >= 35 ? 1 : 0 ) ) ;
                }
                $objPagos->descuento =  str_pad( $objPagos->horasDescuento, 2, '0', STR_PAD_LEFT ) . ':' . str_pad( $objPagos->minutosDescuento, 2, '0', STR_PAD_LEFT ) ;

                $vctDebug[] = $intCont . '.- calculo del pago ';
                $objPagos->horasExtrasPagar = number_format( $objPagos->horasExtras *  $objDia->costoHoraExtra, 2 );
                $objPagos->horasExtrasDescuentoPagar = number_format( $objPagos->horasExtrasDescuento *  $objDia->costoHoraExtra, 2 );

                $vctPagos[] = $objPagos;

                $intDia += 1;
            } else  if ( ( $intDia == 6 ) &&  ( $strEmpleado ==  $item->personal ) ) {
                $vctDebug[] = $intCont . '.- ultimo registro del empleado del periodo en los casos ';
                $objPagos = new stdClass;
                $objPagos->fecha = $item->fecha;
                $objPagos->tiempoExtra = $item->horasExtra;
                $objPagos->tiempoAnticipado = $item->horasAnticipada;
                $objPagos->tiempoRetraso = $item->horasRetraso;
                $objPagos->tipoAsistencia = $item->tipoAsistenciaId;
                $objPagos->esAsistencia = $item->esAsistencia;
                $objPagos->entradaAnticipada = $item->entradaAnticipada;
                $objPagos->tipoAsistenciaColor = $item->tipoAsistenciaColor;
                $objPagos->tipoAsistenciaNombre = $item->tipoAsistenciaNombre;
                $vctDebug[] = $intCont . '.- Todo el tiempo extra ( anticipado y excedente )';
                $intMinutosTotalesDia = ( int ) $item->horasExtra ;
                if ( $item->entradaAnticipada == 1 && $item->horasAnticipada > 0 ) {
                    $intMinutosTotalesDia += $item->horasAnticipada ;
                }

                $objPagos->horas =  ( int )( $intMinutosTotalesDia / 60 );
                $objPagos->minutos =  ( int )( $intMinutosTotalesDia % 60 );
                $objPagos->tiempo =  str_pad( $objPagos->horas, 2, '0', STR_PAD_LEFT ) . ':' . str_pad( $objPagos->minutos, 2, '0', STR_PAD_LEFT ) ;

                $vctDebug[] = $intCont . '.- obtención del tiempo de retraso de ingreso';
                $objPagos->horasRetraso =  0;
                $objPagos->minutosRetraso = 0;
                $intMinutosRetrasoDia = 0;
                if ( $item->horasRetraso > 0 ) {
                    $objPagos->horasRetraso = ( int ) ( $item->horasRetraso / 60 );
                    $objPagos->minutosRetraso = ( $item->horasRetraso % 60 );
                }
                $objPagos->retraso =  str_pad( $objPagos->horasRetraso, 2, '0', STR_PAD_LEFT ) . ':' . str_pad( $objPagos->minutosRetraso, 2, '0', STR_PAD_LEFT ) ;

                $vctDebug[] = $intCont . '.- completar una hora fraccionaria, deberá de ser mayor o igual a 35 minutos';
                $objPagos->horasExtras =  ( $objPagos->horas + ( $objPagos->minutos >= 35 ? 1 : 0 ) ) ;

                $vctDebug[] = $intCont . '.- Para el calculo de horas extras con descuento realizamos el descuento del tiempo extra menos el tiempo de retraso';
                $intTiempoDescuento = 0;
                $objPagos->horasDescuento = 0;
                $objPagos->minutosDescuento = 0;
                $objPagos->horasExtrasDescuento = $objPagos->horasExtras;

                $vctDebug[] = $intCont . '.- inicialmente es el pago normal ';

                if ( $item->horasRetraso > 0 ) {
                    $intTiempoDescuento = ( $intMinutosTotalesDia -  $item->horasRetraso );
                    $objPagos->horasDescuento =  ( int ) ( $intTiempoDescuento / 60 );
                    $objPagos->minutosDescuento = ( $intTiempoDescuento % 60 );
                    $objPagos->horasExtrasDescuento =  ( $objPagos->horasDescuento + ( $objPagos->minutosDescuento >= 35 ? 1 : 0 ) ) ;
                }
                $objPagos->descuento =  str_pad( $objPagos->horasDescuento, 2, '0', STR_PAD_LEFT ) . ':' . str_pad( $objPagos->minutosDescuento, 2, '0', STR_PAD_LEFT ) ;

                $vctDebug[] = $intCont . '.- calculo del pago ';
                $objPagos->horasExtrasPagar = number_format( $objPagos->horasExtras *  $objDia->costoHoraExtra, 2 );
                $objPagos->horasExtrasDescuentoPagar = number_format( $objPagos->horasExtrasDescuento *  $objDia->costoHoraExtra, 2 );

                $vctPagos[] = $objPagos;

                $objDia->pagos  = $vctPagos;
                $vctAsistencias[] =  $objDia;

                $intDia = 0;
                $strEmpleado = null;
                unset( $vctPagos );
            } else  if ( ( $intDia > 0 &&  $intDia < 6 ) &&  ( $strEmpleado ==  $item->personal ) ) {
                $vctDebug[] = $intCont . '.- seguimos con el siguiente dia y verificamos que se trate de la misma persona';
                $objPagos = new stdClass;
                $objPagos->fecha = $item->fecha;
                $objPagos->tiempoExtra = $item->horasExtra;
                $objPagos->tiempoAnticipado = $item->horasAnticipada;
                $objPagos->tiempoRetraso = $item->horasRetraso;
                $objPagos->tipoAsistencia = $item->tipoAsistenciaId;
                $objPagos->esAsistencia = $item->esAsistencia;
                $objPagos->entradaAnticipada = $item->entradaAnticipada;
                $objPagos->tipoAsistenciaColor = $item->tipoAsistenciaColor;
                $objPagos->tipoAsistenciaNombre = $item->tipoAsistenciaNombre;
                $vctDebug[] = $intCont . '.- Todo el tiempo extra ( anticipado y excedente )';
                $intMinutosTotalesDia = ( int ) $item->horasExtra ;
                if ( $item->entradaAnticipada == 1 && $item->horasAnticipada > 0 ) {
                    $intMinutosTotalesDia += $item->horasAnticipada ;
                }

                $objPagos->horas =  ( int )( $intMinutosTotalesDia / 60 );
                $objPagos->minutos =  ( int )( $intMinutosTotalesDia % 60 );
                $objPagos->tiempo =  str_pad( $objPagos->horas, 2, '0', STR_PAD_LEFT ) . ':' . str_pad( $objPagos->minutos, 2, '0', STR_PAD_LEFT ) ;

                $vctDebug[] = $intCont . '.- obtención del tiempo de retraso de ingreso';
                $objPagos->horasRetraso =  0;
                $objPagos->minutosRetraso = 0;
                $intMinutosRetrasoDia = 0;
                if ( $item->horasRetraso > 0 ) {
                    $objPagos->horasRetraso = ( int ) ( $item->horasRetraso / 60 );
                    $objPagos->minutosRetraso = ( $item->horasRetraso % 60 );
                }
                $objPagos->retraso =  str_pad( $objPagos->horasRetraso, 2, '0', STR_PAD_LEFT ) . ':' . str_pad( $objPagos->minutosRetraso, 2, '0', STR_PAD_LEFT ) ;

                $vctDebug[] = $intCont . '.- completar una hora fraccionaria, deberá de ser mayor o igual a 35 minutos';
                $objPagos->horasExtras =  ( $objPagos->horas + ( $objPagos->minutos >= 35 ? 1 : 0 ) ) ;

                $vctDebug[] = $intCont . '.- Para el calculo de horas extras con descuento realizamos el descuento del tiempo extra menos el tiempo de retraso';
                $intTiempoDescuento = 0;
                $objPagos->horasDescuento = 0;
                $objPagos->minutosDescuento = 0;
                $objPagos->horasExtrasDescuento = $objPagos->horasExtras;
                $vctDebug[] = $intCont . '.- inicialmente es el pago normal';

                if ( $item->horasRetraso > 0 ) {
                    $intTiempoDescuento = ( $intMinutosTotalesDia -  $item->horasRetraso );
                    $objPagos->horasDescuento =  ( int ) ( $intTiempoDescuento / 60 );
                    $objPagos->minutosDescuento = ( $intTiempoDescuento % 60 );
                    $objPagos->horasExtrasDescuento =  ( $objPagos->horasDescuento + ( $objPagos->minutosDescuento >= 35 ? 1 : 0 ) ) ;
                }
                $objPagos->descuento =  str_pad( $objPagos->horasDescuento, 2, '0', STR_PAD_LEFT ) . ':' . str_pad( $objPagos->minutosDescuento, 2, '0', STR_PAD_LEFT ) ;

                $vctDebug[] = $intCont . '.- calculo del pago ';
                $objPagos->horasExtrasPagar = number_format( $objPagos->horasExtras *  $objDia->costoHoraExtra, 2 );
                $objPagos->horasExtrasDescuentoPagar = number_format( $objPagos->horasExtrasDescuento *  $objDia->costoHoraExtra, 2 );

                $vctPagos[] = $objPagos;
                $intDia += 1;
                if ( $intCont == $intTotalAsistencias ) {
                    $vctDebug[] = 'Es el final ' . $intCont;

                    $objDia->pagos  = $vctPagos;
                    $vctAsistencias[] =  $objDia;
                    $vctDebug[] = $objDia;
                }
            } else {
                $vctDebug[] = $intCont . '.- el empleado ya no tiene registros y hay que cerrar y crear el nuevo';
                $objDia->pagos  = $vctPagos;
                $vctAsistencias[] =  $objDia;
                $vctDebug[] = $intCont . ".- Entre al cierre forzoso,  $intDia ";
                $vctDebug[] = $objDia ;
                $intDia = 0;
                $strEmpleado = null;
                unset( $vctPagos );
                $objDia = new stdClass;

                $strEmpleado = $item->personal;
                $objDia->numEmpleado = str_pad( $item->numeroNomina, 4, '0', STR_PAD_LEFT );
                $objDia->empleado = $item->personal;
                $objDia->puesto = $item->puesto;
                $objDia->sueldo = $item->sueldo;
                $objDia->costoHoraExtra = number_format( ( $item->sueldo / 8 ), 2 );
                $objDia->estatus = $item->estatus;
                $objDia->estatusColor = $item->estatusColor;

                $objPagos = new stdClass;
                $objPagos->fecha = $item->fecha;
                $objPagos->tiempoExtra = $item->horasExtra;
                $objPagos->tiempoAnticipado = $item->horasAnticipada;
                $objPagos->tiempoRetraso = $item->horasRetraso;
                $objPagos->tipoAsistencia = $item->tipoAsistenciaId;
                $objPagos->esAsistencia = $item->esAsistencia;
                $objPagos->entradaAnticipada = $item->entradaAnticipada;
                $objPagos->tipoAsistenciaColor = $item->tipoAsistenciaColor;
                $objPagos->tipoAsistenciaNombre = $item->tipoAsistenciaNombre;
                $vctDebug[] = $intCont . '.- Todo el tiempo extra ( anticipado y excedente )';
                $intMinutosTotalesDia = ( int ) $item->horasExtra ;
                if ( $item->entradaAnticipada == 1 && $item->horasAnticipada > 0 ) {
                    $intMinutosTotalesDia += $item->horasAnticipada ;
                }

                $objPagos->horas =  ( int )( $intMinutosTotalesDia / 60 );
                $objPagos->minutos =  ( int )( $intMinutosTotalesDia % 60 );
                $objPagos->tiempo =  str_pad( $objPagos->horas, 2, '0', STR_PAD_LEFT ) . ':' . str_pad( $objPagos->minutos, 2, '0', STR_PAD_LEFT ) ;

                $vctDebug[] = $intCont . '.- obtención del tiempo de retraso de ingreso';
                $objPagos->horasRetraso =  0;
                $objPagos->minutosRetraso = 0;
                $intMinutosRetrasoDia = 0;
                if ( $item->horasRetraso > 0 ) {
                    $objPagos->horasRetraso = ( int ) ( $item->horasRetraso / 60 );
                    $objPagos->minutosRetraso = ( $item->horasRetraso % 60 );
                }
                $objPagos->retraso =  str_pad( $objPagos->horasRetraso, 2, '0', STR_PAD_LEFT ) . ':' . str_pad( $objPagos->minutosRetraso, 2, '0', STR_PAD_LEFT ) ;

                $vctDebug[] = $intCont . '.- completar una hora fraccionaria, deberá de ser mayor o igual a 35 minutos';
                $objPagos->horasExtras =  ( $objPagos->horas + ( $objPagos->minutos >= 35 ? 1 : 0 ) ) ;

                $vctDebug[] = $intCont . '.- Para el calculo de horas extras con descuento realizamos el descuento del tiempo extra menos el tiempo de retraso';
                $intTiempoDescuento = 0;
                $objPagos->horasDescuento = 0;
                $objPagos->minutosDescuento = 0;
                $objPagos->horasExtrasDescuento = $objPagos->horasExtras;
                $vctDebug[] = $intCont . '.- inicialmente es el pago normal';

                if ( $item->horasRetraso > 0 ) {
                    $intTiempoDescuento = ( $intMinutosTotalesDia -  $item->horasRetraso );
                    $objPagos->horasDescuento =  ( int ) ( $intTiempoDescuento / 60 );
                    $objPagos->minutosDescuento = ( $intTiempoDescuento % 60 );
                    $objPagos->horasExtrasDescuento =  ( $objPagos->horasDescuento + ( $objPagos->minutosDescuento >= 35 ? 1 : 0 ) ) ;
                }
                $objPagos->descuento =  str_pad( $objPagos->horasDescuento, 2, '0', STR_PAD_LEFT ) . ':' . str_pad( $objPagos->minutosDescuento, 2, '0', STR_PAD_LEFT ) ;

                $vctDebug[] = $intCont . '.- calculo del pago';
                $objPagos->horasExtrasPagar = number_format( $objPagos->horasExtras *  $objDia->costoHoraExtra, 2 );
                $objPagos->horasExtrasDescuentoPagar = number_format( $objPagos->horasExtrasDescuento *  $objDia->costoHoraExtra, 2 );
                $vctPagos[] = $objPagos;

                $intDia += 1;
                $vctDebug[] = $intCont . ".-Entre al cierre forzoso,  $intDia ";
                $vctDebug[] =  $objDia;
                $vctDebug[] =  $objPagos;

            }
            $intCont += 1;
        }

        //*** Procesamos para los totales */
        foreach ( $vctAsistencias as $objItem ) {

            $intAsistencias = 0;
            $intHorasExtras = 0;
            $decCostoHorasExtras = 0;
            $decCostoHorasExtrasDescuento = 0;
            $intHorasExtrasDescuento = 0;
            $intMinutosExtra = 0;
            $intTiempoExtra = 0;
            foreach ( $objItem->pagos as  $value ) {
                $intAsistencias += ( $value->esAsistencia == 1?1:0 );
                $decCostoHorasExtras +=   $value->horasExtrasPagar ;
                $decCostoHorasExtrasDescuento +=   $value->horasExtrasDescuentoPagar ;
                $intHorasExtras += $value->horasExtras ;
                $intHorasExtrasDescuento += $value->horasExtrasDescuento ;
                $intTiempoExtra += ( $value->tiempoExtra + $value->tiempoAnticipado );

            }

            $objItem->nominaDias = $intAsistencias;
            $objItem->nominaImporte = ( $intAsistencias *$objItem->sueldo );

            //*** calculo de horas extras normales */
            $intHorasDobles = 0;
            $intHorasTriples = 0;
            $decCostoHoraExtra = $objItem->costoHoraExtra;

            if ( $intHorasExtras > 0 ) {
                if ( $intHorasExtras <= 9 ) {
                    //*** se multiplican por dos del valor proporcional
                    $intHorasDobles =  ( $decCostoHoraExtra * 2 )* $intHorasExtras ;
                    $decCostoHorasExtras = $intHorasDobles ;

                } elseif ( $intHorasExtras >= 10 ) {
                    //*** obtenemos el calculo proporcional de los dias
                    $intHorasDobles = ( ( $decCostoHoraExtra * 2 )* 9 );
                    $intHorasTriples = ( ( $decCostoHoraExtra * 3 )* ( $intHorasExtras - 9 ) ) ;

                    $decCostoHorasExtras =  ( $intHorasDobles +  $intHorasTriples )  ;

                }
            }

            $objItem->nominaHorasExtras =  $intHorasExtras ;
            $objItem->nominaImporteHorasExtras =  $decCostoHorasExtras ;
            $objItem->nominaPagoSemanal =  $objItem->nominaImporte + $decCostoHorasExtras ;

            //*** calculo de horas extras descuento */
            $intHorasDoblesDesc = 0;
            $intHorasTriplesDesc = 0;

            if ( $intHorasExtrasDescuento > 0 ) {
                if ( $intHorasExtrasDescuento <= 9 ) {
                    //*** se multiplican por dos del valor proporcional
                    $intHorasDoblesDesc =  ( $decCostoHoraExtra * 2 )* $intHorasExtrasDescuento ;
                    $decCostoHorasExtrasDescuento = $intHorasDoblesDesc ;

                } elseif ( $intHorasExtrasDescuento >= 10 ) {
                    //*** obtenemos el calculo proporcional de los dias
                    $intHorasDoblesDesc = ( ( $decCostoHoraExtra * 2 )* 9 );
                    $intHorasTriplesDesc = ( ( $decCostoHoraExtra * 3 )* ( $intHorasExtrasDescuento - 9 ) ) ;

                    $decCostoHorasExtrasDescuento =  ( $intHorasDoblesDesc +  $intHorasTriplesDesc )  ;

                }
            }

            $objItem->nominaHorasExtrasDescuento =  $intHorasExtrasDescuento ;
            $objItem->nominaImporteHorasExtrasDescuento =  $decCostoHorasExtrasDescuento ;
            $objItem->nominaPagoSemanalDescuento =  $objItem->nominaImporte + $decCostoHorasExtrasDescuento ;
            $objItem->nominaTiempoExtra =  str_pad( ( int ) ( $intTiempoExtra/60 ), 2, '0', STR_PAD_LEFT ) . ':' . str_pad( ( $intTiempoExtra % 60 ), 2, '0', STR_PAD_LEFT ) ;

            // if ( $intHorasExtras > 0 ) {
            //     dd(
            //         'Valor base: ' . $decCostoHorasExtras,
            //         'Horas: ' . $intHorasExtras,
            //         'Horas dobles: ' . $intHorasDobles,
            //         'Horas triples: ' . $intHorasTriples,
            //         'Total: ' . $decCostoHorasExtras, $objItem
            // );
            // }
        }

        // dd( $vctDebug,  $vctAsistencias );
        return $vctAsistencias ;
    }

    public function reloadCorteSemanal( $intAnio, $intMes, $intDia ) {
        // dd( $personalId, $intAnio, $intMes, $intDia );
        return redirect()->action( [ asistenciaController::class, 'corteSemanal' ], [ 'intAnio' => $intAnio, 'intMes' => $intMes, 'intDia' => $intDia ] );
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
        abort_if ( Gate::denies( 'asistencia_edit' ), '403' );

        // dd( $request );
        $i = 0;
        foreach ( $request[ 'recordId' ] as $value ) {

            $objAsistencia = asistencia::where( 'id', '=', $request[ 'recordId' ][ $i ] )->first();

            if ( $objAsistencia ) {

                $dteHorario = null;
                $dteHoraSalida = null;
                $dteHoraEntrada = null;

                //*** validamos si asistio a trabajar */
                if ( $request->$value[ 0 ] == 1 ) {

                    //*** obtenemos los minutos de diferencia en la entrada si se registro que es anticipada siempre y cuando se asignara su calculo */

                    if ( is_null( $request[ 'horarioEntrada' ][ $i ] ) == false &&  is_null( $request[ 'hEntrada' ][ $i ] ) == false ) {

                        $intMinutosEntrada = 0;
                        $dteHorario =   Carbon::parse( $request[ 'horarioEntrada' ][ $i ] );
                        $dteHoraEntrada =  Carbon::parse( $request[ 'hEntrada' ][ $i ] );
                        if ( is_null( $request[ 'entradaAnticipada' ][ $i ] ) == false && $request[ 'entradaAnticipada' ][ $i ] == 1 ) {

                            //*** preguntamos si la entrada es menor que la horario de entrada */
                            if ( $dteHoraEntrada < $dteHorario ) {
                                $intMinutosEntrada = $dteHoraEntrada->diffInMinutes( $dteHorario ) ;
                                // $objAsistencia->tipoHoraExtraId = $request[ 'tipoHoraExtraId' ][ $i ];
                                //dd( 'Soy mayor '. $intMinutosEntrada . ' minutos' );
                            } else {
                                // dd( 'Soy menor' );
                                // $objAsistencia->tipoHoraExtraId = 1;
                            }

                            $objAsistencia->horasAnticipada = $intMinutosEntrada;
                        }

                        //*** calculamos tiempo de retraso de entrada */
                        $objAsistencia->horasRetraso = 0;
                        //*** preguntamos si la entrada es menor que la hora salida */
                        if ( $dteHoraEntrada > $dteHorario ) {
                            $objAsistencia->horasRetraso = $dteHoraEntrada->diffInMinutes( $dteHorario ) ;
                            //  dd( 'Soy mayor '. $objAsistencia->horasRetraso . ' minutos' );
                        } else {
                            //  dd( 'Soy menor' );
                        }

                    } else {
                        //*** se marca en 0 y se marca que no aplica */
                        $objAsistencia->horasAnticipada = 0;
                        // $objAsistencia->tipoHoraExtraId = 1;

                    }

                    //*** obtenemos los minutos de diferencia en la salida */
                    if ( is_null( $request[ 'horarioSalida' ][ $i ] ) == false &&  is_null( $request[ 'hSalida' ][ $i ] ) == false ) {

                        $intMinutosSalida = 0;
                        $dteHorario =   Carbon::parse( $request[ 'horarioSalida' ][ $i ] );

                        //*** verificamos si es sabado para trabajar con el horario del sabado */
                        $dtDia =  Carbon::parse( $request[ 'fecha' ][ $i ] );
                        if ( $dtDia->isoWeekday() == 6 ) {
                            //*** preguntamos si es sabado */
                            $dteHorario =   Carbon::parse( $request[ 'horarioSalidaSabado' ][ $i ] );
                        }

                        $dteHoraSalida =  Carbon::parse( $request[ 'hSalida' ][ $i ] );

                        //*** preguntamos si la salida es mayor que la hora salida */
                        if ( $dteHoraSalida > $dteHorario ) {
                            $intMinutosSalida = $dteHoraSalida->diffInMinutes( $dteHorario ) ;
                            // $objAsistencia->tipoHoraExtraId = $request[ 'tipoHoraExtraId' ][ $i ];
                            // dd( 'Soy mayor '. $intMinutosSalida . ' minutos' );
                        } else {
                            //  dd( 'Soy menor' );
                            // $objAsistencia->tipoHoraExtraId = 1;
                        }

                        $objAsistencia->horasExtra = $intMinutosSalida;

                    } else {
                        //*** se marca en 0 y se marca que no aplica */
                        $objAsistencia->horasExtra = 0;
                        // $objAsistencia->tipoHoraExtraId = 1;
                    }

                    //*** obtenemos las horas extras a pagar */
                    $intHoras = ( int ) (( $objAsistencia->horasExtra + $objAsistencia->horasAnticipada ) / 60 );
                    $intHorasFraccionadas = ( ( $objAsistencia->horasExtra + $objAsistencia->horasAnticipada ) >= 35 ? 1 : 0 );
                    $objAsistencia->totalHorasExtra = $intHoras + $intHorasFraccionadas;

                } else {
                    //*** se marca en 0 y se marca que no aplica */
                    $objAsistencia->horasExtra = 0;
                    $objAsistencia->horasAnticipada = 0;
                    // $objAsistencia->tipoHoraExtraId = 1;
                    // dd( 'No vine' );

                }

                $objAsistencia->asistenciaId = $request->$value[ 0 ];
                $objAsistencia->hEntrada = $request[ 'hEntrada' ][ $i ];
                $objAsistencia->hSalida = $request[ 'hSalida' ][ $i ];
                $objAsistencia->comentario = $request[ 'comentario' ][ $i ];
                $objAsistencia->save();
                // dd( $objAsistencia );
            }
            $i += 1;
        }

        return redirect()->action( [ asistenciaController::class, 'index' ], [ 'intAnio' => $request[ 'intAnio' ], 'intMes' => $request[ 'intMes' ] ] );
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

    public function reporteExcel( Request $request ) {
        abort_if ( Gate::denies( 'asistencia_show' ), '403' );
        $objCalendario = new Calendario();

        $data = request()->all();
        if ( is_array( $data ) == true && count( $data ) > 0 ) {
            $intMes = $data[ 'intMes' ];
            $intAnio = $data[ 'intAnio' ];
            $intDia = $data[ 'intDia' ];
        } else {
            $intMes = date( 'm' );
            $intAnio = date( 'Y' );
            $intDia = date( 'd' );
        }

        $strDate = $intAnio . '-' . $intMes . '-' . $intDia;
        $vctFechas =  $objCalendario->getSemanaTrabajo( date_create( $strDate ), 3 );
        $strFechaInicioPeriodo = $vctFechas[ 0 ]->format( 'Y-m-d' );
        $strFechaFinPeriodo = $vctFechas[ 1 ]->format( 'Y-m-d' );

        $usuario = personal::where( 'userId', auth()->user()->id )->first();
        // $personal = personal::where( 'id', $personalId )->first();

        $asistencias = personal::select(
            DB::raw( 'personal.id AS personalId' ),
            DB::raw( "CONCAT( personal.apellidoP,' ', personal.apellidoM,', ',personal.nombres)as personal" ),
            DB::raw( 'puestoNivel.nombre AS puesto' ),
            DB::raw( 'asistencia.id AS id' ),
            DB::raw( 'asistencia.asistenciaId as tipoAsistenciaId' ),
            'asistencia.horasExtra',
            'asistencia.horasAnticipada',
            'asistencia.horasRetraso',
            'asistencia.fecha',
            DB::raw( 'nomina.diario AS sueldo' ),
            DB::raw( 'nomina.nomina AS numeroNomina' ),
            DB::raw( 'tipoAsistencia.color AS tipoAsistenciaColor' ),
            DB::raw( 'tipoAsistencia.nombre AS tipoAsistenciaNombre' ),
            DB::raw( 'tipoAsistencia.esAsistencia AS esAsistencia' ),
            // DB::raw( 'tipoHoraExtra.color AS horaExtraColor' ),
            // DB::raw( 'tipoHoraExtra.valor AS horaExtraCosto' ),
            // DB::raw( 'tipoHoraExtra.nombre AS horaExtraNombre' ),
            DB::raw( 'userEstatus.nombre AS estatus' ),
            DB::raw( 'userEstatus.color AS estatusColor' ),
            DB::raw( 'asistencia.entradaAnticipada' ),
        )
        ->join( 'nomina', 'nomina.personalId', '=', 'personal.id' )
        ->join( 'asistencia', 'asistencia.personalId', '=', 'personal.id' )
        ->join( 'tipoAsistencia', 'tipoAsistencia.id', '=', 'asistencia.asistenciaId' )
        // ->join( 'tipoHoraExtra', 'tipoHoraExtra.id', '=', 'asistencia.tipoHoraExtraId' )
        ->join( 'userEstatus', 'userEstatus.id', '=', 'personal.estatusId' )
        ->join( 'puesto', 'puesto.id', '=', 'nomina.puestoId' )
        ->join( 'puestoNivel', 'puestoNivel.id', '=', 'puesto.puestoNivelId' )
        ->where( 'puestoNivel.requiereAsistencia', '=', '1' )
        // ->where( 'asistencia.personalId', '=', 23 )
        ->whereBetween( 'asistencia.fecha',   [ $strFechaInicioPeriodo, $strFechaFinPeriodo ] )
        ->orderBy( 'personal.apellidoP', 'asc' )
        ->orderBy( 'asistencia.personalId', 'asc' )
        ->orderBy( 'asistencia.fecha', 'asc' )->get();

        //*** lista de asistencia */
        $listaAsistencia = personal::select(
            'personal.id',
            'personal.nombres',
            'personal.apellidoP',
            'personal.apellidoM',
            DB::raw( 'puestoNivel.nombre AS puesto' ),
            DB::raw( "CONCAT(personal.nombres,' ', personal.apellidoP,' ', personal.apellidoM)as personal" ),
            DB::raw( 'puestoNivel.nombre AS puesto' ),
            DB::raw( 'nomina.nomina AS numNomina' ),
            DB::raw( 'userEstatus.nombre AS estatus' ),
            DB::raw( 'userEstatus.color AS estatusColor' )
        )
        ->join( 'nomina', 'nomina.personalId', '=', 'personal.id' )
        ->join( 'puesto', 'puesto.id', '=', 'nomina.puestoId' )
        ->join( 'puestoNivel', 'puestoNivel.id', '=', 'puesto.puestoNivelId' )
        ->join( 'userEstatus', 'userEstatus.id', '=', 'personal.estatusId' )
        ->where( 'puestoNivel.requiereAsistencia', '=', '1' )
        ->orderBy( 'personal.apellidoP', 'asc' )->get();

        $dteMesInicio = $intAnio . '-' . $intMes . '-01';
        $dteMesFin = $intAnio . '-' . $intMes . '-' . $objCalendario->getTotalDaysInMonth( $intMes, $intAnio );

        $vctAsistencias = array();
        $vctEmpleado = array();
        $vctPagos = array();
        $intDia = 0;
        $strEmpleado = null;
        $intEmpleado = null;

        foreach ( $asistencias as $key => $item ) {

            if ( $intDia == 0 && $strEmpleado == null ) {
                //*** creamos el objeto */
                $objDia = new stdClass;
            } else {
                //*** el objeto sigue vivo */
                // dd( 'Seguimos con el objeto ' .  $intDia );
            }

            if ( $intDia == 0 && $strEmpleado == null ) {
                //** primer registro del empleado */
                unset( $vctPagos );
                $strEmpleado = $item->personal;
                $objDia->numEmpleado = str_pad( $item->numeroNomina, 4, '0', STR_PAD_LEFT );
                $objDia->empleado = $item->personal;
                $objDia->puesto = $item->puesto;
                $objDia->sueldo = $item->sueldo;
                $objDia->estatus = $item->estatus;
                $objDia->estatusColor = $item->estatusColor;

                $objPagos = new stdClass;
                $objPagos->fecha = $item->fecha;
                $objPagos->horasExtra = $item->horasExtra;
                $objPagos->horasAnticipada = $item->horasAnticipada;
                $objPagos->horasRetraso = $item->horasRetraso;
                // $objPagos->horaExtraColor = $item->horaExtraColor;
                // $objPagos->horaExtraCosto = $item->horaExtraCosto;
                // $objPagos->horaExtraNombre = $item->horaExtraNombre;
                $objPagos->tipoAsistencia = $item->tipoAsistenciaId;
                $objPagos->esAsistencia = $item->esAsistencia;
                $objPagos->entradaAnticipada = $item->entradaAnticipada;
                $objPagos->tipoAsistenciaColor = $item->tipoAsistenciaColor;
                $objPagos->tipoAsistenciaNombre = $item->tipoAsistenciaNombre;
                $vctPagos[] = $objPagos;

                $intDia += 1;
            } else  if ( ( $intDia == 6 ) &&  ( $strEmpleado ==  $item->personal ) ) {
                //** ultimo registro del empleado del periodo en los casos */
                $objPagos = new stdClass;
                $objPagos->fecha = $item->fecha;
                $objPagos->horasExtra = $item->horasExtra;
                $objPagos->horasAnticipada = $item->horasAnticipada;
                $objPagos->horasRetraso = $item->horasRetraso;
                // $objPagos->horaExtraColor = $item->horaExtraColor;
                // $objPagos->horaExtraCosto = $item->horaExtraCosto;
                // $objPagos->horaExtraNombre = $item->horaExtraNombre;
                $objPagos->tipoAsistencia = $item->tipoAsistenciaId;
                $objPagos->esAsistencia = $item->esAsistencia;
                $objPagos->entradaAnticipada = $item->entradaAnticipada;
                $objPagos->tipoAsistenciaColor = $item->tipoAsistenciaColor;
                $objPagos->tipoAsistenciaNombre = $item->tipoAsistenciaNombre;
                $vctPagos[] = $objPagos;

                $objDia->pagos  = $vctPagos;
                $vctAsistencias[] =  $objDia;

                $intDia = 0;
                $strEmpleado = null;
                unset( $vctPagos );
            } else  if ( ( $intDia > 0 &&  $intDia < 6 ) &&  ( $strEmpleado ==  $item->personal ) ) {
                //*** seguimos con el siguiente dia y verificamos que se trate de la misma persona */
                $objPagos = new stdClass;
                $objPagos->fecha = $item->fecha;
                $objPagos->horasExtra = $item->horasExtra;
                $objPagos->horasAnticipada = $item->horasAnticipada;
                $objPagos->horasRetraso = $item->horasRetraso;
                // $objPagos->horaExtraColor = $item->horaExtraColor;
                // $objPagos->horaExtraCosto = $item->horaExtraCosto;
                // $objPagos->horaExtraNombre = $item->horaExtraNombre;
                $objPagos->tipoAsistencia = $item->tipoAsistenciaId;
                $objPagos->esAsistencia = $item->esAsistencia;
                $objPagos->entradaAnticipada = $item->entradaAnticipada;
                $objPagos->tipoAsistenciaColor = $item->tipoAsistenciaColor;
                $objPagos->tipoAsistenciaNombre = $item->tipoAsistenciaNombre;
                $vctPagos[] = $objPagos;
                $intDia += 1;
            } else {
                //*** el empleado ya no tiene registros y hay que cerrar y crear el nuevo */
                $objDia->pagos  = $vctPagos;
                $vctAsistencias[] =  $objDia;
                // dd( 'Entre al cierre forzoso ',  $intDia, $objDia );
                $intDia = 0;
                $strEmpleado = null;
                unset( $vctPagos );
                $objDia = new stdClass;

                $strEmpleado = $item->personal;
                $objDia->numEmpleado = str_pad( $item->numeroNomina, 4, '0', STR_PAD_LEFT );
                $objDia->empleado = $item->personal;
                $objDia->puesto = $item->puesto;
                $objDia->sueldo = $item->sueldo;
                $objDia->estatus = $item->estatus;
                $objDia->estatusColor = $item->estatusColor;

                $objPagos = new stdClass;
                $objPagos->fecha = $item->fecha;
                $objPagos->horasExtra = $item->horasExtra;
                $objPagos->horasAnticipada = $item->horasAnticipada;
                $objPagos->horasRetraso = $item->horasRetraso;
                // $objPagos->horaExtraColor = $item->horaExtraColor;
                // $objPagos->horaExtraCosto = $item->horaExtraCosto;
                // $objPagos->horaExtraNombre = $item->horaExtraNombre;
                $objPagos->tipoAsistencia = $item->tipoAsistenciaId;
                $objPagos->esAsistencia = $item->esAsistencia;
                $objPagos->entradaAnticipada = $item->entradaAnticipada;
                $objPagos->tipoAsistenciaColor = $item->tipoAsistenciaColor;
                $objPagos->tipoAsistenciaNombre = $item->tipoAsistenciaNombre;
                $vctPagos[] = $objPagos;

                $intDia += 1;
                // dd( 'Entre al cierre forzoso ',  $intDia, $objDia );

            }
        }

        // dd( $request );

        return ( new CorteSemanalExport( compact( 'usuario', 'vctAsistencias',   'asistencias', 'listaAsistencia', 'intDia', 'intMes', 'intAnio', 'strFechaInicioPeriodo', 'strFechaFinPeriodo' ) ) )->download( 'corteSemanal.xlsx' );
    }

    public function export() {
        return Excel::download( new CorteSemanalExport, 'corteSemanal.xlsx' );
    }
}
