@extends('layouts.main', ['activePage' => 'asistencias', 'titlePage' => __('Asistencia Diaria')])
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
$intDiaSeleccionado = date_format($fechaSeleccionada, 'N');
$diaSeleccionado = $objCalendar->getNameDay(date_format($fechaSeleccionada, 'N'), true);
$mesSeleccionado = $objCalendar->getNameMonth(date_format($fechaSeleccionada, 'm'));

$dtToday = date('Ymd');
$dtTrabajar = date('Ymd', strtotime("$intAnio-$intMes-$intDia"));
//*** averiguamos si el dia seleccionado es Sabado
$blnFechaSeleccionadaEsSabado = $fechaSeleccionada->format('N') == 6 ? true : false;

//*** estoy dentro del periodo de la semana de trabajo en curso
$blnEnSemanaEnCurso = $objCalendar->getEnSemanaDeTrabajo($fechaSeleccionada, 3);
//*** el dia actual en curso
$blnEsDiaActual = $dtTrabajar == $dtToday ? true : false;
//*** bloqueamos fecha mayor al dia actual
$blnBloquearRegistro = $dtToday >= $dtTrabajar ? false : true;

// dd('Asistencias',$asistencias,
// 'Dia anterior',$diaAnterior,
// 'Dia sisguiente', $diaSiguiente,
// 'Fecha seleccionada', $fechaSeleccionada,
// 'Dia seleccionado',$diaSeleccionado,
// 'Hoy:', $dtToday,
// 'Fecha trabajar:',$dtTrabajar,
// 'Bloquear',$blnBloquearRegistro);

?>
@section('content')
    <div class="content">
        @if ($errors->any())
            <div class="alert alert-danger">
                <!-- PARA LA CARGA DE LOS ERRORES DE LOS DATOS-->
                <p>Listado de Errores a Corregir</p>
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
                                            <a href="{{ url('asistencia/diaria/' . $anioAnterior . '/' . $mesAnterior . '/' . $diaAnterior) }}"
                                                class="" title="Ir al día anterior">
                                                <i class="bi bi-arrow-left-square"></i>
                                            </a>
                                            <!-- Para el mes en curso -->
                                        </span>
                                        <span>
                                            <a href="{{ route('asistencia.create') }}" class="display-8 mb-8 text-center"
                                                title="Ir al día en curso"><b>Hoy <?php echo $blnAsistenciaRegistrada == false ? '(Apertura)' : '(Cierre)'; ?>
                                                    {{-- {{ $objCalendar->getFechaFormateada(date_create(date('Y-m-d'))) }} --}}
                                                </b></a>
                                        </span>

                                        {{-- &nbsp;&nbsp;&nbsp;
                                        {{ $objCalendar->getFechaFormateada($fechaSeleccionada) }}
                                        &nbsp;&nbsp;&nbsp; --}}
                                        <!-- Un dia adelante del cargado -->


                                        <span>
                                            <a href="{{ url('asistencia/diaria/' . $anioSiguiente . '/' . $mesSiguiente . '/' . $diaSiguiente) }}"
                                                class="" title="Ir al día siguiente">
                                                <i class="bi bi-arrow-right-square"></i>
                                            </a>
                                        </span>
                                    </h4>
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
                                                <a href="{{ route('asistencia.create') }}"
                                                    class="combustibleLitros fw-semibold text-end"
                                                    title="Ir al dia en curso"><b>Asistencia del Día
                                                        {{ /*ucwords*/ trans($objCalendar->getFechaFormateada($fechaSeleccionada, true)) }}
                                                    </b>
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

                                        <form class="row alertaGuardar" action="{{ route('asistencia.store') }}"
                                            method="post" enctype="multipart/form-data">
                                            @csrf

                                            <input type="hidden" name="blnAsistenciaRegistrada"
                                                value="{{ $blnAsistenciaRegistrada }}">
                                            <input type="hidden" name="intAnio" value="{{ $intAnio }}">
                                            <input type="hidden" name="intMes" value="{{ $intMes }}">
                                            <input type="hidden" name="intDia" value="{{ $intDia }}">
                                            <input type="hidden" name="fecha"
                                                value="{{ date_format($fechaSeleccionada, 'Y-m-d') }}">
                                            <input type="hidden" name="horasExtra" value="0">

                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead class="labelTitulo text-center">
                                                        <th class="labelTitulo" style="width:35px !important">#</th>
                                                        <th class="labelTitulo">Código</th>
                                                        <th class="labelTitulo">Nombre</th>
                                                        <th class="labelTitulo">Puesto</th>
                                                        <th class="labelTitulo" style="width:140px !important">Asistencia
                                                        </th>
                                                        <th class="labelTitulo">Faltas</th>
                                                        <th class="labelTitulo" style="width:190px !important">
                                                            Incapacidadades</th>
                                                        <th class="labelTitulo" style="width:140px !important">Vacaciones
                                                        </th>
                                                        <th class="labelTitulo" style="width:140px !important">Descansos
                                                        </th>
                                                        <th class="labelTitulo">Horario Entrada</th>
                                                        <th class="labelTitulo" style="width:120px !important">Entrada
                                                            Anticipada
                                                        </th>
                                                        <th class="labelTitulo" style="width:120px !important">Entrada
                                                        </th>
                                                        <th class="labelTitulo">Horario Salida</th>
                                                        <th class="labelTitulo" style="width:120px !important">Salida
                                                        </th>
                                                    </thead>
                                                    <tbody class="text-center">
                                                        @php
                                                            $intCont = 1;
                                                        @endphp
                                                        @if ($blnAsistenciaRegistrada == false)
                                                            @forelse ($listaAsistencia as $item)
                                                                <tr>
                                                                    <td>{{ $intCont }}</td>
                                                                    <td class=""
                                                                        style="color: {{ $item->estatusColor }};">
                                                                        <strong>{{ str_pad($item->numNomina, 4, '0', STR_PAD_LEFT) }}</strong>
                                                                        <input type="hidden" name="asistenciaId[]"
                                                                            value="{{ $item->asistenciaId }}">
                                                                        <input type="hidden" name="personalId[]"
                                                                            value="{{ $item->id }}">
                                                                        {{-- <input type="hidden" name="horarioSalida[]"
                                                                            value="{{ $item->horarioSalida }}"> --}}
                                                                    </td>
                                                                    <td class="text-left">
                                                                        <a href="#"
                                                                            title="Fecha de Ingreso {{ \Carbon\Carbon::parse($item->fechaIngreso)->format('d/m/Y') }}">
                                                                            {{ $item->getFullLastNameAttribute() }}</a>
                                                                    </td>
                                                                    <td>{{ $item->puesto }}</td>
                                                                    <td><input type="radio"
                                                                            name="{{ $item->id }}[]"
                                                                            id="Asistencia_{{ $item->id }}"
                                                                            value="1"
                                                                            {{ $intDiaSeleccionado != 7 ? 'checked' : '' }}>
                                                                    </td>
                                                                    <td><input type="radio"
                                                                            name="{{ $item->id }}[]"
                                                                            id="Asistencia_{{ $item->id }}"
                                                                            value="2">
                                                                    </td>
                                                                    <td><input type="radio"
                                                                            name="{{ $item->id }}[]"
                                                                            id="Asistencia_{{ $item->id }}"
                                                                            value="3">
                                                                    </td>
                                                                    <td><input type="radio"
                                                                            name="{{ $item->id }}[]"
                                                                            id="Asistencia_{{ $item->id }}"
                                                                            value="4">
                                                                    </td>
                                                                    <td><input type="radio"
                                                                            name="{{ $item->id }}[]"
                                                                            id="Asistencia_{{ $item->id }}"
                                                                            value="5"
                                                                            {{ $intDiaSeleccionado == 7 ? 'checked' : '' }}>
                                                                    </td>
                                                                    <td>
                                                                        <?php
                                                                        $dtHorario = $item->horarioEntrada ? \Carbon\Carbon::parse($item->horarioEntrada)->format('H:i') : '';
                                                                        ?>
                                                                        {{ $dtHorario }}
                                                                        <input type="hidden" name="horarioEntrada[]"
                                                                            value="{{ $dtHorario }}">
                                                                    </td>
                                                                    <td>
                                                                        <select class="form-select" id="entradaAnticipada"
                                                                            name="entradaAnticipada[]">
                                                                            <option value="0"
                                                                                {{ $item->entradaAnticipada == 0 ? ' selected' : '' }}>
                                                                                No</option>
                                                                            <option value="1"
                                                                                {{ $item->entradaAnticipada == 1 ? ' selected' : '' }}>
                                                                                Sí</option>
                                                                        </select>
                                                                    </td>
                                                                    <td>
                                                                        <input type="time" class="inputCaja "
                                                                            placeholder="Entrada" id=""
                                                                            name="hEntrada[]"
                                                                            value="{{ $dtHorario }}">
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
                                                                        <input type="time" class="inputCaja "
                                                                            placeholder="Salida" id=""
                                                                            name="hSalida[]"
                                                                            value="{{ $item->hSalida }}">
                                                                    </td>
                                                                </tr>
                                                                @php
                                                                    $intCont += 1;
                                                                @endphp
                                                            @empty
                                                                <tr>
                                                                    <td colspan="2">Sin Registros.</td>
                                                                </tr>
                                                            @endforelse
                                                        @else
                                                            @forelse ($asistencias as $item)
                                                                <tr>
                                                                    <td>{{ $intCont }}</td>
                                                                    <td class=""
                                                                        style="color: {{ $item->estatusColor }};">
                                                                        <strong>{{ str_pad($item->numNomina, 4, '0', STR_PAD_LEFT) }}</strong>
                                                                        <input type="hidden" name="asistenciaId[]"
                                                                            value="{{ $item->asistenciaId }}">
                                                                        <input type="hidden" name="personalId[]"
                                                                            value="{{ $item->id }}">
                                                                        <input type="hidden" name="recordId[]"
                                                                            value="{{ $item->recordId }}">
                                                                        {{-- <input type="hidden" name="horarioSalida[]"
                                                                            value="{{ $item->horarioSalida }}"> --}}
                                                                        <input type="hidden" name="horarioEntrada[]"
                                                                            value="{{ $item->horarioEntrada }}">
                                                                    </td>
                                                                    <td>{{ $item->puesto }}</td>
                                                                    <td class="text-left">
                                                                        <a href="#"
                                                                            title="Fecha de Ingreso {{ \Carbon\Carbon::parse($item->fechaIngreso)->format('d/m/Y') }}">
                                                                            {{ $item->getFullLastNameAttribute() }}</a>
                                                                    </td>
                                                                    <td>
                                                                        <input type="radio"
                                                                            name="{{ $item->id }}[]"
                                                                            id="Asistencia_{{ $item->id }}"
                                                                            value="1"
                                                                            {{ $item->asistenciaId == 1 ? ' checked' : '' }}>
                                                                    </td>
                                                                    <td>
                                                                        <input type="radio"
                                                                            name="{{ $item->id }}[]"
                                                                            id="Asistencia_{{ $item->id }}"
                                                                            value="2"
                                                                            {{ $item->asistenciaId == 2 ? ' checked' : '' }}>
                                                                    </td>
                                                                    <td>
                                                                        <input type="radio"
                                                                            name="{{ $item->id }}[]"
                                                                            id="Asistencia_{{ $item->id }}"
                                                                            value="3"
                                                                            {{ $item->asistenciaId == 3 ? ' checked' : '' }}>
                                                                    </td>
                                                                    <td>
                                                                        <input type="radio"
                                                                            name="{{ $item->id }}[]"
                                                                            id="Asistencia_{{ $item->id }}"
                                                                            value="4"
                                                                            {{ $item->asistenciaId == 4 ? ' checked' : '' }}>
                                                                    </td>
                                                                    <td>
                                                                        <input type="radio"
                                                                            name="{{ $item->id }}[]"
                                                                            id="Asistencia_{{ $item->id }}"
                                                                            value="5"
                                                                            {{ $item->asistenciaId == 5 ? ' checked' : '' }}>
                                                                    </td>
                                                                    <td>
                                                                        <?php
                                                                        $dtHorario = $item->horarioEntrada ? \Carbon\Carbon::parse($item->horarioEntrada)->format('H:i') : '';
                                                                        ?>
                                                                        {{ $dtHorario }}
                                                                    </td>
                                                                    <td>
                                                                        <select class="form-select" id="entradaAnticipada"
                                                                            name="entradaAnticipada[]">
                                                                            <option value="0"
                                                                                {{ $item->entradaAnticipada == 0 ? ' selected' : '' }}>
                                                                                No</option>
                                                                            <option value="1"
                                                                                {{ $item->entradaAnticipada == 1 ? ' selected' : '' }}>
                                                                                Sí</option>
                                                                        </select>
                                                                    </td>
                                                                    <td>
                                                                        <input type="time" class="inputCaja "
                                                                            placeholder="Entrada" id=""
                                                                            name="hEntrada[]"
                                                                            value="{{ $item->hEntrada ? \Carbon\Carbon::parse($item->hEntrada)->format('H:i') : '' }}">
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
                                                                        <input type="time" class="inputCaja "
                                                                            placeholder="Salida" id=""
                                                                            name="hSalida[]"
                                                                            value="{{ $item->hSalida ? \Carbon\Carbon::parse($item->hSalida)->format('H:i') : '' }}">
                                                                    </td>
                                                                </tr>
                                                                @php
                                                                $intCont += 1;
                                                            @endphp
                                                            @empty
                                                                <tr>
                                                                    <td colspan="2">Sin Registros.</td>
                                                                </tr>
                                                            @endforelse
                                                        @endif


                                                    </tbody>
                                                </table>
                                            </div>

                                            <div class="card-footer mr-auto">
                                                <?php if($blnEnSemanaEnCurso == true && $blnBloquearRegistro == false ){  ?>
                                                <a href="{{ route('asistencia.index') }}">
                                                    <button type="button" class="btn btn-danger">Cancelar</button>
                                                </a>
                                                <a href="#">
                                                    <button type="submit" class="btn botonGral">Guardar</button>
                                                </a>
                                                {{-- {{ $personal->links() }} --}}
                                                <?php }else{
                                                    if($blnAsistenciaRegistrada==true && $blnEsDiaActual==false){
                                                        ?>
                                                <p class="botonTitulos mt-2">La asistencia ya fue registrada, si requiere
                                                    realizar un cambio deberá hacerlo de forma individual por cada empleado.
                                                </p>
                                                <?php
                                                    }else{

                                                    }
                                                } ?>
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

        {{-- //Modales --}}
        <div class="modal fade" id="modal-cliente" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="modal-cliente" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="col-12">
                        <div class="card ">
                            <form action="{{ url('asistencia/otrodia/') }}" method="post">
                                @csrf
                                <div class="card-header bacTituloPrincipal ">
                                    <div class="nav-tabs-navigation">
                                        <div class="nav-tabs-wrapper">
                                            <span class="nav-tabs-title">
                                                <h2 class="titulos">Seleccionar Otro día Para Asistencia</h2>
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
