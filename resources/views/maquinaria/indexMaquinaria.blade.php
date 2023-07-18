@extends('layouts.main', ['activePage' => 'equipos', 'titlePage' => __('Lista de Maquinaria')])
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row justify-content-center ">
                <div class="col-md-11 align-self-center">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header bacTituloPrincipal">
                                    <h4 class="card-title">Maquinaria</h4>
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
                                    <div class="d-flex p-3 divBorder">
                                        <div class="col-12 text-end">
                                            @can('maquinaria_create')
                                                <a href="{{ route('maquinaria.create') }}">
                                                    <button type="button" class="btn botonGral">Añadir Maquina</button>
                                                </a>
                                            @endcan
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead class="labelTitulo">
                                                <th class="labelTitulo text-center">ID</th>
                                                <th class="labelTitulo text-center">Marca</th>
                                                <th class="labelTitulo text-center">Modelo</th>
                                                <th class="labelTitulo text-center" style="width:120px">Categoria </th>
                                                <th class="labelTitulo text-center">Uso</th>
                                                <th class="labelTitulo text-center">placas</th>
                                                <th class="labelTitulo text-center">ID</th>
                                                <th class="labelTitulo text-center">Marca</th>
                                                <th class="labelTitulo text-center">Modelo</th>
                                                <th class="labelTitulo text-center" style="width:120px">Categoria </th>
                                                <th class="labelTitulo text-center">Uso</th>
                                                <th class="labelTitulo text-center">placas</th>
                                                <th class="labelTitulo text-center" style="width:120px">Acciones</th>
                                            </thead>
                                            <tbody>
                                                @forelse ($maquinaria as $maquina)
                                                    <tr>
                                                        <td class="text-center">{{ $maquina->identificador }}</td>
                                                        <td class="text-center">{{ $maquina->marca }}</td>
                                                        <td class="text-center">{{ $maquina->modelo }}</td>
                                                        <td class="text-center">{{ $maquina->categoria }}</td>
                                                        <td class="text-center">{{ $maquina->uso }}</td>
                                                        <td class="text-center">{{ $maquina->placas }}</td>
                                                        <td class="text-center">{{ $maquina->identificador }}</td>
                                                        <td class="text-center">{{ $maquina->marca }}</td>
                                                        <td class="text-center">{{ $maquina->modelo }}</td>
                                                        <td class="text-center">{{ $maquina->categoria }}</td>
                                                        <td class="text-center">{{ $maquina->uso }}</td>
                                                        <td class="text-center">{{ $maquina->placas }}</td>

                                                        <td class="td-actions text-center">
                                                            {{-- @can('user_show') --}}
                                                            {{-- <a href="{{ route('maquinaria.show', $maquina->id) }}"  class="">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-card-text accionesIconos" viewBox="0 0 16 16">
                                                                    <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                                                                    <path d="M3 5.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 8zm0 2.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5z"/>
                                                                </svg>
                                                            </a> --}}
                                                            {{-- @endcan --}}
                                                            @can('maquinaria_edit')
                                                                <a href="{{ route('maquinaria.show', $maquina->id) }}"
                                                                    class="">
                                                                    <svg xmlns="http://www.w3.org/2000/svg " width="28"
                                                                        height="28" fill="currentColor"
                                                                        class="bi bi-pencil accionesIconos" viewBox="0 0 16 16">
                                                                        <path
                                                                            d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                                                                    </svg>
                                                                </a>
                                                            @endcan
                                                            {{-- @can('user_destroy') --}}
                                                            {{-- <form action="{{ route('maquinaria.delete', $maquina->id) }}"
                                                                method="POST" style="display: inline-block;"
                                                                onsubmit="return confirm('Seguro?')">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button class="btnSinFondo" type="submit" rel="tooltip">
                                                                    <svg xmlns="http://www.w3.org/2000/svg"  width="28" height="28"  fill="currentColor"  class="bi bi-x-circle"  viewBox="0 0 16 16">
                                                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                                                                    </svg>
                                                                </button>
                                                            </form> --}}
                                                            {{-- @endcan --}}
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
                                <div class="card-footer d-flex justify-content-center">
                                    {{ $maquinaria->links() }}
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
