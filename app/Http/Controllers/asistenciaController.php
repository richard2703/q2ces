<?php

namespace App\Http\Controllers;

use App\Exports\CorteSemanalExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Gate;
use App\Models\asistencia;
use App\Models\personal;
// use App\Helpers\Validaciones;
use App\Helpers\Calendario;
// use App\Helpers\Calculos;
use App\Models\tipoHoraExtra;
use stdClass;

class asistenciaController extends Controller {

    public function index( $intAnio = null, $intMes = null, $intDia = null ) {
        abort_if ( Gate::denies( 'asistencia_index' ), '403' );

        $objCalendario = new Calendario();

        $data = request()->all();
        if ( is_array( $data ) == true && count( $data ) > 0 ) {
            $intMes = $data[ 'intMes' ];
            $intAnio = $data[ 'intAnio' ];
        } else {
            $intMes = date( 'm' );
            $intAnio = date( 'Y' );
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
            DB::raw( 'puestoNivel.nombre AS puesto' ),
            DB::raw( 'nomina.nomina AS numNomina' ),
            DB::raw( 'userEstatus.nombre AS estatus' ),
            DB::raw( 'userEstatus.color AS estatusColor' ),
            DB::raw( 'COUNT( if ( asistencia.asistenciaId = 1, 1, null ) ) as asistencias' ),
            DB::raw( 'COUNT( if ( asistencia.asistenciaId = 2, 1, null ) ) as faltas' ),
            DB::raw( 'COUNT( if ( asistencia.asistenciaId = 3, 1, null ) ) as incapacidades' ),
            DB::raw( 'COUNT( if ( asistencia.asistenciaId = 4, 1, null ) ) as vacaciones' ),
            DB::raw( 'COUNT( if ( asistencia.asistenciaId = 5, 1, null ) ) as descansos' ),
            DB::raw( 'SUM( asistencia.horasExtra )as extras' ),
            DB::raw( 'COUNT( asistencia.id )as dias' )
        )
        ->join( 'puestoNivel', 'puestoNivel.id', '=', 'personal.puestoNivelId' )
        ->join( 'nomina', 'nomina.personalId', '=', 'personal.id' )
        ->join( 'asistencia', 'asistencia.personalId', '=', 'personal.id' )
        ->join( 'userEstatus', 'userEstatus.id', '=', 'personal.estatusId' )
        ->where( 'puestoNivel.requiereAsistencia', '=', '1' )
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
            DB::raw( 'puestoNivel.nombre AS puesto' ),
            DB::raw( 'nomina.nomina AS numNomina' ),
            DB::raw( 'userEstatus.nombre AS estatus' ),
            DB::raw( 'userEstatus.color AS estatusColor' )
        )
        ->join( 'puestoNivel', 'puestoNivel.id', '=', 'personal.puestoNivelId' )
        ->join( 'nomina', 'nomina.personalId', '=', 'personal.id' )
        ->join( 'asistencia', 'asistencia.personalId', '=', 'personal.id' )
        ->join( 'userEstatus', 'userEstatus.id', '=', 'personal.estatusId' )
        ->where( 'puestoNivel.requiereAsistencia', '=', '1' )
        ->groupBy( 'asistencia.personalId' )
        ->orderBy( 'personal.apellidoP', 'asc' )->get();

        return view( 'asistencias.indexAsistencias', compact( 'usuario', 'personal', 'listaAsistencia', 'intDia', 'intMes', 'intAnio' ) );
    }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */

    public function reloadAsistencia( $intAnio, $intMes ) {
        return redirect()->action( [ asistenciaController::class, 'index' ], [ 'intAnio' => $intAnio, 'intMes' => $intMes ] );
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
            DB::raw( 'puestoNivel.nombre AS puesto' ),
            DB::raw( 'userEstatus.nombre AS estatus' ),
            DB::raw( 'userEstatus.color AS estatusColor' ),
            DB::raw( 'nomina.nomina AS numNomina' ),
        )
        ->join( 'puestoNivel', 'puestoNivel.id', '=', 'personal.puestoNivelId' )
        ->join( 'nomina', 'nomina.personalId', '=', 'personal.id' )
        ->join( 'userEstatus', 'userEstatus.id', '=', 'personal.estatusId' )
        ->where( 'puestoNivel.requiereAsistencia', '=', '1' )
        ->where( 'userEstatus.id', '=', '1' )
        ->where( 'nomina.ingreso', '<=', $strDate )
        ->orderBy( 'personal.apellidoP', 'asc' )->get();

        $dteMesInicio = $intAnio . '-' . $intMes . '-01';
        $dteMesFin = $intAnio . '-' . $intMes . '-' . $objCalendario->getTotalDaysInMonth( $intMes, $intAnio );

        $asistencias = asistencia::where( 'asistencia.fecha', '=', $strDate )->get();

        return view( 'asistencias.asistenciaDiaria', compact( 'usuario', 'personal', 'asistencias', 'intDia', 'intMes', 'intAnio' ) );
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

        // dd( $request );
        $i = 0;
        foreach ( $request[ 'personalId' ] as $value ) {
            // dd( $request->$value[ 0 ] );

            $objAsistencia = new asistencia();
            $objAsistencia->personalId = $request[ 'personalId' ][ $i ];
            $objAsistencia->asistenciaId = $request->$value[ 0 ];
            $objAsistencia->fecha = $request[ 'fecha' ];
            $objAsistencia->horasExtra = $request[ 'horasExtra' ];
            $objAsistencia->tipoHoraExtraId = 1;
            $objAsistencia->save();
            // dd( $objAsistencia );
            $i += 1;
        }

        return redirect()->action( [ asistenciaController::class, 'index' ], [ 'intAnio' => $request[ 'intAnio' ], 'intMes' => $request[ 'intMes' ] ] );
    }

    /**
    * Registra las horas extras del día
    *
    * @param Request $request
    * @return void
    */

    public function horasExtra() {

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
            'personal.id',
            'personal.nombres',
            'personal.apellidoP',
            'personal.apellidoM',
            DB::raw( 'nomina.nomina AS numNomina' ),
            DB::raw( "CONCAT(personal.nombres,' ', personal.apellidoP,' ', personal.apellidoM)as personal" ),
            DB::raw( 'puestoNivel.nombre AS puesto' ),
            DB::raw( 'asistencia.id AS asistenciaId' ),
            'asistencia.horasExtra',
            'asistencia.tipoHoraExtraId',
            DB::raw( 'userEstatus.nombre AS estatus' ),
            DB::raw( 'userEstatus.color AS estatusColor' ),
        )
        ->join( 'puestoNivel', 'puestoNivel.id', '=', 'personal.puestoNivelId' )
        ->join( 'nomina', 'nomina.personalId', '=', 'personal.id' )
        ->join( 'asistencia', 'asistencia.personalId', '=', 'personal.id' )
        ->join( 'userEstatus', 'userEstatus.id', '=', 'personal.estatusId' )
        ->where( 'puestoNivel.requiereAsistencia', '=', '1' )
        ->where( 'asistencia.asistenciaId', '=', '1' )
        ->where( 'userEstatus.id', '=', '1' )
        ->where( 'asistencia.fecha', '=', $strDate )
        ->orderBy( 'personal.apellidoP', 'asc' )->get();

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
        ->join( 'puestoNivel', 'puestoNivel.id', '=', 'personal.puestoNivelId' )
        ->join( 'nomina', 'nomina.personalId', '=', 'personal.id' )
        ->join( 'asistencia', 'asistencia.personalId', '=', 'personal.id' )
        ->join( 'userEstatus', 'userEstatus.id', '=', 'personal.estatusId' )
        ->where( 'puestoNivel.requiereAsistencia', '=', '1' )
        ->groupBy( 'asistencia.personalId' )
        ->orderBy( 'personal.apellidoP', 'asc' )->get();

        $vctTiposHoras = tipoHoraExtra::all();

        $dteMesInicio = $intAnio . '-' . $intMes . '-01';
        $dteMesFin = $intAnio . '-' . $intMes . '-' . $objCalendario->getTotalDaysInMonth( $intMes, $intAnio );

        return view( 'asistencias.horasExtra', compact( 'usuario', 'asistencias', 'listaAsistencia', 'vctTiposHoras', 'intDia', 'intMes', 'intAnio' ) );
    }

    public function reloadHorasExtra( $intAnio, $intMes, $intDia ) {
        // dd( $intAnio, $intMes, $intDia );
        return redirect()->action( [ asistenciaController::class, 'horasExtra' ], [ 'intAnio' => $intAnio, 'intMes' => $intMes, 'intDia' => $intDia ] );
    }

    public function HEstore( Request $request ) {
        // dd( $request );

        for (
            $i = 0; $i < count( $request[ 'asistenciaId' ] );
            $i++
        ) {
            if ( $request[ 'asistenciaId' ][ $i ] != '' ) {
                //** Actualizacion de registro */
                $objAsistencia =  asistencia::where( 'id', '=', $request[ 'asistenciaId' ][ $i ] )->first();

                if ( $objAsistencia ) {
                    $objAsistencia->horasExtra = $request[ 'horasExtra' ][ $i ];
                    $objAsistencia->tipoHoraExtraId = $request[ 'tipoHoraExtraId' ][ $i ];
                    $objAsistencia->save();
                    // dd( $objAsistencia );
                }
            } else {
                // dd( 'No hay id' );
            }
        }

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
        $strFechaInioPeriodo = $vctFechas[ 0 ]->format( 'Y-m-d' );
        $strFechaFinPeriodo = $vctFechas[ 1 ]->format( 'Y-m-d' );

        $usuario = personal::where( 'userId', auth()->user()->id )->first();
        $personal = personal::where( 'id', $personalId )->first();

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
            'asistencia.fecha',
            'asistencia.asistenciaId',
            'asistencia.comentario',
            'asistencia.tipoHoraExtraId'
        )
        ->join( 'puestoNivel', 'puestoNivel.id', '=', 'personal.puestoNivelId' )
        ->join( 'nomina', 'nomina.personalId', '=', 'personal.id' )
        ->join( 'asistencia', 'asistencia.personalId', '=', 'personal.id' )
        ->where( 'puestoNivel.requiereAsistencia', '=', '1' )
        ->where( 'asistencia.personalId', '=', $personal->id )
        ->whereBetween( 'asistencia.fecha',   [ $strFechaInioPeriodo, $strFechaFinPeriodo ] )
        ->orderBy( 'asistencia.fecha', 'asc' )->get();

        $dteMesInicio = $intAnio . '-' . $intMes . '-01';
        $dteMesFin = $intAnio . '-' . $intMes . '-' . $objCalendario->getTotalDaysInMonth( $intMes, $intAnio );
        $vctTiposHoras = tipoHoraExtra::all();

        // dd( $asistencias, $intAnio, $intMes, $intDia, $strDate, $vctFechas[ 0 ], $vctFechas[ 1 ] );

        return view( 'asistencias.asistenciaDetalle',  compact( 'usuario', 'personal', 'asistencias', 'vctTiposHoras', 'intDia', 'intMes', 'intAnio', 'strFechaInioPeriodo', 'strFechaFinPeriodo' ) );
    }

    public function reloadDetalle( $personalId, $intAnio, $intMes, $intDia ) {
        // dd( $personalId, $intAnio, $intMes, $intDia );
        return redirect()->action( [ asistenciaController::class, 'show' ], [ 'personalId' => $personalId, 'intAnio' => $intAnio, 'intMes' => $intMes, 'intDia' => $intDia ] );
    }

    public function corteSemanal( $intAnio = null, $intMes = null, $intDia = null ) {

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
        $strFechaInioPeriodo = $vctFechas[ 0 ]->format( 'Y-m-d' );
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
            'asistencia.fecha',
            DB::raw( 'nomina.diario AS sueldo' ),
            DB::raw( 'nomina.nomina AS numeroNomina' ),
            DB::raw( 'tipoAsistencia.color AS tipoAsistenciaColor' ),
            DB::raw( 'tipoAsistencia.nombre AS tipoAsistenciaNombre' ),
            DB::raw( 'tipoAsistencia.esAsistencia AS esAsistencia' ),
            DB::raw( 'tipoHoraExtra.color AS horaExtraColor' ),
            DB::raw( 'tipoHoraExtra.valor AS horaExtraCosto' ),
            DB::raw( 'userEstatus.nombre AS estatus' ),
            DB::raw( 'userEstatus.color AS estatusColor' ),
        )
        ->join( 'puestoNivel', 'puestoNivel.id', '=', 'personal.puestoNivelId' )
        ->join( 'nomina', 'nomina.personalId', '=', 'personal.id' )
        ->join( 'asistencia', 'asistencia.personalId', '=', 'personal.id' )
        ->join( 'tipoAsistencia', 'tipoAsistencia.id', '=', 'asistencia.asistenciaId' )
        ->join( 'tipoHoraExtra', 'tipoHoraExtra.id', '=', 'asistencia.tipoHoraExtraId' )
        ->join( 'userEstatus', 'userEstatus.id', '=', 'personal.estatusId' )
        ->where( 'puestoNivel.requiereAsistencia', '=', '1' )
        // ->where( 'asistencia.personalId', '=', 23 )
        ->whereBetween( 'asistencia.fecha',   [ $strFechaInioPeriodo, $strFechaFinPeriodo ] )
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
        ->join( 'puestoNivel', 'puestoNivel.id', '=', 'personal.puestoNivelId' )
        ->join( 'nomina', 'nomina.personalId', '=', 'personal.id' )
        ->join( 'asistencia', 'asistencia.personalId', '=', 'personal.id' )
        ->join( 'userEstatus', 'userEstatus.id', '=', 'personal.estatusId' )
        ->where( 'puestoNivel.requiereAsistencia', '=', '1' )
        ->groupBy( 'asistencia.personalId' )
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
                $objPagos->horaExtraColor = $item->horaExtraColor;
                $objPagos->horaExtraCosto = $item->horaExtraCosto;
                $objPagos->tipoAsistencia = $item->tipoAsistenciaId;
                $objPagos->esAsistencia = $item->esAsistencia;
                $objPagos->tipoAsistenciaColor = $item->tipoAsistenciaColor;
                $objPagos->tipoAsistenciaNombre = $item->tipoAsistenciaNombre;
                $vctPagos[] = $objPagos;

                $intDia += 1;
            } else  if ( ( $intDia == 6 ) &&  ( $strEmpleado ==  $item->personal ) ) {
                //** ultimo registro del empleado del periodo en los casos */
                $objPagos = new stdClass;
                $objPagos->fecha = $item->fecha;
                $objPagos->horasExtra = $item->horasExtra;
                $objPagos->horaExtraColor = $item->horaExtraColor;
                $objPagos->horaExtraCosto = $item->horaExtraCosto;
                $objPagos->tipoAsistencia = $item->tipoAsistenciaId;
                $objPagos->esAsistencia = $item->esAsistencia;
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
                $objPagos->horaExtraColor = $item->horaExtraColor;
                $objPagos->horaExtraCosto = $item->horaExtraCosto;
                $objPagos->tipoAsistencia = $item->tipoAsistenciaId;
                $objPagos->esAsistencia = $item->esAsistencia;
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
                $objPagos->horaExtraColor = $item->horaExtraColor;
                $objPagos->horaExtraCosto = $item->horaExtraCosto;
                $objPagos->tipoAsistencia = $item->tipoAsistenciaId;
                $objPagos->esAsistencia = $item->esAsistencia;
                $objPagos->tipoAsistenciaColor = $item->tipoAsistenciaColor;
                $objPagos->tipoAsistenciaNombre = $item->tipoAsistenciaNombre;
                $vctPagos[] = $objPagos;

                $intDia += 1;
                // dd( 'Entre al cierre forzoso ',  $intDia, $objDia );

            }
        }

        // dd( $vctAsistencias, $asistencias, $intAnio, $intMes, $intDia, $strDate, $vctFechas[ 0 ], $vctFechas[ 1 ] );

        return view( 'asistencias.corteSemanal',  compact( 'usuario', 'vctAsistencias',   'asistencias', 'listaAsistencia', 'intDia', 'intMes', 'intAnio', 'strFechaInioPeriodo', 'strFechaFinPeriodo' ) );
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
            // dd( $request->$value[ 0 ] );

            $objAsistencia = asistencia::where( 'id', '=', $request[ 'recordId' ][ $i ] )->first();

            if ( $objAsistencia ) {
                // $objAsistencia->personalId = $request[ 'personalId' ][ $i ];
                $objAsistencia->asistenciaId = $request->$value[ 0 ];
                // $objAsistencia->fecha = $request[ 'fecha' ];
                $objAsistencia->horasExtra = $request[ 'horasExtra' ][ $i ];
                $objAsistencia->tipoHoraExtraId = $request[ 'tipoHoraExtraId' ][ $i ];
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

    public function export() {
        return Excel::download( new CorteSemanalExport, 'corteSemanal.xlsx' );
    }
}
