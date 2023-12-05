<?php

namespace App\Http\Controllers;

use App\Helpers\Calculos;
use App\Models\serviciosTrasporte;
use App\Http\Controllers\Controller;
use App\Models\almacenTiraderos;
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
        abort_if(Gate::denies('serviciosTrasporte_index'), 403);

        $hoy = now();
        $quincena = $hoy->clone()->subDay(15);
        $reporte = 0;

        $pendientes = serviciosTrasporte::whereBetween('fecha', [$quincena, $hoy])
            ->whereNotIn('estatus', [4, 0])
            // ->sum('costoServicio');
            ->get();

        $sumaPendientes = $pendientes->sum('costoServicio') + $pendientes->sum('cantidad') + $pendientes->sum('costoMano');
        $totalPendientes = $pendientes->count();

        $pagados = serviciosTrasporte::whereBetween('fecha', [$quincena, $hoy])
            ->where('estatus', 4)
            // ->sum('costoServicio');
            ->get();

        $sumaPagados = $pagados->sum('costoServicio') + $pagados->sum('cantidad') + $pagados->sum('costoMano');
        $totalPagados = $pagados->count();

        $registros = serviciosTrasporte::join('conceptos', 'serviciosTrasporte.conceptoId', 'conceptos.id')
            ->leftJoin('obras', 'serviciosTrasporte.obraId', 'obras.id')
            ->join('clientes', 'obras.clienteId', 'clientes.id')
            ->join('maquinaria', 'serviciosTrasporte.equipoId', 'maquinaria.id')
            ->join('personal', 'serviciosTrasporte.personalId', 'personal.id')
            ->select(
                'serviciosTrasporte.id',
                'serviciosTrasporte.fecha',
                'conceptos.nombre as cnombre',
                'clientes.nombre as cliente',
                'obras.nombre as obra',
                'obras.centroCostos',
                'obras.proyecto',
                'maquinaria.identificador',
                'maquinaria.nombre as maquinaria',
                'personal.nombres as pnombre',
                'personal.apellidoP as papellidoP',
                'cantidad',
                'costoMano',
                'costoServicio',
                'numFactura',
                'serviciosTrasporte.estatus'
            )
            ->orderBy('id', 'desc')
            ->whereBetween('serviciosTrasporte.fecha', [$quincena, $hoy])
            ->paginate(15);
        // dd($sumaPendientes, $Cpagados);

        return view('serviciosTrasporte.indexServicios', compact('registros', 'sumaPendientes', 'totalPendientes', 'sumaPagados', 'totalPagados', 'quincena', 'hoy', 'reporte'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(Gate::denies('serviciosTrasporte_create'), 403);

        $conceptos = conceptos::orderBy('codigo', 'asc')->get();
        $personal = personal::orderBy('nombres', 'asc')->where('estatusId', 1)->get();
        $obras = obras::orderBy('nombre', 'asc')->where('estatus', 1)->get();
        $maquinaria = maquinaria::where('compania', '!=', 'mtq')->orWhere('compania', null)->orderBy('identificador', 'asc')->get();
        $vctComprobantes = comprobante::select()->orderBy('nombre', 'asc')->get();
        $vctClientes = clientes::select()->orderBy('nombre', 'asc')->get();
        $almacenes =  almacenTiraderos::select()->orderBy('nombre', 'asc')->get();
        return view('serviciosTrasporte.nuevoMovimientoServicio', compact('conceptos', 'personal', 'obras', 'maquinaria', 'vctComprobantes', 'vctClientes', 'almacenes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        abort_if(Gate::denies('serviciosTrasporte_create'), 403);

        $data = $request->all();
        $data['estatus'] = 1;
        // dd($data);
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
        abort_if(Gate::denies('serviciosTrasporte_create'), 403);

        $conceptos = conceptos::orderBy('codigo', 'asc')->get();
        $personal = personal::orderBy('nombres', 'asc')->where('estatusId', 1)->get();
        $obras = obras::orderBy('nombre', 'asc')->where('estatus', 1)->get();
        $maquinaria = maquinaria::where('compania', '!=', 'mtq')->orWhere('compania', null)->get();
        $vctClientes = clientes::select()->orderBy('nombre', 'asc')->get();
        $almacenes =  almacenTiraderos::select()->orderBy('nombre', 'asc')->get();
        // dd($serviciosTrasporte);
        return view('serviciosTrasporte.updateMovimientoServicio', compact('serviciosTrasporte', 'conceptos', 'personal', 'obras', 'maquinaria', 'vctClientes', 'almacenes'));
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
        abort_if(Gate::denies('serviciosTrasporte_create'), 403);

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
        // servicioTrasporteId
        if ($serviciosTrasporte->cajachica == 1) {
            $cajaChica = cajaChica::select('*')
                ->where('servicioTrasporteId', $serviciosTrasporte->id)
                ->first();

            $cajaChica->delete();
        }
        $serviciosTrasporte->delete();
        return redirect()->back()->with('success', 'Eliminado correctamente');

        dd($serviciosTrasporte);

        abort_if(Gate::denies('catalogos_destroy'), 403);
        // try {
        //     $tiposDocs->delete();
        //     // Intenta eliminar
        // } catch (QueryException $e) {
        //     if ($e->getCode() === 23000) {
        //         return redirect()->back()->with('faild', 'No Puedes Eliminar ');
        //         // Esto es un error de restricción de clave externa ( FOREIGN KEY constraint )
        //         // Puedes mostrar un mensaje de error o realizar otras acciones aquí.
        //     } else {
        //         return redirect()->back()->with('faild', 'No Puedes Eliminar si esta en uso');
        //         // Otro tipo de error de base de datos
        //         // Maneja según sea necesario
        //     }
        // }
        // return redirect()->back()->with('success', 'Eliminado correctamente');
    }

    public function cajaChica(Request $request)
    {
        abort_if(Gate::denies('serviciosTrasporte_create'), 403);
        // dd($request);
        $serviciosTrasporte = serviciosTrasporte::find($request->id);
        $serviciosTrasporte->cajaChica = 1;
        $serviciosTrasporte->estatus = 3;
        $serviciosTrasporte->save();

        $obra = obras::find($serviciosTrasporte->obraId);
        // serviciosTrasporte.conceptoId
        $data['dia'] = $serviciosTrasporte->fecha;
        $data['concepto'] = $serviciosTrasporte->conceptoId;
        $data['comprobanteId'] = 2;
        $data['ncomprobante'] = $serviciosTrasporte->id;
        $data['cliente'] = $obra->clienteId;
        $data['obra'] = $serviciosTrasporte->obraId;
        $data['equipo'] = $serviciosTrasporte->equipoId;
        $data['personal'] = $serviciosTrasporte->personalId;
        $data['tipo'] = 2;
        $data['cantidad'] = $serviciosTrasporte->cantidad + $serviciosTrasporte->costoMano;
        $data['servicioTrasporteId'] = $serviciosTrasporte->id;


        // $data['comentario'] = $serviciosTrasporte->id;

        cajaChica::create($data);

        return redirect()->action([serviciosTrasporteController::class, 'index']);
        dd('cajaChica');
    }

    public function pagado(Request $request)
    {
        abort_if(Gate::denies('serviciosTrasporte_create'), 403);
        // dd($request);
        $serviciosTrasporte = serviciosTrasporte::find($request->id);
        $serviciosTrasporte->estatus = 4;
        $serviciosTrasporte->numFactura = $request->numFactura;
        $serviciosTrasporte->save();

        return redirect()->action([serviciosTrasporteController::class, 'index']);
        dd('cajaChica');
    }

    public function misServicios()
    {
        abort_if(Gate::denies('servicio_Chofer'), 403);

        $personal = personal::where('userId', auth()->user()->id)->first();
        if (!isset($personal->id)) {
            return redirect()->action([serviciosTrasporteController::class, 'index']);
        }
        // dd($personal);
        $registros = serviciosTrasporte::join('conceptos', 'serviciosTrasporte.conceptoId', 'conceptos.id')
            ->leftJoin('obras', 'serviciosTrasporte.obraId', 'obras.id')
            ->leftJoin('residente', 'obras.id', 'residente.obraId')
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
                'serviciosTrasporte.estatus',
                'residente.nombre',
                'serviciosTrasporte.comentario',
            )
            ->orderBy('fecha', 'desc')
            ->groupBy('serviciosTrasporte.id')
            ->where('serviciosTrasporte.personalId', $personal->id)
            ->orWhere('serviciosTrasporte.estatus', 1)
            ->orWhere('serviciosTrasporte.estatus', 2)
            ->paginate(15);
        // dd($registros);
        return view('serviciosTrasporte.indexServicios', compact('registros'));
    }

    public function misServiciosChofer(Request $request)
    {
        abort_if(Gate::denies('servicio_Chofer'), 403);
        $now = new \DateTime();
        $serviciosTrasporte = serviciosTrasporte::find($request->id);
        $serviciosTrasporte->recibe = $request->recibe;
        $serviciosTrasporte->comentario = $request->comentario;
        $serviciosTrasporte->estatus = 2;
        $serviciosTrasporte->horaEntrega = $now->format('H:i:s');
        $serviciosTrasporte->odometro = $request->odometro;
        // dd($serviciosTrasporte, $request);
        $objCalculos = new Calculos();
        $objCalculos->updateKilometrajeMaquinaria($serviciosTrasporte->equipoId, $request->odometro, $proviene = 'Servicios');

        // dd($serviciosTrasporte);

        $serviciosTrasporte->save();
        return redirect()->action([serviciosTrasporteController::class, 'misServicios']);
    }

    public function printTicketChofer($id)
    {
        $servicio = serviciosTrasporte::join('personal', 'personal.id', '=', 'serviciosTrasporte.personalId')
            ->join('maquinaria', 'maquinaria.id', 'serviciosTrasporte.equipoId')
            ->join('obras', 'obras.id', 'serviciosTrasporte.obraId')
            ->join('clientes', 'clientes.id', 'obras.clienteId')
            ->join('almacenTiraderos', 'almacenTiraderos.id', 'serviciosTrasporte.almacenId')
            ->join('conceptos', 'conceptos.id', 'serviciosTrasporte.conceptoId')
            ->select(
                'serviciosTrasporte.id',
                'personal.nombres',
                'personal.apellidoP',
                'maquinaria.nombre as equipo',
                'clientes.nombre as cliente',
                'obras.nombre as obra',
                'serviciosTrasporte.recibe',
                'almacenTiraderos.nombre as almacen',
                'serviciosTrasporte.horaEntrega',
                'serviciosTrasporte.comentario',
                'conceptos.nombre as concepto'
            )
            ->where('serviciosTrasporte.id', $id)
            ->first();

        // dd('printTicketChofer', $servicio);

        return view('serviciosTrasporte.ticketChofer', compact('servicio'));
    }

    public function printTicketCerrado($id)
    {
        $servicio = serviciosTrasporte::join('personal', 'personal.id', '=', 'serviciosTrasporte.personalId')
            ->leftjoin('personal as manio', 'personal.id', '=', 'serviciosTrasporte.maniobristaId')
            ->join('maquinaria', 'maquinaria.id', 'serviciosTrasporte.equipoId')
            ->join('obras', 'obras.id', 'serviciosTrasporte.obraId')
            ->join('clientes', 'clientes.id', 'obras.clienteId')
            ->join('almacenTiraderos', 'almacenTiraderos.id', 'serviciosTrasporte.almacenId')
            ->join('conceptos', 'conceptos.id', 'serviciosTrasporte.conceptoId')
            ->select(
                'serviciosTrasporte.id',
                'personal.nombres',
                'personal.apellidoP',
                'manio.nombres as maninombre',
                'manio.apellidoP as maniapellido',
                'maquinaria.nombre as equipo',
                'clientes.nombre as cliente',
                'obras.nombre as obra',
                'serviciosTrasporte.recibe',
                'almacenTiraderos.nombre as almacen',
                'serviciosTrasporte.horaEntrega',
                'serviciosTrasporte.comentario',
                'serviciosTrasporte.horaEntrega',
                'serviciosTrasporte.horaLlegada',
                'serviciosTrasporte.odometro',
                'serviciosTrasporte.costoMaterial',
                'serviciosTrasporte.costoServicio',
                'serviciosTrasporte.costoMano',
                'serviciosTrasporte.servicio',
                'serviciosTrasporte.cantidad',
                'conceptos.nombre as concepto'
            )
            ->where('serviciosTrasporte.id', $id)
            ->first();

        // dd('printTicketChofer', $servicio);

        return view('serviciosTrasporte.ticketCerrado', compact('servicio'));
    }

    public function reporte(Request $request)
    {
        abort_if(Gate::denies('serviciosTrasporte_index'), 403);

        // dd($request);
        $hoy = $request->fin;
        $quincena = $request->inicio;
        $reporte = 1;

        $pendientes = serviciosTrasporte::whereBetween('fecha', [$quincena, $hoy])
            ->whereNotIn('estatus', [4, 0])
            // ->sum('costoServicio');
            ->get();

        $sumaPendientes = $pendientes->sum('costoServicio') + $pendientes->sum('cantidad') + $pendientes->sum('costoMano');
        $totalPendientes = $pendientes->count();

        $pagados = serviciosTrasporte::whereBetween('fecha', [$quincena, $hoy])
            ->where('estatus', 4)
            // ->sum('costoServicio');
            ->get();

        $sumaPagados = $pagados->sum('costoServicio') + $pagados->sum('cantidad') + $pagados->sum('costoMano');
        $totalPagados = $pagados->count();

        $registros = serviciosTrasporte::join('conceptos', 'serviciosTrasporte.conceptoId', 'conceptos.id')
            ->leftJoin('obras', 'serviciosTrasporte.obraId', 'obras.id')
            ->join('clientes', 'obras.clienteId', 'clientes.id')
            ->join('maquinaria', 'serviciosTrasporte.equipoId', 'maquinaria.id')
            ->join('personal', 'serviciosTrasporte.personalId', 'personal.id')
            ->select(
                'serviciosTrasporte.id',
                'serviciosTrasporte.fecha',
                'conceptos.nombre as cnombre',
                'clientes.nombre as cliente',
                'obras.nombre as obra',
                'obras.centroCostos',
                'obras.proyecto',
                'maquinaria.identificador',
                'maquinaria.nombre as maquinaria',
                'personal.nombres as pnombre',
                'personal.apellidoP as papellidoP',
                'cantidad',
                'costoMano',
                'costoServicio',
                'numFactura',
                'serviciosTrasporte.estatus'
            )
            ->orderBy('fecha', 'desc')
            ->whereBetween('serviciosTrasporte.fecha', [$quincena, $hoy])
            ->paginate(15);
        // dd($sumaPendientes, $Cpagados);

        return view('serviciosTrasporte.indexServicios', compact('registros', 'sumaPendientes', 'totalPendientes', 'sumaPagados', 'totalPagados', 'quincena', 'hoy', 'reporte'));
    }
}
