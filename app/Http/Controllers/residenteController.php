<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\maquinaria;
use Illuminate\Http\Request;
use App\Models\residente;
use App\Models\obras;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class residenteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        // abort_if(Gate::denies('puesto_index'), 403);

        $records = residente::select(
            'residente.*',
            'obras.nombre AS obra',
            'maquinaria.identificador',
            'maquinaria.nombre AS auto'
        )
            ->leftjoin('obras', 'obras.id', '=', 'residente.obraId')
            ->leftjoin('maquinaria', 'maquinaria.id', '=', 'residente.autoId')
            ->where('residente.clienteId', '=', 2)
            ->orderBy('nombre', 'asc')->paginate(10);

        $vctObras = obras::where('estatus', 1)
            ->orderBy('nombre', 'asc')->get();
        // $vctObras = obras::all();

        $maquinaria = maquinaria::where('compania', 'mtq')
            ->where('residente.autoId', null)
            ->orWhere('residente.autoId', '')
            ->leftJoin('residente', 'residente.autoId', 'maquinaria.id')
            ->select('maquinaria.*')
            ->get();
        // dd($records);
        return view('MTQ.residentes', compact('records', 'vctObras', 'maquinaria'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        // abort_if(Gate::denies('catalogos_create'), 403);

        // dd( $request );
        $request->validate([
            'nombre' => 'required|max:250',
            'comentario' => 'nullable|max:500',
        ], [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'nombre.max' => 'El campo título excede el límite de caracteres permitidos.',
            'comentario.max' => 'El campo comentarios excede el límite de caracteres permitidos.',
        ]);
        $record = $request->all();

        $record['clienteId'] = 2; //*** el cliente 2 de MTQ */

        residente::create($record);
        Session::flash('message', 1);

        return redirect()->route('residentes.index');
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

        abort_if(Gate::denies('catalogos_edit'), 403);

        // dd($request);

        $request->validate([
            'nombre' => 'required|max:250',
        ], [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'nombre.max' => 'El campo título excede el límite de caracteres permitidos.',
        ]);
        $data = $request->all();

        $record = residente::where('id', $data['residenteId'])->first();
        if ($data['autoId'] == 0 && $data['autoId'] != '') {
            $data['autoId'] = $record->autoId;
        }

        if (is_null($record) == false) {
            // dd( $data );
            $record->update($data);
            Session::flash('message', 1);
        }

        return redirect()->route('residentes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        abort_if(Gate::denies('residente_mtq_destroy'), 403);
        $residente = residente::select("*")->where('id', '=', $id)->first();
        $residente->delete();

        Session::flash('message', 4);

        return redirect()->route('residentes.index');
    }
}
