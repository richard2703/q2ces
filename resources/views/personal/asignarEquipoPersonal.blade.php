@extends('layouts.main', ['activePage' => 'personal', 'titlePage' => __('Vista de Personal')])
@section('content')
    <div class="content">
        <?php
        $objValida = new Validaciones();
        ?>
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

                            <form action="{{ route('personal.equipo.asignacion', $personal->id) }}"
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
                                                <h2 class="tituloEncabezado ">Equipo Asignado</h2>
                                            </div>
                                            <div class="col-6 divBorder pb-3 text-end">
                                                <button type="button" class="btnVerde" onclick="crearItems()">
                                                </button>
                                            </div>
                                        </div>

                                        @forelse ($asignados as $asignado)
                                            <div class="row opcion divBorderItems" id="opc">

                                                <input type="hidden" name="asignado[]" value="{{ $asignado->id }}">

                                                <div class="col-12 col-sm-6 col-lg-2 my-3 ">
                                                    <label class="labelTitulo">Cantidad:
                                                        <span>*</span></label></br>
                                                    <input type="number" class="inputCaja" id="cantidad" name="cantidad[]"
                                                        required value="{{ $asignado->cantidad }}">
                                                </div>

                                                <div class="col-12 col-sm-6 col-lg-4 my-3 ">
                                                    <label class="labelTitulo">Equipo:</label></br>
                                                    <select class="form-select" aria-label="Default select example"
                                                        id="equipoId[]" name="equipoId[]">

                                                        @foreach ($equipos as $equipo)
                                                            <option value="{{ $equipo->id }}"
                                                                {{ $equipo->id == $asignado->equipoId ? 'selected' : '' }}>
                                                                {{ $objValida->ucwords_accent($equipo->nombre) }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-12 col-sm-6 col-lg-4 my-3 ">
                                                    <label class="labelTitulo">Marca:</label></br>
                                                    <select class="form-select" aria-label="Default select example"
                                                        id="marcaId[]" name="marcaId[]">
                                                        <option value="">Seleccione</option>
                                                        @foreach ($marcas as $marca)
                                                            <option value="{{ $marca->id }}"
                                                                {{ $marca->id == $asignado->marcaId ? 'selected' : '' }}>
                                                                {{ $objValida->ucwords_accent($marca->nombre) }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-lg-2 my-3 text-end">
                                                    <button type="button" id="removeRow" class="btnRojo"></button>
                                                </div>

                                                <div class="col-12 col-sm-6 col-lg-4 my-3 ">
                                                    <label class="labelTitulo">Serial:</label></br>
                                                    <input type="text" class="inputCaja" id="serie"
                                                        placeholder="Especifique..." name="serie[]"
                                                        value="{{ $asignado->serie }}">
                                                </div>

                                                <div class="col-12 col-sm-6  my-3 ">
                                                    <label class="labelTitulo">Comentario:</label></br>
                                                    <textarea class="inputComent" id="comentario" name="comentario[]" rows="3">{{ $asignado->comentario }}</textarea>
                                                </div>
                                            </div>

                                        @empty
                                            <div class="row opcion divBorderItems" id="opc">

                                                <input type="hidden" name="asignado[]">

                                                <div class="col-12 col-sm-6 col-lg-2 my-3 ">
                                                    <label class="labelTitulo">Cantidad:
                                                        <span>*</span></label></br>
                                                    <input type="number" class="inputCaja" id="cantidad"
                                                        name="cantidad[]">
                                                </div>

                                                <div class="col-12 col-sm-6 col-lg-4 my-3 ">
                                                    <label class="labelTitulo">Equipo:</label></br>
                                                    <select class="form-select" aria-label="Default select example"
                                                        id="equipoId[]" name="equipoId[]">

                                                        @foreach ($equipos as $equipo)
                                                            <option value="{{ $equipo->id }}">
                                                                {{ $objValida->ucwords_accent($equipo->nombre) }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-12 col-sm-6 col-lg-4 my-3 ">
                                                    <label class="labelTitulo">Marca:</label></br>
                                                    <input type="text" class="inputCaja" id="marca"
                                                        placeholder="Especifique..." name="marca[]" value="">
                                                </div>

                                                <div class="col-lg-2 my-3 text-end">
                                                    <button type="button" id="removeRow" class="btnRojo"></button>
                                                </div>

                                                <div class="col-12 col-sm-6 col-lg-4 my-3 ">
                                                    <label class="labelTitulo">Serial:</label></br>
                                                    <input type="text" class="inputCaja" id="serie"
                                                        placeholder="Especifique..." name="serie[]" value="">
                                                </div>

                                                <div class="col-12 col-sm-6  my-3 ">
                                                    <label class="labelTitulo">Comentario:</label></br>
                                                    <textarea class="inputComent" id="comentario" name="comentario[]" rows="3"></textarea>
                                                </div>
                                            </div>
                                        @endforelse





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


    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
        crossorigin="anonymous"></script>

    <script>
        function crearItems() {

            $('.opcion:first').clone().find("input").val("").end().appendTo('#elementos');

        }
        // Borrar registro
        $(document).on('click', '#removeRow', function() {
            if ($('.opcion').length > 1) {
                $(this).closest('.opcion').remove();
            }
        });
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
