@extends('layouts.main', ['activePage' => 'equipos', 'titlePage' => __('Lista De Servicios')])
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bacTituloPrincipal">
                            <h4 class="card-title">Servicios MTQ</h4>
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
                                    <div class="col-12 text-right">

                                        <a href="{{ route('catalogos.index') }}">
                                            <button class="btn regresar">
                                                <span class="material-icons">
                                                    reply
                                                </span>
                                                Regresar
                                            </button>
                                        </a>

                                        @can('ubicaciones_create')
                                            <button class="btn botonGral float-end" data-bs-toggle="modal"
                                                data-bs-target="#nuevoItem" onclick="cargaItem(' ',' ',' ',' ',' ','')">
                                                Añadir Un Servicio
                                            </button>
                                        @endcan
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="labelTitulo">
                                        <tr>
                                            <th class="labelTitulo text-center">Codigo</th>
                                            <th class="labelTitulo text-center">Nombre</th>
                                            <th class="labelTitulo text-center">Color</th>
                                            <th class="labelTitulo text-center" style="width:150px">Comentarios</th>
                                            <th class="labelTitulo text-center" style="width:140px">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($servicios as $item)
                                            <tr>
                                                <td class="text-center">{{ $item->codigo }}</td>
                                                <td class="text-center">{{ $item->nombre }}</td>
                                                <td class="text-center"
                                                    style="
                                                font-weight: bold;
                                                background: {{ $item->color }};
                                            ">
                                                    {{ $item->color }}</td>
                                                <td class="text-center">{{ $item->comentario }}</td>

                                                <td class="td-actions text-center">
                                                    @can('ubicaciones_show')
                                                        <a href="#" data-bs-toggle="modal" data-bs-target="#editarItem"
                                                            onclick="cargaItem('{{ $item->id }}','{{ $item->codigo }}','{{ $item->nombre }}','{{ $item->color }}','{{ $item->comentario }}','{{ true }}')">
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
                                                    @can('ubicaciones_edit')
                                                        <a href="#" class="" data-bs-toggle="modal"
                                                            data-bs-target="#editarItem"
                                                            onclick="cargaItem('{{ $item->id }}','{{ $item->codigo }}','{{ $item->nombre }}','{{ $item->color }}','{{ $item->comentario }}','{{ false }}')">
                                                            <svg xmlns="http://www.w3.org/2000/svg " width="28"
                                                                height="28" fill="currentColor"
                                                                class="bi bi-pencil accionesIconos" viewBox="0 0 16 16">
                                                                <path
                                                                    d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                                                            </svg>
                                                        </a>
                                                    @endcan
                                                    {{-- @can('ubicaciones_destroy') --}}
                                                    {{-- <form action="{{ route('puestos.delete', $item->id) }}"
                                                    method="POST" style="display: inline-block;"
                                                    onsubmit="return confirm('Seguro?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btnSinFondo" type="submit" rel="tooltip">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="28"
                                                            height="28" fill="currentColor"
                                                            class="bi bi-x-circle" viewBox="0 0 16 16">
                                                            <path
                                                                d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                            <path
                                                                d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
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
                            <div class="card-footer mr-auto d-flex justify-content-center">
                                {{ $servicios->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Nueva Tarea-->
    <div class="modal fade" id="nuevoItem" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bacTituloPrincipal">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">&nbsp Añadir Servicio</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row d-flex" action="{{ route('serviciosMtq.store') }}" method="post">
                        @csrf
                        <div class=" col-12 col-sm-6 mb-3 ">
                            <label class="labelTitulo">Codigo:<span>*</span></label></br>
                            <input type="text" class="inputCaja" name="codigo" value="{{ old('codigo') }}"
                                placeholder="ej: MT-00">
                        </div>

                        <div class=" col-12 col-sm-6 mb-3 ">
                            <label class="labelTitulo">Nombre:<span>*</span></label></br>
                            <input type="text" class="inputCaja" name="nombre" value="{{ old('nombre') }}"
                                placeholder="Especifique...">
                        </div>
                        <div class=" col-12 col-sm-6 mb-3 ">
                            <label class="labelTitulo">Color:<span>*</span></label></br>
                            <input type="color" class="inputCaja" name="color" value="{{ old('color') }}">
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

    <!-- Modal Editar  Tarea-->
    <div class="modal fade" id="editarItem" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bacTituloPrincipal">

                    <h1 class="modal-title fs-5" id="exampleModalLabel">&nbsp <span id="tituloModal">Editar</span>
                        Ubicación</label>
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row d-flex" action="{{ route('serviciosMtq.update', 0) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <input type="hidden" name="servicioId" id="servicioId" value="">
                        <div class=" col-12 col-sm-6 mb-3 ">
                            <label class="labelTitulo">Codigo:<span>*</span></label></br>
                            <input type="text" class="inputCaja" name="codigo" id="codigo"
                                value="{{ old('codigo') }}" placeholder="ej: MT-00">
                        </div>

                        <div class=" col-12 col-sm-6 mb-3 ">
                            <label class="labelTitulo">Nombre:<span>*</span></label></br>
                            <input type="text" class="inputCaja" name="nombre" id="nombre"
                                value="{{ old('nombre') }}" placeholder="Especifique...">
                        </div>
                        <div class=" col-12 col-sm-6 mb-3 ">
                            <label class="labelTitulo">Color:<span>*</span></label></br>
                            <input type="color" class="inputCaja" name="color" id="color"
                                value="{{ old('color') }}">
                        </div>

                        <div class=" col-12  my-3 ">
                            <label class="labelTitulo">Comentario: <span>*</span></label>
                            <textarea class="form-select" id="controlcomentario" rows="3" maxlength="1000" required name="comentario"
                                value="" placeholder="Escribe aquí tus comentario."></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <div id="contenedorBotonGuardar">
                                <button type="submit" class="btn botonGral" id="btnTareaGuardar">Guardar
                                    cambios</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/alertas.js') }}"></script>

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

    <script>
        function cargaItem(id, codigo, nombre, color, comentario, modalTipo) {

            const txtId = document.getElementById('servicioId');
            txtId.value = id;

            const txtCodigo = document.getElementById('codigo');
            txtCodigo.value = codigo;
            txtCodigo.disabled = modalTipo;

            const txtNombre = document.getElementById('nombre');
            txtNombre.value = nombre;
            txtNombre.disabled = modalTipo;

            const txtColor = document.getElementById('color');
            txtColor.value = color;
            txtColor.disabled = modalTipo;


            const txtComentario = document.getElementById('controlcomentario');
            txtComentario.value = comentario;
            txtComentario.readOnly = modalTipo;

            const contenedorBotonGuardar = document.getElementById('contenedorBotonGuardar');

            console.log(modalTipo);
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

            const campos = document.querySelectorAll('input[type="text"], select, textarea');
            // Aplicar color gris a los campos con readonly
            campos.forEach((campo) => {
                if (modalTipo) {
                    campo.disabled = true;
                    campo.style.color = 'grey';
                } else {
                    campo.disabled = false;
                    campo.style.color = 'initial';
                }
            });
        }
    </script>
@endsection
