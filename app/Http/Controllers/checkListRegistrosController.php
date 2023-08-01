<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\checkList;
use App\Models\checkListRegistros;
use Illuminate\Http\Request;

class checkListRegistrosController extends Controller {
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
        $i = 0;

        //*** registramos primero el checlist */

        // $objCheckList =  new checkList();
        // $objCheckList->usuarioId = $request[ 'usuarioId' ];
        // $objCheckList->maquinariaId = $request[ 'maquinariaId' ];
        // $objCheckList->bitacoraId = $request[ 'bitacoraId' ];
        // $objCheckList->comentario = $request[ 'comentario' ];
        // $objCheckList->save();
        $objCheckList=2;

        // dd( $request, $objCheckList );

        foreach ( $request[ 'tareaId' ] as $value ) {

            $objRegistro = new checkListRegistros();
            $objRegistro->checkListId = $objCheckList ;
            $objRegistro->usuarioId = $request[ 'usuarioId' ][ $i ];
            $objRegistro->tareaId = $request[ 'tareaId' ][ $i ];
            $objRegistro->grupoId = $request[ 'grupoId' ][ $i ];
            $objRegistro->tarea = $request[ 'tarea' ][ $i ];
            $objRegistro->grupo = $request[ 'grupo' ][ $i ];
            $objRegistro->bitacoraId = $request[ 'bitacoraId' ][ $i ];
            $objRegistro->maquinariaId = $request[ 'maquinariaId' ];


            // $objRegistro->save();
            dd( $objRegistro );
            $i += 1;
        }
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
        //
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
