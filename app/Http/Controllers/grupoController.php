<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\grupo;
use App\Models\tarea;
use App\Models\grupoTareas;
use App\Helpers\Validaciones;

class grupoController extends Controller {
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function index() {

        abort_if ( Gate::denies( 'grupo_index' ), 403 );

        $vctGrupos = grupo::select( 'grupo.*', )
        ->orderBy( 'created_at', 'desc' )->paginate( 15 );

        return view( 'grupos.indexGrupos', compact( 'vctGrupos' ) );
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function create() {

        abort_if ( Gate::denies( 'grupo_create' ), 403 );

        $vctGrupos = grupo::select( 'grupo.*', )
        ->orderBy( 'created_at', 'desc' )->paginate( 15 );

        return view( 'grupos.nuevoGrupo', compact( 'vctGrupos' ) );
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */

    public function store( Request $request ) {
        // dd( $request );

        abort_if ( Gate::denies( 'grupo_create' ), 403 );

        $request->validate( [
            'nombre' => 'required|max:250|unique:grupo,nombre,' . $request['nombre'],
            'comentario' => 'nullable|max:500',
        ], [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'nombre.unique' => 'El valor del campo nombre ya esta en uso.',
            'nombre.max' => 'El campo título excede el límite de caracteres permitidos.',
            'comentario.max' => 'El campo comentarios excede el límite de caracteres permitidos.',
        ] );
        $grupo = $request->all();

        $grupo = grupo::create( $grupo );
        Session::flash( 'message', 1 );
        return redirect()->route( 'grupo.edit', $grupo->id )->with('success','Grupo creado correctamente.');
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

        abort_if ( Gate::denies( 'grupo_edit' ), 403 );

        $grupo = grupo::where( 'id', '=', $id )->first();

        $tareas = grupoTareas::select( 'grupoTareas.*',
        DB::raw( 'grupo.nombre as grupo' ),
        DB::raw( 'tarea.nombre as tarea' ),
        DB::raw( 'tarea.comentario as comentario' ),
        )
        ->join( 'grupo', 'grupo.id', '=', 'grupoTareas.grupoId' )
        ->join( 'tarea', 'tarea.id', '=', 'grupoTareas.tareaId' )
        ->where( 'grupoId', '=', $id )->get();

        // dd($tareas);
        return view( 'grupos.editarGrupo', compact( 'grupo','tareas' ) );
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
        abort_if ( Gate::denies( 'grupo_edit' ), 403 );

        $objValida = new Validaciones();
        $request->validate( [
            'nombre' => 'required|max:250|unique:grupo,nombre,' . $request['id'] ,
            'comentario' => 'nullable|max:500',
        ], [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'nombre.unique' => 'El valor del campo nombre ya esta en uso.',
            'nombre.max' => 'El campo título excede el límite de caracteres permitidos.',
            'comentario.max' => 'El campo comentarios excede el límite de caracteres permitidos.',
        ] );

        $data = $request->all();

        $grupo = grupo::where( 'id', '=', $id )->first();

        if ( is_null( $grupo ) == false ) {
            $grupo->nombre = $request['nombre'];
            $grupo->comentario = $request['comentario'];
            $grupo->update();
            // dd( $data );

            //*** trabajamos con los items de piezas registradas y no registradas */
            $vctRegistrados = $objValida->preparaArreglo(grupoTareas::where('grupoId', '=', $grupo->id)->pluck('id')->toArray());
            $vctArreglo = $objValida->preparaArreglo($request['grupoTareaId']);

            // dd( $request, $data, "Registrados", $vctRegistrados, "Arreglo", $vctArreglo );

            //*** Preguntamos si existen registros en el arreglo */
            if (is_array($vctArreglo) && count($vctArreglo) > 0) {

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
                            grupoTareas::destroy($vctRegistrados[$i]);
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
                    $i < count($request['grupoTareaId']);
                    $i++
                ) {
                    if ($request['grupoTareaId'][$i] != '') {
                        //** Actualizacion de registro */
                        $objRecord =  grupoTareas::where('id', '=', $request['grupoTareaId'][$i])->first();

                        if ($objRecord && $objRecord->id > 0) {
                            $objRecord->grupoId  = $request['grupoId'][$i];
                            $objRecord->tareaId  =  $request['tareaId'][$i];
                            $objRecord->save();
                            // dd( 'Actualizando gasto de grupo' );
                        }
                    } else {

                        //** No existe en bd */
                        if ($request['grupoTareaId'][$i] == 0) {
                            $objRecord = new grupoTareas();
                            $objRecord->grupoId  = $request['grupoId'][$i];
                            $objRecord->tareaId  =  $request['tareaId'][$i];
                            $objRecord->save();
                            // dd( 'Guardando tarea de grupo' );
                        }
                    }
                }
            } else {
                //*** se deben de eliminar todos los registrados */
                if (is_array($vctRegistrados) && count($vctRegistrados) > 0) {
                    for (
                        $i = 0;
                        $i < count($vctRegistrados);
                        $i++
                    ) {
                        grupoTareas::destroy($vctRegistrados[$i]);
                        // dd( 'Borrando toda tarea de grupo' );
                    }
                }
            }

            Session::flash( 'message', 1 );
        }

        return redirect()->route( 'grupo.index' );

    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */

    public function destroy( $id ) {

        abort_if ( Gate::denies( 'grupo_destroy' ), 403 );
        try {
            $tarea =  grupo::where( 'id', '=', $id )->first();
            $tarea->delete();
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
