@extends('layouts.main', ['activePage' => 'obra', 'titlePage' => __('Detalle de Obra')])
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
            <div class="row justify-content-center">
                <div class="col-11 align-self-start">
                    <div class="card">
                        <div class="card-body contCart">
                            <div class="p-1 align-self-start bacTituloPrincipal">
                                <h2 class="my-3 ms-3 texticonos ">Detalle de Obra</h2>
                            </div>

                            <div class="col-4 text-left mt-3" style="margin-left:20px">
                                    <a href="{{ route('obras.index') }}">
                                        <button class="btn regresar">
                                            <span class="material-icons">
                                                reply
                                            </span>
                                            Regresar
                                        </button>
                                    </a>    
                                </div>
                                <div class="d-flex p-3 divBorder" style="margin-top:-15px"></div>

                            <form class="row alertaGuardar" action="{{ route('obras.update', $obras->id) }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                @method('put')

                                <div class="col-12   my-5 ">

                                    <div class="row d-flex">
                                        <div class="col-12 col-sm-6 ">
                                            <div class="text-center mx-auto border vistaFoto mb-4">
                                                <i><img class="imgVista img-fluid mb-5"
                                                        src="{{ $obras->foto == '' ? '/img/general/default.jpg' : asset('/storage/obras/' . str_pad($obras->id, 4, '0', STR_PAD_LEFT) . '/' . $obras->foto) }}"></i>
                                                <span class="mi-archivo"> <input class="mb-4 ver" type="file"
                                                        name="foto" id="mi-archivo" accept="image/*"></span>
                                                <label for="mi-archivo">
                                                    <span>sube vista aérea</span>
                                                </label>
                                            </div>
                                        </div>


                                        <div class="col-12 col-sm-6 ">
                                            <div class="text-center mx-auto border vistaFoto mb-4">
                                                <i><img class="imgVista img-fluid mb-5"
                                                        src="{{ $obras->logo == '' ? '/img/general/default.jpg' : asset('/storage/obras/' . str_pad($obras->id, 4, '0', STR_PAD_LEFT) . '/' . $obras->logo) }}"></i>
                                                <span class="mi-archivo"> <input class="mb-4 ver" type="file"
                                                        name="logo" id="mi-archivo2" accept="image/*"></span>
                                                <label for="mi-archivo2">
                                                    <span>sube Logo</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-12 col-sm-6 col-lg-4 my-3 ">
                                            <label class="labelTitulo">Nombre de la Obra: <span>*</span></label></br>
                                            <input type="text" class="inputCaja" id="nombre" name="nombre" required
                                                placeholder="Especifique..." value="{{ $obras->nombre }}">
                                        </div>
                                        <div class="col-12 col-sm-6  col-lg-4 my-3 ">
                                            <label class="labelTitulo">Tipo: <span>*</span></label></br>
                                            <select class="form-select" aria-label="Default select example" id="tipo"
                                                required name="tipo">
                                                <option value="Seleccione"
                                                    {{ $obras->tipo == 'Seleccione' ? ' selected' : '' }}>Seleccione
                                                </option>
                                                <option value="Q2Ces"{{ $obras->tipo == 'Q2Ces' ? ' selected' : '' }}>
                                                    Q2Ces
                                                </option>
                                                <option value="Externa"{{ $obras->tipo == 'Externa' ? ' selected' : '' }}>
                                                    Externa
                                                </option>
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
                                            <input type="text" class="inputCaja" id="estado" name="estado"
                                                required placeholder="Especifique..." value="{{ $obras->estado }}">
                                        </div>
                                    </div>
                                </div>
                                <!-- RESIDENTES -->
                                <div class="row card-body" id="elementos">

                                    @forelse ($vctResidenteAsignado as $residentes)
                                        <div class="row opcion" id="opc">
                                            <div class="col-12 my-5 ">
                                                <div class="">
                                                    <h2 class="tituloEncabezado ">Residente Responsable</h2>
                                                </div>
                                                <div class="col-12 divBorder pb-3" style="text-align: right;">
                                                    <button type="button" id="removeRow" class="btnRojo"></button>
                                                    <button type="button" class="btnVerde" onclick="crearItems()">
                                                    </button>
                                                </div>
                                                <div class="row">
                                                    <input type="hidden" name="idResidente[]"
                                                        value="{{ $residentes->id }}">

                                                    <div class="col-12 col-sm-6 col-lg-4 my-3 ">
                                                        <label class="labelTitulo">Nombre: <span>*</span></label></br>
                                                        <input type="text" class="inputCaja" id="rnombre" required
                                                            placeholder="Especifique..." required name="rnombre[]"
                                                            value="{{ $residentes->nombre }}">
                                                    </div>

                                                    <div class="col-12 col-sm-6 col-lg-4 my-3 ">
                                                        <label class="labelTitulo">Empresa:</label></br>
                                                        <input type="text" class="inputCaja" id="rempresa"
                                                            placeholder="Especifique..." name="rempresa[]"
                                                            value="{{ $residentes->empresa }}">
                                                    </div>

                                                    <div class="col-12 col-sm-6 col-lg-4 my-3 ">
                                                        <label class="labelTitulo">Puesto:</label></br>
                                                        <input type="text" class="inputCaja" id="rpuesto"
                                                            placeholder="Especifique..." name="rpuesto[]"
                                                            value="{{ $residentes->puesto }}">
                                                    </div>

                                                    <div class="col-12 col-sm-6 col-lg-4 my-3 ">
                                                        <label class="labelTitulo">Teléfono:</label></br>
                                                        <input type="tel" pattern="[0-9]{2}-[0-9]{4}-[0-9]{4}"
                                                            placeholder="ej. 00-0000-0000" class="inputCaja"
                                                            id="rtelefono"
                                                            name="rtelefono[]"value="{{ $residentes->telefono }}">
                                                    </div>

                                                    <div class="col-12 col-sm-6 col-lg-4 my-3 ">
                                                        <label class="labelTitulo">Email: <span>*</span></label></br>
                                                        <input type="email" class="inputCaja" id="remail" required
                                                            placeholder="ej. elcorreo@delresponsable.com" min="6"
                                                            name="remail[]" value="{{ $residentes->email }}">
                                                    </div>

                                                    <div class="col-12 col-sm-6 col-lg-4 my-3 ">
                                                        <label class="labelTitulo">Código de Confirmación:</label></br>
                                                        <input type="password" class="inputCaja" id="rfirma"
                                                            placeholder="Especifique..." name="rfirma[]"
                                                            value="{{ $residentes->firma }}">
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="row opcion" id="opc">
                                            <div class="col-12 my-5 ">
                                                <div class="">
                                                    <h2 class="tituloEncabezado ">Residente Responsable</h2>
                                                </div>
                                                <div class="col-12 divBorder pb-3" style="text-align: right;">
                                                    <button type="button" id="removeRow" class="btnRojo"></button>
                                                    <button type="button" class="btnVerde" onclick="crearItems()">
                                                    </button>
                                                </div>
                                                <div class="row">
                                                    <input type="hidden" name="idResidente[]" value="">

                                                    <div class="col-12 col-sm-6 col-lg-4 my-3 ">
                                                        <label class="labelTitulo">Nombre: <span>*</span></label></br>
                                                        <input type="text" class="inputCaja" id="rnombre" required
                                                            placeholder="Especifique..." name="rnombre[]" value="">
                                                    </div>

                                                    <div class="col-12 col-sm-6 col-lg-4 my-3 ">
                                                        <label class="labelTitulo">Empresa:</label></br>
                                                        <input type="text" class="inputCaja" id="rempresa"
                                                            placeholder="Especifique..." name="rempresa[]"
                                                            value="">
                                                    </div>

                                                    <div class="col-12 col-sm-6 col-lg-4 my-3 ">
                                                        <label class="labelTitulo">Puesto:</label></br>
                                                        <input type="text" class="inputCaja" id="rpuesto"
                                                            placeholder="Especifique..." name="rpuesto[]" value="">
                                                    </div>

                                                    <div class="col-12 col-sm-6 col-lg-4 my-3 ">
                                                        <label class="labelTitulo">Teléfono:</label></br>

                                                        <input type="tel" pattern="[0-9]{2}-[0-9]{4}-[0-9]{4}"
                                                            placeholder="ej. 00-0000-0000" class="inputCaja"
                                                            id="rtelefono" name="rtelefono[]"value="">
                                                    </div>

                                                    <div class=" col-12 col-sm-6 col-lg-4 my-3 ">
                                                        <label class="labelTitulo">E-mail: <span>*</span></label></br>
                                                        <input type="email" class="inputCaja" id="remail" required
                                                            placeholder="ej. elcorreo@delresponsable.com" min="6"
                                                            name="remail[]" value="">
                                                    </div>

                                                    <div class="col-12 col-sm-6 col-lg-4 my-3 ">
                                                        <label class="labelTitulo">Código de Confirmación:</label></br>
                                                        <input type="text" class="inputCaja" id="rfirma"
                                                            placeholder="Especifique..." name="rfirma[]" value="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforelse
                                </div>

                                <!-- EQUIPOS -->
                                <div class="row card-body" id="elementosB">

                                    @forelse ($vctMaquinariaAsignada as $maquinaria)
                                        <div class="row opcionB" id="opcB">
                                            <div class="col-12 my-5 ">
                                                <div class="">
                                                    <h2 class="tituloEncabezado ">Detalle de Obra</h2>
                                                </div>
                                                <div class="col-12 divBorder pb-3" style="text-align: right;">
                                                    <button type="button" id="removeRow" class="btnRojo"></button>
                                                    <button type="button" class="btnVerde" onclick="crearItemsB()">
                                                    </button>
                                                </div>

                                                <div class="row">

                                                    <input type="hidden" name="idObraMaqPer[]"
                                                        value="{{ $maquinaria->id }}">

                                                    <div class="col-12 col-sm-6 col-lg-4 my-3 ">
                                                        <label class="labelTitulo">Equipo:</label></br>
                                                        <select id="maquinariaId" name="maquinariaId[]"
                                                            class="form-select" aria-label="Default select example">
                                                            <option value="">Seleccione</option>
                                                            @foreach ($vctMaquinaria as $maquina)
                                                                <option value="{{ $maquina->id }}"
                                                                    {{ $maquina->id == $maquinaria->maquinariaId ? ' selected' : '' }}>
                                                                    {{ $maquina->identificador . ' ' . $maquina->nombre }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="col-12 col-sm-6 col-lg-4 my-3 ">
                                                        <label class="labelTitulo">Operador:</label></br>
                                                        <select id="personalId" name="personalId[]" class="form-select"
                                                            aria-label="Default select example">
                                                            <option value="">Seleccione</option>
                                                            @foreach ($vctPersonal as $persona)
                                                                <option value="{{ $persona->id }}"
                                                                    {{ $persona->id == $maquinaria->personalId ? ' selected' : '' }}>
                                                                    {{ $persona->nombres . ' ' . $persona->apellidoP }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="col-12 col-sm-6 col-lg-4 my-3 ">
                                                        <label class="labelTitulo">Combustible:</label></br>
                                                        <select class="form-select" aria-label="Default select example"
                                                            id="combustible" name="combustible[]">
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
                                                            value="{{ \Carbon\Carbon::parse($maquinaria->inicio)->format('Y-m-d') }}">
                                                    </div>

                                                    <div class="col-12 col-sm-6 col-lg-4 my-3 ">
                                                        <label class="labelTitulo">Fecha de Término:</label></br>
                                                        <input type="date" class="inputCaja" id="fin"
                                                            name="fin[]"
                                                            value="{{ \Carbon\Carbon::parse($maquinaria->fin)->format('Y-m-d') }}">
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                    @empty
                                        <div class="row opcionB" id="opcB">
                                            <div class="col-12 my-5 ">
                                                <div class="">
                                                    <h2 class="tituloEncabezado ">Detalle de Obra</h2>
                                                </div>
                                                <div class="col-12 divBorder pb-3" style="text-align: right;">
                                                    <button type="button" id="removeRow" class="btnRojo"></button>
                                                    <button type="button" class="btnVerde" onclick="crearItemsB()">
                                                    </button>
                                                </div>

                                                <div class="row">

                                                    <input type="hidden" name="idObraMaqPer[]" value="">

                                                    <div class="col-12 col-sm-6 col-lg-4 my-3 ">
                                                        <label class="labelTitulo">Equipo:</label></br>
                                                        <select id="maquinariaId" name="maquinariaId[]"
                                                            class="form-select" aria-label="Default select example">
                                                            <option value="">Seleccione</option>
                                                            @foreach ($vctMaquinaria as $maquina)
                                                                <option value="{{ $maquina->id }}">
                                                                    {{ $maquina->identificador . ' ' . $maquina->nombre }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="col-12 col-sm-6 col-lg-4 my-3 ">
                                                        <label class="labelTitulo">Operador:</label></br>
                                                        <select id="personalId" name="personalId[]" class="form-select"
                                                            aria-label="Default select example">
                                                            <option value="">Seleccione</option>
                                                            @foreach ($vctPersonal as $persona)
                                                                <option value="{{ $persona->id }}">
                                                                    {{ $persona->nombres . ' ' . $persona->apellidoP }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="col-12 col-sm-6 col-lg-4 my-3 ">
                                                        <label class="labelTitulo">Combustible:</label></br>
                                                        <select class="form-select" aria-label="Default select example"
                                                            id="combustible" name="combustible[]">
                                                            <option value="0">No
                                                            </option>
                                                            <option value="1">Sí
                                                            </option>
                                                        </select>
                                                    </div>

                                                    <div class="col-12 col-sm-6 col-lg-4 my-3 ">
                                                        <label class="labelTitulo">Fecha de Inicio:</label></br>
                                                        <input type="date" class="inputCaja" id="inicio"
                                                            name="inicio[]" value="">
                                                    </div>

                                                    <div class="col-12 col-sm-6 col-lg-4 my-3 ">
                                                        <label class="labelTitulo">Fecha de Término:</label></br>
                                                        <input type="date" class="inputCaja" id="fin"
                                                            name="fin[]" value="">
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    @endforelse
                                </div>
                        </div>

                        <div class="col-12 text-end mb-3 ">
                            <button type="submit" class="btn botonGral" onclick="alertaGuardar()">Guardar</button>
                        </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
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
