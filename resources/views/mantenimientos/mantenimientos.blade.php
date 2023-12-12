@extends('layouts.main', ['activePage' => 'mantenimiento', 'titlePage' => __('Bitácora de Mantenimientos')])
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bacTituloPrincipal">
                        <h4 class="card-title">Mantenimientos {{ $blnEsMtq == true ? 'MTQ' : '' }}</h4>
                    </div>
                    <div class="row">
                        <div class="d-flex p-3">
                            <div class="col-8 text-end mt-4">
                                <form
                                    action="{{ $blnEsMtq == false ? route('mantenimientos.index') : route('mantenimientos.indexMtq') }}"
                                    method="GET" id="filterForm">
                                    <div class="input-group">
                                        <label class="labelTitulo p-2">Estado: </label>
                                        <select name="estatus" id="estatus"
                                            style="background: #727176; color: white; font-weight: bold;"
                                            class="form-control" onchange="document.getElementById('filterForm').submit();">
                                            <option selected value="0">Todos</option>
                                            <option value="1" {{ request('estatus') == 1 ? 'selected' : '' }}>En
                                                Espera
                                            </option>
                                            <option value="2" {{ request('estatus') == 2 ? 'selected' : '' }}>
                                                Realizando
                                            </option>
                                            <option value="3" {{ request('estatus') == 3 ? 'selected' : '' }}>
                                                Terminado
                                            </option>
                                            <option value="4" {{ request('estatus') == 4 ? 'selected' : '' }}>
                                                Borrado
                                            </option>
                                        </select>
                                    </div>
                                </form>
                            </div>
                            <div class="col-4 text-end mt-4" style="margin-left:-20px">
                                @can('mantenimiento_create')
                                    <a
                                        href="{{ $blnEsMtq == true ? url('/mantenimientos/nuevo/mtq') : url('/mantenimientos/nuevo') }}">
                                        <!--Agregar ruta-->
                                        <button type="button" class="btn botonGral">Añadir Mantenimiento</button>
                                    </a>
                                @endcan
                            </div>

                        </div>
                    </div>
                    <div class="d-flex p-3 divBorder w-100" style="margin-top:-10px"></div>
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
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="labelTitulo">
                                    <tr>
                                        <th class="labelTitulo text-center">Folio</th>
                                        <th class="labelTitulo text-center">Equipo</th>
                                        <th class="labelTitulo text-center">Tipo</th>
                                        <th class="labelTitulo text-center">Fecha</th>
                                        <th class="labelTitulo text-center">Costo</th>
                                        <th class="labelTitulo text-center">Estatus</th>
                                        <th class="labelTitulo text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($vctMantenimientos as $item)
                                        <tr>
                                            <td class="text-center">
                                                <a href="{{ url('/mantenimientos/editar/' . $item->id) }}"
                                                    title="Editar el mantenimiento" class=""
                                                    style="color: blue">{{ str_pad($item->id, 4, '0', STR_PAD_LEFT) }}
                                                </a>
                                            </td>
                                            </td>
                                            <td class="text-center"><a href="#" title="{{ $item->titulo }}">
                                                    {{ $item->maquinaria }}</a> </td>
                                            <td class="text-center">{{ $item->tipoMantenimiento }} </td>
                                            <td class="text-center">{{ $item->fechaInicio }}</td>
                                            <td class="text-center">$ {{ number_format($item->costo, 2) }} </td>


                                            <td
                                                class=@switch($item->estadoId)
                                                @case(1)
                                                    'yellow'
                                                @break

                                                @case(2)
                                                    'green'

                                                @break

                                                @case(3)
                                                    'blue'
                                                @break

                                                @default
                                                'red'
                                            @endswitch>
                                                {{ $item->estado }}
                                            </td>

                                            <td class="td-actions text-center">
                                                {{-- @if ($item->estadoId == 3)
                                                    @can('mantenimiento_edit')
                                                        <a href="#" class="" data-bs-toggle="modal"
                                                            data-bs-target="#editarItem"
                                                            onclick="cargaItem('{{ $item->id }}','{{ $item->coordTaller }}','{{ $item->coordOperaciones }}','{{ $item->mecanico }}','{{ $item->responsable }}','{{ $item->imagenSellos }}')">
                                                            <i class="fas fa-sign-out-alt iconoTablas" title="Responsables"></i>
                                                        </a>
                                                    @endcan
                                                @endif --}}

                                                @can('mantenimiento_show')
                                                    <a href="{{ route('mantenimientos.show', $item->id) }}"
                                                        title="Ver el detalle del Mantenimiento" class="">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28"
                                                            fill="currentColor" class="bi bi-card-text accionesIconos mb-2"
                                                            viewBox="0 0 16 16">
                                                            <path
                                                                d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z" />
                                                            <path
                                                                d="M3 5.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 8zm0 2.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5z" />
                                                        </svg> </a>
                                                @endcan
                                                <form id="printForm" action="{{ route('printMantenimiento.get') }}" method="GET" style="display: inline-block;">
                                                    @can('mantenimiento_show')
                                                        <input type="hidden" name="mecanico" value="true">
                                                        <input type="hidden" name="id" value={{$item->id}}>

                                                        <input type="hidden" name="cordinadorTaller" value="true">
                                                        <input type="hidden" name="cordinadorOperaciones" value={{$item->id}}>

                                                        <input type="hidden" name="mecanicoFirma" value="true">
                                                        <input type="hidden" name="responsableEquipo" value={{$item->id}}>

                                                        @if ($item->estadoId == 3)
                                                            <button class="btnSinFondo" type="submit">
                                                                <i class="fas fa-print" style="color: #8caf48; font-size: x-large;"></i>
                                                            </button>
                                                        @endif

                                                    @endcan
                                                </form>

                                                <form id="printForm" action="{{ route('printMantenimiento.get') }}" method="GET" style="display: inline-block;">
                                                    @can('mantenimientoPrintCostos_show')
                                                        <input type="hidden" name="mecanico" value="false">
                                                        <input type="hidden" name="id" value={{$item->id}}>

                                                        <input type="hidden" name="cordinadorTaller" value="true">
                                                        <input type="hidden" name="cordinadorOperaciones" value={{$item->id}}>

                                                        <input type="hidden" name="mecanicoFirma" value="true">
                                                        <input type="hidden" name="responsableEquipo" value={{$item->id}}>

                                                        @if ($item->estadoId == 3)
                                                            <button class="btnSinFondo" type="submit">
                                                                <i class="fas fa-print" style="color: black; font-size: x-large;"></i>
                                                            </button>
                                                        @endif
                                                    @endcan
                                                </form>

                                                <form id="printForm" action="{{ route('documentoSelladoMantenimiento.index') }}" method="GET" style="display: inline-block;">
                                                    @can('mantenimientoPrintCostos_show')
                                                        <input type="hidden" name="mecanico" value="false">
                                                        <input type="hidden" name="id" value={{$item->id}}>

                                                        @if ($item->estadoId == 3)
                                                            <button class="btnSinFondo" type="submit">
                                                                <i class="fas fa-solid fa-file-signature" style="{{ $item->documentoSellado == 1 ? 'color: green; font-size: x-large;' : 'color: red; font-size: x-large;' }}"
                                                                ></i>
                                                            </button>
                                                        @endif
                                                    @endcan
                                                </form>

                                                @can('mantenimiento_edit')
                                                    <a href="{{ url('/mantenimientos/editar/' . $item->id) }}"
                                                        title="Editar el mantenimiento" class="">
                                                        <svg xmlns="http://www.w3.org/2000/svg " width="28" height="28"
                                                            fill="currentColor" title="Editar"
                                                            class="bi bi-pencil accionesIconos mb-2" viewBox="0 0 16 16">
                                                            <path
                                                                d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                                                        </svg>
                                                    </a>
                                                @endcan
                                                {{-- Solo si no esta terminado se puede eliminar --}}
                                                @can('mantenimientos_destroy')
                                                    <form action="{{ route('mantenimientos.destroy', $item->id) }}"
                                                        method="POST" style="display: inline-block;"
                                                        onsubmit="return confirm('¿Estas Seguro que Deseas Eliminar Este Mantenimiento y Toda la Información Relacionada?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btnSinFondo" type="submit" rel="tooltip">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="28"
                                                                height="28" fill="currentColor" title="Eliminar"
                                                                class="bi bi-x-circle mb-2" viewBox="0 0 16 16">
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
                                            <td colspan="6">Sin Registros.</td>
                                        </tr>
                                    @endforelse

                                </tbody>
                            </table>
                            <div class="card-footer d-flex justify-content-center">
                                {{ $vctMantenimientos->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <!-- Modal Editar  Tarea-->
    <div class="modal fade" id="editarItem" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bacTituloPrincipal">

                    <h1 class="modal-title fs-5" id="exampleModalLabel">&nbsp <span id="tituloModal">Editar
                            Información de Control</label>
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row d-flex" action="{{ route('mantenimientos.update', 0) }}" method="post">
                        @csrf
                        @method('put')
                        <input type="hidden" name="controlId" id="id" value="">

                        <div class=" col-12  mb-3 ">
                            <label class="labelTitulo">Coordinador de Taller :</label></br>
                            <input type="text" class="inputCaja" id="controlCoordTaller" name="coordTaller"
                                value="">
                        </div>

                        <div class=" col-12  mb-3 ">
                            <label class="labelTitulo">Coordinador de Operaciones:</label></br>
                            <input type="text" class="inputCaja" id="controlCoordOperaciones" name="coordOperaciones"
                                value="">
                        </div>

                        <div class=" col-12  mb-3 ">
                            <label class="labelTitulo">Mecánico:</label></br>
                            <input type="text" class="inputCaja" id="controlMecanico" name="mecanico"
                                value="">
                        </div>

                        <div class=" col-12  mb-3 ">
                            <label class="labelTitulo">Responsable:</label></br>
                            <input type="text" class="inputCaja" id="controlResponsable" name="responsable"
                                value="">
                        </div>


                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <div id="contenedorBotonGuardar">
                                <button type="submit" class="btn botonGral" id="btnTareaGuardar">Guardar
                                    Cambios</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- <script>
        function cargaItem(id, coordTaller, coordOperaciones, mecanico, responsable, imagenSellos) {

            alert(coordTaller);
            const txtId = document.getElementById('controlId');

            const txtControl1 = document.getElementById('controlCoordTaller');
            txtControl1.value = coordTaller;

            const txtControl2 = document.getElementById('controlCoordOperaciones');
            txtControl2.value = coordOperaciones;

            const txtControl3 = document.getElementById('controlCoordOperaciones');
            txtControl3.value = coordOperaciones;

            const txtControl4 = document.getElementById('controlCoordOperaciones');
            txtControl4.value = coordOperaciones;

        }
    </script> --}}
@endsection
