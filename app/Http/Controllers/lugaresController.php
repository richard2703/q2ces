<?php

namespace App\Http\Controllers;

use App\Models\lugares;
use App\Models\ubicaciones;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class lugaresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lugares = lugares::orderBy('created_at', 'desc')->paginate(10);
        $ubicacion = ubicaciones::all();
        return view('catalogos.indexLugares', compact('lugares', 'ubicacion'));
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

        $lugares = $request->all();
        if ((isset($request->check) && $request->check == 'on')) {
            $lugares['activo'] = 1;
        }else{
            $lugares['activo'] = 0;
        }
        // dd( $lugares );
        
        lugares::create($lugares);
        Session::flash('message', 1);

        return redirect()->route('lugares.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\lugares  $lugares
     * @return \Illuminate\Http\Response
     */
    public function show(lugares $lugares)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\lugares  $lugares
     * @return \Illuminate\Http\Response
     */
    public function edit(lugares $lugares)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\lugares  $lugares
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, lugares $lugares)
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

        $lugares = lugares::where('id', $data['controlId'])->first();
        if ((isset($request->check) && $request->check == 'on')) {
            $lugares['activo'] = 1;
        }else{
            $lugares['activo'] = 0;
        }
        if (is_null($lugares) == false) {
            // dd( $data );
            $lugares->update($data);
            Session::flash('message', 1);
        }

        return redirect()->route('lugares.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\lugares  $lugares
     * @return \Illuminate\Http\Response
     */
    public function destroy(lugares $lugares)
    {
        //
    }
}
