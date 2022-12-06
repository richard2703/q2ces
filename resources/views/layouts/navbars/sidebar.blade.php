<div class="sidebar sidebarDerecha barra-lateral" data-image="{{ asset('material') }}/img/sidebar-1.jpg">

    <div class="logo">
        <a href="{{ url('dashboard', session('id')) }}"class="nav-item{{ $activePage == 'dashboard' ? ' active' : '' }}">
            <img src="{{ asset('img/login/logoQcem2.svg') }}" class="mx-auto d-block " width="30%">
        </a>
    </div>

    <div class="sidebar-wrapper menu">
        <ul class="nav">
            
        <!-- EQUIPOS -->
            <li class="nav-item {{ $activePage == 'dashboard' || $activePage == 'user-management' ? ' active' : '' }}">
                <a href="#equipo" onmouseover="cambiar();" onmouseout="volver();" class="nav-link p-2" data-toggle="collapse" aria-expanded="false">
                    <i><img id="cambiaBCO" ssrc="{{ $activePage == 'equipos' ? ' img/navs/eqiposMenuBCO.svg' : '/img/navs/eqiposMenu.svg' }}"  style="width:25px">  </i> 
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
                <a class="nav-link p-2 " onmouseover="cambiar2();" onmouseout="volver2();" data-toggle="collapse" href="#personal" aria-expanded="false">
                    <i><img id="cambiaBCO2" style="width:25px" src="{{ $activePage == 'personal' ? ' img/navs/personalMenuBCO.svg' : '/img/navs/personalMenu.svg' }}"></i>
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
            <li class="nav-item {{ $activePage == 'inventario' || $activePage == 'user-management' ? ' active' : '' }}">
                <a href="{{ route('inventario.dash') }}" onmouseover="cambiar3();" onmouseout="volver3();" class="nav-link -item{{ $activePage == 'obra' ? ' active' : '' }} ">
                    <i><img id="cambiaBCO3" style="width:25px" src="{{ $activePage == 'inventario' ? ' img/navs/inventarioMenuBCO.svg' : '/img/navs/inventarioMenu.svg' }}"></i>
                    <p> {{ __('inventario') }} </p>
                    {{--  <b class="caret"></b>  --}}
                </a>
            </li>

            <!------ OBRA ------>
            <li class="nav-item {{ $activePage == 'obra' || $activePage == 'user-management' ? ' active' : '' }}">
                <a class="nav-link p-2" onmouseover="cambiar4();" onmouseout="volver4();" data-toggle="collapse" href="#obras" aria-expanded="false">
                    <i><img id="cambiaBCO4" src="{{ $activePage == 'obra' ? ' img/navs/obrasMenuBCO.svg' : '/img/navs/obrasMenu.svg' }}" style="width:25px"></i>
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
            <li class="nav-item {{ $activePage == 'bitacoras' || $activePage == 'user-management' ? ' active' : '' }}">
                <a class="nav-link p-2" onmouseover="cambiar5();" onmouseout="volver5();" data-toggle="collapse" href="#bitacorass" aria-expanded="false">
                    <i><img id="cambiaBCO5" src="{{ $activePage == 'bitacoras' ? ' img/navs/bitacorasMenuBCO.svg' : '/img/navs/bitacorasMenu.svg' }}" style="width:25px"></i>
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
            <li class="nav-item {{ $activePage == 'formatos' || $activePage == 'user-management' ? ' active' : '' }}">
                <a class="nav-link p-2" onmouseover="cambiar6();" onmouseout="volver6();" data-toggle="collapse" href="#formatoss" aria-expanded="false">
                    <i><img id="cambiaBCO6" src="{{ $activePage == 'formatos' ? ' img/navs/formatosmenuBCO.svg' : '/img/navs/formatosmenu.svg' }}" style="width:25px"></i>
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

//FUNCIONES PARA CAMBIAR BOTONES A BLANCO
//---equipos-----
function cambiar(){
  document.getElementById('cambiaBCO').src="{{ asset('/img/navs/eqiposMenuBCO.svg') }}";
}
function volver(){
  document.getElementById('cambiaBCO').src="{{ asset('/img/navs/eqiposMenu.svg') }}";
}

//---personal-----
function cambiar2(){
  document.getElementById('cambiaBCO2').src="{{ asset('/img/navs/personalMenuBCO.svg') }}";
}
function volver2(){
  document.getElementById('cambiaBCO2').src="{{ asset('/img/navs/personalMenu.svg') }}";
}

//---inventario-----
function cambiar3(){
  document.getElementById('cambiaBCO3').src="{{ asset('/img/navs/inventarioMenuBCO.svg') }}";
}
function volver3(){
  document.getElementById('cambiaBCO3').src="{{ asset('/img/navs/inventarioMenu.svg') }}";
}

//---obra-----
function cambiar4(){
  document.getElementById('cambiaBCO4').src="{{ asset('/img/navs/obrasMenuBCO.svg') }}";
}
function volver4(){
  document.getElementById('cambiaBCO4').src="{{ asset('/img/navs/obrasMenu.svg') }}";
}

//---bitacora-----
function cambiar5(){
  document.getElementById('cambiaBCO5').src="{{ asset('/img/navs/bitacorasMenuBCO.svg') }}";
}
function volver5(){
  document.getElementById('cambiaBCO5').src="{{ asset('/img/navs/bitacorasMenu.svg') }}";
}

//---formatos-----
function cambiar6(){
  document.getElementById('cambiaBCO6').src="{{ asset('/img/navs/formatosmenuBCO.svg') }}";
}
function volver6(){
  document.getElementById('cambiaBCO6').src="{{ asset('/img/navs/formatosmenu.svg') }}";
}










</script>
