@extends('layouts.main', ['activePage' => 'maquinaria', 'titlePage' => __('Alta de Accesorios')])
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
                <div class="col-12 align-self-start">
                    <div class="card">
                        <div class="card-body contCart">
                        <div class="ml-3">
                                    <div class="p-1 align-self-start bacTituloPrincipal">
                                        <h2 class="my-3 ms-3 texticonos">Alta de Accesorios</h2>
                                    </div>
                                    <div>
                                    <div class="col-4 text-left mt-3" style="margin-left:20px">
                                    <a href="{{ route('accesorios.index') }}">
                                        <button class="btn regresar">
                                            <span class="material-icons">
                                                reply
                                            </span>
                                            Regresar
                                        </button>
                                    </a>    
                                    </div>
                                    <div class="d-flex p-3 divBorder" style="margin-top:-15px">
                                    </div>
                                    </div>
                            <form action="{{ route('accesorios.store') }}"
                                method="post"class="row alertaGuardar" enctype="multipart/form-data">
                                @csrf
                                <div class="row mt-3" style="padding-left:35px;">
                                    <div class="col-12 col-md-4  my-3">
                                        <div class="text-center mx-auto border vistaFoto mb-4">
                                            <i><img class="imgVista img-fluid mb-2"
                                                    src="{{ asset('/img/general/default.jpg') }}"></i>
                                            <span class="mi-archivo"> <input class="mb-4 ver " type="file" name="foto"
                                                    id="mi-archivo" accept="image/*"></span>
                                            <label for="mi-archivo">
                                                <span class="">sube imagen</span>
                                            </label>
                                        </div>
                                    </div>
                                
                                    <div class="col-12 col-md-8 ">
                                        <div class="row">
                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                <label class="labelTitulo">Accesorio: <span>*</span></label></br>
                                                <input type="text" class="inputCaja" id="nombre" name="nombre" placeholder="Especifique..." required
                                                    value="{{ old('nombre') }}">
                                            </div>

                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                <label class="labelTitulo">Año:</label></br>
                                                <input type="number" class="inputCaja" id="ano" maxlength="4"
                                                    placeholder="Ej. 2000" name="ano" value="{{ old('ano') }}">
                                            </div>

                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                <label class="labelTitulo">Marca:</label></br>
                                                <input type="text" class="inputCaja" id="marca" name="marca" placeholder="Especifique..."
                                                    value="{{ old('marca') }}">
                                            </div>


                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                <label class="labelTitulo">Número Serie:</label></br>
                                                <input type="text" class="inputCaja" id="serie" name="serie" placeholder="Especifique..."
                                                    value="{{ old('serie') }}">
                                            </div>

                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                <label class="labelTitulo">Modelo:</label></br>
                                                <input type="text" class="inputCaja" id="modelo" name="modelo" placeholder="Especifique..."
                                                    value="{{ old('modelo') }}">
                                            </div>

                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                <label class="labelTitulo">Color:</label></br>
                                                <input type="text" class="inputCaja" id="color" name="color" placeholder="Especifique..."
                                                    value="{{ old('color') }}">
                                            </div>

                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                <label class="labelTitulo">Maquinaria Asignada:</label></br>
                                                <select id="maquinariaId" name="maquinariaId" class="form-select"
                                                    aria-label="Default select example">
                                                    <option value="">Seleccione</option>
                                                    @foreach ($vctMaquinaria as $maquina)
                                                        <option value="{{ $maquina->id }}">
                                                            {{ $maquina->identificador . ' ' . $maquina->nombre }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                    <div class="col p-1 align-self-start bacTituloPrincipal" style="margin-left: 12px; margin-right: 12px">
                                        <h2 class="my-3 ms-3 texticonos">Documentos</h2>
                                    </div>
                                    <div class="row mt-3" style="padding-left:35px;">
                                    <div class="col-12 col-md-10 ">
                                        <div class="row mt-3">
                                            @php
                                                $count = 0;
                                            @endphp
                                            @foreach ($doc as $item)
                                                <div
                                                    class="card-group col-12 col-md-6 col-lg-4 col-xl-3 small-card-date my-1">
                                                    <div class="card border-green">
                                                        <div class="card-body">
                                                            <div>
                                                                <label
                                                                    class="form-check-label text-start fs-5 textTitulo text-break mb-2"
                                                                    for="flexCheckDefault">
                                                                    <!--<i class="fa fa-check-circle semaforo2"></i>-->
                                                                    {{ ucwords(trans($item->nombre)) }}
                                                                </label>
                                                            </div>
                                                            <div
                                                                class="contIconosDocumentos d-flex flex-wrap align-items-end align-items-center">
                                                                <input type="hidden" id='{{ $item->nombre }}'
                                                                    name='archivo[{{ $count }}][tipoDocs]'
                                                                    value='{{ $item->id }}'>
                                                                <input type="hidden"
                                                                    id='nombre{{ $item->nombre }}'
                                                                    name='archivo[{{ $count }}][tipoDocsNombre]'
                                                                    value='{{ $item->nombre }}'>
                                                                <input type="hidden"
                                                                    id='omitido{{ $item->id }}'
                                                                    name='archivo[{{ $count }}][omitido]'
                                                                    value='0'>
                                                                <label class="custom-file-upload"
                                                                    onclick='handleDocumento("{{ $item->id }}","{{ $item->nombre }}")'>
                                                                    <input class="mb-4" type="file"
                                                                        name='archivo[{{ $count }}][docs]'
                                                                        id='{{ $item->id }}' accept=".pdf">
                                                                    <div id='iconContainer{{ $item->id }}'>
                                                                        <lord-icon
                                                                            src="https://cdn.lordicon.com/koyivthb.json"
                                                                            trigger="hover"
                                                                            colors="primary:#86c716,secondary:#e8e230"
                                                                            stroke="65"
                                                                            style="width:50px;height:70px">
                                                                        </lord-icon>

                                                                    </div>
                                                                </label>
                                                                <a id='downloadButton{{ $item->id }}'
                                                                    class="btnViewDescargar btn btn-outline-success btnView"
                                                                    style="display: none" download>
                                                                    <span class="btn-text">Descargar</span>
                                                                    <span class="icon">
                                                                        <i class="far fa-eye mt-2"></i>
                                                                    </span>
                                                                </a>
                                                                <button id='removeButton{{ $item->id }}'
                                                                    type="button"
                                                                    class="btnViewDelete btn btn-outline-danger btnView"
                                                                    style="width: 2.4em; height: 2.4em; display: none;"><i
                                                                        class="fa fa-times"></i></button>
                                                                <!-- Botón Omitir -->
                                                                <button id='omitirButton{{ $item->id }}'
                                                                    class="btnSinFondo float-end mt-3"
                                                                    style="margin-left: 20px" rel="tooltip"
                                                                    type="button"
                                                                    onclick='omitir("{{ $item->id }}","{{ $item->nombre }}")'>
                                                                    <P class="fs-5"> Omitir</P>
                                                                </button>
                                                                <button
                                                                    id='cancelarOmitirButton{{ $item->id }}'
                                                                    class="btnSinFondo float-end mt-3"
                                                                    style="margin-left: 20px; display: none;"
                                                                    rel="tooltip" type="button"
                                                                    onclick='cancelarOmitir("{{ $item->id }}","{{ $item->nombre }}")'>
                                                                    <P class="fs-5"> Cancelar</P>
                                                                </button>
                                                                <div class="text-center">
                                                                    <div
                                                                        class="form-check d-flex justify-content-between">
                                                                        <div class="text-center"></div>
                                                                        <label
                                                                            class="text-start fs-5 textTitulo text-break mb-2"
                                                                            style="margin-left:-33px!important; font-size: 18px !important">
                                                                            Expiración:
                                                                        </label>
                                                                        <input
                                                                            class="form-check-input is-invalid align-self-end mb-2"
                                                                            type="checkbox"
                                                                            name='archivo[{{ $count }}][check]'
                                                                            id='check{{ $item->id }}' checked
                                                                            style="font-size: 20px; visibility: hidden"
                                                                            onchange='handleCheckboxChange("{{ $item->id }}")'>
                                                                        <!--<input type="hidden" class="form-check-input is-invalid align-self-end mb-2"  id='checkHidden{{ $item->id }}' value='false'> -->
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <input type="date"
                                                                            class="inputCaja text-center"
                                                                            name='archivo[{{ $count }}][fecha]'
                                                                            id='fecha{{ $item->id }}'
                                                                            style="display: block;" disabled>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <label
                                                                            class="text-start fs-5 textTitulo text-break mb-2"
                                                                            style="font-size: 18px !important; padding-top: 10px; padding-bottom: 5px; resize: horizontal !important;">Comentario:</label>
                                                                        <textarea id='comentario{{ $item->id }}' name='archivo[{{ $count }}][comentario]'
                                                                            class="form-control-textarea inputCaja" rows="2" maxlength="1000" placeholder="Escribe Un Comentario"></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @php
                                                    $count++;
                                                @endphp
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="col-12 text-end mb-3 ">
                                        <button type="submit" class="btn botonGral"
                                            onclick="alertaGuardar()">Guardar</button>
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

<script src="{{ asset('js/cardArchivos.js') }}"></script>
