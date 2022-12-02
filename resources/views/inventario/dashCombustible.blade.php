@extends('layouts.main', ['activePage' => 'inventario', 'titlePage' => __('Carga y Descarga')])
@section('content')

<div class="content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-11 align-self-center">
                <div class="card">
                    <div class="card-body contCart">
                        <div class="p-1 align-self-start bacTituloPrincipal">     
                            <h2 class="my-3 ms-3 texticonos ">Carga y Descarga</h2>   
                        </div> 
                        
                        <div class="col-11  mx-auto d-block my-4 border-bottom">   
                             
                            <nav class=" ">
                                                                    <div class="nav nav-tabs navMenuBalance justify-content-evenly" id="nav-tab" role="tablist">
                                                                        <button class="nav-link active BTNbalance col-4" id="balanceUno-tab" data-bs-toggle="tab" data-bs-target="#balanceUno" type="button" role="tab" aria-controls="balanceUno" aria-selected="true">
                                                                            <img src="{{ asset('img/inventario/cargaVerde.svg') }}" class="mx-auto d-block" width="65%">
                                                                            <p class="text-center mt-2">CARGA</p>
                                                                        </button>




                                                                        <button class="nav-link BTNbalance col-4" id="balanceDos-tab" data-bs-toggle="tab" data-bs-target="#balanceDos" type="button" role="tab" aria-controls="balanceDos" aria-selected="false">
                                                                            <img src="{{ asset('img/inventario/descargaVerde.svg') }}" class="mx-auto d-block" width="65%">
                                                                            <p class="text-center mt-2">DESCARGA</p>
                                                                        </button>
                                                                        <div class="col-4" >
                                                                            <p class="text-end mb-2">Datos de Registro</p>
                                                                            <p class="text-end combustibleFecha"> 22/11/2022</p>
                                                                            <p class="text-end combustibleHora my-2">2:00 pm</p>
                                                                        </div>
                                                                    </div>
                            </nav>

                            <div class="tab-content" id="nav-tabContent ">

                                <div class="tab-pane fade show active border" id="balanceUno" role="tabpanel" aria-labelledby="balanceUno-tab" tabindex="0">

                                                                        <div class="col-12 my-5 ">
                                                                            <div class="row mt-5">
                                                                                <div class="col-4">
                                                                                    <div class="text-center mx-auto border vistaFoto mb-4">
                                                                                        <i><img class="imgVista img-fluid mb-2" src="{{ asset('/img/general/default.jpg') }}"></i>
                                                                                        <span class="mi-archivo"> <input class="mb-4 ver " type="file" name="ruta[]" id="mi-archivo"  accept="image/*" multiple></span>
                                                                                        <label for="mi-archivo">
                                                                                            <span class="">Sube Imagen</span>
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-8">
                                                                                    <div class="row ">
                                                                                        <div class=" col-6 d-flex mb-4">
                                                                                            <div class="me-2">
                                                                                                <img src="{{ asset('/img/inventario/equipo_1.svg') }}" alt="" style="width:40px;">
                                                                                            </div>
                                                                                            <div>
                                                                                                <label class="labelTitulo">Equipo:</label></br>
                                                                                                <input type="text" class="inputCaja" id="marca" name="marca" value="{{ old('marca') }}">
                                                                                            </div>
                                                                                        </div>
                                                
                                                                                        <div class=" col-6 d-flex mb-4">
                                                                                            <div class="me-2">
                                                                                                <img src="{{ asset('/img/inventario/despachador.svg') }}" alt="" style="width:40px;">
                                                                                            </div>
                                                                                            <div>
                                                                                                <label class="labelTitulo">Despachador:</label></br>
                                                                                                <input type="text" class="inputCaja" id="marca" name="marca" value="{{ old('marca') }}">
                                                                                            </div>
                                                                                        </div>
                                                
                                                                                        <div class=" col-6 d-flex mb-4">
                                                                                            <div class="me-2">
                                                                                                <img src="{{ asset('/img/inventario/litros.svg') }}" alt="" style="width:40px;">
                                                                                            </div>
                                                                                            <div>
                                                                                                <label class="labelTitulo">Litros:</label></br>
                                                                                                <input type="text" class="inputCaja" id="marca" name="marca" value="{{ old('marca') }}">
                                                                                            </div>
                                                                                        </div>
                                                
                                                
                                                                                        <div class=" col-6 d-flex mb-4">
                                                                                            <div class="me-2">
                                                                                                <img src="{{ asset('/img/inventario/precio.svg') }}" alt="" style="width:40px;">
                                                                                            </div>
                                                                                            <div>
                                                                                                <label class="labelTitulo">Precio:</label></br>
                                                                                                <input type="text" class="inputCaja" id="marca" name="marca" value="{{ old('marca') }}">
                                                                                            </div>
                                                                                        </div>
                                                                                        
                                                                                    </div>
                                                
                                                                                </div>
                                                
                                                
                                                                            </div>
                                                                        </div>

                                </div>

                                <div class="tab-pane fade border" id="balanceDos" role="tabpanel" aria-labelledby="balanceDos-tab" tabindex="0">
                                    <div class="col-12 my-5 ">
                                        <div class="row mt-5">
                                            <div class="col-4">
                                                <div class="text-center mx-auto border vistaFoto mb-4">
                                                    <i><img class="imgVista img-fluid mb-2" src="{{ asset('/img/general/default.jpg') }}"></i>
                                                    <span class="mi-archivo"> <input class="mb-4 ver " type="file" name="ruta[]" id="mi-archivo"  accept="image/*" multiple></span>
                                                    <label for="mi-archivo">
                                                        <span class="">Sube Imagen</span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-8">
                                                <div class="row ">
                                                    <div class=" col-6 d-flex mb-4">
                                                        <div class="me-2">
                                                            <img src="{{ asset('/img/inventario/equipo_1.svg') }}" alt="" style="width:40px;">
                                                        </div>
                                                        <div>
                                                            <label class="labelTitulo">Equipo:</label></br>
                                                            <input type="text" class="inputCaja" id="marca" name="marca" value="{{ old('marca') }}">
                                                        </div>
                                                    </div>

                                                    <div class=" col-6 d-flex mb-4">
                                                        <div class="me-2">
                                                            <img src="{{ asset('/img/navs/eqiposMenu.svg') }}" alt="" style="width:40px;">
                                                        </div>
                                                        <div>
                                                            <label class="labelTitulo">Maquinaria:</label></br>
                                                            <input type="text" class="inputCaja" id="marca" name="marca" value="{{ old('marca') }}">
                                                        </div>
                                                    </div>
                                                
                                                    <div class=" col-6 d-flex mb-4">
                                                        <div class="me-2">
                                                            <img src="{{ asset('/img/inventario/despachador.svg') }}" alt="" style="width:40px;">
                                                        </div>
                                                        <div>
                                                            <label class="labelTitulo">Despachador:</label></br>
                                                            <input type="text" class="inputCaja" id="marca" name="marca" value="{{ old('marca') }}">
                                                        </div>
                                                    </div>

                                                    <div class=" col-6 d-flex mb-4">
                                                        <div class="me-2">
                                                            <img src="{{ asset('/img/navs/personalMenu.svg') }}" alt="" style="width:40px;">
                                                        </div>
                                                        <div>
                                                            <label class="labelTitulo">Operador:</label></br>
                                                                <input type="text" class="inputCaja" id="marca" name="marca" value="{{ old('marca') }}">
                                                            </div>
                                                    </div>
                                                
                                                    <div class=" col-6 d-flex mb-4">
                                                        <div class="me-2">
                                                            <img src="{{ asset('/img/inventario/litros.svg') }}" alt="" style="width:40px;">
                                                            </div>
                                                        <div>
                                                            <label class="labelTitulo">Litros:</label></br>
                                                            <input type="text" class="inputCaja" id="marca" name="marca" value="{{ old('marca') }}">
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

                <!--Espacio para los tres camiones-->
                <div class="row">
                    <div class="col-sm-4">
                        <div class="card">
                            <div class="card-body combustibleBorde">
                                <div class="bordeTitulo mb-3">
                                    <h2 class="combustibleTitulo fw-semibold  my-3"> TOYOTA HILUX</h2>
                                </div>
                                <div class="row ">
                                    <div class="col-12 mb-5">
                                        <p class="text-end">Reserva</p>
                                        <p class="combustibleLitros fw-semibold text-end">20 lts.</p>
                                    </div>
                                    <div class="col mb-3">
                                        <div class="row">
                                            <div class="col-6">
                                                <p class=" ">Útima carga</p>
                                                <p class="combustiblefecha fw-semibold mb-3">20/11/2022</p>
                                                <p class="">$ por litro</p>
                                                <p class="combustibleLitros fw-semibold">$ 30.5</p>
                                            </div>
                                            <div class="col-6">
                                                <p class=" text-end">Litros Cargados</p>
                                                <p class="combustibleLitros fw-semibold text-end">30 lts.</p>
                                            </div>
                                        </div>

                                    </div> 

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="card">
                            <div class="card-body combustibleBorde">
                                <div class="bordeTitulo mb-3">
                                    <h2 class="combustibleTitulo fw-semibold  my-3"> RENAULT KANGOO</h2>
                                </div>
                                <div class="row ">
                                    <div class="col-12 mb-5">
                                        <p class="text-end">Reserva</p>
                                        <p class="combustibleLitros fw-semibold text-end">20 lts.</p>
                                    </div>
                                    <div class="col mb-3">
                                        <div class="row">
                                            <div class="col-6">
                                                <p class=" ">Útima carga</p>
                                                <p class="combustiblefecha fw-semibold mb-3">20/11/2022</p>
                                                <p class="">$ Por litro</p>
                                                <p class="combustibleLitros fw-semibold">$ 30.5</p>
                                            </div>
                                            <div class="col-6">
                                                <p class=" text-end">Litros Cargados</p>
                                                <p class="combustibleLitros fw-semibold text-end">30 lts.</p>
                                            </div>
                                        </div>

                                    </div> 

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="card">
                            <div class="card-body combustibleBorde">
                                <div class="bordeTitulo mb-3">
                                    <h2 class="combustibleTitulo fw-semibold  my-3"> CAMIÓN ORQUESTA</h2>
                                </div>
                                <div class="row ">
                                    <div class="col-12 mb-5">
                                        <p class="text-end">Reserva</p>
                                        <p class="combustibleLitros fw-semibold text-end">20 lts.</p>
                                    </div>
                                    <div class="col mb-3">
                                        <div class="row">
                                            <div class="col-6">
                                                <p class=" ">Útima carga</p>
                                                <p class="combustiblefecha fw-semibold mb-3">20/11/2022</p>
                                                <p class="">$ Por litro</p>
                                                <p class="combustibleLitros fw-semibold">$ 30.5</p>
                                            </div>
                                            <div class="col-6">
                                                <p class=" text-end">Litros Cargados</p>
                                                <p class="combustibleLitros fw-semibold text-end">30 lts.</p>
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




</div>

@endsection
