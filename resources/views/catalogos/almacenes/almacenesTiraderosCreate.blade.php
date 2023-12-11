@extends('layouts.main', ['activePage' => 'equipos', 'titlePage' => __('Lista de Documentos')])
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
                        <h4 class="card-title">Alta de Almacenes o Tiraderos</h4>
                        {{-- <p class="card-category">Usuarios registrados</p> --}}
                    </div>
                    <div class="card-body">
                        <div class="row divBorder">
                            <div class="col-12 mb-3">
                                <a href="{{ route('almacenTiraderos.index') }}">
                                    <button class="btn regresar">
                                        <span class="material-icons">
                                            reply
                                        </span>
                                        Regresar
                                    </button>
                                </a>
                            </div>
                        </div>

                        <form class="alertaGuardar" action="{{ route('almacenTiraderos.store') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="row mt-3 ">
                                <div class="col-12  ">
                                    <div class="row">


                                        <div class=" col-12 col-sm-6 col-lg-4 my-3 ">
                                            <label class="labelTitulo">Nombre: <span>*</span></label>
                                            <input type="text" class="inputCaja" id="nombre" name="nombre" required
                                                placeholder="Especifique..." value="{{ old('nombre') }}">
                                        </div>

                                        <div class=" col-12 col-sm-6 col-lg-4 my-3 ">
                                            <label class="labelTitulo">Tipo:</label></br>
                                            <select id="tipoId" name="tipoAlmacenId" class="form-select"
                                                aria-label="Default select example">
                                                <option value="">Seleccione</option>
                                                @foreach ($tiposDocs as $item)
                                                    <option value="{{ $item->id }}">
                                                        {{ $item->nombre }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class=" col-12 col-sm-6 col-lg-4 my-3 ">
                                            <label class="labelTitulo">Comentario: <span>*</span></label>
                                            <textarea class="form-select" id="exampleFormControlTextarea1" rows="3" maxlength="1000" required id="comentario"
                                                name="comentario" placeholder="Escribe aquí tus comentarios."></textarea>
                                        </div>

                                    </div>

                                    <!-- Servicios -->
                                    <div class="d-flex p-3">
                                        <div class="col-12" id="elementos">
                                            <div class="d-flex">
                                                <div class="col-6 divBorder">
                                                    <h2 class="tituloEncabezado ">Servicios de obra</h2>
                                                </div>

                                                <div class="col-6 divBorder pb-3 text-end">
                                                    <button type="button" class="btnVerde" onclick="crearItems()">
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="row opcion divBorderItems" id="opc">
                                                {{--  <input type="hidden" name="idRefaccion[]" value="">  --}}
                                                <div class=" col-12 col-sm-6  my-3 ">
                                                    <label class="labelTitulo">Servicio:</label></br>
                                                    <select id="tipoRefaccion" name='servicioId[]' class="form-select">
                                                        <option value="">Seleccione</option>
                                                        @foreach ($servicios as $item)
                                                            <option value="{{ $item->id }}">
                                                                {{ $item->codigo }} - {{ $item->nombre }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class=" col-12 col-sm-5  my-3 ">
                                                    <label class="labelTitulo">Precio por servicio:</label></br>
                                                    <input type="number" class="inputCaja" name='precio[]' id="numeroParte"
                                                        maxlength="100000" step="0.01" min="0.00" max="99999"
                                                        placeholder="$ 2,000.00" value="">
                                                </div>

                                                <div class="col-lg-1 my-3 text-end">
                                                    <button type="button" id="removeRow" class="btnRojo"></button>
                                                </div>

                                            </div>

                                        </div>
                                    </div>


                                    <div class="col-12 text-end mb-3 ">
                                        <div class="mb-5" id="spinner-container"></div>
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
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
        crossorigin="anonymous"></script>
    <script>
        function crearItems() {
            var newOpcion = $('.opcion:first').clone();
            newOpcion.find("select, input").val(""); // Establece los valores en blanco
            newOpcion.find(".material-icons").text("content_paste_search").css("color",
                "gray"); // Establece el ícono y el color
            newOpcion.appendTo('#elementos');
        }

        // Borrar registro
        $(document).on('click', '#removeRow', function() {
            if ($('.opcion').length > 1) {
                $(this).closest('.opcion').remove();
            }
        });
    </script>
@endsection
