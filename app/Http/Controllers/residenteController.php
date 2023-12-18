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
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

class residenteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function generate(Request $request)
    {
        $residente = Residente::where('id', $request['userId'])->first();

        if ($residente->userId != null) {
            Session::flash('message', 7);
        } else {
            $userData = [
                'name' => $residente->nombre, // Utiliza el campo correcto del residente para el nombre del usuario
                'username' => $residente->nombre, // Utiliza el campo correcto del residente para el username del usuario
                'email' => $residente->email, // Asegúrate de tener el campo correcto para el email del residente
                'password' => bcrypt('12345678'),
            ];

            $newUser = User::create($userData);

            $roles = ['9'];
            $newUser->syncRoles($roles);

            $residente->userId = $newUser->id;
            $residente->save();
            Session::flash('message', 8);
        }

        return redirect()->route('residentes.index');
    }


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
            ->leftjoin('residenteAutos', 'residenteAutos.residenteId', 'residente.Id')
            ->leftjoin('maquinaria', 'maquinaria.id', '=', 'residenteAutos.autoId')
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

        $record['clienteId'] = 2;
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
        $request->validate([
            'nombre' => 'required|max:250',
        ], [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'nombre.max' => 'El campo título excede el límite de caracteres permitidos.',
        ]);
        $data = $request->all();
        $record = residente::where('id', $data['residenteId'])->first();
        $nuevaLista = collect();
        $record->update($data);

        for ($i = 0; $i < count($request['idResidenteAuto']); $i++) {
            if ($request['autoIdR'][$i]) {
                $array = [
                    'id' => $request['idResidenteAuto'][$i],
                    'autoId' => $request['autoIdR'][$i],
                    'residenteId' => $record->id
                ];
                $objResidente = residenteAutos::updateOrCreate(['id' => $array['id']], $array);
                $nuevaLista->push($objResidente->id);
            }
        }

        $test = residenteAutos::where('residenteId', $record->id)->whereNotIn('id', $nuevaLista)->delete();
        $user = User::where('id', $record->userId)->first();
        if ($user) {
            $request['name'] = $request['nombre'];
            $request['username'] = $request['nombre'];
            $dataUser = $request->only('name', 'username', 'email');
            $user->update($dataUser);
        } else {
        }

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
        $residenteAutos = residenteAutos::select("*")->where('residenteId', '=', $id)->get();
        if ($residenteAutos) {
            foreach ($residenteAutos as $residenteAto) {
                $residenteAto->delete();
            }
        }

        $user = User::where('id', $residente->userId)->first();
        $residente->delete();
        if ($user) {
            $password = Str::random(50);
            $user->estadoId = 2;
            $user->password = bcrypt($password);
            $user->update();
        }

        Session::flash('message', 4);

        return redirect()->route('residentes.index');
    }
}
