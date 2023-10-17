@extends('layouts.main', ['activePage' => 'equipos', 'titlePage' => __('Lista de Documentos')])
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bacTituloPrincipal">
                            <h4 class="card-title">Administrador de Almacenes y Tiraderos</h4>
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
                            <div class="row ">
                                <div class="col-12 col-lg-6 text-start mb-3">
                                    <a href="{{ route('catalogos.index') }}">
                                        <button class="btn regresar">
                                            <span class="material-icons">
                                                reply
                                            </span>
                                            Regresar
                                        </button>
                                    </a>
                                </div>
                                <div class="col-12 col-lg-6 pb-3 divAñadir">

                                    @can('catalogos_create')
                                        <a href="{{ route('almacenTiraderos.create') }}">
                                            <button type="button" class="btn botonGral align-it">Añadir Tipo</button>
                                        </a>
                                    @endcan
                                </div>
                            </div>
                            <div class="divBorder">
                                <p>Catálogo General de Almacenes y Tiraderos, Es Utilizado para Gestionar los Tiraderos y
                                    almacenes que se usan en los servicios.</p>
                            </div>

                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="labelTitulo">
                                        <th class="labelTitulo text-center">ID</th>
                                        <th class="labelTitulo text-center">Nombre</th>
                                        <th class="labelTitulo text-center">Tipo</th>
                                        <th class="labelTitulo text-center">Comentario</th>
                                        <th class="labelTitulo text-center">Acciones</th>
                                    </thead>
                                    <tbody>
                                        @forelse ($docs as $doc)
                                            <tr>
                                                <td class="text-center">{{ $doc->id }}</td>
                                                <td class="text-center">{{ $doc->nombre }}</td>
                                                <td class="text-center">{{ $doc->nombreTipo }}</td>
                                                <td class="text-center">{{ $doc->comentario }}</td>

                                                <td class="td-actions text-center">
                                                    @can('catalogos_edit')
                                                        <a href="{{ route('almacenTiraderos.edit', $doc->id) }}" class="">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="28"
                                                                height="28" fill="currentColor"
                                                                class="bi bi-card-text accionesIconos" viewBox="0 0 16 16">
                                                                <path
                                                                    d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                                                            </svg>
                                                        </a>
                                                    @endcan
                                                    @can('docs_destroy')
                                                        <form action="{{ route('almacenTiraderos.destroy', $doc->id) }}"
                                                            method="POST" style="display: inline-block;"
                                                            onsubmit="return confirm('Seguro?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btnSinFondo" type="submit" rel="tooltip">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="28"
                                                                    height="28" fill="currentColor" class="bi bi-x-circle"
                                                                    viewBox="0 0 16 16">
                                                                    <path
                                                                        d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                                    <path
                                                                        d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                                                                </svg>
                                                            </button>
                                                        </form>
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
                            {{ $docs->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/alertas.js') }}"></script>

    <script>
        var slug = '{{ Session::get('message') }}';
        if (slug == 1) {
            Guardado();

        }
    </script>
@endsection
