@extends('layouts.main', ['activePage' => 'asistencias', 'titlePage' => __('Asistencia Personal en Semana de Trabajo')])
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
// dd($vctFechas);

//*** Arreglo para los dias del periodo **/
$vctDiasSemanaActual = $objCalendar->getSemanaTrabajo(date_create(date('Y-m-d')), 3);

//*** bloqueamos si no hay registros
if ($asistencias->isEmpty() == true) {
    $blnBloquearRegistro = true;
} else {
    //*** preguntamos si esta en la semana en curso para permitir el registro de horas extras ***//
    if ($fechaSeleccionada->format('Ymd') >= $vctDiasSemanaActual[0]->format('Ymd')) {
        //*** la fecha seleccionada es mayor o igual que el día inicial del periodo
        $blnBloquearRegistro = false;
    } else {
        $blnBloquearRegistro = true;
    }
}
// dd($asistencias, $diaAnterior, $diaSiguiente, $fechaSeleccionada, $diaSeleccionado, $dtToday, $dtTrabajar);
?>
@section('content')
    <div class="content">
        @if ($errors->any())
            <div class="alert alert-danger">
                <!-- PARA LA CARGA DE LOS ERRORES DE LOS DATOS-->
                <p>Listado De Errores A Corregir</p>
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
                                        &nbsp;&nbsp;&nbsp; Semana {{ $semanaSeleccionada }} Del
                                        {{ $strFechaInicioPeriodo }} Al {{ $strFechaFinPeriodo }}
                                        &nbsp;&nbsp;&nbsp;
                                        <!-- Un dia adelante del cargado -->
                                        <span>
                                            <a href="{{ url('asistencia/personal/' . $personal->id . '/' . $anioSiguiente . '/' . $mesSiguiente . '/' . $diaSiguiente) }}"
                                                class="" title="Ir al día periodo siguiente">
                                                <i class="bi bi-arrow-right-square"></i>
                                            </a>
                                        </span>
                                    </h4>
                                    {{-- <p class="card-category">Usuarios Registrados</p> --}}
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
                                                class="display-8 mb-8 text-center" title="Ir al periodo en curso"><b>Hoy
                                                    Es
                                                    {{ ucwords(trans($objCalendar->getFechaFormateada(date_create(date('Y-m-d')), true))) }}</b></a>
                                        </span>
                                        <h4 class="card-title">
                                            {{ $personal->nombres }} {{ $personal->apellidoP }}
                                            {{ $personal->apellidoM }}</h4>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 my-4 pb-4 d-md-flex align-items-center divBorder">
                                            <div class="col-12 col-md-2">
                                                <a href="{{ route('asistencia.index') }}">
                                                    <button class="btn regresar">
                                                        <span class="material-icons">
                                                            reply
                                                        </span>
                                                        Regresar
                                                    </button>
                                                </a>
                                            </div>
                                        </div>
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
                                                    <th class="labelTitulo">Día</th>
                                                    <th class="labelTitulo">Horas Extra</th>
                                                    <th class="labelTitulo" style="width:140px !important">Tipo</th>
                                                    <th class="labelTitulo" style="width:150px !important">Asistencia</th>
                                                    <th class="labelTitulo">Faltas</th>
                                                    <th class="labelTitulo" style="width:170px !important">Incapacidades
                                                    </th>
                                                    <th class="labelTitulo" style="width:150px !important">Vacaciones</th>
                                                    <th class="labelTitulo" style="width:150px !important">Descansos</th>
                                                    <th class="labelTitulo" style="width:140px !important">Entrada
                                                    </th>
                                                    <th class="labelTitulo" style="width:140px !important">Salida
                                                    </th>
                                                    <th class="labelTitulo" style="width:170px !important">Observaciones
                                                    </th>
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
                                                                    name="horasExtra[]"
                                                                    id="horasExtra"{{ $blnBloquearRegistro == true ? 'disabled="false"' : '' }}
                                                                    value="{{ $item->horasExtra }}" maxlength="2"
                                                                    step="1" min="0" max="16"></td>
                                                            <td>
                                                                <select id="tipoHoraExtraId" name="tipoHoraExtraId[]"
                                                                    {{ $blnBloquearRegistro == true ? 'disabled="false"' : '' }}
                                                                    class="form-select" aria-label="Default select example">

                                                                    @foreach ($vctTiposHoras as $tipo)
                                                                        <option value="{{ $tipo->id }}"
                                                                            {{ $item->tipoHoraExtraId == $tipo->id ? ' selected' : '' }}>
                                                                            {{ $tipo->nombre }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <input type="radio" name="{{ $item->id }}[]"
                                                                    id="Asistencia_{{ $item->id }}" value="1"
                                                                    {{ $blnBloquearRegistro == true ? 'disabled="false"' : '' }}
                                                                    {{ $item->asistenciaId == 1 ? ' checked' : '' }}></td>
                                                            <td>
                                                                <input type="radio" name="{{ $item->id }}[]"
                                                                    id="Asistencia_{{ $item->id }}" value="2"
                                                                    {{ $blnBloquearRegistro == true ? 'disabled="false"' : '' }}
                                                                    {{ $item->asistenciaId == 2 ? ' checked' : '' }}>
                                                            </td>
                                                            <td>
                                                                <input type="radio" name="{{ $item->id }}[]"
                                                                    {{ $blnBloquearRegistro == true ? 'disabled="false"' : '' }}
                                                                    id="Asistencia_{{ $item->id }}" value="3"
                                                                    {{ $item->asistenciaId == 3 ? ' checked' : '' }}>
                                                            </td>
                                                            <td>
                                                                <input type="radio" name="{{ $item->id }}[]"
                                                                    {{ $blnBloquearRegistro == true ? 'disabled="false"' : '' }}
                                                                    id="Asistencia_{{ $item->id }}" value="4"
                                                                    {{ $item->asistenciaId == 4 ? ' checked' : '' }}>
                                                            </td>
                                                            <td>
                                                                <input type="radio" name="{{ $item->id }}[]"
                                                                    {{ $blnBloquearRegistro == true ? 'disabled="false"' : '' }}
                                                                    id="Asistencia_{{ $item->id }}" value="5"
                                                                    {{ $item->asistenciaId == 5 ? ' checked' : '' }}>
                                                            </td>
                                                            <td>
                                                                <input type="time" class="inputCaja "
                                                                    placeholder="Entrada" id="hEntrada" name="hEntrada[]"
                                                                    value="{{ ($item->hEntrada?\Carbon\Carbon::parse($item->hEntrada)->format('H:i'):"") }}">
                                                            </td>
                                                            <td>
                                                                <input type="time" class="inputCaja "
                                                                    placeholder="Salida" id="hSalida" name="hSalida[]"
                                                                    value="{{ ($item->hSalida?\Carbon\Carbon::parse($item->hSalida)->format('H:i') : "")}}">
                                                            </td>
                                                            <td>
                                                                <input type="text" class="inputCaja text-left"
                                                                    name="comentario[]" id="comentario"
                                                                    {{ $blnBloquearRegistro == true ? 'disabled="false"' : '' }}
                                                                    value="{{ $item->comentario }}" maxlength="500"
                                                                    placeholder="Especifique...">
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="2">Sin registros.<br><br> <b>Es necesario
                                                                    Registrar Primero La Asistencia Del Personal Antes De
                                                                    Poder Realizar Las Acciones De Esta Semana.</b></td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="card-footer mr-auto">
                                            <?php if( $blnBloquearRegistro == false){  ?>
                                            <a href="{{ route('asistencia.index') }}">
                                                <button type="button" class="btn btn-danger">Cancelar</button>
                                            </a>
                                            <a href="#">
                                                <button type="submit" class="btn botonGral">Guardar</button>
                                            </a>
                                            <?php }else {
                                                ?>
                                            <p>Ya no se pueden realizar modificaciones, esta fuera del periodo permitido.
                                            </p>
                                            <?php
                                            } ?>
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
            width: 100px;
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
