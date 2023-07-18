@extends('layouts.main', ['activePage' => 'catalogos', 'titlePage' => __('Dashboard Catálogos')])
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-10 align-self-center">
                    <div class="card">
                        <div class="card-body">
                            <div class="row d-flex ">

                                @can('catalogos_show')
                                    <div class="col-12 col-md-6 text-center my-4">
                                        <a href="{{ route('catalogoPuestos.index') }}" class="">
                                            <img src="/img/inventario/herramientas.svg" alt="Puestos" title="Puestos"
                                                width="30%" class="botonIconoPrincipal">
                                            <p class="mt-4 texticonos">Puestos</p>
                                        </a>
                                    </div>

                                    <div class="col-12 col-md-6 text-center my-4">
                                        <a href="{{ route('catalogoPuestosNivel.index') }}" class="">
                                            <img src="/img/inventario/herramientas.svg" alt="Nivel de Puestos" title="Nivel de Puestos"
                                                width="30%" class="botonIconoPrincipal">
                                            <p class="mt-4 texticonos">Nivel de Puestos</p>
                                        </a>
                                    </div>

                                    <div class="col-12 col-md-6 text-center my-4">
                                        <a href="{{ route('catalogoCategoriasTareas.index') }}" class="">
                                            <img src="/img/inventario/herramientas.svg" alt="Categoría de tareas" title="Categoría de tareas"
                                                width="30%" class="botonIconoPrincipal">
                                            <p class="mt-4 texticonos">Categoría de tareas</p>
                                        </a>
                                    </div>

                                    <div class="col-12 col-md-6 text-center my-4">
                                        <a href="{{ route('catalogoTiposTareas.index') }}" class="">
                                            <img src="/img/inventario/herramientas.svg" alt="Categoría de tareas" title="Tipos de tareas"
                                                width="30%" class="botonIconoPrincipal">
                                            <p class="mt-4 texticonos">Tipos de tareas</p>
                                        </a>
                                    </div>

                                    <div class="col-12 col-md-6 text-center my-4">
                                        <a href="{{ route('catalogoUbicacionesTareas.index') }}" class="">
                                            <img src="/img/inventario/herramientas.svg" alt="Categoría de tareas" title="Ubicaciones de tareas"
                                                width="30%" class="botonIconoPrincipal">
                                            <p class="mt-4 texticonos">Ubicaciones de tareas</p>
                                        </a>
                                    </div>

                                @endcan


                            </div>
                        </div>
                        <!--Footer-->
                        <div class="card-footer mr-auto">
                        </div>
                        <!--End footer-->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
