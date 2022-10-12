@extends('layouts.main', ['activePage' => 'maquinaria', 'titlePage' => __('Detalle de Equipo')])
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-11 align-self-start">
                    <div class="card">
                        <div class="card-body contCart">
                            <form action="{{ route('maquinaria.update', $maquinaria->id) }}"
                                method="post"class="row alertaGuardar" enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="accordion my-3" id="accordionExample">

                                    <div class="accordion-item">
                                        <h2 class="accordion-header " id="headingOne">
                                            <button class="accordion-button bacTituloPrincipal" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#datosPersonales"
                                                aria-expanded="true" aria-controls="collapseOne">
                                                Retroexcabadora
                                            </button>
                                        </h2>
                                        <div id="datosPersonales" class="accordion-collapse collapse show"
                                            aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <div class="row mt-3">
                                                    <div class="col-12 col-lg-4  my-3">
                                                        <div class="row">

                                                            <div class="col-12" id="visor">
                                                                <img src="{{ asset('img/general/img1.png') }}"
                                                                    class="mx-auto d-block img-fluid">
                                                            </div>


                                                            <div class="col-12 my-3 d-flex justify-content-around"
                                                                id="selectores">
                                                                <img onclick="abre(this)" title="'Nereida'."
                                                                    src="{{ asset('img/general/img1.png') }}"
                                                                    class="img-fluid ">
                                                                <img onclick="abre(this)" title="Ricardo Crespo."
                                                                    src="{{ asset('img/general/img2.jpg') }}"
                                                                    class="img-fluid ">
                                                                <img onclick="abre(this)" title="Roberto Cortez."
                                                                    src="{{ asset('img/general/img3.jpg') }}"
                                                                    class="img-fluid ">
                                                                <img onclick="abre(this)" title="Ricardo Cinalli."
                                                                    src="{{ asset('img/general/img4.jpg') }}"
                                                                    class="img-fluid ">
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="col-12 col-md-8 ">

                                                        <div class="row alin">
                                                            {{--  <div class=" col-12 col-sm-6  mb-3 ">
                                                                <label class="labelTitulo">Nombre:</label></br>
                                                                <input type="text" class="inputCaja" id=""
                                                                name="calle" value="">
                                                            </div>  --}}

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Marca:</label></br>
                                                                <input type="text" class="inputCaja" id="marca"
                                                                    name="marca" value="{{ $maquinaria->marca }}">
                                                            </div>


                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Modelo:</label></br>
                                                                <input type="text" class="inputCaja" id="modelo"
                                                                    name="modelo" value="{{ $maquinaria->modelo }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Sub Marca:</label></br>
                                                                <input type="text" class="inputCaja" id="submarca"
                                                                    name="submarca" value="{{ $maquinaria->submarca }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6  mb-3 ">
                                                                <label class="labelTitulo">Categoría:</label></br>
                                                                <input type="text" class="inputCaja" id="categoria"
                                                                    name="categoria" value="{{ $maquinaria->categoria }}"
                                                                    placeholder="ej: excavadora">
                                                            </div>

                                                            <div class=" col-12 col-sm-6  mb-3 ">
                                                                <label class="labelTitulo">Uso:</label></br>
                                                                <select class="form-select"
                                                                    aria-label="Default select example" id="uso"
                                                                    name="uso">
                                                                    <option value="Mov. Tierras">Mov. Tierras</option>
                                                                    <option value="Completo">Completo</option>
                                                                </select>
                                                            </div>

                                                            <div class=" col-12 col-sm-8  mb-3 ">
                                                                <div class="row align-items-end">
                                                                    <div class="col-8">
                                                                        <label class="labelTitulo">Tipo:</label></br>
                                                                        <select class="form-select"
                                                                            aria-label="Default select example"
                                                                            id="tipo" name="tipo">
                                                                            <option value="Pesada">Pesada</option>
                                                                            <option value="Ligero">Ligero</option>
                                                                            <option value="Grua">Grua</option>
                                                                        </select>

                                                                    </div>
                                                                    <div class="col-4">
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

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Año:</label></br>
                                                                <input type="text" class="inputCaja" id="ano"
                                                                    name="ano" value="{{ $maquinaria->ano }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Color:</label></br>
                                                                <input type="text" class="inputCaja" id="color"
                                                                    name="color" value="{{ $maquinaria->color }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Placas:</label></br>
                                                                <input type="text" class="inputCaja" id="placas"
                                                                    name="placas" value="{{ $maquinaria->placas }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6  mb-3 ">
                                                                <label class="labelTitulo">Motor:</label></br>
                                                                <input type="text" class="inputCaja" id="motor"
                                                                    name="motor" value="{{ $maquinaria->motor }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6  mb-3 ">
                                                                <label class="labelTitulo">Número Motor:</label></br>
                                                                <input type="text" class="inputCaja" id="nummotor"
                                                                    name="nummotor" value="{{ $maquinaria->nummotor }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6  mb-3 ">
                                                                <label class="labelTitulo">Número Serie:</label></br>
                                                                <input type="text" class="inputCaja" id="numserie"
                                                                    name="numserie" value="{{ $maquinaria->numserie }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6  mb-3 ">
                                                                <label class="labelTitulo">Número VIN:</label></br>
                                                                <input type="text" class="inputCaja" id="vin"
                                                                    name="vin" value="{{ $maquinaria->vin }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Capacidad en kW:</label></br>
                                                                <input type="text" class="inputCaja" id="capacidad"
                                                                    name="capacidad" value="{{ $maquinaria->capacidad }}"
                                                                    placeholder="">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Capacidad Tanque:</label></br>
                                                                <input type="number" class="inputCaja" id="tanque"
                                                                    name="tanque" value="{{ $maquinaria->tanque }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Ejes:</label></br>
                                                                <input type="text" class="inputCaja" id="ejes"
                                                                    name="ejes" value="{{ $maquinaria->ejes }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Rin Delantero:</label></br>
                                                                <input type="text" class="inputCaja" id="rinD"
                                                                    name="rinD" value="{{ $maquinaria->rinD }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Rin Trasero:</label></br>
                                                                <input type="text" class="inputCaja" id="rinT"
                                                                    name="rinT" value="{{ $maquinaria->rinT }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Llanta Delantera:</label></br>
                                                                <input type="text" class="inputCaja" id="llantaD"
                                                                    name="llantaD" value="{{ $maquinaria->llantaD }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Llanta Trasera:</label></br>
                                                                <input type="text" class="inputCaja" id="llantaT"
                                                                    name="llantaT" value="{{ $maquinaria->llantaT }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Combustible:</label></br>
                                                                <input type="text" class="inputCaja" id="combustible"
                                                                    name="combustible"
                                                                    value="{{ $maquinaria->combustible }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Aceite Motor:</label></br>
                                                                <input type="text" class="inputCaja" id="aceitemotor"
                                                                    name="aceitemotor"
                                                                    value="{{ $maquinaria->aceitemotor }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Aceite Transmisión:</label></br>
                                                                <input type="text" class="inputCaja" id="aceitetras"
                                                                    name="aceitetras"
                                                                    value="{{ $maquinaria->aceitetras }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Aceite Dirección:</label></br>
                                                                <input type="text" class="inputCaja" id="aceitedirec"
                                                                    name="aceitedirec"
                                                                    value="{{ $maquinaria->aceitedirec }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Aceite Hidráulico:</label></br>
                                                                <input type="text" class="inputCaja"
                                                                    name="aceitehidra"
                                                                    value="{{ $maquinaria->aceitehidra }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Filtro Aceite:</label></br>
                                                                <input type="text" class="inputCaja" id="filtroaceite"
                                                                    name="filtroaceite"
                                                                    value="{{ $maquinaria->filtroaceite }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Filtro Aire:</label></br>
                                                                <input type="text" class="inputCaja" id="filtroaire"
                                                                    name="filtroaire"
                                                                    value="{{ $maquinaria->filtroaire }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Bujías:</label></br>
                                                                <input type="text" class="inputCaja" id="bujias"
                                                                    name="bujias" value="{{ $maquinaria->bujias }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Tipo de Bujías:</label></br>
                                                                <input type="text" class="inputCaja" id="tipobujia"
                                                                    name="tipobujia"
                                                                    value="{{ $maquinaria->tipobujia }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Horómetro Inicial:</label></br>
                                                                <input type="number" class="inputCaja" id="horometro"
                                                                    name="horometro"
                                                                    value="{{ $maquinaria->horometro }}">
                                                            </div>

                                                            <div class=" col-8   mb-3 ">
                                                                <div class="row align-items-end">
                                                                    <div class="col-7">
                                                                        <label class="labelTitulo">Kilometraje / Millaje
                                                                            Inicial:</label></br>
                                                                        <input type="number" class="inputCaja"
                                                                            id="kilometraje" name="kilometraje"
                                                                            value="{{ $maquinaria->kilometraje }}">

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
                                                                        class="form-check-label text-start fs-5 textTitulo mb-2"
                                                                        for="flexCheckDefault">
                                                                        <i
                                                                            class="fa  {{ $docs->factura != null ? ' fa-check-circle semaforo3' : '  fa-times-circle semaforo2' }}"></i>
                                                                        Factura
                                                                    </label>
                                                                </div>
                                                                <div class="contIconosDocumentos d-flex align-items-end">

                                                                    <label class="custom-file-upload">
                                                                        <input class="mb-4" type="file"
                                                                            name="factura" id="foto" accept=".pdf">
                                                                        <img class="mx-2" style="height:23px"
                                                                            src="{{ asset('/img/general/guardarVerde.svg') }}"
                                                                            title="Subir Documento">
                                                                    </label>

                                                                    <label class="custom-file-upload">
                                                                        <a href="{{ route('maquinaria.download', [$docs->id, 'factura']) }}"
                                                                            class="" target="blank">
                                                                            <img class="mx-2" style="height:23px"
                                                                                src="{{ asset('/img/general/fotoVerde.svg') }}"
                                                                                title="Ver Documento">
                                                                        </a>

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
                                                                        class="form-check-label text-start fs-5 textTitulo mb-2"
                                                                        for="flexCheckDefault">
                                                                        <i
                                                                            class="fa {{ $docs->verificacion != null ? ' fa-check-circle semaforo3' : '  fa-times-circle semaforo2' }}"></i>
                                                                        Verificación
                                                                    </label>

                                                                </div>
                                                                <div class="contIconosDocumentos d-flex align-items-end">
                                                                    <label class="custom-file-upload">
                                                                        <input class="mb-4" type="file"
                                                                            name="verificacion" id="foto"
                                                                            accept=".pdf">
                                                                        <img class="mx-2" style="height:23px"
                                                                            src="{{ asset('/img/general/guardarVerde.svg') }}"
                                                                            title="Subir Documento">
                                                                    </label>

                                                                    <label class="custom-file-upload">
                                                                        <a href="{{ route('maquinaria.download', [$docs->id, 'verificacion']) }}"
                                                                            class="" target="blank">
                                                                            <img class="mx-2" style="height:23px"
                                                                                src="{{ asset('/img/general/fotoVerde.svg') }}"
                                                                                title="Ver Documento">
                                                                        </a>
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
                                                                        class="form-check-label text-start fs-5 textTitulo mb-2"
                                                                        for="flexCheckDefault">
                                                                        <i
                                                                            class="fa {{ $docs->manual != null ? ' fa-check-circle semaforo3' : '  fa-times-circle semaforo2' }}"></i>
                                                                        Manual de Uso
                                                                    </label>

                                                                </div>
                                                                <div class="contIconosDocumentos d-flex align-items-end">
                                                                    <label class="custom-file-upload">
                                                                        <input class="mb-4" type="file"
                                                                            name="manual" id="foto" accept=".pdf">
                                                                        <img class="mx-2" style="height:23px"
                                                                            src="{{ asset('/img/general/guardarVerde.svg') }}"
                                                                            title="Subir Documento">
                                                                    </label>

                                                                    <label class="custom-file-upload">
                                                                        <a href="{{ route('maquinaria.download', [$docs->id, 'manual']) }}"
                                                                            class="" target="blank">
                                                                            <img class="mx-2" style="height:23px"
                                                                                src="{{ asset('/img/general/fotoVerde.svg') }}"
                                                                                title="Ver Documento">
                                                                        </a>
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
                                                                        class="form-check-label text-start fs-5 textTitulo mb-2"
                                                                        for="flexCheckDefault">
                                                                        <i
                                                                            class="fa {{ $docs->registro != null ? ' fa-check-circle semaforo3' : '  fa-times-circle semaforo2' }}"></i>
                                                                        Registro
                                                                    </label>

                                                                </div>
                                                                <div class="contIconosDocumentos d-flex align-items-end">
                                                                    <label class="custom-file-upload">
                                                                        <input class="mb-4" type="file"
                                                                            name="registro" id="foto"
                                                                            accept=".pdf">
                                                                        <img class="mx-2" style="height:23px"
                                                                            src="{{ asset('/img/general/guardarVerde.svg') }}"
                                                                            title="Subir Documento">
                                                                    </label>

                                                                    <label class="custom-file-upload">
                                                                        <a href="{{ route('maquinaria.download', [$docs->id, 'registro']) }}"
                                                                            class="" target="blank">
                                                                            <img class="mx-2" style="height:23px"
                                                                                src="{{ asset('/img/general/fotoVerde.svg') }}"
                                                                                title="Ver Documento">
                                                                        </a>
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
                                                                        class="form-check-label text-start fs-5 textTitulo mb-2"
                                                                        for="flexCheckDefault">
                                                                        <i
                                                                            class="fa {{ $docs->circulacion != null ? ' fa-check-circle semaforo3' : '  fa-times-circle semaforo2' }}"></i>
                                                                        Tarjeta de Circulación
                                                                    </label>
                                                                </div>
                                                                <div class="contIconosDocumentos d-flex align-items-end">
                                                                    <label class="custom-file-upload">
                                                                        <input class="mb-4" type="file"
                                                                            name="circulacion" id="foto"
                                                                            accept=".pdf">
                                                                        <img class="mx-2" style="height:23px"
                                                                            src="{{ asset('/img/general/guardarVerde.svg') }}"
                                                                            title="Subir Documento">
                                                                    </label>

                                                                    <label class="custom-file-upload">
                                                                        <a href="{{ route('maquinaria.download', [$docs->id, 'circulacion']) }}"
                                                                            class="" target="blank">
                                                                            <img class="mx-2" style="height:23px"
                                                                                src="{{ asset('/img/general/fotoVerde.svg') }}"
                                                                                title="Ver Documento">
                                                                        </a>
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
                                                                        class="form-check-label text-start fs-5 textTitulo mb-2"
                                                                        for="flexCheckDefault">
                                                                        <i
                                                                            class="fa {{ $docs->ficha != null ? ' fa-check-circle semaforo3' : '  fa-times-circle semaforo2' }}"></i>
                                                                        Ficha Técnica del Proveedor
                                                                    </label>
                                                                </div>
                                                                <div class="contIconosDocumentos d-flex align-items-end">
                                                                    <label class="custom-file-upload">
                                                                        <input class="mb-4" type="file"
                                                                            name="ficha" id="foto" accept=".pdf">
                                                                        <img class="mx-2" style="height:23px"
                                                                            src="{{ asset('/img/general/guardarVerde.svg') }}"
                                                                            title="Subir Documento">
                                                                    </label>

                                                                    <label class="custom-file-upload">
                                                                        <a href="{{ route('maquinaria.download', [$docs->id, 'ficha']) }}"
                                                                            class="" target="blank">
                                                                            <img class="mx-2" style="height:23px"
                                                                                src="{{ asset('/img/general/fotoVerde.svg') }}"
                                                                                title="Ver Documento">
                                                                        </a>
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
                                                                        class="form-check-label text-start fs-5 textTitulo mb-2"
                                                                        for="flexCheckDefault">
                                                                        <i
                                                                            class="fa {{ $docs->seguro != null ? ' fa-check-circle semaforo3' : '  fa-times-circle semaforo2' }}"></i>
                                                                        Seguros
                                                                    </label>

                                                                </div>
                                                                <div class="contIconosDocumentos d-flex align-items-end">
                                                                    <label class="custom-file-upload">
                                                                        <input class="mb-4" type="file"
                                                                            name="seguro" id="foto" accept=".pdf">
                                                                        <img class="mx-2" style="height:23px"
                                                                            src="{{ asset('/img/general/guardarVerde.svg') }}"
                                                                            title="Subir Documento">
                                                                    </label>

                                                                    <label class="custom-file-upload">
                                                                        <a href="{{ route('maquinaria.download', [$docs->id, 'seguro']) }}"
                                                                            class="" target="blank">
                                                                            <img class="mx-2" style="height:23px"
                                                                                src="{{ asset('/img/general/fotoVerde.svg') }}"
                                                                                title="Ver Documento">
                                                                        </a>
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
                                                                        class="form-check-label text-start fs-5 textTitulo mb-2"
                                                                        for="flexCheckDefault">
                                                                        <i
                                                                            class="fa {{ $docs->especial != null ? ' fa-check-circle semaforo3' : '  fa-times-circle semaforo2' }}"></i>
                                                                        Permisos Especiales
                                                                    </label>

                                                                </div>
                                                                <div class="contIconosDocumentos d-flex align-items-end">
                                                                    <label class="custom-file-upload">
                                                                        <input class="mb-4" type="file"
                                                                            name="especial" id="foto"
                                                                            accept=".pdf">
                                                                        <img class="mx-2" style="height:23px"
                                                                            src="{{ asset('/img/general/guardarVerde.svg') }}"
                                                                            title="Subir Documento">
                                                                    </label>

                                                                    <label class="custom-file-upload">
                                                                        <a href="{{ route('maquinaria.download', [$docs->id, 'especial']) }}"
                                                                            class="" target="blank">
                                                                            <img class="mx-2" style="height:23px"
                                                                                src="{{ asset('/img/general/fotoVerde.svg') }}"
                                                                                title="Ver Documento">
                                                                        </a>
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
                                                                        <img class="mx-2" style="height:23px"
                                                                            src="{{ asset('/img/general/guardarVerde.svg') }}">
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
                                                                        <img class="mx-2" style="height:23px"
                                                                            src="{{ asset('/img/general/guardarVerde.svg') }}">
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
                                                                        <img class="mx-2" style="height:23px"
                                                                            src="{{ asset('/img/general/guardarVerde.svg') }}">
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
                                    <button type="submit" class="btn botonGral" onclick="alertaGuardar()">Guardar
                                        Edicion</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@accessible360/accessible-slick@1.0.1/slick/slick.min.js"></script>



<script>
    function abre(T) {
        var ruta = T.src.replace("/s90-Ic42/", "/s590-Ic42/");
        document.querySelector("#visor img").src = ruta;
    }
</script>

<!-- Modal -->
<div class="modal fade" id="agregaTipo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agrega un nuevo tipo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
