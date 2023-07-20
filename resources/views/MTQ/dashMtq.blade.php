@extends('layouts.main', ['activePage' => 'mtq', 'titlePage' => __('Dashboard mtq')])
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-10 align-self-center">
                <div class="card">
                    <div class="card-body">
                        <div class="row d-flex ">

                            <div class="col-12 col-md-6 text-center my-4">
                                <a href="{{route('mtq.index')}}">
                                    <img src="/img/inventario/herramientas.svg" alt="Puestos" title="Puestos"
                                        width="30%" class="botonIconoPrincipal">
                                    <p class="mt-4 texticonos">Maquinaria Mtq's</p>
                                </a>
                            </div>

                            <div class="col-12 col-md-6 text-center my-4">
                                <a href="{{route('residentes.index')}}">
                                    <img src="/img/inventario/herramientas.svg" alt="Puestos" title="Puestos"
                                        width="30%" class="botonIconoPrincipal">
                                    <p class="mt-4 texticonos">Residentes</p>
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
