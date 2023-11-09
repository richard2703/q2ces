<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use App\Models\manoDeObra;

class manoDeObraController extends Controller {
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
            'nombre' => 'required|max:250|unique:manoDeObra,nombre,' . $request[ 'nombre' ],
            'codigo' => 'required|max:8|unique:manoDeObra,nombre,' . $request[ 'nombre' ],
            'comentarios' => 'nullable|max:500',
        ], [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'nombre.unique' => 'El valor del campo nombre ya esta en uso.',
            'nombre.max' => 'El campo título excede el límite de caracteres permitidos.',
            'codigo.required' => 'El campo código es obligatorio.',
            'codigo.unique' => 'El valor del campo código ya esta en uso.',
            'codigo.max' => 'El campo código excede el límite de caracteres permitidos.',
            'comentarios.max' => 'El campo comentarios excede el límite de caracteres permitidos.',
        ] );
        $record = $request->all();

        $record[ 'codigo' ] = trim( strtoupper( $request[ 'codigo' ] ) );

        manoDeObra::create( $record );
        Session::flash( 'message', 1 );

        return redirect()->route( 'catalogoManoDeObra.index' );
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
            'nombre' => 'required|max:250|unique:manoDeObra,nombre,' . $request[ 'controlId' ],
            'codigo' => 'required|max:8|unique:manoDeObra,codigo,' . $request[ 'controlId' ],
            'comentario' => 'nullable|max:500',
        ], [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'codigo.required' => 'El campo código es obligatorio.',
            'nombre.unique' => 'El valor del campo nombre ya esta en uso.',
            'codigo.unique' => 'El valor del campo código ya esta en uso.',
            'nombre.max' => 'El campo nombre excede el límite de caracteres permitidos.',
            'codigo.max' => 'El campo código excede el límite de caracteres permitidos.',
            'comentario.max' => 'El campo comentarios excede el límite de caracteres permitidos.',
        ] );

        $data = $request->all();
        $data[ 'codigo' ] = trim( strtoupper( $request[ 'codigo' ] ) );

        $record = manoDeObra::where( 'id', $data[ 'controlId' ] )->first();

        if ( is_null( $record ) == false ) {
            // dd( $data );
            $record->update( $data );
            Session::flash( 'message', 1 );
        }

        return redirect()->route( 'catalogoManoDeObra.index' );
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */

    public function destroy( $id ) {
        //
    }
}
