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

        // dd($request);
        $request->validate([
            'titulo' => 'required|max:250',
            'responsable' => 'required',
            'maquinariaId' => 'required',
            'prioridadId' => 'required',
            'estadoId' => 'required',
            'funcionalidadId' => 'required',
            'servicioId' => 'required',
            'fechaRequerimiento' => 'required|date|date_format:Y-m-d',
            'comentarios' => 'nullable|max:500',
        ], [
            'titulo.required' => 'El campo nombre es obligatorio.',
            'titulo.max' => 'El campo título excede el límite de caracteres permitidos.',
            'fechaRequerimiento' => 'El campo fecha del requerimiento es obligatoria.',
            'responsable.required' => 'El campo responsable es obligatorio.',
            'maquinariaId.required' => 'El campo maquinaria es obligatorio.',
            'estadoId.required' => 'El campo estado es obligatorio.',
            'funcionalidadId.required' => 'El campo funcionalidad es obligatorio.',
            'servicioId.required' => 'El campo servicio de reparación es obligatorio.',
            'comentarios.max' => 'El campo comentarios excede el límite de caracteres permitidos.',
        ]);
        $solicitud = $request->all();

        // dd( $tarea );
        $solicitud = solicitudes::create($solicitud);

        //*** validamos si agregamos herramientas */
        if ($request['herramientaId'] != "" && (int)$request['herramientaCantidad'] > 0) {
            $refaccion = new solicitudeslistas();
            $refaccion->inventarioId = $request['herramientaId'];
            $refaccion->solicitudId = $solicitud->id;
            $refaccion->cantidad = $request['herramientaCantidad'];
            $refaccion->save();
        }
        //*** validamos si agregamos refacciones */
        if ($request['refaccionId'] != "" && (int)$request['refaccionCantidad'] > 0) {
            $refaccion = new solicitudeslistas();
            $refaccion->inventarioId = $request['refaccionId'];
            $refaccion->solicitudId = $solicitud->id;
            $refaccion->cantidad = $request['refaccionCantidad'];
            $refaccion->save();
        }
        //*** validamos si agregamos consumibles */
        if ($request['consumibleId'] != "" && (int)$request['consumibleCantidad'] > 0) {
            $refaccion = new solicitudeslistas();
            $refaccion->inventarioId = $request['consumibleId'];
            $refaccion->solicitudId = $solicitud->id;
            $refaccion->cantidad = $request['consumibleCantidad'];
            $refaccion->save();
        }
        //*** validamos si agregamos combustible */
        if ($request['combustibleId'] != "" && (int)$request['combustibleCantidad'] > 0) {
            $refaccion = new solicitudeslistas();
            $refaccion->inventarioId = $request['combustibleId'];
            $refaccion->solicitudId = $solicitud->id;
            $refaccion->cantidad = $request['combustibleCantidad'];
            $refaccion->save();
        }

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
