<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\tareas;
use App\Models\maquinaria;
use App\Models\personal;
use App\Helpers\Validaciones;
use App\Helpers\Calendario;
use App\Helpers\Calculos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class calendarioController extends Controller {
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function index( $intAnio = null, $intMes = null ) {
        $objCalendario = new Calendario();
        $usuario = personal::where( 'userId', auth()->user()->id )->first();
        $personal = personal::orderBy( 'nombres', 'asc' )->get();

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

        // dd($dteMesFin);

        $vctTasks =  tareas::select(
            'tareas.*',
            DB::raw( 'tareas.responsable AS responsableId' ),
            DB::raw( "CONCAT(personal.nombres,' ',personal.apellidoP) AS responsable" ),
            DB::raw( 'prioridades.nombre AS prioridad' ),
            DB::raw( 'estados.nombre AS estado' )
        )
        ->join( 'personal', 'personal.id', '=', 'tareas.responsable' )
        ->join( 'prioridades', 'prioridades.id', '=', 'tareas.prioridadId' )
        ->join( 'estados', 'estados.id', '=', 'tareas.estadoId' )
        ->where( 'fechaFin', '>=', $dteMesInicio )
        ->where( 'fechaFin', '<=', $dteMesFin )
        ->orderBy( 'fechaFin', 'asc' )->get();

        return view( 'calendario.calendario', compact( 'usuario', 'personal', 'intMes', 'intAnio', 'vctTasks' ) );
    }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */

    public function reloadCalendario( $intAnio, $intMes ) {
        return redirect()->action( [ calendarioController::class, 'index' ], [ 'intAnio'=>$intAnio, 'intMes'=>$intMes ] );
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
