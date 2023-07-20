<?php

namespace App\Http\Controllers;

use App\Models\maquinaria;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use App\Helpers\Validaciones;
use Illuminate\Support\Facades\Session;

class maquinariaMtqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(Gate::denies('maquinaria_index'), 403);

        // Filtrar maquinarias donde el campo 'compania' no sea nulo
        $maquinaria = maquinaria::whereNotNull('compania')->paginate(15);
        // dd( 'test' );
        return view('mtq.indexMaquinariaMtq', compact('maquinaria'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(Gate::denies('maquinaria_create'), 403);

        return view('mtq.altaDeMaquinariaMtq');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        abort_if(Gate::denies('maquinaria_create'), 403);

        // dd( $request );

        $maquinaria = $request->all();

        //** Generamos el identificador de la maquinaria */
        $maquinaria['estatusId'] = 1;
        $maquinaria['compania'] = 'mtq';
        // dd( $maquinaria[ 'identificador' ] );

        /*** directorio contenedor de su información */
        $pathMaquinaria = str_pad($maquinaria['identificador'], 4, '0', STR_PAD_LEFT);

        $maquinaria['placas'] = strtoupper($maquinaria['placas']);
        $maquinaria['nummotor'] = strtoupper($maquinaria['nummotor']);
        $maquinaria['numserie'] = strtoupper($maquinaria['numserie']);

        //*** se guarda la maquinaria */
        //dd($request);
        $maquinaria = maquinaria::create($maquinaria);
        

        //**Imagenes de la maquinaria */
        if ($request->hasFile('ruta')) {
            foreach ($request->file('ruta') as $ruta) {
                $imagen['maquinariaId'] = $maquinaria->id;
                $imagen['ruta'] = time() . '_' . $ruta->getClientOriginalName();
                $ruta->storeAs('/public/maquinaria/' . $pathMaquinaria, $imagen['ruta']);
                maqimagen::create($imagen);
            }
        }

        Session::flash('message', 1);
        return redirect()->route('mtq.index');
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

        // dd( $docs );
//        return view('maquinaria.detalleMaquinaria', compact('maquinaria', 'docs', 'fotos', 'vctEstatus'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\maquinaria  $maquinaria
     * @return \Illuminate\Http\Response
     */
    public function edit(maquinaria $maquinaria)
    {
        dd($maquinaria);
        // $docs = maqdocs::where( 'maquinariaId', $maquinaria->id )->first();
        // return view( 'maquinaria.detalleMaquinaria', compact( 'maquinaria', 'docs' ) );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\maquinaria $maquinaria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $maquinaria)
    {
        abort_if(Gate::denies('maquinaria_edit'), 403);

        $maquinariaMtq = maquinaria::where('id',$request->id)->first();
        // dd($request, $maquinaria, $maquinariaMtq);
        $data = $request->all();
        
        $data['identificador'] = strtoupper($data['identificador']);
        $data['placas'] = strtoupper($data['placas']);
        $data['nummotor'] = strtoupper($data['nummotor']);
        $data['numserie'] = strtoupper($data['numserie']);

        /*** directorio contenedor de su información */
        $pathMaquinaria = str_pad($data['identificador'], 4, '0', STR_PAD_LEFT);
        $data['compania'] = 'mtq';
        

        $maquinariaMtq->update($data);
        
        // dd($request);

        if ($request->hasFile('ruta')) {
            foreach ($request->file('ruta') as $ruta) {
                $imagen['maquinariaId'] = $maquinaria->id;
                $imagen['ruta'] = time() . '_' . $ruta->getClientOriginalName();
                $ruta->storeAs('/public/maquinaria/' . $pathMaquinaria, $imagen['ruta']);
                maqimagen::create($imagen);
            }
        }

        Session::flash('message', 1);

        return redirect()->route('mtq.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\maquinaria  $maquinaria
     * @return \Illuminate\Http\Response
     */
    public function destroy(maquinaria $maquinaria)
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
                //$objMaquinaria = new maqdocs();

                $objMaquinaria->ruta = time() . '_' . $request->file('ruta')->getClientOriginalName();
                $objMaquinaria->tipo =  $request['tipo'];
                $objMaquinaria->maquinariaId = $request['maquinariaId'];
                $objMaquinaria->comentarios = $request['comentarios'];
                $objMaquinaria->fechaVencimiento = $request['fechaVencimiento'];
                $objMaquinaria->save();

                //$request->file('ruta')->storeAs('/public/maquinaria/' . $pathMaquinaria . '/documentos/' .  $objMaquinaria->tipo, $objMaquinaria->ruta);

                Session::flash('message', 1);
            } else {
                Session::flash('message', 0);
            }
        }

        return redirect()->route('maquinaria.show', $request['maquinariaId']);
    }
}
