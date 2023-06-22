<?php

namespace App\Http\Controllers;

use App\Models\conceptos;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Gate;

class conceptosController extends Controller
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
        abort_if(Gate::denies('cajachica_create'), 403);

        conceptos::create($request->only('codigo', 'nombre', 'comentario'));
        Session::flash('message', 1);
        return redirect()->action([cajachicaController::class, 'create']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\conceptos  $conceptos
     * @return \Illuminate\Http\Response
     */
    public function show(conceptos $conceptos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\conceptos  $conceptos
     * @return \Illuminate\Http\Response
     */
    public function edit(conceptos $conceptos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\conceptos  $conceptos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, conceptos $conceptos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\conceptos  $conceptos
     * @return \Illuminate\Http\Response
     */
    public function destroy(conceptos $conceptos)
    {
        //
    }
}
