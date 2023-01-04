<?php

namespace App\Http\Controllers;

use App\Models\personal;
use App\Models\contactos;
use App\Models\beneficiario;
use App\Models\nomina;
use App\Models\equipo;
use App\Models\User;
use App\Models\userdocs;
use App\Models\fiscal;
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

        $vctPersonal = personal::all();
        return view('personal.altaDePersonal')->with('personal', $vctPersonal);
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
        $request->validate([
            'nombres' => 'required|max:150',
            'apellidoP' => 'required|max:150',
            'apellidoM' => 'nullable|max:150',
            'aler' => 'nullable|max:150',
            'celular' => 'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:9|max:16',
            'mailEmpresarial' => 'nullable|email|max:200',
            'fechaNacimiento' => 'nullable|date|date_format:Y-m-d',

            'lugarNacimiento' => 'nullable|max:200',
            'civil' => 'nullable|max:150',
            'curp' => 'nullable|max:20',
            'rfc' => 'nullable|max:20',
            'ine' => 'nullable|max:20',
            'licencia' => 'nullable|max:20',
            'cpf' => 'nullable|max:25',
            'cpe' => 'nullable|max:25',
            'hijos' => 'nullable|numeric',
            'profe' => 'nullable|max:150',
            'mailpersonal' => 'nullable|email|max:200',

            'calle' => 'nullable|max:200',
            'numero' => 'nullable|max:20',
            'interior' => 'nullable|max:20',
            'colonia' => 'nullable|max:200',
            'cp' => 'nullable|max:99999',
            'municipio' => 'nullable|max:200',
            'estado' => 'nullable|max:200',
            'casa' => 'nullable|max:200',

            'callef' => 'nullable|max:200',
            'numerof' => 'nullable|max:20',
            'interiorf' => 'nullable|max:20',
            'coloniaf' => 'nullable|max:200',
            'cp_f' => 'nullable|max:99999',
            'municipiof' => 'nullable|max:200',
            'estadof' => 'nullable|max:200',
            'entref' => 'nullable|max:200',

            'nombreE' => 'nullable|max:150',
            'nombreP' => 'nullable|max:150',
            'nombreM' => 'nullable|max:150',
            'parentesco' => 'nullable|max:150',
            'particularE' => 'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:9|max:16',
            'celularE' => 'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:9|max:16',

            'nombreB' => 'nullable|max:150',
            'apellidoPB' => 'nullable|max:150',
            'apellidoMB' => 'nullable|max:150',
            'particularB' => 'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:9|max:16',
            'celularB' => 'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:9|max:16',
            'nacimientoB' => 'nullable|date|date_format:Y-m-d',

            'nomina' => 'nullable|numeric',
            'imss' => 'nullable|numeric',
            'clinica' => 'nullable|max:150',
            'infonavit' => 'nullable|max:20',
            'afore' => 'nullable|max:20',
            'tarjeta' => 'nullable|max:20',
            'banco' => 'nullable|max:150',
            'puesto' => 'nullable|max:150',
            'horario' => 'nullable|max:150',
            'jefeId' => 'nullable|numeric',
            'neto' => 'nullable|numeric',
            'ingreso' => 'nullable|date|date_format:Y-m-d',

            'botas' => 'nullable|numeric|max:8',
            'pc' => 'nullable|max:200',
            'pcSerial' => 'nullable|max:50',
            'celularEquipo' => 'nullable|max:200',
            'celularImei' => 'nullable|numeric',
            'radio' => 'nullable|max:200',
            'radioSerial' => 'nullable|numeric',
            'cargadorSerial' => 'nullable|numeric',
        ], [
            'nombres.required' => 'El campo nombre(s) es obligatorio.',
            'nombres.max' => 'El campo nombre(s) excede el límite de caracteres permitidos.',
            'apellidoP.required' => 'El campo apellido paterno es obligatorio.',
            'apellidoP.max' => 'El campo apellido paterno excede el límite de caracteres permitidos.',
            'apellidoM.max' => 'El campo apellido materno excede el límite de caracteres permitidos.',
            'aler.max' => 'El campo alergías excede el límite de caracteres permitidos.',
            'lugarNacimiento.max' => 'El campo lugar de nacimiento excede el límite de caracteres permitidos.',
            'fechaNacimiento.date_format' => 'El campo fecha de nacimiento tiene un formato inválido.',
            'rfc.max' => 'El campo RFC excede el límite de caracteres permitidos.',
            'curp.max' => 'El campo CURP excede el límite de caracteres permitidos.',
            'ine.max' => 'El campo folio INE excede el límite de caracteres permitidos.',
            'licencia.max' => 'El campo licencia excede el límite de caracteres permitidos.',
            'cpf.max' => 'El campo Cédula Profesional Federal excede el límite de caracteres permitidos.',
            'cpe.max' => 'El campo Cédula Profesional Estatal excede el límite de caracteres permitidos.',
            'civil.max' => 'El campo estado civil excede el límite de caracteres permitidos.',
            'profe.max' => 'El campo profesión excede el límite de caracteres permitidos.',
            'celular.numeric' => 'El campo celular solo acepta números.',
            'celular.min' => 'El campo celular requiere de al menos 10 caracteres.',
            'calle.max' => 'El campo calle excede el límite de caracteres permitidos.',
            'numero.max' => 'El campo número excede el límite de caracteres permitidos.',
            'interior.max' => 'El campo interior excede el límite de caracteres permitidos.',
            'colonia.max' => 'El campo colonia excede el límite de caracteres permitidos.',
            'cp.min' => 'El campo código postal requiere de al menos 5 caracteres.',
            'municipio.max' => 'El campo municipio excede el límite de caracteres permitidos.',
            'estado.max' => 'El campo estado excede el límite de caracteres permitidos.',
            'casa.max' => 'El campo casa en domicilio fiscal excede el límite de caracteres permitidos.',
            'callef.max' => 'El campo calle en domicilio fiscal excede el límite de caracteres permitidos.',
            'numerof.max' => 'El campo número en domicilio fiscal excede el límite de caracteres permitidos.',
            'interiorf.max' => 'El campo interior en domicilio fiscal excede el límite de caracteres permitidos.',
            'coloniaf.max' => 'El campo colonia en domicilio fiscal excede el límite de caracteres permitidos.',
            'cp_f.min' => 'El campo código postal en domicilio fiscal requiere de al menos 5 caracteres.',
            'municipiof.max' => 'El campo municipio en domicilio fiscal excede el límite de caracteres permitidos.',
            'estadof.max' => 'El campo estado en domicilio fiscal excede el límite de caracteres permitidos.',
            'entref.max' => 'El campo entre calles en domicilio fiscal excede el límite de caracteres permitidos.',
            'nombreE.max' => 'El campo nombre en personales excede el límite de caracteres permitidos.',
            'nombreP.max' => 'El campo apellido paterno en personales excede el límite de caracteres permitidos.',
            'nombreM.max' => 'El campo apellido materno en personales excede el límite de caracteres permitidos.',
            'parentesco.max' => 'El campo parentesco en personales excede el límite de caracteres permitidos.',
            'particularE.min' => 'El campo teléfono particular en personales requiere de al menos 10 caracteres.',
            'celularE.min' => 'El campo celular en personales requiere de al menos 10 caracteres.',
            'nombreB.max' => 'El campo nombre en beneficiario excede el límite de caracteres permitidos.',
            'apellidoPB.max' => 'El campo apellido paterno en beneficiario excede el límite de caracteres permitidos.',
            'apellidoMB.max' => 'El campo apellido materno en beneficiario excede el límite de caracteres permitidos.',
            'particularB.min' => 'El campo teléfono beneficiario en contacto requiere de al menos 10 caracteres.',
            'celularB.min' => 'El campo celular en beneficiario requiere de al menos 10 caracteres.',
            'nomina.max' => 'El campo número de nómina excede el límite de caracteres permitidos.',
            'imss.max' => 'El campo número de IMSS excede el límite de caracteres permitidos.',
            'clinica.max' => 'El campo nombre de clínica excede el límite de caracteres permitidos.',
            'infonavit.max' => 'El campo número de Infonavit excede el límite de caracteres permitidos.',
            'afore.max' => 'El campo afore excede el límite de caracteres permitidos.',
            'tarjeta.max' => 'El campo tarjeta excede el límite de caracteres permitidos.',
            'banco.max' => 'El campo nombre de banco excede el límite de caracteres permitidos.',
            'puesto.max' => 'El campo nombre de puesto excede el límite de caracteres permitidos.',
            'horario.max' => 'El campo horario excede el límite de caracteres permitidos.',
            'botas.max' => 'El campo botas excede el límite de caracteres permitidos.',
            'pc.max' => 'El campo Equipo de cómputo excede el límite de caracteres permitidos.',
            'pcSerial.max' => 'El campo serial de equipo de cómputo excede el límite de caracteres permitidos.',
            'celularEquipo.max' => 'El campo equipo celular excede el límite de caracteres permitidos.',
            'celularEmei.max' => 'El campo IMEI de celular excede el límite de caracteres permitidos.',
            'radio.max' => 'El campo radio excede el límite de caracteres permitidos.',
            'radioSerial.max' => 'El campo serial de radio excede el límite de caracteres permitidos.',
            'radioSerial.numeric' => 'El campo serial de radio debe de ser númerico.',
            'cargadorSerial.max' => 'El campo serial de cargador excede el límite de caracteres permitidos.',
            'cargadorSerial.numeric' => 'El campo serial del cargador debe de ser númerico.',
        ]);

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
            'mailEmpresarial',
            'casa',
            'foto',
            'aler',
            'profe',
            'interior'
        );
        // conversion a mayuscula de algunos campos
        $personal['curp'] = strtoupper($personal['curp']);
        $personal['ine'] = strtoupper($personal['ine']);
        $personal['rfc'] = strtoupper($personal['rfc']);
        $personal['licencia'] = strtoupper($personal['licencia']);
        $personal['cpf'] = strtoupper($personal['cpf']);
        // conversion a minuscula de algunos campos
        $personal['mailpersonal'] = strtolower($personal['mailpersonal']);
        /* Generación del email empresarial */
        $personal['mailEmpresarial'] =  strtolower($this->generarCorreoEmpresarial($personal['nombres'], $personal['apellidoP'], $personal['apellidoM']));

        if ($request->hasFile("foto")) {
            $personal['foto'] = time() . '_' . 'foto.' . $request->file('foto')->getClientOriginalExtension();
            $request->file('foto')->storeAs('/public/personal', $personal['foto']);
        }

        $existeUsuario = User::where('email', $personal["mailEmpresarial"])->get();

        if ($existeUsuario->isEmpty() == true) {

            $roles[] = 2;

            $newuser = new User();
            $newuser->name = Str::substr($personal['nombres'], 0, 1) . ' ' . str_replace(' ', '', $personal['apellidoP']) . ' ' . str_replace(' ', '', $personal['apellidoM']);
            // $newuser->username =  Str::substr($personal['nombres'], 0, 1) . $personal['apellidoP'];
            $newuser->email =  $personal['mailEmpresarial'];
            $newuser->password = bcrypt('12345678');
            $newuser->syncRoles($roles);
            $newuser->save();

            //** guardamos el id de usuario para el registro de personal */
            $personal['userId'] = $newuser->id;
        }

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
        $newbeneficiario->nombres = $request->nombreB;
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
        $newequipo->celular = $request->celularEquipo;
        $newequipo->celularImei = $request->imei;
        $newequipo->radio = $request->radio;
        $newequipo->radioSerial = $request->radioSerial;
        $newequipo->cargadorSerial = $request->cargadorSerial;
        $newequipo->save();

        if ($request->cp != "") {
            $newfiscal =  new fiscal();
            $newfiscal->personalId = $personal->id;
            $newfiscal->calle = $request->calle;
            $newfiscal->numero = $request->numero;
            $newfiscal->interior = $request->interior;
            $newfiscal->entre = null;
            $newfiscal->colonia = $request->colonia;
            $newfiscal->localidad = $request->ciudad;
            $newfiscal->municipio = $request->ciudad;
            $newfiscal->estado = $request->estado;
            $newfiscal->cp = $request->cp;
            $newfiscal->tipo = null;
            $newfiscal->save();
        } else {
            $newfiscal = new fiscal();
            $newfiscal->personalId = $personal->id;
            $newfiscal->calle = $request->callef;
            $newfiscal->numero = $request->numerof;
            $newfiscal->interior = $request->interiorf;
            $newfiscal->entre = $request->entref;
            $newfiscal->colonia = $request->coloniaf;
            $newfiscal->localidad = $request->localidadf;
            $newfiscal->municipio = $request->municipiof;
            $newfiscal->estado = $request->estadof;
            $newfiscal->cp = $request->cp_f;
            $newfiscal->tipo = $request->tipof;
            $newfiscal->save();
        }

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
        $contacto = contactos::where("personalId", $personal->id)->first();
        $beneficiario = beneficiario::where("personalId", $personal->id)->first();
        $nomina = nomina::where("personalId", $personal->id)->first();
        $equipo = equipo::where("personalId", $personal->id)->first();
        $docs = userdocs::where("personalId", $personal->id)->first();
        $fiscal = fiscal::where("personalId", $personal->id)->first();
        $vctPersonal = personal::all();

        $nomina->decSalarioDiario = ($nomina->diario);
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

        // dd($nomina);
        return view('personal.detalleDePersonal', compact('personal', 'contacto', 'beneficiario', 'nomina', 'equipo', 'docs', 'fiscal', 'vctPersonal'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\personal  $personal
     * @return \Illuminate\Http\Response
     */
    public function edit(personal $personal)
    {
        return "Usar show para editar";
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

        $request->validate([
            'nombres' => 'required|max:150',
            'apellidoP' => 'required|max:150',
            'apellidoM' => 'nullable|max:150',
            'aler' => 'nullable|max:150',
            'celular' => 'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:16',
            'mailEmpresarial' => 'nullable|email|max:200',
            'fechaNacimiento' => 'nullable|date|date_format:Y-m-d',

            'lugarNacimiento' => 'nullable|max:200',
            'curp' => 'nullable|max:20',
            'rfc' => 'nullable|max:20',
            'ine' => 'nullable|max:20',
            'licencia' => 'nullable|max:20',
            'cpf' => 'nullable|max:25',
            'cpe' => 'nullable|max:25',
            'hijos' => 'nullable|numeric',
            'profe' => 'nullable|max:150',
            'mailpersonal' => 'nullable|email|max:200',

            'calle' => 'nullable|max:200',
            'numero' => 'nullable|max:20',
            'interior' => 'nullable|max:20',
            'colonia' => 'nullable|max:200',
            'cp' => 'nullable|min:5',
            'municipio' => 'nullable|max:200',
            'estado' => 'nullable|max:200',
            'casa' => 'nullable|max:200',

            'callef' => 'nullable|max:200',
            'numerof' => 'nullable|max:20',
            'interiorf' => 'nullable|max:20',
            'coloniaf' => 'nullable|max:200',
            'cp_f' => 'nullable|min:5',
            'municipiof' => 'nullable|max:200',
            'estadof' => 'nullable|max:200',
            'entref' => 'nullable|max:200',

            'nombreE' => 'nullable|max:150',
            'nombreP' => 'nullable|max:150',
            'nombreM' => 'nullable|max:150',
            'particularE' => 'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:16',
            'celularE' => 'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:16',

            'nombreB' => 'nullable|max:150',
            'apellidoPB' => 'nullable|max:150',
            'apellidoMB' => 'nullable|max:150',
            'particularB' => 'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:16',
            'celularB' => 'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:16',
            'nacimientoB' => 'nullable|date|date_format:Y-m-d',

            'nomina' => 'nullable|numeric',
            'imss' => 'nullable|numeric',
            'clinica' => 'nullable|max:150',
            'infonavit' => 'nullable|max:20',
            'afore' => 'nullable|max:20',
            'tarjeta' => 'nullable|max:20',
            'banco' => 'nullable|max:150',
            'puesto' => 'nullable|max:150',
            'horario' => 'nullable|max:150',
            'jefeId' => 'nullable|numeric',
            'neto' => 'nullable|numeric',
            'ingreso' => 'nullable|date|date_format:Y-m-d',

            'botas' => 'nullable|numeric',
            'pc' => 'nullable|max:200',
            'pcSerial' => 'nullable|max:50',
            'celularEquipo' => 'nullable|max:200',
            'celularImei' => 'nullable|numeric',
            'radio' => 'nullable|max:200',
            'radioSerial' => 'nullable|numeric',
            'cargadorSerial' => 'nullable|numeric',
        ], [
            'nombres.required' => 'El campo nombre(s) es obligatorio.',
            'nombres.max' => 'El campo nombre(s) excede el límite de caracteres permitidos.',
            'apellidoP.required' => 'El campo apellido paterno es obligatorio.',
            'apellidoP.max' => 'El campo apellido paterno excede el límite de caracteres permitidos.',
            'apellidoM.max' => 'El campo apellido materno excede el límite de caracteres permitidos.',
            'aler.max' => 'El campo alergías excede el límite de caracteres permitidos.',
            'lugarNacimiento.max' => 'El campo lugar de nacimiento excede el límite de caracteres permitidos.',
            'fechaNacimiento.date_format' => 'El campo fecha de nacimiento tiene un formato inválido.',
            'rfc.max' => 'El campo RFC excede el límite de caracteres permitidos.',
            'curp.max' => 'El campo CURP excede el límite de caracteres permitidos.',
            'ine.max' => 'El campo folio INE excede el límite de caracteres permitidos.',
            'licencia.max' => 'El campo licencia excede el límite de caracteres permitidos.',
            'cpf.max' => 'El campo Cédula Profesional Federal excede el límite de caracteres permitidos.',
            'cpe.max' => 'El campo Cédula Profesional Estatal excede el límite de caracteres permitidos.',
            'civil.max' => 'El campo estado civil excede el límite de caracteres permitidos.',
            'profe.max' => 'El campo profesión excede el límite de caracteres permitidos.',
            'celular.numeric' => 'El campo celular solo acepta números.',
            'celular.min' => 'El campo celular requiere de al menos 10 caracteres.',
            'calle.max' => 'El campo calle excede el límite de caracteres permitidos.',
            'numero.max' => 'El campo número excede el límite de caracteres permitidos.',
            'interior.max' => 'El campo interior excede el límite de caracteres permitidos.',
            'colonia.max' => 'El campo colonia excede el límite de caracteres permitidos.',
            'cp.min' => 'El campo código postal requiere de al menos 5 caracteres.',
            'municipio.max' => 'El campo municipio excede el límite de caracteres permitidos.',
            'estado.max' => 'El campo estado excede el límite de caracteres permitidos.',
            'casa.max' => 'El campo casa en domicilio fiscal excede el límite de caracteres permitidos.',
            'callef.max' => 'El campo calle en domicilio fiscal excede el límite de caracteres permitidos.',
            'numerof.max' => 'El campo número en domicilio fiscal excede el límite de caracteres permitidos.',
            'interiorf.max' => 'El campo interior en domicilio fiscal excede el límite de caracteres permitidos.',
            'coloniaf.max' => 'El campo colonia en domicilio fiscal excede el límite de caracteres permitidos.',
            'cp_f.min' => 'El campo código postal en domicilio fiscal requiere de al menos 5 caracteres.',
            'municipiof.max' => 'El campo municipio en domicilio fiscal excede el límite de caracteres permitidos.',
            'estadof.max' => 'El campo estado en domicilio fiscal excede el límite de caracteres permitidos.',
            'entref.max' => 'El campo entre calles en domicilio fiscal excede el límite de caracteres permitidos.',
            'nombreE.max' => 'El campo nombre en personales excede el límite de caracteres permitidos.',
            'nombreP.max' => 'El campo apellido paterno en personales excede el límite de caracteres permitidos.',
            'nombreM.max' => 'El campo apellido materno en personales excede el límite de caracteres permitidos.',
            'parentesco.max' => 'El campo parentesco en personales excede el límite de caracteres permitidos.',
            'particularE.min' => 'El campo teléfono particular en personales requiere de al menos 10 caracteres.',
            'celularE.min' => 'El campo celular en personales requiere de al menos 10 caracteres.',
            'nombreB.max' => 'El campo nombre en beneficiario excede el límite de caracteres permitidos.',
            'apellidoPB.max' => 'El campo apellido paterno en beneficiario excede el límite de caracteres permitidos.',
            'apellidoMB.max' => 'El campo apellido materno en beneficiario excede el límite de caracteres permitidos.',
            'particularB.min' => 'El campo teléfono beneficiario en contacto requiere de al menos 10 caracteres.',
            'celularB.min' => 'El campo celular en beneficiario requiere de al menos 10 caracteres.',
            'nomina.max' => 'El campo número de nómina excede el límite de caracteres permitidos.',
            'imss.max' => 'El campo número de IMSS excede el límite de caracteres permitidos.',
            'clinica.max' => 'El campo nombre de clínica excede el límite de caracteres permitidos.',
            'infonavit.max' => 'El campo número de Infonavit excede el límite de caracteres permitidos.',
            'afore.max' => 'El campo afore excede el límite de caracteres permitidos.',
            'tarjeta.max' => 'El campo tarjeta excede el límite de caracteres permitidos.',
            'banco.max' => 'El campo nombre de banco excede el límite de caracteres permitidos.',
            'puesto.max' => 'El campo nombre de puesto excede el límite de caracteres permitidos.',
            'horario.max' => 'El campo horario excede el límite de caracteres permitidos.',
            'botas.max' => 'El campo botas excede el límite de caracteres permitidos.',
            'pc.max' => 'El campo Equipo de cómputo excede el límite de caracteres permitidos.',
            'pcSerial.max' => 'El campo serial de equipo de cómputo excede el límite de caracteres permitidos.',
            'celularEquipo.max' => 'El campo equipo celular excede el límite de caracteres permitidos.',
            'celularEmei.max' => 'El campo IMEI de celular excede el límite de caracteres permitidos.',
            'radio.max' => 'El campo radio excede el límite de caracteres permitidos.',
            'radioSerial.max' => 'El campo serial de radio excede el límite de caracteres permitidos.',
            'radioSerial.numeric' => 'El campo serial de radio debe de ser númerico.',
            'cargadorSerial.max' => 'El campo serial de cargador excede el límite de caracteres permitidos.',
            'cargadorSerial.numeric' => 'El campo serial del cargador debe de ser númerico.',
        ]);

        $id = $personal->id;
        $data = $request->only(
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
            'mailEmpresarial',
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

        // conversion a mayuscula de algunos campos
        $data['curp'] = strtoupper($data['curp']);
        $data['ine'] = strtoupper($data['ine']);
        $data['rfc'] = strtoupper($data['rfc']);
        $data['licencia'] = strtoupper($data['licencia']);
        $data['cpf'] = strtoupper($data['cpf']);
        // conversion a minuscula de algunos campos
        $data['mailEmpresarial'] = strtolower($data['mailEmpresarial']);
        $data['mailpersonal'] = strtolower($data['mailpersonal']);

        $personal->update($data);

        $contacto = contactos::where("personalId", "$id")->first();
        $contacto->nombre = $request->nombreE;
        $contacto->particular = $request->particularE;
        $contacto->celular = $request->celularE;
        $contacto->parentesco = $request->parentesco;
        $contacto->nombreP = $request->nombreP;
        $contacto->nombreM = $request->nombreM;
        $contacto->save();

        $beneficiario = beneficiario::where("personalId", "$id")->first();
        $beneficiario->nombres = $request->nombreB;
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
        $nomina->neto = $request->neto;
        $nomina->diario = $request->diario;
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
        $equipo->celular = $request->celularEquipo;
        $equipo->celularImei = $request->celularImei;
        $equipo->radio = $request->radio;
        $equipo->radioSerial = $request->radioSerial;
        $equipo->cargadorSerial = $request->cargadorSerial;
        $equipo->save();

        $newfiscal =   fiscal::where("personalId", "$id")->first();
        $newfiscal->calle = $request->callef;
        $newfiscal->numero = $request->numerof;
        $newfiscal->interior = $request->interiorf;
        $newfiscal->entre = $request->entref;
        $newfiscal->colonia = $request->coloniaf;
        $newfiscal->localidad = $request->localidadf;
        $newfiscal->municipio = $request->municipiof;
        $newfiscal->estado = $request->estadof;
        $newfiscal->cp = $request->cp_f;
        $newfiscal->tipo = $request->tipof;
        $newfiscal->save();


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
        //dd($request);

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
        return redirect()->back()->with('failed', 'No se puede eliminar');
    }

    public function download($id, $doc)
    {
        $book = userdocs::where('id', $id)->firstOrFail();

        if (empty($book) === false) {
            $pathToFile = storage_path("app/public/docusers/" . $book->$doc);
            if (file_exists($pathToFile) === true &&  is_file($pathToFile) === true) {
                // return response()->download($pathToFile);
                return response()->file($pathToFile);
            } else {
                return redirect('404');
            }
        }
    }

    /**
     * Limpieza de caracteres invalidos de un email
     *
     * @param string $strEmail Correo a sanitizar
     * @return void
     */
    public function sanitizaEmail($strEmail)
    {
        return  str_replace(
            array('Á', 'À', 'Â', 'Ä', 'á', 'à', 'ä', 'â', 'ª', 'É', 'È', 'Ê', 'Ë', 'é', 'è', 'ë', 'ê', 'Í', 'Ì', 'Ï', 'Î', 'í', 'ì', 'ï', 'î', 'Ó', 'Ò', 'Ö', 'Ô', 'ó', 'ò', 'ö', 'ô', 'Ú', 'Ù', 'Û', 'Ü', 'ú', 'ù', 'ü', 'û', 'Ñ', 'ñ', 'Ç', 'ç'),
            array('A', 'A', 'A', 'A', 'a', 'a', 'a', 'a', 'a', 'E', 'E', 'E', 'E', 'e', 'e', 'e', 'e', 'I', 'I', 'I', 'I', 'i', 'i', 'i', 'i', 'O', 'O', 'O', 'O', 'o', 'o', 'o', 'o', 'U', 'U', 'U', 'U', 'u', 'u', 'u', 'u', 'N', 'n', 'C', 'c'),
            $strEmail
        );
    }

    /**
     * Genera el correo empresarial del usuario
     *
     * @param [type] $strNombre
     * @param [type] $strPaterno
     * @param [type] $strMaterno
     * @return string email
     */
    public function generarCorreoEmpresarial($strNombre, $strPaterno, $strMaterno = null)
    {
        $strEmail =  $this->sanitizaEmail(mb_strtolower(Str::substr($strNombre, 0, 1) . str_replace(' ', '', $strPaterno) . '@q2ces.com', 'UTF-8'));

        // existe el correo
        $objCorreo = personal::where('mailEmpresarial', $strEmail)->first();

        if ($objCorreo) {
            if ($strMaterno != "") {
                $strEmail2 =  $this->sanitizaEmail(
                    mb_strtolower(Str::substr($strNombre, 0, 1) . str_replace(' ', '', $strPaterno) . str_replace(' ', '', $strMaterno) . '@q2ces.com', 'UTF-8')
                );

                $objCorreo = personal::where('mailEmpresarial', $strEmail2)->first();
                if ($objCorreo) {
                    // existe y se regresa con el dia
                    $strEmail3 =  $this->sanitizaEmail(
                        mb_strtolower(Str::substr($strNombre, 0, 1) . str_replace(' ', '', $strPaterno) . str_replace(' ', '', $strMaterno) . date('d') . '@q2ces.com', 'UTF-8')
                    );
                    return $strEmail3;
                } else {
                    //*** se regresa con el segundo apellido */
                    return $strEmail2;
                }
            } else {
                // no existe segundo apellido y se pone el dia
                $strEmail3 =  $this->sanitizaEmail(
                    mb_strtolower(Str::substr($strNombre, 0, 1) .  str_replace(' ', '', $strPaterno)  . date('d') . '@q2ces.com', 'UTF-8')
                );
                return $strEmail3;
            }
        } else {
            return $strEmail;
        }
    }
}
