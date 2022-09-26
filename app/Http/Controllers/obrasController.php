<?php

namespace App\Http\Controllers;

use App\Models\obras;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class obrasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd('lista de obras');
        $obras = obras::paginate(5);
        return view('obra.indexObras', compact('obras'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('obra.altaObra');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        // $obra = obras::create($request->only('nombre', 'tipo', 'calle', 'numero', 'colonia', 'estado', 'ciudad', 'cp'));

        $obra = $request->all();
        if ($request->hasFile("logo")) {
            $obra['logo'] = time() . '_' . 'logo.' . $request->file('logo')->getClientOriginalExtension();
            $request->file('logo')->storeAs('/public/obras', $obra['logo']);
        }
        if ($request->hasFile("foto")) {
            $obra['foto'] = time() . '_' . 'foto.' . $request->file('foto')->getClientOriginalExtension();
            $request->file('foto')->storeAs('/public/obras', $obra['foto']);
        }
        $obra['estatus'] = 'Activa';
        obras::create($obra);
        return redirect()->route('obras.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\obras  $obras
     * @return \Illuminate\Http\Response
     */
    public function show(obras $obras)
    {
        // dd($obras->logo);
        return view('obra.vistaObra', compact('obras'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\obras  $obras
     * @return \Illuminate\Http\Response
     */
    public function edit(obras $obras)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\obras  $obras
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, obras $obras)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\obras  $obras
     * @return \Illuminate\Http\Response
     */
    public function destroy(obras $obras)
    {
        //
    }
}
