<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\carga;
use App\Models\descarga;
use App\Models\descargaDetalle;
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
        $solicitante = $request->all();
        $descarga = descarga::join('maquinaria as equipo', 'descarga.maquinariaId', '=', 'equipo.id')
            ->join('users', 'descarga.userId', '=', 'users.id')
            ->join('personal as operador', 'descarga.operadorId', '=', 'operador.id')
            ->join('personal as receptor', 'descarga.receptorId', '=', 'receptor.id')
            ->join('maquinaria as despachado', 'descarga.servicioId', '=', 'despachado.id')
            ->where('descarga.descargaDetalleId', $request['id'])
            ->select('descarga.*', 'equipo.nombre as equipo_nombre', 'users.name as user_nombre', 'operador.nombres as operador_nombre', 'receptor.nombres as receptor_nombre', 'despachado.nombre as despachado_nombre')
            ->first();

        $cliente = false;
        if (isset($request['tipo_solicitud'])) {
            $cliente = true;
        }

        // dd($descarga);
        $solicitante['descargaId'] = $descarga['id'];
        $solicitante['tipo_solicitud'] = $cliente;
        $nuevoSolicitante = descargaDetalle::create($solicitante);
        $ticket = descarga::where('descargaDetalleId', $request['id'])->first();
        $ticket->ticket = 1;

        $ticket->descargaDetalleId = $nuevoSolicitante['id'];
        $ticket->save();

        return view('inventario.vistaPreviaImpresion', compact('descarga', 'solicitante', 'cliente'));
    }

    public function printEdit(Request $request)
    {
        // dd($request);
        $solicitante = $request->all();
        $descarga = descarga::join('maquinaria as equipo', 'descarga.maquinariaId', '=', 'equipo.id')
            ->join('users', 'descarga.userId', '=', 'users.id')
            ->join('personal as operador', 'descarga.operadorId', '=', 'operador.id')
            ->join('personal as receptor', 'descarga.receptorId', '=', 'receptor.id')
            ->join('maquinaria as despachado', 'descarga.servicioId', '=', 'despachado.id')
            ->where('descarga.descargaDetalleId', $request['id'])
            ->select('descarga.*', 'equipo.nombre as equipo_nombre', 'users.name as user_nombre', 'operador.nombres as operador_nombre', 'receptor.nombres as receptor_nombre', 'despachado.nombre as despachado_nombre')
            ->first();

        $cliente = false;
        if (isset($request['tipo_solicitud'])) {
            $cliente = true;
        }

        // dd($descarga);
        // $ticket->ticket = 1;

        $calendarioPrincipal = descargaDetalle::where('id', $request['id'])->first();
        $data = $request->all();
        $calendarioPrincipal->update($data);

        return view('inventario.vistaPreviaImpresion', compact('descarga', 'solicitante', 'cliente'));
    }

    public function printCarga(Request $request)
    {
        $carga = carga::join('maquinaria', 'carga.maquinariaId', '=', 'maquinaria.id')
            ->join('users', 'carga.userId', '=', 'users.id')
            ->join('personal as operador', 'carga.operadorId', '=', 'operador.id')
            ->where('carga.id', $request['id'])
            ->select('carga.*', 'maquinaria.nombre as maquinaria_nombre', 'maquinaria.kom as maquinaria_kom', 'maquinaria.kilometraje as maquinaria_kilometraje', 'users.name as user_nombre', 'operador.nombres as operador_nombre')
            ->first();

        return view('inventario.vistaPreviaImpresionCarga', compact('carga'));
    }

    public function printOnlyTicket(Request $request)
    {
        // 

        // dd($request);
        $descarga = descarga::join('maquinaria as equipo', 'descarga.maquinariaId', '=', 'equipo.id')
            ->join('users', 'descarga.userId', '=', 'users.id')
            ->join('personal as operador', 'descarga.operadorId', '=', 'operador.id')
            ->join('personal as receptor', 'descarga.receptorId', '=', 'receptor.id')
            ->join('maquinaria as despachado', 'descarga.servicioId', '=', 'despachado.id')
            ->join('descargaDetalle as detalles', 'descarga.descargaDetalleId', '=', 'detalles.id')
            ->where('descarga.descargaDetalleId', $request['id'])
            ->select('descarga.*', 'detalles.*', 'equipo.nombre as equipo_nombre', 'users.name as user_nombre', 'operador.nombres as operador_nombre', 'receptor.nombres as receptor_nombre', 'despachado.nombre as despachado_nombre')
            ->first();

        // dd($descarga);

        return view('inventario.vistaPreviaImpresionOnlyprint', compact('descarga'));
    }
}
