<?php

namespace App\Http\Controllers;

use App\Models\inventario;
use App\Models\personal;
use App\Models\restock;
use App\Models\invconsu;
use App\Models\carga;
use App\Models\descarga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use App\Helpers\Validaciones;
use App\Models\maquinaria;

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
        if ($tipo == 'combustible') {

            $personal = personal::all();
            $maquinaria = maquinaria::all();

            return view('inventario.dashCombustible', compact('personal', 'maquinaria'));
        } else {
            $inventarios = inventario::where("tipo",  $tipo)->orderBy('created_at', 'desc')->paginate(5);
            return view('inventario.indexInventario', compact('inventarios'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
        $vctDesde = maquinaria::all();
        $vctHasta = maquinaria::all();
        // dd($vctDesde);
        $inventario = inventario::where("id", $inventario->id)->first();
        return view('inventario.detalleInventario', compact('inventario', 'vctDesde', 'vctHasta'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\inventario  $inventario
     * @return \Illuminate\Http\Response
     */
    public function edit(inventario $inventario)
    {
        $inventario = inventario::where("id", $inventario->id)->first();
        // dd($inventario);
        return view('inventario.detalleInventario', compact('inventario'));
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
        // dd($inventario);

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
        $data = $request->only(
            'nombre',
            'marca',
            'modelo',
            'proveedor',
            'numparte',
            'cantidad',
            'valor',
            'reorden',
            'maximo',
            'tipo',
        );

        if ($request->hasFile("imagen")) {
            $data['imagen'] = time() . '_' . 'imagen.' . $request->file('imagen')->getClientOriginalExtension();
            $request->file('imagen')->storeAs('/public/inventario', $data['imagen']);
        }

        $inventario->update($data);

        Session::flash('message', 1);
        // dd($request);
        return redirect()->route('inventario.index', $inventario->tipo);
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

    /**
     * Agrega mas stock a un producto, crea registro y actualiza el inventario del mismo
     *
     * @param Request $request
     * @return void
     */
    public function restock(Request $request)
    {
        // dd($request);
        $restock = $request->only(
            'productoid',
            'cantidad',
            'costo'
        );

        //*** existe el producto en inventario */
        $producto = inventario::where("id", $request['productoid'])->first();

        if ($producto) {
            //*** creamos el registro del stock */
            $restock = restock::create($restock);

            $producto->cantidad = ($producto->cantidad + $restock->cantidad);
            $producto->save();
            Session::flash('message', 1);
            return redirect()->route('inventario.index', $producto->tipo);
        } else {
            Session::flash('message', 0);
            return redirect()->back()->with('failed', 'No se encuentra en el inventario!');
        }
    }

    /**
     * Crea el registro de movimiento de producto
     *
     * @param Request $request
     * @return void
     */
    public function mover(Request $request)
    {
        $invconsu = $request->only(
            'productoId',
            'cantidad',
            'tipo',
            'desde',
            'hasta',
            'comentarios'
        );
        // dd($request);

        //*** creamos el registro del movimiento */
        $invconsu = invconsu::create($invconsu);

        if ($request['productoTipo'] == 'consumibles' || $request['tipo'] == 'desechar') {

            //*** existe el producto en inventario */
            $producto = inventario::where("id", $request['productoId'])->first();
            if ($producto) {
                $producto->cantidad = ($producto->cantidad - $request['cantidad']);
                $producto->save();
            } else {
                Session::flash('message', 0);
                return redirect()->back()->with('failed', 'No se encuentra en el inventario!');
            }
        }
        Session::flash('message', 1);
        return redirect()->route('inventario.show', $invconsu->productoId);
    }


    /**
     * Captura de movimientos de combustible
     *
     * @return void
     */
    public function dashCombustible()
    {
        dd('Hola');
    }

    /**
     * Realiza la carga y registro de combustible
     *
     * @param Request $request
     * @return void
     */
    public function cargaCombustible(Request $request)
    {
        $carga = $request->only(
            'litros',
            'maquinariaId',
            'operadorId',
            'precio',
        );

        carga::create($carga);
        Session::flash('message', 1);
        return view('inventario.dashInventario');
    }

    /**
     * Realiza la descarga y registro de combustible
     *
     * @param Request $request
     * @return void
     */
    public function descargaCombustible(Request $request)
    {
        $descarga = $request->only(
            'horas',
            'km',
            'imgKm',
            'imgHoras',
            'litros',
            'maquinariaId',
            'operadorId',
            'receptorId',
            'servicioId',
        );

        // dd($request);

        // if ($request->hasFile("imgKm")) {
        //     $ruta['imgKm'] = time() . '_' . 'imgKm.' . $request->file('ruta')->getClientOriginalExtension();
        //     $request->file('imgKm')->storeAs('/public/inventario/combustibles', $ruta['imgKm']);
        // }

        descarga::create($descarga);
        Session::flash('message', 1);
        return view('inventario.dashInventario');
    }
}
