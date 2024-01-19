@extends('comercial.layouts.main', ['activePage' => 'inicio'])
@section('content')
{{--  <link rel="stylesheet" type="text/css" href="{{ asset('css/comercial/slider.css') }}">  --}}

    <div class="contenido">
        <!-- Carousel Start --> <div class="">

        
            <div class="">
        <div class="col-lg-6 text-start">
            <div class="fixed-form-container">
                <div class="container" style="border: var(--verdeF) 3px solid;">
                    <div class="row justify-content-center">
                        <div class="shadow-lg border-0" style="background: #fff;">
                        
                        <div class="p-3">
                            <div class="text-center">
                                <h3 class="h1 fw-bold text-dark" style="font-size: 22px;">Encuentra el equipo adecuado</h3>   
                                {{--  <img src="{{ asset('img/comercial/layout/flechasDerecha.svg') }}" style="height: 55px; width:49px;">  --}}
                            </div>

                            <form id="contactForm" data-sb-form-api-token="API_TOKEN">
                                <div class="form-floating mb-3 d-flex align-items-center;" style="border-top: var(--verdeF) 3px solid; border-bottom: var(--verdeF) 3px solid;">
                                    <img class="font-weight-bold" src="{{ asset('img/comercial/layout/formularioCotizacion/EXCAVADORA.svg') }}" style="height: 58px; width:43.5px; padding: 3px; border-left: var(--verdeF) 3px solid; border-right: var(--verdeF) 3px solid; border-right: 0;">
                                    <span class="text-center" style="font-size:35px; height: 58px; color: gray">|</span>
                                    <select class="form-select inputCotizacion text-center" id="name" data-sb-validations="required" style="padding: 10px;">
                                        <option value="" selected disabled>Selecciona Tipo de Equipo</option>
                                        <!-- Agrega las opciones del select aquí -->
                                    </select>
                                </div>
                                
                                <div class="form-floating mb-3 d-flex align-items-center" style="border-top: var(--verdeF) 3px solid; border-bottom: var(--verdeF) 3px solid;">
                                    <img class="font-weight-bold" src="{{ asset('img/comercial/layout/formularioCotizacion/TRACTOR.svg') }}" style="height: 58px; width:43.5px; padding: 3px; border-left: var(--verdeF) 3px solid; border-right: var(--verdeF) 3px solid; border-right: 0;">
                                    <span class="text-center" style="font-size:35px; height: 58px; color: gray">|</span>
                                    <select class="form-select inputCotizacion text-center" id="emailAddress" data-sb-validations="required,email" style="padding: 10px;">
                                        <option value="" selected disabled>Selecciona Equipo</option>
                                        <!-- Agrega las opciones del select aquí -->
                                    </select>
                                </div>
                                
                                <div class="form-floating mb-3 d-flex align-items-center;" style="border-top: var(--verdeF) 3px solid; border-bottom: var(--verdeF) 3px solid;">
                                    <img class="font-weight-bold" src="{{ asset('img/comercial/layout/formularioCotizacion/MAPS GRIS.svg') }}" style="height: 58px; width:43.5px; padding: 6px; border-left: var(--verdeF) 3px solid; border-right: var(--verdeF) 3px solid; border-right: 0;">
                                    <span class="text-center" style="font-size:35px; height: 58px; color: gray">|</span>
                                    <select class="form-select inputCotizacion text-center" id="name" data-sb-validations="required" style="padding: 10px;">
                                        <option value="" selected disabled>Selecciona Ubicación</option>
                                        <!-- Agrega las opciones del select aquí -->
                                    </select>
                                </div>
                                
                                <div class="form-floating mb-3 d-flex align-items-center;" style="border-top: var(--verdeF) 3px solid; border-bottom: var(--verdeF) 3px solid;">
                                    <img class="font-weight-bold" src="{{ asset('img/comercial/layout/formularioCotizacion/CALENDARIO GRIS.svg') }}" style="height: 58px; width:43.5px; padding: 3px; border-left: var(--verdeF) 3px solid; border-right: var(--verdeF) 3px solid; border-right: 0;">
                                    <span class="text-center" style="font-size:35px; height: 58px; color: gray">|</span>
                                    <input class="form-control inputCotizacion text-center" id="emailAddress" type="date" data-sb-validations="required,email" style="padding: 10px;" />
                                </div>

                            <div class="form-floating mb-3 d-flex justify-content-center">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-check form-check-inline  inputCotizacionRadius">
                                            <input class="form-check-input"  type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                                            <label class="form-check-label"style="white-space: nowrap;" for="inlineRadio1">Recoger</label>
                                        </div>
                                    </div>
                                    
                                    <div class="col-6">
                                        <div class="form-check form-check-inline inputCotizacionRadius">
                                            <input class="form-check-input"  type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                                            <label class="form-check-label"style="white-space: nowrap;" for="inlineRadio2">Entregar</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                
                            <!-- Submit success message -->
                            <div class="d-none" id="submitSuccessMessage">
                                <div class="text-center mb-3">
                                <div class="fw-bolder">Form submission successful!</div>
                                <p>To activate this form, sign up at</p>
                                <a href="https://startbootstrap.com/solution/contact-forms">https://startbootstrap.com/solution/contact-forms</a>
                                </div>
                            </div>
                
                            <!-- Submit error message -->
                            <div class="d-none" id="submitErrorMessage">
                                <div class="text-center text-danger mb-3">Error sending message!</div>
                            </div>
                
                            <!-- Submit button -->
                            <div class="d-grid">
                                <button class="ButtonCotizacion btn-lg" id="submitButton" type="submit">
                                    <h1 class="display-1 text-white animated slideInRight pt-1" style="font-size: 21px; overflow-wrap: break-word; text-shadow: none;">COTIZA TU EQUIPO</h1>
                                </button>
                            </div>
                            </form>
                
                        </div>
                        </div>
                    
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
        <div style="background-color: black !important; opacity: 1 !important" class="container-fluid px-0 mb-2">
            <div id="header-carousel" class="carousel slide" data-bs-ride="carousel" style="position: relative !important; 
            overflow: hidden !important; background-size: auto; background-position: center center; background-repeat: no-repeat;background-image: url('/img/comercial/gifts/loading.gif');">
                <div class="carousel-inner sliderHome">
                    <div class="carousel-item active slides">
                        <img class="w-100" src="{{ asset('/img/comercial/banners/banner01.jpg') }}" alt="Image">
                        <div class="carousel-caption" >
                            <div class="container containerSlider">
                            
                                <div class="col-lg-6 text-start">
                                    <h1 class="display-1 text-white mb-5 animated slideInRight" style="font-size: 50px; overflow-wrap: break-word;">RENTA DE  <br> MAQUINARIA PESADA</h1>
                                    <div class="text-white text-uppercase animated slideInRight" style="font-size: 1rem;">
                                        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quidem magnam, sit amet consectetur adipisicing elit. Quidem magnam,
                                    </div>
                                </div>
                                <div class="col-lg-6 text-start"></div>
                            </div>
                        </div>

                    </div>
                    <div class="carousel-item slides">
                        <img class="w-100" src="{{ asset('/img/comercial/home/imgBackgoundSlider.jpg') }}" alt="Image">
                        <div class="carousel-caption">
							<div class="container containerSlider">
                            
                                <div class="col-lg-6 text-start">
                                    <h1 class="display-1 text-white mb-5 animated slideInRight" style="font-size: 50px; overflow-wrap: break-word;">RENTA DE  <br> MAQUINARIA PESADA</h1>
                                    <div class="text-white text-uppercase animated slideInRight" style="font-size: 1rem;">
                                        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quidem magnam, sit amet consectetur adipisicing elit. Quidem magnam,
                                    </div>
                                </div>
                                <div class="col-lg-6 text-start"></div>
                            </div>
						</div>
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

        <br>
        <div class="d-md-flex ">
            {{--  <div
                style="background-image: url('{{ asset('img/comercial/layout/Q2CES.svg') }}'); width: 100%; height: 80vh; opacity: 50%; ">
            </div>  --}}
            <div class="container">
                <div class="row">
                    <!-- Contenido del lado izquierdo -->
                    <div class="col-12 col-sm-12 col-md-12 col-lg-8 col-xl-6">
                        <div class="img-container">
                            <img class="img-cotiza" src="{{ asset('img/comercial/layout/quienesSomos/videoMuestra.jpg') }}" width="580px" alt="Q2Ces">
                            <a href="#" class="circular-button"><i class="fas fa-solid fa-play"></i></a>
                        </div>
                    </div>
                    <!-- Contenido del lado derecho -->
                    <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-6">
                        <div class="headerCotiza">¡Cotiza en linea y empieza <br>tu proyecto hoy!</div>
                        <p class="parrafoCotiza">Lorem ipsum dolor sit amet, Rem ea voluptatem culpa ratione aliquam, veritatis quae modi consequatur mollitia ab deserunt reiciendis voluptas amet quo eum. Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ut, ullam a. Eos expedita omnis quis repellendus, repudiandae inventore aut dolor sequi rerum ullam dicta sapiente voluptates unde optio eligendi facere.</p>
                        <p class="parrafoCotiza">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consectetur facilis eos placeat laudantium beatae exercitationem unde hic inventore? Ducimus iste eum enim nam non? Ipsum saepe delectus expedita unde vel! Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    </div>
                </div>
            </div>
            {{--  <div class="col-12 col-md-6 ">
                <img src="{{ asset('img/comercial/layout/whats.svg') }}" style="width: 50%;">
            </div>  --}}

        </div>
        <br>

        <div class="my-3 ">
            {{--  <div
                style="background-image: url('{{ asset('img/comercial/layout/Q2CES.svg') }}'); width: 100%; height: 80vh; opacity: 50%; ">
            </div>  --}}
            <div class="col-12 text-center mb-2 ">
                <h2>Nuestras Marcas</h2>
            </div>

            <div class="slider mb-2 ">
                <div class="slide-track mt-2">
                    <div class="slide">
                        <img src="{{ asset('img/comercial/sliderMarcas/BOBCAT.svg') }}" height="85" width="140" style="margin-top: 5px;"
                            alt="">
                    </div>
                    <div class="slide">
                        <img class="" src="{{ asset('img/comercial/sliderMarcas/WACKER.svg') }}" height="100"
                            width="230" style="">
                    </div>
                    <div class="slide">
                        <img class="" src="{{ asset('img/comercial/sliderMarcas/GENIE.svg') }}" height="60" width="230" style="margin-top: 15px;"
                            alt="">
                    </div>
                    <div class="slide">
                        <img class="" src="{{ asset('img/comercial/sliderMarcas/JCB.svg') }}" height="70" width="230" style="margin-top: 15px;"
                            alt="">
                    </div>
                    <div class="slide">
                        <img class="px-1" src="{{ asset('img/comercial/sliderMarcas/YANMAR.svg') }}" height="100" width="290"
                            alt="" style="padding-bootm:20px">
                    </div>
                    <div class="slide">
                        <img class="px-1" src="{{ asset('img/comercial/sliderMarcas/INTERNATIONAL.svg') }}" height="100"
                            width="105" alt="">
                    </div>
                    <div class="slide">
                        <img class="px-1" src="{{ asset('img/comercial/sliderMarcas/VOLVO.svg') }}" height="100"
                            width="105" alt="" style="margin-right: 10px;">
                    </div>
                    <div class="slide">
                        <img class="px-1" src="{{ asset('img/comercial/sliderMarcas/KENWORTH.svg') }}" height="100"
                            width="320" alt="" style="margin-bootm:30px">
                    </div>
                    <div class="slide">
                        <img class="px-2 mb-5" src="{{ asset('img/comercial/sliderMarcas/SCHWING.svg') }}" height="160"
                        width="100%" style="margin-top:-30px">
                    </div>
                    <div class="slide">
                        <img class="px-2" src="{{ asset('img/comercial/sliderMarcas/DEERE.svg') }}" height="200"
                        width="100%" style="margin-top:-45px">
                    </div>
                    <div class="slide">
                        <img class="px-2" src="{{ asset('img/comercial/sliderMarcas/PLANELEC.svg') }}" height="200"
                        width="100%" style="margin-top:-45px">
                    </div>
                    
                    <div class="slide">
                        <img src="{{ asset('img/comercial/sliderMarcas/BOBCAT.svg') }}" height="85" width="140" style="margin-top: 5px;"
                            alt="">
                    </div>
                    <div class="slide">
                        <img class="" src="{{ asset('img/comercial/sliderMarcas/WACKER.svg') }}" height="100"
                            width="230" style="">
                    </div>
                    <div class="slide">
                        <img class="" src="{{ asset('img/comercial/sliderMarcas/GENIE.svg') }}" height="60" width="230" style="margin-top: 15px;"
                            alt="">
                    </div>
                    <div class="slide">
                        <img class="" src="{{ asset('img/comercial/sliderMarcas/JCB.svg') }}" height="70" width="230" style="margin-top: 15px;"
                            alt="">
                    </div>
                    <div class="slide">
                        <img class="px-1" src="{{ asset('img/comercial/sliderMarcas/YANMAR.svg') }}" height="100" width="290"
                            alt="" style="padding-bootm:20px">
                    </div>
                    <div class="slide">
                        <img class="px-1" src="{{ asset('img/comercial/sliderMarcas/INTERNATIONAL.svg') }}" height="100"
                            width="105" alt="">
                    </div>
                    <div class="slide">
                        <img class="px-1" src="{{ asset('img/comercial/sliderMarcas/VOLVO.svg') }}" height="100"
                            width="105" alt="" style="margin-right: 10px;">
                    </div>
                    <div class="slide">
                        <img class="px-1" src="{{ asset('img/comercial/sliderMarcas/KENWORTH.svg') }}" height="100"
                            width="320" alt="" style="margin-bootm:30px">
                    </div>
                    <div class="slide">
                        <img class="px-2 mb-5" src="{{ asset('img/comercial/sliderMarcas/SCHWING.svg') }}" height="160"
                        width="100%" style="margin-top:-30px">
                    </div>
                    <div class="slide">
                        <img class="px-2" src="{{ asset('img/comercial/sliderMarcas/DEERE.svg') }}" height="200"
                        width="100%" style="margin-top:-45px">
                    </div>
                    <div class="slide">
                        <img class="px-2" src="{{ asset('img/comercial/sliderMarcas/PLANELEC.svg') }}" height="200"
                        width="100%" style="margin-top:-45px">
                    </div>
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
                        {{--  <div class="Row">
                                <h3>¡Movimiento!</h3>
                            </div>  --}}

                        {{--  Inicio de CARRUSEL CARD  --}}
                        <section class="product">
                            <button class="pre-btn">
                                <img src="{{ asset('img/comercial/home/arrow.png') }}" alt="">
                            </button>
                            <button class="nxt-btn">
                                <img src="{{ asset('img/comercial/home/arrow.png') }}" alt="">
                            </button>
                            <div class="product-container">

                                {{--  Aqui inicia el elemento --}}
                                <div class="card product-card cartaProducto" style="margin: 15px">
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
                                        <div class="precios d-flex">
                                            <div class="col-4">
                                                <p class="text-center">
                                                    $36,000
                                                </p>
                                                <p class="text-center">
                                                    Dia
                                                </p>
                                            </div>
                                            <div class="col-4">
                                                <p class="text-center">
                                                    $44,000
                                                </p>
                                                <p class="text-center">
                                                    Semana
                                                </p>
                                            </div>
                                            <div class="col-4">
                                                <p class="text-center">
                                                    $56,000
                                                </p>
                                                <p class="text-center">
                                                    Mes
                                                </p>
                                            </div>

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
                                                <button class="button botonesCard">RENTAR</button>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                {{--  Aqui terminan el elemento --}}


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
                        {{--  Fin de CARRUSEL CARD  --}}

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
        </div>



        <div>
            <div class="liston liston-linea" style="background-image: url('img/comercial/banners/valores.png');">
                <div class="section px-2 col-12 col-md-6 col-lg-3">
                    <img src="{{ asset('img/comercial/home/inovacion.svg') }}" />
                    <p>INOVACÍON <br><span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque sit amet
                            velit ut enim malesuada porttitor.</span></p>
                </div>
                <div class="section px-2 col-12 col-md-6 col-lg-3">
                    <img src="{{ asset('img/comercial/home/calidad.svg') }}" />
                    <p>CALIDAD <br><span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque sit amet
                            velit ut enim malesuada porttitor.</span></p>
                </div>
                <div class="section px-2 col-12 col-md-6 col-lg-3">
                    <img src="{{ asset('img/comercial/home/experiencia.svg') }}" />
                    <p>EXPERIENCIA <br><span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque sit
                            amet
                            velit ut enim malesuada porttitor.</span></p>
                </div>
                <div class="section px-2 col-12 col-md-6 col-lg-3">
                    <img src="{{ asset('img/comercial/home/soporte.svg') }}" />
                    <p>SOPORTE <br><span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque sit amet
                            velit ut enim malesuada porttitor.</span></p>
                </div>
            </div>
        </div>

        <div id="liston-carousel" class="carousel  liston liston-carrusel" data-bs-ride="liston-carousel"
            style="background-image: url('img/comercial/banners/valores.png');">
            <div class="liston-carousel-inner col-12">
                <div class="carousel-item active ">
                    <img src="{{ asset('img/comercial/home/inovacion.svg') }}" />
                    <p>INOVACÍON <br><span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque sit amet
                            velit ut enim malesuada porttitor.</span></p>
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('img/comercial/home/calidad.svg') }}" />
                    <p>CALIDAD <br><span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque sit amet
                            velit ut enim malesuada porttitor.</span></p>
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('img/comercial/home/experiencia.svg') }}" />
                    <p>EXPERIENCIA <br><span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque
                            sit
                            amet
                            velit ut enim malesuada porttitor.</span></p>
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('img/comercial/home/soporte.svg') }}" />
                    <p>SOPORTE <br><span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque sit amet
                            velit ut enim malesuada porttitor.</span></p>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#liston-carousel"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#liston-carousel"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>

        </div>
        <div class="my-2 mx-5">
            <div class="d-flex">
                <div class="col-6 noticias">
                    <h4>Últimas Coticias y Actualizaciones</h4>
                    <img src="{{ asset('img/comercial/layout/flechasDerecha.svg') }}">
                </div>
                <div class="col-6 text-end">
                    <button class="button" type="button">
                        Ver Todas Las Noticias
                    </button>
                </div>
            </div>
            <div class="col-12 my-3 mx-5 d-flex">
                <div class="card product-card cartaProducto mx-3" style="margin: 15px">
                    <div class="card-body combustibleBorde">
                        <div>
                            <img class="ImgCard" src="{{ asset('img/general/img4.jpg') }}" alt="">
                        </div>
                        <div class="bordeTitulo  d-flex">
                            <h3 class="text-center pe-2"> 10 de marzo del 2024: </h3>
                        </div>
                        <div class="bordeTitulo mb-3">
                            <h2 class="text-center"> Diferencia entre plataforma telescopica y articulada </h2>
                        </div>
                        <div class="d-flex">
                            <div class="col-12">
                                <p class="text-center" style="font-size: 10px">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque sit amet velit ut enim
                                    malesuada porttitor. Nam tincidunt a est vitae porttitor. Phasellus consequat augue vel
                                    condimentum posuere
                                </p>
                            </div>
                        </div>

                        <div class="d-flex">
                            <a href="#">
                                <h4 style="font-size: 15px">Ver Mas <img
                                        src="{{ asset('img/comercial/layout/flechasDerecha.svg') }}" style="width: 35px">
                                </h4>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card product-card cartaProducto mx-3" style="margin: 15px">
                    <div class="card-body combustibleBorde">
                        <div>
                            <img class="ImgCard" src="{{ asset('img/general/img4.jpg') }}" alt="">
                        </div>
                        <div class="bordeTitulo  d-flex">
                            <h3 class="text-center pe-2"> 10 de marzo del 2024: </h3>
                        </div>
                        <div class="bordeTitulo mb-3">
                            <h2 class="text-center"> Diferencia entre plataforma telescopica y articulada </h2>
                        </div>
                        <div class="d-flex">
                            <div class="col-12">
                                <p class="text-center" style="font-size: 10px">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque sit amet velit ut enim
                                    malesuada porttitor. Nam tincidunt a est vitae porttitor. Phasellus consequat augue vel
                                    condimentum posuere
                                </p>
                            </div>
                        </div>

                        <div class="d-flex">
                            <a href="#">
                                <h4 style="font-size: 15px">Ver Mas <img
                                        src="{{ asset('img/comercial/layout/flechasDerecha.svg') }}" style="width: 35px">
                                </h4>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card product-card cartaProducto mx-3" style="margin: 15px">
                    <div class="card-body combustibleBorde">
                        <div>
                            <img class="ImgCard" src="{{ asset('img/general/img4.jpg') }}" alt="">
                        </div>
                        <div class="bordeTitulo  d-flex">
                            <h3 class="text-center pe-2"> 10 de marzo del 2024: </h3>
                        </div>
                        <div class="bordeTitulo mb-3">
                            <h2 class="text-center"> Diferencia entre plataforma telescopica y articulada </h2>
                        </div>
                        <div class="d-flex">
                            <div class="col-12">
                                <p class="text-center" style="font-size: 10px">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque sit amet velit ut enim
                                    malesuada porttitor. Nam tincidunt a est vitae porttitor. Phasellus consequat augue vel
                                    condimentum posuere
                                </p>
                            </div>
                        </div>

                        <div class="d-flex">
                            <a href="#">
                                <h4 style="font-size: 15px">Ver Mas <img
                                        src="{{ asset('img/comercial/layout/flechasDerecha.svg') }}" style="width: 35px">
                                </h4>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{--  <div class="col-12 col-md-6 ">
                <img src="{{ asset('img/comercial/layout/whats.svg') }}" style="width: 50%;">
            </div>  --}}

            <style>
                
                
                .sliderHome{
                    position: relative;
                    width: 100%;
                    min-height: 520px;
                    overflow: hidden;
                }
                .sliderHome .slides {
                    position: absolute;
                    width: 100%;
                    height: 100%;
                }
        
                .sliderHome .slides img{
                    position: absolute;
                    width: 100%;
                    height: 100%;
                    object-fit: cover;
                }

                /* Agrega estas reglas de estilo a tu hoja de estilo CSS */
                .carousel-item {
                    transition: opacity 0.5s ease-in-out; /* Ajusta la duración y el tipo de transición según tus preferencias */
                }

                .carousel-inner {
                    overflow: hidden;
                }

                .carousel-item.active,
                .carousel-item-next,
                .carousel-item-prev {
                    display: block !important; /* Importante para evitar que Bootstrap oculte elementos */
                }

                .carousel-item-next,
                .carousel-item-prev {
                    opacity: 0;
                }

                .carousel-item.active {
                    opacity: 1;
                }
                .no-wrap {
                    word-wrap: break-word;
                }
                /*.carousel-item {
                    transition: transform 0.5s ease-in-out;
                }

                .carousel-inner {
                    overflow: hidden;
                }

                .carousel-item.active,
                .carousel-item-next,
                .carousel-item-prev {
                    display: block !important; 
                }

                .carousel-item-next {
                    transform: translateX(100%); 
                }

                .carousel-item-prev {
                    transform: translateX(-100%);
                }

                .carousel-item.active {
                    transform: translateX(0);
                }*/
                /* Agrega estas reglas de estilo a tu hoja de estilo CSS */
                /*.carousel-item {
                    transition: transform 1s ease-in-out;
                }

                .carousel-inner {
                    overflow: hidden;
                }

                .carousel-item.active,
                .carousel-item-next,
                .carousel-item-prev {
                    display: block !important;
                }

                .carousel-item-next,
                .carousel-item-prev {
                    transform: scale(0.8);
                }

                .carousel-item.active {
                    transform: scale(1);
                }*/
                .ButtonCotizacion {
                    font-size: 24px !important;
                    border-radius: 0 !important;
                    color: #fff; /* Color del texto */
                    background-color: var(--verdeB);
                    border: none;
                    padding: 0.2rem 3rem;
                }

                .ButtonCotizacion:hover {
                    background-color: var(--verdeF);
                }

                .inputCotizacion{
                    border-radius: 0 !important;
                    border-left: 0;
                    border-right: var(--verdeF) 3px solid;
                    color: gray;
                    font-weight: 600;
                }
                .inputCotizacionRadius{
                    color: black;
                    font-weight: bold;
                }
                .inputCotizacion:focus {
                    box-shadow: none;
                    border: var(--verdeB) 4px solid !important;
                }
                .form-check-input:checked {
                    background-color: black;
                    border-color: black;
                }
                .form-control:focus {
                    border: var(--verdeB) 4px solid !important;
                    box-shadow: none;
                }

            </style>

            <style>
                @media (min-width: 1401px) and (max-width: 2600px) {
                    .fixed-form-container {
                      position: absolute;
                      bottom: 34%;
                      left: 60%;
                      width: 415px;
                      z-index: 1000; /* Ajusta según sea necesario para que esté por encima de otros elementos */
                    }
                    .containerSlider{
                        margin-top: -400px;
                    }
                  }
                @media (min-width: 700px) and (max-width: 1400px) {
                    .fixed-form-container {
                        position: absolute;
                        bottom: 34%;
                        left: 55%;
                        width: 360px;
                        z-index: 1000; /* Ajusta según sea necesario para que esté por encima de otros elementos */
                    }
                    .containerSlider{
                        margin-top: -400px;
                    }
                }
                @media (max-width: 700px) {
                    .fixed-form-container {
                        position: absolute;
                        bottom: 34%;
                        left: 50%;
                        width: 330px;
                        z-index: 1000; /* Ajusta según sea necesario para que esté por encima de otros elementos */
                    }
                }
            </style>
            
            <style>
                
                .headerCotiza{
                    font-size: 30px;
                    color: var(--verdeF); font-weight: bold;
                    margin-bottom: 5px;
                    margin-top: 10px;
                }

                .parrafoCotiza{
                    color: var(--verdeB);
                    text-align: justify;
                }

                .img-cotiza{
                    border-radius: 6em;
                }
                .img-container {
                    position: relative;
                }
                
                .img-cotiza {
                    width: 100%; /* Ajusta el tamaño de la imagen según sea necesario */
                    display: block;
                }
                
                .circular-button {
                    position: absolute;
                    top: 50%;
                    left: 50%;
                    transform: translate(-50%, -50%);
                    background-color: var(--verdeB);
                    border-radius: 50%; /* Hace que el botón sea circular */
                    padding: 10px 20px; 
                    text-decoration: none;
                    border: none;
                    color: #fff; 
                }
                
                .circular-button i {
                    font-size: 24px; /* Ajusta el tamaño del icono según sea necesario */
                }

                .circular-button:hover {
                    background-color: var(--verdeF);
                    color: white;
                }
            </style>
    </div>
@endsection
