<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

use App\Models\asistencia;
use App\Models\personal;

use App\Helpers\Validaciones;
use App\Helpers\Calendario;
use App\Helpers\Calculos;

class asistenciaController extends Controller {

    public function index( $intAnio = null, $intMes = null, $intDia = null ) {
        $objCalendario = new Calendario();

        $data = request()->all();
        if ( is_array( $data ) == true && count( $data )>0 ) {
            $intMes = $data[ 'intMes' ] ;
            $intAnio = $data[ 'intAnio' ] ;
        } else {
            $intMes = date( 'm' );
            $intAnio = date( 'Y' );
        }

        $dteMesInicio = $intAnio .'-' .$intMes . '-01';
        $dteMesFin = $intAnio .'-' .$intMes .'-'. $objCalendario->getTotalDaysInMonth( $intMes, $intAnio );

        $usuario = personal::where( 'userId', auth()->user()->id )->first();

        $personal = personal::select(
            'personal.id', 'personal.nombres', 'personal.apellidoP', 'personal.apellidoM',
            DB::raw( "CONCAT(personal.nombres,' ', personal.apellidoP,' ', personal.apellidoM)as personal" ),
            DB::raw( 'puestoNivel.nombre AS puesto' ),
            DB::raw( 'nomina.nomina AS numNomina' ),
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
        ->where( 'puestoNivel.requiereAsistencia', '=', '1' )
        ->whereBetween( 'asistencia.fecha',   [ $dteMesInicio, $dteMesFin ] )
        ->groupBy( 'asistencia.personalId' )
        ->orderBy( 'personal.apellidoP', 'asc' )->get();

        // select `personal`.id,  CONCAT( personal.nombres, ' ', personal.apellidoP, ' ', personal.apellidoM )as personal  ,
        // puestoNivel.nombre AS puestoNivel,
        // nomina.ingreso, nomina.nomina as numNomina,
        // COUNT( if ( asistencia.asistenciaId = 1, 1, null ) ) as asistencias,
        // COUNT( if ( asistencia.asistenciaId = 2, 1, null ) ) as faltas,
        // COUNT( if ( asistencia.asistenciaId = 3, 1, null ) ) as incapacidades,
        // COUNT( if ( asistencia.asistenciaId = 4, 1, null ) ) as vacaciones,
        // COUNT( if ( asistencia.asistenciaId = 5, 1, null ) ) as descansos,
        // SUM( asistencia.horasExtra )as extras,
        // COUNT( asistencia.id )as dias
        // from `personal`
        // inner join `puestoNivel` on `puestoNivel`.`id` = `personal`.`puestoNivelId`
        // inner join `nomina` on `nomina`.`personalId` = `personal`.`id`
        // inner join `asistencia` on `asistencia`.`personalId` = `personal`.`id`
        // where `puestoNivel`.`requiereAsistencia` = 1
        //     and    `asistencia`.`fecha` between   '2023-03-01' and '2023-03-31'
        // group by asistencia.personalId
        // order by `personal`.`apellidoP` asc;

        return view( 'asistencias.indexAsistencias', compact( 'usuario', 'personal', 'intDia', 'intMes', 'intAnio' ) );
    }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */

    public function reloadAsistencia( $intAnio, $intMes ) {
        return redirect()->action( [ asistenciaController::class, 'index' ], [ 'intAnio'=>$intAnio, 'intMes'=>$intMes ] );
    }

    public function create( $intAnio = null, $intMes = null, $intDia = null ) {

        $objCalendario = new Calendario();

        $data = request()->all();
        if ( is_array( $data ) == true && count( $data )>0 ) {
            $intMes = $data[ 'intMes' ] ;
            $intAnio = $data[ 'intAnio' ] ;
            $intDia = $data[ 'intDia' ] ;
        } else {
            $intMes = date( 'm' );
            $intAnio = date( 'Y' );
            $intDia = date( 'd' );
        }

        $strDate = $intAnio.'-'.$intMes.'-'.$intDia;

        $usuario = personal::where( 'userId', auth()->user()->id )->first();
        $personal = personal::select( 'personal.*',
        DB::raw( 'puestoNivel.nombre AS puesto' ) )
        ->join( 'puestoNivel', 'puestoNivel.id', '=', 'personal.puestoNivelId' )
        ->join( 'nomina', 'nomina.personalId', '=', 'personal.id' )
        ->where( 'puestoNivel.requiereAsistencia', '=', '1' )
        ->where( 'nomina.ingreso', '<=', $strDate )
        ->orderBy( 'personal.apellidoP', 'asc' )->get();

        $dteMesInicio = $intAnio .'-' .$intMes . '-01';
        $dteMesFin = $intAnio .'-' .$intMes .'-'. $objCalendario->getTotalDaysInMonth( $intMes, $intAnio );

        $asistencias = asistencia::where( 'asistencia.fecha', '=', $strDate )->get();

        return view( 'asistencias.asistenciaDiaria', compact( 'usuario', 'personal', 'asistencias', 'intDia', 'intMes', 'intAnio' ) );
    }

    public function reloadLista( $intAnio, $intMes, $intDia ) {
        // dd( $intAnio, $intMes, $intDia );
        return redirect()->action( [ asistenciaController::class, 'create' ], [ 'intAnio'=>$intAnio, 'intMes'=>$intMes, 'intDia'=>$intDia ] );
    }

    /**
    * Registra la asistencia del día
    *
    * @param Request $request
    * @return void
    */

    public function store( Request $request ) {
        // dd( $request );
        $i = 0;
        foreach ( $request[ 'personalId' ] as $value ) {
            // dd( $request->$value[ 0 ] );

            $objAsistencia = new asistencia();
            $objAsistencia->personalId = $request[ 'personalId' ][ $i ];
            $objAsistencia->asistenciaId = $request->$value[ 0 ];
            $objAsistencia->fecha = $request[ 'fecha' ];
            $objAsistencia->horasExtra = $request[ 'horasExtra' ];
            $objAsistencia->save();
            // dd( $objAsistencia );
            $i += 1;
        }

        return redirect()->action( [ asistenciaController::class, 'index' ], [ 'intAnio'=>$request[ 'intAnio' ], 'intMes'=>$request[ 'intMes' ] ] );

    }

    public function horasExtra() {

        $objCalendario = new Calendario();

        $data = request()->all();
        if ( is_array( $data ) == true && count( $data )>0 ) {
            $intMes = $data[ 'intMes' ] ;
            $intAnio = $data[ 'intAnio' ] ;
            $intDia = $data[ 'intDia' ] ;
        } else {
            $intMes = date( 'm' );
            $intAnio = date( 'Y' );
            $intDia = date( 'd' );
        }

        $strDate = $intAnio.'-'.$intMes.'-'.$intDia;

        $usuario = personal::where( 'userId', auth()->user()->id )->first();

        $asistencias = personal::select(
            'personal.id', 'personal.nombres', 'personal.apellidoP', 'personal.apellidoM',
            DB::raw( "CONCAT(personal.nombres,' ', personal.apellidoP,' ', personal.apellidoM)as personal" ),
            DB::raw( 'puestoNivel.nombre AS puesto' ),
            DB::raw( 'asistencia.id AS asistenciaId' ), 'asistencia.horasExtra'
        )
        ->join( 'puestoNivel', 'puestoNivel.id', '=', 'personal.puestoNivelId' )
        ->join( 'nomina', 'nomina.personalId', '=', 'personal.id' )
        ->join( 'asistencia', 'asistencia.personalId', '=', 'personal.id' )
        ->where( 'puestoNivel.requiereAsistencia', '=', '1' )
        ->where( 'asistencia.asistenciaId', '=', '1' )
        ->where( 'asistencia.fecha', '=', $strDate )
        ->orderBy( 'personal.apellidoP', 'asc' )->get();

        $dteMesInicio = $intAnio .'-' .$intMes . '-01';
        $dteMesFin = $intAnio .'-' .$intMes .'-'. $objCalendario->getTotalDaysInMonth( $intMes, $intAnio );

        return view( 'asistencias.horasExtra', compact( 'usuario', 'asistencias', 'intDia', 'intMes', 'intAnio' ) );
    }

    public function reloadHorasExtra( $intAnio, $intMes, $intDia ) {
        // dd( $intAnio, $intMes, $intDia );
        return redirect()->action( [ asistenciaController::class, 'horasExtra' ], [ 'intAnio'=>$intAnio, 'intMes'=>$intMes, 'intDia'=>$intDia ] );
    }

    public function HEstore( Request $request ) {
        // dd( $request );

        for ( $i = 0; $i < count( $request[ 'asistenciaId' ] );
        $i++ ) {
            if ( $request[ 'asistenciaId' ][ $i ] != '' ) {
                //** Actualizacion de registro */
                $objAsistencia =  asistencia::where( 'id', '=', $request[ 'asistenciaId' ][ $i ] )->first();

                if ( $objAsistencia ) {
                    $objAsistencia->horasExtra = $request[ 'horasExtra' ][ $i ];
                    $objAsistencia->save();
                    // dd( $objAsistencia );
                }
            } else {
                // dd( 'No hay id' );
            }
        }

        return redirect()->action( [ asistenciaController::class, 'index' ], [ 'intAnio'=>$request[ 'intAnio' ], 'intMes'=>$request[ 'intMes' ] ] );
    }

    /**
    * Detalle de la semana de trabajo de un empleado de personal
    *
    * @param personal $personal
    * @return void
    */

    public function show( $personalId, $intAnio = null, $intMes = null, $intDia = null ) {

        $objCalendario = new Calendario();

        $data = request()->all();
        if ( is_array( $data ) == true && count( $data )>0 ) {
            $intMes = $data[ 'intMes' ] ;
            $intAnio = $data[ 'intAnio' ] ;
            $intDia = $data[ 'intDia' ] ;
        } else {
            $intMes = date( 'm' );
            $intAnio = date( 'Y' );
            $intDia = date( 'd' );
        }

        $strDate = $intAnio.'-'.$intMes.'-'.$intDia;
        $vctFechas =  $objCalendario->getSemanaTrabajo( date_create( $strDate ), 3 );

        $usuario = personal::where( 'userId', auth()->user()->id )->first();
        $personal = personal::where( 'id', $personalId )->first();

        $asistencias = personal::select(
            DB::raw( 'personal.id AS personalId' ),
            'personal.nombres', 'personal.apellidoP', 'personal.apellidoM',
            DB::raw( "CONCAT(personal.nombres,' ', personal.apellidoP,' ', personal.apellidoM)as personal" ),
            DB::raw( 'puestoNivel.nombre AS puesto' ),
            DB::raw( 'asistencia.id AS id' ), 'asistencia.horasExtra', 'asistencia.fecha', 'asistencia.asistenciaId'
        )
        ->join( 'puestoNivel', 'puestoNivel.id', '=', 'personal.puestoNivelId' )
        ->join( 'nomina', 'nomina.personalId', '=', 'personal.id' )
        ->join( 'asistencia', 'asistencia.personalId', '=', 'personal.id' )
        ->where( 'puestoNivel.requiereAsistencia', '=', '1' )
        ->where( 'asistencia.personalId', '=', $personal->id )
        ->whereBetween( 'asistencia.fecha',   [ $vctFechas[ 0 ]->format( 'Y-m-d' ), $vctFechas[ 1 ]->format( 'Y-m-d' ) ] )
        ->orderBy( 'asistencia.fecha', 'asc' )->get();

        $dteMesInicio = $intAnio .'-' .$intMes . '-01';
        $dteMesFin = $intAnio .'-' .$intMes .'-'. $objCalendario->getTotalDaysInMonth( $intMes, $intAnio );

        // dd( $asistencias );

        return view( 'asistencias.asistenciaDetalle',  compact( 'usuario', 'personal', 'asistencias', 'intDia', 'intMes', 'intAnio' ) );
    }

    public function reloadDetalle( $personalId, $intAnio, $intMes, $intDia ) {
        // dd( $intAnio, $intMes, $intDia );
        return redirect()->action( [ asistenciaController::class, 'show' ], [ 'personalId'=>$personalId, 'intAnio'=>$intAnio, 'intMes'=>$intMes, 'intDia'=>$intDia ] );
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
                $objAsistencia->save();
                // dd( $objAsistencia );
            }
            $i += 1;
        }

        return redirect()->action( [ asistenciaController::class, 'index' ], [ 'intAnio'=>$request[ 'intAnio' ], 'intMes'=>$request[ 'intMes' ] ] );
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
