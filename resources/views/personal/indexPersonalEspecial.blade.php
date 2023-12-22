@extends('layouts.main', ['activePage' => 'personal', 'titlePage' => __('Lista de Personal')])
@section('content')
    <?php
        $objValida = new Validaciones();
    ?>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header bacTituloPrincipal">
                                    <h4 class="card-title">Personal</h4>
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
                                    <div class="row divBorder">
                                        <div class="col-12 col-sm-6 col-lg-3 pb-3 text-center">
                                            <form action="{{ route('personalEspecial.index') }}" method="GET" id="filterForm">
                                                <div class="input-group">
                                                    <label class="labelTitulo p-2">Estatus: </label>
                                                    <select name="estatus" id="estatus" style="background: #727176; color: white; font-weight: bold;" class="form-control" onchange="document.getElementById('filterForm').submit();">
                                                        <option value="1" style="font-weight: bold;" {{ request('estatus') == '1' ? 'selected' : '' }}>Activos</option>
                                                        <option value="3" style="font-weight: bold;" {{ request('estatus') == '3' ? 'selected' : '' }}>Baja</option>
                                                        <option value="2" style="font-weight: bold;" {{ request('estatus') == '2' ? 'selected' : '' }}>Inactivos</option>
                                                        <option value="4" style="font-weight: bold;" {{ request('estatus') == '4' ? 'selected' : '' }}>Borrado</option>
                                                        <option value="0" style="font-weight: bold;" {{ request('estatus') == '0' ? 'selected' : '' }}>Todos</option>
                                                    </select>
                                                </div>
                                            </form>
                                        </div>
                                        
                                        <div class="col-12 col-sm-6 col-lg-9 pb-3 text-end">
                                            @can('personal_create')
                                                <button class="btn botonGral float-end" data-bs-toggle="modal"
                                                    data-bs-target="#nuevoItem" onclick="cargaItem('','','','','','','',
                                                    '','','','','', '{{ false }}')">
                                                    Añadir Personal Especial
                                                </button>
                                            @endcan
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead class="labelTitulo">
                                                {{--  <th class="labelTitulo text-center">ID</th>  --}}
                                                <th class="labelTitulo text-center">Nombre</th>
                                                <th class="labelTitulo text-center">Apellido</th>
                                                <th class="labelTitulo text-center">Puesto </th>
                                                <th class="labelTitulo text-center">Teléfono</th>
                                                <th class="labelTitulo text-center">Correo Electrónico</th>
                                                <th class="labelTitulo text-center">Estatus</th>
                                                <th class="labelTitulo text-center">Acciones</th>
                                            </thead>
                                            <tbody>
                                                @forelse ($personal as $persona)
                                                    <tr>
                                                        {{--  <td class="text-center">{{ $persona->id }}</td>  --}}
                                                        <td class="text-center">
                                                            {{ $persona->nombres }}
                                                        </td>
                                                        <td class="text-center">{{ $persona->apellidoP }}</td>
                                                        <td class="text-center">{{ $persona->puesto }}</td>
                                                        <td class="text-center">{{ $persona->celular }}</td>
                                                        <td class="text-center">{{ $persona->mailEmpresarial }}</td>
                                                        <td class="text-center">{{ $persona->estatus }}</td>

                                                        <td class="td-actions text-center">
                                                            @can('residente_mtq_generateUser')
                                                            <form class="" id="printForm" action="{{ route('personalEspecial.generateUser') }}" method="POST" style="display: inline-block;">
                                                                @csrf
                                                                @method('POST')
                                                                <input type="hidden" name="personalIdRoles" id="personalIdRoles" value="">
                                                                @if ($persona->userId != null)
                                                                <button class="btnSinFondo" type="button" onclick="alertaDuplicado()">
                                                                    <i class="fas fa-user-plus" style="color: #8caf48; font-size: x-large;"></i>
                                                                </button>    
                                                                @else                                                                
                                                                <button class="btnSinFondo" type="button" onclick="alertaGuardarEvent(event,'{{ $persona->id }}')">
                                                                    <i class="fas fa-user-plus" style="color: red; font-size: x-large;"></i>
                                                                </button>
                                                                @endif
                                                            </form>
                                                            @endcan
                                                            @can('personal_show')
                                                            <a href="#" data-bs-toggle="modal" data-bs-target="#editarItem"
                                                            onclick="cargaItem('{{ $persona->id }}','{{ $persona->nombres }}','{{ $persona->apellidoP }}','{{ $persona->apellidoM }}','{{ $persona->fechaNacimiento }}','{{ $persona->puestoId }}','{{ $persona->celular }}',
                                                            '{{ $persona->mailEmpresarial }}','{{ $persona->mailpersonal }}','{{ $persona->estatus }}','{{ $persona->foto }}', '{{ true }}')">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28"
                                                                fill="currentColor" class="bi bi-card-text accionesIconos"
                                                                viewBox="0 0 16 16">
                                                                <path
                                                                    d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z" />
                                                                <path
                                                                    d="M3 5.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 8zm0 2.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5z" />
                                                            </svg>
                                                            </a>
                                                            @endcan
                                                            @can('personal_edit')
                                                            <a href="#" data-bs-toggle="modal" data-bs-target="#editarItem"
                                                            onclick="cargaItem('{{ $persona->id }}','{{ $persona->nombres }}','{{ $persona->apellidoP }}','{{ $persona->apellidoM }}','{{ $persona->fechaNacimiento }}','{{ $persona->puestoId }}','{{ $persona->celular }}',
                                                            '{{ $persona->mailEmpresarial }}','{{ $persona->mailpersonal }}','{{ $persona->estatus }}','{{ $persona->foto }}', '{{ false }}')">
                                                                <svg xmlns="http://www.w3.org/2000/svg " width="28" height="28"
                                                                    fill="currentColor" class="bi bi-pencil accionesIconos"
                                                                    viewBox="0 0 16 16">
                                                                    <path
                                                                        d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                                                                </svg>
                                                            </a>
                                                            @endcan

                                                            {{-- @can('user_edit') --}}
                                                            {{--  <a href="{{ route('personal.edit', $persona->id) }}" class="">
                                                            <svg xmlns="http://www.w3.org/2000/svg "  width="28" height="28" fill="currentColor" class="bi bi-pencil accionesIconos"  viewBox="0 0 16 16">
                                                               <path  d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                                                            </svg>
                                                            </a> --}}
                                                            {{-- @endcan --}}
                                                            @can('user_destroy')
                                                            <form action="{{ route('personalEspecial.destroy', $persona->id) }}"
                                                                method="POST" style="display: inline-block;"
                                                                onsubmit="return confirm('¿Estás seguro que deseas eliminar este registro?')">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button class="btnSinFondo" type="submit"  rel="tooltip">
                                                                    <svg xmlns="http://www.w3.org/2000/svg"  width="28" height="28"  fill="currentColor"  class="bi bi-x-circle"  viewBox="0 0 16 16">
                                                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                                                                    </svg>
                                                                </button>
                                                            </form>
                                                            @endcan
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
                                <div class="card-footer mr-auto">
                                    {{ $personal->appends(['estatus' => request('estatus')])->links() }}
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
                    <h1 class="modal-title fs-5" id="exampleModalLabel">&nbsp Nuevo Personal Especial</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row d-flex" action="{{ route('personalEspecial.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="estatusId" value="1">
                        <input type="hidden" name="personalEspecial" id="personalEspecial" value="1">
                        <div class="col-12 align-items-center">
                            <div class="text-center mx-auto border vistaFoto mb-4">
                                <i><img class="img-fluid imgPersonal mb-2"
                                    src="{{ asset('/img/general/avatar.jpg') }}"></i>
                                <span class="mi-archivo">
                                    <input class="mb-4 ver" type="file"
                                        name="foto" id="mi-archivo" accept="image/*">
                                </span>
                                <label for="mi-archivo">
                                    <span>sube Imagen</span>
                                </label>
                            </div>
                        </div>

                        <div class=" col-12 col-sm-6 mb-3 ">
                            <label class="labelTitulo">Nombre(s):
                                <span>*</span></label></br>
                            <input type="text" class="inputCaja"
                                required name="nombres" value="{{ old('nombres') }}">
                        </div>

                        <div class=" col-12 col-sm-6 mb-3 ">
                            <label class="labelTitulo">Apellido Paterno:
                                <span>*</span></label></br>
                            <input type="text" class="inputCaja"
                                required name="apellidoP"
                                value="{{ old('apellidoP') }}">
                        </div>

                        <div class=" col-12 col-sm-6 mb-3 ">
                            <label class="labelTitulo">Apellido Materno:</label></br>
                            <input type="text" class="inputCaja"
                                name="apellidoM" value="{{ old('apellidoM') }}">
                        </div>

                        <div class=" col-12 col-sm-6 mb-3 ">
                            <label class="labelTitulo">Puesto:
                                <span>*</span></label></br>
                            <select name="puestoId"
                                class="form-select" required
                                aria-label="Default select example">
                                <option value="">Seleccione</option>
                                @foreach ($vctPuestos as $item)
                                    <option value="{{ $item->id }}">
                                        {{ $objValida->ucwords_accent($item->nombre) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{--  <div class=" col-12 col-sm-6 mb-3 ">
                            <label class="labelTitulo">Nivel de Puesto:
                                <span>*</span></label></br>
                            <select name="puestoNivelId"
                                class="form-select" required
                                aria-label="Default select example">
                                <option value="">Seleccione</option>
                                @foreach ($vctNiveles as $item)
                                    <option value="{{ $item->id }}">
                                        {{ $item->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>  --}}

                        <div class=" col-12 col-sm-6 mb-3 ">
                            <label class="labelTitulo">Celular:</label></br>
                            <input type="text" class="inputCaja"
                                name="celular" value="{{ old('celular') }}">
                        </div>

                        <div class=" col-12 col-sm-6 mb-3 ">
                            <label class="labelTitulo">Fecha de Nacimiento:</label></br>
                            <input type="date" class="inputCaja"
                                name="fechaNacimiento"
                                value="{{ old('fechaNacimiento') }}">
                        </div>

                        <div class=" col-12 col-sm-6 mb-3 ">
                            <label class="labelTitulo">Correo Electrónico
                                Personal:</label></br>
                            <input type="email" class="inputCaja"
                                name="mailpersonal"
                                value="{{ old('mailpersonal') }}">
                        </div>

                        <div class=" col-12 col-sm-6 mb-3 " style="display: none;">
                            <label class="labelTitulo">Correo Electrónico
                                Empresarial:</label></br>
                            <input type="email" class="inputCaja"
                                name="mailEmpresarial"
                                value="{{ old('mailEmpresarial') }}">
                        </div>

                        {{--  <div class=" col-12  mb-3 ">
                            <label class="labelTitulo">Comentarios:</label></br>
                            <textarea class="form-control" placeholder="Escribe tu comentario aquí" id="floatingTextarea" name="comentario"
                                spellcheck="true"></textarea>
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

    <!-- Modal Editar Equipos MTQ-->
    <div class="modal fade" id="editarItem" tabindex="-1" aria-labelledby="exampleModalLabelEdit" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bacTituloPrincipal">
                    <h1 class="modal-title fs-5" id="exampleModalLabelEdit">&nbsp <span id="tituloModal">Editar</span>
                        </label>
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row d-flex" action="{{ route('personalEspecial.update', 0) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('post')
                        <input type="hidden" name="id" id="personalId" value="">
                        <div class="col-12 align-items-center">
                            <div class="text-center mx-auto border vistaFoto mb-4">
                                <div class="image-container">
                                    <i><img id="fotoImg" class="imgVista img-fluid" src="{{ asset('/img/general/avatar.jpg') }}"></i>
                                </div>
                                <div id="contenedorBotonSubirImagen">
                                    <div class="button-container mt-2" style="height: 50px; background-color: #a6ce34; color: white; font-weight: 500; font-size:14px">
                                        <label class="custom-file-upload mt-2">
                                            <input class="mb-4 ver" type="file" name="foto" accept="image/*">
                                            <span>SUBE IMAGEN</span>  
                                        </label>
                                    </div>
                                </div>
                            </div>    
                        </div>

                        <div class=" col-12 col-sm-6 mb-3 ">
                            <label class="labelTitulo">Nombre(s):
                                <span>*</span></label></br>
                            <input type="text" class="inputCaja"
                                required name="nombres" id="nombres" value="{{ old('nombres') }}">
                        </div>

                        <div class=" col-12 col-sm-6 mb-3 ">
                            <label class="labelTitulo">Apellido Paterno:
                                <span>*</span></label></br>
                            <input type="text" class="inputCaja" id="apellidoP"
                                required name="apellidoP"
                                value="{{ old('apellidoP') }}">
                        </div>

                        <div class=" col-12 col-sm-6 mb-3 ">
                            <label class="labelTitulo">Apellido Materno:</label></br>
                            <input type="text" class="inputCaja" id="apellidoM"
                                name="apellidoM" value="{{ old('apellidoM') }}">
                        </div>

                        <div class=" col-12 col-sm-6 mb-3 ">
                            <label class="labelTitulo">Puesto:
                                <span>*</span></label></br>
                            <select id="puestoId" name="puestoId"
                                class="form-select" required
                                aria-label="Default select example">
                                <option value="">Seleccione</option>
                                @foreach ($vctPuestos as $item)
                                    <option value="{{ $item->id }}">
                                        {{ $objValida->ucwords_accent($item->nombre) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{--  <div class=" col-12 col-sm-6 mb-3 ">
                            <label class="labelTitulo">Nivel de Puesto:
                                <span>*</span></label></br>
                            <select id="puestoNivelId" name="puestoNivelId"
                                class="form-select" required
                                aria-label="Default select example">
                                <option value="">Seleccione</option>
                                @foreach ($vctNiveles as $item)
                                    <option value="{{ $item->id }}">
                                        {{ $item->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>  --}}

                        <div class=" col-12 col-sm-6 mb-3 ">
                            <label class="labelTitulo">Celular:</label></br>
                            <input type="text" class="inputCaja" id="celular"
                                name="celular" value="{{ old('celular') }}">
                        </div>

                        <div class=" col-12 col-sm-6 mb-3 ">
                            <label class="labelTitulo">Fecha de Nacimiento:</label></br>
                            <input type="date" class="inputCaja" id="fechaNacimiento"
                                name="fechaNacimiento"
                                value="{{ old('fechaNacimiento') }}">
                        </div>

                        <div class=" col-12 col-sm-6 mb-3 ">
                            <label class="labelTitulo">Correo Electrónico
                                Personal:</label></br>
                            <input type="email" class="inputCaja" id="mailpersonal"
                                name="mailpersonal"
                                value="{{ old('mailpersonal') }}">
                        </div>

                        <div class=" col-12 col-sm-6 mb-3 ">
                            <label class="labelTitulo">Correo Electrónico
                                Empresarial:</label></br>
                            <input type="email" class="inputCaja" id="mailEmpresarial"
                                name="mailEmpresarial"
                                value="{{ old('mailEmpresarial') }}">
                        </div>

                        <div class="col-12 col-sm-6 mb-3">
                            <label class="labelTitulo">Estatus:</label></br>
                            <select class="form-select" aria-label="Default select example"
                                id="estatusId" name="estatusId">
                                @foreach ($vctEstatus as $item)
                                    <option value="{{ $item->id }}">
                                        {{ $objValida->ucwords_accent($item->nombre) }} </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <div id="contenedorBotonGuardarTarea">
                                <button type="submit" class="btn botonGral">Guardar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal" id="rolesModal">
        <!-- Contenido del modal -->
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bacTituloPrincipal">
                    <h1 class="modal-title fs-5" id="exampleModalLabelEdit">&nbsp <span id="tituloModal">Roles</span>
                        </label>
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Contenido del modal con los roles -->
                    <!-- ... -->
                    <div class="row mt-3 d-flex justify-content-end">
                        <div class="col-12">
                            <div class="form-group">
                                <div class="tab-content">
                                    <div class="tab-pane active">
                                        <table class="table">
                                            <tbody>
                                                @foreach ($roles as $id => $role)
                                                    <tr>
                                                        <td>
                                                            <div class="form-check">
                                                                <label class="form-check-label">
                                                                    <input
                                                                        class="form-check-input is-invalid align-self-end"
                                                                        type="checkbox" name="roles[]"
                                                                        value="{{ $id }}">
                                                                    {{ $role }}
                                                                    <span class="form-check-sign">
                                                                        <span class="check"></span>
                                                                    </span>
                                                                </label>
                                                                
                                                            </div>

                                                        </td>


                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn botonGral" onclick="submitForm()">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function alertaGuardarEvent(event, id) {
           
            if (event) {
                event.preventDefault(); // Evita que el formulario se envíe automáticamente
            }
            // Muestra el modal con los roles
            $('#rolesModal').modal('show');
            const txtIdPersonal = document.getElementById('personalIdRoles');
            txtIdPersonal.value = id;
        }
        
        function submitForm() {
            const rolesSeleccionados = document.querySelectorAll('input[name="roles[]"]:checked');
            if (rolesSeleccionados.length === 0) {
                alert('Selecciona al menos un rol.'); 
            } else {
                rolesSeleccionados.forEach(function(rol) {
                    // Crear un elemento input para cada rol seleccionado
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'roles[]';
                    input.value = rol.value;
                    document.getElementById('printForm').appendChild(input);
                });
        
                // Continuar con el envío del formulario
                document.getElementById('printForm').submit();
            }
        }
        
    </script>

    <style>
        select[readonly], input[readonly], textarea[readonly]{
            color: grey;
            cursor:no-drop;
        }
        
        select[readonly] option{
            display:none;
        }
    </style>
    
    <script>
        function cargaItem(id, nombres, apellidoP, apellidoM, fechaNacimiento, puesto, celular, mailEmpresarial, mailPersonal, estatus, foto, value) {

            const txtId = document.getElementById('personalId');
            txtId.value = id;

            const txtNombres = document.getElementById('nombres');
            txtNombres.value = nombres;

            const txtApellidoP = document.getElementById('apellidoP');
            txtApellidoP.value = apellidoP;

            const txtApellidoM = document.getElementById('apellidoM');
            txtApellidoM.value = apellidoM;

            const txtFechaNacimiento = document.getElementById('fechaNacimiento');
            const fechaPartida = fechaNacimiento.split(' ')[0];
            txtFechaNacimiento.value = fechaPartida;

            const txtPuesto = document.getElementById('puestoId');

            for (let i = 0; i < txtPuesto.options.length; i++) {
                if (txtPuesto.options[i].value == puesto) {
                    // txtPuesto.options[i].selected = true;
                    txtPuesto.selectedIndex = i;
                }
            }

            const txtCelular = document.getElementById('celular');
            txtCelular.value = celular;

            const txtMailEmpresarial = document.getElementById('mailEmpresarial');
            txtMailEmpresarial.value = mailEmpresarial;

            const txtMailPersonal = document.getElementById('mailpersonal');
            txtMailPersonal.value = mailPersonal;

            const txtEstatus = document.getElementById('estatusId');

            for (let i = 0; i < txtEstatus.options.length; i++) {
                if (txtEstatus.options[i].value == estatus) {
                    // txtEstatus.options[i].selected = true;
                    txtEstatus.selectedIndex = i;
                }
            }

            const imagenVistaT = document.getElementById('fotoImg');
            if (foto != "" && foto != null) {
                imagenVistaT.src = "{{ asset('/storage/personal') }}/" + id.padStart(4, "0") + "/" + foto;
            } else {
                imagenVistaT.src = "{{ asset('/img/general/avatar.jpg') }}"
            }

            // Obtener todos los campos del formulario
            //const campos = document.querySelectorAll('input[type="text"], textarea');
            let campos = document.querySelectorAll('.inputCaja, .form-select, .form-control-textarea');
            const tituloModal = document.getElementById('tituloModal');
            const contenedorBotonGuardarTarea = document.getElementById('contenedorBotonGuardarTarea');
            const contenedorBotonSubirImagen = document.getElementById('contenedorBotonSubirImagen');
            

            // Aplicar color gris a los campos con readonly
            campos.forEach((campo) => {
                if (value) {
                    campo.setAttribute('readonly', 'readonly');
                    campo.style.color = 'gray';
                    tituloModal.textContent = 'Ver Personal Especial';
                    contenedorBotonGuardarTarea.style.display = 'none';
                    contenedorBotonSubirImagen.style.display = 'none';
                    // campo.style.cursor:no-drop;
                } else {
                    campo.removeAttribute('readonly');
                    campo.style.color = 'initial';
                    tituloModal.textContent = 'Editar Personal Especial';
                    contenedorBotonGuardarTarea.style.display = 'block';
                    contenedorBotonSubirImagen.style.display = 'block';
                }
            });
        }
    </script>

    <script>
        function Guardado() {
            
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
        if (slug == 7) {
            alertaDuplicado();

        }
        if(slug == 8) {
            mostrarAlertaExitoCorta();
        }
    </script>
    
@endsection
