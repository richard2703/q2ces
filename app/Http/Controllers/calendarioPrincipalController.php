<?php

namespace App\Http\Controllers;

use App\Models\calendarioPrincipal;
use App\Http\Controllers\Controller;
use App\Models\tipoMantenimiento;
use Illuminate\Http\Request;

class calendarioPrincipalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd('HOLA');
        $tiposMantenimiento = tipoMantenimiento::all();
        $eventos = calendarioPrincipal::join('maquinaria', "maquinaria.id", "calendarioPrincipal.maquinariaId")
            ->join('serviciosMtq', 'serviciosMtq.id', 'calendarioPrincipal.mantenimientoId')
            ->select(
                'calendarioPrincipal.id',
                'calendarioPrincipal.title',
                'calendarioPrincipal.mantenimientoId',
                'calendarioPrincipal.maquinariaId',
                'calendarioPrincipal.fecha',
                'calendarioPrincipal.descripcion',
                'calendarioPrincipal.estatus',
                'calendarioPrincipal.color',
                'calendarioPrincipal.start',
                'calendarioPrincipal.end',
                'maquinaria.nombre',
                'maquinaria.identificador as numeconomico',
                'maquinaria.placas',
                'maquinaria.marca',
                'serviciosMtq.nombre as nombreServicio'
                // 'maquinaria.id as idDoc'
            )
            ->get();
        $eventosJson = $eventos->toJson();
        // dd($eventos);
        return view('calendarioPrincipal/calendarioPrincipal', compact('eventosJson', 'tiposMantenimiento'));
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
        dd('HOLA');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\calendarioPrincipal  $calendarioPrincipal
     * @return \Illuminate\Http\Response
     */
    public function show(calendarioPrincipal $calendarioPrincipal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\calendarioPrincipal  $calendarioPrincipal
     * @return \Illuminate\Http\Response
     */
    public function edit(calendarioPrincipal $calendarioPrincipal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\calendarioPrincipal  $calendarioPrincipal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, calendarioPrincipal $calendarioPrincipal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\calendarioPrincipal  $calendarioPrincipal
     * @return \Illuminate\Http\Response
     */
    public function destroy(calendarioPrincipal $calendarioPrincipal)
    {
        //
    }
}
