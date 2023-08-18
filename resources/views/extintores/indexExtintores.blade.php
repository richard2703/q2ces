@extends('layouts.main', ['activePage' => 'inventario', 'titlePage' => __('Inventario')])
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header bacTituloPrincipal">
                                    <h4 class="card-title">Inventario de Extintores</h4>
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

                                        <div class="col-6 text-right">

                                            <a href="{{ route('inventario.dash') }}">
                                                <button class="btn regresar">
                                                    <span class="material-icons">
                                                        reply
                                                    </span>
                                                    Regresar
                                                </button>
                                            </a>
                                        </div>

                                        <div class="col-6 pb-3 text-end">
                                            @can('inventario_create')
                                                <button type="button" class="btn botonGral" data-bs-toggle="modal"
                                                    data-bs-target="#nuevoItem" type="button" class="btn botonGral"
                                                    onclick="cargaItem('','','','','','','','','','','','{{ false }}' )">Añadir
                                                    al Inventario</button>
                                            @endcan
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead class="labelTitulo">
                                                <th class="labelTitulo text-center">Código</th>
                                                <th class="labelTitulo text-center">Serie</th>
                                                <th class="labelTitulo text-center">Capacidad</th>
                                                <th class="labelTitulo text-center">Última Revisión</th>
                                                <th class="labelTitulo text-center">Próxima Revisión</th>
                                                <th class="labelTitulo text-center">Acciones</th>
                                            </thead>
                                            <tbody>
                                                @forelse ($extintores as $extintor)
                                                    <tr>
                                                        <td class="text-center">{{ $extintor->identificador }} </td>
                                                        <td class="text-center align-middle">{{ $extintor->serie }}</td>
                                                        <td class="text-center align-middle">{{ $extintor->capacidad }}
                                                        </td>
                                                        <td class="text-center align-middle">
                                                            {{ $extintor->ultimaRevision }}
                                                        </td>
                                                        <td class="text-center align-middle">
                                                            {{ $extintor->proximaRevision }}</td>
                                                        <td class="td-actions text-center align-middle">
                                                            @can('inventario_restock')
                                                                <a href="#" data-bs-toggle="modal"
                                                                    data-bs-target="#editItem"
                                                                    onclick="cargaItem('{{ $extintor->id }}','{{ $extintor->identificador }}','{{ $extintor->serie }}'
																	,'{{ $extintor->capacidad }}','{{ $extintor->ultimaRevision }}','{{ $extintor->proximaRevision }}'
																	,'{{ $extintor->tipo }}','{{ $extintor->ubicacionId }}','{{ $extintor->lugarId }}','{{ $extintor->comentario }}',
                                                                    '{{ $extintor->maquinariaId }}','{{ true }}' )">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="28"
                                                                        height="28" fill="currentColor"
                                                                        class="bi bi-card-text accionesIconos"
                                                                        viewBox="0 0 16 16">
                                                                        <path
                                                                            d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z" />
                                                                        <path
                                                                            d="M3 5.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 8zm0 2.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5z" />
                                                                    </svg>
                                                                </a>
                                                            @endcan
                                                            @can('inventario_edit')
                                                                <a href="#" data-bs-toggle="modal"
                                                                    data-bs-target="#editItem"
                                                                    onclick="cargaItem('{{ $extintor->id }}','{{ $extintor->identificador }}','{{ $extintor->serie }}',
                                                                    '{{ $extintor->capacidad }}','{{ $extintor->ultimaRevision }}','{{ $extintor->proximaRevision }}',
                                                                    '{{ $extintor->tipo }}','{{ $extintor->ubicacionId }}','{{ $extintor->lugarId }}','{{ $extintor->comentario }}',
                                                                    '{{ $extintor->maquinariaId }}','{{ false }}' )">
                                                                    <svg xmlns="http://www.w3.org/2000/svg " width="28"
                                                                        height="28" fill="currentColor"
                                                                        class="bi bi-pencil accionesIconos" viewBox="0 0 16 16">
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
                                    {{ $extintores->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Nueva Equipos MTQ-->
    <div class="modal fade" id="nuevoItem" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bacTituloPrincipal">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">&nbsp Nueva Extintor</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row d-flex" id="miFormulario" action="{{ route('extintores.store') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf

                        <div class=" col-12 col-sm-6 mb-3 ">
                            <label class="labelTitulo">Identificador:<span>*</span></label></br>
                            <input type="text" class="inputCaja" name="identificador" value="{{ old('identificador') }}"
                                placeholder="ej: MT-00">
                        </div>

                        <div class=" col-12 col-sm-6 mb-3 ">
                            <label class="labelTitulo">Serie:<span>*</span></label></br>
                            <input type="text" class="inputCaja" name="serie" value="{{ old('serie') }}"
                                placeholder="Especifique...">
                        </div>
                        <div class=" col-12 col-sm-6 mb-3 ">
                            <label class="labelTitulo">Capacidad:<span>*</span></label></br>
                            <input type="number" class="inputCaja" placeholder="Capacidad en kilos" name="capacidad"
                                step="0.01" value="{{ old('capacidad') }}">
                        </div>


                        <div class=" col-12 col-sm-6 mb-3 ">
                            <label class="labelTitulo">Última Revisión:<span>*</span></label></br>
                            <input type="date" class="inputCaja" placeholder="Especifique..." name="ultimaRevision"
                                value="{{ old('ultimaRevision') }}">
                        </div>

                        <div class=" col-12 col-sm-6 mb-3 ">
                            <label class="labelTitulo">Próxima Revisión:</label></br>
                            <input type="date" class="inputCaja" placeholder="Especifique..." name="proximaRevision"
                                value="{{ old('proximaRevision') }}">
                        </div>

                        <div class="col-12 col-sm-6 mb-3 ">
                            <label class="labelTitulo">Tipo:</label></br>
                            <input type="text" class="inputCaja" placeholder="A, B, C, D, K" name="tipo"
                                value="{{ old('tipo') }}">
                        </div>

                        <div class=" col-12 col-sm-6 mb-3 ">
                            <label class="labelTitulo">Ubicación:</label></br>
                            <select id="ubicaciontest" onchange="cargar()" name="ubicacionId" class="form-select">
                                <option value="">Seleccione</option>
                                @foreach ($ubicaciones as $ubicacion)
                                    <option value="{{ $ubicacion->id }}">
                                        {{ $ubicacion->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class=" col-12 col-sm-6  mb-3 ">
                            <label class="labelTitulo">Lugar o Maquinaría:</label></br>
                            <select id="lugar" name="lugarId" class="form-select">
                                <option value="">Seleccione</option>
                                {{--  @foreach ($ubicaciones as $ubicacion)
                                    <option value="{{ $ubicacion->id }}">
                                        {{ $ubicacion->nombre }}
                                    </option>
                                @endforeach  --}}
                            </select>
                        </div>

                        <div class=" col-12  my-3 ">
                            <label class="labelTitulo">Comentario: <span>*</span></label>
                            <textarea class="form-select" id="exampleFormControlTextarea1" rows="3" maxlength="1000" required
                                name="comentario" placeholder="Escribe aquí tus comentario."></textarea>
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

    <!-- Modal editar Equipos MTQ-->
    <div class="modal fade" id="editItem" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bacTituloPrincipal">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">&nbsp <span id="tituloModal">Editar</span>
                        Extintor</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row d-flex" id="miFormulario" action="{{ route('extintores.update', 0) }}"
                        method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <input type="hidden" name="id" id="id" value="">

                        <div class=" col-12 col-sm-6 mb-3 ">
                            <label class="labelTitulo">Identificador:<span>*</span></label></br>
                            <input type="text" class="inputCaja" id="identificador" name="identificador"
                                value="{{ old('identificador') }}" placeholder="ej: MT-00">
                        </div>

                        <div class=" col-12 col-sm-6 mb-3 ">
                            <label class="labelTitulo">Serie:<span>*</span></label></br>
                            <input type="text" class="inputCaja" name="serie" id="serie" value=""
                                placeholder="Especifique...">
                        </div>
                        <div class=" col-12 col-sm-6 mb-3 ">
                            <label class="labelTitulo">Capacidad:<span>*</span></label></br>
                            <input type="number" class="inputCaja" placeholder="Capacidad en kilos" id="capacidad"
                                name="capacidad" step="0.01" value="">
                        </div>


                        <div class=" col-12 col-sm-6 mb-3 ">
                            <label class="labelTitulo">Última Revisión:<span>*</span></label></br>
                            <input type="date" class="inputCaja" placeholder="Especifique..." id="ultimaRevision"
                                name="ultimaRevision" value="">
                        </div>

                        <div class=" col-12 col-sm-6 mb-3 ">
                            <label class="labelTitulo">Próxima Revisión:</label></br>
                            <input type="date" class="inputCaja" placeholder="Especifique..." id="proximaRevision"
                                name="proximaRevision" value="">
                        </div>

                        <div class="col-12 col-sm-6 mb-3 ">
                            <label class="labelTitulo">Tipo:</label></br>
                            <input type="text" class="inputCaja" placeholder="A, B, C, D, K" name="tipo"
                                id="tipo" value="">
                        </div>

                        <div class=" col-12 col-sm-6 mb-3 ">
                            <label class="labelTitulo">Ubicación:</label></br>
                            <select id="ubicacionId" onchange="cargar()" name="ubicacionId" class="form-select">
                                <option value="">Seleccione</option>
                                @foreach ($ubicaciones as $ubicacion)
                                    <option value="{{ $ubicacion->id }}">
                                        {{ $ubicacion->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class=" col-12 col-sm-6  mb-3 ">
                            <label class="labelTitulo">Lugar o Maquinaría:</label></br>
                            <select id="lugarId" name="lugarId" class="form-select">
                                <option value="">Seleccione</option>
                            </select>
                        </div>

                        <div class=" col-12  my-3 ">
                            <label class="labelTitulo">Comentario: <span>*</span></label>
                            <textarea class="form-select" rows="3" maxlength="1000" id="controlcomentario" name="comentario"
                                value="" placeholder="Escribe aquí tus comentario."></textarea>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <div id="guardar">
                                <button type="submit" class="btn botonGral">Guardar</button>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function cargaItem(id, identificador, serie, capacidad, ultimaRevision, proximaRevision, tipo, ubicacionId, lugarId,
            comentario, maquinariaId, modalTipo) {

            const txtId = document.getElementById('id');
            txtId.value = id;
            const contenedorBotonGuardar = document.getElementById('guardar');

            if (modalTipo) {
                contenedorBotonGuardar.style.display = 'none';
            } else {
                contenedorBotonGuardar.style.display = 'block';
            }

            const tituloModal = document.getElementById('tituloModal');
            if (modalTipo) {
                tituloModal.textContent = 'Ver';
            } else {
                tituloModal.textContent = 'Editar';
            }

            const txtIdentificador = document.getElementById('identificador');
            txtIdentificador.value = identificador;
            txtIdentificador.readOnly = modalTipo;

            const txtSerie = document.getElementById('serie');
            txtSerie.value = serie;
            txtSerie.readOnly = modalTipo;

            const txtCapacidad = document.getElementById('capacidad');
            txtCapacidad.value = capacidad;
            txtCapacidad.readOnly = modalTipo;

            const txtUltimaRevision = document.getElementById('ultimaRevision');
            txtUltimaRevision.value = ultimaRevision;
            txtUltimaRevision.readOnly = modalTipo;

            const txtProximaRevision = document.getElementById('proximaRevision');
            txtProximaRevision.value = proximaRevision;
            txtProximaRevision.readOnly = modalTipo;

            const txtTipo = document.getElementById('tipo');
            txtTipo.value = tipo;
            txtTipo.readOnly = modalTipo;

            const txtUbicacion = document.getElementById('ubicacionId');
            txtUbicacion.value = tipo;
            txtUbicacion.disabled = modalTipo;

            const txtLugar = document.getElementById('lugarId');
            txtLugar.value = tipo;
            txtLugar.disabled = modalTipo;

            const txtComentario = document.getElementById('controlcomentario');
            txtComentario.value = comentario;
            txtComentario.readOnly = modalTipo;

            const campos = document.querySelectorAll(
                'input[type="text"], textarea, input[type="date"],input[type="select"],input[type="number"]');
            // Aplicar color gris a los campos con readonly
            campos.forEach((campo) => {
                if (modalTipo) {
                    campo.readOnly = true;
                    campo.style.color = 'grey';
                } else {
                    campo.readOnly = false;
                    campo.style.color = 'initial';
                }
            });


            const txtUbicacionId = document.getElementById('ubicacionId');
            //txtUbicacionId.value = ubicacionId;

            for (let i = 0; i < txtUbicacionId.options.length; i++) {
                if (txtUbicacionId.options[i].value == ubicacionId) {
                    // txtUbicacionId.options[i].selected = true;
                    txtUbicacionId.selectedIndex = i;
                }
            }

            const txtLugarId = document.getElementById('lugarId');
            //txtLugarId.value = lugarId;
            var url = '{{ route('lugares.get', ':ubicacionid') }}';
            url = url.replace(':ubicacionid', txtUbicacionId.value);

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    // Actualiza las opciones en el select "lugar"
                    txtLugarId.innerHTML = '';
                    data.forEach(lugar => {
                        var option = document.createElement('option');
                        option.value = lugar.id;
                        option.textContent = lugar.nombre;
                        console.log(lugar.id, 'lugar', lugarId, 'maquinaria', maquinariaId);
                        if (lugar.id == parseInt(maquinariaId)) {
                            option.selected = true; // Esto seleccionará la opción por defecto
                        } else if (lugar.id == parseInt(lugarId)) {
                            option.selected = true; // Esto seleccionará la opción por defecto
                        }
                        txtLugarId.appendChild(option);
                    });

                });

        }
    </script>

    {{--  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>  --}}

    <script>
        function cargar() {
            const ubicacionSelect = document.getElementById('ubicaciontest');
            const lugarSelect = document.getElementById('lugar');

            var url = '{{ route('lugares.get', ':ubicacionid') }}';
            url = url.replace(':ubicacionid', ubicacionSelect.value);

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    // Actualiza las opciones en el select "lugar"
                    console.log(data);
                    lugarSelect.innerHTML = '';
                    data.forEach(lugar => {
                        console.log(lugar);
                        var option = document.createElement('option');
                        option.value = lugar.id;
                        option.textContent = lugar.nombre;
                        lugarSelect.appendChild(option);
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
