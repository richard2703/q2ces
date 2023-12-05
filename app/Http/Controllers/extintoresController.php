<?php

namespace App\Http\Controllers;

use App\Models\extintores;
use App\Http\Controllers\Controller;
use App\Models\lugares;
use App\Models\maquinaria;
use App\Models\ubicaciones;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class extintoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $extintores = extintores::orderBy('created_at', 'desc')->paginate(15);
        $ubicaciones = ubicaciones::all()->sortBy('nombre');
        return view('extintores.indexExtintores', compact('extintores', 'ubicaciones'));
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
        // dd($request);
        $extintor = $request->all();
        if ($request->ubicacionId == 1) {
            $extintor['lugarId'] = null;
            $extintor['maquinariaId'] = $request->lugarId;
        }
        $extintor = extintores::create($extintor);
        Session::flash('message', 1);
        return redirect()->action([extintoresController::class, 'index']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\extintores  $extintores
     * @return \Illuminate\Http\Response
     */
    public function show(extintores $extintores)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\extintores  $extintores
     * @return \Illuminate\Http\Response
     */
    public function edit(extintores $extintores)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\extintores  $extintores
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, extintores $extintores)
    {
        // dd($request);
        $data = $request->all();
        $extintor = extintores::where('id', $request->id)->first();
        if ($request->ubicacionId == 1) {
            $extintor->lugarId = null;
            $extintor->maquinariaId = $request->lugarId;
        }
        $extintor->update($data);

        Session::flash('message', 1);
        return redirect()->action([extintoresController::class, 'index']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\extintores  $extintores
     * @return \Illuminate\Http\Response
     */
    public function destroy(extintores $extintores)
    {
        //
    }


    public function lugares($ubicacionId)
    {
        if ($ubicacionId == 1) {
            $data =  maquinaria::select('id', 'nombre')
                ->get();
        } else {
            $data =  lugares::orderby("nombre", "asc")
                ->select('id', 'nombre')
                ->where('ubicacionId', $ubicacionId)
                ->get();
        }
        // dd($data);
        return response()->json($data);
    }
}
