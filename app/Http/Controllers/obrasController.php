<?php

namespace App\Http\Controllers;

use App\Models\obras;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use App\Helpers\Validaciones;



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
        $obras = obras::orderBy('created_at', 'desc')->paginate(5);
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

        $request->validate([
            'nombre' => 'required|max:250',
            'calle' => 'nullable|max:250',
            'numero' => 'nullable|max:20',
            'colonia' => 'nullable|max:200',
            'cp' => 'nullable|max:99999|numeric',
            'ciudad' => 'nullable|max:200',
            'estado' => 'nullable|max:200',
        ], [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'nombre.max' => 'El campo nombre excede el límite de caracteres permitidos.',
            'calle.max' => 'El campo calle excede el límite de caracteres permitidos.',
            'numero.max' => 'El campo número excede el límite de caracteres permitidos.',
            'colonia.max' => 'El campo colonia excede el límite de caracteres permitidos.',
            'cp.numeric' => 'El campo código postal debe de ser numérico.',
            'cp.min' => 'El campo código postal requiere de al menos 5 caracteres.',
            'cp.max' => 'El campo código postal excede el límite de caracteres permitidos.',
            'ciudad.max' => 'El campo localidad excede el límite de caracteres permitidos.',
            'estado.max' => 'El campo estado excede el límite de caracteres permitidos.',
        ]);
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
        Session::flash('message', 1);

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
        // dd($obras);
        return view('obra.detalleObra', compact('obras'));
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
        $request->validate([
            'nombre' => 'required|max:250',
            'calle' => 'nullable|max:250',
            'numero' => 'nullable|max:20',
            'colonia' => 'nullable|max:200',
            'cp' => 'nullable|max:99999|numeric',
            'ciudad' => 'nullable|max:200',
            'estado' => 'nullable|max:200',
        ], [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'nombre.max' => 'El campo nombre excede el límite de caracteres permitidos.',
            'calle.max' => 'El campo calle excede el límite de caracteres permitidos.',
            'numero.max' => 'El campo número excede el límite de caracteres permitidos.',
            'colonia.max' => 'El campo colonia excede el límite de caracteres permitidos.',
            'cp.numeric' => 'El campo código postal debe de ser numérico.',
            'cp.min' => 'El campo código postal requiere de al menos 5 caracteres.',
            'cp.max' => 'El campo código postal excede el límite de caracteres permitidos.',
            'ciudad.max' => 'El campo localidad excede el límite de caracteres permitidos.',
            'estado.max' => 'El campo estado excede el límite de caracteres permitidos.',
        ]);

         $data = $request->only( 
            'nombre', 
            'calle',
            'numero',
            'colonia',
            'estado',
            'ciudad',
            'cp', 
            'foto', 
            'logo', 
        );

        if ($request->hasFile("logo")) {
            $data['logo'] = time() . '_' . 'logo.' . $request->file('logo')->getClientOriginalExtension();
            $request->file('logo')->storeAs('/public/obras', $data['logo']);
        }
        if ($request->hasFile("foto")) {
            $data['foto'] = time() . '_' . 'foto.' . $request->file('foto')->getClientOriginalExtension();
            $request->file('foto')->storeAs('/public/obras', $data['foto']);
        }
        $obras->update($data); 
        Session::flash('message', 1);

        return redirect()->route('obras.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\obras  $obras
     * @return \Illuminate\Http\Response
     */
    public function destroy(obras $obras)
    {
        return redirect()->back()->with('failed', 'No se puede eliminar');
    }
}
