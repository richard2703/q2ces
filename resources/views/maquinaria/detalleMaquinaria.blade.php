@extends('layouts.main', ['activePage' => 'maquinaria', 'titlePage' => __('Detalle de Equipo')])
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
                <div class="col-11 align-self-center">
                    <div class="card col-12">


                        <div class="card-body contCart">
                            <form action="{{ route('maquinaria.update', $maquinaria->id) }}"
                                method="post"class="row alertaGuardar" enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="accordion my-3" id="accordionExample">

                                    <div class="accordion-item">
                                        <h2 class="accordion-header " id="headingOne">
                                            <button class="accordion-button bacTituloPrincipal" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#datosPersonales"
                                                aria-expanded="true" aria-controls="collapseOne">
                                                {{ $maquinaria->identificador }} {{ $maquinaria->nombre }}
                                            </button>
                                        </h2>
                                        <div id="datosPersonales" class="accordion-collapse collapse show"
                                            aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <div class="row mt-3">
                                                    <div class="col-12 col-lg-4  my-3">
                                                        <div class="row mb-5">

                                                            <div class="col-12 contFotoMaquinaria" id="visor">
                                                                <img src="{{ empty($fotos[0]) ? '/img/general/default.jpg' : asset('/storage/maquinaria/' . str_pad($maquinaria['identificador'], 4, '0', STR_PAD_LEFT) . '/' . $fotos[0]->ruta) }}"
                                                                    class="mx-auto d-block img-fluid imgMaquinaria">
                                                            </div>

                                                            <div class="col-12 my-3 d-flex justify-content-around"
                                                                id="selectores">
                                                                @forelse ($fotos as $foto)
                                                                    <img onclick="abre(this)"
                                                                        title="'{{ $maquinaria->nombre }}'."
                                                                        src="{{ asset('/storage/maquinaria/' . str_pad($maquinaria['identificador'], 4, '0', STR_PAD_LEFT) . '/' . $foto->ruta) }}"
                                                                        class="img-fluid ">
                                                                @empty
                                                                @endforelse

                                                            </div>
                                                            @if (count($fotos) <= 3)
                                                                <span class="mi-archivo"> <input class="mb-4 ver "
                                                                        type="file" name="ruta[]" id="mi-archivo"
                                                                        accept="image/*" multiple></span>
                                                                <label for="mi-archivo">
                                                                    <span class="">sube imagen</span>
                                                                </label>
                                                            @endif
                                                        </div>

                                                    </div>

                                                    <div class="col-12 col-lg-8">

                                                        <div class="row alin">
                                                            <div class=" col-12 col-sm-6  mb-3 ">
                                                                <label class="labelTitulo">Nombre:</label></br>
                                                                <input type="text" class="inputCaja" id="nombre"
                                                                    placeholder="Especifique..." required name="nombre"
                                                                    value="{{ $maquinaria->nombre }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6  mb-3 ">
                                                                <label class="labelTitulo">Marca:</label></br>
                                                                <input type="text" class="inputCaja" id="marca"
                                                                    placeholder="Especifique..." name="marca"
                                                                    value="{{ $maquinaria->marca }}">
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
                                                                <select class="form-select"
                                                                    aria-label="Default select example" id="categoria"
                                                                    required name="categoria">
                                                                    <option value="Accesorios"
                                                                        {{ $maquinaria->categoria == 'Accesorios' ? ' selected' : '' }}>
                                                                        Accesorios</option>
                                                                    <option value="Campers"
                                                                        {{ $maquinaria->categoria == 'Campers' ? ' selected' : '' }}>
                                                                        Campers</option>
                                                                    <option value="Cisterna"
                                                                        {{ $maquinaria->categoria == 'Cisterna' ? ' selected' : '' }}>
                                                                        Cisterna</option>
                                                                    <option value="Maquinaria ligera"
                                                                        {{ $maquinaria->categoria == 'Maquinaria ligera' ? ' selected' : '' }}>
                                                                        Maquinaria ligera</option>
                                                                    <option value="Maquinaria pesada"
                                                                        {{ $maquinaria->categoria == 'Maquinaria pesada' ? ' selected' : '' }}>
                                                                        Maquinaria pesada</option>
                                                                    <option value="Retroexcavadoras"
                                                                        {{ $maquinaria->categoria == 'Retroexcavadoras' ? ' selected' : '' }}>
                                                                        Retroexcavadoras</option>
                                                                    <option value="Tractocamiones"
                                                                        {{ $maquinaria->categoria == 'Tractocamiones' ? ' selected' : '' }}>
                                                                        Tractocamiones</option>
                                                                    <option value="Otros"
                                                                        {{ $maquinaria->categoria == 'Otros' ? ' selected' : '' }}>
                                                                        Otros</option>
                                                                    <option value="Utilitarios"
                                                                        {{ $maquinaria->categoria == 'Utilitarios' ? ' selected' : '' }}>
                                                                        Utilitarios</option>
                                                                </select>
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Uso:</label></br>
                                                                <select class="form-select"
                                                                    aria-label="Default select example" id="uso"
                                                                    name="uso">
                                                                    <option
                                                                        value="Mov. Tierras"{{ $maquinaria->uso == 'Mov. Tierras' ? ' selected' : '' }}>
                                                                        Mov. Tierras</option>
                                                                    <option
                                                                        value="Completo"{{ $maquinaria->uso == 'Completo' ? ' selected' : '' }}>
                                                                        Completo</option>
                                                                </select>
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <div class="row align-items-end">
                                                                    <div class="col-8">
                                                                        <label class="labelTitulo">Tipo:</label></br>
                                                                        <select class="form-select"
                                                                            aria-label="Default select example"
                                                                            id="tipo" name="tipo">
                                                                            <option
                                                                                value="Pesada"{{ $maquinaria->tipo == 'Pesada' ? ' selected' : '' }}>
                                                                                Pesada</option>
                                                                            <option
                                                                                value="Ligero"{{ $maquinaria->tipo == 'Ligero' ? ' selected' : '' }}>
                                                                                Ligero</option>
                                                                            <option
                                                                                value="Grua"{{ $maquinaria->tipo == 'Grua' ? ' selected' : '' }}>
                                                                                Grua</option>
                                                                            <option
                                                                                value="N/A"{{ $maquinaria->tipo == 'no_aplica' ? ' selected' : '' }}>
                                                                                N/A</option>
                                                                        </select>

                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Año:</label></br>
                                                                <input type="text" class="inputCaja" id="ano"
                                                                    maxlength="4" placeholder="Ej. 2000" name="ano"
                                                                    value="{{ $maquinaria->ano }}">
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
                                                                <label class="labelTitulo">Identificador:</label></br>
                                                                <input type="text" class="inputCaja"
                                                                    id="identificador" name="identificador"
                                                                    value="{{ $maquinaria->identificador }}"
                                                                    placeholder="ej: MT-00">
                                                            </div>

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
                                                                <label class="labelTitulo">Número Serie:</label></br>
                                                                <input type="text" class="inputCaja" id="numserie"
                                                                    placeholder="Ej. NS01234ABCD" name="numserie"
                                                                    value="{{ $maquinaria->numserie }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6  mb-3 ">
                                                                <label class="labelTitulo">Número VIN:</label></br>
                                                                <input type="text" class="inputCaja" id="vin"
                                                                    placeholder="Ej. 123456" name="vin"
                                                                    value="{{ $maquinaria->vin }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
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

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Combustible:</label></br>
                                                                <input type="text" class="inputCaja" id="combustible"
                                                                    name="combustible"
                                                                    placeholder="Diesel / Gasolina / Especificar"
                                                                    value="{{ $maquinaria->combustible }}">
                                                            </div>

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
                                                                <label class="labelTitulo">Filtro Aceite:</label></br>
                                                                <input type="number" class="inputCaja" id="filtroaceite"
                                                                    name="filtroaceite" placeholder="Cantidad"
                                                                    value="{{ $maquinaria->filtroaceite }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Filtro Aire:</label></br>
                                                                <input type="number" class="inputCaja" id="filtroaire"
                                                                    name="filtroaire" placeholder="Cantidad"
                                                                    value="{{ $maquinaria->filtroaire }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Bujías:</label></br>
                                                                <input type="number" class="inputCaja" id="bujias"
                                                                    placeholder="Cantidad" name="bujias"
                                                                    value="{{ $maquinaria->bujias }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Tipo de Bujías:</label></br>
                                                                <input type="text" class="inputCaja" id="tipobujia"
                                                                    placeholder="Especifique..." name="tipobujia"
                                                                    value="{{ $maquinaria->tipobujia }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Horómetro Inicial:</label></br>
                                                                <input type="number" class="inputCaja" id="horometro"
                                                                    name="horometro" placeholder="Numérico"
                                                                    value="{{ $maquinaria->horometro }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4   mb-3 ">
                                                                <div class="row align-items-end">
                                                                    <div class="col-7">
                                                                        <label class="labelTitulo">Kilometraje / Millaje
                                                                            Inicial:</label></br>
                                                                        <input type="number" class="inputCaja"
                                                                            id="kilometraje" name="kilometraje"
                                                                            placeholder="Numérico"
                                                                            value="{{ $maquinaria->kilometraje }}">

                                                                    </div>
                                                                    <div class="col-5">
                                                                        <select class="form-select"
                                                                            aria-label="Default select example"
                                                                            name="kom">
                                                                            <option
                                                                                value="Km"{{ $maquinaria->kom == 'Km' ? ' selected' : '' }}>
                                                                                Km</option>
                                                                            <option
                                                                                value="Ml"{{ $maquinaria->kom == 'Ml' ? ' selected' : '' }}>
                                                                                Ml</option>
                                                                        </select>

                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Uso como
                                                                    cisterna:</label></br>
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
                                                        </div>


                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="accordion-item">
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
                                                <div class="row">
                                                    <div class="col-12 text-right">
                                                        <a href="" data-bs-toggle="modal"
                                                            data-bs-target="#modal-documentos">
                                                            <button type="button" class="btn botonGral">Añadir
                                                                documento</button>

                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="row mt-3">

                                                    <!-- FACTURA -->
                                                    <div class="col-12 col-md-4 col-lg-3">
                                                        <div class="card h-99 contDocumentos ">
                                                            <div class="card-body m-2">
                                                                <div>
                                                                    <label
                                                                        class="form-check-label text-start fs-5 textTitulo text-break mb-2"
                                                                        for="flexCheckDefault">
                                                                        {{-- <i
                                                                            class="fa  {{ $docs->factura != null ? ' fa-check-circle semaforo3' : '  fa-times-circle semaforo2' }}"></i> --}}
                                                                        Factura
                                                                    </label>
                                                                </div>
                                                                <div
                                                                    class="contIconosDocumentos d-flex flex-wrap align-items-end">

                                                                    <label class="custom-file-upload">
                                                                        <ul>
                                                                            @forelse ($docs as $item)
                                                                                @if ($item->tipo == 'Factura')
                                                                                    <li>
                                                                                        <a href="{{ route('maquinaria.download', [$item->id, 'factura']) }}"
                                                                                            class=""
                                                                                            title="{{ $item->comentarios ? $item->comentarios : 'Sin comentarios' }}"
                                                                                            target="blank">{{ $item->created_at ? \Carbon\Carbon::parse($item->created_at)->format('Y-m-d') : 'Sin comentarios' }}
                                                                                            <lord-icon
                                                                                                src="https://cdn.lordicon.com/tyounuzx.json"
                                                                                                trigger="hover"
                                                                                                colors="primary:#86c716,secondary:#e8e230"
                                                                                                stroke="65"
                                                                                                style="width:35px;height:45px">
                                                                                            </lord-icon>
                                                                                        </a>
                                                                                    </li>
                                                                                @endif

                                                                            @empty
                                                                                <li>
                                                                                    <label>Sin documentos
                                                                                        registrados.</label>
                                                                                </li>
                                                                            @endforelse
                                                                        </ul>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- MANUAL DE USO -->
                                                    <div class="col-12 col-md-4 col-lg-3">
                                                        <div class="card contDocumentos">
                                                            <div class="card-body m-2">

                                                                <div>
                                                                    <label
                                                                        class="form-check-label text-start fs-5 textTitulo text-break mb-2"
                                                                        for="flexCheckDefault">
                                                                        {{-- <i
                                                                            class="fa {{ $docs->manual != null ? ' fa-check-circle semaforo3' : '  fa-times-circle semaforo2' }}"></i> --}}
                                                                        Manual de Uso
                                                                    </label>
                                                                </div>
                                                                <div
                                                                    class="contIconosDocumentos d-flex flex-wrap  align-items-end">
                                                                    <label class="custom-file-upload">
                                                                        <ul>
                                                                            @forelse ($docs as $item)
                                                                                @if ($item->tipo == 'Manual_de_Uso')
                                                                                    <li>
                                                                                        <a href="{{ route('maquinaria.download', [$item->id, 'factura']) }}"
                                                                                            class=""
                                                                                            title="{{ $item->comentarios ? $item->comentarios : 'Sin comentarios' }}"
                                                                                            target="blank">{{ $item->created_at ? \Carbon\Carbon::parse($item->created_at)->format('Y-m-d') : 'Sin comentarios' }}
                                                                                            <lord-icon
                                                                                                src="https://cdn.lordicon.com/tyounuzx.json"
                                                                                                trigger="hover"
                                                                                                colors="primary:#86c716,secondary:#e8e230"
                                                                                                stroke="65"
                                                                                                style="width:35px;height:45px">
                                                                                            </lord-icon>
                                                                                        </a>
                                                                                    </li>
                                                                                @endif

                                                                            @empty
                                                                                <li>
                                                                                    <label>Sin documentos
                                                                                        registrados.</label>
                                                                                </li>
                                                                            @endforelse
                                                                        </ul>
                                                                    </label>
                                                                </div>


                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- REGISTRO -->
                                                    <div class="col-12 col-md-4 col-lg-3">
                                                        <div class="card contDocumentos">
                                                            <div class="card-body m-2">

                                                                <div>
                                                                    <label
                                                                        class="form-check-label text-start fs-5 textTitulo text-break mb-2"
                                                                        for="flexCheckDefault">
                                                                        {{-- <i
                                                                            class="fa {{ $docs->registro != null ? ' fa-check-circle semaforo3' : '  fa-times-circle semaforo2' }}"></i> --}}
                                                                        Registro
                                                                    </label>

                                                                </div>
                                                                <div
                                                                    class="contIconosDocumentos d-flex flex-wrap  align-items-end">
                                                                    <label class="custom-file-upload">
                                                                        <ul>
                                                                            @forelse ($docs as $item)
                                                                                @if ($item->tipo == 'Registro')
                                                                                    <li>
                                                                                        <a href="{{ route('maquinaria.download', [$item->id, 'factura']) }}"
                                                                                            class=""
                                                                                            title="{{ $item->comentarios ? $item->comentarios : 'Sin comentarios' }}"
                                                                                            target="blank">{{ $item->created_at ? \Carbon\Carbon::parse($item->created_at)->format('Y-m-d') : 'Sin comentarios' }}
                                                                                            <lord-icon
                                                                                                src="https://cdn.lordicon.com/tyounuzx.json"
                                                                                                trigger="hover"
                                                                                                colors="primary:#86c716,secondary:#e8e230"
                                                                                                stroke="65"
                                                                                                style="width:35px;height:45px">
                                                                                            </lord-icon>
                                                                                        </a>
                                                                                    </li>
                                                                                @endif

                                                                            @empty
                                                                                <li>
                                                                                    <label>Sin documentos
                                                                                        registrados.</label>
                                                                                </li>
                                                                            @endforelse
                                                                        </ul>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- FICHA TECNICA DEL PROVEEDOR -->
                                                    <div class="col-12 col-md-4 col-lg-3">
                                                        <div class="card contDocumentos">
                                                            <div class="card-body m-2">

                                                                <div>
                                                                    <label
                                                                        class="form-check-label text-start fs-5 textTitulo text-break mb-2"
                                                                        for="flexCheckDefault">
                                                                        {{-- <i
                                                                            class="fa {{ $docs->ficha != null ? ' fa-check-circle semaforo3' : '  fa-times-circle semaforo2' }}"></i> --}}
                                                                        Ficha Técnica del Proveedor
                                                                    </label>
                                                                </div>
                                                                <div
                                                                    class="contIconosDocumentos d-flex flex-wrap  align-items-end">
                                                                    <label class="custom-file-upload">
                                                                        <ul>
                                                                            @forelse ($docs as $item)
                                                                                @if ($item->tipo == 'Ficha_Tecnica_del_Proveedor')
                                                                                    <li>
                                                                                        <a href="{{ route('maquinaria.download', [$item->id, 'factura']) }}"
                                                                                            class=""
                                                                                            title="{{ $item->comentarios ? $item->comentarios : 'Sin comentarios' }}"
                                                                                            target="blank">{{ $item->created_at ? \Carbon\Carbon::parse($item->created_at)->format('Y-m-d') : 'Sin comentarios' }}
                                                                                            <lord-icon
                                                                                                src="https://cdn.lordicon.com/tyounuzx.json"
                                                                                                trigger="hover"
                                                                                                colors="primary:#86c716,secondary:#e8e230"
                                                                                                stroke="65"
                                                                                                style="width:35px;height:45px">
                                                                                            </lord-icon>
                                                                                        </a>
                                                                                    </li>
                                                                                @endif

                                                                            @empty
                                                                                <li>
                                                                                    <label>Sin documentos
                                                                                        registrados.</label>
                                                                                </li>
                                                                            @endforelse
                                                                        </ul>
                                                                    </label>
                                                                </div>


                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- VERIFICACION -->
                                                    <div class="col-12 col-md-4 col-lg-3">
                                                        <div class="card h-99 contDocumentos">
                                                            <div class="card-body m-2">
                                                                <div>
                                                                    <label
                                                                        class="form-check-label text-start fs-5 textTitulo text-break mb-2"
                                                                        for="flexCheckDefault">
                                                                        {{-- <i
                                                                            class="fa {{ $docs->verificacion != null ? ' fa-check-circle semaforo3' : '  fa-times-circle semaforo2' }}"></i> --}}
                                                                        Verificación
                                                                    </label>
                                                                </div>
                                                                <div
                                                                    class="contIconosDocumentos d-flex flex-wrap  align-items-end">
                                                                    <label class="custom-file-upload">
                                                                        <ul>
                                                                            @forelse ($docs as $item)
                                                                                @if ($item->tipo == 'Verificacion')
                                                                                    <li>
                                                                                        <a href="{{ route('maquinaria.download', [$item->id, 'factura']) }}"
                                                                                            class=""
                                                                                            title="{{ $item->comentarios ? $item->comentarios : 'Sin comentarios' }}"
                                                                                            target="blank">{{ $item->created_at ? \Carbon\Carbon::parse($item->created_at)->format('Y-m-d') : 'Sin comentarios' }}
                                                                                            <lord-icon
                                                                                                src="https://cdn.lordicon.com/tyounuzx.json"
                                                                                                trigger="hover"
                                                                                                colors="primary:#86c716,secondary:#e8e230"
                                                                                                stroke="65"
                                                                                                style="width:35px;height:45px">
                                                                                            </lord-icon>
                                                                                        </a>
                                                                                    </li>
                                                                                @endif

                                                                            @empty
                                                                                <li>
                                                                                    <label>Sin documentos
                                                                                        registrados.</label>
                                                                                </li>
                                                                            @endforelse
                                                                        </ul>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- TARJETA DE CIRCULACION -->
                                                    <div class="col-12 col-md-4 col-lg-3">
                                                        <div class="card contDocumentos">
                                                            <div class="card-body m-2">

                                                                <div>
                                                                    <label
                                                                        class="form-check-label text-start fs-5 textTitulo text-break mb-2"
                                                                        for="flexCheckDefault">
                                                                        {{-- <i
                                                                            class="fa {{ $docs->circulacion != null ? ' fa-check-circle semaforo3' : '  fa-times-circle semaforo2' }}"></i> --}}
                                                                        Tarjeta de Circulación
                                                                    </label>
                                                                </div>
                                                                <div
                                                                    class="contIconosDocumentos d-flex flex-wrap  align-items-end">
                                                                    <label class="custom-file-upload">
                                                                        <ul>
                                                                            @forelse ($docs as $item)
                                                                                @if ($item->tipo == 'Tarjeta_Circulacion')
                                                                                    <li>
                                                                                        <a href="{{ route('maquinaria.download', [$item->id, 'factura']) }}"
                                                                                            class=""
                                                                                            title="{{ $item->comentarios ? $item->comentarios : 'Sin comentarios' }}"
                                                                                            target="blank">{{ $item->created_at ? \Carbon\Carbon::parse($item->created_at)->format('Y-m-d') : 'Sin comentarios' }}
                                                                                            <lord-icon
                                                                                                src="https://cdn.lordicon.com/tyounuzx.json"
                                                                                                trigger="hover"
                                                                                                colors="primary:#86c716,secondary:#e8e230"
                                                                                                stroke="65"
                                                                                                style="width:35px;height:45px">
                                                                                            </lord-icon>
                                                                                        </a>
                                                                                    </li>
                                                                                @endif

                                                                            @empty
                                                                                <li>
                                                                                    <label>Sin documentos
                                                                                        registrados.</label>
                                                                                </li>
                                                                            @endforelse
                                                                        </ul>
                                                                    </label>
                                                                </div>


                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- SEGUROS -->
                                                    <div class="col-12 col-md-4 col-lg-3">
                                                        <div class="card contDocumentos">
                                                            <div class="card-body m-2">

                                                                <div>
                                                                    <label
                                                                        class="form-check-label text-start fs-5 textTitulo text-break mb-2"
                                                                        for="flexCheckDefault">
                                                                        {{-- <i
                                                                            class="fa {{ $docs->seguro != null ? ' fa-check-circle semaforo3' : '  fa-times-circle semaforo2' }}"></i> --}}
                                                                        Seguros
                                                                    </label>

                                                                </div>
                                                                <div
                                                                    class="contIconosDocumentos d-flexflex-wrap   align-items-end">
                                                                    <label class="custom-file-upload">
                                                                        <ul>
                                                                            @forelse ($docs as $item)
                                                                                @if ($item->tipo == 'Seguros')
                                                                                    <li>
                                                                                        <a href="{{ route('maquinaria.download', [$item->id, 'factura']) }}"
                                                                                            class=""
                                                                                            title="{{ $item->comentarios ? $item->comentarios : 'Sin comentarios' }}"
                                                                                            target="blank">{{ $item->created_at ? \Carbon\Carbon::parse($item->created_at)->format('Y-m-d') : 'Sin comentarios' }}
                                                                                            <lord-icon
                                                                                                src="https://cdn.lordicon.com/tyounuzx.json"
                                                                                                trigger="hover"
                                                                                                colors="primary:#86c716,secondary:#e8e230"
                                                                                                stroke="65"
                                                                                                style="width:35px;height:45px">
                                                                                            </lord-icon>
                                                                                        </a>
                                                                                    </li>
                                                                                @endif

                                                                            @empty
                                                                                <li>
                                                                                    <label>Sin documentos
                                                                                        registrados.</label>
                                                                                </li>
                                                                            @endforelse
                                                                        </ul>
                                                                    </label>
                                                                </div>


                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- PERMISOS ESPECIALES -->
                                                    <div class="col-12 col-md-4 col-lg-3">
                                                        <div class="card contDocumentos">
                                                            <div class="card-body m-2">

                                                                <div>
                                                                    <label
                                                                        class="form-check-label text-start fs-5 textTitulo text-break mb-2"
                                                                        for="flexCheckDefault">
                                                                        {{-- <i
                                                                            class="fa {{ $docs->especial != null ? ' fa-check-circle semaforo3' : '  fa-times-circle semaforo2' }}"></i> --}}
                                                                        Permisos Especiales
                                                                    </label>

                                                                </div>
                                                                <div
                                                                    class="contIconosDocumentos d-flex flex-wrap  align-items-end">
                                                                    <label class="custom-file-upload">
                                                                        <ul>
                                                                            @forelse ($docs as $item)
                                                                                @if ($item->tipo == 'Permisos_Especiales')
                                                                                    <li>
                                                                                        <a href="{{ route('maquinaria.download', [$item->id, 'factura']) }}"
                                                                                            class=""
                                                                                            title="{{ $item->comentarios ? $item->comentarios : 'Sin comentarios' }}"
                                                                                            target="blank">
                                                                                            {{ $item->created_at ? \Carbon\Carbon::parse($item->created_at)->format('Y-m-d') : 'Sin comentarios' }}
                                                                                            <lord-icon
                                                                                                src="https://cdn.lordicon.com/tyounuzx.json"
                                                                                                trigger="hover"
                                                                                                colors="primary:#86c716,secondary:#e8e230"
                                                                                                stroke="65"
                                                                                                style="width:35px;height:45px">
                                                                                            </lord-icon>
                                                                                        </a>
                                                                                    </li>
                                                                                @endif

                                                                            @empty
                                                                                <li>
                                                                                    <label>Sin documentos
                                                                                        registrados.</label>
                                                                                </li>
                                                                            @endforelse
                                                                        </ul>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <!-- OTROS -->
                                                    <div class="col-12 col-md-4 col-lg-3">
                                                        <div class="card contDocumentos">
                                                            <div class="card-body m-2">

                                                                <div>
                                                                    <label
                                                                        class="form-check-label text-start fs-5 textTitulo text-break mb-2"
                                                                        for="flexCheckDefault">
                                                                        {{-- <i
                                                                            class="fa {{ $docs->especial != null ? ' fa-check-circle semaforo3' : '  fa-times-circle semaforo2' }}"></i> --}}
                                                                        OTROS
                                                                    </label>

                                                                </div>
                                                                <div
                                                                    class="contIconosDocumentos d-flex flex-wrap  align-items-end">
                                                                    <label class="custom-file-upload">
                                                                        <ul>
                                                                            @forelse ($docs as $item)
                                                                                @if ($item->tipo == 'Otros')
                                                                                    <li>
                                                                                        <a href="{{ route('maquinaria.download', [$item->id, 'factura']) }}"
                                                                                            class=""
                                                                                            title="{{ $item->comentarios ? $item->comentarios : 'Sin comentarios' }}"
                                                                                            target="blank">
                                                                                            {{ $item->created_at ? \Carbon\Carbon::parse($item->created_at)->format('Y-m-d') : 'Sin comentarios' }}
                                                                                            <lord-icon
                                                                                                src="https://cdn.lordicon.com/tyounuzx.json"
                                                                                                trigger="hover"
                                                                                                colors="primary:#86c716,secondary:#e8e230"
                                                                                                stroke="65"
                                                                                                style="width:35px;height:45px">
                                                                                            </lord-icon>
                                                                                        </a>
                                                                                        {{-- <a href="#" class=""
                                                                                            data-bs-toggle="modal"
                                                                                            data-bs-target="#modal-edit-documentos"
                                                                                            onclick="loadDocument(
                                                                                            '{{ $item->id }}'
                                                                                            ,'{{ $item->tipo }}'
                                                                                            ,'{{ $item->comentarios }}'
                                                                                            ,'{{ \Carbon\Carbon::parse($item->fechaVencimiento)->format('d/m/Y') }}'
                                                                                        )">
                                                                                            <svg xmlns="http://www.w3.org/2000/svg "
                                                                                                width="28"
                                                                                                height="28"
                                                                                                fill="currentColor"
                                                                                                class="bi bi-pencil accionesIconos"
                                                                                                viewBox="0 0 16 16">
                                                                                                <path
                                                                                                    d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                                                                                            </svg>
                                                                                        </a> --}}
                                                                                    </li>
                                                                                @endif

                                                                            @empty
                                                                                <li>
                                                                                    <label>Sin documentos
                                                                                        registrados.</label>
                                                                                </li>
                                                                            @endforelse
                                                                        </ul>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

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
                                                                    {{ $item->nombre }} </option>
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
                                        Edicion</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
                <h1 class="modal-title fs-5" id="exampleModalLabel">Subir documento</h1>
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

                <label class="labelTitulo mt-3">Archivo: <span>*</span></label></br>
                <input class="inputStyle d-block" type="file" name="ruta" id="ruta" accept=".pdf"
                    required>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn botonGral">Guardar</button>
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
                <input type="datetime" class="inputCaja" id="docFechaVencimiento" name="fechaVencimiento" pattern="\d{2}/\d{2}/\d{4}" placeholder="dd/mm/yyyy"
                    value="">

                <label class="labelTitulo mt-3">Comentarios:</label></br>
                <textarea class="col-12 inputCaja mb-3" id="docComentarios" name="comentarios" spellcheck="true"
                    placeholder="Descripción breve..."></textarea>

                {{-- <label class="labelTitulo mt-3">Archivo: <span>*</span></label></br>
                <input class="inputStyle d-block" type="file" name="ruta" id="ruta" accept=".pdf" required> --}}

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn botonGral">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function loadDocument(id, tipo, comentarios, fechaVencimiento) {
// alert(id);
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
