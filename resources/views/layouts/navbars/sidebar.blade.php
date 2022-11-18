<div class="sidebar sidebarDerecha barra-lateral" data-image="{{ asset('material') }}/img/sidebar-1.jpg">

    <div class="logo">
        <a href="{{ url('dashboard', session('id')) }}"class="nav-item{{ $activePage == 'dashboard' ? ' active' : '' }}">
            <img src="{{ asset('img/login/logoQcem2.svg') }}" class="mx-auto d-block " width="30%">
        </a>
    </div>

    <div class="sidebar-wrapper menu">
        <ul class="nav">
            <!-- inicio de colapsable -->

            <li class="nav-item {{ $activePage == 'dashboard' || $activePage == 'user-management' ? ' active' : '' }}">
                <a href="#equipo" class="nav-link p-2" data-toggle="collapse" aria-expanded="false">

                    <svg class="iconMenu " style="width:25px" id="Capa_1" data-name="Capa 1"
                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 36 40">
                        <defs>
                        </defs>
                        <g id="Capa_2" data-name="Capa 2">
                            <g id="Capa_5" data-name="Capa 5">
                                <path class="cls-1"
                                    d="M25.43,0H15a1.38,1.38,0,0,0-1.36,1.25l-.93,19.31H10.3V15a1,1,0,0,0-1-1h0a1,1,0,0,0-1,1v5.53h-1V16.89a.71.71,0,0,0-.7-.72h0a.71.71,0,0,0-.7.72h0v3.67H5a1.16,1.16,0,0,0-1.15,1l-.79,5.5a6.89,6.89,0,0,1,3.32-.85,7.11,7.11,0,0,1,7,7.2v.49h3.79a11,11,0,0,1-.52-3.31A10.31,10.31,0,0,1,26.8,20.16V1.41A1.39,1.39,0,0,0,25.43,0Zm-.71,17.79a1.37,1.37,0,0,1-1.07,1.36,10.32,10.32,0,0,0-7.43,6.37.94.94,0,0,1-.85.59h-.46a.94.94,0,0,1-.92-1s0-.06,0-.09L15.22,3.15A1.39,1.39,0,0,1,16.58,1.9h6.77a1.39,1.39,0,0,1,1.37,1.41h0ZM7.46,33.42a1.05,1.05,0,1,1-1-1.08h0A1.06,1.06,0,0,1,7.46,33.42Zm5.36-1v2.06a.4.4,0,0,1-.38.39h0a.4.4,0,0,0-.37.28,6.26,6.26,0,0,1-.48,1.2.39.39,0,0,0,.06.47h0a.4.4,0,0,1,0,.56L10.23,38.8a.38.38,0,0,1-.54,0h0a.38.38,0,0,0-.45-.07,5.5,5.5,0,0,1-1.17.5.4.4,0,0,0-.28.38h0a.4.4,0,0,1-.38.39h-2A.38.38,0,0,1,5,39.63v0H5a.4.4,0,0,0-.28-.38,5.5,5.5,0,0,1-1.17-.5.38.38,0,0,0-.45.07h0a.39.39,0,0,1-.55,0L1.17,37.35a.4.4,0,0,1,0-.56h0a.39.39,0,0,0,.06-.47,6.26,6.26,0,0,1-.48-1.2.4.4,0,0,0-.37-.28h0A.4.4,0,0,1,0,34.45V32.39A.4.4,0,0,1,.38,32h0a.4.4,0,0,0,.37-.28,6.26,6.26,0,0,1,.48-1.2.39.39,0,0,0-.06-.47h0a.4.4,0,0,1,0-.56L2.58,28a.39.39,0,0,1,.55,0,.38.38,0,0,0,.45.07,5.5,5.5,0,0,1,1.17-.5A.41.41,0,0,0,5,27.23H5a.38.38,0,0,1,.37-.39h2a.38.38,0,0,1,.38.38h0a.4.4,0,0,0,.28.38,5.5,5.5,0,0,1,1.17.5A.37.37,0,0,0,9.69,28h0a.38.38,0,0,1,.54,0h0l1.42,1.45a.4.4,0,0,1,0,.56h0a.39.39,0,0,0-.06.47,6.26,6.26,0,0,1,.48,1.2.4.4,0,0,0,.37.28h0a.38.38,0,0,1,.38.4v.06Zm-3.42,1a3,3,0,0,0-2.93-3.07H6.4a3.07,3.07,0,1,0,0,6.14,3,3,0,0,0,3-3Zm19-2.82a1.51,1.51,0,1,1-1.5-1.54,1.52,1.52,0,0,1,1.5,1.54ZM36,29.14v2.93a.55.55,0,0,1-.54.56h0a.55.55,0,0,0-.52.41,8.74,8.74,0,0,1-.69,1.71.58.58,0,0,0,.09.67h0a.57.57,0,0,1,0,.79l-2,2.08a.55.55,0,0,1-.77,0,.55.55,0,0,0-.66-.1,7.83,7.83,0,0,1-1.66.71.56.56,0,0,0-.4.54h0a.55.55,0,0,1-.54.56H25.42a.56.56,0,0,1-.55-.56h0a.56.56,0,0,0-.4-.54,7.83,7.83,0,0,1-1.66-.71.53.53,0,0,0-.65.1.56.56,0,0,1-.78,0l-2-2.08a.57.57,0,0,1,0-.79h0a.56.56,0,0,0,.09-.67,9.13,9.13,0,0,1-.7-1.75.56.56,0,0,0-.53-.41h0a.56.56,0,0,1-.55-.56V29.14a.56.56,0,0,1,.55-.56h0a.56.56,0,0,0,.53-.41,9.67,9.67,0,0,1,.68-1.71.56.56,0,0,0-.09-.67.57.57,0,0,1,0-.79l2-2.08a.54.54,0,0,1,.76,0l0,0a.53.53,0,0,0,.65.09,8.35,8.35,0,0,1,1.66-.7.56.56,0,0,0,.4-.54h0a.56.56,0,0,1,.55-.56h2.86a.55.55,0,0,1,.54.56h0a.56.56,0,0,0,.4.54,8.35,8.35,0,0,1,1.66.7.56.56,0,0,0,.66-.09.53.53,0,0,1,.75,0l0,0,2,2.08a.57.57,0,0,1,0,.79h0a.58.58,0,0,0-.09.67,8.74,8.74,0,0,1,.69,1.71.55.55,0,0,0,.52.41h0a.56.56,0,0,1,.59.51ZM31.12,30.6A4.27,4.27,0,1,0,26.85,35a4.31,4.31,0,0,0,4.27-4.37Z"
                                    transform="translate(0)" />
                            </g>
                        </g>
                    </svg>



                    <!--<i><img class="imgMenu" style="width:25px" src="{{ asset('/img/navs/eqiposMenu.svg') }}"></i>-->
                    <p>{{ __('Equipos') }}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse " id="equipo">
                    <ul class="nav">
                        <li class="nav-item{{ $activePage == 'profile' ? ' active' : '' }}">
                            <a
                                href="{{ route('maquinaria.index') }}"class="nav-link nav-item{{ $activePage == 'equipos' ? ' active' : '' }} ">
                                <span class="py-2 ps-5 sidebar-normal">{{ __('Ver Equipo') }} </span>
                            </a>
                        </li>

                        <!--no colapsable>-->
                        <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
                            <a
                                href="{{ route('maquinaria.create') }}"class="nav-link nav-item{{ $activePage == 'equipos' ? ' active' : '' }} ">
                                <span class="sidebar-normal py-2 ps-5"> {{ __('Alta de Equipo') }} </span>
                            </a>
                        </li>

                        <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
                            <a
                                href="{{ route('accesorios.index') }}"class="nav-link nav-item{{ $activePage == 'equipos' ? ' active' : '' }} ">
                                <span class="sidebar-normal py-2 ps-5"> {{ __('Ver Accesorios') }} </span>
                            </a>
                        </li>

                        <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
                            <a
                                href="{{ route('accesorios.create') }}"class="nav-link nav-item{{ $activePage == 'equipos' ? ' active' : '' }} ">
                                <span class="sidebar-normal py-2 ps-5"> {{ __('Alta de Accesorios') }} </span>
                            </a>
                        </li>

                    </ul>
                </div>
            </li>
            <!------ PERSONAL ------>
            <li class="nav-item {{ $activePage == 'personal' || $activePage == 'user-management' ? ' active' : '' }}">
                <a class="nav-link p-2 " data-toggle="collapse" href="#personal" aria-expanded="false">
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
                                href="{{ route('personal.create') }}"class="nav-link -item{{ $activePage == 'personal' ? ' active' : '' }} ">
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

            <!------ INVENTARIO ------>

            <li class="nav-item {{ $activePage == 'profile' || $activePage == 'user-management' ? ' active' : '' }}">
                <a
                    href="{{ route('inventario.dash') }}"class="nav-link -item{{ $activePage == 'obra' ? ' active' : '' }} ">
                    <i><img style="width:25px" src="{{ asset('/img/navs/bitacorasMenu.svg') }}"></i>
                    <p> {{ __('inventario') }} </p>
                    {{--  <b class="caret"></b>  --}}
                </a>
            </li>

            <!------ OBRA ------>
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
                                href="{{ route('obras.index') }}"class="nav-link -item{{ $activePage == 'obra' ? ' active' : '' }} ">
                                <span class="sidebar-normal py-2 ps-5">{{ __('Ver Obras') }} </span>
                            </a>
                        </li>

                        <!--no colapsable>-->
                        <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
                            <a
                                href="{{ route('obras.create') }}"class="nav-link -item{{ $activePage == 'obra' ? ' active' : '' }} ">
                                <span class="sidebar-normal py-2 ps-5"> {{ __('Alta de Obra') }} </span>
                            </a>
                        </li>

                        <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
                            <a class="nav-link py-2 ps-5" href="#">
                                <span class="sidebar-normal py-2 ps-5"> {{ __('Asignación de Obra') }} </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <!------ BITÁCORAS ------>
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
                                <span class="sidebar-normal py-2 ps-5"> {{ __('Asignación de Obra') }} </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <!------ FORMATOS ------>
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
                                <span class="sidebar-normal "> {{ __('Alta de Obra') }} </span>
                            </a>
                        </li>

                        <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
                            <a class="nav-link py-2 ps-5" href="#">
                                <span class="sidebar-normal py-2 ps-5"> {{ __('Asignación de Obra') }} </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

        </ul>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


<script>
    $('.nav-item').on('mouseover', function() {

        $(this).css({

            'fill': '#fff'

        });

    });
</script>
