<?php

namespace App\Http\Controllers;

use App\Models\maquinaria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class maquinariaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $maquinaria = maquinaria::paginate(5);
        // dd('test');
        return view('maquinaria.indexMaquinaria', compact('maquinaria'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('maquinaria.altademaquinaria');
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
        $maquinaria = $request->all();
        // $maquinaria = maquinaria::create($maquinaria);
        Session::flash('message', 1);
        return redirect()->route('maquinaria.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\maquinaria  $maquinaria
     * @return \Illuminate\Http\Response
     */
    public function show(maquinaria $maquinaria)
    {
        return view('maquinaria.detalleMaquinaria', compact('maquinaria'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\maquinaria  $maquinaria
     * @return \Illuminate\Http\Response
     */
    public function edit(maquinaria $maquinaria)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\maquinaria  $maquinaria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, maquinaria $maquinaria)
    {
        $data = $request->all();
        $maquinaria->update($data);
        Session::flash('message', 1);

        return redirect()->route('maquinaria.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\maquinaria  $maquinaria
     * @return \Illuminate\Http\Response
     */
    public function destroy(maquinaria $maquinaria)
    {
        //
    }
}
