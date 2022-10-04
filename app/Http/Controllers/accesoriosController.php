<?php

namespace App\Http\Controllers;

use App\Models\accesorios;
use Illuminate\Http\Request;

class accesoriosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $accesorios = accesorios::paginate(5);
        return view('accesorios.indexAccesorios', compact('accesorios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('accesorios.altaDeAccesorios');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $accesorio = $request->only(
            'nombre',
            'marca',
            'modelo',
            'color',
            'serie',
            'ano',
            'foto'
        );
        if ($request->hasFile("foto")) {
            $accesorio['foto'] = time() . '_' . 'foto.' . $request->file('foto')->getClientOriginalExtension();
            $request->file('foto')->storeAs('/public/accesorio', $accesorio['foto']);
        }
        $accesorio = accesorios::create($accesorio);
        return redirect()->route('accesorios.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\accesorios  $accesorios
     * @return \Illuminate\Http\Response
     */
    public function show(accesorios $accesorios)
    {
        return view('accesorios.detalleAccesorios', compact('accesorios'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\accesorios  $accesorios
     * @return \Illuminate\Http\Response
     */
    public function edit(accesorios $accesorios)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\accesorios  $accesorios
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, accesorios $accesorios)
    {
        $data = $request->only(
            'nombre',
            'marca',
            'modelo',
            'color',
            'serie',
            'ano',
            'foto'
        );
        if ($request->hasFile("foto")) {
            $accesorio['foto'] = time() . '_' . 'foto.' . $request->file('foto')->getClientOriginalExtension();
            $request->file('foto')->storeAs('/public/accesorio', $accesorio['foto']);
        }
        $accesorios->update($data);
        return redirect()->route('accesorios.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\accesorios  $accesorios
     * @return \Illuminate\Http\Response
     */
    public function destroy(accesorios $accesorios)
    {
        //
    }
}
