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

class cajachicaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // abort_if(Gate::denies('cajachica_index'), 403);

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
                'cajachica.total'
            )->orderby('dia', 'desc')->orderby('id', 'desc')
            ->paginate(15);

        $last = cajaChica::orderby('dia', 'desc')->orderby('id', 'desc')->first();

        // dd($registros);
        // tomas::join('examenes', 'tomas.examenes_id', 'examenes.id')
        // ->select('examenes.id', 'examenes.nombre', 'tomas.estatus', 'tomas.id as toma')
        // ->where('tomas.tickets_id', $ticket->id)
        // ->paginate(10);
        // Dia, concepto, comprabante, numero de comprobante, cliente, obra, equipo, personal, cantidad, tipo
        return view('cajachica.indexcajachica', compact('registros', 'last'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $conceptos = conceptos::get();
        $personal = personal::get();
        $obras = obras::get();
        $maquinaria = maquinaria::get();
        // dd($maquinaria);
        return view('cajachica.nuevoMovimiento', compact('conceptos', 'personal', 'obras', 'maquinaria'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $last = cajaChica::orderby('dia', 'desc')->orderby('id', 'desc')->first();


        if ($request->tipo == 1 || $request->tipo == 2) {
            if ($request->tipo == 1) {
                $total = $last->total + $request->cantidad;
                // dd('uno');
            } else {
                $total = $last->total - $request->cantidad;
            }
        } else {
            // dd('3');
        }
        // dd($last);
        $ultimo = cajachica::create($request->only('dia', 'concepto', 'comprobante', 'ncomprobante', 'cliente', 'obra', 'equipo', 'personal', 'tipo', 'cantidad', 'comentario',) + ['total' => $total]);
        Session::flash('message', 1);
        return redirect()->action([cajachicaController::class, 'index']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\cajachica  $cajachica
     * @return \Illuminate\Http\Response
     */
    public function show(cajachica $cajachica)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\cajachica  $cajachica
     * @return \Illuminate\Http\Response
     */
    public function edit(cajachica $cajachica)
    {
        // dd($cajachica);

        $conceptos = conceptos::get();
        $personal = personal::get();
        $obras = obras::get();
        $maquinaria = maquinaria::get();
        return view('cajachica.editMovimiento', compact('conceptos', 'personal', 'obras', 'maquinaria', 'cajachica'));

        // {{ \Carbon\Carbon::parse($tarea->fechaInicio)->format('d/m/Y') }}
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\cajachica  $cajachica
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, cajachica $cajachica)
    {
        $cajachica->update($request->only('dia', 'concepto', 'comprobante', 'ncomprobante', 'cliente', 'obra', 'equipo', 'personal', 'tipo', 'cantidad', 'comentario', 'total'));
        Session::flash('message', 1);
        return redirect()->action([cajachicaController::class, 'index']);
        dd("update");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\cajachica  $cajachica
     * @return \Illuminate\Http\Response
     */
    public function destroy(cajachica $cajachica)
    {
        dd("destroy");
    }
}