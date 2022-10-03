<?php

namespace App\Http\Controllers;

use App\Models\personal;
use App\Models\contactos;
use App\Models\beneficiario;
use App\Models\nomina;
use App\Models\equipo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class personalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $personal = personal::orderBy('created_at', 'desc')->paginate(5);
        // dd($personal);
        return view('personal.indexPersonal', compact('personal'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('personal.altaDePersonal');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $personal = $request->only(
            'userId',
            'nombres',
            'apellidoP',
            'apellidoM',
            'fechaNacimiento',
            'lugarNacimiento',
            'curp',
            'ine',
            'rfc',
            'licencia',
            'cpf',
            'cpe',
            'sexo',
            'civil',
            'hijos',
            'sangre',
            'calle',
            'numero',
            'colonia',
            'estado',
            'ciudad',
            'cp',
            'particular',
            'celular',
            'mailpersonal',
            'mailEmpresaril',
            'casa',
            'foto',
            'aler',
            'profe',
            'interior'
        );

        if ($request->hasFile("foto")) {
            $personal['foto'] = time() . '_' . 'foto.' . $request->file('foto')->getClientOriginalExtension();
            $request->file('foto')->storeAs('/public/personal', $personal['foto']);
        }


        $personal['mailEmpresaril'] = Str::substr($personal['nombres'], 0, 1) . str_replace(' ', '', $personal['apellidoP']) . '@q2ces.com';
        $existe = User::where('email', $personal["mailEmpresaril"])->get();
        if (count($existe) >= 1) {
            $personal['mailEmpresaril'] = Str::substr($personal['nombres'], 0, 1) . str_replace(' ', '', $personal['apellidoP']) . str_replace(' ', '', $personal['apellidoM']) . '@q2ces.com';
        }

        $newuser = new User();
        $newuser->name = Str::substr($personal['nombres'], 0, 1) . ' ' . str_replace(' ', '', $personal['apellidoP']) . ' ' . str_replace(' ', '', $personal['apellidoM']);
        // $newuser->username =  Str::substr($personal['nombres'], 0, 1) . $personal['apellidoP'];
        $newuser->email =  $personal['mailEmpresaril'];
        $newuser->password = bcrypt('12345678');
        $newuser->save();

        // $user = User::create($request->only('name', 'username', 'email')
        //     + [
        //         'password' => bcrypt($request->input('password')),
        //     ]);
        // $roles = $request->input('roles', 'id');
        // $user->syncRoles($roles);
        ///////////////////////////////////////////
        // dd($personal);

        $personal = personal::create($personal);

        $newcontacto = new contactos();
        $newcontacto->personalId = $personal->id;
        $newcontacto->nombre = $request->nombreE;
        $newcontacto->particular = $request->particularE;
        $newcontacto->celular = $request->celularE;
        $newcontacto->parentesco = $request->parentesco;
        $newcontacto->nombreP = $request->nombreP;
        $newcontacto->nombreM = $request->nombreM;
        $newcontacto->save();

        $newbeneficiario = new beneficiario();
        $newbeneficiario->personalId = $personal->id;
        $newbeneficiario->nombres = $request->nombreE;
        $newbeneficiario->apellidoP = $request->apellidoPB;
        $newbeneficiario->apellidoM = $request->apellidoMB;
        $newbeneficiario->particular = $request->particularB;
        $newbeneficiario->celular = $request->celularB;
        $newbeneficiario->nacimiento = $request->nacimientoB;
        $newbeneficiario->save();

        $newnomina = new nomina();
        $newnomina->personalId = $personal->id;
        $newnomina->nomina = $request->nomina;
        $newnomina->imss = $request->imss;
        $newnomina->clinica = $request->clinica;
        $newnomina->infonavit = $request->infonavit;
        $newnomina->afore = $request->afore;
        $newnomina->pago = $request->pago;
        $newnomina->tarjeta = $request->tarjeta;
        $newnomina->banco = $request->banco;
        $newnomina->puesto = $request->puesto;
        $newnomina->ingreso = $request->ingreso;
        $newnomina->horario = $request->horario;
        $newnomina->jefeId = $request->jefeId;
        $newnomina->neto = $request->neto;
        $newnomina->save();

        $newequipo = new equipo();
        $newequipo->personalId = $personal->id;
        $newequipo->chaleco = $request->chaleco;
        $newequipo->camisa = $request->camisa;
        $newequipo->botas = $request->botas;
        $newequipo->guantes = $request->guantes;
        $newequipo->comentarios = $request->comentarios;
        $newequipo->pc = $request->pc;
        $newequipo->pcSerial = $request->pcSerial;
        $newequipo->celular = $request->celular;
        $newequipo->celularImei = $request->imei;
        $newequipo->radio = $request->radio;
        $newequipo->radioSerial = $request->radioSerial;
        $newequipo->cargadorSerial = $request->cargadorSerial;
        $newequipo->save();


        return redirect()->route('personal.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\personal  $personal
     * @return \Illuminate\Http\Response
     */
    public function show(personal $personal)
    {
        // dd($personal->id);
        $contacto = contactos::where("personalId", "$personal->id")->first();
        $beneficiario = beneficiario::where("personalId", "$personal->id")->first();
        $nomina = nomina::where("personalId", "$personal->id")->first();
        $equipo = equipo::where("personalId", "$personal->id")->first();

        // dd($contacto);
        return view('personal.detalleDePersonal', compact('personal', 'contacto', 'beneficiario', 'nomina', 'equipo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\personal  $personal
     * @return \Illuminate\Http\Response
     */
    public function edit(personal $personal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\personal  $personal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, personal $personal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\personal  $personal
     * @return \Illuminate\Http\Response
     */
    public function destroy(personal $personal)
    {
        //
    }
}
