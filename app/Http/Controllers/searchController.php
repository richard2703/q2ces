<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\maquinaria;
use App\Models\inventario;

class searchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    /**
     * Busca equipos de maquinaria
     *
     * @param Request $request
     * @return void
     */
    public function equipos(Request $request)
    {
         // dd( $request );
        // $term = $request->input( 'term' );
        $term = $request->get( 'term' );

        $maquinaria = maquinaria::where( 'nombre', 'LIKE', '%' . $term . '%' )
        ->orwhere( 'marca', 'LIKE', '%' . $term . '%' )
        ->orwhere( 'categoria', 'LIKE', '%' . $term . '%' )->get();

        $sugerencias = [];
        foreach ( $maquinaria as $item ) {
            $sugerencias[] = [
                'value' => $item->nombre . ' ' . $item->marca . ' ' . $item->modelo,
                'id' => $item->id,
                'nombre' => $item->nombre,
                'marca' => $item->marca,
                'numserie' => $item->numserie,
                'placas' => $item->placas,
                'modelo' => $item->modelo,
            ];
        }

        return $sugerencias;
        // return response()->json( $sugerencias );
    }

    /**
     * Busca material para el mantenimiento de equipos
     *
     * @param Request $request
     * @return void
     */
    public function materialMantenimiento(Request $request)
    {
         // dd( $request );
        // $term = $request->input( 'term' );
        $term = $request->get( 'term' );

        $inventario = inventario::where( 'nombre', 'LIKE', '%' . $term . '%' )
        ->orwhere( 'numparte', 'LIKE', '%' . $term . '%' )
        ->orwhere( 'modelo', 'LIKE', '%' . $term . '%' )
        ->orwhere( 'tipo', 'LIKE', '%' . $term . '%' )
        ->orwhere( 'marca', 'LIKE', '%' . $term . '%' )->get();

        $sugerencias = [];
        foreach ( $inventario as $item ) {
            $sugerencias[] = [
                'value' => $item->nombre . ' ' . $item->numparte . ' ' . $item->modelo,
                'id' => $item->id,
                'nombre' => $item->nombre,
                'valor' => $item->valor,
                'cantidad' => $item->cantidad,
                'marca' => $item->marca,
                'numparte' => $item->numparte,
                'tipo' => $item->tipo,
                'modelo' => $item->modelo,
            ];
        }

        return $sugerencias;
        // return response()->json( $sugerencias );
    }


}
