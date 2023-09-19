@extends('layouts.main', ['activePage' => 'mtq', 'titlePage' => __('Lista de Tipos de Tareas')])
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header bacTituloPrincipal">
                                    <h4 class="card-title">Residentes</h4>

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
                                        <div class="col-12 text-right">

                                            {{--  <a href="{{ url('dashMtq') }}">
                                                <button class="btn regresar">
                                                    <span class="material-icons">
                                                        reply
                                                    </span>
                                                    Regresar
                                                </button>
                                            </a>  --}}

                                            @can('catalogos_create')
                                                <button class="btn botonGral float-end" data-bs-toggle="modal"
                                                    data-bs-target="#nuevoItem">
                                                    Añadir Residente
                                                </button>
                                            @endcan
                                        </div>
                                        <div class="d-flex p-3 divBorder"></div>
                                    </div>


                                    <table class="table table-responsive">
                                        <thead class="labelTitulo">
                                            <tr>
                                                <th class="labelTitulo">Id</th>
                                                <th class="labelTitulo">Nombre</th>
                                                <th class="labelTitulo">Telefono</th>
                                                <th class="labelTitulo">Obra</th>
                                                <th class="labelTitulo">Auto</th>
                                                <th class="labelTitulo text-right">Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($records as $item)
                                                <tr>
                                                    <td>{{ $item->id }}</td>
                                                    <td class="text-left">{{ $item->nombre }}</td>
                                                    <td class="text-left">{{ $item->telefono }}</td>
                                                    <td class="text-left">{{ $item->obra }}</td>
                                                    <td class="text-left">{{ $item->identificador }} {{ $item->auto }}
                                                    </td>

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
                                                            onclick="cargaItem('{{ $item->id }}','{{ $item->nombre }}','{{ $item->email }}','{{ $item->telefono }}','{{ $item->identificador }}','{{ $item->auto }}','{{ $item->obraId }}')">
                                                            <svg xmlns="http://www.w3.org/2000/svg " width="28"
                                                                height="28" fill="currentColor"
                                                                class="bi bi-pencil accionesIconos" viewBox="0 0 16 16">
                                                                <path
                                                                    d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                                                            </svg>
                                                        </a>
                                                        {{-- @endcan --}}
                                                        {{-- @can('user_destroy') --}}
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
                    <h1 class="modal-title fs-5" id="exampleModalLabel">&nbsp Nuevo Residente</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row d-flex" action="{{ route('residentes.store') }}" method="post">
                        @csrf
                        <input type="hidden" name="userId" id="userId" value="{{ auth()->user()->id }}">
                        <div class=" col-12 col-sm-6 mb-3 ">
                            <label class="labelTitulo">Nombre:<span>*</span></label></br>
                            <input type="text" class="inputCaja" name="nombre" required value="{{ old('nombre') }}"
                                required placeholder="Especifique...">
                        </div>
                        {{--  <div class=" col-12 col-sm-6 mb-3 ">
                            <label class="labelTitulo">Empresa:<span>*</span></label></br>
                            <input type="text" class="inputCaja" id="empresa" name="empresa" required
                                value="{{ old('empresa') }}" required placeholder="Especifique...">
                        </div>  --}}

                        <div class=" col-12 col-sm-6 mb-3 ">
                            <label class="labelTitulo">E-mail</label></br>
                            <input type="email" class="inputCaja" required placeholder="ej. elcorreo@delresponsable.com"
                                min="6" name="email" value="{{ old('email') }}">
                        </div>

                        <div class=" col-12 col-sm-6 mb-3 ">
                            <label class="labelTitulo">Teléfono:</label></br>
                            <input type="tel" placeholder="ej. 00-0000-0000" class="inputCaja"
                                name="telefono"value="{{ old('telefono') }}">
                        </div>

                        {{--  <div class=" col-12 col-sm-6 mb-3 ">
                            <label class="labelTitulo">Puesto:<span>*</span></label></br>
                            <input type="text" class="inputCaja" id="puesto" name="puesto" required
                                value="{{ old('puesto') }}" required placeholder="Especifique...">
                        </div>  --}}

                        <div class=" col-12 col-sm-6 mb-3 ">
                            <label class="labelTitulo">Obra: <span>*</span></label></br>
                            <select name="obraId" class="form-select" aria-label="Default select example">
                                <option value="">Seleccione</option>
                                @foreach ($vctObras as $item)
                                    <option value="{{ $item->id }}">
                                        {{ $item->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class=" col-12 col-sm-6 mb-3 ">
                            <label class="labelTitulo">Auto: <span></span></label></br>
                            <select name="autoId" class="form-select" aria-label="Default select example">
                                <option value="">Seleccione</option>
                                @foreach ($maquinaria as $item)
                                    <option value="{{ $item->id }}">
                                        {{ $item->identificador }} {{ $item->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{--  <div class=" col-12  mb-3 ">
                            <label class="labelTitulo">Comentarios:</label></br>
                            <textarea class="form-control" placeholder="Escribe tu comentario aquí" id="floatingTextarea" name="comentario"
                                spellcheck="true">{{ old('comentario') }}</textarea>
                        </div>  --}}



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

                    <h1 class="modal-title fs-5" id="exampleModalLabel">&nbsp Editar Tipo de Tareas</label>
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row d-flex" action="{{ route('residentes.update', 0) }}" method="post">
                        @csrf
                        @method('put')
                        <input type="hidden" name="residenteId" id="residenteId" value="">
                        <div class=" col-12 col-sm-6 mb-3 ">
                            <label class="labelTitulo">Nombre:<span>*</span></label></br>
                            <input type="text" class="inputCaja" id="nombre" name="nombre" required
                                value="{{ old('nombre') }}" required placeholder="Especifique...">
                        </div>

                        <div class=" col-12 col-sm-6 mb-3 ">
                            <label class="labelTitulo">E-mail</label></br>
                            <input type="email" class="inputCaja" id="email" required
                                placeholder="ej. elcorreo@delresponsable.com" min="6" name="email"
                                value="{{ old('email') }}">
                        </div>

                        <div class=" col-12 col-sm-6 mb-3 ">
                            <label class="labelTitulo">Teléfono:</label></br>
                            <input type="tel" placeholder="ej. 00-0000-0000" class="inputCaja" id="telefono"
                                name="telefono"value="{{ old('telefono') }}">
                        </div>

                        <div class=" col-12 col-sm-6 mb-3 ">
                            <label class="labelTitulo">Obra: </label></br>
                            <select id="obraId" name="obraId" class="form-select"
                                aria-label="Default select example">
                                <option value="">Seleccione</option>
                                @foreach ($vctObras as $item)
                                    <option value="{{ $item->id }}">
                                        {{ $item->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class=" col-12 col-sm-6 mb-3 ">
                            <label class="labelTitulo">Auto Asignado: </label></br>
                            <input type="text" class="inputCaja" id="asignado" value="" readonly>
                        </div>

                        <div class=" col-12 col-sm-6 mb-3 ">
                            <label class="labelTitulo">Cambio de Auto: </label></br>
                            <select id="autoId" name="autoId" class="form-select"
                                aria-label="Default select example">
                                <option value="0">Sin Cambios</option>
                                <option value="">Denegar Auto</option>
                                @foreach ($maquinaria as $item)
                                    <option value="{{ $item->id }}">
                                        {{ $item->identificador }} {{ $item->nombre }}
                                    </option>
                                @endforeach
                            </select>
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
        function cargaItem(id, nombre, email, telefono, identificador, auto, obraId) {
            console.log('id= ', id)
            const txtId = document.getElementById('residenteId');
            txtId.value = id;

            const txtNombre = document.getElementById('nombre');
            txtNombre.value = nombre;


            const txtEmail = document.getElementById('email');
            txtEmail.value = email;

            const txtTelefono = document.getElementById('telefono');
            txtTelefono.value = telefono;

            const txtAsignado = document.getElementById('asignado');
            txtAsignado.value = identificador + ' ' + auto;


            const lstObre = document.getElementById('obraId').value = obraId;


        }
    </script>
@endsection
