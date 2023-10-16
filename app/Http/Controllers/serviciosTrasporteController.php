<?php

namespace App\Http\Controllers;

use App\Models\serviciosTrasporte;
use App\Http\Controllers\Controller;
use App\Models\cajaChica;
use App\Models\clientes;
use App\Models\comprobante;
use App\Models\conceptos;
use App\Models\conceptosServiciosTrasporte;
use App\Models\maquinaria;
use App\Models\obras;
use App\Models\personal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Carbon;


class serviciosTrasporteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd("serviciosTrasporte");
        abort_if(Gate::denies('cajachica_index'), 403);

        $registros = serviciosTrasporte::join('conceptos', 'serviciosTrasporte.conceptoId', 'conceptos.id')
            ->leftJoin('obras', 'serviciosTrasporte.obraId', 'obras.id')
            ->join('maquinaria', 'serviciosTrasporte.equipoId', 'maquinaria.id')
            ->join('personal', 'serviciosTrasporte.personalId', 'personal.id')
            ->select(
                'serviciosTrasporte.id',
                'serviciosTrasporte.fecha',
                'conceptos.nombre as cnombre',
                'obras.nombre as obra',
                'maquinaria.identificador',
                'maquinaria.nombre as maquinaria',
                'personal.nombres as pnombre',
                'personal.apellidoP as papellidoP',
                'cantidad',
                'serviciosTrasporte.estatus'
            )
            ->orderBy('fecha', 'desc')
            ->paginate(15);

        return view('serviciosTrasporte.indexServicios', compact('registros'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(Gate::denies('cajachica_create'), 403);

        $conceptos = conceptos::where('tipo', 2)->orderBy('codigo', 'asc')->get();
        $personal = personal::orderBy('nombres', 'asc')->where('estatusId', 1)->get();
        $obras = obras::orderBy('nombre', 'asc')->where('estatus', 1)->get();
        $maquinaria = maquinaria::where('compania', '!=', 'mtq')->orWhere('compania', null)->get();
        $vctComprobantes = comprobante::select()->orderBy('nombre', 'asc')->get();
        $vctClientes = clientes::select()->orderBy('nombre', 'asc')->get();
        return view('serviciosTrasporte.nuevoMovimientoServicio', compact('conceptos', 'personal', 'obras', 'maquinaria', 'vctComprobantes', 'vctClientes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        abort_if(Gate::denies('cajachica_create'), 403);

        $data = $request->all();
        $data['estatus'] = 1;

        serviciosTrasporte::create($data);

        return redirect()->action([serviciosTrasporteController::class, 'index']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\serviciosTrasporte  $serviciosTrasporte
     * @return \Illuminate\Http\Response
     */
    public function show(serviciosTrasporte $serviciosTrasporte)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\serviciosTrasporte  $serviciosTrasporte
     * @return \Illuminate\Http\Response
     */
    public function edit(serviciosTrasporte $serviciosTrasporte)
    {
        abort_if(Gate::denies('cajachica_create'), 403);

        $conceptos = conceptos::orderBy('codigo', 'asc')->get();
        $personal = personal::orderBy('nombres', 'asc')->where('estatusId', 1)->get();
        $obras = obras::orderBy('nombre', 'asc')->where('estatus', 1)->get();
        $maquinaria = maquinaria::where('compania', '!=', 'mtq')->orWhere('compania', null)->get();
        $vctClientes = clientes::select()->orderBy('nombre', 'asc')->get();
        // dd($serviciosTrasporte);
        return view('serviciosTrasporte.updateMovimientoServicio', compact('serviciosTrasporte', 'conceptos', 'personal', 'obras', 'maquinaria', 'vctClientes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\serviciosTrasporte  $serviciosTrasporte
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, serviciosTrasporte $serviciosTrasporte)
    {
        abort_if(Gate::denies('cajachica_create'), 403);

        $data = $request->all();
        $serviciosTrasporte->update($data);
        return redirect()->action([serviciosTrasporteController::class, 'index']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\serviciosTrasporte  $serviciosTrasporte
     * @return \Illuminate\Http\Response
     */
    public function destroy(serviciosTrasporte $serviciosTrasporte)
    {
        //
    }

    public function cajaChica(Request $request)
    {
        abort_if(Gate::denies('cajachica_create'), 403);
        $serviciosTrasporte = serviciosTrasporte::find($request->id);
        $serviciosTrasporte->cajaChica = 1;
        $serviciosTrasporte->save();

        $obra = obras::find($serviciosTrasporte->obraId);

        $data['dia'] = $serviciosTrasporte->fecha;
        $data['concepto'] = 1;
        $data['comprobanteId'] = 4;
        $data['ncomprobante'] = $serviciosTrasporte->id;
        $data['cliente'] = $obra->clienteId;
        $data['obra'] = $serviciosTrasporte->obraId;
        $data['equipo'] = $serviciosTrasporte->equipoId;
        $data['personal'] = $serviciosTrasporte->personalId;
        $data['tipo'] = 2;
        $data['cantidad'] = $serviciosTrasporte->cantidad;
        $data['servicioTrasporteId'] = $serviciosTrasporte->id;

        // $data['comentario'] = $serviciosTrasporte->id;

        cajaChica::create($data);

        return redirect()->action([serviciosTrasporteController::class, 'index']);
        dd('cajaChica');
    }
}
