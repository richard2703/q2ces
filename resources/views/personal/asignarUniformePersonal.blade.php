@extends('layouts.main', ['activePage' => 'personal', 'titlePage' => __('Vista de Personal')])
@section('content')
    <div class="content">
        @if ($errors->any())
            <div class="alert alert-danger">
                <!-- PARA LA CARGA DE LOS ERRORES DE LOS DATOS-->
                <p>Listado de errores a corregir</p>
                <ul>
                    @foreach ($errors->all() as $item)
                        <li>{{ $item }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12 align-self-start">
                    <div class="card">
                        @if (session('success'))
                            <div class="alert alert-success" role="success">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if (session('faild'))
                            <div class="alert alert-danger" role="faild">
                                {{ session('faild') }}
                            </div>
                        @endif
                        <div class="card-body contCart">
                            <div class="p-1 align-self-start bacTituloPrincipal">
                                <h6 class="my-3 ms-3 texticonos ">{{ $personal->nombres }} {{ $personal->apellidoP }}
                                    {{ $personal->apellidoM }}</h6>
                            </div>
                            <div class="d-flex p-3 divBorder">

                                <div class="col-4 text-left">
                                    <a href="{{ route('personal.show', $personal->id) }}">
                                        <button class="btn regresar">
                                            <span class="material-icons">
                                                reply
                                            </span>
                                            Regresar
                                        </button>
                                    </a>
                                </div>

                                <div class="col-8 text-end">
                                    {{--  @can('asistencia_horasextra')
                                        <a href="{{ route('asistencia.horasExtra') }}">
                                            <button type="button" class="btn botonGral">Horas Extra</button>
                                        </a>
                                    @endcan  --}}
                                    {{--  @can('asistencia_create')
                                        <a href="{{ route('asistencia.create') }}">
                                            <button type="button" class="btn botonGral">Asignar Equipo</button>
                                        </a>
                                    @endcan  --}}


                                </div>
                            </div>

                            <form action="{{ route('personal.uniforme.asignacion', $personal->id) }}"
                                method="post"class="alertaGuardar" enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="d-flex p-3">
                                    <div class="col-12 col-md-4 px-2 ">
                                        <div class="text-center mx-auto border  mb-4">
                                            <i><img class="imgPersonal img-fluid"
                                                    src="{{ $personal->foto == '' ? ' /img/general/default.jpg' : asset('/storage/personal/' . str_pad($personal->id, 4, '0', STR_PAD_LEFT) . '/' . $personal->foto) }}"></i>
                                        </div>
                                    </div>

                                    <div class="">
                                        <div class="row alin">
                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                <label class="labelTitulo">Número del Empleado:</label></br>
                                                <input type="text" class="inputCaja" id="" name="calle"
                                                    readonly value="">
                                            </div>

                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                <label class="labelTitulo">Nombre(s): <span>*</span></label></br>
                                                <input type="text" class="inputCaja" id="nombres" name="nombres"
                                                    readonly value="{{ $personal->nombres }}">
                                            </div>

                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                <label class="labelTitulo">Apellido Paterno: <span>*</span></label></br>
                                                <input type="text" class="inputCaja" id="apellidoP" name="apellidoP"
                                                    readonly value="{{ $personal->apellidoP }}">
                                            </div>

                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                <label class="labelTitulo">Apellio Materno:</label></br>
                                                <input type="text" class="inputCaja" id="apellidoM" name="apellidoM"
                                                    readonly value="{{ $personal->apellidoM }}">
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex p-3">
                                    <div class="col-12" id="elementos">
                                        <div class="d-flex">
                                            <div class="col-6 divBorder">
                                                <h2 class="tituloEncabezado ">Asignar Nuevo Uniforme</h2>
                                            </div>
                                            <div class="col-6 divBorder pb-3 text-end">
                                                <button type="button" class="btnVerde" onclick="crearItems()">
                                                </button>
                                            </div>
                                        </div>

                                        {{-- @forelse ($asignados as $asignado) --}}
                                        {{-- <div class="row opcion divBorderItems" id="opc">

                                                <input type="hidden" name="asignado[]" value="{{ $asignado->id }}">

                                                <div class="col-12 col-sm-6 col-lg-2 my-3 ">
                                                    <label class="labelTitulo">Cantidad:
                                                        <span>*</span></label></br>
                                                    <input type="number" class="inputCaja"
                                                        id="cantidad{{ $asignado->inventarioId }}[]" name="cantidad[]"
                                                        value="{{ $asignado->cantidad }}">
                                                </div>

                                                <div class="col-12 col-sm-6 col-lg-4 my-3 ">
                                                    <label class="labelTitulo">Tipo de Uniforme:</label> </br>
                                                    <select class="form-select" aria-label="Default select example"
                                                        onchange="cargar({{ $asignado->inventarioId }})"
                                                        id="uniformeTipoId{{ $asignado->inventarioId }}[]"
                                                        name="uniformeTipoId[]">

                                                        @foreach ($inventario as $item)
                                                            <option value="{{ $item->id }}"
                                                                {{ $asignado->uniformeTipoId == $item->id ? ' selected' : '' }}>
                                                                {{ $item->nombre }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-12 col-sm-6 col-lg-4 my-3 ">
                                                    <label class="labelTitulo">Uniforme:</label></br>
                                                    <select class="form-select" aria-label="Default select example"
                                                        id="inventarioId{{ $asignado->inventarioId }}[]"
                                                        name="inventarioId[]">
                                                        <option value="">Seleccione</option>
                                                        <!-- AQUI SE CARGAN LOS ITEMS DINAMICAMENTE  -->
                                                    </select>
                                                </div>

                                                <div class="col-lg-2 my-3 text-end">
                                                    <button type="button" id="removeRow" class="btnRojo"></button>
                                                </div>

                                                <div class="col-12 col-sm-6  my-3 ">
                                                    <label class="labelTitulo">Comentario:</label></br>
                                                    <textarea class="inputComent" id="comentario{{ $asignado->inventarioId }}[]" name="comentario[]" rows="3">{{ $asignado->comentario }}</textarea>
                                                </div>
                                            </div> --}}

                                        {{-- <script>
                                                document.addEventListener('DOMContentLoaded', function() {
                                                    // Llamar a la función después de que la vista haya cargado completamente
                                                    cargarItem({{ $asignado->uniformeTipoId }}, {{ $asignado->inventarioId }});
                                                });
                                            </script> --}}

                                        {{-- @empty --}}
                                        <div class="row opcion divBorderItems" id="opc">
                                            <?php $intCount = 0; ?>
                                            <input type="hidden" name="asignado[]">
                                            <input type="hidden" name="usuarioId" id="usuarioId"
                                                value="{{ auth()->user()->id }}">
                                            <input type="hidden" name="enInventario[]"
                                                id="enInventario{{ $intCount }}[]">

                                            <div class="col-12 col-sm-6 col-lg-2 my-3 ">
                                                <label class="labelTitulo">Cantidad:
                                                    <span>*</span></label></br>
                                                <input type="number" class="inputCaja" id="cantidad{{ $intCount }}[]"
                                                    required name="cantidad[]">
                                            </div>

                                            <div class="col-12 col-sm-6 col-lg-3 my-3 ">
                                                <label class="labelTitulo">Tipo de Uniforme:</label></br>
                                                <select class="form-select" aria-label="Default select example"
                                                    onchange="cargar({{ $intCount }})"
                                                    id="uniformeTipoId{{ $intCount }}[]" name="uniformeTipoId[]">

                                                    <option value="">Seleccione</option>
                                                    @foreach ($inventario as $item)
                                                        <option value="{{ $item->id }}">
                                                            {{ $item->nombre }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-12 col-sm-8 col-lg-5 my-3 ">
                                                <label class="labelTitulo">Uniforme:</label></br>
                                                <select class="form-select" aria-label="Default select example"
                                                    id="inventarioId{{ $intCount }}[]" name="inventarioId[]">
                                                    <option value="">Seleccione</option>
                                                    {{-- AQUI SE CARGAN LOS ITEMS DINAMICAMENTE  --}}
                                                </select>
                                            </div>

                                            <div class="col-lg-2 my-3 text-end">
                                                <button type="button" id="removeRow" class="btnRojo"></button>
                                            </div>

                                            <div class="col-12 col-sm-6 my-3 ">
                                                <label class="labelTitulo">Comentario:</label></br>
                                                <textarea class="inputComent" id="comentario{{ $intCount }}[]" name="comentario[]" rows="3"></textarea>
                                            </div>
                                        </div>
                                        {{-- @endforelse --}}

                                    </div>
                                </div>

                                <div class="d-flex p-3">
                                    <div class="col-12">
                                        <div class="d-flex">
                                            <div class="col-12 divBorder">
                                                <h2 class="tituloEncabezado ">Histórico</h2>
                                            </div>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead class="labelTitulo">
                                                    <th class="labelTitulo text-center">Folio</th>
                                                    <th class="labelTitulo text-center">Cantidad</th>
                                                    <th class="labelTitulo text-center">Tipo</th>
                                                    <th class="labelTitulo text-center">Talla</th>
                                                    <th class="labelTitulo text-center">Asignado</th>
                                                    <th class="labelTitulo text-center">Comentarios</th>
                                                    <th class="labelTitulo text-center">Acciones</th>
                                                </thead>
                                                <tbody>
                                                    @forelse ($asignados as $asignado)
                                                        <tr>
                                                            <td class="text-center">{{ $asignado->id }}</td>
                                                            <td class="text-center">{{ $asignado->cantidad }}</td>
                                                            <td class="text-center">{{ $asignado->uniformeTipo }}</td>
                                                            <td class="text-center">{{ $asignado->talla }}</td>
                                                            <td class="text-center">{{ $asignado->created_at }}</td>
                                                            <td class="text-center">{{ $asignado->comentario }}</td>
                                                            {{-- <td class="text-center">{{ $asignado->estatus }}</td> --}}

                                                            <td class="td-actions text-center">
                                                                @can('inventario_restock')
                                                                    {{--  <a href="{{ route('maquinaria.vista', $maquina->id) }}"  class="">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-card-text accionesIconos" viewBox="0 0 16 16">
                                                                    <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                                                                    <path d="M3 5.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 8zm0 2.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5z"/>
                                                                </svg>
                                                            </a>  --}}
                                                                    <button type="button"
                                                                        class="botonSinFondo mx-2"title="Ajustar"
                                                                        data-bs-toggle="modal" data-bs-target="#modal-cliente"
                                                                        onclick="loadItem('{{ $asignado->id }}','{{ $asignado->inventarioId }}','{{ $asignado->uniformeTipo }}','{{ $asignado->cantidad }}')">
                                                                        <img
                                                                            style="width: 30px;"src="{{ '/img/inventario/reestock.svg' }}"></button>
                                                                @endcan

                                                                {{-- @can('user_edit') --}}
                                                                {{--  <a href="{{ route('personal.edit', $persona->id) }}" class="">
                                                                <svg xmlns="http://www.w3.org/2000/svg "  width="28" height="28" fill="currentColor" class="bi bi-pencil accionesIconos"  viewBox="0 0 16 16">
                                                                   <path  d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                                                                </svg>
                                                                </a> --}}
                                                                {{-- @endcan --}}
                                                                {{-- @can('user_destroy') --}}
                                                                {{-- <form action="{{ route('personal.delete', $persona->id) }}"
                                                                    method="POST" style="display: inline-block;"
                                                                    onsubmit="return confirm('¿Estás seguro que deseas eliminar este registro?')">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button class="btnSinFondo" type="submit"  rel="tooltip">
                                                                        <svg xmlns="http://www.w3.org/2000/svg"  width="28" height="28"  fill="currentColor"  class="bi bi-x-circle"  viewBox="0 0 16 16">
                                                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                                            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                                                                        </svg>
                                                                    </button>
                                                                </form> --}}
                                                                {{-- @endcan --}}
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="2">Sin Registros.</td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                {{--  <div class="col-12 text-end mb-3 ">
                                    <button type="submit" class="btn botonGral">Guardar</button>
                                </div>  --}}


                        </div>
                        <div class="col-12 text-center mb-3 ">
                            <button type="submit" class="btn botonGral" onclick="alertaGuardar()">Guardar</button>
                        </div>
                    </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
      {{-- //Modales --}}
      <div class="modal fade" id="modal-cliente" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-cliente"
      aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="col-12">
                  <div class="card ">
                      <form action="{{ route('inventario.ajusteDeUniforme',0) }}" method="post">
                          @csrf
                          @method('put')
                          <div class="card-header bacTituloPrincipal ">
                              <div class="nav-tabs-navigation">
                                  <div class="nav-tabs-wrapper">
                                      <span class="nav-tabs-title">
                                          <h2 class="titulos">Editar </h2>
                                      </span>
                                  </div>
                              </div>
                          </div>
                          <div class="row  card-body">
                              <div class="row card-body" style="
                       text-align: center;">
                                  <input type="hidden" name="productoId" id="productoId" value="">
                                  <input type="hidden" name="movimientoId" id="movimientoId" value="">
                                  <input type="hidden" name="productoCantidad" id="productoCantidad" value="">
                                  <input type="hidden" name="usuarioId" id="usuarioId" value="{{ auth()->user()->id }}">

                                  <div class="col-12 col-lg-8">
                                    <label class="labelTitulo" for="">Producto:</label></br>
                                    <input type="text" class="inputCaja" id="nombreProducto" name="nombreProducto"
                                     value="">
                                </div>
                                  <div class="col-12 col-lg-4">
                                      <label class="labelTitulo" for="">Cantidad:</label></br>
                                      <input class="inputCaja" type="number" step="1" min="1"
                                          id="productoCantidadNueva" name="productoCantidadNueva" value="" required></br>
                                  </div>
                              </div>
                          </div>
                          <div class="col-12  mb-3 d-flex  justify-content-center align-self-end">
                              <button type="submit" class="btn botonGral ">Guardar</button>
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

            // var newOpcion = $('.opcion:first').clone();
            // newOpcion.find("select, input, textarea").val(""); // Establece los valores en blanco
            // newOpcion.appendTo('#elementos');
            var ms = +new Date();
            console.log(ms);

            var intCount = +new Date();
            var html = '';
            html += '<div class="row opcion divBorderItems" id="opc">';
            html += '   <input type="hidden" name="asignado[]">';
            html += '   <div class="col-12 col-sm-6 col-lg-2 my-3 ">';
            html += '       <label class="labelTitulo">Cantidad: <span>*</span></label></br>';
            html += '       <input type="number" class="inputCaja" id="cantidad' + intCount +
                '[]" required name="cantidad[]">';
            html += '   </div>';

            html += '   <div class="col-12 col-sm-6 col-lg-3 my-3 ">';
            html += '       <label class="labelTitulo">Tipo de Uniforme:</label></br>';
            html += '       <select class="form-select" aria-label="Default select example" onchange="cargar(' + intCount +
                ')" id="uniformeTipoId' + intCount + '[]" name="uniformeTipoId[]">';
            @foreach ($inventario as $item)
                html += '   <option value="{{ $item->id }}"> {{ $item->nombre }} </option>';
            @endforeach
            html += '</select>';
            html += '</div>';

            html += '   <div class="col-12 col-sm-6 col-lg-5 my-3 ">';
            html += '       <label class="labelTitulo">Uniforme:</label></br>';
            html += '       <select class="form-select" aria-label="Default select example"  id="inventarioId' + intCount +
                '[]" name="inventarioId[]">';
            html += '           <option value="">Seleccione</option>  {{-- AQUI SE CARGAN LOS ITEMS DINAMICAMENTE  --}}';
            html += '       </select>';
            html += '   </div>';

            html += '   <div class="col-lg-2 my-3 text-end">';
            html += '       <button type="button" id="removeRow" class="btnRojo"></button>';
            html += '   </div>';

            html += '   <div class="col-12 col-sm-6  my-3 ">';
            html += '       <label class="labelTitulo">Comentario:</label></br>';
            html += '        <textarea class="inputComent" id="comentario' + intCount +
                '[]" name="comentario[]" rows="3"></textarea>';
            html += '   </div>';
            html += '</div>';

            $('#elementos').append(html);

        }
        // Borrar registro
        $(document).on('click', '#removeRow', function() {
            if ($('.opcion').length > 1) {
                $(this).closest('.opcion').remove();
            }
        });
    </script>

    <script>
        function loadItem(id, productoId, producto, cantidad) {

            console.log(id, productoId, producto, cantidad);

            const productoid = document.getElementById('productoId');
            productoid.value = productoId;

            const movId = document.getElementById('movimientoId');
            movId.value = id;

            const p1 = document.getElementById('nombreProducto');
            p1.value = producto;

            const p2 = document.getElementById('productoCantidad');
            p2.value = cantidad;

            const p3 = document.getElementById('productoCantidadNueva');
            p3.value = cantidad;
        }
    </script>


    <script>
        function cargarItem(tipoUniformeId, inventarioId) {


            const tipoUniformeSelect = document.getElementById('uniformeTipoId' + inventarioId + '[]');
            const lugarSelect = document.getElementById('inventarioId' + inventarioId + '[]');

            var url = '{{ route('uniformesPorTipo.get', ':tipoUniformeId') }}';
            url = url.replace(':tipoUniformeId', tipoUniformeSelect.value);

            // console.log(tipoUniformeId, inventarioId, url);

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    // Actualiza las opciones en el select "lugar"
                    console.log(data);
                    lugarSelect.innerHTML = '';
                    data.forEach(lugar => {
                        console.log(lugar);
                        var option = document.createElement('option');
                        option.value = lugar.id;
                        option.textContent = lugar.nombre;
                        lugarSelect.appendChild(option);
                    });

                });
        };
    </script>

    <script>
        function cargar(inventarioId) {

            const tipoUniformeSelect = document.getElementById('uniformeTipoId' + inventarioId + '[]');
            const lugarSelect = document.getElementById('inventarioId' + inventarioId + '[]');

            var url = '{{ route('uniformesPorTipo.get', ':uniformeTipoId') }}';
            url = url.replace(':uniformeTipoId', tipoUniformeSelect.value);

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    // Actualiza las opciones en el select "lugar"
                    console.log(data);
                    lugarSelect.innerHTML = '';
                    data.forEach(lugar => {
                        console.log(lugar);
                        var option = document.createElement('option');
                        option.value = lugar.id;
                        option.textContent = lugar.nombre + ' [ ' + lugar.cantidad + ' existencias ]';
                        lugarSelect.appendChild(option);
                    });

                });
        };
    </script>

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
@endsection
