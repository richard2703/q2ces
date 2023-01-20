<?php

namespace App\Http\Controllers;

use App\Models\inventario;
use App\Models\personal;
use App\Models\restock;
use App\Models\invconsu;
use App\Models\carga;
use App\Models\descarga;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use App\Helpers\Validaciones;
use App\Models\maquinaria;
use Illuminate\Support\Facades\DB;


class inventarioController extends Controller
{
    public function dash()
    {
        return view('inventario.dashInventario');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($tipo)
    {
        if ($tipo == 'combustible') {

            $despachador = personal::where("userId", auth()->user()->id)->get();
            $despachadores = personal::all();
            $personal = personal::all();
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
            $gasolinas = DB::select($sql);

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
                'carga.created_at AS fecha'
            )
                ->join('maquinaria', 'maquinaria.id', '=', 'carga.maquinariaId')
                ->join('personal', 'personal.id', '=', 'carga.operadorId')
                ->where('maquinaria.cisterna', '=', 1)
                ->orderBy('carga.created_at', 'desc')
                ->paginate(10);

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
                'descarga.created_at AS fecha'
            )
                ->join('maquinaria', 'maquinaria.id', '=', 'descarga.maquinariaId')
                ->join('personal', 'personal.id', '=', 'descarga.operadorId')
                ->join('maquinaria as m2', 'm2.id', '=', 'descarga.servicioId')
                ->join('personal as p2', 'p2.id', '=', 'descarga.receptorId')
                ->orderBy('descarga.created_at', 'desc')
                ->paginate(10);

            // dd($cargas);

            return view('inventario.dashCombustible', compact('despachador', 'personal', 'maquinaria', 'cisternas', 'gasolinas', 'suma', 'dia', 'despachadores', 'cargas', 'descargas'));
        } else {
            $inventarios = inventario::where("tipo",  $tipo)->orderBy('created_at', 'desc')->paginate(5);
            return view('inventario.indexInventario', compact('inventarios'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('inventario.inventarioNuevo');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|max:250',
            'marca' => 'nullable|max:250',
            'modelo' => 'nullable|max:250',
            'proveedor' => 'nullable|max:200',
            'numparte' => 'nullable|max:250',
            'cantidad' => 'required|numeric',
            'valor' => 'required|numeric',
            'reorden' => 'nullable|numeric',
            'maximo' => 'nullable|numeric',
        ], [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'nombre.max' => 'El campo nombre excede el límite de caracteres permitidos.',
            'marca.max' => 'El campo marca excede el límite de caracteres permitidos.',
            'modelo.max' => 'El campo modelo excede el límite de caracteres permitidos.',
            'proveedor.max' => 'El campo proveedor excede el límite de caracteres permitidos.',
            'numparte.max' => 'El campo número de parte excede el límite de caracteres permitidos.',
            'cantidad.numeric' => 'El campo cantidad debe de ser numérico.',
            'valor.numeric' => 'El campo valor debe de ser numérico.',
            'reorden.numeric' => 'El campo valor debe de ser numérico.',
            'maximo.numeric' => 'El campo valor debe de ser numérico.',
        ]);
        $producto = $request->all();

        if ($request->hasFile("imagen")) {
            $producto['imagen'] = time() . '_' . 'imagen.' . $request->file('imagen')->getClientOriginalExtension();
            $request->file('imagen')->storeAs('/public/inventario', $producto['imagen']);
        }

        inventario::create($producto);
        Session::flash('message', 1);

        return redirect()->route('inventario.index', $producto['tipo']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\inventario  $inventario
     * @return \Illuminate\Http\Response
     */
    public function show(inventario $inventario)
    {
        $vctDesde = maquinaria::all();
        $vctHasta = maquinaria::all();
        // dd($vctDesde);
        $inventario = inventario::where("id", $inventario->id)->first();
        return view('inventario.detalleInventario', compact('inventario', 'vctDesde', 'vctHasta'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\inventario  $inventario
     * @return \Illuminate\Http\Response
     */
    public function edit(inventario $inventario)
    {
        $inventario = inventario::where("id", $inventario->id)->first();
        // dd($inventario);
        return view('inventario.detalleInventario', compact('inventario'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\inventario  $inventario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, inventario $inventario)
    {
        // dd($request);

        $request->validate([
            'nombre' => 'required|max:250',
            'marca' => 'nullable|max:250',
            'modelo' => 'nullable|max:250',
            'proveedor' => 'nullable|max:200',
            'numparte' => 'nullable|max:250',
            'cantidad' => 'required|numeric',
            'valor' => 'required|numeric',
            'reorden' => 'nullable|numeric',
            'maximo' => 'nullable|numeric',
        ], [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'nombre.max' => 'El campo nombre excede el límite de caracteres permitidos.',
            'marca.max' => 'El campo marca excede el límite de caracteres permitidos.',
            'modelo.max' => 'El campo modelo excede el límite de caracteres permitidos.',
            'proveedor.max' => 'El campo proveedor excede el límite de caracteres permitidos.',
            'numparte.max' => 'El campo número de parte excede el límite de caracteres permitidos.',
            'cantidad.numeric' => 'El campo cantidad debe de ser numérico.',
            'valor.numeric' => 'El campo valor debe de ser numérico.',
            'reorden.numeric' => 'El campo valor debe de ser numérico.',
            'maximo.numeric' => 'El campo valor debe de ser numérico.',
        ]);
        $data = $request->only(
            'nombre',
            'marca',
            'modelo',
            'proveedor',
            'numparte',
            'cantidad',
            'valor',
            'reorden',
            'maximo',
            'tipo',
        );

        if ($request->hasFile("imagen")) {
            $data['imagen'] = time() . '_' . 'imagen.' . $request->file('imagen')->getClientOriginalExtension();
            $request->file('imagen')->storeAs('/public/inventario', $data['imagen']);
        }

        $inventario->update($data);

        Session::flash('message', 1);
        // dd($request);
        return redirect()->route('inventario.index', $inventario->tipo);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\inventario  $inventario
     * @return \Illuminate\Http\Response
     */
    public function destroy(inventario $inventario)
    {
        return redirect()->back()->with('failed', 'No se puede eliminar');
    }

    /**
     * Agrega mas stock a un producto, crea registro y actualiza el inventario del mismo
     *
     * @param Request $request
     * @return void
     */
    public function restock(Request $request)
    {
        // dd($request);
        $restock = $request->only(
            'productoid',
            'cantidad',
            'costo'
        );

        //*** existe el producto en inventario */
        $producto = inventario::where("id", $request['productoid'])->first();

        if ($producto) {
            //*** creamos el registro del stock */
            $restock = restock::create($restock);

            $producto->cantidad = ($producto->cantidad + $restock->cantidad);
            $producto->save();
            Session::flash('message', 1);
            return redirect()->route('inventario.index', $producto->tipo);
        } else {
            Session::flash('message', 0);
            return redirect()->back()->with('failed', 'No se encuentra en el inventario!');
        }
    }

    /**
     * Crea el registro de movimiento de producto
     *
     * @param Request $request
     * @return void
     */
    public function mover(Request $request)
    {
        $invconsu = $request->only(
            'productoId',
            'cantidad',
            'tipo',
            'desde',
            'hasta',
            'comentarios'
        );
        // dd($request);

        //*** creamos el registro del movimiento */
        $invconsu = invconsu::create($invconsu);

        if ($request['productoTipo'] == 'consumibles' || $request['tipo'] == 'desechar') {

            //*** existe el producto en inventario */
            $producto = inventario::where("id", $request['productoId'])->first();
            if ($producto) {
                $producto->cantidad = ($producto->cantidad - $request['cantidad']);
                $producto->save();
            } else {
                Session::flash('message', 0);
                return redirect()->back()->with('failed', 'No se encuentra en el inventario!');
            }
        }
        Session::flash('message', 1);
        return redirect()->route('inventario.show', $invconsu->productoId);
    }


    /**
     * Captura de movimientos de combustible
     *
     * @return void
     */
    public function dashCombustible(Request $request)
    {
        // return "hola";
        $date = Carbon::now();
        $endDate = $date->subMonth();

        $sql1 = " select id,sum(litros) as suma ,day(created_at) as dia from carga c where created_at
                    between '" . $endDate->toDateString() . "' and '" . Carbon::now()->addDay()->toDateString() . "' and maquinariaId = '" . $request->id . "'
                    group by date(created_at) order by created_at";
        $script = DB::select($sql1);

        $suma = [];
        $dia = [];
        foreach ($script as $key) {
            array_push($suma, $key->suma);
            array_push($dia, $key->dia);
        }
        $datos = array('suma' => $suma, 'dia' => $dia);
        // return view('inventario.dashCombustible', compact('suma', 'dia'));
        return response(json_encode($datos), 200)->header('Content-type', 'text/plain');
    }

    /**
     * Realiza la carga y registro de combustible
     *
     * @param Request $request
     * @return void
     */
    public function cargaCombustible(Request $request)
    {
        $request->validate([
            'litros' => 'required|numeric',
            'precio' => 'required|numeric|max:30|min:10',
        ], [
            'litros.required' => 'El campo litros es obligatorio.',
            'precio.required' => 'El campo precio es obligatorio.',
            'litros.numeric' => 'El campo litros debe de ser numérico.',
            'precio.numeric' => 'El campo precio debe de ser numérico.',
            'precio.minimo' => 'El campo precio debiera de ser mayor a 10 pesos.',
            'precio.maximo' => 'El campo precio debiera de ser menor a 30 pesos.',
        ]);
        $carga = $request->only(
            'litros',
            'maquinariaId',
            'operadorId',
            'precio',
        );

        //*** guardamos el registro */
        carga::create($carga);

        //buscamos el equipo para actulizar el nivel de la cisterna
        $cisterna =   maquinaria::where("id", $request['maquinariaId'])->first();
        $cisterna->cisternaNivel = ($cisterna->cisternaNivel + $request['litros']);
        $cisterna->update();

        Session::flash('message', 1);

        return redirect()->action([inventarioController::class, 'index'], ['tipo' => 'combustible']);
    }

    /**
     * Realiza la descarga y registro de combustible
     *
     * @param Request $request
     * @return void
     */
    public function descargaCombustible(Request $request)
    {
        $blnHayImagen = false;
        $request->validate([
            'litros' => 'required|numeric',
            'km' => 'required|numeric',
            'horas' => 'required|numeric',
            'imgKm' => 'nullable',
            'imgHoras' => 'nullable',
        ], [
            'litros.required' => 'El campo litros es obligatorio.',
            'km.required' => 'El campo Km/Mi es obligatorio.',
            'horas.required' => 'El campo horómetro es obligatorio.',
            'imgKm.required' => 'El campo imagen de kilometraje es obligatorio.',
            'imgHoras.required' => 'El campo imagen de horómetro es obligatorio.',
            'litros.numeric' => 'El campo litros debe de ser numérico.',
            'km.numeric' => 'El campo Km/Mi debe de ser numérico.',
            'horas.numeric' => 'El campo horometro debe de ser numérico.',
        ]);
        $descarga = $request->only(
            'horas',
            'km',
            'imgKm',
            'imgHoras',
            'litros',
            'maquinariaId',
            'operadorId',
            'receptorId',
            'servicioId',
        );

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

        //*** Preguntamos si no hay una imagen cargada */
        if ($blnHayImagen == false) {
            return redirect()->back()->withInput()->withErrors("Se requiere al menos una imagen de kilometraje o del homometro.");
        }

        //buscamos el equipo para actulizar el nivel de la cisterna
        $cisterna =   maquinaria::where("id", $request['maquinariaId'])->first();
        $cisterna->cisternaNivel = ($cisterna->cisternaNivel - $request['litros']);
        $cisterna->update();

        descarga::create($descarga);
        Session::flash('message', 1);

        return redirect()->action([inventarioController::class, 'index'], ['tipo' => 'combustible']);
    }

    public function updateCarga(Request $request)
    {
        // dd($request);

        $request->validate([
            'cargaLitros' => 'required|numeric|between:0,9999.99',
            'cargaPrecio' => 'required|numeric|max:30|min:10',
        ], [
            'cargaLitros.required' => 'El campo litros es obligatorio.',
            'cargaPrecio.required' => 'El campo precio es obligatorio.',
            'cargaLitros.numeric' => 'El campo litros debe de ser numérico.',
            'cargaPrecio.numeric' => 'El campo precio debe de ser numérico.',
            'cargaPrecio.minimo' => 'El campo precio debiera de ser mayor a 10 pesos.',
            'cargaPrecio.maximo' => 'El campo precio debiera de ser menor a 30 pesos.',
        ]);

        //*** guardamos el registro */
        $carga = carga::where("id", $request['cargaId'])->first();

        //*** obtenemos informacion para ajustes */
        $strSegundos = substr($carga->created_at, -2);
        $decLitros = $carga->litros;

        $carga->litros = $request['cargaLitros'];
        $carga->maquinariaId = $request['cargaMaquinaria'];
        $carga->operadorId = $request['cargaOperador'];
        $carga->precio = $request['cargaPrecio'];


        $carga->created_at = ($request['cargaFecha'] . " " . $request['cargaHora'] . ":" . $strSegundos);

        // dd($carga);
        $carga->update();

        // //buscamos el equipo para actulizar el nivel de la cisterna
        // $cisterna =   maquinaria::where("id", $request['maquinariaId'])->first();
        // $cisterna->cisternaNivel = ($cisterna->cisternaNivel + $request['litros']);
        // $cisterna->update();

        Session::flash('message', 1);

        return redirect()->action([inventarioController::class, 'index'], ['tipo' => 'combustible']);
    }

    public function updateDescarga(Request $request)
    {
        dd($request);
        $request->validate([
            'descargaLitros' => 'required|numeric',
            'descargaKms' => 'required|numeric',
            'descargaHoras' => 'required|numeric',
            'descargaImagenKms' => 'nullable',
            'descargaImagenHoras' => 'nullable',
        ], [
            'descargaLitros.required' => 'El campo litros es obligatorio.',
            'descargaKms.required' => 'El campo Km/Mi es obligatorio.',
            'descargaHoras.required' => 'El campo horómetro es obligatorio.',
            'descargaImgenKms.required' => 'El campo imagen de kilometraje es obligatorio.',
            'descargaImgenHoras.required' => 'El campo imagen de horómetro es obligatorio.',
            'descargaLitros.numeric' => 'El campo litros debe de ser numérico.',
            'descargaKms.numeric' => 'El campo Km/Mi debe de ser numérico.',
            'descargaHoras.numeric' => 'El campo horometro debe de ser numérico.',
        ]);
        //*** guardamos el registro */
        $descarga = descarga::where("id", $request['descargaId'])->first();

        //*** obtenemos informacion para ajustes */
        $strSegundos = substr($descarga->created_at, -2);
        $decLitros = $descarga->litros;

        $descarga->litros = $request['descargaLitros'];
        $descarga->km = $request['descargaKms'];
        $descarga->horas = $request['descargaHoras'];
        $descarga->maquinariaId = $request['descargaMaquinaria'];
        $descarga->operadorId = $request['descargaOperador'];
        $descarga->servicioId = $request['descargaServicio'];
        $descarga->receptorId = $request['descargaDespachador'];

        $descarga->created_at = ($request['descargaFecha'] . " " . $request['descargaHora'] . ":" . $strSegundos);


        if ($request->hasFile("descargaImagenKms")) {
            dd('Hola imagen de Kms');
            $descarga['descargaImagenKms'] = time() . '_' . 'imgKm.' . $request->file('descargaImagenKms')->getClientOriginalExtension();
            $request->file('descargaImagenKms')->storeAs('/public/combustibles', $descarga['descargaImagenKms']);
            // $blnHayImagen = true;
        }
        if ($request->hasFile("descargaImagenHoras")) {
            dd('Hola imagen de Horas');
            $descarga['descargaImagenHoras'] = time() . '_' . 'imgHoras.' . $request->file('descargaImagenHoras')->getClientOriginalExtension();
            $request->file('descargaImagenHoras')->storeAs('/public/combustibles', $descarga['descargaImagenHoras']);
            // $blnHayImagen = true;
        }

        // //*** Preguntamos si no hay una imagen cargada */
        // if ($blnHayImagen == false) {
        //     return redirect()->back()->withInput()->withErrors("Se requiere al menos una imagen de kilometraje o del homometro.");
        // }

        // dd($descarga);
        $descarga->update();

        // //buscamos el equipo para actulizar el nivel de la cisterna
        // $cisterna =   maquinaria::where("id", $request['maquinariaId'])->first();
        // $cisterna->cisternaNivel = ($cisterna->cisternaNivel - $request['litros']);
        // $cisterna->update();

        // descarga::create($descarga);
        Session::flash('message', 1);

        return redirect()->action([inventarioController::class, 'index'], ['tipo' => 'combustible']);
    }
}
