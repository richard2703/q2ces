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
            'funcionalidad' => 'required',
            'fechaSolicitud' => 'required|date|date_format:Y-m-d',
            'descripcion' => 'nullable|max:500',
        ], [
            'title.required' => 'El campo nombre es obligatorio.',
            'title.max' => 'El campo título excede el límite de caracteres permitidos.',
            'fechaSolicitud' => 'El campo fecha del requerimiento es obligatoria.',
            'personalId.required' => 'El campo responsable es obligatorio.',
            'maquinariaId.required' => 'El campo maquinaria es obligatorio.',
            'funcionalidad.required' => 'El campo funcionalidad es obligatorio.',
            'descripcion.max' => 'El campo descripción excede el límite de caracteres permitidos.',
        ]);
        $solicitud = $request->all();
        $solicitud['start'] = strtoupper($solicitud['fechaSolicitud'] . ' ' . $solicitud['horaSolicitud']);
        $nuevaSolicitud = solicitudes::create($solicitud);

        $tipoCount = ($solicitud['tipo_solicitud'] == 'refaccion'
            ? $solicitud['refaccionNombre']
            : ($solicitud['tipo_solicitud'] == 'herramienta'
                ? $solicitud['herramientaNombre']
                : ($solicitud['tipo_solicitud'] == 'reparacion'
                    ? $solicitud['reparacionSolicitud']
                    : ($solicitud['tipo_solicitud'] == 'combustible'
                        ? $solicitud['carga']
                        : null
                    )
                )
            )
        );
        $tipoComentario = ($solicitud['tipo_solicitud'] == 'refaccion'
            ? $solicitud['comentarioRefaccion']
            : ($solicitud['tipo_solicitud'] == 'herramienta'
                ? $solicitud['comentarioHerramienta']
                : ($solicitud['tipo_solicitud'] == 'reparacion'
                    ? $solicitud['comentarioReparacion']
                    : ($solicitud['tipo_solicitud'] == 'combustible'
                        ? $solicitud['comentarioCombustible']
                        : null
                    )
                )
            )
        );
        $tipoCantidad = ($solicitud['tipo_solicitud'] == 'refaccion'
            ? $solicitud['cantidadRefaccion']
            : ($solicitud['tipo_solicitud'] == 'herramienta'
                ? $solicitud['cantidadHerramienta']
                : null
            )
        );



        for ($i = 0; $i < count($tipoCount); $i++) {
            $nuevaSolicitudDetalle = new solicitudDetalle();
            $nuevaSolicitudDetalle->solicitudId = $nuevaSolicitud->id;
            // $nuevaSolicitudDetalle->estadoId = $nuevaSolicitud->estadoId;
            $nuevaSolicitudDetalle->tipo = $solicitud['tipo_solicitud'];
            $nuevaSolicitudDetalle->cantidad = $tipoCantidad[$i] ?? '';
            $nuevaSolicitudDetalle->inventarioId = $solicitud['tipo_solicitud'] == 'herramienta' ? $solicitud['herramientaNombre'][$i] : ($solicitud['tipo_solicitud'] == 'refaccion' ? $solicitud['refaccionNombre'][$i] : null);
            $nuevaSolicitudDetalle->comentario = $tipoComentario[$i];
            $nuevaSolicitudDetalle->carga = $solicitud['carga'][$i] ?? '';
            $nuevaSolicitudDetalle->litros = $solicitud['litros'][$i] ?? '';
            $nuevaSolicitudDetalle->reparacion = $solicitud['reparacionSolicitud'][$i] ?? '';
            $nuevaSolicitudDetalle->save();
        }
        // dd($solicitud, $tipoComentario, $nuevaSolicitudDetalle);
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
        $eventoCalendario->prioridad = $solicitud['prioridad'];
        $eventoCalendario->tipoEvento = 'solicitud';
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
    public function update(Request $request)
    {
        abort_if(Gate::denies('calendarioMtq_edit'), 404);
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
        if ($data['maquinariaId'] === null) {
            unset($data['maquinariaId']);
        }
        if ($data['title'] === null) {
            unset($data['title']);
        }
        $calendarioPrincipal->update($data);
        // dd($data);
        $nuevaLista = collect();
        $tipoSolicitud = ($data['detalleTipo'][0] == 'refaccion'
            ? 'refaccion'
            : ($data['detalleTipo'][0] == 'herramienta'
                ? 'herramienta'
                : ($data['detalleTipo'][0] == 'reparacion'
                    ? 'reparacion'
                    : ($data['detalleTipo'][0] == 'combustible'
                        ? 'combustible'
                        : null
                    )
                )
            )
        );
        if ($tipoSolicitud == 'refaccion') {
            for ($i = 0; $i < count($data['idRefaccion']); $i++) {
                $array = [
                    'id' => $data['idRefaccion'][$i],
                    'inventarioId' => $data['refaccionNombre'][$i],
                    'cantidad' => $data['cantidadRefaccion'][$i],
                    'comentario' => $data['comentarioRefaccion'][$i],
                    'tipo' => $data['detalleTipo'][$i] != null ? $data['detalleTipo'][$i] : 'refaccion',
                    'solicitudId' => $data['solicitudIdDetalle'],
                ];
                $objRefaccion = solicitudDetalle::updateOrCreate(['id' => $array['id']], $array);
                $nuevaLista->push($objRefaccion->id);
            }
            $test = solicitudDetalle::where('solicitudId', $data['solicitudIdDetalle'])->whereNotIn('id', $nuevaLista)->delete();
        } else if ($tipoSolicitud == 'herramienta') {
            for ($i = 0; $i < count($data['idHerramienta']); $i++) {
                $array = [
                    'id' => $data['idHerramienta'][$i],
                    'inventarioId' => $data['herramientaNombre'][$i],
                    'cantidad' => $data['cantidadHerramienta'][$i],
                    'comentario' => $data['comentarioHerramienta'][$i],
                    'tipo' => $data['detalleTipo'][$i] != null ? $data['detalleTipo'][$i] : 'herramienta',
                    'solicitudId' => $data['solicitudIdDetalle'],
                ];
                $objHerramienta = solicitudDetalle::updateOrCreate(['id' => $array['id']], $array);
                $nuevaLista->push($objHerramienta->id);
            }
            $test = solicitudDetalle::where('solicitudId', $data['solicitudIdDetalle'])->whereNotIn('id', $nuevaLista)->delete();
        } else if ($tipoSolicitud == 'reparacion') {
            for ($i = 0; $i < count($data['idReparacion']); $i++) {
                $array = [
                    'id' => $data['idReparacion'][$i],
                    'reparacion' => $data['reparacionSolicitud'][$i],
                    'comentario' => $data['comentarioReparacion'][$i],
                    'tipo' => $data['detalleTipo'][$i] != null ? $data['detalleTipo'][$i] : 'reparacion',
                    'solicitudId' => $data['solicitudIdDetalle'],
                ];
                $objHerramienta = solicitudDetalle::updateOrCreate(['id' => $array['id']], $array);
                $nuevaLista->push($objHerramienta->id);
            }
            $test = solicitudDetalle::where('solicitudId', $data['solicitudIdDetalle'])->whereNotIn('id', $nuevaLista)->delete();
        } else {
            for ($i = 0; $i < count($data['idCombustible']); $i++) {
                $array = [
                    'id' => $data['idCombustible'][$i],
                    'litros' => $data['litros'][$i],
                    'carga' => $data['carga'][$i],
                    'comentario' => $data['comentarioCombustible'][$i],
                    'tipo' => $data['detalleTipo'][$i] != null ? $data['detalleTipo'][$i] : 'combustible',
                    'solicitudId' => $data['solicitudIdDetalle'],
                ];
                $objHerramienta = solicitudDetalle::updateOrCreate(['id' => $array['id']], $array);
                $nuevaLista->push($objHerramienta->id);
            }
            $test = solicitudDetalle::where('solicitudId', $data['solicitudIdDetalle'])->whereNotIn('id', $nuevaLista)->delete();
        }

        Session::flash('message', 1);

        return redirect()->route('calendarioPrincipal.index');
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
