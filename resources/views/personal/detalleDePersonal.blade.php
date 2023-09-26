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
                                    <a href="{{ route('personal.index') }}">
                                        <button class="btn regresar">
                                            <span class="material-icons">
                                                reply
                                            </span>
                                            Regresar
                                        </button>
                                    </a>
                                    {{--  @can('asistencia_cortesemanal')
                                        <a href="{{ route('asistencia.corteSemanal') }}">
                                            <button type="button" class="btn botonGral">Corte Semanal</button>
                                        </a>
                                    @endcan  --}}
                                </div>

                                <div class="col-8 text-end">
                                    {{--  @can('asistencia_horasextra')
                                        <a href="{{ route('asistencia.horasExtra') }}">
                                            <button type="button" class="btn botonGral">Horas Extra</button>
                                        </a>
                                    @endcan  --}}
                                    {{--  @can('asistencia_create')  --}}
                                    <a href="{{ route('personal.equipo', $personal->id) }}" method="get">
                                        <button class="btn botonGral">Asignar Equipo Personal</button>
                                    </a>


                                    <a href="{{ route('personal.uniforme', $personal->id) }}" method="get">
                                        <button class="btn botonGral">Asignar Uniforme</button>
                                    </a>

                                    <a href="#" data-bs-toggle="modal" data-bs-target="#asignar"
                                        onclick="asignar(
                                        '{{ $personal->id }}',
                                        '{{ is_null($vctAsignacion->maquinariaId) == false ? $vctAsignacion->maquinariaId : 0 }}',
                                        '{{ is_null($vctAsignacion->maquina) == false ? $vctAsignacion->maquina : '' }}',
                                        '{{ is_null($vctAsignacion->recordId) == false ? $vctAsignacion->recordId : 0 }}'
                                        )">
                                        <button class="btn botonGral">Asignar Maquinaría</button>
                                    </a>
                                    {{--  @endcan  --}}


                                </div>
                            </div>

                            <form action="{{ route('personal.update', $personal->id) }}" method="post"
                                class="alertaGuardar" enctype="multipart/form-data">
                                @csrf
                                @method('put')

                                <div class="d-md-flex p-3">
                                    <div class="col-12 col-md-4 px-2 ">
                                        <div class="text-center mx-auto border  mb-4">
                                            <i><img class="imgPersonal img-fluid"
                                                    src="{{ $personal->foto == '' ? ' /img/general/default.jpg' : asset('/storage/personal/' . str_pad($personal->id, 4, '0', STR_PAD_LEFT) . '/' . $personal->foto) }}"></i>

                                            <span class="mi-archivo"> <input class="mb-4 ver" type="file" name="foto"
                                                    id="mi-archivo" accept="image/*"></span>
                                            <label for="mi-archivo">
                                                <span>Sube Imagen</span>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-8 px-2">
                                        <div class="row alin">
                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                <label class="labelTitulo">Número de Empleado:</label></br>
                                                <input type="text" class="inputCaja" id="numEmpleado" name="numEmpleado"
                                                    value="">
                                            </div>

                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                <label class="labelTitulo">Nombre(s): <span>*</span></label></br>
                                                <input type="text" class="inputCaja" id="nombres" name="nombres"
                                                    required value="{{ $personal->nombres }}">
                                            </div>

                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                <label class="labelTitulo">Apellido Paterno: <span>*</span></label></br>
                                                <input type="text" class="inputCaja" id="apellidoP" name="apellidoP"
                                                    required value="{{ $personal->apellidoP }}">
                                            </div>

                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                <label class="labelTitulo">Apellio Materno:</label></br>
                                                <input type="text" class="inputCaja" id="apellidoM" name="apellidoM"
                                                    value="{{ $personal->apellidoM }}">
                                            </div>

                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                <label class="labelTitulo">Tipo de Sangre:</label></br>
                                                <select class="form-select" aria-label="Default select example"
                                                    id="sangre" name="sangre">
                                                    <option value="A+"
                                                        {{ $personal->sangre == 'A+' ? ' selected' : '' }}>A+
                                                    </option>
                                                    <option
                                                        value="A-"{{ $personal->sangre == 'A-' ? ' selected' : '' }}>A-
                                                    </option>
                                                    <option
                                                        value="B+"{{ $personal->sangre == 'B+' ? ' selected' : '' }}>B+
                                                    </option>
                                                    <option
                                                        value="B-"{{ $personal->sangre == 'B-' ? ' selected' : '' }}>B-
                                                    </option>
                                                    <option
                                                        value="AB+"{{ $personal->sangre == 'AB+' ? ' selected' : '' }}>
                                                        AB+</option>
                                                    <option
                                                        value="AB-"{{ $personal->sangre == 'AB-' ? ' selected' : '' }}>
                                                        AB-</option>
                                                    <option
                                                        value="O+"{{ $personal->sangre == 'O+' ? ' selected' : '' }}>O+
                                                    </option>
                                                    <option
                                                        value="O-"{{ $personal->sangre == 'O-' ? ' selected' : '' }}>O-
                                                    </option>
                                                </select>
                                            </div>

                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                <label class="labelTitulo">Alergias:</label></br>
                                                <input type="text" class="inputCaja" id="aler" name="aler"
                                                    value="{{ $personal->aler }}">
                                            </div>

                                            <div class=" col-12 col-sm-6 mb-3 ">
                                                <label class="labelTitulo">Correo Electrónico Empresa:</label></br>
                                                <input type="text" class="inputCaja" id="mailEmpresarial"
                                                    name="mailEmpresarial" value="{{ $personal->mailEmpresarial }}">
                                            </div>

                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                <label class="labelTitulo">Celular:</label></br>
                                                <input type="text" class="inputCaja" id="celular" name="celular"
                                                    value="{{ $personal->celular }}">
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="row p-3">
                                    <div class=" col-12   mb-3 ">
                                        <p class="textTitulo my-2">Obra Asignada: <span>Falta Agregar Bloque</span></p>
                                        <p class="textTitulo my-2">Maquinaria Asignada: <span>Falta Agregar Bloque</span>
                                        </p>
                                        <p class="textTitulo my-2">Fecha de Inicio: <span>Falta Agregar Bloque</span>
                                        </p>
                                    </div>
                                </div>
                                {{--  <div class="col-12 text-end mb-3 ">
                                    <button type="submit" class="btn botonGral">Guardar</button>
                                </div>  --}}


                        </div>
                    </div>
                    <div class="accordion my-3" id="accordionExample">
                        {{--  Datos Personales  --}}

                        <div class="accordion-item">
                            <h6 class="accordion-header " id="headingOne">
                                <button class="accordion-button bacTituloPrincipal" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#datosPersonales" aria-expanded="true"
                                    aria-controls="collapseOne">
                                    Datos Personales
                                </button>
                            </h6>
                            <div id="datosPersonales" class="accordion-collapse collapse show"
                                aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="row mt-3">
                                        {{--  <div class="col-12 col-md-4  ">
                                            <div class="text-center mx-auto border vistaFoto mb-4">
                                                <i><img class="imgVista img-fluid mb-5"
                                                        src="{{ asset('/img/general/vistaAerea.jpg') }}"></i>
                                                <input class="mb-4" type="file" name="foto" id="foto">
                                            </div>
                                        </div>  --}}

                                        <div class="col-12 ">
                                            <div class="row alin">

                                                <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                    <label class="labelTitulo">Fecha de Nacimiento: </label></br>
                                                    <input type="date" class="inputCaja" id="fechaNacimiento"
                                                        name="fechaNacimiento"
                                                        value="{{ $personal->fechaNacimiento ? \Carbon\Carbon::parse($personal->fechaNacimiento)->format('Y-m-d') : '' }}">
                                                </div>

                                                <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                    <label class="labelTitulo">Lugar de Nacimiento:</label></br>
                                                    <input type="text" class="inputCaja" id="lugarNacimiento"
                                                        name="lugarNacimiento" value="{{ $personal->lugarNacimiento }}">
                                                </div>

                                                {{--  <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                <label class="labelTitulo">Edad:</label></br>
                                                <input type="text" class="inputCaja" id=""
                                                    name="calle" value="">
                                            </div>  --}}

                                                <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                    <label class="labelTitulo">CURP:</label></br>
                                                    <input type="text" class="inputCaja" id="curp"
                                                        name="curp" value="{{ $personal->curp }}">
                                                </div>

                                                <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                    <label class="labelTitulo">RFC:</label></br>
                                                    <input type="text" class="inputCaja" id="rfc"
                                                        name="rfc" value="{{ $personal->rfc }}">
                                                </div>

                                                <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                    <label class="labelTitulo">Sexo:</label></br>

                                                    <select class="form-select" aria-label="Default select example"
                                                        id="sexo" name="sexo">
                                                        <option value="Masculino"
                                                            {{ $personal->sexo == 'Masculino' ? ' selected' : '' }}>
                                                            Masculino</option>
                                                        <option value="Femenino"
                                                            {{ $personal->sexo == 'Femenino' ? ' selected' : '' }}>Femenino
                                                        </option>
                                                    </select>
                                                </div>
                                                <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                    <label class="labelTitulo">Folio INE:</label></br>
                                                    <input type="text" class="inputCaja" id="ine"
                                                        name="ine" value="{{ $personal->ine }}">
                                                </div>

                                                <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                    <label class="labelTitulo">Núm. Licencia :</label></br>
                                                    <input type="text" class="inputCaja" id="licencia"
                                                        name="licencia" value="{{ $personal->licencia }}">
                                                </div>

                                                <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                    <label class="labelTitulo">Cédula Profesional
                                                        Federal:</label></br>
                                                    <input type="text" class="inputCaja" id="cpf"
                                                        name="cpf" value="{{ $personal->cpf }}">
                                                </div>

                                                <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                    <label class="labelTitulo">Cédula Profesional
                                                        Estatal:</label></br>
                                                    <input type="text" class="inputCaja" id="cpe"
                                                        name="cpe" value="{{ $personal->cpe }}">
                                                </div>

                                                <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                    <label class="labelTitulo">Hijos:</label></br>
                                                    <input type="number" class="inputCaja text-right" id="hijos"
                                                        name="hijos" value="{{ $personal->hijos }}">
                                                </div>

                                                <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                    <label class="labelTitulo">Estado Civil:</label></br>
                                                    {{--  <input type="text" class="inputCaja" id="civil"
                                                        name="civil" value="{{ $personal->civil }}"> --}}
                                                    <select class="form-select" aria-label="Default select example"
                                                        id="civil" name="civil">
                                                        <option value="Soltero"
                                                            {{ $personal->civil == 'Soltero' ? ' selected' : '' }}>Soltero
                                                        </option>
                                                        <option
                                                            value="Casado"{{ $personal->civil == 'Casado' ? ' selected' : '' }}>
                                                            Casado
                                                        </option>
                                                        <option
                                                            value="Unión libre"{{ $personal->civil == 'Unión libre' ? ' selected' : '' }}>
                                                            Unión libre
                                                        </option>
                                                    </select>
                                                </div>
                                                {{--
                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                <label class="labelTitulo">Tipo de Sangre:</label></br>
                                                <input type="text" class="inputCaja" id="sangre"
                                                    name="sangre" value="">
                                            </div>  --}}

                                                {{--  <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                <label class="labelTitulo">Alergias:</label></br>
                                                <input type="text" class="inputCaja" id="aler"
                                                    name="aler" value="">
                                            </div>  --}}

                                                <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                    <label class="labelTitulo">Profesión:</label></br>
                                                    <input type="text" class="inputCaja" id="profe"
                                                        name="profe" value="{{ $personal->profe }}">
                                                </div>

                                                <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                    <label class="labelTitulo">Teléfono de Casa:</label></br>
                                                    <input type="text" class="inputCaja" id="particular"
                                                        name="particular" value="{{ $personal->particular }}">
                                                </div>
                                                {{--
                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                <label class="labelTitulo">Celular:</label></br>
                                                <input type="text" class="inputCaja" id="celular"
                                                    name="celular" value="">
                                            </div>  --}}

                                                <div class=" col-12 col-sm-6 mb-3 ">
                                                    <label class="labelTitulo">Correo Electrónico
                                                        Personal:</label></br>
                                                    <input type="text" class="inputCaja" id="mailpersonal"
                                                        name="mailpersonal" value="{{ $personal->mailpersonal }}">
                                                </div>

                                                {{--  <div class=" col-12 col-sm-6  mb-3 ">
                                                <label class="labelTitulo">Correo Electrónico
                                                    Empresa:</label></br>
                                                <input type="text" class="inputCaja" id="mailEmpresarial"
                                                    name="mailEmpresarial" value="">
                                            </div>  --}}

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{--  Direcciones  --}}
                        <div class="accordion-item">
                            <h6 class="accordion-header" id="headingTwo">
                                <button class="accordion-button bacTituloPrincipal" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#direcciones" aria-expanded="true"
                                    aria-controls="collapseOne">
                                    Direcciones
                                </button>
                            </h6>
                            <div id="direcciones" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="row mt-3">

                                        <div class="col-12">
                                            <div class="row alin">

                                                <div class=" col-12  mb-3 border-bottom">
                                                    <h6 class="text-start fs-5 textTitulo mb-2">Física</h6>
                                                </div>

                                                <div class=" col-12 col-sm-6  mb-3 ">
                                                    <label class="labelTitulo">Calle:</label></br>
                                                    <input type="text" class="inputCaja" id="calle"
                                                        name="calle" value="{{ $personal->calle }}">
                                                </div>

                                                <div class=" col-12 col-sm-6  mb-3 ">
                                                    <label class="labelTitulo">Número Exterior:</label></br>
                                                    <input type="text" class="inputCaja" id="numero"
                                                        name="numero" value="{{ $personal->numero }}">
                                                </div>

                                                <div class=" col-12 col-sm-6  mb-3 ">
                                                    <label class="labelTitulo">Número Interior:</label></br>
                                                    <input type="text" class="inputCaja" id="interior"
                                                        name="interior" value="{{ $personal->interior }}">
                                                </div>
                                                {{--
                                    <div class=" col-12 col-sm-6  mb-3 ">
                                        <label class="labelTitulo">Entre las Calles:</label></br>
                                        <input type="text" class="inputCaja" id=""
                                            name="calle" value="">
                                    </div>  --}}

                                                <div class=" col-12 col-sm-6  mb-3 ">
                                                    <label class="labelTitulo">Colonia:</label></br>
                                                    <input type="text" class="inputCaja" id="colonia"
                                                        name="colonia" value="{{ $personal->colonia }}">
                                                </div>

                                                <div class=" col-12 col-sm-6  mb-3 ">
                                                    <label class="labelTitulo">Código Postal:</label></br>
                                                    <input type="text" class="inputCaja" id="cp"
                                                        name="cp" value="{{ $personal->cp }}">
                                                </div>

                                                {{--  <div class=" col-12 col-sm-6  mb-3 ">
                                        <label class="labelTitulo">Localidad:</label></br>
                                        <input type="text" class="inputCaja" id="colonia"
                                            name="colonia" value="{{ $personal->colonia }}">
                                    </div>  --}}

                                                <div class=" col-12 col-sm-6  mb-3 ">
                                                    <label class="labelTitulo">Municipio:</label></br>
                                                    <input type="text" class="inputCaja" id="ciudad"
                                                        name="ciudad" value="{{ $personal->ciudad }}">
                                                </div>

                                                <div class=" col-12 col-sm-6  mb-3 ">
                                                    <label class="labelTitulo">Entidad Federativa:</label></br>
                                                    <input type="text" class="inputCaja" id="estado"
                                                        name="estado" value="{{ $personal->estado }}">
                                                </div>

                                                <div class=" col-12 col-sm-6  mb-3 ">
                                                    <label class="labelTitulo">Casa Propia o
                                                        Rentada:</label></br>
                                                    <input type="text" class="inputCaja" id="casa"
                                                        name="casa" value="{{ $personal->casa }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12  ">
                                            <div class="row">

                                                <div class=" col-12  mb-3 border-bottom">
                                                    <h6 class="text-start fs-5 textTitulo mb-2">Fiscal</h6>
                                                </div>

                                                <div class=" col-12 col-sm-6  mb-3 ">
                                                    <label class="labelTitulo">Calle:</label></br>
                                                    <input type="text" class="inputCaja" id="callef"
                                                        name="callef" value="{{ $fiscal->calle }}">
                                                </div>

                                                <div class=" col-12 col-sm-6  mb-3 ">
                                                    <label class="labelTitulo">Número Exterior:</label></br>
                                                    <input type="text" class="inputCaja" id="numerof"
                                                        name="numerof" value="{{ $fiscal->numero }}">
                                                </div>

                                                <div class=" col-12 col-sm-6  mb-3 ">
                                                    <label class="labelTitulo">Número Interior:</label></br>
                                                    <input type="text" class="inputCaja" id="interiorf"
                                                        name="interiorf" value="{{ $fiscal->interior }}">
                                                </div>

                                                <div class=" col-12 col-sm-6  mb-3 ">
                                                    <label class="labelTitulo">Entre las Calles:</label></br>
                                                    <input type="text" class="inputCaja" id="entref"
                                                        name="entref" value="{{ $fiscal->entre }}">
                                                </div>

                                                <div class=" col-12 col-sm-6  mb-3 ">
                                                    <label class="labelTitulo">Colonia:</label></br>
                                                    <input type="text" class="inputCaja" id="coloniaf"
                                                        name="coloniaf" value="{{ $fiscal->colonia }}">
                                                </div>

                                                <div class=" col-12 col-sm-6  mb-3 ">
                                                    <label class="labelTitulo">Código Postal:</label></br>
                                                    <input type="text" class="inputCaja" id="cp_f"
                                                        name="cp_f" value="{{ $fiscal->cp }}">
                                                </div>

                                                <div class=" col-12 col-sm-6  mb-3 ">
                                                    <label class="labelTitulo">Localidad:</label></br>
                                                    <input type="text" class="inputCaja" id="localidadf"
                                                        name="localidadf" value="{{ $fiscal->localidad }}">
                                                </div>

                                                <div class=" col-12 col-sm-6  mb-3 ">
                                                    <label class="labelTitulo">Municipio:</label></br>
                                                    <input type="text" class="inputCaja" id="municipiof"
                                                        name="municipiof" value="{{ $fiscal->municipio }}">
                                                </div>
                                                <div class=" col-12 col-sm-6  mb-3 ">
                                                    <label class="labelTitulo">Entidad Federativa:</label></br>
                                                    <input type="text" class="inputCaja" id="estadof"
                                                        name="estadof" value="{{ $fiscal->estado }}">
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{--  Datos Familiares  --}}
                        <div class="accordion-item">
                            <h6 class="accordion-header" id="headingThree">
                                <button class="accordion-button bacTituloPrincipal" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#datosFamiliares" aria-expanded="true"
                                    aria-controls="collapseOne">
                                    Datos Familiares
                                </button>
                            </h6>
                            <div id="datosFamiliares" class="accordion-collapse collapse" aria-labelledby="headingThree"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="row mt-3">

                                        <div class="col-12 ">
                                            <div class="row alin">

                                                <div class=" col-12  mb-3 border-bottom">
                                                    <h6 class="text-start fs-5 textTitulo mb-2">Personales</h6>
                                                </div>

                                                <div class=" col-12 col-sm-6   mb-3 ">
                                                    <label class="labelTitulo">Nombre del Padre:</label></br>
                                                    <input type="text" class="inputCaja" id="nombreP"
                                                        name="nombreP" value="{{ $contacto->nombreP }}">
                                                </div>

                                                <div class=" col-12 col-sm-6   mb-3 ">
                                                    <label class="labelTitulo">Nombre de la Madre:</label></br>
                                                    <input type="text" class="inputCaja" id="nombreM"
                                                        name="nombreM" value="{{ $contacto->nombreM }}">
                                                </div>

                                                <div class=" col-12 col-sm-6   mb-3 ">
                                                    <label class="labelTitulo">En Caso de Accidente Avisar
                                                        A:</label></br>
                                                    <input type="text" class="inputCaja" id="nombreE"
                                                        name="nombreE" value="{{ $contacto->nombre }}">
                                                </div>

                                                <div class=" col-12 col-sm-6   mb-3 ">
                                                    <label class="labelTitulo">Teléfono:</label></br>
                                                    <input type="text" class="inputCaja" id="particularE"
                                                        name="particularE" value="{{ $contacto->particular }}">
                                                </div>

                                                <div class=" col-12 col-sm-6   mb-3 ">
                                                    <label class="labelTitulo">Celular:</label></br>
                                                    <input type="text" class="inputCaja" id="celularE"
                                                        name="celularE" value="{{ $contacto->celular }}">
                                                </div>

                                                <div class=" col-12 col-sm-6  mb-3 ">
                                                    <label class="labelTitulo">Parentesco:</label></br>
                                                    <input type="text" class="inputCaja" id="parentesco"
                                                        name="parentesco" value="{{ $contacto->parentesco }}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12  ">
                                            <div class="row">

                                                <div class=" col-12  mb-3 border-bottom"><br>
                                                    <h6 class="text-start fs-5 textTitulo mb-2">Beneficiario
                                                    </h6>
                                                </div>

                                                <div class=" col-12 col-sm-6 col-md-4 mb-3 ">
                                                    <label class="labelTitulo">Nombres:</label></br>
                                                    <input type="text" class="inputCaja" id="nombreB"
                                                        name="nombreB" value="{{ $beneficiario->nombres }}">
                                                </div>

                                                <div class=" col-12 col-sm-6 col-md-4 mb-3 ">
                                                    <label class="labelTitulo">Correo Electrónico:</label></br>
                                                    <input type="email" class="inputCaja" id="emailB"
                                                        name="emailB" value="{{ $beneficiario->emailB }}">
                                                </div>

                                                <div class=" col-12 col-sm-6 col-md-4 mb-3 ">
                                                    <label class="labelTitulo">Apellido Paterno:</label></br>
                                                    <input type="text" class="inputCaja" id="apellidoP"
                                                        name="apellidoPB" value="{{ $beneficiario->apellidoP }}">
                                                </div>

                                                <div class=" col-12 col-sm-6 col-md-4 mb-3 ">
                                                    <label class="labelTitulo">Apellido Materno :</label></br>
                                                    <input type="text" class="inputCaja" id="apellidoM"
                                                        name="apellidoMB" value="{{ $beneficiario->apellidoM }}">
                                                </div>

                                                <div class=" col-12 col-sm-6 col-md-4 mb-3 ">
                                                    <label class="labelTitulo">Teléfono:</label></br>
                                                    <input type="text" class="inputCaja" id="particular"
                                                        name="particularB" value="{{ $beneficiario->particular }}">
                                                </div>

                                                <div class=" col-12 col-sm-6 col-md-4 mb-3 ">
                                                    <label class="labelTitulo">Celular:</label></br>
                                                    <input type="text" class="inputCaja" id="celular"
                                                        name="celularB" value="{{ $beneficiario->celular }}">
                                                </div>

                                                <div class=" col-12 col-sm-6 col-md-4 mb-3 ">
                                                    <label class="labelTitulo">Fecha de
                                                        Nacimiento:</label></br>
                                                    <input type="date" class="inputCaja" id="nacimiento"
                                                        name="nacimientoB"value="{{ $beneficiario->nacimiento ? \Carbon\Carbon::parse($beneficiario->nacimiento)->format('Y-m-d') : '' }}">
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- Nomina   --}}
                        <div class="accordion-item">
                            <h6 class="accordion-header" id="headingThree">
                                <button class="accordion-button bacTituloPrincipal" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#datosNomina" aria-expanded="true"
                                    aria-controls="collapseOne">
                                    Datos de Nómina
                                </button>
                            </h6>
                            <div id="datosNomina" class="accordion-collapse collapse" aria-labelledby="headingThree"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="row mt-3">

                                        <div class="col-12 border-end">
                                            <div class="row alin">
                                                <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                    <label class="labelTitulo">Número de Nómina:</label></br>
                                                    <input type="number" class="inputCaja" id=""
                                                        name="nomina" value="{{ $nomina->nomina }}">
                                                </div>

                                                <div class=" col-12 col-sm-6 col-lg-4  mb-3 ">
                                                    <label class="labelTitulo">Número de IMSS:</label></br>
                                                    <input type="text" class="inputCaja" id=""
                                                        name="imss" value="{{ $nomina->imss }}">
                                                </div>

                                                <div class=" col-12 col-sm-6 col-lg-4  mb-3 ">
                                                    <label class="labelTitulo">Número de Clínica de
                                                        IMSS:</label></br>
                                                    <input type="text" class="inputCaja" id=""
                                                        name="clinica" value="{{ $nomina->clinica }}">
                                                </div>

                                                <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                    <label class="labelTitulo">Agregado IMSS:</label></br>
                                                    <input type="number" class="inputCaja" id=""
                                                        name="" value="{{ $nomina->decImss }}" disabled>
                                                </div>

                                                <div class=" col-12 col-sm-6 col-lg-4  mb-3 ">
                                                    <label class="labelTitulo">Crédito Infonavit:</label></br>
                                                    <input type="text" class="inputCaja" id=""
                                                        name="infonavit" value="{{ $nomina->infonavit }}">
                                                </div>

                                                <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                    <label class="labelTitulo">Agregado infonavit:</label></br>
                                                    <input type="number" class="inputCaja" id=""
                                                        name="" value="{{ $nomina->decInfonavit }}" disabled>
                                                </div>

                                                <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                    <label class="labelTitulo">Afore:</label></br>
                                                    <input type="text" class="inputCaja" id=""
                                                        name="afore" value="{{ $nomina->afore }}">
                                                </div>

                                                <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                    <label class="labelTitulo">Agregado Afore:</label></br>
                                                    <input type="number" class="inputCaja" id=""
                                                        name="" value="{{ $nomina->decAfore }}" disabled>
                                                </div>

                                                <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                    <label class="labelTitulo">Pago
                                                        (Semanal/quincenal):</label></br>
                                                    <select class="form-select" aria-label="Default select example"
                                                        name="pago">
                                                        <option value="Semanal"
                                                            {{ $personal->pago == 'Semanal' ? ' selected' : '' }}>Semanal
                                                        </option>
                                                        <option value="Quincenal"
                                                            {{ $personal->pago == 'Quincenal' ? ' selected' : '' }}>
                                                            Quincenal</option>
                                                    </select>
                                                </div>

                                                <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                    <label class="labelTitulo">Número Tarjeta
                                                        Nómina:</label></br>
                                                    <input type="text" class="inputCaja" id=""
                                                        name="tarjeta" value="{{ $nomina->tarjeta }}">
                                                </div>

                                                <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                    <label class="labelTitulo">Banco:</label></br>
                                                    <input type="text" class="inputCaja" id=""
                                                        name="banco" value="{{ $nomina->banco }}">
                                                </div>

                                                <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                    <label class="labelTitulo">Puesto: <span>*</span></label></br>
                                                    {{-- <input type="text" class="inputCaja" id=""
                                                        name="puesto" value="{{ $nomina->puesto }}"> --}}
                                                    <select id="puestoId" name="puestoId" required class="form-select"
                                                        aria-label="Default select example">
                                                        <option value="">Seleccione</option>
                                                        @foreach ($vctPuestos as $item)
                                                            <option value="{{ $item->id }}"
                                                                {{ $nomina->puestoId == $item->id ? ' selected' : '' }}>
                                                                {{ $objValida->ucwords_accent($item->nombre) }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                    <label class="labelTitulo">Fecha de Ingreso:
                                                        <span>*</span></label></br>
                                                    <input type="date" class="inputCaja" id="" required
                                                        name="ingreso"
                                                        value="{{ $nomina->ingreso ? \Carbon\Carbon::parse($nomina->ingreso)->format('Y-m-d') : '' }}">
                                                </div>

                                                <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                    {{--  <label class="labelTitulo">Horario:</label></br>  --}}
                                                    <div class="d-flex">
                                                        <div class="col-6 pe-1">
                                                            <label class="labelTitulo">Horario
                                                                Entrada Semana:</label></br>

                                                            <input type="time" class="inputCaja "
                                                                placeholder="Entrada" id="" name="hEntrada"
                                                                value="{{ $nomina->hEntrada }}">
                                                        </div>
                                                        <div class="col-6  ps-1">
                                                            <label class="labelTitulo">Horario
                                                                Salida Semana:</label></br>

                                                            <input type="time" class="inputCaja " placeholder="Salida"
                                                                id="" name="hSalida"
                                                                value="{{ $nomina->hSalida }}">
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                    {{--  <label class="labelTitulo">Horario:</label></br>  --}}
                                                    <div class="d-flex">
                                                        <div class="col-6 pe-1">
                                                            <label class="labelTitulo">Horario
                                                                Entrada Sábado:</label></br>

                                                            <input type="time" class="inputCaja "
                                                                placeholder="Entrada" id=""
                                                                name="hEntradaSabado"
                                                                value="{{ $nomina->hEntradaSabado }}">
                                                        </div>
                                                        <div class="col-6  ps-1">
                                                            <label class="labelTitulo">Horario
                                                                Salida Sábado:</label></br>

                                                            <input type="time" class="inputCaja " placeholder="Salida"
                                                                id="" name="hSalidaSabado"
                                                                value="{{ $nomina->hSalidaSabado }}">
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                    <label class="labelTitulo">Jefe Inmediato:</label></br>
                                                    <select id="jefeId" name="jefeId" class="form-select"
                                                        aria-label="Default select example">
                                                        @foreach ($vctPersonal as $persona)
                                                            <option value="{{ $persona->id }}"
                                                                {{ $persona->id == $nomina->jefeId ? ' selected' : '' }}>
                                                                {{ $objValida->ucwords_accent($persona->nombres . ' ' . $persona->apellidoP. ' [' . $persona->puesto .']' ) }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                    <label class="labelTitulo">Sueldo Diario: <span>*</span></label></br>
                                                    <input type="number" maxlength="5" step="0.01" min="00000"
                                                        max="99999" placeholder="ej. 1000" required
                                                        class="inputCaja text-right" id="diario" name="diario"
                                                        value="{{ $nomina->diario }}">
                                                </div>

                                                <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                    <label class="labelTitulo">Salario diario Integrado:</label></br>
                                                    <input type="number" class="inputCaja text-right" id=""
                                                        name="" value="{{ $nomina->decSalarioDiarioIntegrado }}">
                                                </div>
                                                <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                    <label class="labelTitulo">Salario Mensual:</label></br>
                                                    <input type="number" class="inputCaja text-right" id=""
                                                        name="" value="{{ $nomina->decSalarioMensual }}" disabled>
                                                </div>

                                                <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                    <label class="labelTitulo">Salario Mensual o integrado:</label></br>
                                                    <input type="number" class="inputCaja text-right" id=""
                                                        name="" value="{{ $nomina->decSalarioMensualIntegrado }}"
                                                        disabled>
                                                </div>
                                                <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                    <label class="labelTitulo">Estado:</label></br>
                                                    <input type="number" class="inputCaja text-right" id=""
                                                        name="" value="{{ $nomina->decEstado }}" disabled>
                                                </div>

                                                <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                    <label class="labelTitulo">Riesgo de Trabajo:</label></br>
                                                    <input type="number" class="inputCaja text-right" id=""
                                                        name="" value="{{ $nomina->decImssRiesgo }}" disabled>
                                                </div>

                                                <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                    <label class="labelTitulo">Vacaciones:</label></br>
                                                    <input type="number" class="inputCaja text-right" id=""
                                                        name="" value="{{ $nomina->decVacaciones }}" disabled>
                                                </div>
                                                <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                    <label class="labelTitulo">Prima Vacacional:</label></br>
                                                    <input type="number" class="inputCaja text-right" id=""
                                                        name="" value="{{ $nomina->decPrimaVacacional }}"
                                                        disabled>
                                                </div>

                                                <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                    <label class="labelTitulo">Fecha de Pago Prima Vacacional:</label></br>
                                                    <input type="date" class="inputCaja" id="fechaPagoPrimaVac"
                                                        name="fechaPagoPrimaVac"
                                                        value="{{ $nomina->fechaPagoPrimaVac ? \Carbon\Carbon::parse($nomina->fechaPagoPrimaVac)->format('Y-m-d') : '' }}">
                                                </div>

                                                <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                    <label class="labelTitulo">ISR:</label></br>
                                                    <input type="number" class="inputCaja text-right" id=""
                                                        name="isr" value="{{ $nomina->isr }}">
                                                </div>

                                                <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                    <label class="labelTitulo">Aguinaldo:</label></br>
                                                    <input type="number" class="inputCaja text-right" id=""
                                                        name="" value="{{ $nomina->decAguinaldo }}" disabled>
                                                </div>
                                                <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                    <label class="labelTitulo">Total:</label></br>
                                                    <input type="number" class="inputCaja text-right" id=""
                                                        name="" value="{{ $nomina->decTotal }}" disabled>
                                                </div>

                                                {{-- <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                    <label class="labelTitulo">Registra Asistencia:</label></br>
                                                    <select class="form-select" aria-label="Default select example"
                                                        id="asistencia" name="asistencia">
                                                        <option value="0"
                                                            {{ $nomina->asistencia == 0 ? ' selected' : '' }}>
                                                            No</option>
                                                        <option value="1"
                                                            {{ $nomina->asistencia == 1 ? ' selected' : '' }}>Sí
                                                        </option>
                                                    </select>
                                                </div> --}}

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{--  Uniforme  --}}
                        <div class="accordion-item">
                            <h6 class="accordion-header" id="headingThree">
                                <button class="accordion-button bacTituloPrincipal" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#uniforme" aria-expanded="true"
                                    aria-controls="collapseOne">
                                    Tallas De Los Uniformes
                                </button>
                            </h6>
                            <div id="uniforme" class="accordion-collapse collapse" aria-labelledby="headingThree"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="row mt-3">

                                        <div class="col-12 border-end">
                                            <div class="row alin">
                                                {{--  <div class=" col-12 col-sm-6 col-lg-3 mb-3 ">
                                                    <label class="labelTitulo">EPP Casco:</label></br>
                                                    <select class="form-select"
                                                        aria-label="Default select example">
                                                        <option selected>Chica</option>
                                                        <option value="1">Mediana</option>
                                                        <option value="1">Grande</option>
                                                        <option value="1">Extra Grande</option>
                                                    </select>
                                                </div>  --}}

                                                <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                    <label class="labelTitulo">EPP Chaleco:</label></br>
                                                    <select class="form-select" aria-label="Default select example"
                                                        name="chaleco">
                                                        <option
                                                            value="XS"{{ $equipo->chaleco == 'XS' ? ' selected' : '' }}>
                                                            XS</option>
                                                        <option
                                                            value="S"{{ $equipo->chaleco == 'S' ? ' selected' : '' }}>
                                                            S</option>
                                                        <option
                                                            value="M"{{ $equipo->chaleco == 'M' ? ' selected' : '' }}>
                                                            M Grande</option>
                                                        <option
                                                            value="G"{{ $equipo->chaleco == 'G' ? ' selected' : '' }}>
                                                            G</option>
                                                        <option
                                                            value="XG"{{ $equipo->chaleco == 'XG' ? ' selected' : '' }}>
                                                            XG</option>
                                                        <option
                                                            value="2XG"{{ $equipo->chaleco == '2XG' ? ' selected' : '' }}>
                                                            2XG Grande</option>
                                                        <option
                                                            value="3XG"{{ $equipo->chaleco == '3XG' ? ' selected' : '' }}>
                                                            3XG Grande</option>
                                                    </select>
                                                </div>

                                                <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                    <label class="labelTitulo">EPP Camisas (2):</label></br>
                                                    <select class="form-select" aria-label="Default select example"
                                                        name="camisa">
                                                        <option
                                                            value="XS"{{ $equipo->camisa == 'XS' ? ' selected' : '' }}>
                                                            XS</option>
                                                        <option
                                                            value="S"{{ $equipo->camisa == 'S' ? ' selected' : '' }}>
                                                            S</option>
                                                        <option
                                                            value="M"{{ $equipo->camisa == 'M' ? ' selected' : '' }}>
                                                            M Grande</option>
                                                        <option
                                                            value="G"{{ $equipo->camisa == 'G' ? ' selected' : '' }}>
                                                            G</option>
                                                        <option
                                                            value="XG"{{ $equipo->camisa == 'XG' ? ' selected' : '' }}>
                                                            XG</option>
                                                        <option
                                                            value="2XG"{{ $equipo->camisa == '2XG' ? ' selected' : '' }}>
                                                            2XG Grande</option>
                                                        <option
                                                            value="3XG"{{ $equipo->camisa == '3XG' ? ' selected' : '' }}>
                                                            3XG Grande</option>
                                                    </select>
                                                </div>

                                                {{--  <div class=" col-12 col-sm-6 col-lg-3 mb-3 ">
                                                    <label class="labelTitulo">EPP Arnes y Línea de
                                                        Vida:</label></br>
                                                    <input type="text" class="inputCaja" id=""
                                                        name="calle1" value="">
                                                </div>  --}}

                                                <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                    <label class="labelTitulo">EPP Botas:</label></br>
                                                    <input type="text" class="inputCaja" id=""
                                                        name="botas" value="{{ $equipo->botas }}">
                                                </div>

                                                <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                    <label class="labelTitulo">EPP Guantes:</label></br>
                                                    <select class="form-select" aria-label="Default select example"
                                                        name="guantes">
                                                        <option value="Chica"
                                                            {{ $equipo->guantes == 'Chica' ? ' selected' : '' }}>Chica
                                                        </option>
                                                        <option
                                                            value="Mediana"{{ $equipo->guantes == 'Mediana' ? ' selected' : '' }}>
                                                            Mediana</option>
                                                        <option
                                                            value="Grande"{{ $equipo->guantes == 'Grande' ? ' selected' : '' }}>
                                                            Grande</option>
                                                        <option
                                                            value="Extra Grande"{{ $equipo->guantes == 'Extra Grande' ? ' selected' : '' }}>
                                                            Extra Grande</option>
                                                    </select>
                                                </div>
                                                {{--
                                                <div class=" col-12 col-sm-6 col-lg-3 mb-3 ">
                                                    <label class="labelTitulo">Epp Lentes:</label></br>
                                                    <input type="text" class="inputCaja" id=""
                                                        name="calle1" value="">
                                                </div>

                                                <div class=" col-12 col-sm-6 col-lg-3 mb-3 ">
                                                    <label class="labelTitulo">Credencial:</label></br>
                                                    <input type="text" class="inputCaja" id=""
                                                        name="calle1" value="">
                                                </div>  --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{--  Documentacion  --}}
                        <div class="accordion-item">
                            <h6 class="accordion-header" id="headingThree">
                                <button class="accordion-button bacTituloPrincipal" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#documentos" aria-expanded="true"
                                    aria-controls="collapseOne">
                                    Documentos
                                </button>
                            </h6>
                            <div id="documentos" class="accordion-collapse collapse" aria-labelledby="headingThree"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="row mt-3">
                                        @php
                                            $contador = 0;
                                        @endphp
                                        @forelse ($docs as $doc)
                                            <div class="card-group col-12 col-md-6 col-lg-4 col-xl-3 small-card-date my-1">
                                                <div class="card border-green">
                                                    <div class="card-body">
                                                        <div>
                                                            <label
                                                                class="form-check-label text-start fs-5 textTitulo text-break mb-2"
                                                                for="flexCheckDefault">
                                                                <i class="fas fa-times-circle semaforo{{ $doc->estatus }}"
                                                                    style="display: {{ $doc->estatus != '0' ? ' none' : '' }};"></i>
                                                                <i class="fa fa-exclamation-circle semaforo{{ $doc->estatus }}"
                                                                    style="display: {{ $doc->estatus != '1' ? ' none' : '' }};"
                                                                    title="Proximo a vencer"></i>
                                                                <i class="fa fa-check-circle semaforo{{ $doc->estatus }}"
                                                                    style="display: {{ $doc->estatus != '2' ? ' none' : '' }};"></i>
                                                                {{ ucwords(trans($doc->nombre)) }} </label>
                                                        </div>
                                                        @if ($doc->ruta != null)
                                                            <div
                                                                class="contIconosDocumentos d-flex flex-wrap align-items-end align-items-center">
                                                                <input type="hidden" id='{{ $doc->idDoc }}'
                                                                    name='archivo[{{ $contador }}][idDoc]'
                                                                    value='{{ $doc->idDoc }}'>
                                                                <input type="hidden" id='{{ $doc->nombre }}'
                                                                    name='archivo[{{ $contador }}][tipoDocs]'
                                                                    value='{{ $doc->id }}'>
                                                                <input type="hidden" id='nombre{{ $doc->nombre }}'
                                                                    name='archivo[{{ $contador }}][tipoDocsNombre]'
                                                                    value='{{ $doc->nombre }}'>
                                                                <input type="hidden" id='omitido{{ $doc->id }}'
                                                                    name='archivo[{{ $contador }}][omitido]'
                                                                    value='0'>
                                                                <label class="custom-file-upload"
                                                                    onclick='handleDocumento("{{ $doc->id }}","{{ $doc->nombre }}")'>
                                                                    <input class="mb-4" type="file"
                                                                        name='archivo[{{ $contador }}][docs]'
                                                                        id='{{ $doc->id }}' accept=".pdf"
                                                                        value="{{ $doc->ruta }}">
                                                                    <div id='iconContainer{{ $doc->id }}'>
                                                                        <lord-icon
                                                                            src="https://cdn.lordicon.com/nxaaasqe.json"
                                                                            trigger="hover"
                                                                            colors="primary:#86c716,secondary:#e8e230"
                                                                            stroke="65" style="width:50px;height:70px">
                                                                        </lord-icon>

                                                                    </div>
                                                                </label>
                                                                <a id='downloadButton{{ $doc->id }}'
                                                                    class="btnViewDescargar btn btn-outline-success btnView"
                                                                    download
                                                                    href="{{ asset('/storage/personal/' . str_pad($personal->id, 4, '0', STR_PAD_LEFT) . '/documentos/' . $doc->nombre . '/' . $doc->ruta) }}">
                                                                    <span class="btn-text">Descargar</span>
                                                                    <span class="icon">
                                                                        <i class="far fa-eye mt-2"></i>
                                                                    </span>
                                                                </a>
                                                                <button id='removeButton{{ $doc->id }}'
                                                                    onclick='eliminarBotonera("{{ $doc->id }}")'
                                                                    type="button"
                                                                    class="btnViewDelete btn btn-outline-danger btnView"
                                                                    style="width: 2.4em; height: 2.4em;"><i
                                                                        class="fa fa-times"></i></button>
                                                                <!-- Botón Omitir -->
                                                                <button id='omitirButton{{ $doc->id }}'
                                                                    class="btnSinFondo float-end mt-3"
                                                                    style="margin-left: 20px" rel="tooltip"
                                                                    type="button"
                                                                    onclick='omitir("{{ $doc->id }}","{{ $doc->nombre }}")'>
                                                                    <P class="fs-5" style="display: none"> Omitir</P>
                                                                </button>
                                                                <button id='cancelarOmitirButton{{ $doc->id }}'
                                                                    class="btnSinFondo float-end mt-3"
                                                                    style="margin-left: 20px; display: none;"
                                                                    rel="tooltip" type="button"
                                                                    onclick='cancelarOmitir("{{ $doc->id }}","{{ $doc->nombre }}")'>
                                                                    <P class="fs-5"> Cancelar</P>
                                                                </button>
                                                                <div class="text-center">
                                                                    <div class="form-check d-flex justify-content-between">
                                                                        <div class="text-center"></div>
                                                                        <label
                                                                            class="text-start fs-5 textTitulo text-break mb-2"
                                                                            style="margin-left:-33px!important; font-size: 18px !important">
                                                                            Expiración:
                                                                        </label>
                                                                        <input
                                                                            class="form-check-input is-invalid align-self-end mb-2"
                                                                            name='archivo[{{ $contador }}][check]'
                                                                            type="checkbox"
                                                                            id='check{{ $doc->id }}' checked
                                                                            style="font-size: 20px; visibility: hidden"
                                                                            onchange='handleCheckboxChange("{{ $doc->id }}")'>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <input type="date"
                                                                            class="inputCaja text-center"
                                                                            id='fecha{{ $doc->id }}'
                                                                            name="archivo[{{ $contador }}][fecha]"
                                                                            style="display: block;"
                                                                            value="{{ $doc->fechaVencimiento }}">
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <label
                                                                            class="text-start fs-5 textTitulo text-break mb-2"
                                                                            style="font-size: 18px !important; padding-top: 10px; padding-bottom: 5px; resize: horizontal !important;">Comentario:</label>
                                                                        <textarea class="form-control-textarea inputCaja" rows="2" maxlength="1000"
                                                                            id='comentario{{ $doc->id }}' name="archivo[{{ $contador }}][comentario]"
                                                                            placeholder="Escribe Un Comentario">{{ $doc->comentarios }}</textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @else
                                                            <div
                                                                class="contIconosDocumentos d-flex flex-wrap align-items-end align-items-center">
                                                                <input type="hidden" id=''
                                                                    name='archivo[{{ $contador }}][idDoc]'
                                                                    value='{{ $doc->idDoc }}'>
                                                                <input type="hidden" id='{{ $doc->nombre }}'
                                                                    name='archivo[{{ $contador }}][tipoDocs]'
                                                                    value='{{ $doc->id }}'>
                                                                <input type="hidden" id='nombre{{ $doc->nombre }}'
                                                                    name='archivo[{{ $contador }}][tipoDocsNombre]'
                                                                    value='{{ $doc->nombre }}'>
                                                                <input type="hidden" id='omitido{{ $doc->id }}'
                                                                    name='archivo[{{ $contador }}][omitido]'
                                                                    value='0'>
                                                                <label class="custom-file-upload"
                                                                    onclick='handleDocumento("{{ $doc->id }}","{{ $doc->nombre }}")'>
                                                                    <input class="mb-4" type="file"
                                                                        name='archivo[{{ $contador }}][docs]'
                                                                        id='{{ $doc->id }}' accept=".pdf"
                                                                        value="{{ $doc->ruta }}">
                                                                    <div id='iconContainer{{ $doc->id }}'>
                                                                        <lord-icon
                                                                            src="https://cdn.lordicon.com/koyivthb.json"
                                                                            trigger="hover"
                                                                            colors="primary:#86c716,secondary:#e8e230"
                                                                            stroke="65" style="width:50px;height:70px">
                                                                        </lord-icon>

                                                                    </div>
                                                                </label>
                                                                <a id='downloadButton{{ $doc->id }}'
                                                                    class="btnViewDescargar btn btn-outline-success btnView"
                                                                    style="display: none" download>
                                                                    <span class="btn-text">Descargar</span>
                                                                    <span class="icon">
                                                                        <i class="far fa-eye mt-2"></i>
                                                                    </span>
                                                                </a>
                                                                <button id='removeButton{{ $doc->id }}'
                                                                    class="btnViewDelete btn btn-outline-danger btnView"
                                                                    type="button"
                                                                    style="width: 2.4em; height: 2.4em; display: none;"><i
                                                                        class="fa fa-times"></i></button>
                                                                <!-- Botón Omitir -->
                                                                <button id='omitirButton{{ $doc->id }}'
                                                                    class="btnSinFondo float-end mt-3"
                                                                    style="margin-left: 20px" rel="tooltip"
                                                                    type="button"
                                                                    onclick='omitir("{{ $doc->id }}","{{ $doc->nombre }}")'>
                                                                    <P class="fs-5"> Omitir</P>
                                                                </button>
                                                                <button id='cancelarOmitirButton{{ $doc->id }}'
                                                                    class="btnSinFondo float-end mt-3"
                                                                    style="margin-left: 20px; display: none;"
                                                                    rel="tooltip" type="button"
                                                                    onclick='cancelarOmitir("{{ $doc->id }}","{{ $doc->nombre }}")'>
                                                                    <P class="fs-5"> Cancelar</P>
                                                                </button>
                                                                <div class="text-center"
                                                                    style="margin-top: -10px !important">
                                                                    <div class="form-check d-flex justify-content-between">
                                                                        <div class="text-center"></div>
                                                                        <label
                                                                            class="text-start fs-5 textTitulo text-break mb-2"
                                                                            style="margin-left:-33px!important; font-size: 18px !important">
                                                                            Expiración:
                                                                        </label>
                                                                        <input
                                                                            class="form-check-input is-invalid align-self-end mb-2"
                                                                            name='archivo[{{ $contador }}][check]'
                                                                            type="checkbox"
                                                                            id='check{{ $doc->id }}' checked
                                                                            style="font-size: 20px; visibility: hidden"
                                                                            onchange='handleCheckboxChange("{{ $doc->id }}")'>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <input type="date"
                                                                            class="inputCaja text-center"
                                                                            id='fecha{{ $doc->id }}'
                                                                            name="archivo[{{ $contador }}][fecha]"
                                                                            style="display: block;"
                                                                            value="{{ $doc->fechaVencimiento }}">
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <label
                                                                            class="text-start fs-5 textTitulo text-break mb-2"
                                                                            style="font-size: 18px !important; padding-top: 10px; padding-bottom: 5px; resize: horizontal !important;">Comentario:</label>
                                                                        <textarea class="form-control-textarea inputCaja" rows="2" maxlength="1000"
                                                                            id='comentario{{ $doc->id }}' name="archivo[{{ $contador }}][comentario]"
                                                                            placeholder="Escribe Un Comentario">{{ $doc->comentarios }}</textarea>
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
                                                    evaluar({{ $doc->id }}, {{ $doc->requerido }});
                                                });
                                            </script>

                                            @php
                                                $contador++;
                                            @endphp
                                        @empty
                                            sin registro
                                        @endforelse

                                    </div>
                                </div>
                            </div>
                        </div>
                        {{--  estatus  --}}
                        <div class="accordion-item">
                            <h6 class="accordion-header" id="headingThree">
                                <button class="accordion-button bacTituloPrincipal" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#estatus" aria-expanded="true"
                                    aria-controls="collapseOne">
                                    Sistema
                                </button>
                            </h6>
                            <div id="estatus" class="accordion-collapse collapse" aria-labelledby="headingThree"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="row mt-3">

                                        <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                            <label class="labelTitulo">Estatus:</label></br>

                                            <select class="form-select" aria-label="Default select example"
                                                id="estatusId" name="estatusId">
                                                @foreach ($vctEstatus as $item)
                                                    <option value="{{ $item->id }}"
                                                        {{ $item->id == $personal->estatusId ? ' selected' : '' }}>
                                                        {{ $objValida->ucwords_accent($item->nombre) }} </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        {{--  <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                            <label class="labelTitulo">Nivel de Puesto: <span>*</span></label></br>
                                            <select id="puestoNivelId" name="puestoNivelId" class="form-select" required
                                                aria-label="Default select example">
                                                <option value="">Seleccione</option>
                                                @foreach ($vctNiveles as $item)
                                                    <option value="{{ $item->id }}"
                                                        {{ $personal->puestoNivelId == $item->id ? ' selected' : '' }}>
                                                        {{ $item->nombre }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>  --}}

                                        {{-- <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                            <label class="labelTitulo">Usa caja chica:</label></br>
                                            <select class="form-select" aria-label="Default select example"
                                                id="usaCajaChica" name="usaCajaChica">
                                                <option value="0"
                                                    {{ $personal->usaCajaChica == 0 ? ' selected' : '' }}>
                                                    No</option>
                                                <option value="1"
                                                    {{ $personal->usaCajaChica == 1 ? ' selected' : '' }}>Sí
                                                </option>
                                            </select>
                                        </div> --}}

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 text-center mb-3 ">
                        <button type="submit" class="btn botonGral" onclick="alertaGuardar()">Guardar</button>
                    </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <!-- Modal Asignar-->
    <div class="modal fade" id="asignar" tabindex="-1" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bacTituloPrincipal">
                    <h5 class="modal-title fs-5" id="modalTitleId">Asignar Vehículo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('personal.asignaciones', $persona->id) }}" method="post">
                        @csrf
                        @method('put')
                        <div class="container-fluid">

                            <input type="hidden" name="personalId" id="asignacionPersona">
                            <input type="hidden" name="recordId" id="recordId">

                            <div class="row">
                                <div class="mb-3 col-12 text-center">
                                    <h3 class="labelTitulo fs-3" id="nombreAuto">Asignar Vehículo</h3>
                                </div>

                                {{-- <div class="mb-3 col-6">
                                            <label for="obraAsignada" class="labelTitulo">Asignado en la Obra:</label>
                                            <input type="hidden" name="obraId" id="obraId">

                                            <input autofocus type="text" class="inputCaja" id="obraAsignada" name="obraAsignada"
                                                placeholder="Nombre Obra..." readonly>
                                        </div>

                                        <div class="mb-3 col-6">
                                            <label for="NobraId" class="labelTitulo">Asignar a la Obra:</label>
                                            <select name="NobraId" id="NobraId" required class="form-select">
                                                <option value="0">Sin Cambios</option>
                                                <option value="">Denegar Obra</option>
                                                @foreach ($vctObras as $item)
                                                    <option value="{{ $item->id }}" >
                                                        {{ $item->nombre . ' [' . $item->cliente . ']' }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div> --}}

                                <div class="mb-3 col-6">
                                    <label for="maquinariaAsignada" class="labelTitulo">Asignado a
                                        Maquinaría:</label>
                                    <input type="hidden" name="maquinariaId" id="maquinariaId">
                                    <input autofocus type="text" class="inputCaja" id="maquinariaAsignada"
                                        name="maquinariaAsignada" placeholder="Nombre Equipo..." readonly>
                                </div>

                                <div class="mb-3 col-6">
                                    <label for="NmaquinariaId" class="labelTitulo">Asignar a Maquinaria:</label>
                                    <select name="NmaquinariaId" id="NmaquinariaId" required class="form-select">
                                        <option value="0">Sin Cambios</option>
                                        <option value="">Denegar Equipo</option>
                                        @foreach ($vctMaquinaria as $item)
                                            <option value="{{ $item->id }}">
                                                {{ strtoupper($item->identificador) . ' - ' . $objValida->ucwords_accent($item->maquina) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>


                                {{-- <div class="mb-3 col-4">
                                            <label for="combustible" class="labelTitulo">Combustible:</label></br>
                                            <select class="form-select" aria-label="Default select example"
                                                id="combustible" name="combustible">
                                                <option value="0">No</option>
                                                <option value="1">Sí</option>
                                            </select>
                                        </div>

                                        <div class="mb-3 col-4">
                                            <label for="inicio" class="labelTitulo">Fecha de Inicio:</label></br>
                                            <input type="date" class="inputCaja" id="inicio" name="inicio"
                                                pattern="\d{2}/\d{2}/\d{4}" placeholder="dd/mm/yyyy" value="">
                                        </div>

                                        <div class="mb-3 col-4">
                                            <label for="fin" class="labelTitulo">Fecha de Término:</label></br>
                                            <input type="date" class="inputCaja" id="fin" name="fin"
                                                pattern="\d{2}/\d{2}/\d{4}" placeholder="dd/mm/yyyy" value="">
                                        </div> --}}


                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn botonGral">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function asignar(id, maquinariaId, maquina, recordId) {

            console.log(id, maquinariaId, maquina, recordId);

            const txtId = document.getElementById('asignacionPersona');
            txtId.value = id;

            const txtRId = document.getElementById('recordId');
            txtRId.value = recordId;

            const txtOperadorA = document.getElementById('maquinariaId');
            txtOperadorA.value = maquinariaId;

            const txtOperadorB = document.getElementById('maquinariaAsignada');
            txtOperadorB.value = maquina;
            txtOperadorB.readOnly = true;

            // const tituloModal = document.getElementById('nombreAuto');
            // tituloModal.textContent = identificador + ' ' + maquinaria;

            // const txtObraA = document.getElementById('obraId');
            // txtObraA.value = obraId;

            // const txtObraB = document.getElementById('obraAsignada');
            // txtObraB.value = obra;
            // txtObraB.readOnly = true;

            // const lstCombustible = document.getElementById('combustible').value = combustible;
            // const dteFechaInicio = document.getElementById('inicio').value = inicio;
            // const dteFechaFin = document.getElementById('fin').value = fin;



            // Obtener todos los campos del formulario
            const campos = document.querySelectorAll('input[type="text"], textarea');

            // Aplicar color gris a los campos con readonly
            campos.forEach((campo) => {
                if (modalTipo) {
                    campo.readOnly = true;

                    // campo.style.cursor:no-drop;
                } else {
                    campo.readOnly = false;
                    campo.style.color = 'initial';
                    // campo.style.cursor:no-drop;
                }
                if (campo == txtIdentificador) {
                    campo.readOnly = true;
                    campo.style.color = 'grey';
                }
            });
        }
    </script>
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
    <script>
        function evaluarH(id, ruta) {
            console.log(id, requerido);
            if (ruta != null) {
                console.log('ruta');
                handleDocumento(id);

            }
        }
    </script>

@endsection
