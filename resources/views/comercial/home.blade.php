@extends('comercial.layouts.main', ['activePage' => 'inicio'])
@section('content')
    <div class="contenido">
        <!-- Carousel Start -->
        <div class="container-fluid px-0 mb-2">
            <div id="header-carousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="w-100" src="{{ asset('/img/comercial/banners/banner01.jpg') }}" alt="Image">
                        <div class="carousel-caption ">
                            {{--  <div class="container">  --}}
                            {{--  <div class="row justify-content-center">
                                <div class="col-lg-6 text-start">
                                    <p class="fs-5 fw-medium text-primary text-uppercase animated slideInRight">25
                                        Years
                                        of Working Experience</p>
                                    <h1 class="display-1 text-white mb-5 animated slideInRight">Industrial Solution
                                        Providing Company</h1>
                                    <a href="" class="btn btn-primary py-3 px-5 animated slideInRight btnF">Explore
                                        More</a>
                                </div>
                                <div class="col-lg-6 text-start">
                                    <p class="fs-5 fw-medium text-primary text-uppercase animated slideInRight">25
                                        Years
                                        of Working Experience</p>
                                    <h1 class="display-1 text-white mb-5 animated slideInRight">Industrial Solution
                                        Providing Company</h1>
                                    <a href="" class="btn btn-primary py-3 px-5 animated slideInRight btnF">Explore
                                        More</a>
                                </div>  --}}
                            {{--  </div>  --}}
                            {{--  </div>  --}}
                        </div>

                    </div>
                    <div class="carousel-item">
                        <img class="w-100" src="{{ asset('/img/comercial/banners/banner02.jpg') }}" alt="Image">
                        {{--  <div class="carousel-caption">
							<div class="container">
								<div class="row justify-content-center">
									<div class="col-lg-10 text-start">
										<p class="fs-5 fw-medium text-primary text-uppercase animated slideInRight">25
											Years
											of Working Experience</p>
										<h1 class="display-1 text-white mb-5 animated slideInRight">The Best Reliable
											Industry Solution</h1>
										<a href=""
											class="btn btn-primary py-3 px-5 animated slideInRight btnF">Explore
											More</a>
									</div>
								</div>
							</div>
						</div>  --}}
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#header-carousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>

        <div class="d-md-flex ">
            {{--  <div
                style="background-image: url('{{ asset('img/comercial/layout/Q2CES.svg') }}'); width: 100%; height: 80vh; opacity: 50%; ">
            </div>  --}}
            <div class="col-12 col-md-8 ">
                <img src="{{ asset('img/comercial/layout/Q2CES.svg') }}" alt="Q2Ces" style="width: 50%;">
            </div>
            <div class="col-12 col-md-4 ">
                <h3>¡Cotiza en línea y empieza tu proyecto hoy!</h3>
                <p>Obtén la renta de maquinaria pesada para construcción
                    más eﬁciente y de excelente rendimiento en Q2CES, donde
                    contamos con una amplia experiencia en el sector de la
                    renta de este tipo de equipos que te permitirán conseguir
                    resultados mucho más rápidos en todos tus proyectos de
                    obra.</p>

                <p>Manejamos los precios más competitivos y una atención
                    personalizada desde una óptica de ingeniería civil, además
                    de que tenemos al personal más capacitado.</p>
                <div class="text-center">
                    <a href="#">
                        <button class="button">Conoce más</button>
                    </a>
                </div>
            </div>
            {{--  <div class="col-12 col-md-6 ">
                <img src="{{ asset('img/comercial/layout/whats.svg') }}" style="width: 50%;">
            </div>  --}}

        </div>
        <div class="my-3 ">
            {{--  <div
                style="background-image: url('{{ asset('img/comercial/layout/Q2CES.svg') }}'); width: 100%; height: 80vh; opacity: 50%; ">
            </div>  --}}
            <div class="col-12 text-center mb-2 ">
                <h2>Nuestras Marcas</h2>
            </div>

            <div class="slider mb-2 ">
                <div class="slide-track">
                    <div class="slide">
                        <img src="{{ asset('img/comercial/home/BOBCAT.svg') }}" height="100" width="250"
                            alt="">
                    </div>
                    <div class="slide">
                        <img class="px-1" src="{{ asset('img/comercial/home/GENIE.svg') }}" height="100" width="250"
                            alt="">
                    </div>
                    <div class="slide">
                        <img class="px-1" src="{{ asset('img/comercial/home/JCB.svg') }}" height="100" width="250"
                            alt="">
                    </div>
                    <div class="slide">
                        <img class="px-1" src="{{ asset('img/comercial/home/JohnDeere.svg') }}" height="100"
                            width="250" alt="">
                    </div>
                    <div class="slide">
                        <img class="px-1" src="{{ asset('img/comercial/home/SCHWING.svg') }}" height="100"
                            width="250" alt="">
                    </div>
                    <div class="slide">
                        <img class="px-1" src="{{ asset('img/comercial/home/YANMAR.svg') }}" height="100" width="250"
                            alt="">
                    </div>
                    <div class="slide">
                        <img class="px-1" src="{{ asset('img/comercial/home/Ford.svg') }}" height="100" width="250"
                            alt="">
                    </div>
                    <div class="slide">
                        <img class="px-1" src="{{ asset('img/comercial/home/INTERNATIONAL.svg') }}" height="100"
                            width="250" alt="">
                    </div>
                    <div class="slide">
                        <img class="px-1" src="{{ asset('img/comercial/home/KENWORTH.svg') }}" height="100"
                            width="250" alt="">
                    </div>
                    <div class="slide">
                        <img class="px-1" src="{{ asset('img/comercial/home/PLANELEC.svg') }}" height="100"
                            width="250" alt="">
                    </div>
                    <div class="slide">
                        <img class="px-1" src="{{ asset('img/comercial/home/SCHWING.svg') }}" height="100"
                            width="250" alt="">
                    </div>
                    <div class="slide">
                        <img class="px-1" src="{{ asset('img/comercial/home/VOLVO.svg') }}" height="100"
                            width="250" alt="">
                    </div>
                    <div class="slide">
                        <img class="px-1" src="{{ asset('img/comercial/home/WACKER.svg') }}" height="100"
                            width="250" alt="">
                    </div>
                </div>
            </div>
            <div class="col-12  ">
                <div class="text-center">
                    <h3>¡Cotiza en línea y empieza tu proyecto hoy!</h3>
                </div>
                <div class="text-center" id="myTab" role="tablist">
                    <button class="button active" role="presentation" id="movimiento-tab" data-bs-toggle="tab"
                        data-bs-target="#movimiento-tab-pane" type="button" role="tab"
                        aria-controls="movimiento-tab-pane" aria-selected="true">
                        Boton 1 Movimiento
                    </button>
                    <button class="button" role="presentation" id="grua-tab" data-bs-toggle="tab"
                        data-bs-target="#grua-tab-pane" type="button" role="tab" aria-controls="grua-tab-pane"
                        aria-selected="true">
                        Boton 2 Grua
                    </button>
                    {{--  <button class="button">Boton 3 Maquinaria</button>  --}}



                </div>

                <div class="tab-content " id="myTabContent">

                    <div class="tab-content " id="myTabContent">
                        <div class="tab-pane fade show active" id="movimiento-tab-pane" role="tabpanel"
                            aria-labelledby="movimiento-tab" tabindex="0">
                            <div class="Row">
                                <h3>¡Movimiento!</h3>
                            </div>

                            {{--  Inicio de CARD  --}}
                            <section class="product">
                                <button class="pre-btn">
                                    <img src="{{ asset('img/comercial/home/arrow.png') }}" alt="">
                                </button>
                                <button class="nxt-btn">
                                    <img src="{{ asset('img/comercial/home/arrow.png') }}" alt="">
                                </button>
                                <div class="product-container">

                                    <div class="card product-card" style="margin: 15px">
                                        <div class="card-body combustibleBorde">
                                            <div>
                                                <img class="ImgCard" src="{{ asset('img/general/img4.jpg') }}"
                                                    alt="">
                                            </div>
                                            <div class="bordeTitulo mb-3">
                                                <h2 class="text-center"> Volteo 7 MTS Internacional</h2>
                                            </div>
                                            <div class="bordeTitulo  d-flex">
                                                <h3 class="text-center pe-2"> Precio de Renta desde: </h3>
                                                <h3 style="font-weight: 900"> $56,000</h3>
                                            </div>
                                            <div>
                                                <p style="font-size: 8px;">*Aplica restricciones *Precio aproximado</p>
                                            </div>
                                            <div class="precios">

                                            </div>
                                            <div class="row ">
                                                <div class="col-12 mb-1">
                                                    <p class="text-center" style="font-weight: bold">Reserva</p>
                                                    <p class="combustibleLitros fw-semibold text-center">
                                                        {{--  {{ number_format($gasolina->cisternaNivel, 2) }} lts.  --}}
                                                    </p>
                                                </div>

                                                <div class="col-6" style="width: 150px !important">
                                                    <p class=" "style="font-weight: bold">Última Carga:</p>
                                                    <p class="combustiblefecha fw-semibold mb-3">
                                                        {{--  {{ \Carbon\Carbon::parse($gasolina->created_at)->format('Y-m-d') }}  --}}
                                                    </p>
                                                </div>

                                                <div class="col-5" style="width: 130px !important">
                                                    <p class="d-flex align-content-end"style="font-weight: bold">Por Litro:
                                                    </p>
                                                    <p class="d-flex align-content-end combustibleLitros fw-semibold">
                                                        {{--  $ {{ number_format($gasolina->precio, 2) }}  --}}
                                                    </p>
                                                </div>

                                                <div class="col-12 d-flex justify-content-center">
                                                    <p class="text-center mt-1"
                                                        style="font-weight: bold; margin-right:8px; width: 130px !important">
                                                        Litros Cargados: </p>
                                                    <div class="combustibleLitros fw-semibold text-center mt-2">
                                                        {{--  {{ number_format($gasolina->litros, 2) }} lts.  --}}

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{--  EJEMPLO DEL TUTO  --}}
                                    {{--  <div class="product-card">
                                        <div class="product-image">
                                            <span class="discount-tag">50% off</span>
                                            <img src="images/card10.jpg" class="product-thumb" alt="">
                                            <button class="card-btn">add to wishlist</button>
                                        </div>
                                        <div class="product-info">
                                            <h2 class="product-brand">brand</h2>
                                            <p class="product-short-description">a short line about the cloth..</p>
                                            <span class="price">$20</span><span class="actual-price">$40</span>
                                        </div>
                                    </div>  --}}


                                </div>
                            </section>
                            {{--  Fin de CARD  --}}

                            <div class="text-center">
                                <a href="#">
                                    <button class="button">Conoce más</button>
                                </a>
                            </div>

                        </div>
                    </div>

                    <div class="tab-content " id="myTabContent">
                        <div class="tab-pane fade   " id="grua-tab-pane" role="tabpanel" aria-labelledby="grua-tab"
                            tabindex="0">
                            <div class="Row">
                                <h3>¡Grua!</h3>
                            </div>
                            <p>Obtén la renta de maquinaria pesada para construcción
                                más eﬁciente y de excelente rendimiento en Q2CES, donde
                                contamos con una amplia experiencia en el sector de la
                                renta de este tipo de equipos que te permitirán conseguir
                                resultados mucho más rápidos en todos tus proyectos de
                                obra.</p>

                            <p>Manejamos los precios más competitivos y una atención
                                personalizada desde una óptica de ingeniería civil, además
                                de que tenemos al personal más capacitado.</p>
                            <div class="text-center">
                                <a href="#">
                                    <button class="button">Conoce más</button>
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
                {{--  <div class="tab-content contentCargas" id="myTabContent">
                    <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab"
                        tabindex="0">
                        <div class="Row">
                            <h3>¡Cotiza en línea y empieza tu proyecto hoy!</h3>
                        </div>

                    </div>
                </div>  --}}


            </div>
            {{--  <div class="col-12 col-md-6 ">
                <img src="{{ asset('img/comercial/layout/whats.svg') }}" style="width: 50%;">
            </div>  --}}

        </div>

    </div>
@endsection
