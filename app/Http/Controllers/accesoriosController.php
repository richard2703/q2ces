<?php

namespace App\Http\Controllers;

use App\Models\accesorios;
use App\Models\accesoriosDocs;
use App\Models\docs;
use App\Models\maquinaria;
use App\Models\marca;
use App\Models\marcasTipo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class accesoriosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        abort_if(Gate::denies('maquinaria_index'), '403');
        $accesorios = accesorios::select('accesorios.*', db::raw("CONCAT(maquinaria.identificador,' ',maquinaria.nombre) AS maquinaria"), 'marca.nombre as marca',)
            ->join('maquinaria', 'maquinaria.id', '=', 'accesorios.maquinariaId')
            ->leftjoin('marca', 'marca.id', 'accesorios.marcaId')
            ->paginate(10);
        // dd($accesorios);
        return view('accesorios.indexAccesorios', compact('accesorios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        abort_if(Gate::denies('maquinaria_create'), '403');
        // $marcasTipo = marcasTipo::->get();

        // dd($marcasTipo);
        $marcas = marca::select('marca.*', 'marcasFilter.tipos_marcas_id')->leftJoin('marcasTipo as marcasFilter', 'marca.id', '=', 'marcasFilter.marca_id')->orderBy('nombre', 'asc')
            ->where('marcasFilter.tipos_marcas_id', '5')
            ->get();
        // dd($marcas);
        $doc = docs::where('tipoId', '3')->orderBy('nombre', 'asc')->get();
        $vctMaquinaria = maquinaria::all();
        return view('accesorios.altaDeAccesorios', compact('vctMaquinaria', 'doc', 'marcas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        abort_if(Gate::denies('maquinaria_create'), '403');

        // dd( 'test' );
        $request->validate([
            'nombre' => 'required|max:250',
            'modelo' => 'nullable|max:200',
            'marca' => 'nullable|max:200',
            'serie' => 'nullable|max:200',
            'ano' => 'nullable|max:9999|numeric',
            'color' => 'nullable|max:200',
            'maquinariaId' => 'required',
        ], [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'nombre.max' => 'El campo nombre excede el límite de caracteres permitidos.',
            'modelo.max' => 'El campo modelo excede el límite de caracteres permitidos.',
            'marca.max' => 'El campo marca excede el límite de caracteres permitidos.',
            'ano.numeric' => 'El campo año debe ser numérico.',
            'ano.max' => 'El campo serie excede el límite de caracteres permitidos.',
            'ano.min' => 'El campo año requiere de al menos 4 caracteres.',
            'color.max' => 'El campo color excede el límite de caracteres permitidos.',
            'maquinariaId.required' => 'El campo maquinaría es obligatorio.',
        ]);
        $accesorio = $request->only(
            'nombre',
            'marcaId',
            'modelo',
            'color',
            'serie',
            'ano',
            'maquinariaId',
            'foto'
        );
        $accesorio['serie'] = strtoupper($accesorio['serie']);
        // dd($request);

        /*** directorio contenedor de su información */

        // $accesorioPath = str_pad($accesorio['identificador'], 4, '0', STR_PAD_LEFT);
        $accesorio = accesorios::create($accesorio);

        $cont = 0;



        for ($i = 0; $i < count($request->archivo); $i++) {
            $documento = new accesoriosDocs();
            $documento->accesorioId = $accesorio->id;
            $documento->tipoId = $request->archivo[$i]['tipoDocs'];
            // Obtenemos el tipo de documento
            $tipoDocumentoNombre = $request->archivo[$i]['tipoDocsNombre'];
            // Obtenemos el tipo de documento
            $pathAccesorio = str_pad($accesorio['serie'] . $documento->accesorioId, 4, '0', STR_PAD_LEFT);
            if ($request->archivo[$i]['omitido'] == 0) {
                // OBLIGATORIO
                $documento->requerido = '1';
                $documento->estatus = '0';

                if (isset(($request->archivo[$i]['docs']))) {
                    $file = $request->file('archivo')[$i]['docs'];
                    $documento->ruta = time() . '_' . $file->getClientOriginalName();
                    $file->storeAs('/public/accesorios/' . $pathAccesorio . '/documentos/' .  $tipoDocumentoNombre, $documento->ruta);
                    // $file->storeAs('/public/accesorios/ ' .  . '/documentos/', $documento->ruta);
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

        $pathAccesorioFoto = str_pad($accesorio->id, 4, '0', STR_PAD_LEFT);

        if ($request->hasFile('foto')) {
            $accesorio->foto = time() . '_' . 'foto.' . $request->file('foto')->getClientOriginalExtension();

            $request->file('foto')->storeAs('/public/accesorios/' . $pathAccesorioFoto . '/', $accesorio->foto);
            $accesorio->save();
        }

        Session::flash('message', 1);
        return redirect()->route('accesorios.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\accesorios  $accesorios
     * @return \Illuminate\Http\Response
     */

    public function show(accesorios $accesorios)
    {
        abort_if(Gate::denies('maquinaria_show'), '403');
        $marcas = marca::select('marca.*', 'marcasFilter.tipos_marcas_id')->leftJoin('marcasTipo as marcasFilter', 'marca.id', '=', 'marcasFilter.marca_id')->orderBy('nombre', 'asc')
            ->where('marcasFilter.tipos_marcas_id', '5')
            ->get();
        $vctMaquinaria = maquinaria::all();
        return view('accesorios.detalleAccesorios', compact('accesorios', 'vctMaquinaria', 'marcas'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\accesorios  $accesorios
     * @return \Illuminate\Http\Response
     */

    public function edit(accesorios $accesorios)
    {
        abort_if(Gate::denies('maquinaria_edit'), '403');
        $marcasTipo = marcasTipo::where('tipos_marcas_id', '=', '5');
        $marcas = marca::select('marca.*', 'marcasFilter.tipos_marcas_id')->leftJoin('marcasTipo as marcasFilter', 'marca.id', '=', 'marcasFilter.marca_id')->orderBy('nombre', 'asc')
            ->where('marcasFilter.tipos_marcas_id', '5')
            ->get();
        $doc = docs::leftJoin('accesoriosDocs', function ($join) use ($accesorios) {
            $join->on('docs.id', '=', 'accesoriosDocs.tipoId')
                ->where('accesoriosDocs.accesorioId', '=', $accesorios->id);
        })
            ->select(
                'docs.id',
                'docs.nombre',
                'accesoriosDocs.fechaVencimiento',
                'accesoriosDocs.estatus',
                'accesoriosDocs.comentarios',
                'accesoriosDocs.ruta',
                'accesoriosDocs.requerido',
                'accesoriosDocs.id as idDoc'
            )->where('docs.tipoId', '3')
            ->get();

        // dd($doc);
        // dd($accesorios);
        $vctMaquinaria = maquinaria::all();
        // 
        return view('accesorios.detalleAccesorios', compact('accesorios', 'vctMaquinaria', 'doc', 'marcas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\accesorios  $accesorios
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, accesorios $accesorios)
    {
        abort_if(Gate::denies('maquinaria_edit'), '403');

        // dd( $accesorios );
        $request->validate([
            'nombre' => 'required|max:250',
            'modelo' => 'nullable|max:200',
            'marca' => 'nullable|max:200',
            'serie' => 'nullable|max:200',
            'ano' => 'nullable|max:9999|numeric',
            'color' => 'nullable|max:200',
            'maquinariaId' => 'required',
        ], [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'nombre.max' => 'El campo nombre excede el límite de caracteres permitidos.',
            'modelo.max' => 'El campo modelo excede el límite de caracteres permitidos.',
            'marca.max' => 'El campo marca excede el límite de caracteres permitidos.',
            'ano.numeric' => 'El campo año debe ser numérico.',
            'ano.max' => 'El campo serie excede el límite de caracteres permitidos.',
            'ano.min' => 'El campo año requiere de al menos 4 caracteres.',
            'color.max' => 'El campo color excede el límite de caracteres permitidos.',
            'maquinariaId.required' => 'El campo maquinaría es obligatorio.',
        ]);
        $data = $request->only(
            'nombre',
            'marcaId',
            'modelo',
            'color',
            'serie',
            'ano',
            'foto',
            'maquinariaId'
        );
        // dd($request);
        $pathAccesorio = str_pad($data['serie'] . $accesorios->id, 4, '0', STR_PAD_LEFT);
        if ($request->archivo) {
            for (
                $i = 0;
                $i < count($request->archivo);
                $i++
            ) {
                $documento = null;
                // dd( $request->archivo[ $i ][ 'idDoc' ] );
                if ($request->archivo[$i]['idDoc'] == null) {
                    $documento = new accesoriosDocs();
                }
                $documento['maquinariaId'] = $accesorios->id;
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
                        $file->storeAs('/public/accesorios/' . $pathAccesorio . '/documentos/' .  $tipoDocumentoNombre, $documento['ruta']);
                        // $file->storeAs('/public/accesorios/ ' . $pathAccesorio . '/documentos/'. $tipoDocumentoNombre, $documento['ruta']);
                        // $file->storeAs('/public/maquinaria/' . $pathMaquinaria . '/documentos/' .  $tipoDocumentoNombre, $documento->ruta);
                        $documento['estatus'] = '2';
                        //Si es 2 Esta  OK
                    }

                    if ((isset($request->archivo[$i]['check']) && $request->archivo[$i]['check'] == 'on')) {
                        $documento['vencimiento'] = 1;
                        //Si es 1 SI vence el documento
                        $documento['estatus'] = '0';
                        //Si esta en 0 Esta MAL
                        // dd( 'check', $request->archivo[ $i ][ 'fecha' ] );
                        if (isset($request->archivo[$i]['fecha'])) {
                            $documento['fechaVencimiento'] = $request->archivo[$i]['fecha'];
                            // Evaluar fecha de vencimiento
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
                    $docu = accesoriosDocs::where('id', $request->archivo[$i]['idDoc'])->first();
                    // dd( $request->archivo[ $i ][ 'idDoc' ] );
                    $docu->update($documento);
                }
            }
        }

        $data['serie'] = strtoupper($data['serie']);
        /*** directorio contenedor de su información */
        $pathAccesorio = str_pad($data['serie'] . $accesorios->id, 4, '0', STR_PAD_LEFT);
        $pathAccesorioFoto = str_pad($accesorios->id, 4, '0', STR_PAD_LEFT);

        if ($request->hasFile('foto')) {
            $data['foto'] = time() . '_' . 'foto.' . $request->file('foto')->getClientOriginalExtension();
            $request->file('foto')->storeAs('/public/accesorios/' . $pathAccesorioFoto . '/', $data['foto']);
        }

        $accesorios->update($data);
        Session::flash('message', 1);
        return redirect()->route('accesorios.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\accesorios  $accesorios
     * @return \Illuminate\Http\Response
     */

    public function destroy(accesorios $accesorios)
    {
        abort_if(Gate::denies('maquinaria_destroy'), '403');

        return redirect()->back()->with('failed', 'No se puede eliminar');
    }

    public function test(Request $request)
    {
        dd('test');
    }
}
