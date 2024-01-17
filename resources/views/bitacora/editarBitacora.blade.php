@extends('layouts.main', ['activePage' => ' bitacoras', 'titlePage' => __('Editar Bitácoras')])
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header bacTituloPrincipal">
                                    <h4 class="card-title">Editar Bitácoras</h4>
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
                                    </div>
                                    <br />
                                    <div class="col-md-12">
                                        <form class="row alertaGuardar"
                                            action="{{ route('bitacoras.update', $bitacora->id) }}" method="post"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('put')
                                            <div class="col-12 my-6">
                                                <div class="row">
                                                    <div class="card">
                                                        <div class="row">
                                                            <div class=" col-12 col-sm-6  col-lg-9 my-6 ">
                                                                <label class="labelTitulo">Nombre:
                                                                    <span>*</span></label></br>

                                                                <input type="text" required maxlength="250"
                                                                    id="nombre" name="nombre"
                                                                    value="{{ $bitacora->nombre }}"
                                                                    placeholder="Especifique el nombre de la bitácora."
                                                                    class="inputCaja">
                                                            </div>


                                                            <div class=" col-2 col-sm-6  col-lg-3 my-6 ">
                                                                <label class="labelTitulo">Activa :
                                                                    <span></span></label></br>
                                                                <select class="form-select"
                                                                    aria-label="Default select example" id="activa"
                                                                    name="activa">
                                                                    <option value="0"
                                                                        {{ $bitacora->activa == 0 ? ' selected' : '' }}>No
                                                                    </option>
                                                                    <option value="1"
                                                                        {{ $bitacora->activa == 1 ? ' selected' : '' }}>Sí
                                                                    </option>
                                                                </select>
                                                            </div>

                                                            <div class=" col-4 col-sm-6  col-lg-5 my-6 ">
                                                                <label class="labelTitulo">Frecuencia de Ejecución:
                                                                    <span>*</span></label></br>
                                                                <select class="form-select"
                                                                    aria-label="Default select example" required
                                                                    id="frecuenciaId" name="frecuenciaId">
                                                                    <option selected value="">Selecciona una opción
                                                                    </option>
                                                                    @foreach ($vctFrecuencias as $item)
                                                                        <option value="{{ $item->id }}"
                                                                            {{ $item->id == $bitacora->frecuenciaId ? ' selected' : '' }}>
                                                                            {{ $item->nombre . ' [ ' . $item->dias . ' días]' }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <div class=" col-2 col-sm-6  col-lg-3 my-6 ">
                                                                <label class="labelTitulo">Reprogramación :
                                                                    <span></span></label></br>
                                                                <select class="form-select"
                                                                    aria-label="Default select example" id="renovacion"
                                                                    name="renovacion">
                                                                    <option value="0"
                                                                        {{ $bitacora->renovacion == 0 ? ' selected' : '' }}>
                                                                        No
                                                                    </option>
                                                                    <option value="1"
                                                                        {{ $bitacora->renovacion == 1 ? ' selected' : '' }}>
                                                                        Sí
                                                                    </option>
                                                                </select>
                                                            </div>

                                                            <div class=" col-4 col-sm-6  col-lg-2 my-6 ">
                                                                <label class="labelTitulo">Código:
                                                                    <span>*</span></label></br>
                                                                <input type="text" required maxlength="10" id="codigo"
                                                                    value="{{ $bitacora->codigo }}" name="codigo"
                                                                    placeholder="Especifique el código de la bitácora, Ej. QCEM-V01"
                                                                    class="inputCaja">
                                                            </div>

                                                            <div class=" col-2 col-sm-6  col-lg-2 my-6 ">
                                                                <label class="labelTitulo">Versión:
                                                                    <span>*</span></label></br>
                                                                <input type="number" class="inputCaja text-end"
                                                                    id="version" maxlength="4" min="0"
                                                                    max="9999"
                                                                    placeholder="Especifique la versión de la bitácora, Ej. 1"
                                                                    name="version" value="{{ $bitacora->version }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!--Espacio para asignacion de grupos de tareas y maquinaria-->
                                            <div class="col-12 my-4">
                                                <div class="row">
                                                    <div class="card">
                                                        <!-- <div class="card-header bacTituloPrincipal">
                                                                                                                                                                                                                                                                                                                                                                                                    </div>-->
                                                        <div class="card-body mb-3">
                                                            <div class="nav nav-tabs justify-content-evenly" id="myTab"
                                                                role="tablist">
                                                                <button
                                                                    class=" nav-item col-12 col-md-6 BTNbCargaDescarga py-3 border-0 active "
                                                                    role="presentation" id="home-tab" data-bs-toggle="tab"
                                                                    data-bs-target="#home-tab-pane" type="button"
                                                                    role="tab" aria-controls="home-tab-pane"
                                                                    aria-selected="true">Grupos de Tareas
                                                                    Asignados</button>
                                                                <button class="nav-item col-12 col-md-6 BTNbCargaDescarga "
                                                                    role="presentation" id="profile-tab"
                                                                    data-bs-toggle="tab" data-bs-target="#profile-tab-pane"
                                                                    type="button" role="tab"
                                                                    aria-controls="profile-tab-pane"
                                                                    aria-selected="false">Maquinaría Asignada</button>
                                                            </div>

                                                            <div class="tab-content contentCargas" id="myTabContent">
                                                                <div class="tab-pane fade show active" id="home-tab-pane"
                                                                    role="tabpanel" aria-labelledby="home-tab"
                                                                    tabindex="0">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="card">
                                                                                <div class="card-body">
                                                                                    <div class="row d-flex">
                                                                                        <div
                                                                                            class="col-12 col-md-6  mt-3 ">
                                                                                            <p class="subEncabezado">
                                                                                                Busca un Grupo de Tareas
                                                                                            </p>
                                                                                            <div class="mb-6 mt-0"
                                                                                                role="search"
                                                                                                class="inputCaja">
                                                                                                <input value=""
                                                                                                    class="search-submit ">
                                                                                                <input autofocus
                                                                                                    type="text"
                                                                                                    class=""
                                                                                                    id="searchGrupos"
                                                                                                    name="searchGrupos"
                                                                                                    placeholder="Escribe aquí el texto a buscar..."
                                                                                                    title="Escriba la(s) palabra(s) a buscar.">
                                                                                                <input type="button"
                                                                                                    onclick="clearInput('searchGrupos')"
                                                                                                    class="btn botonGral"
                                                                                                    value="Borrar">
                                                                                            </div>
                                                                                        </div>

                                                                                    </div>

                                                                                    <div class="my-4 divBorder">
                                                                                        <h3 class="subEncabezado mb-3">
                                                                                            Listado de Grupo de Tareas
                                                                                        </h3>
                                                                                    </div>

                                                                                    <div class=" col-12  my-3 ">
                                                                                        <ul class=""
                                                                                            id="newRowGrupos">

                                                                                            @forelse ($grupos as $item)
                                                                                                <li class="listaMaterialMantenimiento my-3 border-bottom"
                                                                                                    id="inputFormRowGrupos">

                                                                                                    <div
                                                                                                        class="row d-flex pb-4">

                                                                                                        <input
                                                                                                            type="hidden"
                                                                                                            name="grupoBitacoraId[]"
                                                                                                            id="grupoBitacoraId"
                                                                                                            value="{{ $item->id != null ? $item->id : 0 }}">

                                                                                                        <input
                                                                                                            type="hidden"
                                                                                                            name="grupoId[]"
                                                                                                            id="grupoId"
                                                                                                            value="{{ $item->grupoId }}">

                                                                                                        <input
                                                                                                            type="hidden"
                                                                                                            name="bitacoraId[]"
                                                                                                            id="bitacoraId"
                                                                                                            value="{{ $item->bitacoraId }}">

                                                                                                        <div
                                                                                                            class="col-5 ">
                                                                                                            <label
                                                                                                                for="nombreGrupo"
                                                                                                                class="">Grupo
                                                                                                                de
                                                                                                                Tareas</label></br></br>
                                                                                                            <input
                                                                                                                type="text"
                                                                                                                maxlength="250"
                                                                                                                readonly
                                                                                                                class="inputCaja"
                                                                                                                id="nombreGrupo"
                                                                                                                disabled="true"
                                                                                                                placeholder="El Grupo de Tareas"
                                                                                                                name="nombreGrupo[]"
                                                                                                                value="{{ $item->grupo }}">
                                                                                                        </div>

                                                                                                        <div
                                                                                                            class="col-5">
                                                                                                            <label
                                                                                                                for="descripcion"
                                                                                                                class="">Descripción</label></br></br>
                                                                                                            <textarea rows="3" cols="80" class="form-control form-select" id="descripcion" readonly
                                                                                                                name="descripcion[]" disabled="true" value="">{{ $item->comentario }} </textarea>
                                                                                                        </div>

                                                                                                        <div
                                                                                                            class="col-2">
                                                                                                            </br></br>
                                                                                                            <button
                                                                                                                id="removeRowGrupos"
                                                                                                                type="button"
                                                                                                                class="btn btn-danger">Borrar</button>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </li>

                                                                                            @empty
                                                                                                <li>Sin registros.</li>
                                                                                            @endforelse

                                                                                        </ul>
                                                                                    </div>



                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="tab-pane fade" id="profile-tab-pane"
                                                                    role="tabpanel" aria-labelledby="profile-tab"
                                                                    tabindex="0">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="card">
                                                                                <div class="card-body">
                                                                                    <div class="col-12 my-4">
                                                                                        <div class="row">
                                                                                            <p class="subEncabezado">Busca
                                                                                                Una Maquinaria</p>
                                                                                            <div class="mb-4 mt-0"
                                                                                                role="search"
                                                                                                class="">
                                                                                                <input value=""
                                                                                                    class="search-submit ">
                                                                                                <input autofocus
                                                                                                    type="text"
                                                                                                    class=""
                                                                                                    id="searchMaquinaria"
                                                                                                    name="searchMaquinaria"
                                                                                                    placeholder="Escribe aquí el texto a buscar..."
                                                                                                    title="Escriba la(s) palabra(s) a buscar.">
                                                                                                <input type="button"
                                                                                                    onclick="clearInput('searchMaquinaria')"
                                                                                                    class="btn botonGral"
                                                                                                    value="Borrar">
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="my-4 divBorder">
                                                                                            <h3 class="subEncabezado mb-3">
                                                                                                Listado de Equipos
                                                                                            </h3>
                                                                                        </div>

                                                                                        <div class=" col-12  my-3 ">
                                                                                            <ul class=""
                                                                                                id="newRowEquipos">

                                                                                                @forelse ($equipos as $item)
                                                                                                    <li class="listaEquipos my-3 border-bottom"
                                                                                                        id="inputFormRowEquipos">

                                                                                                        <div
                                                                                                            class="row d-flex pb-4">

                                                                                                            <input
                                                                                                                type="hidden"
                                                                                                                name="bitacorasEquiposId[]"
                                                                                                                id="bitacorasEquiposId"
                                                                                                                value="{{ $item->id != null ? $item->id : 0 }}">

                                                                                                            <input
                                                                                                                type="hidden"
                                                                                                                name="maquinariaId[]"
                                                                                                                id="maquinariaId"
                                                                                                                value="{{ $item->maquinariaId }}">

                                                                                                            <input
                                                                                                                type="hidden"
                                                                                                                name="bitacoraId[]"
                                                                                                                id="bitacoraId"
                                                                                                                value="{{ $item->bitacoraId }}">

                                                                                                            <div
                                                                                                                class="col-5 ">
                                                                                                                <label
                                                                                                                    for="nombreEquipo"
                                                                                                                    class="">Maquinaría</label></br></br>
                                                                                                                <input
                                                                                                                    type="text"
                                                                                                                    maxlength="250"
                                                                                                                    readonly
                                                                                                                    class="inputCaja"
                                                                                                                    id="nombreEquipo"
                                                                                                                    disabled="true"
                                                                                                                    placeholder="El equipo"
                                                                                                                    name="nombreEquipo[]"
                                                                                                                    value="{{ $item->maquinaria }}">
                                                                                                            </div>

                                                                                                            <div
                                                                                                                class="col-5">
                                                                                                                <label
                                                                                                                    for="descripcion"
                                                                                                                    class="">Descripción</label></br></br>
                                                                                                                <textarea rows="3" cols="80" class="form-control form-select" id="descripcion" readonly
                                                                                                                    name="descripcion[]" disabled="true" value="">{{ $item->descripcion }} </textarea>
                                                                                                            </div>

                                                                                                            <div
                                                                                                                class="col-2">
                                                                                                                </br></br>
                                                                                                                <button
                                                                                                                    id="removeRowEquipos"
                                                                                                                    type="button"
                                                                                                                    class="btn btn-danger">Borrar</button>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </li>

                                                                                                @empty
                                                                                                    <li>Sin registros.</li>
                                                                                                @endforelse

                                                                                            </ul>
                                                                                        </div>


                                                                                    </div>

                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>

                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                    </div>


                                    <div class=" col-12 col-sm-6  col-lg-12 my-6 ">
                                        <label for="exampleFormControlTextarea1" class="labelTitulo">Descripción
                                            de la Bitácora: <span>*</span></label>
                                        <textarea class="form-select" id="exampleFormControlTextarea1" rows="3" maxlength="1000" required
                                            id="comentario" name="comentario" placeholder="Escribe aquí tus comentarios sobre la bitácora.">  {{ $bitacora->comentario }} </textarea>
                                    </div>

                                    <div class="col-12 text-center mt-2 pt-2">
                                        <a href="{{ url('/bitacoras') }}">
                                            <button type="button" class="btn btn-danger">Cancelar</button>
                                        </a>
                                        <button type="submit" class="btn botonGral">Guardar</button>
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
    <script src="{{ asset('js/alertas.js') }}"></script>
    <script type="application/javascript">
    jQuery('input[type=file]').change(function(){
     var filename = jQuery(this).val().split('\\').pop();
     var idname = jQuery(this).attr('id');
     console.log(jQuery(this));
     console.log(filename);
     console.log(idname);
     jQuery('span.'+idname).next().find('span').html(filename);
    });
    </script>

    <script>
        function Guardado() {
            // alert('test');
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: 'success',
                title: 'Guardado con exito'
            })
        }
        var slug = '{{ Session::get('message') }}';
        if (slug == 1) {
            Guardado();

        }
    </script>

    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E="
        crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    {{-- <script src="{{ asset('vendor/jquery-ui/jquery-ui.min.js') }}"></script> --}}

    <script>
        var curso = ['html', 'hola', 'hi'];

        $('#searchGrupos').autocomplete({

            source: function(request, response) {
                $.ajax({
                    url: "{{ route('search.gruposParaBitacoras') }}",

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
                // alert(ui.item.comentario);
                // Rellenar los campos con los datos del inventario seleccionado
                crearItemGrupo(ui.item.id, ui.item.nombre, ui.item.value);

            }
        });


        $('#searchMaquinaria').autocomplete({
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
                // Rellenar los campos con los datos del equipo seleccionado
                crearItemEquipo(ui.item.id, ui.item.identificador, ui.item.nombre, ui.item.value);
            }

        });
    </script>

    <script type="text/javascript">
        function clearInput(controlId) {
            var getValue = document.getElementById(controlId);
            if (getValue.value != "") {
                getValue.value = "";
                getValue.focus();
            }
        }

        function crearItemEquipo(maquinariaId, identificador, nombre, value) {

            var html = '';
            html += '<li class="listaEquipos my-3 border-bottom" id="inputFormRowEquipos">';
            html += '   <div class="row d-flex pb-4">';
            html += '      <input type="hidden" name="bitacorasEquiposId[]" id="bitacorasEquiposId" value="">';
            html += '      <input type="hidden" name="bitacoraId[]" id="bitacoraId" value="{{ $bitacora->id }}">';
            html += '      <input type="hidden" name="maquinariaId[]" id="mquinariaId" value="' + maquinariaId + '">';
            html += '      <div class="col-5 ">';
            html += '           <label for="nombreMaquinaria" class="">Maquinaría</label></br></br>';
            html +=
                '           <input type="text" required readonly class="inputCaja" id="nombreMaquinaria" placeholder="Ej. 1" name="nombreMaquinaria[]" value="' +
                identificador + ' - ' + nombre + '">';
            html += '      </div>';
            html += '      <div class="col-5">';
            html += '          <label for="descripcion" class="">Descripción</label></br></br>';
            html +=
                '          <textarea rows="3" cols="80" class="form-control form-select" id="descripcionMaquinaria" readonly name="descripcionMaquinaria[]" disabled="true">' +
                value + '</textarea>';
            html += '      </div>';
            html += '      <div class="col-2"></br></br>';
            html += '         <button id="removeRowEquipos" type="button" class="btn btn-danger">Borrar</button>';
            html += '      </div>';
            html += '    </div>';
            html += '</li>';

            $('#newRowEquipos').append(html);
        }

        function crearItemGrupo(grupoId, nombre, value) {
            var html = '';
            html += '<li class="listaMaterialMantenimiento my-3 border-bottom" id="inputFormRowGrupos">';
            html += '   <div class="row d-flex pb-4">';
            html += '      <input type="hidden" name="grupoBitacoraId[]" id="grupoBitacoraId" value="">';
            html += '      <input type="hidden" name="bitacoraId[]" id="bitacoraId" value="{{ $bitacora->id }}">';
            html += '      <input type="hidden" name="grupoId[]" id="grupoId" value="' + grupoId + '">';
            html += '      <div class="col-5 ">';
            html += '           <label for="nombreGrupo" class="">Grupo de tareas</label></br></br>';
            html +=
                '           <input type="text" required readonly class="inputCaja" id="nombreGrupo" placeholder="Ej. 1" name="nombreGrupo[]" value="' +
                nombre + '">';
            html += '      </div>';
            html += '      <div class="col-5">';
            html += '          <label for="descripcion" class="">Descripción</label></br></br>';
            html +=
                '          <textarea rows="3" cols="80" class="form-control form-select" id="descripcion" readonly name="descripcion[]" disabled="true">' +
                value + '</textarea>';
            html += '      </div>';
            html += '      <div class="col-2"></br></br>';
            html += '         <button id="removeRowGrupos" type="button" class="btn btn-danger">Borrar</button>';
            html += '      </div>';
            html += '    </div>';
            html += '</li>';

            $('#newRowGrupos').append(html);
        }


        // borrar registro
        $(document).on('click', '#removeRowGrupos', function() {
            $(this).closest('#inputFormRowGrupos').remove();
        });

        // borrar registro
        $(document).on('click', '#removeRowEquipos', function() {
            $(this).closest('#inputFormRowEquipos').remove();
        });
    </script>
@endsection
