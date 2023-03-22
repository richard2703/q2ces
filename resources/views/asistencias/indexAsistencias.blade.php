@extends('layouts.main', ['activePage' => 'asistencias', 'titlePage' => __('Lista de asistencia')])
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header bacTituloPrincipal">
                                    <h4 class="card-title"><i class="bi bi-arrow-left-square"></i> Marzo <i
                                            class="bi bi-arrow-right-square"></i></h4>
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
                                        <div class="col-12 text-right">
                                            <a href="{{ route('asistencia.horasExtra') }}">
                                                <button type="button" class="btn botonGral">Horas Extra</button>
                                            </a>
                                            <a href="{{ route('asistencia.create') }}">
                                                <button type="button" class="btn botonGral">Asistencia</button>
                                            </a>
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
                                                <th class="labelTitulo">Ho ras Extra</th>
                                                <th class="labelTitulo ">Acciones</th>
                                            </thead>
                                            <tbody class="text-center">
                                                <tr>
                                                    <td>1542</td>
                                                    <td>Ricardo Rios</td>
                                                    <td>20</td>
                                                    <td>0</td>
                                                    <td>2</td>
                                                    <td>4</td>
                                                    <td class="td-actions">
                                                        {{-- @can('user_show') --}}
                                                        <a href="{{ route('asistencia.show') }}" class="">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="28"
                                                                height="28" fill="currentColor"
                                                                class="bi bi-card-text accionesIconos" viewBox="0 0 16 16">
                                                                <path
                                                                    d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z" />
                                                                <path
                                                                    d="M3 5.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 8zm0 2.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5z" />
                                                            </svg> </a>
                                                    </td>
                                                </tr>

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
