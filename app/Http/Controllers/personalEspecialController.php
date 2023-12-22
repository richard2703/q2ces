<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\calendarioPrincipal;
use App\Models\contactos;
use App\Models\equipo;
use App\Models\eventosCalendarioTipos;
use App\Models\fiscal;
use App\Models\nomina;
use App\Models\personal;
use App\Models\puesto;
use App\Models\puestoNivel;
use App\Models\User;
use App\Models\userdocs;
use App\Models\userEstatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class personalEspecialController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('personal_index'), 403);

        $estatus = $request->input('estatus', '1');

        $personal = personal::select(
            'personal.*',
            'puesto.nombre as puesto',
            'userEstatus.nombre AS estatus'
        )
            ->join('nomina', 'nomina.personalId', '=', 'personal.id')
            ->join('userEstatus', 'userEstatus.id', '=', 'personal.estatusId')
            ->leftJoin('puesto', 'puesto.id', '=', 'nomina.puestoId')
            ->whereNotNull('personal.personalEspecial');

        if ($estatus !== '0') {
            $personal->where('personal.estatusId', $estatus);
        }

        $personal = $personal->orderBy('nombres', 'asc')->paginate(15);
        $vctPuestos = puesto::orderBy('nombre', 'asc')->get();
        $vctNiveles = puestoNivel::orderBy('nombre', 'asc')->get();
        $vctEstatus = userEstatus::all();
        $roles = Role::all()->pluck('name', 'id');
        // dd($personal);

        return view('personal.indexPersonalEspecial', compact('personal', 'vctPuestos', 'vctNiveles', 'vctEstatus', 'roles'));
    }

    public function store(Request $request)
    {
        abort_if(Gate::denies('personal_create'), 403);
        $personal = $request->all();
        $puestoNivel = puesto::where('id', $personal['puestoId'])->first();

        $personal['nivelPuestoId'] = $puestoNivel->puestoNivelId;
        //dd($personal);
        // conversion a mayuscula de algunos campos
        $personal['mailpersonal'] = strtolower($personal['mailpersonal']);
        /* Generación del email empresarial */
        $personal['mailEmpresarial'] =  strtolower($this->generarCorreoEmpresarial($personal['nombres'], $personal['apellidoP'], $personal['apellidoM']));

        // $existeUsuario = User::where('email', $personal['mailEmpresarial'])->get();

        // if ($existeUsuario->isEmpty() == true) {
        //     $roles[] = 2;
        //     $newuser = new User();
        //     $newuser->name = Str::substr($personal['nombres'], 0, 1) . ' ' . str_replace(' ', '', $personal['apellidoP']) . ' ' . str_replace(' ', '', $personal['apellidoM']);
        //     // $newuser->username =  Str::substr( $personal[ 'nombres' ], 0, 1 ) . $personal[ 'apellidoP' ];
        //     $newuser->email =  $personal['mailEmpresarial'];
        //     $newuser->password = bcrypt('12345678');
        //     $newuser->syncRoles($roles);
        //     $newuser->save();

        //     //** guardamos el id de usuario para el registro de personal */
        //     $personal['userId'] = $newuser->id;
        // }
        // dd($request);

        $personalNew = personal::create($personal);
        /*** directorio contenedor de su información */
        $pathPesonal = str_pad($personalNew->id, 4, '0', STR_PAD_LEFT);
        // dd($request);
        if ($request->hasFile('foto')) {
            // dd( $request );
            $personalNew->foto = time() . '_' . $request->file('foto')->getClientOriginalName();
            //$maqimagen = maqimagen::create( $imagen );
            $request->file('foto')->storeAs('/public/personal/' . $pathPesonal, $personalNew->foto);
            $personalNew->save();
        }

        $newnomina = new nomina();
        $newnomina->personalId = $personalNew->id;
        $newnomina->nomina = null;
        $newnomina->imss = null;
        $newnomina->clinica = null;
        $newnomina->infonavit = null;
        $newnomina->afore = null;
        $newnomina->pago = null;
        $newnomina->tarjeta = null;
        $newnomina->banco = null;
        // $newnomina->puesto = null;
        $newnomina->ingreso = null;
        $newnomina->horario = null;
        $newnomina->hEntrada = null;
        $newnomina->hSalida = null;
        $newnomina->hEntradaSabado = null;
        $newnomina->hSalidaSabado = null;
        $newnomina->jefeId = null;
        $newnomina->neto = null;
        $newnomina->isr = null;
        $newnomina->fechaPagoPrimaVac = null;
        $newnomina->puestoId = $personalNew->puestoId;
        $newnomina->asistencia =  null;
        $newnomina->diario = null;
        $newnomina->save();

        Session::flash('message', 1);
        return redirect()->route('personalEspecial.index');
    }

    public function update(Request $request, personal $no)
    {
        abort_if(Gate::denies('personal_edit'), 403);
        // $request->validate([
        //     'nombres' => 'required|max:150',
        //     'apellidoP' => 'required|max:150',
        //     'apellidoM' => 'nullable|max:150',
        //     'aler' => 'nullable|max:150',
        //     'celular' => 'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:16',
        //     'mailEmpresarial' => 'nullable|email|max:200',
        //     'fechaNacimiento' => 'nullable|date|date_format:Y-m-d',
        //     // 'puestoNivelId' => 'required',
        //     'puestoId' => 'required',
        //     'ingreso' => 'required|date|date_format:Y-m-d',
        //     'diario' => 'required',

        //     'lugarNacimiento' => 'nullable|max:200',
        //     'curp' => 'nullable|max:20',
        //     'rfc' => 'nullable|max:20',
        //     'ine' => 'nullable|max:20',
        //     'licencia' => 'nullable|max:20',
        //     'cpf' => 'nullable|max:25',
        //     'cpe' => 'nullable|max:25',
        //     'hijos' => 'nullable|numeric',
        //     'profe' => 'nullable|max:150',
        //     'mailpersonal' => 'nullable|email|max:200',

        //     'calle' => 'nullable|max:200',
        //     'numero' => 'nullable|max:20',
        //     'interior' => 'nullable|max:20',
        //     'colonia' => 'nullable|max:200',
        //     'cp' => 'nullable|min:5',
        //     'municipio' => 'nullable|max:200',
        //     'estado' => 'nullable|max:200',
        //     'casa' => 'nullable|max:200',

        //     'callef' => 'nullable|max:200',
        //     'numerof' => 'nullable|max:20',
        //     'interiorf' => 'nullable|max:20',
        //     'coloniaf' => 'nullable|max:200',
        //     'cp_f' => 'nullable|min:5',
        //     'municipiof' => 'nullable|max:200',
        //     'estadof' => 'nullable|max:200',
        //     'entref' => 'nullable|max:200',

        //     'nombreE' => 'nullable|max:150',
        //     'nombreP' => 'nullable|max:150',
        //     'nombreM' => 'nullable|max:150',
        //     'particularE' => 'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:16',
        //     'celularE' => 'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:16',

        //     'nombreB' => 'nullable|max:150',
        //     'apellidoPB' => 'nullable|max:150',
        //     'apellidoMB' => 'nullable|max:150',
        //     'particularB' => 'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:16',
        //     'celularB' => 'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:16',
        //     'nacimientoB' => 'nullable|date|date_format:Y-m-d',

        //     'nomina' => 'nullable|numeric',
        //     'imss' => 'nullable|numeric',
        //     'clinica' => 'nullable|max:150',
        //     'infonavit' => 'nullable|max:20',
        //     'afore' => 'nullable|max:20',
        //     'tarjeta' => 'nullable|max:20',
        //     'banco' => 'nullable|max:150',
        //     'puesto' => 'nullable|max:150',
        //     'horario' => 'nullable|max:150',
        //     'jefeId' => 'nullable|numeric',
        //     'neto' => 'nullable|numeric',
        //     'ingreso' => 'nullable|date|date_format:Y-m-d',

        //     'botas' => 'nullable|numeric',
        //     'pc' => 'nullable|max:200',
        //     'pcSerial' => 'nullable|max:50',
        //     'celularEquipo' => 'nullable|max:200',
        //     'celularImei' => 'nullable|numeric',
        //     'radio' => 'nullable|max:200',
        //     'radioSerial' => 'nullable|numeric',
        //     'cargadorSerial' => 'nullable|numeric',
        // ], [
        //     'nombres.required' => 'El campo nombre(s) es obligatorio.',
        //     'nombres.max' => 'El campo nombre(s) excede el límite de caracteres permitidos.',
        //     'apellidoP.required' => 'El campo apellido paterno es obligatorio.',
        //     'apellidoP.max' => 'El campo apellido paterno excede el límite de caracteres permitidos.',
        //     'apellidoM.max' => 'El campo apellido materno excede el límite de caracteres permitidos.',
        //     // 'puestoNivelId' => 'El campo de nivel de puesto es obligatorio',
        //     'puestoId' => 'El campo de puesto es obligatorio',
        //     'ingreso' => 'El campo de fecha de ingreso es obligatorio',
        //     'ingreso.date_format' => 'El campo fecha de ingreso tiene un formato inválido.',
        //     'diario' => 'El campo de salario diario es obligatorio',
        //     'aler.max' => 'El campo alergías excede el límite de caracteres permitidos.',
        //     'lugarNacimiento.max' => 'El campo lugar de nacimiento excede el límite de caracteres permitidos.',
        //     'fechaNacimiento.date_format' => 'El campo fecha de nacimiento tiene un formato inválido.',
        //     'rfc.max' => 'El campo RFC excede el límite de caracteres permitidos.',
        //     'curp.max' => 'El campo CURP excede el límite de caracteres permitidos.',
        //     'ine.max' => 'El campo folio INE excede el límite de caracteres permitidos.',
        //     'licencia.max' => 'El campo licencia excede el límite de caracteres permitidos.',
        //     'cpf.max' => 'El campo Cédula Profesional Federal excede el límite de caracteres permitidos.',
        //     'cpe.max' => 'El campo Cédula Profesional Estatal excede el límite de caracteres permitidos.',
        //     'civil.max' => 'El campo estado civil excede el límite de caracteres permitidos.',
        //     'profe.max' => 'El campo profesión excede el límite de caracteres permitidos.',
        //     'celular.numeric' => 'El campo celular solo acepta números.',
        //     'celular.min' => 'El campo celular requiere de al menos 10 caracteres.',
        //     'calle.max' => 'El campo calle excede el límite de caracteres permitidos.',
        //     'numero.max' => 'El campo número excede el límite de caracteres permitidos.',
        //     'interior.max' => 'El campo interior excede el límite de caracteres permitidos.',
        //     'colonia.max' => 'El campo colonia excede el límite de caracteres permitidos.',
        //     'cp.min' => 'El campo código postal requiere de al menos 5 caracteres.',
        //     'municipio.max' => 'El campo municipio excede el límite de caracteres permitidos.',
        //     'estado.max' => 'El campo estado excede el límite de caracteres permitidos.',
        //     'casa.max' => 'El campo casa en domicilio fiscal excede el límite de caracteres permitidos.',
        //     'callef.max' => 'El campo calle en domicilio fiscal excede el límite de caracteres permitidos.',
        //     'numerof.max' => 'El campo número en domicilio fiscal excede el límite de caracteres permitidos.',
        //     'interiorf.max' => 'El campo interior en domicilio fiscal excede el límite de caracteres permitidos.',
        //     'coloniaf.max' => 'El campo colonia en domicilio fiscal excede el límite de caracteres permitidos.',
        //     'cp_f.min' => 'El campo código postal en domicilio fiscal requiere de al menos 5 caracteres.',
        //     'municipiof.max' => 'El campo municipio en domicilio fiscal excede el límite de caracteres permitidos.',
        //     'estadof.max' => 'El campo estado en domicilio fiscal excede el límite de caracteres permitidos.',
        //     'entref.max' => 'El campo entre calles en domicilio fiscal excede el límite de caracteres permitidos.',
        //     'nombreE.max' => 'El campo nombre en personales excede el límite de caracteres permitidos.',
        //     'nombreP.max' => 'El campo apellido paterno en personales excede el límite de caracteres permitidos.',
        //     'nombreM.max' => 'El campo apellido materno en personales excede el límite de caracteres permitidos.',
        //     'parentesco.max' => 'El campo parentesco en personales excede el límite de caracteres permitidos.',
        //     'particularE.min' => 'El campo teléfono particular en personales requiere de al menos 10 caracteres.',
        //     'celularE.min' => 'El campo celular en personales requiere de al menos 10 caracteres.',
        //     'nombreB.max' => 'El campo nombre en beneficiario excede el límite de caracteres permitidos.',
        //     'apellidoPB.max' => 'El campo apellido paterno en beneficiario excede el límite de caracteres permitidos.',
        //     'apellidoMB.max' => 'El campo apellido materno en beneficiario excede el límite de caracteres permitidos.',
        //     'particularB.min' => 'El campo teléfono beneficiario en contacto requiere de al menos 10 caracteres.',
        //     'celularB.min' => 'El campo celular en beneficiario requiere de al menos 10 caracteres.',
        //     'nomina.max' => 'El campo número de nómina excede el límite de caracteres permitidos.',
        //     'imss.max' => 'El campo número de IMSS excede el límite de caracteres permitidos.',
        //     'clinica.max' => 'El campo nombre de clínica excede el límite de caracteres permitidos.',
        //     'infonavit.max' => 'El campo número de Infonavit excede el límite de caracteres permitidos.',
        //     'afore.max' => 'El campo afore excede el límite de caracteres permitidos.',
        //     'tarjeta.max' => 'El campo tarjeta excede el límite de caracteres permitidos.',
        //     'banco.max' => 'El campo nombre de banco excede el límite de caracteres permitidos.',
        //     'puesto.max' => 'El campo nombre de puesto excede el límite de caracteres permitidos.',
        //     'horario.max' => 'El campo horario excede el límite de caracteres permitidos.',
        //     'botas.max' => 'El campo botas excede el límite de caracteres permitidos.',
        //     'pc.max' => 'El campo Equipo de cómputo excede el límite de caracteres permitidos.',
        //     'pcSerial.max' => 'El campo serial de equipo de cómputo excede el límite de caracteres permitidos.',
        //     'celularEquipo.max' => 'El campo equipo celular excede el límite de caracteres permitidos.',
        //     'celularEmei.max' => 'El campo IMEI de celular excede el límite de caracteres permitidos.',
        //     'radio.max' => 'El campo radio excede el límite de caracteres permitidos.',
        //     'radioSerial.max' => 'El campo serial de radio excede el límite de caracteres permitidos.',
        //     'radioSerial.numeric' => 'El campo serial de radio debe de ser númerico.',
        //     'cargadorSerial.max' => 'El campo serial de cargador excede el límite de caracteres permitidos.',
        //     'cargadorSerial.numeric' => 'El campo serial del cargador debe de ser númerico.',
        // ]);

        $data = $request->all();

        $personal = personal::where('id', $data['id'])->first();
        /*** directorio contenedor de su información */
        $pathPesonal = str_pad($personal->id, 4, '0', STR_PAD_LEFT);
        // dd($request);
        $puestoNivel = puesto::where('id', $personal['puestoId'])->first();

        $personal['nivelPuestoId'] = $puestoNivel->puestoNivelId;
        // dd($personal);
        // if ($request->hasFile('foto')) {
        //     $data['foto'] = time() . '_' . 'foto.' . $request->file('foto')->getClientOriginalExtension();
        //     $request->file('foto')->storeAs('/public/personal/' . $pathPesonal, $data['foto']);
        // }
        $pathPesonal = str_pad($personal->id, 4, '0', STR_PAD_LEFT);

        if ($request->hasFile('foto')) {
            $data['foto'] = time() . '_' . 'foto.' . $request->file('foto')->getClientOriginalExtension();

            $request->file('foto')->storeAs('/public/personal/' . $pathPesonal, $data['foto']);
        }
        // dd($data);
        // conversion a minuscula de algunos campos
        $data['mailEmpresarial'] = strtolower($data['mailEmpresarial']);
        $data['mailpersonal'] = strtolower($data['mailpersonal']);

        $personal->update($data);

        $nomina = nomina::where('personalId', $personal->id)->first();
        $nomina->puestoId = $data['puestoId'];
        $nomina->save();
        // dd($data);
        $user = User::where('id', $personal->userId)->first();
        if ($user) {
            $request['name'] = $request['nombres'];
            $request['username'] = $request['nombres'] . $request['apellidoP'];
            $request['email'] = $request['mailEmpresarial'];
            $dataUser = $request->only('name', 'username', 'email');
            $user->update($dataUser);

            // dd($dataUser, $user);
        }

        Session::flash('message', 1);

        return redirect()->route('personalEspecial.index');
    }

    public function generarCorreoEmpresarial($strNombre, $strPaterno, $strMaterno = null)
    {
        $strEmail =  $this->sanitizaEmail(mb_strtolower(Str::substr($strNombre, 0, 1) . str_replace(' ', '', $strPaterno) . '@q2ces.com', 'UTF-8'));

        // existe el correo
        $objCorreo = personal::where('mailEmpresarial', $strEmail)->first();

        if ($objCorreo) {
            if ($strMaterno != '') {
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

    public function sanitizaEmail($strEmail)
    {
        return  str_replace(
            array('Á', 'À', 'Â', 'Ä', 'á', 'à', 'ä', 'â', 'ª', 'É', 'È', 'Ê', 'Ë', 'é', 'è', 'ë', 'ê', 'Í', 'Ì', 'Ï', 'Î', 'í', 'ì', 'ï', 'î', 'Ó', 'Ò', 'Ö', 'Ô', 'ó', 'ò', 'ö', 'ô', 'Ú', 'Ù', 'Û', 'Ü', 'ú', 'ù', 'ü', 'û', 'Ñ', 'ñ', 'Ç', 'ç'),
            array('A', 'A', 'A', 'A', 'a', 'a', 'a', 'a', 'a', 'E', 'E', 'E', 'E', 'e', 'e', 'e', 'e', 'I', 'I', 'I', 'I', 'i', 'i', 'i', 'i', 'O', 'O', 'O', 'O', 'o', 'o', 'o', 'o', 'U', 'U', 'U', 'U', 'u', 'u', 'u', 'u', 'N', 'n', 'C', 'c'),
            $strEmail
        );
    }

    public function destroy($id, $estatusId = 4)
    {
        abort_if(Gate::denies('personal_destroy'), 403);
        $personal = personal::select("*")->where('id', '=', $id)->first();
        // $residenteAutos = residenteAutos::select("*")->where('residenteId', '=', $id)->get();
        // if ($residenteAutos) {
        //     foreach ($residenteAutos as $residenteAto) {
        //         $residenteAto->delete();
        //     }
        // }

        $user = User::where('id', $personal->id)->first();
        $personal->estatusId = $estatusId;
        $personal->save();
        if ($user) {
            $password = Str::random(50);
            $user->estadoId = 2;
            $user->password = bcrypt($password);
            $user->update();
        }

        Session::flash('message', 4);

        return redirect()->route('personalEspecial.index');
    }

    public function cambiaEstatusUsuario($id, $estatusId)
    {
        $objPersona = personal::where('id', '=', $id)->firstOrFail();

        $vctEstatus = userEstatus::select('userEstatus.nombre')->get()->toArray();
        $aEstatus = array();
        foreach ($vctEstatus as   $value) {
            $aEstatus[] = strtolower($value['nombre'] . '_');
        }

        if (empty($objPersona) === false) {
            $strPrefijo = '';
            $objEstatus = userEstatus::where('id', $estatusId)->firstOrFail();

            $objUser = User::where('id', $objPersona->userId)->firstOrFail();

            if (empty($objUser) === false) {
                //** si el estatus es mayor de 1 se debe de realizar ajustes */
                if (empty($objEstatus) === false && $objEstatus->id > 1) {
                    //** para todos los estatus */
                    $strPrefijo = $objEstatus->nombre . '_';

                    $strUserEmail = $strPrefijo .  str_replace($aEstatus, '', $objUser->email);
                    $strUserPwd =  bcrypt($strPrefijo . $objUser->email . now()->toString());

                    $objUser->email = strtolower($strUserEmail);
                    $objUser->password = $strUserPwd;
                    $objUser->update();

                    $strPersonalEmail = $strPrefijo . str_replace($aEstatus, '', $objPersona->mailEmpresarial);

                    $objPersona->mailEmpresarial = strtolower($strPersonalEmail);
                    $objPersona->estatusId = $estatusId;
                    $objPersona->update();

                    // dd( $objPersona );
                } else {
                    /** es activacion */
                    $strUserEmail =  str_replace($aEstatus, '', $objUser->email);
                    $strUserPwd =  bcrypt('12345678');

                    $objUser->email = $strUserEmail;
                    $objUser->password = $strUserPwd;
                    $objUser->update();

                    $strPersonalEmail =  str_replace($aEstatus, '', $objPersona->mailEmpresarial);

                    $objPersona->mailEmpresarial = $strPersonalEmail;
                    $objPersona->estatusId = $estatusId;
                    $objPersona->update();
                }
            }
        }
    }

    public function generate(Request $request)
    {
        $personal = personal::where('id', $request['personalIdRoles'])->first();
        // dd($personal, $request);
        if ($personal->userId != null) {
            Session::flash('message', 7);
        } else {
            $userData = [
                'name' => $personal->nombres,
                'username' => $personal->nombres . $personal->apellidoP,
                'email' => $personal->mailEmpresarial,
                'password' => bcrypt('12345678')
            ];

            $newUser = User::create($userData);
            if (isset($request['roles'])) {
                $roles = $request->input('roles', 'id');
                $newUser->syncRoles($roles);
            }
            $personal->userId = $newUser->id;
            $personal->save();

            Session::flash('message', 8);
        }
        // dd($userData, $newUser, $personal);
        return redirect()->route('personalEspecial.index');
    }
}
