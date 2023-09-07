<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

use App\Models\checkList;
use App\Models\checkListRegistros;
use App\Models\bitacoras;
use App\Models\grupoBitacoras;
use App\Models\grupoTareas;
use App\Models\grupo;
use App\Models\tarea;
use App\Models\maquinaria;

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

        dd( $request );

        //*** registramos primero el checlist */
        $objCheckList =  new checkList();
        $objCheckList->usuarioId = $request[ 'usuarioId' ];
        $objCheckList->maquinariaId = $request[ 'maquinariaId' ];
        $objCheckList->bitacoraId = $request[ 'bitacoraId' ];
        $objCheckList->comentario = $request[ 'comentario' ];
        $objCheckList->registrada = date( 'Y-m-d H:i:s' );
        $objCheckList->save();

        for ( $i = 0; $i < count( $request[ 'tareaId' ] ) ;
        $i++ ) {

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

            $objRegistro->valor = $request[ 'resultado' . $request[ 'tareaId' ][ $i ] ][ 0 ] ;
            $objRegistro->resultado = $this->etiquetaValor( $request[ 'resultado' . $request[ 'tareaId' ][ $i ] ][ 0 ] );

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

        abort_if ( Gate::denies( 'checkList_show' ), 403 );

        $checkList = checkList::select(
            'checkList.*',
            DB::raw( 'maquinaria.nombre AS maquinaria' ),
            DB::raw( 'users.username AS usuario' ),
            DB::raw( 'bitacoras.nombre AS bitacora' ),
        )
        ->join( 'maquinaria', 'maquinaria.id', '=', 'checkList.maquinariaId' )
        ->join( 'users', 'users.id', '=', 'checkList.usuarioId' )
        ->leftJoin( 'bitacoras', 'bitacoras.id', '=', 'checkList.bitacoraId' )
        ->orderBy( 'registrada', 'desc' )
        ->where( 'checkList.id', '=', $id )->first();

        $vctRecords = checkListRegistros::select(
            'checkListRegistros.*',
            DB::raw( 'maquinaria.nombre AS maquinaria' ),
            DB::raw( 'users.username AS usuario' ),
            DB::raw( 'bitacoras.nombre AS bitacora' )
        )
        ->join( 'maquinaria', 'maquinaria.id', '=', 'checkListRegistros.maquinariaId' )
        ->join( 'users', 'users.id', '=', 'checkListRegistros.usuarioId' )
        ->leftJoin( 'bitacoras', 'bitacoras.id', '=', 'checkListRegistros.bitacoraId' )
        ->orderBy( 'grupo', 'asc' )
        ->where( 'checkListRegistros.checkListId', '=', $id )->get();

        // dd( $records );
        return view( 'checkList.editarCheckList', compact( 'checkList', 'vctRecords' ) );
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

    public function update( Request $request ) {

        $blnExito = false;

        //*** actualizamos primero el checklist */
        $objCheckList =    checkList::where( 'id', '=', $request[ 'checkListId' ] )->first();

        if ( $objCheckList ) {

            $objCheckList->usuarioId = $request[ 'usuarioId' ];
            $objCheckList->maquinariaId = $request[ 'maquinariaId' ];
            $objCheckList->bitacoraId = $request[ 'bitacoraId' ];
            $objCheckList->comentario = $request[ 'comentario' ];
            $objCheckList->registrada = date( 'Y-m-d H:i:s' );
            $objCheckList->save();

            // dd( $request );

            $i = 0;
            $iRes = 1;

            for ( $i = 0; $i < count( $request[ 'tareaId' ] ) ;
            $i++ ) {

                $objRegistro =   checkListRegistros::where( 'id', '=', $request[ 'recordId' ][ $i ] )->first();

                if ( $objRegistro ) {
                    //*** actualizamos solo el valor de la tarea y su etiqueta */
                    $objRegistro->valor = $request[ 'resultado' . $request[ 'tareaId' ][ $i ] ][ 0 ] ;
                    $objRegistro->resultado = $this->etiquetaValor( $request[ 'resultado' . $request[ 'tareaId' ][ $i ] ][ 0 ] );
                    $objRegistro->save();

                }

                $iRes += 1;
            }

            $blnExito = false;

        } else {
            $blnExito = false;
        }
        return redirect()->route( 'checkList.index' )->with( ( $blnExito == true?'success':'error' ), ( $blnExito == true?'Registro actualizado de forma correctamenta.':'No se pudo actualizar el registro' ) );
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

    public function etiquetaValor( $intValor ) {

        $strResultado = '';

        switch ( $intValor ) {
            case 0:
            $strResultado = 'Requiere Atención Inmediata';
            break;

            case 1:
            $strResultado = 'Requiere Atención Futura';
            break;

            case 2:
            $strResultado = 'Revisión Ok';
            break;

            default:
            $strResultado = 'No Definido';
            break;
        }
        return  $strResultado;
    }
}
