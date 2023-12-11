@extends('layouts.main', ['activePage' => 'asistencias', 'titlePage' => __('Horas Extras en Asistencia Diaria')])
<?php
$objCalendar = new Calendario();

// dd( $intAnio, $intMes, $intDia );
$diaAnterior = date_format($objCalendar->getDiaAnterior("$intAnio-$intMes-$intDia"), 'd');
$mesAnterior = date_format($objCalendar->getDiaAnterior("$intAnio-$intMes-$intDia"), 'm');
$anioAnterior = date_format($objCalendar->getDiaAnterior("$intAnio-$intMes-$intDia"), 'Y');

$diaSiguiente = date_format($objCalendar->getDiaSiguiente("$intAnio-$intMes-$intDia"), 'd');
$mesSiguiente = date_format($objCalendar->getDiaSiguiente("$intAnio-$intMes-$intDia"), 'm');
$anioSiguiente = date_format($objCalendar->getDiaSiguiente("$intAnio-$intMes-$intDia"), 'Y');
$fechaSeleccionada = date_create(date('Y-m-d', strtotime("$intAnio-$intMes-$intDia")));
$diaSeleccionado = $objCalendar->getNameDay(date_format($fechaSeleccionada, 'N'), true);
$mesSeleccionado = $objCalendar->getNameMonth(date_format($fechaSeleccionada, 'm'));

$dtToday = date('Ymd');
$dtTrabajar = date('Ymd', strtotime("$intAnio-$intMes-$intDia"));

//*** averiguamos si el dia seleccionado es Sabado
$blnFechaSeleccionadaEsSabado = $fechaSeleccionada->format('N') == 6 ? true : false;

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
                                            <a href="{{ url('asistencia/horasExtra/' . $anioAnterior . '/' . $mesAnterior . '/' . $diaAnterior) }}"
                                                class="" title="Ir al día anterior">
                                                <i class="bi bi-arrow-left-square"></i>
                                            </a>
                                            <!-- Para el mes en curso -->
                                        </span>
                                        &nbsp;&nbsp;&nbsp;
                                        {{ $diaSeleccionado }} {{ $intDia }} de {{ $mesSeleccionado }} de
                                        {{ $intAnio }}
                                        &nbsp;&nbsp;&nbsp;
                                        <!-- Un dia adelante del cargado -->
                                        <span>
                                            <a href="{{ url('asistencia/horasExtra/' . $anioSiguiente . '/' . $mesSiguiente . '/' . $diaSiguiente) }}"
                                                class="" title="Ir al día siguiente">
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

                                            <div class="col-10 col-md-8 text-center">
                                                <a href="{{ route('asistencia.HEstore') }}"
                                                    class="combustibleLitros fw-semibold text-end"
                                                    title="Ir al día de hoy"><b>Horas Extras del Día
                                                        {{ /*ucwords*/ trans($objCalendar->getFechaFormateada($fechaSeleccionada, true)) }}</b>
                                                </a>
                                            </div>

                                            <div class="col-12 col-md-2 text-end">
                                                <button type="button"
                                                    class="botonSinFondo mx-2"title="Clic para marcar la asistencia en otro día."
                                                    data-bs-toggle="modal" data-bs-target="#modal-cliente">
                                                    <img style="width: 30px;"src="{{ '/img/inventario/reestock.svg' }}">
                                                    <p class="botonTitulos mt-2">Otro Día</p>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <form class="row alertaGuardar" action="{{ route('asistencia.HEstore') }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    {{-- @method('put') --}}

                                    <input type="hidden" name="intAnio" value="{{ $intAnio }}">
                                    <input type="hidden" name="intMes" value="{{ $intMes }}">
                                    <input type="hidden" name="intDia" value="{{ $intDia }}">
                                    <input type="hidden" name="fecha"
                                        value="{{ date_format($fechaSeleccionada, 'Y-m-d') }}">

                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead class="labelTitulo text-center">
                                                <th class="labelTitulo" style="width:25px !important">#</th>
                                                <th class="labelTitulo">Código</th>
                                                <th class="labelTitulo">Nombre</th>
                                                <th class="labelTitulo">Puesto</th>
                                                <th class="labelTitulo">Horario Salida</th>
                                                <th class="labelTitulo">Salida</th>
                                                {{-- <th class="labelTitulo">Tipo</th> <!-- Se calculan de forma dinamica --> --}}
                                                <th class="labelTitulo">Tiempo Extra</th>
                                            </thead>
                                            <tbody class="text-center">
                                                @php
                                                    $intCont = 1;
                                                @endphp
                                                @forelse ($asistencias as $item)
                                                    <tr>
                                                        <td>{{ $intCont }}</td>
                                                        <td style="color: {{ $item->estatusColor }};">
                                                            <strong>{{ str_pad($item->numNomina, 4, '0', STR_PAD_LEFT) }}</strong>
                                                            <input type="hidden" name="asistenciaId[]"
                                                                value="{{ $item->asistenciaId }}">
                                                            <input type="hidden" name="personalId[]"
                                                                value="{{ $item->id }}">
                                                        </td>
                                                        <td class="text-left">
                                                            {{ $item->getFullLastNameAttribute() }}
                                                        </td>
                                                        <td>
                                                            {{ $item->puesto }}
                                                        </td>
                                                        <td>
                                                            <?php
                                                            $dtHorario = null;
                                                            if ($blnFechaSeleccionadaEsSabado == true) {
                                                                $dtHorario = $item->horarioSalidaSabado ? \Carbon\Carbon::parse($item->horarioSalidaSabado)->format('H:i') : '';
                                                            } else {
                                                                $dtHorario = $item->horarioSalida ? \Carbon\Carbon::parse($item->horarioSalida)->format('H:i') : '';
                                                            }
                                                            ?>
                                                            {{ $dtHorario }}
                                                            <input type="hidden" name="horarioSalida[]"
                                                                value="{{ $dtHorario }}">
                                                        </td>
                                                        <td>
                                                            <input type="time" class="inputCaja " placeholder="Salida"
                                                                id="hSalida" name="hSalida[]"
                                                                value="{{ $item->hSalida ? \Carbon\Carbon::parse($item->hSalida)->format('H:i') : $dtHorario }}">
                                                        </td>
                                                        {{-- <td>
                                                            <!-- Se van a calcular de forma dinamica -->
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
                                                        </td> --}}
                                                        <td>
                                                            <?php
                                                            $intHoras = (int) ($item->horasExtra / 60);
                                                            $intMinutos = $item->horasExtra % 60;
                                                            ?>
                                                            <input type="time" class="inputCaja text-right"
                                                                readonly="false" name="horasExtra[]" id="horasExtra"
                                                                value="{{ str_pad($intHoras, 2, '0', STR_PAD_LEFT) . ':' . str_pad($intMinutos, 2, '0', STR_PAD_LEFT) }}">
                                                        </td>
                                                    </tr>
                                                    @php
                                                        $intCont += 1;
                                                    @endphp
                                                @empty
                                                    @forelse ($listaAsistencia as $item)
                                                        <tr>
                                                            <td>{{ $intCont }}</td>
                                                            <td style="color: {{ $item->estatusColor }};">
                                                                <strong>{{ str_pad($item->numNomina, 4, '0', STR_PAD_LEFT) }}</strong>
                                                            </td>
                                                            <td class="text-left">
                                                                {{ $item->getFullLastNameAttribute() }}</td>
                                                            <td>{{ $item->puesto }}</td>
                                                            <td>---</td>
                                                            <td>---</td>
                                                            {{-- <td>---</td> --}}
                                                            <td class="td-actions">---</td>
                                                        </tr>
                                                        @php
                                                            $intCont += 1;
                                                        @endphp
                                                    @empty
                                                        <tr>
                                                            <td colspan="2">Sin registros.<br><br> <b>Es necesario
                                                                    Registrar Primero la Asistencia del Personal Antes de
                                                                    Poder Asignar las Horas Extras.</b></td>
                                                        </tr>
                                                    @endforelse
                                                @endforelse
                                                <tr>
                                                    <td colspan="6"><br>Solo se Muestran Registros de Personal que
                                                        Asistió.<br><br></b></td>
                                                </tr>
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
                                        <p>Ya no se pueden realizar modificaciones, esta fuera del periodo permitido.</p>
                                        <?php
                                        } ?>
                                        {{--  {{ $personal->links() }}  --}}
                                    </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    {{-- //Modales --}}
    <div class="modal fade" id="modal-cliente" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-cliente"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="col-12">
                    <div class="card ">
                        <form action="{{ url('asistencia/otrodiaextras/') }}" method="post">
                            @csrf
                            <div class="card-header bacTituloPrincipal ">
                                <div class="nav-tabs-navigation">
                                    <div class="nav-tabs-wrapper">
                                        <span class="nav-tabs-title">
                                            <h2 class="titulos">Seleccionar Otro Día Para Asistencia</h2>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="row  card-body">
                                <div class="row card-body" style=" text-align: center;">
                                    <input type="hidden" name="productoid" id="productoid" value="">

                                    <div class="col-12 col-lg-6">
                                        <input type="date" class="inputCaja" id="fechaAsistencia"
                                            name="fechaAsistencia"
                                            value="{{ $fechaSeleccionada->format('Y-m-d') }}"></br>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12  mb-3 d-flex  justify-content-center align-self-end">
                                <button type="submit" class="btn botonGral ">Ir</button>
                            </div>
                        </form>

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
