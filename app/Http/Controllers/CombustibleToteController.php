<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\carga;
use App\Models\cisternas;
use App\Models\descarga;
use App\Models\maquinaria;
use App\Models\personal;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;

class CombustibleToteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $extintores = extintores::orderBy('created_at', 'desc')->paginate(15);
        // $ubicaciones = ubicaciones::all();
        $usuarios = personal::all();
        $despachador = personal::join('puesto', 'personal.puestoId', 'puesto.id')
            ->join('puestoNivel', 'puesto.puestoNivelId', 'puestoNivel.id')
            ->select('personal.id', 'personal.nombres', 'personal.apellidoP')
            ->where('puestoNivel.usoCombustible', 1)->get();
        // dd($despachador);
        $despachadores = personal::join('puesto', 'personal.puestoId', 'puesto.id')
            ->join('puestoNivel', 'puesto.puestoNivelId', 'puestoNivel.id')
            ->select('personal.id', 'personal.nombres', 'personal.apellidoP')
            ->where('puestoNivel.usoCombustible', 1)->get();
        $personal = personal::join('puesto', 'personal.puestoId', 'puesto.id')
            ->join('puestoNivel', 'puesto.puestoNivelId', 'puestoNivel.id')
            ->select('personal.id', 'personal.nombres', 'personal.apellidoP')
            ->where('puestoNivel.usoCombustible', 1)->get();
        $maquinaria = maquinaria::where("cisterna", 0)->orderBy('nombre', 'asc')->get();
        $cisternas = maquinaria::where("cisterna", 1)->orderBy('nombre', 'asc')->get();

        // $lastcarga = carga::select('maquinariaId')->selectraw('max(id) as id')->groupBy('maquinariaId')->get();
        $lastcarga = carga::select('maquinariaId')->selectraw('max(id) as id')->groupBy('maquinariaId')->get();

        // $cisternas = maquinaria::join('carga', 'maquinaria.id', '=', 'carga.maquinariaId')
        //     ->joinSub($lastcarga, 'last_carga', function ($join) {
        //         $join->on('carga.id', '=', 'last_carga.id');
        //     })
        //     ->get();

        $sql = 'select m.id,m.cisternaNivel ,m.nombre,c.precio ,c.litros, c.created_at  from maquinaria m
            inner join carga c on m.id =c.maquinariaId
            inner join (select max(c.id) id from carga c group by maquinariaId ) s
            on s.id=c.id
            where m.cisterna = 1
            order by m.nombre ';

        $cisterna = cisternas::where('nombre', '=', 'Tote')->get();

        $date = Carbon::now();
        $endDate = $date->subMonth();
        // dd($date->toDateString(), $endDate->toDateString());

        $sql1 = " select id,sum(litros) as suma ,day(created_at) as dia from carga c where created_at
                        between '" . $endDate->toDateString() . "' and '" . Carbon::now()->addDay()->toDateString() . "' and maquinariaId = '9'
                        group by date(created_at) order by created_at";
        $script = DB::select($sql1);

        $suma = [];
        $dia = [];
        foreach ($script as $key) {
            array_push($suma, $key->suma);
            array_push($dia, $key->dia);
        }

        $cargas = carga::select(
            'carga.id',
            db::raw("CONCAT(maquinaria.identificador,' ',maquinaria.nombre) AS equipo"),
            'carga.maquinariaid',
            DB::raw("CONCAT(personal.nombres,' ',personal.apellidoP) AS operador"),
            'carga.operadorid',
            'carga.litros',
            'carga.precio',
            'carga.created_at AS fecha',
            'cisternas.nombre',
            'carga.horaLlegadaCarga'
        )
            ->join('maquinaria', 'maquinaria.id', '=', 'carga.maquinariaId')
            ->join('personal', 'personal.id', '=', 'carga.operadorId')
            ->join('cisternas', 'cisternas.id', '=', 'carga.tipoCisternaId')
            ->where('maquinaria.cisterna', '=', 1)
            ->where('cisternas.nombre', '=', 'Tote')
            ->orderBy('carga.created_at', 'desc')
            ->paginate(10);
        // dd($cargas);
        $descargas = descarga::select(
            'descarga.id',
            'descarga.maquinariaId',
            'descarga.operadorId',
            db::raw("CONCAT(maquinaria.identificador,' ',maquinaria.nombre) AS maquinaria"),
            DB::raw("CONCAT(personal.nombres,' ',personal.apellidoP) AS operador"),
            'descarga.servicioId',
            'descarga.receptorId',
            db::raw("CONCAT(m2.identificador,' ',m2.nombre) AS servicio"),
            DB::raw("CONCAT(p2.nombres,' ',p2.apellidoP) AS receptor"),
            'descarga.km',
            'descarga.horas',
            'descarga.imgHoras',
            'descarga.imgKm',
            'descarga.litros',
            'descarga.created_at AS fecha',
            'descarga.ticket',
            'descarga.descargaDetalleId',
            'descarga.tipoCisternaId',
            'cisternas.nombre',
            'descarga.id',
            'detalles.*',
        )
            ->join('maquinaria', 'maquinaria.id', '=', 'descarga.maquinariaId')
            ->join('personal', 'personal.id', '=', 'descarga.operadorId')
            ->leftJoin('maquinaria as m2', 'm2.id', '=', 'descarga.servicioId')
            ->join('personal as p2', 'p2.id', '=', 'descarga.receptorId')
            ->join('cisternas', 'cisternas.id', '=', 'descarga.tipoCisternaId')
            ->leftJoin('descargaDetalle as detalles', 'descarga.descargaDetalleId', '=', 'detalles.id')
            ->whereNotNull('descarga.tipoCisternaId')
            ->orderBy('descarga.created_at', 'desc')
            ->paginate(10);

        // dd($descargas);

        return view('combustibleTote.indexCombustibleTote', compact('despachador', 'personal', 'maquinaria', 'cisternas', 'cisterna', 'suma', 'dia', 'despachadores', 'cargas', 'descargas', 'usuarios'));
        // return view('extintores.indexExtintores', compact('extintores', 'ubicaciones'));
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
        abort_if(Gate::denies('combustible_create'), 403);
        // dd('carga', $request);
        $request->validate([
            'litros' => 'required|numeric',
            // 'precio' => 'required|numeric|max:30|min:10',
        ], [
            'litros.required' => 'El campo litros es obligatorio.',
            'precio.required' => 'El campo precio es obligatorio.',
            'litros.numeric' => 'El campo litros debe de ser numérico.',
            'precio.numeric' => 'El campo precio debe de ser numérico.',
            // 'precio.minimo' => 'El campo precio debiera de ser mayor a 10 pesos.',
            // 'precio.maximo' => 'El campo precio debiera de ser menor a 30 pesos.',
        ]);
        $carga = $request->only(
            'litros',
            'maquinariaId',
            'operadorId',
            'precio',
            'horaLlegadaCarga',
            'comentario',
            'tipoCisternaId'
        );
        $carga['userId'] = auth()->user()->id;
        //*** guardamos el registro */
        // dd($request);
        //buscamos el equipo para actulizar el nivel de la cisterna
        $cisterna =   maquinaria::where("id", $request['maquinariaId'])->first();
        $cisterna->cisternaNivel = ($cisterna->cisternaNivel - $request['litros']);

        if ($request['kilometraje'] > $cisterna->kilometraje) {
            $cisterna->kilometraje = $request['kilometraje'];
            carga::create($carga);
            $cisterna->update();
            $cisternaTipo = cisternas::where("id", $request['tipoCisternaId'])->first();
            $cisternaTipo->contenido = ($cisternaTipo->contenido + $request['litros']);
            $cisternaTipo->ultimoPrecio = $request['precio'];
            $cisternaTipo->ultimaCarga = $request['litros'];
            $cisternaTipo->update();
            // dd($cisternaTipo);
            Session::flash('message', 1);
        } else {
            Session::flash('message', 6);
        }

        return redirect()->route('combustibleTote.index');
    }

    public function storeDescarga(Request $request)
    {
        // dd($request);
        abort_if(Gate::denies('combustible_create'), 403);

        $blnHayImagen = false;
        $blnHayDatos = false;

        // $request->validate([
        //     'litros' => 'required|numeric',
        //     'km' => 'nullable|numeric',
        //     'horas' => 'nullable|numeric',
        //     'imgKm' => 'nullable',
        //     'imgHoras' => 'nullable',
        // ], [
        //     'litros.required' => 'El campo litros es obligatorio.',
        //     'km.required' => 'El campo Km/Mi es obligatorio.',
        //     'horas.required' => 'El campo horómetro es obligatorio.',
        //     'imgKm.required' => 'El campo imagen de kilometraje es obligatorio.',
        //     'imgHoras.required' => 'El campo imagen de horómetro es obligatorio.',
        //     'litros.numeric' => 'El campo litros debe de ser numérico.',
        //     // 'km.numeric' => 'El campo Km/Mi debe de ser numérico.',
        //     // 'horas.numeric' => 'El campo horometro debe de ser numérico.',
        // ]);


        if (is_null($request['horas']) == false && strlen(trim($request['horas'])) > 0) {
            $blnHayDatos = true;
        } else {
            $request['horas'] = 0;
        }

        if (is_null($request['horas']) && strlen(trim($request['km'])) > 0) {
            $blnHayDatos = true;
        } else {
            $request['km'] = 0;
        }

        // $descarga = $request->only(
        //     'horas',
        //     'km',
        //     'imgKm',
        //     'imgHoras',
        //     'litros',
        //     'maquinariaId',
        //     'operadorId',
        //     'receptorId',
        //     'servicioId',
        // );
        // dd($request);
        $descarga = $request->all();

        if ($request->hasFile("imgKm")) {
            $descarga['imgKm'] = time() . '_' . 'imgKm.' . $request->file('imgKm')->getClientOriginalExtension();
            $request->file('imgKm')->storeAs('/public/combustibles', $descarga['imgKm']);
            $blnHayImagen = true;
        }

        if ($request->hasFile("imgHoras")) {
            $descarga['imgHoras'] = time() . '_' . 'imgHoras.' . $request->file('imgHoras')->getClientOriginalExtension();
            $request->file('imgHoras')->storeAs('/public/combustibles', $descarga['imgHoras']);
            $blnHayImagen = true;
        }

        //buscamos el equipo para actualizar el nivel de la cisterna
        $cisterna =  maquinaria::where("id", $request['maquinariaId'])->first();
        $cisterna->cisternaNivel = ($cisterna->cisternaNivel + $request['litros']);
        $descarga['userId'] = auth()->user()->id;
        descarga::create($descarga);

        if ($request['litros'] != null) {
            $cisternaTipoTote = cisternas::where("nombre", 'Tote')->first();
            $cisternaTipoTote->contenido = ($cisternaTipoTote->contenido - $request['litros']);
            $cisternaTipoTote->update();
        }

        if ($request['grasa'] != null) {
            $cisternaTipoGrasa = cisternas::where("nombre", 'Grasa')->first();
            $cisternaTipoGrasa->contenido = ($cisternaTipoGrasa->contenido - $request['grasa']);
            $cisterna->grasas = ($cisterna->grasas + $request['grasa']);
            $cisternaTipoTote->update();
        }

        if ($request['hidraulico'] != null) {
            $cisternaTipoHidraulico = cisternas::where("nombre", 'Aceite Hidraulico')->first();
            $cisternaTipoHidraulico->contenido = ($cisternaTipoHidraulico->contenido - $request['hidraulico']);
            $cisterna->aceitehidra = ($cisterna->aceitehidra + $request['hidraulico']);
            $cisternaTipoHidraulico->update();
        }

        if ($request['Anticongelante'] != null) {
            $cisternaTipoAnticongelante = cisternas::where("nombre", 'Anticongelante')->first();
            $cisternaTipoAnticongelante->contenido = ($cisternaTipoAnticongelante->contenido - $request['Anticongelante']);
            $cisterna->anticongelante = ($cisterna->anticongelante + $request['Anticongelante']);
            $cisternaTipoAnticongelante->update();
        }

        if ($request['motor'] != null) {
            $cisternaTipoMotor = cisternas::where("nombre", 'Aceite Motor')->first();
            $cisternaTipoMotor->contenido = ($cisternaTipoMotor->contenido - $request['motor']);
            $cisterna->aceitemotor = ($cisterna->aceitemotor + $request['motor']);
            $cisternaTipoMotor->update();
        }

        if ($request['otro'] != null) {
            $cisternaTipoOtros = cisternas::where("nombre", 'Otros')->first();
            $cisternaTipoOtros->contenido = ($cisternaTipoOtros->contenido - $request['otro']);
            $cisterna->otroCombustible = ($cisterna->otroCombustible + $request['otro']);
            $cisternaTipoOtros->update();
        }

        if ($request['direccion'] != null) {
            $cisternaTipoDireccion = cisternas::where("nombre", 'Aceite Direccion')->first();
            $cisternaTipoDireccion->contenido = ($cisternaTipoDireccion->contenido - $request['direccion']);
            $cisterna->aceitedirec = ($cisterna->aceitedirec + $request['direccion']);
            $cisternaTipoDireccion->update();
        }

        if ($request['kilometraje'] > $cisterna->kilometraje) {
            $cisterna->kilometraje = $request['kilometraje'];
            $cisterna->update();
            // dd($cisternaTipo);
            Session::flash('message', 1);
        } else {
            Session::flash('message', 6);
        }
        Session::flash('message', 1);

        return redirect()->route('combustibleTote.index');

        //*** Preguntamos si hay un valor cargado de kilometraje o del horometro */
        // if ($blnHayDatos == false) {
        //     return redirect()->back()->withInput()->withErrors("Se requiere al menos que registre el valor del Kilometraje o del Horometro.");
        // }

        //*** Preguntamos si no hay una imagen cargada */
        // if ($blnHayImagen == false) {
        //     return redirect()->back()->withInput()->withErrors("Se requiere al menos una imagen de kilometraje o del homometro.");
        // }


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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
