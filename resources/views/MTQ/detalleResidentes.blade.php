@extends('layouts.main', ['activePage' => 'mtq', 'titlePage' => __('Detalle de Accesorios')])
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
            <div class="row justify-content-center">
                <div class="col-12 align-self-start">
                    <div class="card">
                        <div class="card-body contCart">
                            <div class="ml-3">
                                <div class="p-1 align-self-start bacTituloPrincipal">
                                    @if ($readonly)
                                        <h2 class="my-3 ms-3 texticonos">Vista Detalle de Accesorios</h2>
                                    @else
                                        <h2 class="my-3 ms-3 texticonos">Detalle de Residente</h2>
                                    @endif

                                </div>
                                <div>
                                    <div class="col-4 text-left mt-3" style="margin-left:20px">
                                        <a href="{{ route('residentes.index') }}">
                                            <button class="btn regresar">
                                                <span class="material-icons">
                                                    reply
                                                </span>
                                                Regresar
                                            </button>
                                        </a>
                                    </div>
                                    <div class="d-flex p-3 divBorder" style="margin-top:-15px"></div>
                                </div>
                                <form action="{{ route('residentes.update', $residente->id) }}" method="post"
                                    class="row alertaGuardar" enctype="multipart/form-data">
                                    @csrf
                                    @method('put')
                                    <input type="hidden" name="residenteId" id="residenteId" value="{{ $residente->id }}">
                                    <div class="row mt-3" style="padding-left: 40px">
                                        <div class=" col-12 col-sm-6 mb-3 ">
                                            <label class="labelTitulo">Nombre:<span>*</span></label></br>
                                            <input type="text" class="inputCaja" id="nombre" name="nombre" required
                                                value="{{ $residente->nombre }}" required placeholder="Especifique...">
                                        </div>

                                        <div class=" col-12 col-sm-6 mb-3 ">
                                            <label class="labelTitulo">E-mail</label></br>
                                            <input type="email" class="inputCaja" id="email" required
                                                placeholder="ej. elcorreo@delresponsable.com" min="6" name="email"
                                                value="{{ $residente->email }}">
                                        </div>

                                        <div class=" col-12 col-sm-6 mb-3 ">
                                            <label class="labelTitulo">Teléfono:</label></br>
                                            <input type="tel" placeholder="ej. 00-0000-0000" class="inputCaja"
                                                id="telefono" name="telefono"value="{{ $residente->telefono }}">
                                        </div>

                                        <div class=" col-12 col-sm-6 mb-3 ">
                                            <label class="labelTitulo">Obra: </label></br>
                                            <select id="obraId" name="obraId" class="form-select"
                                                aria-label="Default select example">
                                                <option value="">Seleccione</option>
                                                @foreach ($vctObras as $item)
                                                    <option value="{{ $item->id }}"
                                                        {{ $item->id == $residente->obraId ? ' selected' : '' }}>
                                                        {{ $item->nombre }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        @can('residente_mtq_assign_vehiculo')
                                            {{--  <div class=" col-12 col-sm-6 mb-3 ">
                                            <label class="labelTitulo">Auto Asignado: </label></br>
                                            <input type="text" class="inputCaja" id="asignado" value="" readonly>
                                        </div>
    
                                        <div class=" col-12 col-sm-6 mb-3 ">
                                            <label class="labelTitulo">Cambio de Auto: </label></br>
                                            <select id="autoId" name="autoId" class="form-select"
                                                aria-label="Default select example">
                                                <option value="0">Sin Cambios</option>
                                                <option value="">Denegar Auto</option>
                                                @foreach ($maquinaria as $item)
                                                    <option value="{{ $item->id }}">
                                                        {{ $item->identificador }} {{ $item->nombre }} {{ $item->modelo }} {{ $item->placas }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>  --}}
                                        @endcan
                                        @if (count($residentesAutos) > 0)
                                            <div class="d-flex p-3">
                                                <div class="col-12" id="elementos">
                                                    <div class="d-flex">
                                                        <div class="col-6 divBorder">
                                                            <h2 class="tituloEncabezado ">Vehículos</h2>
                                                        </div>
                                                        <div class="col-6 divBorder pb-3 text-end">
                                                            <button type="button" class="btnVerde" onclick="crearItems()">
                                                            </button>
                                                        </div>
                                                    </div>
                                        @endif

                                        @forelse($residentesAutos as $residenteAuto)
                                            <div class="row opcion divBorderItems" id="opc">
                                                <input type="hidden" name="idResidenteAuto[]"
                                                    value="{{ $residenteAuto->id }}">
                                                <div class=" col-9 mb-3 ">
                                                    <label class="labelTitulo mt-2">Auto: <span></span></label></br>
                                                    <select name="autoIdR[]" class="form-select"
                                                        aria-label="Default select example">
                                                        <option value="">Seleccione</option>
                                                        @foreach ($maquinaria as $item)
                                                            <option value="{{ $item->id }}"
                                                                {{ $residenteAuto->equipo_id == $item->id ? 'selected' : '' }}>
                                                                {{ $item->identificador }} {{ $item->nombre }}
                                                                {{ $item->modelo }} {{ $item->placas }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-lg-2 my-3 text-center pt-2">
                                                    <span class="material-icons" style="font-size:40px; color: green">
                                                        no_crash
                                                    </span>
                                                </div>
                                                <div class="col-lg-1 my-3 text-end">
                                                    <button type="button" id="removeRow" class="btnRojo"></button>
                                                </div>
                                            </div>

                                        @empty
                                            <div class="d-flex p-3">
                                                <div class="col-12" id="elementos">
                                                    <div class="d-flex">
                                                        <div class="col-6 divBorder">
                                                            <h2 class="tituloEncabezado ">Vehículos</h2>
                                                        </div>
                                                        <div class="col-6 divBorder pb-3 text-end">
                                                            <button type="button" class="btnVerde" onclick="crearItems()">
                                                            </button>
                                                        </div>
                                                    </div>

                                                    <div class="row opcion divBorderItems" id="opc">
                                                        <input type="hidden" name="idResidenteAuto[]" value="">
                                                        <div class=" col-9 mb-3 ">
                                                            <label class="labelTitulo mt-2">Auto:
                                                                <span></span></label></br>
                                                            <select name="autoIdR[]" class="form-select"
                                                                aria-label="Default select example">
                                                                <option value="">Seleccione</option>
                                                                @foreach ($maquinaria as $item)
                                                                    <option value="{{ $item->id }}">
                                                                        {{ $item->identificador }} {{ $item->nombre }}
                                                                        {{ $item->modelo }} {{ $item->placas }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-lg-2 my-3 text-center pt-2">
                                                            <span class="material-icons"
                                                                style="font-size:40px; color: green">
                                                                no_crash
                                                            </span>
                                                        </div>
                                                        <div class="col-lg-1 my-3 text-end">
                                                            <button type="button" id="removeRow"
                                                                class="btnRojo"></button>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        @endforelse
                                        @if (count($residentesAutos) > 0)
                                    </div>
                            </div>
                            @endif

                        </div>

                        <div class="col-12 text-center mb-3 mt-3">
                            <button type="submit" class="btn botonGral" onclick="alertaGuardar()">Guardar</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection
<script src="{{ asset('js/cardArchivos.js') }}"></script>
<script>
    function loadDocument(id, tipo, comentarios, fechaVencimiento) {

        const txtId = document.getElementById('docId');
        txtId.value = id;

        const lstTipo = document.getElementById('docTipo').value = tipo;

        const txtComentario = document.getElementById('docComentarios');
        txtComentario.innerText = comentarios;

        const dteFechaVencimiento = document.getElementById('docFechaVencimiento').value = fechaVencimiento;
        // const dteFechaFin = document.getElementById('tareaFechaFin').value = fechaFin;

        // if(estadoId==3){
        //     txtTitulo.disabled = true;
        //     txtComentario.disabled = true;

        //     document.getElementById('tareaResponsableId').disabled = true;

        //     document.getElementById('tareaPrioridadId1').disabled = true;
        //     document.getElementById('tareaPrioridadId2').disabled = true;
        //     document.getElementById('tareaPrioridadId3').disabled = true;
        //     document.getElementById('tareaPrioridadId4').disabled = true;

        //     document.getElementById('tareaEstadoId1').disabled = true;
        //     document.getElementById('tareaEstadoId2').disabled = true;
        //     document.getElementById('tareaEstadoId3').disabled = true;

        //    document.getElementById('tareaFechaInicio').disabled = true;
        //    document.getElementById('tareaFechaFin').disabled = true;

        //     document.getElementById('btnTareaGuardar').disabled = true;

        // }
    }
</script>

<script>
    function evaluar(id, requerido) {
        console.log(id, requerido);
        if (requerido == 0) {
            console.log('requerido');
            omitir(id);
            let downloadButton = document.getElementById("downloadButton" + id);
            let removeButton = document.getElementById("removeButton" + id);
            downloadButton.style.display = "none";
            removeButton.style.display = "none";

        }

    }
</script>
<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
    crossorigin="anonymous"></script>
<script>
    function crearItems() {
        $('.opcion:first').clone().find("input, select").val("").end().appendTo('#elementos');
    }

    // Borrar registro
    $(document).on('click', '#removeRow', function() {
        if ($('.opcion').length > 1) {
            $(this).closest('.opcion').remove();
        }
    });
</script>
