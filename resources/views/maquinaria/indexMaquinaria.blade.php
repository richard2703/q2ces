@extends('layouts.main', ['activePage' => 'maquinaria', 'titlePage' => __('Lista de Maquinaria')])
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
                            <h4 class="card-title">Maquinaria</h4>
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
                                        @can('maquinaria_create')
                                            <a href="{{ route('maquinaria.create') }}">
                                                <button type="button" class="btn botonGral">Añadir Máquina</button>
                                            </a>
                                        @endcan
                                        @can('maquinaria_index')
                                            <a href="{{ route('maquinaria.distribucion') }}">
                                                <button type="button" class="btn botonGral">Distribución General</button>
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
                                            <th class="labelTitulo text-center" style="width:120px">Categoría</th>
                                            <th class="labelTitulo text-center">Uso</th>
                                            <th class="labelTitulo text-center">Placas</th>
                                            {{--  <th class="labelTitulo text-center">Sub Marca</th>  --}}
                                            <th class="labelTitulo text-center">Año</th>
                                            <th class="labelTitulo text-center" style="width:120px">Acciones</th>
                                        </thead>
                                        <tbody>
                                            @forelse ($maquinaria as $maquina)
                                                <tr>
                                                    <td class="text-center"><a
                                                            href="{{ route('maquinaria.vista', $maquina->id) }}"  title="Editar la información de la maquinaría."
                                                            style="color: blue">{{ $maquina->identificador }}</a></td>
                                                    <td class="text-center">{{ $maquina->marca }}</td>
                                                    <td class="text-center">{{ $maquina->modelo }}</td>
                                                    <td class="text-center">{{ $maquina->categoria }}</td>
                                                    <td class="text-center">{{ $maquina->uso }}</td>
                                                    <td class="text-center">{{ $maquina->placas }}</td>
                                                    {{--  <td class="text-center">{{ $maquina->submarca }}</td>  --}}
                                                    <td class="text-center">{{ $maquina->ano }}</td>

                                                    <td class="td-actions text-center">
                                                        @can('maquinaria_show')
                                                            <a href="{{ route('maquinaria.vista', $maquina->id) }}"
                                                                class="" title="Ver el detalle de la maquinaría.">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="28"
                                                                    height="28" fill="currentColor"
                                                                    class="bi bi-card-text accionesIconos" viewBox="0 0 16 16">
                                                                    <path
                                                                        d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z" />
                                                                    <path
                                                                        d="M3 5.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 8zm0 2.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5z" />
                                                                </svg>
                                                            </a>
                                                        @endcan
                                                        @can('maquinaria_edit')
                                                            <a href="{{ route('maquinaria.show', $maquina->id) }}"
                                                                class="" title="Editar la información de la maquinaría.">
                                                                <svg xmlns="http://www.w3.org/2000/svg " width="28"
                                                                    height="28" fill="currentColor"
                                                                    class="bi bi-pencil accionesIconos" viewBox="0 0 16 16">
                                                                    <path
                                                                        d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                                                                </svg>
                                                            </a>
                                                        @endcan
                                                        @can('maquinaria_assign_personal')
                                                            <a href="#" data-bs-toggle="modal" data-bs-target="#asignar" title="Asignar Obra y/o Operador a la maquinaría."
                                                                onclick="asignar(
                                                                    '{{ $maquina->id }}',
                                                                    '{{ $maquina->identificador }}',
                                                                    '{{ $maquina->maquina }}',
                                                                    '{{ is_null($maquina->operador) == false ? $maquina->operador : 0 }}',
                                                                    '{{ is_null($maquina->operadorId) == false ? $maquina->operadorId : 0 }}',
                                                                    '{{ is_null($maquina->obra) == false ? $maquina->obra : 0 }}',
                                                                    '{{ is_null($maquina->obraId) == false ? $maquina->obraId : 0 }}',
                                                                    '{{ is_null($maquina->cargaCombustible) == false ? $maquina->cargaCombustible : 0 }}',
                                                                    '{{ is_null($maquina->fechaInicial) == false ? \Carbon\Carbon::parse($maquina->fechaInicial)->format('Y-m-d') : 0 }}',
                                                                    '{{ is_null($maquina->fechaFinal) == false ? \Carbon\Carbon::parse($maquina->fechaFinal)->format('Y-m-d') : 0 }}',
                                                                    '{{ is_null($maquina->recordId) == false ? $maquina->recordId : 0 }}'

                                                                    )">
                                                                <i class="fas fa-user-check iconoTablas"></i>
                                                            </a>
                                                            {{-- Id:{{ $maquina->id }} --}}
                                                            {{-- Identificador:{{ $maquina->identificador }} --}}
                                                            {{-- Maquina:{{ $maquina->maquina }} --}}
                                                            {{-- Operador:{{ (is_null($maquina->operador) == false ? $maquina->operador:0) }} --}}
                                                            {{-- OperadorId:{{ (is_null($maquina->operadorId) == false ? $maquina->operadorId : 0) }} --}}
                                                            {{-- Obra:{{ (is_null($maquina->obra ) == false ? $maquina->obra : 0 )}} --}}
                                                            {{-- ObraId:{{ (is_null($maquina->obraId ) == false ? $maquina->obraId : 0 )}} --}}
                                                        @endcan
                                                        {{-- @can('maquinaria_destroy') --}}
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
                                                    <td colspan="2">Sin Registros.</td>
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

            <!-- Modal Asignar-->
            <div class="modal fade" id="asignar" tabindex="-1" aria-labelledby="modalTitleId" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header bacTituloPrincipal">
                            <h5 class="modal-title fs-5" id="modalTitleId">Asignar Vehículo</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('maquinaria.asignacion') }}" method="post">
                                @csrf
                                @method('put')
                                <div class="container-fluid">

                                    <input type="hidden" name="maquinariaId" id="asignacionMaquinaria">

                                    <div class="row">
                                        <div class="mb-3 col-12 text-center">
                                            <h3 class="labelTitulo fs-3" id="nombreAuto">Asignar Vehículo</h3>
                                        </div>

                                        <div class="mb-3 col-6">
                                            <label for="obraAsignada" class="labelTitulo">Asignado en la Obra:</label>
                                            <input type="hidden" name="obraId" id="obraId">
                                            <input type="hidden" name="recordId" id="recordId">
                                            <input type="hidden" name="usuarioId" id="usuarioId"
                                                value="{{ auth()->user()->id }}">
                                            <input autofocus type="text" class="inputCaja" id="obraAsignada"
                                                name="obraAsignada" placeholder="Nombre Obra..." readonly>
                                        </div>

                                        <div class="mb-3 col-6">
                                            <label for="NobraId" class="labelTitulo">Asignar a la Obra:</label>
                                            <select name="NobraId" id="NobraId" required class="form-select">
                                                <option value="0">Sin Cambios</option>
                                                {{-- <option value="">Denegar Obra</option> --}}
                                                @foreach ($vctObras as $item)
                                                    <option value="{{ $item->id }}">
                                                        {{ $objValida->ucwords_accent($item->nombre . ' [' . $item->cliente . ']') }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="mb-3 col-6">
                                            <label for="personalAsignado" class="labelTitulo">Asignado al
                                                Operador:</label>
                                            <input type="hidden" name="personalId" id="personalId">
                                            <input autofocus type="text" class="inputCaja" id="personalAsignado"
                                                name="personalAsignado" placeholder="Nombre Equipo..." readonly>
                                        </div>

                                        <div class="mb-3 col-6">
                                            <label for="NpersonalId" class="labelTitulo">Asignar al Operador:</label>
                                            <select name="NpersonalId" id="NpersonalId" required class="form-select">
                                                <option value="0">Sin Cambios</option>
                                                <option value="-1">Denegar Equipo</option>
                                                @foreach ($vctOperarios as $item)
                                                    <option value="{{ $item->id }}">
                                                        {{ $objValida->ucwords_accent($item->personal . ' [' . $item->puesto . ']') }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>


                                        <div class="mb-3 col-4">
                                            <label for="combustible" class="labelTitulo">Combustible:</label></br>
                                            <select class="form-select" aria-label="Default select example"
                                                id="combustible" name="combustible">
                                                <option value="0">No</option>
                                                <option value="1">Sí</option>
                                            </select>
                                        </div>

                                        <div class="mb-3 col-4">
                                            <label for="inicio" class="labelTitulo">Fecha de Inicio:</label></br>
                                            <input type="date" class="inputCaja" id="inicio" name="inicio"
                                                pattern="\d{2}/\d{2}/\d{4}" placeholder="dd/mm/yyyy" value="">
                                        </div>

                                        <div class="mb-3 col-4">
                                            <label for="fin" class="labelTitulo">Fecha de Término:</label></br>
                                            <input type="date" class="inputCaja" id="fin" name="fin"
                                                pattern="\d{2}/\d{2}/\d{4}" placeholder="dd/mm/yyyy" value="">
                                        </div>


                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Cerrar</button>
                                    <button type="submit" class="btn botonGral">Guardar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                function asignar(id, identificador, maquinaria, operador, operadorId, obra, obraId, combustible, inicio, fin,
                    recordId) {

                    console.log(id, identificador, maquinaria, operador, operadorId, obra, obraId, combustible, inicio, fin);

                    const txtId = document.getElementById('asignacionMaquinaria');
                    txtId.value = id;

                    const txtRId = document.getElementById('recordId');
                    txtRId.value = recordId;

                    const txtOperadorA = document.getElementById('personalId');
                    txtOperadorA.value = operadorId;

                    const txtOperadorB = document.getElementById('personalAsignado');
                    txtOperadorB.value = operador;
                    txtOperadorB.readOnly = true;

                    const tituloModal = document.getElementById('nombreAuto');
                    tituloModal.textContent = identificador + ' ' + maquinaria;

                    const txtObraA = document.getElementById('obraId');
                    txtObraA.value = obraId;

                    const txtObraB = document.getElementById('obraAsignada');
                    txtObraB.value = obra;
                    txtObraB.readOnly = true;

                    const lstCombustible = document.getElementById('combustible').value = combustible;
                    const dteFechaInicio = document.getElementById('inicio').value = inicio;
                    const dteFechaFin = document.getElementById('fin').value = fin;



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
