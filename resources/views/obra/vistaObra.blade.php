@extends('layouts.main', ['activePage' => 'obra', 'titlePage' => __('Edición de Obra')])
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
                        <h4 class="card-title">Vista de Obra</h4>
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
                        <form class="row alertaGuardar" action="{{ route('obras.update', $obras->id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('put')

                            <input type="hidden" name="obraId" value="{{ $obras->id }}">
                            <div class="col-6 my-3 ">

                                <div class="row d-flex justify-content-around">
                                    <div class="col-12  ">
                                        <div class="text-center mx-auto border mb-4">
                                            <i><img class="imgVista img-fluid mb-5"
                                                    src="{{ $obras->foto == '' ? ' /img/general/default.jpg' : asset('/storage/obras/' . str_pad($obras->id, 4, '0', STR_PAD_LEFT) . '/' . $obras->foto) }}"></i>
                                        </div>
                                    </div>


                                    <div class="col-12  ">
                                        <div class="text-center mx-auto border vistaFoto mb-4">
                                            <i><img class="imgVista img-fluid mb-5"
                                                    src="{{ $obras->logo == '' ? ' /img/general/default.jpg' : asset('/storage/obras/' . str_pad($obras->id, 4, '0', STR_PAD_LEFT) . '/' . $obras->logo) }}"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class=" col-12  my-3 order-1">
                                    <h2 class="fs-5 textTitulo">Nombre de Obra:</h2>

                                    <p class="txtVistaObra">{{ $obras->nombre }}
                                    </p>

                                </div>
                                <div class=" col-12  my-3 order-1">
                                    <h2 class="fs-5 textTitulo">Dirección de Obra:</h2>
                                    <a href="https://maps.google.com/?q={{ $obras->calle }} {{ $obras->numero }} {{ $obras->colonia }} {{ $obras->cp }} {{ $obras->estado }}"
                                        target="blank">
                                        <p class="txtVistaObra">{{ $obras->calle }} {{ $obras->numero }},
                                            {{ $obras->colonia }}, {{ $obras->cp }}
                                            {{ $obras->ciudad }}, {{ $obras->estado }}
                                        </p>
                                    </a>
                                </div>

                                <div class=" col-12  my-3 order-1">
                                    <h2 class="fs-5 textTitulo">Información Adicional:</h2>
                                    <p class="txtVistaObra">Proyecto
                                        {{ $obras->proyecto ? $obras->proyecto : '---' }}<br> Centro de Costos
                                        {{ $obras->centroCostos ? $obras->centroCostos : '---' }}
                                    </p>
                                </div>

                                <div class=" col-12  my-3 order-1">
                                    <h2 class="fs-5 textTitulo">Estatus:</h2>
                                    <p class="txtVistaObra">{{ $obras->estatus == 1 ? ' Activa' : 'Inactiva' }}
                                    </p>
                                </div>

                                {{--  <div class="row">
                                    <div class="col-12 col-sm-6 col-lg-4 my-3 ">
                                        <label class="labelTitulo">Nombre de la Obra: <span>*</span></label></br>
                                        <input type="text" class="inputCaja" id="nombre" name="nombre" required
                                            placeholder="Especifique..." value="{{ $obras->nombre }}">
                                    </div>
                                    <div class="col-12 col-sm-6  col-lg-4 my-3 ">
                                        <label class="labelTitulo">Cliente: <span>*</span></label></br>
                                        <select class="form-select" aria-label="Default select example" id="tipo"
                                            required name="clienteId">
                                            @foreach ($Clientes as $Cliente)
                                                <option value="{{ $Cliente->id }}"
                                                    {{ $obras->clienteId == $Cliente->id ? ' selected' : '' }}>
                                                    {{ $objValida->ucwords_accent($Cliente->nombre) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-12 col-sm-6  col-lg-4 my-3 ">
                                        <label class="labelTitulo">Calle: <span>*</span></label></br>
                                        <input type="text" class="inputCaja" id="calle" name="calle" required
                                            placeholder="Especifique..." value="{{ $obras->calle }}">
                                    </div>
                                    <div class="col-12 col-sm-6  col-lg-4 my-3 ">
                                        <label class="labelTitulo">Número:</label></br>
                                        <input type="text" class="inputCaja" id="numero" name="numero"
                                            value="{{ $obras->numero }}">
                                    </div>
                                    <div class="col-12 col-sm-6  col-lg-4 my-3 ">
                                        <label class="labelTitulo">Colonia: <span>*</span></label></br>
                                        <input type="text" class="inputCaja" id="colonia" name="colonia" required
                                            placeholder="Especifique..." value="{{ $obras->colonia }}">
                                    </div>
                                    <div class="col-12 col-sm-6  col-lg-4 my-3 ">
                                        <label class="labelTitulo">Código Postal:</label></br>
                                        <input type="number" maxlength="5" step="1" min="00000"
                                            max="99999" placeholder="ej. 44100" class="inputCaja" id="cp"
                                            name="cp" value="{{ $obras->cp }}">
                                    </div>
                                    <div class="col-12 col-sm-6  col-lg-4 my-3 ">
                                        <label class="labelTitulo">Localidad: <span>*</span></label></br>
                                        <input type="text" class="inputCaja" id="ciudad" name="ciudad" required
                                            placeholder="Especifique..." value="{{ $obras->ciudad }}">
                                    </div>
                                    <div class="col-12 col-sm-6  col-lg-4 my-3 ">
                                        <label class="labelTitulo">Estado: <span>*</span></label></br>
                                        <input type="text" class="inputCaja" id="estado" name="estado" required
                                            placeholder="Especifique..." value="{{ $obras->estado }}">
                                    </div>
                                    <div class="col-12 col-sm-6  col-lg-4 my-3 ">
                                        <label class="labelTitulo">Estatus:</label></br>
                                        <select class="form-select" aria-label="Default select example" id="estatus"
                                            name="estatus">
                                            <option value="0" {{ $obras->estatus == 0 ? ' selected' : '' }}>Inactiva
                                            </option>
                                            <option value="1" {{ $obras->estatus == 1 ? ' selected' : '' }}>Activa
                                            </option>
                                        </select>
                                    </div>
                                </div>  --}}
                            </div>

                            <!-- EQUIPOS -->
                            @can('obra_assign_maquinaria')
                                <div class="row card-body" id="elementosB">

                                    @forelse ($vctMaquinariaAsignada as $maquinaria)
                                        <div class="row opcionB" id="opcB">
                                            <div class="col-12">
                                                <div class="">
                                                    <h2 class="tituloEncabezado ">Maquinaria asignada</h2>
                                                </div>
                                                {{--  <div class=" divBorder pb-3" style="text-align: right;">
                                                    @if ($obras->id > 2)
                                                        <button type="button" id="removeRow" class="btnRojo"></button>
                                                    @endif
                                                    <button type="button" class="btnVerde" onclick="crearItemsB()">
                                                    </button>
                                                </div>  --}}

                                                <div class="row">

                                                    <input type="hidden" name="idObraMaqPer[]" value="{{ $maquinaria->id }}">

                                                    <div class="col-12 col-sm-6 col-lg-4 my-3 ">
                                                        <label class="labelTitulo">Equipo: <span>*</span></label></br>
                                                        <select id="maquinariaId" name="maquinariaId[]" class="form-select"
                                                            aria-label="Default select example" disabled>
                                                            <option value="">Seleccione</option>
                                                            @foreach ($vctMaquinaria as $maquina)
                                                                <option value="{{ $maquina->id }}"
                                                                    {{ $maquina->id == $maquinaria->maquinariaId ? ' selected' : '' }}>
                                                                    {{ strtoupper($maquina->identificador) . ' - ' . $objValida->ucwords_accent($maquina->nombre) }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="col-12 col-sm-6 col-lg-4 my-3 ">
                                                        <label class="labelTitulo">Operador: <span>*</span></label></br>
                                                        <select id="personalId" name="personalId[]" class="form-select"
                                                            aria-label="Default select example" disabled>
                                                            <option value="">Seleccione</option>
                                                            @foreach ($vctPersonal as $item)
                                                                {{-- <option value="0">Sin Cambios</option>
                                                            <option value="">Denegar Equipo</option> --}}
                                                                <option value="{{ $item->id }}"
                                                                    {{ $item->id == $maquinaria->personalId ? ' selected' : '' }}>
                                                                    {{ $objValida->ucwords_accent($item->personal . ' [' . $item->puesto . ']') }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="col-12 col-sm-6 col-lg-4 my-3 ">
                                                        <label class="labelTitulo">Combustible:</label></br>
                                                        <select class="form-select" aria-label="Default select example"
                                                            id="combustible" name="combustible[]" disabled>
                                                            <option value="0"
                                                                {{ $maquinaria->combustible == 0 ? 'selected' : '' }}>No
                                                            </option>
                                                            <option value="1"
                                                                {{ $maquinaria->combustible == 1 ? 'selected' : '' }}>Sí
                                                            </option>
                                                        </select>
                                                    </div>

                                                    <div class="col-12 col-sm-6 col-lg-4 my-3 ">
                                                        <label class="labelTitulo">Fecha de Inicio:</label></br>
                                                        <input type="date" class="inputCaja" id="inicio" name="inicio[]"
                                                            value="{{ \Carbon\Carbon::parse($maquinaria->inicio)->format('Y-m-d') }}"
                                                            disabled>
                                                    </div>

                                                    <div class="col-12 col-sm-6 col-lg-4 my-3 ">
                                                        <label class="labelTitulo">Fecha de Término:</label></br>
                                                        <input type="date" class="inputCaja" id="fin" name="fin[]"
                                                            value="{{ \Carbon\Carbon::parse($maquinaria->fin)->format('Y-m-d') }}"
                                                            disabled>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                    @empty
                                        <div class="row opcionB" id="opcB">
                                            <div class="col-12 ">
                                                <div class="">
                                                    <h2 class="tituloEncabezado ">Maquinaria Asignada</h2>
                                                </div>
                                                {{--  <div class="divBorder pb-3" style="text-align: right;">
                                                    @if ($obras->id > 2)
                                                        <button type="button" id="removeRow" class="btnRojo"></button>
                                                    @endif
                                                    <button type="button" class="btnVerde" onclick="crearItemsB()">
                                                    </button>
                                                </div>  --}}

                                                <div class="row">

                                                    <input type="hidden" name="idObraMaqPer[]" value="">

                                                    <div class="col-12 col-sm-6 col-lg-4 my-3 ">
                                                        <label class="labelTitulo">Equipo: <span>*</span></label></br>
                                                        <select id="maquinariaId" name="maquinariaId[]" class="form-select"
                                                            aria-label="Default select example" disabled>
                                                            <option value="">Seleccione</option>
                                                            @foreach ($vctMaquinaria as $maquina)
                                                                <option value="{{ $maquina->id }}">
                                                                    {{ strtoupper($maquina->identificador) . ' - ' . $objValida->ucwords_accent($maquina->nombre) }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="col-12 col-sm-6 col-lg-4 my-3 ">
                                                        <label class="labelTitulo">Operador: <span>*</span></label></br>
                                                        <select id="personalId" name="personalId[]" class="form-select"
                                                            aria-label="Default select example" disabled>
                                                            <option value="">Seleccione</option>
                                                            {{-- <option value="0">Sin Cambios</option>
                                                        <option value="">Denegar Equipo</option> --}}
                                                            @foreach ($vctPersonal as $item)
                                                                <option value="{{ $item->id }}">
                                                                    {{ $objValida->ucwords_accent($item->personal . ' [' . $item->puesto . ']') }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="col-12 col-sm-6 col-lg-4 my-3 ">
                                                        <label class="labelTitulo">Combustible:</label></br>
                                                        <select class="form-select" aria-label="Default select example"
                                                            id="combustible" name="combustible[]" disabled>
                                                            <option value="0">No
                                                            </option>
                                                            <option value="1">Sí
                                                            </option>
                                                        </select>
                                                    </div>

                                                    <div class="col-12 col-sm-6 col-lg-4 my-3 ">
                                                        <label class="labelTitulo">Fecha de Inicio:</label></br>
                                                        <input type="date" class="inputCaja" id="inicio"
                                                            name="inicio[]" value="" disabled>
                                                    </div>

                                                    <div class="col-12 col-sm-6 col-lg-4 my-3 ">
                                                        <label class="labelTitulo">Fecha de Término:</label></br>
                                                        <input type="date" class="inputCaja" id="fin"
                                                            name="fin[]" value="" disabled>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    @endforelse
                                </div>
                            @endcan

                            <!-- Servicios -->
                            @can('obra_assign_maquinaria')
                                <div class="row card-body" id="elementosB">

                                    @forelse ($vctMaquinariaAsignada as $maquinaria)
                                        <div class="row opcionB" id="opcB">
                                            <div class="col-12">
                                                <div class="">
                                                    <h2 class="tituloEncabezado ">Maquinaria asignada</h2>
                                                </div>
                                                {{--  <div class=" divBorder pb-3" style="text-align: right;">
                                                    @if ($obras->id > 2)
                                                        <button type="button" id="removeRow" class="btnRojo"></button>
                                                    @endif
                                                    <button type="button" class="btnVerde" onclick="crearItemsB()">
                                                    </button>
                                                </div>  --}}

                                                <div class="row">

                                                    <input type="hidden" name="idObraMaqPer[]"
                                                        value="{{ $maquinaria->id }}">

                                                    <div class="col-12 col-sm-6 col-lg-4 my-3 ">
                                                        <label class="labelTitulo">Equipo: <span>*</span></label></br>
                                                        <select id="maquinariaId" name="maquinariaId[]" class="form-select"
                                                            aria-label="Default select example" disabled>
                                                            <option value="">Seleccione</option>
                                                            @foreach ($vctMaquinaria as $maquina)
                                                                <option value="{{ $maquina->id }}"
                                                                    {{ $maquina->id == $maquinaria->maquinariaId ? ' selected' : '' }}>
                                                                    {{ strtoupper($maquina->identificador) . ' - ' . $objValida->ucwords_accent($maquina->nombre) }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="col-12 col-sm-6 col-lg-4 my-3 ">
                                                        <label class="labelTitulo">Operador: <span>*</span></label></br>
                                                        <select id="personalId" name="personalId[]" class="form-select"
                                                            aria-label="Default select example" disabled>
                                                            <option value="">Seleccione</option>
                                                            @foreach ($vctPersonal as $item)
                                                                {{-- <option value="0">Sin Cambios</option>
                                                            <option value="">Denegar Equipo</option> --}}
                                                                <option value="{{ $item->id }}"
                                                                    {{ $item->id == $maquinaria->personalId ? ' selected' : '' }}>
                                                                    {{ $objValida->ucwords_accent($item->personal . ' [' . $item->puesto . ']') }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="col-12 col-sm-6 col-lg-4 my-3 ">
                                                        <label class="labelTitulo">Combustible:</label></br>
                                                        <select class="form-select" aria-label="Default select example"
                                                            id="combustible" name="combustible[]" disabled>
                                                            <option value="0"
                                                                {{ $maquinaria->combustible == 0 ? 'selected' : '' }}>No
                                                            </option>
                                                            <option value="1"
                                                                {{ $maquinaria->combustible == 1 ? 'selected' : '' }}>Sí
                                                            </option>
                                                        </select>
                                                    </div>

                                                    <div class="col-12 col-sm-6 col-lg-4 my-3 ">
                                                        <label class="labelTitulo">Fecha de Inicio:</label></br>
                                                        <input type="date" class="inputCaja" id="inicio"
                                                            name="inicio[]"
                                                            value="{{ \Carbon\Carbon::parse($maquinaria->inicio)->format('Y-m-d') }}"
                                                            disabled>
                                                    </div>

                                                    <div class="col-12 col-sm-6 col-lg-4 my-3 ">
                                                        <label class="labelTitulo">Fecha de Término:</label></br>
                                                        <input type="date" class="inputCaja" id="fin"
                                                            name="fin[]"
                                                            value="{{ \Carbon\Carbon::parse($maquinaria->fin)->format('Y-m-d') }}"
                                                            disabled>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                    @empty
                                        <div class="row opcionB" id="opcB">
                                            <div class="col-12 ">
                                                <div class="">
                                                    <h2 class="tituloEncabezado ">Maquinaria Asignada</h2>
                                                </div>
                                                {{--  <div class="divBorder pb-3" style="text-align: right;">
                                                    @if ($obras->id > 2)
                                                        <button type="button" id="removeRow" class="btnRojo"></button>
                                                    @endif
                                                    <button type="button" class="btnVerde" onclick="crearItemsB()">
                                                    </button>
                                                </div>  --}}

                                                <div class="row">

                                                    <input type="hidden" name="idObraMaqPer[]" value="">

                                                    <div class="col-12 col-sm-6 col-lg-4 my-3 ">
                                                        <label class="labelTitulo">Equipo: <span>*</span></label></br>
                                                        <select id="maquinariaId" name="maquinariaId[]" class="form-select"
                                                            aria-label="Default select example" disabled>
                                                            <option value="">Seleccione</option>
                                                            @foreach ($vctMaquinaria as $maquina)
                                                                <option value="{{ $maquina->id }}">
                                                                    {{ strtoupper($maquina->identificador) . ' - ' . $objValida->ucwords_accent($maquina->nombre) }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="col-12 col-sm-6 col-lg-4 my-3 ">
                                                        <label class="labelTitulo">Operador: <span>*</span></label></br>
                                                        <select id="personalId" name="personalId[]" class="form-select"
                                                            aria-label="Default select example" disabled>
                                                            <option value="">Seleccione</option>
                                                            {{-- <option value="0">Sin Cambios</option>
                                                        <option value="">Denegar Equipo</option> --}}
                                                            @foreach ($vctPersonal as $item)
                                                                <option value="{{ $item->id }}">
                                                                    {{ $objValida->ucwords_accent($item->personal . ' [' . $item->puesto . ']') }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="col-12 col-sm-6 col-lg-4 my-3 ">
                                                        <label class="labelTitulo">Combustible:</label></br>
                                                        <select class="form-select" aria-label="Default select example"
                                                            id="combustible" name="combustible[]" disabled>
                                                            <option value="0">No
                                                            </option>
                                                            <option value="1">Sí
                                                            </option>
                                                        </select>
                                                    </div>

                                                    <div class="col-12 col-sm-6 col-lg-4 my-3 ">
                                                        <label class="labelTitulo">Fecha de Inicio:</label></br>
                                                        <input type="date" class="inputCaja" id="inicio"
                                                            name="inicio[]" value="" disabled>
                                                    </div>

                                                    <div class="col-12 col-sm-6 col-lg-4 my-3 ">
                                                        <label class="labelTitulo">Fecha de Término:</label></br>
                                                        <input type="date" class="inputCaja" id="fin"
                                                            name="fin[]" value="" disabled>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    @endforelse
                                </div>
                            @endcan


                            <div class="col-12 text-end mb-3 ">
                                <div class="mb-5" id="spinner-container"></div>
                                {{--  <button type="submit" class="btn botonGral" onclick="alertaGuardar()">Guardar</button>  --}}
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
