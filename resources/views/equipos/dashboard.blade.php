@extends('layouts.main', ['activePage' => 'equipos', 'titlePage' => __('dashboard')])


@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-10 align-self-center">
                    <div class="card">
                        <!--<div class="card-header card-header-primary">
                            <h4 class="card-title">Roles</h4>
                            <p class="card-category">Lista de roles registrados en la base de datos</p>
                        </div>-->
                        <div class="card-body">
                            <div class="row ">
                                <div class="col-4 text-center my-4">
                                    <a href="" class="">
                                        <img src="/img/equipos/equipo.svg" alt="equipos" title="equipos" width="30%" class="botonIconoPrincipal">
                                        <p class="mt-4 texticonos">Equipos</p>
                                    </a>
                                </div>

                                <div class="col-4 text-center my-4">
                                    <a href="" class="">
                                        <img src="/img/equipos/personal.svg" alt="personal" title="personal" width="30%" class="botonIconoPrincipal">
                                        <p class="mt-4 texticonos">Personal</p>
                                </div>

                                <div class="col-4 text-center my-4">
                                    <a href="" class="">
                                        <img src="/img/equipos/inventario.svg" alt="inventario" title="inventario" width="30%" class="botonIconoPrincipal">
                                        <p class="mt-4 texticonos">Inventario</p>
                                    </a>
                                </div>

                                <div class="col-4 text-center my-4">
                                    <a href="" class="">
                                        <img src="/img/equipos/obras.svg" alt="obras" title="eobras" width="30%" class="botonIconoPrincipal">
                                        <p class="mt-4 texticonos">Obras</p>
                                    </a>
                                </div>
                                <div class="col-4 text-center my-4">
                                    <a href="" class="">
                                        <img src="/img/equipos/bitacoras.svg" alt="bitacoras" title="bitacoras" width="30%" class="botonIconoPrincipal">
                                        <p class="mt-4 texticonos">Bitácoras</p >
                                     </a>      
                                </div>

                                <div class="col-4 text-center my-4">
                                    <a href="" class="">
                                        <img src="/img/equipos/formatos.svg" alt="formatos" title="formatos" width="30%" class="botonIconoPrincipal">
                                        <p class="mt-4 texticonos">Formatos</p>
                                    </a> 
                                </div>
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
