<?php

namespace App\Http\Controllers;

use App\Helpers\Calendario;
use App\Http\Controllers\Controller;
use App\Models\cajaChica;
use App\Models\carga;
use App\Models\cisternas;
use App\Models\clientes;
use App\Models\corteCajaChica;
use App\Models\descarga;
use App\Models\descargaDetalle;
use App\Models\gastosMantenimiento;
use App\Models\mantenimientoImagen;
use App\Models\mantenimientos;
use App\Models\maquinaria;
use App\Models\obraMaqPer;
use App\Models\obras;
use App\Models\personal;
use App\Models\serviciosTrasporte;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
// use Dompdf\Dompdf;
// use Dompdf\Options;
use App\Models\tipoHoraExtra;
use App\Models\tipoMantenimiento;
use PDF;
use stdClass;

use function PHPUnit\Framework\isEmpty;

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
        $descarga = descarga::leftJoin('maquinaria as equipo', 'descarga.maquinariaId', '=', 'equipo.id')
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

        // dd($descarga);
        $ultimaCargaSinTote = null;
        if ($descarga['maquinariaId'] != null) {
            $ultimaCargaSinTote = carga::where('maquinariaId', $descarga['maquinariaId'])
                ->whereNull('tipoCisternaId')
                ->latest()
                ->first();
        }

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
                if ($ultimaCargaSinTote != null) {
                    $ticket->precioCarga = $ultimaCargaSinTote->precio;
                }

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

    public function printMaquinaria(Request $request)
    {

        $maquinaria = maquinaria::whereNull('compania')->orderBy('maquinaria.identificador', 'asc')->get();

        // $maquinaria = maquinaria::all();

        return view('maquinaria.vistaPreviaImpresion', compact('maquinaria'));
    }

    public function printCajaChica($saldoFormatted, $ingresoFormatted, $egresoFormatted, $saldo, $inicioSemana, $finSemana)
    {
        // dd($saldoFormatted, $ingresoFormatted, $egresoFormatted, $saldo, $inicioSemana, $finSemana);

        $ultimoCorte = corteCajaChica::latest()->first();
        $inicioSemanaFormatted = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $inicioSemana);
        $finSemanaFormatted = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $finSemana);

        $registros = cajaChica::join('personal', 'cajaChica.personal', 'personal.id')
            ->leftJoin('obras', 'cajaChica.obra', 'obras.id')
            ->leftJoin('maquinaria', 'cajaChica.equipo', 'maquinaria.id')
            ->join('conceptos', 'cajaChica.concepto', 'conceptos.id')
            ->join('comprobante', 'cajaChica.comprobanteId', 'comprobante.id')
            ->leftJoin('clientes', 'obras.clienteId', 'clientes.id')
            ->select(
                'cajaChica.id',
                'dia',
                'conceptos.codigo',
                'conceptos.nombre as cnombre',
                'comprobanteId',
                'comprobante.nombre as comprobante',
                'ncomprobante',
                'personal.nombres as pnombre',
                'personal.apellidoP as papellidoP',
                'clientes.nombre as cliente',
                'obras.nombre as obra',
                'maquinaria.identificador',
                'maquinaria.nombre as maquinaria',
                'cantidad',
                'cajaChica.tipo',
                'cajaChica.total'
            )->orderby('dia', 'desc')->orderby('id', 'desc')
            ->whereBetween('dia', [$inicioSemanaFormatted->clone()->subDay(1), $finSemanaFormatted])
            ->get();

        // dd($registros);

        return view('cajaChica.vistaPreviaImpresion', compact('saldoFormatted', 'ingresoFormatted', 'egresoFormatted', 'saldo', 'inicioSemana', 'finSemana', 'ultimoCorte', 'registros'));
    }

    public function printAsistencia($semanaFormatted, $intAnio = null, $intMes = null, $intDia = null)
    {
        abort_if(Gate::denies('asistencia_execute_corte_semanal'), '403');

        abort_if(Gate::denies('asistencia_index'), '403');
        $objCalendario = new Calendario();

        $data = request()->all();
        if (is_array($data) == true && count($data) > 0) {
            $intMes = $data['intMes'];
            $intAnio = $data['intAnio'];
            $intDia = $data['intDia'];
        } else {
            $intMes = date('m');
            $intAnio = date('Y');
            $intDia = date('d');
        }

        $strDate = $intAnio . '-' . $intMes . '-' . $intDia;
        $vctFechas =  $objCalendario->getSemanaTrabajo(date_create($strDate), 3);
        $strFechaInicioPeriodo = $vctFechas[0]->format('Y-m-d');
        $strFechaFinPeriodo = $vctFechas[1]->format('Y-m-d');

        // dd( $strDate, $vctFechas, $strFechaInicioPeriodo, $strFechaFinPeriodo );

        $usuario = personal::where('userId', auth()->user()->id)->first();
        // $personal = personal::where( 'id', $personalId )->first();

        $asistencias = personal::select(
            DB::raw('personal.id AS personalId'),
            DB::raw("CONCAT( personal.apellidoP,' ', personal.apellidoM,', ',personal.nombres)as personal"),
            DB::raw('puestoNivel.nombre AS puesto'),
            DB::raw('asistencia.id AS id'),
            DB::raw('asistencia.asistenciaId as tipoAsistenciaId'),
            'asistencia.horasExtra',
            'asistencia.horasAnticipada',
            'asistencia.horasRetraso',
            'asistencia.fecha',
            DB::raw('nomina.diario AS sueldo'),
            DB::raw('nomina.nomina AS numeroNomina'),
            DB::raw('tipoAsistencia.color AS tipoAsistenciaColor'),
            DB::raw('tipoAsistencia.nombre AS tipoAsistenciaNombre'),
            DB::raw('tipoAsistencia.esAsistencia AS esAsistencia'),
            // DB::raw( 'tipoHoraExtra.color AS horaExtraColor' ),
            // DB::raw( 'tipoHoraExtra.valor AS horaExtraCosto' ),
            // DB::raw( 'tipoHoraExtra.nombre AS horaExtraNombre' ),
            DB::raw('userEstatus.nombre AS estatus'),
            DB::raw('userEstatus.color AS estatusColor'),
            DB::raw('asistencia.entradaAnticipada'),
        )
            ->join('nomina', 'nomina.personalId', '=', 'personal.id')
            ->join('asistencia', 'asistencia.personalId', '=', 'personal.id')
            ->join('tipoAsistencia', 'tipoAsistencia.id', '=', 'asistencia.asistenciaId')
            // ->join( 'tipoHoraExtra', 'tipoHoraExtra.id', '=', 'asistencia.tipoHoraExtraId' )
            ->join('userEstatus', 'userEstatus.id', '=', 'personal.estatusId')
            ->join('puesto', 'puesto.id', '=', 'nomina.puestoId')
            ->join('puestoNivel', 'puestoNivel.id', '=', 'puesto.puestoNivelId')
            ->where('puestoNivel.requiereAsistencia', '=', '1')
            // ->where( 'asistencia.personalId', '=', 12 )
            ->whereBetween('asistencia.fecha',   [$strFechaInicioPeriodo, $strFechaFinPeriodo])
            ->orderBy('personal.apellidoP', 'asc')
            ->orderBy('asistencia.personalId', 'asc')
            ->orderBy('asistencia.fecha', 'asc')->get();

        //*** lista de asistencia */
        $listaAsistencia = personal::select(
            'personal.id',
            'personal.nombres',
            'personal.apellidoP',
            'personal.apellidoM',
            DB::raw('puestoNivel.nombre AS puesto'),
            DB::raw("CONCAT(personal.nombres,' ', personal.apellidoP,' ', personal.apellidoM)as personal"),
            DB::raw('puestoNivel.nombre AS puesto'),
            DB::raw('nomina.nomina AS numNomina'),
            DB::raw('userEstatus.nombre AS estatus'),
            DB::raw('userEstatus.color AS estatusColor')
        )
            ->join('nomina', 'nomina.personalId', '=', 'personal.id')
            ->join('puesto', 'puesto.id', '=', 'nomina.puestoId')
            ->join('puestoNivel', 'puestoNivel.id', '=', 'puesto.puestoNivelId')
            ->join('userEstatus', 'userEstatus.id', '=', 'personal.estatusId')
            ->where('puestoNivel.requiereAsistencia', '=', '1')
            ->orderBy('personal.apellidoP', 'asc')->get();

        $dteMesInicio = $intAnio . '-' . $intMes . '-01';
        $dteMesFin = $intAnio . '-' . $intMes . '-' . $objCalendario->getTotalDaysInMonth($intMes, $intAnio);

        $vctAsistencias = array();
        $vctEmpleado = array();
        $vctPagos = array();
        $intDiaTrabajado = 0;
        $strEmpleado = null;
        $intEmpleado = null;

        $vctDebug = array();
        $intCont = 0;
        $intTotalAsistencias = count($asistencias) - 1;

        foreach ($asistencias as $key => $item) {

            $vctDebug[] = $intCont . '.- ' . $item->personal;
            // $vctDebug[] = $item;

            if ($intCont == $intTotalAsistencias) {
                $vctDebug[] = 'Es el final iniciando...';
            }

            $vctDebug[] = '*** Creamos el primer objeto para trabajar y se asigna a ' . $intDiaTrabajado . ' - ' . $strEmpleado;
            if ($intDiaTrabajado == 0 && $strEmpleado == null) {
                $vctDebug[] = '*** Creamos el primer objeto para trabajar y se asigna a ' . $item->personal;
                $objDia = new stdClass;
            } else {
                //*** el objeto sigue vivo */
                $vctDebug[] = 'Seguimos con el objeto ' .  $item->personal;
            }

            if ($intDiaTrabajado == 0 && $strEmpleado == null) {
                $vctDebug[] = '-> Trabajamos con el Primer registro de empleado a trabajar : ' . $item->personal;
                unset($vctPagos);
                $strEmpleado = $item->personal;
                $objDia->numEmpleado = str_pad($item->numeroNomina, 4, '0', STR_PAD_LEFT);
                $objDia->empleado = $item->personal;
                $objDia->puesto = $item->puesto;
                $objDia->sueldo = $item->sueldo;
                $objDia->estatus = $item->estatus;
                $objDia->estatusColor = $item->estatusColor;

                $objPagos = new stdClass;
                $objPagos->fecha = $item->fecha;
                $objPagos->horasExtra = $item->horasExtra;
                $objPagos->horasAnticipada = $item->horasAnticipada;
                $objPagos->horasRetraso = $item->horasRetraso;
                $objPagos->tipoAsistencia = $item->tipoAsistenciaId;
                $objPagos->esAsistencia = $item->esAsistencia;
                $objPagos->entradaAnticipada = $item->entradaAnticipada;
                $objPagos->tipoAsistenciaColor = $item->tipoAsistenciaColor;
                $objPagos->tipoAsistenciaNombre = $item->tipoAsistenciaNombre;
                $vctPagos[] = $objPagos;

                $intDiaTrabajado += 1;
                $vctDebug[] = '<- Terminamos con el Primer registro de empleado a trabajar : ' . $item->personal;
            } else  if (($intDiaTrabajado == 6) && ($strEmpleado ==  $item->personal)) {
                $vctDebug[] = '-> Ultimo registro del empleado del periodo en los casos ' . $item->personal;
                $objPagos = new stdClass;
                $objPagos->fecha = $item->fecha;
                $objPagos->horasExtra = $item->horasExtra;
                $objPagos->horasAnticipada = $item->horasAnticipada;
                $objPagos->horasRetraso = $item->horasRetraso;
                $objPagos->tipoAsistencia = $item->tipoAsistenciaId;
                $objPagos->esAsistencia = $item->esAsistencia;
                $objPagos->entradaAnticipada = $item->entradaAnticipada;
                $objPagos->tipoAsistenciaColor = $item->tipoAsistenciaColor;
                $objPagos->tipoAsistenciaNombre = $item->tipoAsistenciaNombre;
                $vctPagos[] = $objPagos;

                $objDia->pagos  = $vctPagos;
                $vctAsistencias[] =  $objDia;

                $intDiaTrabajado = 0;
                $strEmpleado = null;
                unset($vctPagos);
                $vctDebug[] = '<- Terminamos las asistencias de la semana de ' . $item->personal;
            } else  if (($intDiaTrabajado > 0 &&  $intDiaTrabajado < 6) &&  ($strEmpleado ==  $item->personal)) {
                $vctDebug[] = '-> Seguimos con el siguiente dia y verificamos que se trate de la misma persona ' . $item->personal;

                $objPagos = new stdClass;
                $objPagos->fecha = $item->fecha;
                $objPagos->horasExtra = $item->horasExtra;
                $objPagos->horasAnticipada = $item->horasAnticipada;
                $objPagos->horasRetraso = $item->horasRetraso;
                $objPagos->tipoAsistencia = $item->tipoAsistenciaId;
                $objPagos->esAsistencia = $item->esAsistencia;
                $objPagos->entradaAnticipada = $item->entradaAnticipada;
                $objPagos->tipoAsistenciaColor = $item->tipoAsistenciaColor;
                $objPagos->tipoAsistenciaNombre = $item->tipoAsistenciaNombre;
                $vctPagos[] = $objPagos;
                $intDiaTrabajado += 1;
                $vctDebug[] = $objPagos;

                if ($intCont == $intTotalAsistencias) {
                    $vctDebug[] = 'Es el final ' . $intCont;

                    $objDia->pagos  = $vctPagos;
                    $vctAsistencias[] =  $objDia;
                }
            } else {
                $vctDebug[] = '-> El empleado ya no tiene registros de asistencia y hay que cerrar su objeto ' . $item->personal;
                $objDia->pagos  = $vctPagos;
                $vctAsistencias[] =  $objDia;

                // dd( 'Entre al cierre forzoso ',  $intDiaTrabajado, $objDia );
                $vctDebug[] = '-> Creamos el siguiente objeto para ' . $item->personal;
                $intDiaTrabajado = 0;
                $strEmpleado = null;
                unset($vctPagos);
                $objDia = new stdClass;

                $strEmpleado = $item->personal;
                $intDiaTrabajado = 1;

                $objDia->numEmpleado = str_pad($item->numeroNomina, 4, '0', STR_PAD_LEFT);
                $objDia->empleado = $item->personal;
                $objDia->puesto = $item->puesto;
                $objDia->sueldo = $item->sueldo;
                $objDia->estatus = $item->estatus;
                $objDia->estatusColor = $item->estatusColor;

                $objPagos = new stdClass;
                $objPagos->fecha = $item->fecha;
                $objPagos->horasExtra = $item->horasExtra;
                $objPagos->horasAnticipada = $item->horasAnticipada;
                $objPagos->horasRetraso = $item->horasRetraso;
                $objPagos->tipoAsistencia = $item->tipoAsistenciaId;
                $objPagos->esAsistencia = $item->esAsistencia;
                $objPagos->entradaAnticipada = $item->entradaAnticipada;
                $objPagos->tipoAsistenciaColor = $item->tipoAsistenciaColor;
                $objPagos->tipoAsistenciaNombre = $item->tipoAsistenciaNombre;
                $vctPagos[] = $objPagos;
            }
            $intCont += 1;
        }
        return view('asistencias.vistaPreviaImpresion', compact('semanaFormatted', 'usuario', 'vctAsistencias',   'asistencias', 'listaAsistencia', 'intDia', 'intMes', 'intAnio', 'strFechaInicioPeriodo', 'strFechaFinPeriodo'));
    }

    public function printMantenimiento(Request $request)
    {
        $mecanico = $request->input('mecanico');
        $id = $request->input('id');

        $mecanico = $request->input('mecanico');
        $id = $request->input('id');

        // Imprimir para verificar el valor recibido
        // dd($mecanico);
        $mantenimiento = mantenimientos::select(
            'mantenimientos.*',
            DB::raw("CONCAT(maquinaria.identificador,' - ', maquinaria.nombre)as maquinaria"),
        )
            ->join('maquinaria', 'maquinaria.id', '=', 'mantenimientos.maquinariaId')
            ->where('mantenimientos.id', '=', $id)->first();

        $gastos = gastosMantenimiento::select(
            'gastosMantenimiento.*',
            DB::raw('inventario.nombre as articulo'),
            DB::raw('inventario.numparte as numparte'),
            DB::raw('inventario.modelo as modelo'),
            DB::raw('marca.nombre AS marca'),
            DB::raw('inventario.valor as valor ')
        )
            ->leftjoin('inventario', 'inventario.id', '=', 'gastosMantenimiento.inventarioId')
            ->leftjoin('marca', 'marca.id', '=', 'inventario.marcaId')
            ->leftjoin('manoDeObra', 'manoDeObra.id', '=', 'gastosMantenimiento.manoObraId')
            ->where('mantenimientoId', '=', $id)->get();

        $fotos = mantenimientoImagen::where('mantenimientoId', $id)->get()->toArray();

        $maquinaria = maquinaria::select(
            'maquinaria.*',
            'marca.nombre as marca'
        )->leftjoin('marca', 'marca.id', 'maquinaria.marcaId')->where('maquinaria.id', '=', $mantenimiento->maquinariaId)->first();

        $vctTipos = tipoMantenimiento::select('tipoMantenimiento.*')->orderBy('tipoMantenimiento.nombre', 'asc')->get();

        $vctCoordinadores = personal::getPersonalPorNivel(3);
        $vctMecanicos = personal::getPersonalPorNivel(4);
        $vctResponsables = personal::getPersonalPorNivel(5, true);
        $totalManoObra = $gastos->whereNotNull('manoObraId')->count();
        $totalMateriales = $gastos->whereNotNull('inventarioId')->count();
        $gastosCount = count($gastos);

        $totalCostoManoObra = 0;
        $totalCostoMateriales = 0;
        $totalImporteManoObra = 0;
        $totalImporteMateriales = 0;

        foreach ($gastos as $gasto) {
            // Sumar el costo si manoObraId no es nulo
            if (!is_null($gasto->manoObraId)) {
                $totalCostoManoObra += $gasto->costo;
                $totalImporteManoObra += $gasto->total;
            }

            // Sumar el costo si inventarioId no es nulo
            if (!is_null($gasto->inventarioId)) {
                $totalCostoMateriales += $gasto->costo;
                $totalImporteMateriales += $gasto->total;
            }
        }

        // dd(
        //     $totalCostoManoObra,
        //     $totalImporteManoObra,
        //     $totalCostoMateriales,
        //     $totalImporteMateriales,
        //     $totalManoObra,
        //     $totalMateriales,
        //     $gastosCount,
        //     $mantenimiento,
        //     $gastos,
        //     $vctTipos,
        //     $fotos,
        //     $maquinaria,
        //     $vctMecanicos,
        //     $vctCoordinadores,
        //     $vctResponsables
        // );

        if ($gastosCount > 20) {
            return view('mantenimientos.vistaPreviaImpresionDesborde', compact(
                'totalCostoManoObra',
                'totalImporteManoObra',
                'totalCostoMateriales',
                'totalImporteMateriales',
                'totalManoObra',
                'totalMateriales',
                'mecanico',
                'mantenimiento',
                'gastos',
                'vctTipos',
                'fotos',
                'maquinaria',
                'vctMecanicos',
                'vctCoordinadores',
                'vctResponsables'
            ));
        } else {
            return view('mantenimientos.vistaPreviaImpresionDiseño2', compact('gastosCount', 'mecanico', 'mantenimiento', 'gastos', 'vctTipos', 'fotos', 'maquinaria', 'vctMecanicos', 'vctCoordinadores', 'vctResponsables'));
        }
    }



    // public function generarPDF(Request $request)
    // {
    //     $content = $request->input('content');

    //     $dompdf = new Dompdf();
    //     $options = new Options();
    //     $options->set('isPhpEnabled', true); // Habilita PHP en el HTML (opcional)
    //     $dompdf->setOptions($options);

    //     $dompdf->loadHtml($content);
    //     $dompdf->setPaper('A4', 'portrait');
    //     $dompdf->render();

    //     return response($dompdf->output(), 200)->header('Content-Type', 'application/pdf');
    // }

    public function printOnlyTicket(Request $request)
    {
        // dd($request);
        $descarga = descarga::leftJoin('maquinaria as equipo', 'descarga.maquinariaId', '=', 'equipo.id')
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

    // public function printServicios($saldoFormatted, $ingresoFormatted, $egresoFormatted, $saldo, $inicioSemana, $finSemana)
    public function printServicios(Request $request)
    {
        // dd($request);
        $hoy = $request->hoy;
        $quincena = $request->quincena;
        $reporte = 1;

        $pendientes = serviciosTrasporte::whereBetween('fecha', [$quincena, $hoy])
            ->whereNotIn('estatus', [4, 0])
            // ->sum('costoServicio');
            ->get();

        $sumaPendientes = $pendientes->sum('costoServicio') + $pendientes->sum('cantidad') + $pendientes->sum('costoMano');
        $totalPendientes = $pendientes->count();

        $pagados = serviciosTrasporte::whereBetween('fecha', [$quincena, $hoy])
            ->where('estatus', 4)
            // ->sum('costoServicio');
            ->get();

        $sumaPagados = $pagados->sum('costoServicio') + $pagados->sum('cantidad') + $pagados->sum('costoMano');
        $totalPagados = $pagados->count();

        $registros = serviciosTrasporte::join('conceptos', 'serviciosTrasporte.conceptoId', 'conceptos.id')
            ->leftJoin('obras', 'serviciosTrasporte.obraId', 'obras.id')
            ->join('clientes', 'obras.clienteId', 'clientes.id')
            ->join('maquinaria', 'serviciosTrasporte.equipoId', 'maquinaria.id')
            ->join('personal', 'serviciosTrasporte.personalId', 'personal.id')
            ->select(
                'serviciosTrasporte.id',
                'serviciosTrasporte.fecha',
                'conceptos.nombre as cnombre',
                'clientes.nombre as cliente',
                'obras.nombre as obra',
                'obras.centroCostos',
                'obras.proyecto',
                'maquinaria.identificador',
                'maquinaria.nombre as maquinaria',
                'personal.nombres as pnombre',
                'personal.apellidoP as papellidoP',
                'cantidad',
                'costoMano',
                'costoServicio',
                'numFactura',
                'serviciosTrasporte.estatus'
            )
            ->orderBy('fecha', 'desc')
            ->whereBetween('serviciosTrasporte.fecha', [$quincena, $hoy])
            ->get();
        // dd($registros);

        return view('serviciosTrasporte.vistaPreviaImpresion', compact('registros', 'sumaPendientes', 'totalPendientes', 'sumaPagados', 'totalPagados', 'quincena', 'hoy', 'reporte'));
    }
}
