<?php

namespace App\Http\Controllers;

use App\Models\calendarioPrincipal;
use App\Http\Controllers\Controller;
use App\Models\inventario;
use App\Models\mantenimientos;
use App\Models\marca;
use App\Models\personal;
use App\Models\solicitudDetalle;
use App\Models\tipoMantenimiento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class calendarioPrincipalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(Gate::denies('calendarioPrincipal_index'), 404);
        // dd('HOLA');
        $personal = personal::all()->sortBy('nombres');
        $marca = marca::all()->sortBy('nombre');
        $tiposMantenimiento = tipoMantenimiento::all()->sortBy('nombre');
        $herramientas = inventario::where('tipo', 'herramientas')->get();
        $refacciones = inventario::where('tipo', 'refacciones')->get();
        // $eventos = calendarioPrincipal::all();
        $eventos = calendarioPrincipal::leftJoin('solicitudes', 'calendarioPrincipal.solicitudesId', '=', 'solicitudes.id')
            ->leftJoin('actividades', 'calendarioPrincipal.actividadesId', '=', 'actividades.id')
            ->leftJoin('maquinaria', 'calendarioPrincipal.maquinariaId', '=', 'maquinaria.id')
            ->leftJoin('personal', 'calendarioPrincipal.personalId', '=', 'personal.id')
            // ->leftJoin('solicitudDetalle', 'solicitudes.id', '=', 'solicitudDetalle.solicitudId')
            ->select(
                'calendarioPrincipal.*',
                'calendarioPrincipal.id',
                'calendarioPrincipal.title',
                'calendarioPrincipal.mantenimientoId',
                'calendarioPrincipal.maquinariaId',
                'calendarioPrincipal.descripcion',
                'calendarioPrincipal.estatus',
                'calendarioPrincipal.color',
                'calendarioPrincipal.start',
                'calendarioPrincipal.end',
                'solicitudes.prioridad as solicitud_prioridad',
                'solicitudes.funcionalidad as funcionalidad',
                'actividades.prioridad as actividad_prioridad',
                'maquinaria.nombre',
                'maquinaria.identificador as numeconomico',
                'maquinaria.placas',
                'maquinaria.marcaId',
                'personal.nombres as personalNombre',
                'personal.apellidoP as personalApellidoP',
                'personal.celular as celular',
                'personal.mailEmpresarial as email',
                // 'solicitudDetalle.cantidad',
                // 'solicitudDetalle.tipo',
                // 'solicitudDetalle.comentario',
                // 'solicitudDetalle.litros',
                // 'solicitudDetalle.reparacion',
                // 'solicitudDetalle.carga'
            )
            ->get();
        $eventosJson = $eventos->toJson();

        // $solicitudDetalle = solicitudDetalle::where($maquinaria->id)->get();
        // dd($eventos, $eventosJson);
        return view('calendarioPrincipal/calendarioPrincipal', compact('eventosJson', 'tiposMantenimiento', 'marca', 'personal', 'herramientas', 'refacciones'));
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
        abort_if(Gate::denies('calendarioPrincipal_create'), 404);

        $mantenimiento = $request->all();

        // $mantenimiento['fechaInicio'] =  $request['fecha'];
        $mantenimiento['codigo'] =  $request['identificador'];
        $mantenimiento['titulo'] = "Mantenimiento " . $request['identificador'] . " " . $request['nombre'];

        // dd($mantenimiento);
        $nuevoMantenimiento = mantenimientos::create($mantenimiento);

        // dd("NO");
        $eventoCalendario = new calendarioPrincipal();
        $eventoCalendario->mantenimientoId = $nuevoMantenimiento->id;
        $eventoCalendario->title = strtoupper($mantenimiento['placas'] . ' ' . $mantenimiento['nombre'] . ' ' . $mantenimiento['marca'] . ' ' . $mantenimiento['numeconomico'] . ' ' . $mantenimiento['descripcion']);
        $eventoCalendario->start = strtoupper($mantenimiento['fecha'] . ' ' . $mantenimiento['hora']);
        $eventoCalendario->userId = $mantenimiento['userId'];
        $eventoCalendario->maquinariaId = $mantenimiento['maquinariaId'];
        $eventoCalendario->personalId = $mantenimiento['personalId'];
        $eventoCalendario->tipoMantenimientoId = $mantenimiento['tipoMantenimientoId'];
        $eventoCalendario->estadoId = $mantenimiento['estadoId'];
        $eventoCalendario->descripcion = $mantenimiento['descripcion'];
        $eventoCalendario->estatus = $mantenimiento['tipo'];
        $eventoCalendario->color = $mantenimiento['color'];
        $eventoCalendario->tipoEvento = 'mantenimiento';
        // dd($eventoCalendario);
        $eventoCalendario->save();

        Session::flash('message', 1);
        return redirect()->route('calendarioPrincipal.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\calendarioPrincipal  $calendarioPrincipal
     * @return \Illuminate\Http\Response
     */
    public function show(calendarioPrincipal $calendarioPrincipal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\calendarioPrincipal  $calendarioPrincipal
     * @return \Illuminate\Http\Response
     */
    public function edit(calendarioPrincipal $calendarioPrincipal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\calendarioPrincipal  $calendarioPrincipal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, calendarioPrincipal $calendarioPrincipal)
    {
        abort_if(Gate::denies('calendarioPrincipal_edit'), 404);
        $calendarioPrincipal = calendarioPrincipal::where('id', $request->id)->first();
        $data = $request->all();
        // dd($calendarioPrincipal, $data);
        $data['estadoId'] = 3;
        // dd($data);
        if ($data['fecha'] != null && $data['hora'] != null) {
            $data['start'] = strtoupper($data['fecha'] . ' ' . $data['hora']);
        }
        if ($data['fechaSalida'] != null && $data['horaSalida'] != null) {
            $data['end'] = strtoupper($data['fechaSalida'] . ' ' . $data['horaSalida']);
        }
        if ($data['color'] === null) {
            unset($data['color']);
        }
        if ($data['maquinariaId'] === null) {
            unset($data['maquinariaId']);
        }
        $data['title'] = strtoupper($data['placas'] . ' ' . $data['nombre'] . ' ' . $data['marca'] . ' ' . $data['numeconomico'] . ' ' . $data['descripcion']);
        $calendarioPrincipal->update($data);

        Session::flash('message', 1);

        return redirect()->route('calendarioPrincipal.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\calendarioPrincipal  $calendarioPrincipal
     * @return \Illuminate\Http\Response
     */
    public function destroy(calendarioPrincipal $calendarioPrincipal)
    {
        //
    }

    // public function generarDiasFeriados($days)
    // {
    //     foreach ($days as $dia) {
    //         $eventoCalendario = new calendarioPrincipal();
    //         $eventoCalendario->title = 'Feriado: ' . $dia['name']; // Accede a 'name' dentro de cada día
    //         $eventoCalendario->start = strtoupper($dia['date']); // Accede a 'date' dentro de cada día
    //         $eventoCalendario->descripcion = 'Se suspenden actividades laborales debido a que es: ' . $dia['name']; // Accede a 'name' dentro de cada día
    //         $eventoCalendario->color = '#a6ce34';
    //         $eventoCalendario->tipoEvento = 'DiaFeriado';
    //         $eventoCalendario->save();
    //     }
    // }

    public function generarDiasFeriados(Request $request)
    {
        $data = $request->input('days'); // Obtiene los datos enviados desde JavaScript

        foreach ($data as $dia) {
            $eventoCalendario = new calendarioPrincipal();
            $eventoCalendario->title = 'Feriado: ' . $dia['name']; // Accede a 'name' dentro de cada día
            $eventoCalendario->start = strtoupper($dia['date']); // Accede a 'date' dentro de cada día
            $eventoCalendario->descripcion = 'Este día es festivo porque es: ' . $dia['name']; // Accede a 'name' dentro de cada día
            $eventoCalendario->color = '#a6ce34';
            $eventoCalendario->tipoEvento = 'DiaFeriado';
            $eventoCalendario->estadoId = 3;
            $eventoCalendario->userId = 1;
            $eventoCalendario->save();
        }

        Session::flash('message', 1);

        return redirect()->route('calendarioPrincipal.index');
    }

    public function solicitudDetalle($solicitudId)
    {
        $solicitudes = solicitudDetalle::where('solicitudId', $solicitudId)->get();
        return response()->json($solicitudes);
    }

    public function checkPermission($permission)
    {
        $hasPermission = Auth::user()->hasPermissionTo($permission);

        return response()->json(['hasPermission' => $hasPermission]);
    }
}
