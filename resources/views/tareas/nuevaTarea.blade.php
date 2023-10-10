@extends('layouts.main', ['activePage' => ' bitacoras', 'titlePage' => __('Nuevo Registro de Tarea')])
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header bacTituloPrincipal">
                                    <h4 class="card-title">Nuevo Registro de Tarea</h4>
                                </div>
                                <div class="card-body ">
                                    <form action="{{ route('tarea.store') }}" method="post"
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
                                                        de la Tarea: <span>*</span></label>
                                                    <textarea class="form-select" id="exampleFormControlTextarea1" rows="3" maxlength="1000" required id="comentario"
                                                        name="comentario" placeholder="Escribe aquí que es lo que hace la tarea."></textarea>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="recipient-name" class="labelTitulo">Categoría: <span>*</span></label>
                                                    <select class="form-select" id="floatingSelect" aria-label="Floating label select example" title="Seleccione la categoría en que se asociará a la tarea."
                                                        required id="categoriaId" name="categoriaId">
                                                        <option selected value="">Selecciona una opción</option>
                                                        @foreach ($vctCategorias as $item)
                                                            <option value="{{ $item->id }}">
                                                                {{ $item->nombre }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="recipient-name" class="labelTitulo">Ubicación: <span>*</span></label>
                                                    <select class="form-select" id="floatingSelect" aria-label="Floating label select example"  title="Seleccione la ubicación de donde será realizada la tarea."
                                                        required id="ubicacionId" name="ubicacionId">
                                                        <option selected value="">Selecciona una opción</option>
                                                        @foreach ($vctUbicaciones as $item)
                                                            <option value="{{ $item->id }}">
                                                                {{ $item->nombre }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="recipient-name" class="labelTitulo">Tipo: <span>*</span></label>
                                                    <select class="form-select" id="floatingSelect" aria-label="Floating label select example"  title="Seleccione el tipo de revisión que se hará en la tarea."
                                                        required id="tipoId" name="tipoId">
                                                        <option selected value="">Selecciona una opción</option>
                                                        @foreach ($vctTipos as $item)
                                                            <option value="{{ $item->id }}">
                                                                {{ $item->nombre }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="labelTitulo">Tipo de Valor a Capturar:</label></br>
                                                    <select class="form-select" aria-label="Default select example" id="tipoValor" title="Seleccione el tipo de valor con que se guardará la tarea."
                                                        name="tipoValorId">
                                                        <option selected value="">Selecciona una opción</option>
                                                        @foreach ($vctTipoValor as $item)
                                                            <option value="{{ $item->id }}">
                                                                {{ $item->nombre }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                {{-- <div class="mb-3">
                                                    <label for="exampleFormControlTextarea1" class="form-label">Comentarios</label>
                                                    <textarea class="form-select" placeholder="Escribe aquí tus comentarios sobre la tarea." rows="3"
                                                        id="comentario" name="comentario"></textarea>
                                                </div> --}}

                                                <input type="hidden" name="activo" id="activo" value="1">
                                                <div class="col-12 text-center mt-5 pt-5">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal"><a
                                                            href="{{ url('/bitacoras/tareas') }}">Regresar</a></button>
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
