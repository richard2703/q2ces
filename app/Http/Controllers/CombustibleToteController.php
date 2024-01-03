<?php

namespace App\Http\Controllers;

use App\Helpers\Calculos;
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
        $cisternaTipo = cisternas::where("id", 1)->first();
        $despachador = personal::join('puesto', 'personal.puestoId', 'puesto.id')
            ->join('puestoNivel', 'puesto.puestoNivelId', 'puestoNivel.id')
            ->select('personal.id', 'personal.nombres', 'personal.apellidoP')
            ->where('puestoNivel.usoCombustible', 1)
            ->where('personal.estatusId', 1)->orderBy('nombres', 'asc')->get();
        // dd($despachador);
        $despachadores = personal::join('puesto', 'personal.puestoId', 'puesto.id')
            ->join('puestoNivel', 'puesto.puestoNivelId', 'puestoNivel.id')
            ->select('personal.id', 'personal.nombres', 'personal.apellidoP')
            ->where('puestoNivel.usoCombustible', 1)
            ->where('personal.estatusId', 1)->orderBy('nombres', 'asc')->get();
        $personal = personal::join('puesto', 'personal.puestoId', 'puesto.id')
            ->join('puestoNivel', 'puesto.puestoNivelId', 'puestoNivel.id')
            ->select('personal.id', 'personal.nombres', 'personal.apellidoP')
            ->where('puestoNivel.usoCombustible', 1)
            ->where('personal.estatusId', 1)->orderBy('nombres', 'asc')->get();
        $maquinaria = maquinaria::where("cisterna", 1)->orderBy('nombre', 'asc')->get();
        $cisternas = maquinaria::where("cisterna", 0)->orderBy('nombre', 'asc')->get();

        // $lastcarga = carga::select('maquinariaId')->selectraw('max(id) as id')->groupBy('maquinariaId')->get();
        $lastcarga = carga::select('maquinariaId')->selectraw('max(id) as id')->groupBy('maquinariaId')->get();
        // dd($lastcarga);

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
            'carga.horaLlegadaCarga',
            'carga.comentario',
            'carga.kilometraje'
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
            'descarga.id as descargaIdTote',
            'descarga.maquinariaId',
            'descarga.operadorId',
            db::raw("CONCAT(maquinaria.identificador,' ',maquinaria.nombre) AS maquinaria"),
            DB::raw("CONCAT(personal.nombres,' ',personal.apellidoP) AS operador"),
            'descarga.servicioId',
            'descarga.receptorId',
            db::raw("CONCAT(m2.identificador,' ',m2.nombre) AS servicio"),
            DB::raw("CONCAT(p2.nombres,' ',p2.apellidoP) AS receptor"),
            'descarga.km',
            'descarga.kilometrajeNuevo',
            'descarga.fechaLlegada',
            'descarga.horas',
            'descarga.imgHoras',
            'descarga.imgKm',
            'descarga.litros',
            'descarga.created_at AS fecha',
            'descarga.ticket',
            // 'descarga.descargaDetalleId',
            'descarga.tipoCisternaId',
            'cisternas.nombre',
            'descarga.grasa',
            'descarga.hidraulico',
            'descarga.anticongelante',
            'descarga.motor',
            'descarga.otro',
            'descarga.direccion',
            'descarga.otroComment',
            'detalles.*',
        )
            ->join('maquinaria', 'maquinaria.id', '=', 'descarga.maquinariaId')
            ->join('personal', 'personal.id', '=', 'descarga.operadorId')
            ->leftJoin('maquinaria as m2', 'm2.id', '=', 'descarga.servicioId')
            ->join('personal as p2', 'p2.id', '=', 'descarga.receptorId')
            ->join('cisternas', 'cisternas.id', '=', 'descarga.tipoCisternaId')
            ->leftJoin('descargaDetalle as detalles', 'descarga.id', '=', 'detalles.descargaId')
            // ->leftJoin('descargaDetalle as detalles', 'descarga.descargaDetalleId', '=', 'detalles.id')
            ->whereNotNull('descarga.tipoCisternaId')
            ->orderBy('descarga.created_at', 'desc')
            ->paginate(10);

        // dd($descargas);
        // dd($cisternas);

        // en este caso solo recuerda que cisternas son las maquinarias pero tuvimos que ponerle ese nombre porque estaba causando conflicto si lo cambiamos a maquinaria y cisterna en singular son las cisternas todas las cisternas del TOTE
        return view('combustibleTote.indexCombustibleTote', compact('cisternaTipo', 'despachador', 'personal', 'maquinaria', 'cisternas', 'cisterna', 'suma', 'dia', 'despachadores', 'cargas', 'descargas', 'usuarios'));
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
            'tipoCisternaId',
            'kilometraje'
        );
        $carga['userId'] = auth()->user()->id;
        //*** guardamos el registro */
        // dd($request);
        //buscamos el equipo para actulizar el nivel de la cisterna
        $cisterna =   maquinaria::where("id", $request['maquinariaId'])->first();
        $cisterna->cisternaNivel = ($cisterna->cisternaNivel - $request['litros']);

        if ($request['kilometraje'] > $cisterna->kilometraje) {
            $cisterna->kilometraje = $request['kilometraje'];

            $cisterna->update();
            $cisternaTipo = cisternas::where("id", $request['tipoCisternaId'])->first();
            $cisternaTipo->contenido = ($cisternaTipo->contenido + $request['litros']);

            $ultimaCarga = carga::where('maquinariaId', $request['maquinariaId'])
                ->whereNull('tipoCisternaId') // Agrega esta condición
                ->latest()
                ->first();

            if ($ultimaCarga) {
                // Asigna el precio de la última carga a la propiedad 'ultimoPrecio' de la cisterna.
                $cisternaTipo->ultimoPrecio = $ultimaCarga->precio;
                $carga['precio'] = $cisternaTipo->ultimoPrecio;
                $cisternaTipo->save();
                carga::create($carga);
            } else {
                dd('Este error se debe a que la carga a la kangoo o al equipo en cuestion no existe y al momento de asignar el ultimo precio al tote marca error.');
            }
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


        // if (is_null($request['horas']) == false && strlen(trim($request['horas'])) > 0) {
        //     $blnHayDatos = true;
        // } else {
        //     $request['horas'] = 0;
        // }

        // if (is_null($request['horas']) && strlen(trim($request['km'])) > 0) {
        //     $blnHayDatos = true;
        // } else {
        //     $request['km'] = 0;
        // }

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
        // date_default_timezone_set('America/Mexico_City');
        $descarga['horas'] = $request['horas'];
        $descarga = $request->all();
        // dd($descarga);

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
        $grasa = cisternas::where("nombre", 'Grasa')->get('ultimoPrecio');
        $anticongelante = cisternas::where("nombre", 'Anticongelante')->get('ultimoPrecio');
        $hidraulico = cisternas::where("nombre", 'Aceite Hidraulico')->get('ultimoPrecio');
        $motor = cisternas::where("nombre", 'Aceite Motor')->get('ultimoPrecio');
        $direccion = cisternas::where("nombre", 'Aceite Direccion')->get('ultimoPrecio');

        if ($request['km'] > $cisterna->kilometraje) {
            $descarga['otroComment'] = $request['otroComment'];
            if ($request['otro'] != null) {
                $descarga['otro'] = $request['otro'];
            } else {
                $descarga['otro'] = 0;
            }
            $descarga['grasaUnitario'] = $grasa[0]['ultimoPrecio'];
            $descarga['hidraulicoUnitario'] = $hidraulico[0]['ultimoPrecio'];
            $descarga['anticongelanteUnitario'] = $anticongelante[0]['ultimoPrecio'];
            $descarga['mototUnitario'] = $motor[0]['ultimoPrecio'];
            $descarga['direccionUnitario'] = $direccion[0]['ultimoPrecio'];
            $descarga['kilometrajeAnterior'] = $cisterna->kilometraje;
            $descarga['kilometrajeNuevo'] = $request['km'];
            $descarga['fechaLlegada'] = Carbon::now();
            descarga::create($descarga);
            $cisterna->kilometraje = $request['km'];
            $cisterna->update();


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
            // dd($cisternaTipo);
            Session::flash('message', 1);
        } else {
            Session::flash('message', 6);
        }

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
    public function updateDescarga(Request $request)
    {
        abort_if(Gate::denies('combustible_edit'), 403);
        $objCalculo = new Calculos();

        // $request->validate([
        //     'descargaLitros' => 'required|numeric',
        //     'descargaKms' => 'required|numeric',
        //     'descargaHoras' => 'required|numeric',
        //     'descargaFileImgKms' => 'nullable',
        //     'descargaFileImgHoras' => 'nullable',
        // ], [
        //     'descargaLitros.required' => 'El campo litros es obligatorio.',
        //     'descargaKms.required' => 'El campo Km/Mi es obligatorio.',
        //     'descargaHoras.required' => 'El campo horómetro es obligatorio.',
        //     'descargaImgenKms.required' => 'El campo imagen de kilometraje es obligatorio.',
        //     'descargaImgenHoras.required' => 'El campo imagen de horómetro es obligatorio.',
        //     'descargaLitros.numeric' => 'El campo litros debe de ser numérico.',
        //     'descargaKms.numeric' => 'El campo Km/Mi debe de ser numérico.',
        //     'descargaHoras.numeric' => 'El campo horometro debe de ser numérico.',
        // ]);
        //*** buscamos el registro */
        $descarga = descarga::where("id", $request['descargaId'])->first();

        // dd($request);
        //*** obtenemos informacion para ajustes */
        $strSegundos = substr($descarga->created_at, -2);
        $decLitros = $descarga->litros;

        $descarga->litros = $request['descargaLitros'];
        $descarga->kilometrajeNuevo = $request['kilometrajeNuevo'];
        $descarga->horas = $request['horas'];
        $descarga->maquinariaId = $request['descargaMaquinaria'];
        $descarga->operadorId = $request['descargaOperador'];
        $descarga->servicioId = $request['descargaServicio'];
        $descarga->receptorId = $request['descargaDespachador'];
        $descarga->fechaLlegada = $request['fechaLlegada'];

        $descarga->grasa = $request['grasa'];
        $descarga->hidraulico = $request['hidraulico'];
        $descarga->anticongelante = $request['Anticongelante'];
        $descarga->motor = $request['motor'];
        $descarga->direccion = $request['direccion'];
        $descarga->otro = $request['otro'];
        $descarga->otroComment = $request['otroComment'];

        // $descarga->created_at = ($request['descargaFecha'] . " " . $request['descargaHora'] . ":" . $strSegundos);

        if ($request->hasFile("descargaFileImgKms")) {
            $descarga->imgKm = time() . '_' . 'imgKm.' . $request->file('descargaFileImgKms')->getClientOriginalExtension();
            $request->file('descargaFileImgKms')->storeAs('/public/combustibles', $descarga->imgKm);
            // $blnHayImagen = true;
        }
        if ($request->hasFile("descargaFileImgHoras")) {
            $descarga->imgHoras = time() . '_' . 'imgHoras.' . $request->file('descargaFileImgHoras')->getClientOriginalExtension();
            $request->file('descargaFileImgHoras')->storeAs('/public/combustibles', $descarga->imgHoras);
            // $blnHayImagen = true;
        }

        // //*** Preguntamos si no hay una imagen cargada */
        // if ($blnHayImagen == false) {
        //     return redirect()->back()->withInput()->withErrors("Se requiere al menos una imagen de kilometraje o del homometro.");
        // }

        // dd($descarga);
        $descarga->update();

        //*** obtenemos el total de cargas y descargas para obtener el nivel de la cisterna */
        $decLitrosCargados = $objCalculo->getTotalLitrosCargas($descarga->maquinariaId);
        $decLitrosDescargados = $objCalculo->getTotalLitrosDescargas($descarga->maquinariaId);
        $litrosActualizados = ($decLitrosCargados - $decLitrosDescargados);

        $cisternaTipo = cisternas::where("id", 1)->first();
        if ($decLitros > $descarga->litros) {
            $litrosFinales = $decLitros - $descarga->litros;
            $cisternaTipo->contenido = ($cisternaTipo->contenido + $litrosFinales);

            $cisternaTipo->save();
        } else {
            $litrosFinales = $decLitros - $descarga->litros;
            $cisternaTipo->contenido = ($cisternaTipo->contenido + ($litrosFinales));

            $cisternaTipo->save();
        }

        //buscamos el equipo para actulizar el nivel de la cisterna
        $cisterna =   maquinaria::where("id", $descarga->maquinariaId)->first();
        $cisterna->cisternaNivel = $litrosActualizados;
        $cisterna->update();

        Session::flash('message', 1);

        if ($descarga->tipoCisternaId != null) {
            return redirect()->route('combustibleTote.index');
        } else {
            return redirect()->action([inventarioController::class, 'index'], ['tipo' => 'combustible']);
        }
    }

    public function updateCarga(Request $request)
    {
        abort_if(Gate::denies('combustible_edit'), 403);
        // dd($request);
        $objCalculo = new Calculos();

        $request->validate([
            'cargaLitros' => 'required|numeric|between:0,9999.99',
            // 'cargaPrecio' => 'required|numeric|max:30|min:10',
        ], [
            'cargaLitros.required' => 'El campo litros es obligatorio.',
            'cargaPrecio.required' => 'El campo precio es obligatorio.',
            'cargaLitros.numeric' => 'El campo litros debe de ser numérico.',
            'cargaPrecio.numeric' => 'El campo precio debe de ser numérico.',
            // 'cargaPrecio.minimo' => 'El campo precio debiera de ser mayor a 10 pesos.',
            // 'cargaPrecio.maximo' => 'El campo precio debiera de ser menor a 30 pesos.',
        ]);
        //*** obtenemos el registro */
        $carga = carga::where("id", $request['cargaId'])->first();

        //*** obtenemos informacion para ajustes */
        // $strSegundos = substr($carga->created_at, -2);
        $decLitros = $carga->litros;

        $carga->litros = $request['cargaLitros'];
        $carga->maquinariaId = $request['cargaMaquinaria'];
        $carga->operadorId = $request['cargaOperador'];
        $carga->precio = $request['cargaPrecio'];
        $carga->comentario = $request['comentario'];
        $carga->horaLlegadaCarga = $request['cargaHora'];
        $carga->created_at = ($request['cargaFecha'] . " " . $request['cargaHora']);
        //*** Actualizamos la carga */
        $ultimaCarga = carga::latest()->first();
        //dd($ultimaCarga->created_at, $carga->created_at);
        $carga->update();

        //*** obtenemos el total de cargas y descargas para obtener el nivel de la cisterna */
        $decLitrosCargados = $objCalculo->getTotalLitrosCargas($carga->maquinariaId);
        $decLitrosDescargados = $objCalculo->getTotalLitrosDescargas($carga->maquinariaId);
        $litrosActualizados = ($decLitrosCargados - $decLitrosDescargados);
        // dd($decLitros, $carga->litros, $decLitrosCargados, $decLitrosDescargados, $litrosActualizados);
        $cisternaTipo = cisternas::where("id", 1)->first();
        if ($decLitros > $carga->litros) {
            $litrosFinales = $decLitros - $carga->litros;
            $cisternaTipo->contenido = ($cisternaTipo->contenido - $litrosFinales);

            if ($ultimaCarga->created_at <= $carga->created_at) {
                $cisternaTipo->ultimaCarga = $carga->litros;
                $cisternaTipo->ultimoPrecio = $carga->precio;
                $cisternaTipo->updated_at = $carga->created_at;
            }
            $cisternaTipo->save();
        } else {
            $litrosFinales = $decLitros - $carga->litros;
            $cisternaTipo->contenido = ($cisternaTipo->contenido - ($litrosFinales));

            if ($ultimaCarga->created_at <= $carga->created_at) {
                $cisternaTipo->ultimaCarga = $carga->litros;
                $cisternaTipo->ultimoPrecio = $carga->precio;
                $cisternaTipo->updated_at = $carga->created_at;
            }
            $cisternaTipo->save();
        }

        //buscamos el equipo para actulizar el nivel de la cisterna
        $cisterna = maquinaria::where("id", $carga->maquinariaId)->first();
        $cisterna->cisternaNivel = $litrosActualizados;
        $cisterna->update();

        Session::flash('message', 1);

        if ($carga->tipoCisternaId != null) {
            return redirect()->route('combustibleTote.index');
        } else {
            return redirect()->action([inventarioController::class, 'index'], ['tipo' => 'combustible']);
        }
    }

    public function updateReserva(Request $request)
    {
        $cisternaTipo = cisternas::where("id", 1)->first();
        $data = $request->all();
        // dd($data);
        $cisternaTipo->update($data);
        return redirect()->route('combustibleTote.index');
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
