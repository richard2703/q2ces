<div class="sidebar sidebarDerecha barra-lateral" data-image="{{ asset('material') }}/img/sidebar-1.jpg">

    <div class="logo">
        <a href="{{ url('home', session('id')) }}"class="nav-item{{ $activePage == 'dashboard' ? ' active' : '' }}">
            <img src="{{ asset('img/login/logoQcem2.svg') }}" class="mx-auto d-block " width="30%">
        </a>
    </div>

    <div class="sidebar-wrapper menu">
        <ul class="nav sidebar-nav">

            <!-- 1 Calendario -->
            @can('calendario_show')
                <li class="nav-item {{ $activePage == 'calendario' || $activePage == 'user-management' ? ' active' : '' }}">
                    <a href="{{ url('calendario') }}" onmouseover="cambiar1();" onmouseout="volver1();"
                        class="nav-link -item{{ $activePage == 'calendario' ? ' active' : '' }} ">
                        <i><img id="cambiaBCO1" style="width:25px"
                                src="{{ $activePage == 'calendario' ? ' /img/navs/calendarioBco.svg' : '/img/navs/calendario.svg' }}"></i>
                        <p> {{ __('calendario') }} </p>

                    </a>
                </li>
            @endcan

            <!-- 3 Asistencia -->
            @can('asistencia_show')
                <li class="nav-item {{ $activePage == 'asistencia' || $activePage == 'user-management' ? ' active' : '' }}">
                    <a href="{{ route('asistencia.index') }}" onmouseover="cambiar3();" onmouseout="volver3();"
                        class="nav-link -item{{ $activePage == 'asistencia' ? ' active' : '' }} ">
                        <i><img id="cambiaBCO3"
                                src="{{ $activePage == 'asistencia' ? '/img/navs/asistenciaBco.svg' : '/img/navs/asistencia.svg' }}"
                                style="width:25px"></i>
                        <p>{{ __('Asistencia') }}
                            <!--<b class="caret"></b>-->
                        </p>
                    </a>
                </li>
            @endcan

            <!------ 2 Caja Chica ------>
            @can('cajachica_show')
                <li class="nav-item {{ $activePage == 'cajachica' || $activePage == 'user-management' ? ' active' : '' }}">
                    <a class="nav-link" href="{{ route('cajaChica.index') }}" onmouseover="cambiar2();"
                        onmouseout="volver2();" class="nav-link -item{{ $activePage == 'cajachica' ? ' active' : '' }} ">
                        <i><img id="cambiaBCO2" style="width:25px"
                                src="{{ $activePage == 'cajaChica' ? '/img/navs/cajaChicaBco.svg' : '/img/navs/cajaChica.svg' }}"></i>
                        <p> {{ __('Caja chica') }} </p>
                        {{--  <b class="caret"></b>  --}}
                    </a>
                </li>
            @endcan

            <!------ 11 INVENTARIO ------>
            @can('inventario_show')
                <li
                    class="nav-item {{ $activePage == 'inventario' || $activePage == 'user-management' ? ' active' : '' }}">
                    <a href="{{ route('inventario.dash') }}" onmouseover="cambiar11();" onmouseout="volver11();"
                        class="nav-link -item{{ $activePage == 'obra' ? ' active' : '' }} ">
                        <i><img id="cambiaBCO11" style="width:25px"
                                src="{{ $activePage == 'inventario' ? '/img/navs/inventariomenubco.svg' : '/img/navs/inventariomenu.svg' }}"></i>
                        <p> {{ __('inventario') }} </p>
                        {{--  <b class="caret"></b>  --}}
                    </a>
                </li>
            @endcan

            {{--  <!------ 4 Tareas ------>
            <li class="nav-item {{ $activePage == 'tareas' || $activePage == 'user-management' ? ' active' : '' }}">
                <a class="nav-link py-2 ps-5" href="{{ url('/tareas') }}" onmouseover="cambiar4();"
                    onmouseout="volver4();" class="nav-link -item{{ $activePage == 'tareas' ? ' active' : '' }} ">
                    <i><img id="cambiaBCO4" style="width:25px"
                            src="{{ $activePage == 'tareas' ? '/img/navs/tareasBco.svg' : '/img/navs/tareas.svg' }}"></i>
                    <p> {{ __('Tareas') }} </p>
                </a>
            </li>  --}}

            {{--  <!------ 5 Check List ------>
            <li class="nav-item {{ $activePage == 'checkList' || $activePage == 'user-management' ? ' active' : '' }}">
                <a class="nav-link p-2 " onmouseover="cambiar5();" onmouseout="volver5();" data-toggle="collapse"
                    href="#checkList" aria-expanded="false">
                    <i><img id="cambiaBCO5" style="width:25px"
                            src="{{ $activePage == 'checkList' ? '/img/navs/checkListBco.svg' : '/img/navs/checkList.svg' }}"></i>
                    <p>{{ __('Check List') }}
                        <b class="caret"></b>
                    </p>
                </a>
                <!--no colapsable>-->
                <div class="collapse " id="checkList">
                    <ul class="nav">
                        <li class="nav-item{{ $activePage == 'profile' ? ' active' : '' }}">
                            <a href="{{ url('/checkList') }}"
                                class="nav-link -item{{ $activePage == 'checkList' ? ' active' : '' }} ">
                                <span class="sidebar-normal py-2 ps-5">{{ __('Ver Check List') }} </span>
                            </a>
                            <!--no colapsable>-->
                            <div class="collapse " id="checkList">
                                <ul class="nav">
                                    <li class="nav-item{{ $activePage == 'profile' ? ' active' : '' }}">
                                        <a href="{{ url('/checkList') }}" class="nav-link -item{{ $activePage == 'checkList' ? ' active' : '' }} ">
                                            <span class="sidebar-normal py-2 ps-5">{{ __('Ver Check List') }} </span>
                                        </a>
                                    </li>


                                    <li class="nav-item{{ $activePage == 'profile' ? ' active' : '' }}">
                                        <a  href="{{ url('/nuevoCheckList') }}" class="nav-link -item{{ $activePage == 'nuevoCheckList' ? ' active' : '' }} ">
                                            <span class="sidebar-normal py-2 ps-5"> {{ __('Nueva Tarea') }} </span>
                                        </a>
                                    </li>

                                </ul>
                            </div>
                        </li>


                        <li class="nav-item{{ $activePage == 'profile' ? ' active' : '' }}">
                            <a href="{{ url('/nuevoCheckList') }}"
                                class="nav-link -item{{ $activePage == 'nuevoCheckList' ? ' active' : '' }} ">
                                <span class="sidebar-normal py-2 ps-5"> {{ __('Nueva Tarea') }} </span>
                            </a>
                        </li>

                    </ul>
                </div>
            </li>  --}}

            <!------ 6 Mantenimientos ------>
            @can('mantenimiento_show')
                <li
                    class="nav-item {{ $activePage == 'mantenimientos' || $activePage == 'user-management' ? ' active' : '' }}">
                    <a class="nav-link p-2 " onmouseover="cambiar6();" onmouseout="volver6();" data-toggle="collapse"
                        href="#mantenimientos" aria-expanded="false">
                        <i><img id="cambiaBCO6" style="width:25px"
                                src="{{ $activePage == 'mantenimientos' ? '/img/navs/mantenimientoBco.svg' : '/img/navs/mantenimiento.svg' }}"></i>
                        <p>{{ __('Mantenimientos') }}
                            <b class="caret"></b>
                        </p>
                    </a>
                    <!--no colapsable>-->
                    <div class="collapse " id="mantenimientos">
                        <ul class="nav">
                            @can('mantenimiento_show')
                                <li class="nav-item{{ $activePage == 'profile' ? ' active' : '' }}">
                                    <a
                                        href="{{ url('/mantenimientos') }}"class="nav-link -item{{ $activePage == 'mantenimientos' ? ' active' : '' }} ">
                                        <span class="sidebar-normal py-2 ps-5">{{ __('Ver Mantenimiento') }} </span>
                                    </a>
                                </li>
                            @endcan

                            @can('mantenimiento_create')
                                <li class="nav-item{{ $activePage == 'profile' ? ' active' : '' }}">
                                    <a href="{{ url('/nuevoMantenimiento') }}"
                                        class="nav-link -item{{ $activePage == 'nuevoMantenimiento' ? ' active' : '' }} ">
                                        <span class="sidebar-normal py-2 ps-5"> {{ __('Nuevo Mantemiento') }} </span>
                                    </a>
                                </li>
                            @endcan

                        </ul>
                    </div>
                </li>
            @endcan

            <!------ 7 Bitácoras / Reportes ------>
            @can('bitacora_show')
                <li class="nav-item {{ $activePage == 'bitacoras' || $activePage == 'user-management' ? ' active' : '' }}">
                    <a class="nav-link p-2" onmouseover="cambiar7();" onmouseout="volver7();" data-toggle="collapse"
                        href="#bitacoras" aria-expanded="false">
                        <i><img id="cambiaBCO7"
                                src="{{ $activePage == 'bitacoras' ? '/img/navs/bitacorasmenubco.svg' : '/img/navs/bitacorasmenu.svg' }}"
                                style="width:25px"></i>
                        <p>{{ __('Bitácoras') }}
                            <b class="caret"></b>
                        </p>
                    </a>
                    <!--no colapsable>-->
                    <div class="collapse " id="bitacoras">
                        <ul class="nav">

                            @can('checkList_show')
                                <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
                                    <a class="nav-link py-2 ps-5" href="{{ url('/checkList') }}">
                                        <span class="sidebar-normal py-2 ps-5"> {{ __('Ver CheckList') }} </span>
                                    </a
                                </li>
                            @endcan

                            @can('bitacora_show')
                                <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
                                    <a class="nav-link py-2 ps-5" href="{{ url('/bitacoras') }}">
                                        <span class="sidebar-normal py-2 ps-5"> {{ __('Ver Bitácoras') }} </span>
                                    </a
                                </li>
                            @endcan
                            @can('grupo_show')
                                <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
                                    <a class="nav-link py-2 ps-5" href="{{ url('/bitacoras/grupos') }}">
                                        <span class="sidebar-normal py-2 ps-5"> {{ __('Ver Grupos') }} </span>
                                    </a>
                                </li>
                            @endcan
                            @can('tarea_show')
                                <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
                                    <a class="nav-link py-2 ps-5" href="{{ url('/bitacoras/tareas') }}">
                                        <span class="sidebar-normal py-2 ps-5"> {{ __('Ver Tareas') }} </span>
                                    </a>
                                </li>
                            @endcan
                            {{--  <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
                            <a class="nav-link py-2 ps-5" href="{{ url('/nuevoBitacora') }}">
                                <span class="sidebar-normal py-2 ps-5"> {{ __('Nueva Registro Bitácora') }} </span>
                            </a>
                        </li>  --}}
                        </ul>
                    </div>
                </li>
            @endcan


            {{--  <!------ 8 Grupos------>
            <li class="nav-item {{ $activePage == 'grupos' || $activePage == 'user-management' ? ' active' : '' }}">
                <a class="nav-link p-2 " onmouseover="cambiar8();" onmouseout="volver8();" data-toggle="collapse"
                    href="#grupos" aria-expanded="false">
                    <i><img id="cambiaBCO8" style="width:25px"
                            src="{{ $activePage == 'grupos' ? '/img/navs/gruposBco.svg' : '/img/navs/grupos.svg' }}"></i>
                    <p>{{ __('Grupos') }}
                        <b class="caret"></b>
                    </p>
                </a>
                <!--no colapsable>-->
                <div class="collapse " id="grupos">
                    <ul class="nav">
                        <li class="nav-item{{ $activePage == 'profile' ? ' active' : '' }}">
                            <a href="{{ url('/indexGrupos') }}"
                                class="nav-link -item{{ $activePage == 'grupos' ? ' active' : '' }} ">
                                <span class="sidebar-normal py-2 ps-5">{{ __('Ver Grupos') }} </span>
                            </a>
                            <!--no colapsable>-->
                            <div class="collapse " id="grupos">
                                <ul class="nav">
                                    <li class="nav-item{{ $activePage == 'profile' ? ' active' : '' }}">
                                        <a href="{{ url('/indexGrupos') }}" class="nav-link -item{{ $activePage == 'grupos' ? ' active' : '' }} ">
                                            <span class="sidebar-normal py-2 ps-5">{{ __('Ver Grupos') }} </span>
                                        </a>
                                    </li>


                                    <li class="nav-item{{ $activePage == 'profile' ? ' active' : '' }}">
                                        <a  href="{{ url('/nuevoGrupo') }}" class="nav-link -item{{ $activePage == 'nuevoGrupo' ? ' active' : '' }} ">
                                            <span class="sidebar-normal py-2 ps-5"> {{ __('Nuevo Grupo') }} </span>
                                        </a>
                                    </li>

                                </ul>
                            </div>
                        </li>


                        <li class="nav-item{{ $activePage == 'profile' ? ' active' : '' }}">
                            <a href="{{ url('/nuevoGrupo') }}"
                                class="nav-link -item{{ $activePage == 'nuevoGrupo' ? ' active' : '' }} ">
                                <span class="sidebar-normal py-2 ps-5"> {{ __('Nuevo Grupo') }} </span>
                            </a>
                        </li>

                    </ul>
                </div>
            </li>  --}}

            <!-- 9 EQUIPOS -->
            @can('maquinaria_show')
                <li class="nav-item {{ $activePage == 'dashboard' || $activePage == 'user-management' ? ' active' : '' }}">
                    <a href="#equipo" onmouseover="cambiar9();" onmouseout="volver9();" class="nav-link p-2"
                        data-toggle="collapse" aria-expanded="false">
                        <i><img id="cambiaBCO9"
                                src="{{ $activePage == 'equipos' ? '/img/navs/eqiposmenubco.svg' : '/img/navs/eqiposmenu.svg' }}"
                                style="width:25px"> </i>
                        <p>{{ __('Equipos/Maquinaria') }}
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
                            @can('maquinaria_create')
                                <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
                                    <a
                                        href="{{ route('maquinaria.create') }}"class="nav-link nav-item{{ $activePage == 'equipos' ? ' active' : '' }} ">
                                        <span class="sidebar-normal py-2 ps-5"> {{ __('Alta de Equipo') }} </span>
                                    </a>
                                </li>
                            @endcan


                            <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
                                <a
                                    href="{{ route('accesorios.index') }}"class="nav-link nav-item{{ $activePage == 'equipos' ? ' active' : '' }} ">
                                    <span class="sidebar-normal py-2 ps-5"> {{ __('Ver Accesorios') }} </span>
                                </a>
                            </li>

                            @can('maquinaria_create')
                                <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
                                    <a
                                        href="{{ route('accesorios.create') }}"class="nav-link nav-item{{ $activePage == 'equipos' ? ' active' : '' }} ">
                                        <span class="sidebar-normal py-2 ps-5"> {{ __('Alta de Accesorios') }} </span>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </div>
                </li>
            @endcan

            <!------ 10 PERSONAL ------>
            @can('personal_show')
                <li class="nav-item {{ $activePage == 'personal' || $activePage == 'user-management' ? ' active' : '' }}">
                    <a class="nav-link p-2 " onmouseover="cambiar10();" onmouseout="volver10();" data-toggle="collapse"
                        href="#personal" aria-expanded="false">
                        <i><img id="cambiaBCO10" style="width:25px"
                                src="{{ $activePage == 'personal' ? '/img/navs/personalmenubco.svg' : '/img/navs/personalmenu.svg' }}"></i>
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
                            @can('personal_create')
                                <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
                                    <a
                                        href="{{ route('personal.create') }}"class="nav-link -item{{ $activePage == 'personal' ? ' active' : '' }} ">
                                        <span class="sidebar-normal py-2 ps-5"> {{ __('Alta de Personal') }} </span>
                                    </a>
                                </li>
                            @endcan

                            <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
                                <a class="nav-link py-2 ps-5" href="#">

                                    <span class="sidebar-normal"> {{ __('Contraseña') }} </span>
                                </a>
                            </li>


                        </ul>
                    </div>
                </li>
            @endcan

            <!------ 12 OBRA ------>
            @can('obra_show')
                <li class="nav-item {{ $activePage == 'obra' || $activePage == 'user-management' ? ' active' : '' }}">
                    <a class="nav-link p-2" onmouseover="cambiar12();" onmouseout="volver12();" data-toggle="collapse"
                        href="#obras" aria-expanded="false">
                        <i><img id="cambiaBCO12"
                                src="{{ $activePage == 'obra' ? '/img/navs/obrasmenubco.svg' : '/img/navs/obrasmenu.svg' }}"
                                style="width:25px"></i>
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
                            @can('obra_create')
                                <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
                                    <a
                                        href="{{ route('obras.create') }}"class="nav-link -item{{ $activePage == 'obra' ? ' active' : '' }} ">
                                        <span class="sidebar-normal py-2 ps-5"> {{ __('Alta de Obra') }} </span>
                                    </a>
                                </li>
                            @endcan

                            <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
                                <a class="nav-link py-2 ps-5" href="#">
                                    <span class="sidebar-normal py-2 ps-5"> {{ __('Asignación de Obra') }} </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            @endcan

            <!------ 13 Usuarios ------>
            @can('user_show')
                <li class="nav-item {{ $activePage == 'usuarios' || $activePage == 'user-management' ? ' active' : '' }}">
                    <a class="nav-link p-2" onmouseover="cambiar13();" onmouseout="volver13();" data-toggle="collapse"
                        href="#usuarios" aria-expanded="false">
                        <i><img id="cambiaBCO13"
                                src="{{ $activePage == 'usuarios' ? '/img/navs/usuariosBco.svg' : '/img/navs/usuarios.svg' }}"
                                style="width:25px"></i>
                        <p>{{ __('usuarios y permisos') }}
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse " id="usuarios">
                        <ul class="nav">
                            <li class="nav-item{{ $activePage == 'profile' ? ' active' : '' }}">
                                <a
                                    href="{{ route('users.index') }}"class="nav-link -item{{ $activePage == 'usuarios' ? ' active' : '' }} ">
                                    <span class="sidebar-normal py-2 ps-5">{{ __('Ver usuarios') }} </span>
                                </a>
                            </li>

                            <!--no colapsable>-->
                            @can('permission_create')
                                <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
                                    <a
                                        href="{{ route('roles.index') }}"class="nav-link -item{{ $activePage == 'obra' ? ' active' : '' }} ">
                                        <span class="sidebar-normal py-2 ps-5"> {{ __('ver roles') }} </span>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </div>
                </li>
            @endcan

            {{--  <!------ Inspecciones ------>
            <li
                class="nav-item {{ $activePage == 'inspecciones' || $activePage == 'user-management' ? ' active' : '' }}">
                <a class="nav-link" href="#">
                    <i><img id="cambiaBCO3" style="width:25px"
                            src="{{ $activePage == 'inventario' ? '/img/navs/inventariomenubco.svg' : '/img/navs/inventariomenu.svg' }}"></i>
                    <p> {{ __('Tareas') }} </p>
                </a>
            </li>  --}}



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

    //FUNCIONES PARA CAMBIAR BOTONES A BLANCO
    //---1 CALENDARIO-----
    function cambiar1() {
        document.getElementById('cambiaBCO1').src = "{{ asset('/img/navs/calendarioBco.svg') }}";
    }

    function volver1() {
        document.getElementById('cambiaBCO7').src = "{{ asset('/img/navs/calendario.svg') }}";
    }

    //---2 CAJA CHICA-----
    function cambiar2() {
        document.getElementById('cambiaBCO2').src = "{{ asset('/img/navs/cajaChicaBco.svg') }}";
    }

    function volver2() {
        document.getElementById('cambiaBCO2').src = "{{ asset('/img/navs/cajaChica.svg') }}";
    }

    //---3 ASISTENCIA-----
    function cambiar3() {
        document.getElementById('cambiaBCO3').src = "{{ asset('/img/navs/asistenciaBco.svg') }}";
    }

    function volver3() {
        document.getElementById('cambiaBCO3').src = "{{ asset('/img/navs/asistencia.svg') }}";
    }

    //---4 TAREAS-----
    function cambiar4() {
        document.getElementById('cambiaBCO4').src = "{{ asset('/img/navs/tareasBco.svg') }}";
    }

    function volver4() {
        document.getElementById('cambiaBCO4').src = "{{ asset('/img/navs/tareas.svg') }}";
    }

    //---5 CHECK LIST-----
    function cambiar5() {
        document.getElementById('cambiaBCO5').src = "{{ asset('/img/navs/checkListBco.svg') }}";
    }

    function volver5() {
        document.getElementById('cambiaBCO5').src = "{{ asset('/img/navs/checkList.svg') }}";
    }

    //---6 MANTENIMIENTOS-----
    function cambiar6() {
        document.getElementById('cambiaBCO6').src = "{{ asset('/img/navs/mantenimientoBco.svg') }}";
    }

    function volver6() {
        document.getElementById('cambiaBCO6').src = "{{ asset('/img/navs/mantenimiento.svg') }}";
    }

    //---7 BITÁCORAS-----
    function cambiar7() {
        document.getElementById('cambiaBCO7').src = "{{ asset('/img/navs/bitacorasmenubco.svg') }}";
    }

    function volver7() {
        document.getElementById('cambiaBCO7').src = "{{ asset('/img/navs/bitacorasmenu.svg') }}";
    }

    //---8 GRUPOS-----
    function cambiar8() {
        document.getElementById('cambiaBCO8').src = "{{ asset('/img/navs/gruposBco.svg') }}";
    }

    function volver8() {
        document.getElementById('cambiaBCO8').src = "{{ asset('/img/navs/grupos.svg') }}";
    }



    //---9 EQUIPOS-----
    function cambiar9() {
        document.getElementById('cambiaBCO9').src = "{{ asset('/img/navs/eqiposmenubco.svg') }}";
    }

    function volver9() {
        document.getElementById('cambiaBCO9').src = "{{ asset('/img/navs/eqiposmenu.svg') }}";
    }

    //---10 PERSONAL-----
    function cambiar10() {
        document.getElementById('cambiaBCO10').src = "{{ asset('/img/navs/personalmenubco.svg') }}";
    }

    function volver10() {
        document.getElementById('cambiaBCO10').src = "{{ asset('/img/navs/personalmenu.svg') }}";
    }

    //---11 INVENTARIO-----
    function cambiar11() {
        document.getElementById('cambiaBCO11').src = "{{ asset('/img/navs/inventariomenubco.svg') }}";
    }

    function volver11() {
        document.getElementById('cambiaBCO11').src = "{{ asset('/img/navs/inventariomenu.svg') }}";
    }

    //---12 OBRAS-----
    function cambiar12() {
        document.getElementById('cambiaBCO12').src = "{{ asset('/img/navs/obrasmenubco.svg') }}";
    }

    function volver12() {
        document.getElementById('cambiaBCO12').src = "{{ asset('/img/navs/obrasmenu.svg') }}";
    }


    //---13 USUARIOS Y PERMISOS-----
    function cambiar13() {
        document.getElementById('cambiaBCO13').src = "{{ asset('/img/navs/usuariosBco.svg') }}";
    }

    function volver13() {
        document.getElementById('cambiaBCO13').src = "{{ asset('/img/navs/usuarios.svg') }}";
    }












    //---FORMATOS-----
    function cambiar6() {
        document.getElementById('cambiaBCO6').src = "{{ asset('/img/navs/formatosmenubco.svg') }}";
    }

    function volver6() {
        document.getElementById('cambiaBCO6').src = "{{ asset('/img/navs/formatosmenu.svg') }}";
    }
</script>
