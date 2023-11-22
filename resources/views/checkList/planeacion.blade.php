@extends('layouts.main', ['activePage' => 'checkList', 'titlePage' => __('Programación y Asignación de Checklist')])
@section('content')
    <div class="content">
        <?php
        $objValida = new Validaciones();
        ?>
        @if ($errors->any())
            <!-- PARA LA CARGA DE LOS ERRORES DE LOS DATOS-->
            <div class="alert alert-danger">
                <p>Listado de errores a corregir</p>
                <ul>
                    @foreach ($errors->all() as $item)
                        <li>{{ $item }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12 align-self-center">
                    <div class="card">
                        <div class="card-header bacTituloPrincipal">
                            <h4 class="card-title">Planeación de Trabajo</h4>
                            {{-- <p class="card-category">Usuarios Registrados</p> --}}
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

                                    <div class="col-6 col-sm-6 col-lg-6 pb-6 text-end">
                                        <form action="{{ route('checkList.planeacion') }}" method="GET" id="filterForm">
                                            <div class="input-group">
                                                <label class="labelTitulo p-2">Frecuencia de Ejecución: </label>
                                                <select name="estatus" id="estatus"
                                                    style="background: #727176; color: white; font-weight: bold;"
                                                    class="form-control"
                                                    onchange="document.getElementById('filterForm').submit();">
                                                    <option selected value="0">Todos</option>
                                                    @foreach ($vctFilterFrecuencia as $item)
                                                        <option value="{{ $item->id }}" style="font-weight: bold;"
                                                            {{ request('estatus') == $item->id ? 'selected' : '' }}>
                                                            {{ $item->nombre }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </form>
                                        @if (is_array($vctDiasPeriodo) == true)
                                            <label class="labelTitulo">Periodo del
                                                {{ $vctDiasPeriodo[0]->format('Y-m-d') }} al
                                                {{ $vctDiasPeriodo[1]->format('Y-m-d') }}</label>
                                        @endif
                                    </div>
                                    <div class="col-6 text-end">
                                        <a href="{{ route('maquinaria.index') }}">
                                            <button class="btn regresar">
                                                <span class="material-icons">
                                                    reply
                                                </span>
                                                Regresar
                                            </button>
                                        </a>
                                        @can('checkList_assign_bitacoras')
                                            <button class="btn botonGral float-end" data-bs-toggle="modal"
                                                data-bs-target="#nuevoTrabajo">
                                                Añadir Trabajo
                                            </button>
                                        @endcan
                                    </div>
                                </div>

                                <form class="row alertaGuardar" action="{{ route('checkList.updatePlaneacion') }}"
                                    method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method('put')

                                    {{-- <input type="hidden" name="intAnio" value="{{ $intAnio }}">
                                <input type="hidden" name="intMes" value="{{ $intMes }}">
                                <input type="hidden" name="intDia" value="{{ $intDia }}">
                                <input type="hidden" name="fecha"
                                    value="{{ date_format($fechaSeleccionada, 'Y-m-d') }}">
                                <input type="hidden" name="horasExtra" value="0"> --}}


                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead class="labelTitulo">
                                                <th class="labelTitulo" style="width:50px">Folio</th>
                                                <th class="labelTitulo text-center">Maquinaría</th>
                                                <th class="labelTitulo text-center">CheckList</th>
                                                {{-- <th class="labelTitulo text-center">Frecuencia</th> --}}
                                                <th class="labelTitulo text-center">Personal</th>
                                                <th class="labelTitulo text-center" style="width:60px">Fecha</th>
                                                {{-- <th class="labelTitulo text-center" style="width:60px">Estatus</th> --}}
                                                {{-- <th class="labelTitulo text-center" style="width:120px">Acciones</th> --}}
                                            </thead>
                                            <tbody>
                                                @forelse ($vctRecords as $item)
                                                    <tr>
                                                        <td class="text-left">
                                                            <input type="hidden" name="id[]" id="id"
                                                                value="{{ $item->id }}">
                                                            {{ str_pad($item->id, 5, '0', STR_PAD_LEFT) }}
                                                        </td>
                                                        <td class="text-center"><a href="#"
                                                                title="{{ is_null($item->comentario) == true ? 'Sin comentarios' : $item->comentario }}">{{ $item->maquinaria }}</a>
                                                            <input type="hidden" name="maquinariaId[]" id="maquinariaId"
                                                                value="{{ $item->maquinariaId }}">
                                                            <input type="hidden" name="comentario[]" id="comentario"
                                                                value="{{ $item->comentario }}">
                                                            <input type="hidden" name="estatus[]" id="estatus"
                                                                value="{{ $item->estatus }}">
                                                        </td>

                                                        <td>
                                                            <input type="hidden" name="checkListId[]" id="checkListId"
                                                                value="{{ $item->checkListId }}">

                                                            <input type="hidden" name="bitacoraId[]" id="bitacoraId"
                                                                value="{{ $item->bitacoraId }}">

                                                            @if ($item->checkListId != '')
                                                                <a href="{{ route('checkList.show', $item->checkListId) }}"
                                                                    target="_blank"
                                                                    title="Ver la información del CheckList."
                                                                    style="color: blue">{{ $item->bitacora . ', Folio: ' . str_pad($item->checkListId, 5, '0', STR_PAD_LEFT) }}</a>
                                                            @else
                                                                {{ $item->bitacora }}
                                                            @endif
                                                            <label title="Estado del CheckList {{ ($item->estatus==1?'En Espera':($item->estatus==2?'Hecho':($item->estatus==3?'Terminado':'Cancelado'))) }}"
                                                                class=@switch($item->estatus)
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
                                                        @endswitch>[{{ $item->frecuencia }}]</label>
                                                        </td>
                                                        {{-- <td class="text-center">
                                                        {{ $item->frecuencia }}
                                                    </td> --}}
                                                        <td class="text-center">
                                                            @if ($item->estatus == 2)
                                                                <input type="text" class="inputCaja" id="personal"
                                                                    readonly disabled="true" name="personal"
                                                                    value="{{ $item->personal }}">
                                                                <input type="hidden" name="personalId[]" id="personalId"
                                                                    value="{{ $item->personalId }}">
                                                            @else
                                                                <select class="form-select" id="personalId"
                                                                    name="personalId[]" required>
                                                                    <option selected value="0">Seleccione</option>
                                                                    @foreach ($vctPersonal as $value)
                                                                        <option value="{{ $value->id }}"
                                                                            style="font-weight: bold;"
                                                                            {{ $item->personalId == $value->id ? 'selected' : '' }}>
                                                                            {{ $value->personal }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            @endif
                                                        </td>
                                                        <td class="text-center">
                                                            @if ($item->estatus == 2)
                                                                <input type="text" class="inputCaja"
                                                                    id="FechaTrabajado" readonly disabled="true"
                                                                    name="FechaTrabajado"
                                                                    value="{{ \Carbon\Carbon::parse($item->fecha)->format('Y-m-d') }}">

                                                                <input type="hidden" name="fecha[]" id="fecha"
                                                                    value="{{ \Carbon\Carbon::parse($item->fecha)->format('Y-m-d') }}">
                                                            @else
                                                                <input type="date" class="inputCaja "
                                                                    placeholder="Fecha" required
                                                                    min="{{ $vctDiasPeriodo[0]->format('Y-m-d') }}"
                                                                    max="{{ $vctDiasPeriodo[1]->format('Y-m-d') }}"
                                                                    {{ $item->estatus == 2 ? 'disabled="true"' : '' }}
                                                                    id="fecha" pattern="\d{4}-\d{2}-\d{2}"
                                                                    name="fecha[]"
                                                                    value="{{ $item->fecha != '' ? \Carbon\Carbon::parse($item->fecha)->format('Y-m-d') : '---' }}">
                                                            @endif

                                                        </td>
                                                    @empty
                                                    <tr>
                                                        <td  class="td-actions text-center" colspan="5">Sin Registros.</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="card-footer mr-auto">
                                        <a href="{{ route('checkList.index') }}">
                                            <button type="button" class="btn btn-danger">Cancelar</button>
                                        </a>
                                        @if (count($vctRecords) > 0)
                                            <a href="#">
                                                <button type="submit" class="btn botonGral">Guardar</button>
                                            </a>
                                        @endif
                                    </div>
                            </div>
                            <div class="card-footer d-flex justify-content-center">
                                {{-- {{ $vctRecords->links() }} --}}
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
