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

                                    <form class="row alertaGuardar" action="{{ route('bitacoras.update', $bitacora->id) }}"
                                        method="post" enctype="multipart/form-data">
                                        @csrf
                                        @method('put')
                                        <div class="col-12 my-4">
                                            <div class="row">

                                                <div class=" col-12 col-sm-6  col-lg-12 my-6 ">
                                                    <label class="labelTitulo">Nombre: <span>*</span></label></br>

                                                    <input type="text" required maxlength="250" id="nombre"
                                                        name="nombre" value="{{ $bitacora->nombre }}"
                                                        placeholder="Especifique el nombre de la bitácora."
                                                        class="inputCaja">
                                                </div>

                                                <div class=" col-12 col-sm-6  col-lg-12 my-6 ">
                                                    <label for="exampleFormControlTextarea1" class="labelTitulo">Descripción
                                                        de la Bitácora: <span>*</span></label>
                                                    <textarea class="form-select" id="exampleFormControlTextarea1" rows="3" maxlength="1000" required id="comentario"
                                                        name="comentario" placeholder="Escribe aquí tus comentarios sobre la bitácora.">  {{ $bitacora->comentario }} </textarea>
                                                </div>

                                                <input type="hidden" name="activa" id="activa"
                                                    value="{{ $bitacora->activo }}">

                                                <div class="row d-flex">
                                                    <div class="col-12 col-md-6  mt-3 ">
                                                        <p class="subEncabezado">Busca un Grupo de Tareas </p>
                                                        <div class="mb-6 mt-0" role="search" class="inputCaja">
                                                            <input value="" class="search-submit ">
                                                            <input autofocus type="text" class="" id="search"
                                                                name="search"
                                                                placeholder="Escribe aquí el texto a buscar..."
                                                                title="Escriba la(s) palabra(s) a buscar.">
                                                            <input type="button" onclick="clearInput()"
                                                                class="btn botonGral" value="Borrar">
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="my-4 divBorder">
                                                    <h3 class="subEncabezado mb-3">Listado de Grupo de Tareas</h3>
                                                </div>

                                                <div class=" col-12  my-3 ">
                                                    <ul class="" id="newRow">

                                                        @forelse ($grupos as $item)
                                                            <li class="listaMaterialMantenimiento my-3 border-bottom"
                                                                id="inputFormRow">

                                                                <div class="row d-flex pb-4">

                                                                    <input type="hidden" name="grupoBitacoraId[]"
                                                                        id="grupoBitacoraId"
                                                                        value="{{ $item->id != null ? $item->id : 0 }}">

                                                                    <input type="hidden" name="grupoId[]" id="grupoId"
                                                                        value="{{ $item->grupoId }}">

                                                                    <input type="hidden" name="bitacoraId[]"
                                                                        id="bitacoraId" value="{{ $item->bitacoraId }}">

                                                                    <div class="col-5 ">
                                                                        <label for="nombreGrupo" class="">Grupo de
                                                                            Tareas</label></br></br>
                                                                        <input type="text" maxlength="250" readonly
                                                                            class="inputCaja" id="nombreGrupo"
                                                                            disabled="true" placeholder="Ej. Tarea 1"
                                                                            name="nombreGrupo[]"
                                                                            value="{{ $item->grupo }}">
                                                                    </div>

                                                                    <div class="col-5">
                                                                        <label for="descripcion"
                                                                            class="">Descripción</label></br></br>
                                                                        <textarea rows="3" cols="80" class="form-control form-select" id="descripcion" readonly name="descripcion[]"
                                                                            disabled="true" value="">{{ $item->comentario }} </textarea>
                                                                    </div>

                                                                    <div class="col-2"></br></br>
                                                                        <button id="removeRow" type="button"
                                                                            class="btn btn-danger">Borrar</button>
                                                                    </div>
                                                                </div>
                                                            </li>

                                                        @empty
                                                            <li>Sin registros.</li>
                                                        @endforelse

                                                    </ul>
                                                </div>

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

        $('#search').autocomplete({

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
                crearItems(ui.item.id, ui.item.nombre, ui.item.comentario, ui.item.value);

            }
        });
    </script>

    <script type="text/javascript">
        function clearInput() {
            var getValue = document.getElementById("search");
            if (getValue.value != "") {
                getValue.value = "";
            }
        }


        function crearItems(grupoId, nombre, descripcion, value) {
            var html = '';
            html += '<li class="listaMaterialMantenimiento my-3 border-bottom" id="inputFormRow">';
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
