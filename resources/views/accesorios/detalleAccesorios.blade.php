@extends('layouts.main', ['activePage' => 'maquinaria', 'titlePage' => __('Detalle de Accesorios')])
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
                            <div class="ml-3">
                                <div class="p-1 align-self-start bacTituloPrincipal">
                                    <h2 class="my-3 ms-3 texticonos">Detalle de Accesorios</h2>
                                </div>
                            <div>
                                <div class="col-4 text-left mt-3" style="margin-left:20px">
                                    <a href="{{ route('accesorios.index') }}">
                                        <button class="btn regresar">
                                            <span class="material-icons">
                                                reply
                                            </span>
                                            Regresar
                                        </button>
                                    </a>    
                                </div>
                                <div class="d-flex p-3 divBorder" style="margin-top:-15px"></div>
                            </div>

                            <form action="{{ route('accesorios.update', $accesorios->id) }}"
                                method="post"class="row alertaGuardar" enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="row mt-3">
                                    <div class="col-12 col-md-4  my-3">
                                        <div class="text-center mx-auto border vistaFoto mb-4">
                                            <i><img class="imgVista img-fluid mb-2"
                                                    src="{{  $accesorios->foto == '' ? '/img/general/default.jpg' : asset('/storage/maquinaria/accesorios/' . str_pad($accesorios->id, 4, '0', STR_PAD_LEFT) . '/' . $accesorios->foto ) }}"
                                                    {{-- src="'/img/general/default.jpg' : asset('/storage/maquinaria/' . str_pad($maquinaria['identificador'], 4, '0', STR_PAD_LEFT) . '/' . $fotos[0]->ruta) " --}}
                                                    ></i>
                                            <span class="mi-archivo"> <input class="mb-4 ver" type="file" name="foto"
                                                    id="mi-archivo" accept="image/*"></span>
                                            <label for="mi-archivo">
                                                <span>sube imagen</span>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-8 ">
                                        <div class="row">
                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                <label class="labelTitulo">Nombre: <span>*</span></label></br>
                                                <input type="text" class="inputCaja" id="nombre" name="nombre"
                                                    placeholder="Especifique..." required value="{{ $accesorios->nombre }}">
                                            </div>

                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                <label class="labelTitulo">Año:</label></br>
                                                <input type="number" class="inputCaja" id="ano" maxlength="4"
                                                    placeholder="Ej. 2000" name="ano" value="{{ $accesorios->ano }}">
                                            </div>

                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                <label class="labelTitulo">Marca:</label></br>
                                                <input type="text" class="inputCaja" id="marca" name="marca"
                                                    placeholder="Especifique..." value="{{ $accesorios->marca }}">
                                            </div>


                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                <label class="labelTitulo">Número Serie:</label></br>
                                                <input type="text" class="inputCaja" id="serie" name="serie"
                                                    placeholder="Especifique..." value="{{ $accesorios->serie }}">
                                            </div>

                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                <label class="labelTitulo">Modelo:</label></br>
                                                <input type="text" class="inputCaja" id="modelo" name="modelo"
                                                    placeholder="Especifique..." value="{{ $accesorios->modelo }}">
                                            </div>

                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                <label class="labelTitulo">Color:</label></br>
                                                <input type="text" class="inputCaja" id="color" name="color"
                                                    placeholder="Especifique..." value="{{ $accesorios->color }}">
                                            </div>

                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                <label class="labelTitulo">Maquinaria Asignada:</label></br>
                                                <select id="maquinariaId" name="maquinariaId" class="form-select"
                                                    aria-label="Default select example">
                                                    <option value="">Seleccione</option>
                                                    @foreach ($vctMaquinaria as $maquina)
                                                        <option value="{{ $maquina->id }}"
                                                            {{ $maquina->id == $accesorios->maquinariaId ? ' selected' : '' }}>
                                                            {{ $maquina->identificador . ' ' . $maquina->nombre }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-12 text-end mb-3 ">
                                        <button type="submit" class="btn botonGral"
                                            onclick="alertaGuardar()">Guardar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
