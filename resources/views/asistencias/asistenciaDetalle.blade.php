@extends('layouts.main', ['activePage' => 'asistencias', 'titlePage' => __('Asistencia Diaria')])
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header bacTituloPrincipal">
                                    <h4 class="card-title"><i class="bi bi-arrow-left-square"></i> Lunes 20 - Domingo 26 <i
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
                                                <th class="labelTitulo">Dia</th>
                                                <th class="labelTitulo">Horas Extra</th>
                                                <th class="labelTitulo">Asistencia</th>
                                                <th class="labelTitulo">Faltas</th>
                                                <th class="labelTitulo">Incapacidadades</th>
                                                <th class="labelTitulo">Vacaciones</th>
                                                <th class="labelTitulo">Descansos</th>
                                            </thead>
                                            <tbody class="text-center">
                                                <tr>
                                                    <td>Lunes</td>
                                                    <td><input type="number" name="horas" value="0"></td>
                                                    <td><input type="radio" name="Lunes" value="1" checked>
                                                    </td>
                                                    <td><input type="radio" name="Lunes" value="2"></td>
                                                    <td><input type="radio" name="Lunes" value="3"></td>
                                                    <td><input type="radio" name="Lunes" value="4"></td>
                                                    <td><input type="radio" name="Lunes" value="5"></td>
                                                </tr>
                                                <tr>
                                                    <td>Martes</td>
                                                    <td><input type="number" name="horas" value="3"></td>
                                                    <td><input type="radio" name="Martes" value="1" checked>
                                                    </td>
                                                    <td><input type="radio" name="Martes" value="2"></td>
                                                    <td><input type="radio" name="Martes" value="3"></td>
                                                    <td><input type="radio" name="Martes" value="4"></td>
                                                    <td><input type="radio" name="Martes" value="5"></td>
                                                </tr>
                                                <tr>
                                                    <td>Miercoles</td>
                                                    <td><input type="number" name="horas" value="0"></td>
                                                    <td><input type="radio" name="Miercoles" value="1" checked>
                                                    </td>
                                                    <td><input type="radio" name="Miercoles" value="2"></td>
                                                    <td><input type="radio" name="Miercoles" value="3"></td>
                                                    <td><input type="radio" name="Miercoles" value="4"></td>
                                                    <td><input type="radio" name="Miercoles" value="5"></td>
                                                </tr>
                                                <tr>
                                                    <td>Jueves</td>
                                                    <td><input type="number" name="horas" value="0"></td>
                                                    <td><input type="radio" name="Jueves" value="1" checked>
                                                    </td>
                                                    <td><input type="radio" name="Jueves" value="2"></td>
                                                    <td><input type="radio" name="Jueves" value="3"></td>
                                                    <td><input type="radio" name="Jueves" value="4"></td>
                                                    <td><input type="radio" name="Jueves" value="5"></td>
                                                </tr>
                                                <tr>
                                                    <td>Viernes</td>
                                                    <td><input type="number" name="horas" value="3"></td>
                                                    <td><input type="radio" name="Viernes" value="1" checked></td>
                                                    <td><input type="radio" name="Viernes" value="2"></td>
                                                    <td><input type="radio" name="Viernes" value="3"></td>
                                                    <td><input type="radio" name="Viernes" value="4"></td>
                                                    <td><input type="radio" name="Viernes" value="5"></td>
                                                </tr>
                                                <tr>
                                                    <td>Sabado</td>
                                                    <td><input type="number" name="horas" value="0"></td>
                                                    <td><input type="radio" name="Sabado" value="1"></td>
                                                    <td><input type="radio" name="Sabado" value="2"></td>
                                                    <td><input type="radio" name="Sabado" value="3"></td>
                                                    <td><input type="radio" name="Sabado" value="4"></td>
                                                    <td><input type="radio" name="Sabado" value="5" checked></td>
                                                </tr>
                                                <tr>
                                                    <td>Domingo</td>
                                                    <td><input type="number" name="horas" value="0"></td>
                                                    <td><input type="radio" name="Domingo" value="1"></td>
                                                    <td><input type="radio" name="Domingo" value="2"></td>
                                                    <td><input type="radio" name="Domingo" value="3"></td>
                                                    <td><input type="radio" name="Domingo" value="4"></td>
                                                    <td><input type="radio" name="Domingo" value="5" checked></td>
                                                </tr>
                                                <tr>
                                                    <td>Total</td>
                                                    <td>6</td>
                                                    <td>5</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>2</td>
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
