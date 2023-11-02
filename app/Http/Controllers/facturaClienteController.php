<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\clientes;
use App\Models\facturaCliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;

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
            ->select('facturaCliente.*', 'clientes.nombre as cliente_nombre')->orderBy('facturaCliente.fecha', 'desc')->where('facturaCliente.clienteId', $id)->paginate(15);

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
        // dd($clienteSelected);
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
        // $newFacturacliente = residente::create($record);

        // dd($request);
        $producto = $request->all();
        for ($i = 0; $i < count($request['factura']['folio']); $i++) {

            if ($request['factura']['folio'][$i]) {
                $objFacturaCliente = new facturaCliente();
                $objFacturaCliente->userId = $request['userId'];
                $objFacturaCliente->clienteId = $request['clienteId'];
                $objFacturaCliente->folio = $request['factura']['folio'][$i];
                $objFacturaCliente->fecha = $request['factura']['fecha'][$i];
                $objFacturaCliente->pdf = isset($request['factura']['pdf'][$i]) && $request['factura']['pdf'][$i] !== null
                    ? time() . '_' . 'pdf.' . $request['factura']['pdf'][$i]->getClientOriginalExtension()
                    : null;

                $objFacturaCliente->xml = isset($request['factura']['xml'][$i]) && $request['factura']['xml'][$i] !== null
                    ? time() . '_' . 'xml.' . $request['factura']['xml'][$i]->getClientOriginalExtension()
                    : null;

                $objFacturaCliente->save();
            }
            if (isset($request['factura']['pdf'][$i])) {
                $producto['factura']['pdf'][$i] = time() . '_' . 'pdf.' . $request['factura']['pdf'][$i]->getClientOriginalExtension();
                $request['factura']['pdf'][$i]->storeAs('/public/cliente/' . $objFacturaCliente->clienteId . '/facturas/',  $producto['factura']['pdf'][$i]);
            } else {
                // No se subió ningún archivo en la posición $i del array
            }
            if (isset($request['factura']['xml'][$i])) {
                $producto['factura']['xml'][$i] = time() . '_' . 'xml.' . $request['factura']['xml'][$i]->getClientOriginalExtension();
                $request['factura']['xml'][$i]->storeAs('/public/cliente/' . $objFacturaCliente->clienteId . '/facturas/',  $producto['factura']['xml'][$i]);
            } else {
                // No se subió ningún archivo en la posición $i del array
            }
        }

        Session::flash('message', 1);
        $id = $request->clienteId;
        return redirect()->route('facturaCliente.index', ['id' => $id]);
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
        $facturaCliente = facturaCliente::where('id', $id)->get();
        $readonly = false;
        $cliente = clientes::all();

        return view('facturasClientes.detalleDeFacturaCliente', compact('facturaCliente', 'cliente', 'readonly', 'id'));
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
        // $request->validate([
        //     'nombre' => 'required|max:250',
        // ], [
        //     'nombre.required' => 'El campo nombre es obligatorio.',
        //     'nombre.max' => 'El campo título excede el límite de caracteres permitidos.',
        // ]);
        $data = $request->all();

        $record = facturaCliente::where('id', $id)->first();
        if (isset($request['pdf'])) {
            $data['pdf'] = time() . '_' . 'pdf.' . $request['pdf']->getClientOriginalExtension();
            $request['pdf']->storeAs('/public/cliente/' . $request['clienteId'] . '/facturas/',  $data['pdf']);
        } else {
            // No se subió ningún archivo en la posición $i del array
        }
        if (isset($request['xml'])) {
            $data['xml'] = time() . '_' . 'xml.' . $request['xml']->getClientOriginalExtension();
            $request['xml']->storeAs('/public/cliente/' . $request['clienteId'] . '/facturas/',  $data['xml']);
        } else {
            // No se subió ningún archivo en la posición $i del array
        }

        if ($request['eliminarArchivoXML'] != null) {
            $data['xml'] = null;
            // $request['xml']->storeAs('/public/cliente/' . $request['clienteId'] . '/facturas/',  $data['xml']);
        } else {
            // No se subió ningún archivo en la posición $i del array
        }

        if ($request['eliminarArchivo'] != null) {
            $data['pdf'] = null;
            // $request['xml']->storeAs('/public/cliente/' . $request['clienteId'] . '/facturas/',  $data['xml']);
        } else {
            // No se subió ningún archivo en la posición $i del array
        }

        $record->update($data);

        Session::flash('message', 1);

        return redirect()->route('facturaCliente.index', ['id' => $request['clienteId']]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $facturaCliente = facturaCliente::select("*")->where('id', '=', $id)->first();
        $facturaCliente->delete();

        Session::flash('message', 1);
        return redirect()->route('facturaCliente.index', ['id' => $facturaCliente->clienteId]);
    }
}
