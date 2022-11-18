@extends('layouts.main', ['activePage' => 'obra', 'titlePage' => __('Vista de Obra')])
@section('content')
    <div class="content">
        @if ($errors->any())
            <!-- PARA LA CARGA DE LOS ERRORES DE LOS DATOS-->
            <div class="alert alert-danger">
                <p>Listado de errores a corregir</p>
                <ul>
                    @foreach ($errors->all() as $item)
                        <li>{{ $item }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-11 align-self-start">
                    <div class="card">
                        <div class="card-body contCart">
                            <div class="p-1 align-self-start bacTituloPrincipal">
                                <h2 class="my-3 ms-3 texticonos ">Obra: {{ $obras->nombre }}</h2>
                            </div>
                            <form class="row">

                                <div class="col-12 col-md-5  my-3 align-self-center">
                                    <div class="text-center mx-auto mb-2 border vistaFoto ">
                                        <i><img class="imgVista"
                                                src="{{ $obras->foto == '' ? ' /img/general/default.jpg' : '/storage/obras/' . $obras->foto }}"></i>
                                    </div>
                                </div>

                                <div class="col-12 col-md-7 my-3">
                                    <div class="row">
                                        <div class=" col-12 col-sm-6 col-lg-4 my-3 ">
                                            <h2 class="fs-5 textTitulo">Dirección de Obra:</h2></br>
                                            <a href="https://maps.google.com/?q={{ $obras->calle }} {{ $obras->numero }} {{ $obras->colonia }} {{ $obras->cp }} {{ $obras->estado }}"
                                                target="blank">
                                                <p class="txtVistaObra">{{ $obras->calle }} {{ $obras->numero }},
                                                    {{ $obras->colonia }}, {{ $obras->cp }}
                                                    {{ $obras->ciudad }}, {{ $obras->estado }}
                                                </p>
                                            </a>
                                        </div>

                                        <div class=" col-12 col-sm-6  col-lg-4 my-3 ">
                                            <h2 class="fs-5 textTitulo">Tipo:</h2></br>
                                            <p>{{ $obras->tipo }}
                                            </p>
                                        </div>

                                        <div class=" col-12 col-sm-6  col-lg-4 my-3 ">
                                            <h2 class="fs-5 textTitulo">Residente Responsable:</h2></br>
                                            <p class="txtVistaObra">(falta agregar bloque)</p>
                                        </div>


                                        <div class=" col-12 col-sm-6  col-lg-4 my-3 ">
                                            <h2 class="fs-5 textTitulo">Equipos Asignados:</h2></br>
                                            <ul>
                                                <li class="txtVistaObra">(falta agregar bloque)</li>
                                                {{--  <li class="txtVistaObra">Bobcat</li>  --}}
                                            </ul>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-12 text-end mb-3 ">
                                    <i><img src="{{ $obras->logo == '' ? ' /img/general/default.jpg' : '/storage/obras/' . $obras->logo }}"
                                            class="vistaLogo"></i>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
