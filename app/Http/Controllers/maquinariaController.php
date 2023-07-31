<?php

namespace App\Http\Controllers;

use App\Models\maquinaria;
use App\Models\maqdocs;
use App\Models\maqimagen;
use App\Models\bitacoras;
use App\Models\docs;
use App\Models\maquinariaEstatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use PhpParser\Node\Stmt\Switch_;
use Illuminate\Support\Facades\Gate;
use LengthException;

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

        $maquinaria = maquinaria::whereNull('compania')->paginate(15);
        // dd( 'test' );
        return view('maquinaria.indexMaquinaria', compact('maquinaria'));
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
        $bitacora = bitacoras::all();

        return view('maquinaria.altaDeMaquinaria', compact('bitacora', 'doc'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        // dd($request->archivo);
        abort_if(Gate::denies('maquinaria_create'), 403);
        // $request->validate([
        //     'nombre' => 'required|max:250',
        //     'identificador' => 'required|max:8',
        //     'marca' => 'required|max:250',
        //     'modelo' => 'required|max:250',
        //     'horometro' => 'nullable|numeric',
        //     'kilometraje' => 'nullable|numeric',
        //     'submarca' => 'nullable|max:200',
        //     'categoria' => 'required|max:200',
        //     'ano' => 'nullable|max:9999|numeric',
        //     'color' => 'nullable|max:200',
        //     'placas' => 'nullable|max:200',
        //     'motor' => 'nullable|max:200',
        //     'nummotor' => 'nullable|max:200',
        //     'numserie' => 'nullable|max:200',
        //     'vin' => 'nullable|max:200',
        //     'combustible' => 'nullable|max:200',
        //     'capacidad' => 'nullable|numeric',
        //     'tanque' => 'nullable|numeric',
        //     'ejes' => 'nullable|numeric',
        //     'rinD' => 'nullable|numeric',
        //     'rinT' => 'nullable|numeric',
        //     'llantaD' => 'nullable|numeric',
        //     'llantaT' => 'nullable|numeric',
        //     'aceitemotor' => 'nullable|numeric',
        //     'aceitetras' => 'nullable|numeric',
        //     'aceitehidra' => 'nullable|numeric',
        //     'aceitedirec' => 'nullable|numeric',
        //     'filtroaceite' => 'nullable|numeric',
        //     'filtroaire' => 'nullable|numeric',
        //     'bujias' => 'nullable|numeric',
        //     'tipobujia' => 'nullable|max:200',
        // ], [
        //     'nombre.required' => 'El campo nombre es obligatorio.',
        //     'nombre.max' => 'El campo nombre excede el límite de caracteres permitidos.',
        //     'identificador.required' => 'El campo identificador es obligatorio.',
        //     'identificador.max' => 'El campo identificador excede el límite de caracteres permitidos.',
        //     'marca.required' => 'El campo marca es obligatorio.',
        //     'marca.max' => 'El campo marca excede el límite de caracteres permitidos.',
        //     'modelo.required' => 'El campo modelo es obligatorio.',
        //     'modelo.max' => 'El campo modelo excede el límite de caracteres permitidos.',
        //     'horometro.numeric' => 'El campo horómetro debe de ser numérico.',
        //     'kilometraje.numeric' => 'El campo kilometraje debe de ser numérico.',
        //     'submarca.max' => 'El campo submarca excede el límite de caracteres permitidos.',
        //     'categoria.required' => 'El campo categoria es obligatorio.',
        //     'ano.numeric' => 'El campo año debe ser numérico.',
        //     'ano.max' => 'El campo serie excede el límite de caracteres permitidos.',
        //     'color.max' => 'El campo color excede el límite de caracteres permitidos.',
        //     'placas.max' => 'El campo placas excede el límite de caracteres permitidos.',
        //     'motor.max' => 'El campo motor excede el límite de caracteres permitidos.',
        //     'nummotor.max' => 'El número de motor placas excede el límite de caracteres permitidos.',
        //     'numserie.max' => 'El número de serie placas excede el límite de caracteres permitidos.',
        //     'vin.max' => 'El campo VIN excede el límite de caracteres permitidos.',
        //     'combustible.max' => 'El campo combustible excede el límite de caracteres permitidos.',
        //     'capacidad.numeric' => 'El campo capacidad debe ser numérico.',
        //     'tanque.numeric' => 'El campo tanque debe ser numérico.',
        //     'ejes.numeric' => 'El campo ejes debe ser numérico.',
        //     'rinD.numeric' => 'El campo rin delatero debe ser numérico.',
        //     'rinT.numeric' => 'El campo rin trasero debe ser numérico.',
        //     'llantaD.numeric' => 'El campo llanta delantera debe ser numérico.',
        //     'llantaT.numeric' => 'El campo llanta trasera debe ser numérico.',
        //     'aceitemotor.numeric' => 'El campo aceite de motor debe ser numérico.',
        //     'aceitetras.numeric' => 'El campo aceite de transmisión debe ser numérico.',
        //     'aceitehidra.numeric' => 'El campo aceite hidráulico debe ser numérico.',
        //     'aceitedirec.numeric' => 'El campo aceite de dirección debe ser numérico.',
        //     'filtroaceite.numeric' => 'El campo filtro de aceite debe ser numérico.',
        //     'filtroaire.numeric' => 'El campo filtro de aire debe ser numérico.',
        //     'bujias.numeric' => 'El campo bujias trasera debe ser numérico.',
        //     'tipobujia.max' => 'El campo tipo de bujía excede el límite de caracteres permitidos.',
        // ]);

        $maquinaria = $request->all();

        //** Generamos el identificador de la maquinaria */
        $maquinaria[ 'identificador' ] = $this->generaCodigoIdentificacion( $maquinaria[ 'categoria' ] );
        $maquinaria['estatusId'] = 1;
        // dd( $maquinaria[ 'identificador' ] );

        /*** directorio contenedor de su información */
        $pathMaquinaria = str_pad($maquinaria['identificador'], 4, '0', STR_PAD_LEFT);


        $maquinaria['placas'] = strtoupper($maquinaria['placas']);
        $maquinaria['nummotor'] = strtoupper($maquinaria['nummotor']);
        $maquinaria['numserie'] = strtoupper($maquinaria['numserie']);

        //*** se guarda la maquinaria */
        $maquinaria = maquinaria::create($maquinaria);
        $cont = 0;

        for ($i = 0; $i < count($request->archivo); $i++) {
            $documento = new maqdocs();
            $documento->maquinariaId = $maquinaria->id;
            $documento->tipoId = $request->archivo[$i]['tipoDocs']; // Obtenemos el tipo de documento
            $tipoDocumentoNombre = $request->archivo[$i]['tipoDocsNombre']; // Obtenemos el tipo de documento

            if ($request->archivo[$i]['omitido'] == 0) {
                // OBLIGATORIO
                $documento->requerido = '1';
                $documento->estatus = '0';

                if (isset(($request->archivo[$i]['docs']))) {
                    $file = $request->file('archivo')[$i]['docs'];
                    $documento->ruta = time() . '_' . $file->getClientOriginalName();
                    $file->storeAs('/public/maquinaria/' . $pathMaquinaria . '/documentos/' .  $tipoDocumentoNombre, $documento->ruta);
                    $documento->estatus = '2'; //Si es 2 Esta  OK
                }

                if ((isset($request->archivo[$i]['check']) && $request->archivo[$i]['check'] == 'on')) {
                    $documento->vencimiento = 1; //Si es 1 SI vence el documento
                    $documento->estatus = '0'; //Si esta en 0 Esta MAL
                    if (isset($request->archivo[$i]['fecha'])) {
                        $documento->fechaVencimiento = $request->archivo[$i]['fecha'];
                        // Evaluar fecha de vencimiento
                        $documento->estatus = '1'; //Si es 1 Esta proximo a vencer
                    }
                } else {
                    $documento->vencimiento = 0; //Si es 0 no vence el documento
                }
            } else {
                // NO REQUERIDO
                $documento->requerido = '0';
                $documento->estatus = '2'; //Si es 2 Esta  OK
            }
            $documento->comentarios = $request->archivo[$i]['comentario'];

            $documento->save();
        }

        // dd($request->docs[$cont]);
        // Bucle para procesar los documentos
        //dd($request->tipoDocs);
        // for ($i = 0; $i < count($request->tipoDocs); $i++) {
        //     $documento = new maqdocs();
        //     $documento->maquinariaId = $maquinaria->id;
        //     $tipoDocumento = $request->tipoDocs[$i];
        
        //     if (strpos($tipoDocumento, '-0') !== false) {
        //         $documento->tipo = substr($tipoDocumento, 0, -2);
        //         $documento->estatus = 'omitido';
        //         $documento->save();
        //     } elseif (strpos($tipoDocumento, '-1') !== false) {
        //         $documento->tipo = substr($tipoDocumento, 0, -2);
        //         $documento->estatus = 'activo';
        //         $documento->ruta = time() . '_' . $request->file('docs')[$cont]->getClientOriginalName();
        //         $request->file('docs')[$cont]->storeAs('/public/maquinaria/' . $pathMaquinaria . '/documentos/' .  $documento->tipo, $documento->ruta);
        //         $documento->save();
        //     }
        // }

        Session::flash('message', 1);
        return redirect()->route('maquinaria.index');
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
        
        $bitacora = bitacoras::all();
        //$maquinaria = maquinaria::all();
        $docs = maqdocs::where('maquinariaId', $maquinaria->id)->get();
        $doc = maqdocs::join('docs', "maqdocs.tipoId", "docs.id")
            ->select(
                'docs.id',
                'docs.nombre',
                'maqdocs.id as usuarioId',
                'maqdocs.fechaVencimiento',
                'maqdocs.estatus',
                'maqdocs.comentarios',
                'maqdocs.ruta',
                'maqdocs.requerido'
            )
            ->where('maquinariaId', $maquinaria->id)->get();
        $fotos = maqimagen::where('maquinariaId', $maquinaria->id)->get();
        $vctEstatus = maquinariaEstatus::all();
        // dd( $docs );
        return view('maquinaria.detalleMaquinaria', compact('maquinaria', 'doc', 'fotos', 'bitacora', 'vctEstatus'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\maquinaria  $maquinaria
     * @return \Illuminate\Http\Response
     */

    public function edit(maquinaria $maquinaria)
    {
        $bitacora = bitacoras::all();
        $doc = docs::where('tipoId', '2')->get();
        //$docs = maqdocs::where( 'maquinariaId', $maquinaria->id )->first();
        return view( 'maquinaria.detalleMaquinaria', compact( 'maquinaria', 'bitacora','doc'));
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
            'marca' => 'required|max:250',
            'modelo' => 'required|max:250',
            'horometro' => 'nullable|numeric',
            'kilometraje' => 'nullable|numeric',
            'submarca' => 'nullable|max:200',
            'categoria' => 'nullable|max:200',
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
            'marca.required' => 'El campo marca es obligatorio.',
            'marca.max' => 'El campo marca excede el límite de caracteres permitidos.',
            'modelo.required' => 'El campo modelo es obligatorio.',
            'modelo.max' => 'El campo modelo excede el límite de caracteres permitidos.',
            'horometro.numeric' => 'El campo horómetro debe de ser numérico.',
            'kilometraje.numeric' => 'El campo kilometraje debe de ser numérico.',
            'submarca.max' => 'El campo submarca excede el límite de caracteres permitidos.',
            'categoria.max' => 'El campo categoria excede el límite de caracteres permitidos.',
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

        $data['identificador'] = strtoupper($data['identificador']);
        $data['placas'] = strtoupper($data['placas']);
        $data['nummotor'] = strtoupper($data['nummotor']);
        $data['numserie'] = strtoupper($data['numserie']);

        /*** directorio contenedor de su información */
        $pathMaquinaria = str_pad($data['identificador'], 4, '0', STR_PAD_LEFT);

        $maquinaria->update($data);
        if ($request->hasFile('factura')) {
            $docs['factura'] = time() . '_' . $request->file('factura')->getClientOriginalName();
            $request->file('factura')->storeAs('/public/maquinaria/' . $pathMaquinaria . '/documentos', $docs['factura']);
        }
        if ($request->hasFile('circulacion')) {
            $docs['circulacion'] = time() . '_' . $request->file('circulacion')->getClientOriginalName();
            $request->file('circulacion')->storeAs('/public/maquinaria/' . $pathMaquinaria . '/documentos', $docs['circulacion']);
        }
        if ($request->hasFile('verificacion')) {
            $docs['verificacion'] = time() . '_' . $request->file('verificacion')->getClientOriginalName();
            $request->file('verificacion')->storeAs('/public/maquinaria/' . $pathMaquinaria . '/documentos', $docs['verificacion']);
        }
        if ($request->hasFile('ficha')) {
            $docs['ficha'] = time() . '_' . $request->file('ficha')->getClientOriginalName();
            $request->file('ficha')->storeAs('/public/maquinaria/' . $pathMaquinaria . '/documentos', $docs['ficha']);
        }
        if ($request->hasFile('manual')) {
            $docs['manual'] = time() . '_' . $request->file('manual')->getClientOriginalName();
            $request->file('manual')->storeAs('/public/maquinaria/' . $pathMaquinaria . '/documentos', $docs['manual']);
        }
        if ($request->hasFile('seguro')) {
            $docs['seguro'] = time() . '_' . $request->file('seguro')->getClientOriginalName();
            $request->file('seguro')->storeAs('/public/maquinaria/' . $pathMaquinaria . '/documentos', $docs['seguro']);
        }
        if ($request->hasFile('registro')) {
            $docs['registro'] = time() . '_' . $request->file('registro')->getClientOriginalName();
            $request->file('registro')->storeAs('/public/maquinaria/' . $pathMaquinaria . '/documentos', $docs['registro']);
        }
        if ($request->hasFile('especial')) {
            $docs['especial'] = time() . '_' . $request->file('especial')->getClientOriginalName();
            $request->file('especial')->storeAs('/public/maquinaria/' . $pathMaquinaria . '/documentos', $docs['especial']);
        }
        $docu = maqdocs::where('maquinariaId', $maquinaria->id);
        if (isset($docs)) {
            $docu->update($docs);
        }

        if ($request->hasFile('ruta')) {
            foreach ($request->file('ruta') as $ruta) {
                $imagen['maquinariaId'] = $maquinaria->id;
                $imagen['ruta'] = time() . '_' . $ruta->getClientOriginalName();
                $ruta->storeAs('/public/maquinaria/' . $pathMaquinaria, $imagen['ruta']);
                maqimagen::create($imagen);
            }
        }

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

        // dd( $request );
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
                $strCodigo = 'CAM-' . str_pad($intEquipos + 1, 2, 0, STR_PAD_LEFT);
                break;

            case 'retroexcavadoras':
                $strCodigo = 'RET-' . str_pad($intEquipos + 1, 2, 0, STR_PAD_LEFT);
                break;

            case 'maquinaria pesada':
                $strCodigo = 'MP-' . str_pad($intEquipos + 1, 2, 0, STR_PAD_LEFT);
                break;

            case 'maquinaria ligera':
                $strCodigo = 'ML-' . str_pad($intEquipos + 1, 2, 0, STR_PAD_LEFT);
                break;

            case 'tractocamiones':
                $strCodigo = 'TRA-' . str_pad($intEquipos + 1, 2, 0, STR_PAD_LEFT);
                break;

            case 'accesorios':
                $strCodigo = 'ACC-' . str_pad($intEquipos + 1, 2, 0, STR_PAD_LEFT);
                break;

            case 'otros':
            case 'cisterna':
            case 'utilitarios':
                $strCodigo = 'Q2S-' . str_pad($intEquipos + 1, 2, 0, STR_PAD_LEFT);
                break;

            default:
                $strCodigo = 'DES-' . str_pad($intEquipos + 1, 2, 0, STR_PAD_LEFT);
                break;
        }

        return $strCodigo;
    }
}
