@extends('layouts.main', ['activePage' => 'personal', 'titlePage' => __('Alta de Personal')])
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
        <div class="container-fluid mb-2">
            <div class="row justify-content-center">
                <div class="col-12 align-self-center">
                    <div class="col-12">

                        <div class="card-body contCart">
                            <div class="text-left">
                                <a href="{{ route('personal.index') }}">
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
                <div class="col-12 align-self-start">
                    <div class="card">
                        <div class="card-body contCart">
                            <form class=" alertaGuardar" action="{{ route('personal.store') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="estatusId" id="estatusId" value="1">
                                <div class="accordion " id="accordionExample">
                                    {{--  Datos Personales  --}}

                                    <div class="accordion-item">
                                        <h6 class="accordion-header" id="headingOne">
                                            <button class="accordion-button bacTituloPrincipal" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#datosPersonales"
                                                aria-expanded="true" aria-controls="collapseOne">
                                                Datos Personales
                                            </button>
                                        </h6>
                                        <div id="datosPersonales" class="accordion-collapse collapse show"
                                            aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <div class="row mt-3">
                                                    <div class="col-12 col-md-4  ">

                                                        <div class="text-center mx-auto border  mb-4">
                                                            <i><img class="img-fluid imgPersonal mb-2"
                                                                    src="{{ asset('/img/general/avatar.jpg') }}"></i>

                                                            <span class="mi-archivo"> <input class="mb-4 ver" type="file"
                                                                    name="foto" id="mi-archivo" accept="image/*"></span>
                                                            <label for="mi-archivo">
                                                                <span>sube imagen</span>
                                                            </label>
                                                        </div>

                                                    </div>

                                                    <div class="col-12 col-md-8 ">
                                                        <div class="row alin">

                                                            {{--  <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Número del Empleado:</label></br>
                                                                <input type="text" class="inputCaja" id=""
                                                                    name="calle1" value="" readonly>
                                                            </div>  --}}

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Nombre(s):
                                                                    <span>*</span></label></br>
                                                                <input type="text" class="inputCaja" id="nombres"
                                                                    required name="nombres" value="{{ old('nombres') }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Apellido Paterno:
                                                                    <span>*</span></label></br>
                                                                <input type="text" class="inputCaja" id="apellidoP"
                                                                    required name="apellidoP"
                                                                    value="{{ old('apellidoP') }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Apellio Materno:</label></br>
                                                                <input type="text" class="inputCaja" id="apellidoM"
                                                                    name="apellidoM" value="{{ old('apellidoM') }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Fecha de Nacimiento:</label></br>
                                                                <input type="date" class="inputCaja" id="fechaNacimiento"
                                                                    name="fechaNacimiento"
                                                                    value="{{ old('fechaNacimiento') }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Lugar de Nacimiento:</label></br>
                                                                <input type="text" class="inputCaja" id="lugarNacimiento"
                                                                    name="lugarNacimiento"
                                                                    value="{{ old('lugarNacimiento') }}">
                                                            </div>

                                                            {{--  <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Edad:</label></br>
                                                                <input type="text" class="inputCaja" id=""
                                                                    name="calle1" value="">
                                                            </div>  --}}

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">CURP:</label></br>
                                                                <input type="text" class="inputCaja" id="curp"
                                                                    name="curp" value="{{ old('curp') }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">RFC:</label></br>
                                                                <input type="text" class="inputCaja" id="rfc"
                                                                    name="rfc" value="{{ old('rfc') }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Sexo:</label></br>
                                                                <select class="form-select"
                                                                    aria-label="Default select example" id="sexo"
                                                                    name="sexo">
                                                                    <option value="Masculino">Masculino</option>
                                                                    <option value="Femenino">Femenino</option>
                                                                </select>
                                                            </div>
                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Folio INE:</label></br>
                                                                <input type="text" class="inputCaja" id="ine"
                                                                    name="ine" value="{{ old('ine') }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Núm. Licencia :</label></br>
                                                                <input type="text" class="inputCaja" id="licencia"
                                                                    name="licencia" value="{{ old('licencia') }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Tipo de licencia:</label></br>
                                                                <input type="email" class="inputCaja" id="tipoLicencia"
                                                                    name="tipoLicencia"
                                                                    value="{{ old('tipoLicencia') }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Cédula Profesional
                                                                    Federal:</label></br>
                                                                <input type="text" class="inputCaja" id="cpf"
                                                                    name="cpf" value="{{ old('cpf') }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Cédula Profesional
                                                                    Estatal:</label></br>
                                                                <input type="text" class="inputCaja" id="cpe"
                                                                    name="cpe" value="{{ old('cpe') }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Hijos:</label></br>
                                                                <input type="number" class="inputCaja text-right"
                                                                    id="hijos" name="hijos"
                                                                    value="{{ old('hijos') }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Estado Civil:</label></br>
                                                                <input type="text" class="inputCaja" id="civil"
                                                                    name="civil" value="{{ old('civil') }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Tipo de Sangre:</label></br>
                                                                <select class="form-select"
                                                                    aria-label="Default select example" id="sangre"
                                                                    name="sangre">
                                                                    <option value="A+">A+</option>
                                                                    <option value="A-">A-</option>
                                                                    <option value="B+">B+</option>
                                                                    <option value="B-">B-</option>
                                                                    <option value="AB+">AB+</option>
                                                                    <option value="AB-">AB-</option>
                                                                    <option value="O+">O+</option>
                                                                    <option value="O-">O-</option>
                                                                </select>
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Alergias:</label></br>
                                                                <input type="text" class="inputCaja" id="aler"
                                                                    name="aler" value="{{ old('aler') }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Profesión:</label></br>
                                                                <input type="text" class="inputCaja" id="profe"
                                                                    name="profe" value="{{ old('profe') }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Teléfono de Casa:</label></br>
                                                                <input type="text" class="inputCaja" id="particular"
                                                                    name="particular" value="{{ old('particular') }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Celular:</label></br>
                                                                <input type="text" class="inputCaja" id="celular"
                                                                    name="celular" value="{{ old('celular') }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Correo Electrónico
                                                                    Personal:</label></br>
                                                                <input type="email" class="inputCaja" id="mailpersonal"
                                                                    name="mailpersonal"
                                                                    value="{{ old('mailpersonal') }}">
                                                            </div>
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
                                                data-bs-toggle="collapse" data-bs-target="#direcciones"
                                                aria-expanded="true" aria-controls="collapseOne">
                                                Direcciones
                                            </button>
                                        </h6>
                                        <div id="direcciones" class="accordion-collapse collapse"
                                            aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
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
                                                                    name="calle" value="{{ old('calle') }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6  mb-3 ">
                                                                <label class="labelTitulo">Número Exterior:</label></br>
                                                                <input type="text" class="inputCaja" id="numero"
                                                                    name="numero" value="{{ old('numero') }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6  mb-3 ">
                                                                <label class="labelTitulo">Número Interior:</label></br>
                                                                <input type="text" class="inputCaja" id="interior"
                                                                    name="interior" value="{{ old('interior') }}">
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
                                                                    name="colonia" value="{{ old('colonia') }}">
                                                            </div>

                                                            <div class="col-12 col-sm-6 mb-3">
                                                                <label class="labelTitulo">Código Postal:</label></br>
                                                                <input type="text" class="inputCaja" id="cp"
                                                                    name="cp" onchange="fillAddressFields()"
                                                                    value="{{ old('cp') }}">
                                                            </div>

                                                            {{--  <div class=" col-12 col-sm-6  mb-3 ">
                                                    <label class="labelTitulo">Localidad:</label></br>
                                                    <input type="text" class="inputCaja" id="colonia"
                                                        name="colonia" value="{{ $personal->colonia }}">
                                                </div>  --}}

                                                            <div class=" col-12 col-sm-6  mb-3 ">
                                                                <label class="labelTitulo">Municipio:</label></br>
                                                                <input type="text" class="inputCaja" id="municipio"
                                                                    name="municipio" value="{{ old('municipio') }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6  mb-3 ">
                                                                <label class="labelTitulo">Entidad Federativa:</label></br>
                                                                <input type="text" class="inputCaja" id="estado"
                                                                    name="estado" value="{{ old('estado') }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6  mb-3 ">
                                                                <label class="labelTitulo">Casa Propia o
                                                                    Rentada:</label></br>
                                                                <input type="text" class="inputCaja" id="casa"
                                                                    name="casa" value="{{ old('casa') }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12  ">
                                                        <div class="row">

                                                            <div class=" col-12  mb-3 border-bottom">
                                                                <h6 class="text-start fs-5 textTitulo mb-2">Fiscal</h6>
                                                            </div>

                                                            <div class=" col-12 col-sm-6  mb-3 ">
                                                                <label class="labelTitulo">Codigo Postal:</label></br>
                                                                <input type="text" class="inputCaja" id="cp_f"
                                                                    name="cp_f" onchange="fillAddressFieldsFiscal()"
                                                                    value="{{ old('cp_f') }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6  mb-3 ">
                                                                <label class="labelTitulo">Tipo de Vialidad:</label></br>
                                                                <input type="text" class="inputCaja" id="tipof"
                                                                    name="tipof" value="{{ old('tipof') }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6  mb-3 ">
                                                                <label class="labelTitulo">Calle:</label></br>
                                                                <input type="text" class="inputCaja" id="callef"
                                                                    name="callef" value="{{ old('callef') }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6  mb-3 ">
                                                                <label class="labelTitulo">Número Exterior:</label></br>
                                                                <input type="text" class="inputCaja" id="numerof"
                                                                    name="numerof" value="{{ old('numerof') }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6  mb-3 ">
                                                                <label class="labelTitulo">Número Interior:</label></br>
                                                                <input type="text" class="inputCaja" id="interiorf"
                                                                    name="interiorf" value="{{ old('interiorf') }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6  mb-3 ">
                                                                <label class="labelTitulo">Colonia:</label></br>
                                                                <input type="text" class="inputCaja" id="coloniaf"
                                                                    name="coloniaf" value="{{ old('coloniaf') }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6  mb-3 ">
                                                                <label class="labelTitulo">Localidad:</label></br>
                                                                <input type="text" class="inputCaja" id="localidadf"
                                                                    name="localidadf" value="{{ old('localidadf') }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6  mb-3 ">
                                                                <label class="labelTitulo">Municipio:</label></br>
                                                                <input type="text" class="inputCaja" id="municipiof"
                                                                    name="municipiof" value="{{ old('municipiof') }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6  mb-3 ">
                                                                <label class="labelTitulo">Entidad Federativa:</label></br>
                                                                <input type="text" class="inputCaja" id="estadof"
                                                                    name="estadof" value="{{ old('estadof') }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6  mb-3 ">
                                                                <label class="labelTitulo">Entre calle:</label></br>
                                                                <input type="text" class="inputCaja" id="entref"
                                                                    name="entref" value="{{ old('entref') }}">
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
                                                data-bs-toggle="collapse" data-bs-target="#datosFamiliares"
                                                aria-expanded="true" aria-controls="collapseOne">
                                                Datos Familiares
                                            </button>
                                        </h6>
                                        <div id="datosFamiliares" class="accordion-collapse collapse"
                                            aria-labelledby="headingThree" data-bs-parent="#accordionExample">
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
                                                                    name="nombreP" value="{{ old('nombreP') }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6   mb-3 ">
                                                                <label class="labelTitulo">Nombre de la Madre:</label></br>
                                                                <input type="text" class="inputCaja" id="nombreM"
                                                                    name="nombreM" value="{{ old('nombreM') }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6   mb-3 ">
                                                                <label class="labelTitulo">En Caso de Accidente Avisar
                                                                    A:</label></br>
                                                                <input type="text" class="inputCaja" id="nombreE"
                                                                    name="nombreE" value="{{ old('nombreE') }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6   mb-3 ">
                                                                <label class="labelTitulo">Teléfono:</label></br>
                                                                <input type="text" class="inputCaja" id="particularE"
                                                                    name="particularE" value="{{ old('particularE') }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6   mb-3 ">
                                                                <label class="labelTitulo">Celular:</label></br>
                                                                <input type="text" class="inputCaja" id="celularE"
                                                                    name="celularE" value="{{ old('celularE') }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6  mb-3 ">
                                                                <label class="labelTitulo">Parentesco:</label></br>
                                                                <input type="text" class="inputCaja" id="parentesco"
                                                                    name="parentesco" value="{{ old('parentesco') }}">
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
                                                                <label class="labelTitulo">Nombre(s):</label></br>
                                                                <input type="text" class="inputCaja" id="nombreB"
                                                                    name="nombreB" value="{{ old('nombreB') }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-md-4 mb-3 ">
                                                                <label class="labelTitulo">Correo Electrónico:</label></br>
                                                                <input type="email" class="inputCaja" id="emailB"
                                                                    name="emailB" value="{{ old('emailB') }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-md-4 mb-3 ">
                                                                <label class="labelTitulo">Apellido Paterno:</label></br>
                                                                <input type="text" class="inputCaja" id="apellidoPB"
                                                                    name="apellidoPB" value="{{ old('apellidoPB') }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-md-4 mb-3 ">
                                                                <label class="labelTitulo">Apellido Materno :</label></br>
                                                                <input type="text" class="inputCaja" id="apellidoMB"
                                                                    name="apellidoMB" value="{{ old('apellidoMB') }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-md-4 mb-3 ">
                                                                <label class="labelTitulo">Teléfono:</label></br>
                                                                <input type="text" class="inputCaja" id="particularB"
                                                                    name="particularB" value="{{ old('particularB') }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-md-4 mb-3 ">
                                                                <label class="labelTitulo">Celular:</label></br>
                                                                <input type="text" class="inputCaja" id="celularB"
                                                                    name="celularB" value="{{ old('celularB') }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-md-4 mb-3 ">
                                                                <label class="labelTitulo">Fecha de
                                                                    Nacimiento:</label></br>
                                                                <input type="date" class="inputCaja" id="nacimientoB"
                                                                    name="nacimientoB" value="{{ old('nacimientoB') }}">
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
                                                data-bs-toggle="collapse" data-bs-target="#datosNomina"
                                                aria-expanded="true" aria-controls="collapseOne">
                                                Datos de Nómina
                                            </button>
                                        </h6>
                                        <div id="datosNomina" class="accordion-collapse collapse"
                                            aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <div class="row mt-3">

                                                    <div class="col-12 border-end">
                                                        <div class="row alin">
                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Número de Nómina:</label></br>
                                                                <input type="number" class="inputCaja" id=""
                                                                    name="nomina" value="{{ old('nomina') }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4  mb-3 ">
                                                                <label class="labelTitulo">Número de IMSS:</label></br>
                                                                <input type="text" class="inputCaja" id=""
                                                                    name="imss" value="{{ old('imss') }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4  mb-3 ">
                                                                <label class="labelTitulo">Número de Clínica de
                                                                    IMSS:</label></br>
                                                                <input type="text" class="inputCaja" id=""
                                                                    name="clinica" value="{{ old('clinica') }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4  mb-3 ">
                                                                <label class="labelTitulo">Crédito Infonavit:</label></br>
                                                                <input type="text" class="inputCaja" id=""
                                                                    name="infonavit" value="{{ old('infonavit') }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Afore:</label></br>
                                                                <input type="text" class="inputCaja" id=""
                                                                    name="afore" value="{{ old('afore') }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Pago
                                                                    (Semanal/Quincenal):</label></br>
                                                                <select class="form-select"
                                                                    aria-label="Default select example" name="pago">
                                                                    <option value="Semanal" selected>Semanal</option>
                                                                    <option value="Quincenal">Quincenal</option>
                                                                </select>
                                                            </div>
                                                            {{--
                                                            <div class=" col-12 col-sm-6 col-lg-3 mb-3 ">
                                                                <label class="labelTitulo">Cantidad:</label></br>
                                                                <input type="text" class="inputCaja" id=""
                                                                    name="calle1" value="">
                                                            </div>  --}}

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Número Tarjeta
                                                                    Nómina:</label></br>
                                                                <input type="text" class="inputCaja" id=""
                                                                    name="tarjeta" value="{{ old('tarjeta') }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Banco:</label></br>
                                                                <input type="text" class="inputCaja" id=""
                                                                    name="banco" value="{{ old('banco') }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Puesto:
                                                                    <span>*</span></label></br>
                                                                <select id="puestoId" name="puestoId"
                                                                    class="form-select" required
                                                                    aria-label="Default select example">
                                                                    <option value="">Seleccione</option>
                                                                    @foreach ($vctPuestos as $item)
                                                                        <option value="{{ $item->id }}">
                                                                            {{ $item->nombre }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            {{--  <div class=" col-12 col-sm-6 col-lg-3 mb-3 ">
                                                                <label class="labelTitulo">Permisos:</label></br>
                                                                <select class="form-select"
                                                                    aria-label="Default select example">
                                                                    <option selected>Opción 1</option>
                                                                    <option value="1">Opcion 2</option>
                                                                </select>
                                                            </div>  --}}

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Fecha de Ingreso:
                                                                    <span>*</span></label></br>
                                                                <input type="date" class="inputCaja" id=""
                                                                    required name="ingreso" value="{{ old('ingreso') }}">
                                                            </div>

                                                            {{--  <div class=" col-12 col-sm-6 col-lg-3 mb-3 ">
                                                                <label class="labelTitulo">Días Trabajados
                                                                    (Años/Meses):</label></br>
                                                                <input type="text" class="inputCaja" id=""
                                                                    name="calle1" value="">
                                                            </div>  --}}

                                                            {{--  <div class=" col-12 col-sm-6 col-lg-3 mb-3 ">
                                                                <label class="labelTitulo">Días de Derecho a
                                                                    Vacaciones:</label></br>
                                                                <input type="text" class="inputCaja" id=""
                                                                    name="calle1" value="">
                                                            </div>  --}}

                                                            {{--  <div class=" col-12 col-sm-6 col-lg-3 mb-3 ">
                                                                <label class="labelTitulo">Vacaciones Tomadas en el
                                                                    Año:</label></br>
                                                                <input type="text" class="inputCaja" id=""
                                                                    name="calle1" value="">
                                                            </div>  --}}

                                                            {{--  <div class=" col-12 col-sm-6 col-lg-3 mb-3 ">
                                                                <label class="labelTitulo">Días Restantes de
                                                                    Vacaciones:</label></br>
                                                                <input type="text" class="inputCaja" id=""
                                                                    name="calle1" value="">
                                                            </div>  --}}

                                                            {{--  <div class=" col-12 col-sm-6 col-lg-3 mb-3 ">
                                                                <label class="labelTitulo">Días Laborables:</label></br>
                                                                <input type="text" class="inputCaja" id=""
                                                                    name="calle1" value="">
                                                            </div>  --}}

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                {{--  <label class="labelTitulo">Horario:</label></br>  --}}
                                                                <div class="d-flex">
                                                                    <div class="col-6 pe-1">
                                                                        <label class="labelTitulo">Horario
                                                                            Entrada:</label></br>

                                                                        <input type="time" class="inputCaja "
                                                                            placeholder="Entrada" id=""
                                                                            name="hEntrada"
                                                                            value="{{ old('hEntrada') }}">
                                                                    </div>
                                                                    <div class="col-6  ps-1">
                                                                        <label class="labelTitulo">Horario
                                                                            Salida:</label></br>

                                                                        <input type="time" class="inputCaja "
                                                                            placeholder="Salida" id=""
                                                                            name="hSalida" value="{{ old('hSalida') }}">
                                                                    </div>
                                                                </div>

                                                            </div>

                                                            {{-- <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Jefe Inmediato:</label></br>
                                                                <input type="text" class="inputCaja" id=""
                                                                    name="jefeId" value="{{ old('jefeId') }}">
                                                            </div> --}}

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Jefe Inmediato:
                                                                    <span>*</span></label></br>
                                                                <select id="jefeId" name="jefeId" class="form-select"
                                                                    aria-label="Default select example">

                                                                    <option value="">Seleccione</option>
                                                                    @foreach ($vctPersonal as $persona)
                                                                        <option value="{{ $persona->id }}">
                                                                            {{ $persona->nombres . ' ' . $persona->apellidoP }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            {{--  <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Obra o Lugar de
                                                                    Trabajo:</label></br>
                                                                <input type="text" class="inputCaja" id=""
                                                                    name="calle1" value="">
                                                            </div>  --}}

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Sueldo Diario:
                                                                    <span>*</span></label></br>
                                                                <input type="number" maxlength="5" step="0.01"
                                                                    required min="00000" max="99999"
                                                                    placeholder="ej. 1000" class="inputCaja text-right"
                                                                    id="diario" name="diario"
                                                                    value="{{ old('diario') }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">ISR:</label></br>
                                                                <input type="number" class="inputCaja text-right"
                                                                    id="" name="isr" step='0.01'
                                                                    value="{{ old('isr') }}">
                                                            </div>

                                                            {{-- <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Registra
                                                                    Asistencia:</label></br>
                                                                <select class="form-select"
                                                                    aria-label="Default select example" id="asistencia"
                                                                    name="asistencia">
                                                                    <option value="0">No</option>
                                                                    <option value="1">Sí</option>
                                                                </select>
                                                            </div> --}}

                                                            {{--  <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Nivel de Puesto:
                                                                    <span>*</span></label></br>
                                                                <select id="puestoNivelId" name="puestoNivelId"
                                                                    class="form-select" required
                                                                    aria-label="Default select example">
                                                                    <option value="">Seleccione</option>
                                                                    @foreach ($vctNiveles as $item)
                                                                        <option value="{{ $item->id }}">
                                                                            {{ $item->nombre }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>  --}}


                                                            {{-- <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Usa caja chica:</label></br>
                                                                <select class="form-select"
                                                                    aria-label="Default select example" id="usaCajaChica"
                                                                    name="usaCajaChica">
                                                                    <option value="0" >
                                                                        No</option>
                                                                    <option value="1" >
                                                                        Sí
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
                                        <div id="uniforme" class="accordion-collapse collapse"
                                            aria-labelledby="headingThree" data-bs-parent="#accordionExample">
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
                                                                <select class="form-select"
                                                                    aria-label="Default select example" name="chaleco">
                                                                    <option value="XS">XS</option>
                                                                    <option value="S">S</option>
                                                                    <option value="M">M Grande</option>
                                                                    <option value="G">G</option>
                                                                    <option value="X">XG</option>
                                                                    <option value="2XG">2XG Grande</option>
                                                                    <option value="3XG">3XG Grande</option>
                                                                </select>
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">EPP Camisas (2):</label></br>
                                                                <select class="form-select"
                                                                    aria-label="Default select example" name="camisa">
                                                                    <option value="XS">XS</option>
                                                                    <option value="S">S</option>
                                                                    <option value="M">M Grande</option>
                                                                    <option value="G">G</option>
                                                                    <option value="X">XG</option>
                                                                    <option value="2XG">2XG Grande</option>
                                                                    <option value="3XG">3XG Grande</option>
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
                                                                    name="botas" value="{{ old('botas') }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">EPP Guantes:</label></br>
                                                                <select class="form-select"
                                                                    aria-label="Default select example" name="guantes">
                                                                    <option value="Chica" selected>Chica</option>
                                                                    <option value="Mediana">Mediana</option>
                                                                    <option value="Grande">Grande</option>
                                                                    <option value="Extra Grande">Extra Grande</option>
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
                                    {{--  Asignacion de Equipo  --}}
                                    {{--  <div class="accordion-item">
                                        <h6 class="accordion-header" id="headingThree">
                                            <button class="accordion-button bacTituloPrincipal" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#equipoAsignado"
                                                aria-expanded="true" aria-controls="collapseOne">
                                                Equipo Asignado
                                            </button>
                                        </h6>
                                        <div id="equipoAsignado" class="accordion-collapse collapse"
                                            aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <div class="row mt-3">

                                                    <div class="col-12 border-end">
                                                        <div class="row alin">
                                                            <div class=" col-12 col-sm-6 col-lg-3 mb-3 ">
                                                                <label class="labelTitulo">Equipo de Cómputo:</label></br>
                                                                <input type="text" class="inputCaja" id=""
                                                                    name="pc" value="{{ old('pc') }}"
                                                                    placeholder="Marca y Modelo">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-3 mb-3 ">
                                                                <label class="labelTitulo">Número de Serie:</label></br>
                                                                <input type="text" class="inputCaja" id=""
                                                                    name="pcSerial" value="{{ old('pcSerial') }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-3 mb-3 ">
                                                                <label class="labelTitulo">Teléfono Celular:</label></br>
                                                                <input type="text" class="inputCaja" id=""
                                                                    name="celularEquipo"
                                                                    value="{{ old('celularEquipo') }}"
                                                                    placeholder="Marca y Modelo">
                                                            </div>
                                                            <div class=" col-12 col-sm-6 col-lg-3 mb-3 ">
                                                                <label class="labelTitulo">Número de IMEI:</label></br>
                                                                <input type="text" class="inputCaja" id=""
                                                                    name="imei" value="">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-3 mb-3 ">
                                                                <label class="labelTitulo">Radio Comunicación:</label></br>
                                                                <input type="text" class="inputCaja" id=""
                                                                    name="radio" placeholder="Marca y Modelo"
                                                                    value="{{ old('radio') }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-3 mb-3 ">
                                                                <label class="labelTitulo">Número de Serie:</label></br>
                                                                <input type="text" class="inputCaja" id=""
                                                                    name="radioSerial" value="{{ old('radioSerial') }}">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-3 mb-3 ">
                                                                <label class="labelTitulo">Cargador Radio Núm. de
                                                                    Serie:</label></br>
                                                                <input type="text" class="inputCaja" id=""
                                                                    name="cargadorSerial"
                                                                    value="{{ old('cargadorSerial') }}">
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>  --}}
                                    {{--  Documentacion  --}}
                                    <div class="accordion-item">
                                        <h6 class="accordion-header" id="headingThree">
                                            <button class="accordion-button bacTituloPrincipal" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#documentos"
                                                aria-expanded="true" aria-controls="collapseOne">
                                                Documentos
                                            </button>
                                        </h6>
                                        <div id="documentos" class="accordion-collapse collapse"
                                            aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <div class="row mt-3">
                                                    @php
                                                        $contador = 0;
                                                    @endphp
                                                    @forelse ($docs as $doc)
                                                        <div
                                                            class="card-group col-12 col-md-6 col-lg-4 col-xl-3 small-card-date my-1">
                                                            <div class="card border-green">
                                                                <div class="card-body">
                                                                    <div>
                                                                        <label
                                                                            class="form-check-label text-start fs-5 textTitulo text-break mb-2"
                                                                            for="flexCheckDefault">
                                                                            {{ ucwords(trans($doc->nombre)) }}
                                                                        </label>
                                                                    </div>
                                                                    <div
                                                                        class="contIconosDocumentos d-flex flex-wrap align-items-end align-items-center">
                                                                        <input type="hidden" id='{{ $doc->nombre }}'
                                                                            name='archivo[{{ $contador }}][tipoDocs]'
                                                                            value='{{ $doc->id }}'>
                                                                        <input type="hidden"
                                                                            id='nombre{{ $doc->nombre }}'
                                                                            name='archivo[{{ $contador }}][tipoDocsNombre]'
                                                                            value='{{ $doc->nombre }}'>
                                                                        <input type="hidden"
                                                                            id='omitido{{ $doc->id }}'
                                                                            name='archivo[{{ $contador }}][omitido]'
                                                                            value='0'>
                                                                        <label class="custom-file-upload"
                                                                            onclick='handleDocumento("{{ $doc->id }}","{{ $doc->nombre }}")'>
                                                                            <input class="mb-4" type="file"
                                                                                name='archivo[{{ $contador }}][docs]'
                                                                                id='{{ $doc->id }}' accept=".pdf">
                                                                            <div id='iconContainer{{ $doc->id }}'>
                                                                                <lord-icon
                                                                                    src="https://cdn.lordicon.com/koyivthb.json"
                                                                                    trigger="hover"
                                                                                    colors="primary:#86c716,secondary:#e8e230"
                                                                                    stroke="65"
                                                                                    style="width:50px;height:70px">
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
                                                                        <button
                                                                            id='cancelarOmitirButton{{ $doc->id }}'
                                                                            class="btnSinFondo float-end mt-3"
                                                                            style="margin-left: 20px; display: none;"
                                                                            rel="tooltip"
                                                                            onclick='cancelarOmitir("{{ $doc->id }}","{{ $doc->nombre }}")'>
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
                                                                                    style="display: block;">
                                                                            </div>
                                                                            <div class="col-12">
                                                                                <label
                                                                                    class="text-start fs-5 textTitulo text-break mb-2"
                                                                                    style="font-size: 18px !important; padding-top: 10px; padding-bottom: 5px; resize: horizontal !important;">Comentario:</label>
                                                                                <textarea class="form-control-textarea inputCaja" rows="2" maxlength="1000"
                                                                                    id='comentario{{ $doc->id }}' name="archivo[{{ $contador }}][comentario]"
                                                                                    placeholder="Escribe Un Comentario"></textarea>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
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
                                </div>
                                <div class="col-12 text-center my-3 ">
                                    <button type="submit" class="btn botonGral"
                                        onclick="alertaGuardar()">Guardar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="{{ asset('js/cardArchivos.js') }}"></script>

    <script>
        function fillAddressFields() {
            var cp = document.getElementById('cp').value;

            // OpenStreetMap Nominatim API con filtro para México
            axios.get(
                    `https://nominatim.openstreetmap.org/search?postalcode=${cp}&countrycodes=MX&format=json&addressdetails=1`
                )
                .then(function(response) {
                    console.log(response);
                    var data = response.data;
                    if (data.length > 0) {
                        var address = data[0];

                        var state = address.address.state;
                        var city = address.address.city || address.address.town || address.address.village || "";
                        var municipality = address.address.county || address.county;

                        document.getElementById('estado').value = state;
                        document.getElementById('municipio').value = municipality;
                        document.getElementById('colonia').value = city;

                    }
                })
                .catch(function(error) {
                    console.error(error);
                });
        }
    </script>

    <script>
        function fillAddressFieldsFiscal() {
            var cp = document.getElementById('cp_f').value;

            // OpenStreetMap Nominatim API con filtro para México
            axios.get(
                    `https://nominatim.openstreetmap.org/search?postalcode=${cp}&countrycodes=MX&format=json&addressdetails=1`
                )
                .then(function(response) {
                    console.log(response);
                    var data = response.data;
                    if (data.length > 0) {
                        var address = data[0];

                        var state = address.address.state;
                        var city = address.address.city || address.address.town || address.address.village || "";
                        var municipality = address.address.county || address.county;

                        document.getElementById('estadof').value = state;
                        document.getElementById('municipiof').value = municipality;
                        document.getElementById('coloniaf').value = city;

                    }
                })
                .catch(function(error) {
                    console.error(error);
                });
        }
    </script>


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
