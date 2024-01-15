@extends('comercial.layouts.main', ['activePage' => 'equipos'])
@section('content')
    <div class="contenido ">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/comercial/quienesSomos.css') }}">
        <body>
        <header class="paddindY-5 bg-image img-fluid">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-center">
                    <h1 class="display-4">MOVIMIENTO <br>DE TIERRAS</h1>
                    {{--  <p class="lead fw-normal text-white-50 mb-0">With this shop hompeage template</p>  --}}
                </div>
            </div>
        </header> 
        <br>
        <div class="container">
            <div class="col-9">
                <div class="d-flex justify-content-around align-items-center" id="myTab" role="tablist">
                    <div class="button-container active" role="presentation" id="movimiento-tab" data-bs-toggle="tab"
                        data-bs-target="#movimiento-tab-pane" role="tab" aria-controls="movimiento-tab-pane" aria-selected="true">
                        MOVIMIENTO DE TIERRAS
                    </div>
                    <div class="button-container" role="presentation" id="grua-tab" data-bs-toggle="tab"
                        data-bs-target="#grua-tab-pane" role="tab" aria-controls="grua-tab-pane" aria-selected="true">
                        GRÚA ARTICULADA
                    </div>
                    <div class="button-container" role="presentation" id="maquinariaPesada-tab" data-bs-toggle="tab"
                        data-bs-target="#maquinariaPesada-tab-pane" role="tab" aria-controls="maquinariaPesada-tab-pane"
                        aria-selected="true">
                        MAQUINARIA PESADA
                    </div>
                </div>
            </div>
            <div class="col-3">
    
            </div>
        </div>
        <br>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="movimiento-tab-pane" role="tabpanel"
                aria-labelledby="movimiento-tab" tabindex="0">
                <div class="row d-flex justify-content-center">
                    @for ($i = 0; $i < 10; $i++)
                    <div class="card product-card cartaProducto col-9 col-md-5 col-lg-5 col-xl-3" style="margin-left: 25px; margin-top: 15px; box-shadow: 10px 10px 10px rgba(0, 0, 0, 0.5); border-radius: 0;">
                        <div class="card-body combustibleBorde">
                            <img class="ImgCard" src="{{ asset('img/general/img4.jpg') }}"
                                alt="">
                            <div class="bordeTitulo mb-3" style="border-bottom: #212529 1px solid;">
                                <h2 class="text-center"> Volteo 7 MTS Internacional</h2>
                            </div>
    
                            <div>
                                <ul class="listaCaracteristicas">
                                    <li>Alcance Maximo: 2 Metros </li>
                                    <li>Alcance Maximo: 2 Metros </li>
                                    <li>Alcance Maximo: 2 Metros </li>
                                    <li>Alcance Maximo: 2 Metros </li>
                                </ul>
    
                            </div>
    
                            <div class="text-center">
                                <a href="#">
                                    <button class="button botonesCard">VER FICHA</button>
                                </a>
                            </div>
    
                            <div class="text-center">
                                <a href="#">
                                    <button class="button botonesCard">COTIZAR</button>
                                </a>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
        </div>
        <div class="tab-content " id="myTabContent">
            <div class="tab-pane fade   " id="grua-tab-pane" role="tabpanel" aria-labelledby="grua-tab"
                tabindex="0">
                <div class="row d-flex justify-content-center">
                    @for ($i = 0; $i < 5; $i++)
                    <div class="card product-card cartaProducto col-9 col-md-5 col-lg-5 col-xl-3" style="margin-left: 25px; margin-top: 15px; box-shadow: 10px 10px 10px rgba(0, 0, 0, 0.5); border-radius: 0;">
                        <div class="card-body combustibleBorde">
                            <img class="ImgCard" src="{{ asset('img/general/img4.jpg') }}"
                                alt="">
                            <div class="bordeTitulo mb-3" style="border-bottom: #212529 1px solid;">
                                <h2 class="text-center"> Volteo 7 MTS Internacional</h2>
                            </div>
    
                            <div>
                                <ul class="listaCaracteristicas">
                                    <li>Alcance Maximo: 2 Metros </li>
                                    <li>Alcance Maximo: 2 Metros </li>
                                    <li>Alcance Maximo: 2 Metros </li>
                                    <li>Alcance Maximo: 2 Metros </li>
                                </ul>
    
                            </div>
    
                            <div class="text-center">
                                <a href="#">
                                    <button class="button botonesCard">VER FICHA</button>
                                </a>
                            </div>
    
                            <div class="text-center">
                                <a href="#">
                                    <button class="button botonesCard">COTIZAR</button>
                                </a>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
        </div>

        <div class="tab-content " id="myTabContent">
            <div class="tab-pane fade" id="maquinariaPesada-tab-pane" role="tabpanel" aria-labelledby="maquinariaPesada-tab"
                tabindex="0">
                <div class="row d-flex justify-content-center">
                    @for ($i = 0; $i < 3; $i++)
                    <div class="card product-card cartaProducto col-9 col-md-5 col-lg-5 col-xl-3" style="margin-left: 25px; margin-top: 15px; box-shadow: 10px 10px 10px rgba(0, 0, 0, 0.5); border-radius: 0;">
                        <div class="card-body combustibleBorde">
                            <img class="ImgCard" src="{{ asset('img/general/img4.jpg') }}"
                                alt="">
                            <div class="bordeTitulo mb-3" style="border-bottom: #212529 1px solid;">
                                <h2 class="text-center"> Volteo 7 MTS Internacional</h2>
                            </div>
    
                            <div>
                                <ul class="listaCaracteristicas">
                                    <li>Alcance Maximo: 2 Metros </li>
                                    <li>Alcance Maximo: 2 Metros </li>
                                    <li>Alcance Maximo: 2 Metros </li>
                                    <li>Alcance Maximo: 2 Metros </li>
                                </ul>
    
                            </div>
    
                            <div class="text-center">
                                <a href="#">
                                    <button class="button botonesCard">VER FICHA</button>
                                </a>
                            </div>
    
                            <div class="text-center">
                                <a href="#">
                                    <button class="button botonesCard">COTIZAR</button>
                                </a>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
        </div>
        <body>
    </div>
@endsection
