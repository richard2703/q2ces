<div class="sidebar sidebarDerecha" data-image="{{ asset('material') }}/img/sidebar-1.jpg">

    <div class="logo">
        <a href="{{ url('dashboard', session('id')) }}"class="nav-item{{ $activePage == 'dashboard' ? ' active' : '' }}">
            <img src="{{ asset('img/login/logoQcem2.svg') }}" class="mx-auto d-block " width="30%">
        </a>
    </div>

    <div class="sidebar-wrapper">
        <ul class="nav">
            <!-- inicio de colapsable -->

            <li class="nav-item {{ $activePage == 'dashboard' || $activePage == 'user-management' ? ' active' : '' }}">
                <a href="#equipo" class="nav-link p-2" data-toggle="collapse" aria-expanded="false">
                    <i><img class="imgMenu" style="width:25px" src="{{ asset('/img/navs/eqiposMenu.svg') }}"></i>
                    <p>{{ __('Equipos') }}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse " id="equipo">
                    <ul class="nav">
                        <li class="nav-item{{ $activePage == 'profile' ? ' active' : '' }}">
                            <a
                                href="{{ url('verEquipos', session('id')) }}"class="nav-link nav-item{{ $activePage == 'equipos' ? ' active' : '' }} ">
                                <span class="py-2 ps-5 sidebar-normal">{{ __('Ver Equipo') }} </span>
                            </a>
                        </li>

                        <!--no colapsable>-->
                        <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
                            <a class="nav-link py-2 ps-5" href="#">

                                <span class="sidebar-normal"> {{ __('Alta de Equipo') }} </span>
                            </a>
                        </li>

                        <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
                            <a class="nav-link py-2 ps-5" href="#">

                                <span class="sidebar-normal"> {{ __('Accesorios') }} </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item {{ $activePage == 'personal' || $activePage == 'user-management' ? ' active' : '' }}">
                <a class="nav-link p-2" data-toggle="collapse" href="#personal" aria-expanded="false">
                    <i><img style="width:25px" src="{{ asset('/img/navs/personalMenu.svg') }}"></i>
                    <p>{{ __('Personal') }}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse " id="personal">
                    <ul class="nav">
                        <li class="nav-item{{ $activePage == 'profile' ? ' active' : '' }}">
                            <a
                                href="{{ route('personal.index') }}"class="nav-link -item{{ $activePage == 'personal' ? ' active' : '' }} ">
                                <span class="sidebar-normal py-2 ps-5">{{ __('Ver Personal') }} </span>
                            </a>
                        </li>

                        <!--no colapsable>-->
                        <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
                            <a
                                href="{{ url('altaDePersonal', session('id')) }}"class="nav-link -item{{ $activePage == 'personal' ? ' active' : '' }} ">
                                <span class="sidebar-normal py-2 ps-5"> {{ __('Alta de Personal') }} </span>
                            </a>
                        </li>
                        <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
                            <a class="nav-link py-2 ps-5" href="#">

                                <span class="sidebar-normal"> {{ __('Contraseña') }} </span>
                            </a>
                        </li>


                    </ul>
                </div>
            </li>

            <li class="nav-item {{ $activePage == 'obra' || $activePage == 'user-management' ? ' active' : '' }}">
                <a class="nav-link p-2" data-toggle="collapse" href="#obras" aria-expanded="false">
                    <i><img style="width:25px" src="{{ asset('/img/navs/obrasMenu.svg') }}"></i>
                    <p>{{ __('Obra') }}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse " id="obras">
                    <ul class="nav">
                        <li class="nav-item{{ $activePage == 'profile' ? ' active' : '' }}">
                            <a
                                href="{{ route('obras.index', session('id')) }}"class="nav-link -item{{ $activePage == 'obra' ? ' active' : '' }} ">
                                <span class="sidebar-normal py-2 ps-5">{{ __('Ver Obras') }} </span>
                            </a>
                        </li>

                        <!--no colapsable>-->
                        <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
                            <a
                                href="{{ url('altaObra', session('id')) }}"class="nav-link -item{{ $activePage == 'obra' ? ' active' : '' }} ">
                                <span class="sidebar-normal py-2 ps-5"> {{ __('Alta de Obra') }} </span>
                            </a>
                        </li>

                        <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
                            <a class="nav-link py-2 ps-5" href="#">
                                <span class="sidebar-normal"> {{ __('Asignación de Obra') }} </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item {{ $activePage == 'profile' || $activePage == 'user-management' ? ' active' : '' }}">
                <a class="nav-link p-2" data-toggle="collapse" href="#bitacorass" aria-expanded="false">
                    <i><img style="width:25px" src="{{ asset('/img/navs/bitacorasMenu.svg') }}"></i>
                    <p>{{ __('Bitácoras / Reportes') }}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse " id="bitacoras">
                    <ul class="nav">
                        <li class="nav-item{{ $activePage == 'profile' ? ' active' : '' }}">
                            <a class="nav-link py-2 ps-5" href="#">
                                <span class="sidebar-normal">{{ __('Obra') }} </span>
                            </a>
                        </li>

                        <!--no colapsable>-->
                        <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
                            <a class="nav-link py-2 ps-5" href="#">
                                <span class="sidebar-normal"> {{ __('Ver Obra') }} </span>
                            </a>
                        </li>

                        <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
                            <a class="nav-link py-2 ps-5" href="#">
                                <span class="sidebar-normal"> {{ __('Alta de Obra') }} </span>
                            </a>
                        </li>

                        <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
                            <a class="nav-link py-2 ps-5" href="#">
                                <span class="sidebar-normal"> {{ __('Asignación de Obra') }} </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item {{ $activePage == 'profile' || $activePage == 'user-management' ? ' active' : '' }}">
                <a class="nav-link p-2" data-toggle="collapse" href="#formatoss" aria-expanded="false">
                    <i><img style="width:25px" src="{{ asset('/img/navs/formatosMenu.svg') }}"></i>
                    <p>{{ __('Formatos') }}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse " id="formatos">
                    <ul class="nav">
                        <li class="nav-item{{ $activePage == 'profile' ? ' active' : '' }}">
                            <a class="nav-link py-2 ps-5" href="#">
                                <span class="sidebar-normal">{{ __('Obra') }} </span>
                            </a>
                        </li>

                        <!--no colapsable>-->
                        <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
                            <a class="nav-link py-2 ps-5" href="#">
                                <span class="sidebar-normal"> {{ __('Ver Obra') }} </span>
                            </a>
                        </li>

                        <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
                            <a class="nav-link py-2 ps-5" href="#">
                                <span class="sidebar-normal"> {{ __('Alta de Obra') }} </span>
                            </a>
                        </li>

                        <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
                            <a class="nav-link py-2 ps-5" href="#">
                                <span class="sidebar-normal"> {{ __('Asignación de Obra') }} </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

        </ul>
    </div>
</div>
