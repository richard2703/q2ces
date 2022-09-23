@extends('layouts.main', ['activePage' => 'obra', 'titlePage' => __('Vista de Obra')])
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12 align-self-start">
                    <div class="card">
                        <div class="card-body contCart">
                            <div class="p-1 align-self-start bacTituloPrincipal">     
                                <h2 class="my-3 ms-3 texticonos ">Vista de Obra</h2>   
                            </div> 
                            <form class="row">

                                <div class="col-12 col-md-5  my-3 align-self-center"> 
                                    <div class="text-center mx-auto mb-2 border vistaFoto ">
                                        <i><img class="imgVista" src="{{ asset('/img/general/vistaAerea.jpg') }}"></i>
                                    </div>
                                </div>  
                                    
                                <div class="col-12 col-md-7 my-3">  
                                    <div class="row">
                                        <div class=" col-12 col-sm-6 col-lg-4 my-3 ">
                                            <h2 class="fs-5 textTitulo">Dirección de Obra:</h2></br>
                                            <p class="txtVistaObra">José María Heredia 2387
                                                Lomas de Grvara, 44657
                                                Guadalajara, Jalisco
                                            </p>
                                        </div>
                                        
                                        <div class=" col-12 col-sm-6  col-lg-4 my-3 ">
                                            <h2 class="fs-5 textTitulo">Tipo:</h2></br>
                                            <p>Maquinaria Pesada
                                            </p>
                                        </div>

                                        <div class=" col-12 col-sm-6  col-lg-4 my-3 ">
                                            <h2 class="fs-5 textTitulo">Residente Responsable:</h2></br>
                                            <p class="txtVistaObra">Arq. Jorge Pineda</p>
                                        </div>

                                        <div class=" col-12 col-sm-6  col-lg-4 my-3 ">
                                            <h2 class="fs-5 textTitulo">Equipos Asignados:</h2></br>
                                            <ul>
                                                <li class="txtVistaObra">Retroexcabadora</li>
                                                <li class="txtVistaObra">Bobcat</li>
                                            </ul>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-12 text-end mb-3 ">
                                    <i><img  src="{{ asset('img/login/logoQcem2.svg') }}" class="vistaLogo"></i>
                                </div>

                            </form>
                            
                        </div>   
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
