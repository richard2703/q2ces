<?php

namespace App\Http\Controllers;

use App\Models\usoMaquinarias;
use App\Http\Controllers\Controller;
use App\Models\maquinaria;
use App\Helpers\Calculos;
use App\Models\marca;
use App\Models\residente;
use App\Models\residenteAutos;
use App\Models\serviciosMtq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;


class usoMaquinariasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $marca = marca::all();
        $maquinaria = maquinaria::join('marca', 'marca.id', 'maquinaria.marcaId')
            // ->join('usoMaquinarias', 'usoMaquinarias.maquinariaId', 'maquinaria.id')
            ->select('maquinaria.*', 'maquinaria.nombre as nombre_maquinaria', 'marca.nombre as nombre_marca', 'marca.id as id_marca')
            ->where('compania', 'mtq')
            ->orderBy('identificador', 'asc')
            ->paginate(15);

        $servicios = serviciosMtq::all();

        // $maquinaria = usoMaquinarias::join('maquinaria', 'maquinaria.id', 'usoMaquinarias.maquinariaId')
        //     ->select('usoMaquinarias.id', 'restantes', 'maquinaria.mantenimiento', 'identificador', 'nombre', 'marcaId', 'modelo', 'placas', 'usoMaquinarias.uso', 'usoMaquinarias.created_at')
        //     ->where('compania', 'mtq')->orderBy('usoMaquinarias.created_at', 'desc')
        //     ->paginate(15);
        // $servicios = serviciosMtq::all();
        $userId = auth()->user()->id;
        $residente = residente::where('userId', $userId)->first();
        if ($residente) {
            $residenteAutos = residenteAutos::where('residenteId', '=', $residente['id'])->get();
        } else {
            $residenteAutos = null;
        }

        if ($residenteAutos !== null && !$residenteAutos->isEmpty()) {
            $autoIds = $residenteAutos->pluck('autoId')->toArray();
        }

        if (!empty($autoIds)) {
            $maquinariaAsignada = maquinaria::join('marca', 'marca.id', 'maquinaria.marcaId')
                ->select('maquinaria.*', 'maquinaria.nombre as nombre_maquinaria', 'marca.nombre as nombre_marca', 'marca.id as id_marca')
                ->where('maquinaria.compania', 'mtq')
                ->whereIn('maquinaria.id', $autoIds)
                ->orderBy('maquinaria.identificador', 'asc')
                ->get();
        } else {
            $maquinariaAsignada = null;
        }

        $vctUsos = usoMaquinarias::select('usoMaquinarias.*')
            ->selectRaw('max( usoMaquinarias.uso)  as usoMantenimiento')
            ->join('maquinaria', 'maquinaria.id', 'usoMaquinarias.maquinariaId')
            ->where('usoMaquinarias.proviene', '=', 'Mantenimiento')
            ->where('maquinaria.compania', 'mtq')
            ->groupBy('usoMaquinarias.maquinariaId')
            ->orderBy('usoMaquinarias.maquinariaId', 'asc')
            ->orderBy('usoMaquinarias.id', 'asc')
            ->get();
        // dd($residenteAutos);
        return view('MTQ.indexUsoMaquinariaMtq', compact('maquinaria', 'servicios', 'marca', 'maquinariaAsignada', 'residenteAutos', 'vctUsos'));
    }

    public function indexQ2ces()
    {
        $marca = marca::all();
        $maquinaria = maquinaria::join('marca', 'marca.id', 'maquinaria.marcaId')
            ->leftjoin('usoMaquinarias', 'usoMaquinarias.maquinariaId', 'maquinaria.id')
            ->leftJoin(
                DB::raw('(SELECT maquinariaId,tipoMantenimientoId, MAX(fechaReal) as ultima_fecha_mantenimiento 
            FROM mantenimientos 
            GROUP BY maquinariaId) as ultima_mantenimiento'),
                'ultima_mantenimiento.maquinariaId',
                '=',
                'maquinaria.id'
            )
            ->leftJoin('tipoMantenimiento', 'ultima_mantenimiento.tipoMantenimientoId', 'tipoMantenimiento.id')
            ->select(
                'maquinaria.identificador',
                'maquinaria.nombre as nombre_maquinaria',
                'maquinaria.modelo',
                'maquinaria.placas',
                'maquinaria.kilometraje',
                'maquinaria.mantenimiento',
                'marca.nombre as nombre_marca',
                'marca.id as id_marca',
                'ultima_mantenimiento.ultima_fecha_mantenimiento',
                'ultima_mantenimiento.tipoMantenimientoId',
                'tipoMantenimiento.nombre as tipoMantenimiento'

            )
            ->where('compania', null)
            // ->where('maquinaria.id', 1)
            ->groupBy('maquinaria.id')
            ->orderBy('identificador', 'asc')
            ->paginate(15);
        // ->get();
        // dd($maquinaria);

        // $vctUsos = usoMaquinarias::select('usoMaquinarias.*')
        //     ->selectRaw('max( usoMaquinarias.uso)  as usoMantenimiento')
        //     ->join('maquinaria', 'maquinaria.id', 'usoMaquinarias.maquinariaId')
        //     ->where('usoMaquinarias.proviene', '=', 'Mantenimiento')
        //     ->where('maquinaria.compania', null)
        //     ->groupBy('usoMaquinarias.maquinariaId')
        //     ->orderBy('usoMaquinarias.maquinariaId', 'asc')
        //     ->orderBy('usoMaquinarias.id', 'asc')
        //     ->get();


        // dd($vctUsos);

        $servicios = serviciosMtq::all();

        return view('maquinaria.indexUsoMaquinaria', compact('maquinaria', 'servicios', 'marca'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        // dd( 'create' )
        $maquinaria = maquinaria::join('marca', 'marca.id', 'maquinaria.marcaId')
            ->select('maquinaria.*', 'maquinaria.mantenimiento', 'identificador', 'maquinaria.nombre as nombre_maquinaria', 'marca.nombre as nombre_marca', 'marca.id as id_marca', 'modelo', 'placas')
            ->where('compania', 'mtq')
            ->orderBy('identificador', 'asc')
            ->get();
        // dd( $maquinaria );
        return view('MTQ.createUsoMaquinariaMtq', compact('maquinaria'));
    }

    public function createQ2ces()
    {
        // dd( 'create' )
        $maquinaria = maquinaria::join('marca', 'marca.id', 'maquinaria.marcaId')
            ->select('maquinaria.*', 'maquinaria.mantenimiento', 'identificador', 'maquinaria.nombre as nombre_maquinaria', 'marca.nombre as nombre_marca', 'marca.id as id_marca', 'modelo', 'placas')
            ->where('compania', null)
            ->orderBy('identificador', 'asc')
            ->get();
        // dd( $maquinaria );
        return view('maquinaria.createUsoMaquinaria', compact('maquinaria'));
    }
    // 'kilometraje' => null
    // 'kom' => null
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        // dd( $request );
        //*** para realizar los calculos */
        $objCalculos = new Calculos;
        $intUpdate = 0;
        $intSinDatos = 0;

        for ($i = 0; $i < count($request['id']); $i++) {
            if ($request['valor'][$i] != '' || $request['valor'][$i] != null) {

                // $proviene = 'Uso';
                if ($objCalculos->updateKilometrajeMaquinaria($request['id'][$i], $request['valor'][$i], $proviene = 'Uso') == true) {
                    $intUpdate += 1;
                }

                // $maquina  = maquinaria::find( $request[ 'id' ][ $i ] );
                // $objUso = new usoMaquinarias();
                // $objUso->maquinariaId  = $request[ 'id' ][ $i ];
                // // if ( $maquina->kilometraje == '' || $maquina->kilometraje == null ) {
                // //     $objUso->anterior = 0;
                // // } else {
                // //     $objUso->anterior  = $maquina->kilometraje;
                // // }
                // $objUso->uso = $request[ 'valor' ][ $i ];
                // $objUso->comentario = null;
                // // $objUso->foto = null;
                // $objUso->save();
                // $maquina->kilometraje = $request[ 'valor' ][ $i ];
                // $maquina->save();
            } else {
                $intSinDatos += 1;
            }
        }
        // dd( $request,  $intUpdate , $intSinDatos);
        Session::flash('message', 1);
        return redirect()->back();
        // return redirect()->action([usoMaquinariasController::class, 'index']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\usoMaquinarias  $usoMaquinarias
     * @return \Illuminate\Http\Response
     */

    public function show(usoMaquinarias $usoMaquinarias)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\usoMaquinarias  $usoMaquinarias
     * @return \Illuminate\Http\Response
     */

    public function edit(usoMaquinarias $usoMaquinarias)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\usoMaquinarias  $usoMaquinarias
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, usoMaquinarias $usoMaquinaria)
    {
        // dd( $usoMaquinaria, $request );
        $uso  = usoMaquinarias::find($request->id);
        $uso->uso = $request->valor;
        $uso->save();
        return redirect()->action([usoMaquinariasController::class, 'index']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\usoMaquinarias  $usoMaquinarias
     * @return \Illuminate\Http\Response
     */

    public function destroy(usoMaquinarias $usoMaquinarias)
    {
        //
    }

    public function mantenimiento(Request $request)
    {
        // dd($request);
        $uso  = maquinaria::find($request->mId);

        $uso->mantenimiento = $request->mantenimiento;
        $uso->save();
        // return redirect()->action([usoMaquinariasController::class, 'indexQ2ces']);
        return redirect()->back();
    }
}
