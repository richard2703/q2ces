<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\checkList;
use App\Models\bitacoras;
use App\Models\checkListRegistros;
use App\Models\grupoBitacoras;
use App\Models\grupoTareas;
use App\Models\grupo;
use App\Models\tarea;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class checkListController extends Controller {
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function index() {
        abort_if ( Gate::denies( 'checkList_index' ), 403 );

        $records = checkList::select(
            'checkList.*',
            DB::raw( 'maquinaria.nombre AS maquinaria' ),
            DB::raw( 'users.username AS usuario' ),
            DB::raw( 'bitacoras.nombre AS bitacora' )
        )
        ->join( 'maquinaria', 'maquinaria.id', '=', 'checkList.maquinariaId' )
        ->join( 'users', 'users.id', '=', 'checkList.usuarioId' )
        ->leftJoin( 'bitacoras', 'bitacoras.id', '=', 'checkList.bitacoraId' )
        ->orderBy( 'registrada', 'desc' )->paginate( 15 );

        // dd( $records );
        return view( 'checkList.checkList', compact( 'records' ) );
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
        //
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
            DB::raw( 'bitacoras.nombre AS bitacora' )
        )
        ->join( 'maquinaria', 'maquinaria.id', '=', 'checkList.maquinariaId' )
        ->join( 'users', 'users.id', '=', 'checkList.usuarioId' )
        ->leftJoin( 'bitacoras', 'bitacoras.id', '=', 'checkList.bitacoraId' )
        ->orderBy( 'registrada', 'desc' )
        ->where( 'checkList.id', '=', $id )->first();

        $records = checkListRegistros::select(
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
        return view( 'checkList.detalleCheckList', compact( 'checkList', 'records' ) );
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
