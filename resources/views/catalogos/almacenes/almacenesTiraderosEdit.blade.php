@extends('layouts.main', ['activePage' => 'equipos', 'titlePage' => __('Modificación de Documentos')])
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
            <div class="justify-content-center">
                <div class="card">
                    <div class="card-header bacTituloPrincipal">
                        <h4 class="card-title">Modificacion en la Administración de Almacenes y Tiraderos</h4>
                        {{-- <p class="card-category">Usuarios registrados</p> --}}
                    </div>
                    <div class="card-body">
                        <div class="row divBorder">

                            <div class="col-12 mb-3">
                                <a href="{{ route('docs.index') }}">
                                    <button class="btn regresar">
                                        <span class="material-icons">
                                            reply
                                        </span>
                                        Regresar
                                    </button>
                                </a>
                            </div>
                        </div>

                        <form class="alertaGuardar" action="{{ route('almacenTiraderos.update', $almacenTiradero->id) }}"
                            method="post" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="row mt-3 ">
                                <div class="col-12  ">
                                    <div class="row">
                                        <div class=" col-12 col-sm-6 col-lg-4 my-3 ">
                                            <label class="labelTitulo">Nombre: <span>*</span></label></br>
                                            <input type="text" class="inputCaja" id="nombre" name="nombre" required
                                                placeholder="Especifique..." value="{{ $almacenTiradero->nombre }}">
                                        </div>
                                        <div class=" col-12 col-sm-6 col-lg-4 my-3 ">
                                            <label class="labelTitulo">Tipo:</label></br>
                                            <select id="tipoId" name="tipoAlmacenId" class="form-select"
                                                aria-label="Default select example">
                                                <option value="">Seleccione</option>
                                                @foreach ($tiposDocs as $item)
                                                    <option value="{{ $item->id }}"
                                                        {{ $item->id == $almacenTiradero->tipoAlmacenId ? ' selected' : '' }}>
                                                        {{ $item->nombre }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class=" col-12 col-sm-6 col-lg-4 my-3 ">
                                            <label class="labelTitulo">Comentario: <span>*</span></label></br>
                                            <textarea class="form-select" id="exampleFormControlTextarea1" rows="3" maxlength="1000" required id="comentario"
                                                name="comentario" placeholder="Escribe aquí tus comentarios.">{{ $almacenTiradero->comentario }} </textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 text-end mb-3 ">
                                    <div class="mb-5" id="spinner-container"></div>
                                    <button type="submit" class="btn botonGral" onclick="alertaGuardar()">Guardar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
        crossorigin="anonymous"></script>
    <script>
        // agregar registro
        function crearItems() {

            $('.opcion:first').clone().find("input").val("").end().appendTo('#elementos');

        }
        // borrar registro
        $(document).on('click', '#removeRow', function() {

            $(this).closest('#opc').remove();
        });

        function crearItemsB() {

            $('.opcionB:first').clone().find("input").val("").end().appendTo('#elementosB');

        }
        // borrar registro
        $(document).on('click', '#removeRow', function() {

            $(this).closest('#opcB').remove();
        });
    </script>
@endsection