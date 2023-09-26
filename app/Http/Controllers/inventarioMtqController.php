<?php

namespace App\Http\Controllers;

use App\Models\inventarioMtq;
use App\Http\Controllers\Controller;
use App\Models\inventarioMovimientosMtq;
use App\Models\maquinaria;
use App\Models\marca;
use App\Models\proveedor;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class inventarioMtqController extends Controller
{

    public function dash()
    {
        // abort_if(Gate::denies('inventario_index'), 403);

        return view('MTQ.inventarioDashMtq');
    }

    public function index($tipo)
    {
        $inventarios = inventarioMtq::where("tipo",  $tipo)->orderBy('created_at', 'desc')->paginate(15);
        // dd($inventarios);
        return view('MTQ.indexInventarioMtq', compact('inventarios', 'tipo'));

        dd('index inventarioMtq.index');
    }

    public function create($tipo)
    {
        abort_if(Gate::denies('inventario_create'), 403);

        // $vctTipos = tipoUniforme::all();
        $vctMarcas = marca::all();
        $vctProveedores = proveedor::all();

        return view('MTQ.inventarioNuevoMtq', compact('tipo', 'vctMarcas', 'vctProveedores'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd('store,');
        $producto = $request->all();

        if ($request->hasFile("imagen")) {
            $producto['imagen'] = time() . '_' . 'imagen.' . $request->file('imagen')->getClientOriginalExtension();
            $request->file('imagen')->storeAs('/public/inventario/' . $producto['tipo'], $producto['imagen']);
        }

        $objProducto = inventarioMtq::create($producto);

        if ($objProducto->id > 0) {
            $objMovimiento = new inventarioMovimientosMtq();
            $objMovimiento->movimiento = 1; //*** agrega al inventario */
            $objMovimiento->inventarioId = $objProducto->id;
            $objMovimiento->cantidad = $objProducto->cantidad;
            $objMovimiento->precioUnitario = $objProducto->valor;
            $objMovimiento->total = ($objProducto->valor * $objProducto->cantidad);
            $objMovimiento->usuarioId = $request['usuarioId'];
            $objMovimiento->Save();
        }

        Session::flash('message', 1);

        return redirect()->route('inventarioMtq.index', $producto['tipo']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\inventarioMtq  $inventarioMtq
     * @return \Illuminate\Http\Response
     */
    public function show(inventarioMtq $inventario)
    {
        // dd($inventario);
        $vctDesde = maquinaria::all();
        $vctHasta = maquinaria::all();
        $vctMarcas = marca::all();
        $vctProveedores = proveedor::all();
        $vctMaquinaria = maquinaria::all();
        // dd($vctDesde);
        $inventario = inventarioMtq::where("id", $inventario->id)->first();
        // dd($inventario);

        return view('MTQ.detalleInventarioMtq ', compact('inventario', 'vctDesde', 'vctHasta', 'vctMarcas', 'vctProveedores', 'vctMaquinaria'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\inventarioMtq  $inventarioMtq
     * @return \Illuminate\Http\Response
     */
    public function edit(inventarioMtq $inventarioMtq)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\inventarioMtq  $inventarioMtq
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, inventarioMtq $inventario)
    {
        $data = $request->all();

        if ($request->hasFile("imagen")) {
            $data['imagen'] = time() . '_' . 'imagen.' . $request->file('imagen')->getClientOriginalExtension();
            $request->file('imagen')->storeAs('/public/inventario/' . $data['tipo'], $data['imagen']);
        }

        $inventario->update($data);

        Session::flash('message', 1);
        // dd($request);
        return redirect()->route('inventarioMtq.index', $inventario->tipo);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\inventarioMtq  $inventarioMtq
     * @return \Illuminate\Http\Response
     */
    public function destroy(inventarioMtq $inventarioMtq)
    {
        //
    }
}
