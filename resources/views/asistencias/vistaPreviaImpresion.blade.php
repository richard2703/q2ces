@extends('layouts.main', ['activePage' => 'inventario', 'titlePage' => __('Inventario')])
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
$blnBloquearitem = $dtTrabajar <= $dtToday && $asistencias->isEmpty() == true ? false : true;

// dd($asistencias, $diaAnterior, $diaSiguiente, $fechaSeleccionada, $diaSeleccionado, $dtToday, $dtTrabajar);

?>
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card" >
                    <div class="card-header bacTituloPrincipal">
                        {{-- <p class="card-category">Usuarios registrados</p> --}}
                        Vista Previa de Impresion de Nomina Y Asistencia
                    </div>
                    <div class="card-body">
                        <div class="row divBorder">
                            <div class="col-6 text-right">
                                <button class="btn regresar" onclick="goBack()">
                                    <span class="material-icons">
                                        reply
                                    </span>
                                    Regresar
                                </button>
                            </div>

                            <div class="col-6 pb-3 text-end">
                                @can('inventario_create')
                                    <button type="button" onclick="print()" class="btn botonGral text-capitalize">Volver A Imprimir</button>
                                @endcan
                            </div>
                        </div>
                    </div>
                    
                    <div id="content-center" class="content-center" style="display: none">
                        <img src="{{ asset('/img/maquinariaPrint/Q de fondo.svg') }}" width="45%" alt="">    
                    </div>
                    <div id="print-content" class="print-content d-flex align-items-center">
                        <div class="table-responsive" style="font-size: 11px">
                            <div id="print-header" class="print-header">
                                <div class="row mb-2">
                                    <div class="col-1 text-start">
                                        <img src="{{ asset('/img/maquinariaPrint/Logo q2cem_1.svg') }}" alt="" width="75px;" class="mt-1">    
                                    </div>
                                    <div class="col-10 text-center d-flex align-items-center justify-content-center">
                                        <img src="{{ asset('/img/maquinariaPrint/Nómina Asiatencia.svg') }}" alt="" width="315px;" class="mt-2">
                                        <div class="d-flex align-items-center p-3" style="font-weight: 500 !important; font-size: 20px !important; border-radius: 2em; background-color: #f7c90d; color: var(--select); height: 25px; box-shadow: 5px 5px 5px rgba(0, 0, 0, 0.5);">
                                            {{$semanaFormatted}}
                                        </div>
                                    </div>
                                    <div class="col-1 text-end" style="margin-left: -5px">
                                        <img src="{{ asset('/img/maquinariaPrint/Logo q2ces_2.svg') }}" alt="" width="75px;" class="mt-1">    
                                    </div>
                                </div>
                            </div>
                            <table style="margin-top: 95px">
                                @if ($vctAsistencias != null)
                                    <thead class="labelTitulo">
                                        <th class="labelTitulo text-center" style="height: 35px; padding-left: 5px !important; padding-right: 5px !important;">
                                            <div class="d-flex justify-content-center align-items-center" style="margin-right: 5px !important;font-size:14px !important; border-radius: 2em; background-color: var(--select); color: #fff; height: 35px; width: 125px;">Nombre </div></th>
                                        <?php
                                        for ($i=0; $i < 7 ; $i++) {
                                        ?>
                                        <th class="labelTitulo text-center" style="height: 35px; width: 70px;"> 
                                            <div class="d-flex justify-content-center align-items-center" style="margin-right: 5px !important;font-size:14px !important; border-radius: 2em; background-color: var(--select); color: #fff; height: 35px;">{{ $objCalendar->getNameDay($vctDiasSemana[$i]->format('N')) }}
                                            .{{ $vctDiasSemana[$i]->format('d') }}</div></th>
                                        </th>
                                        <?php
                                        }
                                        ?>
                                            
                                        <th class="labelTitulo text-center" style="height: 35px;"> 
                                            <div class="d-flex justify-content-center align-items-center" style="margin-right: 5px !important;font-size:14px !important; border-radius: 2em; background-color: var(--select); color: #fff; height: 35px;">Días </div></th>
                                        <th class="labelTitulo text-center" style="height: 35px;"> 
                                            <div class="d-flex justify-content-center align-items-center" style="margin-right: 5px !important;font-size:14px !important; border-radius: 2em; background-color: var(--select); color: #fff; height: 35px; width: 95px;">Salario Díario </div></th>
                                        <th class="labelTitulo text-center" style="height: 35px;"> 
                                                <div class="d-flex justify-content-center align-items-center" style="margin-right: 5px !important;font-size:14px !important; border-radius: 2em; background-color: var(--select); color: #fff; height: 35px;">Horas Extra </div></th>
                                        <th class="labelTitulo text-center" style=" height: 35px;"> 
                                            <div class="d-flex justify-content-center align-items-center" style="margin-right: 5px !important;font-size:14px !important; border-radius: 2em; background-color: var(--select); color: #fff; height: 35px; width: 90px;">Total Horas Extra </div></th>
                                        <th class="labelTitulo text-center" style="height: 35px; width: 150px;">
                                            <div class="d-flex justify-content-center align-items-center" style="margin-right: 5px !important;font-size:14px !important; border-radius: 2em; background-color: var(--select); color: #fff; height: 35px;">Pago Semanal </div></th>
                                    </thead>
                                @endif
                                
                                <tbody>
                                    @php
                                        $totalitems = count($vctAsistencias) - 1;
                                    @endphp
                                
                                    @forelse ($vctAsistencias as $key => $item)
                                    @if ($key == $totalitems)
                                    
                                    <style>
                                        /* Estilos para la última página al imprimir */
                                        @media print {
                                            .print-content {
                                                margin-bottom: -40mm !important;
                                            }
                                        }

                                    </style>
                                    
                                    @endif
                                    
                                    @if ($key == 13 || $key == 26 || $key == 39 || $key == 52 || $key == 65 || $key == 78 || $key == 91 || $key == 104 || $key == 117 || $key == 130 || $key == 143 || $key == 156 || $key == 169 || $key == 182 || $key == 195 || $key == 208 || $key == 221 || $key == 234)
                                        </tbody>
                                    </table>
                                    <div class="page mt-1" style="margin-left: 115mm; font-weight: 500 !important; border-radius: 2em; background-color: #f7c90d; color: var(--select); height: 20px;" ></div>
                                        <br><br><br><br>
                                        <br><br><br>
                                        
                                    @endif
                                    @if ($key == 13 || $key == 26 || $key == 39 || $key == 52 || $key == 65 || $key == 78 || $key == 91 || $key == 104 || $key == 117 || $key == 130 || $key == 143 || $key == 156 || $key == 169 || $key == 182 || $key == 195 || $key == 208 || $key == 221 || $key == 234)
                                    <table class="mt-4">
                                        
                                        <thead class="labelTitulo">
                                            <th class="labelTitulo text-center" style="height: 35px; padding-left: 5px !important; padding-right: 5px !important;">
                                                <div class="d-flex justify-content-center align-items-center" style="margin-right: 5px !important;font-size:14px !important; border-radius: 2em; background-color: var(--select); color: #fff; height: 35px; width: 125px;">Nombre </div></th>
                                            <?php
                                            for ($i=0; $i < 7 ; $i++) {
                                            ?>
                                            <th class="labelTitulo text-center" style="height: 35px; width: 70px;"> 
                                                <div class="d-flex justify-content-center align-items-center" style="margin-right: 5px !important;font-size:14px !important; border-radius: 2em; background-color: var(--select); color: #fff; height: 35px;">{{ $objCalendar->getNameDay($vctDiasSemana[$i]->format('N')) }}
                                                   .{{ $vctDiasSemana[$i]->format('d') }}</div></th>
                                            </th>
                                            <?php
                                            }
                                            ?>
                                                
                                            <th class="labelTitulo text-center" style="height: 35px;"> 
                                                <div class="d-flex justify-content-center align-items-center" style="margin-right: 5px !important;font-size:14px !important; border-radius: 2em; background-color: var(--select); color: #fff; height: 35px;">Días </div></th>
                                            <th class="labelTitulo text-center" style="height: 35px;"> 
                                                <div class="d-flex justify-content-center align-items-center" style="margin-right: 5px !important;font-size:14px !important; border-radius: 2em; background-color: var(--select); color: #fff; height: 35px; width: 95px;">Salario Díario </div></th>
                                            <th class="labelTitulo text-center" style="height: 35px;"> 
                                                    <div class="d-flex justify-content-center align-items-center" style="margin-right: 5px !important;font-size:14px !important; border-radius: 2em; background-color: var(--select); color: #fff; height: 35px; width: 95px;">Horas Extra </div></th>
                                            <th class="labelTitulo text-center" style=" height: 35px;"> 
                                                <div class="d-flex justify-content-center align-items-center" style="margin-right: 5px !important;font-size:14px !important; border-radius: 2em; background-color: var(--select); color: #fff; height: 35px; width: 90px;">Total Horas Extra </div></th>
                                            <th class="labelTitulo text-center" style="height: 35px; width: 150px;">
                                                <div class="d-flex justify-content-center align-items-center" style="margin-right: 5px !important;font-size:14px !important; border-radius: 2em; background-color: var(--select); color: #fff; height: 35px;">Pago Semanal </div></th>
                                            </thead>       
                                        <tbody>        
                                        @endif
                                        <?php
                                            $intTotalGeneralSueldo = 0;
                                            $intTotalGeneralHorasExtras = 0; 
                                        ?> 
                                        <?php
                                            $intTotalHorasExtras = 0;
                                            $intTotalCostoHorasExtras = 0;
                                            $intTotalMinutosRetrasoExtras = 0;
                                            $intDiasAsistidos = 0;
                                            $intTotalMinutosExtras = 0;
                                            $intDiasPagados = count($item->pagos);
                                            $intTotalHorasCompletas = 0;
                                        ?>
                                        <tr>
                                            <td style="">
                                                @if ($item->empleado)
                                                    <div style="margin-right: 5px !important;border-radius: 1em; border-color: black;
                                                    border-width: 1px;
                                                    border-style: solid; height: 35px; margin-top: 3px; {{ strlen(trans($item->empleado)) > 38 ? 'font-size: 8px;' : '' }}" class="d-flex justify-content-center align-items-center"> {{ucwords(trans($item->empleado))}} </div>
                                                @else
                                                    <div style="border-radius: 1em; border-color: black; margin-right: 5px !important;
                                                    border-width: 1px;
                                                    border-style: solid; height: 35px; margin-top: 3px" class="d-flex justify-content-center align-items-center"> - </div>
                                                @endif
                                            </td>
                                            <?php
                                                //*** recorremos el arreglo de los dias de la semana de trabajo ***************//
                                                $intHorasSemanales = 0;
                                                $decSueldoDiario = $item->sueldo;
                                                $decValorHoraExtra = number_format(($decSueldoDiario / 8),2);

                                                for ($i = 0; $i < 7; $i++) {
                                                    //*** creamos el pivote de la fecha a buscar ***//
                                                    $intDiaSemana = $vctDiasSemana[$i]->format('Ymd');

                                                    //*** recorremos el arreglo de los dias de la semana de trabajo registrados
                                                    $blnExiste=false;

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
                                                            $intMinutosDia = $intMinutosTotalesDia % 60;

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
                                                                $intHorasCompletasPagarDia = $intHorasCompletasDia;
                                                                $intHorasSemanales += $intHorasCompletasPagarDia;
                                                            }  else {
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

                                                    //*** realizamos el calculo del total de las horas extras

                                                    if($intHorasSemanales>0){
                                                        if($intHorasSemanales<=9){
                                                            //*** se multiplican por dos del valor proporcional
                                                            $decCostoHoraExtraDia =  ($decValorHoraExtra * $intHorasSemanales)*2 ;
                                                                $intTotalCostoHorasExtras = $decCostoHoraExtraDia ;

                                                        }elseif($intHorasSemanales>=10){
                                                                //*** obtenemos el calculo proporcional de los dias
                                                                $intHorasDobles = (($decValorHoraExtra * 2)*9);
                                                                $intHorasTriples = (($decValorHoraExtra * 3)* ($intHorasSemanales - 9)) ;

                                                                $decCostoHoraExtraDia =  ($intHorasDobles +  $intHorasTriples)  ;
                                                                $intTotalCostoHorasExtras = $decCostoHoraExtraDia ;

                                                                //  dd("Valor base: " . $decValorHoraExtra,
                                                                //  " Horas dobles: " . (($decValorHoraExtra * 2)*9) ,
                                                                //  " Horas triples: " . (($decValorHoraExtra * 3)* ($intHorasSemanales - 9)) ,
                                                                //  " Total:". $decCostoHoraExtraDia);
                                                        }
                                                    }

                                                    if($blnExiste == true){
                                                        //*** Hay registro del día de la semana ***//
                                                        ?>
                                            <td title="{{ $item->pagos[$iDay]->tipoAsistenciaNombre }}"
                                                style="">
                                                <!-- Estatus de asistencia-->
                                                @if ($item->pagos[$iDay]->esAsistencia)
                                                    <div style="margin-right: 5px !important;border-radius: 1em; border-color: black; color: {{ $item->pagos[$iDay]->tipoAsistenciaColor }};
                                                    border-width: 1px;
                                                    border-style: solid; height: 35px; margin-top: 3px; padding-left: 10px; padding-right: 10px" class="d-flex justify-content-between align-items-center">
                                                    <strong>{{ $item->pagos[$iDay]->esAsistencia }}</strong>
                                                     <strong>
                                                        {{ $intHorasCompletasDia }} Hrs<br>
                                                        {{--  {{ str_pad($intHorasDia, 2, '0', STR_PAD_LEFT) . ':' . str_pad($intMinutosDia, 2, '0', STR_PAD_LEFT) }}  --}}
                                                    </strong>
                                                </div>
                                                    
                                                @else
                                                    <div style="border-radius: 1em; border-color: black; margin-right: 5px !important;
                                                    border-width: 1px;
                                                    border-style: solid; height: 35px; margin-top: 3px" class="d-flex justify-content-center align-items-center"> 0 </div>
                                                @endif
                                                
                                            </td>
                                            <?php
                                                }else{
                                                //*** no hay registro del día de la semana ***//
                                            ?>
                                            <td> <div style="margin-right: 5px !important;border-radius: 1em; border-color: black;
                                                border-width: 1px;
                                                border-style: solid; height: 35px; margin-top: 3px; padding-left: 10px; padding-right: 10px" class="d-flex justify-content-center align-items-center"> --- </div></td>
                                            
                                            <?php
                                                    }
                                                } // Fin del bloque de los dias de la semana
                                            ?>
                                            <td>
                                                @if ($intDiasAsistidos)
                                                    <div style="margin-right: 5px !important;border-radius: 1em; border-color: black;
                                                    border-width: 1px;
                                                    border-style: solid; height: 35px; margin-top: 3px" class="d-flex justify-content-center align-items-center"> {{ $intDiasAsistidos }} </div>
                                                @else
                                                    <div style="border-radius: 1em; border-color: black; margin-right: 5px !important;
                                                    border-width: 1px;
                                                    border-style: solid; height: 35px; margin-top: 3px" class="d-flex justify-content-center align-items-center"> 0 </div>
                                                @endif
                                                
                                            </td>
                                            <td class="text-right">
                                                @if ($item->sueldo)
                                                    <div style="margin-right: 5px !important;border-radius: 1em; border-color: black;
                                                    border-width: 1px;
                                                    border-style: solid; height: 35px; margin-top: 3px" class="d-flex justify-content-center align-items-center"> $ {{ number_format($item->sueldo, 2) }} </div>
                                                @else
                                                    <div style="border-radius: 1em; border-color: black; margin-right: 5px !important;
                                                    border-width: 1px;
                                                    border-style: solid; height: 35px; margin-top: 3px" class="d-flex justify-content-center align-items-center"> 0 </div>
                                                @endif
                                            </td>
                                            {{-- <td class="text-right">
                                                <!-- Total semanal de tiempo extra -->
                                                <?php
                                                $intHorasSemanal = (int) ($intTotalMinutosExtras / 60);
                                                $intMinutosSemanal = $intTotalMinutosExtras % 60;
                                                ?>
                                                {{ str_pad($intHorasSemanal, 2, '0', STR_PAD_LEFT) . ':' . str_pad($intMinutosSemanal, 2, '0', STR_PAD_LEFT) }}
                                            </td> --}}
                                            <td class="text-right">
                                                @if ($intHorasSemanales)
                                                    <div style="margin-right: 5px !important;border-radius: 1em; border-color: black;
                                                    border-width: 1px;
                                                    border-style: solid; height: 35px; margin-top: 3px" class="d-flex justify-content-center align-items-center">
                                                        <!-- Calculo de horas extra con los minutos sobrantes -->
                                                        <?php
                                                        // $intHorasExtrasPagar = $intHorasSemanal + ($intMinutosSemanal >= 31 ? 1 : 0);
                                                        ?> {{ $intHorasSemanales }}
                                                    </div>
                                                @else
                                                    <div style="border-radius: 1em; border-color: black; margin-right: 5px !important;
                                                    border-width: 1px;
                                                    border-style: solid; height: 35px; margin-top: 3px" class="d-flex justify-content-center align-items-center"> 0 </div>
                                                @endif
                                            </td>
                                            <td class="text-right">
                                                <div style="margin-right: 5px !important;border-radius: 1em; border-color: black;
                                                border-width: 1px;
                                                border-style: solid; height: 35px; margin-top: 3px" class="d-flex justify-content-center align-items-center">
                                                    <?php
                                                    //*** sumamos al total general las horas extras del personal
                                                    $intTotalGeneralHorasExtras += $intTotalCostoHorasExtras;
                                                    ?>
                                                    $ {{ number_format($intTotalCostoHorasExtras, 2) }}
                                                </div>
                                            </td>
                                            <td class="text-right">
                                                <div style="margin-right: 5px !important;border-radius: 1em; border-color: black;
                                                border-width: 1px;
                                                border-style: solid; height: 35px; margin-top: 3px" class="d-flex justify-content-center align-items-center">
                                                <!-- Calculo de costo de tiempo extra -->
                                                $
                                                {{ number_format($intTotalCostoHorasExtras + $item->sueldo * $intDiasAsistidos, 2) }}
                                                <?php
                                                //*** sumamos al total general el sueldo del personal
                                                $intTotalGeneralSueldo += $intTotalCostoHorasExtras + $item->sueldo * $intDiasAsistidos;
                                                ?>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                    <tr>
                                        <h3 colspan="2" style="margin-top: 115px;"><b>Sin Registros.</b><br><br>Es Necesario
                                            Registrar Primero La asistencia Del personal Antes
                                            De
                                            Poder <br> Realizar Las acciones De Esta Semana.</h3>
                                    </tr>
                                    
                                        {{--  @forelse ($listaAsistencia as $item)
                                            <tr>
                                                <td style="color: {{ $item->estatusColor }};">
                                                    <strong>{{ str_pad($item->numNomina, 4, '0', STR_PAD_LEFT) }}</strong>
                                                </td>
                                                <td class="text-left">{{ $item->apellidoP }}
                                                    {{ $item->apellidoM }}, {{ $item->nombres }}</td>
                                                <td>{{ ucwords(trans($item->puesto)) }}</td>
                                                <td>---</td>
                                                <td>---</td>
                                                <td>---</td>
                                                <td>---</td>
                                                <td>---</td>
                                                <td>---</td>
                                                <td>---</td>
                                                <td>---</td>
                                                <td>---</td>
                                                
                                            </tr> --}}
                                                
                                        {{--  @empty
                                            <tr>
                                                <td colspan="2">Sin Registros.<br><br> <b>Es Necesario
                                                        Registrar Primero La asistencia Del personal Antes
                                                        De
                                                        Poder Realizar Las acciones De Esta Semana.</b></td>
                                            </tr>
                                        @endforelse  --}}
                                        
                                    @endforelse

                                    {{--  <tr>
                                        <td colspan="21"></td>
                                        <td class="text-right">$
                                            {{ number_format($intTotalGeneralHorasExtras, 2) }} </td>
                                        <td class="text-right">$
                                            {{ number_format($intTotalGeneralSueldo, 2) }} </td>
                                    </tr>  --}}
                                                
                                    @php
                                        $numeroTotal = $totalitems;
                                        $numeroACaber = 14;

                                        $vecesQueCabe = floor($numeroTotal / $numeroACaber);
                                        $faltante = $numeroACaber - ($numeroTotal % $numeroACaber);
                                        $var = ($numeroTotal % $numeroACaber);
                                        $faltante -= 3;
                                        if ($faltante == -2)
                                            $faltante = 13;
                                        if ($faltante == -1)
                                            $faltante = 14;
                                    @endphp
                                    
                                </tbody>
                            </table>
                            
                        </div>
                        @if ($vctAsistencias != null)
                            @for ($i = 0; $i <$faltante; $i++)
                                <tr>
                                    <div style="border-radius: 1em; border-color: white; color: white; margin-right: 5px !important;
                                            border-width: 1px;
                                            border-style: solid; height: 35px; margin-top: 3px; visibility: hidden" class="d-flex justify-content-center align-items-center"> - </div>
                                </tr>
                            @endfor
                        @endif
                        
                        @if (isset($key) &&  $key == $totalitems)
                        {{--  <div>{{$var}}, Total:{{$numeroTotal}}Faltantes: {{$faltante}}</div>  --}}
                            <div class="page mt-1" id="ultimoNumPage" style="margin-right: 35px !important; font-weight: 500 !important; font-size: 11px !important; border-radius: 2em; background-color: #f7c90d; color: var(--select); height: 20px; "></div>
                        @endif
                    </div>
                    
                    <br>
                    <div id="print-footer" class="print-footer">
                        <img src="{{ asset('/img/maquinariaPrint/Pie de página_1.svg') }}">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function goBack() {
        window.history.back();
    }
</script>
<script>
    // Detectar cuándo se está imprimiendo
    window.onbeforeprint = function() {
        document.getElementById('ultimoNumPage').style.display = 'block';
    };

    // Ocultar el pie de página después de la impresión
    window.onafterprint = function() {
        document.getElementById('ultimoNumPage').style.display = 'none';
    };

</script>
<script>
    const totalPages = document.querySelectorAll('.page').length;
    document.documentElement.style.setProperty('--total-pages', totalPages);
</script>
<script>
    print(){
        window.print();
    }
</script>
<style>
    :root {
        --total-pages: 0;
      }
    ::-webkit-scrollbar {
        display: none;
    }
    .centered-text {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 50%;
    }

    body {
        counter-reset: page-counter 0 total-pages var(--total-pages);
        background-color: white;
      }
      
      .page {

        min-height: 10px;
        width: 8vw;
        margin-bottom:1rem;
        bottom: 7.2mm;
        left: 3mm;
        right: 1mm;
        display: block;
      }

    .page::before {
        counter-increment: page-counter 1;
        content: counter(page-counter) " de " counter(total-pages);
      }
</style>

<style>
    .page-break {
        page-break-after: always;
    }
</style>
    
<style>
    @media print {
        body * {
            visibility: hidden;
        }
        #print-content * {
            visibility: visible !important;
        }
        #columnaInvisible {
            visibility: hidden !important;
        }
        #columnaInvisible2 {
            visibility: hidden !important;
        }
        #print-content, #print-content {
            margin-left: -6mm;
            margin-right: -10mm;
            
        }
      
        #print-footer {
            position: fixed;
            bottom: 10mm;
            left: 3mm;
            right: 1mm;
            text-align: center;
            height: 0mm; /* Altura fija para el footer */
            margin-top: 6mm;
        }
        table {
            boder: none;
          }
        #print-footer, #print-footer * {
            visibility: visible !important;
        }
        .print-header {
            position: fixed;
            top: 6mm;
            left: 5mm;
            right: 5mm;
            text-align: center;
        }
        #print-header, #print-header * {
            visibility: visible !important;
        }
        .content-center {
            position: fixed;
            top: 50%;
            left: 0;
            right: 0;
            transform: translateY(-50%);
            text-align: center;
        }
        #content-center, #content-center * {
            visibility: visible !important;
            display: inline-block !important;
        }
        @page {
            size: letter landscape;
            margin-bottom: 39px;
        }
        body {
            margin-top: -65mm !important;
            padding: 0 !important;
        }
    }

    #print-content {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        text-align: center !important;
        font-family: 'Montserrat', sans-serif !important;
        align-items: start;
    }

    #main {
        margin-top: 80px !important;
    }
</style>

@endsection
