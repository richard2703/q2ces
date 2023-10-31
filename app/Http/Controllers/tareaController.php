<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\grupo;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\tarea;
use App\Models\tareaCategoria;
use App\Models\tareaTipo;
use App\Models\tareaUbicacion;
use App\Models\tipoValorTarea;

class tareaController extends Controller {
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function index(Request $request) {

        abort_if ( Gate::denies( 'tarea_index' ), 403 );
        $estatus = $request->input('estatus', '0');

        $vctCategorias = tareaCategoria::all();
        $vctTipos = tareaTipo::all();
        $vctUbicaciones = tareaUbicacion::all();
        $vctTipoValor = tipoValorTarea::all();

        $vctTareas = tarea::select(
            'tarea.*',
            DB::raw( 'tareaCategoria.nombre AS categoria' ),
            DB::raw( 'tareaTipo.nombre AS tipo' ),
            DB::raw( 'tareaUbicacion.nombre AS ubicacion' ),
            DB::raw( 'tipoValorTarea.nombre AS tipoValor' ),
            DB::raw( 'tipoValorTarea.controlHtml AS controlHtml' ),
            DB::raw( 'grupo.nombre AS grupo' ),
        )
        ->join( 'grupoTareas', 'grupoTareas.tareaId', '=', 'tarea.id' )
        ->join( 'grupo', 'grupo.id', '=', 'grupoTareas.grupoId' )
        ->leftJoin( 'tareaCategoria', 'tareaCategoria.id', '=', 'tarea.categoriaId' )
        ->leftJoin( 'tareaTipo', 'tareaTipo.id', '=', 'tarea.tipoId' )
        ->leftJoin( 'tareaUbicacion', 'tareaUbicacion.id', '=', 'tarea.ubicacionId' )
        ->leftJoin( 'tipoValorTarea', 'tipoValorTarea.id', '=', 'tarea.tipoValorId' );

        if ($estatus !== '0') {
            $vctTareas = $vctTareas->where('grupo.id', $estatus);
        }

        $vctTareas = $vctTareas->orderBy( 'created_at', 'desc' )->paginate( 15 );


        $vctFilterGrupos = grupo::select('grupo.*')->orderBy('grupo.nombre','asc')->get();
        // dd($vctTareas);

        return view( 'tareas.tareas', compact( 'vctTareas', 'vctCategorias', 'vctTipos', 'vctUbicaciones', 'vctTipoValor','vctFilterGrupos' ) );
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function create() {

        abort_if ( Gate::denies( 'tarea_create' ), 403 );

        $vctCategorias = tareaCategoria::all();
        $vctTipos = tareaTipo::all();
        $vctUbicaciones = tareaUbicacion::all();
        $vctTipoValor = tipoValorTarea::all();

        return view( 'tareas.nuevaTarea', compact( 'vctCategorias', 'vctTipos', 'vctUbicaciones', 'vctTipoValor' ) );
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */

    public function store( Request $request ) {
        //     dd( $request );
        abort_if ( Gate::denies( 'tarea_create' ), 403 );

        $request->validate( [
            'nombre' => 'required|max:250|unique:tarea,nombre,' . $request[ 'nombre' ],
            'comentario' => 'nullable|max:500',
        ], [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'nombre.unique' => 'El valor del campo nombre ya esta en uso.',
            'nombre.max' => 'El campo título excede el límite de caracteres permitidos.',
            'comentario.max' => 'El campo comentarios excede el límite de caracteres permitidos.',
        ] );
        $tarea = $request->all();

        // dd( $tarea );
        tarea::create( $tarea );
        Session::flash( 'message', 1 );

        return redirect()->route( 'tarea.index' );
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

        abort_if ( Gate::denies( 'tarea_edit' ), 403 );

        $tarea =  tarea::where( 'id', '=', $id )->first();
        $vctCategorias = tareaCategoria::all();
        $vctTipos = tareaTipo::all();
        $vctUbicaciones = tareaUbicacion::all();
        $vctTipoValor = tipoValorTarea::all();

        // dd( $tarea );
        return view( 'tareas.editarTarea', compact( 'tarea',  'vctCategorias', 'vctTipos', 'vctUbicaciones', 'vctTipoValor' ) );
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */

    public function update( Request $request, $id ) {

        abort_if ( Gate::denies( 'tarea_edit' ), 403 );

        // dd( $request );

        $request->validate( [
            'nombre' => 'required|max:250|unique:tarea,nombre,' . $request[ 'tareaId' ],
            'comentario' => 'nullable|max:500',
        ], [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'nombre.unique' => 'El valor del campo nombre ya esta en uso.',
            'nombre.max' => 'El campo título excede el límite de caracteres permitidos.',
            'comentario.max' => 'El campo comentarios excede el límite de caracteres permitidos.',
        ] );

        $data = $request->all();

        $data[ 'requiereUnidadMedida' ] = ( $request[ 'requiereUnidadMedida' ] == 'on'?1:0 );
        $data[ 'requiereLimites' ] = ( $request[ 'requiereLimites' ] == 'on'?1:0 );
        $data[ 'requiereEscala' ] = ( $request[ 'requiereEscala' ] == 'on'?1:0 );
        $data[ 'requierePeriodo' ] = ( $request[ 'requierePeriodo' ] == 'on'?1:0 );

        $tarea = tarea::where( 'id', $data[ 'tareaId' ] )->first();

        if ( is_null( $tarea ) == false ) {
            // dd( $data );
            $tarea->update( $data );
            Session::flash( 'message', 1 );
        }

        return redirect()->route( 'tarea.index' );
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */

    public function destroy( $id ) {

        abort_if ( Gate::denies( 'tarea_destroy' ), 403 );
        try {
            $tarea =  tarea::where( 'id', '=', $id )->first();
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
