@extends('layouts.main', ['activePage' => 'asistencias', 'titlePage' => __('Corte Semanal de Nomina')])
<?php
$objCalendar = new Calendario();

$dtToday = date('Ymd');
$fechaSeleccionada = date_create(date('Y-m-d', strtotime("$intAnio-$intMes-$intDia")));
$diaSeleccionado = $objCalendar->getNameDay(date_format($fechaSeleccionada, 'N'));
$mesSeleccionado = $objCalendar->getNameMonth(date_format($fechaSeleccionada, 'm'));
$semanaSeleccionada = date_format($fechaSeleccionada, 'W');

$semanaAnterior = date('Y-m-d', strtotime($strFechaInioPeriodo . '- 6 days'));
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
    $vctDiasSemana[] = date_create(date('Y-m-d', strtotime($strFechaInioPeriodo . '+' . $i . ' days')));
}

// dd($vctDiasSemana);

//*** bloqueamos fecha mayor al dia actual
$blnBloquearRegistro = $dtTrabajar <= $dtToday && $asistencias->isEmpty() == true ? false : true;

// dd($asistencias, $diaAnterior, $diaSiguiente, $fechaSeleccionada, $diaSeleccionado, $dtToday, $dtTrabajar);

?>
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
                                        {{ $strFechaInioPeriodo }} al {{ $strFechaFinPeriodo }}
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
                                        <span>
                                            <a href="{{ route('asistencia.corteSemanal') }}"
                                                class="display-8 mb-8 text-center" title="Ir al periodo en curso"><b>Hoy es
                                                    {{ $objCalendar->getFechaFormateada(date_create(date('Y-m-d'))) }}</b></a>
                                        </span>
                                        {{-- <h4 class="card-title">
                                            {{ $personal->nombres }} {{ $personal->apellidoP }}
                                            {{ $personal->apellidoM }}</h4> --}}
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
                                                    <th class="labelTitulo">Puesto</th>
                                                    <th class="labelTitulo">Código</th>
                                                    <th class="labelTitulo">Nombre</th>
                                                    <?php
                                                    for ($i=0; $i < 7 ; $i++) {
                                                       ?>
                                                    <th class="labelTitulo" colspan="2">
                                                        {{ $objCalendar->getNameDay($vctDiasSemana[$i]->format('N')) }}
                                                        {{ $vctDiasSemana[$i]->format('d') }} </th>
                                                    <?php
                                                    }
                                                    ?>
                                                    <th class="labelTitulo">Días</th>
                                                    <th class="labelTitulo">Salario por día</th>
                                                    <th class="labelTitulo">Importe semanal</th>
                                                    <th class="labelTitulo">Horas extra</th>
                                                    <th class="labelTitulo">Total horas extra</th>
                                                    <th class="labelTitulo">Pago semanal</th>
                                                </thead>
                                                <?php
                                                $intTotalGeneralSueldo = 0;
                                                $intTotalGeneralHorasExtras = 0; ?>
                                                <tbody class="text-center">
                                                    @forelse ($vctAsistencias as $item)
                                                        <?php
                                                        $intTotalHorasExtras = 0;
                                                        $intTotalCostoHorasExtras = 0;
                                                        $intDiasAsistidos = 0;
                                                        $intDiasPagados = count($item->pagos);

                                                        ?>
                                                        <tr>
                                                            <td>{{ $item->puesto }}</td>
                                                            <td>{{ $item->numEmpleado }}</td>
                                                            <td class="text-left">{{ $item->empleado }}</td>
                                                            <?php

                                                           if ($intDiasPagados > 0 && $intDiasPagados == 7 ) {
                                                            //*** tenemos semana completa ***************//
                                                                for ($i = 0; $i < count($item->pagos); $i++) {

                                                                    $intTotalHorasExtras += $item->pagos[$i]->horasExtra;
                                                                    $intTotalCostoHorasExtras += ( $item->pagos[$i]->horasExtra * $item->pagos[$i]->horaExtraCosto);
                                                                    $intDiasAsistidos += $item->pagos[$i]->esAsistencia;

                                                                    ?>
                                                            <td style="color: {{ $item->pagos[$i]->tipoAsistenciaColor }}">
                                                                {{ $item->pagos[$i]->esAsistencia }}
                                                            </td>
                                                            <td
                                                                style="color: {{ $item->pagos[$i]->horaExtraColor }}; background: whitesmoke;">
                                                                {{ $item->pagos[$i]->horasExtra }}</td>
                                                            <?php
                                                                }
                                                                    //*** total de las horas extras
                                                                    $intTotalGeneralHorasExtras +=$intTotalCostoHorasExtras;
                                                            } else if ($intDiasPagados > 0 && $intDiasPagados < 7){
                                                                //*** tenemos semana incompleta ***************//
                                                                for ($i = 0; $i < 7; $i++) {
                                                                        //*** validamos la cantidad de dias registrados
                                                                        if( $i <= ($intDiasPagados-1)){

                                                                        //*** convertimos las fechas a numero para comparar  **/
                                                                        $intDiaSemana = $vctDiasSemana[$i]->format('Ymd');
                                                                        $intDiaPago = str_replace("-","",$item->pagos[$i]->fecha);

                                                                        //*** es el mismo dia
                                                                        if($intDiaSemana == $intDiaPago){
                                                                            $intTotalHorasExtras += $item->pagos[$i]->horasExtra;
                                                                    $intTotalCostoHorasExtras += ( $item->pagos[$i]->horasExtra * $item->pagos[$i]->horaExtraCosto);
                                                                    $intDiasAsistidos += $item->pagos[$i]->esAsistencia;
                                                                            //*** total de las horas extras
                                                                            $intTotalGeneralHorasExtras +=$intTotalCostoHorasExtras;
                                                                            ?>
                                                            <td style="color: {{ $item->pagos[$i]->tipoAsistenciaColor }}">
                                                                {{ $item->pagos[$i]->esAsistencia }}
                                                            </td>
                                                            <td
                                                                style="color: {{ $item->pagos[$i]->horaExtraColor }}; background: whitesmoke;">
                                                                {{ $item->pagos[$i]->horasExtra }}</td>
                                                            <?php

                                                                        }else{ ?>
                                                            <td> --- </td>
                                                            <td> --- </td>
                                                            <?php
                                                                        }

                                                                        }else{ ?>
                                                            <td> --- </td>
                                                            <td> --- </td>
                                                            <?php
                                                                        }

                                                                    }
                                                                }else if ($intDiasPagados == 0 ){
                                                                //*** no tenemos ningun registro ***************//
                                                                for ($i = 0; $i < 7; $i++) {
                                                                    //*** sin registros ese dia **/
                                                                    ?>
                                                            <td> --- </td>
                                                            <td> --- </td>
                                                            <?php
                                                                }
                                                            }
                                                            ?>
                                                            <td>{{ $intDiasAsistidos }}</td>
                                                            <td class="text-right">$ {{ number_format($item->sueldo, 2) }}
                                                            </td>
                                                            <td class="text-right">$
                                                                {{ number_format($item->sueldo * $intDiasAsistidos, 2) }}
                                                            </td>
                                                            <td class="text-right">{{ $intTotalHorasExtras }}</td>
                                                            <td class="text-right">$
                                                                {{ number_format($intTotalCostoHorasExtras, 2) }}</td>
                                                            <td class="text-right">$
                                                                {{ number_format($intTotalCostoHorasExtras + $item->sueldo * $intDiasAsistidos, 2) }}
                                                                <?php $intTotalGeneralSueldo += $intTotalCostoHorasExtras + $item->sueldo * $intDiasAsistidos; ?>
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="2">Sin registros.<br><br> <b>Es necesario
                                                                    registrar primero la asistencia del personal antes de
                                                                    poder realizar las acciones de esta semana.</b></td>
                                                        </tr>
                                                    @endforelse

                                                    <tr>
                                                        <td colspan="21"></td>
                                                        <td class="text-right">$
                                                            {{ number_format($intTotalGeneralHorasExtras, 2) }} </td>
                                                        <td class="text-right">$
                                                            {{ number_format($intTotalGeneralSueldo, 2) }} </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="card-footer mr-auto">

                                            <a href="{{ route('asistencia.index') }}">
                                                <button type="button" class="btn btn-danger">Cancelar</button>
                                            </a>
                                            <a href="#">
                                                <button type="submit" class="btn botonGral">Guardar</button>
                                            </a>
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
