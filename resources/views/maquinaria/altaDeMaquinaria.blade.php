@extends('layouts.main', ['activePage' => 'equipos', 'titlePage' => __('Alta de Maquinaria')])
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
            <div class="row justify-content-center">
                <div class="col-11 align-self-center">
                    <div class="card col-12">
                        <div class="card-body contCart">
                            <form class="row alertaGuardar" action="{{ route('maquinaria.store') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="accordion my-3" id="accordionExample">

                                    <div class="accordion-item">
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
                                                        <div class="text-center mx-auto border contFotoMaquinaria mb-4">
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
                                                            <div class=" col-12 col-sm-6  mb-3 ">
                                                                <label class="labelTitulo">Nombre: <span>*</span></label></br>
                                                                <input type="text" class="inputCaja" id="nombre" placeholder="Especifique..." required
                                                                    name="nombre" value="{{ old('nombre') }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6  mb-3 ">
                                                                <label class="labelTitulo">Marca:</label></br>
                                                                <input type="text" class="inputCaja" id="marca"  placeholder="Especifique..."
                                                                    name="marca" value="{{ old('marca') }}">
                                                            </div>


                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Modelo:</label></br>
                                                                <input type="text" class="inputCaja" id="modelo"  placeholder="Especifique..."
                                                                    name="modelo" value="{{ old('modelo') }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Sub Marca:</label></br>
                                                                <input type="text" class="inputCaja" id="submarca"  placeholder="Especifique..."
                                                                    name="submarca" value="{{ old('submarca') }}">
                                                            </div>

                                                            {{-- <div class=" col-12 col-sm-6 col-lg-4  mb-3 ">
                                                                <label class="labelTitulo">Categoría:</label></br>
                                                                <input type="text" class="inputCaja" id="categoria"
                                                                    name="categoria" value="{{ old('categoria') }}"
                                                                    placeholder="ej: excavadora">
                                                            </div> --}}

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Categoría:</label><span>*</span></br>
                                                                <select class="form-select"
                                                                    aria-label="Default select example" id="categoria" required
                                                                    name="categoria">
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
                                                                <input type="number" class="inputCaja" id="ano" maxlength="4" placeholder="Ej. 2000"
                                                                    name="ano" value="{{ old('ano') }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Color:</label></br>
                                                                <input type="text" class="inputCaja" id="color" placeholder="Ej. Amarillo"
                                                                    name="color" value="{{ old('color') }}"
                                                                    >
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Placas:</label></br>
                                                                <input type="text" class="inputCaja" id="placas" placeholder="Ej. JAL-0000"
                                                                    name="placas" value="{{ old('placas') }}"
                                                                     >
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Código de maquinaria:</label></br>
                                                                <input type="text" class="inputCaja" >
                                                            </div> 

                                                            <input type="hidden" id="identificador" name="identificador"
                                                                value="">

                                                            <div class=" col-12 col-sm-6  mb-3">
                                                                <label class="labelTitulo">Motor:</label></br>
                                                                <input type="text" class="inputCaja" id="motor" placeholder="Especifique..."
                                                                    name="motor" value="{{ old('motor') }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6  mb-3 ">
                                                                <label class="labelTitulo">Número Motor:</label></br>
                                                                <input type="text" class="inputCaja" id="nummotor" placeholder="Ej. NUM0123ABCD"
                                                                    name="nummotor" value="{{ old('nummotor') }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6  mb-3 ">
                                                                <label class="labelTitulo">Número Serie:</label></br>
                                                                <input type="text" class="inputCaja" id="numserie" placeholder="Ej. NS01234ABCD"
                                                                    name="numserie" value="{{ old('numserie') }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6  mb-3 ">
                                                                <label class="labelTitulo">Número VIN:</label></br>
                                                                <input type="text" class="inputCaja" id="vin" placeholder="Ej. 123456"
                                                                    name="vin" value="{{ old('vin') }}">
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

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Ejes:</label></br>
                                                                <input type="number" class="inputCaja" id="ejes"
                                                                    placeholder="Cantidad" name="ejes"
                                                                    value="{{ old('ejes') }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
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

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Combustible:</label></br>
                                                                <input type="text" class="inputCaja" id="combustible"
                                                                    placeholder="Diesel / Gasolina / Especificar"
                                                                    name="combustible" value="{{ old('combustible') }}">
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

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Filtro Aceite:</label></br>
                                                                <input type="number" class="inputCaja" id="filtroaceite"
                                                                    name="filtroaceite" placeholder="Cantidad"
                                                                    value="{{ old('filtroaceite') }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Filtro Aire:</label></br>
                                                                <input type="number" class="inputCaja" id="filtroaire"
                                                                    placeholder="Cantidad" name="filtroaire"
                                                                    value="{{ old('filtroaire') }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Bujías:</label></br>
                                                                <input type="number" class="inputCaja" id="bujias"
                                                                    placeholder="Cantidad" name="bujias"
                                                                    value="{{ old('bujias') }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Tipo de Bujías:</label></br>
                                                                <input type="text" class="inputCaja" id="tipobujia" placeholder="Especifique..."
                                                                    name="tipobujia" value="{{ old('tipobujia') }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Horómetro Inicial:</label></br>
                                                                <input type="number" class="inputCaja" id="horometro"  placeholder="Numérico"
                                                                    name="horometro" value="{{ old('horometro') }}">
                                                            </div>

                                                            <div class=" col-8   mb-3 ">
                                                                <div class="row align-items-end">
                                                                    <div class="col-7">
                                                                        <label class="labelTitulo">Kilometraje / Millaje
                                                                            Inicial:</label></br>
                                                                        <input type="number" class="inputCaja"
                                                                            id="kilometraje"
                                                                            name="kilometraje" placeholder="Numérico"
                                                                            value="{{ old('kilometraje') }}">

                                                                    </div>
                                                                    <div class="col-5">
                                                                        <select class="form-select"
                                                                            aria-label="Default select example"
                                                                            name="kom">
                                                                            <option value="Km">Km</option>
                                                                            <option value="Ml">Ml</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
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
                                                        </div>
                                                    </div>


                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="accordion-item">
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

                                                    <div class="col-12 col-md-4 col-lg-3">
                                                        <div class="card contDocumentos">
                                                            <div class="card-body m-2">

                                                                <div>
                                                                    <label
                                                                        class="form-check-label text-start fs-5 textTitulo text-break mb-2"
                                                                        for="flexCheckDefault">
                                                                        <i class="fa fa-check-circle semaforo2"></i>
                                                                        Factura
                                                                    </label>
                                                                </div>
                                                                <div class="contIconosDocumentos d-flex flex-wrap align-items-end align-items-center">
                                                                    <input type="hidden" id="factura_tipo" name="factura_tipo" value="Factura">
                                                                    <label class="custom-file-upload">
                                                                        <input class="mb-4" type="file"
                                                                            name="factura_ruta" id="factura_ruta" accept=".pdf">
                                                                        <lord-icon
                                                                            src="https://cdn.lordicon.com/koyivthb.json"
                                                                            trigger="hover"
                                                                            colors="primary:#86c716,secondary:#e8e230"
                                                                            stroke="65" style="width:50px;height:70px">
                                                                        </lord-icon>
                                                                    </label>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-md-4 col-lg-3">
                                                        <div class="card contDocumentos">
                                                            <div class="card-body m-2">

                                                                <div>
                                                                    <label
                                                                        class="form-check-label text-start fs-5 textTitulo text-break mb-2"
                                                                        for="flexCheckDefault">
                                                                        <i class="fa fa-user semaforo2"></i>
                                                                        Manual de Uso
                                                                    </label>

                                                                </div>
                                                                <div class="contIconosDocumentos d-flex flex-wrap align-items-end">
                                                                    <input type="hidden" id="manual_tipo" name="manual_tipo" value="Manual_de_Uso">
                                                                    <label class="custom-file-upload">
                                                                        <input class="mb-4" type="file"
                                                                            name="manual_ruta" id="manual_ruta" accept=".pdf">
                                                                        <lord-icon
                                                                            src="https://cdn.lordicon.com/koyivthb.json"
                                                                            trigger="hover"
                                                                            colors="primary:#86c716,secondary:#e8e230"
                                                                            stroke="65" style="width:50px;height:70px">
                                                                        </lord-icon>
                                                                    </label>
                                                                </div>


                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-md-4 col-lg-3">
                                                        <div class="card contDocumentos">
                                                            <div class="card-body m-2">

                                                                <div>
                                                                    <label
                                                                        class="form-check-label text-start fs-5 textTitulo text-break mb-2"
                                                                        for="flexCheckDefault">
                                                                        <i class="fa fa-user semaforo2"></i>
                                                                        Registro
                                                                    </label>

                                                                </div>
                                                                <div class="contIconosDocumentos d-flex flex-wrap align-items-end">
                                                                    <input type="hidden" id="registro_tipo" name="registro_tipo" value="Registro">

                                                                    <label class="custom-file-upload">
                                                                        <input class="mb-4" type="file"
                                                                            name="registro_ruta" id="registro_ruta"
                                                                            accept=".pdf">
                                                                        <lord-icon
                                                                            src="https://cdn.lordicon.com/koyivthb.json"
                                                                            trigger="hover"
                                                                            colors="primary:#86c716,secondary:#e8e230"
                                                                            stroke="65" style="width:50px;height:70px">
                                                                        </lord-icon>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-md-4 col-lg-3">
                                                        <div class="card contDocumentos">
                                                            <div class="card-body m-2">

                                                                <div>
                                                                    <label
                                                                        class="form-check-label text-start fs-5 textTitulo text-break mb-2"
                                                                        for="flexCheckDefault">
                                                                        <i class="fa fa-user semaforo2"></i>
                                                                        Ficha Técnica del Proveedor
                                                                    </label>
                                                                </div>
                                                                <div class="contIconosDocumentos d-flex flex-wrap align-items-end">
                                                                    <input type="hidden" id="ficha_tipo" name="ficha_tipo" value="Ficha_Tecnica_del_Proveedor">
                                                                    <label class="custom-file-upload">
                                                                        <input class="mb-4" type="file"
                                                                            name="ficha_ruta" id="ficha_ruta" accept=".pdf">
                                                                        <lord-icon
                                                                            src="https://cdn.lordicon.com/koyivthb.json"
                                                                            trigger="hover"
                                                                            colors="primary:#86c716,secondary:#e8e230"
                                                                            stroke="65" style="width:50px;height:70px">
                                                                        </lord-icon>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="col-12 col-md-4 col-lg-3">
                                                        <div class="card contDocumentos">
                                                            <div class="card-body m-2">

                                                                <div>
                                                                    <label
                                                                        class="form-check-label text-start fs-5 textTitulo text-break  mb-2"
                                                                        for="flexCheckDefault">
                                                                        <i class="fa fa-user semaforo2"></i>
                                                                        Verificación
                                                                    </label>

                                                                </div>
                                                                <div class="contIconosDocumentos d-flex flex-wrap align-items-end">
                                                                    <input type="hidden" id="verificacion_tipo" name="verificacion_tipo" value="Verificacion">
                                                                    <label class="custom-file-upload">
                                                                        <input class="mb-4" type="file"
                                                                            name="verificacion_ruta" id="verificacion_ruta"
                                                                            accept=".pdf">
                                                                        <lord-icon
                                                                            src="https://cdn.lordicon.com/koyivthb.json"
                                                                            trigger="hover"
                                                                            colors="primary:#86c716,secondary:#e8e230"
                                                                            stroke="65" style="width:50px;height:70px">
                                                                        </lord-icon>
                                                                    </label>

                                                                    <label class="labelTitulo">Fecha de vencimiento:</label></br>
                                                                    <input type="date" class="inputCaja" id="verificacion_fechaVencimiento" name="verificacion_fechaVencimiento"
                                                                        value="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-md-4 col-lg-3">
                                                        <div class="card contDocumentos">
                                                            <div class="card-body m-2">
                                                                <div>
                                                                    <label
                                                                        class="form-check-label text-start fs-5 textTitulo text-break mb-2"
                                                                        for="flexCheckDefault">
                                                                        <i class="fa fa-user semaforo2"></i>
                                                                        Tarjeta de Circulación
                                                                    </label>
                                                                </div>
                                                                <div  class="contIconosDocumentos d-flex flex-wrap align-items-end">
                                                                    <input type="hidden" id="tarjeta_tipo" name="tarjeta_tipo" value="Tarjeta_Circulacion">
                                                                    <label class="custom-file-upload">
                                                                        <input class="mb-4" type="file"
                                                                            name="tarjeta_ruta" id="tarjeta_ruta"
                                                                            accept=".pdf">
                                                                        <lord-icon
                                                                            src="https://cdn.lordicon.com/koyivthb.json"
                                                                            trigger="hover"
                                                                            colors="primary:#86c716,secondary:#e8e230"
                                                                            stroke="65" style="width:50px;height:70px">
                                                                        </lord-icon>
                                                                    </label>

                                                                    <label class="labelTitulo">Fecha de vencimiento:</label></br>
                                                                    <input type="date" class="inputCaja" id="tarjeta_fechaVencimiento" name="tarjeta_fechaVencimiento"
                                                                        value="">
                                                                </div>


                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-md-4 col-lg-3">
                                                        <div class="card contDocumentos">
                                                            <div class="card-body m-2">

                                                                <div>
                                                                    <label
                                                                        class="form-check-label text-start fs-5 textTitulo text-break mb-2"
                                                                        for="flexCheckDefault">
                                                                        <i class="fa fa-user semaforo2"></i>
                                                                        Seguros
                                                                    </label>

                                                                </div>
                                                                <div  class="contIconosDocumentos d-flex flex-wrap align-items-end">
                                                                    <input type="hidden" id="seguros_tipo" name="seguros_tipo" value="Seguros">
                                                                    <label class="custom-file-upload">
                                                                        <input class="mb-4" type="file"
                                                                            name="seguros_ruta" id="seguros_ruta" accept=".pdf">
                                                                        <lord-icon
                                                                            src="https://cdn.lordicon.com/koyivthb.json"
                                                                            trigger="hover"
                                                                            colors="primary:#86c716,secondary:#e8e230"
                                                                            stroke="65" style="width:50px;height:70px">
                                                                        </lord-icon>
                                                                    </label>

                                                                    <label class="labelTitulo">Fecha de vencimiento:</label></br>
                                                                    <input type="date" class="inputCaja" id="seguros_fechaVencimiento" name="seguros_fechaVencimiento"
                                                                        value="">
                                                                </div>


                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-md-4 col-lg-3">
                                                        <div class="card contDocumentos">
                                                            <div class="card-body m-2">

                                                                <div>
                                                                    <label
                                                                        class="form-check-label text-start fs-5 textTitulo text-break mb-2"
                                                                        for="flexCheckDefault">
                                                                        <i class="fa fa-user semaforo2"></i>
                                                                        Permisos Especiales
                                                                    </label>

                                                                </div>
                                                                <div  class="contIconosDocumentos d-flex flex-wrap align-items-end">
                                                                    <input type="hidden" id="especiales_tipo" name="especiales_tipo" value="Permisos_Especiales">
                                                                    <label class="custom-file-upload">
                                                                        <input class="mb-4" type="file"
                                                                            name="especiales_ruta" id="especiales_ruta"
                                                                            accept=".pdf">
                                                                        <lord-icon
                                                                            src="https://cdn.lordicon.com/koyivthb.json"
                                                                            trigger="hover"
                                                                            colors="primary:#86c716,secondary:#e8e230"
                                                                            stroke="65" style="width:50px;height:70px">
                                                                        </lord-icon>
                                                                    </label>

                                                                    <label class="labelTitulo">Fecha de vencimiento:</label></br>
                                                                    <input type="date" class="inputCaja" id="especiales_fechaVencimiento" name="especiales_fechaVencimiento"
                                                                        value="">

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
                                    <button type="submit" class="btn botonGral" onclick="test()">Guardar</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
@endsection
