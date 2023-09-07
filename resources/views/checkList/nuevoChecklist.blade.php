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
                        <form class="alertaGuardar" action="{{ route('checkListRegistros.store') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="maquinariaId" id="maquinariaId" value="{{ $maquinaria->id }}">
                            <input type="hidden" name="usuarioId" id="usuarioId" value="{{ auth()->user()->id }}">
                            <input type="hidden" name="bitacoraId" id="bitacoraId" value="{{ $bitacora->id }}">
                            <input type="hidden" name="bitacora" id="bitacora" value="{{ $bitacora->nombre }}">
                            <input type="hidden" name="maquinaria" id="maquinaria" value="{{ $maquinaria->nombre }}">
                            <div class="card-header bacTituloPrincipal">
                                <h4 class="card-title">Nuevo Registro de CheckList</h4>
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


                                    <div class="col-12 col-md-8 ">

                                        <div class="row alin">
                                            <div class=" col-12  ">
                                                <label class="labelTitulo">Equipo:
                                                    <span>*</span></label></br>
                                                <input type="text" class="inputCaja" id="nombre" readonly
                                                    disabled="true" required name="nombre"
                                                    value="{{ $maquinaria->nombre }}">
                                            </div>


                                            <div class=" col-12   ">
                                                <label class="labelTitulo">Bitácora:</label></br>
                                                <input type="text" class="inputCaja" id="marca" name="marca"
                                                    readonly disabled="true" value="{{ $bitacora->nombre }}">
                                            </div>


                                            <div class=" col-12">
                                                <label class="labelTitulo">Comentarios:</label></br>
                                                <textarea class="form-control" placeholder="Escribe tu comentario aquí sobre la revisión del CheckList" id="comentario"
                                                    name="comentario" spellcheck="true"></textarea>
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

                                <div class="table-responsive">
                                    <table class="table">
                                        <thead class="labelTitulo">
                                            {{-- <tr>
                                                <th class="labelTitulo">Tarea</th>
                                                <th class="labelTitulo">Resultado</th>
                                            </tr> --}}
                                        </thead>
                                        <tbody>
                                            <?php
                                            $strNombreGrupo = '';
                                            $intCont = 0;
                                            $blnNuevaSeccion = false;
                                            $objPresentacion = new checkListPresentacion();
                                            ?>
                                            @forelse ($vctTareas as $item)
                                                <?php
                                                if ($strNombreGrupo == '') {
                                                    //*** es la primera vez
                                                    $strNombreGrupo = $item->grupo;
                                                    $blnNuevaSeccion = true;
                                                } elseif ($strNombreGrupo != $item->grupo) {
                                                    $strNombreGrupo = $item->grupo;
                                                    $blnNuevaSeccion = true;
                                                } else {
                                                    $blnNuevaSeccion = false;
                                                }

                                                ?>
                                                @if ($blnNuevaSeccion == true)
                                                    <tr>
                                                        <th class="labelTitulo" colspan="2">Sección
                                                            {{ $strNombreGrupo }}</th>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Tarea</strong></td>
                                                        <td><strong>Resultado</strong></td>
                                                    </tr>
                                                @endif

                                                <tr>
                                                    <td>
                                                        {{ $item->tareaId }} .- {{ $item->tarea }}
                                                        <input type="hidden" name="tarea[]" id="tarea"
                                                            value="{{ $item->tarea }}">

                                                        <input type="hidden" name="tareaId[]" id="tareaId"
                                                            value="{{ $item->tareaId }}">

                                                        <input type="hidden" name="grupo[]" id="grupo"
                                                            value="{{ $item->grupo }}">

                                                        <input type="hidden" name="grupoId[]" id="grupoId"
                                                            value="{{ $item->grupoId }}">
                                                    </td>
                                                    <td>

                                                        <?php echo $objPresentacion->getControl($item->controlHtml, $item->tarea, $item->tareaId, $intCont); ?>
                                                        <?php

                                                        // switch ($item->tipoValorId) {
                                                        //     //*** CASO 1
                                                        //     case 1:
                                                        ?>
                                                        {{-- <div>
                                                            <input type="radio" id="control{{ $intCont }}1"
                                                                name="resultado{{ $item->tareaId }}[]" value="2"
                                                                checked>
                                                            <label class="form-check-label labelProrrogable"
                                                                for="control{{ $intCont }}1">Revisión Ok</label>
                                                        </div>
                                                        <div>
                                                            <input type="radio" id="control{{ $intCont }}2"
                                                                name="resultado{{ $item->tareaId }}[]" value="1">
                                                            <label class="form-check-label labelDeseable"
                                                                for="control{{ $intCont }}2">Requiere Atención
                                                                Futura</label>
                                                        </div>
                                                        <div>
                                                            <input type="radio" id="control{{ $intCont }}3"
                                                                name="resultado{{ $item->tareaId }}[]" value="0">
                                                            <label class="form-check-label labelUrgente"
                                                                for="control{{ $intCont }}3">Requiere Atención
                                                                Inmediata</label>
                                                        </div> --}}
                                                        <?php
                                                        //                                                                 break;
                                                        // //*** CASO 2
                                                        //                                                                 case 2:
                                                        ?>
                                                        {{-- <div>
                                                            <input type="radio" id="control{{ $intCont }}1"
                                                                name="resultado{{ $item->tareaId }}[]" value="2"
                                                                checked>
                                                            <label class="form-check-label labelProrrogable"
                                                                for="control{{ $intCont }}1">Revisión Ok</label>
                                                        </div>
                                                        <div>
                                                            <input type="radio" id="control{{ $intCont }}3"
                                                                name="resultado{{ $item->tareaId }}[]" value="0">
                                                            <label class="form-check-label labelUrgente"
                                                                for="control{{ $intCont }}3">Requiere Atención
                                                                Inmediata</label>
                                                        </div> --}}
                                                        <?php
                                                        // break;

                                                        // //*** CASO 3
                                                        // case 3:
                                                        ?>
                                                        {{-- <div>
                                                            <input type="radio" id="control{{ $intCont }}1"
                                                                name="resultado{{ $item->tareaId }}[]" value="2"
                                                                checked>
                                                            <label class="form-check-label labelProrrogable"
                                                                for="control{{ $intCont }}1">50%
                                                                o más de
                                                                Vida</label>
                                                        </div>
                                                        <div>
                                                            <input type="radio" id="control{{ $intCont }}2"
                                                                name="resultado{{ $item->tareaId }}[]" value="1">
                                                            <label class="form-check-label labelDeseable"
                                                                for="control{{ $intCont }}2">20% al 50% de
                                                                Vida</label>
                                                        </div>
                                                        <div>
                                                            <input type="radio" id="control{{ $intCont }}3"
                                                                name="resultado{{ $item->tareaId }}[]" value="0">
                                                            <label class="form-check-label labelUrgente"
                                                                for="control{{ $intCont }}3">Menos del 20% de
                                                                Vida</label>
                                                        </div> --}}

                                                        <?php
                                                        // break;
                                                        //     default:
                                                        //         # code...
                                                        //         break;
                                                        // }
                                                        ?>
                                                    </td>
                                                </tr>

                                                <?php
                                                $intCont += 1;
                                                ?>
                                            @empty
                                                <tr>
                                                    <td colspan="4">Sin registros.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                            @if ($vctTareas->isEmpty() === false)
                                <div class="col-12 text-center mt-5 pt-5">
                                    <button type="submit" class="btn botonGral mb-3">Guardar</button>
                                </div>
                            @else
                                <div class="col-12 text-center mt-5 pt-5">
                                    <p>La bitácora no cuenta con grupos de tareas asignados. Verifique que se asignen los
                                        grupos de tareas correspondientes antes de continuar.</p>
                                </div>
                            @endif

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
