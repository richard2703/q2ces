<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\tareas;
use App\Models\eventos;
use App\Models\mantenimientos;
use App\Models\servicios;
use App\Models\solicitudes;
use App\Models\reparaciones;
use App\Models\maquinaria;
use App\Models\personal;
use App\Models\inventario;
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
        $maquinaria = maquinaria::orderBy( 'nombre', 'asc' )->get();

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

        // dd( $dteMesFin );

        //** tareas del mes en seleccionado */
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
        ->where( 'tareas.fechaFin', '>=', $dteMesInicio )
        ->where( 'tareas.fechaFin', '<=', $dteMesFin )
        ->orderBy( 'tareas.fechaFin', 'asc' )->get();

        //** eventos del mes seleccionado */
        $vctEventos = eventos::select(
            'eventos.*',
            DB::raw( 'prioridades.nombre AS prioridad' )
        )
        ->join( 'prioridades', 'prioridades.id', '=', 'eventos.prioridadId' )
        ->where( 'eventos.fechaFin', '>=', $dteMesInicio )
        ->where( 'eventos.fechaFin', '<=', $dteMesFin )
        ->orderBy( 'eventos.fechaFin', 'asc' )->get();

        //** mantenimientos del mes seleccionado */
        $vctMantenimientos = mantenimientos::select(
            'mantenimientos.*',
            DB::raw( 'estados.nombre AS estado' ),
            DB::raw( 'maquinaria.nombre AS maquinaria' ),
            DB::raw( 'maquinaria.identificador AS maquinariaCodigo' )
        )
        ->join( 'estados', 'estados.id', '=', 'mantenimientos.estadoId' )
        ->join( 'maquinaria', 'maquinaria.id', '=', 'mantenimientos.maquinariaId' )
        ->where( 'mantenimientos.fechaInicio', '>=', $dteMesInicio )

        ->where( 'mantenimientos.fechaInicio', '<=', $dteMesFin )
        ->orderBy( 'mantenimientos.fechaInicio', 'asc' )->get();

        //** solicitudes del mes seleccionado */
        $vctSolicitudes = solicitudes::select(
            'solicitudes.*',
            DB::raw( "CONCAT(personal.nombres,' ',personal.apellidoP) AS responsable" ),
            DB::raw( 'estados.nombre AS estado' ),
            DB::raw( 'prioridades.nombre AS prioridad' ),
            DB::raw( 'maquinaria.nombre AS maquinaria' ),
            DB::raw( 'users.name AS usuario' ),
            DB::raw( 'reparaciones.nombre AS servicio' )
        )
        ->join( 'personal', 'personal.id', '=', 'solicitudes.responsable' )
        ->join( 'reparaciones', 'reparaciones.id', '=', 'solicitudes.servicioId' )
        ->join( 'estados', 'estados.id', '=', 'solicitudes.estadoId' )
        ->join( 'maquinaria', 'maquinaria.id', '=', 'solicitudes.maquinariaId' )
        ->join( 'prioridades', 'prioridades.id', '=', 'solicitudes.prioridadId' )
        ->join( 'users', 'users.id', '=', 'solicitudes.userId' )
        ->where( 'solicitudes.fechaRequerimiento', '>=', $dteMesInicio )
        ->where( 'solicitudes.fechaRequerimiento', '<=', $dteMesFin )
        ->orderBy( 'solicitudes.fechaRequerimiento', 'asc' )->get();

        //** procesos de reparacion registrados */
        $vctProcesos = reparaciones::select(
            'reparaciones.*'
        )
        ->orderBy( 'reparaciones.nombre', 'asc' )->get();

        $vctHerramientas =   inventario::where( 'tipo', '=',  'herramientas' )->orderBy( 'created_at', 'desc' )->get();
        $vctConsumibles =   inventario::where( 'tipo', '=',  'consumibles' )->orderBy( 'created_at', 'desc' )->get();
        $vctRefacciones =   inventario::where( 'tipo', '=',  'refacciones' )->orderBy( 'created_at', 'desc' )->get();
        $vctCombustibles =   inventario::where( 'tipo', '=',  'combustibles' )->orderBy( 'created_at', 'desc' )->get();

        // dd( $vctMantenimientos );

        return view( 'calendario.calendario', compact( 'usuario', 'personal', 'maquinaria', 'intMes', 'intAnio', 'vctTasks', 'vctEventos', 'vctMantenimientos', 'vctSolicitudes', 'vctProcesos', 'vctHerramientas', 'vctConsumibles', 'vctRefacciones', 'vctCombustibles' ) );
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
