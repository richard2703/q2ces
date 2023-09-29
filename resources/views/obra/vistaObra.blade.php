@extends('layouts.main', ['activePage' => 'obra', 'titlePage' => __('Vista de Obra')])
@section('content')
    <div class="content">
        <?php
        $objValida = new Validaciones();
        ?>
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
                                <h2 class="my-3 ms-3 texticonos ">Obra: {{ $objValida->ucwords_accent($obras->nombre) }}</h2>
                            </div>
                            <form class="row">

                                <div class="col-12 col-md-4  my-3 align-self-center">
                                    <div class="text-center mx-auto mb-2 border vistaFoto ">
                                        <i><img class="imgVista"
                                                src="{{ $obras->foto == '' ? '/img/general/default.jpg' : asset('/storage/obras/' . str_pad($obras->id, 4, '0', STR_PAD_LEFT) . '/' .  $obras->foto) }}"
                                                ></i>
                                    </div>
                                </div>

                                <div class="col-12 col-md-8 my-3">
                                    <div class="row">
                                        <div class=" col-12 col-sm-6 col-lg-4 my-3 order-1">
                                            <h2 class="fs-5 textTitulo">Dirección de Obra:</h2></br>
                                            <a href="https://maps.google.com/?q={{ $obras->calle }} {{ $obras->numero }} {{ $obras->colonia }} {{ $obras->cp }} {{ $obras->estado }}"
                                                target="blank">
                                                <p class="txtVistaObra">{{ $obras->calle }} {{ $obras->numero }},
                                                    {{ $obras->colonia }}, {{ $obras->cp }}
                                                    {{ $obras->ciudad }}, {{ $obras->estado }}
                                                </p>
                                            </a>
                                        </div>



                                        <div class=" col-12 col-sm-6  col-lg-4 my-3 order-2 order-sm-3 order-lg-3">
                                            <h2 class="fs-5 textTitulo">Residente Responsable:</h2></br>
                                            <ul>
                                                @forelse ($vctResidenteAsignado as $residente)
                                                    <li>
                                                        <p class="txtVistaObra">{{ $residente->nombre }}</p>
                                                    </li>
                                                @empty
                                                    <li>
                                                        <p class="txtVistaObra">Sin residente asignado</p>
                                                    </li>
                                                @endforelse
                                            </ul>
                                        </div>


                                        <div class=" col-12 col-sm-6  col-lg-4 my-3 order-3 order-sm-4">
                                            <h2 class="fs-5 textTitulo">Equipos Asignados:</h2></br>
                                            <ul>
                                                @forelse ($vctMaquinariaAsignada as $maquinaria)
                                                    <li>
                                                        <p class="txtVistaObra">{{ $maquinaria->maquinaria }}</p>
                                                    </li>
                                                @empty
                                                    <li>
                                                        <p class="txtVistaObra">Sin Maquinaría Y/O Equipo Asignado</p>
                                                    </li>
                                                @endforelse
                                            </ul>
                                        </div>

                                        <div class=" col-12 col-sm-6  col-lg-4 my-3 order-4 order-sm-2 order-lg-4">
                                            <h2 class="fs-5 textTitulo">Tipo:</h2></br>
                                            <p>{{ $obras->tipo }}
                                            </p>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-12 text-end mb-3 ">
                                    <i><img  src="{{ $obras->logo == '' ? '/img/general/default.jpg' : asset('/storage/obras/' . str_pad($obras->id, 4, '0', STR_PAD_LEFT) . '/' .  $obras->logo) }}"
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
