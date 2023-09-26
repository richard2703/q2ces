@extends('layouts.main', ['activePage' => 'maquinaria', 'titlePage' => __('Alta de Maquinaria')])
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
        <div class="container-fluid mb-2">
            <div class="row justify-content-center">
                <div class="col-12 align-self-center">
                    <div class="col-12">

                        <div class="card-body contCart">
                            <div class="text-left">
                                <a href="{{ route('maquinaria.index') }}">
                                    <button class="btn regresar">
                                        <span class="material-icons">
                                            reply
                                        </span>
                                        Regresar
                                    </button>
                                </a>

                                <div class="col-8 text-end">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12 align-self-center">

                    <div class="card col-12">
                        <div class="card-body contCart">

                            <form class="row alertaGuardar" action="{{ route('maquinaria.store') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="accordion my-3" id="accordionExample">

                                    <div class="accordion-item" style="margin-top: -20px;" id="AccordionPrincipal">

                                        <h2 class="accordion-header " id="headingOne">
                                            <button class="accordion-button bacTituloPrincipal" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#datosPersonales"
                                                aria-expanded="true" aria-controls="collapseOne">
                                                Alta De Maquinaria
                                            </button>

                                        </h2>

                                        <div id="datosPersonales" class="accordion-collapse collapse show"
                                            aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <div class="row mt-3">
                                                    <div class="col-12 col-md-4  my-3">
                                                        <div class="text-center mx-auto border mb-4">
                                                            <i><img class="imgMaquinaria img-fluid mb-2"
                                                                    src="{{ asset('/img/general/default.jpg') }}"></i>
                                                            <span class="mi-archivo"> <input class="mb-4 ver "
                                                                    type="file" name="ruta[]" id="mi-archivo"
                                                                    accept="image/*" multiple></span>
                                                            <label for="mi-archivo">
                                                                <span class="">Sube Imagen</span>
                                                            </label>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-md-8 ">

                                                        <div class="row alin">
                                                            <div class=" col-12 col-sm-8 mb-3 ">
                                                                <label class="labelTitulo">Equipo:
                                                                    <span>*</span></label></br>
                                                                <input type="text" class="inputCaja" id="nombre"
                                                                    placeholder="Especifique..." required name="nombre"
                                                                    value="{{ old('nombre') }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4  mb-3 ">
                                                                <label class="labelTitulo">Marca:</label></br>
                                                                {{-- <input type="text" class="inputCaja" id="marca"
                                                                    placeholder="Especifique..." name="marca"
                                                                    value="{{ old('marca') }}"> --}}
                                                                <select class="form-select"
                                                                    aria-label="Default select example" id="marcaId"
                                                                    name="marcaId">
                                                                    <option value="">Seleccione</option>
                                                                    @foreach ($marcas as $marca)
                                                                        <option value="{{ $marca->id }}">
                                                                            {{ ucwords($marca->nombre) }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>


                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Modelo:</label></br>
                                                                <input type="text" class="inputCaja" id="modelo"
                                                                    placeholder="Especifique..." name="modelo"
                                                                    value="{{ old('modelo') }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Sub Marca:</label></br>
                                                                <input type="text" class="inputCaja" id="submarca"
                                                                    placeholder="Especifique..." name="submarca"
                                                                    value="{{ old('submarca') }}">
                                                            </div>

                                                            {{-- <div class=" col-12 col-sm-6 col-lg-4  mb-3 ">
                                                                <label class="labelTitulo">Categoría:</label></br>
                                                                <input type="text" class="inputCaja" id="categoria"
                                                                    name="categoria" value="{{ old('categoria') }}"
                                                                    placeholder="ej: excavadora">
                                                            </div> --}}

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label
                                                                    class="labelTitulo">Categoría:</label><span>*</span></br>
                                                                {{-- <select class="form-select"
                                                                    aria-label="Default select example" id="categoria"
                                                                    required name="categoria">
                                                                    <option value="">Seleccione</option>
                                                                    <option value="Accesorios">Accesorios</option>
                                                                    <option value="Campers">Campers</option>
                                                                    <option value="Cisterna">Cisterna</option>
                                                                    <option value="Maquinaria ligera">Maquinaria Ligera
                                                                    </option>
                                                                    <option value="Maquinaria pesada">Maquinaria Pesada
                                                                    </option>
                                                                    <option value="Retroexcavadoras">Retroexcavadoras
                                                                    </option>
                                                                    <option value="Tractocamiones">Tractocamiones</option>
                                                                    <option value="Otros">Otros</option>
                                                                    <option value="Utilitarios">Utilitarios</option>
                                                                </select> --}}
                                                                <select class="form-select"
                                                                    aria-label="Default select example" id="categoriaId"
                                                                    name="categoriaId">
                                                                    <option value="">Seleccione</option>
                                                                    @foreach ($categorias as $cat)
                                                                        <option value="{{ $cat->id }}">
                                                                            {{ $cat->nombre }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Uso:</label></br>
                                                                <select class="form-select"
                                                                    aria-label="Default select example" id="uso"
                                                                    name="uso">
                                                                    <option value="Mov. Tierras">Mov. Tierras</option>
                                                                    <option value="Completo">Completo</option>
                                                                    <option value="Utilitario">Utilitario</option>
                                                                </select>
                                                            </div>

                                                            <div class="col-12 col-sm-6 col-lg-4 mb-3">

                                                                <label class="labelTitulo">Tipo:</label></br>
                                                                {{-- <select class="form-select"
                                                                    aria-label="Default select example" id="tipo"
                                                                    name="tipo">
                                                                    <option value="Pesada">Pesada</option>
                                                                    <option value="Ligero">Ligero</option>
                                                                    <option value="Grua">Grua</option>
                                                                    <option value="no_aplica">N/A</option>
                                                                </select> --}}
                                                                <select class="form-select"
                                                                    aria-label="Default select example" id="tipoId"
                                                                    name="tipoId">
                                                                    <option value="">Seleccione</option>
                                                                    @foreach ($tipos as $tipo)
                                                                        <option value="{{ $tipo->id }}">
                                                                            {{ $tipo->nombre }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Año:</label></br>
                                                                <input type="number" class="inputCaja" id="ano"
                                                                    maxlength="4" placeholder="Ej. 2000" name="ano"
                                                                    value="{{ old('ano') }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Color:</label></br>
                                                                <input type="text" class="inputCaja" id="color"
                                                                    placeholder="Ej. Amarillo" name="color"
                                                                    value="{{ old('color') }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Placas:</label></br>
                                                                <input type="text" class="inputCaja" id="placas"
                                                                    placeholder="Ej. JAL-0000" name="placas"
                                                                    value="{{ old('placas') }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Identificador:</label></br>
                                                                <input type="text" class="inputCaja"
                                                                    id="identificador" name="identificador"
                                                                    value="{{ old('identificador') }}"
                                                                    placeholder="ej: MT-00">
                                                            </div>

                                                            <div class=" col-12 col-sm-12 mb-3 ">
                                                                <label class="labelTitulo">Asignado en la Obra:</label></br>
                                                                <select id="obraId" name="obraId"
                                                                    class="form-select" aria-label="Default select example">
                                                                     @foreach ($obras as $item)
                                                                        <option value="{{ $item->id }}">
                                                                            {{ $item->nombre . ' [ '. $item->cliente . ' ] '  }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <div class=" col-12 col-sm-6 mb-3 ">
                                                                <label class="labelTitulo">Número Económico:</label></br>
                                                                <input type="text" class="inputCaja">
                                                            </div>

                                                            {{--  <input type="hidden" id="identificador" name="identificador"
                                                                value="">  --}}

                                                            <div class=" col-12 col-sm-6  mb-3">
                                                                <label class="labelTitulo">Motor:</label></br>
                                                                <input type="text" class="inputCaja" id="motor"
                                                                    placeholder="Especifique..." name="motor"
                                                                    value="{{ old('motor') }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6  mb-3 ">
                                                                <label class="labelTitulo">Número Motor:</label></br>
                                                                <input type="text" class="inputCaja" id="nummotor"
                                                                    placeholder="Ej. NUM0123ABCD" name="nummotor"
                                                                    value="{{ old('nummotor') }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6  mb-3 ">
                                                                <label class="labelTitulo">Número Serie -VIN:</label></br>
                                                                <input type="text" class="inputCaja" id="numserie"
                                                                    placeholder="Ej. NS01234ABCD" name="numserie"
                                                                    value="{{ old('numserie') }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-6 mb-3 ">
                                                                <label class="labelTitulo">Capacidad en Kg:</label></br>
                                                                <input type="number" class="inputCaja" id="capacidad"
                                                                    placeholder="Capacidad" name="capacidad"
                                                                    value="{{ old('capacidad') }}" placeholder="">
                                                            </div>

                                                            <div class="col-12 col-sm-6  mb-3">
                                                                <label class="labelTitulo">Capacidad Tanque:</label></br>
                                                                <input type="number" class="inputCaja" id="tanque"
                                                                    placeholder="En litros" name="tanque"
                                                                    value="{{ old('tanque') }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 mb-3 ">
                                                                <label class="labelTitulo">Ejes:</label></br>
                                                                <input type="number" class="inputCaja" id="ejes"
                                                                    placeholder="Cantidad" name="ejes"
                                                                    value="{{ old('ejes') }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 mb-3 ">
                                                                <label class="labelTitulo">Rin Delantero:</label></br>
                                                                <input type="number" class="inputCaja" id="rinD"
                                                                    placeholder="Dimensiones" name="rinD"
                                                                    value="{{ old('rinD') }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Rin Trasero:</label></br>
                                                                <input type="number" class="inputCaja"
                                                                    id="rinT"placeholder="Dimensiones"
                                                                    name="rinT" value="{{ old('rinT') }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Llanta Delantera:</label></br>
                                                                <input type="number" class="inputCaja" id="llantaD"
                                                                    placeholder="Cantidad" name="llantaD"
                                                                    value="{{ old('llantaD') }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Llanta Trasera:</label></br>
                                                                <input type="number" class="inputCaja" id="llantaT"
                                                                    placeholder="Cantidad" name="llantaT"
                                                                    value="{{ old('llantaT') }}">
                                                            </div>

                                                            <div class="col-12 col-sm-6 col-lg-4 mb-3">
                                                                <label class="labelTitulo">Combustible*:</label></br>
                                                                <select class="form-select" id="combustible"
                                                                    name="combustible">
                                                                    <option value="">Seleccione</option>
                                                                    <option value="Diesel">Diesel</option>
                                                                    <option value="Gasolina">Gasolina</option>
                                                                </select>
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Aceite Motor:</label></br>
                                                                <input type="number" class="inputCaja" id="aceitemotor"
                                                                    placeholder="En litros" name="aceitemotor"
                                                                    value="{{ old('aceitemotor') }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Aceite Transmisión:</label></br>
                                                                <input type="number" class="inputCaja" id="aceitetras"
                                                                    placeholder="En litros" name="aceitetras"
                                                                    value="{{ old('aceitetras') }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Aceite Dirección:</label></br>
                                                                <input type="number" class="inputCaja" id="aceitedirec"
                                                                    placeholder="En litros" name="aceitedirec"
                                                                    value="{{ old('aceitedirec') }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Aceite Hidráulico:</label></br>
                                                                <input type="number" class="inputCaja"
                                                                    placeholder="En litros" name="aceitehidra"
                                                                    value="{{ old('aceitehidra') }}">
                                                            </div>

                                                            {{--  <div class="col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Horómetro Inicial:</label></br>
                                                                <input type="number" class="inputCaja" id="horometro"
                                                                    placeholder="Numérico" name="horometro"
                                                                    value="{{ old('horometro') }}">
                                                            </div>  --}}

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Uso Como
                                                                    Cisterna:</label></br>
                                                                <select class="form-select"
                                                                    aria-label="Default select example" id="cisterna"
                                                                    name="cisterna">
                                                                    <option value="0">No</option>
                                                                    <option value="1">Sí</option>
                                                                </select>
                                                                <input type="hidden" id="cisternaNivel"
                                                                    name="cisternaNivel" value="0">
                                                            </div>

                                                            <div class="col-12 col-sm-6  mb-3">
                                                                <div class="row align-items-end">
                                                                    <label class="labelTitulo">Medicion de uso</label></br>
                                                                    <div
                                                                        class="col-6 col-md-6 col-lg-4 col-xl-7 inputNumberKilometraje">

                                                                        <input type="number" class="inputCaja"
                                                                            id="kilometraje" name="kilometraje"
                                                                            placeholder="Numérico"
                                                                            value="{{ old('kilometraje') }}">

                                                                    </div>
                                                                    <div class="col-12 col-md-6 col-lg-4 inputKilometraje">
                                                                        <select class="form-select"
                                                                            aria-label="Default select example"
                                                                            name="kom">
                                                                            <option value="Km">Km</option>
                                                                            <option value="Ml">Ml</option>
                                                                            <option value="Hr">Hr</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    @php
                                                        $countador = 0;
                                                    @endphp
                                                    <div class="d-flex p-3">
                                                        <div class="col-12" id="elementos">
                                                            <div class="d-flex">
                                                                <div class="col-6 divBorder">
                                                                    <h2 class="tituloEncabezado ">Refacciones</h2>
                                                                </div>
                                                                <div class="col-6 divBorder pb-3 text-end">
                                                                    <button type="button" class="btnVerde"
                                                                        onclick="crearItems()">
                                                                    </button>
                                                                </div>
                                                            </div>

                                                            <div class="row opcion divBorderItems" id="opc">

                                                                <input type="hidden" name="idRefaccion[]"
                                                                    value="">
                                                                <div class=" col-12 col-sm-6 col-lg-3 my-3 ">
                                                                    <label class="labelTitulo">Tipo De
                                                                        Refacción:</label></br>
                                                                    <select id="tipoRefaccion" name='tipoRefaccionId[]'
                                                                        class="form-select">
                                                                        <option value="">Seleccione</option>
                                                                        @foreach ($refaccionTipo as $item)
                                                                            <option value="{{ $item->id }}">
                                                                                {{ ucwords($item->nombre) }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>

                                                                <div class=" col-12 col-sm-6 col-lg-3 my-3 ">
                                                                    <label class="labelTitulo">Marca:</label></br>
                                                                    <select id="marcaRefaccion" name='marca[]'
                                                                        class="form-select">
                                                                        <option value="">Seleccione</option>
                                                                        @foreach ($marcas as $item)
                                                                            <option value="{{ $item->id }}">
                                                                                {{ ucwords($item->nombre) }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>

                                                                <div class=" col-12 col-sm-6 col-lg-3 my-3 ">
                                                                    <label class="labelTitulo">Número De
                                                                        Parte:</label></br>
                                                                    <input type="text" class="inputCaja"
                                                                        name='numeroParte[]' id="numeroParte"
                                                                        placeholder="Especifique..." value="">
                                                                </div>
                                                                <div class="col-lg-2 my-3 text-center pt-3">
                                                                    <span class="material-icons"
                                                                        style="font-size:40px; color: gray">
                                                                        content_paste_search
                                                                    </span>
                                                                </div>
                                                                <div class="col-lg-1 my-3 text-end">
                                                                    <button type="button" id="removeRow"
                                                                        class="btnRojo"></button>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{--  @php
                                                        $countador++;
                                                    @endphp  --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="accordion-item" id="AccordionSecondary">
                                        <h2 class="accordion-header" id="headingThree">
                                            <button class="accordion-button bacTituloPrincipal" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#documentos"
                                                aria-expanded="true" aria-controls="collapseOne">
                                                Documentos
                                            </button>
                                        </h2>
                                        <div id="documentos" class="accordion-collapse collapse"
                                            aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <div class="row mt-3">
                                                    @php
                                                        $count = 0;
                                                    @endphp
                                                    @foreach ($doc as $item)
                                                        <div
                                                            class="card-group col-12 col-md-6 col-lg-4 col-xl-3 small-card-date my-1">
                                                            <div class="card border-green">
                                                                <div class="card-body">
                                                                    <div>
                                                                        <label
                                                                            class="form-check-label text-start fs-5 textTitulo text-break mb-2"
                                                                            for="flexCheckDefault">
                                                                            <!--<i class="fa fa-check-circle semaforo2"></i>-->
                                                                            {{ ucwords(trans($item->nombre)) }}
                                                                        </label>
                                                                    </div>
                                                                    <div
                                                                        class="contIconosDocumentos d-flex flex-wrap align-items-end align-items-center">
                                                                        <input type="hidden" id='{{ $item->nombre }}'
                                                                            name='archivo[{{ $count }}][tipoDocs]'
                                                                            value='{{ $item->id }}'>
                                                                        <input type="hidden"
                                                                            id='nombre{{ $item->nombre }}'
                                                                            name='archivo[{{ $count }}][tipoDocsNombre]'
                                                                            value='{{ $item->nombre }}'>
                                                                        <input type="hidden"
                                                                            id='omitido{{ $item->id }}'
                                                                            name='archivo[{{ $count }}][omitido]'
                                                                            value='0'>
                                                                        <label class="custom-file-upload"
                                                                            onclick='handleDocumento("{{ $item->id }}","{{ $item->nombre }}")'>
                                                                            <input class="mb-4" type="file"
                                                                                name='archivo[{{ $count }}][docs]'
                                                                                id='{{ $item->id }}' accept=".pdf">
                                                                            <div id='iconContainer{{ $item->id }}'>
                                                                                <lord-icon
                                                                                    src="https://cdn.lordicon.com/koyivthb.json"
                                                                                    trigger="hover"
                                                                                    colors="primary:#86c716,secondary:#e8e230"
                                                                                    stroke="65"
                                                                                    style="width:50px;height:70px">
                                                                                </lord-icon>

                                                                            </div>
                                                                        </label>
                                                                        <a id='downloadButton{{ $item->id }}'
                                                                            class="btnViewDescargar btn btn-outline-success btnView"
                                                                            style="display: none" download>
                                                                            <span class="btn-text">Descargar</span>
                                                                            <span class="icon">
                                                                                <i class="far fa-eye mt-2"></i>
                                                                            </span>
                                                                        </a>
                                                                        <button id='removeButton{{ $item->id }}'
                                                                            type="button"
                                                                            class="btnViewDelete btn btn-outline-danger btnView"
                                                                            style="width: 2.4em; height: 2.4em; display: none;"><i
                                                                                class="fa fa-times"></i></button>
                                                                        <!-- Botón Omitir -->
                                                                        <button id='omitirButton{{ $item->id }}'
                                                                            class="btnSinFondo float-end mt-3"
                                                                            style="margin-left: 20px" rel="tooltip"
                                                                            type="button"
                                                                            onclick='omitir("{{ $item->id }}","{{ $item->nombre }}")'>
                                                                            <P class="fs-5"> Omitir</P>
                                                                        </button>
                                                                        <button
                                                                            id='cancelarOmitirButton{{ $item->id }}'
                                                                            class="btnSinFondo float-end mt-3"
                                                                            style="margin-left: 20px; display: none;"
                                                                            rel="tooltip" type="button"
                                                                            onclick='cancelarOmitir("{{ $item->id }}","{{ $item->nombre }}")'>
                                                                            <P class="fs-5"> Cancelar</P>
                                                                        </button>
                                                                        <div class="text-center">
                                                                            <div
                                                                                class="form-check d-flex justify-content-between">
                                                                                <div class="text-center"></div>
                                                                                <label
                                                                                    class="text-start fs-5 textTitulo text-break mb-2"
                                                                                    style="margin-left:-33px!important; font-size: 18px !important">
                                                                                    Expiración:
                                                                                </label>
                                                                                <input
                                                                                    class="form-check-input is-invalid align-self-end mb-2"
                                                                                    type="checkbox"
                                                                                    name='archivo[{{ $count }}][check]'
                                                                                    id='check{{ $item->id }}' checked
                                                                                    style="font-size: 20px; visibility: hidden"
                                                                                    onchange='handleCheckboxChange("{{ $item->id }}")'>
                                                                                <!--<input type="hidden" class="form-check-input is-invalid align-self-end mb-2"  id='checkHidden{{ $item->id }}' value='false'> -->
                                                                            </div>
                                                                            <div class="col-12">
                                                                                <input type="date"
                                                                                    class="inputCaja text-center"
                                                                                    name='archivo[{{ $count }}][fecha]'
                                                                                    id='fecha{{ $item->id }}'
                                                                                    style="display: block;" disabled>
                                                                            </div>
                                                                            <div class="col-12">
                                                                                <label
                                                                                    class="text-start fs-5 textTitulo text-break mb-2"
                                                                                    style="font-size: 18px !important; padding-top: 10px; padding-bottom: 5px; resize: horizontal !important;">Comentario:</label>
                                                                                <textarea id='comentario{{ $item->id }}' name='archivo[{{ $count }}][comentario]'
                                                                                    class="form-control-textarea inputCaja" rows="2" maxlength="1000" placeholder="Escribe Un Comentario"></textarea>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @php
                                                            $count++;
                                                        @endphp
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 text-center mb-3 ">
                                    <button type="submit" class="btn botonGral" onclick="test()">
                                        Guardar
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>-->
    <!--<script>
        $(document).ready(function() {
            // Agregar el evento keyup al campo de entrada "Número De Parte"
            $('#nParteRefaccion').keyup(function() {
                var numeroParte = $(this).val();
                var iconContainer = $(this).parent().next().find(".material-icons");

                if (numeroParte !== "") {
                    // Realizar la petición Ajax al controlador para buscar la relación en la base de datos
                    $.ajax({
                        url: '/inventario',
                        type: 'GET',
                        data: {
                            '_token': '{{ csrf_token() }}',
                            numparte: numeroParte
                        },
                        // headers: {
                        //      // Agrega esto si estás usando CSRF protection en Laravel
                        // },
                        success: function(data) {
                            if (data.relacionEncontrada) {
                                iconContainer.css("color",
                                    "green"); // Cambiar el color del icono a verde
                            } else {
                                iconContainer.css("color",
                                    "red"); // Cambiar el color del icono a rojo
                            }
                        },
                        error: function(error) {
                            console.error('Error en la petición:', error);
                        }
                    });
                } else {
                    iconContainer.css("color", "gray"); // Cambiar el color del icono a gris
                }
            });
        });
    </script>-->
    <script src="{{ asset('js/cardArchivos.js') }}"></script>

    <script type="application/javascript">
    jQuery('input[type=file]').change(function(){
        var filename = jQuery(this).val().split('\\').pop();
        var idname = jQuery(this).attr('id');
        console.log(jQuery(this));
        console.log(filename);
        console.log(idname);
        var $fileUpload = $("input[type='file']");
        if (parseInt($fileUpload.get(0).files.length) > 1) {
        jQuery('span.'+idname).next().find('span').html(parseInt($fileUpload.get(0).files.length)+' archivos');

        } else {
        jQuery('span.'+idname).next().find('span').html(filename);
    }
    });
    </script>

    <script>
        function test() {
            var $fileUpload = $("input[type='file']");
            if (parseInt($fileUpload.get(0).files.length) > 4) {
                event.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Maximo 4 imagenes',
                })
            } else {

                alertaGuardar()
            }
        }
    </script>


    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
        crossorigin="anonymous"></script>

    <script>
        function crearItems() {
            $('.opcion:first').clone().find("input").val("").end().appendTo('#elementos');
        }

        // Borrar registro
        $(document).on('click', '#removeRow', function() {
            if ($('.opcion').length > 1) {
                $(this).closest('.opcion').remove();
            }
        });
    </script>

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

@endsection
