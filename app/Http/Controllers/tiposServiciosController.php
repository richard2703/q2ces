<?php

namespace App\Http\Controllers;

use App\Models\tiposServicios;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class tiposServiciosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //dd('jhijsa0');
        abort_if(Gate::denies('tipoServicios_index'), '404');
        $tiposServicios = tiposServicios::orderBy('created_at', 'desc')->paginate(10);
        return view('catalogos.indexTiposServicios', compact('tiposServicios'));
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
        $request->validate([
            'nombre' => 'required|max:250',
            'comentario' => 'nullable|max:500',
        ], [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'nombre.max' => 'El campo título excede el límite de caracteres permitidos.',
            'comentario.max' => 'El campo comentarios excede el límite de caracteres permitidos.',
        ]);

        $tiposServicios = $request->all();
        if ((isset($request->check) && $request->check == 'on')) {
            $tiposServicios['activo'] = 1;
        }else{
            $tiposServicios['activo'] = 0;
        }
        // dd( $tiposServicios );
        tiposServicios::create($tiposServicios);
        Session::flash('message', 1);

        return redirect()->route('tiposServicios.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\tiposServicios  $tiposServicios
     * @return \Illuminate\Http\Response
     */
    public function show(tiposServicios $tiposServicios)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\tiposServicios  $tiposServicios
     * @return \Illuminate\Http\Response
     */
    public function edit(tiposServicios $tiposServicios)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\tiposServicios  $tiposServicios
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, tiposServicios $tiposServicios)
    {
        $request->validate([
            'nombre' => 'required|max:250',
            'comentario' => 'nullable|max:500',
        ], [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'nombre.max' => 'El campo título excede el límite de caracteres permitidos.',
            'comentario.max' => 'El campo comentarios excede el límite de caracteres permitidos.',
        ]);
        $data = $request->all();

        $tipoServicio = tiposServicios::where('id', $data['controlId'])->first();
        if ((isset($request->check) && $request->check == 'on')) {
            $tipoServicio['activo'] = 1;
        }else{
            $tipoServicio['activo'] = 0;
        }
        if (is_null($tipoServicio) == false) {
            // dd( $data );
            $tipoServicio->update($data);
            Session::flash('message', 1);
        }

        return redirect()->route('tiposServicios.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\tiposServicios  $tiposServicios
     * @return \Illuminate\Http\Response
     */
    public function destroy(tiposServicios $tiposServicios)
    {
        //
    }
}
