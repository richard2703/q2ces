@extends('layouts.main', ['activePage' => 'asistencias', 'titlePage' => __('Asistencia Diaria')])
<?php
$objCalendar = new Calendario();
$diaAnterior= $objCalendar->getMesAnterior($intMes,$intAnio);
$diaSiguiente= $objCalendar->getMesSiguiente($intMes,$intAnio);

?>
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header bacTituloPrincipal">
                                    <h4 class="card-title">
                                        <i class="bi bi-arrow-left-square">
                                            <a href="{{ url('calendario/'.$diaAnterior['year'].'/'.$diaAnterior['month']) }}" class="" title="Ir al mes anterior">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-caret-left-fill"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="m3.86 8.753 5.482 4.796c.646.566 1.658.106 1.658-.753V3.204a1 1 0 0 0-1.659-.753l-5.48 4.796a1 1 0 0 0 0 1.506z" />
                                                    </svg>

                                                </a>
                                        </i>
                                        Martes 21
                                        <i class="bi bi-arrow-right-square"></i>
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
                                        {{--  <div class="col-12 text-right">
                                            <a href="{{ route('personal.create') }}">
                                                <button type="button" class="btn botonGral">Asistencia</button>
                                            </a>
                                            <a href="{{ route('personal.create') }}">
                                                <button type="button" class="btn botonGral">Horas Extra</button>
                                            </a>
                                        </div>  --}}
                                    </div>
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
                                                <tr>
                                                    <td>1542</td>
                                                    <td>Ricardo Rios</td>
                                                    <td><input type="radio" name="Asistensia1542" value="1"></td>
                                                    <td><input type="radio" name="Asistensia1542" value="2"></td>
                                                    <td><input type="radio" name="Asistensia1542" value="3"></td>
                                                    <td><input type="radio" name="Asistensia1542" value="4"></td>
                                                    <td><input type="radio" name="Asistensia1542" value="5"></td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="card-footer mr-auto">

                                    <a href="{{ route('asistencia.index') }}">
                                        <button type="button" class="btn btn-danger">Cancelar</button>
                                    </a>
                                    <a href="#">
                                        <button type="button" class="btn botonGral">Guardar</button>
                                    </a>
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
