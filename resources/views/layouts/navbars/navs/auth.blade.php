<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
    <div class="container-fluid">
        <div class="navbar-wrapper">
            <a class="navbar-brand" href="#">{{ $titlePage }}</a>
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end">

            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link" href="#pablo" id="navbarDropdownProfile" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <i><img id="cambiaBCO30" style="width:25px"
                                src="{{ $activePage == 'Notificaciones' ? ' img/navs/accountbco.svg' : '/img/navs/account.svg' }}"></i>
                        <p class="d-lg-none d-md-block">
                            {{ __('Perfil') }}
                        </p>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
                        {{--  <a class="dropdown-item" href="#">{{ __('Profile') }}</a>
                        <a class="dropdown-item" href="#">{{ __('Settings') }}</a>
                        <div class="dropdown-divider"></div>  --}}
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();document.getElementById('logout-form').submit();">{{ __('Log out') }}</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
    //FUNCIONES PARA CAMBIAR BOTONES A BLANCO
    //---equipos-----
    //---- HOME--------
    function cambiar10() {

        document.getElementById('cambiaBCO10').src = "{{ asset('/img/navs/housebco.svg') }}";
    }

    function volver10() {
        document.getElementById('cambiaBCO10').src = "{{ asset('/img/navs/house.svg') }}";
    }

    //---- NOTIFICACIONES--------
    function cambiar20() {
        document.getElementById('cambiaBCO20').src = "{{ asset('/img/navs/bellbco.svg') }}";
    }

    function volver20() {
        document.getElementById('cambiaBCO20').src = "{{ asset('/img/navs/house.svg') }}";
    }

    //---- HPERFIL--------
    function cambiar30() {
        document.getElementById('cambiaBCO30').src = "{{ asset('/img/navs/accountbco.svg') }}";
    }

    function volver30() {
        document.getElementById('cambiaBCO30').src = "{{ asset('/img/navs/house.svg') }}";
    }
</script>
