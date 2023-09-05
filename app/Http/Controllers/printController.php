<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\carga;
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
            ->join('users', 'descarga.userId', '=', 'users.id')
            // ->join('servicios', 'descarga.servicioId', '=', 'servicios.id')
            ->join('personal as operador', 'descarga.operadorId', '=', 'operador.id') // Alias 'operador' para la primera instancia de 'personal'
            ->join('personal as receptor', 'descarga.receptorId', '=', 'receptor.id') // Alias 'receptor' para la segunda instancia de 'personal'
            ->where('descarga.id', $request['id'])
            ->select('descarga.*', 'maquinaria.nombre as maquinaria_nombre', 'users.name as user_nombre', 'operador.nombres as operador_nombre', 'receptor.nombres as receptor_nombre')
            ->first();


        // dd($descarga);

        // return redirect()->route('inventario.dashCombustible');
        return view('inventario.vistaPreviaImpresion', compact('descarga'));
    }

    public function printCarga(Request $request)
    {
        $carga = carga::join('maquinaria', 'carga.maquinariaId', '=', 'maquinaria.id')
            ->join('users', 'carga.userId', '=', 'users.id')
            ->join('personal as operador', 'carga.operadorId', '=', 'operador.id')
            ->where('carga.id', $request['id'])
            ->select('carga.*', 'maquinaria.nombre as maquinaria_nombre', 'users.name as user_nombre', 'operador.nombres as operador_nombre')
            ->first();


        // dd($descarga);

        // return redirect()->route('inventario.dashCombustible');
        return view('inventario.vistaPreviaImpresionCarga', compact('carga'));
    }
}
