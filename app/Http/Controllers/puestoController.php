<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\puesto;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class puestoController extends Controller {
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function index() {
        abort_if ( Gate::denies( 'catalogos_index' ), 403 );

        $records = puesto::select( 'puestos.*', 'puestosNivel.nombre as puestoNivel' )
        ->leftJoin( 'puestoNivel', 'puestoNivel.id', '=', 'puestos.puestoNivelId' )
        ->orderBy( 'nombre', 'asc' )->paginate( 15 );

        return view( 'catalogo.indexPuestos', compact( 'puestos' ) );
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
            'nombre' => 'required|max:250|unique:puesto,nombre,' . $request[ 'nombre' ],
            'comentarios' => 'nullable|max:500',
        ], [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'nombre.unique' => 'El valor del campo nombre ya esta en uso.',
            'nombre.max' => 'El campo título excede el límite de caracteres permitidos.',
            'comentarios.max' => 'El campo comentarios excede el límite de caracteres permitidos.',
        ] );
        $record = $request->all();

        puesto::create( $record );
        Session::flash( 'message', 1 );

        return redirect()->route( 'catalogoPuestos.index' );
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

    public function update( Request $request, $id = null ) {
        abort_if ( Gate::denies( 'catalogos_edit' ), 403 );

        // dd( $request );

        $request->validate( [
            'nombre' => 'required|max:250|unique:puesto,nombre,' . $request[ 'puestoId' ],
            'comentarios' => 'nullable|max:500',
        ], [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'nombre.unique' => 'El valor del campo nombre ya esta en uso.',
            'nombre.max' => 'El campo título excede el límite de caracteres permitidos.',
            'comentarios.max' => 'El campo comentarios excede el límite de caracteres permitidos.',
        ] );
        $data = $request->all();

        $record = puesto::where( 'id', $data[ 'puestoId' ] )->first();

        if ( is_null( $record ) == false ) {
            // dd( $data );
            $record->update( $data );
            Session::flash( 'message', 1 );
        }

        return redirect()->route( 'catalogoPuestos.index' );
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */

    public function destroy( puesto $puesto ) {
        abort_if ( Gate::denies( 'catalogos_destroy' ), 403 );
        try {
            $puesto->delete();
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
