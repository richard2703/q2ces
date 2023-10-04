<?php

namespace App\Http\Controllers;

use App\Models\ubicaciones;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ubicacionesController extends Controller {
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function index() {
        abort_if ( Gate::denies( 'catalogos_index' ), '404' );
        $ubicaciones = ubicaciones::orderBy( 'created_at', 'desc' )->paginate( 10 );
        return view( 'catalogos.indexUbicaciones', compact( 'ubicaciones' ) );
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
        abort_if ( Gate::denies( 'catalogos_create' ), '404' );
        $request->validate( [
            'nombre' => 'required|max:250',
            'comentario' => 'nullable|max:500',
        ], [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'nombre.max' => 'El campo título excede el límite de caracteres permitidos.',
            'comentario.max' => 'El campo comentarios excede el límite de caracteres permitidos.',
        ] );

        $ubicaciones = $request->all();
        if ( ( isset( $request->check ) && $request->check == 'on' ) ) {
            $ubicaciones[ 'activo' ] = 1;
        } else {
            $ubicaciones[ 'activo' ] = 0;
        }
        // dd( $ubicaciones );
        ubicaciones::create( $ubicaciones );
        Session::flash( 'message', 1 );

        return redirect()->route( 'ubicaciones.index' );
    }

    /**
    * Display the specified resource.
    *
    * @param  \App\Models\ubicaciones  $ubicaciones
    * @return \Illuminate\Http\Response
    */

    public function show( ubicaciones $ubicaciones ) {
        //
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Models\ubicaciones  $ubicaciones
    * @return \Illuminate\Http\Response
    */

    public function edit( ubicaciones $ubicaciones ) {
        //
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Models\ubicaciones  $ubicaciones
    * @return \Illuminate\Http\Response
    */

    public function update( Request $request, ubicaciones $ubicaciones ) {
        abort_if ( Gate::denies( 'catalogos_edit' ), '404' );
        $request->validate( [
            'nombre' => 'required|max:250',
            'comentario' => 'nullable|max:500',
        ], [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'nombre.max' => 'El campo título excede el límite de caracteres permitidos.',
            'comentario.max' => 'El campo comentarios excede el límite de caracteres permitidos.',
        ] );
        $data = $request->all();

        $ubicaciones = ubicaciones::where( 'id', $data[ 'controlId' ] )->first();
        if ( ( isset( $request->check ) && $request->check == 'on' ) ) {
            $ubicaciones[ 'activo' ] = 1;
        } else {
            $ubicaciones[ 'activo' ] = 0;
        }
        if ( is_null( $ubicaciones ) == false ) {
            // dd( $data );
            $ubicaciones->update( $data );
            Session::flash( 'message', 1 );
        }

        return redirect()->route( 'ubicaciones.index' );
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Models\ubicaciones  $ubicaciones
    * @return \Illuminate\Http\Response
    */

    public function destroy( ubicaciones $ubicaciones ) {

        abort_if ( Gate::denies( 'catalogos_destroy' ), 403 );
        try {
            $ubicaciones->delete();
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

