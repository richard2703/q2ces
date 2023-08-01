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
        $iRes = 1;

        //*** registramos primero el checlist */
        $objCheckList =  new checkList();
        $objCheckList->usuarioId = $request[ 'usuarioId' ];
        $objCheckList->maquinariaId = $request[ 'maquinariaId' ];
        $objCheckList->bitacoraId = $request[ 'bitacoraId' ];
        $objCheckList->comentario = $request[ 'comentario' ];
        $objCheckList->registrada = date( 'Y-m-d H:i:s' );
        $objCheckList->save();

        // dd( $request, $objCheckList, count( $request[ 'tareaId' ] ) );

        for ( $i = 0; $i < count( $request[ 'tareaId' ] ) ;  $i++ ) {

            $objRegistro = new checkListRegistros();
            $objRegistro->checkListId = $objCheckList->id ;
            $objRegistro->usuarioId = $request[ 'usuarioId' ];
            $objRegistro->tareaId = $request[ 'tareaId' ][ $i ];
            $objRegistro->grupoId = $request[ 'grupoId' ][ $i ];
            $objRegistro->tarea = $request[ 'tarea' ][ $i ];
            $objRegistro->grupo = $request[ 'grupo' ][ $i ];
            $objRegistro->bitacoraId = $request[ 'bitacoraId' ];
            $objRegistro->bitacora = $request[ 'bitacora' ];
            $objRegistro->maquinariaId = $request[ 'maquinariaId' ];
            $objRegistro->maquinaria = $request[ 'maquinaria' ];

            $objRegistro->resultado = $request[ 'resultado' . $request[ 'tareaId' ][ $i ] ][ 0 ];

            $objRegistro->save();
            // dd( $request, $objCheckList, $objRegistro, $request[ 'resultado' . $iRes ][ 0 ] );

            $iRes += 1;
        }

        return redirect()->route( 'checkList.index' );

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
