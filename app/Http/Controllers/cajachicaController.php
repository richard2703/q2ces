<?php

namespace App\Http\Controllers;

use App\Exports\ReporteCajaChicaExport;
use App\Models\cajaChica;
use App\Http\Controllers\Controller;
use App\Models\conceptos;
use App\Models\maquinaria;
use App\Models\obras;
use App\Models\personal;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

use App\Helpers\Calculos;
use App\Models\clientes;
use App\Models\comprobante;
use App\Models\corteCajaChica;
use Maatwebsite\Excel\Excel as ExcelExcel;
use Maatwebsite\Excel\Facades\Excel;

class cajaChicaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        abort_if(Gate::denies('cajachica_index'), 403);

        // SEMANA ACTUAL
        if (Carbon::parse(now())->locale('es')->isoFormat('dddd') == 'lunes') {
            $lunes = now();
            // dd(Carbon::parse($pLunes)->locale('es')->isoFormat('dddd'));
        } else {
            $lunes = new Carbon('last monday');
        }
        if (Carbon::parse(now())->locale('es')->isoFormat('dddd') == 'domingo') {
            $domingo = now();
            // dd(Carbon::parse($pLunes)->locale('es')->isoFormat('dddd'));
        } else {
            $domingo = new Carbon('next sunday');
        }

        // SEMANA PASADA
        $Adomingo = $domingo->clone()->subDay(7);
        $Alunes = $lunes->clone()->subDay(7);

        $ultimoCorte = corteCajaChica::latest()->first();

        $registros = cajaChica::join('personal', 'cajaChica.personal', 'personal.id')
            ->leftJoin('obras', 'cajaChica.obra', 'obras.id')
            ->leftJoin('maquinaria', 'cajaChica.equipo', 'maquinaria.id')
            ->join('conceptos', 'cajaChica.concepto', 'conceptos.id')
            ->join('comprobante', 'cajaChica.comprobanteId', 'comprobante.id')
            ->leftJoin('clientes', 'obras.clienteId', 'clientes.id')
            ->select(
                'cajaChica.id',
                'dia',
                'conceptos.codigo',
                'conceptos.nombre as cnombre',
                'comprobanteId',
                'comprobante.nombre as comprobante',
                'ncomprobante',
                'personal.nombres as pnombre',
                'personal.apellidoP as papellidoP',
                'clientes.nombre as cliente',
                'obras.nombre as obra',
                'maquinaria.identificador',
                'maquinaria.nombre as maquinaria',
                'cantidad',
                'cajaChica.tipo',
                'cajaChica.total'
            )->orderby('dia', 'desc')->orderby('id', 'desc')
            ->whereBetween('dia', [$lunes->clone()->subDay(1), $domingo])
            ->paginate(15);

        $ingreso = cajaChica::whereBetween('dia', [$lunes->clone()->subDay(1), $domingo])
            ->where('tipo', 1)
            ->sum('cantidad');

        $egreso = cajaChica::whereBetween('dia', [$lunes->clone()->subDay(1), $domingo])
            ->where('tipo', 2)
            ->sum('cantidad');

        $saldo = $ingreso - $egreso;

        $ingreso = $ingreso - $ultimoCorte->saldo;


        // $ultimocortefecha = $ultimoCorte->fin;
        // $time = strtotime($ultimocortefecha);

        // $newformat = date('Y-m-d', $time);
        // // dd($newformat);
        // if (date_diff(now(), $newformat->addDays(1))->format('%D%') <= 1 || !isset($ultimoCorte->saldo)) {
        //     dd("entro");
        // } else {
        //     dd("no");
        // }



        // $date = Carbon::createFromFormat('m/d/Y', $ultimocortefecha)->format('Y-m-d');



        // dd($lunes, $domingo);

        return view('cajaChica.indexCajaChica', compact('registros', 'saldo', 'ingreso', 'egreso', 'lunes', 'domingo', 'ultimoCorte'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        abort_if(Gate::denies('cajachica_create'), 403);

        $conceptos = conceptos::orderBy('codigo', 'asc')->get();
        $personal = personal::join('puesto', 'personal.puestoId', 'puesto.id')
            ->join('puestonivel', 'puesto.puestoNivelId', 'puestonivel.id')
            ->select('personal.id', 'personal.nombres', 'personal.apellidoP')
            ->where('puestonivel.usaCajaChica', 1)
            ->where('personal.estatusId', 1)
            ->orderBy('personal.nombres', 'asc')->get();
        // dd($personal);
        $obras = obras::orderBy('nombre', 'asc')->get();
        $maquinaria = maquinaria::where('compania', '!=', 'mtq')->orWhere('compania', null)->orderBy('identificador', 'asc')->get();
        $vctComprobantes = comprobante::select()->orderBy('nombre', 'asc')->get();
        $vctClientes = clientes::select()->orderBy('nombre', 'asc')->get();
        // dd($conceptos);
        return view('cajaChica.nuevoMovimiento', compact('conceptos', 'personal', 'obras', 'maquinaria', 'vctComprobantes', 'vctClientes'));
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

        // dd($request);

        $last = cajaChica::orderby('dia', 'desc')->orderby('id', 'desc')->first();

        if ($last) {
            $decTotal = $last->total;
        } else {
            $decTotal = 0;
        }

        if ($request->tipo == 1 || $request->tipo == 2) {
            //*** para ingreso o egreso */
            if ($request->tipo == 1) {
                $total = $decTotal + $request->cantidad;
            } else {
                $total = $decTotal - $request->cantidad;
            }
        } else {
            //*** todos los demas */
            $total = 0;
        }
        // dd( $decTotal, $total );

        $ultimo = cajaChica::create($request->only('dia', 'concepto', 'comprobanteId', 'ncomprobante', 'cliente', 'obra', 'equipo', 'personal', 'tipo', 'cantidad', 'comentario',) + ['total' => $total]);
        Session::flash('message', 1);
        return redirect()->action([cajaChicaController::class, 'index']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\cajaChica  $cajaChica
     * @return \Illuminate\Http\Response
     */

    public function show(cajaChica $cajaChica)
    {
        $conceptos = conceptos::orderBy('codigo', 'asc')->get();
        $personal = personal::join('puesto', 'personal.puestoId', 'puesto.id')
            ->join('puestonivel', 'puesto.puestoNivelId', 'puestonivel.id')
            ->select('personal.id', 'personal.nombres', 'personal.apellidoP')
            ->where('puestonivel.usaCajaChica', 1)
            ->where('personal.estatusId', 1)
            ->orderBy('personal.nombres', 'asc')->get();
        $obras = obras::orderBy('nombre', 'asc')->get();
        $maquinaria = maquinaria::where('compania', '!=', 'mtq')->orWhere('compania', null)->orderBy('identificador', 'asc')->get();
        $vctComprobantes = comprobante::select()->orderBy('nombre', 'asc')->get();
        $vctClientes = clientes::select()->orderBy('nombre', 'asc')->get();

        return view('cajaChica.showMovimiento', compact('conceptos', 'personal', 'obras', 'maquinaria', 'cajaChica', 'vctComprobantes', 'vctClientes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\cajaChica  $cajaChica
     * @return \Illuminate\Http\Response
     */

    public function edit(cajaChica $cajaChica)
    {
        abort_if(Gate::denies('cajachica_edit'), 403);

        // dd( $cajaChica );

        $conceptos = conceptos::orderBy('codigo', 'asc')->get();
        $personal = personal::join('puesto', 'personal.puestoId', 'puesto.id')
            ->join('puestonivel', 'puesto.puestoNivelId', 'puestonivel.id')
            ->select('personal.id', 'personal.nombres', 'personal.apellidoP')
            ->where('puestonivel.usaCajaChica', 1)
            ->where('personal.estatusId', 1)
            ->orderBy('personal.nombres', 'asc')->get();
        $obras = obras::orderBy('nombre', 'asc')->get();
        $maquinaria = maquinaria::where('compania', '!=', 'mtq')->orWhere('compania', null)->orderBy('identificador', 'asc')->get();
        $vctComprobantes = comprobante::select()->orderBy('nombre', 'asc')->get();
        $vctClientes = clientes::select()->orderBy('nombre', 'asc')->get();
        return view('cajaChica.editMovimiento', compact('conceptos', 'personal', 'obras', 'maquinaria', 'cajaChica', 'vctComprobantes', 'vctClientes'));

        // {
        // {
        //     \Carbon\Carbon::parse( $tarea->fechaInicio )->format( 'd/m/Y' ) }
        // }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\cajaChica  $cajaChica
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, cajaChica $cajaChica)
    {
        abort_if(Gate::denies('cajachica_edit'), 403);

        $cajaChica->update($request->only('dia', 'concepto', 'comprobanteId', 'ncomprobante', 'cliente', 'obra', 'equipo', 'personal', 'tipo', 'cantidad', 'comentario', 'total'));

        //*** ejecutamos el recalculo general */
        $objCalculos = new Calculos;

        $objCalculos->RecalcularCajaChica($cajaChica->id);

        Session::flash('message', 1);
        return redirect()->action([cajaChicaController::class, 'index']);
        dd('update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\cajaChica  $cajaChica
     * @return \Illuminate\Http\Response
     */

    public function destroy(cajaChica $cajaChica)
    {
        abort_if(Gate::denies('cajachica_destroy'), 403);

        // dd($cajaChica);
        Session::flash('message', 1);
        $cajaChica->delete();
        return redirect()->action([cajaChicaController::class, 'index']);
    }

    public function reporte(Request $request)
    {
        // abort_if(Gate::denies('cajachica_destroy'), 403);
        // dd($request);

        $registros = cajaChica::join('personal', 'cajaChica.personal', 'personal.id')
            ->leftJoin('obras', 'cajaChica.obra', 'obras.id')
            ->join('maquinaria', 'cajaChica.equipo', 'maquinaria.id')
            ->join('conceptos', 'cajaChica.concepto', 'conceptos.id')
            ->join('comprobante', 'cajaChica.comprobanteId', 'comprobante.id')
            ->select(
                'cajaChica.id',
                'dia',
                'conceptos.codigo',
                'conceptos.nombre as cnombre',
                'comprobanteId',
                'comprobante.nombre as comprobante',
                'ncomprobante',
                'personal.nombres as pnombre',
                'personal.apellidoP as papellidoP',
                'cliente',
                'obras.nombre as obra',
                'maquinaria.identificador',
                'maquinaria.nombre as maquinaria',
                'cantidad',
                'cajaChica.tipo',
                'cajaChica.total'
            )->whereBetween('dia', [$request->inicio, $request->fin])
            ->orderby('dia', 'desc')->orderby('id', 'desc')
            ->get();

        $ingreso = cajaChica::where('tipo', 1)
            ->whereBetween('dia', [$request->inicio, $request->fin])
            ->sum('cantidad');
        $egreso = cajaChica::where('tipo', 2)
            ->whereBetween('dia', [$request->inicio, $request->fin])
            ->sum('cantidad');

        $inicio = $request->inicio;
        $fin = $request->fin;
        return view('cajaChica.reporteCajaChica', compact('registros', 'inicio', 'fin', 'ingreso', 'egreso'));
    }

    public function reporteExcel(Request $request)
    {
        // dd('test');
        $query = cajaChica::join('personal', 'cajaChica.personal', 'personal.id')
            ->leftJoin('obras', 'cajaChica.obra', 'obras.id')
            ->join('maquinaria', 'cajaChica.equipo', 'maquinaria.id')
            ->join('conceptos', 'cajaChica.concepto', 'conceptos.id')
            ->join('comprobante', 'cajaChica.comprobanteId', 'comprobante.id')
            ->select(
                'cajaChica.id',
                'dia',
                'conceptos.codigo',
                'conceptos.nombre as cnombre',
                'ncomprobante',
                'comprobante.nombre as comprobante',
                'personal.nombres as pnombre',
                'personal.apellidoP as papellidoP',
                'cliente',
                'obras.nombre as obra',
                'maquinaria.identificador',
                'maquinaria.nombre as maquinaria',
                'cantidad',
                'cajaChica.tipo',
            )->whereBetween('dia', [$request->inicio, $request->fin])
            ->orderby('dia', 'desc')->orderby('id', 'desc')
            ->get();
        // dd($query);

        foreach ($query as $q) {
            switch ($q->tipo) {
                case  $q->tipo == 1:
                    $q->tipo = 'Ingreso';
                    break;
                case $q->tipo == 2:
                    $q->tipo = 'Egreso';
                    break;
                case $q->tipo == 3:
                    $q->tipo = 'Ingreso de Servicios';
                    break;
                case $q->tipo == 4:
                    $q->tipo = 'Pendiente de Cobro Y/O Factura';
                    break;

                default:
                    break;
            }
        }




        // dd($request);
        // return Excel::download(new ReporteCajaChicaExport, 'cajaChica.xlsx');
        // return (new ReporteCajaChicaExport)->download('invoices.csv', ExcelExcel::CSV, ['Content-Type' => 'text/csv']);
        return (new ReporteCajaChicaExport($query))->download('invoices.xlsx');
        // return (new ReporteCajaChicaExport)->forYear(2023)->download('invoices.xlsx');
    }

    public function corte(Request $request)
    {
        // dd('corte');
        $lunes = $request->inicio;
        $domingo = $request->fin;

        $registros = cajaChica::join('personal', 'cajaChica.personal', 'personal.id')
            ->leftJoin('obras', 'cajaChica.obra', 'obras.id')
            ->join('maquinaria', 'cajaChica.equipo', 'maquinaria.id')
            ->join('conceptos', 'cajaChica.concepto', 'conceptos.id')
            ->join('comprobante', 'cajaChica.comprobanteId', 'comprobante.id')
            ->select(
                'cajaChica.id',
                'dia',
                'conceptos.codigo',
                'conceptos.nombre as cnombre',
                'comprobanteId',
                'comprobante.nombre as comprobante',
                'ncomprobante',
                'personal.nombres as pnombre',
                'personal.apellidoP as papellidoP',
                'cliente',
                'obras.nombre as obra',
                'maquinaria.identificador',
                'maquinaria.nombre as maquinaria',
                'cantidad',
                'cajaChica.tipo',
                'cajaChica.total'
            )->orderby('dia', 'desc')->orderby('id', 'desc')
            ->whereBetween('dia', [$lunes, $domingo])
            ->paginate(15);

        $ingreso = cajaChica::whereBetween('dia', [$lunes, $domingo])
            ->where('tipo', 1)
            ->sum('cantidad');

        $egreso = cajaChica::whereBetween('dia', [$lunes, $domingo])
            ->where('tipo', 2)
            ->sum('cantidad');

        $saldo = $ingreso - $egreso;

        // $registros = cajaChica::select(
        //     'personal.nombres as pnombre',
        //     'personal.apellidoP as papellidoP',
        //     DB::raw('SUM(CASE WHEN tipo = 1 THEN cantidad ELSE 0 END) AS total_ingresos'),
        //     DB::raw('SUM(CASE WHEN tipo = 2 THEN cantidad ELSE 0 END) AS total_egresos')
        // )
        //     ->join('personal', 'cajaChica.personal', 'personal.id')
        //     ->whereBetween('dia', [$lunes, $domingo])
        //     ->groupBy('cajaChica.personal')
        //     ->get();

        // dd($registros);

        return view('cajaChica.corteCajaChica', compact('registros', 'lunes', 'domingo', 'ingreso', 'egreso', 'saldo'));
    }

    public function cerrar(Request $request)
    {
        // dd('cerrar');

        $lunes = $request->inicio;
        $domingo = $request->fin;

        $ingreso = cajaChica::whereBetween('dia', [$lunes, $domingo])
            ->where('tipo', 1)
            ->sum('cantidad');

        $egreso = cajaChica::whereBetween('dia', [$lunes, $domingo])
            ->where('tipo', 2)
            ->sum('cantidad');

        $saldo = $ingreso - $egreso;

        $corte = new corteCajaChica();
        $corte->inicio = $lunes;
        $corte->fin = $domingo;
        $corte->saldo = $saldo;
        // $corte->Movimientos = $lunes;
        $corte->save();
        // dd('test');
        $carbon_date = Carbon::createFromFormat('Y-m-d', $domingo);
        $carbon_date = $carbon_date->addDay();
        $ultimoSaldo['dia'] =  $carbon_date;
        $ultimoSaldo['concepto'] =  1;
        $ultimoSaldo['comprobanteId'] =  1;
        $ultimoSaldo['ncomprobante'] =  1;
        $ultimoSaldo['equipo'] =  1;
        $ultimoSaldo['personal'] =  16;
        $ultimoSaldo['tipo'] =  1;
        $ultimoSaldo['cantidad'] =  $saldo;
        $ultimoSaldo['comentario'] =  'Ingreso hecho automatico por corte ';


        // dd($carbon_date);

        $cajachica = cajaChica::create($ultimoSaldo);
        // dd($cajachica);
        return redirect()->action([cajaChicaController::class, 'index']);
    }
}
