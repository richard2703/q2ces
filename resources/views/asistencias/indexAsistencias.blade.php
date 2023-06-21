@extends('layouts.main', ['activePage' => 'asistencias', 'titlePage' => __('Lista de Asistencia Mensual Acumulada')])
<?php
$objCalendar = new Calendario();
$mesAnterior = $objCalendar->getMesAnterior($intMes, $intAnio);
$mesSiguiente = $objCalendar->getMesSiguiente($intMes, $intAnio);
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
                                        <!-- Un mes atras del cargado -->
                                        <span>
                                            <a href="{{ url('asistencia/' . $mesAnterior['year'] . '/' . $mesAnterior['month']) }}"
                                                class="" title="Ir al mes anterior">
                                                <i class="bi bi-arrow-left-square"></i>
                                            </a>
                                            <!-- Para el mes en curso -->
                                        </span>
                                        &nbsp;&nbsp;&nbsp;
                                        {{ $objCalendar->getNameMonth($intMes) }} {{ $intAnio }}
                                        &nbsp;&nbsp;&nbsp;
                                        <!-- Un mes adelante del cargado -->
                                        <span>
                                            <a href="{{ url('asistencia/' . $mesSiguiente['year'] . '/' . $mesSiguiente['month']) }}"
                                                class="" title="Ir al mes siguiente">
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
                                        <span>
                                            <a href="{{ route('asistencia.index') }}" class="display-8 mb-8 text-center"
                                                title="Ir al mes en curso"><b>Hoy es
                                                    {{ $objCalendar->getFechaFormateada(date_create(date('Y-m-d'))) }}</b>
                                            </a>
                                        </span>
                                        <div class="col-4 text-left">
                                            @can('asistencia_cortesemanal')
                                                <a href="{{ route('asistencia.corteSemanal') }}">
                                                    <button type="button" class="btn botonGral">Corte Semanal</button>
                                                </a>
                                            @endcan
                                        </div>

                                        <div class="col-8 text-right">
                                            @can('asistencia_horasextra')
                                                <a href="{{ route('asistencia.horasExtra') }}">
                                                    <button type="button" class="btn botonGral">Horas Extra</button>
                                                </a>
                                            @endcan
                                            @can('asistencia_create')
                                                <a href="{{ route('asistencia.create') }}">
                                                    <button type="button" class="btn botonGral">Asistencia</button>
                                                </a>
                                            @endcan


                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead class="labelTitulo text-center">
                                                <th class="labelTitulo">Codigo</th>
                                                <th class="labelTitulo">Nombre</th>
                                                <th class="labelTitulo">Asistencia</th>
                                                <th class="labelTitulo">Faltas</th>
                                                <th class="labelTitulo">Otros Dias</th>
                                                <th class="labelTitulo">Horas Extra</th>
                                                <th class="labelTitulo ">Acciones</th>
                                            </thead>
                                            <tbody class="text-center">

                                                @forelse ($personal as $item)
                                                    <tr>
                                                        <td style="color: {{ $item->estatusColor }};">
                                                            <strong>{{ $item->numNomina }}</strong>
                                                        </td>
                                                        <td class="text-left">{{ $item->apellidoP }}
                                                            {{ $item->apellidoM }}, {{ $item->nombres }}</td>
                                                        <td>{{ $item->asistencias }}</td>
                                                        <td>{{ $item->faltas }}</td>
                                                        <td>{{ $item->incapacidades + $item->vacaciones + $item->descansos }}
                                                        </td>
                                                        <td>{{ $item->extras }}</td>
                                                        <td class="td-actions">
                                                            @can('asistencia_show')
                                                                <a href="{{ route('asistencia.show', $item->id) }}"
                                                                    class="">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="28"
                                                                        height="28" fill="currentColor"
                                                                        class="bi bi-card-text accionesIconos"
                                                                        viewBox="0 0 16 16">
                                                                        <path
                                                                            d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z" />
                                                                        <path
                                                                            d="M3 5.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 8zm0 2.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5z" />
                                                                    </svg> </a>
                                                            @endcan
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
                                </div>
                                <div class="card-footer mr-auto">
                                    {{--  {{ $personal->links() }}  --}}
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
