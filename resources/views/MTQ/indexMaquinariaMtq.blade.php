@extends('layouts.main', ['activePage' => 'mtq', 'titlePage' => __('MTQ')])
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bacTituloPrincipal">
                            <h4 class="card-title"> Equipos MTQ</h4>
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
                            
                                <form id="excel-upload-form" action="{{ route('importExcel.post') }}" method="POST" enctype="multipart/form-data">
                                    <div class="row">
                                    @csrf
                                    <div class="col-6 col-md-4 col-lg-4 text-left">
                                        <div style="display: flex; align-items: center;">
                                            <label class="custom-file-upload" onclick='handleDocumento("excel-file-input")'>
                                                <input class="mb-4" type="file" name="excel_file" id="excel-file-input" accept=".xlsx">
                                                <div id='iconContainer'>
                                                    <lord-icon src="https://cdn.lordicon.com/koyivthb.json"
                                                               trigger="hover"
                                                               colors="primary:#86c716,secondary:#e8e230"
                                                               stroke="65"
                                                               style="width:50px;height:70px">
                                                    </lord-icon>
                                                </div>
                                            </label>
                                            
                                            <a id='downloadButton' class="btnViewDescargar btn btn-outline-success btnView" style="display: none" download>
                                                <span class="btn-text">Descargar</span>
                                                <span class="icon">
                                                    <i class="far fa-eye mt-2"></i>
                                                </span>
                                            </a>
                                            
                                            <button id='removeButton' type="button" class="btnViewDelete btn btn-outline-danger btnView"
                                                    style="width: 2.4em; height: 2.4em; display: none;">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </div>
                                    </div>
                                    
                                    

                                    <div class="col-6 col-md-3 col-lg-4">
                                        <button type="button" class="btn regresar d-flex mt-4" id="submit-button">
                                            <span class="material-icons">
                                                file_upload
                                            </span>
                                            Importar Excel
                                        </button>
                                    </label>
                                </div>
                                <div class="col-12 col-md-6 col-lg-4 align-end">
                                    @can('maquinaria_mtq_create')
                                        <button data-bs-toggle="modal" data-bs-target="#nuevoItem" type="button" style="height: 40px"
                                            class="btn botonGral mt-4"
                                            onclick="cargaItem(' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ','{{ false }}')">Añadir
                                            Equipos MTQ</button>
                                    @endcan
                                </div>
                            </form>
                                <div class="d-flex p-3 divBorder"></div>
                            </div>

                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="labelTitulo">
                                        <th class="labelTitulo text-center" style="width:150px">Número Económico</th>
                                        <th class="labelTitulo text-center">Equipo</th>
                                        <th class="labelTitulo text-center">Marca</th>
                                        <th class="labelTitulo text-center">Modelo</th>
                                        <th class="labelTitulo text-center">Sub Marca</th>
                                        <th class="labelTitulo text-center">Año</th>
                                        <th class="labelTitulo text-center">Color</th>
                                        <th class="labelTitulo text-center">Placas</th>
                                        <th class="labelTitulo text-center">VIN</th>
                                        <th class="labelTitulo text-center">Número de Motor</th>
                                        <th class="labelTitulo text-center" style="width:120px">Acciones</th>
                                    </thead>
                                    <tbody>
                                        @forelse ($maquinaria as $maquina)
                                            <tr>
                                                <td class="text-center">{{ $maquina->identificador }}</td>
                                                <td class="text-center">{{ $maquina->nombre }}</td>
                                                <td class="text-center">{{ $maquina->nombreMarca }}</td>
                                                <td class="text-center">{{ $maquina->modelo }}</td>
                                                <td class="text-center">{{ $maquina->submarca }}</td>
                                                <td class="text-center">{{ $maquina->ano }}</td>
                                                <td class="text-center">{{ $maquina->color }}</td>
                                                <td class="text-center">{{ $maquina->placas }}</td>
                                                <td class="text-center">{{ $maquina->numserie }}</td>
                                                <td class="text-center">{{ $maquina->nummotor }}</td>

                                                <td class="td-actions text-center">
                                                    @can('maquinaria_mtq_show')
                                                        <a href="#" data-bs-toggle="modal" data-bs-target="#editarItem"
                                                            onclick="cargaItem('{{ $maquina->id }}','{{ $maquina->identificador }}','{{ $maquina->nombre }}','{{ $maquina->marcaId }}','{{ $maquina->modelo }}','{{ $maquina->submarca }}','{{ $maquina->ano }}','{{ $maquina->color }}','{{ $maquina->placas }}','{{ $maquina->numserie }}','{{ $maquina->nummotor }}','{{ $maquina->foto }}','{{ true }}')">
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
                                                    @can('maquinaria_mtq_edit')
                                                        <a href="#" data-bs-toggle="modal" data-bs-target="#editarItem"
                                                            onclick="cargaItem('{{ $maquina->id }}','{{ $maquina->identificador }}','{{ $maquina->nombre }}','{{ $maquina->marcaId }}','{{ $maquina->modelo }}','{{ $maquina->submarca }}','{{ $maquina->ano }}','{{ $maquina->color }}','{{ $maquina->placas }}','{{ $maquina->numserie }}','{{ $maquina->nummotor }}','{{ $maquina->foto }}','{{ false }}')">
                                                            <svg xmlns="http://www.w3.org/2000/svg " width="28"
                                                                height="28" fill="currentColor"
                                                                class="bi bi-pencil accionesIconos" viewBox="0 0 16 16">
                                                                <path
                                                                    d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                                                            </svg>
                                                        </a>
                                                    @endcan
                                                    {{-- @can('maquinaria_mtq_destroy') --}}
                                                    {{-- <form action="{{ route('mtq.delete', $maquina->id) }}"
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
                                                <td colspan="2">Sin registros.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer mr-auto">
                            {{ $maquinaria->links() }}
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
                    <h1 class="modal-title fs-5" id="exampleModalLabel">&nbsp Nueva Equipos MTQ</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row d-flex" action="{{ route('mtq.store') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        {{-- <input type="hidden" name="userId" id="userId" value="{{ $usuario->id }}"> --}}

                        <div class="row d-flex justify-content-center">
                            <div class="col-12 col-sm-6 align-items-center">
                                <div class="text-center mx-auto border vistaFoto mb-4">
                                    <i><img class="imgVista img-fluid mb-5"
                                            src="{{ asset('/img/general/default.jpg') }}"></i>
                                    <span class="mi-archivo">
                                        <input class="mb-4 ver" type="file" name="foto" id="mi-archivo2"
                                            accept="image/*">
                                    </span>
                                    <label for="mi-archivo2">
                                        <span>sube Imagen</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class=" col-12 col-sm-6 mb-3 ">
                            <label class="labelTitulo">Numero Económico:<span>*</span></label></br>
                            <input type="text" class="inputCaja" name="identificador"
                                value="{{ old('identificador') }}" placeholder="ej: MT-00" required>
                        </div>

                        <div class=" col-12 col-sm-6 mb-3 ">
                            <label class="labelTitulo">Equipo:<span>*</span></label></br>
                            <input type="text" class="inputCaja" name="nombre" value="{{ old('nombre') }}" required
                                placeholder="Especifique...">
                        </div>
                        <div class=" col-12 col-sm-6 mb-3 ">
                            <label class="labelTitulo">Marca:</label></br>
                            <select name='marca[]' class="form-select">
                                <option value="">Seleccione</option>
                                @foreach ($marcas as $item)
                                    <option value="{{ $item->id }}">
                                        {{ $item->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>


                        <div class=" col-12 col-sm-6 mb-3 ">
                            <label class="labelTitulo">Modelo:<span>*</span></label></br>
                            <input type="text" class="inputCaja" placeholder="Especifique..." name="modelo"
                                value="{{ old('modelo') }}" required>
                        </div>

                        <div class=" col-12 col-sm-6 mb-3 ">
                            <label class="labelTitulo">Sub Marca:</label></br>
                            <input type="text" class="inputCaja" placeholder="Especifique..." name="submarca"
                                value="{{ old('submarca') }}">
                        </div>

                        <div class="col-12 col-sm-6 mb-3 ">
                            <label class="labelTitulo">Año:</label></br>
                            <input type="number" class="inputCaja" maxlength="4" placeholder="Ej. 2000"
                                name="ano" value="{{ old('ano') }}">
                        </div>

                        <div class=" col-12 col-sm-6 mb-3 ">
                            <label class="labelTitulo">Color:</label></br>
                            <input type="text" class="inputCaja" placeholder="Ej. Amarillo" name="color"
                                value="{{ old('color') }}">
                        </div>

                        <div class=" col-12 col-sm-6 mb-3 ">
                            <label class="labelTitulo">Placas:</label></br>
                            <input type="text" class="inputCaja" placeholder="Ej. JAL-0000" name="placas"
                                value="{{ old('placas') }}">
                        </div>

                        <div class=" col-12 col-sm-6  mb-3 ">
                            <label class="labelTitulo">Número Serie -VIN:</label></br>
                            <input type="text" class="inputCaja" placeholder="Ej. NS01234ABCD" name="numserie"
                                value="{{ old('numserie') }}">
                        </div>

                        <div class=" col-12 col-sm-6  mb-3 ">
                            <label class="labelTitulo">Número Motor:</label></br>
                            <input type="text" class="inputCaja" placeholder="Ej. NUM0123ABCD" name="nummotor"
                                value="{{ old('nummotor') }}">
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

    <!-- Modal Editar Equipos MTQ-->
    <div class="modal fade" id="editarItem" tabindex="-1" aria-labelledby="exampleModalLabelEdit" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bacTituloPrincipal">
                    <h1 class="modal-title fs-5" id="exampleModalLabelEdit">&nbsp <span id="tituloModal">Editar</span>
                        Equipos MTQ</label>
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row d-flex" action="{{ route('mtq.update', 0) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <input type="hidden" name="id" value="" id="id">
                        <div class="row d-flex justify-content-center">
                            <div class="col-12 col-sm-6 align-items-center">
                                <div class="text-center mx-auto border vistaFoto mb-4">
                                    <i><img id="fotoImg" class="imgVista img-fluid mb-5"
                                            src="{{ asset('/img/general/default.jpg') }}"></i>
                                    <span class="mi-archivo">
                                        <input class="mb-4 ver" type="file" name="foto" id="mi-archivo"
                                            accept="image/*">
                                    </span>
                                    <div id="contenedorBotonSubirImagen">
                                        <label for="mi-archivo">
                                            <span>sube Imagen</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="puestoId" id="puestoId" value="">
                        <div class=" col-12 col-sm-6 mb-3 ">

                            <label class="labelTitulo">Numero Económico:<span>*</span></label></br>
                            <input type="text" class="inputCaja" id="identificador" name="identificador" readonly
                                value="" placeholder="ej: MT-00" required>
                        </div>

                        <div class=" col-12 col-sm-6  mb-3 ">
                            <label class="labelTitulo">Equipo:<span>*</span></label></br>
                            <input type="text" class="inputCaja" id="nombre" placeholder="Especifique..." required
                                name="nombre" value="">
                        </div>

                        <div class=" col-12 col-sm-6  mb-3 ">
                            <label class="labelTitulo">Marca:</label></br>
                            <select id="marca" name='marca[]' class="form-select">
                                <option value="">Seleccione</option>
                                @foreach ($marcas as $item)
                                    <option value="{{ $item->id }}">
                                        {{ $item->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>


                        <div class=" col-12 col-sm-6 mb-3 ">
                            <label class="labelTitulo">Modelo:<span>*</span></label></br>
                            <input type="text" class="inputCaja" id="modelo" placeholder="Especifique..." required
                                name="modelo" value="">
                        </div>

                        <div class=" col-12 col-sm-6 mb-3 ">
                            <label class="labelTitulo">Sub Marca:</label></br>
                            <input type="text" class="inputCaja" id="submarca" placeholder="Especifique..."
                                name="submarca" value="">
                        </div>

                        <div class=" col-12 col-sm-6 mb-3 ">
                            <label class="labelTitulo">Año:</label></br>
                            <input type="text" class="inputCaja" id="ano" maxlength="4"
                                placeholder="Ej. 2000" name="ano" value="">
                        </div>

                        <div class=" col-12 col-sm-6 mb-3 ">
                            <label class="labelTitulo">Color:</label></br>
                            <input type="text" class="inputCaja" id="color" placeholder="Ej. Amarillo"
                                name="color" value="">
                        </div>

                        <div class=" col-12 col-sm-6 mb-3 ">
                            <label class="labelTitulo">Placas:</label></br>
                            <input type="text" class="inputCaja" id="placas" placeholder="Ej. JAL-0000"
                                name="placas" value="">
                        </div>

                        <div class="col-12 col-sm-6 mb-3 ">
                            <label class="labelTitulo">Número Serie -VIN:</label></br>
                            <input type="text" class="inputCaja" id="numserie" placeholder="Ej. NS01234ABCD"
                                name="numserie" value="">
                        </div>

                        <div class=" col-12 col-sm-6  mb-3 ">
                            <label class="labelTitulo">Número Motor:</label></br>
                            <input type="text" class="inputCaja" id="nummotor" placeholder="Ej. NUM0123ABCD"
                                name="nummotor" value="">
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <div id="contenedorBotonGuardar">
                                <button type="submit" class="btn botonGral" id="btnTareaGuardar"
                                    onclick="alertaGuardar()">Guardar cambios</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <style>
        .align-end {
            display: flex !important;
            justify-content: flex-end !important;
        }

        @media only screen and (max-width: 500px) {
            .align-end button {
                width: 120px !important;
            }
            #submit-button {
                margin-right: 0px !important;
            }
        }

        select[readonly],
        input[readonly],
        textarea[readonly] {
            color: grey;
            cursor: no-drop;
        }


        select[readonly] option {
            display: none;
        }
    </style>
    <script>
        function handleDocumento(id) {
		
            // Resto del código que utilizas para manejar los eventos, pero ahora con el ID proporcionado
            var facturaInput = document.getElementById(id);
            
            var downloadFacturaButton = document.getElementById("downloadButton");
            var removeFacturaButton = document.getElementById("removeButton");
            var iconContainer = document.getElementById("iconContainer");

            facturaInput.addEventListener("change", function(event) {
                let alertShownEdit = false;
                console.log('facturaInput.value', facturaInput.value);
                
                if (event.target.files.length > 0) {
                    
                    facturaInput.addEventListener("click", createClickHandler(id));
                    var file = event.target.files[0];
                    var fileURL = URL.createObjectURL(file);
                    downloadFacturaButton.setAttribute("href", fileURL);
                    downloadFacturaButton.style.display = "block";
                    removeFacturaButton.style.display = "block";
                    //nullInput.value = id + '-1';
                    alertShown = false;
                    iconContainer.innerHTML =
                        '<lord-icon src="https://cdn.lordicon.com/nxaaasqe.json" trigger="hover" colors="primary:#86c716,secondary:#e8e230" style="width:50px;height:70px"></lord-icon>';
                } else {
                    downloadFacturaButton.style.display = "none";
                    removeFacturaButton.style.display = "none";
                    alertShown = false;
                    iconContainer.innerHTML =
                        '<lord-icon src="https://cdn.lordicon.com/koyivthb.json" trigger="hover" colors="primary:#86c716,secondary:#e8e230" stroke="65" style="width:50px;height:70px"></lord-icon>';
                }
            });
            removeFacturaButton.addEventListener("click", function() {
                facturaInput.value = null;
                downloadFacturaButton.removeAttribute("href");
                downloadFacturaButton.style.display = "none";
                removeFacturaButton.style.display = "none";
                
                
                iconContainer.innerHTML =
                    '<lord-icon src="https://cdn.lordicon.com/koyivthb.json" trigger="hover" colors="primary:#86c716,secondary:#e8e230" stroke="65" style="width:50px;height:70px"></lord-icon>';
            });
        }
    </script>
    <script>
        document.getElementById('submit-button').addEventListener('click', function() {
            // Obtener el elemento de entrada de archivo
            var fileInput = document.getElementById('excel-file-input');
            
            // Verificar si se ha seleccionado un archivo
            if (fileInput.files.length > 0) {
                // Enviar el formulario si se ha seleccionado un archivo
                document.getElementById('excel-upload-form').submit();
            } else {
                // Mostrar un mensaje o realizar otra acción si no se ha seleccionado un archivo
                alert('Por favor, selecciona un archivo Excel para importar.');
            }
        });
    </script>
    <script>
        function cargaItem(id, identificador, nombre, marca, modelo, submarca, ano, color, placas, numserie, nummotor, img,
            modalTipo) {

            const txtId = document.getElementById('id');
            txtId.value = id;

            const contenedorBotonGuardar = document.getElementById('contenedorBotonGuardar');
            const contenedorBotonSubirImagen = document.getElementById('contenedorBotonSubirImagen');
            if (modalTipo) {
                contenedorBotonSubirImagen.style.display = 'none';
            } else {
                contenedorBotonSubirImagen.style.display = 'block';
            }

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
            txtIdentificador.readOnly = true;

            const txtNombre = document.getElementById('nombre');
            txtNombre.value = nombre;
            txtNombre.readOnly = modalTipo;

            const txtMarca = document.getElementById('marca');
            //txtMarca.readOnly = modalTipo;
            console.log("marca", marca);
            for (let i = 0; i < txtMarca.options.length; i++) {
                if (txtMarca.options[i].value == marca) {
                    // txtMarca.options[i].selected = true;
                    txtMarca.selectedIndex = i;
                }
            }

            const txtModelo = document.getElementById('modelo');
            txtModelo.value = modelo;
            txtModelo.readOnly = modalTipo;

            const txtSubmarca = document.getElementById('submarca');
            txtSubmarca.value = submarca;
            txtSubmarca.readOnly = modalTipo;

            const txtAno = document.getElementById('ano');
            txtAno.value = ano;
            txtAno.readOnly = modalTipo;

            const txtColor = document.getElementById('color');
            txtColor.value = color;
            txtColor.readOnly = modalTipo;

            const txtPlacas = document.getElementById('placas');
            txtPlacas.value = placas;
            txtPlacas.readOnly = modalTipo;

            const txtNumserie = document.getElementById('numserie');
            txtNumserie.value = numserie;
            txtNumserie.readOnly = modalTipo;

            const txtNummotor = document.getElementById('nummotor');
            txtNummotor.value = nummotor;
            txtNummotor.readOnly = modalTipo;

            const imagenVista = document.getElementById('fotoImg');
            console.log('imagen 1', img);
            if (img != "" && img != null) {
                imagenVista.src = "{{ asset('/storage/maquinaria/') }}/" + identificador + "/" + img;
            } else {
                imagenVista.src = "{{ asset('/img/general/default.jpg') }}"
            }
            // Obtener todos los campos del formulario
            const campos = document.querySelectorAll('input[type="text"], textarea');

            // Aplicar color gris a los campos con readonly
            campos.forEach((campo) => {
                if (modalTipo ) {
                    campo.readOnly = true;
                    
                    // campo.style.cursor:no-drop;
                } else {
                    campo.readOnly = false;
                    campo.style.color = 'initial';
                    // campo.style.cursor:no-drop;
                }
                if(campo == txtIdentificador){
                    campo.readOnly = true;
                    campo.style.color = 'grey';
                }
            });
        }
    </script>

    <script>
        // Función para crear el manejador de eventos "click" usando el ID específico
	function createClickHandler(id) {
        return function (event) {
            var facturaInput = document.getElementById(id);
            var iconContainer = document.getElementById("iconContainer");
            var icon = document.getElementById("icon");
            var expectedIconHTML =
            '<lord-icon src="https://cdn.lordicon.com/nxaaasqe.json" trigger="hover" colors="primary:#86c716,secondary:#e8e230" style="width:50px;height:70px"></lord-icon>';
            console.log('expectedIconHTML',expectedIconHTML);
    
            if (!alertShown && iconContainer.innerHTML === expectedIconHTML) {
            event.stopPropagation(); // Prevent the file explorer from opening immediately
            event.preventDefault(); // Prevent any default behavior
    
            Swal.fire({
                title: "¿Estás seguro?",
                text: "Se reemplazará la imagen actual por una nueva. ¿Deseas continuar?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Continuar",
                cancelButtonText: "Cancelar",
            }).then((result) => {
                if (result.isConfirmed) {
                alertShown = true; // Set the flag to true to prevent the alert from showing again
                facturaInput.click();
                }
            });
            }
        };
        }
    </script>

    <script src="{{ asset('js/alertas.js') }}"></script>

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
    </script>
@endsection
