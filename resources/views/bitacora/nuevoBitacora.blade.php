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
                                    <form action="{{ route('bitacoras.store') }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="col-12 my-4">
                                            <div class="row">

                                                <div class=" col-12 col-sm-6  col-lg-12 my-6 ">
                                                    <label class="labelTitulo">Nombre: <span>*</span></label></br>
                                                    <input type="text" required maxlength="250" id="nombre"
                                                        name="nombre" placeholder="Especifique el nombre del grupo."
                                                        class="inputCaja">
                                                </div>

                                                <div class=" col-12 col-sm-6  col-lg-12 my-6 ">
                                                    <label for="exampleFormControlTextarea1" class="labelTitulo">Descripción
                                                        de la Bitácora: <span>*</span></label>
                                                    <textarea class="form-select" id="exampleFormControlTextarea1" rows="3" maxlength="1000" required id="comentario"
                                                        name="comentario" placeholder="Escribe aquí tus comentarios sobre la bitácora."></textarea>
                                                </div>

                                                <div class=" col-12 col-sm-6  col-lg-12 my-6 ">
                                                    <label class="labelTitulo">Frecuencia de Ejecución:</label></br>
                                                    <select class="form-select" aria-label="Default select example"
                                                        id="frecuenciaId" name="frecuenciaId">
                                                        <option selected value="">Selecciona una opción</option>
                                                        @foreach ($vctFrecuencias as $item)
                                                            <option value="{{ $item->id }}"
                                                                {{ $item->id == $item->frecuenciaId ? ' selected' : '' }}>
                                                                {{ $item->nombre . " [ ". $item->dias ." días]" }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <input type="hidden" name="activo" id="activo" value="1">
                                                <div class="col-12 text-center mt-5 pt-5">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal"><a
                                                            href="{{ url('/bitacoras') }}">Regresar</a></button>
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
