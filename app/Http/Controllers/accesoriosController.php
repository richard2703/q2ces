<?php

namespace App\Http\Controllers;

use App\Models\accesorios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;



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
        // dd('test');        
        $request->validate([
            'nombre' => 'required|max:250',
            'modelo' => 'nullable|max:200',
            'marca' => 'nullable|max:200',
            'serie' => 'nullable|max:200',
            'ano' => 'nullable|max:9999|numeric',
            'color' => 'nullable|max:200',
        ], [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'nombre.max' => 'El campo nombre excede el límite de caracteres permitidos.',
            'modelo.max' => 'El campo modelo excede el límite de caracteres permitidos.',
            'marca.max' => 'El campo marca excede el límite de caracteres permitidos.',
            'ano.numeric' => 'El campo año debe ser numérico.',
            'ano.max' => 'El campo serie excede el límite de caracteres permitidos.',
            'ano.min' => 'El campo año requiere de al menos 4 caracteres.',
            'color.max' => 'El campo color excede el límite de caracteres permitidos.',
        ]);
        $accesorio = $request->only(
            'nombre',
            'marca',
            'modelo',
            'color',
            'serie',
            'ano',
            'foto'
        );
        $accesorio['serie'] = strtoupper($accesorio['serie']);

        if ($request->hasFile("foto")) {
            $accesorio['foto'] = time() . '_' . 'foto.' . $request->file('foto')->getClientOriginalExtension();
            $request->file('foto')->storeAs('/public/accesorio', $accesorio['foto']);
        }
        $accesorio = accesorios::create($accesorio);
        Session::flash('message', 1);
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
        return view('accesorios.detalleAccesorios', compact('accesorios'));
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
        $request->validate([
            'nombre' => 'required|max:250',
            'modelo' => 'nullable|max:200',
            'marca' => 'nullable|max:200',
            'serie' => 'nullable|max:200',
            'ano' => 'nullable|max:9999|numeric',
            'color' => 'nullable|max:200',
        ], [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'nombre.max' => 'El campo nombre excede el límite de caracteres permitidos.',
            'modelo.max' => 'El campo modelo excede el límite de caracteres permitidos.',
            'marca.max' => 'El campo marca excede el límite de caracteres permitidos.',
            'ano.numeric' => 'El campo año debe ser numérico.',
            'ano.max' => 'El campo serie excede el límite de caracteres permitidos.',
            'ano.min' => 'El campo año requiere de al menos 4 caracteres.',
            'color.max' => 'El campo color excede el límite de caracteres permitidos.',
        ]);
        $data = $request->only(
            'nombre',
            'marca',
            'modelo',
            'color',
            'serie',
            'ano',
            'foto'
        );

        $data['serie'] = strtoupper($data['serie']);

        if ($request->hasFile("foto")) {
            $data['foto'] = time() . '_' . 'foto.' . $request->file('foto')->getClientOriginalExtension();
            $request->file('foto')->storeAs('/public/accesorio', $data['foto']);
        }

        $accesorios->update($data);
        Session::flash('message', 1);
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
        return redirect()->back()->with('failed', 'No se puede eliminar');
    }
}
