<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\descarga;
use Illuminate\Http\Request;

class printController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function print(Request $request)
    {
        // dd('HOLA', $request['id']);
        $descarga = descarga::join('maquinaria', 'descarga.maquinariaId', '=', 'maquinaria.id')
            // ->join('servicios', 'descarga.servicioId', '=', 'servicios.id')
            // ->join('receptores', 'descargas.receptorId', '=', 'receptores.id')
            ->where('descarga.id', $request['id'])
            ->select('descarga.*', 'maquinaria.nombre as maquinaria_nombre')
            ->first();

        // dd($descarga);

        // return redirect()->route('inventario.dashCombustible');
        return view('inventario.vistaPreviaImpresion', compact('descarga'));
    }
}
