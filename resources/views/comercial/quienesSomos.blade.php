@extends('comercial.layouts.main', ['activePage' => 'quienesSomos'])
@section('content')
    <div class="contenido">
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
            <section class="section-bg-image">
                <img class="q2cesFondo" src="{{ asset('img/comercial/layout/Q2CES.svg') }}" alt="Q2Ces">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="headerButton">Botón</div>
                            <p class="parrafoVisionEmpresa">Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis consequuntur veritatis numquam atque magnam reiciendis nemo optio iure saepe ipsa neque, ut repellat. Sed quaerat dignissimos perspiciatis harum nesciunt culpa? Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        </div>
                        <div class="col-md-4">
                            
                            <div class="headerButton">Botón</div>
                            <p class="parrafoVisionEmpresa">Lorem ipsum dolor sit amet consectetur adipisicing elit. A hic voluptate quis minus, sit quae tempora aut placeat officia error sed non facere laborum eaque illo vero necessitatibus sapiente nisi. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        </div>
                        <div class="col-md-4">
                            
                            <div class="headerButton">Botón</div>
                            <p class="parrafoVisionEmpresa">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consectetur facilis eos placeat laudantium beatae exercitationem unde hic inventore? Ducimus iste eum enim nam non? Ipsum saepe delectus expedita unde vel! Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        </div>
                    </div>
                </div>
            </section>
            
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
        <div class="my-3">
        </div>
    </div>
    <style>
        .bg-image {
            background-image: url('img/comercial/layout/quienesSomos/BANNER SOBRE NOSOTROS_1.png');
            background-size: 100% 100%;
            background-position: center;
            background-repeat: no-repeat;
        }
        .bg-image-contactos{
            background-image: url('img/comercial/layout/quienesSomos/BANNER SOBRE NOSOTROS_1.png');
            background-size: 100% 100%;
            background-position: center;
            background-repeat: no-repeat;
        }
    </style>
@endsection
