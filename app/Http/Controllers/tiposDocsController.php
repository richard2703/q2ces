<?php

namespace App\Http\Controllers;

use App\Models\tiposDocs;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;

class tiposDocsController extends Controller {
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function index() {
        abort_if ( Gate::denies( 'catalogos_index' ), 403 );
        $tiposDocs = tiposDocs::orderBy( 'created_at', 'desc' )->paginate( 5 );
        return view( 'catalogos.tiposDocs.indexTiposDocs', compact( 'tiposDocs' ) );
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function create() {
        abort_if ( Gate::denies( 'catalogos_create' ), 403 );
        return view( 'catalogos.tiposDocs.createTiposDocs' );
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */

    public function store( Request $request ) {
        abort_if ( Gate::denies( 'catalogos_create' ), 403 );

        $tipoDocs = $request->all();
        $tipoDocs = tiposDocs::create( $tipoDocs );
        Session::flash( 'message', 1 );
        return redirect()->action( [ tiposDocsController::class, 'index' ] );
    }

    /**
    * Display the specified resource.
    *
    * @param  \App\Models\tiposDocs  $tiposDocs
    * @return \Illuminate\Http\Response
    */

    public function show( tiposDocs $tiposDocs ) {
        //
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Models\tiposDocs  $tiposDocs
    * @return \Illuminate\Http\Response
    */

    public function edit( tiposDocs $tiposDoc ) {
        abort_if ( Gate::denies( 'catalogos_edit' ), 403 );
        // dd( $tiposDoc );
        return view( 'catalogos.tiposDocs.editTiposDocs', compact( 'tiposDoc' ) );
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Models\tiposDocs  $tiposDocs
    * @return \Illuminate\Http\Response
    */

    public function update( Request $request, tiposDocs $tiposDoc ) {
        abort_if ( Gate::denies( 'catalogos_edit' ), 403 );
        $data = $request->all();
        // dd( $data );
        $tiposDoc->update( $data );
        Session::flash( 'message', 1 );
        return redirect()->action( [ tiposDocsController::class, 'index' ] );
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Models\tiposDocs  $tiposDocs
    * @return \Illuminate\Http\Response
    */

    public function destroy( tiposDocs $tiposDocs ) {

        abort_if ( Gate::denies( 'catalogos_destroy' ), 403 );
        try {
            $tiposDocs->delete();
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
