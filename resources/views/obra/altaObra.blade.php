@extends('layouts.main', ['activePage' => 'obra', 'titlePage' => __('Alta de Obra')])
@section('content')
    <div class="content">
        <?php
        $objValida = new Validaciones();
        ?>
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
                        <h4 class="card-title">Alta de Obra</h4>
                        {{-- <p class="card-category">Usuarios registrados</p> --}}
                    </div>
                    <div class="card-body">
                        <div class="row">

                            <div class="d-flex p-3 divBorder">
                                <div class="col-12 ">
                                    <a href="{{ route('obras.index') }}">
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

                        <form class="alertaGuardar" action="{{ route('obras.store') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="col-12 my-3 ">

                                <div class="row d-flex justify-content-around">
                                    <div class="col-12 col-sm-4 ">
                                        <div class="text-center mx-auto border mb-4">
                                            <i><img class="imgVista img-fluid mb-5"
                                                    src="{{ asset('/img/general/default.jpg') }}"></i>
                                            <span class="mi-archivo"> <input class="mb-4 ver" type="file" name="foto"
                                                    id="mi-archivo" accept="image/*"></span>
                                            <label for="mi-archivo">
                                                <span>Sube Vista Aérea</span>
                                            </label>
                                        </div>
                                    </div>


                                    <div class="col-12 col-sm-4 ">
                                        <div class="text-center mx-auto border vistaFoto mb-4">
                                            <i><img class="imgVista img-fluid mb-5"
                                                    src="{{ asset('/img/general/default.jpg') }}"></i>
                                            <span class="mi-archivo2"> <input class="mb-4 ver" type="file" name="logo"
                                                    id="mi-archivo2" accept="image/*"></span>
                                            <label for="mi-archivo2">
                                                <span>Sube Logo</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 ">
                                <div class="row">
                                    <div class=" col-12 col-sm-6 col-lg-4 my-3 ">
                                        <label class="labelTitulo">Nombre de la Obra: <span>*</span></label></br>
                                        <input type="text" class="inputCaja" id="nombre" name="nombre" required
                                            placeholder="Especifique..." value="{{ old('nombre') }}">
                                    </div>
                                    <div class=" col-12 col-sm-6  col-lg-4 my-3 ">
                                        <label class="labelTitulo">Cliente: <span>*</span></label></br>
                                        <select class="form-select" aria-label="Default select example" id="tipo"
                                            required name="clienteId">
                                            @foreach ($Clientes as $Cliente)
                                                <option value="{{ $Cliente->id }}">
                                                    {{ $objValida->ucwords_accent($Cliente->nombre) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class=" col-12 col-sm-6  col-lg-4 my-3 ">
                                        <label class="labelTitulo">Calle: <span>*</span></label></br>
                                        <input type="text" class="inputCaja" id="calle" name="calle" required
                                            placeholder="Especifique..." value="{{ old('calle') }}">
                                    </div>
                                    <div class=" col-12 col-sm-6  col-lg-4 my-3 ">
                                        <label class="labelTitulo">Número: </label></br>
                                        <input type="text" class="inputCaja" id="numero" name="numero"
                                            placeholder="Especifique..." value="{{ old('numero') }}">
                                    </div>
                                    <div class=" col-12 col-sm-6  col-lg-4 my-3 ">
                                        <label class="labelTitulo">Colonia: <span>*</span></label></br>
                                        <input type="text" class="inputCaja" id="colonia" name="colonia" required
                                            placeholder="Especifique..." value="{{ old('colonia') }}">
                                    </div>
                                    <div class=" col-12 col-sm-6  col-lg-4 my-3 ">
                                        <label class="labelTitulo">Código Postal:</label></br><input type="number"
                                            maxlength="5" step="1" min="00000" max="99999"
                                            placeholder="ej. 44100" class="inputCaja" id="cp" name="cp"
                                            value="{{ old('cp') }}">
                                    </div>
                                    <div class=" col-12 col-sm-6  col-lg-4 my-3 ">
                                        <label class="labelTitulo">Localidad: <span>*</span></label></br>
                                        <input type="text" class="inputCaja" id="ciudad" name="ciudad" required
                                            placeholder="Especifique..." value="{{ old('ciudad') }}">
                                    </div>
                                    <div class=" col-12 col-sm-6  col-lg-4 my-3 ">
                                        <label class="labelTitulo">Estado: <span>*</span></label></br>
                                        <input type="text" class="inputCaja" id="estado" name="estado" required
                                            placeholder="Especifique..." value="{{ old('estado') }}">
                                    </div>
                                    <div class=" col-12 col-sm-6 col-lg-4 my-3 ">
                                        <label class="labelTitulo">Proyecto: </label></br>
                                        <input type="text" class="inputCaja" id="proyecto" name="proyecto"
                                            placeholder="Especifique..." value="{{ old('proyecto') }}">
                                    </div>
                                    <div class=" col-12 col-sm-6 col-lg-4 my-3 ">
                                        <label class="labelTitulo">Centro de Costos: </label></br>
                                        <input type="text" class="inputCaja" id="centroCostos" name="centroCostos"
                                            placeholder="Especifique..." value="{{ old('centroCostos') }}">
                                    </div>
                                </div>
                            </div>

                            {{--  <div class="card-body" id="elementos">
                                    <div class="row opcion" id="opc">
                                        <div class="col-12 my-5 ">
                                            <div class="">
                                                <h2 class="tituloEncabezado ">Residente Responsable</h2>
                                            </div>
                                            <div class="col-12 divBorder pb-3" style="text-align: right;">
                                                <button type="button" id="removeRow" class="btnRojo"></button>
                                                <button type="button" class="btnVerde" onclick="crearItems()"> </button>
                                            </div>
                                            <div class="row">
                                                <div class=" col-12 col-sm-6 col-lg-4 my-3 ">
                                                    <label class="labelTitulo">Nombre: <span>*</span></label></br>
                                                    <input type="text" class="inputCaja" id="rnombre" required
                                                        placeholder="Especifique..." name="rnombre[]" value="">
                                                </div>
                                                <div class=" col-12 col-sm-6 col-lg-4 my-3 ">
                                                    <label class="labelTitulo">Empresa:</label></br>
                                                    <input type="text" class="inputCaja" id="rempresa"
                                                        placeholder="Especifique..." name="rempresa[]" value="">
                                                </div>

                                                <div class=" col-12 col-sm-6 col-lg-4 my-3 ">
                                                    <label class="labelTitulo">Puesto:</label></br>
                                                    <input type="text" class="inputCaja" id="rpuesto"
                                                        placeholder="Especifique..." name="rpuesto[]" value="">
                                                </div>

                                                <div class=" col-12 col-sm-6 col-lg-4 my-3 ">
                                                    <label class="labelTitulo">Teléfono:</label></br>
                                                    <input type="tel" pattern="[0-9]{2}-[0-9]{4}-[0-9]{4}"
                                                        placeholder="ej. 00-0000-0000" class="inputCaja" id="rtelefono"
                                                        name="rtelefono[]"value="">

                                                </div>

                                                <div class=" col-12 col-sm-6 col-lg-4 my-3 ">
                                                    <label class="labelTitulo">E-mail</label></br>
                                                    <input type="email" class="inputCaja" id="remail" required
                                                        placeholder="ej. elcorreo@delresponsable.com" min="6"
                                                        name="remail[]" value="{{ old('remail') }}">
                                                </div>

                                                <div class=" col-12 col-sm-6 col-lg-4 my-3 ">
                                                    <label class="labelTitulo">Código de Confirmación:</label></br>
                                                    <input type="text" class="inputCaja" id="rfirma"
                                                        placeholder="Especifique..." name="rfirma[]" value="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>  --}}

                            <div class="" id="elementosB">
                                <div class="opcionB" id="opcB">
                                    <div class="col-12 my-5 ">
                                        <div class="d-flex">
                                            <div class="col-6 divBorder">
                                                <h2 class="tituloEncabezado ">Detalle de Obra</h2>
                                            </div>
                                            <div class="col-6 divBorder pb-3 text-end" style="text-align: right;">
                                                <button type="button" id="removeRow" class="btnRojo"></button>
                                                <button type="button" class="btnVerde" onclick="crearItemsB()">
                                                </button>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class=" col-12 col-sm-6 col-lg-4 my-3 ">
                                                <label class="labelTitulo">Equipo:</label></br>
                                                <select id="maquinariaId" name="maquinariaId[]" class="form-select"
                                                    aria-label="Default select example">
                                                    <option value="">Seleccione</option>
                                                    @foreach ($vctMaquinaria as $maquina)
                                                        <option value="{{ $maquina->id }}">
                                                            {{ strtoupper($maquina->identificador) . ' - ' . $objValida->ucwords_accent($maquina->nombre) }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class=" col-12 col-sm-6 col-lg-4 my-3 ">
                                                <label class="labelTitulo">Operador:</label></br>
                                                <select id="personalId" name="personalId[]" class="form-select"
                                                    aria-label="Default select example">
                                                    <option value="">Seleccione</option>
                                                    @foreach ($vctPersonal as $item)
                                                        <option value="{{ $item->id }}">
                                                            {{ $objValida->ucwords_accent($item->personal . ' [' . $item->puesto . ']') }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class=" col-12 col-sm-6 col-lg-4 my-3 ">
                                                <label class="labelTitulo">Combustible:</label></br>
                                                <select class="form-select" aria-label="Default select example"
                                                    id="combustible" name="combustible[]">
                                                    <option value="0">No</option>
                                                    <option value="1">Sí</option>
                                                </select>
                                            </div>

                                            <div class=" col-12 col-sm-6 col-lg-4 my-3 ">
                                                <label class="labelTitulo">Fecha de Inicio:</label></br>
                                                <input type="date" class="inputCaja" id="inicio" name="inicio[]"
                                                    value="">
                                            </div>

                                            <div class=" col-12 col-sm-6 col-lg-4 my-3 ">
                                                <label class="labelTitulo">Fecha de Término:</label></br>
                                                <input type="date" class="inputCaja" id="fin" name="fin[]"
                                                    value="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="col-12 text-end mb-3 ">
                                <div class="mb-5" id="spinner-container"></div>
                                <button type="submit" class="btn botonGral" onclick="alertaGuardar()">Guardar</button>
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
        // agregar registro
        function crearItems() {

            $('.opcion:first').clone().find("input").val("").end().appendTo('#elementos');

        }
        // borrar registro
        $(document).on('click', '#removeRow', function() {

            $(this).closest('#opc').remove();
        });

        function crearItemsB() {

            $('.opcionB:first').clone().find("input").val("").end().appendTo('#elementosB');

        }
        // borrar registro
        $(document).on('click', '#removeRow', function() {

            $(this).closest('#opcB').remove();
        });
    </script>
@endsection
