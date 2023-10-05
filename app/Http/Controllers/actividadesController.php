<?php

namespace App\Http\Controllers;

use App\Models\actividades;
use App\Http\Controllers\Controller;
use App\Models\calendarioPrincipal;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class actividadesController extends Controller
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
        $actividad = $request->all();
        // dd($actividad);
        $actividad['start'] = strtoupper($actividad['fechaTarea'] . ' ' . $actividad['horaTarea']);
        $nuevoactividad = actividades::create($actividad);
        // dd("NO");
        $eventoCalendario = new calendarioPrincipal();
        $eventoCalendario->actividadesId = $nuevoactividad->id;
        $eventoCalendario->title = $actividad['title'];
        $eventoCalendario->start = strtoupper($actividad['fechaTarea'] . ' ' . $actividad['horaTarea']);
        $eventoCalendario->userId = $actividad['userId'];
        $eventoCalendario->personalId = $actividad['personalId'];
        $eventoCalendario->estadoId = $actividad['estadoId'];
        $eventoCalendario->descripcion = $actividad['descripcion'];
        $eventoCalendario->estatus = $actividad['tipo'];
        $eventoCalendario->color = $actividad['color'];
        $eventoCalendario->prioridad = $actividad['prioridad'];
        $eventoCalendario->tipoEvento = 'actividades';
        // dd($eventoCalendario);
        $eventoCalendario->save();

        // $events = $request->all();
        // // dd('evento', $events);
        // $events['start'] = strtoupper($events['fechaTarea'] . ' ' . $events['horaTarea']);

        // $actividades = actividades::create($events);
        // dd($events);
        // $events = calendarioPrincipal::create($events);
        Session::flash('message', 1);
        return redirect()->route('calendarioPrincipal.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\actividades  $actividades
     * @return \Illuminate\Http\Response
     */
    public function show(actividades $actividades)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\actividades  $actividades
     * @return \Illuminate\Http\Response
     */
    public function edit(actividades $actividades)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\actividades  $actividades
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, actividades $actividades)
    {
        abort_if(Gate::denies('calendario_mtq_edit'), 404);
        $calendarioPrincipal = calendarioPrincipal::where('id', $request->id)->first();
        $data = $request->all();
        // dd($calendarioPrincipal, $data);
        $data['estadoId'] = 3;
        // dd($data);
        if ($data['fecha'] != null && $data['hora'] != null) {
            $data['start'] = strtoupper($data['fecha'] . ' ' . $data['hora']);
        }
        if ($data['fechaSalida'] != null && $data['horaSalida'] != null) {
            $data['end'] = strtoupper($data['fechaSalida'] . ' ' . $data['horaSalida']);
        }
        if ($data['color'] === null) {
            unset($data['color']);
        }
        if ($data['prioridad'] === null) {
            unset($data['prioridad']);
        }
        $calendarioPrincipal->update($data);

        Session::flash('message', 1);

        return redirect()->route('calendarioPrincipal.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\actividades  $actividades
     * @return \Illuminate\Http\Response
     */
    public function destroy(actividades $actividades)
    {
        //
    }
}
