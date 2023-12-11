<?php

namespace App\Http\Controllers;

use App\Models\maquinaria;
use App\Models\maqdocs;
use App\Models\maqimagen;
use App\Models\bitacoras;
use App\Models\bitacorasEquipos;
use App\Models\calendarioPrincipal;
use App\Models\checkList;
use App\Models\checkListRegistros;
use App\Models\obras;
use App\Models\personal;
use App\Models\marca;
use App\Models\docs;
use App\Models\maquinariaEstatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use PhpParser\Node\Stmt\Switch_;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;
use LengthException;
use App\Models\refacciones;
use App\Models\refaccionTipo;
use App\Models\inventario;
use App\Models\mantenimientos;
use App\Models\maquinariaCategoria;
use App\Models\maquinariaTipo;
use App\Models\obraMaqPer;
use App\Models\obraMaqPerHistorico;
use Carbon\Carbon;
use Illuminate\Database\QueryException;

class maquinariaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(Gate::denies('maquinaria_index'), 403);
        // $mtq = 'mtq';
        $maquinaria = maquinaria::select(
            'maquinaria.*',
            'maquinaria.nombre as maquina',
            'marca.nombre as marca',
            'maquinariaCategoria.nombre as categoria',
            'obras.nombre as obra',
            'obras.id as obraId',
            'personal.id as operadorId',
            'obraMaqPer.combustible as cargaCombustible',
            'obraMaqPer.inicio as fechaInicial',
            'obraMaqPer.fin as fechaFinal',
            'obraMaqPer.id as recordId',
            'marca.nombre as marca',
            DB::raw("CONCAT(personal.nombres,' ', personal.apellidoP,' ', personal.apellidoM)as operador")
        )
            ->leftjoin('obraMaqPer', 'obraMaqPer.maquinariaId', 'maquinaria.id')
            ->leftjoin('personal', 'personal.id', 'obraMaqPer.personalId')
            ->leftjoin('obras', 'obras.id', 'obraMaqPer.obraId')
            ->leftjoin('marca', 'marca.id', 'maquinaria.marcaId')
            ->leftjoin('maquinariaCategoria', 'maquinariaCategoria.id', 'maquinaria.categoriaId')
            ->whereNull('compania')
            ->orderBy('maquinaria.identificador', 'asc')
            ->paginate(15);

        $vctObras = obras::select('obras.*', 'clientes.nombre as cliente')
            ->join('clientes', 'clientes.id', 'obras.clienteId')
            ->where('obras.id', '<>', 2)
            ->orderBy('obras.nombre', 'asc')->get();
        //*** Todas excepto la de MTQ control */

        $vctOperarios = personal::select(
            'personal.id',
            DB::raw("CONCAT(personal.nombres,' ', personal.apellidoP,' ', personal.apellidoM)as personal"),
            'obras.nombre AS obra',
            'maquinaria.identificador',
            'maquinaria.nombre AS auto',
            'nomina.puestoId',
            'puesto.nombre AS puesto',
            'puesto.puestoNivelId',
            'personal.estatusId',
            'puestoNivel.nombre AS puestoNivel'
        )
            ->join('nomina', 'nomina.personalId', 'personal.id')
            ->join('puesto', 'puesto.id', 'nomina.puestoId')
            ->join('puestoNivel', 'puestoNivel.id', 'puesto.puestoNivelId')
            ->leftjoin('obraMaqPer', 'obraMaqPer.personalId', 'personal.id')
            ->leftjoin('maquinaria', 'maquinaria.id', '=', 'obraMaqPer.maquinariaId')
            ->leftjoin('obras', 'obras.id', '=', 'obraMaqPer.obraId')
            ->where('puesto.puestoNivelId', '=', 5)
            ->where('personal.estatusId', '=', 1) //*** solo operarios de maquinaria */ //*** solo operarios de maquinaria */
            ->orderBy('personal.nombres', 'asc')->get();

        // dd( $vctMaquinaria );

        return view('maquinaria.indexMaquinaria', compact('maquinaria', 'vctOperarios', 'vctObras'));
    }

    public function distribucion()
    {
        // dd('Hola');
        abort_if(Gate::denies('maquinaria_index'), 403);
        // $mtq = 'mtq';
        $maquinaria = maquinaria::select(
            'maquinaria.id',
            'maquinaria.identificador',
            DB::raw("CONCAT(maquinaria.identificador,' - ', maquinaria.nombre)as maquinaria"),
            'obras.id as obraId',
            'obras.nombre as obra',
            'obraMaqPer.combustible as cargaCombustible',
            'obraMaqPer.inicio as fechaInicial',
            'obraMaqPer.fin as fechaFinal',
            'obraMaqPer.id as recordId',
            'personal.id as operadorId',
            DB::raw("CONCAT(personal.nombres,' ', personal.apellidoP,' ', personal.apellidoM)as operador")
        )
            ->leftjoin('obraMaqPer', 'obraMaqPer.maquinariaId', 'maquinaria.id')
            ->leftjoin('personal', 'personal.id', 'obraMaqPer.personalId')
            ->leftjoin('obras', 'obras.id', 'obraMaqPer.obraId')
            ->leftjoin('marca', 'marca.id', 'maquinaria.marcaId')
            ->leftjoin('maquinariaCategoria', 'maquinariaCategoria.id', 'maquinaria.categoriaId')
            ->whereNull('compania')
            ->orderBy('maquinaria.identificador', 'asc')
            ->paginate(15);

        $vctObras = obras::select('obras.*', 'clientes.nombre as cliente')
            ->join('clientes', 'clientes.id', 'obras.clienteId')
            ->where('obras.id', '<>', 2)
            ->orderBy('obras.nombre', 'asc')->get();
        //*** Todas excepto la de MTQ control */

        $vctOperarios = personal::select(
            'personal.id',
            DB::raw("CONCAT(personal.nombres,' ', personal.apellidoP,' ', personal.apellidoM)as personal"),
            'obras.nombre AS obra',
            'maquinaria.identificador',
            'maquinaria.nombre AS auto',
            'nomina.puestoId',
            'puesto.nombre AS puesto',
            'puesto.puestoNivelId',
            'personal.estatusId',
            'puestoNivel.nombre AS puestoNivel'
        )
            ->join('nomina', 'nomina.personalId', 'personal.id')
            ->join('puesto', 'puesto.id', 'nomina.puestoId')
            ->join('puestoNivel', 'puestoNivel.id', 'puesto.puestoNivelId')
            ->leftjoin('obraMaqPer', 'obraMaqPer.personalId', 'personal.id')
            ->leftjoin('maquinaria', 'maquinaria.id', '=', 'obraMaqPer.maquinariaId')
            ->leftjoin('obras', 'obras.id', '=', 'obraMaqPer.obraId')
            ->where('puesto.puestoNivelId', '=', 5)
            ->where('personal.estatusId', '=', 1) //*** solo operarios de maquinaria */ //*** solo operarios de maquinaria */
            ->orderBy('personal.nombres', 'asc')->get();

        // dd( $vctMaquinaria );

        return view('maquinaria.distribucionMaquinaria', compact('maquinaria', 'vctOperarios', 'vctObras'));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        abort_if(Gate::denies('maquinaria_create'), 403);
        $doc = docs::where('tipoId', '2')->orderBy('nombre', 'asc')->get();

        $obras = obras::select('obras.*', 'clientes.nombre as cliente')
            ->join('clientes', 'clientes.id', 'obras.clienteId')->where('obras.clienteId', '=', 1)->get();
        //*** asignamos al centro de control de Q2ces */

        $marcas = marca::select('marca.*')->orderBy('marca.nombre', 'asc')->get();
        $categorias = maquinariaCategoria::select('maquinariaCategoria.*')->orderBy('maquinariaCategoria.nombre', 'asc')->get();
        $tipos = maquinariaTipo::select('maquinariaTipo.*')->orderBy('maquinariaTipo.nombre', 'asc')->get();
        $refaccionTipo = refaccionTipo::select('refaccionTipo.*')->orderBy('refaccionTipo.nombre', 'asc')->get();

        return view('maquinaria.altaDeMaquinaria', compact('obras', 'doc', 'marcas', 'categorias', 'tipos', 'refaccionTipo'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        // dd( $request->archivo );
        abort_if(Gate::denies('maquinaria_create'), 403);
        $request->validate([
            'nombre' => 'required|max:250',
            'identificador' => 'required|max:8',
            'marca' => 'required|max:250',
            'modelo' => 'required|max:250',
            'horometro' => 'nullable|numeric',
            'kilometraje' => 'nullable|numeric',
            'submarca' => 'nullable|max:200',
            'categoriaId' => 'required|max:200',
            'ano' => 'nullable|max:9999|numeric',
            'color' => 'nullable|max:200',
            'placas' => 'nullable|max:200',
            'motor' => 'nullable|max:200',
            'nummotor' => 'nullable|max:200',
            'numserie' => 'nullable|max:200',
            'vin' => 'nullable|max:200',
            'combustible' => 'nullable|max:200',
            'capacidad' => 'nullable|numeric',
            'tanque' => 'nullable|numeric',
            'ejes' => 'nullable|numeric',
            'rinD' => 'nullable|numeric',
            'rinT' => 'nullable|numeric',
            'llantaD' => 'nullable|numeric',
            'llantaT' => 'nullable|numeric',
            'aceitemotor' => 'nullable|numeric',
            'aceitetras' => 'nullable|numeric',
            'aceitehidra' => 'nullable|numeric',
            'aceitedirec' => 'nullable|numeric',
            'filtroaceite' => 'nullable|numeric',
            'filtroaire' => 'nullable|numeric',
            'bujias' => 'nullable|numeric',
            'tipobujia' => 'nullable|max:200',
        ], [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'nombre.max' => 'El campo nombre excede el límite de caracteres permitidos.',
            'identificador.required' => 'El campo identificador es obligatorio.',
            'identificador.max' => 'El campo identificador excede el límite de caracteres permitidos.',
            'marca.required' => 'El campo marca es obligatorio.',
            // 'marcaId.max' => 'El campo marca excede el límite de caracteres permitidos.',
            'modelo.required' => 'El campo modelo es obligatorio.',
            'modelo.max' => 'El campo modelo excede el límite de caracteres permitidos.',
            'horometro.numeric' => 'El campo horómetro debe de ser numérico.',
            'kilometraje.numeric' => 'El campo kilometraje debe de ser numérico.',
            'submarca.max' => 'El campo submarca excede el límite de caracteres permitidos.',
            'categoriaId.required' => 'El campo categoria es obligatorio.',
            'ano.numeric' => 'El campo año debe ser numérico.',
            'ano.max' => 'El campo serie excede el límite de caracteres permitidos.',
            'color.max' => 'El campo color excede el límite de caracteres permitidos.',
            'placas.max' => 'El campo placas excede el límite de caracteres permitidos.',
            'motor.max' => 'El campo motor excede el límite de caracteres permitidos.',
            'nummotor.max' => 'El número de motor placas excede el límite de caracteres permitidos.',
            'numserie.max' => 'El número de serie placas excede el límite de caracteres permitidos.',
            'vin.max' => 'El campo VIN excede el límite de caracteres permitidos.',
            'combustible.max' => 'El campo combustible excede el límite de caracteres permitidos.',
            'capacidad.numeric' => 'El campo capacidad debe ser numérico.',
            'tanque.numeric' => 'El campo tanque debe ser numérico.',
            'ejes.numeric' => 'El campo ejes debe ser numérico.',
            'rinD.numeric' => 'El campo rin delatero debe ser numérico.',
            'rinT.numeric' => 'El campo rin trasero debe ser numérico.',
            'llantaD.numeric' => 'El campo llanta delantera debe ser numérico.',
            'llantaT.numeric' => 'El campo llanta trasera debe ser numérico.',
            'aceitemotor.numeric' => 'El campo aceite de motor debe ser numérico.',
            'aceitetras.numeric' => 'El campo aceite de transmisión debe ser numérico.',
            'aceitehidra.numeric' => 'El campo aceite hidráulico debe ser numérico.',
            'aceitedirec.numeric' => 'El campo aceite de dirección debe ser numérico.',
            'filtroaceite.numeric' => 'El campo filtro de aceite debe ser numérico.',
            'filtroaire.numeric' => 'El campo filtro de aire debe ser numérico.',
            'bujias.numeric' => 'El campo bujias trasera debe ser numérico.',
            'tipobujia.max' => 'El campo tipo de bujía excede el límite de caracteres permitidos.',
        ]);

        $maquinaria = $request->all();

        //** Generamos el identificador de la maquinaria */
        // $maquinaria[ 'identificador' ] = $this->generaCodigoIdentificacion( $maquinaria[ 'categoriaId' ] );
        $maquinaria['estatusId'] = 1;


        /*** directorio contenedor de su información */
        $pathMaquinaria = str_pad($maquinaria['identificador'], 4, '0', STR_PAD_LEFT);

        // $maquinaria[ 'marcaId' ] = strtoupper( $maquinaria[ 'marcaId' ] );
        $maquinaria['marcaId'] = $request->marca[0];
        $maquinaria['placas'] = strtoupper($maquinaria['placas']);
        $maquinaria['nummotor'] = strtoupper($maquinaria['nummotor']);
        $maquinaria['numserie'] = strtoupper($maquinaria['numserie']);

        //*** se guarda la maquinaria */
        $maquinaria = maquinaria::create($maquinaria);
        $cont = 0;

        for (
            $i = 0;
            $i < count($request->archivo);
            $i++
        ) {
            $documento = new maqdocs();
            $documento->maquinariaId = $maquinaria->id;
            $documento->tipoId = $request->archivo[$i]['tipoDocs'];
            // Obtenemos el tipo de documento
            $tipoDocumentoNombre = $request->archivo[$i]['tipoDocsNombre'];
            // Obtenemos el tipo de documento

            if ($request->archivo[$i]['omitido'] == 0) {
                // OBLIGATORIO
                $documento->requerido = '1';
                $documento->estatus = '0';

                if (isset(($request->archivo[$i]['docs']))) {
                    $file = $request->file('archivo')[$i]['docs'];
                    $documento->ruta = time() . '_' . $file->getClientOriginalName();
                    $file->storeAs('/public/maquinaria/' . $pathMaquinaria . '/documentos/' .  $tipoDocumentoNombre, $documento->ruta);
                    $documento->estatus = '2';
                    //Si es 2 Esta  OK
                }

                if ((isset($request->archivo[$i]['check']) && $request->archivo[$i]['check'] == 'on')) {
                    $documento->vencimiento = 1;

                    //Si es 1 SI vence el documento
                    $documento->estatus = '0';
                    //Si esta en 0 Esta MAL
                    if (isset($request->archivo[$i]['fecha'])) {
                        $documento->fechaVencimiento = $request->archivo[$i]['fecha'];

                        // Evaluar fecha de vencimiento
                        $documento->estatus = '1';
                        //Si es 1 Esta proximo a vencer
                        $eventoCalendario = new calendarioPrincipal();
                        $eventoCalendario->maquinariaId = $documento->maquinariaId;
                        $eventoCalendario->title = 'Expira documento: ' . $request->archivo[$i]['tipoDocsNombre'];
                        $eventoCalendario->end = strtoupper($request->archivo[$i]['fecha'] . ' ' . '23:00:00');
                        $eventoCalendario->start = strtoupper($request->archivo[$i]['fecha'] . ' ' . '01:00:00');
                        $eventoCalendario->descripcion = 'Expiración del Documento: ' . $request->archivo[$i]['tipoDocsNombre'] . ' Perteneciente al Equipo: ' . $maquinaria->nombre . ', con Placas: ' . $maquinaria->placas . ', y N/Económico: ' . $maquinaria->identificador;
                        $eventoCalendario->color = '#f70202';
                        $eventoCalendario->tipoEvento = 'ExpiranDocumentos';
                        // dd($eventoCalendario);
                        $eventoCalendario->save();
                    }
                } else {
                    $documento->vencimiento = 0;
                    //Si es 0 no vence el documento
                }
            } else {
                // NO REQUERIDO
                $documento->requerido = '0';
                $documento->estatus = '2';
                //Si es 2 Esta  OK
            }
            $documento->comentarios = $request->archivo[$i]['comentario'];

            $documento->save();
        }

        for (
            $i = 0;
            $i < count($request['tipoRefaccionId']);
            $i++
        ) {
            //* se guarda solo si se selecciono una máquina */
            if ($request['marca'][$i] && $request['tipoRefaccionId'][$i]) {
                if ($request['tipoRefaccionId'][$i] != '' || $request['tipoRefaccionId'][$i] != null) {

                    $relacion = inventario::where('numparte', $request['numeroParte'][$i])->first();

                    $objResidente = new refacciones();
                    if ($relacion != null) {
                        $objResidente->relacionInventarioId = $relacion->id;
                    }
                    $objResidente->maquinariaId = $maquinaria->id;
                    $objResidente->marcaId  = $request['marca'][$i];
                    $objResidente->tipoRefaccionId = $request['tipoRefaccionId'][$i];
                    // $objResidente->puesto = $request[ 'rpuesto' ][ $i ];
                    $objResidente->numeroParte = $request['numeroParte'][$i];
                    $objResidente->save();
                }
                $objResidente->maquinariaId = $maquinaria->id;
                $objResidente->marcaId  = $request['marca'][$i];
                $objResidente->tipoRefaccionId = $request['tipoRefaccionId'][$i];
                // $objResidente->puesto = $request[ 'rpuesto' ][ $i ];
                $objResidente->numeroParte = $request['numeroParte'][$i];
                $objResidente->save();
            }
        }
        /*
        // for ( $i = 0; $i < count( $request->refaccion );
        $i++ ) {
            //     $ref = new refacciones();
            //     $ref->maquinariaId = $maquinaria->id;
            //
            //     $ref->tipoRefaccionId = $request->refaccion[ $i ][ 'tipoRefaccionId' ];
            //     $ref->marcaId = $request->refaccion[ $i ][ 'marcaId' ];
            //     //$activo = $request->refaccion[ $i ][ 'activo' ];
            //     //$ref->comentario = $request->refaccion[ $i ][ 'comentario' ];
            //     //$ref->nombre = 'prueba';
            //     $ref->numeroParte = $request->refaccion[ $i ][ 'numeroParte' ];
            //     $ref->save();
            // }
            */

        Session::flash('message', 1);
        return redirect()->route('maquinaria.index');
    }


    public function storeCheckList(Request $request)
    {
        // dd($request);

        abort_if(Gate::denies('maquinaria_create'), 403);
        $request->validate([
            'maquinariaId' => 'required',
            'bitacoraId' => 'required',
        ], [
            'maquinariaId.required' => 'El campo Maquinaría es obligatorio.',
            'bitacoraId.required' => 'El campo Bitácora es obligatorio.',
        ]);

        $record = $request->all();

        $objRecord = bitacorasEquipos::where('maquinariaId', '=', $request['maquinariaId'])
            ->where('bitacoraId', '=', $request['bitacoraId'])
            ->first();

        if ($objRecord) {
            return back()->withErrors(['maquinariaId' => 'La maquinaría ya tiene asignada esta bitácora.']);
        } else {
            //*** se guarda la maquinaria */
            $maquinaria = bitacorasEquipos::create($record);
        }

        Session::flash('message', 1);
        return redirect()->route('maquinaria.checkLists');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\maquinaria  $maquinaria
     * @return \Illuminate\Http\Response
     */

    public function show(maquinaria $maquinaria)
    {
        abort_if(Gate::denies('maquinaria_show'), 403);
        // dd('Aqui ES');
        // $bitacora = bitacoras::all();
        // $doc = maqdocs::leftJoin('docs', "maqdocs.tipoId", "docs.id")
        //     ->select(
        //         'docs.id',
        //         'docs.nombre',
        //         'maqdocs.fechaVencimiento',
        //         'maqdocs.estatus',
        //         'maqdocs.comentarios',
        //         'maqdocs.ruta',
        //         'maqdocs.requerido',
        //         'maqdocs.id as idDoc'
        //     )
        //     // ->where('maquinariaId', $maquinaria->id)
        //     ->where('docs.tipoId', '2')
        //     // ->where('maqdocs.maquinariaId', $maquinaria->id)
        //     ->groupBy('docs.id')
        //     ->orderBy('nombre', 'asc')
        //     ->get();
        // dd($doc);

        $doc = docs::leftJoin('maqdocs', function ($join) use ($maquinaria) {
            $join->on('docs.id', '=', 'maqdocs.tipoId')
                ->where('maqdocs.maquinariaId', '=', $maquinaria->id);
        })
            ->select(
                'docs.id',
                'docs.nombre',
                'maqdocs.fechaVencimiento',
                'maqdocs.estatus',
                'maqdocs.comentarios',
                'maqdocs.ruta',
                'maqdocs.requerido',
                'maqdocs.id as idDoc'
            )->where('docs.tipoId', '2')
            ->get();

        $fotos = maqimagen::where('maquinariaId', $maquinaria->id)->get();
        // $obraMaqPer = obraMaqPer::where('maquinariaId', $maquinaria->id)->get();
        $obraMaqPer = obraMaqPer::join('obras', 'obraMaqPer.obraId', '=', 'obras.id')
            ->join('personal', 'obraMaqPer.personalId', '=', 'personal.id')
            ->where('obraMaqPer.maquinariaId', $maquinaria->id)
            ->select('obraMaqPer.inicio as fechaInicio', 'obras.nombre as nombre_obra', 'obras.id as id_obra', 'personal.id as id_personal', DB::raw('CONCAT(personal.nombres, " ", personal.apellidoP, " ", personal.apellidoM) as nombre_personal'))
            ->first();

        $vctEstatus = maquinariaEstatus::all();
        $marcas = marca::select('marca.*')->orderBy('marca.nombre', 'asc')->get();
        $refacciones = refacciones::select('refacciones.*')->where('maquinariaId', $maquinaria->id)->orderBy('refacciones.nombre', 'asc')->get();
        $refaccionTipo = refaccionTipo::select('refaccionTipo.*')->orderBy('refaccionTipo.nombre', 'asc')->get();
        $categorias = maquinariaCategoria::select('maquinariaCategoria.*')->orderBy('maquinariaCategoria.nombre', 'asc')->get();
        $tipos = maquinariaTipo::select('maquinariaTipo.*')->orderBy('maquinariaTipo.nombre', 'asc')->get();
        $lastCheckList = checkList::select('checkList.id', 'bitacoras.nombre as bitacora')
            ->join('bitacoras', 'bitacoras.id', 'checkList.bitacoraId')
            ->where('maquinariaId', '=', $maquinaria->id)
            ->orderBy('checkList.id', 'desc')->first();
        $lastMantenimiento = mantenimientos::select('*')->where('maquinariaId', '=', $maquinaria->id)->orderBy('mantenimientos.id', 'desc')->first();
        // dd($obraMaqPer);
        return view('maquinaria.detalleMaquinaria', compact('maquinaria', 'doc', 'fotos',  'vctEstatus', 'marcas', 'refaccionTipo', 'refacciones', 'categorias', 'tipos', 'obraMaqPer', 'lastCheckList', 'lastMantenimiento'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\maquinaria  $maquinaria
     * @return \Illuminate\Http\Response
     */
    public function vista(maquinaria $maquinaria)
    {
        abort_if(Gate::denies('maquinaria_show'), 403);
        // dd($maquinaria);
        // $bitacora = bitacoras::all();
        // $doc = maqdocs::leftJoin('docs', "maqdocs.tipoId", "docs.id")
        //     ->select(
        //         'docs.id',
        //         'docs.nombre',
        //         'maqdocs.fechaVencimiento',
        //         'maqdocs.estatus',
        //         'maqdocs.comentarios',
        //         'maqdocs.ruta',
        //         'maqdocs.requerido',
        //         'maqdocs.id as idDoc'
        //     )
        //     // ->where('maquinariaId', $maquinaria->id)
        //     ->where('docs.tipoId', '2')
        //     // ->where('maqdocs.maquinariaId', $maquinaria->id)
        //     ->groupBy('docs.id')
        //     ->orderBy('nombre', 'asc')
        //     ->get();
        // dd($doc);

        $doc = docs::leftJoin('maqdocs', function ($join) use ($maquinaria) {
            $join->on('docs.id', '=', 'maqdocs.tipoId')
                ->where('maqdocs.maquinariaId', '=', $maquinaria->id);
        })
            ->select(
                'docs.id',
                'docs.nombre',
                'maqdocs.fechaVencimiento',
                'maqdocs.estatus',
                'maqdocs.comentarios',
                'maqdocs.ruta',
                'maqdocs.requerido',
                'maqdocs.id as idDoc'
            )->where('docs.tipoId', '2')
            ->get();


        $fotos = maqimagen::where('maquinariaId', $maquinaria->id)->get();
        $vctEstatus = maquinariaEstatus::all();
        $marcas = marca::all();
        $obraMaqPer = obraMaqPer::join('obras', 'obraMaqPer.obraId', '=', 'obras.id')
            ->join('personal', 'obraMaqPer.personalId', '=', 'personal.id')
            ->where('obraMaqPer.maquinariaId', $maquinaria->id)
            ->select('obraMaqPer.inicio as fechaInicio', 'obras.nombre as nombre_obra', 'obras.id as id_obra', 'personal.id as id_personal', DB::raw('CONCAT(personal.nombres, " ", personal.apellidoP, " ", personal.apellidoM) as nombre_personal'))
            ->first();
        $refacciones = refacciones::where('maquinariaId', $maquinaria->id)->get();
        $refaccionTipo = refaccionTipo::all();
        $categorias = maquinariaCategoria::all();
        $tipos = maquinariaTipo::all();

        $lastCheckList = checkList::select('checkList.id', 'bitacoras.nombre as bitacora')
            ->join('bitacoras', 'bitacoras.id', 'checkList.bitacoraId')
            ->where('maquinariaId', '=', $maquinaria->id)
            ->orderBy('checkList.id', 'desc')->first();
        $lastMantenimiento = mantenimientos::select('*')->where('maquinariaId', '=', $maquinaria->id)->orderBy('mantenimientos.id', 'desc')->first();
        // dd($lastMantenimiento);
        return view('maquinaria.verMaquinaria', compact('maquinaria', 'doc', 'fotos', 'vctEstatus', 'marcas', 'refaccionTipo', 'refacciones', 'categorias', 'tipos', 'obraMaqPer', 'lastCheckList', 'lastMantenimiento'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\maquinaria  $maquinaria
     * @return \Illuminate\Http\Response
     */

    public function edit(maquinaria $maquinaria)
    {
        // dd($maquinaria);
        // $bitacora = bitacoras::all();
        dd('NO');
        $doc = docs::where('tipoId', '2')->get();
        //$docs = maqdocs::where( 'maquinariaId', $maquinaria->id )->first();
        return view('maquinaria.detalleMaquinaria', compact('maquinaria', 'doc'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\maquinaria  $maquinaria
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, maquinaria $maquinaria)
    {
        abort_if(Gate::denies('maquinaria_edit'), 403);

        // dd( $request );
        $request->validate([
            'nombre' => 'required|max:250',
            // 'identificador' => 'required|max:8',
            // 'marcaId' => 'required',
            'modelo' => 'required|max:250',
            'horometro' => 'nullable|numeric',
            'kilometraje' => 'nullable|numeric',
            'submarca' => 'nullable|max:200',
            'categoriaId' => 'nullable|max:200',
            'ano' => 'nullable|max:9999|numeric',
            'color' => 'nullable|max:200',
            'placas' => 'nullable|max:200',
            'motor' => 'nullable|max:200',
            'nummotor' => 'nullable|max:200',
            'numserie' => 'nullable|max:200',
            'vin' => 'nullable|max:200',
            'combustible' => 'nullable|max:200',
            'capacidad' => 'nullable|numeric',
            'tanque' => 'nullable|numeric',
            'ejes' => 'nullable|numeric',
            'rinD' => 'nullable|numeric',
            'rinT' => 'nullable|numeric',
            'llantaD' => 'nullable|numeric',
            'llantaT' => 'nullable|numeric',
            'aceitemotor' => 'nullable|numeric',
            'aceitetras' => 'nullable|numeric',
            'aceitehidra' => 'nullable|numeric',
            'aceitedirec' => 'nullable|numeric',
            'filtroaceite' => 'nullable|numeric',
            'filtroaire' => 'nullable|numeric',
            'bujias' => 'nullable|numeric',
            'tipobujia' => 'nullable|max:200',
        ], [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'nombre.max' => 'El campo nombre excede el límite de caracteres permitidos.',
            // 'identificador.required' => 'El campo identificador es obligatorio.',
            // 'identificador.max' => 'El campo identificador excede el límite de caracteres permitidos.',
            // 'marcaId.required' => 'El campo marca es obligatorio.',
            // 'marcaId.max' => 'El campo marca excede el límite de caracteres permitidos.',
            'modelo.required' => 'El campo modelo es obligatorio.',
            'modelo.max' => 'El campo modelo excede el límite de caracteres permitidos.',
            'horometro.numeric' => 'El campo horómetro debe de ser numérico.',
            'kilometraje.numeric' => 'El campo kilometraje debe de ser numérico.',
            'submarca.max' => 'El campo submarca excede el límite de caracteres permitidos.',
            'categoriaId.max' => 'El campo categoria excede el límite de caracteres permitidos.',
            'ano.numeric' => 'El campo año debe ser numérico.',
            'ano.max' => 'El campo serie excede el límite de caracteres permitidos.',
            'color.max' => 'El campo color excede el límite de caracteres permitidos.',
            'placas.max' => 'El campo placas excede el límite de caracteres permitidos.',
            'motor.max' => 'El campo motor excede el límite de caracteres permitidos.',
            'nummotor.max' => 'El número de motor placas excede el límite de caracteres permitidos.',
            'numserie.max' => 'El número de serie placas excede el límite de caracteres permitidos.',
            'vin.max' => 'El campo VIN excede el límite de caracteres permitidos.',
            'combustible.max' => 'El campo combustible excede el límite de caracteres permitidos.',
            'capacidad.numeric' => 'El campo capacidad debe ser numérico.',
            'tanque.numeric' => 'El campo tanque debe ser numérico.',
            'ejes.numeric' => 'El campo ejes debe ser numérico.',
            'rinD.numeric' => 'El campo rin delatero debe ser numérico.',
            'rinT.numeric' => 'El campo rin trasero debe ser numérico.',
            'llantaD.numeric' => 'El campo llanta delantera debe ser numérico.',
            'llantaT.numeric' => 'El campo llanta trasera debe ser numérico.',
            'aceitemotor.numeric' => 'El campo aceite de motor debe ser numérico.',
            'aceitetras.numeric' => 'El campo aceite de transmisión debe ser numérico.',
            'aceitehidra.numeric' => 'El campo aceite hidráulico debe ser numérico.',
            'aceitedirec.numeric' => 'El campo aceite de dirección debe ser numérico.',
            'filtroaceite.numeric' => 'El campo filtro de aceite debe ser numérico.',
            'filtroaire.numeric' => 'El campo filtro de aire debe ser numérico.',
            'bujias.numeric' => 'El campo bujias trasera debe ser numérico.',
            'tipobujia.max' => 'El campo tipo de bujía excede el límite de caracteres permitidos.',
        ]);

        $data = $request->all();
        // dd($data, $maquinaria);

        $data['identificador'] = strtoupper($data['identificador']);
        $data['placas'] = strtoupper($data['placas']);
        $data['nummotor'] = strtoupper($data['nummotor']);
        $data['numserie'] = strtoupper($data['numserie']);
        // $data[ 'marcaId' ] = $request->marca[ 0 ];

        /*** directorio contenedor de su información */
        $pathMaquinaria = str_pad($data['identificador'], 4, '0', STR_PAD_LEFT);

        $eliminarFotos = json_decode($request->arrayFotosPersistente);
        // dd( $data[ 'bitacoraId' ] );
        $maquinaria->update($data);

        if ($eliminarFotos != null) {
            for (
                $i = 0;
                $i < count($eliminarFotos);
                $i++
            ) {
                // dd( $eliminarFotos[ $i ]->id );
                $test = maqimagen::where('id', $eliminarFotos[$i]->id)->delete();
                // dd( $test );
            }
        }

        if ($request->archivo) {
            for (
                $i = 0;
                $i < count($request->archivo);
                $i++
            ) {
                $documento = null;
                // dd( $request->archivo[ $i ][ 'idDoc' ] );
                if ($request->archivo[$i]['idDoc'] == null) {
                    $documento = new maqdocs();
                }
                $documento['maquinariaId'] = $maquinaria->id;
                $documento['tipoId'] = $request->archivo[$i]['tipoDocs'];
                // Obtenemos el tipo de documento
                $tipoDocumentoNombre = $request->archivo[$i]['tipoDocsNombre'];
                // Obtenemos el tipo de documento

                if ($request->archivo[$i]['omitido'] == 0) {
                    // OBLIGATORIO
                    $documento['requerido'] = '1';
                    $documento['estatus'] = '0';
                    if (isset(($request->archivo[$i]['docs']))) {
                        $file = $request->file('archivo')[$i]['docs'];
                        $documento['ruta'] = time() . '_' . $file->getClientOriginalName();
                        $file->storeAs('/public/maquinaria/' . $pathMaquinaria . '/documentos/' .  $tipoDocumentoNombre, $documento['ruta']);
                        $documento['estatus'] = '2';
                        //Si es 2 Esta  OK
                    }

                    if ((isset($request->archivo[$i]['check']) && $request->archivo[$i]['check'] == 'on')) {
                        $documento['vencimiento'] = 1;
                        //Si es 1 SI vence el documento

                        $documento['estatus'] = '0';
                        //Si esta en 0 Esta MAL
                        // dd( 'check', $request->archivo[ $i ][ 'fecha' ] );
                        // dd($request->archivo);
                        if (isset($request->archivo[$i]['fecha'])) {
                            $documento['fechaVencimiento'] = $request->archivo[$i]['fecha'];
                            // Evaluar fecha de vencimiento
                            if ($request->archivo[$i]['modificacionDocs'] == 1) {
                                $eventoCalendario = new calendarioPrincipal();
                                $eventoCalendario->maquinariaId = $maquinaria->id;
                                $eventoCalendario->title = 'Expira documento: ' . $request->archivo[$i]['tipoDocsNombre'];
                                $eventoCalendario->end = strtoupper($documento['fechaVencimiento'] . ' ' . '23:00:00');
                                $eventoCalendario->start = strtoupper($documento['fechaVencimiento'] . ' ' . '01:00:00');
                                $eventoCalendario->descripcion = 'Expiración del Documento: ' . $request->archivo[$i]['tipoDocsNombre'] . ' Perteneciente al Equipo: ' . $maquinaria->nombre . ', con Placas: ' . $maquinaria->placas . ', y N/Económico: ' . $maquinaria->identificador;
                                $eventoCalendario->color = '#f70202';
                                $eventoCalendario->tipoEvento = 'ExpiranDocumentos';
                                // dd($eventoCalendario);
                                $eventoCalendario->save();
                            }

                            $fechaActual = Carbon::now();
                            // Obtén la fecha que deseas evaluar ( por ejemplo, desde una base de datos )
                            $fechaProximaAVencer = Carbon::parse($request->archivo[$i]['fecha']);
                            // Calcula la diferencia en meses entre las dos fechas
                            $mesesRestantes = $fechaActual->diffInMonths($fechaProximaAVencer, false);
                            if ($mesesRestantes <= 1) {
                                $documento['estatus'] = '1';
                                //Si es 1 Esta proximo a vencer
                            } else {
                                $documento['estatus'] = '2';
                                //Si es 2 Esta Bien
                            }
                            // dd( 'entro' );
                        }
                    } else {
                        $documento['vencimiento'] = 0;
                        //Si es 0 no vence el documento
                        // $documento->estatus = '1';
                    }
                } else {
                    // NO REQUERIDO
                    $documento['requerido'] = '0';
                    $documento['estatus'] = '2';
                    //Si es 2 Esta  OK
                }

                $documento['comentarios'] = $request->archivo[$i]['comentario'];
                if ($request->archivo[$i]['idDoc'] == null) {
                    $documento->save();
                } else {
                    $docu = maqdocs::where('id', $request->archivo[$i]['idDoc'])->first();
                    // dd( $request->archivo[ $i ][ 'idDoc' ] );
                    $docu->update($documento);
                }
            }
        }

        if ($request->hasFile('ruta')) {
            foreach ($request->file('ruta') as $ruta) {
                $imagen['maquinariaId'] = $maquinaria->id;
                $imagen['ruta'] = time() . '_' . $ruta->getClientOriginalName();
                $ruta->storeAs('/public/maquinaria/' . $pathMaquinaria, $imagen['ruta']);
                maqimagen::create($imagen);
            }
        }
        $nuevaLista = collect();

        for (
            $i = 0;
            $i < count($request['idRefaccion']);
            $i++
        ) {
            $relacion = inventario::where('numparte', $request['numeroParte'][$i])->first();

            if ($request['marca'][$i] && $request['tipoRefaccionId'][$i]) {
                $numParteRelacion = null;
                if ($relacion != null) {
                    $numParteRelacion = $relacion->id;
                }
                $array = [
                    'id' => $request['idRefaccion'][$i],
                    'marcaId' => $request['marca'][$i],
                    'tipoRefaccionId' => $request['tipoRefaccionId'][$i],
                    'numeroParte' => $request['numeroParte'][$i],
                    'maquinariaId' => $maquinaria->id,
                    'relacionInventarioId' => $numParteRelacion,
                ];
                $objRefaccion = refacciones::updateOrCreate(['id' => $array['id']], $array);
                $nuevaLista->push($objRefaccion->id);
            }
        }
        $test = refacciones::where('maquinariaId', $maquinaria->id)->whereNotIn('id', $nuevaLista)->delete();

        Session::flash('message', 1);

        $this->cambiaEstatusMaquinaria($maquinaria->id, $maquinaria->estatusId);

        return redirect()->route('maquinaria.index');
    }

    public function updateDocumento(Request $request)
    {

        dd($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\maquinaria  $maquinaria
     * @return \Illuminate\Http\Response
     */

    public function destroy($id, $estatusId = 1)
    {
        abort_if(Gate::denies('maquinaria_destroy'), 403);

        $this->cambiaEstatusMaquinaria($id, $estatusId);
    }

    /**
     * Elimina la relacion de un equipo con un checklist
     *
     * @param int $bitacoraEquiposId Identificador del registro de la tabla de Bitacoras y Equipos
     * @return void
     */
    public function destroyCheckList($bitacoraEquiposId)
    {
        // dd($bitacoraEquiposId);
        abort_if(Gate::denies('maquinaria_destroy'), 403);
        try {
            $item = bitacorasEquipos::where('id', '=', $bitacoraEquiposId)->first();
            $item->delete();
            // Intenta eliminar
        } catch (QueryException $e) {
            if ($e->getCode() === 23000) {
                return redirect()->back()->with('faild', 'No Puedes Eliminar ');
                // Esto es un error de restricción de clave externa ( FOREIGN KEY constraint )
                // Puedes mostrar un mensaje de error o realizar otras acciones aquí.
            } else {
                return redirect()->back()->with('faild', 'No Puedes Eliminar si esta en uso');
                // Otro tipo de error de base de datos
                // Maneja según sea necesario
            }
        }
        return redirect()->back()->with('success', 'Eliminado correctamente');
    }

    public function cambiaEstatusMaquinaria($id, $estatusId)
    {
        abort_if(Gate::denies('maquinaria_destroy'), 403);

        $objMaquinaria = maquinaria::where('id', '=', $id)->firstOrFail();

        $vctEstatus = maquinariaEstatus::select('maquinariaEstatus.nombre')->get()->toArray();
        $aEstatus = array();
        foreach ($vctEstatus as   $value) {
            $aEstatus[] = strtoupper($value['nombre'] . '_');
        }

        if (empty($objMaquinaria) === false) {
            $strPrefijo = '';
            $objEstatus = maquinariaEstatus::where('id', $estatusId)->firstOrFail();

            //** si el estatus es mayor de 1 se debe de realizar ajustes */
            if (empty($objEstatus) === false && $objEstatus->id > 1) {
                //** para todos los estatus */
                $strPrefijo = $objEstatus->nombre . '_';

                $strMaquinariaId = $strPrefijo .  str_replace($aEstatus, '', $objMaquinaria->identificador);

                $objMaquinaria->identificador = strtoupper($strMaquinariaId);
                $objMaquinaria->update();
            } else {
                /** es activacion */
                $strMaquinariaId =  str_replace($aEstatus, '', $objMaquinaria->identificador);

                $objMaquinaria->identificador = strtoupper($strMaquinariaId);
                $objMaquinaria->update();
            }
        }
    }

    public function upload(Request $request)
    {
        abort_if(Gate::denies('maquinaria_edit'), 403);

        $objMaquinaria = maquinaria::where('id', '=', $request['maquinariaId'])->firstOrFail();

        if ($objMaquinaria) {
            /*** directorio contenedor de su información */
            $pathMaquinaria = str_pad($objMaquinaria->identificador, 4, '0', STR_PAD_LEFT);

            if ($request->hasFile('ruta')) {
                $objMaquinaria = new maqdocs();

                $objMaquinaria->ruta = time() . '_' . $request->file('ruta')->getClientOriginalName();
                $objMaquinaria->tipo =  $request['tipo'];
                $objMaquinaria->maquinariaId = $request['maquinariaId'];
                $objMaquinaria->comentarios = $request['comentarios'];
                $objMaquinaria->fechaVencimiento = $request['fechaVencimiento'];
                $objMaquinaria->save();

                $request->file('ruta')->storeAs('/public/maquinaria/' . $pathMaquinaria . '/documentos/' .  $objMaquinaria->tipo, $objMaquinaria->ruta);

                Session::flash('message', 1);
            } else {
                Session::flash('message', 0);
            }
        }

        return redirect()->route('maquinaria.show', $request['maquinariaId']);
    }

    public function download($id, $doc)
    {

        abort_if(Gate::denies('maquinaria_edit'), 403);
        $book = maqdocs::where('id', $id)->firstOrFail();

        if (empty($book) === false) {

            $objMaq = maquinaria::where('id', '=', $book->maquinariaId)->firstOrFail();

            /*** directorio contenedor de su información */
            $pathMaquinaria = str_pad($objMaq->identificador, 4, '0', STR_PAD_LEFT);

            $pathToFile = storage_path('app/public/maquinaria/' . $pathMaquinaria . '/documentos/' . $book->tipo . '/' . $book->ruta);

            if (file_exists($pathToFile) === true &&  is_file($pathToFile) === true) {
                // return response()->download( $pathToFile );
                return response()->file($pathToFile);
            } else {
                return redirect('404');
            }
        }
    }

    public function generaCodigoIdentificacion($categoria)
    {
        $strCodigo = null;
        $intEquipos = 0;
        //*** obtenemos el numero de elementos existentes */
        switch (strtolower($categoria)) {
            case 'otros':
            case 'cisterna':
            case 'utilitarios':
                $intEquipos = (int) maquinaria::where('categoria', 'otros')->get()->count();
                $intEquipos +=  (int)  maquinaria::where('categoria', 'cisterna')->get()->count();
                $intEquipos += (int)   maquinaria::where('categoria', 'utilitarios')->get()->count();
                break;

            default:
                $intEquipos = maquinaria::where('categoria', $categoria)->get()->count();
                break;
        }

        /*** buscamos el tipo para crear el tipo */
        switch (strtolower($categoria)) {
            case 'campers':
            case '2':
                $strCodigo = 'CAM-' . str_pad($intEquipos + 1, 2, 0, STR_PAD_LEFT);
                break;

            case 'retroexcavadoras':
            case '6':
                $strCodigo = 'RET-' . str_pad($intEquipos + 1, 2, 0, STR_PAD_LEFT);
                break;

            case 'maquinaria pesada':
            case '5':
                $strCodigo = 'MP-' . str_pad($intEquipos + 1, 2, 0, STR_PAD_LEFT);
                break;

            case 'maquinaria ligera':
            case '4':
                $strCodigo = 'ML-' . str_pad($intEquipos + 1, 2, 0, STR_PAD_LEFT);
                break;

            case 'tractocamiones':
            case '7':
                $strCodigo = 'TRA-' . str_pad($intEquipos + 1, 2, 0, STR_PAD_LEFT);
                break;

            case 'accesorios':
            case '1':
                $strCodigo = 'ACC-' . str_pad($intEquipos + 1, 2, 0, STR_PAD_LEFT);
                break;

            case 'otros':
            case 'cisterna':
            case 'utilitarios':
            case '3':
                $strCodigo = 'Q2S-' . str_pad($intEquipos + 1, 2, 0, STR_PAD_LEFT);
                break;

            default:
                $strCodigo = 'DES-' . str_pad($intEquipos + 1, 2, 0, STR_PAD_LEFT);
                break;
        }

        return $strCodigo;
    }
    /**
     * Asigna una maquinaria a personal
     *
     * @param Request $request
     * @return void
     */

    public function asignacion(Request $request)
    {
        abort_if(Gate::denies('maquinaria_assign_personal'), 403);
        $data = $request->all();
        $vctDebug = array();
        $objAsigna = new obraMaqPer();
        $objHistorico = new obraMaqPerHistorico();

        // dd( $request, $data );
        //*** validamos si estan aplicados los dos filtros sin cambios y solo se actualizan los datos */
        if ($data['NobraId'] == 0 && $data['NpersonalId'] == 0) {
            $objResult = $objAsigna->actualizarDatosRegistro($data['recordId'], $data['combustible'], $data['inicio'], $data['fin']);
        } elseif ($data['NobraId'] == 0 && $data['NpersonalId'] == -1) {
            //*** eliminamos la referencia del operador */
            $objResult = $objAsigna->eliminarReferenciaDeOperador($data['recordId']);
        } else {
            //*** realizamos el registro de movimiento */
            $objResult = $objAsigna->registraMovimiento($data['maquinariaId'], $data['NpersonalId'], $data['NobraId'], $data['recordId'], $data['combustible'], $data['inicio'], $data['fin']);
        }

        return redirect()->route('maquinaria.index');
    }

    /**
     * Muestra la distribución de los equipos y checklist
     *
     * @return void
     */
    public function checkLists(Request $request)
    {

        abort_if(Gate::denies('maquinaria_index'), 403);
        $estatus = $request->input('estatus', '0');

        $vctMaquinaria = maquinaria::select('maquinaria.id', DB::raw("CONCAT(maquinaria.identificador,' ', maquinaria.nombre)as maquinaria"),)
            ->whereNull('compania')
            ->orderBy('maquinaria.identificador', 'asc')->get();

        $vctBitacoras = bitacoras::select(
            DB::raw("CONCAT(bitacoras.nombre,' ', bitacoras.codigo,' v', bitacoras.version)as bitacora"),
            'bitacoras.id',
            'frecuenciaEjecucion.nombre as frecuencia',
            'frecuenciaEjecucion.dias',
        )
            ->join('frecuenciaEjecucion', 'frecuenciaEjecucion.id', 'bitacoras.id')
            ->where('bitacoras.activa', '=', 1)
            ->orderBy('bitacoras.nombre', 'asc')->get();

        $vctRecords = bitacoras::select(
            DB::raw("CONCAT(bitacoras.nombre,' ', bitacoras.codigo,' v', bitacoras.version)as bitacora"),
            'bitacoras.id as bitacoraId',
            'bitacorasEquipos.id as bitacoraEquiposId',
            'frecuenciaEjecucion.nombre as frecuencia',
            'bitacoras.frecuenciaId',
            DB::raw("CONCAT(maquinaria.identificador,' ', maquinaria.nombre)as maquinaria"),
            'maquinaria.id as maquinariaId',
            'maquinaria.estatusId',
        )
            ->join('frecuenciaEjecucion', 'frecuenciaEjecucion.id', 'bitacoras.id')
            ->leftjoin('bitacorasEquipos', 'bitacorasEquipos.bitacoraId', 'bitacoras.id')
            ->rightjoin('maquinaria', 'maquinaria.id', 'bitacorasEquipos.maquinariaId')
            ->whereNull('compania');

        if ($estatus !== '0') {
            $vctRecords = $vctRecords->where('maquinaria.id', $estatus);
        }

        $vctRecords = $vctRecords->where('maquinaria.estatusId', '=', 1)
            ->orderBy('maquinaria.identificador', 'asc')
            ->orderBy('frecuenciaEjecucion.dias', 'asc')
            ->paginate(15);

        return view('maquinaria.checkListMaquinaria', compact('vctRecords', 'vctMaquinaria', 'vctBitacoras'));
    }
}
