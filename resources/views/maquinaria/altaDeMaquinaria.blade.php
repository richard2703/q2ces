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
                                                        <div class="text-center mx-auto border vistaFoto mb-4">
                                                            <i><img class="imgVista img-fluid mb-2"
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
                                                                <label class="labelTitulo">Nombre:</label></br>
                                                                <input type="text" class="inputCaja" id="nombre"
                                                                    name="nombre" value="{{ old('nombre') }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6  mb-3 ">
                                                                <label class="labelTitulo">Marca:</label></br>
                                                                <input type="text" class="inputCaja" id="marca"
                                                                    name="marca" value="{{ old('marca') }}">
                                                            </div>


                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Modelo:</label></br>
                                                                <input type="text" class="inputCaja" id="modelo"
                                                                    name="modelo" value="{{ old('modelo') }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Sub Marca:</label></br>
                                                                <input type="text" class="inputCaja" id="submarca"
                                                                    name="submarca" value="{{ old('submarca') }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4  mb-3 ">
                                                                <label class="labelTitulo">Categoría:</label></br>
                                                                <input type="text" class="inputCaja" id="categoria"
                                                                    name="categoria" value="{{ old('categoria') }}"
                                                                    placeholder="ej: excavadora">
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
                                                                <div class="row align-items-end g-0">
                                                                    <div class="col-9">
                                                                        <label class="labelTitulo">Tipo:</label></br>
                                                                        <select class="form-select"
                                                                            aria-label="Default select example"
                                                                            id="tipo" name="tipo">
                                                                            <option value="Pesada">Pesada</option>
                                                                            <option value="Ligero">Ligero</option>
                                                                            <option value="Grua">Grua</option>
                                                                        </select>

                                                                    </div>
                                                                    <div class="col-3">
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            fill="currentColor"
                                                                            class="bi bi-plus-circle-fill btnMas"
                                                                            viewBox="0 0 16 16">
                                                                            <path
                                                                                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z" />
                                                                        </svg>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Año:</label></br>
                                                                <input type="number" class="inputCaja" id="ano"
                                                                    name="ano" value="{{ old('ano') }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Color:</label></br>
                                                                <input type="text" class="inputCaja" id="color"
                                                                    name="color" value="{{ old('color') }}"
                                                                    placeholder="amarillo">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Placas:</label></br>
                                                                <input type="text" class="inputCaja" id="placas"
                                                                    name="placas" value="{{ old('placas') }}"
                                                                    placeholder="MW88888">
                                                            </div>

                                                            <div class=" col-12 col-sm-6  mb-3">
                                                                <label class="labelTitulo">Motor:</label></br>
                                                                <input type="text" class="inputCaja" id="motor"
                                                                    name="motor" value="{{ old('motor') }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6  mb-3 ">
                                                                <label class="labelTitulo">Número Motor:</label></br>
                                                                <input type="text" class="inputCaja" id="nummotor"
                                                                    name="nummotor" value="{{ old('nummotor') }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6  mb-3 ">
                                                                <label class="labelTitulo">Número Serie:</label></br>
                                                                <input type="text" class="inputCaja" id="numserie"
                                                                    name="numserie" value="{{ old('numserie') }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6  mb-3 ">
                                                                <label class="labelTitulo">Número VIN:</label></br>
                                                                <input type="text" class="inputCaja" id="vin"
                                                                    name="vin" value="{{ old('vin') }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-6 mb-3 ">
                                                                <label class="labelTitulo">Capacidad en kW:</label></br>
                                                                <input type="text" class="inputCaja" id="capacidad"
                                                                    name="capacidad" value="{{ old('capacidad') }}"
                                                                    placeholder="">
                                                            </div>

                                                            <div class="col-12 col-sm-6  mb-3">
                                                                <label class="labelTitulo">Capacidad Tanque:</label></br>
                                                                <input type="number" class="inputCaja" id="tanque"
                                                                    name="tanque" value="{{ old('tanque') }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Ejes:</label></br>
                                                                <input type="text" class="inputCaja" id="ejes"
                                                                    name="ejes" value="{{ old('ejes') }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Rin Delantero:</label></br>
                                                                <input type="text" class="inputCaja" id="rinD"
                                                                    name="rinD" value="{{ old('rinD') }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Rin Trasero:</label></br>
                                                                <input type="text" class="inputCaja" id="rinT"
                                                                    name="rinT" value="{{ old('rinT') }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Llanta Delantera:</label></br>
                                                                <input type="text" class="inputCaja" id="llantaD"
                                                                    name="llantaD" value="{{ old('llantaD') }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Llanta Trasera:</label></br>
                                                                <input type="text" class="inputCaja" id="llantaT"
                                                                    name="llantaT" value="{{ old('llantaT') }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Combustible:</label></br>
                                                                <input type="text" class="inputCaja" id="combustible"
                                                                    name="combustible" value="{{ old('combustible') }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Aceite Motor:</label></br>
                                                                <input type="text" class="inputCaja" id="aceitemotor"
                                                                    name="aceitemotor" value="{{ old('aceitemotor') }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Aceite Transmisión:</label></br>
                                                                <input type="text" class="inputCaja" id="aceitetras"
                                                                    name="aceitetras" value="{{ old('aceitetras') }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Aceite Dirección:</label></br>
                                                                <input type="text" class="inputCaja" id="aceitedirec"
                                                                    name="aceitedirec" value="{{ old('aceitedirec') }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Aceite Hidráulico:</label></br>
                                                                <input type="text" class="inputCaja"
                                                                    name="aceitehidra" value="{{ old('aceitehidra') }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Filtro Aceite:</label></br>
                                                                <input type="text" class="inputCaja" id="filtroaceite"
                                                                    name="filtroaceite"
                                                                    value="{{ old('filtroaceite') }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Filtro Aire:</label></br>
                                                                <input type="text" class="inputCaja" id="filtroaire"
                                                                    name="filtroaire" value="{{ old('filtroaire') }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Bujías:</label></br>
                                                                <input type="text" class="inputCaja" id="bujias"
                                                                    name="bujias" value="{{ old('bujias') }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Tipo de Bujías:</label></br>
                                                                <input type="text" class="inputCaja" id="tipobujia"
                                                                    name="tipobujia" value="{{ old('tipobujia') }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Horómetro Inicial:</label></br>
                                                                <input type="number" class="inputCaja" id="horometro"
                                                                    name="horometro" value="{{ old('horometro') }}">
                                                            </div>

                                                            <div class=" col-8   mb-3 ">
                                                                <div class="row align-items-end">
                                                                    <div class="col-7">
                                                                        <label class="labelTitulo">Kilometraje / Millaje
                                                                            Inicial:</label></br>
                                                                        <input type="number" class="inputCaja"
                                                                            id="kilometraje" name="kilometraje"
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
                                                                <div
                                                                    class="contIconosDocumentos d-flex flex-wrap align-items-end align-items-center">

                                                                    <label class="custom-file-upload">
                                                                        <input class="mb-4" type="file"
                                                                            name="factura" id="foto" accept=".pdf">
                                                                        <lord-icon
                                                                            src="https://cdn.lordicon.com/koyivthb.json"
                                                                            trigger="hover"
                                                                            colors="primary:#86c716,secondary:#e8e230"
                                                                            stroke="65" style="width:50px;height:70px">
                                                                        </lord-icon>
                                                                    </label>

                                                                    <label class="custom-file-upload">
                                                                        <input class="mb-4" type="file"
                                                                            name="foto" id="foto">
                                                                        <lord-icon
                                                                            src="https://cdn.lordicon.com/tyounuzx.json"
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
                                                                <div
                                                                    class="contIconosDocumentos d-flex flex-wrap align-items-end">
                                                                    <label class="custom-file-upload">
                                                                        <input class="mb-4" type="file"
                                                                            name="verificacion" id="foto"
                                                                            accept=".pdf">
                                                                        <lord-icon
                                                                            src="https://cdn.lordicon.com/koyivthb.json"
                                                                            trigger="hover"
                                                                            colors="primary:#86c716,secondary:#e8e230"
                                                                            stroke="65" style="width:50px;height:70px">
                                                                        </lord-icon>
                                                                    </label>

                                                                    <label class="custom-file-upload">
                                                                        <input class="mb-4" type="file"
                                                                            name="foto" id="foto">
                                                                        <lord-icon
                                                                            src="https://cdn.lordicon.com/tyounuzx.json"
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
                                                                <div
                                                                    class="contIconosDocumentos d-flex flex-wrap align-items-end">
                                                                    <label class="custom-file-upload">
                                                                        <input class="mb-4" type="file"
                                                                            name="manual" id="foto" accept=".pdf">
                                                                        <lord-icon
                                                                            src="https://cdn.lordicon.com/koyivthb.json"
                                                                            trigger="hover"
                                                                            colors="primary:#86c716,secondary:#e8e230"
                                                                            stroke="65" style="width:50px;height:70px">
                                                                        </lord-icon>
                                                                    </label>

                                                                    <label class="custom-file-upload">
                                                                        <input class="mb-4" type="file"
                                                                            name="foto" id="foto">
                                                                        <lord-icon
                                                                            src="https://cdn.lordicon.com/tyounuzx.json"
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
                                                                <div
                                                                    class="contIconosDocumentos d-flex flex-wrap align-items-end">
                                                                    <label class="custom-file-upload">
                                                                        <input class="mb-4" type="file"
                                                                            name="registro" id="foto"
                                                                            accept=".pdf">
                                                                        <lord-icon
                                                                            src="https://cdn.lordicon.com/koyivthb.json"
                                                                            trigger="hover"
                                                                            colors="primary:#86c716,secondary:#e8e230"
                                                                            stroke="65" style="width:50px;height:70px">
                                                                        </lord-icon>
                                                                    </label>

                                                                    <label class="custom-file-upload">
                                                                        <input class="mb-4" type="file"
                                                                            name="foto" id="foto">
                                                                        <lord-icon
                                                                            src="https://cdn.lordicon.com/tyounuzx.json"
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
                                                                        Tarjeta de Circulación
                                                                    </label>
                                                                </div>
                                                                <div
                                                                    class="contIconosDocumentos d-flex flex-wrap align-items-end">
                                                                    <label class="custom-file-upload">
                                                                        <input class="mb-4" type="file"
                                                                            name="circulacion" id="foto"
                                                                            accept=".pdf">
                                                                        <lord-icon
                                                                            src="https://cdn.lordicon.com/koyivthb.json"
                                                                            trigger="hover"
                                                                            colors="primary:#86c716,secondary:#e8e230"
                                                                            stroke="65" style="width:50px;height:70px">
                                                                        </lord-icon>
                                                                    </label>

                                                                    <label class="custom-file-upload">
                                                                        <input class="mb-4" type="file"
                                                                            name="foto" id="foto">
                                                                        <lord-icon
                                                                            src="https://cdn.lordicon.com/tyounuzx.json"
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
                                                                <div
                                                                    class="contIconosDocumentos d-flex flex-wrap align-items-end">
                                                                    <label class="custom-file-upload">
                                                                        <input class="mb-4" type="file"
                                                                            name="ficha" id="foto" accept=".pdf">
                                                                        <lord-icon
                                                                            src="https://cdn.lordicon.com/koyivthb.json"
                                                                            trigger="hover"
                                                                            colors="primary:#86c716,secondary:#e8e230"
                                                                            stroke="65" style="width:50px;height:70px">
                                                                        </lord-icon>
                                                                    </label>

                                                                    <label class="custom-file-upload">
                                                                        <input class="mb-4" type="file"
                                                                            name="foto" id="foto">
                                                                        <lord-icon
                                                                            src="https://cdn.lordicon.com/tyounuzx.json"
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
                                                                        Seguros
                                                                    </label>

                                                                </div>
                                                                <div
                                                                    class="contIconosDocumentos d-flex flex-wrap align-items-end">
                                                                    <label class="custom-file-upload">
                                                                        <input class="mb-4" type="file"
                                                                            name="seguro" id="foto" accept=".pdf">
                                                                        <lord-icon
                                                                            src="https://cdn.lordicon.com/koyivthb.json"
                                                                            trigger="hover"
                                                                            colors="primary:#86c716,secondary:#e8e230"
                                                                            stroke="65" style="width:50px;height:70px">
                                                                        </lord-icon>
                                                                    </label>

                                                                    <label class="custom-file-upload">
                                                                        <input class="mb-4" type="file"
                                                                            name="foto" id="foto">
                                                                        <lord-icon
                                                                            src="https://cdn.lordicon.com/tyounuzx.json"
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
                                                                        Permisos Especiales
                                                                    </label>

                                                                </div>
                                                                <div
                                                                    class="contIconosDocumentos d-flex flex-wrap align-items-end">
                                                                    <label class="custom-file-upload">
                                                                        <input class="mb-4" type="file"
                                                                            name="especial" id="foto"
                                                                            accept=".pdf">
                                                                        <lord-icon
                                                                            src="https://cdn.lordicon.com/koyivthb.json"
                                                                            trigger="hover"
                                                                            colors="primary:#86c716,secondary:#e8e230"
                                                                            stroke="65" style="width:50px;height:70px">
                                                                        </lord-icon>
                                                                    </label>

                                                                    <label class="custom-file-upload">
                                                                        <input class="mb-4" type="file"
                                                                            name="foto" id="foto">
                                                                        <lord-icon
                                                                            src="https://cdn.lordicon.com/tyounuzx.json"
                                                                            trigger="hover"
                                                                            colors="primary:#86c716,secondary:#e8e230"
                                                                            stroke="65" style="width:50px;height:70px">
                                                                        </lord-icon>
                                                                    </label>
                                                                </div>


                                                            </div>
                                                        </div>
                                                    </div>


                                                </div>
                                                {{--  <div class="row mt-3">
                                                    <div class="col-12 ">
                                                        <div class="row alin">

                                                            <div class="col-12 col-sm-6 col-lg-4 card contDocumentos">
                                                                <div class="row">
                                                                    <div class="col-8 mb-1 mt-1"> <label
                                                                            class="form-check-label text-start fs-5 textTitulo mb-2"
                                                                            for="flexCheckDefault">
                                                                            Factura
                                                                        </label></div>
                                                                    <div class="col-4 mb-1 mt-1"><i
                                                                            class="fa fa-user semaforo2"></i>
                                                                    </div>
                                                                    <div class="col-6 mb-1 mt-1 "> <input class="mb-4"
                                                                            type="file" name="foto" id="foto">
                                                                        <lord-icon src="https://cdn.lordicon.com/koyivthb.json" trigger="hover"  colors="primary:#86c716,secondary:#e8e230"
                                                                            stroke="65" style="width:50px;height:70px">
                                                                        </lord-icon>
                                                                    </div>
                                                                    <br>
                                                                    <div class="col-6 mb-1 mt-1"> <input class="mb-4"
                                                                            type="file" name="foto" id="foto">
                                                                        <img class="mx-2" style="height:23px"
                                                                            src="{{ asset('/img/general/guardarVerde.svg') }}">
                                                                    </div>
                                                                </div>

                                                            </div>

                                                            <div class="col-12 col-sm-6 col-lg-4 card contDocumentos">
                                                                <div class="row">
                                                                    <div class="col-8 mb-1 mt-1"> <label
                                                                            class="form-check-label text-start fs-5 textTitulo mb-2"
                                                                            for="flexCheckDefault">
                                                                            Factura
                                                                        </label></div>
                                                                    <div class="col-4 mb-1 mt-1"><i
                                                                            class="fa fa-user semaforo2"></i>
                                                                    </div>
                                                                    <div class="col-6 mb-1 mt-1 "> <input class="mb-4"
                                                                            type="file" name="foto" id="foto">
                                                                        <lord-icon src="https://cdn.lordicon.com/koyivthb.json" trigger="hover"  colors="primary:#86c716,secondary:#e8e230"
                                                                            stroke="65" style="width:50px;height:70px">
                                                                        </lord-icon>
                                                                    </div>
                                                                    <br>
                                                                    <div class="col-6 mb-1 mt-1"> <input class="mb-4"
                                                                            type="file" name="foto" id="foto">
                                                                        <img class="mx-2" style="height:23px"
                                                                            src="{{ asset('/img/general/guardarVerde.svg') }}">
                                                                    </div>
                                                                </div>

                                                            </div>

                                                            <div class="col-12 col-sm-6 col-lg-4 card contDocumentos">
                                                                <div class="row">
                                                                    <div class="col-8 mb-1 mt-1"> <label
                                                                            class="form-check-label text-start fs-5 textTitulo mb-2"
                                                                            for="flexCheckDefault">
                                                                            Factura
                                                                        </label></div>
                                                                    <div class="col-4 mb-1 mt-1"><i
                                                                            class="fa fa-user semaforo2"></i>
                                                                    </div>
                                                                    <div class="col-6 mb-1 mt-1 "> <input class="mb-4"
                                                                            type="file" name="foto" id="foto">
                                                                        <lord-icon src="https://cdn.lordicon.com/koyivthb.json" trigger="hover"  colors="primary:#86c716,secondary:#e8e230"
                                                                            stroke="65" style="width:50px;height:70px">
                                                                        </lord-icon>
                                                                    </div>
                                                                    <br>
                                                                    <div class="col-6 mb-1 mt-1"> <input class="mb-4"
                                                                            type="file" name="foto" id="foto">
                                                                        <img class="mx-2" style="height:23px"
                                                                            src="{{ asset('/img/general/guardarVerde.svg') }}">
                                                                    </div>
                                                                </div>

                                                            </div>


                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Modelo:</label></br>
                                                                <input type="text" class="inputCaja" id="modelo"
                                                                    name="modelo" value="">
                                                            </div>

                                                        </div>


                                                    </div>
                                                </div>  --}}

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
