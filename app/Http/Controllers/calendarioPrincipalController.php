<?php

namespace App\Http\Controllers;

use App\Models\calendarioPrincipal;
use App\Http\Controllers\Controller;
use App\Models\inventario;
use App\Models\mantenimientos;
use App\Models\personal;
use App\Models\tipoMantenimiento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;

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
        $personal = personal::all();
        $tiposMantenimiento = tipoMantenimiento::all();
        $herramientas = inventario::where('tipo', 'herramientas')->get();
        $refacciones = inventario::where('tipo', 'refacciones')->get();
        $eventos = calendarioPrincipal::all();
        // $eventos = calendarioPrincipal::join('maquinaria', 'calendarioPrincipal.maquinariaId', '=', 'maquinaria.id')
        //     ->join('users', 'calendarioPrincipal.userId', '=', 'users.id')
        //     // ->join('serviciosMtq', 'serviciosMtq.id', 'calendarioPrincipal.mantenimientoId')
        //     ->select(
        //         'calendarioPrincipal.*',
        //         // 'calendarioPrincipal.id',
        //         // 'calendarioPrincipal.title',
        //         // 'calendarioPrincipal.mantenimientoId',
        //         // 'calendarioPrincipal.maquinariaId',
        //         // 'calendarioPrincipal.fecha',
        //         // 'calendarioPrincipal.descripcion',
        //         // 'calendarioPrincipal.estatus',
        //         // 'calendarioPrincipal.color',
        //         // 'calendarioPrincipal.start',
        //         // 'calendarioPrincipal.end',
        //         // 'maquinaria.nombre',
        //         // 'maquinaria.identificador as numeconomico',
        //         // 'maquinaria.placas',
        //         // 'maquinaria.marca',
        //         // 'serviciosMtq.nombre as nombreServicio'
        //         // 'maquinaria.id as idDoc'
        //     )
        //     ->get();

        $eventosJson = $eventos->toJson();
        // dd($eventos);
        return view('calendarioPrincipal/calendarioPrincipal', compact('eventosJson', 'tiposMantenimiento', 'personal', 'herramientas', 'refacciones'));
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
        $mantenimiento = $request->all();
        // dd($mantenimiento);
        $nuevoMantenimiento = mantenimientos::create($mantenimiento);
        // dd("NO");
        $eventoCalendario = new calendarioPrincipal();
        $eventoCalendario->mantenimientoId = $nuevoMantenimiento->id;
        $eventoCalendario->title = strtoupper($mantenimiento['placas'] . ' ' . $mantenimiento['nombre'] . ' ' . $mantenimiento['marca'] . ' ' . $mantenimiento['numeconomico'] . ' ' . $mantenimiento['descripcion']);
        $eventoCalendario->start = strtoupper($mantenimiento['fecha'] . ' ' . $mantenimiento['hora']);
        $eventoCalendario->userId = $mantenimiento['userId'];
        $eventoCalendario->maquinariaId = $mantenimiento['maquinariaId'];
        $eventoCalendario->personalId = $mantenimiento['personalId'];
        $eventoCalendario->tipoMantenimientoId = $mantenimiento['tipoMantenimientoId'];
        $eventoCalendario->estadoId = $mantenimiento['estadoId'];
        $eventoCalendario->descripcion = $mantenimiento['descripcion'];
        $eventoCalendario->estatus = $mantenimiento['tipo'];
        $eventoCalendario->color = $mantenimiento['color'];
        // dd($eventoCalendario);
        $eventoCalendario->save();

        Session::flash('message', 1);
        return redirect()->route('calendarioPrincipal.index');
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
