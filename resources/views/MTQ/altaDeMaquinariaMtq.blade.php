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
                                                                <select id="bitacora" name="bitacora[]" class="form-select"
                                                                    aria-label="Default select example">
                                                                    
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
                                                                <label class="labelTitulo">Numero Económico:</label></br>
                                                                <input type="text" class="inputCaja"
                                                                    id="identificador" name="identificador"
                                                                    value="{{ old('identificador') }}"
                                                                    placeholder="ej: MT-00">
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

                                                    <div class="card-group col-12 col-md-6 col-lg-4">
                                                        <div class="card contDocumentos">
                                                            <div class="card-body m-2">
                                                                <div>
                                                                    <label class="form-check-label text-start fs-5 textTitulo text-break mb-2" for="flexCheckDefault">
                                                                        <i class="fa fa-check-circle semaforo2"></i>
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
                                                                    <a id="downloadFacturaButton" class="btn btn-outline-success btnView" style="display: none" download><i class="fa fa-regular fa-eye mt-2"></i> Descargar</a>
                                                                    <button id="removeFacturaButton" class="btn btn-outline-danger btnView" style="width: 2.4em; height: 2.4em; display: none;"><i class="fa fa-times"></i></button>
                                                                </div>
                                                    
                                                                <button class="btnSinFondo float-end" type="submit" rel="tooltip">
                                                                    <P class="fs-5"> Omitir</P>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="card-group col-12 col-md-6 col-lg-4">
                                                        <div class="card contDocumentos">
                                                            <div class="card-body m-2">
                                                                <div>
                                                                    <label class="form-check-label text-start fs-5 textTitulo text-break mb-2" for="flexCheckDefault">
                                                                        <i class="fa fa-check-circle semaforo2"></i>
                                                                        Manual de Uso
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
                                                                    <a id="downloadManualButton" class="btn btn-outline-success btnView" style="display: none" download><i class="fa fa-regular fa-eye mt-2"></i> Descargar</a>
                                                                    <button id="removeManualButton" class="btn btn-outline-danger btnView" style="width: 2.4em; height: 2.4em; display: none;"><i class="fa fa-times"></i></button>
                                                                </div>
                                                    
                                                                <button class="btnSinFondo float-end" type="submit" rel="tooltip">
                                                                    <P class="fs-5"> Omitir</P>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="card-group col-12 col-md-6 col-lg-4">
                                                        <div class="card contDocumentos">
                                                            <div class="card-body m-2">
                                                                <div>
                                                                    <label class="form-check-label text-start fs-5 textTitulo text-break mb-2" for="flexCheckDefault">
                                                                        <i class="fa fa-check-circle semaforo2"></i>
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
                                                                    <a id="downloadRegistroButton" class="btn btn-outline-success btnView" style="display: none" download><i class="fa fa-regular fa-eye mt-2"></i> Descargar</a>
                                                                    <button id="removeRegistroButton" class="btn btn-outline-danger btnView" style="width: 2.4em; height: 2.4em; display: none;"><i class="fa fa-times"></i></button>
                                                                </div>
                                                    
                                                                <button class="btnSinFondo float-end" type="submit" rel="tooltip">
                                                                    <P class="fs-5"> Omitir</P>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="card-group col-12 col-md-6 col-lg-4">
                                                        <div class="card contDocumentos">
                                                            <div class="card-body m-2">
                                                                <div>
                                                                    <label class="form-check-label text-start fs-5 textTitulo text-break mb-2" for="flexCheckDefault">
                                                                        <i class="fa fa-check-circle semaforo2"></i>
                                                                        Ficha Técnica del Proveedor
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
                                                                    <a id="downloadFichaButton" class="btn btn-outline-success btnView" style="display: none" download><i class="fa fa-regular fa-eye mt-2"></i> Descargar</a>
                                                                    <button id="removeFichaButton" class="btn btn-outline-danger btnView" style="width: 2.4em; height: 2.4em; display: none;"><i class="fa fa-times"></i></button>
                                                                </div>
                                                    
                                                                <button class="btnSinFondo float-end" type="submit" rel="tooltip">
                                                                    <P class="fs-5"> Omitir</P>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="card-group col-12 col-md-6 col-lg-4">
                                                        <div class="card contDocumentos">
                                                            <div class="card-body m-2">
                                                                <div>
                                                                    <label class="form-check-label text-start fs-5 textTitulo text-break mb-2" for="flexCheckDefault">
                                                                        <i class="fa fa-check-circle semaforo2"></i>
                                                                        Verificacion
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
                                                                    <a id="downloadVerificacionButton" class="btn btn-outline-success btnView" style="display: none" download><i class="fa fa-regular fa-eye mt-2"></i> Descargar</a>
                                                                    <button id="removeVerificacionButton" class="btn btn-outline-danger btnView" style="width: 2.4em; height: 2.4em; display: none;"><i class="fa fa-times"></i></button>
                                                                </div>
                                                    
                                                                <button class="btnSinFondo float-end" type="submit" rel="tooltip">
                                                                    <P class="fs-5"> Omitir</P>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="card-group col-12 col-md-6 col-lg-4">
                                                        <div class="card contDocumentos">
                                                            <div class="card-body m-2">
                                                                <div>
                                                                    <label class="form-check-label text-start fs-5 textTitulo text-break mb-2" for="flexCheckDefault">
                                                                        <i class="fa fa-check-circle semaforo2"></i>
                                                                        Tarjeta de Circulación
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
                                                                    <a id="downloadTarjetaButton" class="btn btn-outline-success btnView" style="display: none" download><i class="fa fa-regular fa-eye mt-2"></i> Descargar</a>
                                                                    <button id="removeTarjetaButton" class="btn btn-outline-danger btnView" style="width: 2.4em; height: 2.4em; display: none;"><i class="fa fa-times"></i></button>
                                                                </div>
                                                    
                                                                <button class="btnSinFondo float-end" type="submit" rel="tooltip">
                                                                    <P class="fs-5"> Omitir</P>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="card-group col-12 col-md-6 col-lg-4">
                                                        <div class="card contDocumentos">
                                                            <div class="card-body m-2">
                                                                <div>
                                                                    <label class="form-check-label text-start fs-5 textTitulo text-break mb-2" for="flexCheckDefault">
                                                                        <i class="fa fa-check-circle semaforo2"></i>
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
                                                                    <a id="downloadSegurosButton" class="btn btn-outline-success btnView" style="display: none" download><i class="fa fa-regular fa-eye mt-2"></i> Descargar</a>
                                                                    <button id="removeSegurosButton" class="btn btn-outline-danger btnView" style="width: 2.4em; height: 2.4em; display: none;"><i class="fa fa-times"></i></button>
                                                                </div>
                                                    
                                                                <button class="btnSinFondo float-end" type="submit" rel="tooltip">
                                                                    <P class="fs-5"> Omitir</P>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="card-group col-12 col-md-6 col-lg-4">
                                                        <div class="card contDocumentos">
                                                            <div class="card-body m-2">
                                                                <div>
                                                                    <label class="form-check-label text-start fs-5 textTitulo text-break mb-2" for="flexCheckDefault">
                                                                        <i class="fa fa-check-circle semaforo2"></i>
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
                                                                    <a id="downloadEspecialesButton" class="btn btn-outline-success btnView" style="display: none" download><i class="fa fa-regular fa-eye mt-2"></i> Descargar</a>
                                                                    <button id="removeEspecialesButton" class="btn btn-outline-danger btnView" style="width: 2.4em; height: 2.4em; display: none;"><i class="fa fa-times"></i></button>
                                                                </div>
                                                    
                                                                <button class="btnSinFondo float-end" type="submit" rel="tooltip">
                                                                    <P class="fs-5"> Omitir</P>
                                                                </button>
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

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var facturaInput = document.getElementById("factura_ruta");
            var downloadFacturaButton = document.getElementById("downloadFacturaButton");
            var removeFacturaButton = document.getElementById("removeFacturaButton");
            var iconContainer = document.getElementById("iconContainerFactura");
    
            facturaInput.addEventListener("change", function(event) {
                if (event.target.files.length > 0) {
                    var file = event.target.files[0];
                    var fileURL = URL.createObjectURL(file);
                    downloadFacturaButton.setAttribute("href", fileURL);
                    downloadFacturaButton.style.display = "block";
                    removeFacturaButton.style.display = "block";
                    iconContainer.innerHTML = '<lord-icon src="https://cdn.lordicon.com/nxaaasqe.json" trigger="hover" colors="primary:#86c716,secondary:#e8e230" style="width:50px;height:70px"></lord-icon>';
                } else {
                    downloadFacturaButton.style.display = "none";
                    removeFacturaButton.style.display = "none";
                    iconContainer.innerHTML = '<lord-icon src="https://cdn.lordicon.com/koyivthb.json" trigger="hover" colors="primary:#86c716,secondary:#e8e230" stroke="65" style="width:50px;height:70px"></lord-icon>';
                }
            });
    
            removeFacturaButton.addEventListener("click", function() {
                facturaInput.value = null;
                downloadFacturaButton.removeAttribute("href");
                downloadFacturaButton.style.display = "none";
                removeFacturaButton.style.display = "none";
                iconContainer.innerHTML = '<lord-icon src="https://cdn.lordicon.com/koyivthb.json" trigger="hover" colors="primary:#86c716,secondary:#e8e230" stroke="65" style="width:50px;height:70px"></lord-icon>';
            });
        });
        document.addEventListener("DOMContentLoaded", function() {
            var manualInput = document.getElementById("manual_ruta");
            var downloadManualButton = document.getElementById("downloadManualButton");
            var removeManualButton = document.getElementById("removeManualButton");
            var iconContainer = document.getElementById("iconContainerManual");
    
            manualInput.addEventListener("change", function(event) {
                if (event.target.files.length > 0) {
                    var file = event.target.files[0];
                    var fileURL = URL.createObjectURL(file);
                    downloadManualButton.setAttribute("href", fileURL);
                    downloadManualButton.style.display = "block";
                    removeManualButton.style.display = "block";
                    iconContainer.innerHTML = '<lord-icon src="https://cdn.lordicon.com/nxaaasqe.json" trigger="hover" colors="primary:#86c716,secondary:#e8e230" style="width:50px;height:70px"></lord-icon>';
                } else {
                    downloadManualButton.style.display = "none";
                    removeManualButton.style.display = "none";
                    iconContainer.innerHTML = '<lord-icon src="https://cdn.lordicon.com/koyivthb.json" trigger="hover" colors="primary:#86c716,secondary:#e8e230" stroke="65" style="width:50px;height:70px"></lord-icon>';
                }
            });
    
            removeManualButton.addEventListener("click", function() {
                manualInput.value = null;
                downloadManualButton.removeAttribute("href");
                downloadManualButton.style.display = "none";
                removeManualButton.style.display = "none";
                iconContainer.innerHTML = '<lord-icon src="https://cdn.lordicon.com/koyivthb.json" trigger="hover" colors="primary:#86c716,secondary:#e8e230" stroke="65" style="width:50px;height:70px"></lord-icon>';
            });
        });
        document.addEventListener("DOMContentLoaded", function() {
            var registroInput = document.getElementById("registro_ruta");
            var downloadRegistroButton = document.getElementById("downloadRegistroButton");
            var removeRegistroButton = document.getElementById("removeRegistroButton");
            var iconContainer = document.getElementById("iconContainerRegistro");
    
            registroInput.addEventListener("change", function(event) {
                if (event.target.files.length > 0) {
                    var file = event.target.files[0];
                    var fileURL = URL.createObjectURL(file);
                    downloadRegistroButton.setAttribute("href", fileURL);
                    downloadRegistroButton.style.display = "block";
                    removeRegistroButton.style.display = "block";
                    iconContainer.innerHTML = '<lord-icon src="https://cdn.lordicon.com/nxaaasqe.json" trigger="hover" colors="primary:#86c716,secondary:#e8e230" style="width:50px;height:70px"></lord-icon>';
                } else {
                    downloadRegistroButton.style.display = "none";
                    removeRegistroButton.style.display = "none";
                    iconContainer.innerHTML = '<lord-icon src="https://cdn.lordicon.com/koyivthb.json" trigger="hover" colors="primary:#86c716,secondary:#e8e230" stroke="65" style="width:50px;height:70px"></lord-icon>';
                }
            });
    
            removeRegistroButton.addEventListener("click", function() {
                registroInput.value = null;
                downloadRegistroButton.removeAttribute("href");
                downloadRegistroButton.style.display = "none";
                removeRegistroButton.style.display = "none";
                iconContainer.innerHTML = '<lord-icon src="https://cdn.lordicon.com/koyivthb.json" trigger="hover" colors="primary:#86c716,secondary:#e8e230" stroke="65" style="width:50px;height:70px"></lord-icon>';
            });
        });
        document.addEventListener("DOMContentLoaded", function() {
            var fichaInput = document.getElementById("ficha_ruta");
            var downloadFichaButton = document.getElementById("downloadFichaButton");
            var removeFichaButton = document.getElementById("removeFichaButton");
            var iconContainer = document.getElementById("iconContainerFicha");
    
            fichaInput.addEventListener("change", function(event) {
                if (event.target.files.length > 0) {
                    var file = event.target.files[0];
                    var fileURL = URL.createObjectURL(file);
                    downloadFichaButton.setAttribute("href", fileURL);
                    downloadFichaButton.style.display = "block";
                    removeFichaButton.style.display = "block";
                    iconContainer.innerHTML = '<lord-icon src="https://cdn.lordicon.com/nxaaasqe.json" trigger="hover" colors="primary:#86c716,secondary:#e8e230" style="width:50px;height:70px"></lord-icon>';
                } else {
                    downloadFichaButton.style.display = "none";
                    removeFichaButton.style.display = "none";
                    iconContainer.innerHTML = '<lord-icon src="https://cdn.lordicon.com/koyivthb.json" trigger="hover" colors="primary:#86c716,secondary:#e8e230" stroke="65" style="width:50px;height:70px"></lord-icon>';
                }
            });
    
            removeFichaButton.addEventListener("click", function() {
                fichaInput.value = null;
                downloadFichaButton.removeAttribute("href");
                downloadFichaButton.style.display = "none";
                removeFichaButton.style.display = "none";
                iconContainer.innerHTML = '<lord-icon src="https://cdn.lordicon.com/koyivthb.json" trigger="hover" colors="primary:#86c716,secondary:#e8e230" stroke="65" style="width:50px;height:70px"></lord-icon>';
            });
        });
        
        document.addEventListener("DOMContentLoaded", function() {
            var tarjetaInput = document.getElementById("tarjeta_ruta");
            var downloadTarjetaButton = document.getElementById("downloadTarjetaButton");
            var removeTarjetaButton = document.getElementById("removeTarjetaButton");
            var iconContainer = document.getElementById("iconContainerTarjeta");
    
            tarjetaInput.addEventListener("change", function(event) {
                if (event.target.files.length > 0) {
                    var file = event.target.files[0];
                    var fileURL = URL.createObjectURL(file);
                    downloadTarjetaButton.setAttribute("href", fileURL);
                    downloadTarjetaButton.style.display = "block";
                    removeTarjetaButton.style.display = "block";
                    iconContainer.innerHTML = '<lord-icon src="https://cdn.lordicon.com/nxaaasqe.json" trigger="hover" colors="primary:#86c716,secondary:#e8e230" style="width:50px;height:70px"></lord-icon>';
                } else {
                    downloadTarjetaButton.style.display = "none";
                    removeTarjetaButton.style.display = "none";
                    iconContainer.innerHTML = '<lord-icon src="https://cdn.lordicon.com/koyivthb.json" trigger="hover" colors="primary:#86c716,secondary:#e8e230" stroke="65" style="width:50px;height:70px"></lord-icon>';
                }
            });
    
            removeTarjetaButton.addEventListener("click", function() {
                tarjetaInput.value = null;
                downloadTarjetaButton.removeAttribute("href");
                downloadTarjetaButton.style.display = "none";
                removeTarjetaButton.style.display = "none";
                iconContainer.innerHTML = '<lord-icon src="https://cdn.lordicon.com/koyivthb.json" trigger="hover" colors="primary:#86c716,secondary:#e8e230" stroke="65" style="width:50px;height:70px"></lord-icon>';
            });
        });

        document.addEventListener("DOMContentLoaded", function() {
            var segurosInput = document.getElementById("seguros_ruta");
            var downloadSegurosButton = document.getElementById("downloadSegurosButton");
            var removeSegurosButton = document.getElementById("removeSegurosButton");
            var iconContainer = document.getElementById("iconContainerSeguros");
    
            segurosInput.addEventListener("change", function(event) {
                if (event.target.files.length > 0) {
                    var file = event.target.files[0];
                    var fileURL = URL.createObjectURL(file);
                    downloadSegurosButton.setAttribute("href", fileURL);
                    downloadSegurosButton.style.display = "block";
                    removeSegurosButton.style.display = "block";
                    iconContainer.innerHTML = '<lord-icon src="https://cdn.lordicon.com/nxaaasqe.json" trigger="hover" colors="primary:#86c716,secondary:#e8e230" style="width:50px;height:70px"></lord-icon>';
                } else {
                    downloadSegurosButton.style.display = "none";
                    removeSegurosButton.style.display = "none";
                    iconContainer.innerHTML = '<lord-icon src="https://cdn.lordicon.com/koyivthb.json" trigger="hover" colors="primary:#86c716,secondary:#e8e230" stroke="65" style="width:50px;height:70px"></lord-icon>';
                }
            });
    
            removeSegurosButton.addEventListener("click", function() {
                segurosInput.value = null;
                downloadSegurosButton.removeAttribute("href");
                downloadSegurosButton.style.display = "none";
                removeSegurosButton.style.display = "none";
                iconContainer.innerHTML = '<lord-icon src="https://cdn.lordicon.com/koyivthb.json" trigger="hover" colors="primary:#86c716,secondary:#e8e230" stroke="65" style="width:50px;height:70px"></lord-icon>';
            });
        });

        document.addEventListener("DOMContentLoaded", function() {
            var especialesInput = document.getElementById("especiales_ruta");
            var downloadEspecialesButton = document.getElementById("downloadEspecialesButton");
            var removeEspecialesButton = document.getElementById("removeEspecialesButton");
            var iconContainer = document.getElementById("iconContainerEspeciales");
    
            especialesInput.addEventListener("change", function(event) {
                if (event.target.files.length > 0) {
                    var file = event.target.files[0];
                    var fileURL = URL.createObjectURL(file);
                    downloadEspecialesButton.setAttribute("href", fileURL);
                    downloadEspecialesButton.style.display = "block";
                    removeEspecialesButton.style.display = "block";
                    iconContainer.innerHTML = '<lord-icon src="https://cdn.lordicon.com/nxaaasqe.json" trigger="hover" colors="primary:#86c716,secondary:#e8e230" style="width:50px;height:70px"></lord-icon>';
                } else {
                    downloadEspecialesButton.style.display = "none";
                    removeEspecialesButton.style.display = "none";
                    iconContainer.innerHTML = '<lord-icon src="https://cdn.lordicon.com/koyivthb.json" trigger="hover" colors="primary:#86c716,secondary:#e8e230" stroke="65" style="width:50px;height:70px"></lord-icon>';
                }
            });
    
            removeEspecialesButton.addEventListener("click", function() {
                especialesInput.value = null;
                downloadEspecialesButton.removeAttribute("href");
                downloadEspecialesButton.style.display = "none";
                removeEspecialesButton.style.display = "none";
                iconContainer.innerHTML = '<lord-icon src="https://cdn.lordicon.com/koyivthb.json" trigger="hover" colors="primary:#86c716,secondary:#e8e230" stroke="65" style="width:50px;height:70px"></lord-icon>';
            });
        });

        document.addEventListener("DOMContentLoaded", function() {
            var verificacionInput = document.getElementById("verificacion_ruta");
            var downloadVerificacionButton = document.getElementById("downloadVerificacionButton");
            var removeVerificacionButton = document.getElementById("removeVerificacionButton");
            var iconContainer = document.getElementById("iconContainerVerificacion");
    
            verificacionInput.addEventListener("change", function(event) {
                if (event.target.files.length > 0) {
                    var file = event.target.files[0];
                    var fileURL = URL.createObjectURL(file);
                    downloadVerificacionButton.setAttribute("href", fileURL);
                    downloadVerificacionButton.style.display = "block";
                    removeVerificacionButton.style.display = "block";
                    iconContainer.innerHTML = '<lord-icon src="https://cdn.lordicon.com/nxaaasqe.json" trigger="hover" colors="primary:#86c716,secondary:#e8e230" style="width:50px;height:70px"></lord-icon>';
                } else {
                    downloadVerificacionButton.style.display = "none";
                    removeVerificacionButton.style.display = "none";
                    iconContainer.innerHTML = '<lord-icon src="https://cdn.lordicon.com/koyivthb.json" trigger="hover" colors="primary:#86c716,secondary:#e8e230" stroke="65" style="width:50px;height:70px"></lord-icon>';
                }
            });
    
            removeVerificacionButton.addEventListener("click", function() {
                verificacionInput.value = null;
                downloadVerificacionButton.removeAttribute("href");
                downloadVerificacionButton.style.display = "none";
                removeVerificacionButton.style.display = "none";
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


