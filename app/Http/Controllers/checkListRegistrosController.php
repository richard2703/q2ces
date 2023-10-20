<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use App\Helpers\checkListPresentacion;

use App\Models\checkList;
use App\Models\checkListRegistros;
use App\Models\bitacoras;
use App\Models\grupoBitacoras;
use App\Models\grupoTareas;
use App\Models\grupo;
use App\Models\tarea;
use App\Models\maquinaria;
use App\Models\personal;
use App\Models\programacionCheckLists;

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
        $vctDebug =  array();
        $objTarea = new checkListPresentacion();

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

            $vctDebug[] = 'Validamos si la tareaId->' .   $request[ 'tareaId' ][ $i ] . ' tiene un resultado asociado' ;
            $vctDebug[] = 'Validamos si existe el valor para resultado'.$request[ 'tareaId' ][ $i ].'->resultado' . $request[ 'tareaId' ][ $i ]  ;

            if ( is_array( $request[ 'resultado' . $request[ 'tareaId' ][ $i ] ] ) == true ) {
                $vctDebug[] = 'Los valores->'. $request[ 'tareaId' ][ $i ];
            } else {

                $vctDebug[] = 'El valor->'. $request[ 'resultado' . $request[ 'tareaId' ][ $i ] ];
            }

            //*** existe el resultado */
            if ( $request[ 'resultado' . $request[ 'tareaId' ][ $i ] ] != null ) {

                $vctDebug[] =  'Entre';

                $objRegistro = new checkListRegistros();
                $objRegistro->checkListId =  $objCheckList->id ;
                $objRegistro->usuarioId = $request[ 'usuarioId' ];
                $objRegistro->tareaId = $request[ 'tareaId' ][ $i ];
                $objRegistro->grupoId = $request[ 'grupoId' ][ $i ];
                $objRegistro->tarea = $request[ 'tarea' ][ $i ];
                $objRegistro->grupo = $request[ 'grupo' ][ $i ];
                $objRegistro->bitacoraId = $request[ 'bitacoraId' ];
                $objRegistro->bitacora = $request[ 'bitacora' ];
                $objRegistro->maquinariaId = $request[ 'maquinariaId' ];
                $objRegistro->maquinaria = $request[ 'maquinaria' ];

                //*** el valor seleccionado */
                $objRegistro->valor =  ( int )$request[ 'resultado' . $request[ 'tareaId' ][ $i ] ][ 0 ]  ;

                if ( is_array( $request[ 'resultado' . $request[ 'tareaId' ][ $i ] ] ) == true ) {
                    //*** para el manejo de items de radio, select */
                    $objRegistro->resultado = $objTarea->etiquetaValor( $request[ 'resultado' . $request[ 'tareaId' ][ $i ] ][ 0 ], $request[ 'tareaId' ][ $i ] );
                } else {

                    $vctDebug[] =  'Control a trabajar: '. $request[ 'controlHtml' ][ $i ];

                    if ( $request[ 'controlHtml' ][ $i ] == 'select' ) {
                        $objRegistro->resultado = $objTarea->etiquetaValor( $request[ 'resultado' . $request[ 'tareaId' ][ $i ] ][ 0 ], $request[ 'tareaId' ][ $i ] );
                    } else {
                        $objRegistro->resultado = $request[ 'resultado' . $request[ 'tareaId' ][ $i ] ] ;
                    }
                }

                $objRegistro->save();
                $vctDebug[] =  'Lo Guarde';

                // dd( $request, $objCheckList, $objRegistro, $request[ 'resultado' . $iRes ][ 0 ] );
            } else {
                $vctDebug[] = 'NO existe el valor para resultado'.$request[ 'tareaId' ][ $i ].'->' . $request[ 'resultado' . $request[ 'tareaId' ][ $i ] ];
            }

            $iRes += 1;
        }

        //*** trabajamos la actualización del registro de programacion si existe */
        if ( ( ( int ) $request[ 'programacionId' ] > 0 ) ) {

            $objProg = programacionCheckLists::where( 'id', '=', $request[ 'programacionId' ] )->first();
            if ( $objProg ) {
                $objProg->estatus = 2;
                $objProg->checkListId = $objCheckList->id;
                $objProg->save();
            }
            return redirect()->route( 'checkList.pendientes' );

        } else {
            $objProg = new programacionCheckLists();

            $objPersonal = personal::where( 'userId', auth()->user()->id )->first();
            if ( $objPersonal ) {
                $objProg->personalId = $objPersonal->id;
                $objProg->maquinariaId = $request[ 'maquinariaId' ];
                $objProg->bitacoraId = $request[ 'bitacoraId' ];
                $objProg->estatus = 2;
                $objProg->checkListId = $objCheckList->id;
                $objProg->comentario = 'Ejecutado en directo';
                $objProg->fecha = date('Y-m-d');
                $objProg->save();
            }

        }
        // dd( $vctDebug, $request );

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
            DB::raw( "CONCAT(maquinaria.identificador,' - ',maquinaria.nombre) AS maquinaria" ),
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
            DB::raw( 'bitacoras.nombre AS bitacora' ),
            DB::raw( 'tipoValorTarea.controlHtml' )
        )
        ->join( 'maquinaria', 'maquinaria.id', '=', 'checkListRegistros.maquinariaId' )
        ->join( 'users', 'users.id', '=', 'checkListRegistros.usuarioId' )
        ->join( 'tarea', 'tarea.id', '=', 'checkListRegistros.tareaId' )
        ->join( 'tipoValorTarea', 'tipoValorTarea.id', '=', 'tarea.tipoValorId' )
        ->leftJoin( 'bitacoras', 'bitacoras.id', '=', 'checkListRegistros.bitacoraId' )
        ->orderBy( 'grupo', 'asc' )
        ->where( 'checkListRegistros.checkListId', '=', $id )->get();

        // dd( $vctRecords );
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
        $objTarea = new checkListPresentacion();
        $vctDebug = array();

        //*** actualizamos primero el checklist */
        $objCheckList = checkList::where( 'id', '=', $request[ 'checkListId' ] )->first();

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
                    //*** checamos el tipo de control */
                    if ( $request[ 'controlHtml' ][ $i ] == 'select' || $request[ 'controlHtml' ][ $i ] == 'radio' ) {
                        $vctDebug[] = $objRegistro->resultado = $objTarea->etiquetaValor( $request[ 'resultado' . $request[ 'tareaId' ][ $i ] ][ 0 ], $request[ 'tareaId' ][ $i ] );
                    } else {
                        $vctDebug[] = $objRegistro->resultado = $request[ 'resultado' . $request[ 'tareaId' ][ $i ] ] ;
                    }

                    $objRegistro->save();

                }

                $iRes += 1;
            }

            $blnExito = false;

        } else {
            $blnExito = false;
        }
        // dd( $vctDebug );
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

}
