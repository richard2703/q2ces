@extends('layouts.main', ['activePage' => 'maquinaria', 'titlePage' => __('Alta de Accesorios')])
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
                                <h2 class="my-3 ms-3 texticonos">Editar Facturas</h2>
                            </div>
                            <div>
                                <div class="col-4 text-left mt-3" style="margin-left:20px">
                                    <form action="{{ route('facturaProvedor.index') }}" method="GET" style="display: inline-block;">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $facturaProvedor[0]->provedorId }}">
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

                            <form action="{{ route('facturaProvedor.update', $id) }}"
                                method="post" class="row alertaGuardar" enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <input type="hidden" name="userId" id="userId" value="{{ auth()->user()->id }}">
                                
                                <div class="row mt-3" style="padding-left: 40px">
                                    <div class=" col-12 col-sm-6 mb-3 pr-3">
                                        <label class="labelTitulo">Provedor:<span>*</span></label></br>
                                        <select name="provedorId" class="form-select" aria-label="Default select example" readonly>
                                            <option value="">Seleccione</option>
                                            @foreach ($provedor as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ $item->id == $facturaProvedor[0]->provedorId ? ' selected' : '' }}>
                                                    {{ $item->nombre }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                    {{--  <div class=" col-12 col-sm-6 mb-3 ">
                                        <label class="labelTitulo">Estado:</label></br>
                                        <input type="email" class="inputCaja" required placeholder="Estado del Provedor..."
                                            min="6" name="email" value="{{ $provedorSelected->estado }}" readonly>
                                    </div>

                                    <div class=" col-12 col-sm-6 mb-3 ">
                                        <label class="labelTitulo">Colonia:</label></br>
                                        <input type="email" class="inputCaja" required placeholder="Colonia del Provedor..."
                                            min="6" name="email" value="{{ $provedorSelected->colonia }}" readonly>
                                    </div>

                                    <div class=" col-12 col-sm-6 mb-3 ">
                                        <label class="labelTitulo">Ciudad:</label></br>
                                        <input type="text" class="inputCaja" id="ciudad" name="ciudad" required placeholder="Ciudad del Provedor..."
                                            value="{{ $provedorSelected->ciudad }}" placeholder="Estado..." readonly>
                                    </div>
                                    <div class=" col-12  mb-3 ">
                                        <label class="labelTitulo">Comentarios:</label></br>
                                        <textarea readonly class="form-control border-green" placeholder="Comentarios del Respecto al Provedor..." id="floatingTextarea" name="comentario"
                                            spellcheck="true">{{ $provedorSelected->comentario }}</textarea>
                                    </div>  --}}
                                    {{--  <div class=" col-12 col-sm-6 mb-3 ">
                                        <label class="labelTitulo">Puesto:<span>*</span></label></br>
                                        <input type="text" class="inputCaja" id="puesto" name="puesto" required
                                            value="{{ old('puesto') }}" required placeholder="Especifique...">
                                    </div>  --}}
            
                                    @can('residente_mtq_assign_vehiculo')
                                        {{--  <div class=" col-12 col-sm-6 mb-3 ">
                                            <label class="labelTitulo">Auto: <span></span></label></br>
                                            <select name="autoId" class="form-select" aria-label="Default select example">
                                                <option value="">Seleccione</option>
                                                @foreach ($maquinaria as $item)
                                                    <option value="{{ $item->id }}">
                                                        {{ $item->identificador }} {{ $item->nombre }} {{ $item->modelo }} {{ $item->placas }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>  --}}
                                    @endcan

                                    <div class="d-flex p-3">
                                        <div class="col-12" id="elementos">
                                            <div class="d-flex">
                                                <div class="col-6 divBorder">
                                                    <h2 class="tituloEncabezado ">Facturas</h2>
                                                </div>
                                                <div class="col-6 divBorder pb-3 text-end">
                                                    {{--  <button type="button" class="btnVerde"
                                                        onclick="crearItems()">
                                                    </button>  --}}
                                                </div>
                                            </div>

                                            @forelse($facturaProvedor as $factura)
                                            <div class="row opcion divBorderItems" id="opc">

                                                <div class="col-5 mb-3 ">
                                                    <label class="labelTitulo mt-2">Folio:* <span></span></label></br>

                                                    <input type="text" class="inputCaja" id="" name="folio" required placeholder="Folio de la Factura..."
                                                        value="{{ $factura->folio }}">
                                                </div>

                                                <div class="col-5 mb-3 ">
                                                    <label class="labelTitulo mt-2">Fecha:* <span></span></label></br>

                                                    <input type="date" class="inputCaja" id="fecha" name="fecha" required placeholder="Fecha de la Factura..."
                                                    value="{{ $factura->fecha }}">
                                                </div>

                                                <div class="col-lg-1 my-3 text-center pt-2">
                                                    <span class="material-icons"
                                                        style="font-size:40px; color: green">
                                                        request_quote
                                                    </span>
                                                </div>
                                                <div class="col-lg-1 my-3 text-end">
                                                    <button type="button" id="removeRow"
                                                        class="btnRojo"></button>
                                                </div>
                                                <div class="col-6 mb-3 ">
                                                    <label class="labelTitulo mt-2">Subir PDF:* <span></span></label></br>
                                                    @if ($factura->pdf)
                                                    <div style="display: flex; align-items: center;">
                                                        <label class="custom-file-upload" id="" onclick='handleDocumento("excel-file-input")'>
                                                            <input class="mb-4" type="file" name="pdf" id="excel-file-input"
                                                                accept=".pdf" value="{{$factura->pdf}}">
                                                            <div id='iconContainer'>
                                                                <lord-icon src="https://cdn.lordicon.com/nxaaasqe.json" trigger="hover" colors="primary:#86c716,secondary:#e8e230" style="width:50px;height:70px"></lord-icon>
                                                            </div>
                                                        </label>
            
                                                        <a id="downloadButton" class="btnViewDescargar btn btn-outline-success btnView" style="width: 2.8em; height: 2.8em; display: block;" download="" href="{{ asset('/storage/provedor/' . $factura->provedorId . '/facturas/' . $factura->pdf ) }}">
                                                            <span class="icon">
                                                                <i class="far fa-eye mt-2" style="font-size: 18px !important;"></i>
                                                            </span>
                                                        </a>
            
                                                        <button id='removeButton' type="button"
                                                            class="btnViewDelete btn btn-outline-danger btnView"
                                                            style="width: 2.4em; height: 2.4em;">
                                                            <i class="fa fa-times"></i>
                                                        </button>
                                                    </div>
                                                    @else
                                                    <div style="display: flex; align-items: center;">
                                                        <label class="custom-file-upload" id="" onclick='handleDocumento("excel-file-input")'>
                                                            <input class="mb-4" type="file" id="excel-file-input"
                                                                accept=".pdf">
                                                            <div id='iconContainer'>
                                                                <lord-icon src="https://cdn.lordicon.com/koyivthb.json" trigger="hover"
                                                                    colors="primary:#86c716,secondary:#e8e230" stroke="65"
                                                                    style="width:50px;height:70px">
                                                                </lord-icon>
                                                            </div>
                                                        </label>
            
                                                        <a id='downloadButton' class="btnViewDescargar btn btn-outline-success btnView"
                                                            style="width: 2.8em; height: 2.8em; display: none;" download>
                                                            <span class="btn-text">Descargar</span>
                                                            <span class="icon">
                                                                <i class="far fa-eye mt-2"></i>
                                                            </span>
                                                        </a>
            
                                                        <button id='removeButton' type="button"
                                                            class="btnViewDelete btn btn-outline-danger btnView"
                                                            style="width: 2.4em; height: 2.4em; display: none;">
                                                            <i class="fa fa-times"></i>
                                                        </button>
                                                    </div>
                                                    @endif
                                                    
                                                </div>
                                                <div class="col-6 mb-3 ">
                                                    <label class="labelTitulo mt-2">Subir XML:* <span></span></label></br>

                                                    @if ($factura->xml)
                                                    <div style="display: flex; align-items: center;">
                                                        <label class="custom-file-upload" onclick='handleDocumentoXML("xml-file-input")'>
                                                            <input class="mb-4" type="file" name="xml" id="xml-file-input"
                                                                accept=".xml" value="{{$factura->xml}}">
                                                            <div id='iconContainerXML'>
                                                                <lord-icon src="https://cdn.lordicon.com/nxaaasqe.json" trigger="hover" colors="primary:#86c716,secondary:#e8e230" style="width:50px;height:70px"></lord-icon>
                                                            </div>
                                                        </label>
            
                                                        {{--  <a id='downloadButtonXML' class="btnViewDescargar btn btn-outline-success btnView"
                                                            style="width: 2.8em; height: 2.8em; display: none;" download>
                                                            <span class="btn-text">Descargar</span>
                                                            <span class="iconXML">
                                                                <i class="far fa-eye mt-2" style="font-size: 18px !important;"></i>
                                                            </span>
                                                        </a>  --}}
                                                        <a id="downloadButtonXML" class="btnViewDescargar btn btn-outline-success btnView" style="width: 2.8em; height: 2.8em; display: block;" download="" href="{{ asset('/storage/provedor/' . $factura->provedorId . '/facturas/' . $factura->xml ) }}">
                                                            <span class="icon">
                                                                <i class="far fa-eye mt-2" style="font-size: 18px !important;"></i>
                                                            </span>
                                                        </a>
            
                                                        <button id='removeButtonXML' type="button"
                                                            class="btnViewDelete btn btn-outline-danger btnView"
                                                            style="width: 2.4em; height: 2.4em">
                                                            <i class="fa fa-times"></i>
                                                        </button>
                                                    </div>

                                                    @else
                                                    <div style="display: flex; align-items: center;">
                                                        <label class="custom-file-upload" onclick='handleDocumentoXML("xml-file-input")'>
                                                            <input class="mb-4" type="file" name="xml" id="xml-file-input"
                                                                accept=".xml">
                                                            <div id='iconContainerXML'>
                                                                <lord-icon src="https://cdn.lordicon.com/koyivthb.json" trigger="hover"
                                                                    colors="primary:#86c716,secondary:#e8e230" stroke="65"
                                                                    style="width:50px;height:70px">
                                                                </lord-icon>
                                                            </div>
                                                        </label>
            
                                                        <a id='downloadButtonXML' class="btnViewDescargar btn btn-outline-success btnView"
                                                            style="width: 2.8em; height: 2.8em; display: none;" download>
                                                            <span class="btn-text">Descargar</span>
                                                            <span class="iconXML">
                                                                <i class="far fa-eye mt-2" style="font-size: 18px !important;"></i>
                                                            </span>
                                                        </a>
            
                                                        <button id='removeButtonXML' type="button"
                                                            class="btnViewDelete btn btn-outline-danger btnView"
                                                            style="width: 2.4em; height: 2.4em; display: none;">
                                                            <i class="fa fa-times"></i>
                                                        </button>
                                                    </div>
                                                    @endif
                                                    
                                                </div>
                                                
                                            </div>
                                            @empty
                                                <h1>JHOSK</h1>
                                            @endforelse
                                        </div>
                                        
                                    </div>
                                </div>
                       
                                    <div class="col-12 text-center mb-3 mt-3">
                                        <button type="submit" class="btn botonGral"
                                            onclick="alertaGuardar()">Guardar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        select[readonly], input[readonly], textarea[readonly]{
            color: grey;
            cursor:no-drop;
        }
        
        select[readonly] option{
            display:none;
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

                iconContainer.innerHTML ='<lord-icon src="https://cdn.lordicon.com/koyivthb.json" trigger="hover" colors="primary:#86c716,secondary:#e8e230" stroke="65" style="width:50px;height:70px"></lord-icon>';
            });
        }
    </script>

    <script>
        // Función para crear el manejador de eventos "click" usando el ID específico
        function createClickHandler(id) {
            return function(event) {
                var facturaInput = document.getElementById(id);
                var iconContainer = document.getElementById("iconContainer");
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
        function handleDocumentoXML(id) {
            // Resto del código que utilizas para manejar los eventos, pero ahora con el ID proporcionado
            var facturaInput = document.getElementById(id);
            
            var downloadFacturaButton = document.getElementById("downloadButtonXML");
            var removeFacturaButton = document.getElementById("removeButtonXML");
            var iconContainer = document.getElementById("iconContainerXML");

            facturaInput.addEventListener("change", function(event) {
                let alertShownEdit = false;
                console.log('facturaInput.value', facturaInput.value);

                if (event.target.files.length > 0) {

                    facturaInput.addEventListener("click", createClickHandlerXML(id));
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
        function createClickHandlerXML(id) {
            return function(event) {
                var facturaInput = document.getElementById(id);
                var iconContainer = document.getElementById("iconContainerXML");
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
    
@endsection