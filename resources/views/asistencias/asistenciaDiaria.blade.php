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
$diaSeleccionado = $objCalendar->getNameDay(date_format($fechaSeleccionada, 'N'));
$mesSeleccionado = $objCalendar->getNameMonth(date_format($fechaSeleccionada, 'm'));

$dtToday = date('Ymd');
$dtTrabajar = date('Ymd', strtotime("$intAnio-$intMes-$intDia"));

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
                                            <a href="{{ url('asistencia/diaria/' . $anioAnterior . '/' . $mesAnterior . '/' . $diaAnterior) }}"
                                                class="" title="Ir al día anterior">
                                                <i class="bi bi-arrow-left-square"></i>
                                            </a>
                                            <!-- Para el mes en curso -->
                                        </span>
                                        <span>
                                            <a href="{{ route('asistencia.create') }}" class="display-8 mb-8 text-center"
                                                title="Ir al día en curso"><b>Hoy
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
                                    <!--<div class="col-12 my-4 pb-4 d-flex align-items-center divBorder">
                                            <span>
                                                {{-- <a href="{{ route('asistencia.create') }}"
                                                    class="display-8 mb-8 text-center" title="Ir al día en curso"><b>Hoy es
                                                        {{ $objCalendar->getFechaFormateada(date_create(date('Y-m-d'))) }}</b></a>
                                                         --}}
                                                &nbsp;&nbsp;&nbsp;
                                                {{ $objCalendar->getFechaFormateada($fechaSeleccionada) }}
                                                &nbsp;&nbsp;&nbsp;
                                            </span>
                                        </div>
                                        <div class="col-6 ">
                                            <button type="button"
                                                class="botonSinFondo mx-2"title="Clic para marcar la asistencia en otro día."
                                                data-bs-toggle="modal" data-bs-target="#modal-cliente">
                                                <img style="width: 30px;"src="{{ '/img/inventario/reestock.svg' }}">
                                                <p class="botonTitulos mt-2">Otro día</p>
                                            </button>

                                        </div>
                                    </div>-->

                                    <div class="col-12 my-4 pb-4 d-flex align-items-center divBorder">
                                        <div>
                                            <button type="button" class="botonSinFondo mx-2"title="Clic para marcar la asistencia en otro día."
                                                data-bs-toggle="modal" data-bs-target="#modal-cliente">
                                                <img style="width: 30px;"src="{{ '/img/inventario/reestock.svg' }}">
                                                <p class="botonTitulos mt-2">Otro día</p>
                                            </button>
                                        </div>
                                        <div class="">
                                            <a href="{{ route('asistencia.create') }}" class="combustibleLitros fw-semibold text-end"
                                                title="Ir al mes en curso"><b>Hoy es
                                                        {{ $objCalendar->getFechaFormateada(date_create(date('Y-m-d'))) }}</b>
                                            </a>
                                        </div>
                                    </div>



                                    <form class="row alertaGuardar" action="{{ route('asistencia.store') }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf

                                        <input type="hidden" name="intAnio" value="{{ $intAnio }}">
                                        <input type="hidden" name="intMes" value="{{ $intMes }}">
                                        <input type="hidden" name="intDia" value="{{ $intDia }}">
                                        <input type="hidden" name="fecha"
                                            value="{{ date_format($fechaSeleccionada, 'Y-m-d') }}">
                                        <input type="hidden" name="horasExtra" value="0">

                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead class="labelTitulo text-center">
                                                    <th class="labelTitulo">Codigo</th>
                                                    <th class="labelTitulo">Nombre</th>
                                                    <th class="labelTitulo">Asistencia</th>
                                                    <th class="labelTitulo">Faltas</th>
                                                    <th class="labelTitulo">Incapacidadades</th>
                                                    <th class="labelTitulo">Vacaciones</th>
                                                    <th class="labelTitulo">Descansos</th>
                                                </thead>
                                                <tbody class="text-center">

                                                    @forelse ($personal as $item)
                                                        <tr>
                                                            <td class="">
                                                                {{ $item->id }}
                                                                <input type="hidden" name="asistenciaId[]"
                                                                    value="{{ $item->asistenciaId }}">
                                                                <input type="hidden" name="personalId[]"
                                                                    value="{{ $item->id }}">
                                                            </td>
                                                            <td class="text-left">
                                                                {{ $item->getFullLastNameAttribute() }}
                                                            </td>
                                                            <td><input type="radio" name="{{ $item->id }}[]"
                                                                    id="Asistencia_{{ $item->id }}" value="1"
                                                                    {{ $intDiaSeleccionado != 7 ? 'checked' : '' }}></td>
                                                            <td><input type="radio" name="{{ $item->id }}[]"
                                                                    id="Asistencia_{{ $item->id }}" value="2">
                                                            </td>
                                                            <td><input type="radio" name="{{ $item->id }}[]"
                                                                    id="Asistencia_{{ $item->id }}" value="3">
                                                            </td>
                                                            <td><input type="radio" name="{{ $item->id }}[]"
                                                                    id="Asistencia_{{ $item->id }}" value="4">
                                                            </td>
                                                            <td><input type="radio" name="{{ $item->id }}[]"
                                                                    id="Asistencia_{{ $item->id }}" value="5"
                                                                    {{ $intDiaSeleccionado == 7 ? 'checked' : '' }}>
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="2">Sin registros.</td>
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
                                            {{--  {{ $personal->links() }}  --}}
                                            <?php } ?>
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
    <div class="modal fade" id="modal-cliente" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-cliente"
        aria-hidden="true">
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
                                            <h2 class="titulos">Seleccionar otro día para asistencia</h2>
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
