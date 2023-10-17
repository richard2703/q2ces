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
    <!-- CSS only -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    {{--  <link href="{{ asset('css/material-dashboard.css?v=2.1.1') }}" rel="stylesheet" />  --}}
    {{--  <link rel="stylesheet" type="text/css" href="{{ asset('css/reset.css') }}">  --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('css/general.css') }}">
    {{--  <link rel="stylesheet" type="text/css" href="{{ asset('css/menuDerecho.css') }}">  --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('css/equipos.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/sider.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/layout.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" rel="Stylesheet">


</head>

<body>
    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">
        {{--  Logo  --}}
        <div class="d-flex align-items-center justify-content-between">
            <a href="{{ url('home', session('id')) }}" class="logo d-flex align-items-center">
                <img src="{{ asset('img/login/logoQcem2.svg') }}" width="30%" alt="Q2Ces">
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div>
        {{--  End Logo  --}}

        {{--  Barra de busqueda  --}}
        {{--  <div class="search-bar">
            <form class="search-form d-flex align-items-center" method="POST" action="#">
                <input type="text" name="query" placeholder="Search" title="Enter search keyword">
                <button type="submit" title="Search"><i class="bi bi-search"></i></button>
            </form>
        </div>  --}}
        {{--  END Barra de busqueda  --}}

        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">

                <li class="nav-item d-block d-lg-none">
                    <a class="nav-link nav-icon search-bar-toggle " href="#">
                        <i class="bi bi-search"></i>
                    </a>
                </li>

                <li class="nav-item dropdown pe-3">

                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#"
                        data-bs-toggle="dropdown">
                        {{--  <img src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">  --}}
                        <span class="d-none d-md-block dropdown-toggle ps-2">{{ auth()->user()->name }}</span>
                    </a>
                    {{--  <!-- End Profile Iamge Icon -->  --}}

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6>{{ auth()->user()->name }}</h6>
                            {{--  <span>Web Designer</span>  --}}
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a href="{{ route('personal.cuenta') }}">
                                <button class="dropdown-item d-flex align-items-center" type="button" rel="tooltip">
                                    <i class="far fa-edit"></i>
                                    <span>Gestionar Cuenta</span>
                                </button>
                            </a>
                        </li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST" style="display: inline-block;"
                                onsubmit="return confirm('Seguro?')">
                                @csrf
                                <button class="dropdown-item d-flex align-items-center" type="submit" rel="tooltip">
                                    <i class="bi bi-box-arrow-right"></i>
                                    <span>Sign Out</span>
                                </button>
                            </form>
                        </li>

                    </ul>
                    {{--  <!-- End Profile Dropdown Items -->  --}}
                </li>
                {{--  < !-- End Profile Nav -->  --}}

            </ul>
        </nav>
        {{--  <!-- End Icons Navigation -->  --}}

    </header>
    <!-- End Header -->

    <!-- ======= Sidebar ======= -->
    {{--  {{ $activeItem = 'tickets' }}  --}}

    <aside id="sidebar" class="sidebar">

        <ul class="sidebar-nav" id="sidebar-nav">

            @can('calendario_show')
                <li class="nav-item collapsed">
                    <a class="nav-link {{ $activePage == 'calendario' ? '' : 'collapsed' }}"
                        href="{{ route('calendarioPrincipal.index') }}">
                        {{--  <i class="bi bi-shop"></i>  --}}
                        <span class="material-icons ">
                            calendar_month
                        </span>
                        <span>Calendario</span>
                    </a>
                </li>
            @endcan

            @can('asistencia_show')
                <li class="nav-item collapsed">
                    <a class="nav-link {{ $activePage == 'asistencia' ? '' : 'collapsed' }}"
                        href="{{ route('asistencia.index') }}">
                        {{--  <i class="bi bi-shop"></i>  --}}
                        <span class="material-icons">
                            event_available
                        </span>

                        <span>Nómina/Asistencia</span>
                    </a>
                </li>
            @endcan

            @can('cajachica_show')
                <li class="nav-item collapsed">
                    <a class="nav-link {{ $activePage == 'cajaChica' ? '' : 'collapsed' }}"
                        href="{{ route('cajaChica.index') }}">
                        {{--  <i class="bi bi-shop"></i>  --}}
                        <span class="material-icons">
                            currency_exchange
                        </span>
                        <span>Caja Chica</span>
                    </a>
                </li>
            @endcan

            @can('cajachica_show')
                <li class="nav-item collapsed">
                    <a class="nav-link {{ $activePage == 'servicios' ? '' : 'collapsed' }}"
                        href="{{ route('serviciosTrasporte.index') }}">
                        {{--  <i class="bi bi-shop"></i>  --}}
                        <span class="material-icons">
                            currency_exchange
                        </span>
                        <span>Servicios</span>
                    </a>
                </li>
            @endcan

            @can('combustible_index')

                <li class="nav-item ">
                    <a class="nav-link {{ $activePage == 'combustible' ? '' : 'collapsed' }}"
                        data-bs-target="#combustible-nav" data-bs-toggle="collapse" href="#">
                        {{--  <i class="bi bi-receipt"></i>  --}}
                        <span class="material-icons">
                            local_gas_station
                        </span>
                        <span>Combustible</span><i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="combustible-nav"
                        class="nav-content collapse {{ $activePage == 'combustible' ? 'show' : '' }}"
                        data-bs-parent="#sidebar-nav">
                        @can('combustible_index')
                            <li>
                                {{--  <a href="#" class="{{ $activeItem == 'newTicket' ? 'active' : '' }}">  --}}
                                <a href="{{ route('inventario.index', 'combustible') }}" class="">
                                    <i class="bi bi-circle"></i><span>Combustible Maquinaria</span>
                                </a>
                            </li>
                        @endcan
                        @can('combustible_index')
                            <li>
                                {{--  <a href="#" class="{{ $activeItem == 'newTicket' ? 'active' : '' }}">  --}}
                                <a href="{{ route('combustibleTote.index') }}" class="">
                                    <i class="bi bi-circle"></i><span>Combustible TOTE</span>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan

            @can('mantenimiento_index')
                <li class="nav-item ">
                    <a class="nav-link {{ $activePage == 'mantenimiento' ? '' : 'collapsed' }}"
                        data-bs-target="#mantenimiento-nav" data-bs-toggle="collapse" href="#">
                        {{--  <i class="bi bi-receipt"></i>  --}}
                        <span class="material-icons">
                            build
                        </span>
                        <span>Mantenimientos</span><i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="mantenimiento-nav"
                        class="nav-content collapse {{ $activePage == 'mantenimiento' ? 'show' : '' }}"
                        data-bs-parent="#sidebar-nav">
                        @can('mantenimiento_index')
                            <li>
                                {{--  <a href="#" class="{{ $activeItem == 'newTicket' ? 'active' : '' }}">  --}}
                                <a href="{{ url('/mantenimientos') }}" class="">
                                    <i class="bi bi-circle"></i><span>Ver Mantenimientos</span>
                                </a>
                            </li>
                        @endcan
                        @can('mantenimiento_create')
                            <li>
                                {{--  <a href="#" class="{{ $activeItem == 'newTicket' ? 'active' : '' }}">  --}}
                                <a href="{{ url('/mantenimientos/nuevo') }}" class="">
                                    <i class="bi bi-circle"></i><span>Nuevo Mantenimeinto</span>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan

            @can('bitacora_index')
                <li class="nav-item ">
                    <a class="nav-link {{ $activePage == 'bitacoras' ? '' : 'collapsed' }}"
                        data-bs-target="#bitacora-nav" data-bs-toggle="collapse" href="#">
                        {{--  <i class="bi bi-receipt"></i>  --}}
                        <span class="material-icons">
                            fact_check
                        </span>

                        <span>Bitácoras y Check List</span><i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="bitacora-nav" class="nav-content collapse {{ $activePage == 'bitacoras' ? 'show' : '' }}"
                        data-bs-parent="#sidebar-nav">

                        @can('checkList_show')
                            <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
                                <a href="{{ route('checkList.index') }}" class="">
                                    <i class="bi bi-circle"></i><span>Ver CheckList</span>
                                </a>
                            </li>
                        @endcan
                        @can('bitacora_index')
                            <li>
                                {{--  <a href="{{ url('/indexBitacora') }}"
                                    class="{{ $activeItem == 'bitacoras' ? 'active' : '' }}">  --}}
                                <a href="{{ route('bitacoras.index') }}" class="">
                                    <i class="bi bi-circle"></i><span>Ver Bitácoras</span>
                                </a>
                            </li>
                        @endcan
                        @can('grupo_index')
                            <li>
                                {{--  <a href="{{ url('/indexGrupos') }}" class="{{ $activeItem == 'grupos' ? 'active' : '' }}">  --}}
                                <a href="{{ route('grupo.index') }}" class="">
                                    <i class="bi bi-circle"></i><span>Ver Grupos</span>
                                </a>
                            </li>
                        @endcan
                        @can('tarea_index')
                            <li>
                                {{--  <a href="{{ url('/tareas') }}" class="{{ $activeItem == 'tareas' ? 'active' : '' }}">  --}}
                                <a href="{{ route('tarea.index') }}" class="">
                                    <i class="bi bi-circle"></i><span>Ver Tareas</span>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan

            @can('maquinaria_index')
                <li class="nav-item ">
                    <a class="nav-link {{ $activePage == 'maquinaria' ? '' : 'collapsed' }}"
                        data-bs-target="#maquinaria-nav" data-bs-toggle="collapse" href="#">
                        {{--  <i class="bi bi-receipt"></i>  --}}
                        <span class="material-icons">
                            agriculture
                        </span>

                        <span>Maquinaria y Accesorios</span><i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="maquinaria-nav" class="nav-content collapse {{ $activePage == 'maquinaria' ? 'show' : '' }}"
                        data-bs-parent="#sidebar-nav">
                        @can('maquinaria_index')
                            <li>
                                {{--  <a href="#" class="{{ $activeItem == 'newTicket' ? 'active' : '' }}">  --}}
                                <a href="{{ route('maquinaria.index') }}" class="">
                                    <i class="bi bi-circle"></i><span>Ver Maquinaria</span>
                                </a>
                            </li>
                        @endcan
                        @can('maquinaria_create')
                            <li>
                                {{--  <a href="#" class="{{ $activeItem == 'newTicket' ? 'active' : '' }}">  --}}
                                <a href="{{ route('maquinaria.create') }}" class="">
                                    <i class="bi bi-circle"></i><span>Alta De Maquinaria</span>
                                </a>
                            </li>
                        @endcan
                        @can('maquinaria_index')
                            <li>
                                {{--  <a href="#" class="{{ $activeItem == 'newTicket' ? 'active' : '' }}">  --}}
                                <a href="{{ route('accesorios.index') }}" class="">
                                    <i class="bi bi-circle"></i><span>Ver Accesorios</span>
                                </a>
                            </li>
                        @endcan
                        @can('maquinaria_create')
                            <li>
                                {{--  <a href="#" class="{{ $activeItem == 'newTicket' ? 'active' : '' }}">  --}}
                                <a href="{{ route('accesorios.create') }}" class="">
                                    <i class="bi bi-circle"></i><span>Alta De Accesorio</span>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan

            @can('personal_index')
                <li class="nav-item ">
                    <a class="nav-link {{ $activePage == 'personal' ? '' : 'collapsed' }}" data-bs-target="#personal-nav"
                        data-bs-toggle="collapse" href="#">
                        {{--  i class="bi bi-receipt"></i>  --}}
                        <span class="material-icons">
                            person
                        </span>

                        <span>Personal</span><i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="personal-nav" class="nav-content collapse {{ $activePage == 'personal' ? 'show' : '' }}"
                        data-bs-parent="#sidebar-nav">
                        @can('personal_index')
                            <li>
                                {{--  <a href="#" class="{{ $activeItem == 'newTicket' ? 'active' : '' }}">  --}}
                                <a href="{{ route('personal.index') }}" class="">
                                    <i class="bi bi-circle"></i><span>Ver Personal</span>
                                </a>
                            </li>
                        @endcan
                        @can('personal_create')
                            <li>
                                {{--  <a href="#" class="{{ $activeItem == 'newTicket' ? 'active' : '' }}">  --}}
                                <a href="{{ route('personal.create') }}" class="">
                                    <i class="bi bi-circle"></i><span>Alta De Personal</span>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan

            @can('inventario_show')
                <li class="nav-item collapsed">
                    <a class="nav-link {{ $activePage == 'inventario' ? '' : 'collapsed' }}"
                        href="{{ route('inventario.dash') }}">
                        {{--  <i class="bi bi-shop"></i>  --}}
                        <span class="material-icons">
                            shelves
                        </span>
                        <span>Inventario</span>
                    </a>
                </li>
            @endcan

            @can('maquinaria_mtq_dash')

                <li class="nav-item ">
                    <a class="nav-link {{ $activePage == 'mtq' ? '' : 'collapsed' }}" data-bs-target="#mtq-nav"
                        data-bs-toggle="collapse" href="#">
                        {{--  <i class="bi bi-receipt"></i>  --}}
                        <span class="material-icons">
                            apartment
                        </span>
                        <span>MTQ</span><i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="mtq-nav" class="nav-content collapse {{ $activePage == 'mtq' ? 'show' : '' }}"
                        data-bs-parent="#sidebar-nav">
                        @can('calendario_mtq_index')
                            <li>
                                {{--  <a href="#" class="{{ $activeItem == 'newTicket' ? 'active' : '' }}">  --}}
                                <a href="{{ route('calendarioMtq.index') }}" class="">
                                    {{--  <a href="#" class="">  --}}

                                    <i class="bi bi-circle"></i><span>Calendario</span>
                                </a>
                            </li>
                        @endcan

                        @can('maquinaria_mtq_index')
                            <li>
                                {{--  <a href="#" class="{{ $activeItem == 'newTicket' ? 'active' : '' }}">  --}}
                                <a href="{{ route('uso.index') }}" class="">
                                    <i class="bi bi-circle"></i><span>Uso de Equipo</span>
                                </a>
                            </li>
                        @endcan

                        @can('maquinaria_mtq_index')
                            <li>
                                {{--  <a href="#" class="{{ $activeItem == 'newTicket' ? 'active' : '' }}">  --}}
                                <a href="{{ route('mtq.index') }}" class="">
                                    <i class="bi bi-circle"></i><span>Equipo MTQ</span>
                                </a>
                            </li>
                        @endcan

                        @can('residente_mtq_index')
                            <li>
                                {{--  <a href="#" class="{{ $activeItem == 'newTicket' ? 'active' : '' }}">  --}}
                                <a href="{{ route('residentes.index') }}" class="">
                                    <i class="bi bi-circle"></i><span>Residentes</span>
                                </a>
                            </li>
                        @endcan
                        @can('inventario_mtq_index')
                            <li>
                                {{--  <a href="#" class="{{ $activeItem == 'newTicket' ? 'active' : '' }}">  --}}
                                <a href="{{ route('inventarioMtq.dash') }}" class="">
                                    <i class="bi bi-circle"></i><span>Inventario</span>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan

            @can('obra_index')
                <li class="nav-item ">
                    <a class="nav-link {{ $activePage == 'obra' ? '' : 'collapsed' }}" data-bs-target="#obra-nav"
                        data-bs-toggle="collapse" href="#">
                        {{--  <i class="bi bi-receipt"></i>  --}}
                        <span class="material-icons">
                            construction
                        </span>
                        <span>Obras</span><i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="obra-nav" class="nav-content collapse {{ $activePage == 'obra' ? 'show' : '' }}"
                        data-bs-parent="#sidebar-nav">
                        @can('obra_index')
                            <li>
                                {{--  <a href="#" class="{{ $activeItem == 'newTicket' ? 'active' : '' }}">  --}}
                                <a href="{{ route('obras.index') }}" class="">
                                    <i class="bi bi-circle"></i><span>Ver Obras</span>
                                </a>
                            </li>
                        @endcan
                        @can('obra_create')
                            <li>
                                {{--  <a href="#" class="{{ $activeItem == 'newTicket' ? 'active' : '' }}">  --}}
                                <a href="{{ route('obras.create') }}" class="">
                                    <i class="bi bi-circle"></i><span>Nuevo Obra</span>
                                </a>
                            </li>
                        @endcan

                        @can('cliente_create')
                            <li>
                                {{--  <a href="#" class="{{ $activeItem == 'newTicket' ? 'active' : '' }}">  --}}
                                <a href="{{ route('clientes.index') }}" class="">
                                    <i class="bi bi-circle"></i><span>Clientes</span>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan

            @can('catalogos_show')
                <li class="nav-item collapsed">
                    <a class="nav-link {{ $activePage == 'equipos' ? '' : 'collapsed' }}"
                        href="{{ route('catalogos.index') }}">
                        {{--  <i class="bi bi-shop"></i>  --}}
                        <span class="material-icons">
                            print
                        </span>
                        <span>Catálogos</span>
                    </a>
                </li>
            @endcan

            @can('user_show')
                <li class="nav-item ">
                    <a class="nav-link {{ $activePage == 'usuarios' ? '' : 'collapsed' }}" data-bs-target="#user-nav"
                        data-bs-toggle="collapse" href="#">
                        {{--  <i class="bi bi-receipt"></i>  --}}
                        <span class="material-icons">
                            pan_tool
                        </span>
                        <span>Roles y Permisos</span><i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="user-nav" class="nav-content collapse {{ $activePage == 'usuarios' ? 'show' : '' }}"
                        data-bs-parent="#sidebar-nav">
                        @can('user_create')
                            <li>
                                <a href="{{ route('users.index') }}" class="">
                                    <i class="bi bi-circle"></i><span>Ver Usuario</span>
                                </a>
                            </li>
                        @endcan
                        @can('user_create')
                            <li>
                                {{--  <a href="#" class="{{ $activeItem == 'newTicket' ? 'active' : '' }}">  --}}
                                <a href="{{ route('roles.index') }}" class="">
                                    <i class="bi bi-circle"></i><span>Ver Roles</span>
                                </a>
                            </li>
                        @endcan
                        @can('permission_create')
                            <li>
                                {{--  <a href="#" class="{{ $activeItem == 'newTicket' ? 'active' : '' }}">  --}}
                                <a href="{{ route('permissions.index') }}" class="">
                                    <i class="bi bi-circle"></i><span>Ver Permisos</span>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan

        </ul>

    </aside>
    <!-- End Sidebar-->


    <main id="main" class="main">
        @yield('content')
    </main>

    <!-- End main -->
    <div class="mb-5" id="spinner-container"></div>
    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        <div class="copyright">
            &copy; Copyright <strong><span>Q2Ces</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
            Designed by <a href="#">Q2Ces Developer Team</a>
        </div>
    </footer>
    <!-- End Footer -->

    <!--   Core JS Files   -->
    <script src="{{ asset('js/core/jquery.min.js') }}"></script>
    <script src="{{ asset('js/core/popper.min.js') }}"></script>
    <script src="{{ asset('js/core/bootstrap-material-design.min.js') }}"></script>
    <script src="{{ asset('js/plugins/perfect-scrollbar.jquery.min.js') }}"></script>
    {{--  <script src="{{ asset('js/material-dashboard.js') }}" type="text/javascript"></script>  --}}
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous">
    </script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/alertas.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>

    @stack('js')
</body>

</html>
