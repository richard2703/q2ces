@extends('layouts.main', ['activePage' => ' nuevoMantenimientos', 'titlePage' => __('Nuevo Mantenimiento')])
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
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">

                                <div class="card-header bacTituloPrincipal">
                                    <h4 class="card-title">Editar Registro de Mantenimiento</h4>
                                </div>

                                <div class="card-body ">
                                    <div class="col-12 col-md-2">
                                        <a href="{{ route('mantenimientos.index') }}">
                                            <button class="btn regresar">
                                                <span class="material-icons">
                                                    reply
                                                </span>
                                                Regresar
                                            </button>
                                        </a>
                                    </div>
                                    <form class="row alertaGuardar"
                                        action="{{ route('mantenimientos.update', $mantenimiento->id) }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('put')
                                        <input type="hidden" name="maquinariaId" id="maquinariaId" value="">
                                        <input type="hidden" name="titulo" id="titulo" value="">
                                        <div class="col-12 my-4">
                                            <div class="row">
                                                <input type="hidden" name="mantenimientoId" id="mantenimientoId"
                                                    value="{{ $mantenimiento->id }}">

                                                <input type="hidden" name="maquinariaId" id="maquinariaId"
                                                    value="{{ $mantenimiento->maquinariaId }}">

                                                <input type="hidden" name="personalId" id="personalId"
                                                    value="{{ $mantenimiento->personalId }}">


                                                <div class=" col-12 col-sm-6 col-lg-12 my-3 ">
                                                    <label class="labelTitulo">Descripción del mantenimiento:
                                                        <span>*</span></label></br>
                                                    <textarea rows="2" cols="80" class="form-control" id="titulo" name="titulo" required readonly>{{ $mantenimiento->titulo }}</textarea>
                                                </div>

                                                <div class=" col-12 col-sm-6  col-lg-4 my-3 ">
                                                    <label class="labelTitulo">Fecha de Inicio: </label></br>
                                                    <input type="date" class="inputCaja" placeholder="Especifique..." {{ ($mantenimiento->estadoId < 3? '': 'readonly')}}
                                                        readonly id="fechaInicio" name="fechaInicio"
                                                        value="{{ $mantenimiento->fechaInicio }}">
                                                </div>

                                                <div class=" col-12 col-sm-6  col-lg-4 my-3 ">
                                                    <label class="labelTitulo">Tipo de Mantenimiento:</label></br>
                                                    <select class="form-select form-select-lg mb-3 inputCaja" name="tipo" {{ ($mantenimiento->estadoId < 3? '': 'disabled="false"')}}
                                                        id="tipo" aria-label=".form-select-lg example">

                                                        <option value="">Seleccione</option>
                                                        <option value="Correctivo"
                                                            {{ $mantenimiento->tipo == 'Correctivo' ? ' selected' : '' }}>
                                                            Correctivo</option>
                                                        <option value="250"
                                                            {{ $mantenimiento->tipo == '250' ? ' selected' : '' }}>250
                                                        </option>
                                                        <option value="500"
                                                            {{ $mantenimiento->tipo == '500' ? ' selected' : '' }}>500
                                                        </option>
                                                        <option value="1000"
                                                            {{ $mantenimiento->tipo == '1000' ? ' selected' : '' }}>1000
                                                        </option>
                                                    </select>
                                                </div>
                                                <div class=" col-12 col-sm-6  col-lg-4 my-3 ">
                                                    <label class="labelTitulo">Estado del Mantenimiento:</label></br>
                                                    <select class="form-select form-select-lg mb-3 inputCaja" {{ ($mantenimiento->estadoId < 3? '': 'disabled="false"')}}
                                                        name="estadoId" id="estadoId" aria-label=".form-select-lg example">

                                                        <option value="">Seleccione</option>
                                                        <option value="1"
                                                            {{ $mantenimiento->estadoId == 1 ? ' selected' : '' }}>En
                                                            Espera
                                                        </option>
                                                        <option value="2"
                                                            {{ $mantenimiento->estadoId == 2 ? ' selected' : '' }}>
                                                            Realizando
                                                        </option>
                                                        <option value="3"
                                                            {{ $mantenimiento->estadoId == 3 ? ' selected' : '' }}>
                                                            Terminado
                                                        </option>
                                                    </select>
                                                </div>
                                                <div class=" col-12 col-sm-6  col-lg-12 my-6 ">
                                                    <label class="labelTitulo">Comentarios:</label></br>
                                                    <textarea rows="2" cols="80" class="form-control"  {{ ($mantenimiento->estadoId < 3? '': 'disabled="false"')}}
                                                        placeholder="Escribe tus comentarios o información relevante sobre el mantenimiento aquí." name="comentario"
                                                        id="comentario">{{ $mantenimiento->comentario }}</textarea>
                                                </div>
                                                <br>
                                                <hr>
                                                <div class=" col-12 col-sm-6  col-lg-3 my-3 ">
                                                    <label class="labelTitulo">Resguardatario:</label></br><input
                                                        id="personalId2" name="personalId2" type="text"  {{ ($mantenimiento->estadoId < 3? '': 'disabled="false"')}}
                                                        value="{{ $mantenimiento->personaId }}"
                                                        placeholder="Especifique..." class="inputCaja">
                                                </div>
                                                <div class=" col-12 col-sm-6  col-lg-3 my-3 ">
                                                    <label class="labelTitulo">Adscripción:</label></br><input
                                                        id="adscripcion" name="adscripcion" type="text"  {{ ($mantenimiento->estadoId < 3? '': 'disabled="false"')}}
                                                        value="{{ $mantenimiento->adcripcion }}"
                                                        placeholder="Especifique..." class="inputCaja">
                                                </div>
                                                <div class=" col-12 col-sm-6  col-lg-3 my-3 ">
                                                    <label class="labelTitulo">Horómetro: </label></br>
                                                    <input type="number" class="inputCaja text-end"  {{ ($mantenimiento->estadoId < 3? '': 'disabled="false"')}}
                                                        value="{{ $mantenimiento->horometro }}" placeholder="Ej. 1000"
                                                        step="1" min="0" id="horometro" name="horometro">
                                                </div>
                                                <div class=" col-12 col-sm-6  col-lg-3 my-3 ">
                                                    <label class="labelTitulo">Km/m: </label></br>
                                                    <input type="number" class="inputCaja text-end"  {{ ($mantenimiento->estadoId < 3? '': 'disabled="false"')}}
                                                        value="{{ $mantenimiento->kilometraje }}" placeholder="Ej. 1000"
                                                        step="1" min="0" id="kilometraje"
                                                        name="kilometraje">
                                                </div>

                                                <hr>
                                                <div class=" col-12 col-sm-6  col-lg-4 my-3 ">
                                                    <label class="labelTitulo">Subtotal: </label></br>
                                                    <input type="text" class="inputCaja text-end" readonly
                                                        value="{{ $mantenimiento->subtotal }}" placeholder="Ej. 1"
                                                        id="subtotal" name="subtotal">
                                                </div>
                                                <div class=" col-12 col-sm-6  col-lg-4 my-3 ">
                                                    <label class="labelTitulo">Iva: </label></br>
                                                    <input type="text" class="inputCaja text-end" readonly
                                                        value="{{ $mantenimiento->iva }}" placeholder="Ej. 1"
                                                        id="iva" name="iva">
                                                </div>
                                                <div class=" col-12 col-sm-6  col-lg-4 my-3 ">
                                                    <label class="labelTitulo">Total: </label></br>
                                                    <input type="text" class="inputCaja text-end" readonly
                                                        value="{{ $mantenimiento->costo }}" placeholder="Ej. 1"
                                                        id="total" name="total">
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-12 divBorder">
                                            <h2 class="tituloEncabezado">Material de Mantenimiento</h2></br></br>
                                        </div>
                                        @if ($mantenimiento->estadoId < 3)
                                            <div class="row d-flex">
                                                <div class="col-12 col-md-6  mt-3 ">
                                                    <p class="subEncabezado">Busca un Material</p>
                                                    <div class="mb-4 mt-0" role="search" class="">
                                                        <input value="" class="search-submit ">
                                                        <input autofocus type="text" class="search-text"
                                                            id="search2" name="search2" placeholder="Buscar..."
                                                            title="Escriba la(s) palabra(s) a buscar.">
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="my-4 divBorder">
                                                <h3 class="subEncabezado mb-3">Listado de refacciones</h3>
                                            </div>
                                        @endif
                                        <div class=" col-12  my-3 ">
                                            <ul class="" id="newRow">

                                                @forelse ($gastos as $item)
                                                    <li class="listaMaterialMantenimiento my-3 border-bottom"
                                                        id="inputFormRow">
                                                        <div class="row d-flex pb-4">


                                                            <input type="hidden" name="gastoId[]" id="gastoId"
                                                                value="{{ $item->id != null ? $item->id : 0 }}">

                                                            <input type="hidden" name="inventarioId[]" id="inventarioId"
                                                                value="{{ $item->inventarioId }}">

                                                            <input type="hidden" name="costo[]" id="costo"
                                                                value="{{ $item->costo }}">

                                                            <div class="col-3 ">
                                                                <label for="cantidad"
                                                                    class="">Cantidad</label></br></br>
                                                                @if ($mantenimiento->estadoId < 3)
                                                                    <input type="number" maxlength="2" min="1"
                                                                        required max="99" step="1"
                                                                        class="inputCaja text-right" id="cantidad"
                                                                        placeholder="Ej. 1" name="cantidad[]"
                                                                        value="{{ $item->cantidad }}">
                                                                @else
                                                                    <input type="text" readonly required
                                                                        class="inputCaja text-end" id="cantidad"
                                                                        placeholder="Ej. 1" name="cantidad[]"
                                                                        value="{{ $item->cantidad }}">
                                                                @endif
                                                            </div>

                                                            <div class="col-7">
                                                                <label for="descripcion"
                                                                    class="">Descripción</label></br></br>
                                                                <textarea rows="3" cols="80" class="form-control form-select" id="descripcion" readonly
                                                                    name="descripcion[]" value="">{{ 'Artículo: ' . $item->articulo . ', Número de parte: ' . $item->numeroParte . ', Modelo: ' . $item->modelo . ', PU: $ ' . $item->valor }} </textarea>
                                                            </div>

                                                            @if ($mantenimiento->estadoId < 3)
                                                                <div class="col-2"></br></br>
                                                                    <button id="removeRow" type="button"
                                                                        class="btn btn-danger">Borrar</button>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </li>


                                                @empty
                                                    <li>Sin registros.</li>
                                                @endforelse

                                            </ul>
                                        </div>

                                        @if ($mantenimiento->estadoId < 3)
                                        <div class="col-12 text-center mt-5 pt-5">
                                            <button type="submit" class="btn botonGral">Guardar</button>
                                        </div>
                                        @endif
                                    </form>
                                </div>
                            </div>
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
                $('#nombre').val(ui.item.nombre);
                $('#marca').val(ui.item.marca);
                $('#modelo').val(ui.item.modelo);
                $('#numserie').val(ui.item.numserie);
                $('#placas').val(ui.item.placas);
                $('#titulo').val(ui.item.nombre);
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
                crearItems(ui.item.id, ui.item.value, ui.item.valor);

                // $('#inventarioId').val(ui.item.id);
                // $('#descripcion').val(ui.item.value);
            }

        });
    </script>

    <script type="text/javascript">
        function crearItems(inventarioId, descripcion, costo) {
            var html = '';
            html += '<li class="listaMaterialMantenimiento my-3 border-bottom" id="inputFormRow">';
            html += '   <div class="row d-flex pb-4">';
            html += '      <input type="hidden" name="gastoId[]" id="gastoId" value="">';
            html += '      <input type="hidden" name="inventarioId[]" id="inventarioId" value="' + inventarioId + '">';
            html += '      <input type="hidden" name="costo[]" id="costo" value="' + costo + '">';
            html += '      <div class="col-3 ">';
            html += '           <label for="cantidad" class="">Cantidad</label></br></br>';
            html +=
                '           <input type="number" maxlength="2" min="1" required max="99" step="1" class="inputCaja text-right" id="cantidad" placeholder="Ej. 1" name="cantidad[]" value="">';
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
