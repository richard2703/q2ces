<?php

namespace App\Http\Controllers;

use App\Models\inventario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use App\Helpers\Validaciones;

class inventarioController extends Controller
{
    public function dash()
    {
        return view('inventario.dashInventario');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($tipo)
    {
        $inventarios = inventario::where("tipo",  $tipo)->orderBy('created_at', 'desc')->paginate(5);

        return view('inventario.indexInventario', compact('inventarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // dd('test');
        return view('inventario.inventarioNuevo');
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
            'marca' => 'nullable|max:250',
            'modelo' => 'nullable|max:250',
            'proveedor' => 'nullable|max:200',
            'numparte' => 'nullable|max:250',
            'cantidad' => 'required|numeric',
            'valor' => 'required|numeric',
            'reorden' => 'nullable|numeric',
            'maximo' => 'nullable|numeric',
        ], [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'nombre.max' => 'El campo nombre excede el límite de caracteres permitidos.',
            'marca.max' => 'El campo marca excede el límite de caracteres permitidos.',
            'modelo.max' => 'El campo modelo excede el límite de caracteres permitidos.',
            'proveedor.max' => 'El campo proveedor excede el límite de caracteres permitidos.',
            'numparte.max' => 'El campo número de parte excede el límite de caracteres permitidos.',
            'cantidad.numeric' => 'El campo cantidad debe de ser numérico.',
            'valor.numeric' => 'El campo valor debe de ser numérico.',
            'reorden.numeric' => 'El campo valor debe de ser numérico.',
            'maximo.numeric' => 'El campo valor debe de ser numérico.',
        ]);
        $producto = $request->all();

        if ($request->hasFile("imagen")) {
            $producto['imagen'] = time() . '_' . 'imagen.' . $request->file('imagen')->getClientOriginalExtension();
            $request->file('imagen')->storeAs('/public/inventario', $producto['imagen']);
        }

        inventario::create($producto);
        Session::flash('message', 1);

        return redirect()->route('inventario.index', $producto['tipo']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\inventario  $inventario
     * @return \Illuminate\Http\Response
     */
    public function show(inventario $inventario)
    {
        return view('inventario.detalleInventario');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\inventario  $inventario
     * @return \Illuminate\Http\Response
     */
    public function edit(inventario $inventario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\inventario  $inventario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, inventario $inventario)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\inventario  $inventario
     * @return \Illuminate\Http\Response
     */
    public function destroy(inventario $inventario)
    {
        return redirect()->back()->with('failed', 'No se puede eliminar');
    }
}
