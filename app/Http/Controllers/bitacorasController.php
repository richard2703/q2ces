<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;
use App\Models\bitacoras;
use App\Models\grupo;
use App\Models\maquinaria;
use App\Models\grupoBitacoras;
use App\Helpers\Validaciones;

class bitacorasController extends Controller {
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function index() {

        abort_if ( Gate::denies( 'bitacora_index' ), 403 );

        $vctBitacoras = bitacoras::select( 'bitacoras.*', )
        ->leftJoin('maquinaria', 'maquinaria.bitacoraId', '=', 'bitacoras.id')
        ->groupBy('maquinaria.bitacoraId')
        ->selectRaw('count(*) as total, maquinaria.bitacoraId')
        ->orderBy( 'created_at', 'desc' )->paginate( 15 );

        return view( 'bitacora.indexBitacora', compact( 'vctBitacoras' ) );
    }

    public function indexMaquinaria($id) {

        // dd($id);

        abort_if ( Gate::denies( 'bitacora_index' ), 403 );

        $records = maquinaria::select( 'maquinaria.*' )
        ->where('maquinaria.bitacoraId','=',$id)
        ->orderBy( 'created_at', 'desc' )->paginate( 15 );

        $bitacora = bitacoras::where('id','=',$id)->first();

        return view( 'bitacora.porMaquinaria', compact( 'records','bitacora' ) );
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function create() {

        abort_if ( Gate::denies( 'bitacora_create' ), 403 );

        $vctGrupos = grupo::select( 'grupo.*', )
        ->orderBy( 'created_at', 'desc' )->get();

        return view( 'bitacora.nuevoBitacora', compact( 'vctGrupos' ) );
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */

    public function store( Request $request ) {
        // dd( $request );

        abort_if ( Gate::denies( 'bitacora_create' ), 403 );

        $request->validate( [
            'nombre' => 'required|max:250',
            'comentario' => 'nullable|max:500',
        ], [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'nombre.max' => 'El campo título excede el límite de caracteres permitidos.',
            'comentario.max' => 'El campo comentarios excede el límite de caracteres permitidos.',
        ] );
        $bitacoras = $request->all();

        $bitacoras = bitacoras::create( $bitacoras );
        Session::flash( 'message', 1 );
        return redirect()->route( 'bitacoras.edit', $bitacoras->id )->with( 'success', 'Bitácora creada correctamente.' );
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

        abort_if ( Gate::denies( 'bitacora_edit' ), 403 );

        $bitacora = bitacoras::where( 'id', '=', $id )->first();

        $grupos = grupoBitacoras::select( 'grupoBitacoras.*',
        DB::raw( 'bitacoras.nombre as bitacora' ),
        DB::raw( 'grupo.nombre as grupo' ),
        DB::raw( 'grupo.comentario as comentario' ),
        )
        ->join( 'grupo', 'grupo.id', '=', 'grupoBitacoras.grupoId' )
        ->join( 'bitacoras', 'bitacoras.id', '=', 'grupoBitacoras.bitacoraId' )
        ->where( 'bitacoraId', '=', $id )->get();

        // dd($tareas);
        return view( 'bitacora.editarBitacora', compact( 'bitacora','grupos' ) );
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */

    public function update( Request $request, $id ) {

        // dd( $request );
        abort_if ( Gate::denies( 'bitacora_edit' ), 403 );

        $objValida = new Validaciones();
        $request->validate( [
            'nombre' => 'required|max:250',
            'comentario' => 'nullable|max:500',
        ], [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'nombre.max' => 'El campo título excede el límite de caracteres permitidos.',
            'comentario.max' => 'El campo comentarios excede el límite de caracteres permitidos.',
        ] );

        $data = $request->all();

        $bitacora = bitacoras::where( 'id', '=', $id )->first();

        if ( is_null( $bitacora ) == false ) {
            $bitacora->nombre = $request['nombre'];
            $bitacora->comentario = $request['comentario'];
            $bitacora->update();
            // dd( $data );

            //*** trabajamos con los items de piezas registradas y no registradas */
            $vctRegistrados = $objValida->preparaArreglo(grupoBitacoras::where('bitacoraId', '=', $bitacora->id)->pluck('id')->toArray());
            $vctArreglo = $objValida->preparaArreglo($request['grupoBitacoraId']);

            // dd( $request, $data, "Registrados", $vctRegistrados, "Arreglo", $vctArreglo );

            //*** Preguntamos si existen registros en el arreglo */
            if (is_array($vctArreglo) && count($vctArreglo) > 0) {

                //** buscamos si el registrado esta en el arreglo, de no ser asi se elimina */
                if (is_array($vctRegistrados) && count($vctRegistrados) > 0) {
                    for (
                        $i = 0;
                        $i < count($vctRegistrados);
                        $i++
                    ) {
                        $intValor = (int) $vctRegistrados[$i];

                        if (in_array($intValor, $vctArreglo) == false) {
                            /*** no existe y se debe de eliminar */
                            grupoBitacoras::destroy($vctRegistrados[$i]);
                            // dd( 'Borrando por que se quito la tarea del grupo' );
                        } else {
                            /*** existe el registro */
                            // dd( 'Sigue vivo en el arreglo' );
                        }
                    }
                }

                //*** trabajamos el resto */
                for (
                    $i = 0;
                    $i < count($request['grupoBitacoraId']);
                    $i++
                ) {
                    if ($request['grupoBitacoraId'][$i] != '') {
                        //** Actualizacion de registro */
                        $objRecord =  grupoBitacoras::where('id', '=', $request['grupoBitacoraId'][$i])->first();

                        if ($objRecord && $objRecord->id > 0) {
                            $objRecord->bitacoraId  = $request['bitacoraId'][$i];
                            $objRecord->grupoId  =  $request['grupoId'][$i];
                            $objRecord->save();
                            // dd( 'Actualizando gasto de grupo' );
                        }
                    } else {

                        //** No existe en bd */
                        if ($request['grupoBitacoraId'][$i] == 0) {
                            $objRecord = new grupoBitacoras();
                            $objRecord->bitacoraId  = $request['bitacoraId'][$i];
                            $objRecord->grupoId  =  $request['grupoId'][$i];
                            $objRecord->save();
                            // dd( 'Guardando tarea de grupo' );
                        }
                    }
                }
            } else {
                //*** se deben de eliminar todos los registrados */
                if (is_array($vctRegistrados) && count($vctRegistrados) > 0) {
                    for (
                        $i = 0;
                        $i < count($vctRegistrados);
                        $i++
                    ) {
                        grupoBitacoras::destroy($vctRegistrados[$i]);
                        // dd( 'Borrando toda tarea de grupo' );
                    }
                }
            }

            Session::flash( 'message', 1 );
        }

        return redirect()->route( 'bitacoras.index' );
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
