<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\carga;
use App\Models\cisternas;
use App\Models\descarga;
use App\Models\descargaDetalle;
use App\Models\obraMaqPer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        // dd($request);
        $descarga = descarga::join('maquinaria as equipo', 'descarga.maquinariaId', '=', 'equipo.id')
            ->join('users', 'descarga.userId', '=', 'users.id')
            ->join('personal as operador', 'descarga.operadorId', '=', 'operador.id')
            ->join('personal as receptor', 'descarga.receptorId', '=', 'receptor.id')
            ->leftJoin('maquinaria as despachado', 'descarga.servicioId', '=', 'despachado.id')
            ->where('descarga.id', $request['id'])
            ->select('descarga.*', DB::raw("CONCAT(equipo.nombre, ' ',equipo.ano, ' ', equipo.placas, ' ', equipo.color, ' ', equipo.numserie) as equipo_nombre"), 'equipo.kilometraje as equipo_kilometraje', 'users.name as user_nombre', 'operador.nombres as operador_nombre', 'receptor.nombres as receptor_nombre', DB::raw("CONCAT(despachado.nombre, ' ',despachado.ano, ' ', despachado.placas, ' ', despachado.color, ' ', despachado.numserie) as despachado_nombre"))
            ->first();

        $cliente = false;
        if (isset($request['tipo_solicitud'])) {
            $cliente = true;
        }


        // dd($descarga);
        $ultimaCargaSinTote = carga::where('maquinariaId', $descarga['maquinariaId'])
            ->whereNull('tipoCisternaId')
            ->latest()
            ->first();
        $ultimaCarga = cisternas::where('id', '=', '1')->get('ultimoPrecio');
        $solicitante['descargaId'] = $descarga['id'];
        $solicitante['tipo_solicitud'] = $cliente;
        // $solicitante['kilometrajeAnterior'] = $descarga->equipo_kilometraje;
        $nuevoSolicitante = descargaDetalle::create($solicitante);
        $ticket = descarga::where('id', $request['id'])->first();
        $ticket->ticket = 1;

        $ticket->descargaDetalleId = $nuevoSolicitante['id'];
        $ticket->save();

        return view('inventario.vistaPreviaImpresion', compact('descarga', 'solicitante', 'cliente', 'nuevoSolicitante', 'ultimaCarga', 'ultimaCargaSinTote'));
    }

    public function printEdit(Request $request)
    {
        // dd($request);
        $solicitante = $request->all();
        $descarga = descarga::join('maquinaria as equipo', 'descarga.maquinariaId', '=', 'equipo.id')
            ->join('users', 'descarga.userId', '=', 'users.id')
            ->join('personal as operador', 'descarga.operadorId', '=', 'operador.id')
            ->join('personal as receptor', 'descarga.receptorId', '=', 'receptor.id')
            ->leftJoin('maquinaria as despachado', 'descarga.servicioId', '=', 'despachado.id')
            ->leftJoin('obraMaqPer', 'descarga.servicioId', '=', 'obraMaqPer.maquinariaId')
            ->leftJoin('obras', 'obraMaqPer.obraId', '=', 'obras.id')
            ->leftJoin('clientes', 'obras.clienteId', '=', 'clientes.id')
            ->leftJoin('obraMaqPer as obraMaqPerTote', 'descarga.maquinariaId', '=', 'obraMaqPerTote.maquinariaId')
            ->leftJoin('obras as obrasTote', 'obraMaqPerTote.obraId', '=', 'obrasTote.id')
            ->leftJoin('clientes as clientesTote', 'obrasTote.clienteId', '=', 'clientesTote.id')
            ->where('descarga.descargaDetalleId', $request['id'])
            ->select('descarga.*', 'obras.nombre as obras_nombre', 'obras.clienteId as obras_clienteId', 'clientes.nombre as nombre_cliente', 'obrasTote.nombre as obrasTote_nombre', 'clientesTote.nombre as nombre_clienteTote', DB::raw("CONCAT(equipo.nombre, ' ',equipo.ano, ' ', equipo.placas, ' ', equipo.color, ' ', equipo.numserie) as equipo_nombre"), 'equipo.kom as equipo_kom', 'users.name as user_nombre', 'operador.nombres as operador_nombre', 'receptor.nombres as receptor_nombre', DB::raw("CONCAT(despachado.nombre, ' ',despachado.ano, ' ', despachado.placas, ' ', despachado.color, ' ', despachado.numserie) as despachado_nombre"), 'despachado.kom as despachado_kom')
            ->first();

        // dd($descarga);
        $cliente = false;
        if (isset($request['tipo_solicitud'])) {
            $cliente = true;
        }


        $ultimaCargaSinTote = carga::where('maquinariaId', $descarga['maquinariaId'])
            ->whereNull('tipoCisternaId')
            ->latest()
            ->first();


        // dd($ultimaCargaSinTote);
        $ultimaCarga = cisternas::where('id', '=', '1')->get('ultimoPrecio');
        $detalleEnDescarga = descargaDetalle::where('id', $request['id'])->first();
        $nuevoSolicitante = $detalleEnDescarga;
        $data = $request->all();
        $detalleEnDescarga->update($data);
        // $obramaqper = obraMaqPer::where('maquinariaId', '=', $descarga['servicioId'])->get('obraId');
        // $obra = obraMaqPer::join('obras', 'descarga.servicioId', '=', 'obras.id')
        //     ->where('obras.id', $obramaqper[0]['obraId'])
        //     ->select('obras.*')
        //     ->first();
        // $obramaqper = obraMaqPer::
        //     ->where('maquinariaId', '=', $descarga['servicioId'])
        //     ->select('obras.*')
        //     ->first();

        // dd($obramaqper);
        // dd($ultimaCargaSinTote);
        return view('inventario.vistaPreviaImpresion', compact('descarga', 'solicitante', 'cliente', 'nuevoSolicitante', 'ultimaCarga', 'ultimaCargaSinTote'));
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
        // dd($request);
        $descarga = descarga::join('maquinaria as equipo', 'descarga.maquinariaId', '=', 'equipo.id')
            ->join('users', 'descarga.userId', '=', 'users.id')
            ->join('personal as operador', 'descarga.operadorId', '=', 'operador.id')
            ->join('personal as receptor', 'descarga.receptorId', '=', 'receptor.id')
            ->leftJoin('maquinaria as despachado', 'descarga.servicioId', '=', 'despachado.id')
            ->join('descargaDetalle as detalles', 'descarga.descargaDetalleId', '=', 'detalles.id')
            ->where('descarga.descargaDetalleId', $request['id'])
            ->select('descarga.*', 'detalles.*', DB::raw("CONCAT(equipo.nombre, ' ',equipo.ano, ' ', equipo.placas, ' ', equipo.color, ' ', equipo.numserie) as equipo_nombre"), 'users.name as user_nombre', 'operador.nombres as operador_nombre', 'receptor.nombres as receptor_nombre', DB::raw("CONCAT(despachado.nombre, ' ',despachado.ano, ' ', despachado.placas, ' ', despachado.color, ' ', despachado.numserie) as despachado_nombre"))
            ->first();

        // dd($descarga, $request['id']);
        $ultimaCarga = cisternas::where('id', '=', '1')->get('ultimoPrecio');
        $ultimaCargaSinTote = carga::where('maquinariaId', $descarga['maquinariaId'])
            ->whereNull('tipoCisternaId')
            ->latest()
            ->first();


        return view('inventario.vistaPreviaImpresionOnlyprint', compact('descarga', 'ultimaCarga', 'ultimaCargaSinTote'));
    }
}
