<?php

namespace App\Http\Controllers;

use App\Models\clientes;
use App\Models\documentoSelladoMantenimiento;
use App\Models\facturaCliente;
use App\Models\mantenimientoImagen;
use App\Models\mantenimientos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class documentoSelladoMantenimientoController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $id = $request->query('id');
        $mantenimiento = mantenimientos::select(
            'mantenimientos.*','maquinaria.compania',
            DB::raw("CONCAT(maquinaria.identificador,' - ', maquinaria.nombre)as maquinaria"),
        )
            ->join('maquinaria', 'maquinaria.id', '=', 'mantenimientos.maquinariaId')
            ->where('mantenimientos.id', '=', $id)->first();

        $fotos = documentoSelladoMantenimiento::where('mantenimientoId', $id)->get();

        // dd($mantenimiento);
        return view('mantenimientos.documentosMantenimiento', compact('mantenimiento', 'fotos', 'id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        abort_if(Gate::denies('catalogos_edit'), 403);
        // $request->validate([
        //     'nombre' => 'required|max:250',
        // ], [
        //     'nombre.required' => 'El campo nombre es obligatorio.',
        //     'nombre.max' => 'El campo título excede el límite de caracteres permitidos.',
        // ]);

        $data = $request->all();
        // dd($data);
        $mantto = mantenimientos::where('id', $data['mantenimientoId'])->first();

        /*** trabajamos las imagenes */
        $eliminarFotos = json_decode($request->arrayFotosPersistente);
        // dd( $data[ 'bitacoraId' ] );
        // $maquinaria->update( $data );

        if ($eliminarFotos != null) {
            for (
                $i = 0;
                $i < count($eliminarFotos);
                $i++
            ) {
                // dd( $eliminarFotos[ $i ]->id );
                $test = documentoSelladoMantenimiento::where('id', $eliminarFotos[$i]->id)->delete();
                // dd( $test );
            }
        }
        /*** directorio contenedor de su información */
        $pathMaquinaria = str_pad($data['mantenimientoId'], 4, '0', STR_PAD_LEFT);
        //*** folio consecutivo del checklist */
        $intFolio = str_pad($mantto->id, 4, '0', STR_PAD_LEFT);

        if ($request->hasFile('ruta')) {
            $intNum = 1;
            foreach ($request->file('ruta') as $ruta) {
                $imagen['mantenimientoId'] = $mantto->id;
                $imagen['maquinariaId'] = $mantto->maquinariaId;
                $imagen['ruta'] = $intFolio . '_' . time() . '_' . 'Imagen' . str_pad($intNum, 2, '0', STR_PAD_LEFT) . '.' . $ruta->getClientOriginalExtension();
                // dd( $imagen, '/public/maquinaria/' . $pathMaquinaria. '/mantenimientos/'.$mantto->codigo.'/' . $intFolio .'_'. time() . '_' . 'Imagen'. str_pad( $intNum, 2, '0', STR_PAD_LEFT ) .'.'. $ruta->getClientOriginalExtension() );
                $ruta->storeAs('/public/maquinaria/' . $pathMaquinaria . '/mantenimientosDocumentoFirmado/' . $mantto->codigo, $imagen['ruta']);
                documentoSelladoMantenimiento::create($imagen);
                $intNum += 1;
            }
        }
        $mantto->update();

        $fotos = documentoSelladoMantenimiento::where('mantenimientoId', $data['mantenimientoId'])->get();

        if (!$fotos->isEmpty()) {
            $mantto->documentoSellado = 1;
            $mantto->update();
        } else {
            $mantto->documentoSellado = 0;
            $mantto->update();
        }

        Session::flash('message', 1);

        return redirect()->route('mantenimientos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }
}
