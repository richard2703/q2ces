@extends('layouts.main', ['activePage' => 'maquinaria', 'titlePage' => __('Detalle de Accesorios')])
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
                                        <h2 class="my-3 ms-3 texticonos">Detalle de Accesorios</h2>    
                                    @endif
                                    
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
                                <div class="d-flex p-3 divBorder" style="margin-top:-15px"></div>
                            </div>
                            <form action="{{ route('accesorios.update', $accesorios->id) }}"
                                method="post" class="row alertaGuardar" enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                @if ($readonly)
                                <div class="row mt-3" style="padding-left:35px;">
                                    <div class="col-12 col-md-4  my-3">
                                        <div class="text-center mx-auto border vistaFoto mb-4">
                                            <i><img class="imgVista img-fluid mb-2"
                                                    src="{{  $accesorios->foto == '' ? '/img/general/default.jpg' : asset('/storage/accesorios/' . str_pad($accesorios->id, 4, '0', STR_PAD_LEFT) . '/' . $accesorios->foto ) }}"
                                                    {{-- src="'/img/general/default.jpg' : asset('/storage/maquinaria/' . str_pad($maquinaria['identificador'], 4, '0', STR_PAD_LEFT) . '/' . $fotos[0]->ruta) " --}}
                                                    ></i>
                                            
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-8 ">
                                        <div class="row">
                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                <label class="labelTitulo">Nombre: <span>*</span></label></br>
                                                <input type="text" class="inputCaja" id="nombre" name="nombre" disabled
                                                    placeholder="Especifique..." required value="{{ $accesorios->nombre }}">
                                            </div>

                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                <label class="labelTitulo">Año:</label></br>
                                                <input type="number" class="inputCaja" id="ano" maxlength="4" disabled
                                                    placeholder="Ej. 2000" name="ano" value="{{ $accesorios->ano }}">
                                            </div>

                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                <label class="labelTitulo">Marca:</label></br>
                                                <select id="marcaId" name="marcaId" class="form-select"
                                                    aria-label="Default select example" disabled>
                                                    <option value="">Seleccione</option>
                                                    @foreach ($marcas as $item)
                                                        <option value="{{ $item->id }}"
                                                            {{ $item->id == $accesorios->marcaId ? ' selected' : '' }}>
                                                            {{ $objValida->ucwords_accent($item->nombre) }}
                                                        </option>
                                                    @endforeach
                                                </select>

                                                {{--  <select id="marcaId" name="marcaId" class="form-select"
                                                aria-label="Default select example">
                                                <option value="">Seleccione</option>
                                                @foreach ($marcas as $item)
                                                    <option value="{{ $item->id }}"
                                                        {{ $item->id == $maquinaria->marcaId ? ' selected' : '' }}>
                                                        {{$item->id - $objValida->ucwords_accent($item->nombre) }}
                                                    </option>
                                                @endforeach
                                            </select>  --}}
                                            </div>

                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                <label class="labelTitulo">Número Serie:</label></br>
                                                <input type="text" class="inputCaja" id="serie" name="serie"  disabled
                                                    placeholder="Especifique..." value="{{ $accesorios->serie }}">
                                            </div>

                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                <label class="labelTitulo">Modelo:</label></br>
                                                <input type="text" class="inputCaja" id="modelo" name="modelo" disabled
                                                    placeholder="Especifique..." value="{{ $accesorios->modelo }}">
                                            </div>

                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                <label class="labelTitulo">Color:</label></br>
                                                <input type="text" class="inputCaja" id="color" name="color" disabled
                                                    placeholder="Especifique..." value="{{ $accesorios->color }}">
                                            </div>

                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                <label class="labelTitulo">Maquinaria Asignada:</label></br>
                                                <select id="maquinariaId" name="maquinariaId" class="form-select"
                                                    aria-label="Default select example" disabled>
                                                    <option value="">Seleccione</option>
                                                    @foreach ($vctMaquinaria as $maquina)
                                                        <option value="{{ $maquina->id }}"
                                                            {{ $maquina->id == $accesorios->maquinariaId ? ' selected' : '' }}>
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
                                            @forelse ($doc as $item)
                                                <div class="card-group col-12 col-md-6 col-lg-4 col-xl-3 small-card-date my-1">
                                                    <div class="card border-green">
                                                        <div class="card-body">
                                                            <div>
                                                                <label
                                                                    class="form-check-label text-start fs-5 textTitulo text-break mb-2"
                                                                    for="flexCheckDefault">
                                                                    <i class="fas fa-times-circle semaforo{{ $item->estatus }}"
                                                                        style="display: {{ $item->estatus != '0' ? ' none' : '' }};"></i>
                                                                    <i class="fa fa-exclamation-circle semaforo{{ $item->estatus }}"
                                                                        style="display: {{ $item->estatus != '1' ? ' none' : '' }};"
                                                                        title="Proximo a vencer"></i>
                                                                    <i class="fa fa-check-circle semaforo{{ $item->estatus }}"
                                                                        style="display: {{ $item->estatus != '2' ? ' none' : '' }};"></i>
                                                                    {{ ucwords(trans($item->nombre)) }}
                                                                </label>
                                                            </div>
                                                            @if ($item->ruta != null)
                                                                <div
                                                                    class="contIconosDocumentos d-flex flex-wrap align-items-end align-items-center">
                                                                    <input type="hidden"
                                                                        id='{{ $item->idDoc }}'
                                                                        name='archivo[{{ $count }}][idDoc]'
                                                                        value='{{ $item->idDoc }}'>
                                                                    <input type="hidden"
                                                                        id='{{ $item->nombre }}'
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
                                                                    <label class="custom-file-upload">
                                                                        <div
                                                                            id='iconContainer{{ $item->id }}'>
                                                                            <lord-icon
                                                                                src="https://cdn.lordicon.com/nxaaasqe.json"
                                                                                trigger="hover"
                                                                                colors="primary:#86c716,secondary:#e8e230"
                                                                                stroke="65"
                                                                                style="width:50px;height:70px">
                                                                            </lord-icon>

                                                                        </div>
                                                                    </label>
                                                                    <a id='downloadButton{{ $item->id }}'
                                                                        class="btnViewDescargar btn btn-outline-success btnView"
                                                                        download
                                                                        href="{{ asset('/storage/accesorios/' . str_pad($accesorios->serie . $accesorios->id, 4, '0', STR_PAD_LEFT) . '/documentos/' . $item->nombre . '/' . $item->ruta) }}">
                                                                        <span class="btn-text">Descargar</span>
                                                                        <span class="icon">
                                                                            <i class="far fa-eye mt-2"></i>
                                                                        </span>
                                                                    </a>
                                                                    <button disabled id='removeButton{{ $item->id }}'
                                                                        onclick='eliminarBotonera("{{ $item->id }}")'
                                                                        type="button"
                                                                        class="btnViewDelete btn btn-outline-danger btnView"
                                                                        style="width: 2.4em; height: 2.4em;"><i
                                                                            class="fa fa-times"></i></button>
                                                                    <!-- Botón Omitir -->
                                                                    <button disabled id='omitirButton{{ $item->id }}'
                                                                        class="btnSinFondo float-end mt-3"
                                                                        style="margin-left: 20px" rel="tooltip"
                                                                        type="button"
                                                                        onclick='omitir("{{ $item->id }}","{{ $item->nombre }}")'>
                                                                        <P class="fs-5" style="display: none">
                                                                            Omitir</P>
                                                                    </button>
                                                                    <button disabled
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
                                                                                id='check{{ $item->id }}'
                                                                                checked style="font-size: 20px;"
                                                                                onchange='handleCheckboxChange("{{ $item->id }}")' disabled>
                                                                            <!--<input type="hidden" class="form-check-input is-invalid align-self-end mb-2"  id='checkHidden{{ $item->id }}' value='false'> -->
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <input type="date"
                                                                                id='fecha{{ $item->id }}'
                                                                                class="inputCaja text-center"
                                                                                name='archivo[{{ $count }}][fecha]'
                                                                                style="display: block;"
                                                                                value="{{ $item->fechaVencimiento }}" disabled>
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <label
                                                                                class="text-start fs-5 textTitulo text-break mb-2"
                                                                                style="font-size: 18px !important; padding-top: 10px; padding-bottom: 5px; resize: horizontal !important;">Comentario:</label>
                                                                            <textarea id='comentario{{ $item->id }}' name='archivo[{{ $count }}][comentario]'
                                                                                class="form-control-textarea inputCaja" rows="2" maxlength="1000" placeholder="Escribe Un Comentario" disabled>{{ $item->comentarios }}</textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @else
                                                                <div
                                                                    class="contIconosDocumentos d-flex flex-wrap align-items-end align-items-center">
                                                                    <input type="hidden" id=''
                                                                        name='archivo[{{ $count }}][idDoc]'
                                                                        value='{{ $item->idDoc }}'>
                                                                    <input type="hidden"
                                                                        id='{{ $item->nombre }}'
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
                                                                            id='{{ $item->id }}'
                                                                            accept=".pdf"
                                                                            value="{{ $item->ruta }}">
                                                                        <div
                                                                            id='iconContainer{{ $item->id }}'>
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
                                                                            class="fa fa-times" disabled></i></button>
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
                                                                                id='check{{ $item->id }}'
                                                                                checked
                                                                                style="font-size: 20px; visibility: hidden"
                                                                                onchange='handleCheckboxChange("{{ $item->id }}")'>
                                                                            <!--<input type="hidden" class="form-check-input is-invalid align-self-end mb-2"  id='checkHidden{{ $item->id }}' value='false'> -->
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <input type="date"
                                                                                id='fecha{{ $item->id }}'
                                                                                class="inputCaja text-center"
                                                                                name='archivo[{{ $count }}][fecha]'
                                                                                style="display: block;" disabled
                                                                                value="{{ $item->fechaVencimiento }}">
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <label
                                                                                class="text-start fs-5 textTitulo text-break mb-2"
                                                                                style="font-size: 18px !important; padding-top: 10px; padding-bottom: 5px; resize: horizontal !important;">Comentario:</label>
                                                                            <textarea id='comentario{{ $item->id }}' name='archivo[{{ $count }}][comentario]'
                                                                                class="form-control-textarea inputCaja" rows="2" maxlength="1000" placeholder="Escribe Un Comentario">{{ $item->comentarios }}</textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <script>
                                                    document.addEventListener('DOMContentLoaded', function() {
                                                        // Llamar a la función después de que la vista haya cargado completamente
                                                        evaluar({{ $item->id }}, {{ $item->requerido }});
                                                    });
                                                </script>
                                                @php
                                                    $count++;
                                                @endphp
                                            @empty
                                                Sin Registros
                                            @endforelse
                                        </div>
                                    </div>

                                    <div class="col-12 text-center mb-3 ">
                                        
                                    </div>
                                </div>
                                @else
                                <div class="row mt-3" style="padding-left:35px;">
                                    <div class="col-12 col-md-4  my-3">
                                        <div class="text-center mx-auto border vistaFoto mb-4">
                                            <i><img class="imgVista img-fluid mb-2"
                                                    src="{{  $accesorios->foto == '' ? '/img/general/default.jpg' : asset('/storage/accesorios/' . str_pad($accesorios->id, 4, '0', STR_PAD_LEFT) . '/' . $accesorios->foto ) }}"
                                                    {{-- src="'/img/general/default.jpg' : asset('/storage/maquinaria/' . str_pad($maquinaria['identificador'], 4, '0', STR_PAD_LEFT) . '/' . $fotos[0]->ruta) " --}}
                                                    ></i>
                                            <span class="mi-archivo"> <input class="mb-4 ver" type="file" name="foto"
                                                    id="mi-archivo" accept="image/*"></span>
                                            <label for="mi-archivo">
                                                <span>sube imagen</span>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-8 ">
                                        <div class="row">
                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                <label class="labelTitulo">Nombre: <span>*</span></label></br>
                                                <input type="text" class="inputCaja" id="nombre" name="nombre"
                                                    placeholder="Especifique..." required value="{{ $accesorios->nombre }}">
                                            </div>

                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                <label class="labelTitulo">Año:</label></br>
                                                <input type="number" class="inputCaja" id="ano" maxlength="4"
                                                    placeholder="Ej. 2000" name="ano" value="{{ $accesorios->ano }}">
                                            </div>

                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                <label class="labelTitulo">Marca:</label></br>
                                                <select id="marcaId" name="marcaId" class="form-select"
                                                    aria-label="Default select example">
                                                    <option value="">Seleccione</option>
                                                    @foreach ($marcas as $item)
                                                        <option value="{{ $item->id }}"
                                                            {{ $item->id == $accesorios->marcaId ? ' selected' : '' }}>
                                                            {{ $objValida->ucwords_accent($item->nombre) }}
                                                        </option>
                                                    @endforeach
                                                </select>

                                                {{--  <select id="marcaId" name="marcaId" class="form-select"
                                                aria-label="Default select example">
                                                <option value="">Seleccione</option>
                                                @foreach ($marcas as $item)
                                                    <option value="{{ $item->id }}"
                                                        {{ $item->id == $maquinaria->marcaId ? ' selected' : '' }}>
                                                        {{$item->id - $objValida->ucwords_accent($item->nombre) }}
                                                    </option>
                                                @endforeach
                                            </select>  --}}
                                            </div>

                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                <label class="labelTitulo">Número Serie:</label></br>
                                                <input type="text" class="inputCaja" id="serie" name="serie"
                                                    placeholder="Especifique..." value="{{ $accesorios->serie }}">
                                            </div>

                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                <label class="labelTitulo">Modelo:</label></br>
                                                <input type="text" class="inputCaja" id="modelo" name="modelo"
                                                    placeholder="Especifique..." value="{{ $accesorios->modelo }}">
                                            </div>

                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                <label class="labelTitulo">Color:</label></br>
                                                <input type="text" class="inputCaja" id="color" name="color"
                                                    placeholder="Especifique..." value="{{ $accesorios->color }}">
                                            </div>

                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                <label class="labelTitulo">Maquinaria Asignada:</label></br>
                                                <select id="maquinariaId" name="maquinariaId" class="form-select"
                                                    aria-label="Default select example">
                                                    <option value="">Seleccione</option>
                                                    @foreach ($vctMaquinaria as $maquina)
                                                        <option value="{{ $maquina->id }}"
                                                            {{ $maquina->id == $accesorios->maquinariaId ? ' selected' : '' }}>
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
                                            @forelse ($doc as $item)
                                                <div
                                                    class="card-group col-12 col-md-6 col-lg-4 col-xl-3 small-card-date my-1">
                                                    <div class="card border-green">
                                                        <div class="card-body">
                                                            <div>
                                                                <label
                                                                    class="form-check-label text-start fs-5 textTitulo text-break mb-2"
                                                                    for="flexCheckDefault">
                                                                    <i class="fas fa-times-circle semaforo{{ $item->estatus }}"
                                                                        style="display: {{ $item->estatus != '0' ? ' none' : '' }};"></i>
                                                                    <i class="fa fa-exclamation-circle semaforo{{ $item->estatus }}"
                                                                        style="display: {{ $item->estatus != '1' ? ' none' : '' }};"
                                                                        title="Proximo a vencer"></i>
                                                                    <i class="fa fa-check-circle semaforo{{ $item->estatus }}"
                                                                        style="display: {{ $item->estatus != '2' ? ' none' : '' }};"></i>
                                                                    {{ ucwords(trans($item->nombre)) }}
                                                                </label>
                                                            </div>
                                                            @if ($item->ruta != null)
                                                                <div
                                                                    class="contIconosDocumentos d-flex flex-wrap align-items-end align-items-center">
                                                                    <input type="hidden"
                                                                        id='{{ $item->idDoc }}'
                                                                        name='archivo[{{ $count }}][idDoc]'
                                                                        value='{{ $item->idDoc }}'>
                                                                    <input type="hidden"
                                                                        id='{{ $item->nombre }}'
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
                                                                        onclick='handleDocumento("{{ $item->id }}","{{ $item->nombre }}","{{ true }}","{{ $item->ruta }}")'>
                                                                        <input class="mb-4" type="file"
                                                                            name='archivo[{{ $count }}][docs]'
                                                                            id='{{ $item->id }}'
                                                                            accept=".pdf"
                                                                            value="{{ $item->ruta }}">
                                                                        <div
                                                                            id='iconContainer{{ $item->id }}'>
                                                                            <lord-icon
                                                                                src="https://cdn.lordicon.com/nxaaasqe.json"
                                                                                trigger="hover"
                                                                                colors="primary:#86c716,secondary:#e8e230"
                                                                                stroke="65"
                                                                                style="width:50px;height:70px">
                                                                            </lord-icon>

                                                                        </div>
                                                                    </label>
                                                                    <a id='downloadButton{{ $item->id }}'
                                                                        class="btnViewDescargar btn btn-outline-success btnView"
                                                                        download
                                                                        href="{{ asset('/storage/accesorios/' . str_pad($accesorios->serie . $accesorios->id, 4, '0', STR_PAD_LEFT) . '/documentos/' . $item->nombre . '/' . $item->ruta) }}">
                                                                        <span class="btn-text">Descargar</span>
                                                                        <span class="icon">
                                                                            <i class="far fa-eye mt-2"></i>
                                                                        </span>
                                                                    </a>
                                                                    <button id='removeButton{{ $item->id }}'
                                                                        onclick='eliminarBotonera("{{ $item->id }}")'
                                                                        type="button"
                                                                        class="btnViewDelete btn btn-outline-danger btnView"
                                                                        style="width: 2.4em; height: 2.4em;"><i
                                                                            class="fa fa-times"></i></button>
                                                                    <!-- Botón Omitir -->
                                                                    <button id='omitirButton{{ $item->id }}'
                                                                        class="btnSinFondo float-end mt-3"
                                                                        style="margin-left: 20px" rel="tooltip"
                                                                        type="button"
                                                                        onclick='omitir("{{ $item->id }}","{{ $item->nombre }}")'>
                                                                        <P class="fs-5" style="display: none">
                                                                            Omitir</P>
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
                                                                                id='check{{ $item->id }}'
                                                                                checked style="font-size: 20px;"
                                                                                onchange='handleCheckboxChange("{{ $item->id }}")'>
                                                                            <!--<input type="hidden" class="form-check-input is-invalid align-self-end mb-2"  id='checkHidden{{ $item->id }}' value='false'> -->
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <input type="date"
                                                                                id='fecha{{ $item->id }}'
                                                                                class="inputCaja text-center"
                                                                                name='archivo[{{ $count }}][fecha]'
                                                                                style="display: block;"
                                                                                value="{{ $item->fechaVencimiento }}">
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <label
                                                                                class="text-start fs-5 textTitulo text-break mb-2"
                                                                                style="font-size: 18px !important; padding-top: 10px; padding-bottom: 5px; resize: horizontal !important;">Comentario:</label>
                                                                            <textarea id='comentario{{ $item->id }}' name='archivo[{{ $count }}][comentario]'
                                                                                class="form-control-textarea inputCaja" rows="2" maxlength="1000" placeholder="Escribe Un Comentario">{{ $item->comentarios }}</textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @else
                                                                <div
                                                                    class="contIconosDocumentos d-flex flex-wrap align-items-end align-items-center">
                                                                    <input type="hidden" id=''
                                                                        name='archivo[{{ $count }}][idDoc]'
                                                                        value='{{ $item->idDoc }}'>
                                                                    <input type="hidden"
                                                                        id='{{ $item->nombre }}'
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
                                                                            id='{{ $item->id }}'
                                                                            accept=".pdf"
                                                                            value="{{ $item->ruta }}">
                                                                        <div
                                                                            id='iconContainer{{ $item->id }}'>
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
                                                                                id='check{{ $item->id }}'
                                                                                checked
                                                                                style="font-size: 20px; visibility: hidden"
                                                                                onchange='handleCheckboxChange("{{ $item->id }}")'>
                                                                            <!--<input type="hidden" class="form-check-input is-invalid align-self-end mb-2"  id='checkHidden{{ $item->id }}' value='false'> -->
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <input type="date"
                                                                                id='fecha{{ $item->id }}'
                                                                                class="inputCaja text-center"
                                                                                name='archivo[{{ $count }}][fecha]'
                                                                                style="display: block;" disabled
                                                                                value="{{ $item->fechaVencimiento }}">
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <label
                                                                                class="text-start fs-5 textTitulo text-break mb-2"
                                                                                style="font-size: 18px !important; padding-top: 10px; padding-bottom: 5px; resize: horizontal !important;">Comentario:</label>
                                                                            <textarea id='comentario{{ $item->id }}' name='archivo[{{ $count }}][comentario]'
                                                                                class="form-control-textarea inputCaja" rows="2" maxlength="1000" placeholder="Escribe Un Comentario">{{ $item->comentarios }}</textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <script>
                                                    document.addEventListener('DOMContentLoaded', function() {
                                                        // Llamar a la función después de que la vista haya cargado completamente
                                                        evaluar({{ $item->id }}, {{ $item->requerido }});
                                                    });
                                                </script>
                                                @php
                                                    $count++;
                                                @endphp
                                            @empty
                                                Sin Registros
                                            @endforelse
                                        </div>
                                    </div>

                                    <div class="col-12 text-center mb-3 ">
                                        <button type="submit" class="btn botonGral"
                                            onclick="alertaGuardar()">Guardar</button>
                                    </div>
                                </div>
                                @endif
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
            let downloadButton = document.getElementById("downloadButton"+ id);
        let removeButton = document.getElementById("removeButton"+ id);
        downloadButton.style.display = "none";
        removeButton.style.display = "none";

        }
        
    }
</script>
