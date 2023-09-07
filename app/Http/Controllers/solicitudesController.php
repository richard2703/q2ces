<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\solicitudes;
use App\Models\solicitudeslistas;
use App\Models\inventario;
use App\Helpers\Validaciones;
use App\Helpers\Calculos;
use App\Models\calendarioPrincipal;
use App\Models\solicitudDetalle;
use Illuminate\Support\Facades\Gate;

class solicitudesController extends Controller
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
        abort_if(Gate::denies('calendario_index'), 403);

        $request->validate([
            'title' => 'required|max:250',
            'personalId' => 'required',
            'maquinariaId' => 'required',
            'prioridad' => 'required',
            'estadoId' => 'required',
            'funcionalidad' => 'required',
            'fechaSolicitud' => 'required|date|date_format:Y-m-d',
            'descripcion' => 'nullable|max:500',
        ], [
            'title.required' => 'El campo nombre es obligatorio.',
            'title.max' => 'El campo título excede el límite de caracteres permitidos.',
            'fechaSolicitud' => 'El campo fecha del requerimiento es obligatoria.',
            'personalId.required' => 'El campo responsable es obligatorio.',
            'maquinariaId.required' => 'El campo maquinaria es obligatorio.',
            'estadoId.required' => 'El campo estado es obligatorio.',
            'funcionalidad.required' => 'El campo funcionalidad es obligatorio.',
            'descripcion.max' => 'El campo descripción excede el límite de caracteres permitidos.',
        ]);
        $solicitud = $request->all();
        $solicitud['start'] = strtoupper($solicitud['fechaSolicitud'] . ' ' . $solicitud['horaSolicitud']);
        $nuevaSolicitud = solicitudes::create($solicitud);

        for ($i = 0; $i < count($solicitud['refaccionNombre']); $i++) {
            $nuevaSolicitudDetalle = new solicitudDetalle();
            $nuevaSolicitudDetalle->solicitudId = $nuevaSolicitud->id;
            $nuevaSolicitudDetalle->estadoId = $nuevaSolicitud->estadoId;
            $nuevaSolicitudDetalle->tipo = $solicitud['tipo_solicitud'];
            $nuevaSolicitudDetalle->cantidad = $solicitud['cantidadSolicitudRefaccion'][$i] ?? '';
            $nuevaSolicitudDetalle->inventarioId = $solicitud['tipo_solicitud'] == 'herramienta' ? $solicitud['herramientaNombre'][$i] : ($solicitud['tipo_solicitud'] == 'refaccion' ? $solicitud['refaccionNombre'][$i] : '');
            $nuevaSolicitudDetalle->comentario = $solicitud['comentarioRefaccion'][$i] ?? '';
            $nuevaSolicitudDetalle->carga = $solicitud['carga'][$i] ?? '';
            $nuevaSolicitudDetalle->litros = $solicitud['litrosSolicitud'][$i] ?? '';
            $nuevaSolicitudDetalle->reparacion = $solicitud['reparacionSolicitud'][$i] ?? '';
            $nuevaSolicitudDetalle->save();
        }
        $eventoCalendario = new calendarioPrincipal();
        $eventoCalendario->solicitudesId = $nuevaSolicitud->id;
        $eventoCalendario->title = $solicitud['title'];
        $eventoCalendario->start = $solicitud['start'];
        $eventoCalendario->userId = $solicitud['userId'];
        $eventoCalendario->personalId = $solicitud['personalId'];
        $eventoCalendario->estadoId = $solicitud['estadoId'];
        $eventoCalendario->maquinariaId = $solicitud['maquinariaId'];
        $eventoCalendario->descripcion = $solicitud['descripcion'];
        $eventoCalendario->estatus = $solicitud['tipo'];
        $eventoCalendario->color = $solicitud['color'];
        $eventoCalendario->save();
        // dd($solicitud, $i, $nuevaSolicitudDetalle);

        // dd("NO");
        // $eventoCalendario = new calendarioPrincipal();
        // $eventoCalendario->actividadesId = $nuevoactividad->id;
        // $eventoCalendario->title = $actividad['title'];
        // $eventoCalendario->start = strtoupper($actividad['fechaTarea'] . ' ' . $actividad['horaTarea']);
        // $eventoCalendario->userId = $actividad['userId'];
        // $eventoCalendario->personalId = $actividad['personalId'];
        // $eventoCalendario->estadoId = $actividad['estadoId'];
        // $eventoCalendario->descripcion = $actividad['descripcion'];
        // $eventoCalendario->estatus = $actividad['tipo'];
        // $eventoCalendario->color = $actividad['color'];
        // // dd($eventoCalendario);
        // $eventoCalendario->save();
        // dd($solicitud);
        //*** validamos si agregamos herramientas */
        //  if ($request['herramientaId'] != "" && (int)$request['herramientaCantidad'] > 0) {
        //     $refaccion = new solicitudeslistas();
        //     $refaccion->inventarioId = $request['herramientaId'];
        //     $refaccion->solicitudId = $solicitud->id;
        //     $refaccion->cantidad = $request['herramientaCantidad'];
        //     $refaccion->save();
        // }
        // //*** validamos si agregamos refacciones */
        // if ($request['refaccionId'] != "" && (int)$request['refaccionCantidad'] > 0) {
        //     $refaccion = new solicitudeslistas();
        //     $refaccion->inventarioId = $request['refaccionId'];
        //     $refaccion->solicitudId = $solicitud->id;
        //     $refaccion->cantidad = $request['refaccionCantidad'];
        //     $refaccion->save();
        // }
        // //*** validamos si agregamos consumibles */
        // if ($request['consumibleId'] != "" && (int)$request['consumibleCantidad'] > 0) {
        //     $refaccion = new solicitudeslistas();
        //     $refaccion->inventarioId = $request['consumibleId'];
        //     $refaccion->solicitudId = $solicitud->id;
        //     $refaccion->cantidad = $request['consumibleCantidad'];
        //     $refaccion->save();
        // }
        // //*** validamos si agregamos combustible */
        // if ($request['combustibleId'] != "" && (int)$request['combustibleCantidad'] > 0) {
        //     $refaccion = new solicitudeslistas();
        //     $refaccion->inventarioId = $request['combustibleId'];
        //     $refaccion->solicitudId = $solicitud->id;
        //     $refaccion->cantidad = $request['combustibleCantidad'];
        //     $refaccion->save();
        // }
        Session::flash('message', 1);
        return redirect()->route('calendarioPrincipal.index');
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
        dd('Actualizar');
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
}
