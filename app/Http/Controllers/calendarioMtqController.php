<?php

namespace App\Http\Controllers;

use App\Models\calendarioMtq;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class calendarioMtqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if ( Gate::denies( 'puesto_index' ), 403 );
        $eventos = calendarioMtq::all();
        $eventosJson = $eventos->toJson();
        // dd( $puestos );
        return view( 'mtq.calendario', compact('eventosJson'));
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
        //
        $events = $request->all();
        dd($events);
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
        //
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
}
