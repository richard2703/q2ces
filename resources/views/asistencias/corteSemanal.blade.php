@extends('layouts.main', ['activePage' => 'asistencias', 'titlePage' => __('Corte Semanal de Nómina')])
<?php
$objCalendar = new Calendario();

$dtToday = date('Ymd');
$fechaSeleccionada = date_create(date('Y-m-d', strtotime("$intAnio-$intMes-$intDia")));
$diaSeleccionado = $objCalendar->getNameDay(date_format($fechaSeleccionada, 'N'));
$mesSeleccionado = $objCalendar->getNameMonth(date_format($fechaSeleccionada, 'm'));
$semanaSeleccionada = date_format($fechaSeleccionada, 'W');

$semanaAnterior = date('Y-m-d', strtotime($strFechaInicioPeriodo . '- 6 days'));

// dd( $intAnio, $intMes, $intDia );
$diaAnterior = date_format($objCalendar->getDiaAnterior($semanaAnterior), 'd');
$mesAnterior = date_format($objCalendar->getDiaAnterior($semanaAnterior), 'm');
$anioAnterior = date_format($objCalendar->getDiaAnterior($semanaAnterior), 'Y');

$diaSiguiente = date_format($objCalendar->getDiaSiguiente($strFechaFinPeriodo), 'd');
$mesSiguiente = date_format($objCalendar->getDiaSiguiente($strFechaFinPeriodo), 'm');
$anioSiguiente = date_format($objCalendar->getDiaSiguiente($strFechaFinPeriodo), 'Y');

$dtTrabajar = date('Ymd', strtotime("$intAnio-$intMes-$intDia"));

//*** Arreglo para los dias del periodo **/
$vctDiasSemana = [];
for ($i = 0; $i < 7; $i++) {
    $vctDiasSemana[] = date_create(date('Y-m-d', strtotime($strFechaInicioPeriodo . '+' . $i . ' days')));
}

// dd($vctDiasSemana);

//*** bloqueamos fecha mayor al dia actual
$blnBloquearRegistro = $dtTrabajar <= $dtToday && $asistencias->isEmpty() == true ? false : true;

// dd($asistencias, $diaAnterior, $diaSiguiente, $fechaSeleccionada, $diaSeleccionado, $dtToday, $dtTrabajar);

?>

<style>
    .no-wrap {
        max-width: 150px;
        /* Ajusta el valor según tus necesidades */
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    /* Estilo para el tooltip */
    .no-wrap:hover {
        overflow: visible;
        white-space: normal;
        z-index: 1;
        position: relative;
        background-color: #f9f9f9;
        border: 1px solid #ccc;
        border-radius: 4px;
        padding: 5px;
        font-size: 15px;
    }
</style>
@section('content')
    <div class="content">
        @if ($errors->any())
            <div class="alert alert-danger">
                <!-- PARA LA CARGA DE LOS ERRORES DE LOS DATOS-->
                <p>Listado de errores a corregir</p>
                <ul>
                    @foreach ($errors->all() as $item)
                        <li>{{ $item }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header bacTituloPrincipal">
                                    <h4 class="card-title">
                                        <!-- Un dia atras del cargado -->
                                        <span>
                                            <a href="{{ url('asistencia/corteSemanal/' . $anioAnterior . '/' . $mesAnterior . '/' . $diaAnterior) }}"
                                                class="" title="Ir al día periodo anterior">
                                                <i class="bi bi-arrow-left-square"></i>
                                            </a>
                                            <!-- Para el mes en curso -->
                                        </span>
                                        &nbsp;&nbsp;&nbsp; Semana {{ $semanaSeleccionada }} del
                                        {{ $strFechaInicioPeriodo }} al {{ $strFechaFinPeriodo }}
                                        &nbsp;&nbsp;&nbsp;
                                        <!-- Un dia adelante del cargado -->
                                        <span>
                                            <a href="{{ url('asistencia/corteSemanal/' . $anioSiguiente . '/' . $mesSiguiente . '/' . $diaSiguiente) }}"
                                                class="" title="Ir al día periodo siguiente">
                                                <i class="bi bi-arrow-right-square"></i>
                                            </a>
                                        </span>
                                    </h4>
                                    {{-- <p class="card-category">Usuarios registrados</p> --}}
                                </div>
                                <div class="card-body">

                                    @if (session('success'))
                                        <div class="alert alert-success" role="success">
                                            {{ session('success') }}
                                        </div>
                                    @endif
                                    @if (session('faild'))
                                        <div class="alert alert-danger" role="faild">
                                            {{ session('faild') }}
                                        </div>
                                    @endif
                                    <div class="row">

                                        <div
                                            class="col-12 my-4 pb-4 d-flex align-items-center divBorder justify-content-evenly">
                                            <div>
                                                <a href="{{ route('asistencia.index') }}">
                                                    <button class="btn regresar">
                                                        <span class="material-icons">
                                                            reply
                                                        </span>
                                                        Regresar
                                                    </button>
                                                </a>
                                            </div>
                                            <div class="">
                                                <a href="{{ route('asistencia.corteSemanal') }}"
                                                    class="combustibleLitros fw-semibold text-end"
                                                    title="Ir al mes en curso"><b>Hoy es
                                                        {{ /*ucwords*/ trans($objCalendar->getFechaFormateada(date_create(date('Y-m-d')), true)) }}</b>
                                                </a>
                                            </div>
                                            <div class="">
                                                @can('asistencia_create')
                                                    {{-- <form
                                                        action="{{ route('asistencia.reporteExcel', [$intAnio, $intMes, $intDia]) }}"
                                                        method="post">
                                                        @csrf
                                                        <input type="hidden" name="intAnio" value="{{ $intAnio }}">
                                                        <input type="hidden" name="intMes" value="{{ $intMes }}">
                                                        <input type="hidden" name="intDia" value="{{ $intDia }}">
                                                        <button type="submit" class="btn botonGral">Descargar Excel</button>
                                                    </form> --}}
                                                @endcan
                                            </div>
                                        </div>

                                    </div>

                                    <form class="row alertaGuardar" action="{{ route('asistencia.update', 1) }}"
                                        method="post" enctype="multipart/form-data">
                                        @csrf
                                        @method('put')
                                        <input type="hidden" name="intAnio" value="{{ $intAnio }}">
                                        <input type="hidden" name="intMes" value="{{ $intMes }}">
                                        <input type="hidden" name="intDia" value="{{ $intDia }}">
                                        {{-- <input type="hidden" name="personalId" value="{{ $personal->id }}"> --}}


                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead class="labelTitulo text-center">
                                                    <th class="labelTitulo corte">Código</th>
                                                    <th class="labelTitulo corte">Puesto</th>
                                                    <th class="labelTitulo corte">Nombre</th>
                                                    <?php
                                                    for ($i=0; $i < 7 ; $i++) {
                                                       ?>
                                                    <th class="labelTitulo corte" colspan="2">
                                                        {{ $objCalendar->getNameDay($vctDiasSemana[$i]->format('N')) }}<br>
                                                        <strong>{{ $vctDiasSemana[$i]->format('d') }}</strong>
                                                    </th>
                                                    <?php
                                                    }
                                                    ?>
                                                    <th class="labelTitulo corte ">Días</th>
                                                    <th class="labelTitulo corte ">Salario Por Día</th>
                                                    <th class="labelTitulo corte  no-wrap">Importe Semanal</th>
                                                    <th class="labelTitulo corte  ">Tiempo Extra Total</th>
                                                    <th class="labelTitulo corte  ">Horas Extra Total</th>
                                                    <th class="labelTitulo corte ">Total Horas Extra</th>
                                                    <th class="labelTitulo corte no-wrap">Pago Semanal</th>
                                                </thead>
                                                <?php
                                                $intTotalGeneralSueldo = 0;
                                                $intTotalGeneralHorasExtras = 0; ?>
                                                <tbody class="text-center">
                                                    @forelse ($vctAsistencias as $item)
                                                        <?php
                                                        // dd($item);
                                                        $intTotalHorasExtras = 0;
                                                        $intTotalCostoHorasExtras = 0;
                                                        $intTotalMinutosRetrasoExtras = 0;
                                                        $intDiasAsistidos = 0;
                                                        $intTotalMinutosExtras = 0;
                                                        $intDiasPagados = count($item->pagos);
                                                        $intTotalHorasCompletas = 0;
                                                        ?>
                                                        <tr>
                                                            <td style="color: {{ $item->estatusColor }};">
                                                                <strong>{{ ucwords(trans($item->numEmpleado)) }}</strong>
                                                            </td>
                                                            <td>{{ ucwords(trans($item->puesto)) }}</td>
                                                            <td class="text-left">{{ ucwords(trans($item->empleado)) }}
                                                            </td>
                                                            <?php
                                                                //*** recorremos el arreglo de los dias de la semana de trabajo ***************//
                                                                $intHorasSemanales = 0;
                                                                for ($i = 0; $i < 7; $i++) {
                                                                    //*** creamos el pivote de la fecha a buscar ***//
                                                                    $intDiaSemana = $vctDiasSemana[$i]->format('Ymd');

                                                                    //*** recorremos el arreglo de los dias de la semana de trabajo registrados
                                                                    $blnExiste=false;
                                                                    $decSueldoDiario = $item->sueldo;
                                                                    $decValorHoraExtra = number_format(($decSueldoDiario / 8),2);

                                                                    for ($iDay = 0; $iDay < $intDiasPagados; $iDay++) {
                                                                         //*** convertimos las fechas a numero para comparar  **/
                                                                        $intDiaPago = str_replace("-","",$item->pagos[$iDay]->fecha);

                                                                        if($intDiaSemana == $intDiaPago){
                                                                            $blnExiste = true;
                                                                            $decCostoHoraExtraDia=0;

                                                                            $intDiasAsistidos += $item->pagos[$iDay]->esAsistencia;

                                                                          //*** Todo el tiempo extra (anticipado y excedente)
                                                                            $intMinutosTotalesDia = (int) $item->pagos[$iDay]->horasExtra ;
                                                                            if ($item->pagos[$iDay]->entradaAnticipada == 1 && $item->pagos[$iDay]->horasAnticipada > 0){
                                                                                $intMinutosTotalesDia  += $item->pagos[$iDay]->horasAnticipada ;
                                                                            }

                                                                            $intHorasDia = (int) ($intMinutosTotalesDia / 60);
                                                                            $intMinutosDia =$intMinutosTotalesDia % 60;

                                                                            //*** completar una hora fraccionaria, debera de ser mayor o igual a 35 minutos
                                                                            $intHorasCompletasDia =  ( $intHorasDia + ($intMinutosDia >= 35 ? 1 : 0)) ;

                                                                            //*** obtencion del tiempo de retraso de ingreso
                                                                            $intMinutosRetrasoDia=0;

                                                                            $intHorasRetrasoDia = 0;
                                                                            $intMinutosRetrasoDia = 0;
                                                                            if ( $item->pagos[$iDay]->horasRetraso > 0){
                                                                                $intMinutosRetrasoDia  += $item->pagos[$iDay]->horasRetraso ;
                                                                                $intHorasRetrasoDia = (int) ($intMinutosRetrasoDia / 60);
                                                                                $intMinutosRetrasoDia = $intMinutosRetrasoDia % 60;
                                                                            }

                                                                            //*** minutos posteriores a la entrada
                                                                            // $intMinutosDescontarDia = 0;
                                                                            // if ( $dteHoraEntrada < $dteHorario ) {
                                                                            //     $intMinutosDescontarDia = $dteHoraEntrada->diffInMinutes( $dteHorario ) ;
                                                                            //     // $objAsistencia->tipoHoraExtraId = $request[ 'tipoHoraExtraId' ][ $i ];
                                                                            //     // dd( 'Soy mayor '. $intMinutosEntrada . ' minutos' );
                                                                            // } else {
                                                                            //     // dd( 'Soy menor' );
                                                                            //     // $objAsistencia->tipoHoraExtraId = 1;
                                                                            // }

                                                                            //*** Hay tiempo extra por pagar
                                                                            if($intHorasCompletasDia > 0){
                                                                                //*** obtenemos el calculo proporcional del dia
                                                                                $decCostoHoraExtraDia = number_format( $decValorHoraExtra * $intHorasCompletasDia,2) ;

                                                                                $intHorasCompletasPagarDia = $intHorasCompletasDia;

                                                                                $intHorasSemanales += $intHorasCompletasPagarDia;
                                                                                $intTotalCostoHorasExtras += $decCostoHoraExtraDia ;
                                                                                }
                                                                            else
                                                                                {
                                                                                $intHorasCompletasPagarDia = 0;
                                                                            }

                                                                            //*** Todo el tiempo extra (anticipado y excedente)
                                                                            $intTotalMinutosExtras += $intMinutosTotalesDia ;    //*** el total de minutos extras de hora
                                                                            $intTotalHorasExtras +=  $intHorasCompletasDia; //*** obtenemos el numero cerrado de horas del tiempo extra
                                                                            $intTotalMinutosRetrasoExtras += $intMinutosRetrasoDia ;    //*** el total de minutos extras de hora


                                                                            // dd(  $intMinutosTotalesDia,
                                                                            //  $intHorasDia,
                                                                            //  $intMinutosDia,
                                                                            //  $intHorasCompletasDia,
                                                                            //  $decSueldoDiario,
                                                                            //  $decCostoHoraExtraDia ,
                                                                            //  $intTotalMinutosRetrasoExtras );

                                                                            break;
                                                                        }

                                                                    }

                                                                    if($blnExiste == true){
                                                                        //*** Hay registro del día de la semana ***//
                                                                        ?>
                                                            <td title="{{ $item->pagos[$iDay]->tipoAsistenciaNombre }}"
                                                                style="color: {{ $item->pagos[$iDay]->tipoAsistenciaColor }};">
                                                                <!-- Estatus de asistencia-->
                                                                <strong> {{ $item->pagos[$iDay]->esAsistencia }}</strong>
                                                            </td>
                                                            <td
                                                                title="Tiempo Extra: {{ str_pad($intHorasDia, 2, '0', STR_PAD_LEFT) . ':' . str_pad($intMinutosDia, 2, '0', STR_PAD_LEFT) }}, Tiempo Retraso: {{ str_pad($intHorasRetrasoDia, 2, '0', STR_PAD_LEFT) . ':' . str_pad($intMinutosRetrasoDia, 2, '0', STR_PAD_LEFT) }}, Se Paga: $ {{ $decValorHoraExtra }}">
                                                                <!-- Tiempo extra -->
                                                                <strong>
                                                                    {{ $intHorasCompletasDia }} Hrs<br>
                                                                    {{ str_pad($intHorasDia, 2, '0', STR_PAD_LEFT) . ':' . str_pad($intMinutosDia, 2, '0', STR_PAD_LEFT) }}
                                                                </strong>
                                                            </td>
                                                            <?php
                                                                    }else{
                                                                        //*** no hay registro del día de la semana ***//
                                                                       ?>
                                                            <td> --- </td>
                                                            <td style="background: whitesmoke;"> --- </td>
                                                            <?php
                                                                    }
                                                                } // Fin del bloque de los dias de la semana
                                                            ?>
                                                            <td>{{ $intDiasAsistidos }}</td>
                                                            <td class="text-right">$ {{ number_format($item->sueldo, 2) }}
                                                            </td>
                                                            <td class="text-right">$
                                                                {{ number_format($item->sueldo * $intDiasAsistidos, 2) }}
                                                            </td>
                                                            <td class="text-right">
                                                                <!-- Total semanal de tiempo extra -->
                                                                <?php
                                                                $intHorasSemanal = (int) ($intTotalMinutosExtras / 60);
                                                                $intMinutosSemanal = $intTotalMinutosExtras % 60;
                                                                ?>
                                                                {{ str_pad($intHorasSemanal, 2, '0', STR_PAD_LEFT) . ':' . str_pad($intMinutosSemanal, 2, '0', STR_PAD_LEFT) }}
                                                            </td>
                                                            <td class="text-right">
                                                                <!-- Calculo de horas extra con los minutos sobrantes -->
                                                                <?php
                                                                // $intHorasExtrasPagar = $intHorasSemanal + ($intMinutosSemanal >= 31 ? 1 : 0);
                                                                ?> {{ $intHorasSemanales }}
                                                            </td>
                                                            <td class="text-right">
                                                                <?php
                                                                //*** sumamos al total general las horas extras del personal
                                                                $intTotalGeneralHorasExtras += $intTotalCostoHorasExtras;
                                                                ?>
                                                                $ {{ number_format($intTotalCostoHorasExtras, 2) }}
                                                            </td>
                                                            <td class="text-right">
                                                                <!-- Calculo de costo de tiempo extra -->
                                                                $
                                                                {{ number_format($intTotalCostoHorasExtras + $item->sueldo * $intDiasAsistidos, 2) }}
                                                                <?php
                                                                //*** sumamos al total general el sueldo del personal
                                                                $intTotalGeneralSueldo += $intTotalCostoHorasExtras + $item->sueldo * $intDiasAsistidos;
                                                                ?>
                                                            </td>
                                                        </tr>
                                                    @empty

                                                        @forelse ($listaAsistencia as $item)
                                                            <tr>
                                                                <td style="color: {{ $item->estatusColor }};">
                                                                    <strong>{{ str_pad($item->numNomina, 4, '0', STR_PAD_LEFT) }}</strong>
                                                                </td>
                                                                <td>{{ ucwords(trans($item->puesto)) }}</td>
                                                                <td class="text-left">{{ $item->apellidoP }}
                                                                    {{ $item->apellidoM }}, {{ $item->nombres }}</td>
                                                                <td>---</td>
                                                                <td>---</td>
                                                                <td>---</td>
                                                                <td>---</td>
                                                                <td>---</td>
                                                                <td>---</td>
                                                                <td>---</td>
                                                                <td>---</td>
                                                                <td>---</td>
                                                                <td>---</td>
                                                                <td>---</td>
                                                                <td>---</td>
                                                                <td>---</td>
                                                                <td>---</td>
                                                                <td>---</td>
                                                                <td>---</td>
                                                                <td>---</td>
                                                                <td>---</td>
                                                                <td>---</td>
                                                                <td class="td-actions">---</td>
                                                            </tr>
                                                        @empty
                                                            <tr>
                                                                <td colspan="2">Sin Registros.<br><br> <b>Es Necesario
                                                                        Registrar Primero La asistencia Del personal Antes
                                                                        De
                                                                        Poder Realizar Las acciones De Esta Semana.</b></td>
                                                            </tr>
                                                        @endforelse
                                                    @endforelse

                                                    <tr>
                                                        <td colspan="22"></td>
                                                        <td class="text-right">$
                                                            {{ number_format($intTotalGeneralHorasExtras, 2) }} </td>
                                                        <td class="text-right">$
                                                            {{ number_format($intTotalGeneralSueldo, 2) }} </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="card-footer mr-auto">

                                            {{-- <a href="{{ route('asistencia.index') }}">
                                                <button type="button" class="btn btn-danger">Cancelar</button>
                                            </a>
                                            <a href="#">
                                                <button type="submit" class="btn botonGral">Guardar</button>
                                            </a> --}}
                                            {{--  {{ $personal->links() }}  --}}
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        table {
            table-layout: fixed;
        }

        th,
        td {
            width: 150px;
            word-wrap: break-word;
        }
    </style>
    <script>
        function Guardado() {
            // alert('test');
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: 'success',
                title: 'Guardado con exito'
            })
        }
        var slug = '{{ Session::get('message') }}';
        if (slug == 1) {
            Guardado();

        }
    </script>
@endsection
