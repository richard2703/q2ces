@extends('layouts.main', ['activePage' => 'maquinaria', 'titlePage' => __('Detalle de Equipo')])
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
        <form action="{{ route('maquinaria.update', $maquinaria->id) }}" method="post"class="row alertaGuardar"
            enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="container-fluid mb-2">
                <div class="row justify-content-center">
                    <div class="col-12 align-self-center">

                        <div class="card">

                            <div class="card-body contCart">
                                <div class="p-1 align-self-start bacTituloPrincipal">
                                    <h6 class="my-3 ms-3 texticonos "> {{ $maquinaria->identificador }}
                                        {{ $maquinaria->nombre }}
                                    </h6>
                                </div>
                            </div>
                            <div class="d-flex p-3 divBorder">
                                <div class="col-4 text-left">
                                    <a href="{{ route('maquinaria.index') }}">
                                        <button class="btn regresar">
                                            <span class="material-icons">
                                                reply
                                            </span>
                                            Regresar
                                        </button>
                                    </a>
                                </div>
                                <div class="col-8 text-end">

                                    {{--  @can('asistencia_create')  --}}
                                    {{-- <a href="{{ route('maquinaria.update', $maquinaria->id) }}" method="get">
                                        <button class="btn botonGral">Asignar Equipo</button>
                                    </a>

                                    <a href="{{ route('maquinaria.update', $maquinaria->id) }}" method="get">
                                        <button class="btn botonGral">Asignar Uniforme</button>
                                    </a> --}}
                                    {{--  @endcan  --}}


                                </div>
                            </div>

                            <div class="d-md-flex p-3">
                                <div class="col-12 col-md-4 px-2 ">
                                    <div class="text-center mx-auto border  mb-4">

                                        <div class="col-12 contFotoMaquinaria" id="visor">
                                            <img src="{{ empty($fotos[0]) ? '/img/general/default.jpg' : asset('/storage/maquinaria/' . str_pad($maquinaria['identificador'], 4, '0', STR_PAD_LEFT) . '/' . $fotos[0]->ruta) }}"
                                                class="mx-auto d-block img-fluid imgMaquinaria">
                                        </div>

                                        <div class="col-12 my-3 d-flex justify-content-start" id="selectores">
                                            @forelse ($fotos as $foto)
                                                <img onclick="abre(this)" title="'{{ $maquinaria->nombre }}'."
                                                    src="{{ asset('/storage/maquinaria/' . str_pad($maquinaria['identificador'], 4, '0', STR_PAD_LEFT) . '/' . $foto->ruta) }}"
                                                    class="img-fluid mb-5" id="img{{ $foto->id }}"
                                                    style="margin-right:3px; z-index: 2">
                                                <div class="form-group" style="z-index: 9999 !important">
                                                    <div class="divButtonImage">
                                                        <button type="button" class="btn btn-secondary btn-sm buttonImage"
                                                            id="btnDelete{{ $foto->id }}"
                                                            onclick="esconde_div('{{ $foto->id }}','{{ $fotos }}', (this));">X</button>
                                                    </div>
                                                </div>
                                            @empty
                                            @endforelse
                                        </div>

                                        @php
                $numFotosCargadas = count($fotos);
                $maxNumFotos = 5;
                $numFotosPermitidas = $maxNumFotos - $numFotosCargadas;
            @endphp

            @if ($numFotosPermitidas > 0)
                <span class="mi-archivo">
                    <input class="mb-4 ver " type="file" name="ruta[]" id="mi-archivo" accept="image/*"
                        multiple data-max="{{ $numFotosPermitidas }}">
                </span>
                <label for="mi-archivo">
                    <span class="">Sube Imagen (Puedes subir hasta {{ $numFotosPermitidas }} más)</span>
                </label>
            @else
                <label for="mi-archivo" style="background-color: crimson; cursor: initial;">
                    <span class="">No puedes subir más imágenes, <br>ya has alcanzado el límite de 5.</span>
                </label>
            @endif
                                    </div>

                                    <input type="hidden" name="arrayFotosPersistente" id="arrayFotosPersistente"
                                        value="">
                                </div>
                                <div class="col-12 col-md-8 px-2">
                                    <div class="row alin">
                                        <div class=" col-12 col-sm-8 mb-3 ">
                                            <label class="labelTitulo">Equipo:</label></br>
                                            <input type="text" class="inputCaja" id="nombre"
                                                placeholder="Especifique..." required name="nombre"
                                                value="{{ $maquinaria->nombre }}">
                                        </div>


                                        <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                            <label class="labelTitulo">Marca:</label></br>
                                            <select id="marcaId" name="marcaId" class="form-select"
                                                aria-label="Default select example">
                                                <option value="">Seleccione</option>
                                                @foreach ($marcas as $item)
                                                    <option value="{{ $item->id }}"
                                                        {{ $item->id == $maquinaria->marcaId ? ' selected' : '' }}>
                                                        {{ $objValida->ucwords_accent($item->nombre) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                            <label class="labelTitulo">Modelo:</label></br>
                                            <input type="text" class="inputCaja" id="modelo"
                                                placeholder="Especifique..." name="modelo"
                                                value="{{ $maquinaria->modelo }}">
                                        </div>

                                        <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                            <label class="labelTitulo">Sub Marca:</label></br>
                                            <input type="text" class="inputCaja" id="submarca"
                                                placeholder="Especifique..." name="submarca"
                                                value="{{ $maquinaria->submarca }}">
                                        </div>

                                        <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                            <label class="labelTitulo">Categoría:</label></br>
                                            <select id="categoriaId" name="categoriaId" class="form-select"
                                                aria-label="Default select example">
                                                <option value="">Seleccione</option>
                                                @foreach ($categorias as $item)
                                                    <option value="{{ $item->id }}"
                                                        {{ $item->id == $maquinaria->categoriaId ? ' selected' : '' }}>
                                                        {{ $objValida->ucwords_accent($item->nombre) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                            <label class="labelTitulo">Uso:</label></br>
                                            <select class="form-select" aria-label="Default select example"
                                                id="uso" name="uso">
                                                <option
                                                    value="Mov. Tierras"{{ $maquinaria->uso == 'Mov. Tierras' ? ' selected' : '' }}>
                                                    Mov. Tierras</option>
                                                <option
                                                    value="Completo"{{ $maquinaria->uso == 'Completo' ? ' selected' : '' }}>
                                                    Completo</option>
                                                <option
                                                    value="Utilitario"{{ $maquinaria->uso == 'Utilitario' ? ' selected' : '' }}>
                                                    Utilitario</option>
                                            </select>
                                        </div>

                                        <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                            <div class="row align-items-end">
                                                <div class="pl-2">
                                                    <label class="labelTitulo">Tipo:</label></br>
                                                    <select id="tipoId" name="tipoId" class="form-select"
                                                        aria-label="Default select example">
                                                        <option value="">Seleccione</option>
                                                        @foreach ($tipos as $item)
                                                            <option value="{{ $item->id }}"
                                                                {{ $item->id == $maquinaria->tipoId ? ' selected' : '' }}>
                                                                {{ $objValida->ucwords_accent($item->nombre) }}
                                                            </option>
                                                        @endforeach
                                                    </select>

                                                </div>
                                            </div>
                                        </div>

                                        <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                            <label class="labelTitulo">Año:</label></br>
                                            <input type="text" class="inputCaja" id="ano" maxlength="4"
                                                placeholder="Ej. 2000" name="ano" value="{{ $maquinaria->ano }}">
                                        </div>

                                        <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                            <label class="labelTitulo">Color:</label></br>
                                            <input type="text" class="inputCaja" id="color"
                                                placeholder="Ej. Amarillo" name="color"
                                                value="{{ $maquinaria->color }}">
                                        </div>

                                        <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                            <label class="labelTitulo">Placas:</label></br>
                                            <input type="text" class="inputCaja" id="placas"
                                                placeholder="Ej. JAL-0000" name="placas"
                                                value="{{ $maquinaria->placas }}">
                                        </div>

                                        <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                            <label class="labelTitulo">Numero Económico:</label></br>
                                            <input type="text" class="inputCaja" id="identificador"
                                                name="identificador" value="{{ $maquinaria->identificador }}"
                                                placeholder="ej: MT-00">
                                        </div>

                                        {{-- <div class=" col-12 col-sm-12 mb-3 ">
                                            <label class="labelTitulo">Asignado en la Obra:</label></br>
                                            <select id="obraId" name="obraId" class="form-select"
                                                aria-label="Default select example">
                                                <option value="">Seleccione</option>
                                                @foreach ($vctObras as $item)
                                                    <option value="{{ $item->id }}"
                                                        {{ $item->id == $maquinaria->obraId ? ' selected' : '' }}>
                                                        {{ $item->nombre . ' [ '. $item->cliente . ' ] '  }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div> --}}
                                    </div>
                                    
                                </div>
                                
                            </div>
                            <div class="col-12 divBorder">
                                <h2 class="tituloEncabezado" style="margin-left: 10px">Asignaciones</h2>
                            </div>
                            <div class="row p-3 d-flex text-center">
                                <div class="col-12 mb-3">
                                    <p class="textTitulo my-2">Obra Asignada: @if (isset($obraMaqPer->nombre_obra))
                                        <a href="{{ route('obras.show', $obraMaqPer->id_obra) }}" style="color: blue; text-decoration: underline;">{{$obraMaqPer->nombre_obra}}</a>
                                    @else
                                        <span>Falta Agregar Bloque</span>
                                    @endif</p>
                                    <p class="textTitulo my-2">Personal Asignado: @if (isset($obraMaqPer->nombre_personal))
                                        
                                        <a href="{{ route('personal.ver', $obraMaqPer->id_personal) }}" style="color: blue; text-decoration: underline;">{{$obraMaqPer->nombre_personal}}</a>
                                    @else
                                        <span>Falta Agregar Bloque</span>
                                    @endif
                                    </p>
                                    <p class="textTitulo my-2">Fecha de Inicio: @if (isset($obraMaqPer->fechaInicio))
                                        <span>{{ \Carbon\Carbon::parse($obraMaqPer->fechaInicio)->toDateString() }}</span>
                                    @else
                                        <span>Falta Agregar Bloque</span>
                                    @endif
                                    </p>
                                </div>
                            </div>
                            
                        </div>
                        
                    </div>
                </div>
            </div>

            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-12 align-self-center">
                        <div class="card col-12">

                            <div class="card-body contCart">

                                <div class="accordion my-3" id="accordionExample">

                                    <div class="accordion-item" style="margin-top: -20px;">
                                        <h2 class="accordion-header " id="headingOne">
                                            <button class="accordion-button bacTituloPrincipal" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#datosPersonales"
                                                aria-expanded="true" aria-controls="collapseOne">
                                                Datos Generales
                                            </button>
                                        </h2>
                                        <div id="datosPersonales" class="accordion-collapse collapse show"
                                            aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <div class="row mt-3">

                                                    <div class="col-12 col-lg-12">
                                                        <div class="row alin">

                                                            <div class=" col-12 col-sm-6  mb-3 ">
                                                                <label class="labelTitulo">Motor:</label></br>
                                                                <input type="text" class="inputCaja" id="motor"
                                                                    placeholder="Especifique..." name="motor"
                                                                    value="{{ $maquinaria->motor }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6  mb-3 ">
                                                                <label class="labelTitulo">Número Motor:</label></br>
                                                                <input type="text" class="inputCaja" id="nummotor"
                                                                    placeholder="Ej. NUM0123ABCD" name="nummotor"
                                                                    value="{{ $maquinaria->nummotor }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6  mb-3 ">
                                                                <label class="labelTitulo">Número Serie -VIN:</label></br>
                                                                <input type="text" class="inputCaja" id="numserie"
                                                                    placeholder="Ej. NS01234ABCD" name="numserie"
                                                                    value="{{ $maquinaria->numserie }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 mb-3 ">
                                                                <label class="labelTitulo">Capacidad en kW:</label></br>
                                                                <input type="number" class="inputCaja" id="capacidad"
                                                                    placeholder="Capacidad" name="capacidad"
                                                                    value="{{ $maquinaria->capacidad }}" placeholder="">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Capacidad Tanque:</label></br>
                                                                <input type="number" class="inputCaja" id="tanque"
                                                                    placeholder="En litros" name="tanque"
                                                                    value="{{ $maquinaria->tanque }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Ejes:</label></br>
                                                                <input type="number" class="inputCaja" id="ejes"
                                                                    placeholder="Cantidad" name="ejes"
                                                                    value="{{ $maquinaria->ejes }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Rin Delantero:</label></br>
                                                                <input type="number" class="inputCaja" id="rinD"
                                                                    placeholder="Dimensiones" name="rinD"
                                                                    value="{{ $maquinaria->rinD }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Rin Trasero:</label></br>
                                                                <input type="number" class="inputCaja" id="rinT"
                                                                    placeholder="Dimensiones" name="rinT"
                                                                    value="{{ $maquinaria->rinT }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Llanta Delantera:</label></br>
                                                                <input type="number" class="inputCaja" id="llantaD"
                                                                    placeholder="Cantidad" name="llantaD"
                                                                    value="{{ $maquinaria->llantaD }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Llanta Trasera:</label></br>
                                                                <input type="number" class="inputCaja" id="llantaT"
                                                                    placeholder="Cantidad" name="llantaT"
                                                                    value="{{ $maquinaria->llantaT }}">
                                                            </div>

                                                            <div class="col-12 col-sm-6 col-lg-4 mb-3">
                                                                <label class="labelTitulo">Combustible*:</label></br>
                                                                <select class="form-select" id="combustible"
                                                                    name="combustible">
                                                                    <option value="">Seleccione</option>
                                                                    <option
                                                                        value="Diesel"{{ $maquinaria->combustible == 'Diesel' ? ' selected' : '' }}>
                                                                        Diesel</option>
                                                                    <option
                                                                        value="Gasolina"{{ $maquinaria->combustible == 'Gasolina' ? ' selected' : '' }}>
                                                                        Gasolina</option>
                                                                </select>
                                                            </div>

                                                            <!--<div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                                                                                                                <label class="labelTitulo">Combustible:</label></br>
                                                                                                                                                                <input type="text" class="inputCaja" id="combustible"
                                                                                                                                                                    name="combustible"
                                                                                                                                                                    placeholder="Diesel / Gasolina / Especificar"
                                                                                                                                                                    value="{{ $maquinaria->combustible }}">
                                                                                                                                                            </div>-->

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Aceite Motor:</label></br>
                                                                <input type="number" class="inputCaja" id="aceitemotor"
                                                                    placeholder="En litros" name="aceitemotor"
                                                                    value="{{ $maquinaria->aceitemotor }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Aceite Transmisión:</label></br>
                                                                <input type="number" class="inputCaja" id="aceitetras"
                                                                    placeholder="En litros" name="aceitetras"
                                                                    value="{{ $maquinaria->aceitetras }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Aceite Dirección:</label></br>
                                                                <input type="number" class="inputCaja" id="aceitedirec"
                                                                    placeholder="En litros" name="aceitedirec"
                                                                    value="{{ $maquinaria->aceitedirec }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Aceite Hidráulico:</label></br>
                                                                <input type="number" class="inputCaja"
                                                                    placeholder="En litros" name="aceitehidra"
                                                                    value="{{ $maquinaria->aceitehidra }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Uso Como
                                                                    Cisterna:</label></br>
                                                                <select class="form-select"
                                                                    aria-label="Default select example" id="cisterna"
                                                                    name="cisterna">
                                                                    <option value="0"
                                                                        {{ $maquinaria->cisterna == 0 ? ' selected' : '' }}>
                                                                        No</option>
                                                                    <option value="1"
                                                                        {{ $maquinaria->cisterna == 1 ? ' selected' : '' }}>
                                                                        Sí</option>
                                                                </select>
                                                            </div>

                                                            <div class="col-12 col-sm-6  mb-3">
                                                                <div class="row align-items-end">
                                                                    <label class="labelTitulo">Medición de Uso</label></br>
                                                                    <div
                                                                        class="col-6 col-md-6 col-lg-4 col-xl-7 inputNumberKilometraje">

                                                                        <input type="number" class="inputCaja"
                                                                            id="kilometraje" name="kilometraje"
                                                                            placeholder="Numérico"
                                                                            value="{{ $maquinaria->kilometraje }}">

                                                                    </div>
                                                                    <div class="col-6 col-md-6 col-lg-4 inputKilometraje">
                                                                        <select class="form-select"
                                                                            aria-label="Default select example"
                                                                            name="kom">
                                                                            <option value="Km"
                                                                                {{ $maquinaria->kom == 'Km' ? ' selected' : '' }}>
                                                                                Km</option>
                                                                            <option value="Ml"
                                                                                {{ $maquinaria->kom == 'MI' ? ' selected' : '' }}>
                                                                                Ml</option>
                                                                            <option value="Hr"
                                                                                {{ $maquinaria->kom == 'Hr' ? ' selected' : '' }}>
                                                                                Hr</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="d-flex p-3">
                                                        <div class="col-12" id="elementos">
                                                            <div class="d-flex">
                                                                <div class="col-6 divBorder">
                                                                    <h2 class="tituloEncabezado ">Refacciones</h2>
                                                                </div>

                                                                <div class="col-6 divBorder pb-3 text-end">
                                                                    <button type="button" class="btnVerde"
                                                                        onclick="crearItems()">
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            @forelse($refacciones as $refaccion)
                                                                <div class="row opcion divBorderItems" id="opc">
                                                                    <input type="hidden" name="idRefaccion[]"
                                                                        value="{{ $refaccion->id }}">
                                                                    <div class=" col-12 col-sm-6 col-lg-3 my-3 ">
                                                                        <label class="labelTitulo">Tipo de
                                                                            Refacción:</label></br>
                                                                        <select id="tipoRefaccion"
                                                                            name="tipoRefaccionId[]" class="form-select">
                                                                            <option value="">Seleccione</option>
                                                                            @foreach ($refaccionTipo as $item)
                                                                                <option value="{{ $item->id }}"
                                                                                    {{ $refaccion->tipoRefaccionId == $item->id ? 'selected' : '' }}>
                                                                                    {{ $objValida->ucwords_accent($item->nombre) }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>

                                                                    <div class=" col-12 col-sm-6 col-lg-3 my-3 ">
                                                                        <label class="labelTitulo">Marca:</label></br>
                                                                        <select id="marcaRefaccion" name="marca[]"
                                                                            class="form-select">
                                                                            <option value="">Seleccione</option>
                                                                            @foreach ($marcas as $item)
                                                                                <option value="{{ $item->id }}"
                                                                                    {{ $refaccion->marcaId == $item->id ? 'selected' : '' }}>
                                                                                    {{ $objValida->ucwords_accent($item->nombre) }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>

                                                                    <div class=" col-12 col-sm-6 col-lg-3 my-3 ">
                                                                        <label class="labelTitulo">Número de
                                                                            Parte:</label></br>
                                                                        <input type="text" class="inputCaja"
                                                                            id="numeroParte" placeholder="Especifique..."
                                                                            name="numeroParte[]"
                                                                            value="{{ $refaccion->numeroParte }}">
                                                                    </div>

                                                                    <div
                                                                        class="col-12 col-sm-4 col-lg-2 my-3 text-center pt-3">
                                                                        <!--<i class="fas fa-clipboard-check"></i>-->
                                                                        <!--<span class="material-icons" style="font-size:40px; color: gray">
                                                                                                                                                        content_paste_search
                                                                                                                                                    </span>-->
                                                                        @if ($refaccion->relacionInventarioId != null)
                                                                            <span class="material-icons"
                                                                                style="font-size:40px; color: green">
                                                                                assignment_turned_in
                                                                            </span>
                                                                        @else
                                                                            <span class="material-icons"
                                                                                style="font-size:40px; color: red">
                                                                                content_paste_off
                                                                            </span>
                                                                        @endif
                                                                        <!--<i class="fas fa-clipboard"></i>-->
                                                                    </div>

                                                                    <div class="col-lg-1 my-3 text-end">
                                                                        <button type="button" id="removeRow"
                                                                            class="btnRojo"></button>
                                                                    </div>

                                                                </div>
                                                            @empty
                                                                <div class="row opcion divBorderItems" id="opc">

                                                                    <input type="hidden" name="idRefaccion[]"
                                                                        value="">
                                                                    <div class=" col-12 col-sm-6 col-lg-3 my-3 ">
                                                                        <label class="labelTitulo">Tipo De
                                                                            Refacción:</label></br>
                                                                        <select id="tipoRefaccion"
                                                                            name='tipoRefaccionId[]' class="form-select">
                                                                            <option value="">Seleccione</option>
                                                                            @foreach ($refaccionTipo as $item)
                                                                                <option value="{{ $item->id }}">
                                                                                    {{ $objValida->ucwords_accent($item->nombre) }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>

                                                                    <div class=" col-12 col-sm-6 col-lg-3 my-3 ">
                                                                        <label class="labelTitulo">Marca:</label></br>
                                                                        <select id="marcaRefaccion" name='marca[]'
                                                                            class="form-select">
                                                                            <option value="">Seleccione</option>
                                                                            @foreach ($marcas as $item)
                                                                                <option value="{{ $item->id }}">
                                                                                    {{ $objValida->ucwords_accent($item->nombre) }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>

                                                                    <div class=" col-12 col-sm-6 col-lg-3 my-3 ">
                                                                        <label class="labelTitulo">Número De
                                                                            Parte:</label></br>
                                                                        <input type="text" class="inputCaja"
                                                                            name='numeroParte[]' id="numeroParte"
                                                                            placeholder="Especifique..." value="">
                                                                    </div>
                                                                    <div class="col-lg-2 my-3 text-center pt-3">
                                                                        <span class="material-icons"
                                                                            style="font-size:40px; color: gray">
                                                                            content_paste_search
                                                                        </span>
                                                                    </div>
                                                                    <div class="col-lg-1 my-3 text-end">
                                                                        <button type="button" id="removeRow"
                                                                            class="btnRojo"></button>
                                                                    </div>

                                                                </div>
                                                            @endforelse
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="accordion-item" id="AccordionSecondary">
                                        <h2 class="accordion-header" id="headingThree">
                                            <button class="accordion-button bacTituloPrincipal" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#documentos"
                                                aria-expanded="true" aria-controls="collapseOne">
                                                Documentos
                                            </button>
                                        </h2>
                                        <div id="documentos" class="accordion-collapse collapse"
                                            aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
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
                                                                                href="{{ asset('/storage/maquinaria/' . str_pad($maquinaria->identificador, 4, '0', STR_PAD_LEFT) . '/documentos/' . $item->nombre . '/' . $item->ruta) }}">
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
                                        </div>
                                    </div>
                                    {{--  estatus  --}}
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingThree">
                                            <button class="accordion-button bacTituloPrincipal" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#estatus" aria-expanded="true"
                                                aria-controls="collapseOne">
                                                Estatus
                                            </button>
                                        </h2>
                                        <div id="estatus" class="accordion-collapse collapse"
                                            aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <div class="row mt-3">

                                                    <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                        <label class="labelTitulo">Estatus:</label></br>

                                                        <select class="form-select" aria-label="Default select example"
                                                            id="estatusId" name="estatusId">
                                                            @foreach ($vctEstatus as $item)
                                                                <option value="{{ $item->id }}"
                                                                    {{ $item->id == $maquinaria->estatusId ? ' selected' : '' }}>
                                                                    {{ $objValida->ucwords_accent($item->nombre) }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 text-center mb-3 ">
                                    <button type="submit" class="btn botonGral" onclick="alertaGuardar()">Guardar
                                        Edición</button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </form>
    </div>

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
<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@accessible360/accessible-slick@1.0.1/slick/slick.min.js"></script>

<script>
    function abre(T) {
        var ruta = T.src.replace("/s90-Ic42/", "/s590-Ic42/");
        document.querySelector("#visor img").src = ruta;
    }
</script>

<!-- Modal -->
<div class="modal fade" id="modal-documentos" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="modal-documentos" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bacTituloPrincipal mb-3">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Subir Documento</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form class="col-11" action="{{ route('maquinaria.upload', $maquinaria->id) }}" method="post"
                enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="maquinariaId" id="maquinariaId" value="{{ $maquinaria->id }}">

                <label class="labelTitulo">Tipo de documento: <span>*</span></label></br>
                <select class="form-select" aria-label="Default select example" id="tipo" name="tipo"
                    required>
                    <option value="">Seleccione</option>
                    <option value="Factura">Factura</option>
                    <option value="Ficha_Tecnica_del_Proveedor">Ficha Técnica del Proveedor</option>
                    <option value="Manual_de_Uso">Manual de uso</option>
                    <option value="Otros">Otros</option>
                    <option value="Permisos_Especiales">Permisos Especiales</option>
                    <option value="Registro">Registro</option>
                    <option value="Seguros">Seguros</option>
                    <option value="Tarjeta_Circulacion">Tarjeta circulación</option>
                    <option value="Verificacion">Verificación</option>
                </select>

                <label class="labelTitulo">Fecha de vencimiento:</label></br>
                <input type="date" class="inputCaja" id="fechaVencimiento" name="fechaVencimiento"
                    value="">

                <label class="labelTitulo mt-3">Comentarios:</label></br>
                <textarea class="col-12 inputCaja mb-3" id="comentarios" name="comentarios" spellcheck="true"
                    placeholder="Descripción breve..."></textarea>

                <label class="labelTitulo mt-3">Archivo: <span>*</span></label><br>
                <input class="inputStyle d-block" type="file" name="ruta" id="ruta"
                    accept=".doc, .docx, .xls, .xlsx, .ppt, .pptx, .pdf, .txt, .csv, .rtf, .odt, .odp, .ods" required>


                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <!--<button type="submit" class="btn botonGral">Guardar</button>-->
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-edit-documentos" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="modal-edit-documentos" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bacTituloPrincipal mb-3">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Editar información del documento</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form class="col-11" action="{{ route('maquinaria.updateDocumento') }}" method="post"
                enctype="multipart/form-data">
                @csrf
                @method('put')
                <input type="hidden" name="id" id="docId" value="">
                <input type="hidden" name="maquinariaId" id="docMaquinariaId" value="">

                <label class="labelTitulo">Tipo de documento: <span>*</span></label></br>
                <select class="form-select" aria-label="Default select example" id="docTipo" name="tipo"
                    disabled>
                    <option value="">Seleccione</option>
                    <option value="Factura">Factura</option>
                    <option value="Ficha_Tecnica_del_Proveedor">Ficha Técnica del Proveedor</option>
                    <option value="Manual_de_Uso">Manual de uso</option>
                    <option value="Otros">Otros</option>
                    <option value="Permisos_Especiales">Permisos Especiales</option>
                    <option value="Registro">Registro</option>
                    <option value="Seguros">Seguros</option>
                    <option value="Tarjeta_Circulacion">Tarjeta circulación</option>
                    <option value="Verificacion">Verificación</option>
                </select>

                <label class="labelTitulo">Fecha de vencimiento:</label></br>
                <input type="datetime" class="inputCaja" id="docFechaVencimiento" name="fechaVencimiento"
                    pattern="\d{2}/\d{2}/\d{4}" placeholder="dd/mm/yyyy" value="">

                <label class="labelTitulo mt-3">Comentarios:</label></br>
                <textarea class="col-12 inputCaja mb-3" id="docComentarios" name="comentarios" spellcheck="true"
                    placeholder="Descripción breve..."></textarea>

                {{-- <label class="labelTitulo mt-3">Archivo: <span>*</span></label></br>
                <input class="inputStyle d-block" type="file" name="ruta" id="ruta" accept=".pdf" required> --}}

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <!--<button type="submit" class="btn botonGral">Guardar</button>-->
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    /* Macbook Pro / laptop */
    @media only screen and (min-width: 992px) and (max-width: 1440px) {

        /*ALta maquinaria*/
        .inputNumberKilometrajeEdit {
            width: 35%;
        }

        .inputKilometrajeEdit {
            width: 65%;
            font-size: 11px;
        }
    }
</style>

<script src="{{ asset('js/cardArchivos.js') }}"></script>

<script>
    function deleteImage(id, fotos, button) {
        console.log('ID de imagen', id);
        let jsonFotos = JSON.parse(fotos);
        console.log('Fotos', jsonFotos);
        var childDiv = document.getElementById('selectores').firstChild;

        //var parentDiv = button.parentNode.parentNode.parentNode;

        var childDiv = button.parentNode.parentNode.parentNode;

        // Modificar el selector para que coincida con la clase de la imagen
        var imageElement = childDiv.querySelector("img.img-fluid");
        var parentDivButton = button.parentNode.parentNode;
        var imageId = imageElement.id;
        console.log('imageElement', imageElement);

        // Cambiar la imagen que se muestra
        if (imageElement) {

        }
    }

    // Inicializar arrayFotosPersistente
    let arrayFotosPersistente = [];

    // Función para inicializar el arreglo persistente con el arreglo original
    // function inicializarArrayFotos(fotos) {
    //     arrayFotosPersistente = JSON.parse(fotos);
    //     console.log('HOLA',arrayFotosPersistente);
    // }

    function esconde_div(id, fotos, button) {

        console.log('fotos', fotos);
        let arrayFotos = JSON.parse(fotos);
        const index = arrayFotos.findIndex((foto) => foto.id == id);

        // Si se encontró el objeto con el id coincidente, eliminarlo del array
        if (index !== -1) {
            arrayFotosPersistente.push(arrayFotos[index]);

        } else {
            console.log('El id no se encontró en arrayFotosPersistente.');
        }
        console.log('arrayFotosPersistente', arrayFotosPersistente);
        var parentDiv = button.parentNode.parentNode.parentNode;
        // Modificar el selector para que coincida con la clase de la imagen
        var imageElement = parentDiv.querySelector("img.img-fluid");
        var deleteButton = document.getElementById('btnDelete' + id);
        var imageElement = document.getElementById("img" + id);


        // Ocultar el elemento padre
        imageElement.style.visibility = "hidden";
        deleteButton.style.visibility = "hidden";

        const arrayFotosPersistenteHidden = document.getElementById('arrayFotosPersistente');
        arrayFotosPersistenteHidden.value = JSON.stringify(arrayFotosPersistente);
    }
    // $.ajax({
    //     type: 'put',
    //     url: '/maquinaria/imagen/delete',
    //     data: {
    //         "_token": "{{ csrf_token() }}",
    //         "id": id
    //     },
    //     success: function(data) {
    //         console.log('Funciona');
    //     },
    //     error: function() {
    //         console.log('Error');
    //     }
    // });

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

        }
    }
</script>

<script>
    function crearItems() {
        var newOpcion = $('.opcion:first').clone();
        newOpcion.find("select, input").val(""); // Establece los valores en blanco
        newOpcion.find(".material-icons").text("content_paste_search").css("color",
            "gray"); // Establece el ícono y el color
        newOpcion.appendTo('#elementos');
    }

    // Borrar registro
    $(document).on('click', '#removeRow', function() {
        if ($('.opcion').length > 1) {
            $(this).closest('.opcion').remove();
        }
    });
</script>
<script>
    function fakeSave() {
        console.log('arrayFotosPersistente', arrayFotosPersistente);
    }
</script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        document.getElementById('mi-archivo').addEventListener('change', function () {
            var input = this;
            var maxAllowed = parseInt(input.getAttribute('data-max'));
            
            if (input.files.length > maxAllowed) {
                input.value = "";
                Swal.fire({
                    icon: 'error',
                    title: 'Error...',
                    text: '5 imagenes es el maximo permitido ',
                })
                
            }
        });
    });
</script>


{{-- <!-- Modal -->
<div class="modal fade" id="agregaTipo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agrega un nuevo tipo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div> --}}
