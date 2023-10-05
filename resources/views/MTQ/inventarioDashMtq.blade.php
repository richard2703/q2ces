@extends('layouts.main', ['activePage' => 'mtq', 'titlePage' => __('Dashboard Inventario')])
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12 align-self-center">
                    <div class="card">
                        <div class="card-body">
                            <div class="row d-flex ">

                                @can('inventario_mtq_show')
                                    <div class="col-12 col-sm-6 col-md-4 text-center my-4">
                                        <a href="{{ route('inventarioMtq.index', 'herramientas') }}" class="">
                                            <img src="/img/inventario/herramientas.svg" alt="equipos" title="Herramientas"
                                                width="30%" class="botonIconoPrincipal">
                                            <p class="mt-4 texticonos">Herramientas</p>
                                        </a>
                                    </div>
                                    <div class="col-12 col-sm-6 col-md-4 text-center my-4">
                                        <a href="{{ route('inventarioMtq.index', 'refacciones') }}" class="">
                                            <img src="/img/inventario/refacciones.svg" alt="personal" title="Refacciones"
                                                width="30%" class="botonIconoPrincipal">
                                            <p class="mt-4 texticonos">Refacciones</p>
                                        </a>
                                    </div>
                                    <div class="col-12 col-sm-6 col-md-4 text-center my-4">
                                        <a href="{{ route('inventarioMtq.index', 'consumibles') }}" class="">
                                            <img src="/img/inventario/consumible.svg" alt="inventario" title="Consumibles"
                                                width="30%" class="botonIconoPrincipal">
                                            <p class="mt-4 texticonos">Consumibles</p>
                                        </a>
                                    </div>
                                @endcan

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
