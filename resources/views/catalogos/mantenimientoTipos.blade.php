@extends('layouts.main', ['activePage' => 'equipos', 'titlePage' => __('Lista de Tipos de Mantenimiento')])
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
                                    <h4 class="card-title">Tipos de Mantenimiento</h4>

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
                                        <div class="d-flex p-3">
                                            <div class="col-12 text-right">

                                                <a href="{{ route('catalogos.index') }}">
                                                    <button class="btn regresar">
                                                        <span class="material-icons">
                                                            reply
                                                        </span>
                                                        Regresar
                                                    </button>
                                                </a>

                                                @can('catalogos_create')
                                                    <button class="btn botonGral float-end" data-bs-toggle="modal"
                                                        data-bs-target="#nuevoItem">
                                                        Añadir Tipo de Mantenimiento
                                                    </button>
                                                @endcan
                                            </div>
                                        </div>
                                        <div class="divBorder">
                                            <p>Catálogo General de Tipo de Mantenimento, Es Utilizado para Especificar
                                                el tipo de Mantenimiento que se Aplicará a un Equipo en una Solicitud.
                                            </p>
                                        </div>
                                    </div>
                                </div>


                                <table class="table table-responsive">
                                    <thead class="labelTitulo">
                                        <tr>
                                            <th class="labelTitulo">Id</th>
                                            <th class="labelTitulo">Nombre</th>
                                            <th class="labelTitulo">Color</th>
                                            <th class="labelTitulo" style="width:150px">Comentario</th>
                                            <th class="labelTitulo text-right" style="width:140px">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($records as $item)
                                            <tr>
                                                <td>{{ $item->id }}</td>
                                                <td class="text-left">{{ $item->nombre }}</td>
                                                <td class="text-center"
                                                    style="
                                                font-weight: bold;
                                                background: {{ $item->color }};
                                            ">
                                                    {{ $item->color }}</td>
                                                <td class="text-left">{{ $item->comentario }}</td>

                                                <td class="td-actions text-right">
                                                    {{-- @can('user_show') --}}
                                                    {{-- <!--<a href="{{ route(' puestos.show', $item->id) }}"  class="">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-card-text accionesIconos" viewBox="0 0 16 16">
                                                                    <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                                                                    <path d="M3 5.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 8zm0 2.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5z"/>
                                                                </svg>
                                                            </a>--> --}}
                                                    {{-- @endcan --}}
                                                    {{-- @can('user_edit') --}}
                                                    <a href="#" class="" data-bs-toggle="modal"
                                                        data-bs-target="#editarItem"
                                                        onclick="cargaItem('{{ $item->id }}','{{ $item->nombre }}', '{{ $item->color }}','{{ $item->comentario }}')">
                                                        <svg xmlns="http://www.w3.org/2000/svg " width="28"
                                                            height="28" fill="currentColor"
                                                            class="bi bi-pencil accionesIconos" viewBox="0 0 16 16">
                                                            <path
                                                                d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                                                        </svg>
                                                    </a>
                                                    {{-- @endcan --}}
                                                    @can('user_destroy')
                                                        <form action="{{ route('tipoMantenimiento.destroy', $item->id) }}"
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

    <!-- Modal Nueva Tarea-->
    <div class="modal fade" id="nuevoItem" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bacTituloPrincipal">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">&nbsp Nuevo Tipo de Mantenimiento</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row d-flex" action="{{ route('tipoMantenimiento.store') }}" method="post">
                        @csrf
                        {{-- <input type="hidden" name="userId" id="userId" value="{{ $usuario->id }}"> --}}
                        <div class=" col-12 col-sm-6 mb-3 ">
                            <label class="labelTitulo">Nombre:<span>*</span></label></br>
                            <input type="text" class="inputCaja" id="nombre" name="nombre"
                                value="{{ old('nombre') }}" required placeholder="Especifique...">
                        </div>

                        <div class=" col-12 col-sm-6 mb-3 ">
                            <label class="labelTitulo">Color:<span>*</span></label></br>
                            <input type="color" class="inputCaja" name="color" value="{{ old('color') }}">
                        </div>

                        <div class=" col-12  mb-3 ">
                            <label class="labelTitulo">Comentarios:</label></br>
                            <textarea class="form-control" placeholder="Escribe tu comentario aquí" id="floatingTextarea" name="comentario"
                                spellcheck="true"></textarea>
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

                    <h1 class="modal-title fs-5" id="exampleModalLabel">&nbsp Editar Tipo de Mantenimiento</label>
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row d-flex" action="{{ route('tipoMantenimiento.update', 0) }}" method="post">
                        @csrf
                        @method('put')
                        <input type="hidden" name="controlId" id="controlId" value="">
                        <div class=" col-12 col-sm-6 mb-3 ">
                            <label class="labelTitulo">Nombre:</label></br>
                            <input type="text" class="inputCaja" id="controlNombre" name="nombre" value="">
                        </div>

                        <div class=" col-12 col-sm-6 mb-3 ">
                            <label class="labelTitulo">Color:<span>*</span></label></br>
                            <input type="color" class="inputCaja" name="color" value="{{ old('color') }}"
                                id="color">
                        </div>

                        <div class=" col-12  mb-3 ">
                            <label class="labelTitulo">Comentarios:</label></br>
                            <textarea class="form-control" placeholder="Escribe tu comentario aquí" id="controlComentarios" name="comentario"></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn botonGral" id="btnTareaGuardar">Guardar cambios</button>
                        </div>

                    </form>
                </div>
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
        function cargaItem(id, nombre, color, comentarios) {

            const txtId = document.getElementById('controlId');
            txtId.value = id;

            const txtNombre = document.getElementById('controlNombre');
            txtNombre.value = nombre;

            const txtComentarios = document.getElementById('controlComentarios');
            txtComentarios.value = comentarios;

            const txtColor = document.getElementById('color');
            txtColor.value = color;

        }
    </script>
@endsection
