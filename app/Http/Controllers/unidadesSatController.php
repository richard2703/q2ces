<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\unidadesSat;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;

class unidadesSatController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('catalogos_index'), '404');
        $unidadesSat = unidadesSat::orderBy('created_at', 'desc')->paginate(10);
        return view('catalogos.indexUnidadesSat', compact('unidadesSat'));
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
        $request->validate([
            'nombre' => 'required|max:250',
            'comentario' => 'nullable|max:500',
        ], [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'nombre.max' => 'El campo título excede el límite de caracteres permitidos.',
            'comentario.max' => 'El campo comentarios excede el límite de caracteres permitidos.',
        ]);

        $unidadesSat = $request->all();
        // dd( $unidadesSat );
        unidadesSat::create($unidadesSat);
        Session::flash('message', 1);

        return redirect()->route('unidadesSat.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        //
    }
    public function unidadesSatUpdate(Request $request)
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

        $tipoUnidad = unidadesSat::where('id', $data['controlId'])->first();
        if (is_null($tipoUnidad) == false) {
            // dd( $data );
            $tipoUnidad->update($data);
            Session::flash('message', 1);
        }
        // dd($tipoUnidad);
        return redirect()->route('unidadesSat.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($tiposUnidades)
    {
        $tipoUnidad = unidadesSat::where('id', $tiposUnidades)->first();
        try {
            $tipoUnidad->delete(); // Intenta eliminar 
        } catch (QueryException $e) {
            if ($e->getCode() === 23000) {
                return redirect()->back()->with('faild', 'No Puedes Eliminar');
                // Esto es un error de restricción de clave externa (FOREIGN KEY constraint)
                // Puedes mostrar un mensaje de error o realizar otras acciones aquí.
            } else {
                return redirect()->back()->with('faild', 'No Puedes Eliminar si esta en uso');
                // Otro tipo de error de base de datos
                // Maneja según sea necesario
            }
        }
        return redirect()->back()->with('success', 'Eliminado correctamente');
    }
}
