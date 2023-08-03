@extends('layouts.main', ['activePage' => 'checkList', 'titlePage' => __('checkList')])
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header bacTituloPrincipal">
                                    <h4 class="card-title">Listado de CheckList</h4>
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
                                            <div>
                                                <a href="{{ url('/nuevaTareaCheck') }}">
                                                    <!--Agregar ruta-->
                                                    <button type="button" class="btn botonGral float-end">Añadir Nueva
                                                        Revisión</button>
                                                </a>
                                            </div>
                                            <div>
                                                <a href="{{ url('/checkList/nuevo' ) }}">
                                                    <!--Agregar ruta-->
                                                    <button type="button" class="btn botonGral float-end">Añadir Nuevo
                                                        Checklist</button>
                                                </a>

                                            </div>

                                        </div>

                                    </div>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead class="labelTitulo">
                                                <tr>
                                                    <th class="labelTitulo">Folio</th>
                                                    <th class="labelTitulo">Equipo</th>
                                                    <th class="labelTitulo">Bitácora</th>
                                                    <th class="labelTitulo">Registro</th>
                                                    <th class="labelTitulo">Fecha</th>

                                                    <th class="labelTitulo text-right">Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($records as $item)
                                                    <tr>
                                                        <td>{{ $item->id }}</td>
                                                        <td>{{ $item->maquinaria }} </td>

                                                        <td>{{ $item->bitacora }}</td>
                                                        <td>{{ $item->usuario }} </td>

                                                        <td>{{ $item->registrada }} </td>

                                                        <td class="td-actions text-right">

                                                            @can('checkList_show')
                                                                <a href="{{ route('checkList.show', $item->id) }}"
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

                                                            <a href="{{ route('checkListRegistros.show', $item->id) }}" class="">
                                                                <svg xmlns="http://www.w3.org/2000/svg " width="28"
                                                                    height="28" fill="currentColor" title="Editar"
                                                                    class="bi bi-pencil accionesIconos" viewBox="0 0 16 16">
                                                                    <path
                                                                        d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                                                                </svg>
                                                            </a>


                                                            <form action="" method="POST"
                                                                style="display: inline-block;"
                                                                onsubmit="return confirm('Seguro?')">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button class="btnSinFondo" type="submit" rel="tooltip">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="28"
                                                                        height="28" fill="currentColor" title="Eliminar"
                                                                        class="bi bi-x-circle" viewBox="0 0 16 16">
                                                                        <path
                                                                            d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                                        <path
                                                                            d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                                                                    </svg>
                                                                </button>
                                                            </form>
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
                                        <div class="card-footer mr-auto">
                                            {{ $records->links() }}
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
