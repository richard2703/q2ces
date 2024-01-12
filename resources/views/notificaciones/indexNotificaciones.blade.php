@extends('layouts.main', ['activePage' => 'obra', 'titlePage' => __('Lista de Notificaciones')])
@section('content')
    <div class="content">
        <?php
        $objValida = new Validaciones();
        $objCalendar = new Calendario();
        // $objNotifica = new Notificacion();
        ?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header bacTituloPrincipal">
                                    <h4 class="card-title">Mis Notificaciones</h4>
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
                                            {{-- <div class="col-12 text-end">
                                            @can('obra_create')
                                                <a href="{{ route('obras.create') }}">
                                                    <button type="button" class="btn botonGral">Añadir Obra</button>
                                                </a>
                                            @endcan
                                            </div> --}}
                                            <div class="row">

                                                <span>
                                                    <a href="" class="display-8 mb-8 text-center"
                                                        title="Ir al periodo en curso"><b>Hoy es
                                                            {{ /*ucwords*/ trans($objCalendar->getFechaFormateada(date_create(date('Y-m-d')), true)) }}</b></a>
                                                </span>
                                                @if (isset($personal))
                                                    <h4 class="card-title">
                                                        <strong>{{ str_pad($personal->numNomina, 4, '0', STR_PAD_LEFT) }}</strong>
                                                        {{ $personal->personal }} [ {{ $personal->puesto }} ]
                                                    </h4>
                                                @endif

                                            </div>
                                        </div>
                                    </div>

                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead class="labelTitulo">
                                                <tr>
                                                    <th class="labelTitulo text-center">ID</th>
                                                    <th class="labelTitulo text-center">Modulo</th>
                                                    <th class="labelTitulo text-center">Título</th>
                                                    <th class="labelTitulo text-center">Estatus</th>
                                                    <th class="labelTitulo text-center">Fecha</th>
                                                    <th class="labelTitulo text-center">Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if (is_null($records) == false)
                                                    @php
                                                        $strDetalle = null;
                                                    @endphp
                                                    @forelse ($records as $item)
                                                        <tr>
                                                            <td class="text-center">{{ $item->id }}</td>
                                                            <td class="text-center">{{ $item->modulo }}</td>
                                                            <td class="text-center">{{ $item->titulo }}</td>
                                                            <td class="text-center"><i
                                                                    title="{{ $item->visto == 1 ? 'Notificación Vista' : 'Notificación Sin Revisar' }}"
                                                                    class="{{ $item->visto == 1 ? 'far fa-eye' : 'far fa-eye-slash' }}"></i>
                                                            </td>
                                                            <td class="text-center">{{ $item->created_at }}</td>

                                                            <td class="td-actions text-center">
                                                                @php
                                                                    //*** eliminamos saltos de linea y retorno de carro
                                                                    $strDetalle = str_replace(["\r", "\n"], '', $item->detalle);
                                                                @endphp
                                                                <a href="#" class="" data-bs-toggle="modal"
                                                                    data-bs-target="#editarItem"
                                                                    onclick="cargaItem('{{ $item->id }}','{{ $item->titulo }}','{{ $strDetalle }}')">
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
                                                                <a href="{{ route($item->modulo.".".$item->accion, $item->recordId) }}" class="">
                                                                    <svg xmlns="http://www.w3.org/2000/svg " width="28"
                                                                        height="28" fill="currentColor"
                                                                        class="bi bi-pencil accionesIconos" viewBox="0 0 16 16">
                                                                        <path
                                                                            d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                                                                    </svg>
                                                                </a>

                                                                <form  action="{{ route('notificaciones.delete', $item->id) }}"
                                                                    method="POST" style="display: inline-block;"
                                                                    onsubmit="return confirm('¿Estás Seguro que Deseas Borrar la Notificación?')">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button class="btnSinFondo" type="submit"
                                                                        title="Eliminar notificación" rel="tooltip">
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            width="28" height="28"
                                                                            fill="currentColor" class="bi bi-x-circle"
                                                                            viewBox="0 0 16 16">
                                                                            <path
                                                                                d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                                            <path
                                                                                d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                                                                        </svg>
                                                                    </button>
                                                                </form>

                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="5">Sin Registros.</td>
                                                        </tr>
                                                    @endforelse
                                                @else
                                                    @if (is_null($records) == false)
                                                        <tr>
                                                            <td colspan="5">Sin Registros.</td>
                                                        </tr>
                                                    @endif
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="card-footer mr-auto">
                                    @if (is_null($records) == false)
                                        {{ $records->links() }}
                                    @endif
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

                    <h1 class="modal-title fs-5" id="exampleModalLabel">&nbsp Detalle de Notificación</label>
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row d-flex" action="{{ route('notificaciones.update', 0) }}" method="post">
                        @csrf
                        @method('put')
                        <input type="hidden" name="controlId" id="controlId" value="">
                        <div class=" col-12 col-sm-12 mb-3 ">
                            <label class="labelTitulo">Título:</label></br>
                            <input type="text" class="inputCaja" id="controlNombre" name="nombre" value=""
                                readonly="true">
                        </div>

                        <div class=" col-12  mb-3 ">
                            <label class="labelTitulo">Detalle:</label></br>
                            <textarea class="form-control" placeholder="Detalle de la notificación" id="controlComentarios" name="comentario"
                                readonly="true"></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn botonGral" id="btnTareaGuardar">Cerrar</button>
                        </div>

                    </form>
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
        var slug = '1';
        if (slug == 1) {
            Guardado();

        }
    </script>
    <script>
        function cargaItem(id, titulo, detalle) {

            console.log(id);
            console.log(titulo);
            console.log(detalle);

            const txtId = document.getElementById('controlId');
            txtId.value = id;

            const txtNombre = document.getElementById('controlNombre');
            txtNombre.value = titulo;

            const txtComentarios = document.getElementById('controlComentarios');
            txtComentarios.value = detalle;

        }

        /**
         * This function is same as PHP's nl2br() with default parameters.
         *
         * @param {string} str Input text
         * @param {boolean} replaceMode Use replace instead of insert
         * @param {boolean} isXhtml Use XHTML
         * @return {string} Filtered text
         */
        function nl2br(str, replaceMode, isXhtml) {

            var breakTag = (isXhtml) ? '<br />' : '<br>';
            var replaceStr = (replaceMode) ? '$1' + breakTag : '$1' + breakTag + '$2';
            return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, replaceStr);
        }

        /**
         * This function inverses text from PHP's nl2br() with default parameters.
         *
         * @param {string} str Input text
         * @param {boolean} replaceMode Use replace instead of insert
         * @return {string} Filtered text
         */
        function br2nl(str, replaceMode) {

            var replaceStr = (replaceMode) ? "\n" : '';
            // Includes <br>, <BR>, <br />, </br>
            return str.replace(/<\s*\/?br\s*[\/]?>/gi, replaceStr);
        }
    </script>
@endsection
