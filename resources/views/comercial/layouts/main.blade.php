<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Qcem2</title>
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('img/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('img/favicon.png') }}">
    <meta
        content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'name='viewport' />

    <!--     Fonts and icons     -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <script src="https://cdn.lordicon.com/qjzruarw.js"></script>
    <!-- CSS Files -->
    {{--  <link rel="stylesheet" type="text/css" href="{{ asset('css/general.css') }}">  --}}
    {{--  <link rel="stylesheet" type="text/css" href="{{ asset('css/sider.css') }}">  --}}
    {{--  <link rel="stylesheet" type="text/css" href="{{ asset('css/layout.css') }}">  --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('css/comercial/layout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/comercial/general.css') }}">

    <!-- CSS only -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"
        integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" rel="Stylesheet">


</head>

<body>
    <!-- ======= Header ======= -->
    <header id="header" class="">
        <div class="datos">
            <ul class="lista-datos">
                <li class="">
                    <div>
                        <img src="{{ asset('img/comercial/layout/whats.svg') }}" height="35px" alt="">
                    </div>
                    (55) 33-1215-7273
                </li>
                <li>
                    <div>
                        <img src="{{ asset('img/comercial/layout/telefono.svg') }}" height="20px" alt=""
                            style="">
                    </div>
                    Cóntactanos
                </li>
                <li class="">
                    <div>
                        <img src="{{ asset('img/comercial/layout/maps.svg') }}" height="20px" alt="">
                    </div>
                    Corporativo: <br>
                    José María Heredia #2387
                </li>
                <li class="">
                    <div>
                        <img src="{{ asset('img/comercial/layout/maps.svg') }}" height="20px" alt="">
                    </div>
                    Operaciones: <br>
                    San Juan de Los Lagos #1824
                </li>
                <li class="">
                    <div>
                        <img src="{{ asset('img/comercial/layout/relogBlanco.svg') }}" height="20px" alt="">
                    </div>
                    Lunes - Sábado 8:00-18:00
                </li>
                <li class="">
                    <a href="{{ url('home', session('id')) }}" class=" align-items-center">
                        <img src="{{ asset('img/comercial/layout/Q2CEM.svg') }}" height="35px" alt="Q2Ces">
                    </a>
                </li>
            </ul>
        </div>
        <div class="d-flex encabezado">
            <div class='logo col-2 '>
                {{--  <li >  --}}
                <a href="{{ url('/') }}" class="align-items-center">
                    <img src="{{ asset('img/comercial/layout/Q2CES.svg') }}" alt="Q2Ces">
                </a>
                {{--  </li>  --}}

            </div>
            <div class="col-10 divnav">
                <nav>
                    <ul class='nav-bar d-flex'>
                        <input type='checkbox' id='check' />
                        <span class="menu">
                            <li class="{{ $activePage == 'inicio' ? 'activo' : '' }}">
                                <a href="{{ url('/') }}">Inicio</a>
                            </li>
                            <li><a href="">¿Quiénes Somos?</a></li>
                            <li>
                                <a href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    Equipo
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                </div>
                            </li>
                            <li><a href="">Cotizador</a></li>
                            <li><a href="">Trabaja con Nosotros</a></li>
                            <li><a href="">Blog</a></li>
                            <li><a href="">Contáctanos</a></li>
                            <label for="check" class="close-menu"><i class="fas fa-times"></i></label>
                        </span>
                        <label for="check" class="open-menu"><i class="fas fa-bars"></i></label>
                    </ul>
                </nav>
            </div>
        </div>

    </header>
    <!-- End Header -->

    <!-- ======= Sidebar ======= -->

    <!-- End Sidebar-->


    <main id="main" class="main">
        @yield('content')
    </main>

    <!-- End main -->
    <div class="mb-5" id="spinner-container"></div>
    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        <div class="separadorFooter">
            <img src="{{ asset('img/comercial/layout/separadorFooter.svg') }}">
        </div>
        <div class="contFooder">
            <div class="col-12 col-md-6 col-lg-3 seccionFooder ">
                <img src="{{ asset('img/comercial/layout/Q2CES.svg') }}" alt="Q2Ces">
                <p>ESPECIALIZADO EN LA RENTA DE MAQUINARIA PESADA PARA PROYECTOS DE CONSTRUCCIÓN Y MOVIMIENTO DE
                    TIERRAS.</p>
            </div>
            <div class="col-12 col-md-6 col-lg-3 seccionFooder flechas">
                <h2>ENLACES ÚTILES</h2>
                <img src="{{ asset('img/comercial/layout/flechasDerecha.svg') }}">
                <a href="#">
                    <h3>Inicio</h3>
                </a>
                <a href="#">
                    <h3>Equipo</h3>
                </a>
                <a href="#">
                    <h3>Cotizador</h3>
                </a>
                <a href="#">
                    <h3>Trabaja con nosotros</h3>
                </a>
            </div>
            <div class="col-12 col-md-6 col-lg-3 seccionFooder flechas">
                <h2>EXPLORAR Q2CES</h2>
                <img src="{{ asset('img/comercial/layout/flechasDerecha.svg') }}">
                <a href="#">
                    <h3>Acerca de la renta</h3>
                </a>
                <a href="#">
                    <h3>Últimas noticias</h3>
                </a>
                <a href="#">
                    <h3>Términos y condiciones</h3>
                </a>
                <a href="#">
                    <h3>Protecciones y coberturas</h3>
                </a>
            </div>
            <div class="col-12 col-md-6 col-lg-3 seccionFooder flechas">
                <h2>CONTACTO</h2>
                <img src="{{ asset('img/comercial/layout/flechasDerecha.svg') }}">
                <div class="pats">
                    <div class="col-2 mb-0">
                        <img src="{{ asset('img/comercial/layout/telefonoVerde.svg') }}">
                    </div>
                    <div class="col-10">
                        <h3>Soporte de renta</h3>
                        <h3>33-1215-7273</h3>
                    </div>
                </div>
                <div class="pats">
                    <div class="col-2 mb-0">
                        <img src="{{ asset('img/comercial/layout/relogVerde.svg') }}">
                    </div>
                    <div class="col-10">
                        <h3>Horario de oficina</h3>
                        <h3>Lun - Sab 8am a 6pm</h3>
                    </div>
                </div>
                <div class="pats">
                    <div class="col-2 mb-0">
                        <img src="{{ asset('img/comercial/layout/correoVerde.svg') }}" style="width: 30px">
                    </div>
                    <div class="col-10">
                        <h3>Envíanos un correo</h3>
                        <h3>contacto@q2ces.com</h3>
                    </div>
                </div>
                <div class="pats">
                    <a href="#">
                        <img src="{{ asset('img/comercial/layout/whats.svg') }}">
                    </a>
                    <a href="#">
                        <img src="{{ asset('img/comercial/layout/iconoFacebook.svg') }}">
                    </a>
                    <a href="#">
                        <img src="{{ asset('img/comercial/layout/iconoInsta.svg') }}">
                    </a>
                    <a href="#">
                        <img src="{{ asset('img/comercial/layout/iconoLinke.svg') }}">
                    </a>
                </div>
            </div>
        </div>
        <div class="copyright">
            <?php echo date('Y'); ?> Q2CES. <a href="">AVISO DE PRIVACIDAD.</a> TODOS LOS DERECHOS RESERVADOS.
        </div>
    </footer>
    <!-- End Footer -->

    <!--   Core JS Files   -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>


    <script src="{{ asset('js/core/jquery.min.js') }}"></script>
    <script src="{{ asset('js/core/popper.min.js') }}"></script>
    <script src="{{ asset('js/core/bootstrap-material-design.min.js') }}"></script>
    <script src="{{ asset('js/plugins/perfect-scrollbar.jquery.min.js') }}"></script>
    {{--  <script src="{{ asset('js/material-dashboard.js') }}" type="text/javascript"></script>  --}}
    <!-- JavaScript Bundle with Popper -->
    {{--  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous">
    </script>  --}}
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/alertas.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>

    @stack('js')
</body>

</html>
