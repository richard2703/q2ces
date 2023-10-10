@extends('layouts.main', ['activePage' => 'bitacoras', 'activeItem' => 'tareas'])
@section('content')
    <div class="content">
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
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header bacTituloPrincipal">
                                    <h4 class="card-title">Tareas</h4>
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
                                            @can('tarea_create')
                                                <div class="col-12 text-end">
                                                    <div class="row">
                                                        <a href="{{ url('/bitacoras/tareas/nueva') }}">
                                                            <!--Agregar ruta-->
                                                            <button type="button" class="btn botonGral">Nueva Tarea</button>
                                                        </a>
                                                        {{-- <div class="col-12 text-right" data-bs-toggle="modal"
                                                            data-bs-target="#nuevaTarea">
                                                            <button type="button" class="btn botonGral">Nueva Tarea</button>
                                                        </div> --}}
                                                    </div>
                                                </div>
                                            @endcan
                                        </div>
                                    </div>

                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead class="labelTitulo">
                                                <tr>
                                                    <th class="labelTitulo">Id</th>
                                                    <th class="labelTitulo">Nombre</th>
                                                    <th class="labelTitulo">Categoría</th>
                                                    <th class="labelTitulo">Ubicación</th>
                                                    <th class="labelTitulo">Tipo</th>
                                                    <th class="labelTitulo">Comentario</th>
                                                    <th class="labelTitulo text-right">Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                @forelse ($vctTareas as $item)
                                                    <tr>
                                                        <td>{{ $item->id }}</td>
                                                        <td>{{ $item->nombre }}</td>
                                                        <td>{{ $item->categoria }} </td>
                                                        <td>{{ $item->ubicacion }}</td>
                                                        <td>{{ $item->tipo }}</td>
                                                        <td>{{ $item->comentario }}</td>

                                                        <td class="td-actions text-center">

                                                            @can('tarea_edit')
                                                                <a href="{{ url('/bitacoras/tareas/editar/' . $item->id) }}"
                                                                    class="">
                                                                    <svg xmlns="http://www.w3.org/2000/svg " width="28"
                                                                        height="28" fill="currentColor" title="Editar"
                                                                        class="bi bi-pencil accionesIconos" viewBox="0 0 16 16">
                                                                        <path
                                                                            d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                                                                    </svg>
                                                                </a>
                                                            @endcan

                                                            @can('tarea_destroy')
                                                                <form action="{{ route('tarea.destroy', $item->id) }}"
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
                                                                </form>
                                                            @endcan
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="6">Sin registros.</td>
                                                    </tr>
                                                @endforelse

                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="card-footer mr-auto">
                                        {{ $vctTareas->links() }}
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <!--Nueva Tarea -->
    <div class="modal fade" id="nuevaTarea" tabindex="-1" aria-labelledby="nuevaTarealLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('tarea.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="nuevaTareaModalLabel">Nuevo Registro de Tarea</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="message-text" class="labelTitulo">Nombre: <span>*</span></label>
                            <input type="text" class="inputCaja" id="nombre" name="nombre" required maxlength="250"
                                value="" placeholder="Asigna un nombre a la tarea.">
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="labelTitulo">Categoría: <span>*</span></label>
                            <select class="form-select" id="floatingSelect" aria-label="Floating label select example"
                                required id="categoriaId" name="categoriaId">
                                <option selected value="">Selecciona una opción</option>
                                @foreach ($vctCategorias as $item)
                                    <option value="{{ $item->id }}">
                                        {{ $item->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="labelTitulo">Ubicación: <span>*</span></label>
                            <select class="form-select" id="floatingSelect" aria-label="Floating label select example"
                                required id="ubicacionId" name="ubicacionId">
                                <option selected value="">Selecciona una opción</option>
                                @foreach ($vctUbicaciones as $item)
                                    <option value="{{ $item->id }}">
                                        {{ $item->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="labelTitulo">Tipo: <span>*</span></label>
                            <select class="form-select" id="floatingSelect" aria-label="Floating label select example"
                                required id="tipoId" name="tipoId">
                                <option selected value="">Selecciona una opción</option>
                                @foreach ($vctTipos as $item)
                                    <option value="{{ $item->id }}">
                                        {{ $item->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="labelTitulo">Tipo de Valor a Capturar:</label></br>
                            <select class="form-select" aria-label="Default select example" id="tipoValor"
                                name="tipoValorId">
                                <option selected value="">Selecciona una opción</option>
                                @foreach ($vctTipoValor as $item)
                                    <option value="{{ $item->id }}">
                                        {{ $item->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Comentarios</label>
                            <textarea class="form-select" placeholder="Escribe aquí tus comentarios sobre la tarea." rows="3"
                                id="comentario" name="comentario"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Regresar</button>
                        <button type="submit" class="btn botonGral">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--Editar Tarea -->
    <div class="modal fade" id="editarTarea" tabindex="-1" aria-labelledby="editarTarealLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('tarea.update', 0) }}" method="post">
                    @csrf
                    @method('put')
                    <input type="hidden" name="tareaId" id="tareaId" value="">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="nuevaTareaModalLabel">Editar Registro de Tarea</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="message-text" class="labelTitulo">Nombre: <span>*</span></label>
                            <input type="text" class="inputCaja" id="tareaNombre" required name="nombre"
                                maxlength="250" value="">
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="labelTitulo">Categoría: <span>*</span></label>
                            <select class="form-select" id="tareaCategoriaId" name="categoriaId" required
                                aria-label="Floating label select example">
                                <option selected value="">Selecciona una opción</option>
                                @foreach ($vctCategorias as $item)
                                    <option value="{{ $item->id }}">
                                        {{ $item->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="labelTitulo">Ubicación: <span>*</span></label>
                            <select class="form-select" id="tareaUbicacionId" name="ubicacionId" required
                                aria-label="Floating label select example">
                                <option selected value="">Selecciona una opción</option>
                                @foreach ($vctUbicaciones as $item)
                                    <option value="{{ $item->id }}">
                                        {{ $item->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="labelTitulo">Tipo: <span>*</span></label>
                            <select class="form-select" id="tareaTipoId" name="tipoId" required
                                aria-label="Floating label select example">
                                <option selected value="">Selecciona una opción</option>
                                @foreach ($vctTipos as $item)
                                    <option value="{{ $item->id }}">
                                        {{ $item->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="labelTitulo">Tipo de Valor a Capturar:</label></br>
                            <select class="form-select" aria-label="Default select example" id="tareaTipoValor"
                                name="tipoValorId">
                                <option selected value="">Selecciona una opción</option>
                                @foreach ($vctTipoValor as $item)
                                    <option value="{{ $item->id }}">
                                        {{ $item->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Pon tu Comentario</label>
                            <textarea class="form-select" id="tareaComentario" name="comentario" rows="3"
                                placeholder="Escribe aquí tus comentarios sobre la tarea."></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Regresar</button>
                        <button type="submit" class="btn botonGral">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/alertas.js') }}"></script>
    <script type="application/javascript">
        jQuery('input[type=file]').change(function(){
         var filename = jQuery(this).val().split('\\').pop();
         var idname = jQuery(this).attr('id');
         console.log(jQuery(this));
         console.log(filename);
         console.log(idname);
         jQuery('span.'+idname).next().find('span').html(filename);
        });
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

    <script>
        function cargaItem(id, nombre, categoriaId, ubicacionId, tipoId, comentarios, activa, tipoValorId) {

            const txtId = document.getElementById('tareaId');
            txtId.value = id;

            const txtNombre = document.getElementById('tareaNombre');
            txtNombre.value = nombre;

            const lstCategoria = document.getElementById('tareaCategoriaId').value = categoriaId;
            const lstUbicacion = document.getElementById('tareaUbicacionId').value = ubicacionId;
            const lstTipo = document.getElementById('tareaTipoId').value = tipoId;
            const lstTipoValor = document.getElementById('tareaTipoValor').value = tipoValorId;

            const txtComentarios = document.getElementById('tareaComentario');
            txtComentarios.value = comentarios;

        }
    </script>
@endsection
