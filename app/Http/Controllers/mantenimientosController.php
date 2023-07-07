<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Helpers\Validaciones;
use App\Helpers\Calculos;
use App\Models\mantenimientos;
use App\Models\maquinaria;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;

class mantenimientosController extends Controller {
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function index() {

        abort_if ( Gate::denies( 'mantenimiento_index' ), '404' );

        //** mantenimientos del mes seleccionado */
        $vctMantenimientos = mantenimientos::select(
            'mantenimientos.*',
            DB::raw( 'estados.nombre AS estado' ),
            DB::raw( 'maquinaria.nombre AS maquinaria' ),
            DB::raw( 'maquinaria.identificador AS maquinariaCodigo' )
        )
        ->join( 'estados', 'estados.id', '=', 'mantenimientos.estadoId' )
        ->join( 'maquinaria', 'maquinaria.id', '=', 'mantenimientos.maquinariaId' )
        // ->where( 'mantenimientos.fechaInicio', '>=', $dteMesInicio )

        // ->where( 'mantenimientos.fechaInicio', '<=', $dteMesFin )
        ->orderBy( 'estados.id', 'asc' )
        ->orderBy( 'mantenimientos.fechaInicio', 'desc' )->paginate( 10 );

        return view( 'mantenimientos.mantenimientos', compact( 'vctMantenimientos' ) );

    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function create() {
        abort_if ( Gate::denies( 'mantenimiento_create' ), '404' );

        return view( 'mantenimientos.nuevoMantenimiento' );
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */

    public function store( Request $request ) {
        abort_if ( Gate::denies( 'mantenimiento_create' ), '404' );

        // dd( $request );
        $request->validate( [
            'titulo' => 'required|max:250',
            'maquinariaId' => 'required',
            'tipo' => 'required',
            'comentario' => 'required|max:500',
            'fechaInicio' => 'required|date|date_format:Y-m-d',

        ], [
            'titulo.required' => 'El campo nombre es obligatorio.',
            'tipo.required' => 'El campo tipo de mantenimiento es obligatorio.',
            'maquinariaId.required' => 'El campo maquinaria es obligatorio.',
            'titulo.max' => 'El campo título excede el límite de caracteres permitidos.',
            'comentario.max' => 'El campo comentarios excede el límite de caracteres permitidos.',
            'fechaInicio' => 'El campo de fecha de inicio del mantenimiento es obligatorio',
            'fechaInicio.date_format' => 'El campo fecha de nacimiento tiene un formato inválido.',
        ] );
        $mantenimiento = $request->all();

        // dd( $mantenimiento );

        mantenimientos::create( $mantenimiento );
        Session::flash( 'message', 1 );

        return redirect()->route( 'mantenimientos.index' );
    }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */

    public function show( $id ) {

        dd( 'Todas las tareas...' );
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */

    public function edit( $id ) {
        abort_if ( Gate::denies( 'mantenimiento_edit' ), '404' );

        return view( 'mantenimientos.editarMantenimiento' );
        dd( 'Todas las tareas...' );
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */

    public function update( Request $request ) {
        abort_if ( Gate::denies( 'mantenimiento_edit' ), '404' );

        //  dd( $request );
        $request->validate( [
            'manttoTitulo' => 'required|max:250',
            'manttoComentario' => 'nullable|max:500',
        ], [
            'manttoTitulo.required' => 'El campo nombre es obligatorio.',
            'manttoTitulo.max' => 'El campo título excede el límite de caracteres permitidos.',
            'manttoComentario.max' => 'El campo comentarios excede el límite de caracteres permitidos.',
        ] );

        $data = $request->all();

        $mantto = mantenimientos::where( 'id', $data[ 'manttoId' ] )->first();

        if ( is_null( $mantto ) == false ) {

            $data[ 'titulo' ] =  $data[ 'manttoTitulo' ];
            $data[ 'comentario' ] =  $data[ 'manttoComentario' ];
            $data[ 'tipo' ] =  $data[ 'manttoTipoId' ];

            // $data[ 'prioridadId' ] =  $data[ 'manttoPrioridadId' ] ;

            //*** manejo del estatus de la tarea cuando se cambia su estatus inicial*/
            // if ( $mantto->estadoId <= 1 && $mantto->fechaReal == '0000-00-00' ) {
            //     if ( $data[ 'manttoEstadoId' ] > 1 ) {
            //         $data[ 'fechaReal' ] =  date( 'Y-m-d' ) ;
            //     }
            // }
            //*** manejo del estatus de la tarea cuando se cambia su estatus final*/
            if ( $data[ 'manttoEstadoId' ] == 3 ) {
                $data[ 'fechaReal' ] =  date( 'Y-m-d' );
            }

            $data[ 'estadoId' ] =  $data[ 'manttoEstadoId' ];

            // dd( $data );
            $mantto->update( $data );
            Session::flash( 'message', 1 );
        }

        return redirect()->route( 'calendario.index' );
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */

    public function destroy( $id ) {
        abort_if ( Gate::denies( 'mantenimiento_destroy' ), '404' );
        //
    }

}
