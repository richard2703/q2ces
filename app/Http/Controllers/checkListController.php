<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\checkList;
use App\Models\bitacoras;
use App\Models\checkListRegistros;
use App\Models\frecuenciaEjecucion;
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
use App\Helpers\Calendario;
use stdClass;

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

    /**
    * Vista de obtención de planeación de
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

    public function planeacion( Request $request ) {
        abort_if ( Gate::denies( 'checkList_index' ), 403 );
        $estatus = $request->input( 'estatus', '0' );
        $objCalendar = new Calendario();

        //*** Arreglo para los dias del periodo **/
        $vctDiasSemanaActual = null;
        $vctDiasPeriodo = null;
        if ( $estatus > 0 ) {
            /** para la semana de trabajo */
            $vctDiasPeriodo = $objCalendar->getPeriodoDeTrabajo( date_create( date( 'Y-m-d' ) ), $estatus );
            $strFechaInicioPeriodo = $vctDiasPeriodo[ 0 ];
            $strFechaFinPeriodo = $vctDiasPeriodo[ 1 ];
        }

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

        /** que tenemos para ese tipo */
        $vctListado = bitacoras::select(
            DB::raw( "CONCAT(bitacoras.nombre,' ', bitacoras.codigo,' v', bitacoras.version)as bitacora" ),
            'bitacoras.id as bitacoraId',
            'bitacorasEquipos.id as bitacoraEquiposId',
            'frecuenciaEjecucion.nombre as frecuencia',
            'frecuenciaEjecucion.id as frecuenciaId',
            DB::raw( "CONCAT(maquinaria.identificador,' ', maquinaria.nombre)as maquinaria" ),
            'maquinaria.id as maquinariaId',
            'maquinaria.estatusId',
        )
        ->join( 'frecuenciaEjecucion', 'frecuenciaEjecucion.id', 'bitacoras.frecuenciaId' )
        ->leftjoin( 'bitacorasEquipos', 'bitacorasEquipos.bitacoraId', 'bitacoras.id' )
        ->rightjoin( 'maquinaria', 'maquinaria.id', 'bitacorasEquipos.maquinariaId' )
        ->whereNull( 'compania' );

        if ( $estatus !== '0' ) {
            $vctListado = $vctListado->where( 'bitacoras.frecuenciaId', '=', $estatus );
        }

        $vctListado = $vctListado->where( 'maquinaria.estatusId', '=', 1 )
        ->orderBy( 'maquinaria.identificador', 'asc' )
        ->orderBy( 'frecuenciaEjecucion.dias', 'asc' )
        ->get() ;
        /** FIN de que tenemos para ese tipo */

        /** que tenemos programado */
        $vctRegistrados = programacionCheckLists::select(
            'programacionCheckLists.*',
            'frecuenciaEjecucion.nombre as frecuencia',
            'frecuenciaEjecucion.id as frecuenciaId',
            DB::raw( "CONCAT(maquinaria.identificador,' - ', maquinaria.nombre)as maquinaria" ),
            DB::raw( "CONCAT(bitacoras.nombre,' ', bitacoras.codigo,' v', bitacoras.version)as bitacora" ),
            DB::raw( "CONCAT(personal.nombres,' ', personal.apellidoP,' ', personal.apellidoM)as personal" ),
        )
        ->join( 'bitacoras', 'bitacoras.id', '=', 'programacionCheckLists.bitacoraId' )
        ->join( 'frecuenciaEjecucion', 'frecuenciaEjecucion.id', 'bitacoras.frecuenciaId' )
        ->join( 'maquinaria', 'maquinaria.id', '=', 'programacionCheckLists.maquinariaId' )
        ->join( 'personal', 'personal.id', '=', 'programacionCheckLists.personalId' );

        if ( $estatus !== '0' ) {
            $vctRegistrados = $vctRegistrados->where( 'bitacoras.frecuenciaId', $estatus )
            ->whereBetween( 'programacionCheckLists.fecha',   [ $strFechaInicioPeriodo, $strFechaFinPeriodo ] );
        }

        $vctRegistrados = $vctRegistrados->orderBy( 'bitacoras.id', 'asc' )
        ->orderBy( 'maquinaria.identificador', 'asc' )
        ->get();
        /** FIN de que tenemos programado */

        $vctDebug = array();
        $vctRegistros = array();
        $vctRecords = array();
        $vctIds = array();

        if ( $estatus > '0' ) {
            //*** recorremos el arreglo de los equipos registrados para checklist */
            $vctDebug[] = 'Iniciando...';
            if ( $vctRegistrados->IsEmpty() == false ) {

                //*** trabajamos los registrados */
                $vctDebug[] = 'Procesando los registrados';
                foreach ( $vctRegistrados as $record ) {

                    $objItem = new stdClass();

                    $objItem->id = $record->id;
                    $objItem->checkListId = $record->checkListId;
                    $objItem->comentario = $record->comentario;
                    $objItem->fecha = $record->fecha;
                    $objItem->estatus = $record->estatus;
                    $objItem->bitacora = $record->bitacora;
                    $objItem->bitacoraId = $record->bitacoraId;
                    $objItem->maquinaria = $record->maquinaria;
                    $objItem->maquinariaId = $record->maquinariaId;
                    $objItem->personal = $record->personal;
                    $objItem->personalId = $record->personalId;
                    $objItem->frecuencia = $record->frecuencia;
                    $objItem->frecuenciaId = $record->frecuenciaId;

                    $vctRecords[] = $objItem;
                    $vctDebug[] = 'Procesado: '. $record->maquinaria. ' ' . $record->maquinariaId ;

                    $vctItems[] = $objItem->maquinariaId;
                    $vctDebug[] = 'Agregando: '. $record->maquinaria . $record->maquinariaId ;

                }

                $vctDebug[] = 'Registrados listos...'  ;
                $vctDebug[] = $vctItems ;

                $vctDebug[] = 'Procesando lista de equipos...'  ;

                foreach ( $vctListado as $item ) {

                    if ( in_array( $item->maquinariaId, $vctItems ) == false ) {
                        $vctDebug[] = "Se procesa la maquina $item->maquinaria de la lista"  ;

                        $objItem = new stdClass();

                        $objItem->id = null;
                        $objItem->checkListId = null;
                        $objItem->comentario = $item->comentario;
                        $objItem->fecha = null;
                        $objItem->estatus = 1;
                        $objItem->bitacora = $item->bitacora;
                        $objItem->bitacoraId = $item->bitacoraId;
                        $objItem->maquinaria = $item->maquinaria;
                        $objItem->maquinariaId = $item->maquinariaId;
                        $objItem->personal = null;
                        $objItem->personalId = null;
                        $objItem->frecuencia = $item->frecuencia;
                        $objItem->frecuenciaId = $item->frecuenciaId;

                        $vctRecords[] = $objItem;
                        break;
                    } else {
                        $vctDebug[] = "La maquina $item->maquinaria ya se encuentra registrada"  ;

                    }
                }

            } else {

                foreach ( $vctListado as $item ) {
                    $vctDebug[] = "Se procesa la maquina $item->maquinaria de la lista"  ;

                    $objItem = new stdClass();

                    $objItem->id = null;
                    $objItem->checkListId = null;
                    $objItem->comentario = $item->comentario;
                    $objItem->fecha = null;
                    $objItem->estatus = 1;
                    $objItem->bitacora = $item->bitacora;
                    $objItem->bitacoraId = $item->bitacoraId;
                    $objItem->maquinaria = $item->maquinaria;
                    $objItem->maquinariaId = $item->maquinariaId;
                    $objItem->personal = null;
                    $objItem->personalId = null;
                    $objItem->frecuencia = $item->frecuencia;
                    $objItem->frecuenciaId = $item->frecuenciaId;

                    $vctRecords[] = $objItem;
                }
            }

        }

        $vctDebug[] = 'Terminado....';

        $vctFilterFrecuencia = frecuenciaEjecucion::select( 'frecuenciaEjecucion.*' )->where( 'dias', '>', 0 )->orderBy( 'frecuenciaEjecucion.dias', 'asc' )->get();

        // dd( $estatus, $vctDiasSemanaActual, 'Registrados', $vctRegistrados, 'Asignados', $vctListado, $vctDebug, 'Registros: ', $vctRecords );

        return view( 'checkList.planeacion', compact( 'vctRecords', 'vctPersonal', 'vctFilterFrecuencia', 'vctDiasPeriodo' ) );
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

    public function storePlaneacion( Request $request ) {
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
            'checkList.*',
            'maquinaria.identificador',
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
        return view( 'checkList.detalleCheckList', compact( 'maquinaria', 'checkList', 'records', 'bitacora' ) );
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

    public function updatePlaneacion( Request $request ) {
        // dd( $request );
        abort_if ( Gate::denies( 'checkList_create' ), 403 );
        $data = $request->all();

        $vctDebug = array();

        for ( $i = 0; $i < count( $data[ 'maquinariaId' ] ) ;
        $i++ ) {

            $intId =  $data[ 'id' ][ $i ];
            $vctDebug[] = 'Validando el Id: ' . $data[ 'id' ][ $i ] . ' en la posición '. $i ;

            $objRecord = ( $intId != 0? programacionCheckLists::where( 'id', '=', $intId )->first(): new programacionCheckLists() );

            $vctDebug[] = $objRecord;

            $objRecord->maquinariaId =  $data[ 'maquinariaId' ][ $i ];
            $objRecord->personalId =  $data[ 'personalId' ][ $i ];
            $objRecord->bitacoraId =  $data[ 'bitacoraId' ][ $i ];
            $objRecord->fecha =  $data[ 'fecha' ][ $i ];
            $objRecord->estatus =  $data[ 'estatus' ][ $i ];
            $objRecord->comentario =  $data[ 'comentario' ][ $i ];
            $objRecord->checkListId =  $data[ 'checkListId' ][ $i ];

            $objRecord->save();
            $vctDebug[] = 'Registrando maquinariaId: ' . $data[ 'maquinariaId' ][ $i ]  ;

        }

        // dd( $vctDebug );

        return redirect()->route( 'checkList.index' )->with( 'success', 'Programación de Bitácora actualizada correctamente.' );

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
            'personal.nombres', 'personal.apellidoP', 'users.username' ,
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
