<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\calendarioPrincipal;
use App\Models\eventoImportante;
use App\Models\eventosCalendarioTipos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;

class eventoImportanteController extends Controller
{
    public function store(Request $request)
    {
        $actividad = $request->all();
        // dd($actividad);
        $actividad['start'] = strtoupper($actividad['fechaEventoImportante'] . ' ' . $actividad['horaEventoImportante']);
        $actividad['end'] = strtoupper($actividad['fechaEventoImportanteEdit'] . ' ' . $actividad['horaEventoImportanteEdit']);
        $actividad['titulo'] = $actividad['title'];
        $actividad['comentario'] = $actividad['descripcion'];
        $nuevoactividad = eventoImportante::create($actividad);
        // dd("NO");
        $eventosCalendarioTipos = eventosCalendarioTipos::where('tipoEvento', 'EventoImportante')->first();
        $eventoCalendario = new calendarioPrincipal();
        $eventoCalendario->eventoImportanteId = $nuevoactividad->id;
        $eventoCalendario->title = $actividad['title'];
        $eventoCalendario->end = $actividad['end'];
        $eventoCalendario->start = strtoupper($actividad['fechaEventoImportante'] . ' ' . $actividad['horaEventoImportante']);
        $eventoCalendario->userId = $actividad['userId'];
        $eventoCalendario->descripcion = $actividad['descripcion'];
        $eventoCalendario->color = $eventosCalendarioTipos['color'];
        $eventoCalendario->estadoId = 1;
        $eventoCalendario->tipoEvento = 'EventoImportante';
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
    public function show(eventoImportante $actividades)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\actividades  $actividades
     * @return \Illuminate\Http\Response
     */
    public function edit(eventoImportante $actividades)
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
    public function update(Request $request, eventoImportante $eventosImportantes)
    {
        abort_if(Gate::denies('calendario_mtq_edit'), 404);
        $calendarioPrincipal = calendarioPrincipal::where('id', $request->id)->first();
        $data = $request->all();
        // dd($data, $calendarioPrincipal);
        if ($data['fecha'] != null && $data['hora'] != null) {
            $data['start'] = strtoupper($data['fecha'] . ' ' . $data['hora']);
        }
        if ($data['fechaSalida'] != null && $data['horaSalida'] != null) {
            $data['end'] = strtoupper($data['fechaSalida'] . ' ' . $data['horaSalida']);
        }
        if ($data['color'] === null) {
            unset($data['color']);
        }
        $calendarioPrincipal->update($data);

        $eventoImportante = eventoImportante::where('id', $calendarioPrincipal['eventoImportanteId'])->first();
        $eventoImportante['titulo'] = $calendarioPrincipal['title'];
        $eventoImportante['comentario'] = $calendarioPrincipal['descripcion'];
        $eventoImportante->update($data);

        Session::flash('message', 1);

        return redirect()->route('calendarioPrincipal.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\actividades  $actividades
     * @return \Illuminate\Http\Response
     */
    public function destroy(eventoImportante $eventosImportantes)
    {
        //
    }
}
