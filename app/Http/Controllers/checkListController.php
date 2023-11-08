<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\checkList;
use App\Models\bitacoras;
use App\Models\checkListRegistros;
use App\Models\grupoBitacoras;
use App\Models\grupoTareas;
use App\Models\grupo;
use App\Models\tarea;
use App\Models\maquinaria;
use App\Models\personal;
use App\Models\User;
use App\Models\programacionCheckLists;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class checkListController extends Controller {
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function index() {
        abort_if ( Gate::denies( 'checkList_index' ), 403 );

        $records = checkList::select(
            'checkList.*',
            DB::raw( "CONCAT(maquinaria.identificador,' - ', maquinaria.nombre)as maquinaria" ),
            DB::raw( 'users.username AS usuario' ),
            DB::raw( 'bitacoras.nombre AS bitacora' )
        )
        ->join( 'maquinaria', 'maquinaria.id', '=', 'checkList.maquinariaId' )
        ->join( 'users', 'users.id', '=', 'checkList.usuarioId' )
        ->leftJoin( 'bitacoras', 'bitacoras.id', '=', 'checkList.bitacoraId' )
        ->orderBy( 'registrada', 'desc' )->paginate( 15 );

        $vctEquipos = maquinaria::select( 'maquinaria.nombre', 'maquinaria.id', 'maquinaria.identificador' )
        ->where( 'maquinaria.compania', '=', null )
        ->where( 'maquinaria.estatusId', '=', 1 )->orderBy( 'maquinaria.identificador', 'asc' )->get();

        $vctBitacoras = bitacoras::select( 'bitacoras.*', 'frecuenciaEjecucion.nombre as frecuencia' )
        ->join( 'frecuenciaEjecucion', 'frecuenciaEjecucion.id', 'bitacoras.frecuenciaId' )
        ->where( 'activa', '=', 1 )
        ->orderBy( 'bitacoras.nombre', 'asc' )->get();

        // dd( $records );
        return view( 'checkList.checkList', compact( 'records', 'vctEquipos', 'vctBitacoras' ) );
    }

    /**
    * Vista de consulta de información de programacion
    *
    * @return void
    */

    public function programacion() {
        abort_if ( Gate::denies( 'checkList_index' ), 403 );

        $vctPersonal = personal::select(
            'personal.id',
            DB::raw( "CONCAT(personal.nombres,' ', personal.apellidoP,' ', personal.apellidoM)as personal" ),
            'obras.nombre AS obra',
            'maquinaria.identificador',
            'maquinaria.nombre AS auto',
            'nomina.puestoId',
            'puesto.nombre AS puesto',
            'puesto.puestoNivelId',
            'personal.estatusId',
            'puestoNivel.nombre AS puestoNivel'
        )
        ->join( 'nomina', 'nomina.personalId', 'personal.id' )
        ->join( 'puesto', 'puesto.id', 'nomina.puestoId' )
        ->join( 'puestoNivel', 'puestoNivel.id', 'puesto.puestoNivelId' )
        ->leftjoin( 'obraMaqPer', 'obraMaqPer.personalId', 'personal.id' )
        ->leftjoin( 'maquinaria', 'maquinaria.id', '=', 'obraMaqPer.maquinariaId' )
        ->leftjoin( 'obras', 'obras.id', '=', 'obraMaqPer.obraId' )
        ->where( 'puesto.puestoNivelId', '=', 5 )
        ->where( 'personal.estatusId', '=', 1 ) //*** solo operarios de maquinaria */
        ->orderBy( 'personal.nombres', 'asc' )->get();

        $vctMaquinaria = maquinaria::select( '*' )
        ->where( 'compania', '=', null )
        ->where( 'estatusId', '=', 1 )
        ->orderBy( 'maquinaria.identificador', 'asc' )->get();

        $vctBitacoras = bitacoras::select( 'bitacoras.*', 'frecuenciaEjecucion.nombre as frecuencia' )
        ->join( 'frecuenciaEjecucion', 'frecuenciaEjecucion.id', 'bitacoras.frecuenciaId' )
        ->where( 'activa', '=', 1 )
        ->orderBy( 'bitacoras.nombre', 'asc' )->get();

        $vctRecords = programacionCheckLists::select(
            'programacionCheckLists.*',
            'bitacoras.nombre as bitacora',
            DB::raw( "CONCAT(personal.nombres,' ', personal.apellidoP,' ', personal.apellidoM)as personal" ),
            DB::raw( "CONCAT(maquinaria.identificador,' - ', maquinaria.nombre)as maquinaria" ),
        )
        ->join( 'personal', 'personal.id', '=', 'programacionCheckLists.personalId' )
        ->join( 'maquinaria', 'maquinaria.id', '=', 'programacionCheckLists.maquinariaId' )
        ->join( 'bitacoras', 'bitacoras.id', '=', 'programacionCheckLists.bitacoraId' )
        ->orderBy( 'programacionCheckLists.id', 'desc' )
        ->paginate( 15 );

        // $vctEquipos = maquinaria::select( 'maquinaria.nombre', 'maquinaria.id', 'maquinaria.identificador' )->where( 'maquinaria.compania', '=', null )->where( 'maquinaria.estatusId', '=', 1 )->orderBy( 'maquinaria.identificador', 'asc' )->get();
        // $vctBitacoras = bitacoras::select( 'bitacoras.nombre', 'bitacoras.id' )->where( 'bitacoras.activa', '=', 1 )->orderBy( 'bitacoras.nombre', 'asc' )->get();

        return view( 'checkList.programacion', compact( 'vctRecords', 'vctPersonal', 'vctMaquinaria', 'vctBitacoras' ) );
    }

    /**
    * Vista de trabajo pendiente por personal
    *
    * @return void
    */

    public function pendientes() {
        abort_if ( Gate::denies( 'checkList_index' ), 403 );

        $objPersonal = personal::where( 'userId', auth()->user()->id )->first();

        if ( $objPersonal ) {

            $vctRecords = programacionCheckLists::select(
                'programacionCheckLists.*',
                'bitacoras.nombre as bitacora',
                DB::raw( "CONCAT(personal.nombres,' ', personal.apellidoP,' ', personal.apellidoM)as personal" ),
                DB::raw( "CONCAT(maquinaria.identificador,' - ', maquinaria.nombre)as maquinaria" ),
            )
            ->join( 'personal', 'personal.id', '=', 'programacionCheckLists.personalId' )
            ->join( 'maquinaria', 'maquinaria.id', '=', 'programacionCheckLists.maquinariaId' )
            ->join( 'bitacoras', 'bitacoras.id', '=', 'programacionCheckLists.bitacoraId' )
            ->where( 'personal.id', '=', $objPersonal->id )
            ->orderBy( 'programacionCheckLists.id', 'desc' )
            ->paginate( 15 );
        } else {

            $objUsuario = User::select( 'model_has_roles.role_id' )->join( 'model_has_roles', 'model_has_roles.model_id', 'users.id' )->where( 'id', auth()->user()->id )->first();

            if ( $objUsuario->role_id == 1 ) {
                //*** es administrador */
                $vctRecords = programacionCheckLists::select(
                    'programacionCheckLists.*',
                    'bitacoras.nombre as bitacora',
                    DB::raw( "CONCAT(personal.nombres,' ', personal.apellidoP,' ', personal.apellidoM)as personal" ),
                    DB::raw( "CONCAT(maquinaria.identificador,' - ', maquinaria.nombre)as maquinaria" ),
                )
                ->join( 'personal', 'personal.id', '=', 'programacionCheckLists.personalId' )
                ->join( 'maquinaria', 'maquinaria.id', '=', 'programacionCheckLists.maquinariaId' )
                ->join( 'bitacoras', 'bitacoras.id', '=', 'programacionCheckLists.bitacoraId' )
                ->orderBy( 'programacionCheckLists.id', 'desc' )
                ->paginate( 15 );
            } else {
                $vctRecords = null;
            }
        }

        // dd( $records );
        return view( 'checkList.pendientes', compact( 'vctRecords' ) );
    }

    /**
    * Show the form for seleccionar sobre que equipo se realizará un checklist.
    *
    * @return \Illuminate\Http\Response
    */

    public function seleccionar() {
        // dd( 'Hola' );
        abort_if ( Gate::denies( 'checkList_index' ), 403 );

        $records = bitacoras::select(
            'bitacoras.*',
            DB::raw( 'maquinaria.nombre AS maquinaria' ),
            DB::raw( 'maquinaria.id AS maquinariaId' ),
            DB::raw( 'bitacoras.nombre AS bitacora' ),
            DB::raw( 'bitacoras.id AS bitacoraId' )
        )
        ->join( 'maquinaria', 'maquinaria.bitacoraId', '=', 'bitacoras.id' )
        ->orderBy( 'bitacoras.nombre', 'desc' )->paginate( 15 );

        return view( 'checkList.seleccionarChecklist', compact( 'records' ) );
    }
    /**
    * Show the form for seleccionar sobre que equipo se realizará un checklist.
    *
    * @return \Illuminate\Http\Response
    */

    public function ejecutar( Request $request ) {
        //  dd( $request );
        abort_if ( Gate::denies( 'checkList_execute' ), 403 );

        $bitacoraId = $request[ 'bitacoraId' ];
        $maquinariaId = $request[ 'maquinariaId' ];

        $programacionId =  ( is_null( $request[ 'programacionId' ] ) == true ? null:  $request[ 'programacionId' ] );

        return redirect()->action( [ checkListController::class, 'create' ], [ 'bitacora' => $bitacoraId, 'maquinaria' => $maquinariaId, 'programacion' => $programacionId ] );

    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function create( $bitacoraId, $maquinariaId, $programacionId = null ) {
        abort_if ( Gate::denies( 'checkList_execute' ), 403 );

        $maquinaria = maquinaria::select( 'maquinaria.*' )->where( 'id', '=', $maquinariaId )->first();
        $bitacora = bitacoras::select( 'bitacoras.*' )->where( 'id', '=', $bitacoraId )->first();
        //*** obtenemos las tareas */
        $vctTareas = grupo::select(
            DB::raw( 'tarea.id AS tareaId' ),
            DB::raw( 'tarea.nombre AS tarea' ),
            DB::raw( 'tarea.tipoValorId' ),
            DB::raw( 'tipoValorTarea.nombre AS tipoValor' ),
            DB::raw( 'tipoValorTarea.controlHtml' ),
            DB::raw( 'grupo.nombre AS grupo' ),
            'grupoBitacoras.*',
            'tipoValorTarea.*'
        )
        ->join( 'grupoBitacoras', 'grupoBitacoras.grupoId', '=', 'grupo.id' )
        ->join( 'grupoTareas', 'grupoTareas.grupoId', '=', 'grupo.id' )
        ->join( 'tarea', 'tarea.id', '=', 'grupoTareas.tareaId' )
        ->join( 'tipoValorTarea', 'tipoValorTarea.id', '=', 'tarea.tipoValorId' )
        ->where( 'grupoBitacoras.bitacoraId', '=', $bitacora->id )->get();

        // dd( $bitacora, $maquinaria,  $vctTareas, $bitacoraId, $maquinariaId, $programacionId );

        return view( 'checkList.nuevoCheckList', compact( 'maquinaria', 'bitacora', 'vctTareas', 'programacionId' ) );
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
    * Asigna y programa el trabajo de un checklist de personal
    *
    * @param Request $request
    * @return void
    */

    public function asignacion( Request $request ) {
        //
        // dd( $request );
        abort_if ( Gate::denies( 'checkList_assign_bitacoras' ), 403 );

        $request->validate( [
            'personalId' => 'required',
            'bitacoraId' => 'required',
            'maquinariaId' => 'required',
            'fecha' => 'required',
            'comentario' => 'nullable|max:1024',
        ], [
            'personalId.required' => 'El campo nombre es obligatorio.',
            'bitacoraId.required' => 'El campo nombre es obligatorio.',
            'maquinariaId.required' => 'El campo nombre es obligatorio.',
            'fecha.required' => 'El campo nombre es obligatorio.',
            'comentario.max' => 'El campo comentarios excede el límite de caracteres permitidos.',
        ] );
        $programacion = $request->all();
        // dd( $programacion );

        $programacionCheckLists = programacionCheckLists::create( $programacion );
        Session::flash( 'message', 1 );
        return redirect()->route( 'checkList.programacion', $programacionCheckLists->id )->with( 'success', 'Programación de Bitácora creada correctamente.' );
    }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */

    public function show( $id ) {
        abort_if ( Gate::denies( 'checkList_show' ), 403 );

        $checkList = checkList::select(
            'checkList.*', 'maquinaria.identificador',
            DB::raw( "CONCAT(maquinaria.identificador,' - ',maquinaria.nombre) AS maquinaria" ),
            DB::raw( 'users.username AS usuario' ),
            DB::raw( 'bitacoras.nombre AS bitacora' )
        )
        ->join( 'maquinaria', 'maquinaria.id', '=', 'checkList.maquinariaId' )
        ->join( 'users', 'users.id', '=', 'checkList.usuarioId' )
        ->leftJoin( 'bitacoras', 'bitacoras.id', '=', 'checkList.bitacoraId' )
        ->orderBy( 'registrada', 'desc' )
        ->where( 'checkList.id', '=', $id )->first();

        $records = checkListRegistros::select(
            'checkListRegistros.*',
            DB::raw( 'maquinaria.nombre AS maquinaria' ),
            DB::raw( 'users.username AS usuario' ),
            DB::raw( 'bitacoras.nombre AS bitacora' )
        )
        ->join( 'maquinaria', 'maquinaria.id', '=', 'checkListRegistros.maquinariaId' )
        ->join( 'users', 'users.id', '=', 'checkListRegistros.usuarioId' )
        ->leftJoin( 'bitacoras', 'bitacoras.id', '=', 'checkListRegistros.bitacoraId' )
        ->orderBy( 'grupo', 'asc' )
        ->where( 'checkListRegistros.checkListId', '=', $id )->get();

        $maquinaria = maquinaria::select( 'maquinaria.*' )->where( 'id', '=', $checkList->maquinariaId )->first();
        $bitacora = bitacoras::select( 'bitacoras.*' )->where( 'id', '=', $checkList->bitacoraId )->first();

        // dd( $records );
        return view( 'checkList.detalleCheckList', compact( 'maquinaria', 'checkList', 'records','bitacora' ) );
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
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */

    public function updateAsignacion( Request $request ) {
        abort_if ( Gate::denies( 'checkList_edit' ), 403 );

        // dd( $request );

        $request->validate( [
            'personalId' => 'required',
            'bitacoraId' => 'required',
            'maquinariaId' => 'required',
            'fecha' => 'required',
            'comentario' => 'nullable|max:1024',
        ], [
            'personalId.required' => 'El campo nombre es obligatorio.',
            'bitacoraId.required' => 'El campo nombre es obligatorio.',
            'maquinariaId.required' => 'El campo nombre es obligatorio.',
            'fecha.required' => 'El campo nombre es obligatorio.',
            'comentario.max' => 'El campo comentarios excede el límite de caracteres permitidos.',
        ] );
        $data = $request->all();

        $record = programacionCheckLists::where( 'id', $data[ 'controlId' ] )->first();
        $record->update( $data );
        Session::flash( 'message', 1 );

        return redirect()->route( 'checkList.programacion', $record->id )->with( 'success', 'Programación de Bitácora actualizada correctamente.' );
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */

    public function destroy( $id ) {

        abort_if ( Gate::denies( 'checkList_destroy' ), 403 );
        try {

            $bitacora = bitacoras::where( 'id', '=', $id )->first();
            $bitacora->delete();
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

    public function printTicketUsuario( $id ) {

        $checkList = checkList::select(
            'checkList.*', 'maquinaria.identificador',
            'personal.nombres','personal.apellidoP','users.username' ,
            DB::raw( "CONCAT(maquinaria.identificador,' - ',maquinaria.nombre) AS maquinaria" ),
            DB::raw( 'users.username AS usuario' ),
            DB::raw( 'bitacoras.nombre AS bitacora' )
        )
        ->join( 'maquinaria', 'maquinaria.id', '=', 'checkList.maquinariaId' )
        ->join( 'users', 'users.id', '=', 'checkList.usuarioId' )
        ->leftJoin( 'bitacoras', 'bitacoras.id', '=', 'checkList.bitacoraId' )
        ->leftJoin( 'personal', 'personal.userId', '=', 'checkList.usuarioId' )
        ->orderBy( 'registrada', 'desc' )
        ->where( 'checkList.id', '=', $id )->first();

        // dd( 'printTicketChofer', $checkList );

        return view( 'checkList.ticketCheckListUsuario', compact( 'checkList' ) );
    }

    public function printTicketCheckList( $id ) {

        $checkList = checkList::select(
            'checkList.*', 'maquinaria.identificador',
            DB::raw( "CONCAT(maquinaria.identificador,' - ',maquinaria.nombre) AS maquinaria" ),
            DB::raw( 'users.username AS usuario' ),
            DB::raw( 'bitacoras.nombre AS bitacora' )
        )
        ->join( 'maquinaria', 'maquinaria.id', '=', 'checkList.maquinariaId' )
        ->join( 'users', 'users.id', '=', 'checkList.usuarioId' )
        ->leftJoin( 'bitacoras', 'bitacoras.id', '=', 'checkList.bitacoraId' )
        ->orderBy( 'registrada', 'desc' )
        ->where( 'checkList.id', '=', $id )->first();

        // dd( 'printTicketChofer', $servicio );

        return view( 'checkList.ticketCheckListCerrado', compact( 'checkList' ) );
    }

}
