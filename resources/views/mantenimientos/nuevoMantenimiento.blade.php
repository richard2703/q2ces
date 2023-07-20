@extends('layouts.main', ['activePage' => 'mantenimiento', 'titlePage' => __('Nuevo Mantenimiento')])
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
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <form class="alertaGuardar" action="{{ route('mantenimientos.store') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="maquinariaId" id="maquinariaId" value="">
                            <input type="hidden" name="titulo" id="titulo" value="">
                            <input type="hidden" name="estadoId" id="estadoId" value="1">
                            <input type="hidden" name="personalId" id="personalId" value="{{ auth()->user()->id }}">
                            <div class="card-header bacTituloPrincipal">
                                <h4 class="card-title">Nuevo Registro de Mantenimiento</h4>
                            </div>

                            <div class="card-body ">

                                <div class="col-12 my-4">
                                    <div class="row">
                                        

                                            <p class="subEncabezado">Busca una Maquinaria</p>
                                            <div class="mb-4 mt-0" role="search" class="">
                                                <input value="" class="search-submit ">
                                                <input autofocus type="text" class="search-text" id="search"
                                                    name="search" placeholder="Buscar..."
                                                    title="Escriba la(s) palabra(s) a buscar.">
                                            </div>
                                        </div>
                                        <div class="d-flex p-3 divBorder w-100" style="margin-top:-10px"></div>
                                        <div class=" col-12 col-sm-6 col-lg-12 my-3 ">
                                            <label class="labelTitulo">Descripción Equipo/Maquinaría: <span>*</span></label></br>
                                            <textarea rows="2" cols="80" class="form-control form-select" id="descripcion" readonly name="descripcion"
                                                value=""></textarea>
                                        </div>
                                        {{--  <div class=" col-12 col-sm-6 col-lg-4 my-3 ">
                                            <label class="labelTitulo">Equipo: <span>*</span></label></br>
                                            <input type="text" class="inputCaja" id="nombre" name="nombre"
                                                required readonly>
                                        </div>
                                        <div class=" col-12 col-sm-6  col-lg-4 my-3 ">
                                            <label class="labelTitulo">Número de Serie: </label></br>
                                            <input type="text" class="inputCaja" id="numserie" name="numserie"
                                                readonly>
                                        </div>
                                        <div class=" col-12 col-sm-6  col-lg-4 my-3 ">
                                            <label class="labelTitulo">Marca: </label></br>
                                            <input type="text" class="inputCaja" id="marca" name="marca"
                                                readonly>
                                        </div>
                                        <div class=" col-12 col-sm-6  col-lg-4 my-3 ">
                                            <label class="labelTitulo">Modelo: </label></br>
                                            <input type="text" class="inputCaja" id="modelo" name="modelo"
                                                readonly>
                                        </div>
                                        <div class=" col-12 col-sm-6  col-lg-4 my-3 ">
                                            <label class="labelTitulo">Placas: </label></br>
                                            <input type="text" class="inputCaja" id="placas" name="placas"
                                                readonly>
                                        </div> --}}
                                        {{-- <hr> --}}
                                        {{-- <div class=" col-12 col-sm-6  col-lg-4 my-3 ">
                                            <label class="labelTitulo">Resguardatario:</label></br><input
                                                id="personalId" name="personalId" type="text"
                                                placeholder="Especifique..." class="inputCaja">
                                        </div>
                                        <div class=" col-12 col-sm-6  col-lg-4 my-3 ">
                                            <label class="labelTitulo">Adscripción:</label></br><input
                                                id="adscripcion" name="adscripcion" type="text"
                                                placeholder="Especifique..." class="inputCaja">
                                        </div>
                                        <div class=" col-12 col-sm-6  col-lg-4 my-3 ">
                                            <label class="labelTitulo">Horómetro: </label></br>
                                            <input type="text" class="inputCaja" placeholder="Ej. 1000"
                                                id="horometro" name="horometro">
                                        </div>
                                        <div class=" col-12 col-sm-6  col-lg-4 my-3 ">
                                            <label class="labelTitulo">Km/m: </label></br>
                                            <input type="text" class="inputCaja" placeholder="Especifique..."
                                                id="km" name="km">
                                        </div> --}}
                                        <div class=" col-12 col-sm-6  col-lg-4 my-3 ">
                                            <label class="labelTitulo">Fecha de Inicio: <span>*</span> </label></br>
                                            <input type="date" class="inputCaja" placeholder="Especifique..." required
                                                id="fechaInicio" name="fechaInicio">
                                        </div>

                                        <div class=" col-12 col-sm-6  col-lg-4 my-3 ">
                                            <label class="labelTitulo">Tipo de Mantenimiento: <span>*</span></label></br>
                                            <select class="form-select form-select-lg mb-3 inputCaja" name="tipo" required
                                                id="tipo" aria-label=".form-select-lg example">

                                                <option value="">Seleccione</option>
                                                <option value="Correctivo">Correctivo</option>
                                                <option value="250">250</option>
                                                <option value="500">500</option>
                                                <option value="1000">1000</option>
                                            </select>
                                        </div>
                                        <div class=" col-12 col-sm-6  col-lg-12 my-6 ">
                                            <label class="labelTitulo">Comentarios:</label></br>
                                            <textarea rows="4" cols="80" class="form-control" placeholder="Escribe tus comentarios o información relevante sobre el mantenimiento aquí."
                                                name="comentario" id="comentario"></textarea>
                                        </div>

                                        {{-- <hr>
                                        <div class=" col-12 col-sm-6  col-lg-4 my-3 ">
                                            <label class="labelTitulo">Subtotal: </label></br>
                                            <input type="text" class="inputCaja" placeholder="Especifique..."
                                                id="subtotal" name="subtotal">
                                        </div>
                                        <div class=" col-12 col-sm-6  col-lg-4 my-3 ">
                                            <label class="labelTitulo">Iva: </label></br>
                                            <input type="text" class="inputCaja" placeholder="Especifique..."
                                                id="iva" name="iva">
                                        </div>
                                        <div class=" col-12 col-sm-6  col-lg-4 my-3 ">
                                            <label class="labelTitulo">Total: </label></br>
                                            <input type="text" class="inputCaja" placeholder="Especifique..."
                                                id="total" name="total">
                                        </div> --}}
                                    </div>
                                </div>


                                {{-- <div class="col-12 divBorder">
                                    <h2 class="tituloEncabezado">Material de Mantenimiento</h2></br></br>
                                </div>

                                <div class="row d-flex">
                                    <div class="col-12 col-md-6    mt-3 ">
                                        <p class="subEncabezado">Busca un Material</p>
                                        <div class="mb-4 mt-0" role="search" class="">
                                            <input value="" class="search-submit ">
                                            <input autofocus type="text" class="search-text" id="search2"
                                                name="search2" placeholder="Buscar..."
                                                title="Escriba la(s) palabra(s) a buscar.">
                                        </div>
                                    </div> --}}

                                    {{-- <div class="col-12 col-md-6 mt-3 align-items-center  ">
                                    <button class="btnSinFondocALENDARIO  float-end" type="button"
                                        data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight"
                                        aria-controls="offcanvasRight">
                                        <img class="imgBtns" style="height: 25px;"
                                            src="{{ asset('img/mantenimiento/box.svg') }}"></br>Ver materiales
                                        seleccionados
                                        <span
                                            class="position-absolute top-0 start-97 translate-middle p-2 bg-danger border border-light rounded-circle">
                                            <span class="visually-hidden">New alerts</span>
                                        </span>
                                    </button>
                                    <!-- off canvas-->
                                    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight"
                                        aria-labelledby="offcanvasRightLabel">
                                        <div class="offcanvas-header divBorder">
                                            <h3 class="offcanvas-title tituloEncabezado" id="offcanvasRightLabel">
                                                Lista de Material</h3>
                                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="offcanvas-body">
                                            <ul class="">
                                                <li
                                                    class="listaMaterialMantenimiento my-3 d-flex py-5 border-bottom">
                                                    <div class="col-9 ">
                                                        <p class="fw-semibold">4 litros</p></br>
                                                        <p> <span class="fw-semibold">Descripción:</span>
                                                            PG PC5667C Filtro de aire de cabina | Compatible con
                                                            Toyota Prius 2020-10, Highland 2019-09</br>
                                                            <span class="fw-semibold">N.parte:</span> Lexus CT200h
                                                            2017-11</br>
                                                            <span class="fw-semibold">Costo:</span> $ 300.00</br>
                                                            <span class="fw-semibold">Importe:</span> $ 300.00
                                                        </p>
                                                    </div>
                                                    <div class="col-3">
                                                        <button class="btnSinFondo float-end" type="submit"
                                                            rel="tooltip">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="28"
                                                                height="28" fill="currentColor"
                                                                title="Eliminar" class="bi bi-x-circle"
                                                                viewBox="0 0 16 16">
                                                                <path
                                                                    d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                                <path
                                                                    d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </li>
                                                <li
                                                    class="listaMaterialMantenimiento my-3 d-flex py-5 border-bottom">
                                                    <div class="col-9 ">
                                                        <p class="fw-semibold">4 litros</p></br>
                                                        <p> <span class="fw-semibold">Descripción:</span>
                                                            PG PC5667C Filtro de aire de cabina | Compatible con
                                                            Toyota Prius 2020-10, Highland 2019-09</br>
                                                            <span class="fw-semibold">N.parte:</span> Lexus CT200h
                                                            2017-11</br>
                                                            <span class="fw-semibold">Costo:</span> $ 300.00</br>
                                                            <span class="fw-semibold">Importe:</span> $ 300.00
                                                        </p>
                                                    </div>
                                                    <div class="col-3">
                                                        <button class="btnSinFondo float-end" type="submit"
                                                            rel="tooltip">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="28"
                                                                height="28" fill="currentColor"
                                                                title="Eliminar" class="bi bi-x-circle"
                                                                viewBox="0 0 16 16">
                                                                <path
                                                                    d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                                <path
                                                                    d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </li>
                                            </ul>
                                            <div class="col-12 mt-5">
                                                <button type="button"
                                                    class="btn botonGral mx-auto d-block">Agregar</button>
                                            </div>

                                        </div>
                                    </div>
                                </div> --}}
                                {{-- </div>

                                <div class="my-4 divBorder">
                                    <h3 class="subEncabezado mb-3">Listado de busqueda</h3>
                                </div>
                                <div class=" col-12  my-3 ">
                                    <ul class="" id="newRow"> --}}
                                        {{-- <li class="listaMaterialMantenimiento my-3 border-bottom">
                                        <div class="row d-flex pb-4">
                                            <div class="col-12 col-md-9  py-3 d-flex">

                                                <input type="hidden" name="inventarioId[]" id="inventarioId"
                                                    value=" ">
                                                <div class="col-3 ">
                                                    <label for="cantidad"
                                                        class="">Cantidad</label></br></br>
                                                    <input type="number" maxlength="2" min="1" required
                                                        max="99" step="1"
                                                        class="inputCaja text-right" id="cantidad"
                                                        placeholder="Ej. 1" name="cantidad[]" value="">
                                                </div>
                                                <div class="col-9">
                                                    <label for="descripcion"
                                                        class="">Descripción</label></br></br>
                                                    <textarea rows="3" cols="80" class="form-control form-select" id="descripcion" readonly
                                                        name="descripcion[]" value=""></textarea>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <button class="btnSinFondocALENDARIO ms-3 float-end">
                                                    <img class="imgBtns" style="height: 20px;"
                                                        src="{{ asset('img/mantenimiento/material.svg') }}">
                                                    Seleccionar
                                                </button>
                                            </div>
                                        </div>
                                    </li> --}}
                                        {{-- <li class="listaMaterialMantenimiento my-3 border-bottom ">
                                        <div class="row d-flex pb-4">
                                            <div class="col-12 col-md-9  py-3 d-flex">
                                                <div class="col-3 ">
                                                    <label for="exampleFormControlInput1"
                                                        class="">Cantidad</label></br></br>
                                                    <input type="text" class="inputCaja">
                                                </div>
                                                <div class="col-9">
                                                    <p> <span class="fw-semibold">Descripción:</span>
                                                        PG PC5667C Filtro de aire de cabina | Compatible con Toyota
                                                        Prius 2020-10, Highland 2019-09</br>
                                                        <span class="fw-semibold">N.parte:</span> Lexus CT200h
                                                        2017-11</br>
                                                        <span class="fw-semibold">Costo:</span> $ 300.00</br>
                                                        <span class="fw-semibold">Importe:</span> $ 300.00
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <button class="btnSinFondocALENDARIO ms-3 float-end">
                                                    <img class="imgBtns" style="height: 20px;"
                                                        src="{{ asset('img/mantenimiento/material.svg') }}">
                                                    Seleccionar
                                                </button>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="listaMaterialMantenimiento my-3 border-bottom">
                                        <div class="row d-flex pb-4">
                                            <div class="col-12 col-md-9  py-3 d-flex">
                                                <div class="col-3 ">
                                                    <label for="exampleFormControlInput1"
                                                        class="">Cantidad</label></br></br>
                                                    <input type="text" class="inputCaja">
                                                </div>
                                                <div class="col-9">
                                                    <p> <span class="fw-semibold">Descripción:</span>
                                                        PG PC5667C Filtro de aire de cabina | Compatible con Toyota
                                                        Prius 2020-10, Highland 2019-09</br>
                                                        <span class="fw-semibold">N.parte:</span> Lexus CT200h
                                                        2017-11</br>
                                                        <span class="fw-semibold">Costo:</span> $ 300.00</br>
                                                        <span class="fw-semibold">Importe:</span> $ 300.00
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <button class="btnSinFondocALENDARIO ms-3 float-end">
                                                    <img class="imgBtns" style="height: 20px;"
                                                        src="{{ asset('img/mantenimiento/material.svg') }}">
                                                    Seleccionar
                                                </button>
                                            </div>
                                        </div>
                                    </li> --}}
                                    {{-- </ul>
                                </div> --}}

                                <div class="col-12 text-center mt-5 pt-5">
                                    <button type="submit" class="btn botonGral mb-3">Guardar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
            
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E="
        crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    {{-- <script src="{{ asset('vendor/jquery-ui/jquery-ui.min.js') }}"></script> --}}

    <script>
        var curso = ['html', 'hola', 'hi'];

        $('#search').autocomplete({

            source: function(request, response) {
                $.ajax({
                    url: "{{ route('search.equipos') }}",

                    dataType: 'json',
                    data: {
                        term: request.term,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        response(data);
                    }
                });
            },
            minChars: 1,
            width: 402,
            matchContains: "word",
            autoFill: true,
            minLength: 1,
            select: function(event, ui) {

                // Rellenar los campos con los datos de la persona seleccionada
                $('#maquinariaId').val(ui.item.id);
                $('#descripcion').val(ui.item.value);
                $('#titulo').val('Mantenimiento ' + ui.item.nombre);
                // $('#nombre').val(ui.item.nombre);
                // $('#marca').val(ui.item.marca);
                // $('#modelo').val(ui.item.modelo);
                // $('#numserie').val(ui.item.numserie);
                // $('#placas').val(ui.item.placas);
            }

        });

        $('#search2').autocomplete({

            source: function(request, response) {
                $.ajax({
                    url: "{{ route('search.materialMantenimiento') }}",

                    dataType: 'json',
                    data: {
                        term: request.term,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        response(data);
                    }
                });
            },
            minChars: 1,
            width: 402,
            matchContains: "word",
            autoFill: true,
            minLength: 1,
            select: function(event, ui) {
                // Rellenar los campos con los datos del inventario seleccionado
                crearItems(ui.item.id, ui.item.value);

                // $('#inventarioId').val(ui.item.id);
                // $('#descripcion').val(ui.item.value);
            }

        });
    </script>

    <script type="text/javascript">
        function crearItems(inventarioId, descripcion) {
            var html = '';
            html += '<li class="listaMaterialMantenimiento my-3 border-bottom" id="inputFormRow">';
            html += '   <div class="row d-flex pb-4">';
            html += '      <input type="hidden" name="inventarioId[]" id="inventarioId" value="' + inventarioId + '">';
            html += '      <div class="col-3 ">';
            html += '           <label for="cantidad" class="">Cantidad</label></br></br>';
            html +=
                '           <input type="number" maxlength="2" min="1" required max="99" step="1" class="inputCaja text-right" id="cantidad" placeholder="Ej. 1" name="cantidad[]" value="1">';
            html += '      </div>';
            html += '      <div class="col-7">';
            html += '          <label for="descripcion" class="">Descripción</label></br></br>';
            html +=
                '          <textarea rows="3" cols="80" class="form-control form-select" id="descripcion" readonly name="descripcion[]" value="">' +
                descripcion + '</textarea>';
            html += '      </div>';
            html += '      <div class="col-2"></br></br>';
            html += '         <button id="removeRow" type="button" class="btn btn-danger">Borrar</button>';
            html += '      </div>';
            html += '    </div>';
            html += '</li>';

            $('#newRow').append(html);
        }

        // borrar registro
        $(document).on('click', '#removeRow', function() {
            $(this).closest('#inputFormRow').remove();
        });
    </script>

@endsection
