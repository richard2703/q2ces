@extends('layouts.main', ['activePage' => 'maquinaria', 'titlePage' => __('Alta de Maquinaria')])
@section('content')
<div class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-11 align-self-start">
                    <div class="card">
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
                                                            <img class="imgVista img-fluid mb-5" src="{{ asset('/img/general/vistaAerea.jpg') }}">
                                                            <input class="mb-4" type="file" name="foto" id="foto">
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-md-8 ">

                                                        <div class="row alin">
                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Nombre:</label></br>
                                                                <input type="text" class="inputCaja" id=""
                                                                name="calle" value="">
                                                            </div> 

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Marca:</label></br>
                                                                <input type="text" class="inputCaja" id="marca"
                                                                    name="marca" value="">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Modelo:</label></br>
                                                                <input type="text" class="inputCaja" id="modelo"
                                                                    name="modelo" value="">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Sub Marca:</label></br>
                                                                <input type="text" class="inputCaja" id="submarca"
                                                                    name="submarca" value="">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Categoría:</label></br>
                                                                <input type="text" class="inputCaja" id="categoria"
                                                                    name="categoria" value=""
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

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
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
                                                                        <button class="btnModal" type="button"  data-bs-toggle="modal" data-bs-target="#agregaTipo">
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                fill="currentColor"
                                                                                class="bi bi-plus-circle-fill btnMas"
                                                                                viewBox="0 0 16 16">
                                                                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z" />
                                                                            </svg>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Año:</label></br>
                                                                <input type="number" class="inputCaja" id="ano"  name="ano" value="">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Color:</label></br>
                                                                <input type="text" class="inputCaja" id="color" name="color" value="">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Placas:</label></br>
                                                                <input type="text" class="inputCaja" id="placas" name="placas" value="">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Motor:</label></br>
                                                                <input type="text" class="inputCaja" id="motor"  name="motor" value="">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Número Motor:</label></br>
                                                                <input type="text" class="inputCaja" id="nummotor"  name="nummotor" value="">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Número Serie:</label></br>
                                                                <input type="text" class="inputCaja" id="numserie"  name="numserie" value="">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Número VIN:</label></br>
                                                                <input type="text" class="inputCaja" id="vin"  name="vin" value="">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Capacidad en kW:</label></br>
                                                                <input type="text" class="inputCaja" id="capacidad"  name="capacidad" value="" placeholder="">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Capacidad Tanque:</label></br>
                                                                <input type="number" class="inputCaja" id="tanque"  name="tanque" value="">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Ejes:</label></br>
                                                                <input type="text" class="inputCaja" id="ejes"  name="ejes" value="">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Rin Delantero:</label></br>
                                                                <input type="text" class="inputCaja" id="rinD"  name="rinD" value="">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Rin Trasero:</label></br>
                                                                <input type="text" class="inputCaja" id="rinT"  name="rinT" value="">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Llanta Delantera:</label></br>
                                                                <input type="text" class="inputCaja" id="llantaD"  name="llantaD" value="">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Llanta Trasera:</label></br>
                                                                <input type="text" class="inputCaja" id="llantaT"  name="llantaT" value="">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Combustible:</label></br>
                                                                <input type="text" class="inputCaja" id="combustible"  name="combustible" value="">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Aceite Motor:</label></br>
                                                                <input type="text" class="inputCaja" id="aceitemotor"  name="aceitemotor" value="">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Aceite Transmisión:</label></br>
                                                                <input type="text" class="inputCaja" id="aceitetras"  name="aceitetras" value="">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Aceite Dirección:</label></br>
                                                                <input type="text" class="inputCaja" id="aceitedirec"  name="aceitedirec" value="">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Aceite Hidráulico:</label></br>
                                                                <input type="text" class="inputCaja"  name="aceitehidra" value="">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Filtro Aceite:</label></br>
                                                                <input type="text" class="inputCaja" id="filtroaceite"  name="filtroaceite" value="">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Filtro Aire:</label></br>
                                                                <input type="text" class="inputCaja" id="filtroaire"  name="filtroaire" value="">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Bujías:</label></br>
                                                                <input type="text" class="inputCaja" id="bujias"  name="bujias" value="">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Tipo de Bujías:</label></br>
                                                                <input type="text" class="inputCaja" id="tipobujia"  name="tipobujia" value="">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Horómetro Inicial:</label></br>
                                                                <input type="number" class="inputCaja" id="horometro"  name="horometro" value="">
                                                            </div>

                                                            <div class=" col-8   mb-3 ">
                                                                <div class="row align-items-end">
                                                                    <div class="col-7">
                                                                        <label class="labelTitulo">Kilometraje / Millaje
                                                                            Inicial:</label></br>
                                                                        <input type="number" class="inputCaja" id="kilometraje" name="kilometraje"  value="">
                                                                    </div>
                                                                    <div class="col-5">
                                                                        <select class="form-select"  aria-label="Default select example"  name="kom">
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

                                                    <div class="col-12">
                                                        <div class="row">

                                                            <div class="col-12 col-md-6 col-lg-4">
                                                                <div class="card contDocumentos">
                                                                    <div class="card-body m-2">

                                                                        <div class=" ">
                                                                            <input class="form-check-input"
                                                                                type="checkbox" value=""
                                                                                id="flexCheckDefault">
                                                                            <label
                                                                                class="form-check-label text-start fs-5 textTitulo mb-2"
                                                                                for="flexCheckDefault">
                                                                                Factura
                                                                            </label>
                                                                        </div>
                                                                        <div
                                                                            class="contIconosDocumentos d-flex align-items-end">
                                                                            <div class="semaforo rounded-circle mx-2">
                                                                            </div>
                                                                            <div class="semaforo rounded-circle mx-2">
                                                                            </div>
                                                                            <i><img class="mx-2" style="height:23px"
                                                                                    src="{{ asset('/img/general/guardarVerde.svg') }}"></i>
                                                                            <i><img class="mx-2" style="height:23px"
                                                                                    src="{{ asset('/img/general/fotoVerde.svg') }}"></i>

                                                                        </div>


                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-12 col-md-6 col-lg-4">
                                                                <div class="card contDocumentos">
                                                                    <div class="card-body m-2">

                                                                        <div class=" ">
                                                                            <input class="form-check-input"
                                                                                type="checkbox" value=""
                                                                                id="flexCheckDefault">
                                                                            <label
                                                                                class="form-check-label text-start fs-5 textTitulo mb-2"
                                                                                for="flexCheckDefault">
                                                                                Verificación
                                                                            </label>
                                                                        </div>
                                                                        <div
                                                                            class="contIconosDocumentos d-flex align-items-end">
                                                                            <div class="semaforo rounded-circle mx-2">
                                                                            </div>
                                                                            <div class="semaforo rounded-circle mx-2">
                                                                            </div>
                                                                            <i><img class="mx-2" style="height:23px"
                                                                                    src="{{ asset('/img/general/guardarVerde.svg') }}"></i>
                                                                            <i><img class="mx-2" style="height:23px"
                                                                                    src="{{ asset('/img/general/fotoVerde.svg') }}"></i>

                                                                        </div>


                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-12 col-md-6 col-lg-4">
                                                                <div class="card contDocumentos">
                                                                    <div class="card-body m-2">

                                                                        <div class=" ">
                                                                            <input class="form-check-input"
                                                                                type="checkbox" value=""
                                                                                id="flexCheckDefault">
                                                                            <label
                                                                                class="form-check-label text-start fs-5 textTitulo mb-2"
                                                                                for="flexCheckDefault">
                                                                                Manual de Uso
                                                                            </label>
                                                                        </div>
                                                                        <div
                                                                            class="contIconosDocumentos d-flex align-items-end">
                                                                            <div class="semaforo rounded-circle mx-2">
                                                                            </div>
                                                                            <div class="semaforo rounded-circle mx-2">
                                                                            </div>
                                                                            <i><img class="mx-2" style="height:23px"
                                                                                    src="{{ asset('/img/general/guardarVerde.svg') }}"></i>
                                                                            <i><img class="mx-2" style="height:23px"
                                                                                    src="{{ asset('/img/general/fotoVerde.svg') }}"></i>

                                                                        </div>


                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-12 col-md-6 col-lg-4">
                                                                <div class="card contDocumentos">
                                                                    <div class="card-body m-2">

                                                                        <div class=" ">
                                                                            <input class="form-check-input"
                                                                                type="checkbox" value=""
                                                                                id="flexCheckDefault">
                                                                            <label
                                                                                class="form-check-label text-start fs-5 textTitulo mb-2"
                                                                                for="flexCheckDefault">
                                                                                Registro
                                                                            </label>
                                                                        </div>
                                                                        <div
                                                                            class="contIconosDocumentos d-flex align-items-end">
                                                                            <div class="semaforo rounded-circle mx-2">
                                                                            </div>
                                                                            <div class="semaforo rounded-circle mx-2">
                                                                            </div>
                                                                            <i><img class="mx-2" style="height:23px"
                                                                                    src="{{ asset('/img/general/guardarVerde.svg') }}"></i>
                                                                            <i><img class="mx-2" style="height:23px"
                                                                                    src="{{ asset('/img/general/fotoVerde.svg') }}"></i>

                                                                        </div>


                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-12 col-md-6 col-lg-4">
                                                                <div class="card contDocumentos">
                                                                    <div class="card-body m-2">

                                                                        <div class=" ">
                                                                            <input class="form-check-input"
                                                                                type="checkbox" value=""
                                                                                id="flexCheckDefault">
                                                                            <label
                                                                                class="form-check-label text-start fs-5 textTitulo mb-2"
                                                                                for="flexCheckDefault">
                                                                                Tarjeta de Circulación
                                                                            </label>
                                                                        </div>
                                                                        <div
                                                                            class="contIconosDocumentos d-flex align-items-end">
                                                                            <div class="semaforo rounded-circle mx-2">
                                                                            </div>
                                                                            <div class="semaforo rounded-circle mx-2">
                                                                            </div>
                                                                            <i><img class="mx-2" style="height:23px"
                                                                                    src="{{ asset('/img/general/guardarVerde.svg') }}"></i>
                                                                            <i><img class="mx-2" style="height:23px"
                                                                                    src="{{ asset('/img/general/fotoVerde.svg') }}"></i>

                                                                        </div>


                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-12 col-md-6 col-lg-4">
                                                                <div class="card contDocumentos">
                                                                    <div class="card-body m-2">

                                                                        <div class=" ">
                                                                            <input class="form-check-input"
                                                                                type="checkbox" value=""
                                                                                id="flexCheckDefault">
                                                                            <label
                                                                                class="form-check-label text-start fs-5 textTitulo mb-2"
                                                                                for="flexCheckDefault">
                                                                                Ficha Técnica del Proveedor
                                                                            </label>
                                                                        </div>
                                                                        <div
                                                                            class="contIconosDocumentos d-flex align-items-end">
                                                                            <div class="semaforo rounded-circle mx-2">
                                                                            </div>
                                                                            <div class="semaforo rounded-circle mx-2">
                                                                            </div>
                                                                            <i><img class="mx-2" style="height:23px"
                                                                                    src="{{ asset('/img/general/guardarVerde.svg') }}"></i>
                                                                            <i><img class="mx-2" style="height:23px"
                                                                                    src="{{ asset('/img/general/fotoVerde.svg') }}"></i>

                                                                        </div>


                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-12 col-md-6 col-lg-4">
                                                                <div class="card contDocumentos">
                                                                    <div class="card-body m-2">

                                                                        <div class=" ">
                                                                            <input class="form-check-input"
                                                                                type="checkbox" value=""
                                                                                id="flexCheckDefault">
                                                                            <label
                                                                                class="form-check-label text-start fs-5 textTitulo mb-2"
                                                                                for="flexCheckDefault">
                                                                                Seguros
                                                                            </label>
                                                                        </div>
                                                                        <div
                                                                            class="contIconosDocumentos d-flex align-items-end">
                                                                            <div class="semaforo rounded-circle mx-2">
                                                                            </div>
                                                                            <div class="semaforo rounded-circle mx-2">
                                                                            </div>
                                                                            <i><img class="mx-2" style="height:23px"
                                                                                    src="{{ asset('/img/general/guardarVerde.svg') }}"></i>
                                                                            <i><img class="mx-2" style="height:23px"
                                                                                    src="{{ asset('/img/general/fotoVerde.svg') }}"></i>

                                                                        </div>


                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-12 col-md-6 col-lg-4">
                                                                <div class="card contDocumentos">
                                                                    <div class="card-body m-2">

                                                                        <div class=" ">
                                                                            <input class="form-check-input"
                                                                                type="checkbox" value=""
                                                                                id="flexCheckDefault">
                                                                            <label
                                                                                class="form-check-label text-start fs-5 textTitulo mb-2"
                                                                                for="flexCheckDefault">
                                                                                Permosos Especiales
                                                                            </label>
                                                                        </div>
                                                                        <div
                                                                            class="contIconosDocumentos d-flex align-items-end">
                                                                            <div class="semaforo rounded-circle mx-2">
                                                                            </div>
                                                                            <div class="semaforo rounded-circle mx-2">
                                                                            </div>
                                                                            <i><img class="mx-2" style="height:23px"
                                                                                    src="{{ asset('/img/general/guardarVerde.svg') }}"></i>
                                                                            <i><img class="mx-2" style="height:23px"
                                                                                    src="{{ asset('/img/general/fotoVerde.svg') }}"></i>

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
                                </div>

                                <div class="col-12 text-center mb-3 ">
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

<div class="modal fade" id="agregaTipo" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Agrega Tipo</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Agrega tipo
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary">Guardar</button>
      </div>
    </div>
  </div>
</div>
@endsection



