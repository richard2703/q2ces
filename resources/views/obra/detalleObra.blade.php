@extends('layouts.main', ['activePage' => 'obra', 'titlePage' => __('Detalle de Obra')])
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
                                <h2 class="my-3 ms-3 texticonos ">Detalle de Obra</h2>
                            </div>

                            <form class="row alertaGuardar" action="{{ route('obras.update', $obras->id) }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                @method('put')

                                <div class="col-12   my-5 ">

                                    <div class="row d-flex">
                                        <div class="col-12 col-sm-6 ">
                                            <div class="text-center mx-auto border vistaFoto mb-4">
                                                <i><img class="imgVista img-fluid mb-5" 
                                                        src="{{ $obras->foto == '' ? ' /img/general/default.jpg' : '/storage/obras/' . $obras->foto }}"></i>
                                                <span class="mi-archivo"> <input class="mb-4 ver" type="file"
                                                        name="foto" id="mi-archivo" accept="image/*"></span>
                                                <label for="mi-archivo">
                                                    <span>sube vista aérea</span>
                                                </label>
                                            </div>
                                        </div>


                                        <div class="col-12 col-sm-6 ">
                                            <div class="text-center mx-auto border vistaFoto mb-4">
                                                <i><img class="imgVista img-fluid mb-5"
                                                    src="{{ $obras->logo == '' ? ' /img/general/default.jpg' : '/storage/obras/' . $obras->logo }}"></i>
                                                <span class="mi-archivo"> <input class="mb-4 ver" type="file"
                                                        name="logo" id="mi-archivo2" accept="image/*"></span>
                                                <label for="mi-archivo2">
                                                    <span>sube Logo</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>


                                </div>

                                <div class="col-12   ">
                                    <div class="row">
                                        <div class=" col-12 col-sm-6 col-lg-4 my-3 ">
                                            <label class="labelTitulo">Nombre de la Obra:</label></br>
                                            <input type="text" class="inputCaja" id="nombre" name="nombre"
                                                value="{{ $obras->nombre }}">
                                        </div>
                                        <div class=" col-12 col-sm-6  col-lg-4 my-3 ">
                                            <label class="labelTitulo">Tipo:</label></br>
                                            <select class="form-select" aria-label="Default select example" id="tipo"
                                                name="tipo"> 
                                                <option value="Seleccione"
                                                    {{ $obras->tipo == 'Seleccione' ? ' selected' : '' }}>Seleccione
                                                </option>
                                                <option value="Q2Ces"{{ $obras->tipo == 'Q2Ces' ? ' selected' : '' }}>
                                                    Q2Ces
                                                </option>
                                                <option
                                                    value="Externa"{{ $obras->tipo == 'Externa' ? ' selected' : '' }}>
                                                    Externa
                                                </option>
                                            </select>
                                        </div>
                                        <div class=" col-12 col-sm-6  col-lg-4 my-3 ">
                                            <label class="labelTitulo">Calle:</label></br>
                                            <input type="text" class="inputCaja" id="calle" name="calle"
                                                value="{{ $obras->calle }}">
                                        </div>
                                        <div class=" col-12 col-sm-6  col-lg-4 my-3 ">
                                            <label class="labelTitulo">Número:</label></br>
                                            <input type="text" class="inputCaja" id="numero" name="numero"
                                                value="{{ $obras->numero }}">
                                        </div>
                                        <div class=" col-12 col-sm-6  col-lg-4 my-3 ">
                                            <label class="labelTitulo">Colonia:</label></br>
                                            <input type="text" class="inputCaja" id="colonia" name="colonia"
                                                value="{{ $obras->colonia }}">
                                        </div>
                                        <div class=" col-12 col-sm-6  col-lg-4 my-3 ">
                                            <label class="labelTitulo">Código Postal:</label></br>
                                            <input type="text" class="inputCaja" id="cp" name="cp"
                                                value="{{ $obras->cp }}">
                                        </div>
                                        <div class=" col-12 col-sm-6  col-lg-4 my-3 ">
                                            <label class="labelTitulo">Localidad:</label></br>
                                            <input type="text" class="inputCaja" id="ciudad" name="ciudad"
                                                value="{{ $obras->ciudad }}">
                                        </div>
                                        <div class=" col-12 col-sm-6  col-lg-4 my-3 ">
                                            <label class="labelTitulo">Estado:</label></br>
                                            <input type="text" class="inputCaja" id="estado" name="estado"
                                                value="{{ $obras->estado }}">
                                        </div>
                                    </div>
                                </div>
                        </div>

                        <div class="col-12 text-end mb-3 ">
                            <button type="submit" class="btn botonGral" onclick="alertaGuardar()">Guardar</button>
                        </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
