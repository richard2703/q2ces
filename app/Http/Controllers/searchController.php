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
use App\Models\inventarioMtq;
use App\Models\manoDeObra;

use function PHPUnit\Framework\isNull;

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

         $maquinaria = maquinaria::select('maquinaria.*', 'marca.nombre as marca', 'maquinariaCategoria.nombre as categoria', 'maquinaria.compania')
             ->where('maquinaria.nombre', 'LIKE', '%' . $term . '%')
             ->leftjoin('marca', 'marca.id', 'maquinaria.marcaId')
             ->leftjoin('maquinariaCategoria', 'maquinariaCategoria.id', 'maquinaria.categoriaId')
             ->whereNull('compania')
             ->orwhere('marca.nombre', 'LIKE', '%' . $term . '%')
             ->orwhere('maquinaria.nombre', 'LIKE', '%' . $term . '%')
             ->orwhere('maquinaria.placas', 'LIKE', '%' . $term . '%')
             ->orwhere('maquinaria.identificador', 'LIKE', '%' . $term . '%')
             ->orwhere('maquinariaCategoria.nombre', 'LIKE', '%' . $term . '%')
             ->get();

         $sugerencias = [];
         foreach ($maquinaria as $item) {
             if ($item->compania == null) {
                 $sugerencias[] = [
                     'value' =>   ' Equipo ' . $item->identificador . ' - ' .  $item->nombre . ', Marca ' . $item->marca . ', Modelo ' . $item->modelo  . ', NS ' .  $item->numserie . ', Placas ' .  $item->placas . ', Uso ' . $item->kilometraje . ' '. $item->kom ,
                     'id' => $item->id,
                     'nombre' => $item->nombre,
                     'identificador' => $item->identificador,
                     'marca' => $item->marca,
                     'numserie' => $item->numserie,
                     'placas' => $item->placas,
                     'modelo' => $item->modelo,
                     'categoria' => $item->categoria,
                     'compania' => $item->compania,
                     'kom' => $item->kom,
                     'kilometraje' => $item->kilometraje,
                 ];
             }
         }


         return $sugerencias;
         // return response()->json( $sugerencias );
     }

    /**
     * Busca equipos de maquinaria para el Calendario
     *
     * @param Request $request
     * @return void
     */

    public function equiposCalendario(Request $request)
    {
        // dd( $request );
        // $term = $request->input( 'term' );
        $term = $request->get('term');

        $maquinaria = maquinaria::select('maquinaria.*', 'marca.nombre as marca','marca.id as marcaId', 'maquinariaCategoria.nombre as categoria', 'maquinaria.compania')
            ->where('maquinaria.nombre', 'LIKE', '%' . $term . '%')
            ->leftjoin('marca', 'marca.id', 'maquinaria.marcaId')
            ->leftjoin('maquinariaCategoria', 'maquinariaCategoria.id', 'maquinaria.categoriaId')
            ->whereNull('compania')
            ->orwhere('marca.nombre', 'LIKE', '%' . $term . '%')
            ->orwhere('maquinaria.nombre', 'LIKE', '%' . $term . '%')
            ->orwhere('maquinaria.placas', 'LIKE', '%' . $term . '%')
            ->orwhere('maquinaria.identificador', 'LIKE', '%' . $term . '%')
            ->orwhere('maquinariaCategoria.nombre', 'LIKE', '%' . $term . '%')
            ->get();

        $sugerencias = [];
        foreach ($maquinaria as $item) {
            if ($item->compania == null) {
                $sugerencias[] = [
                    'value' =>   ' Equipo ' . $item->identificador . ' - ' .  $item->nombre . ', Marca ' . $item->marca . ', Modelo ' . $item->modelo  . ', NS ' .  $item->numserie . ', Placas ' .  $item->placas,
                    'id' => $item->id,
                    'nombre' => $item->nombre,
                    'identificador' => $item->identificador,
                    'marca' => $item->marcaId,
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

    public function inventario(Request $request)
    {
        $term = $request->get('term');
        $tipo = $request->input('tipo');

        $inventario = inventario::select('inventario.*', 'marca.nombre as marca')
            ->where(function ($query) use ($tipo) {
                if ($tipo) {
                    $query->where('inventario.tipo', '=', $tipo);
                }
            })
            ->where(function ($query) use ($term) {
                $query->where('inventario.nombre', 'LIKE', '%' . $term . '%')
                    ->orWhere('inventario.numparte', 'LIKE', '%' . $term . '%')
                    ->orWhere('inventario.modelo', 'LIKE', '%' . $term . '%')
                    ->orWhere('marca.nombre', 'LIKE', '%' . $term . '%');
            })
            ->leftjoin('marca', 'marca.id', 'inventario.marcaId')
            ->get();

        $sugerencias = [];
        foreach ($inventario as $item) {
            if ($item->compania == null) {
                $sugerencias[] = [
                    'value' =>   ' N.PARTE: ' . $item->numparte . ' - ' .  $item->nombre . ', Marca: ' . $item->marca . ', Modelo: ' . $item->modelo  . ', Cantidad: ' .  $item->cantidad,
                    'id' => $item->id,
                    'nombre' => $item->nombre,
                    'numparte' => $item->numparte,
                    'marca' => $item->marca,
                    'tipo' => $item->tipo,
                    // 'numserie' => $item->numserie,
                    // 'placas' => $item->placas,
                    'modelo' => $item->modelo,
                    'cantidad' => $item->cantidad,
                    // 'categoria' => $item->categoria,
                    // 'compania' => $item->compania,
                ];
            }
        }

        return $sugerencias;
        // return response()->json( $sugerencias );
    }

    public function inventarioMtq(Request $request)
    {
        $term = $request->get('term');
        $tipo = $request->input('tipo');

        $inventarioMtq = inventarioMtq::select('inventarioMtq.*', 'marca.nombre as marca')
            ->where(function ($query) use ($tipo) {
                if ($tipo) {
                    $query->where('inventarioMtq.tipo', '=', $tipo);
                }
            })
            ->where(function ($query) use ($term) {
                $query->where('inventarioMtq.nombre', 'LIKE', '%' . $term . '%')
                    ->orWhere('inventarioMtq.numparte', 'LIKE', '%' . $term . '%')
                    ->orWhere('inventarioMtq.modelo', 'LIKE', '%' . $term . '%')
                    ->orWhere('marca.nombre', 'LIKE', '%' . $term . '%');
            })
            ->leftjoin('marca', 'marca.id', 'inventarioMtq.marcaId')
            ->get();


        $sugerencias = [];
        foreach ($inventarioMtq as $item) {
            if ($item->compania == null) {
                $sugerencias[] = [
                    'value' =>   ' N.PARTE: ' . $item->numparte . ' - ' .  $item->nombre . ', Marca: ' . $item->marca . ', Modelo: ' . $item->modelo  . ', Cantidad: ' .  $item->cantidad,
                    'id' => $item->id,
                    'nombre' => $item->nombre,
                    'numparte' => $item->numparte,
                    'marca' => $item->marca,
                    'tipo' => $item->tipo,
                    // 'numserie' => $item->numserie,
                    // 'placas' => $item->placas,
                    'modelo' => $item->modelo,
                    'cantidad' => $item->cantidad,
                    // 'categoria' => $item->categoria,
                    // 'compania' => $item->compania,
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
                    ->where('estatusId', '1')
                    ->orWhere('marca', 'LIKE', '%' . $term . '%')
                    ->orWhere('categoria', 'LIKE', '%' . $term . '%');
            })
            ->get();

        $sugerencias = [];
        foreach ($maquinaria as $item) {

            $sugerencias[] = [
                'value' =>  'Equipo ' . $item->nombre . ', Marca ' . $item->marcaId . ', Modelo ' . $item->modelo  . ', N.E. ' .  $item->identificador . ', Placas ' .  $item->placas . ', Uso ' . $item->kilometraje . ' '. $item->kom ,
                'id' => $item->id,
                'nombre' => $item->nombre,
                'marca' => $item->marcaId,
                'numserie' => $item->numserie,
                'placas' => $item->placas,
                'modelo' => $item->modelo,
                'identificador' => $item->identificador,
                'kilometraje' => $item->kilometraje,
                'compania' => $item->compania,
                'kom' => $item->kom,
            ];
        }

        return $sugerencias;
        // return response()->json( $sugerencias );
    }

    public function equiposQ2ces(Request $request)
    {
        //dd( $request );
        // $term = $request->input( 'term' );
        $term = $request->get('term');

        $maquinaria = Maquinaria::where('compania', null)
            ->where(function ($query) use ($term) {
                $query->where('nombre', 'LIKE', '%' . $term . '%')
                    ->where('estatusId', '1')
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
        // dd($request);
        // $term = $request->input( 'term' );
        $filter = $request->input('filter');
        $term = $request->get('term');

        if (is_null($filter) == true) {

            $inventario = inventario::select('inventario.*', DB::raw('marca.nombre AS marca'))
                ->join('marca', 'marca.id', '=', 'inventario.marcaId')
                ->where('inventario.nombre', 'LIKE', '%' . $term . '%')
                ->whereIn('inventario.tipo', ['refacciones', 'consumibles', 'servicios', 'herramientas'])
                ->orwhere('inventario.numparte', 'LIKE', '%' . $term . '%')
                ->orwhere('inventario.modelo', 'LIKE', '%' . $term . '%')
                ->orwhere('inventario.tipo', 'LIKE', '%' . $term . '%')
                ->orwhere('marca.nombre', 'LIKE', '%' . $term . '%')
                ->orderBy('inventario.nombre', 'Asc')
                ->get();
        } else {
            $inventario = inventario::select(
                'inventario.*',
                DB::raw('marca.nombre AS marca'),
                DB::raw("CONCAT(inventario.nombre,' ', inventario.numparte,' ',inventario.modelo,' ',marca.nombre)as buscando"),
            )
                ->join('marca', 'marca.id', '=', 'inventario.marcaId')
                ->where('inventario.tipo', '=', $filter)
                ->where(DB::raw("CONCAT(inventario.nombre,' ', inventario.numparte,' ',inventario.modelo,' ',marca.nombre)"), 'LIKE', '%' . $term . '%')
                ->orderBy('inventario.nombre', 'Asc')
                ->get();
        }


        $sugerencias = [];
        foreach ($inventario as $item) {
            $sugerencias[] = [
                'value' =>   $item->nombre . ', Marca: ' . $item->marca . ', Modelo: ' . $item->modelo  . ', PU: $ ' . $item->valor. " [ Stock ". $item->cantidad . " ]",
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

    public function manoDeObra(Request $request)
    {
        // dd($request);
        // $term = $request->input( 'term' );
        $term = $request->get('term');

        $inventario = manoDeObra::select('manoDeObra.*')
            ->where('manoDeObra.nombre', 'LIKE', '%' . $term . '%')
            ->orwhere('manoDeObra.codigo', 'LIKE', '%' . $term . '%')
            ->orwhere('manoDeObra.comentario', 'LIKE', '%' . $term . '%')
            ->orderBy('nombre', 'asc')->get();

        $sugerencias = [];
        foreach ($inventario as $item) {
            $sugerencias[] = [
                'value' =>  $item->nombre . ', Código: ' . $item->codigo . ', PU: $ ' . $item->costo,
                'id' => $item->id,
                'nombre' => $item->nombre,
                'valor' => $item->costo,
                'cantidad' => 1,
                'marca' => 'N/A',
                'numparte' => $item->codigo,
                'tipo' => 'mano de obra',
                'modelo' => 'N/A',
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
            ->where('activa', '1')
            ->orwhere('comentario', 'LIKE', '%' . $term . '%')->get();

        $sugerencias = [];
        foreach ($tareas as $item) {
            $sugerencias[] = [
                'value' => 'Tarea: ' . $item->nombre . ', ' . $item->comentario,
                'id' => $item->id,
                'nombre' => $item->nombre,
                'comentario' => $item->comentario,
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

    public function gruposParaBitacoras(Request $request)
    {
        //  dd( $request );
        // $term = $request->input( 'term' );
        $term = $request->get('term');

        $grupos = grupo::where('nombre', 'LIKE', '%' . $term . '%')
            ->where('activo', '1')
            ->orwhere('comentario', 'LIKE', '%' . $term . '%')->get();

        $sugerencias = [];
        foreach ($grupos as $item) {
            $sugerencias[] = [
                'value' => 'Grupo de Tareas: ' . $item->nombre . ', ' . $item->comentario,
                'id' => $item->id,
                'nombre' => $item->nombre,
                'comentario' => $item->comentario,
            ];
        }

        return $sugerencias;
        // return response()->json( $sugerencias );
    }
}
