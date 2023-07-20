<?php

namespace App\Http\Controllers;

use App\Models\clientes;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;


class clientesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(Gate::denies('cliente_index'), 403);
        $clientes = clientes::orderBy('created_at', 'desc')->paginate(5);
        return view('clientes.indexClientes', compact('clientes'));
        dd('clientes');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(Gate::denies('cliente_create'), 403);
        return view('clientes.altaCliente');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cliente = $request->all();
        $cliente['estatus'] = 'Activa';
        $cliente = clientes::create($cliente);

        $pathObra = str_pad($cliente->id, 4, '0', STR_PAD_LEFT);

        if ($request->hasFile('logo')) {
            $cliente->logo = time() . '_' . 'logo.' . $request->file('logo')->getClientOriginalExtension();
            $request->file('logo')->storeAs('/public/clientes/' . $pathObra, $cliente->logo);
            $cliente->save();
        }

        if ($request->hasFile('fiscal')) {
            $cliente->fiscal = time() . '_' . 'fiscal.' . $request->file('fiscal')->getClientOriginalExtension();
            $request->file('fiscal')->storeAs('/public/clientes/' . $pathObra, $cliente->fiscal);
            $cliente->save();
        }

        return redirect()->action([clientesController::class, 'index']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\clientes  $clientes
     * @return \Illuminate\Http\Response
     */
    public function show(clientes $clientes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\clientes  $clientes
     * @return \Illuminate\Http\Response
     */
    public function edit(clientes $cliente)
    {
        abort_if(Gate::denies('cliente_edit'), 403);
        // dd($cliente);
        return view('clientes.editCliente', compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\clientes  $clientes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, clientes $cliente)
    {
        // dd($cliente);
        $data = $request->all();
        /*** directorio contenedor de su información */
        $pathObra = str_pad($cliente->id, 4, '0', STR_PAD_LEFT);

        if ($request->hasFile('logo')) {
            $data['logo'] = time() . '_' . 'logo.' . $request->file('logo')->getClientOriginalExtension();
            $request->file('logo')->storeAs('/public/clientes/' . $pathObra, $data['logo']);
        }

        if ($request->hasFile('fiscal')) {
            $data['fiscal'] = time() . '_' . 'fiscal.' . $request->file('fiscal')->getClientOriginalExtension();
            $request->file('fiscal')->storeAs('/public/clientes/' . $pathObra, $data['fiscal']);
        }
        // dd($data);
        $cliente->update($data);

        return redirect()->action([clientesController::class, 'index']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\clientes  $clientes
     * @return \Illuminate\Http\Response
     */
    public function destroy(clientes $clientes)
    {
        //
    }
}
