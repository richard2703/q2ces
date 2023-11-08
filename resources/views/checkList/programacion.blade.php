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
                            <h4 class="card-title">Asignación de Trabajo</h4>
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
                                    <div class="col-12 text-end">
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
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead class="labelTitulo">
                                            <th class="labelTitulo" style="width:50px">Folio</th>
                                            <th class="labelTitulo text-center">Maquinaría</th>
                                            <th class="labelTitulo text-center">Personal</th>
                                            <th class="labelTitulo text-center">CheckList</th>
                                            <th class="labelTitulo text-center" style="width:60px">Fecha</th>
                                            <th class="labelTitulo text-center" style="width:60px">Estatus</th>
                                            {{--  <th class="labelTitulo text-center">Sub Marca</th>  --}}
                                            <th class="labelTitulo text-center" style="width:120px">Acciones</th>
                                        </thead>
                                        <tbody>
                                            @forelse ($vctRecords as $item)
                                                <tr>
                                                    <td class="text-left">
                                                        {{--  --}}
                                                        {{ str_pad($item->id, 5, '0', STR_PAD_LEFT) }}
                                                    </td>
                                                    <td class="text-center"><a href="#"  title="{{ (is_null($item->comentario)==true? 'Sin comentarios':$item->comentario) }}">{{ $item->maquinaria }}</a> </td>
                                                    <td class="text-center">
                                                        {{ $item->personal }}</td>

                                                    <td class="text-center">
                                                        @if ($item->checkListId != '')
                                                            <a href="{{ route('checkList.show', $item->checkListId) }}"
                                                                title="Ver la información del CheckList."
                                                                style="color: blue">{{ $item->bitacora . ', Folio: ' . str_pad($item->checkListId, 5, '0', STR_PAD_LEFT) }}</a>
                                                        @else
                                                            {{ $item->bitacora }}
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        {{ $item->fecha != '' ? \Carbon\Carbon::parse($item->fecha)->format('Y-m-d') : '---' }}
                                                    </td>
                                                    <td
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
                                                        @endswitch>
                                                        @switch($item->estatus)
                                                            @case(1)
                                                                Espera
                                                            @break

                                                            @case(2)
                                                                Hecho
                                                            @break

                                                            @case(3)
                                                                Cerrado
                                                            @break

                                                            @default
                                                                Cancelado
                                                        @endswitch
                                                    </td>

                                                    <td class="td-actions text-center">
                                                        {{-- @can('maquinaria_show')
                                                            <a href="{{ route('maquinaria.vista', $item->id) }}"
                                                                class="">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="28"
                                                                    height="28" fill="currentColor"
                                                                    class="bi bi-card-text accionesIconos" viewBox="0 0 16 16">
                                                                    <path
                                                                        d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z" />
                                                                    <path
                                                                        d="M3 5.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 8zm0 2.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5z" />
                                                                </svg>
                                                            </a>
                                                        @endcan --}}
                                                        @can('checkList_execute')
                                                            <form action="{{ route('checkList.ejecutar') }}" method="get"
                                                                style="display: inline-block;"
                                                                onsubmit="return confirm('¿Seguro que desea ejecutar el CheckList programado?')">
                                                                @csrf
                                                                <input type="hidden" name="bitacoraId" id="bitacoraId"
                                                                    value="{{ $item->bitacoraId }}">
                                                                <input type="hidden" name="maquinariaId" id="maquinariaId"
                                                                    value="{{ $item->maquinariaId }}">
                                                                <input type="hidden" name="programacionId" id="programacionId"
                                                                    value="{{ $item->id }}">
                                                                <button class="btnSinFondo" type="submit" rel="tooltip"
                                                                    title="Ejecutar el CheckList">
                                                                    <i class="far fa-check-square fa-lg"
                                                                        style="color: #a6ce34;"></i>
                                                                </button>
                                                            </form>
                                                        @endcan
                                                        @if ($item->estatus == 1)
                                                            @can('checkList_edit')
                                                                <a href="#" data-bs-toggle="modal"
                                                                    data-bs-target="#editarTrabajo"
                                                                    title="Editar la Información de la Programación del CheckList"
                                                                    onclick="asignar(
                                                                    '{{ $item->id }}',
                                                                    '{{ $item->personalId }}',
                                                                    '{{ $item->bitacoraId }}',
                                                                    '{{ $item->maquinariaId }}',
                                                                    '{{ $item->fecha }}',
                                                                    '{{ $item->comentario }}' )">
                                                                    <svg xmlns="http://www.w3.org/2000/svg " width="28"
                                                                        height="28" fill="currentColor"
                                                                        class="bi bi-pencil accionesIconos" viewBox="0 0 16 16">
                                                                        <path
                                                                            d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                                                                    </svg>
                                                                </a>
                                                                {{-- Id:{{ $item->id }} --}}
                                                                {{-- Identificador:{{ $item->identificador }} --}}
                                                                {{-- Máquina:{{ $item->maquina }} --}}
                                                                {{-- Operador:{{ (is_null($item->operador) == false ? $item->operador:0) }} --}}
                                                                {{-- OperadorId:{{ (is_null($item->operadorId) == false ? $item->operadorId : 0) }} --}}
                                                                {{-- Obra:{{ (is_null($item->obra ) == false ? $item->obra : 0 )}} --}}
                                                                {{-- ObraId:{{ (is_null($item->comentario ) == false ? $item->comentario : '---' )}} --}}
                                                            @endcan
                                                        @endif
                                                        {{-- @can('maquinaria_destroy')
                                                        <form action="{{ route('maquinaria.delete', $item->id) }}"
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
                                                    </form>
                                                          @endcan --}}
                                                    </td>
                                                </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="8">Sin Registros.</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="card-footer d-flex justify-content-center">
                                    {{ $vctRecords->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Añadir -->
        <div class="modal fade" id="nuevoTrabajo" tabindex="-1" aria-labelledby="modalTitleId" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bacTituloPrincipal">
                        <h5 class="modal-title fs-5" id="modalTitleId">Asignar Trabajo</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('checkList.asignacion') }}" method="post">
                            @csrf
                            <div class="container-fluid">

                                <input type="hidden" name="estatus" id="estatus" value="1">

                                <div class="row">
                                    <div class="mb-3 col-12 text-center">
                                        <h3 class="labelTitulo fs-3" id="nombreTrabajo">Detalle del Trabajo</h3>
                                    </div>

                                    <div class="mb-3 col-12">
                                        <label for="personalId" class="labelTitulo">Personal: <span>*</span></label>
                                        <select name="personalId" id="personalId" required class="form-select" required>
                                            <option value="">Seleccione</option>
                                            @foreach ($vctPersonal as $item)
                                                <option value="{{ $item->id }}">
                                                    {{ $objValida->ucwords_accent($item->personal . ' [' . $item->puesto . ']') }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-3 col-12">
                                        <label for="bitacoraId" class="labelTitulo">Bitácora: <span>*</span></label>
                                        <select name="bitacoraId" id="NuevaBitacoraId" required class="form-select" required
                                            onchange="cargar('NuevaBitacoraId','NuevaMaquinariaId')">
                                            <option value="">Seleccione</option>
                                            @foreach ($vctBitacoras as $item)
                                                <option value="{{ $item->id }}">
                                                    {{ $objValida->ucwords_accent($item->nombre . ' [' . $item->frecuencia . ']') }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-3 col-12">
                                        <label for="maquinariaId" class="labelTitulo">Maquinaría:
                                            <span>*</span></label>
                                        <select name="maquinariaId" id="NuevaMaquinariaId" required class="form-select"
                                            required>
                                            <option value="">Seleccione</option>
                                            {{-- @foreach ($vctMaquinaria as $item)
                                                    <option value="{{ $item->id }}">
                                                        {{ $objValida->ucwords_accent($item->identificador . ' - ' . $item->nombre) }}
                                                    </option>
                                                @endforeach --}}
                                        </select>
                                    </div>

                                    <div class="mb-3 col-12">
                                        <label for="fecha" class="labelTitulo">Fecha: <span>*</span></label></br>
                                        <input type="date" class="inputCaja" id="fecha" name="fecha" required
                                            min="{{ date('Y-m-d') }}" pattern="\d{2}/\d{2}/\d{4}" placeholder="dd/mm/yyyy"
                                            value="">
                                    </div>

                                    <div class="mb-3 col-12">
                                        <label class="labelTitulo">Comentarios:</label></br>
                                        <textarea class="form-control" placeholder="Escribe tu comentario aquí sobre la revisión del CheckList"
                                            maxlength="1024" id="comentario" name="comentario" spellcheck="true"></textarea>
                                    </div>

                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn botonGral">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Editar -->
        <div class="modal fade" id="editarTrabajo" tabindex="-1" aria-labelledby="modalTitleId" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bacTituloPrincipal">
                        <h5 class="modal-title fs-5" id="modalTitleId">Editar Trabajo</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('checkList.updateAsignacion') }}" method="post">
                            @csrf
                            @method('put')
                            <div class="container-fluid">

                                <input type="hidden" name="estatus" id="EditEstatus" value="1">
                                <input type="hidden" name="controlId" id="EditId" value="1">

                                <div class="row">
                                    <div class="mb-3 col-12 text-center">
                                        <h3 class="labelTitulo fs-3" id="nombreTrabajo">Detalle del Trabajo</h3>
                                    </div>

                                    <div class="mb-3 col-12">
                                        <label for="personalId" class="labelTitulo">Personal: <span>*</span></label>
                                        <select name="personalId" id="EditPersonalId" required class="form-select" required>
                                            <option value="">Seleccione</option>
                                            @foreach ($vctPersonal as $item)
                                                <option value="{{ $item->id }}">
                                                    {{ $objValida->ucwords_accent($item->personal . ' [' . $item->puesto . ']') }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-3 col-12">
                                        <label for="bitacoraId" class="labelTitulo">Bitácora: <span>*</span></label>
                                        <select name="bitacoraId" id="EditBitacoraId" required class="form-select" required
                                            onchange="cargar('EditBitacoraId','EditMaquinariaId')">
                                            <option value="">Seleccione</option>
                                            @foreach ($vctBitacoras as $item)
                                                <option value="{{ $item->id }}">
                                                    {{ $objValida->ucwords_accent($item->nombre . ' [' . $item->frecuencia . ']') }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-3 col-12">
                                        <label for="maquinariaId" class="labelTitulo">Maquinaría:
                                            <span>*</span></label>
                                        <select name="maquinariaId" id="EditMaquinariaId" required class="form-select"
                                            required>
                                            <option value="">Seleccione</option>
                                            {{-- @foreach ($vctMaquinaria as $item)
                                                    <option value="{{ $item->id }}">
                                                        {{ $objValida->ucwords_accent($item->identificador . ' - ' . $item->nombre) }}
                                                    </option>
                                                @endforeach --}}
                                        </select>
                                    </div>

                                    <div class="mb-3 col-12">
                                        <label for="fecha" class="labelTitulo">Fecha: <span>*</span></label></br>
                                        <input type="date" class="inputCaja" id="EditFecha" name="fecha" required
                                            min="{{ date('Y-m-d') }}" pattern="\d{2}/\d{2}/\d{4}" placeholder="dd/mm/yyyy"
                                            value="">
                                    </div>

                                    <div class="mb-3 col-12">
                                        <label class="labelTitulo">Comentarios:</label></br>
                                        <textarea class="form-control" placeholder="Escribe tu comentario aquí sobre la revisión del CheckList"
                                            maxlength="1024" id="EditComentario" name="comentario" spellcheck="true"></textarea>
                                    </div>

                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn botonGral">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <script>
            function asignar(id, personalId, bitacoraId, maquinariaId, fecha, comentario) {

                console.log(id, personalId, bitacoraId, maquinariaId, fecha, comentario);

                const txtId = document.getElementById('EditId');
                txtId.value = id;

                const txtComentario = document.getElementById('EditComentario');
                txtComentario.value = comentario;

                const dteFechaFin = document.getElementById('EditFecha').value = fecha;

                const lstPersonal = document.getElementById('EditPersonalId').value = personalId;
                const lstBitacora = document.getElementById('EditBitacoraId').value = bitacoraId;

                cargar('EditBitacoraId', 'EditMaquinariaId');

                // después de 1/2 segundos para y ejecuta la seleccion
                setTimeout(() => {
                    const lstMaquinaria = document.getElementById('EditMaquinariaId').value = maquinariaId;
                }, 500);

                // // Obtener todos los campos del formulario
                // const campos = document.querySelectorAll('input[type="text"], textarea');

                // // Aplicar color gris a los campos con readonly
                // campos.forEach((campo) => {
                //     if (modalTipo) {
                //         campo.readOnly = true;

                //         // campo.style.cursor:no-drop;
                //     } else {
                //         campo.readOnly = false;
                //         campo.style.color = 'initial';
                //         // campo.style.cursor:no-drop;
                //     }
                //     if (campo == txtIdentificador) {
                //         campo.readOnly = true;
                //         campo.style.color = 'grey';
                //     }
                // });
            }
        </script>

        <script>
            function cargar(ctrlBitacora, ctrlMaquinaria) {

                const listaSeleccion = document.getElementById(ctrlBitacora);
                const ListaSeleccionar = document.getElementById(ctrlMaquinaria);
                var url = '{{ route('equiposPorBitacora.get', ':bitacoraId') }}';
                url = url.replace(':bitacoraId', listaSeleccion.value);

                fetch(url)
                    .then(response => response.json())
                    .then(data => {
                        // Actualiza las opciones en el select "item"
                        console.log(data);
                        ListaSeleccionar.innerHTML = '';
                        data.forEach(item => {
                            console.log(item);
                            var option = document.createElement('option');
                            option.value = item.maquinariaId;
                            option.textContent = item.maquinaria;
                            ListaSeleccionar.appendChild(option);
                        });

                    });

            };
        </script>

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
