@extends('comercial.layouts.main', ['activePage' => 'quienesSomos'])
@section('content')
    <div class="contenido ">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/comercial/quienesSomos.css') }}">
        <body>
            <header class="paddindY-5 bg-image img-fluid">
                <div class="container px-4 px-lg-5 my-5">
                    <div class="text-center">
                        <h1 class="display-4">Q2CES</h1>
                        {{--  <p class="lead fw-normal text-white-50 mb-0">With this shop hompeage template</p>  --}}
                    </div>
                </div>
            </header>            
            
            <!-- Section-->
            {{--  <section class="paddindY-5">
                <div class="container px-4 px-lg-5 mt-5">
                    <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                        <div class="col mb-5">
                            <div class="card h-100">
                                <!-- Product image-->
                                <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="..." />
                                <!-- Product details-->
                                <div class="card-body p-4">
                                    <div class="text-center">
                                        <!-- Product name-->
                                        <h5 class="fw-bolder">Fancy Product</h5>
                                        <!-- Product price-->
                                        $40.00 - $80.00
                                    </div>
                                </div>
                                <!-- Product actions-->
                                <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                    <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">View options</a></div>
                                </div>
                            </div>
                        </div>
                        <div class="col mb-5">
                            <div class="card h-100">
                                <!-- Product image-->
                                <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="..." />
                                <!-- Product details-->
                                <div class="card-body p-4">
                                    <div class="text-center">
                                        <!-- Product name-->
                                        <h5 class="fw-bolder">Fancy Product</h5>
                                        <!-- Product price-->
                                        $120.00 - $280.00
                                    </div>
                                </div>
                                <!-- Product actions-->
                                <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                    <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">View options</a></div>
                                </div>
                            </div>
                        </div>
                        <div class="col mb-5">
                            <div class="card h-100">
                                <!-- Sale badge-->
                                <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sale</div>
                                <!-- Product image-->
                                <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="..." />
                                <!-- Product details-->
                                <div class="card-body p-4">
                                    <div class="text-center">
                                        <!-- Product name-->
                                        <h5 class="fw-bolder">Special Item</h5>
                                        <!-- Product reviews-->
                                        <div class="d-flex justify-content-center small text-warning mb-2">
                                            <div class="bi-star-fill"></div>
                                            <div class="bi-star-fill"></div>
                                            <div class="bi-star-fill"></div>
                                            <div class="bi-star-fill"></div>
                                            <div class="bi-star-fill"></div>
                                        </div>
                                        <!-- Product price-->
                                        <span class="text-muted text-decoration-line-through">$20.00</span>
                                        $18.00
                                    </div>
                                </div>
                                <!-- Product actions-->
                                <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                    <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">Add to cart</a></div>
                                </div>
                            </div>
                        </div>
                        <div class="col mb-5">
                            <div class="card h-100">
                                <!-- Product image-->
                                <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="..." />
                                <!-- Product details-->
                                <div class="card-body p-4">
                                    <div class="text-center">
                                        <!-- Product name-->
                                        <h5 class="fw-bolder">Popular Item</h5>
                                        <!-- Product reviews-->
                                        <div class="d-flex justify-content-center small text-warning mb-2">
                                            <div class="bi-star-fill"></div>
                                            <div class="bi-star-fill"></div>
                                            <div class="bi-star-fill"></div>
                                            <div class="bi-star-fill"></div>
                                            <div class="bi-star-fill"></div>
                                        </div>
                                        <!-- Product price-->
                                        $40.00
                                    </div>
                                </div>
                                <!-- Product actions-->
                                <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                    <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">Add to cart</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>  --}}
            <br>
            <section class="">
                <div class="container-fluid">
                    <div class="container section-bg-image img-fluid" style="background-image: url('img/comercial/layout/quienesSomos/Logo con opacidad.png');">
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
                        
                        <br><br>
                        <!-- Subsección -->
                        <div class="row subSeccion d-flex justify-content-between">
                            <div class="col-sm-12 col-md-12 col-lg-4">
                                <button class="headerButtonCotizacion">Misión</button>
                                <p class="parrafoVisionEmpresa">Contenido de la misión... Lorem ipsum dolor sit amet consectetur adipisicing elit. Distinctio, quidem! Reiciendis voluptas provident harum minus sed id suscipit, doloremque deleniti qui ab ea dolores nesciunt illo vero dicta beatae pariatur?</p>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-4">
                                <button class="headerButtonCotizacion">Visión</button>
                                <p class="parrafoVisionEmpresa">Contenido de la visión... Lorem ipsum dolor sit amet consectetur adipisicing elit. Distinctio, quidem! Reiciendis voluptas provident harum minus sed id suscipit, doloremque deleniti qui ab ea dolores nesciunt illo vero dicta beatae pariatur?</p>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-4">
                                <button class="headerButtonCotizacion">Valores</button>
                                <p class="parrafoVisionEmpresa">Contenido de los valores... Lorem ipsum dolor sit amet consectetur adipisicing elit. Distinctio, quidem! Reiciendis voluptas provident harum minus sed id suscipit, doloremque deleniti qui ab ea dolores nesciunt illo vero dicta beatae pariatur?</p>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </section>
            
            <br>
            <header class="paddindY-5 bg-image-contactos img-fluid">
                <div class="container px-4 px-lg-5 my-5">
                    <div class="d-flex justify-content-between">
                        <div class="section">
                            <span class="icon">
                                <img src="{{ asset('img/comercial/layout/quienesSomos/TELEFONO BLANCO.svg')}}" width="50" />
                            </span>
                            <p>Soporte para renta <br> 33-2356-2356</p>
                        </div>
                        <div class="section">
                            <span class="icon">
                                <img src="{{ asset('img/comercial/layout/quienesSomos/HORARIO BLANCO.svg')}}" width="50" />
                            </span>
                            <p>Horario de oficina <br> Lun - Sab 8am a 6pm</p>
                        </div>
                        <div class="section">
                            <span class="icon">
                                <img src="{{ asset('img/comercial/layout/quienesSomos/CORREO BLANCO.svg')}}" width="50" />
                            </span>
                            <p>Envíanos un correo <br> contacto@q2ces.com</p>
                        </div>
                    </div>
                </div>
            </header>
        </body>  
    </div>
    <div class="contactoForm">
        <div class="container-fluid">
            <div class="row justify-content-center img-fluid backImageContacto" style="background-image: url('img/comercial/layout/formularioContactenos/YANMAR_1.png');" >
                <div class="col-xl-12" style="background: transparent !important">
                    <div class="border-0 overflow-hidden">
                        <div class="p-0">
                            <div class="row g-0">
                                <div class="col-12 col-md-6 d-sm-block">
                                    <div class="row g-4">
                                        <div class="col-6 pt-5">
                                            <div class="text-center">
                                                <br>
                                                <div class="headerMaps" style="margin-left: 20px">CORPORATIVO</div>
                                            </div>
                                            <div class="map" id="contact">
                                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3733.3067313738783!2d-103.3815732!3d20.6884531!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8428ae3fb43c70c5%3A0x9f4276d55bfda207!2sC.%20Jos%C3%A9%20Mar%C3%ADa%20Heredia%202387%2C%20Lomas%20de%20Guevara%2C%2044657%20Guadalajara%2C%20Jal.!5e0!3m2!1sen!2sus!4v[versión]" style="height: 350px; width: 100%;" allowfullscreen="" loading="lazy"></iframe>
                                                <br />
                                            </div>
                                        </div>
                                        <div class="col-6 pt-5">
                                            <div class="text-center">
                                                <br>
                                                <div class="headerMaps">OPERACIONES</div>
                                            </div>
                                            <div class="map" id="contact">
                                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3735.050826287085!2d-103.4323717!3d20.7607274!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8428a5f319e51b57%3A0x65039db4c405de96!2sSan%20Juan%20de%20Los%20Lagos%201788%2C%20Hogares%20de%20Nuevo%20M%C3%A9xico%2C%2045160%20Nuevo%20M%C3%A9xico%2C%20Jal.!5e0!3m2!1sen!2sus!4v[versión]" style="height: 350px; width: 100%;" allowfullscreen="" loading="lazy"></iframe>
                                                <br />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-md-6 p-4">
                                    <div class="text-center">
                                        <h1 class="h1Contactenos">CONTÁCTENOS</h1>
                                        <p class="mb-4 pContactenos">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Optio ea veritatis eligendi? Quis culpa ducimus labore libero ab aperiam, officiis error aut saepe? Architecto voluptatem amet modi, nisi autem similique?</p>
                                    </div>

                                <form id="contactForm" data-sb-form-api-token="API_TOKEN">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-floating mb-3">
                                                <input autocomplete="off" class="form-control shadow-lg inputContactenos" id="name" type="text"  data-sb-validations="required" />
                                                <label class="labelFormContactenos" for="name">NOMBRE:</label>
                                                <div class="invalid-feedback" style="font-weight: bold" data-sb-feedback="name:required">Nombre Requerido.</div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-6">
                                            <div class="form-floating mb-3">
                                                <input autocomplete="off" class="form-control shadow-lg inputContactenos" id="telefono" type="text"  data-sb-validations="required" />
                                                <label class="labelFormContactenos" for="telefono">TELÉFONO:</label>
                                                <div class="invalid-feedback" style="font-weight: bold" data-sb-feedback="telefono:required">Teléfono Requerido.</div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Email Input -->
                                    <div class="form-floating mb-3">
                                    <input autocomplete="off" class="form-control shadow-lg inputContactenos" id="emailAddress" type="email"  data-sb-validations="required,email" />
                                    <label class="labelFormContactenos" for="emailAddress">CORREO ELECTRÓNICO:</label>
                                    <div class="invalid-feedback" style="font-weight: bold" data-sb-feedback="emailAddress:required">Correo Electrónico Requerido.</div>
                                    <div class="invalid-feedback" style="font-weight: bold" data-sb-feedback="emailAddress:email">Correo Electrónico Invalido.</div>
                                    </div>

                                    <!-- Message Input -->
                                    <div class="form-floating mb-3">
                                    <textarea class="form-control shadow-lg inputContactenos" id="message" type="text"  style="height: 10rem;"></textarea>
                                    <label class="labelFormContactenos" for="message" style="text-white">MENSAJE:</label>
                                    <div class="invalid-feedback" style="font-weight: bold" data-sb-feedback="message:required">Message is required.</div>
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
                                    <div class="d-grid justify-content-center">
                                    <button class="btn disabled submitContactenos" id="submitButton" type="submit">ENVIAR MENSAJE</button>
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
    <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>   
@endsection
