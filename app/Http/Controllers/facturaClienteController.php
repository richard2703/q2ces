<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\clientes;
use App\Models\facturaCliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class facturaClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // dd($request);
        abort_if(Gate::denies('catalogos_index'), 403);
        $id = $request->input('id');
        // dd($id);
        $records = facturaCliente::join('clientes', 'facturaCliente.clienteId', 'clientes.id')
            ->select('facturaCliente.*', 'clientes.nombre as cliente_nombre')->orderBy('facturaCliente.created_at', 'desc')->where('facturaCliente.clienteId', $id)->paginate(15);

        // dd($records);
        return view('facturasClientes.indexFacturaCliente', compact('records', 'id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $id = $request->query('id');
        // dd($id);
        $clienteSelected = clientes::select('nombre', 'colonia', 'ciudad', 'estado', 'id')
            ->where('id', '=', $id)
            ->first();

        $cliente = clientes::all();
        dd($clienteSelected);
        return view('facturasClientes.altaDeFacturaCliente', compact('cliente', 'id', 'clienteSelected'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function update(Request $request, $id)
    {
        //
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
