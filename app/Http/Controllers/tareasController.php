<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\tareas;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use App\Helpers\Validaciones;
use App\Helpers\Calculos;

class tareasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        dd('Todas las tareas...');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        dd('para crear...');
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
            'titulo' => 'required|max:250',
            'comentarios' => 'nullable|max:500',
            // 'modelo' => 'nullable|max:250',
            // 'proveedor' => 'nullable|max:200',
            // 'numparte' => 'nullable|max:250',
            // 'cantidad' => 'required|numeric',
            // 'valor' => 'required|numeric',
            // 'reorden' => 'nullable|numeric',
            // 'maximo' => 'nullable|numeric',
        ], [
            'titulo.required' => 'El campo nombre es obligatorio.',
            'titulo.max' => 'El campo título excede el límite de caracteres permitidos.',
            'comentarios.max' => 'El campo comentarios excede el límite de caracteres permitidos.',
            // 'marca.max' => 'El campo marca excede el límite de caracteres permitidos.',
            // 'modelo.max' => 'El campo modelo excede el límite de caracteres permitidos.',
            // 'proveedor.max' => 'El campo proveedor excede el límite de caracteres permitidos.',
            // 'cantidad.numeric' => 'El campo cantidad debe de ser numérico.',
            // 'valor.numeric' => 'El campo valor debe de ser numérico.',
            // 'reorden.numeric' => 'El campo valor debe de ser numérico.',
            // 'maximo.numeric' => 'El campo valor debe de ser numérico.',
        ]);
        $tarea = $request->all();

        // dd($tarea);

        tareas::create($tarea);
        Session::flash('message', 1);

        return redirect()->route('calendario.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        dd('para mostar la tarea ' . $id . '...');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        dd('para actualizar la tarea ' . $id . '...');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        dd('para actualizar la tarea  ...');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
