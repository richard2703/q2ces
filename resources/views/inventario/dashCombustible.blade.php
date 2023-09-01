@extends('layouts.main', ['activePage' => 'combustible', 'titlePage' => __('Carga y Descarga')])
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
                <div class="col-md-11 align-self-center">
                    <div class="card">
                        @can('combustible_create')
                            <div class="card-body contCart">
                                <div class="p-1 align-self-start bacTituloPrincipal">
                                    <h2 class="my-3 ms-3 texticonos ">Carga y Descarga</h2>
                                </div>

                                <div class="col-11  mx-auto d-block my-4 border-bottom">

                                    <nav class=" ">
                                        <div class="nav nav-tabs navMenuBalance justify-content-evenly" id="nav-tab"
                                            role="tablist">
                                            <button class="nav-link active combustiblePestaña  col-6" id="balanceUno-tab"
                                                data-bs-toggle="tab" data-bs-target="#balanceUno" type="button" role="tab"
                                                aria-controls="balanceUno" aria-selected="true">


                                                <img id="myImage" onclick="changeImage()"
                                                    src="{{ asset('img/inventario/cargaVerde.svg') }}"
                                                    class="mx-auto d-block imgCargaDescarga">
                                                <p class="text-center mt-2">CARGA</p>
                                            </button>
                                            <button class="nav-link  combustiblePestaña col-5" id="balanceDos-tab"
                                                data-bs-toggle="tab" data-bs-target="#balanceDos" type="button" role="tab"
                                                aria-controls="balanceDos" aria-selected="false">


                                                <img id="myImage1" onclick="changeImage1()"
                                                    src="{{ asset('img/inventario/descargaGris.svg') }}"
                                                    class="mx-auto d-block imgCargaDescarga">
                                                <p class="text-center mt-2">DESCARGA</p>
                                            </button>
                                        </div>
                                    </nav>
                                    <div class="tab-content" id="nav-tabContent ">

                                        <div class="tab-pane fade show active conteDivCArgaDescarga " id="balanceUno"
                                            role="tabpanel" aria-labelledby="balanceUno-tab" tabindex="0">
                                            <form action="{{ route('inventario.cargaCombustible') }}" method="post">
                                                @csrf
                                                <div class="col-12 my-5 ">
                                                    <div class="row mt-5">
                                                        <div class="col-12">
                                                            <div class="row ">
                                                                <div class=" col-12 col-md-6 d-flex mb-4">
                                                                    <div class="me-2">
                                                                        <img src="{{ asset('/img/inventario/equipo_1.svg') }}"
                                                                            alt="" style="width:40px;">
                                                                    </div>
                                                                    <div style="width: 90%! important;">
                                                                        <label class="labelTitulo">Equipo:</label></br>
                                                                        <select id="maquinariaId" name="maquinariaId"
                                                                            class="form-select"
                                                                            aria-label="Default select example">
                                                                            @foreach ($cisternas as $maquina)
                                                                                <option value="{{ $maquina->id }}">
                                                                                    {{ $maquina->nombre . ' / ' . $maquina->modelo . ($maquina->placas != '' ? ' [' . $maquina->placas . ']' : '') }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class=" col-12 col-md-6 d-flex mb-4">
                                                                    <div class="me-2">
                                                                        <img src="{{ asset('/img/inventario/despachador.svg') }}"
                                                                            alt="" style="width:40px;">
                                                                    </div>
                                                                    <div style="width: 90%! important;">
                                                                        <label class="labelTitulo">Despachador:</label></br>
                                                                        <select id="operadorId" name="operadorId"
                                                                            class="form-select"
                                                                            aria-label="Default select example">
                                                                            @foreach ($despachador as $persona)
                                                                                <option value="{{ $persona->id }}">
                                                                                    {{ $persona->nombres . ' ' . $persona->apellidoP }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class=" col-12 col-md-6 d-flex mb-4">
                                                                    <div class="me-2">
                                                                        <img src="{{ asset('/img/inventario/litros.svg') }}"
                                                                            alt="" style="width:40px;">
                                                                    </div>
                                                                    <div style="width: 90%! important;">
                                                                        <label class="labelTitulo">Litros:
                                                                            <span>*</span></label></br>
                                                                        <input type="number" step="0.01" min="0.01"
                                                                            required class="inputCaja" id="litros"
                                                                            name="litros" value="{{ old('litros') }}">
                                                                    </div>
                                                                </div>


                                                                <div class=" col-12 col-md-6 d-flex mb-4">
                                                                    <div class="me-2">
                                                                        <img src="{{ asset('/img/inventario/precio.svg') }}"
                                                                            alt="" style="width:40px;">
                                                                    </div>
                                                                    <div style="width: 90%! important;">
                                                                        <label class="labelTitulo">Precio:
                                                                            <span>*</span></label></br>
                                                                        <input type="number" step="0.01" min="0.01"
                                                                            required class="inputCaja" id="precio"
                                                                            name="precio" value="{{ old('precio') }}">
                                                                    </div>
                                                                </div>

                                                            </div>

                                                        </div>


                                                    </div>
                                                </div>
                                                <div class="col-12 text-center mb-3 ">
                                                    <button type="submit" class="btn botonGral"
                                                        onclick="test()">Guardar</button>
                                                </div>

                                            </form>

                                        </div>

                                        <div class="tab-pane fade conteDivCArgaDescarga" id="balanceDos" role="tabpanel"
                                            aria-labelledby="balanceDos-tab" tabindex="0">
                                            <form action="{{ route('inventario.descargaCombustible') }}" method="post"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <div class="col-12 my-5 ">
                                                    <div class="row mt-5">
                                                        <div class="col-12 col-lg-3">
                                                            <div class="row">
                                                                {{--  <div
                                                                    class="col-12 col-md-6 col-lg-12 text-center mx-auto border vistaFotoCombustibles mb-4">
                                                                    <i><img class="imgVistaCombustible img-fluid mb-2"
                                                                            src="{{ asset('/img/inventario/horometro.svg') }}"></i>
                                                                    <span class="mi-archivo"> <input class="mb-4 ver "
                                                                            type="file" name="imgKm" id="mi-archivo"
                                                                            accept="image/*" multiple></span>
                                                                    <label for="mi-archivo">
                                                                        <span class="">Tomar Foto</span>
                                                                    </label>
                                                                </div>  --}}

                                                                <div
                                                                    class="col-12 col-md-6 col-lg-12 text-center mx-auto border vistaFotoCombustibles mb-4">
                                                                    <i><img class="imgVistaCombustible img-fluid mb-2"
                                                                            src="{{ asset('/img/inventario/descarga.svg') }}"></i>
                                                                    <span class="mi-archivo2"> <input class="mb-4 ver "
                                                                            type="file" name="imgHoras" id="mi-archivo2"
                                                                            accept="image/*" multiple></span>
                                                                    <label for="mi-archivo2">
                                                                        <span class="">Tomar Foto</span>
                                                                    </label>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="col-12 col-md-12 col-lg-9">
                                                            <div class="row ">
                                                                <div class=" col-12 col-md-6 d-flex mb-4">
                                                                    <div class="me-2">
                                                                        <img src="{{ asset('/img/inventario/equipo_1.svg') }}"
                                                                            alt="" style="width:40px;">
                                                                    </div>
                                                                    <div style="width: 100%! important;">
                                                                        <label class="labelTitulo">Equipo:</label></br>
                                                                        <select id="maquinariaId" name="maquinariaId"
                                                                            class="form-select"
                                                                            aria-label="Default select example">
                                                                            @foreach ($cisternas as $maquina)
                                                                                <option value="{{ $maquina->id }}">
                                                                                    {{ $maquina->nombre . ' / ' . $maquina->modelo . ($maquina->placas != '' ? ' [' . $maquina->placas . ']' : '') }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class=" col-12 col-md-6 d-flex mb-4">
                                                                    <div class="me-2">
                                                                        <img src="{{ asset('/img/navs/eqiposMenu.svg') }}"
                                                                            alt="" style="width:40px;">
                                                                    </div>
                                                                    <div style="width: 100%! important;">
                                                                        <label class="labelTitulo">Maquinaria:</label></br>
                                                                        <select id="servicioId" name="servicioId"
                                                                            class="form-select"
                                                                            aria-label="Default select example">
                                                                            @foreach ($maquinaria as $maquina)
                                                                                <option value="{{ $maquina->id }}">
                                                                                    {{ $maquina->nombre . ' / ' . $maquina->modelo . ($maquina->placas != '' ? ' [' . $maquina->placas . ']' : '') }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class=" col-12 col-md-6 d-flex mb-4">
                                                                    <div class="me-2">
                                                                        <img src="{{ asset('/img/inventario/despachador.svg') }}"
                                                                            alt="" style="width:40px;">
                                                                    </div>
                                                                    <div style="width: 100%! important;">
                                                                        <label class="labelTitulo">Despachador:</label></br>
                                                                        <select id="operadorId" name="operadorId"
                                                                            class="form-select"
                                                                            style="width: 100%! important;"
                                                                            aria-label="Default select example">
                                                                            @foreach ($despachador as $persona)
                                                                                <option value="{{ $persona->id }}">
                                                                                    {{ $persona->nombres . ' ' . $persona->apellidoP }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="col-12 col-md-6 d-flex mb-4">
                                                                    <div class="me-2">
                                                                        <img src="{{ asset('/img/navs/personalMenu.svg') }}"
                                                                            alt="" style="width:40px;">
                                                                    </div>
                                                                    <div style="width: 100%! important;">
                                                                        <label class="labelTitulo">Operador:</label></br>
                                                                        <select id="receptorId" name="receptorId"
                                                                            class="form-select"
                                                                            aria-label="Default select example">
                                                                            @foreach ($personal as $persona)
                                                                                <option value="{{ $persona->id }}">
                                                                                    {{ $persona->nombres . ' ' . $persona->apellidoP }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class=" col-12 col-md-6 d-flex mb-4">
                                                                    <div class="me-2">
                                                                        <img src="{{ asset('/img/inventario/litros.svg') }}"
                                                                            alt="" style="width:40px;">
                                                                    </div>
                                                                    <div style="width: 100%! important;">
                                                                        <label class="labelTitulo">Litros:
                                                                            <span>*</span></label></br>
                                                                        <input type="number" step="0.01" min="0.01"
                                                                            required class="inputCaja" id="litros"
                                                                            name="litros" value="{{ old('litros') }}">
                                                                    </div>
                                                                </div>
                                                                <div class=" col-12 col-md-6 d-flex mb-4">
                                                                    <div class="me-2">
                                                                        <img src="{{ asset('/img/inventario/uso.svg') }}"
                                                                            alt="" style="width:40px;">
                                                                    </div>
                                                                    <div style="width: 100%! important;">
                                                                        <label class="labelTitulo">Uso en
                                                                            Km/Mi/Hr:</label></br>
                                                                        <input type="number" step="1" min="0"
                                                                            class="inputCaja" id="km" name="km"
                                                                            value="{{ old('km') }}">
                                                                    </div>
                                                                </div>

                                                                <div class=" col-12 col-md-6 d-flex mb-4">
                                                                    <div class="me-2">
                                                                        <img src="{{ asset('/img/inventario/grasa.svg') }}"
                                                                            alt="" style="width:40px;">
                                                                    </div>
                                                                    <div style="width: 100%! important;">
                                                                        <label class="labelTitulo">Grasas:</label></br>
                                                                        <input type="number" min="0"
                                                                            class="inputCaja" id="grasa" name="grasa"
                                                                            value="{{ old('grasa') }}" step="0.01">
                                                                    </div>
                                                                </div>
                                                                <div class=" col-12 col-md-6 d-flex mb-4">
                                                                    <div class="me-2">
                                                                        <img src="{{ asset('/img/inventario/hidraulico.svg') }}"
                                                                            alt="" style="width:40px;">
                                                                    </div>
                                                                    <div style="width: 100%! important;">
                                                                        <label class="labelTitulo">Aceite
                                                                            Hidráulico:</label></br>
                                                                        <input type="number" min="0"
                                                                            class="inputCaja" id="hidraulico"
                                                                            name="hidraulico" value="{{ old('hidraulico') }}"
                                                                            step="0.01">
                                                                    </div>
                                                                </div>
                                                                <div class=" col-12 col-md-6 d-flex mb-4">
                                                                    <div class="me-2">
                                                                        <img src="{{ asset('/img/inventario/anticongelante.svg') }}"
                                                                            alt="" style="width:40px;">
                                                                    </div>
                                                                    <div style="width: 100%! important;">
                                                                        <label class="labelTitulo">Anticongelante:</label></br>
                                                                        <input type="number" min="0"
                                                                            class="inputCaja" id="Anticongelante"
                                                                            name="Anticongelante"
                                                                            value="{{ old('anticongelante') }}"
                                                                            step="0.01">
                                                                    </div>
                                                                </div>
                                                                <div class=" col-12 col-md-6 d-flex mb-4">
                                                                    <div class="me-2">
                                                                        <img src="{{ asset('/img/inventario/motor.svg') }}"
                                                                            alt="" style="width:40px;">
                                                                    </div>
                                                                    <div style="width: 100%! important;">
                                                                        <label class="labelTitulo">Aceite Motor:</label></br>
                                                                        <input type="number" min="0"
                                                                            class="inputCaja" id="motor" name="motor"
                                                                            value="{{ old('motor') }}" step="0.01">
                                                                    </div>
                                                                </div>
                                                                <div class=" col-12 col-md-6 d-flex mb-4">
                                                                    <div class="me-2">
                                                                        <img src="{{ asset('/img/inventario/otro.svg') }}"
                                                                            alt="" style="width:40px;">
                                                                    </div>
                                                                    <div style="width: 100%! important;">
                                                                        <label class="labelTitulo">Otro:</label></br>
                                                                        <input type="number" min="0"
                                                                            class="inputCaja" id="otro" name="otro"
                                                                            value="{{ old('otro') }}" step="0.01">
                                                                    </div>
                                                                </div>
                                                                <div class=" col-12 col-md-6 d-flex mb-4">
                                                                    <div class="me-2">
                                                                        <img src="{{ asset('/img/inventario/direccion.svg') }}"
                                                                            alt="" style="width:40px;">
                                                                    </div>
                                                                    <div style="width: 100%! important;">
                                                                        <label class="labelTitulo">Aceite
                                                                            Dirección:</label></br>
                                                                        <input type="number" min="0"
                                                                            class="inputCaja" id="direccion" name="direccion"
                                                                            value="{{ old('direccion') }}" step="0.01">
                                                                    </div>
                                                                </div>

                                                                {{--  <div class=" col-12 col-md-6 d-flex mb-4">
                                                                    <div class="me-2">
                                                                        <img src="{{ asset('/img/inventario/horometroIcono.svg') }}"
                                                                            alt="" style="width:40px;">
                                                                    </div>
                                                                    <div style="width: 100%! important;">
                                                                        <label class="labelTitulo">Horómetro:</label></br>
                                                                        <input type="number" step="0.1" min="0"
                                                                            class="inputCaja" id="horas" name="horas"
                                                                            value="{{ old('horas') }}">
                                                                    </div>
                                                                </div>  --}}

                                                            </div>

                                                        </div>


                                                    </div>
                                                </div>
                                                <div class="col-12 text-center mb-3 ">
                                                    <button type="submit" class="btn botonGral"
                                                        onclick="test()">Guardar</button>
                                                </div>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        @endcan


                        <!--Espacio para los tres camiones-->
                        <div class="row">

                            @foreach ($gasolinas as $gasolina)
                                <div class="col-sm-4">
                                    <div class="card">
                                        <div class="card-body combustibleBorde">
                                            <div class="bordeTitulo mb-3">
                                                <h2 class="combustibleTitulo fw-semibold  my-3"> {{ $gasolina->nombre }}
                                                </h2>
                                            </div>
                                            <div class="row ">
                                                <div class="col-12 mb-5">
                                                    <p class="text-end">Reserva</p>
                                                    <p class="combustibleLitros fw-semibold text-end">
                                                        {{ $gasolina->cisternaNivel }} lts.</p>
                                                </div>
                                                <div class="col mb-3">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <p class=" ">Última carga</p>
                                                            <p class="combustiblefecha fw-semibold mb-3">
                                                                {{ \Carbon\Carbon::parse($gasolina->created_at)->format('Y-m-d') }}
                                                            </p>
                                                            <p class="">$ por litro</p>
                                                            <p class="combustibleLitros fw-semibold">$
                                                                {{ $gasolina->precio }}
                                                            </p>
                                                        </div>
                                                        <div class="col-6">
                                                            <p class=" text-end">Litros Cargados</p>
                                                            <p class="combustibleLitros fw-semibold text-end">
                                                                {{ $gasolina->litros }} lts.</p>
                                                        </div>
                                                    </div>

                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                        {{--  GRAFICO CARGAS  --}}
                        <div class="row">
                            <div class="col-12">

                                <div class="card card-chart">
                                    <div class="card-header ">
                                        <div class="row">
                                            <div class="col-sm-6 text-left">
                                                <h5 class="card-category">Total de cargas</h5>
                                                <h2 class="card-title">Ultimos 30 Dias</h2>
                                            </div>
                                            <div class="col-sm-6 ">
                                                <div class="btn-group btn-group-toggle float-right d-flex"
                                                    data-toggle="buttons">
                                                    @foreach ($gasolinas as $gasolina)
                                                        <label class="btn btn-sm btn-primary btn-simple botongrafica"
                                                            id="1" aria-controls={{ $gasolina->id }}>
                                                            <input type="radio" class="d-none d-sm-none"
                                                                name="options">
                                                            <span
                                                                class="d-none d-sm-block d-md-block d-lg-block d-xl-block"
                                                                onclick="actualizar({{ $gasolina->id }})">
                                                                {{ $gasolina->nombre }}
                                                                <span class="d-block d-sm-none">
                                                                    <i class="tim-icons icon-gift-2"></i>
                                                                </span>
                                                        </label>
                                                    @endforeach

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="chart-area">
                                            <canvas id="chartBig1"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--Espacio para index carga y descarga-->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <!-- <div class="card-header bacTituloPrincipal">
                                                                                                                                                                                                                                                                                                                                                        <h4 class="card-title">Carga y descarga de combustible</h4>

                                                                                                                                                                                                                                                                                                                                                    </div>-->
                                    <div class="card-body mb-3">
                                        <div class="nav nav-tabs justify-content-evenly" id="myTab" role="tablist">
                                            <button
                                                class=" nav-item col-12 col-md-6 BTNbCargaDescarga py-3 border-0 active "
                                                role="presentation" id="home-tab" data-bs-toggle="tab"
                                                data-bs-target="#home-tab-pane" type="button" role="tab"
                                                aria-controls="home-tab-pane" aria-selected="true">Relación Cargas de
                                                Combustible</button>
                                            <button class="nav-item col-12 col-md-6 BTNbCargaDescarga "
                                                role="presentation" id="profile-tab" data-bs-toggle="tab"
                                                data-bs-target="#profile-tab-pane" type="button" role="tab"
                                                aria-controls="profile-tab-pane" aria-selected="false"> Relación Descargas
                                                de Combustible</button>
                                        </div>

                                        <div class="tab-content contentCargas" id="myTabContent">
                                            <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel"
                                                aria-labelledby="home-tab" tabindex="0">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <div class="table-responsive">
                                                                    <table class="table">
                                                                        <thead class="labelTitulo">
                                                                            <th class="fw-bolder">ID</th>
                                                                            <th class="fw-bolder">Equipos</th>
                                                                            <th class="fw-bolder">Despachador</th>
                                                                            <th class="fw-bolder">Litros</th>
                                                                            <th class="fw-bolder">Precio</th>
                                                                            <th class="fw-bolder">Fecha</th>
                                                                            <th class="fw-bolder">Hora</th>
                                                                            <th class="fw-bolder text-right">Acciones</th>
                                                                        </thead>
                                                                        <tbody>
                                                                            @forelse ($cargas as $carga)
                                                                                <tr>
                                                                                    <td>{{ $carga->id }}</td>
                                                                                    <td>{{ $carga->equipo }}</td>
                                                                                    <td>{{ $carga->operador }} </td>
                                                                                    <td>
                                                                                        {{ number_format($carga->litros, 2, '.', ',') }}
                                                                                    </td>
                                                                                    <td>
                                                                                        $
                                                                                        {{ number_format($carga->precio, 2, '.', ',') }}
                                                                                    </td>
                                                                                    <td>
                                                                                        {{ \Carbon\Carbon::parse($carga->fecha)->format('Y-m-d') }}
                                                                                    </td>
                                                                                    <td>
                                                                                        {{ \Carbon\Carbon::parse($carga->fecha)->format('H:m') }}
                                                                                    </td>

                                                                                    <td
                                                                                        class="td-actions justify-content-end">
                                                                                        @can('combustible_edit')
                                                                                            <a href="#" class=""
                                                                                                data-bs-toggle="modal"
                                                                                                data-bs-target="#cargaCombustible"
                                                                                                onclick="loadCarga('{{ $carga->id }}','{{ $carga->maquinariaid }}','{{ $carga->operadorid }}'
                                                                                        ,'{{ $carga->litros }}','{{ $carga->precio }}'
                                                                                        ,'{{ \Carbon\Carbon::parse($carga->fecha)->format('Y-m-d') }}','{{ \Carbon\Carbon::parse($carga->fecha)->format('H:m') }}')">
                                                                                                <svg xmlns="http://www.w3.org/2000/svg "
                                                                                                    width="28"
                                                                                                    height="28"
                                                                                                    fill="currentColor"
                                                                                                    class="bi bi-pencil accionesIconos"
                                                                                                    viewBox="0 0 16 16">
                                                                                                    <path
                                                                                                        d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                                                                                                </svg>
                                                                                            </a>
                                                                                        @endcan

                                                                                        <form
                                                                                            action="{{ route('inventario.deleteCarga', $carga->id) }}"
                                                                                            method="POST"
                                                                                            style="display: inline-block;"
                                                                                            onsubmit="return confirm('¿Estás seguro?')">
                                                                                            @csrf
                                                                                            @method('DELETE')

                                                                                            @can('combustible_destroy')
                                                                                                <button class=" btnSinFondo"
                                                                                                    type="submit"
                                                                                                    rel="tooltip">
                                                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                                                        width="28"
                                                                                                        height="28"
                                                                                                        fill="currentColor"
                                                                                                        class="bi bi-x-circle"
                                                                                                        viewBox="0 0 16 16">
                                                                                                        <path
                                                                                                            d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                                                                        <path
                                                                                                            d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                                                                                                    </svg>
                                                                                                </button>
                                                                                            @endcan


                                                                                        </form>
                                                                                    </td>
                                                                                </tr>
                                                                            @empty
                                                                                <tr>
                                                                                    <td colspan="7"
                                                                                        class="text-center">Sin
                                                                                        información registrada.</td>
                                                                                </tr>
                                                                            @endforelse


                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel"
                                                aria-labelledby="profile-tab" tabindex="0">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <div class="table-responsive">
                                                                    <table class="table">
                                                                        <thead class="labelTitulo">
                                                                            <th class="fw-bolder">ID</th>
                                                                            <th class="fw-bolder">Equipo</th>
                                                                            <th class="fw-bolder">Despachador</th>
                                                                            <th class="fw-bolder">Maquinaria</th>
                                                                            <th class="fw-bolder">Operador</th>
                                                                            <th class="fw-bolder">Kms</th>
                                                                            <th class="fw-bolder">Horas</th>
                                                                            <th class="fw-bolder">Litros</th>
                                                                            <th class="fw-bolder">fecha</th>
                                                                            <th class="fw-bolder">hora</th>
                                                                            <th class="fw-bolder text-right">Acciones</th>
                                                                        </thead>
                                                                        <tbody>

                                                                            @forelse ($descargas as $descarga)
                                                                                <tr>
                                                                                    <td>{{ $descarga->id }}</td>
                                                                                    <td>{{ $descarga->maquinaria }}</td>
                                                                                    <td>{{ $descarga->operador }}</td>
                                                                                    <td>{{ $descarga->servicio }}</td>
                                                                                    <td>{{ $descarga->receptor }}</td>
                                                                                    <td>{{ $descarga->km }}</td>
                                                                                    {{--  <td>{{ $descarga->horas }}</td>  --}}
                                                                                    <td>
                                                                                        {{ number_format($descarga->litros, 2, '.', ',') }}
                                                                                    </td>
                                                                                    <td>
                                                                                        {{ \Carbon\Carbon::parse($descarga->fecha)->format('Y-m-d') }}
                                                                                    </td>
                                                                                    <td>
                                                                                        {{ \Carbon\Carbon::parse($descarga->fecha)->format('H:m') }}
                                                                                    </td>

                                                                                    <td
                                                                                        class="td-actions justify-content-end">
                                                                                        @can('combustible_edit')
                                                                                            <a href="#" class=""
                                                                                                data-bs-toggle="modal"
                                                                                                data-bs-target="#descargaCombustible"
                                                                                                onclick="loadDescarga('{{ $descarga->id }}','{{ $descarga->maquinariaId }}','{{ $descarga->operadorId }}',
                                                                                        '{{ $descarga->servicioId }}','{{ $descarga->receptorId }}','{{ $descarga->litros }}',
                                                                                        '{{ $descarga->km }}','{{ $descarga->imgKm ? $descarga->imgKm : '0' }}','{{ $descarga->horas }}','{{ $descarga->imgHoras ? $descarga->imgHoras : '0' }}'
                                                                                        ,'{{ \Carbon\Carbon::parse($descarga->fecha)->format('Y-m-d') }}','{{ \Carbon\Carbon::parse($descarga->fecha)->format('H:m') }}')">
                                                                                                <svg xmlns="http://www.w3.org/2000/svg "
                                                                                                    width="28"
                                                                                                    height="28"
                                                                                                    fill="currentColor"
                                                                                                    class="bi bi-pencil accionesIconos"
                                                                                                    viewBox="0 0 16 16">
                                                                                                    <path
                                                                                                        d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                                                                                                </svg>
                                                                                            </a>
                                                                                        @endcan

                                                                                        {{-- id, maquinariaId, operadorId, servicioId, receptorId, litros, kms, imagenKms, horas, imgHoras, fecha --}}
                                                                                        <form
                                                                                            action="{{ route('inventario.deleteDescarga', $descarga->id) }}"
                                                                                            method="POST"
                                                                                            style="display: inline-block;"
                                                                                            onsubmit="return confirm('¿Estás seguro?')">
                                                                                            @csrf
                                                                                            @method('DELETE')
                                                                                            @can('combustible_destroy')
                                                                                                <button class=" btnSinFondo"
                                                                                                    type="submit"
                                                                                                    rel="tooltip">
                                                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                                                        width="28"
                                                                                                        height="28"
                                                                                                        fill="currentColor"
                                                                                                        class="bi bi-x-circle"
                                                                                                        viewBox="0 0 16 16">
                                                                                                        <path
                                                                                                            d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                                                                        <path
                                                                                                            d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                                                                                                    </svg>
                                                                                                </button>
                                                                                            @endcan

                                                                                        </form>
                                                                                    </td>
                                                                                </tr>
                                                                            @empty
                                                                                <tr>
                                                                                    <td colspan="9"
                                                                                        class="text-center">Sin
                                                                                        información registrada.</td>
                                                                                </tr>
                                                                            @endforelse
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ----MODALES DE CARGA Y DESCARGA ----- -->

    <!-- Button trigger modal -->


    <!-- Modal Carga-->
    <div class="modal fade" id="cargaCombustible" tabindex="-1" aria-labelledby="cargaCombustibleLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bacTituloPrincipal">
                    <h1 class="modal-title fs-5" id="cargaCombustibleLabel">Modificar Carga de Combustible</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('inventario.updateCarga') }}" method="post" class="row">
                        @csrf
                        @method('put')

                        <input type="hidden" name="cargaId" id="cargaId" value="">
                        <div class="col-6 my-3">
                            <label for="inputEmail4" class="form-label">Equipo</label>
                            <select id="cargaMaquinaria" name="cargaMaquinaria" class="form-select">
                                @foreach ($cisternas as $maquina)
                                    <option value="{{ $maquina->id }}">
                                        {{ $maquina->nombre . ' / ' . $maquina->modelo . ($maquina->placas != '' ? ' [' . $maquina->placas . ']' : '') }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-6 my-3">
                            <label for="inputEmail4" class="form-label">Despachador</label>
                            <select id="cargaOperador" name="cargaOperador" class="form-select">
                                @foreach ($despachadores as $persona)
                                    <option value="{{ $persona->id }}">
                                        {{ $persona->nombres . ' ' . $persona->apellidoP }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-3 my-3">
                            <label for="inputEmail4" class="form-label">Litros</label>
                            <input type="number" step="0.01" min="0.01" class="form-control" id="cargaLitros"
                                name="cargaLitros">
                        </div>
                        <div class="col-3 my-3">
                            <label for="inputEmail4" class="form-label">Precio</label>
                            <input type="number" step="0.01" min="0.01" class="form-control" id="cargaPrecio"
                                name="cargaPrecio">
                        </div>

                        <div class="col-3 my-3">
                            <label for="inputEmail4" class="form-label">Fecha</label>
                            <input type="datetime" class="form-control" id="cargaFecha" name="cargaFecha"
                                value="">
                        </div>

                        <div class="col-3 my-3">
                            <label for="inputEmail4" class="form-label">Hora carga</label>
                            <input type="time" class="form-control" id="cargaHora" name="cargaHora" value="">
                        </div>

                        <div class="modal-footer">

                            <button type="submit" class="btn botonGral">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Descarga-->
    <div class="modal fade" id="descargaCombustible" tabindex="-1" aria-labelledby="descargaCombustibleLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header bacTituloPrincipal">
                    <h1 class="modal-title fs-5" id="descargaCombustibleLabel">Modificar Descarga de Combustible</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('inventario.updateDescarga') }}" method="post" class="row"
                        enctype="multipart/form-data">
                        @csrf
                        @method('put')

                        <input type="hidden" name="descargaId" id="descargaId" value="">

                        <div class="col-6 my-3">
                            <label for="inputEmail4" class="form-label">Equipo</label>
                            <select id="descargaMaquinaria" name="descargaMaquinaria" class="form-select">
                                @foreach ($cisternas as $maquina)
                                    <option value="{{ $maquina->id }}">
                                        {{ $maquina->nombre . ' / ' . $maquina->modelo . ($maquina->placas != '' ? ' [' . $maquina->placas . ']' : '') }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-6 my-3">
                            <label for="inputEmail4" class="form-label">Despachador</label>
                            <select id="descargaOperador" name="descargaOperador" class="form-select">
                                @foreach ($despachadores as $persona)
                                    <option value="{{ $persona->id }}">
                                        {{ $persona->nombres . ' ' . $persona->apellidoP }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-6 my-3">
                            <label for="inputEmail4" class="form-label">Maquinaria</label>
                            <select id="descargaServicio" name="descargaServicio" class="form-select">
                                @foreach ($maquinaria as $maquina)
                                    <option value="{{ $maquina->id }}">
                                        {{ $maquina->nombre . ' / ' . $maquina->modelo . ($maquina->placas != '' ? ' [' . $maquina->placas . ']' : '') }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-6 my-3">
                            <label for="inputEmail4" class="form-label">Operador</label>
                            <select id="descargaDespachador" name="descargaDespachador" class="form-select"
                                style="width: 200px !important;">
                                @foreach ($despachadores as $persona)
                                    <option value="{{ $persona->id }}">
                                        {{ $persona->nombres . ' ' . $persona->apellidoP }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-4 my-3">
                            <label for="inputEmail4" class="form-label">Litros</label>
                            <input type="number" step="0.01" min="0.01" class="form-control"
                                id="descargaLitros" name="descargaLitros">
                        </div>

                        <div class="col-4 my-3">
                            <label for="inputEmail4" class="form-label">Fecha</label>
                            <input type="datetime" class="form-control" id="descargaFecha" name="descargaFecha"
                                value="">
                        </div>
                        {{-- <div class="col-4 my-3">
                            <label for="inputEmail4" class="form-label">Hora Carga</label>
                            <input type="time" class="form-control" id="">
                        </div> --}}

                        <div class="col-4 my-3">
                            <label for="inputEmail4" class="form-label">Hora descarga</label>
                            <input type="time" class="form-control" id="descargaHora" name="descargaHora"
                                value="">
                        </div>

                        <div class="col-4 my-3">
                            <label for="inputEmail4" class="form-label">Horómetro</label>
                            <input type="number"step="1" min="1" class="form-control" id="descargaHoras"
                                name="descargaHoras">
                        </div>

                        <div class="col-4 my-3">
                            <label for="inputEmail4" class="form-label">Km Mi</label>
                            <input type="number" step="1" min="1" class="form-control" id="descargaKms"
                                name="descargaKms">
                        </div>

                        <div class="col my-3">
                            <div class="row justify-content-evenly ">
                                <div class="col-5 my-3">
                                    <div class=" mx-auto border vistaFoto mb-4">
                                        <i><img class=" img-fluid mb-5" id="descargaImgKms"
                                                src="{{ asset('/img/general/default.jpg') }}"></i>
                                        <span class="mi-archivo3"> <input class="mb-4 ver" type="file"
                                                name="descargaFileImgKms" id="mi-archivo3" accept="image/*"></span>
                                        <label for="mi-archivo3">
                                            <span class="text-center">Fotografía</span>
                                        </label>
                                    </div>
                                </div>

                                <div class="col-5  my-3">
                                    <div class=" mx-auto border vistaFotoModalCarga-Desc mb-4">
                                        <i><img class=" img-fluid mb-5" id="descargaImgHoras"
                                                src="{{ asset('/img/general/default.jpg') }}"></i>
                                        <span class="mi-archivo4"> <input class="mb-4 ver" type="file"
                                                name="descargaFileImgHoras" id="mi-archivo4" accept="image/*"></span>
                                        <label for="mi-archivo4">
                                            <span>logo</span>
                                        </label>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn botonGral">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        function actualizar(id) {

            $.ajax({
                type: 'post',
                url: '/inventario/combustible/',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": id
                },
                success: function(data) {
                    var datos = JSON.parse(data);
                    var chart_labels = datos.dia;
                    var chart_data = datos.suma;

                    //alert(chart_labels);
                    var data = myChartData.config.data;
                    data.datasets[0].data = chart_data;
                    data.labels = chart_labels;
                    myChartData.update();
                    console.log(chart_data);
                },
                error: function() {
                    console.log('Error');
                }
            });


        };
    </script>
    <script>
        const ctx = document.getElementById('chartBig1');

        gradientChartOptionsConfigurationWithTooltipPurple = {
            maintainAspectRatio: false,
            legend: {
                display: false
            },

            tooltips: {
                backgroundColor: '#f5f5f5',
                titleFontColor: '#333',
                bodyFontColor: '#666',
                bodySpacing: 4,
                xPadding: 12,
                mode: "nearest",
                intersect: 0,
                position: "nearest"
            },
            responsive: true,
            scales: {
                yAxes: [{
                    barPercentage: 1.6,
                    gridLines: {
                        drawBorder: false,
                        color: 'rgba(29,140,248,0.0)',
                        zeroLineColor: "transparent",
                    },
                    ticks: {
                        suggestedMin: 60,
                        suggestedMax: 125,
                        padding: 20,
                        fontColor: "#9a9a9a"
                    }
                }],

                xAxes: [{
                    barPercentage: 1.6,
                    gridLines: {
                        drawBorder: false,
                        color: 'rgba(225,78,202,0.1)',
                        zeroLineColor: "transparent",
                    },
                    ticks: {
                        padding: 20,
                        fontColor: "#9a9a9a"
                    }
                }]
            }
        };

        //var chart_labels = ['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'];
        //var chart_data = [100, 70, 90, 70, 85, 60, 75, 60, 90, 80, 110, 100];

        var chart_labels = new Array();
        <?php
        foreach ($dia as $indice => $valor) {
            echo "chart_labels[$indice] = $valor;\n";
        }
        ?>

        var chart_data = new Array();
        <?php
        foreach ($suma as $indice => $valor) {
            echo "chart_data[$indice] = $valor;\n";
        }
        ?>


        var myChartData = new Chart(ctx, {
            type: 'line',
            data: {
                labels: chart_labels,
                datasets: [{
                    label: '# of Votes', //titulo
                    data: chart_data,
                    backgroundColor: '#9a9a9a',
                    orderColor: '# DF0101 ', //no se
                    borderWidth: 2, //borde de la tabla
                    borderDash: [],
                    pointStyle: "circle", //puntos de interseccion
                    borderDashOffset: 0.0,
                    pointBackgroundColor: '#DF0101', //color de punto de interceccion
                    pointBorderColor: 'rgba(255,255,255,0)',
                    pointHoverBackgroundColor: '#DF0101',
                    pointBorderWidth: 20,
                    pointHoverRadius: 4,
                    pointHoverBorderWidth: 15,
                    pointRadius: 4,
                    borderWidth: 1
                }]
            },
            options: gradientChartOptionsConfigurationWithTooltipPurple
        });

        $("#0").click(function() {
            console.log(chart_data);
            var data = myChartData.config.data;
            data.datasets[0].data = chart_data;
            data.labels = chart_labels;
            myChartData.update();
            console.log(chart_data);

        });

        $("#1").click(function(e) {
            let id = $(this).attr("aria-controls");
            $.ajax({
                type: 'post',
                url: '/inventario/combustible/',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": id
                },
                success: function(data) {
                    var datos = JSON.parse(data);
                    var chart_labels = datos.dia;
                    var chart_data = datos.suma;

                    //alert(chart_labels);
                    var data = myChartData.config.data;
                    data.datasets[0].data = chart_data;
                    data.labels = chart_labels;
                    myChartData.update();
                    console.log(chart_data);
                },
                error: function() {
                    console.log('Error');
                }
            });


        });

        $("#2").click(function(e) {
            let id = $(this).attr("aria-controls");
            $.ajax({
                type: 'post',
                url: '/inventario/combustible/',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": id
                },
                success: function(data) {
                    var datos = JSON.parse(data);
                    var chart_labels = datos.dia;
                    var chart_data = datos.suma;

                    //alert(chart_labels);
                    var data = myChartData.config.data;
                    data.datasets[0].data = chart_data;
                    data.labels = chart_labels;
                    myChartData.update();
                    console.log(chart_data);
                },
                error: function() {
                    console.log('Error');
                }
            });
        });
    </script>

    <script>
        function changeImage() {
            var image = document.getElementById('myImage');
            image.src = "{{ asset('img/inventario/cargaVerde.svg') }}";
            var image = document.getElementById('myImage1');
            image.src = "{{ asset('img/inventario/descargaGris.svg') }}";
        }


        function changeImage1() {
            var image = document.getElementById('myImage1');
            image.src = "{{ asset('img/inventario/descargaRojo.svg') }}";
            var image = document.getElementById('myImage');
            image.src = "{{ asset('img/inventario/cargaGris.svg') }}";
        }
    </script>

    <script>
        function loadCarga(id, maquinariaId, operadorId, litros, precio, fecha, hora) {

            const txtId = document.getElementById('cargaId');
            txtId.value = id;

            const lstEquipo = document.getElementById('cargaMaquinaria').value = maquinariaId;

            const lstOperador = document.getElementById('cargaOperador').value = operadorId;

            const txtLitros = document.getElementById('cargaLitros');
            txtLitros.value = litros;

            const txtPrecio = document.getElementById('cargaPrecio');
            txtPrecio.value = precio;

            const dteFecha = document.getElementById('cargaFecha').value = fecha;
            const dteHora = document.getElementById('cargaHora').value = hora;
        }
    </script>

    <script>
        function loadDescarga(id, maquinariaId, operadorId, servicioId, receptorId, litros, kms, imagenKms, horas, imgHoras,
            fecha, hora) {

            const txtId = document.getElementById('descargaId');
            txtId.value = id;

            const lstEquipo = document.getElementById('descargaMaquinaria').value = maquinariaId;

            const lstOperador = document.getElementById('descargaOperador').value = operadorId;

            const lstServicio = document.getElementById('descargaServicio').value = servicioId;

            const lstReceptor = document.getElementById('descargaDespachador').value = receptorId;

            const txtLitros = document.getElementById('descargaLitros');
            txtLitros.value = litros;

            const txtKms = document.getElementById('descargaKms');
            txtKms.value = kms;

            const txtHoras = document.getElementById('descargaHoras');
            txtHoras.value = horas;

            const dteFecha = document.getElementById('descargaFecha').value = fecha;
            const dteHora = document.getElementById('descargaHora').value = hora;

            const imagen1 = document.getElementById('descargaImgKms');
            if (imagenKms != 0) {
                imagen1.src = '/storage/combustibles/' + imagenKms;
            }

            const imagen2 = document.getElementById('descargaImgHoras');
            if (imgHoras != 0) {
                imagen2.src = '/storage/combustibles/' + imgHoras;
            }

        }
    </script>

    <script type="application/javascript">
    jQuery('input[type=file]').change(function(){
     var filename = jQuery(this).val().split('\\').pop();
     var idname = jQuery(this).attr('id');
     console.log(jQuery(this));
     console.log(filename);
     console.log(idname);
     jQuery('span.'+idname).next().find('span').html(filename);
    });
    </script>

@endsection
