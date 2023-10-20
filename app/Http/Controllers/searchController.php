<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

use App\Models\maquinaria;
use App\Models\inventario;
use App\Models\tarea;
use App\Models\grupo;

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
        $term = $request->get('term');

        $maquinaria = maquinaria::select('maquinaria.*','marca.nombre as marca','maquinariaCategoria.nombre as categoria','maquinaria.compania')
        ->where('maquinaria.nombre', 'LIKE', '%' . $term . '%')
        ->leftjoin('marca','marca.id','maquinaria.marcaId')
        ->leftjoin('maquinariaCategoria','maquinariaCategoria.id','maquinaria.categoriaId')
            ->whereNull( 'compania' )
            ->orwhere('marca.nombre', 'LIKE', '%' . $term . '%')
            ->orwhere('maquinaria.nombre', 'LIKE', '%' . $term . '%')
            ->orwhere('maquinaria.placas', 'LIKE', '%' . $term . '%')
            ->orwhere('maquinaria.identificador', 'LIKE', '%' . $term . '%')
            ->orwhere('maquinariaCategoria.nombre', 'LIKE', '%' . $term . '%')
            ->get();

        $sugerencias = [];
        foreach ($maquinaria as $item) {
            if($item->compania == null && $item->estatusId == 1 ){
            $sugerencias[] = [
                'value' =>   ' Equipo ' . $item->identificador .' - ' .  $item->nombre . ', Marca ' . $item->marca . ', Modelo ' . $item->modelo  . ', NS ' .  $item->numserie . ', Placas ' .  $item->placas,
                'id' => $item->id,
                'nombre' => $item->nombre,
                'identificador' => $item->identificador,
                'marca' => $item->marca,
                'numserie' => $item->numserie,
                'placas' => $item->placas,
                'modelo' => $item->modelo,
                'categoria' => $item->categoria,
                'compania' => $item->compania,
            ];

            }
        }


        return $sugerencias;
        // return response()->json( $sugerencias );
    }

    public function equiposMTQ(Request $request)
    {
        //dd( $request );
        // $term = $request->input( 'term' );
        $term = $request->get('term');

        $maquinaria = Maquinaria::where('compania', 'mtq')
            ->where(function ($query) use ($term) {
                $query->where('nombre', 'LIKE', '%' . $term . '%')
                    ->orWhere('marca', 'LIKE', '%' . $term . '%')
                    ->orWhere('categoria', 'LIKE', '%' . $term . '%');
            })
            ->get();

        $sugerencias = [];
        foreach ($maquinaria as $item) {

            $sugerencias[] = [
                'value' =>  'Equipo ' . $item->nombre . ', Marca ' . $item->marcaId . ', Modelo ' . $item->modelo  . ', N.E. ' .  $item->identificador . ', Placas ' .  $item->placas,
                'id' => $item->id,
                'nombre' => $item->nombre,
                'marca' => $item->marcaId,
                'numserie' => $item->numserie,
                'placas' => $item->placas,
                'modelo' => $item->modelo,
                'identificador' => $item->identificador,
                'kilometraje' => $item->kilometraje,
                'compania' => $item->compania,
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
        $term = $request->get('term');

        $inventario = inventario::select('inventario.*', DB::raw('marca.nombre AS marca'))
            ->join('marca', 'marca.id', '=', 'inventario.marcaId')
            ->where('inventario.nombre', 'LIKE', '%' . $term . '%')
            ->whereIn('tipo', ['refacciones', 'consumibles', 'servicios'])
            ->orwhere('inventario.numparte', 'LIKE', '%' . $term . '%')
            ->orwhere('inventario.modelo', 'LIKE', '%' . $term . '%')
            ->orwhere('inventario.tipo', 'LIKE', '%' . $term . '%')
            ->orwhere('marca.nombre', 'LIKE', '%' . $term . '%')->get();

        $sugerencias = [];
        foreach ($inventario as $item) {
            $sugerencias[] = [
                'value' => 'Artículo: ' . $item->nombre . ', Número de parte: ' . $item->numparte . ', Modelo: ' . $item->modelo . ', PU: $ ' . $item->valor,
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

    /**
     * Busca material para el mantenimiento de equipos
     *
     * @param Request $request
     * @return void
     */

    public function tareasParaGrupos(Request $request)
    {
        //  dd( $request );
        // $term = $request->input( 'term' );
        $term = $request->get('term');

        $tareas = tarea::where('nombre', 'LIKE', '%' . $term . '%')
            ->orwhere('comentario', 'LIKE', '%' . $term . '%')->get();

        $sugerencias = [];
        foreach ($tareas as $item) {
            if( $item->activa ==1){
                $sugerencias[] = [
                    'value' => 'Tarea: ' . $item->nombre . ', ' . $item->comentario,
                    'id' => $item->id,
                'nombre' => $item->nombre,
                    'comentario' => $item->comentario,
                ];
            }
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

    public function gruposParaBitacoras(Request $request)
    {
        //  dd( $request );
        // $term = $request->input( 'term' );
        $term = $request->get('term');

        $grupos = grupo::where('nombre', 'LIKE', '%' . $term . '%')
            ->orwhere('comentario', 'LIKE', '%' . $term . '%')->get();

        $sugerencias = [];
        foreach ($grupos as $item) {
            if($item->activo == 1) {
                $sugerencias[] = [
                    'value' => 'Grupo de Tareas: ' . $item->nombre . ', ' . $item->comentario,
                    'id' => $item->id,
                    'nombre' => $item->nombre,
                    'comentario' => $item->comentario,
                ];
            }
        }

        return $sugerencias;
        // return response()->json( $sugerencias );
    }
}
