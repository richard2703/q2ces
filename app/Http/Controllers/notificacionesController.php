<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\notificaciones;
use App\Models\personal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Carbon;
use Illuminate\Database\QueryException;
use App\Helpers\Notificacion;

class notificacionesController extends Controller {
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function index() {

        $usuario = personal::where( 'userId', auth()->user()->id )->first();
        $blnUsuario = false;

        if ( $usuario ) {
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
            ->where( 'personal.userId', '=', $usuario->userId )->first();

            if ( isset( $usuario->id ) ) {
                $records = notificaciones::where( 'personalId', '=', $personal->id )->orderBy( 'created_at', 'desc' )->paginate( 15 );
                $blnUsuario = true;
            } else {
            }
        } else {
            $records = notificaciones::orderBy( 'created_at', 'desc' )->paginate( 15 );
            $personal = null;
        }

        return view( 'notificaciones.indexNotificaciones', compact( 'records', 'usuario', 'personal', 'blnUsuario' ) );
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

    public function update( Request $request, $id = 0 ) {
        $intRecordId = 0;
        if ( $id > 0 ) {

            $intRecordId = $id;
            // dd( $id );

        } else {

            $data = $request->all();
            $intRecordId = $data[ 'controlId' ] ;
            // dd( $request );

        }

        $record = notificaciones::where( 'id', $intRecordId )->first();

        if ( is_null( $record ) == false ) {
            $record->visto = 1;
            $record->save();
            Session::flash( 'message', 1 );
        }

        return redirect()->route( 'notificaciones.index' );
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */

    public function destroy( $id ) {
        try {

            $notificacion = notificaciones::where( 'id', '=', $id )->first();
            if ( isset( $notificacion->id ) ) {
                $notificacion->delete();

            } else {
                return redirect()->back()->with( 'faild', 'No se elimino el registro' );
            }
            // Intenta eliminar
        } catch ( QueryException $e ) {
            if ( $e->getCode() === 23000 ) {
                return redirect()->back()->with( 'faild', 'No Puedes Eliminar ' );
                // Esto es un error de restricción de clave externa ( FOREIGN KEY constraint )
                // Puedes mostrar un mensaje de error o realizar otras acciones aquí.
            } else {
                return redirect()->back()->with( 'faild', 'No Puedes Eliminar si esta en uso' );
                // Otro tipo de error de base de datos
                // Maneja según sea necesario
            }
        }
        return redirect()->back()->with( 'success', 'Eliminado correctamente' );
    }
}
