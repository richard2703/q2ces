<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\tareaTipo;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class tareaTipoController extends Controller {
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function index() {
        //
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

        abort_if ( Gate::denies( 'catalogos_create' ), 403 );

        // dd( $request );
        $request->validate( [
            'nombre' => 'required|max:250|unique:tareaTipo,nombre,' . $request[ 'nombre' ],
            'comentario' => 'nullable|max:500',
        ], [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'nombre.unique' => 'El valor del campo nombre ya esta en uso.',
            'nombre.max' => 'El campo título excede el límite de caracteres permitidos.',
            'comentario.max' => 'El campo comentarios excede el límite de caracteres permitidos.',
        ] );
        $record = $request->all();

        $tareaTipo = tareaTipo::create( $record );

        $fileNombre = 'imagenTipoTarea'.  str_pad( $tareaTipo->id, 2, '0', STR_PAD_LEFT );

        if ( $request->hasFile( 'imagen' ) ) {
            $tareaTipo->imagen =  $fileNombre . '_'. time() .'.' . $request->file( 'imagen' )->getClientOriginalExtension();

            $request->file( 'imagen' )->storeAs( '/public/interfaz/tareas/', $tareaTipo->imagen );
            $tareaTipo->save();
        }

        Session::flash( 'message', 1 );

        return redirect()->route( 'catalogoTiposTareas.index' );
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

        abort_if ( Gate::denies( 'catalogos_edit' ), 403 );

        // dd( $request );

        $request->validate( [
            'nombre' => 'required|max:250|unique:tareaTipo,nombre,' . $request[ 'controlId' ],
            'comentario' => 'nullable|max:500',
        ], [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'nombre.unique' => 'El valor del campo nombre ya esta en uso.',
            'nombre.max' => 'El campo título excede el límite de caracteres permitidos.',
            'comentario.max' => 'El campo comentarios excede el límite de caracteres permitidos.',
        ] );
        $data = $request->all();

        $record = tareaTipo::where( 'id', $data[ 'controlId' ] )->first();

        if ( is_null( $record ) == false ) {
            // dd( $data );
            $record->update( $data );

            $fileNombre = 'imagenTipoTarea'.  str_pad( $record->id, 2, '0', STR_PAD_LEFT );

            if ( $request->hasFile( 'ControlImagen' ) ) {
                $record->imagen =  $fileNombre . '_'. time() .'.' . $request->file( 'ControlImagen' )->getClientOriginalExtension();

                $request->file( 'ControlImagen' )->storeAs( '/public/interfaz/tareas/', $record->imagen );
                $record->save();
            }

            Session::flash( 'message', 1 );
        }

        return redirect()->route( 'catalogoTiposTareas.index' );
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */

    public function destroy( tareaTipo $tareaTipo ) {
        try {
            $tareaTipo->delete();
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
