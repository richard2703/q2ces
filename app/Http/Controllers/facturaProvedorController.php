<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\facturaProvedor;
use App\Models\proveedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;

class facturaProvedorController extends Controller
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
        $records = facturaProvedor::join('proveedor', 'facturaProvedor.provedorId', 'proveedor.id')
            ->select('facturaProvedor.*', 'proveedor.nombre as provedor_nombre')->orderBy('facturaProvedor.created_at', 'desc')->where('facturaProvedor.provedorId', $id)->paginate(15);

        // dd($records);
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
        // $request->validate([
        //     'nombre' => 'required|max:250',
        //     'comentario' => 'nullable|max:500',
        // ], [
        //     'nombre.required' => 'El campo nombre es obligatorio.',
        //     'nombre.max' => 'El campo título excede el límite de caracteres permitidos.',
        //     'comentario.max' => 'El campo comentarios excede el límite de caracteres permitidos.',
        // ]);
        // $record = $request->all();

        // $record['clienteId'] = 2;
        // $newFacturaProvedor = residente::create($record);

        // dd($request);
        $producto = $request->all();
        for ($i = 0; $i < count($request['factura']['folio']); $i++) {

            if ($request['factura']['folio'][$i]) {
                $objFacturaProvedor = new facturaProvedor();
                $objFacturaProvedor->userId = $request['userId'];
                $objFacturaProvedor->provedorId = $request['provedorId'];
                $objFacturaProvedor->folio = $request['factura']['folio'][$i];
                $objFacturaProvedor->fecha = $request['factura']['fecha'][$i];
                $objFacturaProvedor->pdf = isset($request['factura']['pdf'][$i]) && $request['factura']['pdf'][$i] !== null
                    ? time() . '_' . 'pdf.' . $request['factura']['pdf'][$i]->getClientOriginalExtension()
                    : null;

                $objFacturaProvedor->xml = isset($request['factura']['xml'][$i]) && $request['factura']['xml'][$i] !== null
                    ? time() . '_' . 'xml.' . $request['factura']['xml'][$i]->getClientOriginalExtension()
                    : null;

                $objFacturaProvedor->save();
            }
            if (isset($request['factura']['pdf'][$i])) {
                $producto['factura']['pdf'][$i] = time() . '_' . 'pdf.' . $request['factura']['pdf'][$i]->getClientOriginalExtension();
                $request['factura']['pdf'][$i]->storeAs('/public/provedor/' . $objFacturaProvedor->provedorId . '/facturas/',  $producto['factura']['pdf'][$i]);
            } else {
                // No se subió ningún archivo en la posición $i del array
            }
            if (isset($request['factura']['xml'][$i])) {
                $producto['factura']['xml'][$i] = time() . '_' . 'xml.' . $request['factura']['xml'][$i]->getClientOriginalExtension();
                $request['factura']['xml'][$i]->storeAs('/public/provedor/' . $objFacturaProvedor->provedorId . '/facturas/',  $producto['factura']['xml'][$i]);
            } else {
                // No se subió ningún archivo en la posición $i del array
            }
        }

        Session::flash('message', 1);
        $id = $request->provedorId;
        return redirect()->route('facturaProvedor.index', ['id' => $id]);
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
        abort_if(Gate::denies('maquinaria_edit'), '403');
        $facturaProvedor = facturaProvedor::where('id', $id)->get();
        $readonly = false;
        $provedor = proveedor::all();

        return view('facturasProvedores.detalleDeFacturaProvedor', compact('facturaProvedor', 'provedor', 'readonly', 'id'));
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

        abort_if(Gate::denies('catalogos_edit'), 403);

        // dd($request, $id);

        // $request->validate([
        //     'nombre' => 'required|max:250',
        // ], [
        //     'nombre.required' => 'El campo nombre es obligatorio.',
        //     'nombre.max' => 'El campo título excede el límite de caracteres permitidos.',
        // ]);
        $data = $request->all();

        $record = facturaProvedor::where('id', $id)->first();
        if (isset($request['pdf'])) {
            $data['pdf'] = time() . '_' . 'pdf.' . $request['pdf']->getClientOriginalExtension();
            $request['pdf']->storeAs('/public/provedor/' . $request['provedorId'] . '/facturas/',  $data['pdf']);
        } else {
            // No se subió ningún archivo en la posición $i del array
        }
        if (isset($request['xml'])) {
            $data['xml'] = time() . '_' . 'xml.' . $request['xml']->getClientOriginalExtension();
            $request['xml']->storeAs('/public/provedor/' . $request['provedorId'] . '/facturas/',  $data['xml']);
        } else {
            // No se subió ningún archivo en la posición $i del array
        }

        $record->update($data);

        Session::flash('message', 1);

        return redirect()->route('facturaProvedor.index', ['id' => $request['provedorId']]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $facturaProvedor = facturaProvedor::select("*")->where('id', '=', $id)->first();
        $facturaProvedor->delete();

        Session::flash('message', 1);
        return redirect()->route('facturaProvedor.index', ['id' => $facturaProvedor->provedorId]);
    }
}
