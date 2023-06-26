@extends('layouts.main', ['activePage' => ' nuevoMantenimiento', 'titlePage' => __('nuevoMantenimiento')])
@section('content')
<div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header bacTituloPrincipal">
                                    <h4 class="card-title">Registro Nuevo Mantenimiento</h4>   
                                </div>
                                <div class="card-body ">   

                                    <div class="col-12 my-4">
                                        <div class="row">
                                            <div class="divBorder">
                                               
                                                <p class="subEncabezado">Busca una Maquinaria</p>
                                                <form class="mb-4 mt-0" role="search" class="">
                                                    <input type="submit" value="" class="search-submit ">
                                                    <input type="search" name="q" class="search-text" placeholder="Search..." autocomplete="off">
                                                </form>  
                                            </div>
                                            <div class=" col-12 col-sm-6 col-lg-4 my-3 ">
                                                <label class="labelTitulo">Equipo: </label></br>
                                                <p>Retroexcabadora</p>
                                            </div>
                                            <div class=" col-12 col-sm-6  col-lg-4 my-3 ">
                                                <label class="labelTitulo">Número de Serie: </label></br>
                                                <p>NDST1248</p>
                                            </div>
                                            <div class=" col-12 col-sm-6  col-lg-4 my-3 ">
                                                <label class="labelTitulo">Marca: </label></br>
                                                <p>International</p>
                                            </div>
                                            <div class=" col-12 col-sm-6  col-lg-4 my-3 ">
                                                <label class="labelTitulo">Modelo: </label></br>
                                                <p>420</p>
                                            </div>
                                            <div class=" col-12 col-sm-6  col-lg-4 my-3 ">
                                                <label class="labelTitulo">Placas: </label></br>
                                                <p>JW99337</p>
                                            </div>
                                            <div class=" col-12 col-sm-6  col-lg-4 my-3 ">
                                                <label class="labelTitulo">Resguardatario:</label></br><input type="text"
                                                    placeholder="Especifique..." class="inputCaja">
                                            </div>
                                            <div class=" col-12 col-sm-6  col-lg-4 my-3 ">
                                                <label class="labelTitulo">Adscripción:</label></br><input type="text"
                                                    placeholder="Especifique..." class="inputCaja">
                                            </div>
                                            <div class=" col-12 col-sm-6  col-lg-4 my-3 ">
                                                <label class="labelTitulo">Horómetro: </label></br>
                                                <input type="text" class="inputCaja" 
                                                    placeholder="Especifique..." >
                                            </div>
                                            <div class=" col-12 col-sm-6  col-lg-4 my-3 ">
                                                <label class="labelTitulo">Km/m: </label></br>
                                                <input type="text" class="inputCaja" 
                                                 placeholder="Especifique...">
                                            </div>
                                            <div class=" col-12 col-sm-6  col-lg-4 my-3 ">
                                                <label class="labelTitulo">Fecha: </label></br>
                                                <input type="date" class="inputCaja" 
                                                 placeholder="Especifique...">
                                            </div>
                                            <div class=" col-12 col-sm-6  col-lg-4 my-3 ">
                                                <label class="labelTitulo">Subtotal: </label></br>
                                                <input type="text" class="inputCaja" 
                                                 placeholder="Especifique...">
                                            </div>
                                            <div class=" col-12 col-sm-6  col-lg-4 my-3 ">
                                                <label class="labelTitulo">Iva: </label></br>
                                                <input type="text" class="inputCaja" 
                                                 placeholder="Especifique...">
                                            </div>
                                            <div class=" col-12 col-sm-6  col-lg-4 my-3 ">
                                                <label class="labelTitulo">Total: </label></br>
                                                <input type="text" class="inputCaja" 
                                                 placeholder="Especifique...">
                                            </div>
                                        </div>
                                    </div>

                                    
                                    <div class="col-12 divBorder">
                                        <h2 class="tituloEncabezado">Material de Mantenimiento</h2></br></br>
                                    </div>  
                                        
                                        <div class="row d-flex">
                                            <div class="col-12 col-md-6    mt-3 ">
                                                <p class="subEncabezado">Busca un Material</p>
                                                    <form class="mb-4 mt-0" role="search" class="">
                                                        <input type="submit" value="" class="search-submit ">
                                                        <input type="search" name="q" class="search-text" placeholder="Search..." autocomplete="off">
                                                    </form>  
                                            </div>

                                            <div class="col-12 col-md-6 mt-3 align-items-center  ">
                                                <button class="btnSinFondocALENDARIO  float-end" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" 
                                                    aria-controls="offcanvasRight">
                                                    <img class="imgBtns" style="height: 25px;" src="{{ asset('img/mantenimiento/box.svg') }}"></br>Ver materiales seleccionados
                                                    <span class="position-absolute top-0 start-97 translate-middle p-2 bg-danger border border-light rounded-circle">
                                                        <span class="visually-hidden">New alerts</span>
                                                    </span>
                                                </button>
                                                    <!-- off canvas-->
                                                <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
                                                    <div class="offcanvas-header divBorder">
                                                        <h3 class="offcanvas-title tituloEncabezado" id="offcanvasRightLabel">Lista de Material</h3>
                                                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                                    </div>
                                                    <div class="offcanvas-body">
                                                        <ul class="">
                                                            <li class="listaMaterialMantenimiento my-3 d-flex py-5 border-bottom">
                                                                <div class="col-9 ">
                                                                    <p class="fw-semibold" >4 litros</p></br>
                                                                    <p> <span class="fw-semibold">Descripción:</span>
                                                                        PG PC5667C Filtro de aire de cabina | Compatible con Toyota Prius 2020-10, Highland 2019-09</br>
                                                                        <span class="fw-semibold">N.parte:</span> Lexus CT200h 2017-11</br>
                                                                        <span class="fw-semibold">Costo:</span> $ 300.00</br>
                                                                        <span class="fw-semibold">Importe:</span> $ 300.00
                                                                    </p>
                                                                </div>
                                                                <div class="col-3">
                                                                    <button class="btnSinFondo float-end" type="submit" rel="tooltip">
                                                                        <svg xmlns="http://www.w3.org/2000/svg"  width="28" height="28"  fill="currentColor"  title="Eliminar" class="bi bi-x-circle"  viewBox="0 0 16 16">
                                                                                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                                                                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                                                                        </svg>
                                                                    </button>
                                                                </div>
                                                            </li>
                                                            <li class="listaMaterialMantenimiento my-3 d-flex py-5 border-bottom">
                                                                <div class="col-9 ">
                                                                    <p class="fw-semibold" >4 litros</p></br>
                                                                    <p> <span class="fw-semibold">Descripción:</span>
                                                                        PG PC5667C Filtro de aire de cabina | Compatible con Toyota Prius 2020-10, Highland 2019-09</br>
                                                                        <span class="fw-semibold">N.parte:</span> Lexus CT200h 2017-11</br>
                                                                        <span class="fw-semibold">Costo:</span> $ 300.00</br>
                                                                        <span class="fw-semibold">Importe:</span> $ 300.00
                                                                    </p>
                                                                </div>
                                                                <div class="col-3">
                                                                    <button class="btnSinFondo float-end" type="submit" rel="tooltip">
                                                                        <svg xmlns="http://www.w3.org/2000/svg"  width="28" height="28"  fill="currentColor"  title="Eliminar" class="bi bi-x-circle"  viewBox="0 0 16 16">
                                                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                                            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                                                                        </svg>
                                                                    </button>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                        <div class="col-12 mt-5">
                                                            <button type="button" class="btn botonGral mx-auto d-block">Agregar</button>
                                                        </div>

                                                        </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="my-4 divBorder">
                                            <h3 class="subEncabezado mb-3">Listado de busqueda</h3>
                                        </div>
                                        <div class=" col-12  my-3 ">
                                            <ul class="">
                                                <li class="listaMaterialMantenimiento my-3 border-bottom">
                                                    <div class="row d-flex pb-4">
                                                        <div class="col-12 col-md-9  py-3 d-flex">
                                                            <div class="col-3 " >
                                                            <label for="exampleFormControlInput1" class="">Cantidad</label></br></br>
                                                            <input type="text" class="inputCaja" ></div>
                                                            <div class="col-9">
                                                                <p> <span class="fw-semibold">Descripción:</span>
                                                                    PG PC5667C Filtro de aire de cabina | Compatible con Toyota Prius 2020-10, Highland 2019-09</br>
                                                                    <span class="fw-semibold">N.parte:</span> Lexus CT200h 2017-11</br>
                                                                    <span class="fw-semibold">Costo:</span> $ 300.00</br>
                                                                    <span class="fw-semibold">Importe:</span> $ 300.00
                                                                </p>
                                                            </div>
                                                        </div> 
                                                        <div class="col-12 col-md-3">
                                                            <button class="btnSinFondocALENDARIO ms-3 float-end">
                                                                <img class="imgBtns" style="height: 20px;" src="{{ asset('img/mantenimiento/material.svg') }}"> Seleccionar
                                                            </button>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="listaMaterialMantenimiento my-3 border-bottom ">
                                                    <div class="row d-flex pb-4">
                                                        <div class="col-12 col-md-9  py-3 d-flex">
                                                            <div class="col-3 " >
                                                            <label for="exampleFormControlInput1" class="">Cantidad</label></br></br>
                                                            <input type="text" class="inputCaja" ></div>
                                                            <div class="col-9">
                                                                <p> <span class="fw-semibold">Descripción:</span>
                                                                    PG PC5667C Filtro de aire de cabina | Compatible con Toyota Prius 2020-10, Highland 2019-09</br>
                                                                    <span class="fw-semibold">N.parte:</span> Lexus CT200h 2017-11</br>
                                                                    <span class="fw-semibold">Costo:</span> $ 300.00</br>
                                                                    <span class="fw-semibold">Importe:</span> $ 300.00
                                                                </p>
                                                            </div>
                                                        </div> 
                                                        <div class="col-12 col-md-3">
                                                            <button class="btnSinFondocALENDARIO ms-3 float-end">
                                                                <img class="imgBtns" style="height: 20px;" src="{{ asset('img/mantenimiento/material.svg') }}"> Seleccionar
                                                            </button>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="listaMaterialMantenimiento my-3 border-bottom">
                                                    <div class="row d-flex pb-4">
                                                        <div class="col-12 col-md-9  py-3 d-flex">
                                                            <div class="col-3 " >
                                                            <label for="exampleFormControlInput1" class="">Cantidad</label></br></br>
                                                            <input type="text" class="inputCaja" ></div>
                                                            <div class="col-9">
                                                                <p> <span class="fw-semibold">Descripción:</span>
                                                                    PG PC5667C Filtro de aire de cabina | Compatible con Toyota Prius 2020-10, Highland 2019-09</br>
                                                                    <span class="fw-semibold">N.parte:</span> Lexus CT200h 2017-11</br>
                                                                    <span class="fw-semibold">Costo:</span> $ 300.00</br>
                                                                    <span class="fw-semibold">Importe:</span> $ 300.00
                                                                </p>
                                                            </div>
                                                        </div> 
                                                        <div class="col-12 col-md-3">
                                                            <button class="btnSinFondocALENDARIO ms-3 float-end">
                                                                <img class="imgBtns" style="height: 20px;" src="{{ asset('img/mantenimiento/material.svg') }}"> Seleccionar
                                                            </button>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div> 
                                
                                    <div class="col-12 text-center mt-5 pt-5">
                                        <button type="submit" class="btn botonGral" >Guardar</button>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
