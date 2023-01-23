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
            <form class="navbar-form">
                <!--<div class="input-group no-border">
                    <input type="text" value="" class="form-control" placeholder="Search...">
                    <button type="submit" class="btn btn-white btn-round btn-just-icon">
                        <i class="material-icons">search</i>
                        <div class="ripple-container"></div>
                    </button>
                </div>-->
            </form>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}" onmouseover="cambiar10();" onmouseout="volver10();">
                    <i><img id="cambiaBCO10" style="width:25px" src="{{ $activePage == 'Notificaciones' ? ' img/navs/housebco.svg' : '/img/navs/house.svg' }}"></i>
                        <p class="d-lg-none d-md-block">
                            {{ __('Home') }}
                        </p>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false" onmouseover="cambiar20();" onmouseout="volver20();">
                       <i>
                        <img id="cambiaBCO20" style="width:25px" src="{{ $activePage == 'Notificaciones' ? ' img/navs/bellbco.svg' : '/img/navs/bell.svg' }}"></i>
                        <span class="notification">5</span>
                        <p class="d-lg-none d-md-block">
                            {{ __('Notificacioness') }}
                        </p>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="#">{{ __('Mike John responded to your email') }}</a>
                        <a class="dropdown-item" href="#">{{ __('You have 5 new tasks') }}</a>
                        <a class="dropdown-item" href="#">{{ __('You\'re now friend with Andrew') }}</a>
                        <a class="dropdown-item" href="#">{{ __('Another Notification') }}</a>
                        <a class="dropdown-item" href="#">{{ __('Another One') }}</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link" href="#pablo" id="navbarDropdownProfile" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false" onmouseover="cambiar30();" onmouseout="volver30();">
                        <i><img id="cambiaBCO30" style="width:25px" src="{{ $activePage == 'Notificaciones' ? ' img/navs/accountbco.svg' : '/img/navs/account.svg' }}"></i>
                        <p class="d-lg-none d-md-block">
                            {{ __('Perfil') }}
                        </p>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
                        <a class="dropdown-item" href="#">{{ __('Profile') }}</a>
                        <a class="dropdown-item" href="#">{{ __('Settings') }}</a>
                        <div class="dropdown-divider"></div>
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
function cambiar10(){

  document.getElementById('cambiaBCO10').src="{{ asset('/img/navs/housebco.svg') }}";
}
function volver10(){
  document.getElementById('cambiaBCO10').src="{{ asset('/img/navs/house.svg') }}";
}

//---- NOTIFICACIONES--------
function cambiar20(){
  document.getElementById('cambiaBCO20').src="{{ asset('/img/navs/housebco.svg') }}";
}
function volver20(){
  document.getElementById('cambiaBCO20').src="{{ asset('/img/navs/house.svg') }}";
}

//---- HPERFIL--------
function cambiar30(){
  document.getElementById('cambiaBCO30').src="{{ asset('/img/navs/housebco.svg') }}";
}
function volver30(){
  document.getElementById('cambiaBCO30').src="{{ asset('/img/navs/house.svg') }}";
}

</script>