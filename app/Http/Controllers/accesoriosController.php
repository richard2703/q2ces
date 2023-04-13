<?php

namespace App\Http\Controllers;

use App\Models\accesorios;
use App\Models\maquinaria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class accesoriosController extends Controller {
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function index() {
        $accesorios = accesorios::select( 'accesorios.*', db::raw( "CONCAT(maquinaria.identificador,' ',maquinaria.nombre) AS maquinaria" ), )
        ->join( 'maquinaria', 'maquinaria.id', '=', 'accesorios.maquinariaId' )
        ->paginate( 5 );
        return view( 'accesorios.indexAccesorios', compact( 'accesorios' ) );
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function create() {
        $vctMaquinaria = maquinaria::all();
        return view( 'accesorios.altaDeAccesorios', compact( 'vctMaquinaria' ) );
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */

    public function store( Request $request ) {
        // dd( 'test' );
        $request->validate( [
            'nombre' => 'required|max:250',
            'modelo' => 'nullable|max:200',
            'marca' => 'nullable|max:200',
            'serie' => 'nullable|max:200',
            'ano' => 'nullable|max:9999|numeric',
            'color' => 'nullable|max:200',
            'maquinariaId' => 'required',
        ], [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'nombre.max' => 'El campo nombre excede el límite de caracteres permitidos.',
            'modelo.max' => 'El campo modelo excede el límite de caracteres permitidos.',
            'marca.max' => 'El campo marca excede el límite de caracteres permitidos.',
            'ano.numeric' => 'El campo año debe ser numérico.',
            'ano.max' => 'El campo serie excede el límite de caracteres permitidos.',
            'ano.min' => 'El campo año requiere de al menos 4 caracteres.',
            'color.max' => 'El campo color excede el límite de caracteres permitidos.',
            'maquinariaId.required' => 'El campo maquinaría es obligatorio.',
        ] );
        $accesorio = $request->only(
            'nombre',
            'marca',
            'modelo',
            'color',
            'serie',
            'ano',
            'maquinariaId',
            'foto'
        );
        $accesorio[ 'serie' ] = strtoupper( $accesorio[ 'serie' ] );

        $accesorio = accesorios::create( $accesorio );

        /*** directorio contenedor de su información */
        $pathAccesorio = str_pad( $accesorio->id, 4, '0', STR_PAD_LEFT );

        if ( $request->hasFile( 'foto' ) ) {
            $accesorio->foto = time() . '_' . 'foto.' . $request->file( 'foto' )->getClientOriginalExtension();
            $request->file( 'foto' )->storeAs( '/public/maquinaria/accesorios/'. $pathAccesorio, $accesorio->foto );
            $accesorio->save();
        }

        Session::flash( 'message', 1 );
        return redirect()->route( 'accesorios.index' );
    }

    /**
    * Display the specified resource.
    *
    * @param  \App\Models\accesorios  $accesorios
    * @return \Illuminate\Http\Response
    */

    public function show( accesorios $accesorios ) {
        $vctMaquinaria = maquinaria::all();
        return view( 'accesorios.detalleAccesorios', compact( 'accesorios', 'vctMaquinaria' ) );
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Models\accesorios  $accesorios
    * @return \Illuminate\Http\Response
    */

    public function edit( accesorios $accesorios ) {
        $vctMaquinaria = maquinaria::all();
        return view( 'accesorios.detalleAccesorios', compact( 'accesorios', 'vctMaquinaria' ) );
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Models\accesorios  $accesorios
    * @return \Illuminate\Http\Response
    */

    public function update( Request $request, accesorios $accesorios ) {
        // dd( $accesorios );
        $request->validate( [
            'nombre' => 'required|max:250',
            'modelo' => 'nullable|max:200',
            'marca' => 'nullable|max:200',
            'serie' => 'nullable|max:200',
            'ano' => 'nullable|max:9999|numeric',
            'color' => 'nullable|max:200',
            'maquinariaId' => 'required',
        ], [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'nombre.max' => 'El campo nombre excede el límite de caracteres permitidos.',
            'modelo.max' => 'El campo modelo excede el límite de caracteres permitidos.',
            'marca.max' => 'El campo marca excede el límite de caracteres permitidos.',
            'ano.numeric' => 'El campo año debe ser numérico.',
            'ano.max' => 'El campo serie excede el límite de caracteres permitidos.',
            'ano.min' => 'El campo año requiere de al menos 4 caracteres.',
            'color.max' => 'El campo color excede el límite de caracteres permitidos.',
            'maquinariaId.required' => 'El campo maquinaría es obligatorio.',
        ] );
        $data = $request->only(
            'nombre',
            'marca',
            'modelo',
            'color',
            'serie',
            'ano',
            'foto',
            'maquinariaId'
        );

        $data[ 'serie' ] = strtoupper( $data[ 'serie' ] );
        /*** directorio contenedor de su información */
        $pathAccesorio = str_pad( $accesorios->id, 4, '0', STR_PAD_LEFT );

        if ( $request->hasFile( 'foto' ) ) {
            $data[ 'foto' ] = time() . '_' . 'foto.' . $request->file( 'foto' )->getClientOriginalExtension();
            $request->file( 'foto' )->storeAs( '/public/maquinaria/accesorios/'. $pathAccesorio, $data[ 'foto' ] );
        }

        $accesorios->update( $data );
        Session::flash( 'message', 1 );
        return redirect()->route( 'accesorios.index' );
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Models\accesorios  $accesorios
    * @return \Illuminate\Http\Response
    */

    public function destroy( accesorios $accesorios ) {
        return redirect()->back()->with( 'failed', 'No se puede eliminar' );
    }

    public function test( Request $request ) {
        dd( 'test' );
    }
}
