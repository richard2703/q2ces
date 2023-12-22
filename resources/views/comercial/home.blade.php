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

        <div class="d-md-flex marcos">
            {{--  <div
                style="background-image: url('{{ asset('img/comercial/layout/Q2CES.svg') }}'); width: 100%; height: 80vh; opacity: 50%; ">
            </div>  --}}
            <div class="col-12 col-md-8 marcos">
                <img src="{{ asset('img/comercial/layout/Q2CES.svg') }}" alt="Q2Ces" style="width: 50%;">
            </div>
            <div class="col-12 col-md-4 marcos">
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
            {{--  <div class="col-12 col-md-6 marcos">
                <img src="{{ asset('img/comercial/layout/whats.svg') }}" style="width: 50%;">
            </div>  --}}

        </div>
        <div class="my-3 marcos">
            {{--  <div
                style="background-image: url('{{ asset('img/comercial/layout/Q2CES.svg') }}'); width: 100%; height: 80vh; opacity: 50%; ">
            </div>  --}}
            <div class="col-12 text-center mb-2 marcos">
                <h2>Nuestras Marcas</h2>
            </div>

            <div class="slider mb-2 marcos">
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
            <div class="col-12  marcos">
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
            {{--  <div class="col-12 col-md-6 marcos">
                <img src="{{ asset('img/comercial/layout/whats.svg') }}" style="width: 50%;">
            </div>  --}}

        </div>

    </div>
@endsection
