<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\proveedor;
use App\Models\proveedorCategoria;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class proveedorController extends Controller {
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function index() {
        abort_if ( Gate::denies( 'catalogos_index' ), 403 );

        $records = proveedor::select( 'proveedor.*', 'proveedorCategoria.nombre as categoria' )
        ->leftJoin( 'proveedorCategoria', 'proveedorCategoria.id', '=', 'proveedor.categoriaId' )
        ->orderBy( 'nombre', 'asc' )->paginate( 10 );
        $vctCategorias = proveedorCategoria::orderBy( 'nombre', 'asc' )->get();
        // dd( $puestos );
        return view( 'catalogos.proveedores', compact( 'records', 'vctCategorias' ) );
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
            'nombre' => 'required|max:250',
            'comentarios' => 'nullable|max:500',
        ], [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'nombre.max' => 'El campo título excede el límite de caracteres permitidos.',
            'comentarios.max' => 'El campo comentarios excede el límite de caracteres permitidos.',
        ] );
        $record = $request->all();

        proveedor::create( $record );
        Session::flash( 'message', 1 );

        return redirect()->route( 'catalogoProveedor.index' );
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

        abort_if(Gate::denies('catalogos_edit'), 403);

        // dd( $request );

        $request->validate([
            'nombre' => 'required|max:250',
            'comentarios' => 'nullable|max:500',
        ], [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'nombre.max' => 'El campo título excede el límite de caracteres permitidos.',
            'comentarios.max' => 'El campo comentarios excede el límite de caracteres permitidos.',
        ]);
        $data = $request->all();

        $record = proveedor::where('id', $data['controlId'])->first();

        if (is_null($record) == false) {
            // dd( $data );
            $record->update($data);
            Session::flash('message', 1);
        }

        return redirect()->route('catalogoProveedor.index');
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