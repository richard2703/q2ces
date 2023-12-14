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
                        <div class="card-header bacTituloPrincipal">
                            <h4 class="card-title">Nuevo Registro de Mantenimiento {{ $blnEsMtq == 'true' ? 'MTQ' : '' }}
                            </h4>
                        </div>

                        <div class="col-12 col-md-2 mt-4" style="margin-left:20px">
                            <a href="{{ route('mantenimientos.index') }}">
                                <button class="btn regresar">
                                    <span class="material-icons">
                                        reply
                                    </span>
                                    Regresar
                                </button>
                            </a>
                        </div>
                        <div class="d-flex p-3 divBorder w-100" style="margin-top:-10px"></div>
                        <form class="alertaGuardar" action="{{ route('mantenimientos.store') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="maquinariaId" id="maquinariaId" value="">
                            <input type="hidden" name="titulo" id="titulo" value="">
                            <input type="hidden" name="estadoId" id="estadoId" value="1">
                            <input type="hidden" name="personalId" id="personalId" value="{{ auth()->user()->id }}">

                            <div class="card-body ">

                                <div class="col-12 my-4">
                                    <div class="row">
                                        <p class="subEncabezado">Busca Una Maquinaria</p>
                                        <div class="mb-4 mt-0" role="search" class="">
                                            <input value="" class="search-submit ">
                                            @if ($blnEsMtq == 'true')
                                                <input autofocus type="text" class="text" id="searchMtq" name="searchMtq"
                                                    placeholder="Buscar..."
                                                    title="Escriba la(s) palabra(s) a buscar."><input type="button"
                                                    onclick="clearInput('searchMtq')" class="btn botonGral" value="Borrar">
                                            @else
                                                <input autofocus type="text" class="text" id="search" name="search"
                                                    placeholder="Buscar..."
                                                    title="Escriba la(s) palabra(s) a buscar."><input type="button"
                                                    onclick="clearInput('search')" class="btn botonGral" value="Borrar">
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-12 divBorder"></div>

                                    <div class=" col-12 col-sm-6 col-lg-12 my-3 ">
                                        <label class="labelTitulo">Descripción Equipo/Maquinaria:
                                            <span>*</span></label></br>
                                        <textarea rows="2" cols="80" class="form-control form-select" id="descripcion"
                                            placeholder="Especifique puntos o indicaciones a realizar en el mantenimiento..." readonly name="descripcion"
                                            value=""></textarea>
                                    </div>

                                    <div class="row">
                                        <div class=" col-12 col-sm-6  col-lg-4 my-3 ">
                                            <label class="labelTitulo">Fecha de Inicio: <span>*</span> </label></br>
                                            <input type="date" class="inputCaja" placeholder="Especifique..." required
                                                min="{{ date('Y-m-d') }}" pattern="\d{2}/\d{2}/\d{4}"
                                                placeholder="dd/mm/yyyy" id="fechaInicio" name="fechaInicio">
                                        </div>

                                        <div class=" col-12 col-sm-6  col-lg-4 my-3 ">
                                            <label class="labelTitulo">Tipo de Mantenimiento: <span>*</span></label></br>
                                            <select id="tipoMantenimientoId" name="tipoMantenimientoId"
                                                class="form-select form-select-lg mb-3 inputCaja" required
                                                aria-label="Default select example">
                                                <option value="">Seleccione</option>
                                                @foreach ($vctTipos as $item)
                                                    <option value="{{ $item->id }}">
                                                        {{ $item->nombre }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class=" col-12 col-sm-6  col-lg-4 my-3 ">

                                            <label class="labelTitulo">Uso de la Maquinaría: </label></br>
                                            <input type="number" class="inputCaja text-end"
                                                value="{{ old('kilometraje') }}" placeholder="Ej. 1000" step="1"
                                                min="0" id="usoKom" name="usoKom">
                                        </div>
                                    </div>

                                    <div class=" col-12 col-sm-6  col-lg-12 my-6 ">
                                        <label class="labelTitulo">Comentarios e Indicaciones para Ejecución del
                                            Mantenimiento:</label></br>
                                        <textarea rows="3" cols="80" class="form-control"
                                            placeholder="Escribe tus comentarios o información relevante para la ejecución del mantenimiento aquí."
                                            name="comentario" id="comentario"></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 text-center">
                                <button type="submit" class="btn botonGral mb-3">Guardar</button>
                            </div>

                        </form>
                    </div>
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
        function clearInput(controlId) {
            console.log(controlId);
            var getValue = document.getElementById(controlId);
            if (getValue.value != "") {
                getValue.value = "";
                getValue.focus();
            }
        }

        // var curso = ['html', 'hola', 'hi'];

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

        $('#searchMtq').autocomplete({

            source: function(request, response) {
                $.ajax({
                    url: "{{ route('search.equiposMTQ') }}",

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

            $('#" + $intCount + "').append(html);
        }

        // borrar registro
        $(document).on('click', '#removeRow', function() {
            $(this).closest('#inputFormRow').remove();
        });
    </script>

@endsection
