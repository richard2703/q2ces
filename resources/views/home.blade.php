@extends('layouts.main', ['activePage' => 'home', 'titlePage' => __('dashboard')])
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12 align-self-center">
                    <div class="card">
                        <div class="card-body">
                            <div class="row d-flex ">
                                @can('calendario_index')
                                    <div class="col-12 col-md-6 col-lg-3 text-center my-4">
                                        <a href="{{ route('calendarioPrincipal.index') }}" class="">
                                            <img src="/img/equipos/CALENDARIO-01.svg" alt="Calendario" title="Calendario"
                                                width="30%" class="botonIconoPrincipal">
                                            <p class="mt-4 texticonos">Calendario</p>
                                        </a>
                                    </div>
                                @endcan
                                @can('asistencia_index')
                                    <div class="col-12 col-md-6 col-lg-3 text-center my-4">
                                        <a href="{{ route('asistencia.index') }}" class="">
                                            <img src="/img/equipos/CATEGORÍA DE TAREAS-01.svg" alt="Nómina y Asistencia" title="Nómina y Asistencia"
                                                width="30%" class="botonIconoPrincipal">
                                            <p class="mt-4 texticonos">Nómina/Asistencia</p>
                                        </a>
                                    </div>
                                @endcan
                                @can('cajachica_index')
                                    <div class="col-12 col-md-6 col-lg-3 text-center my-4">
                                        <a href="{{ route('cajaChica.index') }}" class="">
                                            <img src="/img/dash/cajachica.svg" alt="Caja Chica" title="Caja Chica"
                                                width="30%" class="botonIconoPrincipal">
                                            <p class="mt-4 texticonos">Caja Chica</p>
                                        </a>
                                    </div>
                                @endcan
                                @can('cajachica_index')
                                    <div class="col-12 col-md-6 col-lg-3 text-center my-4">
                                        <a href="{{ route('serviciosTrasporte.index') }}" class="">
                                            <img src="/img/dash/servicios.svg" alt="Servicios" title="Servicios"
                                                width="30%" class="botonIconoPrincipal">
                                            <p class="mt-4 texticonos">Servicios</p>
                                        </a>
                                    </div>
                                @endcan
                                @can('inventario_index')
                                    <div class="col-12 col-md-6 col-lg-3 text-center my-4">
                                        <a href="{{ route('inventario.index', 'combustible') }}" class="">
                                            <img src="/img/inventario/combustible.svg" alt="Combustible" title="Combustible"
                                                width="30%" class="botonIconoPrincipal">
                                            <p class="mt-4 texticonos">Combustible</p>
                                        </a>
                                    </div>
                                @endcan
                                @can('inventario_index')
                                    <div class="col-12 col-md-6 col-lg-3 text-center my-4">
                                        <a href="{{ url('/combustibleTote') }}" class="">
                                            <img src="/img/inventario/tote.svg" alt="TOTE" title="TOTE"
                                                width="30%" class="botonIconoPrincipal">
                                            <p class="mt-4 texticonos">TOTE</p>
                                        </a>
                                    </div>
                                @endcan
                                @can('mantenimiento_index')
                                    <div class="col-12 col-md-6 col-lg-3 text-center my-4">
                                        <a href="{{ url('/mantenimientos') }}" class="">
                                            <img src="/img/equipos/mantenimientos.svg" alt="Mantenimientos" title="Mantenimientos"
                                                width="30%" class="botonIconoPrincipal">
                                            <p class="mt-4 texticonos">Mantenimientos</p>
                                        </a>
                                    </div>
                                @endcan
                                @can('bitacora_index')
                                    <div class="col-12 col-md-6 col-lg-3 text-center my-4">
                                        <a href="{{ route('bitacoras.index') }}" class="">
                                            <img src="/img/equipos/bitacoras.svg" alt="Bitácoras" title="Bitácoras"
                                                width="30%" class="botonIconoPrincipal">
                                            <p class="mt-4 texticonos">Bitácoras</p>
                                        </a>
                                    </div>
                                @endcan
                                @can('checkList_index')
                                    <div class="col-12 col-md-6  col-lg-3 text-center my-4">
                                        <a href="{{ route('checkList.index') }}" class="">
                                            <img src="/img/equipos/formatos.svg" alt="Cheklist" title="Cheklist" width="30%"
                                                class="botonIconoPrincipal">
                                            <p class="mt-4 texticonos">CheckList</p>
                                        </a>
                                    </div>
                                @endcan
                                @can('checkList_mis_pendientes')
                                    <div class="col-12 col-md-6  col-lg-3 text-center my-4">
                                        <a href="{{ route('checkList.pendientes') }}" class="">
                                            <img src="/img/equipos/mis-pendientes.svg" alt="Mis Pendientes" title="Mis Pendientes" width="30%"
                                                class="botonIconoPrincipal">
                                            <p class="mt-4 texticonos">Mis Pendientes</p>
                                        </a>
                                    </div>
                                @endcan
                                @can('bitacora_grupo_index')
                                    <div class="col-12 col-md-6 col-lg-3 text-center my-4">
                                        <a href="{{ route('grupo.index') }}" class="">
                                            <img src="/img/equipos/TIPOS DE DOCUMENTOS-01.svg" alt="Grupos" title="Grupos"
                                                width="30%" class="botonIconoPrincipal">
                                            <p class="mt-4 texticonos">Grupos</p>
                                        </a>
                                    </div>
                                @endcan
                                @can('bitacora_tarea_index')
                                    <div class="col-12 col-md-6  col-lg-3 text-center my-4">
                                        <a href="{{ route('tarea.index') }}" class="">
                                            <img src="/img/equipos/TIPOS DE TAREAS-01.svg" alt="Tareas" title="Tareas"
                                                width="30%" class="botonIconoPrincipal">
                                            <p class="mt-4 texticonos">Tareas</p>
                                        </a>
                                    </div>
                                @endcan
                                @can('maquinaria_index')
                                    <div class="col-12 col-md-6 col-lg-3 text-center my-4">
                                        <a href="{{ route('maquinaria.index') }}" class="">
                                            <img src="/img/equipos/equipo.svg" alt="equipos" title="equipos" width="30%"
                                                class="botonIconoPrincipal">
                                            <p class="mt-4 texticonos">Equipos</p>
                                        </a>
                                    </div>
                                @endcan
                                @can('maquinaria_index')
                                    <div class="col-12 col-md-6 col-lg-3 text-center my-4">
                                        <a href="{{ route('accesorios.index') }}" class="">
                                            <img src="/img/equipos/REFACCIONES POR MAQUINARÍA-01.svg" alt="Accesorios"
                                                title="Accesorios" width="30%" class="botonIconoPrincipal">
                                            <p class="mt-4 texticonos">Accesorios</p>
                                        </a>
                                    </div>
                                @endcan
                                @can('personal_index')
                                    <div class="col-12 col-md-6 col-lg-3 text-center my-4">
                                        <a href="{{ route('personal.index') }}" class="">
                                            <img src="/img/equipos/personal.svg" alt="personal" title="personal"
                                                width="30%" class="botonIconoPrincipal">
                                            <p class="mt-4 texticonos">Personal</p>
                                        </a>
                                    </div>
                                @endcan
                                @can('inventario_index')
                                    <div class="col-12 col-md-6 col-lg-3 text-center my-4">
                                        <a href="{{ route('inventario.dash') }}" class="">
                                            <img src="/img/equipos/CATEGORÍAS DE PROVEEDORES-01.svg" alt="inventario"
                                                title="inventario" width="30%" class="botonIconoPrincipal">
                                            <p class="mt-4 texticonos">Inventario</p>
                                        </a>
                                    </div>
                                @endcan
                                @can('calendario_mtq_index')
                                    <div class="col-12 col-md-6 col-lg-3 text-center my-4">
                                        <a href="{{ route('calendarioMtq.index') }}" class="">
                                            <img src="/img/dash/calendarioMTQ.svg" alt="Calendario MTQ" title="Calendario MTQ"
                                                width="30%" class="botonIconoPrincipal">
                                            <p class="mt-4 texticonos">Calendario MTQ</p>
                                        </a>
                                    </div>
                                @endcan
                                @can('maquinaria_mtq_index')
                                    <div class="col-12 col-md-6 col-lg-3 text-center my-4">
                                        <a href="{{ route('uso.index') }}" class="">
                                            <img src="/img/dash/usoMTQ.svg" alt="Uso de Equipo" title="Uso de Equipo" width="30%"
                                                class="botonIconoPrincipal">
                                            <p class="mt-4 texticonos">Uso de Equipo</p>
                                        </a>
                                    </div>
                                @endcan
                                @can('maquinaria_mtq_index')
                                    <div class="col-12 col-md-6 col-lg-3 text-center my-4">
                                        <a href="{{ route('mtq.index') }}" class="">
                                            <img src="/img/dash/equiposMTQ.svg" alt="Equipos MTQ" title="Equipos MTQ"
                                                width="30%" class="botonIconoPrincipal">
                                            <p class="mt-4 texticonos">Equipos MTQ</p>
                                        </a>
                                    </div>
                                @endcan
                                @can('maquinaria_mtq_index')
                                    <div class="col-12 col-md-6 col-lg-3 text-center my-4">
                                        <a href="{{ route('residentes.index') }}" class="">
                                            <img src="/img/dash/residente.svg" alt="Residentes" title="Residentes"
                                                width="30%" class="botonIconoPrincipal">
                                            <p class="mt-4 texticonos">Residentes</p>
                                        </a>
                                    </div>
                                @endcan
                                @can('obra_index')
                                    <div class="col-12 col-md-6 col-lg-3 text-center my-4">
                                        <a href="{{ route('obras.index') }}" class="">
                                            <img src="/img/equipos/obras.svg" alt="Obras" title="Obras" width="30%"
                                                class="botonIconoPrincipal">
                                            <p class="mt-4 texticonos">Obras</p>
                                        </a>
                                    </div>
                                @endcan
                                @can('catalogos_index')
                                    <div class="col-12 col-md-6 col-lg-3 text-center my-4">
                                        <a href="{{ route('catalogos.index') }}" class="">
                                            <img src="/img/equipos/ADMINISTRACIÓN DE DOCUMENTOS-01.svg" alt="Catálogos"
                                                title="Catálogos" width="30%" class="botonIconoPrincipal">
                                            <p class="mt-4 texticonos">Catálogos</p>
                                        </a>
                                    </div>
                                @endcan
                                @can('user_index')
                                    <div class="col-12 col-md-6  col-lg-3 text-center my-4">
                                        <a href="{{ route('users.index') }}" class="">
                                            <img src="/img/dash/usuarios.svg" alt="Usuarios" title="Usuarios" width="30%"
                                                class="botonIconoPrincipal">
                                            <p class="mt-4 texticonos">Usuarios</p>
                                        </a>
                                    </div>
                                @endcan
                                @can('user_index')
                                    <div class="col-12 col-md-6  col-lg-3 text-center my-4">
                                        <a href="{{ route('roles.index') }}" class="">
                                            <img src="/img/dash/roles.svg" alt="Roles" title="Roles" width="30%"
                                                class="botonIconoPrincipal">
                                            <p class="mt-4 texticonos">Roles</p>
                                        </a>
                                    </div>
                                @endcan
                                @can('permission_index')
                                    <div class="col-12 col-md-6  col-lg-3 text-center my-4">
                                        <a href="{{ route('permissions.index') }}" class="">
                                            <img src="/img/dash/permisos.svg" alt="Permisos" title="Permisos" width="30%"
                                                class="botonIconoPrincipal">
                                            <p class="mt-4 texticonos">Permisos</p>
                                        </a>
                                    </div>
                                @endcan
                            </div>
                        </div>
                        <!--Footer-->
                        {{--  <div class="card-footer mr-auto">
                        </div>  --}}
                        <!--End footer-->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
