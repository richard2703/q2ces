@extends('layouts.main', ['activePage' => ' bitacoras', 'titlePage' => __('Nuevo Registro de Bitácora')])
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header bacTituloPrincipal">
                                    <h4 class="card-title">Nuevo Registro de Bitácora</h4>
                                </div>
                                <div class="card-body ">
                                    <div class="row">
                                        <div class="d-flex p-3 divBorder">
                                            <div class="col-12 text-start">
                                                <a href="{{ url('/bitacoras') }}">
                                                    <button class="btn regresar">
                                                        <span class="material-icons">
                                                            reply
                                                        </span>
                                                        Regresar
                                                    </button>
                                                </a>
                                            </div>
                                        </div>
                                        <form action="{{ route('bitacoras.store') }}" method="post"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="col-12 my-4">
                                                <div class="row">

                                                    <div class=" col-12 col-sm-6  col-lg-12 my-6 ">
                                                        <label class="labelTitulo">Nombre: <span>*</span></label></br>
                                                        <input type="text" required maxlength="250" id="nombre"
                                                            value="{{ old('nombre') }}" name="nombre"
                                                            placeholder="Especifique el nombre de la bitácora."
                                                            class="inputCaja">
                                                    </div>

                                                    <div class=" col-5 col-sm-6  col-lg-5 my-6 ">
                                                        <label class="labelTitulo">Frecuencia de Ejecución:
                                                            <span>*</span></label></br>
                                                        <select class="form-select" aria-label="Default select example"
                                                            required id="frecuenciaId" name="frecuenciaId">
                                                            <option selected value="">Selecciona una opción</option>
                                                            @foreach ($vctFrecuencias as $item)
                                                                <option value="{{ $item->id }}"
                                                                    {{ $item->id == $item->frecuenciaId ? ' selected' : '' }}>
                                                                    {{ $item->nombre . ' [ ' . $item->dias . ' días]' }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class=" col-2 col-sm-6  col-lg-3 my-6 ">
                                                        <label class="labelTitulo">Reprogramación :
                                                            <span></span></label></br>
                                                        <select class="form-select" aria-label="Default select example"
                                                            id="renovacion" name="renovacion">
                                                            <option value="0">No
                                                            </option>
                                                            <option value="1">Sí
                                                            </option>
                                                        </select>
                                                    </div>
                                                    <div class=" col-5 col-sm-6  col-lg-2 my-6 ">
                                                        <label class="labelTitulo">Código: <span>*</span></label></br>
                                                        <input type="text" required maxlength="10" id="codigo"
                                                            value="{{ old('codigo') }}" name="codigo"
                                                            placeholder="Especifique el código de la bitácora, Ej. QCEM-V01"
                                                            class="inputCaja">
                                                    </div>

                                                    <div class=" col-2 col-sm-6  col-lg-2 my-6 ">
                                                        <label class="labelTitulo">Versión: <span>*</span></label></br>
                                                        <input type="number" class="inputCaja text-end" id="version"
                                                            maxlength="4" min="0" max="9999"
                                                            placeholder="Especifique la versión de la bitácora, Ej. 1"
                                                            name="version" value="{{ old('version') }}">
                                                    </div>

                                                    <div class=" col-12 col-sm-6  col-lg-12 my-6 ">
                                                        <label for="exampleFormControlTextarea1"
                                                            class="labelTitulo">Descripción
                                                            de la Bitácora: <span>*</span></label>
                                                        <textarea class="form-select" id="exampleFormControlTextarea1" rows="3" maxlength="1000" required id="comentario"
                                                            name="comentario" placeholder="Escribe aquí tus comentarios sobre la bitácora.">{{ old('comentario') }}</textarea>
                                                    </div>

                                                    <input type="hidden" name="activa" id="activa" value="1">
                                                    <div class="col-12 text-center mt-5 pt-5">

                                                        <a href="{{ url('/bitacoras') }}">
                                                            <button type="button" class="btn btn-danger">Cancelar</button>
                                                        </a>
                                                        <button type="submit" class="btn botonGral">Guardar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
