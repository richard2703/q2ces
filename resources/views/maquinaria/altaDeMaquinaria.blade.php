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
                                                Alta de Maquinaria
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
                                                                <span class="">sube imagen</span>
                                                            </label>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-md-8 ">

                                                        <div class="row alin">
                                                            <div class=" col-12 col-sm-6 col-lg-4  mb-3 ">
                                                                <label class="labelTitulo">Equipo:
                                                                    <span>*</span></label></br>
                                                                <input type="text" class="inputCaja" id="nombre"
                                                                    placeholder="Especifique..." required name="nombre"
                                                                    value="{{ old('nombre') }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 my-3 ">
                                                            <label class="labelTitulo">Bitacora:</label></br>
                                                                <select id="bitacoraId" name="bitacoraId" class="form-select"
                                                                    aria-label="Default select example">
                                                                    <option value="">Seleccione</option>
                                                                    @foreach ($bitacora as $item)
                                                                        <option value="{{ $item->id }}">
                                                                            {{ $item->nombre }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4  mb-3 ">
                                                                <label class="labelTitulo">Marca:</label></br>
                                                                <input type="text" class="inputCaja" id="marca"
                                                                    placeholder="Especifique..." name="marca"
                                                                    value="{{ old('marca') }}">
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
                                                                <select class="form-select"
                                                                    aria-label="Default select example" id="categoria"
                                                                    required name="categoria">
                                                                    <option value="">Seleccione</option>
                                                                    <option value="Accesorios">Accesorios</option>
                                                                    <option value="Campers">Campers</option>
                                                                    <option value="Cisterna">Cisterna</option>
                                                                    <option value="Maquinaria ligera">Maquinaria ligera
                                                                    </option>
                                                                    <option value="Maquinaria pesada">Maquinaria pesada
                                                                    </option>
                                                                    <option value="Retroexcavadoras">Retroexcavadoras
                                                                    </option>
                                                                    <option value="Tractocamiones">Tractocamiones</option>
                                                                    <option value="Otros">Otros</option>
                                                                    <option value="Utilitarios">Utilitarios</option>
                                                                </select>
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Uso:</label></br>
                                                                <select class="form-select"
                                                                    aria-label="Default select example" id="uso"
                                                                    name="uso">
                                                                    <option value="Mov. Tierras">Mov. Tierras</option>
                                                                    <option value="Completo">Completo</option>
                                                                </select>
                                                            </div>

                                                            <div class="col-12 col-sm-6 col-lg-4 mb-3">
                                                             
                                                                <label class="labelTitulo">Tipo:</label></br>
                                                                <select class="form-select"
                                                                    aria-label="Default select example"
                                                                    id="tipo" name="tipo">
                                                                    <option value="Pesada">Pesada</option>
                                                                    <option value="Ligero">Ligero</option>
                                                                    <option value="Grua">Grua</option>
                                                                    <option value="no_aplica">N/A</option>
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
                                                            <div class=" col-12 col-sm-6 mb-3 ">
                                                                <label class="labelTitulo">Numero Económico:</label></br>
                                                                <input type="text" class="inputCaja" >
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
                                                                <label class="labelTitulo">Capacidad en kW:</label></br>
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
                                                            <select class="form-select" id="combustible" name="combustible">
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

                                                            <!--<div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Filtro Aceite:</label></br>
                                                                <input type="number" class="inputCaja" id="filtroaceite"
                                                                    name="filtroaceite" placeholder="Cantidad"
                                                                    value="{{ old('filtroaceite') }}">
                                                            </div>-->

                                                            <!--<div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Filtro Aire:</label></br>
                                                                <input type="number" class="inputCaja" id="filtroaire"
                                                                    placeholder="Cantidad" name="filtroaire"
                                                                    value="{{ old('filtroaire') }}">
                                                            </div>-->

                                                            <!--<div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Bujías:</label></br>
                                                                <input type="number" class="inputCaja" id="bujias"
                                                                    placeholder="Cantidad" name="bujias"
                                                                    value="{{ old('bujias') }}">
                                                            </div>-->

                                                            <!--<div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Tipo de Bujías:</label></br>
                                                                <input type="text" class="inputCaja" id="tipobujia"
                                                                    placeholder="Especifique..." name="tipobujia"
                                                                    value="{{ old('tipobujia') }}">
                                                            </div>-->

                                                            <div class="col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Horómetro Inicial:</label></br>
                                                                <input type="number" class="inputCaja" id="horometro"
                                                                    placeholder="Numérico" name="horometro"
                                                                    value="{{ old('horometro') }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Uso como
                                                                    cisterna:</label></br>
                                                                <select class="form-select"
                                                                    aria-label="Default select example" id="cisterna"
                                                                    name="cisterna">
                                                                    <option value="0">No</option>
                                                                    <option value="1">Sí</option>
                                                                </select>
                                                                <input type="hidden" id="cisternaNivel"
                                                                    name="cisternaNivel" value="0">
                                                            </div>

                                                            <div class="col-12 col-lg-3 col-xl-4  mb-3">
                                                                <div class="row align-items-end">
                                                                    <label class="labelTitulo">Kilometraje / Millaje
                                                                        Inicial:</label></br>
                                                                    <div class="col-7 col-md-6 col-lg-4 col-xl-7 inputNumberKilometraje">
                                                                        
                                                                        <input type="number" class="inputCaja"
                                                                            id="kilometraje" name="kilometraje"
                                                                            placeholder="Numérico"
                                                                            value="{{ old('kilometraje') }}">

                                                                    </div>
                                                                    <div class="col-5 col-md-6 col-lg-4 inputKilometraje">
                                                                        <select class="form-select"
                                                                            aria-label="Default select example"
                                                                            name="kom">
                                                                            <option value="Km">Km</option>
                                                                            <option value="Ml">Ml</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                    <div class="d-flex p-3">
                                                    <div class="col-12" id="elementos">
                                                        <div class="d-flex">
                                                            <div class="col-6 divBorder">
                                                                <h2 class="tituloEncabezado ">Refacciónes</h2>
                                                            </div>
                                                            <div class="col-6 divBorder pb-3 text-end">
                                                                <button type="button" class="btnVerde" onclick="crearItems()">
                                                                </button>
                                                            </div>
                                                        </div>

                                                            <div class="row opcion divBorderItems" id="opc">

                                                                <input type="hidden" name="asignado[]" value="">
                                                                <div class=" col-12 col-sm-6 col-lg-4 my-3 ">
                                                                    <label class="labelTitulo">Tipo de Refacción:</label></br>
                                                                    <select id="tipoRefaccion" name="tipoRefaccion[]" class="form-select">
                                                                        <option value="">Seleccione</option>
                                                                            <option value="Aceite Primario">Aceite Primario</option>
                                                                            <option value="Aceite Secundario">Aceite Secundario</option>
                                                                            <option value="Combustible Primario">Combustible Primario</option>
                                                                            <option value="Combustible Secundario">Combustible Secundario</option>
                                                                            <option value="Aire de Motor Primario">Aire de Motor Primario</option>
                                                                            <option value="Aire de Motor Secundario">Aire de Motor Secundario</option>
                                                                            <option value="Aire de Cabina">Aire de Cabina</option>
                                                                            <option value="Transmisión">Transmisión</option>
                                                                            <option value="Dirección">Dirección</option>
                                                                            <option value="Bujía">Bujía</option>
                                                                    </select>
                                                                </div>

                                                                <div class=" col-12 col-sm-6 col-lg-2 my-3 ">
                                                                    <label class="labelTitulo">Marca:</label></br>
                                                                    <input type="text" class="inputCaja" id="marcaRefaccion"
                                                                        placeholder="Especifique..." name="marcaRefaccion[]" value="">
                                                                </div>
                    
                                                                <div class=" col-12 col-sm-6 col-lg-4 my-3 ">
                                                                    <label class="labelTitulo">Numero De Parte:</label></br>
                                                                    <input type="text" class="inputCaja" id="nParteRefaccion"
                                                                        placeholder="Especifique..." name="nParteRefaccion[]" value="">
                                                                </div> 

                                                                <div class="col-lg-2 my-3 text-end">
                                                                    <button type="button" id="removeRow" class="btnRojo"></button>
                                                                </div>

                                                                
                                                            </div>
                                                        </div>
                                                    </div>

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

                                                    <div class="card-group col-12 col-md-6 col-lg-4 col-xl-3 small-card-group">
                                                        <div class="card contDocumentos">
                                                            <div class="card-body m-2">
                                                                <div>
                                                                    <label class="form-check-label text-start fs-5 textTitulo text-break mb-2" for="flexCheckDefault">
                                                                        <!--<i class="fa fa-check-circle semaforo2"></i>-->
                                                                        Factura
                                                                    </label>
                                                                </div>
                                                                <div class="contIconosDocumentos d-flex flex-wrap align-items-end align-items-center">
                                                                    <input type="hidden" id="factura_tipo" name="factura_tipo" value="Factura">
                                                                    <label class="custom-file-upload">
                                                                        <input class="mb-4" type="file" name="factura_ruta" id="factura_ruta" accept=".doc, .docx, .xls, .xlsx, .ppt, .pptx, .pdf, .txt, .csv, .rtf, .odt, .odp, .ods">
                                                                        <div id="iconContainerFactura">
                                                                            <lord-icon src="https://cdn.lordicon.com/koyivthb.json" trigger="hover" colors="primary:#86c716,secondary:#e8e230" stroke="65" style="width:50px;height:70px"></lord-icon>

                                                                        </div>
                                                                    </label>
                                                                    <a id="downloadFacturaButton" class="btnViewDescargar btn btn-outline-success btnView" style="display: none" download>
                                                                    <span class="btn-text">Descargar</span>
                                                                    <span class="icon">
                                                                        <i class="far fa-eye mt-2"></i>
                                                                    </span>
                                                                    </a>
                                                                    <button id="removeFacturaButton" class="btnViewDelete btn btn-outline-danger btnView" style="width: 2.4em; height: 2.4em; display: none;"><i class="fa fa-times"></i></button>
                                                                    <!-- Botón Omitir -->
                                                                    <button id="omitirFacturaButton" class="btnSinFondo float-end mt-3" style="margin-left: 20px" type="submit" rel="tooltip" onclick="omitirFactura()">
                                                                        <P class="fs-5"> Omitir</P>
                                                                    </button>
                                                                    <button id="cancelarOmitirButton" class="btnSinFondo float-end mt-3" style="margin-left: 20px; display: none;" type="submit" rel="tooltip" onclick="cancelarOmitir()">
                                                                        <P class="fs-5"> Cancelar</P>
                                                                    </button>
                                                                </div>            
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="card-group col-12 col-md-6 col-lg-4 col-xl-3 small-card-group">
                                                        <div class="card contDocumentos">
                                                            <div class="card-body m-2">
                                                                <div>
                                                                    <label class="form-check-label text-start fs-5 textTitulo text-break mb-2" for="flexCheckDefault">
                                                                        <!--<i class="fa fa-check-circle semaforo2"></i>-->
                                                                        Manual De Uso
                                                                    </label>
                                                                </div>
                                                                <div class="contIconosDocumentos d-flex flex-wrap align-items-end align-items-center">
                                                                    <input type="hidden" id="manual_tipo" name="manual_tipo" value="Manual">
                                                                    <label class="custom-file-upload">
                                                                        <input class="mb-4" type="file" name="manual_ruta" id="manual_ruta" accept=".doc, .docx, .xls, .xlsx, .ppt, .pptx, .pdf, .txt, .csv, .rtf, .odt, .odp, .ods">
                                                                        <div id="iconContainerManual">
                                                                            <lord-icon src="https://cdn.lordicon.com/koyivthb.json" trigger="hover" colors="primary:#86c716,secondary:#e8e230" stroke="65" style="width:50px;height:70px"></lord-icon>
                                                                        </div>
                                                                    </label>
                                                                    <a id="downloadManualButton" class="btnViewDescargar btn btn-outline-success btnView" style="display: none" download>
                                                                        <span class="btn-text">Descargar</span>
                                                                        <span class="icon">
                                                                            <i class="far fa-eye mt-2"></i>
                                                                        </span>
                                                                    </a>
                                                                    <button id="removeManualButton" class="btnViewDelete btn btn-outline-danger btnView" style="width: 2.4em; height: 2.4em; display: none;"><i class="fa fa-times"></i></button>
                                                                    <!-- Botón Omitir -->
                                                                    <button id="omitirManualButton" class="btnSinFondo float-end mt-3" style="margin-left: 20px" type="submit" rel="tooltip" onclick="omitirManual()">
                                                                        <P class="fs-5"> Omitir</P>
                                                                    </button>
                                                                    <!-- Botón Cancelar -->
                                                                    <button id="cancelarOmitirManualButton" class="btnSinFondo float-end mt-3" style="margin-left: 20px; display: none;" type="submit" rel="tooltip" onclick="cancelarOmitirManual()">
                                                                        <P class="fs-5"> Cancelar</P>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="card-group col-12 col-md-6 col-lg-4 col-xl-3 small-card-group">
                                                        <div class="card contDocumentos">
                                                            <div class="card-body m-2">
                                                                <div>
                                                                    <label class="form-check-label text-start fs-5 textTitulo text-break mb-2" for="flexCheckDefault">
                                                                        <!--<i class="fa fa-check-circle semaforo2"></i>-->
                                                                        Registro
                                                                    </label>
                                                                </div>
                                                                <div class="contIconosDocumentos d-flex flex-wrap align-items-end align-items-center">
                                                                    <input type="hidden" id="registro_tipo" name="registro_tipo" value="Registro">
                                                                    <label class="custom-file-upload">
                                                                        <input class="mb-4" type="file" name="registro_ruta" id="registro_ruta" accept=".doc, .docx, .xls, .xlsx, .ppt, .pptx, .pdf, .txt, .csv, .rtf, .odt, .odp, .ods">
                                                                        <div id="iconContainerRegistro">
                                                                            <lord-icon src="https://cdn.lordicon.com/koyivthb.json" trigger="hover" colors="primary:#86c716,secondary:#e8e230" stroke="65" style="width:50px;height:70px"></lord-icon>
                                                                        </div>
                                                                    </label>
                                                                    <a id="downloadRegistroButton" class="btnViewDescargar btn btn-outline-success btnView" style="display: none" download>
                                                                        <span class="btn-text">Descargar</span>
                                                                        <span class="icon">
                                                                            <i class="far fa-eye mt-2"></i>
                                                                        </span>
                                                                    </a>
                                                                    <button id="removeRegistroButton" class="btnViewDelete btn btn-outline-danger btnView" style="width: 2.4em; height: 2.4em; display: none;"><i class="fa fa-times"></i></button>
                                                                    <!-- Botón Omitir -->
                                                                    <button id="omitirRegistroButton" class="btnSinFondo float-end mt-3" style="margin-left: 20px" type="submit" rel="tooltip" onclick="omitirRegistro()">
                                                                        <P class="fs-5"> Omitir</P>
                                                                    </button>
                                                                    <!-- Botón Cancelar -->
                                                                    <button id="cancelarOmitirRegistroButton" class="btnSinFondo float-end mt-3" style="margin-left: 20px; display: none;" type="submit" rel="tooltip" onclick="cancelarOmitirRegistro()">
                                                                        <P class="fs-5"> Cancelar</P>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="card-group col-12 col-md-6 col-lg-4 col-xl-3 small-card-group">
                                                        <div class="card contDocumentos">
                                                            <div class="card-body m-2">
                                                                <div>
                                                                    <label class="form-check-label text-start fs-5 textTitulo text-break mb-2" for="flexCheckDefault">
                                                                        <!--<i class="fa fa-check-circle semaforo2"></i>-->
                                                                        Ficha Técnica Del Proveedor
                                                                    </label>
                                                                </div>
                                                                <div class="contIconosDocumentos d-flex flex-wrap align-items-end align-items-center">
                                                                    <input type="hidden" id="ficha_tipo" name="ficha_tipo" value="Ficha">
                                                                    <label class="custom-file-upload">
                                                                        <input class="mb-4" type="file" name="ficha_ruta" id="ficha_ruta" accept=".doc, .docx, .xls, .xlsx, .ppt, .pptx, .pdf, .txt, .csv, .rtf, .odt, .odp, .ods">
                                                                        <div id="iconContainerFicha">
                                                                            <lord-icon src="https://cdn.lordicon.com/koyivthb.json" trigger="hover" colors="primary:#86c716,secondary:#e8e230" stroke="65" style="width:50px;height:70px"></lord-icon>
                                                                        </div>
                                                                    </label>
                                                                    <a id="downloadFichaButton" class="btnViewDescargar btn btn-outline-success btnView" style="display: none" download>
                                                                        <span class="btn-text">Descargar</span>
                                                                        <span class="icon">
                                                                            <i class="far fa-eye mt-2"></i>
                                                                        </span>
                                                                    </a>
                                                                    <button id="removeFichaButton" class="btnViewDelete btn btn-outline-danger btnView" style="width: 2.4em; height: 2.4em; display: none;"><i class="fa fa-times"></i></button>
                                                                    <!-- Botón Omitir -->
                                                                    <button id="omitirFichaButton" class="btnSinFondo float-end mt-3" style="margin-left: 20px" type="submit" rel="tooltip" onclick="omitirFicha()">
                                                                        <P class="fs-5"> Omitir</P>
                                                                    </button>
                                                                    <!-- Botón Cancelar -->
                                                                    <button id="cancelarOmitirFichaButton" class="btnSinFondo float-end mt-3" style="margin-left: 20px; display: none;" type="submit" rel="tooltip" onclick="cancelarOmitirFicha()">
                                                                        <P class="fs-5"> Cancelar</P>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="card-group col-12 col-md-6 col-lg-4 col-xl-3 small-card-group-date">
                                                        <div class="card contDocumentos">
                                                            <div class="card-body m-2">
                                                                <div>
                                                                    <label class="form-check-label text-start fs-5 textTitulo text-break mb-2" for="flexCheckDefault">
                                                                        <!--<i class="fa fa-check-circle semaforo2"></i>-->
                                                                        Verificación
                                                                    </label>
                                                                </div>
                                                                <div class="contIconosDocumentos d-flex flex-wrap align-items-end align-items-center">
                                                                    <input type="hidden" id="verificacion_tipo" name="verificacion_tipo" value="Verificacion">
                                                                    <label class="custom-file-upload">
                                                                        <input class="mb-4" type="file" name="verificacion_ruta" id="verificacion_ruta" accept=".doc, .docx, .xls, .xlsx, .ppt, .pptx, .pdf, .txt, .csv, .rtf, .odt, .odp, .ods">
                                                                        <div id="iconContainerVerificacion">
                                                                            <lord-icon src="https://cdn.lordicon.com/koyivthb.json" trigger="hover" colors="primary:#86c716,secondary:#e8e230" stroke="65" style="width:50px;height:70px"></lord-icon>
                                                                        </div>
                                                                    </label>
                                                                    <a id="downloadVerificacionButton" class="btnViewDescargar btn btn-outline-success btnView" style="display: none" download>
                                                                        <span class="btn-text">Descargar</span>
                                                                        <span class="icon">
                                                                            <i class="far fa-eye mt-2"></i>
                                                                        </span>
                                                                    </a>
                                                                    <button id="removeVerificacionButton" class="btnViewDelete btn btn-outline-danger btnView" style="width: 2.4em; height: 2.4em; display: none;"><i class="fa fa-times"></i></button>
                                                                    <!-- Botón Omitir -->
                                                                    <button id="omitirVerificacionButton" class="btnSinFondo float-end mt-3" style="margin-left: 20px" type="submit" rel="tooltip" onclick="omitirVerificacion()">
                                                                        <P class="fs-5"> Omitir</P>
                                                                    </button>
                                                                    <!-- Botón Cancelar -->
                                                                    <button id="cancelarOmitirVerificacionButton" class="btnSinFondo float-end mt-3" style="margin-left: 20px; display: none;" type="submit" rel="tooltip" onclick="cancelarOmitirVerificacion()">
                                                                        <P class="fs-5"> Cancelar</P>
                                                                    </button>
                                                                </div>
                                                                <div class="text-center" style="margin-top:-10px !important">
                                                                    <label class="text-start fs-5 textTitulo text-break mb-2"> Expiración:</label>
                                                                    <div class="col-12">
                                                                        <input type="date" class="inputCaja text-center" id="verificacion_fecha" style="display: block;">
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <label class="text-start fs-5 textTitulo text-break mb-2" style="font-size:18px !important; padding-top: 10px; padding-bottom: 5px; resize: horizontal !important;">Comentario:</label>
                                                                        <textarea class="form-control-textarea inputCaja" rows="1" maxlength="1000" name="comentarioVerificacion" placeholder="Tipo De Permiso etc."></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="card-group col-12 col-md-6 col-lg-4 col-xl-3 small-card-group-date">
                                                        <div class="card contDocumentos">
                                                            <div class="card-body m-2">
                                                                <div>
                                                                    <label class="form-check-label text-start fs-5 textTitulo text-break mb-2" for="flexCheckDefault">
                                                                        <!--<i class="fa fa-check-circle semaforo2"></i>-->
                                                                        Tarjeta De Circulación
                                                                    </label>
                                                                </div>
                                                                <div class="contIconosDocumentos d-flex flex-wrap align-items-end align-items-center">
                                                                    <input type="hidden" id="tarjeta_tipo" name="tarjeta_tipo" value="Tarjeta">
                                                                    <label class="custom-file-upload">
                                                                        <input class="mb-4" type="file" name="tarjeta_ruta" id="tarjeta_ruta" accept=".doc, .docx, .xls, .xlsx, .ppt, .pptx, .pdf, .txt, .csv, .rtf, .odt, .odp, .ods">
                                                                        <div id="iconContainerTarjeta">
                                                                            <lord-icon src="https://cdn.lordicon.com/koyivthb.json" trigger="hover" colors="primary:#86c716,secondary:#e8e230" stroke="65" style="width:50px;height:70px"></lord-icon>
                                                                        </div>
                                                                    </label>
                                                                    <a id="downloadTarjetaButton" class="btnViewDescargar btn btn-outline-success btnView" style="display: none" download>
                                                                        <span class="btn-text">Descargar</span>
                                                                        <span class="icon">
                                                                            <i class="far fa-eye mt-2"></i>
                                                                        </span>
                                                                    </a>
                                                                    <button id="removeTarjetaButton" class="btnViewDelete btn btn-outline-danger btnView" style="width: 2.4em; height: 2.4em; display: none;"><i class="fa fa-times"></i></button>
                                                                    <!-- Botón Omitir -->
                                                                    <button id="omitirTarjetaButton" class="btnSinFondo float-end mt-3" style="margin-left: 20px" type="submit" rel="tooltip" onclick="omitirTarjeta()">
                                                                        <P class="fs-5"> Omitir</P>
                                                                    </button>
                                                                    <!-- Botón Cancelar -->
                                                                    <button id="cancelarOmitirTarjetaButton" class="btnSinFondo float-end mt-3" style="margin-left: 20px; display: none;" type="submit" rel="tooltip" onclick="cancelarOmitirTarjeta()">
                                                                        <P class="fs-5"> Cancelar</P>
                                                                    </button>
                                                                </div>
                                                                <div class="text-center" style="margin-top:-10px !important">
                                                                    <label class="text-start fs-5 textTitulo text-break mb-2"> Expiración:</label>
                                                                    <div class="col-12">
                                                                        <input type="date" class="inputCaja text-center" id="tarjeta_fecha" style="display: block;">
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <label class="text-start fs-5 textTitulo text-break mb-2" style="font-size:18px !important; padding-top: 10px; padding-bottom: 5px; resize: horizontal !important;">Comentario:</label>
                                                                        <textarea class="form-control-textarea inputCaja" rows="1" maxlength="1000" name="comentarioTarjeta" placeholder="Tipo De Permiso etc."></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="card-group col-12 col-md-6 col-lg-4 col-xl-3 small-card-group-date">
                                                        <div class="card contDocumentos">
                                                            <div class="card-body m-2">
                                                                <div>
                                                                    <label class="form-check-label text-start fs-5 textTitulo text-break mb-2" for="flexCheckDefault">
                                                                        <!--<i class="fa fa-check-circle semaforo2"></i>-->
                                                                        Seguros
                                                                    </label>
                                                                </div>
                                                                <div class="contIconosDocumentos d-flex flex-wrap align-items-end align-items-center">
                                                                    <input type="hidden" id="seguros_tipo" name="seguros_tipo" value="Seguros">
                                                                    <label class="custom-file-upload">
                                                                        <input class="mb-4" type="file" name="seguros_ruta" id="seguros_ruta" accept=".doc, .docx, .xls, .xlsx, .ppt, .pptx, .pdf, .txt, .csv, .rtf, .odt, .odp, .ods">
                                                                        <div id="iconContainerSeguros">
                                                                            <lord-icon src="https://cdn.lordicon.com/koyivthb.json" trigger="hover" colors="primary:#86c716,secondary:#e8e230" stroke="65" style="width:50px;height:70px"></lord-icon>
                                                                        </div>
                                                                    </label>
                                                                    <a id="downloadSegurosButton" class="btnViewDescargar btn btn-outline-success btnView" style="display: none" download>
                                                                        <span class="btn-text">Descargar</span>
                                                                        <span class="icon">
                                                                            <i class="far fa-eye mt-2"></i>
                                                                        </span>
                                                                    </a>
                                                                    <button id="removeSegurosButton" class="btnViewDelete btn btn-outline-danger btnView" style="width: 2.4em; height: 2.4em; display: none;"><i class="fa fa-times"></i></button>
                                                                    <!-- Botón Omitir -->
                                                                    <button id="omitirSegurosButton" class="btnSinFondo float-end mt-3" style="margin-left: 20px" type="submit" rel="tooltip" onclick="omitirSeguros()">
                                                                        <P class="fs-5"> Omitir</P>
                                                                    </button>
                                                                    <!-- Botón Cancelar -->
                                                                    <button id="cancelarOmitirSegurosButton" class="btnSinFondo float-end mt-3" style="margin-left: 20px; display: none;" type="submit" rel="tooltip" onclick="cancelarOmitirSeguros()">
                                                                        <P class="fs-5"> Cancelar</P>
                                                                    </button>
                                                                </div>
                                                                <div class="text-center" style="margin-top: -10px !important">
                                                                    <label class="text-start fs-5 textTitulo text-break mb-2"> Expiración:</label>
                                                                    <div class="col-12">
                                                                        <input type="date" class="inputCaja text-center" id="seguros_fecha" style="display: block;">
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <label class="text-start fs-5 textTitulo text-break mb-2" style="font-size: 18px !important; padding-top: 10px; padding-bottom: 5px; resize: horizontal !important;">Comentario:</label>
                                                                        <textarea class="form-control-textarea inputCaja" rows="1" maxlength="1000" name="comentarioSeguros" placeholder="Tipo De Permiso etc."></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="card-group col-12 col-md-6 col-lg-4 col-xl-3 small-card-group-date">
                                                        <div class="card contDocumentos">
                                                            <div class="card-body m-2">
                                                                <div>
                                                                    <label class="form-check-label text-start fs-5 textTitulo text-break mb-2" for="flexCheckDefault">
                                                                        <!--<i class="fa fa-check-circle semaforo2"></i>-->
                                                                        Permisos Especiales
                                                                    </label>
                                                                </div>
                                                                <div class="contIconosDocumentos d-flex flex-wrap align-items-end align-items-center">
                                                                    <input type="hidden" id="especiales_tipo" name="especiales_tipo" value="Especiales">
                                                                    <label class="custom-file-upload">
                                                                        <input class="mb-4" type="file" name="especiales_ruta" id="especiales_ruta" accept=".doc, .docx, .xls, .xlsx, .ppt, .pptx, .pdf, .txt, .csv, .rtf, .odt, .odp, .ods">
                                                                        <div id="iconContainerEspeciales">
                                                                            <lord-icon src="https://cdn.lordicon.com/koyivthb.json" trigger="hover" colors="primary:#86c716,secondary:#e8e230" stroke="65" style="width:50px;height:70px"></lord-icon>
                                                                        </div>
                                                                    </label>
                                                                    <a id="downloadEspecialesButton" class="btnViewDescargar btn btn-outline-success btnView" style="display: none" download>
                                                                        <span class="btn-text">Descargar</span>
                                                                        <span class="icon">
                                                                            <i class="far fa-eye mt-2"></i>
                                                                        </span>
                                                                    </a>
                                                                    <button id="removeEspecialesButton" class="btnViewDelete btn btn-outline-danger btnView" style="width: 2.4em; height: 2.4em; display: none;"><i class="fa fa-times"></i></button>
                                                                    <!-- Botón Omitir -->
                                                                    <button id="omitirEspecialesButton" class="btnSinFondo float-end mt-3" style="margin-left: 20px" type="submit" rel="tooltip" onclick="omitirEspeciales()">
                                                                        <P class="fs-5"> Omitir</P>
                                                                    </button>
                                                                    <!-- Botón Cancelar -->
                                                                    <button id="cancelarOmitirEspecialesButton" class="btnSinFondo float-end mt-3" style="margin-left: 20px; display: none;" type="submit" rel="tooltip" onclick="cancelarOmitirEspeciales()">
                                                                        <P class="fs-5"> Cancelar</P>
                                                                    </button>
                                                                </div>
                                                                <div class="text-center" style="margin-top: -10px !important">
                                                                    <label class="text-start fs-5 textTitulo text-break mb-2" style="font-size: 18px !important"> Expiración:</label>
                                                                    <div class="col-12">
                                                                        <input type="date" class="inputCaja text-center" id="especiales_fecha" style="display: block;">
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <label class="text-start fs-5 textTitulo text-break mb-2" style="font-size: 18px !important; padding-top: 10px; padding-bottom: 5px; resize: horizontal !important;">Comentario:</label>
                                                                        <textarea class="form-control-textarea inputCaja" rows="1" maxlength="1000" name="comentarioEspeciales" placeholder="Tipo De Permiso etc."></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
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
    <!--

if (iconContainer.innerHTML !== '<lord-icon src="https://cdn.lordicon.com/koyivthb.json" trigger="hover" colors="primary:#86c716,secondary:#e8e230" stroke="65" style="width:50px;height:70px"></lord-icon>') {
        // Mostrar la alerta de SweetAlert para confirmar el reemplazo
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
                // Proceder con la omisión
                proceedOmitirEspeciales();
            }
        });
        } else {
            // Si no hay una imagen cargada, proceder con la omisión directamente
            
        }-->
    <script>
    let alertShown = true; // Flag to track if the alert has been shown
    let alertShownManual = true;
    let alertShownRegistro = true;
    let alertShownFicha = true;
    let alertShownTarjeta = true;
    let alertShownSeguros = true;
    let alertShownEspeciales = true;
    let alertShownVerificacion = true;
    
    function omitirFactura() {
    // Obtener el input del archivo y el contenedor del icono
    var facturaInput = document.getElementById("factura_ruta");
    var iconContainer = document.getElementById("iconContainerFactura");
    var omitirFacturaButton = document.getElementById("omitirFacturaButton");
    var cancelarOmitirButton = document.getElementById("cancelarOmitirButton");

    // Deshabilitar el input del archivo
    facturaInput.disabled = true;

    // Cambiar el valor del input a 1
    facturaInput.value = "";

    // Cambiar el icono en el contenedor
    iconContainer.innerHTML =
        '<lord-icon src="https://cdn.lordicon.com/jvihlqtw.json" trigger="hover" colors="primary:#86c716,secondary:#e8e230" stroke="65" style="width:50px;height:70px"></lord-icon>';

    // Mostrar el botón "Cancelar" y ocultar el botón "Omitir"
    omitirFacturaButton.style.display = "none";
    cancelarOmitirButton.style.display = "block";
    }

    function cancelarOmitir() {
    // Obtener el input del archivo y el contenedor del icono
    var facturaInput = document.getElementById("factura_ruta");
    var iconContainer = document.getElementById("iconContainerFactura");
    var omitirFacturaButton = document.getElementById("omitirFacturaButton");
    var cancelarOmitirButton = document.getElementById("cancelarOmitirButton");

    // Habilitar el input del archivo nuevamente
    facturaInput.disabled = false;

    // Restaurar el valor del input a su estado original (vacío)
    facturaInput.value = "";

    // Restaurar el icono original en el contenedor
    iconContainer.innerHTML =
        '<lord-icon src="https://cdn.lordicon.com/koyivthb.json" trigger="hover" colors="primary:#86c716,secondary:#e8e230" stroke="65" style="width:50px;height:70px"></lord-icon>';

    // Mostrar el botón "Omitir" y ocultar el botón "Cancelar"
    omitirFacturaButton.style.display = "block";
    cancelarOmitirButton.style.display = "none";
    }

    document.addEventListener("DOMContentLoaded", function () {
    var facturaInput = document.getElementById("factura_ruta");
    var downloadFacturaButton = document.getElementById("downloadFacturaButton");
    var removeFacturaButton = document.getElementById("removeFacturaButton");
    var omitirFacturaButton = document.getElementById("omitirFacturaButton");
    var cancelarOmitirButton = document.getElementById("cancelarOmitirButton");
    var iconContainer = document.getElementById("iconContainerFactura");
    
    facturaInput.addEventListener("click", function (event) {
      if (!alertShown) {
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
            facturaInput.click(); // Open the file explorer manually
          }
        });
      }
    });

    facturaInput.addEventListener("change", function (event) {
      if (event.target.files.length > 0) {
        var file = event.target.files[0];
        var fileURL = URL.createObjectURL(file);
        downloadFacturaButton.setAttribute("href", fileURL);
        downloadFacturaButton.style.display = "block";
        removeFacturaButton.style.display = "block";
        omitirFacturaButton.style.display = "none";
        cancelarOmitirButton.style.display = "none";
        alertShown = false;
        iconContainer.innerHTML =
          '<lord-icon src="https://cdn.lordicon.com/nxaaasqe.json" trigger="hover" colors="primary:#86c716,secondary:#e8e230" style="width:50px;height:70px"></lord-icon>';
      } else {
        downloadFacturaButton.style.display = "none";
        removeFacturaButton.style.display = "none";
        omitirFacturaButton.style.display = "block";
        cancelarOmitirButton.style.display = "none";
        alertShown = true;
        iconContainer.innerHTML =
          '<lord-icon src="https://cdn.lordicon.com/koyivthb.json" trigger="hover" colors="primary:#86c716,secondary:#e8e230" stroke="65" style="width:50px;height:70px"></lord-icon>';
      }
    });

    removeFacturaButton.addEventListener("click", function () {
      facturaInput.value = null;
      downloadFacturaButton.removeAttribute("href");
      downloadFacturaButton.style.display = "none";
      removeFacturaButton.style.display = "none";
      omitirFacturaButton.style.display = "block";
      cancelarOmitirButton.style.display = "none";
      alertShown = true;
      iconContainer.innerHTML =
        '<lord-icon src="https://cdn.lordicon.com/koyivthb.json" trigger="hover" colors="primary:#86c716,secondary:#e8e230" stroke="65" style="width:50px;height:70px"></lord-icon>';
    });
  });


function omitirManual() {
    // Obtener el input del archivo y el contenedor del icono
    var manualInput = document.getElementById("manual_ruta");
    var iconContainer = document.getElementById("iconContainerManual");
    var omitirManualButton = document.getElementById("omitirManualButton");
    var cancelarOmitirManualButton = document.getElementById("cancelarOmitirManualButton");

    // Deshabilitar el input del archivo
    manualInput.disabled = true;

    // Cambiar el valor del input a 
    manualInput.value = "";

    // Cambiar el icono en el contenedor
    iconContainer.innerHTML =
        '<lord-icon src="https://cdn.lordicon.com/jvihlqtw.json" trigger="hover" colors="primary:#86c716,secondary:#e8e230" stroke="65" style="width:50px;height:70px"></lord-icon>';

    // Mostrar el botón "Cancelar" y ocultar el botón "Omitir"
    omitirManualButton.style.display = "none";
    cancelarOmitirManualButton.style.display = "block";
    }

    function cancelarOmitirManual() {
        // Obtener el input del archivo y el contenedor del icono
        var manualInput = document.getElementById("manual_ruta");
        var iconContainer = document.getElementById("iconContainerManual");
        var omitirManualButton = document.getElementById("omitirManualButton");
        var cancelarOmitirManualButton = document.getElementById("cancelarOmitirManualButton");
        var cancelarOmitirRegistroButton = document.getElementById("cancelarOmitirRegistroButton");

        // Habilitar el input del archivo nuevamente
        manualInput.disabled = false;

        // Restaurar el valor del input a su estado original (vacío)
        manualInput.value = "";

        // Restaurar el icono original en el contenedor
        iconContainer.innerHTML =
            '<lord-icon src="https://cdn.lordicon.com/koyivthb.json" trigger="hover" colors="primary:#86c716,secondary:#e8e230" stroke="65" style="width:50px;height:70px"></lord-icon>';

        // Mostrar el botón "Omitir" y ocultar el botón "Cancelar"
        omitirManualButton.style.display = "block";
        cancelarOmitirManualButton.style.display = "none";
    }
    document.addEventListener("DOMContentLoaded", function() {
        var manualInput = document.getElementById("manual_ruta");
        var downloadManualButton = document.getElementById("downloadManualButton");
        var removeManualButton = document.getElementById("removeManualButton");
        var omitirManualButton = document.getElementById("omitirManualButton");
        var iconContainer = document.getElementById("iconContainerManual");
        var cancelarOmitirManualButton = document.getElementById("cancelarOmitirManualButton");

        manualInput.addEventListener("click", function (event) {
        if (!alertShownManual) {
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
                alertShownManual = true; // Set the flag to true to prevent the alert from showing again
                manualInput.click(); // Open the file explorer manually
            }
            });
        }
        });
        
        manualInput.addEventListener("change", function(event) {
            if (event.target.files.length > 0) {
                var file = event.target.files[0];
                var fileURL = URL.createObjectURL(file);
                downloadManualButton.setAttribute("href", fileURL);
                downloadManualButton.style.display = "block";
                removeManualButton.style.display = "block";
                omitirManualButton.style.display = "none";
                cancelarOmitirManualButton.style.display = "none";
                alertShownManual = false;
                iconContainer.innerHTML = '<lord-icon src="https://cdn.lordicon.com/nxaaasqe.json" trigger="hover" colors="primary:#86c716,secondary:#e8e230" style="width:50px;height:70px"></lord-icon>';
            } else {
                downloadManualButton.style.display = "none";
                removeManualButton.style.display = "none";
                omitirManualButton.style.display = "block";
                alertShownManual = true;
                iconContainer.innerHTML = '<lord-icon src="https://cdn.lordicon.com/koyivthb.json" trigger="hover" colors="primary:#86c716,secondary:#e8e230" stroke="65" style="width:50px;height:70px"></lord-icon>';
            }
        });

        removeManualButton.addEventListener("click", function() {
            manualInput.value = null;
            downloadManualButton.removeAttribute("href");
            downloadManualButton.style.display = "none";
            removeManualButton.style.display = "none";
            omitirManualButton.style.display = "block";
            alertShownManual = true;
            iconContainer.innerHTML = '<lord-icon src="https://cdn.lordicon.com/koyivthb.json" trigger="hover" colors="primary:#86c716,secondary:#e8e230" stroke="65" style="width:50px;height:70px"></lord-icon>';
        });
    });

    function omitirRegistro() {
    // Obtener el input del archivo y el contenedor del icono
    var registroInput = document.getElementById("registro_ruta");
    var iconContainer = document.getElementById("iconContainerRegistro");
    var omitirRegistroButton = document.getElementById("omitirRegistroButton");
    var cancelarOmitirRegistroButton = document.getElementById("cancelarOmitirRegistroButton");

    // Deshabilitar el input del archivo
    registroInput.disabled = true;

    // Cambiar el valor del input a 1
    registroInput.value = "";

    // Cambiar el icono en el contenedor
    iconContainer.innerHTML =
        '<lord-icon src="https://cdn.lordicon.com/jvihlqtw.json" trigger="hover" colors="primary:#86c716,secondary:#e8e230" stroke="65" style="width:50px;height:70px"></lord-icon>';

    // Mostrar el botón "Cancelar" y ocultar el botón "Omitir"
    omitirRegistroButton.style.display = "none";
    cancelarOmitirRegistroButton.style.display = "block";
    }

    function cancelarOmitirRegistro() {
    // Obtener el input del archivo y el contenedor del icono
    var registroInput = document.getElementById("registro_ruta");
    var iconContainer = document.getElementById("iconContainerRegistro");
    var omitirRegistroButton = document.getElementById("omitirRegistroButton");
    var cancelarOmitirRegistroButton = document.getElementById("cancelarOmitirRegistroButton");

    // Habilitar el input del archivo nuevamente
    registroInput.disabled = false;

    // Restaurar el valor del input a su estado original (vacío)
    registroInput.value = "";

    // Restaurar el icono original en el contenedor
    iconContainer.innerHTML =
        '<lord-icon src="https://cdn.lordicon.com/koyivthb.json" trigger="hover" colors="primary:#86c716,secondary:#e8e230" stroke="65" style="width:50px;height:70px"></lord-icon>';

    // Mostrar el botón "Omitir" y ocultar el botón "Cancelar"
    omitirRegistroButton.style.display = "block";
    cancelarOmitirRegistroButton.style.display = "none";
    }

    document.addEventListener("DOMContentLoaded", function() {
        var registroInput = document.getElementById("registro_ruta");
        var downloadRegistroButton = document.getElementById("downloadRegistroButton");
        var removeRegistroButton = document.getElementById("removeRegistroButton");
        var omitirRegistroButton = document.getElementById("omitirRegistroButton");
        var iconContainer = document.getElementById("iconContainerRegistro");
        var cancelarOmitirRegistroButton = document.getElementById("cancelarOmitirRegistroButton");

        registroInput.addEventListener("click", function (event) {
        if (!alertShownRegistro) {
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
                alertShownRegistro = true; // Set the flag to true to prevent the alert from showing again
                facturaInput.click(); // Open the file explorer manually
            }
            });
        }
        });

        registroInput.addEventListener("change", function(event) {
            if (event.target.files.length > 0) {
                var file = event.target.files[0];
                var fileURL = URL.createObjectURL(file);
                downloadRegistroButton.setAttribute("href", fileURL);
                downloadRegistroButton.style.display = "block";
                removeRegistroButton.style.display = "block";
                omitirRegistroButton.style.display = "none";
                cancelarOmitirRegistroButton.style.display = "none";
                alertShownRegistro = false;
                iconContainer.innerHTML = '<lord-icon src="https://cdn.lordicon.com/nxaaasqe.json" trigger="hover" colors="primary:#86c716,secondary:#e8e230" style="width:50px;height:70px"></lord-icon>';
            } else {
                downloadRegistroButton.style.display = "none";
                removeRegistroButton.style.display = "none";
                omitirRegistroButton.style.display = "block";
                alertShownRegistro = true;
                iconContainer.innerHTML = '<lord-icon src="https://cdn.lordicon.com/koyivthb.json" trigger="hover" colors="primary:#86c716,secondary:#e8e230" stroke="65" style="width:50px;height:70px"></lord-icon>';
            }
        });

        removeRegistroButton.addEventListener("click", function() {
            registroInput.value = null;
            downloadRegistroButton.removeAttribute("href");
            downloadRegistroButton.style.display = "none";
            removeRegistroButton.style.display = "none";
            omitirRegistroButton.style.display = "block";
            alertShownRegistro = true;
            iconContainer.innerHTML = '<lord-icon src="https://cdn.lordicon.com/koyivthb.json" trigger="hover" colors="primary:#86c716,secondary:#e8e230" stroke="65" style="width:50px;height:70px"></lord-icon>';
        });
    });


    document.addEventListener("DOMContentLoaded", function() {
        var fichaInput = document.getElementById("ficha_ruta");
        var downloadFichaButton = document.getElementById("downloadFichaButton");
        var removeFichaButton = document.getElementById("removeFichaButton");
        var omitirFichaButton = document.getElementById("omitirFichaButton");
        var iconContainer = document.getElementById("iconContainerFicha");
        var cancelarOmitirFichaButton = document.getElementById("cancelarOmitirFichaButton");

        fichaInput.addEventListener("click", function (event) {
        if (!alertShownFicha) {
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
                alertShownFicha = true; // Set the flag to true to prevent the alert from showing again
                facturaInput.click(); // Open the file explorer manually
            }
            });
        }
        });

        fichaInput.addEventListener("change", function(event) {
            if (event.target.files.length > 0) {
                var file = event.target.files[0];
                var fileURL = URL.createObjectURL(file);
                downloadFichaButton.setAttribute("href", fileURL);
                downloadFichaButton.style.display = "block";
                omitirFichaButton.style.display = "none";
                removeFichaButton.style.display = "block";
                cancelarOmitirFichaButton.style.display = "none";
                alertShownFicha = false;
                iconContainer.innerHTML = '<lord-icon src="https://cdn.lordicon.com/nxaaasqe.json" trigger="hover" colors="primary:#86c716,secondary:#e8e230" style="width:50px;height:70px"></lord-icon>';
            } else {
                downloadFichaButton.style.display = "none";
                removeFichaButton.style.display = "none";
                omitirFichaButton.style.display = "block";
                alertShownFicha = true;
                iconContainer.innerHTML = '<lord-icon src="https://cdn.lordicon.com/koyivthb.json" trigger="hover" colors="primary:#86c716,secondary:#e8e230" stroke="65" style="width:50px;height:70px"></lord-icon>';
            }
        });

        removeFichaButton.addEventListener("click", function() {
            fichaInput.value = null;
            downloadFichaButton.removeAttribute("href");
            downloadFichaButton.style.display = "none";
            removeFichaButton.style.display = "none";
            omitirFichaButton.style.display = "block";
            alertShownFicha = true;
            iconContainer.innerHTML = '<lord-icon src="https://cdn.lordicon.com/koyivthb.json" trigger="hover" colors="primary:#86c716,secondary:#e8e230" stroke="65" style="width:50px;height:70px"></lord-icon>';
        });
    });

    function omitirFicha() {
    // Obtener el input del archivo y el contenedor del icono
    var fichaInput = document.getElementById("ficha_ruta");
    var iconContainer = document.getElementById("iconContainerFicha");
    var omitirFichaButton = document.getElementById("omitirFichaButton");
    var cancelarOmitirFichaButton = document.getElementById("cancelarOmitirFichaButton");

    // Deshabilitar el input del archivo
    fichaInput.disabled = true;

    // Cambiar el valor del input a 1
    fichaInput.value = "";

    // Cambiar el icono en el contenedor
    iconContainer.innerHTML =
        '<lord-icon src="https://cdn.lordicon.com/jvihlqtw.json" trigger="hover" colors="primary:#86c716,secondary:#e8e230" stroke="65" style="width:50px;height:70px"></lord-icon>';

    // Mostrar el botón "Cancelar" y ocultar el botón "Omitir"
    omitirFichaButton.style.display = "none";
    cancelarOmitirFichaButton.style.display = "block";
    }

    function cancelarOmitirFicha() {
        // Obtener el input del archivo y el contenedor del icono
        var fichaInput = document.getElementById("ficha_ruta");
        var iconContainer = document.getElementById("iconContainerFicha");
        var omitirFichaButton = document.getElementById("omitirFichaButton");
        var cancelarOmitirFichaButton = document.getElementById("cancelarOmitirFichaButton");

        // Habilitar el input del archivo nuevamente
        fichaInput.disabled = false;

        // Restaurar el valor del input a su estado original (vacío)
        fichaInput.value = "";

        // Restaurar el icono original en el contenedor
        iconContainer.innerHTML =
            '<lord-icon src="https://cdn.lordicon.com/koyivthb.json" trigger="hover" colors="primary:#86c716,secondary:#e8e230" stroke="65" style="width:50px;height:70px"></lord-icon>';

        // Mostrar el botón "Omitir" y ocultar el botón "Cancelar"
        omitirFichaButton.style.display = "block";
        cancelarOmitirFichaButton.style.display = "none";
    }
    
    function omitirTarjeta() {
    // Obtener el input del archivo, el contenedor del icono y los elementos relacionados con la fecha y comentario
    var tarjetaInput = document.getElementById("tarjeta_ruta");
    var iconContainer = document.getElementById("iconContainerTarjeta");
    var omitirTarjetaButton = document.getElementById("omitirTarjetaButton");
    var cancelarOmitirTarjetaButton = document.getElementById("cancelarOmitirTarjetaButton");
    var tarjetaFechaInput = document.getElementById("tarjeta_fecha");
    var comentarioTarjetaInput = document.getElementsByName("comentarioTarjeta")[0];

    // Deshabilitar el input del archivo, la fecha y el comentario
    tarjetaInput.disabled = true;
    tarjetaFechaInput.disabled = true;
    comentarioTarjetaInput.disabled = true;
    tarjetaFechaInput.value = null;
    comentarioTarjetaInput.value = null;

    // Cambiar el valor del input a 1
    tarjetaInput.value = "";

    // Cambiar el icono en el contenedor
    iconContainer.innerHTML =
        '<lord-icon src="https://cdn.lordicon.com/jvihlqtw.json" trigger="hover" colors="primary:#86c716,secondary:#e8e230" stroke="65" style="width:50px;height:70px"></lord-icon>';

    // Mostrar el botón "Cancelar" y ocultar el botón "Omitir"
    omitirTarjetaButton.style.display = "none";
    cancelarOmitirTarjetaButton.style.display = "block";
    }

    function cancelarOmitirTarjeta() {
    // Obtener el input del archivo, el contenedor del icono y los elementos relacionados con la fecha y comentario
    var tarjetaInput = document.getElementById("tarjeta_ruta");
    var iconContainer = document.getElementById("iconContainerTarjeta");
    var omitirTarjetaButton = document.getElementById("omitirTarjetaButton");
    var cancelarOmitirTarjetaButton = document.getElementById("cancelarOmitirTarjetaButton");
    var tarjetaFechaInput = document.getElementById("tarjeta_fecha");
    var comentarioTarjetaInput = document.getElementsByName("comentarioTarjeta")[0];

    // Habilitar el input del archivo, la fecha y el comentario nuevamente
    tarjetaInput.disabled = false;
    tarjetaFechaInput.disabled = false;
    comentarioTarjetaInput.disabled = false;

    // Restaurar el valor del input a su estado original (vacío)
    tarjetaInput.value = "";

    // Restaurar el icono original en el contenedor
    iconContainer.innerHTML =
        '<lord-icon src="https://cdn.lordicon.com/koyivthb.json" trigger="hover" colors="primary:#86c716,secondary:#e8e230" stroke="65" style="width:50px;height:70px"></lord-icon>';

    // Mostrar el botón "Omitir" y ocultar el botón "Cancelar"
    omitirTarjetaButton.style.display = "block";
    cancelarOmitirTarjetaButton.style.display = "none";
    }

    document.addEventListener("DOMContentLoaded", function() {
        var tarjetaInput = document.getElementById("tarjeta_ruta");
        var downloadTarjetaButton = document.getElementById("downloadTarjetaButton");
        var removeTarjetaButton = document.getElementById("removeTarjetaButton");
        var omitirTarjetaButton = document.getElementById("omitirTarjetaButton");
        var iconContainer = document.getElementById("iconContainerTarjeta");
        var cancelarOmitirFichaButton = document.getElementById("cancelarOmitirFichaButton");
        var cancelarOmitirTarjetaButton = document.getElementById("cancelarOmitirTarjetaButton");

        tarjetaInput.addEventListener("click", function (event) {
        if (!alertShownTarjeta) {
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
                alertShownTarjeta = true; // Set the flag to true to prevent the alert from showing again
                facturaInput.click(); // Open the file explorer manually
            }
            });
        }
        });

        tarjetaInput.addEventListener("change", function(event) {
            if (event.target.files.length > 0) {
                var file = event.target.files[0];
                var fileURL = URL.createObjectURL(file);
                downloadTarjetaButton.setAttribute("href", fileURL);
                downloadTarjetaButton.style.display = "block";
                removeTarjetaButton.style.display = "block";
                omitirTarjetaButton.style.display = "none";
                cancelarOmitirTarjetaButton.style.display = "none";
                alertShownTarjeta = false;
                iconContainer.innerHTML = '<lord-icon src="https://cdn.lordicon.com/nxaaasqe.json" trigger="hover" colors="primary:#86c716,secondary:#e8e230" style="width:50px;height:70px"></lord-icon>';
            } else {
                downloadTarjetaButton.style.display = "none";
                removeTarjetaButton.style.display = "none";
                omitirTarjetaButton.style.display = "block";
                alertShownTarjeta = true;
                iconContainer.innerHTML = '<lord-icon src="https://cdn.lordicon.com/koyivthb.json" trigger="hover" colors="primary:#86c716,secondary:#e8e230" stroke="65" style="width:50px;height:70px"></lord-icon>';
            }
        });

        removeTarjetaButton.addEventListener("click", function() {
            tarjetaInput.value = null;
            downloadTarjetaButton.removeAttribute("href");
            downloadTarjetaButton.style.display = "none";
            removeTarjetaButton.style.display = "none";
            omitirTarjetaButton.style.display = "block";
            alertShownTarjeta = true;
            iconContainer.innerHTML = '<lord-icon src="https://cdn.lordicon.com/koyivthb.json" trigger="hover" colors="primary:#86c716,secondary:#e8e230" stroke="65" style="width:50px;height:70px"></lord-icon>';
        });
    });

    function omitirSeguros() {
    // Obtener el input del archivo, el contenedor del icono y los elementos relacionados con la fecha y comentario
    var segurosInput = document.getElementById("seguros_ruta");
    var iconContainer = document.getElementById("iconContainerSeguros");
    var omitirSegurosButton = document.getElementById("omitirSegurosButton");
    var cancelarOmitirSegurosButton = document.getElementById("cancelarOmitirSegurosButton");
    var segurosFechaInput = document.getElementById("seguros_fecha");
    var comentarioSegurosInput = document.getElementsByName("comentarioSeguros")[0];

    // Deshabilitar el input del archivo, la fecha y el comentario
    segurosInput.disabled = true;
    segurosFechaInput.disabled = true;
    comentarioSegurosInput.disabled = true;
    segurosFechaInput.value = null;
    comentarioSegurosInput.value = null;

    // Cambiar el valor del input a 1
    segurosInput.value = "";

    // Cambiar el icono en el contenedor
    iconContainer.innerHTML =
        '<lord-icon src="https://cdn.lordicon.com/jvihlqtw.json" trigger="hover" colors="primary:#86c716,secondary:#e8e230" stroke="65" style="width:50px;height:70px"></lord-icon>';

    // Mostrar el botón de Cancelar y ocultar el botón de Omitir
    cancelarOmitirSegurosButton.style.display = "block";
    omitirSegurosButton.style.display = "none";
    }

    function cancelarOmitirSeguros() {
    // Obtener el input del archivo, el contenedor del icono y los elementos relacionados con la fecha y comentario
    var segurosInput = document.getElementById("seguros_ruta");
    var iconContainer = document.getElementById("iconContainerSeguros");
    var omitirSegurosButton = document.getElementById("omitirSegurosButton");
    var cancelarOmitirSegurosButton = document.getElementById("cancelarOmitirSegurosButton");
    var segurosFechaInput = document.getElementById("seguros_fecha");
    var comentarioSegurosInput = document.getElementsByName("comentarioSeguros")[0];

    // Habilitar el input del archivo, la fecha y el comentario
    segurosInput.disabled = false;
    segurosFechaInput.disabled = false;
    comentarioSegurosInput.disabled = false;
    

    // Cambiar el valor del input a vacío
    segurosInput.value = "";

    // Cambiar el icono en el contenedor
    iconContainer.innerHTML =
        '<lord-icon src="https://cdn.lordicon.com/koyivthb.json" trigger="hover" colors="primary:#86c716,secondary:#e8e230" stroke="65" style="width:50px;height:70px"></lord-icon>';

    // Mostrar el botón de Omitir y ocultar el botón de Cancelar
    cancelarOmitirSegurosButton.style.display = "none";
    omitirSegurosButton.style.display = "block";
    }


    document.addEventListener("DOMContentLoaded", function() {
        var segurosInput = document.getElementById("seguros_ruta");
        var downloadSegurosButton = document.getElementById("downloadSegurosButton");
        var removeSegurosButton = document.getElementById("removeSegurosButton");
        var omitirSegurosButton = document.getElementById("omitirSegurosButton");
        var iconContainer = document.getElementById("iconContainerSeguros");
        var cancelarOmitirSegurosButton = document.getElementById("cancelarOmitirSegurosButton");
        
        segurosInput.addEventListener("click", function (event) {
        if (!alertShownSeguros) {
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
                alertShownSeguros = true; // Set the flag to true to prevent the alert from showing again
                facturaInput.click(); // Open the file explorer manually
            }
            });
        }
        });

        segurosInput.addEventListener("change", function(event) {
            if (event.target.files.length > 0) {
                var file = event.target.files[0];
                var fileURL = URL.createObjectURL(file);
                downloadSegurosButton.setAttribute("href", fileURL);
                downloadSegurosButton.style.display = "block";
                removeSegurosButton.style.display = "block";
                omitirSegurosButton.style.display = "none";
                cancelarOmitirSegurosButton.style.display = "none";
                alertShownSeguros = false;
                iconContainer.innerHTML = '<lord-icon src="https://cdn.lordicon.com/nxaaasqe.json" trigger="hover" colors="primary:#86c716,secondary:#e8e230" style="width:50px;height:70px"></lord-icon>';
            } else {
                downloadSegurosButton.style.display = "none";
                removeSegurosButton.style.display = "none";
                omitirSegurosButton.style.display = "block";
                alertShownSeguros = true;
                iconContainer.innerHTML = '<lord-icon src="https://cdn.lordicon.com/koyivthb.json" trigger="hover" colors="primary:#86c716,secondary:#e8e230" stroke="65" style="width:50px;height:70px"></lord-icon>';
            }
        });

        removeSegurosButton.addEventListener("click", function() {
            segurosInput.value = null;
            downloadSegurosButton.removeAttribute("href");
            downloadSegurosButton.style.display = "none";
            removeSegurosButton.style.display = "none";
            omitirSegurosButton.style.display = "block";
            alertShownSeguros = true;
            iconContainer.innerHTML = '<lord-icon src="https://cdn.lordicon.com/koyivthb.json" trigger="hover" colors="primary:#86c716,secondary:#e8e230" stroke="65" style="width:50px;height:70px"></lord-icon>';
        });
    });

    function omitirEspeciales() {
    // Obtener el input del archivo, el contenedor del icono y los elementos relacionados con la fecha y comentario
    var especialesInput = document.getElementById("especiales_ruta");
    var iconContainer = document.getElementById("iconContainerEspeciales");
    var omitirEspecialesButton = document.getElementById("omitirEspecialesButton");
    var cancelarOmitirEspecialesButton = document.getElementById("cancelarOmitirEspecialesButton");
    var especialesFechaInput = document.getElementById("especiales_fecha");
    var comentarioEspecialesInput = document.getElementsByName("comentarioEspeciales")[0];

    // Deshabilitar el input del archivo, la fecha y el comentario
    especialesInput.disabled = true;
    especialesFechaInput.disabled = true;
    comentarioEspecialesInput.disabled = true;
    especialesFechaInput.value = null;
    comentarioEspecialesInput.value = null;

    // Cambiar el valor del input a 1
    especialesInput.value = "";

    // Cambiar el icono en el contenedor
    iconContainer.innerHTML =
    '<lord-icon src="https://cdn.lordicon.com/jvihlqtw.json" trigger="hover" colors="primary:#86c716,secondary:#e8e230" stroke="65" style="width:50px;height:70px"></lord-icon>';

    // Mostrar el botón de Cancelar y ocultar el botón de Omitir
    cancelarOmitirEspecialesButton.style.display = "block";
    omitirEspecialesButton.style.display = "none";
}

    function cancelarOmitirEspeciales() {
    // Obtener el input del archivo, el contenedor del icono y los elementos relacionados con la fecha y comentario
    var especialesInput = document.getElementById("especiales_ruta");
    var iconContainer = document.getElementById("iconContainerEspeciales");
    var omitirEspecialesButton = document.getElementById("omitirEspecialesButton");
    var cancelarOmitirEspecialesButton = document.getElementById("cancelarOmitirEspecialesButton");
    var especialesFechaInput = document.getElementById("especiales_fecha");
    var comentarioEspecialesInput = document.getElementsByName("comentarioEspeciales")[0];

    // Habilitar el input del archivo, la fecha y el comentario
    especialesInput.disabled = false;
    especialesFechaInput.disabled = false;
    comentarioEspecialesInput.disabled = false;

    // Cambiar el valor del input a vacío
    especialesInput.value = "";

    // Cambiar el icono en el contenedor
    iconContainer.innerHTML =
        '<lord-icon src="https://cdn.lordicon.com/koyivthb.json" trigger="hover" colors="primary:#86c716,secondary:#e8e230" stroke="65" style="width:50px;height:70px"></lord-icon>';

    // Mostrar el botón de Omitir y ocultar el botón de Cancelar
    cancelarOmitirEspecialesButton.style.display = "none";
    omitirEspecialesButton.style.display = "block";
    }


    document.addEventListener("DOMContentLoaded", function() {
        var especialesInput = document.getElementById("especiales_ruta");
        var downloadEspecialesButton = document.getElementById("downloadEspecialesButton");
        var removeEspecialesButton = document.getElementById("removeEspecialesButton");
        var omitirEspecialesButton = document.getElementById("omitirEspecialesButton");
        var iconContainer = document.getElementById("iconContainerEspeciales");
        var cancelarOmitirEspecialesButton = document.getElementById("cancelarOmitirEspecialesButton");

        especialesInput.addEventListener("click", function (event) {
        if (!alertShownEspeciales) {
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
                alertShownEspeciales = true; // Set the flag to true to prevent the alert from showing again
                facturaInput.click(); // Open the file explorer manually
            }
            });
        }
        });
        
        especialesInput.addEventListener("change", function(event) {
            if (event.target.files.length > 0) {
                var file = event.target.files[0];
                var fileURL = URL.createObjectURL(file);
                downloadEspecialesButton.setAttribute("href", fileURL);
                downloadEspecialesButton.style.display = "block";
                removeEspecialesButton.style.display = "block";
                omitirEspecialesButton.style.display = "none";
                cancelarOmitirEspecialesButton.style.display = "none";
                alertShownEspeciales = false;
                iconContainer.innerHTML = '<lord-icon src="https://cdn.lordicon.com/nxaaasqe.json" trigger="hover" colors="primary:#86c716,secondary:#e8e230" style="width:50px;height:70px"></lord-icon>';
            } else {
                downloadEspecialesButton.style.display = "none";
                removeEspecialesButton.style.display = "none";
                omitirEspecialesButton.style.display = "block";
                alertShownEspeciales = true;
                iconContainer.innerHTML = '<lord-icon src="https://cdn.lordicon.com/koyivthb.json" trigger="hover" colors="primary:#86c716,secondary:#e8e230" stroke="65" style="width:50px;height:70px"></lord-icon>';
            }
        });

        removeEspecialesButton.addEventListener("click", function() {
            especialesInput.value = null;
            downloadEspecialesButton.removeAttribute("href");
            downloadEspecialesButton.style.display = "none";
            removeEspecialesButton.style.display = "none";
            omitirEspecialesButton.style.display = "block";
            alertShownEspeciales = true;
            iconContainer.innerHTML = '<lord-icon src="https://cdn.lordicon.com/koyivthb.json" trigger="hover" colors="primary:#86c716,secondary:#e8e230" stroke="65" style="width:50px;height:70px"></lord-icon>';
        });
    });

    function omitirVerificacion() {
    // Obtener el input del archivo, el contenedor del icono y los elementos relacionados con la fecha y comentario
    var verificacionInput = document.getElementById("verificacion_ruta");
    var iconContainer = document.getElementById("iconContainerVerificacion");
    var omitirVerificacionButton = document.getElementById("omitirVerificacionButton");
    var cancelarOmitirVerificacionButton = document.getElementById("cancelarOmitirVerificacionButton");
    var verificacionFechaInput = document.getElementById("verificacion_fecha");
    var comentarioVerificacionInput = document.getElementsByName("comentarioVerificacion")[0];

    // Deshabilitar el input del archivo, la fecha y el comentario
    verificacionInput.disabled = true;
    verificacionFechaInput.disabled = true;
    verificacionFechaInput.value = null;
    comentarioVerificacionInput.value = null;
    comentarioVerificacionInput.disabled = true;

    // Cambiar el valor del input a 1
    verificacionInput.value = "";

    // Cambiar el icono en el contenedor
    iconContainer.innerHTML =
        '<lord-icon src="https://cdn.lordicon.com/jvihlqtw.json" trigger="hover" colors="primary:#86c716,secondary:#e8e230" stroke="65" style="width:50px;height:70px"></lord-icon>';

    // Mostrar el botón "Cancelar" y ocultar el botón "Omitir"
    omitirVerificacionButton.style.display = "none";
    cancelarOmitirVerificacionButton.style.display = "block";
    }

    function cancelarOmitirVerificacion() {
    // Obtener el input del archivo, el contenedor del icono y los elementos relacionados con la fecha y comentario
    var verificacionInput = document.getElementById("verificacion_ruta");
    var iconContainer = document.getElementById("iconContainerVerificacion");
    var omitirVerificacionButton = document.getElementById("omitirVerificacionButton");
    var cancelarOmitirVerificacionButton = document.getElementById("cancelarOmitirVerificacionButton");
    var verificacionFechaInput = document.getElementById("verificacion_fecha");
    var comentarioVerificacionInput = document.getElementsByName("comentarioVerificacion")[0];

    // Habilitar el input del archivo, la fecha y el comentario nuevamente
    verificacionInput.disabled = false;
    verificacionFechaInput.disabled = false;
    comentarioVerificacionInput.disabled = false;

    // Restaurar el valor del input a su estado original (vacío)
    verificacionInput.value = "";

    // Restaurar el icono original en el contenedor
    iconContainer.innerHTML =
        '<lord-icon src="https://cdn.lordicon.com/koyivthb.json" trigger="hover" colors="primary:#86c716,secondary:#e8e230" stroke="65" style="width:50px;height:70px"></lord-icon>';

    // Mostrar el botón "Omitir" y ocultar el botón "Cancelar"
    omitirVerificacionButton.style.display = "block";
    cancelarOmitirVerificacionButton.style.display = "none";
    }

    document.addEventListener("DOMContentLoaded", function() {
        var verificacionInput = document.getElementById("verificacion_ruta");
        var downloadVerificacionButton = document.getElementById("downloadVerificacionButton");
        var removeVerificacionButton = document.getElementById("removeVerificacionButton");
        var omitirVerificacionButton = document.getElementById("omitirVerificacionButton");
        var iconContainer = document.getElementById("iconContainerVerificacion");
        var cancelarOmitirVerificacionButton = document.getElementById("cancelarOmitirVerificacionButton");

        verificacionInput.addEventListener("click", function (event) {
        if (!alertShownVerificacion) {
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
                alertShownVerificacion = true; // Set the flag to true to prevent the alert from showing again
                facturaInput.click(); // Open the file explorer manually
            }
            });
        }
        });

        verificacionInput.addEventListener("change", function(event) {
            if (event.target.files.length > 0) {
                var file = event.target.files[0];
                var fileURL = URL.createObjectURL(file);
                downloadVerificacionButton.setAttribute("href", fileURL);
                downloadVerificacionButton.style.display = "block";
                removeVerificacionButton.style.display = "block";
                omitirVerificacionButton.style.display = "none";
                cancelarOmitirVerificacionButton.style.display = "none";
                alertShownVerificacion = false;
                iconContainer.innerHTML = '<lord-icon src="https://cdn.lordicon.com/nxaaasqe.json" trigger="hover" colors="primary:#86c716,secondary:#e8e230" style="width:50px;height:70px"></lord-icon>';
            } else {
                downloadVerificacionButton.style.display = "none";
                removeVerificacionButton.style.display = "none";
                omitirVerificacionButton.style.display = "block";
                alertShownVerificacion = true;
                iconContainer.innerHTML = '<lord-icon src="https://cdn.lordicon.com/koyivthb.json" trigger="hover" colors="primary:#86c716,secondary:#e8e230" stroke="65" style="width:50px;height:70px"></lord-icon>';
            }
        });

        removeVerificacionButton.addEventListener("click", function() {
            verificacionInput.value = null;
            downloadVerificacionButton.removeAttribute("href");
            downloadVerificacionButton.style.display = "none";
            removeVerificacionButton.style.display = "none";
            omitirVerificacionButton.style.display = "block";
            alertShownVerificacion = true;
            iconContainer.innerHTML = '<lord-icon src="https://cdn.lordicon.com/koyivthb.json" trigger="hover" colors="primary:#86c716,secondary:#e8e230" stroke="65" style="width:50px;height:70px"></lord-icon>';
        });
    });
    </script>

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
    

    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>

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


