<?php

namespace App\Http\Controllers;

use App\Models\serviciosTrasporte;
use App\Http\Controllers\Controller;
use App\Models\clientes;
use App\Models\comprobante;
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

        // SEMANA ACTUAL
        // if (Carbon::parse(now())->locale('es')->isoFormat('dddd') == 'lunes') {
        //     $lunes = now();
        //     // dd(Carbon::parse($pLunes)->locale('es')->isoFormat('dddd'));
        // } else {
        //     $lunes = new Carbon('last monday');
        // }
        // if (Carbon::parse(now())->locale('es')->isoFormat('dddd') == 'domingo') {
        //     $domingo = now();
        //     // dd(Carbon::parse($pLunes)->locale('es')->isoFormat('dddd'));
        // } else {
        //     $domingo = new Carbon('next sunday');
        // }

        // // SEMANA PASADA
        // $Adomingo = $domingo->clone()->subDay(7);
        // $Alunes = $lunes->clone()->subDay(7);

        // $ultimoCorte = corteCajaChica::where('inicio', $Alunes)->first();

        // $registros = serviciosTrasporte::join('personal', 'serviciosTrasporte.personalId', 'personal.id')
        //     ->leftJoin('obras', 'serviciosTrasporte.obra', 'obras.id')
        //     ->join('maquinaria', 'serviciosTrasporte.equipo', 'maquinaria.id')
        //     ->join('conceptos', 'serviciosTrasporte.concepto', 'conceptos.id')
        //     ->join('comprobante', 'serviciosTrasporte.comprobanteId', 'comprobante.id')
        //     ->select(
        //         'serviciosTrasporte.id',
        //         'dia',
        //         'conceptos.codigo',
        //         'conceptos.nombre as cnombre',
        //         'comprobanteId',
        //         'comprobante.nombre as comprobante',
        //         'ncomprobante',
        //         'personal.nombres as pnombre',
        //         'personal.apellidoP as papellidoP',
        //         'cliente',
        //         'obras.nombre as obra',
        //         'maquinaria.identificador',
        //         'maquinaria.nombre as maquinaria',
        //         'cantidad',
        //         'serviciosTrasporte.tipo',
        //         'serviciosTrasporte.total'
        //     )->orderby('dia', 'desc')->orderby('id', 'desc')
        //     ->whereBetween('dia', [$lunes, $domingo])
        //     ->paginate(15);

        $registros = serviciosTrasporte::join('conceptosServiciosTrasporte', 'serviciosTrasporte.conceptoServicioTrasporteId', 'conceptosServiciosTrasporte.id')
            ->leftJoin('obras', 'serviciosTrasporte.obraId', 'obras.id')
            ->join('maquinaria', 'serviciosTrasporte.equipoId', 'maquinaria.id')
            ->join('personal', 'serviciosTrasporte.personalId', 'personal.id')
            ->select(
                'serviciosTrasporte.id',
                'serviciosTrasporte.fecha',
                'conceptosServiciosTrasporte.nombre as cnombre',
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

        // $ingreso = serviciosTrasporte::whereBetween('fecha', [$lunes, $domingo])
        //     // ->where('tipo', 1)
        //     ->sum('cantidad');

        // $egreso = serviciosTrasporte::whereBetween('fecha', [$lunes, $domingo])
        //     // ->where('tipo', 2)
        //     ->sum('cantidad');

        // $saldo = $ingreso - $egreso;


        // dd($lunes, $domingo);

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

        $conceptos = conceptosServiciosTrasporte::orderBy('codigo', 'asc')->get();
        $personal = personal::orderBy('nombres', 'asc')->where('estatusId', 1)->get();
        $obras = obras::orderBy('nombre', 'asc')->where('estatus', 1)->get();
        $maquinaria = maquinaria::where('compania', '!=', 'mtq')->orWhere('compania', null)->get();
        $vctComprobantes = comprobante::select()->orderBy('nombre', 'asc')->get();
        $vctClientes = clientes::select()->orderBy('nombre', 'asc')->get();
        // dd($obras);
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

        // dd($data);

        serviciosTrasporte::create($data);

        // $last = cajaChica::orderby('dia', 'desc')->orderby('id', 'desc')->first();

        // if ($last) {
        //     $decTotal = $last->total;
        // } else {
        //     $decTotal = 0;
        // }

        // if ($request->tipo == 1 || $request->tipo == 2) {
        //     //*** para ingreso o egreso */
        //     if ($request->tipo == 1) {
        //         $total = $decTotal + $request->cantidad;
        //     } else {
        //         $total = $decTotal - $request->cantidad;
        //     }
        // } else {
        //     //*** todos los demas */
        //     $total = 0;
        // }
        // // dd( $decTotal, $total );

        // $ultimo = cajaChica::create($request->only('dia', 'concepto', 'comprobanteId', 'ncomprobante', 'cliente', 'obra', 'equipo', 'personal', 'tipo', 'cantidad', 'comentario',) + ['total' => $total]);
        // Session::flash('message', 1);
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
        //
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
        //
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
}
