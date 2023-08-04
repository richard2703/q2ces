@extends('layouts.main', ['activePage' => 'maquinaria', 'titlePage' => __('Ver Equipos')])
@section('content')
    <!--<div class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-10 align-self-center">
                    <div class="card">
                        <div class="card-body contCart">
                            <div class="p-1 align-self-start bacTituloPrincipal">     
                                <h2 class="my-3 ms-3 texticonos ">Ver Equipos</h2>   
                            </div> 
                            
                            <div class="col-10  mx-auto d-block my-4">   
                                <div class="row d-flex ">
                                    <div class="col-10 col-md-5  mx-auto d-block my-4 ">
                                        <div class="row d-flex border">
                                                <div class="col-4 text-center colIcono p-2">
                                                    <img src="{{ asset('img/equipos/maquinariaPesada.svg') }}" class="mx-auto d-block" width="65%">
                                                </div>
                                                <div class="col-8  p-2">
                                                    <h2 class="text-start fs-5 textTitulo">Maquinaria Pesada</h2>
                                                    <ul>
                                                        <a class="textEquipo" href="{{ url('detalleEquipo', session('id')) }}"><li class="text-start my-3">Retroexcavadora</li></a>
                                                        <a class="textEquipo" href="#"><li class="text-start my-3">Camión de Volteo</li></a>
                                                        <a class="textEquipo" href="#"><li class="text-start my-3">Pipa de Agua</li></a>
                                                        <a class="textEquipo" href="#"><li class="text-start my-3">Camión Orquesta</li></a>
                                                    </ul>
                                                    
                                                </div>
                                        </div>
                                    </div>

                                    <div class="col-10 col-md-5  mx-auto d-block my-4 ">
                                        <div class="row d-flex border">
                                                <div class="col-4 text-center colIcono p-2">
                                                    <img src="{{ asset('img/equipos/maquinariaLigera.svg') }}" class="mx-auto d-block" width="65%" >
                                                </div>
                                                <div class="col-8  p-2">
                                                    <h2 class="text-start fs-5 textTitulo">Maquinaria Ligera</h2>
                                                    <ul>
                                                        <a class="textEquipo" href="#"><li class="text-start my-3">Rodillo</li></a>
                                                        <a class="textEquipo" href="#"><li class="text-start my-3">Bobcat</li></a>
                                                        <a class="textEquipo" href="#"><li class="text-start my-3">Torre de Luz</li></a>                                                       
                                                    </ul>
                                                    
                                                </div>
                                        </div>
                                    </div>

                                    <div class="col-10 col-md-5  mx-auto d-block my-4">
                                        <div class="row d-flex border">
                                                <div class="col-4 text-center colIcono p-2">
                                                    <img src="{{ asset('img/equipos/gruas.svg') }}" class="mx-auto d-block"width="65%">
                                                </div>
                                                <div class="col-8  p-2">
                                                    <h2 class="text-start fs-5 textTitulo">Grúas</h2>
                                                    <ul>
                                                        <a class="textEquipo" href="#"><li class="text-start my-3">Grúa 1</li></a>
                                                        <a class="textEquipo" href="#"><li class="text-start my-3">Grúa 2</li></a>
                                                        <a class="textEquipo"  href="#"><li class="text-start my-3">Grúa 3</li></a>
                                                        <a class="textEquipo" href="#"><li class="text-start my-3">Grúa 4</li></a>
                                                    </ul>
                                                    
                                                </div>
                                        </div>
                                    </div>

                                    <div class="col-10 col-md-5  mx-auto d-block my-4">
                                        <div class="row d-flex border">
                                                <div class="col-4 text-center colIcono p-2">
                                                    <img src="{{ asset('img/equipos/accesorios.svg') }}" class="mx-auto d-block" width="70%" >
                                                </div>
                                                <div class="col-8  p-2">
                                                    <h2 class="text-start fs-5 textTitulo">Accesorios</h2>
                                                    <ul>
                                                        <a class="textEquipo" href="#"><li class="text-start my-3">Accesorio 1</li></a>
                                                        <a class="textEquipo" href="#"><li class="text-start my-3">Accesorio 2</li></a>
                                                        <a class="textEquipo" href="#"><li class="text-start my-3">Accesorio 3</li></a>
                                                        <a class="textEquipo"  href="#"><li class="text-start my-3">Accesorio 4</li></a>
                                                    </ul>
                                                    
                                                </div>
                                        </div>
                                    </div>   
                                </div>
                            </div>   
                            
                        </div>   
                    </div>
                </div>
            </div>
        </div>
    </div>-->
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

        <div class="container-fluid mb-2">
            <div class="row justify-content-center">
                <div class="col-12 align-self-center">
                    <div class="col-12">

                        <div class="card-body contCart">
                            <div class="text-left">
                                <a href="{{ route('maquinaria.index') }}">
                                    <button class="btn regresar">
                                        <span class="material-icons">
                                            reply
                                        </span>
                                        Regresar
                                    </button>
                                </a>

                                <div class="col-8 text-end">
                                </div>
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
                            <form action="{{ route('maquinaria.update', $maquinaria->id) }}"
                                method="post"class="row alertaGuardar" enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="accordion my-3" id="accordionExample">

                                    <div class="accordion-item" style="margin-top: -20px;">
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
                                                                        class="img-fluid mb-5" id="{{ $foto->id }}"
                                                                        style="margin-right:-20px;">
                                                                    <div class="form-group">
                                                                        <div class="col-md-8">
                                                                            <!--<button type="button" class="btn btn-secondary btn-sm buttonImage" onclick="esconde_div('{{ $foto->id }}','{{ $fotos }}', (this));">X</button>-->
                                                                        </div>
                                                                    </div>
                                                                @empty
                                                                @endforelse
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="col-12 col-lg-8">
                                                        <div class="row alin">
                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Equipo:</label></br>
                                                                <input type="text" class="inputCaja" id="nombre"
                                                                    placeholder="Especifique..." required name="nombre"
                                                                    value="{{ $maquinaria->nombre }}" disabled>
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 my-3 ">
                                                                <label class="labelTitulo">Bitácora:</label></br>
                                                                <select id="bitacoraId" name="bitacoraId" disabled
                                                                    class="form-select" aria-label="Default select example">
                                                                    <option value="">Seleccione</option>
                                                                    @foreach ($bitacora as $item)
                                                                        <option value="{{ $item->id }}"
                                                                            {{ $item->id == $maquinaria->bitacoraId ? ' selected' : '' }}>
                                                                            {{ $item->nombre }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Marca:</label></br>
                                                                <input type="text" class="inputCaja" id="marca"
                                                                    placeholder="Especifique..." name="marca"
                                                                    value="{{ $maquinaria->marca }}" disabled>
                                                            </div>


                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Modelo:</label></br>
                                                                <input type="text" class="inputCaja" id="modelo"
                                                                    placeholder="Especifique..." name="modelo"
                                                                    value="{{ $maquinaria->modelo }}" disabled>
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Sub Marca:</label></br>
                                                                <input type="text" class="inputCaja" id="submarca"
                                                                    placeholder="Especifique..." name="submarca"
                                                                    value="{{ $maquinaria->submarca }}" disabled>
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Categoría:</label></br>
                                                                <select class="form-select" disabled
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
                                                                <select class="form-select" disabled
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
                                                                    <div class="pl-2">
                                                                        <label class="labelTitulo">Tipo:</label></br>
                                                                        <select class="form-select" disabled
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
                                                                                Grúa</option>
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
                                                                    value="{{ $maquinaria->ano }}" disabled>
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Color:</label></br>
                                                                <input type="text" class="inputCaja" id="color"
                                                                    placeholder="Ej. Amarillo" name="color"
                                                                    value="{{ $maquinaria->color }}" disabled>
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Placas:</label></br>
                                                                <input type="text" class="inputCaja" id="placas"
                                                                    placeholder="Ej. JAL-0000" name="placas"
                                                                    value="{{ $maquinaria->placas }}" disabled>
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Identificador:</label></br>
                                                                <input type="text" class="inputCaja"
                                                                    id="identificador" name="identificador"
                                                                    value="{{ $maquinaria->identificador }}"
                                                                    placeholder="ej: MT-00" disabled>
                                                            </div>

                                                            <div class=" col-12 col-sm-6  mb-3 ">
                                                                <label class="labelTitulo">Motor:</label></br>
                                                                <input type="text" class="inputCaja" id="motor"
                                                                    placeholder="Especifique..." name="motor"
                                                                    value="{{ $maquinaria->motor }}" disabled>
                                                            </div>

                                                            <div class=" col-12 col-sm-6  mb-3 ">
                                                                <label class="labelTitulo">Número Motor:</label></br>
                                                                <input type="text" class="inputCaja" id="nummotor"
                                                                    placeholder="Ej. NUM0123ABCD" name="nummotor"
                                                                    value="{{ $maquinaria->nummotor }}" disabled>
                                                            </div>

                                                            <div class=" col-12 col-sm-6  mb-3 ">
                                                                <label class="labelTitulo">Número Serie -VIN:</label></br>
                                                                <input type="text" class="inputCaja" id="numserie"
                                                                    placeholder="Ej. NS01234ABCD" name="numserie"
                                                                    value="{{ $maquinaria->numserie }}" disabled>
                                                            </div>

                                                            <div class=" col-12 col-sm-6 mb-3 ">
                                                                <label class="labelTitulo">Capacidad En KW:</label></br>
                                                                <input type="number" class="inputCaja" id="capacidad"
                                                                    placeholder="Capacidad" name="capacidad"
                                                                    value="{{ $maquinaria->capacidad }}" placeholder="" disabled>
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Capacidad Tanque:</label></br>
                                                                <input type="number" class="inputCaja" id="tanque"
                                                                    placeholder="En litros" name="tanque"
                                                                    value="{{ $maquinaria->tanque }}" disabled>
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Ejes:</label></br>
                                                                <input type="number" class="inputCaja" id="ejes"
                                                                    placeholder="Cantidad" name="ejes"
                                                                    value="{{ $maquinaria->ejes }}" disabled>
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Rin Delantero:</label></br>
                                                                <input type="number" class="inputCaja" id="rinD"
                                                                    placeholder="Dimensiones" name="rinD"
                                                                    value="{{ $maquinaria->rinD }}" disabled>
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Rin Trasero:</label></br>
                                                                <input type="number" class="inputCaja" id="rinT"
                                                                    placeholder="Dimensiones" name="rinT"
                                                                    value="{{ $maquinaria->rinT }}" disabled>
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Llanta Delantera:</label></br>
                                                                <input type="number" class="inputCaja" id="llantaD"
                                                                    placeholder="Cantidad" name="llantaD"
                                                                    value="{{ $maquinaria->llantaD }}" disabled>
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Llanta Trasera:</label></br>
                                                                <input type="number" class="inputCaja" id="llantaT"
                                                                    placeholder="Cantidad" name="llantaT"
                                                                    value="{{ $maquinaria->llantaT }}" disabled>
                                                            </div>

                                                            <div class="col-12 col-sm-6 col-lg-4 mb-3">
                                                                <label class="labelTitulo">Combustible*:</label></br>
                                                                <select class="form-select" id="combustible" disabled
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
                                                                    value="{{ $maquinaria->aceitemotor }}" disabled>
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Aceite Transmisión:</label></br>
                                                                <input type="number" class="inputCaja" id="aceitetras"
                                                                    placeholder="En litros" name="aceitetras"
                                                                    value="{{ $maquinaria->aceitetras }}" disabled>
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Aceite Dirección:</label></br>
                                                                <input type="number" class="inputCaja" id="aceitedirec"
                                                                    placeholder="En litros" name="aceitedirec"
                                                                    value="{{ $maquinaria->aceitedirec }}" disabled>
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Aceite Hidráulico:</label></br>
                                                                <input type="number" class="inputCaja"
                                                                    placeholder="En litros" name="aceitehidra"
                                                                    value="{{ $maquinaria->aceitehidra }}" disabled>
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Horómetro Inicial:</label></br>
                                                                <input type="number" class="inputCaja" id="horometro"
                                                                    name="horometro" placeholder="Numérico"
                                                                    value="{{ $maquinaria->horometro }}" disabled>
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Uso Como
                                                                    Cisterna:</label></br>
                                                                <select class="form-select" disabled
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

                                                            <div class=" col-12 col-sm-6 col-lg-4   mb-3 ">
                                                                <div class="row align-items-end">
                                                                    <label class="labelTitulo">Kilometraje / Millaje
                                                                        Inicial:</label></br>
                                                                    <div class="col-7 inputNumberKilometrajeEdit">

                                                                        <input type="number" class="inputCaja"
                                                                            id="kilometraje" name="kilometraje"
                                                                            placeholder="Numérico"
                                                                            value="{{ $maquinaria->kilometraje }}" disabled>

                                                                    </div>
                                                                    <div class="col-5 inputKilometrajeEdit">
                                                                        <select class="form-select" disabled
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
                                                        </div>

                                                    </div>
                                                    <div class="d-flex p-3">
                                                        <div class="col-12" id="elementos">
                                                            <div class="d-flex">
                                                                <div class="col-6 divBorder">
                                                                    <h2 class="tituloEncabezado ">Refacciones</h2>
                                                                </div>
                                                                
                                                                <div class="col-6 divBorder pb-3 text-end">
                                                                    <button type="button" class="btnVerde">
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            @forelse($refacciones as $refaccion)
                                                            <div class="row opcion divBorderItems" id="opc">
                                                                <input type="hidden" name="idRefaccion[]" value="{{$refaccion->id}}">
                                                                <div class=" col-12 col-sm-6 col-lg-3 my-3 ">
                                                                    <label class="labelTitulo">Tipo De
                                                                        Refacción:</label></br>
                                                                    <select id="tipoRefaccion" name="tipoRefaccionId[]" disabled
                                                                        class="form-select">
                                                                        <option value="">Seleccione</option>
                                                                        @foreach ($refaccionTipo as $item)
                                                                            <option value="{{ $item->id }}" {{ $refaccion->tipoRefaccionId == $item->id ? 'selected' : '' }}>
                                                                                {{ $item->nombre }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>

                                                                <div class=" col-12 col-sm-6 col-lg-3 my-3 ">
                                                                <label class="labelTitulo">Marca:</label></br>
                                                                <select id="marcaRefaccion" name="marcaId[]" disabled
                                                                    class="form-select">
                                                                    <option value="">Seleccione</option>
                                                                    @foreach ($marcas as $item)
                                                                        <option value="{{ $item->id }}" {{ $refaccion->marcaId == $item->id ? 'selected' : '' }}>
                                                                            {{ $item->nombre }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                                </div>

                                                                <div class=" col-12 col-sm-6 col-lg-3 my-3 ">
                                                                    <label class="labelTitulo">Número De
                                                                        Parte:</label></br>
                                                                    <input type="text" class="inputCaja" disabled
                                                                        id="numeroParte" placeholder="Especifique..."
                                                                        name="numeroParte[]" value="{{$refaccion->numeroParte}}">
                                                                </div>

                                                                <div class="col-12 col-sm-4 col-lg-2 my-3 text-center pt-3">
                                                                    <!--<i class="fas fa-clipboard-check"></i>-->
                                                                    <!--<span class="material-icons" style="font-size:40px; color: gray">
                                                                        content_paste_search
                                                                    </span>-->
                                                                    @if ($refaccion->relacionInventarioId != null)
                                                                    <span class="material-icons" style="font-size:40px; color: green">
                                                                        assignment_turned_in
                                                                    </span>
                                                                    @else
                                                                    <span class="material-icons" style="font-size:40px; color: red">
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
                                                                Sin Refacciones
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
                                                                            {{ ucwords(trans($item->nombre)) }} </label>
                                                                    </div>
                                                                    @if ($item->ruta != null)
                                                                        <div
                                                                            class="contIconosDocumentos d-flex flex-wrap align-items-end align-items-center">
                                                                            <input type="hidden" disabled
                                                                                id='{{ $item->idDoc }}'
                                                                                name='archivo[{{ $count }}][idDoc]'
                                                                                value='{{ $item->idDoc }}'>
                                                                            <input type="hidden" disabled
                                                                                id='{{ $item->nombre }}'
                                                                                name='archivo[{{ $count }}][tipoDocs]'
                                                                                value='{{ $item->id }}'>
                                                                            <input type="hidden" disabled
                                                                                id='nombre{{ $item->nombre }}'
                                                                                name='archivo[{{ $count }}][tipoDocsNombre]'
                                                                                value='{{ $item->nombre }}'>
                                                                            <input type="hidden" disabled
                                                                                id='omitido{{ $item->id }}'
                                                                                name='archivo[{{ $count }}][omitido]'
                                                                                value='0'>
                                                                            <label class="custom-file-upload"
                                                                                onclick='handleDocumento("{{ $item->id }}","{{ $item->nombre }}","{{ true }}","{{ $item->ruta }}")'>
                                                                                <input class="mb-4" type="file" disabled
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
                                                                            <button id='removeButton{{ $item->id }}' disabled
                                                                                onclick='eliminarBotonera("{{ $item->id }}")'
                                                                                type="button"
                                                                                class="btnViewDelete btn btn-outline-danger btnView"
                                                                                style="width: 2.4em; height: 2.4em;"><i
                                                                                    class="fa fa-times"></i></button>
                                                                            <!-- Botón Omitir -->
                                                                            <button id='omitirButton{{ $item->id }}' disabled
                                                                                class="btnSinFondo float-end mt-3"
                                                                                style="margin-left: 20px" rel="tooltip"
                                                                                type="button"
                                                                                onclick='omitir("{{ $item->id }}","{{ $item->nombre }}")'>
                                                                                <P class="fs-5" style="display: none">
                                                                                    Omitir</P>
                                                                            </button>
                                                                            <button
                                                                                id='cancelarOmitirButton{{ $item->id }}' disabled
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
                                                                                        class="form-check-input is-invalid align-self-end mb-2" disabled
                                                                                        type="checkbox"
                                                                                        name='archivo[{{ $count }}][check]'
                                                                                        id='check{{ $item->id }}'
                                                                                        checked style="font-size: 20px;"
                                                                                        onchange='handleCheckboxChange("{{ $item->id }}")'>
                                                                                    <!--<input type="hidden" class="form-check-input is-invalid align-self-end mb-2"  id='checkHidden{{ $item->id }}' value='false'> -->
                                                                                </div>
                                                                                <div class="col-12">
                                                                                    <input type="date" disabled
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
                                                                                    <textarea id='comentario{{ $item->id }}' disabled name='archivo[{{ $count }}][comentario]' style="resize:none !important;"
                                                                                        class="form-control-textarea inputCaja" rows="2" maxlength="1000" placeholder="Escribe Un Comentario">{{ $item->comentarios }}</textarea>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @else
                                                                        <div
                                                                            class="contIconosDocumentos d-flex flex-wrap align-items-end align-items-center">
                                                                            <input type="hidden" disabled
                                                                                id='{{ $item->idDoc }}'
                                                                                name='archivo[{{ $count }}][idDoc]'
                                                                                value='{{ $item->idDoc }}'>
                                                                            <input type="hidden" disabled
                                                                                id='{{ $item->nombre }}'
                                                                                name='archivo[{{ $count }}][tipoDocs]'
                                                                                value='{{ $item->id }}'>
                                                                            <input type="hidden" disabled
                                                                                id='nombre{{ $item->nombre }}'
                                                                                name='archivo[{{ $count }}][tipoDocsNombre]'
                                                                                value='{{ $item->nombre }}'>
                                                                            <input type="hidden" disabled
                                                                                id='omitido{{ $item->id }}'
                                                                                name='archivo[{{ $count }}][omitido]'
                                                                                value='0'>
                                                                            <label class="custom-file-upload"
                                                                                onclick='handleDocumento("{{ $item->id }}","{{ $item->nombre }}")'>
                                                                                <input class="mb-4" type="file" disabled
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
                                                                            <button id='removeButton{{ $item->id }}' disabled
                                                                                type="button"
                                                                                class="btnViewDelete btn btn-outline-danger btnView"
                                                                                style="width: 2.4em; height: 2.4em; display: none;"><i
                                                                                    class="fa fa-times"></i></button>
                                                                            <!-- Botón Omitir -->
                                                                            <button id='omitirButton{{ $item->id }}' disabled
                                                                                class="btnSinFondo float-end mt-3"
                                                                                style="margin-left: 20px" rel="tooltip"
                                                                                type="button"
                                                                                onclick='omitir("{{ $item->id }}","{{ $item->nombre }}")'>
                                                                                <P class="fs-5"> Omitir</P>
                                                                            </button>
                                                                            <button
                                                                                id='cancelarOmitirButton{{ $item->id }}' disabled
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
                                                                                        class="form-check-input is-invalid align-self-end mb-2" disabled
                                                                                        type="checkbox"
                                                                                        name='archivo[{{ $count }}][check]'
                                                                                        id='check{{ $item->id }}'
                                                                                        checked
                                                                                        style="font-size: 20px; visibility: hidden"
                                                                                        onchange='handleCheckboxChange("{{ $item->id }}")'>
                                                                                    <!--<input type="hidden" class="form-check-input is-invalid align-self-end mb-2"  id='checkHidden{{ $item->id }}' value='false'> -->
                                                                                </div>
                                                                                <div class="col-12">
                                                                                    <input type="date" disabled
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
                                                                                    <textarea id='comentario{{ $item->id }}' disabled name='archivo[{{ $count }}][comentario]' style="resize:none !important;"
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

                                                        <select class="form-select" aria-label="Default select example" disabled
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

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@accessible360/accessible-slick@1.0.1/slick/slick.min.js"></script>
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

<script>
    function abre(T) {
        var ruta = T.src.replace("/s90-Ic42/", "/s590-Ic42/");
        document.querySelector("#visor img").src = ruta;
    }
</script>
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
    function evaluar(id, requerido) {
        console.log(id, requerido);
        if (requerido == 0) {
            console.log('requerido');
            omitir(id);

        }
    }
</script>

