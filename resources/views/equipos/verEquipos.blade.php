@extends('layouts.main', ['activePage' => 'equipos', 'titlePage' => __('Ver Equipos')])
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-10 align-self-center">
                    <div class="card">
                        <div class="card-body contCart">
                            <div class="p-1 align-self-start bacTituloPrincipal">     
                                <h2 class="my-3 ms-3 texticonos ">Ver Equipos</h2>   
                            </div> 
                            <div class="col-10  mx-auto d-block my-4">   
                                <div class="row d-flex ">
                                    <div class="col-10 col-md-5  mx-auto d-block my-4 ">
                                        <div class="row d-flex border">
                                                <div class="col-4 text-center colIcono p-2">
                                                    <img src="{{ asset('img/equipos/maquinariaPesada.svg') }}" class="mx-auto d-block" width="65%">
                                                </div>
                                                <div class="col-8  p-2">
                                                    <h2 class="text-start fs-5 textTitulo">Maquinaria Pesada</h2>
                                                    <ul>
                                                        <a class="textEquipo" href="#"><li class="text-start my-3">Retroexcavadora</li></a>
                                                        <a class="textEquipo" href="#"><li class="text-start my-3">Camión de Volteo</li></a>
                                                        <a class="textEquipo" href="#"><li class="text-start my-3">Pipa de Agua</li></a>
                                                        <a class="textEquipo" href="#"><li class="text-start my-3">Camión Orquesta</li></a>
                                                    </ul>
                                                    
                                                </div>
                                        </div>
                                    </div>

                                    <div class="col-10 col-md-5  mx-auto d-block my-4 ">
                                        <div class="row d-flex border">
                                                <div class="col-4 text-center colIcono p-2">
                                                    <img src="{{ asset('img/equipos/maquinariaLigera.svg') }}" class="mx-auto d-block" width="65%" >
                                                </div>
                                                <div class="col-8  p-2">
                                                    <h2 class="text-start fs-5 textTitulo">Maquinaria Ligera</h2>
                                                    <ul>
                                                        <a class="textEquipo" href="#"><li class="text-start my-3">Rodillo</li></a>
                                                        <a class="textEquipo" href="#"><li class="text-start my-3">Bobcat</li></a>
                                                        <a class="textEquipo" href="#"><li class="text-start my-3">Torre de Luz</li></a>                                                       
                                                    </ul>
                                                    
                                                </div>
                                        </div>
                                    </div>

                                    <div class="col-10 col-md-5  mx-auto d-block my-4">
                                        <div class="row d-flex border">
                                                <div class="col-4 text-center colIcono p-2">
                                                    <img src="{{ asset('img/equipos/gruas.svg') }}" class="mx-auto d-block"width="65%">
                                                </div>
                                                <div class="col-8  p-2">
                                                    <h2 class="text-start fs-5 textTitulo">Grúas</h2>
                                                    <ul>
                                                        <a class="textEquipo" href="#"><li class="text-start my-3">Grúa 1</li></a>
                                                        <a class="textEquipo" href="#"><li class="text-start my-3">Grúa 2</li></a>
                                                        <a class="textEquipo"  href="#"><li class="text-start my-3">Grúa 3</li></a>
                                                        <a class="textEquipo" href="#"><li class="text-start my-3">Grúa 4</li></a>
                                                    </ul>
                                                    
                                                </div>
                                        </div>
                                    </div>

                                    <div class="col-10 col-md-5  mx-auto d-block my-4">
                                        <div class="row d-flex border">
                                                <div class="col-4 text-center colIcono p-2">
                                                    <img src="{{ asset('img/equipos/accesorios.svg') }}" class="mx-auto d-block" width="70%" >
                                                </div>
                                                <div class="col-8  p-2">
                                                    <h2 class="text-start fs-5 textTitulo">Accesorios</h2>
                                                    <ul>
                                                        <a class="textEquipo" href="#"><li class="text-start my-3">Accesorio 1</li></a>
                                                        <a class="textEquipo" href="#"><li class="text-start my-3">Accesorio 2</li></a>
                                                        <a class="textEquipo" href="#"><li class="text-start my-3">Accesorio 3</li></a>
                                                        <a class="textEquipo"  href="#"><li class="text-start my-3">Accesorio 4</li></a>
                                                    </ul>
                                                    
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
