<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\proveedor;
use App\Models\proveedorCategoria;
use App\Models\proveedorContactos;
use Illuminate\Database\QueryException;
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

        return view( 'catalogos.proveedores', compact( 'records', 'vctCategorias' ) );
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function create() {

        abort_if ( Gate::denies( 'catalogos_create' ), 403 );
        $vctCategorias = proveedorCategoria::orderBy( 'nombre', 'asc' )->get();
        return view( 'catalogos.proveedorAlta', compact( 'vctCategorias' ) );
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

        $newProveedor =  proveedor::create( $record );

        $newProveedor->categorias()->sync( $request->input( 'categoria', [] ) );

        $pathObra = str_pad( $newProveedor->id, 4, '0', STR_PAD_LEFT );

        if ( $request->hasFile( 'logo' ) ) {
            $newProveedor->logo = time() . '_' . 'logo.' . $request->file( 'logo' )->getClientOriginalExtension();
            $request->file( 'logo' )->storeAs( '/public/proveedores/' . $pathObra, $newProveedor->logo );
            $newProveedor->save();
        }

        if ( $request->hasFile( 'fiscal' ) ) {
            $newProveedor->fiscal = time() . '_' . 'fiscal.' . $request->file( 'fiscal' )->getClientOriginalExtension();
            $request->file( 'fiscal' )->storeAs( '/public/proveedores/' . $pathObra, $newProveedor->fiscal );
            $newProveedor->save();
        }

        /*** registro de residentes */
        for ( $i = 0; $i < count( $request[ 'rNombre' ] );
        $i++ ) {
            //*** se guarda solo si se selecciono una máquina */
            if ( $request[ 'rNombre' ][ $i ] != '' || $request[ 'rNombre' ][ $i ] != null ) {
                $objResidente = new proveedorContactos();
                $objResidente->proveedorId  = $newProveedor->id;
                $objResidente->nombre  = $request[ 'rNombre' ][ $i ];
                $objResidente->telefono = $request[ 'rTelefono' ][ $i ];
                $objResidente->email = $request[ 'rEmail' ][ $i ];
                $objResidente->save();
            }
        }

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
        dd( 'Hola desde Show()' );
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */

    public function edit( proveedor $proveedor ) {

        abort_if ( Gate::denies( 'catalogos_edit' ), 403 );
        // $residentes = residente::where( 'clienteId', $cliente->id )->get();
        // dd( $residentes );
        $categorias = proveedorCategoria::orderBy( 'nombre', 'asc' )->get();
        $proveedor->load( 'categorias' );
        $contactos = proveedorContactos::orderBy( 'nombre', 'asc' )->get();
        return view( 'catalogos.proveedorEdit', compact( 'proveedor', 'categorias', 'contactos' ) );
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */

    public function update( Request $request, proveedor $proveedor ) {

        abort_if ( Gate::denies( 'catalogos_edit' ), 403 );

        // dd( $request->all() );

        $request->validate( [
            'nombre' => 'required|max:250',
            'comentarios' => 'nullable|max:500',
        ], [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'nombre.max' => 'El campo título excede el límite de caracteres permitidos.',
            'comentarios.max' => 'El campo comentarios excede el límite de caracteres permitidos.',
        ] );
        $data = $request->all();

        $record = proveedor::where( 'id', $proveedor->id )->first();

        /*** directorio contenedor de su información */
        $pathObra = str_pad( $record->id, 4, '0', STR_PAD_LEFT );

        if ( $request->hasFile( 'logo' ) ) {
            $data[ 'logo' ] = time() . '_' . 'logo.' . $request->file( 'logo' )->getClientOriginalExtension();
            $request->file( 'logo' )->storeAs( '/public/proveedores/' . $pathObra, $data[ 'logo' ] );
        }

        if ( $request->hasFile( 'fiscal' ) ) {
            $data[ 'fiscal' ] = time() . '_' . 'fiscal.' . $request->file( 'fiscal' )->getClientOriginalExtension();
            $request->file( 'fiscal' )->storeAs( '/public/proveedores/' . $pathObra, $data[ 'fiscal' ] );
        }

        if ( is_null( $record ) == false ) {
            // dd( $data );
            $record->update( $data );
            $record->categorias()->sync( $request->input( 'categoria', [] ) );
            Session::flash( 'message', 1 );
        }

        $nuevaLista = collect();

        for ( $i = 0; $i < count( $request[ 'rNombre' ] );
        $i++ ) {
            if ( $request[ 'rNombre' ][ $i ] != '' || $request[ 'rNombre' ][ $i ] != null ) {
                $array = [
                    'id' => $request[ 'idContacto' ][ $i ],
                    'nombre' => $request[ 'rNombre' ][ $i ],
                    'telefono' => $request[ 'rTelefono' ][ $i ],
                    'email' => $request[ 'rEmail' ][ $i ],
                    'proveedorId' => $record->id,
                ];
                $objContacto = proveedorContactos::updateOrCreate( [ 'id' => $array[ 'id' ] ], $array );
                $nuevaLista->push( $objContacto->id );
            }
        }
        proveedorContactos::where( 'proveedorId', $record->id )->whereNotIn( 'id', $nuevaLista )->delete();

        return redirect()->route( 'catalogoProveedor.index' );
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */

    public function destroy( proveedor $proveedor ) {
        abort_if ( Gate::denies( 'catalogos_destroy' ), 403 );
        try {
            $proveedor->delete();
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

    public function download( $id, $doc ) {
        $book = proveedor::where( 'id', $id )->firstOrFail();

        /*** directorio contenedor de su información */
        $pathFile = str_pad( $book->id, 4, '0', STR_PAD_LEFT );

        if ( empty( $book ) === false ) {
            $pathToFile = storage_path( 'app/public/proveedores/' . $pathFile .'/'. $book->fiscal );
            // dd( $pathToFile, $id, $doc );
            if ( file_exists( $pathToFile ) === true &&  is_file( $pathToFile ) === true ) {
                // return response()->download( $pathToFile );
                return response()->file( $pathToFile );
            } else {
                return redirect( '404' );
            }
        }
    }
}
