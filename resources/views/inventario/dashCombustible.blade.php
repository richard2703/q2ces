@extends('layouts.main', ['activePage' => 'inventario', 'titlePage' => __('Carga y Descarga')])
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
                        <div class="card-body contCart">
                            <div class="p-1 align-self-start bacTituloPrincipal">
                                <h2 class="my-3 ms-3 texticonos ">Carga y Descarga</h2>
                            </div>

                            <div class="col-11  mx-auto d-block my-4 border-bottom">

                                <nav class="border-bottom ">
                                    <div class="nav nav-tabs justify-content-evenly" id="nav-tab"
                                        role="tablist">
                                        <button class="nav-link active combustiblePestaña  col-3" id="balanceUno-tab" data-bs-toggle="tab" data-bs-target="#balanceUno" type="button" role="tab"
                                            aria-controls="balanceUno" aria-selected="true">


                                            <img id="myImage" onclick="changeImage()"src="{{ asset('img/inventario/cargaVerde.svg') }}" class="imgcargas">
                                            <p class="text-center mt-2">CARGA</p>
                                        </button>

                                        <button class="nav-link  combustiblePestaña col-3" id="balanceDos-tab"
                                            data-bs-toggle="tab" data-bs-target="#balanceDos" type="button" role="tab"
                                            aria-controls="balanceDos" aria-selected="false">


                                            <img id="myImage1" onclick="changeImage1()"
                                                src="{{ asset('img/inventario/descargaGris.svg') }}" class="imgcargas"
                                                width="65%">
                                            <p class="text-center mt-2">DESCARGA</p>
                                        </button>
                                        
                                        {{--  <div class="col-4">
                                            <p class="text-end mb-2">Datos de Registro</p>
                                            <p class="text-end combustibleFecha"> 22/11/2022</p>
                                            <p class="text-end combustibleHora my-2">2:00 pm</p>
                                        </div>  --}}
                                    </div>
                                </nav>
                                <div class="tab-content" id="nav-tabContent ">
                                    <!-- Espacio para carga -->
                                    <div class="tab-pane fade show active border-top" id="balanceUno" role="tabpanel" aria-labelledby="balanceUno-tab" tabindex="0">
                                        <form action="{{ route('inventario.cargaCombustible') }}" method="post">
                                            @csrf
                                            @method('put')
                                            <div class="col-12 my-5 ">
                                                <div class="row mt-5">
                                                    <div class="col-12">
                                                        <div class="row ">
                                                            <div class=" col-6 d-flex mb-4">
                                                                <div class="me-2">
                                                                    <img src="{{ asset('/img/inventario/equipo_1.svg') }}" alt="" style="width:40px;">
                                                                </div>
                                                                <div>
                                                                    <label class="labelTitulo">Equipo:</label></br>
                                                                    <select id="maquinariaId" name="maquinariaId" class="form-select" aria-label="Default select example">
                                                                        @foreach ($cisternas as $maquina)
                                                                            <option value="{{ $maquina->id }}">
                                                                                {{ $maquina->nombre . ' / ' . $maquina->modelo . ($maquina->placas != '' ? ' [' . $maquina->placas . ']' : '') }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class=" col-6 d-flex mb-4">
                                                                <div class="me-2">
                                                                    <img src="{{ asset('/img/inventario/despachador.svg') }}" alt="" style="width:40px;">
                                                                </div>
                                                                <div>
                                                                    <label class="labelTitulo">Despachador:</label></br>
                                                                    <select id="operadorId" name="operadorId" class="form-select" aria-label="Default select example">
                                                                        @foreach ($despachador as $persona)
                                                                            <option value="{{ $persona->id }}">
                                                                                {{ $persona->nombres . ' ' . $persona->apellidoP }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class=" col-6 d-flex mb-4">
                                                                <div class="me-2">
                                                                    <img src="{{ asset('/img/inventario/litros.svg') }}" alt="" style="width:40px;">
                                                                </div>
                                                                <div>
                                                                    <label class="labelTitulo">Litros:</label></br>
                                                                    <input type="number" step="0.01" min="0.01" class="inputCaja" id="litros" name="litros" value="{{ old('litros') }}">
                                                                </div>
                                                            </div>


                                                            <div class=" col-6 d-flex mb-4">
                                                                <div class="me-2">
                                                                    <img src="{{ asset('/img/inventario/precio.svg') }}" alt="" style="width:40px;">
                                                                </div>
                                                                <div>
                                                                    <label class="labelTitulo">Precio:</label></br>
                                                                    <input type="number" step="0.01" min="0.01" class="inputCaja" id="precio" name="precio" value="{{ old('precio') }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 text-center mb-3 ">
                                                <button type="submit" class="btn botonGral" onclick="test()">Guardar</button>
                                            </div>
                                        </form>

                                    </div>
                                    <!-- Espacio para descarga -->
                                    <div class="tab-pane fade border-top" id="balanceDos" role="tabpanel" aria-labelledby="balanceDos-tab" tabindex="0">
                                        <form action="{{ route('inventario.descargaCombustible') }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            @method('put')
                                            <div class="col-12 my-5 ">
                                                <div class="row mt-5">
                                                    <div class="col-4">
                                                        <div class="text-center mx-auto border vistaFoto mb-4">
                                                            <i>
                                                                <img class="imgVistaCombustible img-fluid mb-2" src="{{ asset('/img/inventario/horometro.svg') }}">
                                                            </i>
                                                            <span class="mi-archivo"> <input class="mb-4 ver "  type="file" name="imgKm" id="mi-archivo" accept="image/*" multiple></span>
                                                            <label for="mi-archivo">
                                                                <span class="">Sube Imagen</span>
                                                            </label>
                                                        </div>
                                                        <div class="text-center mx-auto border vistaFoto mb-4">
                                                            <i>
                                                                <img class="imgVistaCombustible img-fluid mb-2" src="{{ asset('/img/inventario/kilometraje.svg') }}">
                                                            </i>
                                                            <span class="mi-archivo2"> <input class="mb-4 ver "  type="file" name="imgHoras" id="mi-archivo2" accept="image/*" multiple></span>
                                                            <label for="mi-archivo2">
                                                                <span class="">Sube Imagen</span>
                                                            </label>
                                                        </div>

                                                    </div>
                                                    <div class="col-8">
                                                        <div class="row ">
                                                            <div class=" col-6 d-flex mb-4">
                                                                <div class="me-2">
                                                                    <img src="{{ asset('/img/inventario/equipo_1.svg') }}"
                                                                        alt="" style="width:40px;">
                                                                </div>
                                                                <div>
                                                                    <label class="labelTitulo">Equipo:</label></br>
                                                                    <select id="servicioId" name="servicioId"
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

                                                            <div class=" col-6 d-flex mb-4">
                                                                <div class="me-2">
                                                                    <img src="{{ asset('/img/navs/eqiposMenu.svg') }}"
                                                                        alt="" style="width:40px;">
                                                                </div>
                                                                <div>
                                                                    <label class="labelTitulo">Maquinaria:</label></br>
                                                                    <select id="maquinariaId" name="maquinariaId"
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

                                                            <div class=" col-6 d-flex mb-4">
                                                                <div class="me-2">
                                                                    <img src="{{ asset('/img/inventario/despachador.svg') }}"
                                                                        alt="" style="width:40px;">
                                                                </div>
                                                                <div>
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

                                                            <div class=" col-6 d-flex mb-4">
                                                                <div class="me-2">
                                                                    <img src="{{ asset('/img/navs/personalMenu.svg') }}"
                                                                        alt="" style="width:40px;">
                                                                </div>
                                                                <div>
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

                                                            <div class=" col-6 d-flex mb-4">
                                                                <div class="me-2">
                                                                    <img src="{{ asset('/img/inventario/litros.svg') }}"
                                                                        alt="" style="width:40px;">
                                                                </div>
                                                                <div>
                                                                    <label class="labelTitulo">Litros:</label></br>
                                                                    <input type="number" step="0.01" min="0.01"
                                                                        class="inputCaja" id="litros" name="litros"
                                                                        value="{{ old('litros') }}">
                                                                </div>
                                                            </div>
                                                            <div class=" col-6 d-flex mb-4">
                                                                <div class="me-2">
                                                                    <img src="{{ asset('/img/inventario/iconoKm.svg') }}"
                                                                        alt="" style="width:40px;">
                                                                </div>
                                                                <div>
                                                                    <label class="labelTitulo">Km/Mi:</label></br>
                                                                    <input type="number" step="0.01" min="0.01"
                                                                        class="inputCaja" id="km" name="km"
                                                                        value="{{ old('km') }}">
                                                                </div>
                                                            </div>

                                                            <div class=" col-6 d-flex mb-4">
                                                                <div class="me-2">
                                                                    <img src="{{ asset('/img/inventario/horometroIcono.svg') }}"
                                                                        alt="" style="width:40px;">
                                                                </div>
                                                                <div>
                                                                    <label class="labelTitulo">Horómetro:</label></br>
                                                                    <input type="number" step="0.01" min="0.01"
                                                                        class="inputCaja" id="horas" name="horas"
                                                                        value="{{ old('horas') }}">
                                                                </div>
                                                            </div>

                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 text-center mb-3 ">
                                                <button type="submit" class="btn botonGral" onclick="test()">Guardar</button>
                                            </div>
                                        </form>
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
                                          <button class=" nav-item col-6 BTNbCargaDescarga py-3 border-0 active " role="presentation" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Relación Cargas de Combustible</button>
                                          <button class="nav-item col-6 BTNbCargaDescarga " role="presentation" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false"> Relación Descargas de Combustible</button>   
                                    </div>

                                    <div class="tab-content contentCargas" id="myTabContent">
                                        <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <div class="table-responsive">
                                                                <table class="table">
                                                                    <thead class="labelTitulo">
                                                                        <th class="fw-bolder">ID</th>
                                                                        <th class="fw-bold">Equipos</th>
                                                                        <th class="fw-bolder">Despachador</th>
                                                                        <th class="fw-bolder">Litros</th>
                                                                        <th class="fw-bolder">Precio</th>
                                                                        <th class="fw-bolder">fecha</th>
                                                                        <th class="fw-bolder text-right">Acciones</th>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td>50</td>
                                                                            <td>Toyota Hilux </td>
                                                                            <td>Jalisco </td>
                                                                            <td>Javier</td>
                                                                            <td>300</td>
                                                                            <td>12/01/2023 </td>

                                                                       
                        
                                                                            <td class="td-actions justify-content-end">                                                                           
                                                                                <a href="#"  class="" data-bs-toggle="modal" data-bs-target="#cargaCombustible" >
                                                                                    <svg xmlns="http://www.w3.org/2000/svg " width="28" height="28" fill="currentColor" class="bi bi-pencil accionesIconos" viewBox="0 0 16 16">
                                                                                        <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                                                                    </svg>
                                                                                </a>
                                                                                   
                                                                                <form action="">
                                                                                    <button class=" btnSinFondo" type="submit" rel="tooltip">
                                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                                                                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                                                                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                                                                        </svg>
                                                                                    </button>
                                                                                </form>
                                                                            </td>
                                                                        </tr>
                                                                       
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <div class="table-responsive">
                                                                <table class="table">
                                                                    <thead class="labelTitulo">
                                                                        <th class="fw-bolder">ID</th>
                                                                        <th class="fw-bold">Equipo</th>
                                                                        <th class="fw-bolder">Maquinaria</th>
                                                                        <th class="fw-bolder">Despachador</th>
                                                                        <th class="fw-bolder">Operador</th>
                                                                        <th class="fw-bolder">Litros</th>
                                                                        <th class="fw-bolder">Precio</th>
                                                                        <th class="fw-bolder">fecha</th>
                                                                        <th class="fw-bolder text-right">Acciones</th>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td>50</td>
                                                                            <td>Toyota Hilux </td>
                                                                            <td>Retroexcabadora </td>
                                                                            <td>Javier</td>
                                                                            <td>Jorge</td>
                                                                            <td>300 </td>
                                                                            <td>20.99 </td>
                                                                            <td>20/05/2023 </td>
                        
                                                                            <td class="td-actions justify-content-end">                                                                           
                                                                                <a href="#"  class="" data-bs-toggle="modal" data-bs-target="#descargaCombustible">
                                                                                    <svg xmlns="http://www.w3.org/2000/svg " width="28" height="28" fill="currentColor" class="bi bi-pencil accionesIconos" viewBox="0 0 16 16">
                                                                                        <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                                                                    </svg>
                                                                                </a>
                                                                                   
                                                                                <form action="">
                                                                                    <button class=" btnSinFondo" type="submit" rel="tooltip">
                                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                                                                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                                                                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                                                                        </svg>
                                                                                    </button>
                                                                                </form>
                                                                            </td>
                                                                        </tr>
                                                                       
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



                    <!--Espacio para los tres camiones-->
                    <div class="row">

                        @foreach ($gasolinas as $gasolina)
                            <div class="col-sm-4">
                                <div class="card">
                                    <div class="card-body combustibleBorde">
                                        <div class="bordeTitulo mb-3">
                                            <h2 class="combustibleTitulo fw-semibold  my-3"> {{ $gasolina->nombre }}</h2>
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
                                                        <p class=" ">Útima carga</p>
                                                        <p class="combustiblefecha fw-semibold mb-3">
                                                            {{ \Carbon\Carbon::parse($gasolina->created_at)->format('Y-m-d') }}
                                                        </p>
                                                        <p class="">$ por litro</p>
                                                        <p class="combustibleLitros fw-semibold">$ {{ $gasolina->precio }}
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

                        {{--  <div class="col-sm-4">
                            <div class="card">
                                <div class="card-body combustibleBorde">
                                    <div class="bordeTitulo mb-3">
                                        <h2 class="combustibleTitulo fw-semibold  my-3"> TOYOTA HILUX</h2>
                                    </div>
                                    <div class="row ">
                                        <div class="col-12 mb-5">
                                            <p class="text-end">Reserva</p>
                                            <p class="combustibleLitros fw-semibold text-end">20 lts.</p>
                                        </div>
                                        <div class="col mb-3">
                                            <div class="row">
                                                <div class="col-6">
                                                    <p class=" ">Útima carga</p>
                                                    <p class="combustiblefecha fw-semibold mb-3">20/11/2022</p>
                                                    <p class="">$ por litro</p>
                                                    <p class="combustibleLitros fw-semibold">$ 30.5</p>
                                                </div>
                                                <div class="col-6">
                                                    <p class=" text-end">Litros Cargados</p>
                                                    <p class="combustibleLitros fw-semibold text-end">30 lts.</p>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="card">
                                <div class="card-body combustibleBorde">
                                    <div class="bordeTitulo mb-3">
                                        <h2 class="combustibleTitulo fw-semibold  my-3"> RENAULT KANGOO</h2>
                                    </div>
                                    <div class="row ">
                                        <div class="col-12 mb-5">
                                            <p class="text-end">Reserva</p>
                                            <p class="combustibleLitros fw-semibold text-end">20 lts.</p>
                                        </div>
                                        <div class="col mb-3">
                                            <div class="row">
                                                <div class="col-6">
                                                    <p class=" ">Útima carga</p>
                                                    <p class="combustiblefecha fw-semibold mb-3">20/11/2022</p>
                                                    <p class="">$ Por litro</p>
                                                    <p class="combustibleLitros fw-semibold">$ 30.5</p>
                                                </div>
                                                <div class="col-6">
                                                    <p class=" text-end">Litros Cargados</p>
                                                    <p class="combustibleLitros fw-semibold text-end">30 lts.</p>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="card">
                                <div class="card-body combustibleBorde">
                                    <div class="bordeTitulo mb-3">
                                        <h2 class="combustibleTitulo fw-semibold  my-3"> CAMIÓN ORQUESTA</h2>
                                    </div>
                                    <div class="row ">
                                        <div class="col-12 mb-5">
                                            <p class="text-end">Reserva</p>
                                            <p class="combustibleLitros fw-semibold text-end">20 lts.</p>
                                        </div>
                                        <div class="col mb-3">
                                            <div class="row">
                                                <div class="col-6">
                                                    <p class=" ">Útima carga</p>
                                                    <p class="combustiblefecha fw-semibold mb-3">20/11/2022</p>
                                                    <p class="">$ Por litro</p>
                                                    <p class="combustibleLitros fw-semibold">$ 30.5</p>
                                                </div>
                                                <div class="col-6">
                                                    <p class=" text-end">Litros Cargados</p>
                                                    <p class="combustibleLitros fw-semibold text-end">30 lts.</p>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>  --}}

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
                                                {{--  <label class="btn btn-sm btn-primary btn-simple active" id="0">
                                                    <input type="radio" name="options" checked>
                                                    <span
                                                        class="d-none d-sm-block d-md-block d-lg-block d-xl-block">Orquesta</span>
                                                    <span class="d-block d-sm-none">
                                                        <i class="tim-icons icon-single-02"></i>
                                                    </span>
                                                </label>  --}}
                                                @foreach ($gasolinas as $gasolina)
                                                    <label class="btn btn-sm btn-primary btn-simple" id="1"
                                                        aria-controls={{ $gasolina->id }}>
                                                        <input type="radio" class="d-none d-sm-none" name="options">
                                                        <span class="d-none d-sm-block d-md-block d-lg-block d-xl-block"
                                                            onclick="actualizar({{ $gasolina->id }})">
                                                            {{ $gasolina->nombre }}
                                                            <span class="d-block d-sm-none">
                                                                <i class="tim-icons icon-gift-2"></i>
                                                            </span>
                                                    </label>
                                                @endforeach

                                            </div>
                                        </div>
                                        {{--  <div class="col-sm-6">
                                            <div class="btn-group btn-group-toggle float-right" data-toggle="buttons">
                                                <label class="btn btn-sm btn-primary btn-simple active" id="0">
                                                    <input type="radio" name="options" checked>
                                                    <span
                                                        class="d-none d-sm-block d-md-block d-lg-block d-xl-block">Orquesta</span>
                                                    <span class="d-block d-sm-none">
                                                        <i class="tim-icons icon-single-02"></i>
                                                    </span>
                                                </label>
                                                <label class="btn btn-sm btn-primary btn-simple" id="1"
                                                    aria-controls=8>
                                                    <input type="radio" class="d-none d-sm-none" name="options">
                                                    <span
                                                        class="d-none d-sm-block d-md-block d-lg-block d-xl-block">Kangoo</span>
                                                    <span class="d-block d-sm-none">
                                                        <i class="tim-icons icon-gift-2"></i>
                                                    </span>
                                                </label>
                                                <label class="btn btn-sm btn-primary btn-simple" id="2"
                                                    aria-controls=7>
                                                    <input type="radio" class="d-none" name="options">
                                                    <span
                                                        class="d-none d-sm-block d-md-block d-lg-block d-xl-block">Sessions</span>
                                                    <span class="d-block d-sm-none">
                                                        <i class="tim-icons icon-tap-02"></i>
                                                    </span>
                                                </label>
                                            </div>
                                        </div>  --}}
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

             {{--  <div class="row">
                        <div class="col-12">
                            <form action="{{ route('inventario.dashCombustible') }}" method="post">
                                @csrf
                                <input type="date" name="inicio" id="">
                                <input type="date" name="fin" id="">

                                <button type="submit"></button>
                            </form>
                        </div>
                    </div>  --}}

                </div>
            </div>
        </div>
    </div>
    @endsection
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


<!------MODALES DE CARGA Y DESCARGA ----- -->

<!-- Button trigger modal -->


<!-- Modal Carga-->
<div class="modal fade" id="cargaCombustible" tabindex="-1" aria-labelledby="cargaCombustibleLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bacTituloPrincipal">
        <h1 class="modal-title fs-5" id="cargaCombustibleLabel">Modificar Carga de Combustible</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="row">
            <div class="col-4 my-3">
                <label for="inputEmail4" class="form-label">Equipo</label> 
                <select id="" class="form-select">
                <option selected>Opción 1</option>
                <option>Opción 2</option>
                <option>Opción 3</option>
                <option>Opción 4</option>
                <option>Opción 5</option>
                </select>
            </div>

            <div class="col-4 my-3">
                <label for="inputEmail4" class="form-label">Despachador</label> 
                <select id="" class="form-select">
                <option selected>Opción 1</option>
                <option>Opción 2</option>
                <option>Opción 3</option>
                <option>Opción 4</option>
                <option>Opción 5</option>
                </select>
            </div>

            <div class="col-4 my-3">
                <label for="inputEmail4" class="form-label">Litros</label> 
                <input type="number" class="form-control" id="">
            </div>
            <div class="col-4 my-3">
                <label for="inputEmail4" class="form-label">Precio</label> 
                <input type="number" class="form-control" id="">
            </div>

            <div class="col-4 my-3">
                <label for="inputEmail4" class="form-label">Fecha</label> 
                <input type="date" class="form-control" id="">
            </div>
        </form>
      </div>
      <div class="modal-footer">
        
        <button type="button" class="btn botonGral">Guardar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Descarga-->
<div class="modal fade" id="descargaCombustible" tabindex="-1" aria-labelledby="descargaCombustibleLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bacTituloPrincipal">
        <h1 class="modal-title fs-5" id="descargaCombustibleLabel">Modificar Descarga  de Combustible</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="row">
            <div class="col-4 my-3">
                <label for="inputEmail4" class="form-label">Equipo</label> 
                <select id="" class="form-select">
                <option selected>Opción 1</option>
                <option>Opción 2</option>
                <option>Opción 3</option>
                <option>Opción 4</option>
                <option>Opción 5</option>
                </select>
            </div>

            <div class="col-4 my-3">
                <label for="inputEmail4" class="form-label">Maquinaria</label> 
                <select id="" class="form-select">
                <option selected>Opción 1</option>
                <option>Opción 2</option>
                <option>Opción 3</option>
                <option>Opción 4</option>
                <option>Opción 5</option>
                </select>
            </div>

            <div class="col-4 my-3">
                <label for="inputEmail4" class="form-label">Despachador</label> 
                <select id="" class="form-select">
                <option selected>Opción 1</option>
                <option>Opción 2</option>
                <option>Opción 3</option>
                <option>Opción 4</option>
                <option>Opción 5</option>
                </select>
            </div>

            <div class="col-4 my-3">
                <label for="inputEmail4" class="form-label">Operador</label> 
                <select id="" class="form-select">
                <option selected>Opción 1</option>
                <option>Opción 2</option>
                <option>Opción 3</option>
                <option>Opción 4</option>
                <option>Opción 5</option>
                </select>
            </div>

            <div class="col-6 my-3">
                <label for="inputEmail4" class="form-label">Litros</label> 
                <input type="number" class="form-control" id="">
            </div>

            <div class="col-6 my-3">
                <label for="inputEmail4" class="form-label">Fecha</label> 
                <input type="date" class="form-control" id="">
            </div>

            <div class="col-6 my-3">
                <label for="inputEmail4" class="form-label">Horómetro</label> 
                <input type="number" class="form-control" id="">
            </div>

            <div class="col-6 my-3">
                <label for="inputEmail4" class="form-label">Km Mi</label> 
                <input type="number" class="form-control" id="">
            </div>

            <div class="col-12 my-3">
                <div class=" mx-auto border vistaFoto mb-4">
                    <i><img class=" img-fluid mb-5" src="{{ asset('/img/general/default.jpg') }}"></i>
                    <span class="botonGral"> <input class="mb-4 ver" type="file" name="foto" id="mi-archivo" accept="image/*"></span>
                    <label for="mi-archivo">
                        <span>Fotografía</span>
                    </label>
                </div>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        
        <button type="button" class="btn botonGral">Guardar</button>
      </div>
    </div>
  </div>
</div>
