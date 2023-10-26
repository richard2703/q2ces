<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\carga;
use App\Models\cisternas;
use App\Models\clientes;
use App\Models\descarga;
use App\Models\descargaDetalle;
use App\Models\obraMaqPer;
use App\Models\obras;
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
            ->leftJoin('obraMaqPer', 'descarga.servicioId', '=', 'obraMaqPer.maquinariaId')
            ->leftJoin('obras', 'obraMaqPer.obraId', '=', 'obras.id')
            ->leftJoin('clientes', 'obras.clienteId', '=', 'clientes.id')
            ->leftJoin('obraMaqPer as obraMaqPerTote', 'descarga.maquinariaId', '=', 'obraMaqPerTote.maquinariaId')
            ->leftJoin('obras as obrasTote', 'obraMaqPerTote.obraId', '=', 'obrasTote.id')
            ->leftJoin('clientes as clientesTote', 'obrasTote.clienteId', '=', 'clientesTote.id')
            ->where('descarga.id', $request['id'])
            ->select('descarga.*', 'obras.nombre as obras_nombre', 'obras.clienteId as obras_clienteId', 'obras.id as obras_Id', 'obrasTote.id as obrasTote_id', 'clientesTote.id as clienteTote_id', 'clientes.nombre as nombre_cliente', 'clientesTote.nombre as nombre_clienteTote', DB::raw("CONCAT(equipo.nombre, ' ',equipo.placas ) as equipo_nombre"), 'equipo.kom as equipo_kom', 'users.name as user_nombre', 'operador.nombres as operador_nombre', 'receptor.nombres as receptor_nombre', DB::raw("CONCAT(despachado.nombre, ' ',despachado.ano, ' ', despachado.placas, ' ', despachado.color, ' ', despachado.numserie) as despachado_nombre"), 'despachado.kom as despachado_kom')
            ->first();

        $cliente = false;
        if (isset($request['tipo_solicitud'])) {
            $cliente = true;
        }

        // dd($descarga['maquinariaId']);
        $ultimaCargaSinTote = carga::where('maquinariaId', $descarga['maquinariaId'])
            ->whereNull('tipoCisternaId')
            ->latest()
            ->first();
        $ultimaCarga = cisternas::where('id', '=', '1')->get('ultimoPrecio');
        $solicitante['descargaId'] = $descarga['id'];
        $solicitante['tipo_solicitud'] = $cliente;
        // $solicitante['kilometrajeAnterior'] = $descarga->equipo_kilometraje;
        $nuevoSolicitante = descargaDetalle::create($solicitante);
        if ($descarga['tipoCisternaId'] != null) {
            $ticket = descarga::where('id', $request['id'])->first();
            $ticket->obraId = $descarga['obrasTote_id'];
            $ticket->clienteId = $descarga['clienteTote_id'];
            $ticket->ticket = 1;
            $ticket->precioCarga = $ultimaCarga[0]->ultimoPrecio;
            // $ticket->descargaDetalleId = $nuevoSolicitante['id'];
            $ticket->save();
        } else {
            $ticket = descarga::where('id', $request['id'])->first();
            if ($descarga['servicioId']) {

                // dd('sfdfd', $ticket);
                $ticket->obraId = $descarga['obras_Id'];
                $ticket->clienteId = $descarga['obras_clienteId'];
                $ticket->precioCarga = $ultimaCargaSinTote->precio;
                $ticket->ticket = 1;
                // $ticket->descargaDetalleId = $nuevoSolicitante['id'];
                $ticket->save();
            } else {
                $ticket->obraId = $request['obraId'];
                $obra = obras::where('id', '=', $request['obraId'])->first();
                $ticket->obraId = $obra->id;
                $ticket->clienteId = $obra->clienteId;
                $ticket->ticket = 1;
                $ticket->precioCarga = $ultimaCarga[0]->ultimoPrecio;
                // dd($ticket);
                $ticket->save();
            }
        }
        $obrasas = obras::where('id', '=', $request['obraId'])->first();
        $clientess = null;
        if ($obrasas) {
            $clientess = clientes::where('id', '=', $obrasas->clienteId)->first();
        }
        $obraEdit = false;
        // dd($clientess, $obrasas);
        // $obra = obras::where('id', '=', $request['obraId'])->get();
        return view('inventario.vistaPreviaImpresion', compact('descarga', 'solicitante', 'cliente', 'nuevoSolicitante', 'ultimaCarga', 'ultimaCargaSinTote', 'obrasas', 'clientess', 'obraEdit'));
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
            ->leftJoin('obras', 'descarga.obraId', '=', 'obras.id')
            ->leftJoin('clientes', 'descarga.clienteId', '=', 'clientes.id')
            ->where('descarga.id', $request['id'])
            ->select('descarga.*', 'obras.nombre as obras_nombre', 'clientes.nombre as nombre_cliente', DB::raw("CONCAT(equipo.nombre, ' ',equipo.placas ) as equipo_nombre"), 'equipo.kom as equipo_kom', 'users.name as user_nombre', 'operador.nombres as operador_nombre', 'receptor.nombres as receptor_nombre', DB::raw("CONCAT(despachado.nombre, ' ', despachado.placas) as despachado_nombre"), 'despachado.kom as despachado_kom')
            ->first();

        $cliente = false;

        if (isset($request['tipo_solicitud'])) {
            $cliente = true;
        }
        $obraEdit = false;

        if (isset($request['obraId'])) {
            $obraEdit = true;
            $ticket = descarga::where('id', $descarga['id'])->first();
            // dd($descarga['id'], $ticket);
            // $ticket->obraId = $request['obraId'];
            $obra = obras::where('id', '=', $request['obraId'])->first();
            $ticket->obraId = $obra->id;
            $ticket->clienteId = $obra->clienteId;
            $ticket->save();
        }


        $ultimaCargaSinTote = carga::where('maquinariaId', $descarga['maquinariaId'])
            ->whereNull('tipoCisternaId')
            ->latest()
            ->first();

        $ultimaCarga = cisternas::where('id', '=', '1')->get('ultimoPrecio');
        $detalleEnDescarga = descargaDetalle::where('descargaId', $request['id'])->first();
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

        $obrasas = obras::where('id', '=', $request['obraId'])->first();
        $clientess = clientes::where('id', '=', $obrasas->clienteId)->first();
        return view('inventario.vistaPreviaImpresion', compact('descarga', 'solicitante', 'cliente', 'nuevoSolicitante', 'ultimaCarga', 'ultimaCargaSinTote', 'obrasas', 'clientess', 'obraEdit'));
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
            ->leftJoin('obras', 'descarga.obraId', '=', 'obras.id')
            ->leftJoin('clientes', 'descarga.clienteId', '=', 'clientes.id')
            ->leftJoin('descargaDetalle as detallesSolicitud', 'descarga.id', '=', 'detallesSolicitud.descargaId')
            // ->leftJoin('descargaDetalle as detallesSolicitud', 'descarga.descargaDetalleId', '=', 'detallesSolicitud.id')
            ->where('detallesSolicitud.id', $request['id'])
            ->select('descarga.*', 'detallesSolicitud.observaciones as detalles_observaciones', 'detallesSolicitud.nombreSolicitante as detalles_nombreSolicitante', 'obras.nombre as obras_nombre', 'obras.clienteId as obras_clienteId', 'clientes.nombre as nombre_cliente', DB::raw("CONCAT(equipo.nombre, ' ',equipo.placas ) as equipo_nombre"), 'equipo.kom as equipo_kom', 'users.name as user_nombre', 'operador.nombres as operador_nombre', 'receptor.nombres as receptor_nombre', DB::raw("CONCAT(despachado.nombre, ' ',despachado.ano, ' ', despachado.placas, ' ', despachado.color, ' ', despachado.numserie) as despachado_nombre"), 'despachado.kom as despachado_kom')
            ->first();

        // dd($descarga, $request['id']);
        // dd($request['id']);
        // $ultimaCarga = cisternas::where('id', '=', '1')->get('ultimoPrecio');
        // $ultimaCargaSinTote = carga::where('maquinariaId', $descarga['maquinariaId'])
        //     ->whereNull('tipoCisternaId')
        //     ->latest()
        //     ->first();

        $cliente = false;

        return view('inventario.vistaPreviaImpresionOnlyprint', compact('descarga', 'cliente'));
    }
}
