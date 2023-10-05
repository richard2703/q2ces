@extends('layouts.main', ['activePage' => 'mtq', 'titlePage' => __('Dashboard mtq')])
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-10 align-self-center">
                    <div class="card">
                        <div class="card-body">
                            <div class="row d-flex ">

                                @can('maquinaria_mtq_index')
                                    <div class="col-12 col-md-6 text-center my-4">
                                        <a href="{{ route('mtq.index') }}">
                                            <img src="/img/inventario/herramientas.svg" alt="Equipos MTQ" title="Equipos MTQ"
                                                width="30%" class="botonIconoPrincipal">
                                            <p class="mt-4 texticonos">Equipos MTQ</p>
                                        </a>
                                    </div>
                                @endcan


                                @can('residente_mtq_index')
                                    <div class="col-12 col-md-6 text-center my-4">
                                        <a href="{{ route('residentes.index') }}">
                                            <img src="/img/inventario/herramientas.svg" alt="Residentes" title="Residentes"
                                                width="30%" class="botonIconoPrincipal">
                                            <p class="mt-4 texticonos">Residentes</p>
                                        </a>
                                    </div>
                                @endcan

                                @can('calendario_mtq_index')
                                    <div class="col-12 col-md-6 text-center my-4">
                                        <a href="{{ route('calendarioMtq.index') }}">
                                            <img src="/img/inventario/herramientas.svg" alt="Calendario MTQ"
                                                title="Calendario MTQ" width="30%" class="botonIconoPrincipal">
                                            <p class="mt-4 texticonos">Calendario MTQ</p>
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
