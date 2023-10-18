<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\docs;
use App\Models\maquinaria;
use App\Models\marca;
use Illuminate\Http\Request;
use App\Models\residente;
use App\Models\obras;
use App\Models\residenteAutos;
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
            ->leftjoin('residenteautos', 'residenteautos.residenteId', 'residente.Id')
            ->leftjoin('maquinaria', 'maquinaria.id', '=', 'residenteautos.autoId')
            ->where('residente.clienteId', '=', 2)
            ->groupBy('residente.Id')
            ->orderBy('nombre', 'asc')
            ->paginate(15);
        // dd($records);
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
        $marcas = marca::select('marca.*', 'marcasFilter.tipos_marcas_id')->leftJoin('marcasTipo as marcasFilter', 'marca.id', '=', 'marcasFilter.marca_id')->orderBy('nombre', 'asc')
            ->where('marcasFilter.tipos_marcas_id', '5')
            ->get();
        // dd($marcas);
        $vctObras = obras::where('estatus', 1)
            ->orderBy('nombre', 'asc')->get();
        // $doc = docs::where('tipoId', '3')->orderBy('nombre', 'asc')->get();
        $maquinaria = maquinaria::where('compania', 'mtq')->get();
        return view('MTQ.altaDeResidentes', compact('maquinaria', 'marcas', 'vctObras'));
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
        $newResidente = residente::create($record);
        for ($i = 0; $i < count($request['autoIdR']); $i++) {

            if ($request['autoIdR'][$i]) {
                $objResidente = new residenteAutos();
                $objResidente->autoId = $request['autoIdR'][$i];
                $objResidente->residenteId = $newResidente->id;
                //  $objResidente->puesto = $request[ 'rpuesto' ][ $i ];
                $objResidente->save();
            }
        }

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

    public function edit(residente $residente)
    {
        abort_if(Gate::denies('maquinaria_edit'), '403');
        $maquinaria = maquinaria::where('compania', 'mtq')->get();
        $readonly = false;

        $vctObras = obras::where('estatus', 1)->orderBy('nombre', 'asc')->get();

        $residentesAutos = residenteAutos::join('maquinaria as equipo', 'autoId', '=', 'equipo.id')->select('equipo.nombre as equipo_nombre', 'equipo.id as equipo_id', 'residenteAutos.id')->where('residenteId', $residente->id)->get();
        // dd($residentesAutos);

        return view('MTQ.detalleResidentes', compact('maquinaria', 'residente', 'vctObras', 'readonly', 'residentesAutos'));
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
        // dd($request);

        $nuevaLista = collect();
        $record->update($data);

        for ($i = 0; $i < count($request['idResidenteAuto']); $i++) {

            if ($request['autoIdR'][$i]) {
                $array = [
                    'id' => $request['idResidenteAuto'][$i],
                    'autoId' => $request['autoIdR'][$i],
                    'residenteId' => $record->id
                ];
                // dd($array);
                $objResidente = residenteAutos::updateOrCreate(['id' => $array['id']], $array);
                // dd($i, $array, $objResidente);
                // dd($objResidente, $array, $request);
                $nuevaLista->push($objResidente->id);
            }
        }


        $test = residenteAutos::where('residenteId', $record->id)->whereNotIn('id', $nuevaLista)->delete();
        Session::flash('message', 1);

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
