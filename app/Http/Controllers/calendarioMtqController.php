<?php

namespace App\Http\Controllers;

use App\Models\calendarioMtq;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\serviciosMtq;
use App\Models\maquinaria;
use Illuminate\Support\Facades\Auth;

class calendarioMtqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if ( Gate::denies( 'calendarioMtq_index' ), 403 );
        //$eventos = calendarioMtq::all();
        $servicios = serviciosMtq::all();
        $eventos = calendarioMtq::join('maquinaria', "maquinaria.id", "mtqEventos.maquinariaId")
        ->join('serviciosMtq', 'serviciosMtq.id', 'mtqEventos.mantenimientoId')
            ->select(
                'mtqEventos.id',
                'mtqEventos.title',
                'mtqEventos.mantenimientoId',
                'mtqEventos.maquinariaId',
                'mtqEventos.fecha',
                'mtqEventos.descripcion',
                'mtqEventos.estatus',
                'mtqEventos.color',
                'mtqEventos.start',
                'mtqEventos.end',
                'maquinaria.nombre',
                'maquinaria.identificador as numeconomico',
                'maquinaria.placas',
                'maquinaria.marca',
                'serviciosMtq.nombre as nombreServicio'
                // 'maquinaria.id as idDoc'
            )
            ->get();
        $eventosJson = $eventos->toJson();
        // dd($eventos);
        return view( 'mtq.calendario', compact('eventosJson', 'servicios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        abort_if(Gate::denies('calendarioMtq_create'), 404);
        $events = $request->all();
        $events['start'] = strtoupper($events['fecha'].' '.$events['hora']);
        $events['title'] = strtoupper($events['placas'].' '.$events['nombre'].' '.$events['marca'].' '.$events['numeconomico'].' '.$events['descripcion']);
        // dd($events);
        $events = calendarioMtq::create($events);
        Session::flash('message', 1);
        return redirect()->route('calendarioMtq.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\calendarioMtq  $calendarioMtq
     * @return \Illuminate\Http\Response
     */
    public function show(calendarioMtq $calendarioMtq)
    {
        //
        dd('show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\calendarioMtq  $calendarioMtq
     * @return \Illuminate\Http\Response
     */
    public function edit(calendarioMtq $calendarioMtq)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\calendarioMtq  $calendarioMtq
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, calendarioMtq $calendarioMtq)
    {
        abort_if(Gate::denies('calendarioMtq_edit'), 404);
        $calendarioMtq = calendarioMtq::where('id',$request->id)->first();
        $data = $request->all();
        // dd($calendarioMtq, $data);
        $data['estatus'] = 1;
        if($data['fecha'] != null && $data['hora'] != null){
            $data['start'] = strtoupper($data['fecha'].' '.$data['hora']);
        }
        if($data['fechaSalida'] != null && $data['horaSalida'] != null){
            $data['end'] = strtoupper($data['fechaSalida'].' '.$data['horaSalida']);    
        }
        if ($data['color'] === null) {
            unset($data['color']);
        }
        if ($data['maquinariaId'] === null) {
            unset($data['maquinariaId']);
        }
        $data['title'] = strtoupper($data['placas'].' '.$data['nombre'].' '.$data['marca'].' '.$data['numeconomico'].' '.$data['descripcion']);
        $calendarioMtq->update($data);

        Session::flash('message', 1);

        return redirect()->route('calendarioMtq.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\calendarioMtq  $calendarioMtq
     * @return \Illuminate\Http\Response
     */
    public function destroy(calendarioMtq $calendarioMtq)
    {
        //
    }
    

    public function checkPermission($permission)
    {
        $hasPermission = Auth::user()->hasPermissionTo($permission);

        return response()->json(['hasPermission' => $hasPermission]);
    }
}
