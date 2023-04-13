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
                                                                //*** recorremos el arreglo de los dias de la semana de trabajo ***************//
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
                                                                            $intTotalHorasExtras += $item->pagos[$iDay]->horasExtra;
                                                                            $intTotalCostoHorasExtras += ( $item->pagos[$iDay]->horasExtra * $item->pagos[$iDay]->horaExtraCosto);
                                                                            $intDiasAsistidos += $item->pagos[$iDay]->esAsistencia;
                                                                            break;
                                                                        }

                                                                    }

                                                                    if($blnExiste == true){
                                                                        ?>
                                                            <td
                                                                style="color: {{ $item->pagos[$iDay]->tipoAsistenciaColor }};">
                                                                {{ $item->pagos[$iDay]->esAsistencia }} </td>
                                                            <td
                                                                style="color: {{ $item->pagos[$iDay]->horaExtraColor }}; background: whitesmoke;">
                                                                {{ $item->pagos[$iDay]->horasExtra }} </td>
                                                            <?php
                                                                    }else{
                                                                       ?>
                                                            <td> --- </td>
                                                            <td style="background: whitesmoke;"> --- </td>
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
                                                            <td class="text-right">
                                                                $ {{ number_format($intTotalCostoHorasExtras, 2) }}
                                                                <?php
                                                                //*** sumamos al total general las horas extras del personal
                                                                $intTotalGeneralHorasExtras += $intTotalCostoHorasExtras;
                                                                ?>
                                                            </td>
                                                            <td class="text-right">
                                                                $ {{ number_format($intTotalCostoHorasExtras + $item->sueldo * $intDiasAsistidos, 2) }}
                                                                <?php
                                                                //*** sumamos al total general el sueldo del personal
                                                                $intTotalGeneralSueldo += $intTotalCostoHorasExtras + ($item->sueldo * $intDiasAsistidos);
                                                                ?>
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
