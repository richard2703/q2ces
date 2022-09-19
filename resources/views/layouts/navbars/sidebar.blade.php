<div class="sidebar sidebarDerecha" data-image="{{ asset('material') }}/img/sidebar-1.jpg">
    
    <div class="logo">
        <a href="" class="">
        <img src="{{ asset('img/login/logoQcem2.svg') }}" class="mx-auto d-block " width="30%">
        </a>
    </div>
    <div class="sidebar-wrapper accordion" id="accordionPanelsStayOpenExample">
        <ul class="nav" >


 
            <li class="accordion-item nav-item{{ $activePage == 'dashboard' ? ' active' : '' }} itemNav">
                <a class="nav-link py-2 accordion-button" href="{{ url('dashboard') }}" data-toggle="collapse" aria-expanded="false">
                    <i class="material-icons">dashboard</i>
                    <p class=" ">{{ __('Equipos') }}</p></a>
                </a>


                <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingOne">
                    <div class="accordion-body">
                      <strong>This is the first item's accordion body.</strong> It is shown by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                    </div>
                  </div>

            </li>

            @can('user_index')
                <li class="nav-item{{ $activePage == 'users' ? ' active' : '' }}">
                    <a class="nav-link py-2" href="{{ route('users.index') }}">
                        <i class="material-icons">face</i>
                        <p>Usuarios</p>
                    </a>
                </li>
            @endcan
            @can('permission_index')
                <li class="nav-item{{ $activePage == 'permissions' ? ' active' : '' }}">
                    <a class="nav-link py-2" href="{{ route('permissions.index') }}">
                        <i class="material-icons">security</i>
                        <p>Permisos</p>
                    </a>
                </li>
            @endcan
            @can('role_index')
                <li class="nav-item{{ $activePage == 'roles' ? ' active' : '' }}">
                    <a class="nav-link py-2" href="{{ route('roles.index') }}">
                        <i class="material-icons">assignment_ind</i>
                        <p>Roles</p>
                    </a>
                </li>
            @endcan

            {{-- <li class="nav-item{{ $activePage == 'icons' ? ' active' : '' }}">
                <a class="nav-link" href="#">
                    <i class="material-icons">bubble_chart</i>
                    <p>{{ __('Icons') }}</p>
                </a>
            </li>
            <li class="nav-item{{ $activePage == 'users' ? ' active' : '' }}">
                <a class="nav-link" href="#">
                    <i class="material-icons">location_ons</i>
                    <p>{{ __('Maps') }}</p>
                </a>
            </li>
            <li class="nav-item{{ $activePage == 'notifications' ? ' active' : '' }}">
                <a class="nav-link" href="#">
                    <i class="material-icons">notifications</i>
                    <p>{{ __('Notifications') }}</p>
                </a>
            </li>
            <li class="nav-item{{ $activePage == 'language' ? ' active' : '' }}">
                <a class="nav-link" href="#">
                    <i class="material-icons">language</i>
                    <p>{{ __('RTL Support') }}</p>
                </a>
            </li> --}}
        </ul>
    </div>
</div>
