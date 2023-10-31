<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\facturaProvedor;
use App\Models\proveedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class facturaProvedorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $id = $request->input('id');
        // dd($id);
        abort_if(Gate::denies('catalogos_index'), 403);

        $records = facturaProvedor::orderBy('nombre', 'asc')->where('provedorId', $id)->paginate(15);

        return view('facturasProvedores.indexFacturaProvedor', compact('records', 'id'));
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
        $provedorSelected = proveedor::select('nombre', 'comentario', 'colonia', 'ciudad', 'estado', 'id')
            ->where('id', '=', $id)
            ->first();

        $provedor = proveedor::all();
        // dd($provedor);
        return view('facturasProvedores.altaDeFacturaProvedor', compact('provedor', 'id', 'provedorSelected'));
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
