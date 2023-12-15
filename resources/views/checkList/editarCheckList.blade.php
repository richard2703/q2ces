@extends('layouts.main', ['activePage' => 'mantenimiento', 'titlePage' => __('Editar CheckList')])
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
                        <form class="alertaGuardar" action="{{ route('checkListRegistros.update') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <input type="hidden" name="maquinariaId" id="maquinariaId"
                                value="{{ $checkList->maquinariaId }}">
                            <input type="hidden" name="identificador" id="identificador"
                                value="{{ $maquinaria->identificador }}">
                            <input type="hidden" name="codigo" id="codigo" value="{{ $bitacora->codigo }}">
                            <input type="hidden" name="version" id="identificador" value="{{ $bitacora->version }}">
                            <input type="hidden" name="usuarioId" id="usuarioId" value="{{ auth()->user()->id }}">
                            <input type="hidden" name="bitacoraId" id="bitacoraId" value="{{ $checkList->bitacoraId }}">
                            <input type="hidden" name="bitacora" id="bitacora" value="{{ $checkList->bitacora }}">
                            <input type="hidden" name="maquinaria" id="maquinaria" value="{{ $checkList->maquinaria }}">
                            <input type="hidden" name="checkListId" id="checkListId" value="{{ $checkList->id }}">
                            <div class="card-header bacTituloPrincipal">
                                <h4 class="card-title">Editar Registro de CheckList</h4>
                            </div>

                            <div class="card-body ">
                                <div class="row">
                                    <div class="col-12 text-right">
                                        <a href="{{ route('checkList.index') }}">
                                            <button class="btn regresar">
                                                <span class="material-icons">
                                                    reply
                                                </span>
                                                Regresar
                                            </button>
                                        </a>
                                    </div>
                                </div>
                                <div class="row mt-3">


                                    <div class="col-12 ">

                                        <div class="row alin">

                                            <div class=" col-12 col-sm-8  col-lg-8 my-1  ">
                                                <label class="labelTitulo">Bitácora:</label></br>
                                                <input type="text" class="inputCaja" id="bitacora1" name="bitacora1"
                                                    readonly disabled="true" value="{{ $checkList->bitacora }}">
                                            </div>

                                            <div class=" col-12 col-sm-4  col-lg-4 my-1  ">
                                                <label class="labelTitulo">Código:</label></br>
                                                <input type="text" class="inputCaja" id="marca" name="marca"
                                                    readonly disabled="true"
                                                    value="{{ $bitacora->codigo . ' V' . $bitacora->version }}">
                                            </div>

                                            <div class=" col-12 col-sm-8  col-lg-8 my-1  ">
                                                <label class="labelTitulo">Equipo:
                                                    <span>*</span></label></br>
                                                <input type="text" class="inputCaja" id="maquinaria1" readonly
                                                    disabled="true" required name="maquinaria1"
                                                    value="{{ $checkList->maquinaria }}">
                                            </div>

                                            <div class=" col-12 col-sm-4  col-lg-4 my-1 ">

                                                <label class="labelTitulo">Uso de la Maquinaría:
                                                </label></br>
                                                <input type="number" class="inputCaja text-end" placeholder="Ej. 1000"
                                                    value="{{ $checkList->usoKom }}" step="1" min="0"
                                                    disabled="true" tabindex="0" id="usoKom" name="usoKom">
                                            </div>

                                            <div class=" col-12">
                                                <label class="labelTitulo">Comentarios:</label></br>
                                                <textarea class="form-control" placeholder="Escribe tu comentario aquí sobre la revisión del CheckList" id="comentario"
                                                    name="comentario" spellcheck="true">{{ $checkList->comentario }}</textarea>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="d-flex p-3">
                                        <div class="col-12" id="elementos">
                                            <div class="d-flex">
                                                <div class="col-12 divBorder">
                                                    <h2 class="tituloEncabezado ">Detalle</h2>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                @php
                                    $strNombreGrupo = '';
                                    $intCont = 1;
                                    $intGroup = 1;
                                    $blnNuevaSeccion = false;
                                    $objPresentacion = new checkListPresentacion();
                                    /*** directorio contenedor de su información */
                                    $strMaquinaria = str_pad($checkList->identificador, 4, '0', STR_PAD_LEFT);
                                    //*** folio consecutivo del checklist */
                                    $intFolioCheckList = str_pad($checkList->id, 4, '0', STR_PAD_LEFT);
                                    //*** codigo y version de bitacora */
                                    $strBitacora = str_replace(' ', '_', trim($checkList->codigo) . '_v' . trim($checkList->version));

                                    $pathImagen = '/storage/maquinaria/' . $strMaquinaria . '/checkList/' . $strBitacora;
                                    // dd($pathImagen);
                                @endphp

                                <div class="card col-12">
                                    <div class="card-body contCart">
                                        <div class="accordion my-3" id="accordionExample">

                                            @forelse ($grupos as $item)
                                                @if ($intGroup == 1)
                                                    <div class="accordion-item" style="margin-top: -20px;"
                                                        id="AccordionPrincipal">
                                                        <h2 class="accordion-header " id="headingOne">

                                                            @php echo $objPresentacion->getImagenGrupoTareasControl($item->grupoId, 32); @endphp
                                                            <button class="accordion-button bacTituloPrincipal"
                                                                type="button" data-bs-toggle="collapse"
                                                                data-bs-target="#{{ str_replace(' ', '_', $item->grupo) }}"
                                                                aria-expanded="true" aria-controls="collapseOne">

                                                                Sección de {{ $item->grupo }}
                                                            </button>
                                                        </h2>

                                                        <div id="{{ str_replace(' ', '_', $item->grupo) }}"
                                                            class="accordion-collapse collapse show"
                                                            aria-labelledby="headingOne"
                                                            data-bs-parent="#accordionExample">
                                                            <div class="accordion-body">

                                                                <div class="row mt-3 d-flex">
                                                                    <div class="col-12">
                                                                        <div class="row d-flex p-1 divBorder">
                                                                            <div class="col-6 ">
                                                                                <label class="labelTitulo">Tarea</label>
                                                                            </div>
                                                                            <div class="col-6">
                                                                                <label
                                                                                    class="labelTitulo">Resultado</label>
                                                                            </div>
                                                                        </div>

                                                                        @forelse ($vctRecords as $tarea)
                                                                            @if ($item->grupoId == $tarea->grupoId)
                                                                                <div class="row">
                                                                                    <div class="col-5">
                                                                                        {{ $tarea->tarea }}
                                                                                        <input type="hidden"
                                                                                            name="tarea[]" id="tarea"
                                                                                            value="{{ $tarea->tarea }}">
                                                                                        <input type="hidden"
                                                                                            name="recordId[]"
                                                                                            id="recordId"
                                                                                            value="{{ $tarea->id }}">

                                                                                        <input type="hidden"
                                                                                            name="tareaId[]"
                                                                                            id="tareaId"
                                                                                            value="{{ $tarea->tareaId }}">

                                                                                        <input type="hidden"
                                                                                            name="grupo[]" id="grupo"
                                                                                            value="{{ $tarea->grupo }}">

                                                                                        <input type="hidden"
                                                                                            name="grupoId[]"
                                                                                            id="grupoId"
                                                                                            value="{{ $tarea->grupoId }}">

                                                                                        <input type="hidden"
                                                                                            name="controlHtml[]"
                                                                                            id="controlHtml"
                                                                                            value="{{ $tarea->controlHtml }}">
                                                                                    </div>
                                                                                    <div class="col-1">
                                                                                        @php
                                                                                            if (is_null($tarea->ruta) == false) {
                                                                                                echo "<a class='img-mouse'><i class='fas fa-camera'> </i></a>";
                                                                                                echo '<input class="img-a-mostrar" type="image" width="300" id="image' . $tarea->tareaId . '" alt="Imagen" src="' . asset($pathImagen . '/' . $tarea->ruta) . '" />';
                                                                                            }
                                                                                        @endphp
                                                                                    </div>
                                                                                    <div class="col-6">
                                                                                        @php echo $objPresentacion->getControlByTarea($tarea->tareaId, $tarea->resultado, $tarea->valor, $intCont); @endphp
                                                                                    </div>
                                                                                </div>
                                                                                @php
                                                                                    $intCont += 1;
                                                                                @endphp
                                                                            @endif

                                                                        @empty
                                                                            <div class="row">
                                                                                <div class="col-12">
                                                                                    class="labelTitulo">Sin
                                                                                    registros</label>
                                                                                </div>
                                                                            </div>
                                                                        @endforelse

                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="accordion-item" id="AccordionSecondary">
                                                        <h2 class="accordion-header" id="headingThree">
                                                            <button class="accordion-button bacTituloPrincipal"
                                                                type="button" data-bs-toggle="collapse"
                                                                data-bs-target="#{{ str_replace(' ', '_', $item->grupo) }}"
                                                                aria-expanded="true" aria-controls="collapseOne">
                                                                Sección de {{ $item->grupo }}
                                                            </button>
                                                        </h2>
                                                        <div id="{{ str_replace(' ', '_', $item->grupo) }}"
                                                            class="accordion-collapse collapse"
                                                            aria-labelledby="headingThree"
                                                            data-bs-parent="#accordionExample">
                                                            <div class="accordion-body">

                                                                <div class="row mt-3 d-flex">
                                                                    <div class="col-12">

                                                                        <div class="row mt-3 d-flex">
                                                                            <div class="col-12">
                                                                                <div class="row d-flex p-1 divBorder">
                                                                                    <div class="col-6">
                                                                                        <label
                                                                                            class="labelTitulo">Tarea</label>
                                                                                    </div>
                                                                                    <div class="col-6">
                                                                                        <label
                                                                                            class="labelTitulo">Resultado</label>
                                                                                    </div>
                                                                                </div>

                                                                                @forelse ($vctRecords as $tarea)
                                                                                    @if ($item->grupoId == $tarea->grupoId)
                                                                                        <div class="row">
                                                                                            <div class="col-5">
                                                                                                {{ $tarea->tarea }}
                                                                                                <input type="hidden"
                                                                                                    name="tarea[]" id="tarea"
                                                                                                    value="{{ $tarea->tarea }}">
                                                                                                <input type="hidden"
                                                                                                    name="recordId[]"
                                                                                                    id="recordId"
                                                                                                    value="{{ $tarea->id }}">

                                                                                                <input type="hidden"
                                                                                                    name="tareaId[]"
                                                                                                    id="tareaId"
                                                                                                    value="{{ $tarea->tareaId }}">

                                                                                                <input type="hidden"
                                                                                                    name="grupo[]" id="grupo"
                                                                                                    value="{{ $tarea->grupo }}">

                                                                                                <input type="hidden"
                                                                                                    name="grupoId[]"
                                                                                                    id="grupoId"
                                                                                                    value="{{ $tarea->grupoId }}">

                                                                                                <input type="hidden"
                                                                                                    name="controlHtml[]"
                                                                                                    id="controlHtml"
                                                                                                    value="{{ $tarea->controlHtml }}">
                                                                                            </div>
                                                                                            <div class="col-1">
                                                                                                @php
                                                                                                    if (is_null($tarea->ruta) == false) {
                                                                                                        echo "<a class='img-mouse'><i class='fas fa-camera'> </i></a>";
                                                                                                        echo '<input class="img-a-mostrar" type="image" width="300" id="image' . $tarea->tareaId . '" alt="Imagen" src="' . asset($pathImagen . '/' . $tarea->ruta) . '" />';
                                                                                                    }
                                                                                                @endphp
                                                                                            </div>
                                                                                            <div class="col-6">
                                                                                                @php echo $objPresentacion->getControlByTarea($tarea->tareaId, $tarea->resultado, $tarea->valor, $intCont); @endphp
                                                                                            </div>
                                                                                        </div>
                                                                                        @php
                                                                                            $intCont += 1;
                                                                                        @endphp
                                                                                    @endif
                                                                                @empty
                                                                                    <div class="row">
                                                                                        <div class="col-12">
                                                                                            <label class="labelTitulo">Sin
                                                                                                registros</label>
                                                                                            </p>
                                                                                        </div>
                                                                                    </div>
                                                                                @endforelse

                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                                @php
                                                    $intGroup += 1;
                                                @endphp

                                            @empty
                                            @endforelse

                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 text-center m-3 pt-2">
                                    <a href="{{ route('checkList.index') }}">
                                        <button type="button" class="btn btn-danger">Cancelar</button>
                                    </a>
                                    <a href="#">
                                        <button type="submit" class="btn botonGral">Guardar</button>
                                    </a>
                                </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <style>
        .img-mouse {
            background: #5c7c26;
            color: #fff;
            padding: 5px;
            border-radius: 5px;
        }

        .img-a-mostrar {
            display: none;
        }

        /* Aquí está la magia que no me funciona*/
        .img-mouse:hover+.img-a-mostrar {
            display: block !important;
            /* activamos la imágen y hasta le ruego con un !important */
        }
    </style>

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
