<?php

namespace App\Http\Controllers;

use App\Models\personal;
use App\Models\contactos;
use App\Models\beneficiario;
use App\Models\nomina;
use App\Models\equipo;
use App\Models\User;
use App\Models\userdocs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;


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
            'fine',
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

        if ($request->hasFile("dvitae")) {
            $docs['dvitae'] = time() . '_' . $request->file('dvitae')->getClientOriginalName();
            $request->file('dvitae')->storeAs('/public/docusers', $docs['dvitae']);
        }
        if ($request->hasFile("dnacimiento")) {
            $docs['dnacimiento'] = time() . '_' . $request->file('dnacimiento')->getClientOriginalName();
            $request->file('dnacimiento')->storeAs('/public/docusers', $docs['dnacimiento']);
        }
        if ($request->hasFile("dine")) {
            $docs['dine'] = time() . '_' . $request->file('dine')->getClientOriginalName();
            $request->file('dine')->storeAs('/public/docusers', $docs['dine']);
        }
        if ($request->hasFile("dcurp")) {
            $docs['dcurp'] = time() . '_' . $request->file('dcurp')->getClientOriginalName();
            $request->file('dcurp')->storeAs('/public/docusers', $docs['dcurp']);
        }
        if ($request->hasFile("dlicencia")) {
            $docs['dlicencia'] = time() . '_' . $request->file('dlicencia')->getClientOriginalName();
            $request->file('dlicencia')->storeAs('/public/docusers', $docs['dlicencia']);
        }
        if ($request->hasFile("dcedula")) {
            $docs['dcedula'] = time() . '_' . $request->file('dcedula')->getClientOriginalName();
            $request->file('dcedula')->storeAs('/public/docusers', $docs['dcedula']);
        }
        if ($request->hasFile("dfiscal")) {
            $docs['dfiscal'] = time() . '_' . $request->file('dfiscal')->getClientOriginalName();
            $request->file('dfiscal')->storeAs('/public/docusers', $docs['dfiscal']);
        }
        if ($request->hasFile("dpenales")) {
            $docs['dpenales'] = time() . '_' . $request->file('dpenales')->getClientOriginalName();
            $request->file('dpenales')->storeAs('/public/docusers', $docs['dpenales']);
        }
        if ($request->hasFile("drecomendacion")) {
            $docs['drecomendacion'] = time() . '_' . $request->file('drecomendacion')->getClientOriginalName();
            $request->file('drecomendacion')->storeAs('/public/docusers', $docs['drecomendacion']);
        }
        if ($request->hasFile("ddc3")) {
            $docs['ddc3'] = time() . '_' . $request->file('ddc3')->getClientOriginalName();
            $request->file('ddc3')->storeAs('/public/docusers', $docs['ddc3']);
        }
        if ($request->hasFile("dmedico")) {
            $docs['dmedico'] = time() . '_' . $request->file('dmedico')->getClientOriginalName();
            $request->file('dmedico')->storeAs('/public/docusers', $docs['dmedico']);
        }
        if ($request->hasFile("ddoping")) {
            $docs['ddoping'] = time() . '_' . $request->file('ddoping')->getClientOriginalName();
            $request->file('ddoping')->storeAs('/public/docusers', $docs['ddoping']);
        }
        if ($request->hasFile("destudios")) {
            $docs['destudios'] = time() . '_' . $request->file('destudios')->getClientOriginalName();
            $request->file('destudios')->storeAs('/public/docusers', $docs['destudios']);
        }
        if ($request->hasFile("dnss")) {
            $docs['dnss'] = time() . '_' . $request->file('dnss')->getClientOriginalName();
            $request->file('dnss')->storeAs('/public/docusers', $docs['dnss']);
        }
        if ($request->hasFile("dari")) {
            $docs['dari'] = time() . '_' . $request->file('dari')->getClientOriginalName();
            $request->file('dari')->storeAs('/public/docusers', $docs['dari']);
        }
        if ($request->hasFile("dpuesto")) {
            $docs['dpuesto'] = time() . '_' . $request->file('dpuesto')->getClientOriginalName();
            $request->file('dpuesto')->storeAs('/public/docusers', $docs['dpuesto']);
        }
        if ($request->hasFile("dcontrato")) {
            $docs['dcontrato'] = time() . '_' . $request->file('dcontrato')->getClientOriginalName();
            $request->file('dcontrato')->storeAs('/public/docusers', $docs['dcontrato']);
        }
        $docs['personalId'] = $personal->id;
        $docs = userdocs::create($docs);


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
        // $newnomina->jefeId = $request->jefeId;
        $newnomina->jefeId = 1;
        $newnomina->neto = $request->neto;
        $newnomina->isr = $request->isr;
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

        Session::flash('message', 1);
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
        $nomina = nomina::where("personalId", $personal->id)->first();
        $equipo = equipo::where("personalId", $personal->id)->first();
        $docs = userdocs::where("personalId", $personal->id)->first();

        $nomina->decSalarioDiario = ($nomina->neto);
        $nomina->decSalarioDiarioIntegrado = round($nomina->decSalarioDiario * 1.05137, 2);
        $nomina->decSalarioMensual = round($nomina->decSalarioDiario * 30, 2);
        $nomina->decSalarioMensualIntegrado = round($nomina->decSalarioDiarioIntegrado * 30, 2);
        $nomina->decEstado = round($nomina->decSalarioMensual * 0.025, 2);
        $nomina->decImss = round($nomina->decSalarioMensualIntegrado  * 0.0938, 2);
        $nomina->decImssRiesgo = round($nomina->decSalarioMensualIntegrado * 0.0658875, 2);
        $nomina->decAfore = round($nomina->decSalarioMensualIntegrado * 0.0628, 2);
        $nomina->decInfonavit = round($nomina->decSalarioMensualIntegrado * 0.05, 2);
        $nomina->decVacaciones = round($nomina->decSalarioDiario * 6, 2);
        $nomina->decPrimaVacacional = round($nomina->decVacaciones * 0.25, 2);
        $nomina->decAguinaldo = round($nomina->decSalarioDiario * 15, 2);
        $nomina->decTotal = round($nomina->decSalarioMensual + $nomina->decEstado + $nomina->decImss + $nomina->decImssRiesgo +
            $nomina->decAfore + $nomina->decInfonavit + $nomina->decVacaciones + $nomina->decPrimaVacacional + $nomina->decAguinaldo + $nomina->isr, 2);


        // dd($contacto);
        return view('personal.detalleDePersonal', compact('personal', 'contacto', 'beneficiario', 'nomina', 'equipo', 'docs'));
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
        $id = $personal->id;
        $data = $request->only(
            'userId',
            'nombres',
            'apellidoP',
            'apellidoM',
            'fechaNacimiento',
            'lugarNacimiento',
            'curp',
            'fine',
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
            $data['foto'] = time() . '_' . 'foto.' . $request->file('foto')->getClientOriginalExtension();
            $request->file('foto')->storeAs('/public/personal', $data['foto']);
        }
        $personal->update($data);
        // dd($request->diario);
        $contacto = contactos::where("personalId", "$id")->first();
        $contacto->nombre = $request->nombreE;
        $contacto->particular = $request->particularE;
        $contacto->celular = $request->celularE;
        $contacto->parentesco = $request->parentesco;
        $contacto->nombreP = $request->nombreP;
        $contacto->nombreM = $request->nombreM;
        $contacto->save();

        $beneficiario = beneficiario::where("personalId", "$id")->first();
        $beneficiario->nombres = $request->nombreE;
        $beneficiario->apellidoP = $request->apellidoPB;
        $beneficiario->apellidoM = $request->apellidoMB;
        $beneficiario->particular = $request->particularB;
        $beneficiario->celular = $request->celularB;
        $beneficiario->nacimiento = $request->nacimientoB;
        $beneficiario->save();

        $nomina = nomina::where("personalId", "$id")->first();;
        $nomina->nomina = $request->nomina;
        $nomina->imss = $request->imss;
        $nomina->clinica = $request->clinica;
        $nomina->infonavit = $request->infonavit;
        $nomina->afore = $request->afore;
        $nomina->pago = $request->pago;
        $nomina->tarjeta = $request->tarjeta;
        $nomina->banco = $request->banco;
        $nomina->puesto = $request->puesto;
        $nomina->ingreso = $request->ingreso;
        $nomina->horario = $request->horario;
        $nomina->jefeId = $request->jefeId;
        $nomina->neto = $request->diario;
        $nomina->isr = $request->isr;
        $nomina->save();

        $equipo = equipo::where("personalId", "$id")->first();
        $equipo->chaleco = $request->chaleco;
        $equipo->camisa = $request->camisa;
        $equipo->botas = $request->botas;
        $equipo->guantes = $request->guantes;
        $equipo->comentarios = $request->comentarios;
        $equipo->pc = $request->pc;
        $equipo->pcSerial = $request->pcSerial;
        $equipo->celular = $request->celular;
        $equipo->celularImei = $request->imei;
        $equipo->radio = $request->radio;
        $equipo->radioSerial = $request->radioSerial;
        $equipo->cargadorSerial = $request->cargadorSerial;
        $equipo->save();

        if ($request->hasFile("dvitae")) {
            $docs['dvitae'] = time() . '_' . $request->file('dvitae')->getClientOriginalName();
            $request->file('dvitae')->storeAs('/public/docusers', $docs['dvitae']);
        }
        if ($request->hasFile("dnacimiento")) {
            $docs['dnacimiento'] = time() . '_' . $request->file('dnacimiento')->getClientOriginalName();
            $request->file('dnacimiento')->storeAs('/public/docusers', $docs['dnacimiento']);
        }
        if ($request->hasFile("dine")) {
            $docs['dine'] = time() . '_' . $request->file('dine')->getClientOriginalName();
            $request->file('dine')->storeAs('/public/docusers', $docs['dine']);
        }
        if ($request->hasFile("dcurp")) {
            $docs['dcurp'] = time() . '_' . $request->file('dcurp')->getClientOriginalName();
            $request->file('dcurp')->storeAs('/public/docusers', $docs['dcurp']);
        }
        if ($request->hasFile("dlicencia")) {
            $docs['dlicencia'] = time() . '_' . $request->file('dlicencia')->getClientOriginalName();
            $request->file('dlicencia')->storeAs('/public/docusers', $docs['dlicencia']);
        }
        if ($request->hasFile("dcedula")) {
            $docs['dcedula'] = time() . '_' . $request->file('dcedula')->getClientOriginalName();
            $request->file('dcedula')->storeAs('/public/docusers', $docs['dcedula']);
        }
        if ($request->hasFile("dfiscal")) {
            $docs['dfiscal'] = time() . '_' . $request->file('dfiscal')->getClientOriginalName();
            $request->file('dfiscal')->storeAs('/public/docusers', $docs['dfiscal']);
        }
        if ($request->hasFile("dpenales")) {
            $docs['dpenales'] = time() . '_' . $request->file('dpenales')->getClientOriginalName();
            $request->file('dpenales')->storeAs('/public/docusers', $docs['dpenales']);
        }
        if ($request->hasFile("drecomendacion")) {
            $docs['drecomendacion'] = time() . '_' . $request->file('drecomendacion')->getClientOriginalName();
            $request->file('drecomendacion')->storeAs('/public/docusers', $docs['drecomendacion']);
        }
        if ($request->hasFile("ddc3")) {
            $docs['ddc3'] = time() . '_' . $request->file('ddc3')->getClientOriginalName();
            $request->file('ddc3')->storeAs('/public/docusers', $docs['ddc3']);
        }
        if ($request->hasFile("dmedico")) {
            $docs['dmedico'] = time() . '_' . $request->file('dmedico')->getClientOriginalName();
            $request->file('dmedico')->storeAs('/public/docusers', $docs['dmedico']);
        }
        if ($request->hasFile("ddoping")) {
            $docs['ddoping'] = time() . '_' . $request->file('ddoping')->getClientOriginalName();
            $request->file('ddoping')->storeAs('/public/docusers', $docs['ddoping']);
        }
        if ($request->hasFile("destudios")) {
            $docs['destudios'] = time() . '_' . $request->file('destudios')->getClientOriginalName();
            $request->file('destudios')->storeAs('/public/docusers', $docs['destudios']);
        }
        if ($request->hasFile("dnss")) {
            $docs['dnss'] = time() . '_' . $request->file('dnss')->getClientOriginalName();
            $request->file('dnss')->storeAs('/public/docusers', $docs['dnss']);
        }
        if ($request->hasFile("dari")) {
            $docs['dari'] = time() . '_' . $request->file('dari')->getClientOriginalName();
            $request->file('dari')->storeAs('/public/docusers', $docs['dari']);
        }
        if ($request->hasFile("dpuesto")) {
            $docs['dpuesto'] = time() . '_' . $request->file('dpuesto')->getClientOriginalName();
            $request->file('dpuesto')->storeAs('/public/docusers', $docs['dpuesto']);
        }
        if ($request->hasFile("dcontrato")) {
            $docs['dcontrato'] = time() . '_' . $request->file('dcontrato')->getClientOriginalName();
            $request->file('dcontrato')->storeAs('/public/docusers', $docs['dcontrato']);
        }
        $docu = userdocs::where("personalId", $id);
        if (isset($docs)) {
            $docu->update($docs);
            # code...
        }
        Session::flash('message', 1);

        return redirect()->route('personal.index');
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
    public function download($id, $doc)
    {
        $book = userdocs::where('id', $id)->firstOrFail();

        $pathToFile = storage_path("app/public/docusers/" . $book->$doc);
        // return response()->download($pathToFile);
        return response()->file($pathToFile);
    }
}
