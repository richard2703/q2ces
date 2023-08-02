<?php

namespace App\Http\Controllers;

use App\Models\clientes;
use App\Http\Controllers\Controller;
use App\Models\residente;
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
        // dd($request['rEmail']);

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

        /*** registro de residentes */
        for ($i = 0; $i < count($request['rNombre']); $i++) {
            //*** se guarda solo si se selecciono una máquina */
            if ($request['rNombre'][$i] != '' || $request['rNombre'][$i] != null) {
                $objResidente = new residente();
                $objResidente->clienteId  = $cliente->id;
                $objResidente->nombre  = $request['rNombre'][$i];
                $objResidente->telefono = $request['rTelefono'][$i];
                // $objResidente->puesto = $request['rpuesto'][$i];
                $objResidente->email = $request['rEmail'][$i];
                $objResidente->save();
            }
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
        $residentes = residente::where('clienteId', $cliente->id)->get();
        // dd($residentes);
        return view('clientes.editCliente', compact('cliente', 'residentes'));
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

        ////////////////////////////////////////////////////////////////////////////
        //*** registro de residentes */
        // dd($request['idResidente']);
        $vctRegistrados = residente::where('clienteId', '=', $cliente->id)->pluck('id')->toArray();
        $vctArreglo = $request['idResidente'];

        //*** Preguntamos si existen registros en el arreglo */
        if (is_array($vctArreglo) && count($vctArreglo) > 0) {

            //** buscamos si el registrado esta en el arreglo, de no ser asi se elimina */
            if (is_array($vctRegistrados) && count($vctRegistrados) > 0) {
                for ($i = 0; $i < count($vctRegistrados); $i++) {
                    $intValor = (int) $vctRegistrados[$i];

                    if (in_array($intValor, $vctArreglo) == false) {
                        /*** no existe y se debe de eliminar */
                        residente::destroy($vctRegistrados[$i]);
                        // dd( 'Borrando por que se quito el residente' );
                    } else {
                        /*** existe el registro */
                        // dd( 'Sigue vivo en el arreglo' );
                    }
                }
            }

            //*** trabajamos el resto */
            for ($i = 0; $i < count($request['idResidente']); $i++) {
                if ($request['idResidente'][$i] != '') {
                    //** Actualizacion de registro */
                    $objResidente =  residente::where('id', '=', $request['idResidente'][$i])->first();

                    if ($objResidente && $objResidente->id > 0) {
                        $objResidente->clienteId  = $cliente->id;
                        $objResidente->nombre  = $request['rNombre'][$i];
                        $objResidente->telefono = $request['rTelefono'][$i];
                        $objResidente->email = $request['rEmail'][$i];
                        $objResidente->save();
                        // dd( 'Actualizando residente' );
                    }
                } else {

                    //** No existe en bd */
                    if ($request['rNombre'][$i] != '') {
                        $objResidente = new residente();
                        $objResidente->clienteId  = $cliente->id;
                        $objResidente->nombre  = $request['rNombre'][$i];
                        $objResidente->telefono = $request['rTelefono'][$i];
                        $objResidente->email = $request['rEmail'][$i];
                        $objResidente->save();
                        // dd( 'Guardando residente' );
                    }
                }
            }
        } else {
            //*** se deben de eliminar todos los registrados */
            if (is_array($vctRegistrados) && count($vctRegistrados) > 0) {
                for ($i = 0; $i < count($vctRegistrados); $i++) {
                    residente::destroy($vctRegistrados[$i]);
                    // dd( 'Borrando todo residente' );
                }
            }
        }

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
