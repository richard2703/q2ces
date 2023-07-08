<?php

namespace App\Http\Controllers;

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

use App\Helpers\Calculos;

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

        // $registros = cajaChica::get();
        $registros = cajaChica::join('personal', 'cajaChica.personal', 'personal.id')
            ->join('obras', 'cajaChica.obra', 'obras.id')
            ->join('maquinaria', 'cajaChica.equipo', 'maquinaria.id')
            ->join('conceptos', 'cajaChica.concepto', 'conceptos.id')
            ->select(
                'cajaChica.id',
                'dia',
                'conceptos.codigo',
                'conceptos.nombre as cnombre',
                'comprobante',
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
            ->paginate(15);

        $vctTipos = [1, 2];

        $last = cajaChica::whereIn('cajaChica.tipo',   $vctTipos)
            ->orderby('dia', 'desc')
            ->orderby('id', 'desc')->first();

        $lastTotal = 0;
        if ($last) {
            $lastTotal = $last->total;
        }

        $lunes = new Carbon('last monday');
        $domingo = new Carbon('last sunday');

        $ingreso = cajaChica::whereBetween('dia', [$lunes, now()])
            ->where('tipo', 1)
            ->get()
            ->sum('cantidad');

        $egreso = cajaChica::whereBetween('dia', [$lunes, now()])
            ->where('tipo', 2)
            ->get()
            ->sum('cantidad');

        $lunes->subDay(7);

        $semana = cajaChica::whereBetween('dia', [$lunes, $domingo])
            ->orderby('dia', 'desc')
            ->orderby('id', 'desc')->first();
        $lastweek = $semana->total;


        if (Carbon::parse(now())->locale('es')->isoFormat('dddd') == 'lunes') {
            $pLunes = now();
            // dd(Carbon::parse($pLunes)->locale('es')->isoFormat('dddd'));
        } else {
            $pLunes = new Carbon('last monday');
        }

        if (Carbon::parse(now())->locale('es')->isoFormat('dddd') == 'domingo') {
            $pDomingo = now();
            // dd(Carbon::parse($pLunes)->locale('es')->isoFormat('dddd'));
        } else {
            $pDomingo = new Carbon('next sunday');
        }

        // dd(Carbon::parse($semana)->locale('es')->isoFormat('D MMMM'));
        // $categorias = Categoria::sum('cantidad')->groupBy('categoria')->get();


        // tomas::join( 'examenes', 'tomas.examenes_id', 'examenes.id' )
        // ->select( 'examenes.id', 'examenes.nombre', 'tomas.estatus', 'tomas.id as toma' )
        // ->where( 'tomas.tickets_id', $ticket->id )
        // ->paginate( 10 );
        // Dia, concepto, comprabante, numero de comprobante, cliente, obra, equipo, personal, cantidad, tipo

        return view('cajaChica.indexCajaChica', compact('registros', 'lastTotal', 'ingreso', 'egreso', 'lastweek', 'pLunes', 'pDomingo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        abort_if(Gate::denies('cajachica_create'), 403);

        $conceptos = conceptos::get();
        $personal = personal::get();
        $obras = obras::get();
        $maquinaria = maquinaria::get();
        // dd( $maquinaria );
        return view('cajaChica.nuevoMovimiento', compact('conceptos', 'personal', 'obras', 'maquinaria'));
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

        // dd( $request );

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

        $ultimo = cajaChica::create($request->only('dia', 'concepto', 'comprobante', 'ncomprobante', 'cliente', 'obra', 'equipo', 'personal', 'tipo', 'cantidad', 'comentario',) + ['total' => $total]);
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
        //
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

        $conceptos = conceptos::get();
        $personal = personal::get();
        $obras = obras::get();
        $maquinaria = maquinaria::get();
        return view('cajaChica.editMovimiento', compact('conceptos', 'personal', 'obras', 'maquinaria', 'cajaChica'));

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

        $cajaChica->update($request->only('dia', 'concepto', 'comprobante', 'ncomprobante', 'cliente', 'obra', 'equipo', 'personal', 'tipo', 'cantidad', 'comentario', 'total'));

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

        dd('destroy');
    }
}
