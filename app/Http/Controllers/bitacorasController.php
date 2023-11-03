<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;
use App\Models\bitacoras;
use App\Models\grupo;
use App\Models\maquinaria;
use App\Models\grupoBitacoras;
use App\Helpers\Validaciones;
use App\Models\frecuenciaEjecucion;
use App\Models\bitacorasEquipos;


class bitacorasController extends Controller {
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function index() {

        abort_if ( Gate::denies( 'bitacora_index' ), 403 );

        $vctBitacoras = bitacoras::select( 'bitacoras.*', 'frecuenciaEjecucion.nombre as frecuencia' )
        ->leftJoin('frecuenciaEjecucion', 'bitacoras.frecuenciaId', '=', 'frecuenciaEjecucion.id')
       // ->leftJoin('maquinaria', 'maquinaria.bitacoraId', '=', 'bitacoras.id')
        ->leftJoin('grupoBitacoras','grupoBitacoras.bitacoraId','bitacoras.id')
        ->leftJoin('bitacorasEquipos','bitacorasEquipos.bitacoraId','bitacoras.id')
        ->groupBy('bitacorasEquipos.bitacoraId')
        ->groupBy('grupoBitacoras.bitacoraId')
        ->selectRaw('count(distinct(bitacorasEquipos.maquinariaId)) as totalEquipos')
        ->selectRaw('count(distinct(grupoBitacoras.grupoId)) as totalGrupos')
        ->orderBy( 'created_at', 'desc' )->paginate( 15 );

        return view( 'bitacora.indexBitacora', compact( 'vctBitacoras' ) );
    }

    public function indexMaquinaria($id) {

        // dd($id);

        abort_if ( Gate::denies( 'bitacora_index' ), 403 );

        $records = maquinaria::select( 'maquinaria.*' )
        ->where('maquinaria.bitacoraId','=',$id)
        ->orderBy( 'created_at', 'desc' )->paginate( 15 );

        $bitacora = bitacoras::where('id','=',$id)->first();

        return view( 'bitacora.porMaquinaria', compact( 'records','bitacora' ) );
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function create() {

        abort_if ( Gate::denies( 'bitacora_create' ), 403 );

        $vctGrupos = grupo::select( 'grupo.*', )
        ->orderBy( 'created_at', 'desc' )->get();

        $vctFrecuencias = frecuenciaEjecucion::select( 'frecuenciaEjecucion.*', )
        ->orderBy( 'frecuenciaEjecucion.dias', 'asc' )->get();

        return view( 'bitacora.nuevoBitacora', compact( 'vctGrupos', 'vctFrecuencias' ) );
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */

    public function store( Request $request ) {
        // dd( $request );

        abort_if ( Gate::denies( 'bitacora_create' ), 403 );

        $request->validate( [
            'nombre' => 'required|max:250',
            'comentario' => 'nullable|max:500',
            'codigo' => 'required|max:10',
        ], [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'nombre.max' => 'El campo título excede el límite de caracteres permitidos.',
            'comentario.max' => 'El campo comentarios excede el límite de caracteres permitidos.',
            'codigo.max' => 'El campo código excede el límite de caracteres permitidos.',
            'comentario.max' => 'El campo comentarios excede el límite de caracteres permitidos.',
        ] );
        $bitacoras = $request->all();
        $bitacoras['codigo']= strtoupper(trim($request['codigo']));

        $bitacoras = bitacoras::create( $bitacoras );
        Session::flash( 'message', 1 );
        return redirect()->route( 'bitacoras.edit', $bitacoras->id )->with( 'success', 'Bitácora creada correctamente.' );
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

        abort_if ( Gate::denies( 'bitacora_edit' ), 403 );

        $bitacora = bitacoras::where( 'id', '=', $id )->first();

        $grupos = grupoBitacoras::select( 'grupoBitacoras.*',
        DB::raw( 'bitacoras.nombre as bitacora' ),
        DB::raw( 'grupo.nombre as grupo' ),
        DB::raw( 'grupo.comentario as comentario' ),
        )
        ->join( 'grupo', 'grupo.id', '=', 'grupoBitacoras.grupoId' )
        ->join( 'bitacoras', 'bitacoras.id', '=', 'grupoBitacoras.bitacoraId' )
        ->where( 'bitacoraId', '=', $id )->get();

        $equipos = bitacorasEquipos::select(
            'bitacorasEquipos.id',
            'bitacorasEquipos.maquinariaId',
            'bitacorasEquipos.bitacoraId',
            DB::raw( "CONCAT(maquinaria.identificador,' - ', maquinaria.nombre)as maquinaria" ),
            DB::raw( "CONCAT('Equipo: ',maquinaria.identificador,' - ', maquinaria.nombre,', Marca: ', marca.nombre,', Categoría: ', maquinariaCategoria.nombre, ', Modelo: ', maquinaria.modelo, ', NS: ', maquinaria.numserie ,', Placas: ', maquinaria.placas)as descripcion" ),
        )
        ->join( 'maquinaria', 'maquinaria.id', '=', 'bitacorasEquipos.maquinariaId' )
        ->leftjoin('marca','marca.id','maquinaria.marcaId')
        ->leftjoin('maquinariaCategoria','maquinariaCategoria.id','maquinaria.categoriaId')
        ->whereNull( 'compania' )
        ->where('bitacorasEquipos.bitacoraId','=',$id)->get();

        $vctFrecuencias = frecuenciaEjecucion::select( 'frecuenciaEjecucion.*', )
        ->orderBy( 'frecuenciaEjecucion.dias', 'asc' )->get();

        // dd($equipos);
        return view( 'bitacora.editarBitacora', compact( 'bitacora','grupos','equipos', 'vctFrecuencias' ) );
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
        abort_if ( Gate::denies( 'bitacora_edit' ), 403 );

        $objValida = new Validaciones();
        $request->validate( [
            'nombre' => 'required|max:250',
            'comentario' => 'nullable|max:500',
            'codigo' => 'required|max:10',
        ], [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'nombre.max' => 'El campo título excede el límite de caracteres permitidos.',
            'codigo.required' => 'El campo código es obligatorio.',
            'codigo.max' => 'El campo código excede el límite de caracteres permitidos.',
            'comentario.max' => 'El campo comentarios excede el límite de caracteres permitidos.',
        ] );

        $data = $request->all();
        $vctDebug=array();
        $bitacora = bitacoras::where( 'id', '=', $id )->first();

        if ( is_null( $bitacora ) == false ) {
            $bitacora->nombre = $request['nombre'];
            $bitacora->comentario = $request['comentario'];
            $bitacora->frecuenciaId = $request['frecuenciaId'];
            $bitacora->codigo = strtoupper(trim($request['codigo']));
            $bitacora->version = $request['version'];
            $bitacora->update();
            // dd( $data );

            //*** trabajamos con los items de grupos registrados y no registrados */
            $vctRegistrados = $objValida->preparaArreglo(grupoBitacoras::where('bitacoraId', '=', $bitacora->id)->pluck('id')->toArray());
            $vctArreglo = $objValida->preparaArreglo($request['grupoBitacoraId']);

            // dd( $request, $data, "Registrados", $vctRegistrados, "Arreglo", $vctArreglo );

            //*** Preguntamos si existen registros en el arreglo */
            if (is_array($vctArreglo) && count($vctArreglo) > 0) {
                $vctDebug[]="Hay registros en el arreglo de bitacoras y grupos";

                //** buscamos si el registrado esta en el arreglo, de no ser asi se elimina */
                if (is_array($vctRegistrados) && count($vctRegistrados) > 0) {
                    for (
                        $i = 0;
                        $i < count($vctRegistrados);
                        $i++
                    ) {
                        $intValor = (int) $vctRegistrados[$i];

                        if (in_array($intValor, $vctArreglo) == false) {
                            /*** no existe y se debe de eliminar */
                            grupoBitacoras::destroy($vctRegistrados[$i]);
                            // dd( 'Borrando por que se quito la tarea del grupo' );
                        } else {
                            /*** existe el registro */
                            // dd( 'Sigue vivo en el arreglo' );
                        }
                    }
                }

                //*** trabajamos el resto */
                for (
                    $i = 0;
                    $i < count($request['grupoBitacoraId']);
                    $i++
                ) {
                    if ($request['grupoBitacoraId'][$i] != '') {
                        $vctDebug[]='Actualizacion de registro';
                        $objRecord =  grupoBitacoras::where('id', '=', $request['grupoBitacoraId'][$i])->first();

                        if ($objRecord && $objRecord->id > 0) {
                            $objRecord->bitacoraId  = $request['bitacoraId'][$i];
                            $objRecord->grupoId  =  $request['grupoId'][$i];
                            $objRecord->save();
                            $vctDebug[]= 'Actualizando el grupo->'.  $objRecord->id;
                        }
                    } else {

                        //** No existe en bd */
                        if ($request['grupoBitacoraId'][$i] == 0) {

                            $vctDebug[]='Validamos si ya existe el grupo de tareas en la bitacora, id->'.   $request['grupoId'][$i];
                            $objRecord =  grupoBitacoras::where('bitacoraId', '=', $request['bitacoraId'][$i])->where('grupoId', '=', $request['grupoId'][$i])->first();

                            if( $objRecord){
                                $vctDebug[]='Ya existe este grupo en la bitacora, id->'. $objRecord->id;
                            }else{
                                $objRecord = new grupoBitacoras();
                                $objRecord->bitacoraId  = $request['bitacoraId'][$i];
                                $objRecord->grupoId  =  $request['grupoId'][$i];
                                $objRecord->save();
                                $vctDebug[]='Guardando el grupo de tareas';
                            }
                        }
                    }
                }
            } else {
                //*** se deben de eliminar todos los registrados */
                if (is_array($vctRegistrados) && count($vctRegistrados) > 0) {
                    $vctDebug[]= 'Borrando todos los items de grupos de tareas';
                    for (
                        $i = 0;
                        $i < count($vctRegistrados);
                        $i++
                    ) {
                        grupoBitacoras::destroy($vctRegistrados[$i]);
                        $vctDebug[]= 'Borrando el item->'. $vctRegistrados[$i];
                    }
                }
            }


            //*** trabajamos con los items de grupos registrados y no registrados */
            $vctRegistrados = $objValida->preparaArreglo(bitacorasEquipos::where('bitacoraId', '=', $bitacora->id)->pluck('id')->toArray());
            $vctArreglo = $objValida->preparaArreglo($request['bitacorasEquiposId']);

            //*** Preguntamos si existen registros en el arreglo */
            if (is_array($vctArreglo) && count($vctArreglo) > 0) {
                $vctDebug[]="Hay registros en el arreglo de bitacoras y equipos";
                //** buscamos si el registrado esta en el arreglo, de no ser asi se elimina */
                if (is_array($vctRegistrados) && count($vctRegistrados) > 0) {
                    for (
                        $i = 0;
                        $i < count($vctRegistrados);
                        $i++
                    ) {
                        $intValor = (int) $vctRegistrados[$i];

                        if (in_array($intValor, $vctArreglo) == false) {
                            $vctDebug[]='No existe y se debe de eliminar el id->'. $vctRegistrados[$i];
                            bitacorasEquipos::destroy($vctRegistrados[$i]);
                            $vctDebug[]='Borrando, se quito el equipo de la bitacora, id->'. $vctRegistrados[$i];
                        } else {
                            /*** existe el registro */
                            $vctDebug[]='Sigue vivo el equipo en el arreglo, id->'. $vctRegistrados[$i];
                        }
                    }
                }

                //*** trabajamos el resto */
                for (
                    $i = 0;
                    $i < count($request['bitacorasEquiposId']);
                    $i++
                ) {
                    if ($request['bitacorasEquiposId'][$i] != '') {
                        //** Actualizacion de registro */
                        $objRecord =  bitacorasEquipos::where('id', '=', $request['bitacorasEquiposId'][$i])->first();

                        if ($objRecord && $objRecord->id > 0) {
                            $objRecord->bitacoraId  = $request['bitacoraId'][$i];
                            $objRecord->maquinariaId  =  $request['maquinariaId'][$i];
                            $objRecord->save();
                            $vctDebug[]='Actualizando el equipo en la bitacora, id->'. $objRecord->id;
                        }
                    } else {

                        //** No existe en bd */
                        if ($request['bitacorasEquiposId'][$i] == 0) {

                            $vctDebug[]='Validamos si ya existe el equipo en la bitacora, id->'.  $request['maquinariaId'][$i];
                            $objRecord =  bitacorasEquipos::where('bitacoraId', '=', $request['bitacoraId'][$i])->where('maquinariaId', '=', $request['maquinariaId'][$i])->first();

                            if( $objRecord){
                                $vctDebug[]='Ya existe este equipo en la bitacora, id->'. $objRecord->id;
                            }else{

                            $objRecord = new bitacorasEquipos();
                            $objRecord->bitacoraId  = $request['bitacoraId'][$i];
                            $objRecord->maquinariaId  =  $request['maquinariaId'][$i];
                            $objRecord->save();
                            $vctDebug[]='Se crea el equipo en la bitacora, id->'. $objRecord->id;
                            }


                        }
                    }
                }
            } else {
                //*** se deben de eliminar todos los registrados */
                if (is_array($vctRegistrados) && count($vctRegistrados) > 0) {
                        $vctDebug[]= 'Borrando todos los items de equipos';
                    for (
                        $i = 0;
                        $i < count($vctRegistrados);
                        $i++
                    ) {
                        bitacorasEquipos::destroy($vctRegistrados[$i]);
                        $vctDebug[]= 'Borrando el item->'. $vctRegistrados[$i];
                    }
                }
            }

            //   dd($vctDebug, $vctArreglo, $vctRegistrados);


            Session::flash( 'message', 1 );
        }

        return redirect()->route( 'bitacoras.index' );
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */

    public function destroy( $id ) {

        abort_if ( Gate::denies( 'bitacora_destroy' ), 403 );
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

    /**
     * Obtiene los equipos ligados con una bitacora
     *
     * @param integer $bitacoraId Identificador de la bitacora
     * @return void
     */
    public function equiposPorBitacora($bitacoraId)
    {
        // if ($bitacoraId == 1) {
        //     $data =  maquinaria::select('id', 'nombre')
        //         ->get();
        // } else {
            $data =  bitacorasEquipos::select(
                'bitacorasEquipos.*',
                'maquinaria.nombre',
                'maquinaria.identificador',
                DB::raw( "CONCAT(maquinaria.identificador,' - ', maquinaria.nombre)as maquinaria" )
                )
                ->join('maquinaria','maquinaria.id','bitacorasEquipos.maquinariaId')
                ->where('bitacorasEquipos.bitacoraId','=', $bitacoraId)
                ->orderby("maquinaria.identificador", "asc")
                ->get();
        // }
        // dd($data);
        return response()->json($data);
    }
}
