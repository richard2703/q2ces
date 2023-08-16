<?php

namespace App\Http\Controllers;

use App\Models\usoMaquinarias;
use App\Http\Controllers\Controller;
use App\Models\maquinaria;
use Illuminate\Http\Request;

class usoMaquinariasController extends Controller
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
        // dd('create')
        $maquinaria = maquinaria::where('compania', 'mtq')->get();
        // dd($maquinaria);
        return view('mtq.createUsoMaquinariaMtq', compact('maquinaria'));
    }
    // "kilometraje" => null
    // "kom" => null
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        for ($i = 0; $i < count($request['id']); $i++) {
            if ($request['valor'][$i] != '' || $request['valor'][$i] != null) {
                $maquina  = maquinaria::find($request['id'][$i]);
                $objUso = new usoMaquinarias();
                $objUso->maquinariaId  = $request['id'][$i];
                $objUso->anterior  = $maquina->kilometraje;
                $objUso->uso = $request['valor'][$i];
                $objUso->comentario = null;
                $objUso->foto = null;
                $objUso->save();
                $maquina->kilometraje = $request['valor'][$i];
                $maquina->save();
            }
        }
        return redirect()->action([maquinariaMtqController::class, 'uso']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\usoMaquinarias  $usoMaquinarias
     * @return \Illuminate\Http\Response
     */
    public function show(usoMaquinarias $usoMaquinarias)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\usoMaquinarias  $usoMaquinarias
     * @return \Illuminate\Http\Response
     */
    public function edit(usoMaquinarias $usoMaquinarias)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\usoMaquinarias  $usoMaquinarias
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, usoMaquinarias $usoMaquinarias)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\usoMaquinarias  $usoMaquinarias
     * @return \Illuminate\Http\Response
     */
    public function destroy(usoMaquinarias $usoMaquinarias)
    {
        //
    }
}
