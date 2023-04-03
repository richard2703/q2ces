@extends('layouts.main', ['activePage' => 'asistencias', 'titlePage' => __('Asistencia Personal')])
<?php
$objCalendar = new Calendario();

$dtToday = date('Ymd');
$fechaSeleccionada = date_create(date('Y-m-d', strtotime("$intAnio-$intMes-$intDia")));
$diaSeleccionado = $objCalendar->getNameDay(date_format($fechaSeleccionada, 'N'));
$mesSeleccionado = $objCalendar->getNameMonth(date_format($fechaSeleccionada, 'm'));

$semanaAnterior =   ( date( 'Y-m-d', strtotime( $strFechaInioPeriodo .'- 6 days' ) ) );
// dd( $intAnio, $intMes, $intDia );
$diaAnterior = date_format($objCalendar->getDiaAnterior($semanaAnterior), 'd');
$mesAnterior = date_format($objCalendar->getDiaAnterior($semanaAnterior), 'm');
$anioAnterior = date_format($objCalendar->getDiaAnterior($semanaAnterior), 'Y');

$diaSiguiente = date_format($objCalendar->getDiaSiguiente($strFechaFinPeriodo), 'd');
$mesSiguiente = date_format($objCalendar->getDiaSiguiente($strFechaFinPeriodo), 'm');
$anioSiguiente = date_format($objCalendar->getDiaSiguiente($strFechaFinPeriodo), 'Y');

$dtTrabajar = date('Ymd', strtotime("$intAnio-$intMes-$intDia"));
// dd($vctFechas);
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
                                            <a href="{{ url('asistencia/personal/' . $personal->id . '/' . $anioAnterior . '/' . $mesAnterior . '/' . $diaAnterior) }}"
                                                class="" title="Ir al día periodo anterior">
                                                <i class="bi bi-arrow-left-square"></i>
                                            </a>
                                            <!-- Para el mes en curso -->
                                        </span>
                                        &nbsp;&nbsp;&nbsp; Semana del
                                        {{ $strFechaInioPeriodo }} al {{ $strFechaFinPeriodo }}
                                        &nbsp;&nbsp;&nbsp;
                                        <!-- Un dia adelante del cargado -->
                                        <span>
                                            <a href="{{ url('asistencia/personal/' . $personal->id . '/' . $anioSiguiente . '/' . $mesSiguiente . '/' . $diaSiguiente) }}"
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
                                            <a href="{{ route('asistencia.show', $personal->id) }}"
                                                class="display-8 mb-8 text-center" title="Ir al periodo en curso"><b>Hoy es
                                                    {{  $objCalendar->getFechaFormateada(date_create(date('Y-m-d'))) }}</b></a>
                                        </span>
                                        <h4 class="card-title">
                                            {{ $personal->nombres }} {{ $personal->apellidoP }}
                                            {{ $personal->apellidoM }}</h4>
                                    </div>

                                    <form class="row alertaGuardar"
                                        action="{{ route('asistencia.update', $personal->id) }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('put')
                                        <input type="hidden" name="intAnio" value="{{ $intAnio }}">
                                        <input type="hidden" name="intMes" value="{{ $intMes }}">
                                        <input type="hidden" name="intDia" value="{{ $intDia }}">
                                        <input type="hidden" name="personalId" value="{{ $personal->id }}">


                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead class="labelTitulo text-center">
                                                    <th class="labelTitulo">Dia</th>
                                                    <th class="labelTitulo">Horas Extra</th>
                                                    <th class="labelTitulo">Asistencia</th>
                                                    <th class="labelTitulo">Faltas</th>
                                                    <th class="labelTitulo">Incapacidadades</th>
                                                    <th class="labelTitulo">Vacaciones</th>
                                                    <th class="labelTitulo">Descansos</th>
                                                </thead>
                                                <tbody class="text-center">
                                                    @forelse ($asistencias as $item)
                                                        <tr>
                                                            <td>{{ $objCalendar->getFechaFormateada(date_create($item->fecha)) }}
                                                                <input type="hidden" name="fecha[]"
                                                                    value="{{ $item->fecha }}">
                                                                <input type="hidden" name="recordId[]"
                                                                    value="{{ $item->id }}">
                                                            </td>
                                                            <td><input type="number" class="inputCaja text-right" required
                                                                    name="horasExtra[]" id="horasExtra"
                                                                    value="{{ $item->horasExtra }}" maxlength="2"
                                                                    step="1" min="0" max="16"></td>
                                                            <td><input type="radio" name="{{ $item->id }}[]"
                                                                    id="Asistencia_{{ $item->id }}" value="1"
                                                                    {{ $item->asistenciaId == 1 ? ' checked' : '' }}></td>
                                                            <td><input type="radio" name="{{ $item->id }}[]"
                                                                    id="Asistencia_{{ $item->id }}" value="2"
                                                                    {{ $item->asistenciaId == 2 ? ' checked' : '' }}>
                                                            </td>
                                                            <td><input type="radio" name="{{ $item->id }}[]"
                                                                    id="Asistencia_{{ $item->id }}" value="3"
                                                                    {{ $item->asistenciaId == 3 ? ' checked' : '' }}>
                                                            </td>
                                                            <td><input type="radio" name="{{ $item->id }}[]"
                                                                    id="Asistencia_{{ $item->id }}" value="4"
                                                                    {{ $item->asistenciaId == 4 ? ' checked' : '' }}>
                                                            </td>
                                                            <td><input type="radio" name="{{ $item->id }}[]"
                                                                    id="Asistencia_{{ $item->id }}" value="5"
                                                                    {{ $item->asistenciaId == 5 ? ' checked' : '' }}>
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="2">Sin registros.<br><br> <b>Es necesario
                                                                    registrar primero la asistencia del personal antes de
                                                                    poder realizar las acciones de esta semana.</b></td>
                                                        </tr>
                                                    @endforelse
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
