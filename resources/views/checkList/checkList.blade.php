@extends('layouts.main', ['activePage' => 'checkList', 'titlePage' => __('checkList')])
@section('content')
    <?php
    $objValida = new Validaciones();
    ?>
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
                                        <div class="d-flex p-3 divBorder">

                                            <div class="col-12 text-end">
                                                <div>
                                                    @can('bitacora_create')
                                                        <a href="{{ route('bitacoras.index') }}">
                                                            <!--Agregar ruta-->
                                                            <button type="button"
                                                                class="btn botonGral float-end">Bitácoras</button>
                                                        </a>
                                                    @endcan
                                                </div>
                                                <div>
                                                    @can('checkList_create')
                                                        {{-- <a href="{{ route('checkList.seleccionar') }}">
                                                            <!--Agregar ruta-->
                                                            <button type="button" class="btn botonGral float-end">Añadir Nuevo
                                                                Checklist</button>
                                                        </a> --}}
                                                        <a href="#" class="" data-bs-toggle="modal"
                                                            data-bs-target="#nuevoCheckList" {{-- onclick="cargaItem('{{ $item->id }}','{{ $item->nombre }}','{{ $item->comentario }}')" --}}>
                                                            <button type="button" class="btn botonGral float-end">Añadir Nuevo
                                                                Checklist</button>
                                                        </a>
                                                    @endcan
                                                </div>
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

                                                            <a href="{{ route('checkListRegistros.show', $item->id) }}"
                                                                class="">
                                                                <svg xmlns="http://www.w3.org/2000/svg " width="28"
                                                                    height="28" fill="currentColor" title="Editar"
                                                                    class="bi bi-pencil accionesIconos" viewBox="0 0 16 16">
                                                                    <path
                                                                        d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                                                                </svg>
                                                            </a>

                                                            {{-- <form action="" method="POST"
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
                                                                </button> --}}
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
    <!-- Modal Editar Tarea-->
    <div class="modal fade" id="nuevoCheckList" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bacTituloPrincipal">

                    <h1 class="modal-title fs-5" id="exampleModalLabel">&nbsp Nuevo CheckList</label>
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row d-flex" action="{{ route('checkList.ejecutar') }}" method="get">
                        @csrf
                        <div class=" col-12 mb-3 ">
                            <label class="labelTitulo">Maquinaría:
                                <span>*</span></label></br>
                            <select id="maquinariaId" name="maquinariaId" class="form-select" required
                                aria-label="Default select example">
                                <option value="">Seleccione</option>
                                @foreach ($vctEquipos as $item)
                                    <option value="{{ $item->id }}">
                                        {{ strtoupper($item->identificador) . ' - ' . $objValida->ucwords_accent($item->nombre) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class=" col-12 mb-3 ">
                            <label class="labelTitulo">Bitácora:
                                <span>*</span></label></br>
                            <select id="bitacoraId" name="bitacoraId" class="form-select" required
                                aria-label="Default select example">
                                <option value="">Seleccione</option>
                                @foreach ($vctBitacoras as $item)
                                    <option value="{{ $item->id }}">
                                        {{ $objValida->ucwords_accent($item->nombre) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn botonGral" id="btnTareaGuardar">Ejecutar</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
