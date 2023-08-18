@extends('layouts.main', ['activePage' => 'obra', 'titlePage' => __('Alta de Clientes')])
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header bacTituloPrincipal">
                                    <h4 class="card-title">Clientes</h4>
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
                                    <div class="row divBorder">
                                        <div class="col-12 pb-3 text-end">
                                            @can('cliente_create')
                                                <a href="{{ route('clientes.create') }}">
                                                    <button type="button" class="btn botonGral">Añadir Cliente</button>
                                                </a>
                                            @endcan
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead class="labelTitulo">
                                                <th class="labelTitulo text-center">ID</th>
                                                <th class="labelTitulo text-center">Nombre</th>
                                                <th class="labelTitulo text-center">Razón Social</th>
                                                <th class="labelTitulo text-center">Colonia</th>
                                                <th class="labelTitulo text-center">Ciudad</th>
                                                <th class="labelTitulo text-center">Estado</th>
                                                <th class="labelTitulo text-center">Estatus</th>
                                                <th class="labelTitulo text-center">Acciones</th>
                                            </thead>
                                            <tbody>
                                                @forelse ($clientes as $cliente)
                                                    <tr>
                                                        <td class="text-center">{{ $cliente->id }}</td>
                                                        <td class="text-center">{{ $cliente->nombre }}</td>
                                                        <td class="text-center">{{ $cliente->razonSocial }}</td>
                                                        <td class="text-center">{{ $cliente->colonia }}</td>
                                                        <td class="text-center">{{ $cliente->estado }}</td>
                                                        <td class="text-center">{{ $cliente->estado }}</td>
                                                        <td class="text-center">{{ $cliente->estatus }}</td>

                                                        <td class="td-actions text-center">
                                                            @can('cliente_edit')
                                                                <a href="{{ route('clientes.edit', $cliente->id) }}"
                                                                    class="">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="28"
                                                                        height="28" fill="currentColor"
                                                                        class="bi bi-card-text accionesIconos"
                                                                        viewBox="0 0 16 16">
                                                                        <path
                                                                            d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                                                                    </svg>
                                                                </a>
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
                                    {{ $clientes->links() }}
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
