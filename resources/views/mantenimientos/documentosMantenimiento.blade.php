@extends('layouts.main', ['activePage' => ( $mantenimiento->compania == true ? 'mtq' : 'mantenimiento'), 'titlePage' => __('Alta de Documentos')])
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
                <div class="col-12 align-self-start">
                    <div class="card">
                        <div class="card-body contCart">
                            <div class="ml-3">
                                <div class="p-1 align-self-start bacTituloPrincipal">
                                    <h2 class="my-3 ms-3 texticonos">{{ $mantenimiento->compania == 'mtq' ? 'MTQ' : '' }}
                                        Subir Imagenes del Documento Sellado</h2>
                                </div>
                                <div>
                                    <div class="col-4 text-left mt-3" style="margin-left:20px">
                                        <form
                                            action="{{ $mantenimiento->compania == 'mtq' ? route('mantenimientos.indexMtq') : route('mantenimientos.index') }}"
                                            method="GET" style="display: inline-block;">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $id }}">
                                            <button class="btnSinFondo btn regresar" type="submit" rel="tooltip">
                                                <span class="material-icons">
                                                    reply
                                                </span>
                                                Regresar
                                            </button>
                                        </form>
                                    </div>
                                    <div class="d-flex p-3 divBorder" style="margin-top:-15px"></div>
                                </div>

                                <form action="{{ route('documentoSelladoMantenimiento.update', $id) }}" method="post"
                                    class="row alertaGuardar" enctype="multipart/form-data">
                                    @csrf
                                    @method('put')
                                    <input type="hidden" name="userId" id="userId" value="{{ auth()->user()->id }}">
                                    <input type="hidden" name="mantenimientoId" value="{{ $id }}">
                                    <div class="row mt-3" style="padding-left: 40px">

                                        <div class="d-flex p-3">
                                            <div class="col-12" id="elementos">
                                                <div class="d-flex">
                                                    <div class="col-12 divBorder">
                                                        <h2 class="tituloEncabezado ">Equipo:
                                                            {{ $mantenimiento->maquinaria }}, Folio:
                                                            {{ str_pad($id, 4, '0', STR_PAD_LEFT) }}</h2>
                                                    </div>
                                                </div>

                                                <div class="row opcion divBorderItems" id="opc">

                                                    <div class="col-12 col-md-12 px-2 mt-4">
                                                        <div class="text-center mx-auto border  mb-4">
                                                            {{-- <a id='downloadButton{{ $item->id }}'
    class="btnViewDescargar btn btn-outline-success btnView"
    download
    href="{{ asset('/storage/maquinaria/' . str_pad($maquinaria->identificador, 4, '0', STR_PAD_LEFT) . '/documentos/' . $item->nombre . '/' . $item->ruta) }}">
    <span class="btn-text">Descargar</span>
    <span class="icon">
        <i class="far fa-eye mt-2"></i>
    </span>
</a> --}}
                                                            <div class="col-12 contFotoMaquinaria" id="visor">
                                                                <a id="visorDownload" href="" target="_blank" title="Clic para descargar"
                                                                    class="mx-auto d-block img-fluid imgMaquinaria">
                                                                    <img src="{{ empty($fotos[0]) ? '/img/general/default.jpg' : asset('/storage/maquinaria/' . str_pad($id, 4, '0', STR_PAD_LEFT) . '/mantenimientosDocumentoFirmado/' . $mantenimiento->codigo . '/' . $fotos[0]->ruta) }}"
                                                                        class="imgMaquinaria">
                                                                     </a>
                                                            </div>
                                                            {{-- '/public/maquinaria/' . $pathMaquinaria. '/mantenimientosDocumentoFirmado/'. $mantto->codigo --}}
                                                            <div class="col-12 my-3 d-flex justify-content-center"
                                                                id="selectores">
                                                                @if (is_null($fotos) == false)
                                                                    @forelse ($fotos as $foto)
                                                                        @php
                                                                            $fileDownload = asset('/storage/maquinaria/' . str_pad($id, 4, '0', STR_PAD_LEFT) . '/mantenimientosDocumentoFirmado/' . $mantenimiento->codigo . '/' . $foto->ruta);
                                                                            $fileInfo = pathinfo($fileDownload);

                                                                            if ($fileInfo['extension'] != 'pdf') {
                                                                                $file = asset('/storage/maquinaria/' . str_pad($id, 4, '0', STR_PAD_LEFT) . '/mantenimientosDocumentoFirmado/' . $mantenimiento->codigo . '/' . $foto->ruta);
                                                                            } else {
                                                                                $file = '/img/general/documento.jpg';
                                                                            }
                                                                            // dd($fileDownload);
                                                                        @endphp
                                                                        <img onclick="abre(this, '{{ $fileDownload }}');"
                                                                            title="{{ $fileInfo['basename'] }}"
                                                                            src="{{ $file }}"
                                                                            class="img-fluid mb-5"
                                                                            id="img{{ $foto->id }}"
                                                                            style="margin-right:3px; z-index: 2">
                                                                        <div class="form-group"
                                                                            style="z-index: 9999 !important">
                                                                            <div class="divButtonImage">
                                                                                <button type="button"
                                                                                    class="btn btn-secondary btn-sm buttonImage"
                                                                                    id="btnDelete{{ $foto->id }}"
                                                                                    onclick="esconde_div('{{ $foto->id }}','{{ $fotos }}', (this));">X</button>
                                                                            </div>
                                                                        </div>



                                                                    @empty
                                                                    @endforelse
                                                                @endif
                                                            </div>

                                                            @php
                                                                $numFotosPermitidas = 0;
                                                                $numFotosCargadas = count($fotos);
                                                                $maxNumFotos = 3;
                                                                $numFotosPermitidas = $maxNumFotos - $numFotosCargadas;
                                                            @endphp

                                                            @if ($numFotosPermitidas > 0)
                                                                <span class="mi-archivo">
                                                                    <input class="mb-4 ver " type="file" name="ruta[]"
                                                                        id="mi-archivo" accept="image/*,.pdf" multiple
                                                                        data-max="{{ $numFotosPermitidas }}">
                                                                </span>
                                                                <label for="mi-archivo">
                                                                    <span class="">Sube los archivos (Imágenes o Documentos PDF)
                                                                        (Puedes subir hasta
                                                                        {{ $numFotosPermitidas }}
                                                                        más)</span>
                                                                </label>
                                                            @else
                                                                <label for="mi-archivo"
                                                                    style="background-color: crimson; cursor: initial;">
                                                                    <span class="">No puedes
                                                                        subir más archivos, <br>ya has
                                                                        alcanzado el
                                                                        límite de 3.</span>
                                                                </label>
                                                            @endif
                                                        </div>

                                                        <div class="text-center mx-auto border  mb-4">

                                                        </div>

                                                        <input type="hidden" name="arrayFotosPersistente"
                                                            id="arrayFotosPersistente" value="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 text-center mb-3 mt-3">
                                        <button type="submit" class="btn botonGral"
                                            onclick="alertaGuardar()">Guardar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <style>
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

        <script src="{{ asset('js/cardArchivos.js') }}"></script>

        <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
            crossorigin="anonymous"></script>

        <script>
            var contador = 1;

            function crearItems() {
                contador++;
                var $nuevoElemento = $('.opcion:first').clone();
                $nuevoElemento.find("input").val("");

                // Modificar los IDs de los inputs
                $nuevoElemento.find("input").each(function() {
                    var idOriginal = $(this).attr("id");
                    var nuevoId = idOriginal + contador;
                    $(this).attr("id", nuevoId);
                });

                $nuevoElemento.find("a[id='downloadButton']").each(function() {
                    var idOriginal = $(this).attr("id");
                    var nuevoId = idOriginal + contador;
                    $(this).attr("id", nuevoId);
                });
                // Modificar los IDs de los elementos con id="downloadButtonXML"
                $nuevoElemento.find("a[id='downloadButtonXML']").each(function() {
                    var idOriginal = $(this).attr("id");
                    var nuevoId = idOriginal + contador;
                    $(this).attr("id", nuevoId);
                });


                $nuevoElemento.find("button[id='removeButton']").each(function() {
                    var idOriginal = $(this).attr("id");
                    var nuevoId = idOriginal + contador;
                    $(this).attr("id", nuevoId);
                });
                // Modificar los IDs de los elementos con id="removeButtonXML"
                $nuevoElemento.find("button[id='removeButtonXML']").each(function() {
                    var idOriginal = $(this).attr("id");
                    var nuevoId = idOriginal + contador;
                    $(this).attr("id", nuevoId);
                });


                $nuevoElemento.find("div[id='iconContainer']").each(function() {
                    var idOriginal = $(this).attr("id");
                    var nuevoId = idOriginal + contador;
                    $(this).attr("id", nuevoId);
                });
                // Modificar los IDs de los elementos con id="iconContainerXML"
                $nuevoElemento.find("div[id='iconContainerXML']").each(function() {
                    var idOriginal = $(this).attr("id");
                    var nuevoId = idOriginal + contador;
                    $(this).attr("id", nuevoId);
                });

                $nuevoElemento.find("label[class='custom-file-upload']").each(function() {
                    var idOriginal = $(this).attr("id");
                    var nuevoId = idOriginal + contador;
                    $(this).attr("id", nuevoId);
                });

                /*$nuevoElemento.find("span[class='iconXML']").each(function() {
                    var idOriginal = $(this).attr("id");
                    var nuevoId = idOriginal + contador;
                    $(this).attr("id", nuevoId);
                });

                $nuevoElemento.find("span[class='icon']").each(function() {
                    var idOriginal = $(this).attr("id");
                    var nuevoId = idOriginal + contador;
                    $(this).attr("id", nuevoId);
                });*/

                $nuevoElemento.appendTo('#elementos');
            }

            // Borrar registro
            $(document).on('click', '#removeRow', function() {
                if ($('.opcion').length > 1) {
                    $(this).closest('.opcion').remove();
                }
            });
        </script>


        <script>
            function handleDocumento(id, button) {
                console.log('BUTTON', button.id);
                let idDinamico = button.id;
                // Resto del código que utilizas para manejar los eventos, pero ahora con el ID proporcionado
                var facturaInput = document.getElementById(id + idDinamico);

                var downloadFacturaButton = document.getElementById("downloadButton" + idDinamico);
                var removeFacturaButton = document.getElementById("removeButton" + idDinamico);
                var iconContainer = document.getElementById("iconContainer" + idDinamico);

                facturaInput.addEventListener("change", function(event) {
                    let alertShownEdit = false;
                    console.log('facturaInput.value', facturaInput.value);

                    if (event.target.files.length > 0) {

                        facturaInput.addEventListener("click", createClickHandler(id, idDinamico));
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
            // Función para crear el manejador de eventos "click" usando el ID específico
            function createClickHandler(id, buttonId) {
                return function(event) {
                    var facturaInput = document.getElementById(id + buttonId);
                    var iconContainer = document.getElementById("iconContainer" + buttonId);
                    var icon = document.getElementById("icon");
                    var expectedIconHTML =
                        '<lord-icon src="https://cdn.lordicon.com/nxaaasqe.json" trigger="hover" colors="primary:#86c716,secondary:#e8e230" style="width:50px;height:70px"></lord-icon>';
                    console.log('expectedIconHTML', expectedIconHTML);

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

        <script>
            function handleDocumentoXML(id, button) {
                let idDinamico = button.id;
                // Resto del código que utilizas para manejar los eventos, pero ahora con el ID proporcionado
                var facturaInput = document.getElementById(id + idDinamico);

                console.log(idDinamico);
                var downloadFacturaButton = document.getElementById("downloadButtonXML" + idDinamico);
                var removeFacturaButton = document.getElementById("removeButtonXML" + idDinamico);
                var iconContainer = document.getElementById("iconContainerXML" + idDinamico);

                facturaInput.addEventListener("change", function(event) {
                    let alertShownEdit = false;
                    console.log('facturaInput.value', facturaInput.value);

                    if (event.target.files.length > 0) {

                        facturaInput.addEventListener("click", createClickHandlerXML(id, idDinamico));
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
            // Función para crear el manejador de eventos "click" usando el ID específico
            function createClickHandlerXML(id, buttonId) {
                return function(event) {
                    var facturaInput = document.getElementById(id + buttonId);
                    var iconContainer = document.getElementById("iconContainerXML" + buttonId);
                    var icon = document.getElementById("iconXML");
                    var expectedIconHTML =
                        '<lord-icon src="https://cdn.lordicon.com/nxaaasqe.json" trigger="hover" colors="primary:#86c716,secondary:#e8e230" style="width:50px;height:70px"></lord-icon>';
                    console.log('expectedIconHTML', expectedIconHTML);

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

        <script>
            function abre(T, archivo) {
                var ruta = T.src.replace("/s90-Ic42/", "/s590-Ic42/");
                document.querySelector("#visor img").src = ruta;

                const txtDown = document.getElementById('visorDownload');
                txtDown.href = archivo;

            }
        </script>

        <style>
            /* Macbook Pro / laptop */
            @media only screen and (min-width: 992px) and (max-width: 1440px) {

                /*ALta maquinaria*/
                .inputNumberKilometrajeEdit {
                    width: 35%;
                }

                .inputKilometrajeEdit {
                    width: 65%;
                    font-size: 11px;
                }
            }
        </style>

        <script src="{{ asset('js/cardArchivos.js') }}"></script>

        <script>
            function deleteImage(id, fotos, button) {
                console.log('ID de imagen', id);
                let jsonFotos = JSON.parse(fotos);
                console.log('Fotos', jsonFotos);
                var childDiv = document.getElementById('selectores').firstChild;

                //var parentDiv = button.parentNode.parentNode.parentNode;

                var childDiv = button.parentNode.parentNode.parentNode;

                // Modificar el selector para que coincida con la clase de la imagen
                var imageElement = childDiv.querySelector("img.img-fluid");
                var parentDivButton = button.parentNode.parentNode;
                var imageId = imageElement.id;
                console.log('imageElement', imageElement);

                // Cambiar la imagen que se muestra
                if (imageElement) {

                }
            }

            // Inicializar arrayFotosPersistente
            let arrayFotosPersistente = [];

            // Función para inicializar el arreglo persistente con el arreglo original
            // function inicializarArrayFotos(fotos) {
            //     arrayFotosPersistente = JSON.parse(fotos);
            //     console.log('HOLA',arrayFotosPersistente);
            // }

            function esconde_div(id, fotos, button) {

                console.log('fotos', fotos);
                let arrayFotos = JSON.parse(fotos);
                const index = arrayFotos.findIndex((foto) => foto.id == id);

                // Si se encontró el objeto con el id coincidente, eliminarlo del array
                if (index !== -1) {
                    arrayFotosPersistente.push(arrayFotos[index]);

                } else {
                    console.log('El id no se encontró en arrayFotosPersistente.');
                }
                console.log('arrayFotosPersistente', arrayFotosPersistente);
                var parentDiv = button.parentNode.parentNode.parentNode;
                // Modificar el selector para que coincida con la clase de la imagen
                var imageElement = parentDiv.querySelector("img.img-fluid");
                var deleteButton = document.getElementById('btnDelete' + id);
                var imageElement = document.getElementById("img" + id);


                // Ocultar el elemento padre
                imageElement.style.visibility = "hidden";
                deleteButton.style.visibility = "hidden";

                const arrayFotosPersistenteHidden = document.getElementById('arrayFotosPersistente');
                arrayFotosPersistenteHidden.value = JSON.stringify(arrayFotosPersistente);
            }
            // $.ajax({
            //     type: 'put',
            //     url: '/maquinaria/imagen/delete',
            //     data: {
            //         "_token": "{{ csrf_token() }}",
            //         "id": id
            //     },
            //     success: function(data) {
            //         console.log('Funciona');
            //     },
            //     error: function() {
            //         console.log('Error');
            //     }
            // });
        </script>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                document.getElementById('mi-archivo').addEventListener('change', function() {
                    var input = this;
                    var maxAllowed = parseInt(input.getAttribute('data-max'));

                    if (input.files.length > maxAllowed) {
                        input.value = "";
                        Swal.fire({
                            icon: 'error',
                            title: 'Error...',
                            text: '3 imagenes es el maximo permitido ',
                        })

                    }
                });
            });
        </script>

    @endsection
