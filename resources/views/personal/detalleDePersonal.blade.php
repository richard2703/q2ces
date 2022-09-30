@extends('layouts.main', ['activePage' => 'personal', 'titlePage' => __('Vista de Personal')])
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-11 align-self-start">
                    <div class="card">
                        <div class="card-body contCart">
                            <div class="p-1 align-self-start bacTituloPrincipal">
                                <h2 class="my-3 ms-3 texticonos ">{{ $personal->nombres }} {{ $personal->apellidoP }}
                                    {{ $personal->apellidoM }}</h2>
                            </div>
                            <form class="row">

                                <div class="col-12 col-md-4  my-3">
                                    <div class="text-center mx-auto border vistaFoto mb-4">
                                        <i><img class="imgVista img-fluid"
                                                src="{{ asset('storage/personal/') . '/' . $personal->foto }}"></i>
                                    </div>
                                </div>

                                <div class="col-12 col-md-8 my-3">
                                    <div class="row alin">
                                        <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                            <label class="labelTitulo">Número del Empleado:</label></br>
                                            <input type="text" class="inputCaja" id="" name="calle"
                                                value=""readonly>
                                        </div>

                                        <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                            <label class="labelTitulo">Nombre(s):</label></br>
                                            <input type="text" class="inputCaja" id="" name="calle"
                                                value="{{ $personal->nombres }}"readonly>
                                        </div>

                                        <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                            <label class="labelTitulo">Apellido Paterno:</label></br>
                                            <input type="text" class="inputCaja" id="" name="calle"
                                                value="{{ $personal->apellidoP }}"readonly>
                                        </div>

                                        <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                            <label class="labelTitulo">Apellio Materno:</label></br>
                                            <input type="text" class="inputCaja" id="" name="calle"
                                                value="{{ $personal->apellidoM }}"readonly>
                                        </div>

                                        <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                            <label class="labelTitulo">Tipo de Sangre:</label></br>
                                            <input type="text" class="inputCaja" id="" name="calle"
                                                value="{{ $personal->sangre }}"readonly>
                                        </div>

                                        <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                            <label class="labelTitulo">Alergias:</label></br>
                                            <input type="text" class="inputCaja" id="" name="calle"
                                                value="{{ $personal->aler }}"readonly>
                                        </div>

                                        <div class=" col-12 col-sm-6 mb-3 ">
                                            <label class="labelTitulo">Correo Electrónico Empresa:</label></br>
                                            <input type="text" class="inputCaja" id="" name="calle"
                                                value="{{ $personal->emailEmpresaril }}"readonly>
                                        </div>

                                        <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                            <label class="labelTitulo">Celular:</label></br>
                                            <input type="text" class="inputCaja" id="" name="calle"
                                                value="{{ $personal->celular }}" readonly>
                                        </div>

                                        {{--  <div class=" col-12 col-sm-6 col-lg-3 mb-3 ">
                                            <label class="labelTitulo">Equipo Asignado:</label></br>
                                            <select class="form-select" aria-label="Default select example">
                                                <option selected>Equipo 1</option>
                                                <option value="1">Equipo 2</option>
                                            </select>
                                        </div>

                                        <div class=" col-12 col-sm-6 col-lg-3 mb-3 ">
                                            <label class="labelTitulo">Obra Asignada:</label></br>
                                            <select class="form-select" aria-label="Default select example">
                                                <option selected>Obra 1</option>
                                                <option value="1">Obra 2</option>
                                            </select>
                                        </div>  --}}

                                    </div>
                                </div>
                                <div class="row">
                                    <div class=" col-12   mb-3 ">
                                        <p class="textTitulo my-2">Obra Asignada: <span>Falta Agregar Bloque</span></p>
                                        <p class="textTitulo my-2">Equipo Asignado: <span>Falta Agregar Bloque</span>
                                        </p>
                                        <p class="textTitulo my-2">Fecha de Inicio: <span>Falta Agregar Bloque</span>
                                        </p>
                                    </div>
                                </div>
                                {{--  <div class="col-12 text-end mb-3 ">
                                    <button type="submit" class="btn botonGral">Guardar</button>
                                </div>  --}}

                            </form>

                        </div>
                    </div>
                    <div class="accordion my-3" id="accordionExample">
                        {{--  Datos Personales  --}}
                        <div class="accordion-item">
                            <h2 class="accordion-header " id="headingOne">
                                <button class="accordion-button bacTituloPrincipal" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#datosPersonales" aria-expanded="true" aria-controls="collapseOne">
                                    Datos Personales
                                </button>
                            </h2>
                            <div id="datosPersonales" class="accordion-collapse collapse" aria-labelledby="headingOne"
                                data-bs-parent="#accordionExample">
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

                                                {{--  <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                    <label class="labelTitulo">Número del Empleado:</label></br>
                                                    <input type="text" class="inputCaja" id=""
                                                        name="calle" value="" readonly>
                                                </div>

                                                <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                    <label class="labelTitulo">Nombre(s):</label></br>
                                                    <input type="text" class="inputCaja" id="nombres"
                                                        name="nombres" value="">
                                                </div>

                                                <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                    <label class="labelTitulo">Apellido Paterno:</label></br>
                                                    <input type="text" class="inputCaja" id="apellidoP"
                                                        name="apellidoP" value="">
                                                </div>

                                                <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                    <label class="labelTitulo">Apellio Materno:</label></br>
                                                    <input type="text" class="inputCaja" id="apellidoM"
                                                        name="apellidoM" value="">
                                                </div>  --}}

                                                <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                    <label class="labelTitulo">Fecha de Nacimiento: </label></br>
                                                    <input type="date" class="inputCaja" id="fechaNacimiento"
                                                        name="fechaNacimiento"
                                                        value="{{ \Carbon\Carbon::parse($personal->fechaNacimiento)->format('Y-m-d') }}">
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
                                                        federal:</label></br>
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
                                                    <input type="number" class="inputCaja" id="hijos"
                                                        name="hijos" value="{{ $personal->hijos }}">
                                                </div>

                                                <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                    <label class="labelTitulo">Estado Civil:</label></br>
                                                    <input type="text" class="inputCaja" id="civil"
                                                        name="civil" value="{{ $personal->civil }}">
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
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button bacTituloPrincipal" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#direcciones" aria-expanded="true"
                                    aria-controls="collapseOne">
                                    Direcciones
                                </button>
                            </h2>
                            <div id="direcciones" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="row mt-3">

                                        <div class="col-12">
                                            <div class="row alin">

                                                <div class=" col-12  mb-3 border-bottom">
                                                    <h2 class="text-start fs-5 textTitulo mb-2">Física</h2>
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
                                                    <h2 class="text-start fs-5 textTitulo mb-2">Fiscal</h2>
                                                </div>

                                                <div class=" col-12 col-sm-6  mb-3 ">
                                                    <label class="labelTitulo">Calle y Número:</label></br>
                                                    <input type="text" class="inputCaja" id=""
                                                        name="calle" value="">
                                                </div>

                                                <div class=" col-12 col-sm-6  mb-3 ">
                                                    <label class="labelTitulo">Número Exterior:</label></br>
                                                    <input type="text" class="inputCaja" id=""
                                                        name="calle" value="">
                                                </div>

                                                <div class=" col-12 col-sm-6  mb-3 ">
                                                    <label class="labelTitulo">Número Interior:</label></br>
                                                    <input type="text" class="inputCaja" id=""
                                                        name="calle" value="">
                                                </div>

                                                <div class=" col-12 col-sm-6  mb-3 ">
                                                    <label class="labelTitulo">Entre las Calles:</label></br>
                                                    <input type="text" class="inputCaja" id=""
                                                        name="calle" value="">
                                                </div>

                                                <div class=" col-12 col-sm-6  mb-3 ">
                                                    <label class="labelTitulo">Colonia:</label></br>
                                                    <input type="text" class="inputCaja" id=""
                                                        name="calle" value="">
                                                </div>

                                                <div class=" col-12 col-sm-6  mb-3 ">
                                                    <label class="labelTitulo">Código Postal:</label></br>
                                                    <input type="text" class="inputCaja" id=""
                                                        name="calle" value="">
                                                </div>

                                                <div class=" col-12 col-sm-6  mb-3 ">
                                                    <label class="labelTitulo">Localidad:</label></br>
                                                    <input type="text" class="inputCaja" id=""
                                                        name="calle" value="">
                                                </div>

                                                <div class=" col-12 col-sm-6  mb-3 ">
                                                    <label class="labelTitulo">Municipio:</label></br>
                                                    <input type="text" class="inputCaja" id=""
                                                        name="calle" value="">
                                                </div>
                                                <div class=" col-12 col-sm-6  mb-3 ">
                                                    <label class="labelTitulo">Entidad Federativa:</label></br>
                                                    <input type="text" class="inputCaja" id=""
                                                        name="calle" value="">
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{--  Datos Familiares  --}}
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button bacTituloPrincipal" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#datosFamiliares" aria-expanded="true"
                                    aria-controls="collapseOne">
                                    Datos Familiares
                                </button>
                            </h2>
                            <div id="datosFamiliares" class="accordion-collapse collapse" aria-labelledby="headingThree"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="row mt-3">

                                        <div class="col-12 ">
                                            <div class="row alin">

                                                <div class=" col-12  mb-3 border-bottom">
                                                    <h2 class="text-start fs-5 textTitulo mb-2">Personales</h2>
                                                </div>

                                                <div class=" col-12 col-sm-6   mb-3 ">
                                                    <label class="labelTitulo">Nombre del Padre:</label></br>
                                                    <input type="text" class="inputCaja" id=""
                                                        name="calle" value="">
                                                </div>

                                                <div class=" col-12 col-sm-6   mb-3 ">
                                                    <label class="labelTitulo">Nombre de la Madre:</label></br>
                                                    <input type="text" class="inputCaja" id=""
                                                        name="calle" value="">
                                                </div>

                                                <div class=" col-12 col-sm-6   mb-3 ">
                                                    <label class="labelTitulo">En Caso de Accidente Avisar
                                                        A:</label></br>
                                                    <input type="text" class="inputCaja" id=""
                                                        name="calle" value="">
                                                </div>

                                                <div class=" col-12 col-sm-6   mb-3 ">
                                                    <label class="labelTitulo">Teléfono:</label></br>
                                                    <input type="text" class="inputCaja" id=""
                                                        name="calle" value="">
                                                </div>

                                                <div class=" col-12 col-sm-6 col-md-4  mb-3 ">
                                                    <label class="labelTitulo">Correo Electrónico:</label></br>
                                                    <input type="text" class="inputCaja" id=""
                                                        name="calle" value="">
                                                </div>

                                                <div class=" col-12 col-sm-6 col-md-4 mb-3 ">
                                                    <label class="labelTitulo">Calle y Número:</label></br>
                                                    <input type="text" class="inputCaja" id=""
                                                        name="calle" value="">
                                                </div>

                                                <div class=" col-12 col-sm-6 col-md-4 mb-3 ">
                                                    <label class="labelTitulo">Colonia:</label></br>
                                                    <input type="text" class="inputCaja" id=""
                                                        name="calle" value="">
                                                </div>

                                                <div class=" col-12 col-sm-6 col-md-4 mb-3 ">
                                                    <label class="labelTitulo">Código Postal:</label></br>
                                                    <input type="text" class="inputCaja" id=""
                                                        name="calle" value="">
                                                </div>

                                                <div class=" col-12 col-sm-6 col-md-4 mb-3 ">
                                                    <label class="labelTitulo">Municipio:</label></br>
                                                    <input type="text" class="inputCaja" id=""
                                                        name="calle" value="">
                                                </div>

                                                <div class=" col-12 col-sm-6 col-md-4 mb-3 ">
                                                    <label class="labelTitulo">Entidad Federativa:</label></br>
                                                    <input type="text" class="inputCaja" id=""
                                                        name="calle" value="">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12  ">
                                            <div class="row">

                                                <div class=" col-12  mb-3 border-bottom"><br>
                                                    <h2 class="text-start fs-5 textTitulo mb-2">Beneficiario
                                                    </h2>
                                                </div>

                                                <div class=" col-12 col-sm-6 col-md-4 mb-3 ">
                                                    <label class="labelTitulo">Nombres:</label></br>
                                                    <input type="text" class="inputCaja" id=""
                                                        name="calle" value="">
                                                </div>

                                                <div class=" col-12 col-sm-6 col-md-4 mb-3 ">
                                                    <label class="labelTitulo">Apellido Paterno:</label></br>
                                                    <input type="text" class="inputCaja" id=""
                                                        name="calle" value="">
                                                </div>

                                                <div class=" col-12 col-sm-6 col-md-4 mb-3 ">
                                                    <label class="labelTitulo">Apellido Materno :</label></br>
                                                    <input type="text" class="inputCaja" id=""
                                                        name="calle" value="">
                                                </div>

                                                <div class=" col-12 col-sm-6 col-md-4 mb-3 ">
                                                    <label class="labelTitulo">Teléfono:</label></br>
                                                    <input type="text" class="inputCaja" id=""
                                                        name="calle" value="">
                                                </div>

                                                <div class=" col-12 col-sm-6 col-md-4 mb-3 ">
                                                    <label class="labelTitulo">Celular:</label></br>
                                                    <input type="text" class="inputCaja" id=""
                                                        name="calle" value="">
                                                </div>

                                                <div class=" col-12 col-sm-6 col-md-4 mb-3 ">
                                                    <label class="labelTitulo">Correo Electrónico:</label></br>
                                                    <input type="text" class="inputCaja" id=""
                                                        name="calle" value="">
                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- Nomina   --}}
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button bacTituloPrincipal" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#datosNomina" aria-expanded="true"
                                    aria-controls="collapseOne">
                                    Datos de Nómina
                                </button>
                            </h2>
                            <div id="datosNomina" class="accordion-collapse collapse" aria-labelledby="headingThree"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="row mt-3">

                                        <div class="col-12 border-end">
                                            <div class="row alin">
                                                <div class=" col-12 col-sm-6 col-lg-3 mb-3 ">
                                                    <label class="labelTitulo">Número de Nómina:</label></br>
                                                    <input type="text" class="inputCaja" id=""
                                                        name="calle" value="">
                                                </div>

                                                <div class=" col-12 col-sm-6 col-lg-3  mb-3 ">
                                                    <label class="labelTitulo">Número de IMSS:</label></br>
                                                    <input type="text" class="inputCaja" id=""
                                                        name="calle" value="">
                                                </div>

                                                <div class=" col-12 col-sm-6 col-lg-3  mb-3 ">
                                                    <label class="labelTitulo">Número de Clínica de
                                                        IMSS:</label></br>
                                                    <input type="text" class="inputCaja" id=""
                                                        name="calle" value="">
                                                </div>

                                                <div class=" col-12 col-sm-6 col-lg-3  mb-3 ">
                                                    <label class="labelTitulo">Crédito Infonavit:</label></br>
                                                    <input type="text" class="inputCaja" id=""
                                                        name="calle" value="">
                                                </div>

                                                <div class=" col-12 col-sm-6 col-lg-3 mb-3 ">
                                                    <label class="labelTitulo">Afore:</label></br>
                                                    <input type="text" class="inputCaja" id=""
                                                        name="calle" value="">
                                                </div>

                                                <div class=" col-12 col-sm-6 col-lg-3 mb-3 ">
                                                    <label class="labelTitulo">Pago
                                                        (Semanal/quincenal):</label></br>
                                                    <select class="form-select" aria-label="Default select example">
                                                        <option selected>Semanal</option>
                                                        <option value="1">Quincenal</option>
                                                    </select>
                                                </div>

                                                <div class=" col-12 col-sm-6 col-lg-3 mb-3 ">
                                                    <label class="labelTitulo">Cantidad:</label></br>
                                                    <input type="text" class="inputCaja" id=""
                                                        name="calle" value="">
                                                </div>

                                                <div class=" col-12 col-sm-6 col-lg-3 mb-3 ">
                                                    <label class="labelTitulo">Número Tarjeta
                                                        Nómina:</label></br>
                                                    <input type="text" class="inputCaja" id=""
                                                        name="calle" value="">
                                                </div>

                                                <div class=" col-12 col-sm-6 col-lg-3 mb-3 ">
                                                    <label class="labelTitulo">Banco:</label></br>
                                                    <input type="text" class="inputCaja" id=""
                                                        name="calle" value="">
                                                </div>

                                                <div class=" col-12 col-sm-6 col-lg-3 mb-3 ">
                                                    <label class="labelTitulo">Puesto:</label></br>
                                                    <input type="text" class="inputCaja" id=""
                                                        name="calle" value="">
                                                </div>

                                                <div class=" col-12 col-sm-6 col-lg-3 mb-3 ">
                                                    <label class="labelTitulo">Permisos:</label></br>
                                                    <select class="form-select" aria-label="Default select example">
                                                        <option selected>Opción 1</option>
                                                        <option value="1">Opcion 2</option>
                                                    </select>
                                                </div>

                                                <div class=" col-12 col-sm-6 col-lg-3 mb-3 ">
                                                    <label class="labelTitulo">Fecha de Ingreso:</label></br>
                                                    <input type="text" class="inputCaja" id=""
                                                        name="calle" value="">
                                                </div>

                                                <div class=" col-12 col-sm-6 col-lg-3 mb-3 ">
                                                    <label class="labelTitulo">Días Trabajados
                                                        (Años/Meses):</label></br>
                                                    <input type="text" class="inputCaja" id=""
                                                        name="calle" value="">
                                                </div>

                                                <div class=" col-12 col-sm-6 col-lg-3 mb-3 ">
                                                    <label class="labelTitulo">Días de Derecho a
                                                        Vacaciones:</label></br>
                                                    <input type="text" class="inputCaja" id=""
                                                        name="calle" value="">
                                                </div>

                                                <div class=" col-12 col-sm-6 col-lg-3 mb-3 ">
                                                    <label class="labelTitulo">Vacaciones Tomadas en el
                                                        Año:</label></br>
                                                    <input type="text" class="inputCaja" id=""
                                                        name="calle" value="">
                                                </div>

                                                <div class=" col-12 col-sm-6 col-lg-3 mb-3 ">
                                                    <label class="labelTitulo">Días Restantes de
                                                        Vacaciones:</label></br>
                                                    <input type="text" class="inputCaja" id=""
                                                        name="calle" value="">
                                                </div>

                                                <div class=" col-12 col-sm-6 col-lg-3 mb-3 ">
                                                    <label class="labelTitulo">Días Laborables:</label></br>
                                                    <input type="text" class="inputCaja" id=""
                                                        name="calle" value="">
                                                </div>


                                                <div class=" col-12 col-sm-6 col-lg-3 mb-3 ">
                                                    <label class="labelTitulo">Horario:</label></br>
                                                    <input type="text" class="inputCaja" id=""
                                                        name="calle" value="">
                                                </div>

                                                <div class=" col-12 col-sm-6 col-lg-3 mb-3 ">
                                                    <label class="labelTitulo">Jefe Inmediato:</label></br>
                                                    <input type="text" class="inputCaja" id=""
                                                        name="calle" value="">
                                                </div>

                                                <div class=" col-12 col-sm-6 col-lg-3 mb-3 ">
                                                    <label class="labelTitulo">Obra o Lugar de
                                                        Trabajo:</label></br>
                                                    <input type="text" class="inputCaja" id=""
                                                        name="calle" value="">
                                                </div>

                                                <div class=" col-12 col-sm-6 col-lg-3 mb-3 ">
                                                    <label class="labelTitulo">Sueldo Neto:</label></br>
                                                    <input type="text" class="inputCaja" id=""
                                                        name="calle" value="">
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{--  Uniforme  --}}
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button bacTituloPrincipal" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#uniforme" aria-expanded="true"
                                    aria-controls="collapseOne">
                                    Uniforme
                                </button>
                            </h2>
                            <div id="uniforme" class="accordion-collapse collapse" aria-labelledby="headingThree"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="row mt-3">

                                        <div class="col-12 border-end">
                                            <div class="row">
                                                <div class=" col-12 col-sm-6 col-lg-3 mb-3 ">
                                                    <label class="labelTitulo">EPP Casco:</label></br>
                                                    <select class="form-select" aria-label="Default select example">
                                                        <option selected>Chica</option>
                                                        <option value="1">Mediana</option>
                                                        <option value="1">Grande</option>
                                                        <option value="1">Extra Grande</option>
                                                    </select>
                                                </div>

                                                <div class=" col-12 col-sm-6 col-lg-3 mb-3 ">
                                                    <label class="labelTitulo">EPP Chaleco:</label></br>
                                                    <select class="form-select" aria-label="Default select example">
                                                        <option selected>Chica</option>
                                                        <option value="1">Mediana</option>
                                                        <option value="1">Grande</option>
                                                        <option value="1">Extra Grande</option>
                                                    </select>
                                                </div>

                                                <div class=" col-12 col-sm-6 col-lg-3 mb-3 ">
                                                    <label class="labelTitulo">EPP Camisas (2):</label></br>
                                                    <select class="form-select" aria-label="Default select example">
                                                        <option selected>Chica</option>
                                                        <option value="1">Mediana</option>
                                                        <option value="1">Grande</option>
                                                        <option value="1">Extra Grande</option>
                                                    </select>
                                                </div>

                                                <div class=" col-12 col-sm-6 col-lg-3 mb-3 ">
                                                    <label class="labelTitulo">EPP Arnes y Línea de
                                                        Vida:</label></br>
                                                    <input type="text" class="inputCaja" id=""
                                                        name="calle" value="">
                                                </div>

                                                <div class=" col-12 col-sm-6 col-lg-3 mb-3 ">
                                                    <label class="labelTitulo">EPP Botas:</label></br>
                                                    <select class="form-select" aria-label="Default select example">
                                                        <option selected>6</option>
                                                        <option value="1">7</option>
                                                        <option value="1">8</option>
                                                        <option value="1">9</option>
                                                    </select>
                                                </div>

                                                <div class=" col-12 col-sm-6 col-lg-3 mb-3 ">
                                                    <label class="labelTitulo">EPP Guentes:</label></br>
                                                    <select class="form-select" aria-label="Default select example">
                                                        <option selected>Chica</option>
                                                        <option value="1">Mediana</option>
                                                        <option value="1">Grande</option>
                                                        <option value="1">Extra Grande</option>
                                                    </select>
                                                </div>

                                                <div class=" col-12 col-sm-6 col-lg-3 mb-3 ">
                                                    <label class="labelTitulo">Epp Lentes:</label></br>
                                                    <input type="text" class="inputCaja" id=""
                                                        name="calle" value="">
                                                </div>

                                                <div class=" col-12 col-sm-6 col-lg-3 mb-3 ">
                                                    <label class="labelTitulo">Credencial:</label></br>
                                                    <input type="text" class="inputCaja" id=""
                                                        name="calle" value="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{--  Asignacion de Equipo  --}}
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button bacTituloPrincipal" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#equipoAsignado" aria-expanded="true"
                                    aria-controls="collapseOne">
                                    Equipo Asignado
                                </button>
                            </h2>
                            <div id="equipoAsignado" class="accordion-collapse collapse" aria-labelledby="headingThree"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="row mt-3">

                                        <div class="col-12 border-end">
                                            <div class="row">

                                                <div class=" col-12 col-sm-6 col-lg-3 mb-3 ">
                                                    <label class="labelTitulo">Automóvil 1
                                                        Asignado:</label></br>
                                                    <input type="text" class="inputCaja" id=""
                                                        name="calle" value="">
                                                </div>

                                                <div class=" col-12 col-sm-6 col-lg-3 mb-3 ">
                                                    <label class="labelTitulo">Automóvil 2
                                                        Asignado:</label></br>
                                                    <input type="text" class="inputCaja" id=""
                                                        name="calle" value="">
                                                </div>

                                                <div class=" col-12 col-sm-6 col-lg-3 mb-3 ">
                                                    <label class="labelTitulo">Equipo de Cómputo:</label></br>
                                                    <input type="text" class="inputCaja" id=""
                                                        name="calle" value="">
                                                </div>

                                                <div class=" col-12 col-sm-6 col-lg-3 mb-3 ">
                                                    <label class="labelTitulo">Número de Serie:</label></br>
                                                    <input type="text" class="inputCaja" id=""
                                                        name="calle" value="">
                                                </div>

                                                <div class=" col-12 col-sm-6 col-lg-3 mb-3 ">
                                                    <label class="labelTitulo">Accesorios:</label></br>
                                                    <input type="text" class="inputCaja" id=""
                                                        name="calle" value="">
                                                </div>

                                                <div class=" col-12 col-sm-6 col-lg-3 mb-3 ">
                                                    <label class="labelTitulo">Radio Cominicación:</label></br>
                                                    <input type="text" class="inputCaja" id=""
                                                        name="calle" value="">
                                                </div>

                                                <div class=" col-12 col-sm-6 col-lg-3 mb-3 ">
                                                    <label class="labelTitulo">Número de Serie:</label></br>
                                                    <input type="text" class="inputCaja" id=""
                                                        name="calle" value="">
                                                </div>

                                                <div class=" col-12 col-sm-6 col-lg-3 mb-3 ">
                                                    <label class="labelTitulo">Cargador Radio Núm. de
                                                        Serie:</label></br>
                                                    <input type="text" class="inputCaja" id=""
                                                        name="calle" value="">
                                                </div>

                                                <div class=" col-12 col-sm-6 col-lg-3 mb-3 ">
                                                    <label class="labelTitulo">Teléfono Celular:</label></br>
                                                    <input type="text" class="inputCaja" id=""
                                                        name="calle" value="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{--  Documentacion  --}}
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button bacTituloPrincipal" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#documentos" aria-expanded="true"
                                    aria-controls="collapseOne">
                                    Documentos
                                </button>
                            </h2>
                            <div id="documentos" class="accordion-collapse collapse" aria-labelledby="headingThree"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="row mt-3">

                                        <div class="col-12">
                                            <div class="row">

                                                <div class="col-12 col-md-6 col-lg-4">
                                                    <div class="card contDocumentos">
                                                        <div class="card-body m-2">

                                                            <div class=" ">
                                                                <input class="form-check-input" type="checkbox"
                                                                    value="" id="flexCheckDefault">
                                                                <label
                                                                    class="form-check-label text-start fs-5 textTitulo mb-2"
                                                                    for="flexCheckDefault">
                                                                    Solicitud o Curriculum Vitae
                                                                </label>
                                                            </div>
                                                            <div class="contIconosDocumentos d-flex align-items-end">
                                                                <div class="semaforo rounded-circle mx-2">
                                                                </div>
                                                                <div class="semaforo rounded-circle mx-2">
                                                                </div>
                                                                <i><img class="mx-2" style="height:23px"
                                                                        src="{{ asset('/img/general/guardarVerde.svg') }}"></i>
                                                                <i><img class="mx-2" style="height:23px"
                                                                        src="{{ asset('/img/general/fotoVerde.svg') }}"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12 col-md-6 col-lg-4">
                                                    <div class="card contDocumentos">
                                                        <div class="card-body m-2">

                                                            <div class=" ">
                                                                <input class="form-check-input" type="checkbox"
                                                                    value="" id="flexCheckDefault">
                                                                <label
                                                                    class="form-check-label text-start fs-5 textTitulo mb-2"
                                                                    for="flexCheckDefault">
                                                                    Acta de Nacimiento
                                                                </label>
                                                            </div>
                                                            <div class="contIconosDocumentos d-flex align-items-end">
                                                                <div class="semaforo rounded-circle mx-2">
                                                                </div>
                                                                <div class="semaforo rounded-circle mx-2">
                                                                </div>
                                                                <i><img class="mx-2" style="height:23px"
                                                                        src="{{ asset('/img/general/guardarVerde.svg') }}"></i>
                                                                <i><img class="mx-2" style="height:23px"
                                                                        src="{{ asset('/img/general/fotoVerde.svg') }}"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12 col-md-6 col-lg-4">
                                                    <div class="card contDocumentos">
                                                        <div class="card-body m-2">

                                                            <div class=" ">
                                                                <input class="form-check-input" type="checkbox"
                                                                    value="" id="flexCheckDefault">
                                                                <label
                                                                    class="form-check-label text-start fs-5 textTitulo mb-2"
                                                                    for="flexCheckDefault">
                                                                    INE
                                                                </label>
                                                            </div>
                                                            <div class="contIconosDocumentos d-flex align-items-end">
                                                                <div class="semaforo rounded-circle mx-2">
                                                                </div>
                                                                <div class="semaforo rounded-circle mx-2">
                                                                </div>
                                                                <i><img class="mx-2" style="height:23px"
                                                                        src="{{ asset('/img/general/guardarVerde.svg') }}"></i>
                                                                <i><img class="mx-2" style="height:23px"
                                                                        src="{{ asset('/img/general/fotoVerde.svg') }}"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12 col-md-6 col-lg-4">
                                                    <div class="card contDocumentos">
                                                        <div class="card-body m-2">

                                                            <div class=" ">
                                                                <input class="form-check-input" type="checkbox"
                                                                    value="" id="flexCheckDefault">
                                                                <label
                                                                    class="form-check-label text-start fs-5 textTitulo mb-2"
                                                                    for="flexCheckDefault">
                                                                    CURP
                                                                </label>
                                                            </div>
                                                            <div class="contIconosDocumentos d-flex align-items-end">
                                                                <div class="semaforo rounded-circle mx-2">
                                                                </div>
                                                                <div class="semaforo rounded-circle mx-2">
                                                                </div>
                                                                <i><img class="mx-2" style="height:23px"
                                                                        src="{{ asset('/img/general/guardarVerde.svg') }}"></i>
                                                                <i><img class="mx-2" style="height:23px"
                                                                        src="{{ asset('/img/general/fotoVerde.svg') }}"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12 col-md-6 col-lg-4">
                                                    <div class="card contDocumentos">
                                                        <div class="card-body m-2">

                                                            <div class=" ">
                                                                <input class="form-check-input" type="checkbox"
                                                                    value="" id="flexCheckDefault">
                                                                <label
                                                                    class="form-check-label text-start fs-5 textTitulo mb-2"
                                                                    for="flexCheckDefault">
                                                                    Licencia (Automovilista / Chofer)
                                                                </label>
                                                            </div>
                                                            <div class="contIconosDocumentos d-flex align-items-end">
                                                                <div class="semaforo rounded-circle mx-2">
                                                                </div>
                                                                <div class="semaforo rounded-circle mx-2">
                                                                </div>
                                                                <i><img class="mx-2" style="height:23px"
                                                                        src="{{ asset('/img/general/guardarVerde.svg') }}"></i>
                                                                <i><img class="mx-2" style="height:23px"
                                                                        src="{{ asset('/img/general/fotoVerde.svg') }}"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12 col-md-6 col-lg-4">
                                                    <div class="card contDocumentos">
                                                        <div class="card-body m-2">

                                                            <div class=" ">
                                                                <input class="form-check-input" type="checkbox"
                                                                    value="" id="flexCheckDefault">
                                                                <label
                                                                    class="form-check-label text-start fs-5 textTitulo mb-2"
                                                                    for="flexCheckDefault">
                                                                    Cédula Profesional
                                                                </label>
                                                            </div>
                                                            <div class="contIconosDocumentos d-flex align-items-end">
                                                                <div class="semaforo rounded-circle mx-2">
                                                                </div>
                                                                <div class="semaforo rounded-circle mx-2">
                                                                </div>
                                                                <i><img class="mx-2" style="height:23px"
                                                                        src="{{ asset('/img/general/guardarVerde.svg') }}"></i>
                                                                <i><img class="mx-2" style="height:23px"
                                                                        src="{{ asset('/img/general/fotoVerde.svg') }}"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12 col-md-6 col-lg-4">
                                                    <div class="card contDocumentos">
                                                        <div class="card-body m-2">

                                                            <div class=" ">
                                                                <input class="form-check-input" type="checkbox"
                                                                    value="" id="flexCheckDefault">
                                                                <label
                                                                    class="form-check-label text-start fs-5 textTitulo mb-2"
                                                                    for="flexCheckDefault">
                                                                    Constancia de Situación Fiscal
                                                                </label>
                                                            </div>
                                                            <div class="contIconosDocumentos d-flex align-items-end">
                                                                <div class="semaforo rounded-circle mx-2">
                                                                </div>
                                                                <div class="semaforo rounded-circle mx-2">
                                                                </div>
                                                                <i><img class="mx-2" style="height:23px"
                                                                        src="{{ asset('/img/general/guardarVerde.svg') }}"></i>
                                                                <i><img class="mx-2" style="height:23px"
                                                                        src="{{ asset('/img/general/fotoVerde.svg') }}"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12 col-md-6 col-lg-4">
                                                    <div class="card contDocumentos">
                                                        <div class="card-body m-2">

                                                            <div class=" ">
                                                                <input class="form-check-input" type="checkbox"
                                                                    value="" id="flexCheckDefault">
                                                                <label
                                                                    class="form-check-label text-start fs-5 textTitulo mb-2"
                                                                    for="flexCheckDefault">
                                                                    Comprobante de Domicilio
                                                                </label>
                                                            </div>
                                                            <div class="contIconosDocumentos d-flex align-items-end">
                                                                <div class="semaforo rounded-circle mx-2">
                                                                </div>
                                                                <div class="semaforo rounded-circle mx-2">
                                                                </div>
                                                                <i><img class="mx-2" style="height:23px"
                                                                        src="{{ asset('/img/general/guardarVerde.svg') }}"></i>
                                                                <i><img class="mx-2" style="height:23px"
                                                                        src="{{ asset('/img/general/fotoVerde.svg') }}"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12 col-md-6 col-lg-4">
                                                    <div class="card contDocumentos">
                                                        <div class="card-body m-2">

                                                            <div class=" ">
                                                                <input class="form-check-input" type="checkbox"
                                                                    value="" id="flexCheckDefault">
                                                                <label
                                                                    class="form-check-label text-start fs-5 textTitulo mb-2"
                                                                    for="flexCheckDefault">
                                                                    Carta de no Antecedentes Penales
                                                                </label>
                                                            </div>
                                                            <div class="contIconosDocumentos d-flex align-items-end">
                                                                <div class="semaforo rounded-circle mx-2">
                                                                </div>
                                                                <div class="semaforo rounded-circle mx-2">
                                                                </div>
                                                                <i><img class="mx-2" style="height:23px"
                                                                        src="{{ asset('/img/general/guardarVerde.svg') }}"></i>
                                                                <i><img class="mx-2" style="height:23px"
                                                                        src="{{ asset('/img/general/fotoVerde.svg') }}"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12 col-md-6 col-lg-4">
                                                    <div class="card contDocumentos">
                                                        <div class="card-body m-2">

                                                            <div class=" ">
                                                                <input class="form-check-input" type="checkbox"
                                                                    value="" id="flexCheckDefault">
                                                                <label
                                                                    class="form-check-label text-start fs-5 textTitulo mb-2"
                                                                    for="flexCheckDefault">
                                                                    Cartas de Recomendación
                                                                </label>
                                                            </div>
                                                            <div class="contIconosDocumentos d-flex align-items-end">
                                                                <div class="semaforo rounded-circle mx-2">
                                                                </div>
                                                                <div class="semaforo rounded-circle mx-2">
                                                                </div>
                                                                <i><img class="mx-2" style="height:23px"
                                                                        src="{{ asset('/img/general/guardarVerde.svg') }}"></i>
                                                                <i><img class="mx-2" style="height:23px"
                                                                        src="{{ asset('/img/general/fotoVerde.svg') }}"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12 col-md-6 col-lg-4">
                                                    <div class="card contDocumentos">
                                                        <div class="card-body m-2">

                                                            <div class=" ">
                                                                <input class="form-check-input" type="checkbox"
                                                                    value="" id="flexCheckDefault">
                                                                <label
                                                                    class="form-check-label text-start fs-5 textTitulo mb-2"
                                                                    for="flexCheckDefault">
                                                                    DC3
                                                                </label>
                                                            </div>
                                                            <div class="contIconosDocumentos d-flex align-items-end">
                                                                <div class="semaforo rounded-circle mx-2">
                                                                </div>
                                                                <div class="semaforo rounded-circle mx-2">
                                                                </div>
                                                                <i><img class="mx-2" style="height:23px"
                                                                        src="{{ asset('/img/general/guardarVerde.svg') }}"></i>
                                                                <i><img class="mx-2" style="height:23px"
                                                                        src="{{ asset('/img/general/fotoVerde.svg') }}"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12 col-md-6 col-lg-4">
                                                    <div class="card contDocumentos">
                                                        <div class="card-body m-2">

                                                            <div class=" ">
                                                                <input class="form-check-input" type="checkbox"
                                                                    value="" id="flexCheckDefault">
                                                                <label
                                                                    class="form-check-label text-start fs-5 textTitulo mb-2"
                                                                    for="flexCheckDefault">
                                                                    Exámen Médico
                                                                </label>
                                                            </div>
                                                            <div class="contIconosDocumentos d-flex align-items-end">
                                                                <div class="semaforo rounded-circle mx-2">
                                                                </div>
                                                                <div class="semaforo rounded-circle mx-2">
                                                                </div>
                                                                <i><img class="mx-2" style="height:23px"
                                                                        src="{{ asset('/img/general/guardarVerde.svg') }}"></i>
                                                                <i><img class="mx-2" style="height:23px"
                                                                        src="{{ asset('/img/general/fotoVerde.svg') }}"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12 col-md-6 col-lg-4">
                                                    <div class="card contDocumentos">
                                                        <div class="card-body m-2">

                                                            <div class=" ">
                                                                <input class="form-check-input" type="checkbox"
                                                                    value="" id="flexCheckDefault">
                                                                <label
                                                                    class="form-check-label text-start fs-5 textTitulo mb-2"
                                                                    for="flexCheckDefault">
                                                                    Prueba Antidoping
                                                                </label>
                                                            </div>
                                                            <div class="contIconosDocumentos d-flex align-items-end">
                                                                <div class="semaforo rounded-circle mx-2">
                                                                </div>
                                                                <div class="semaforo rounded-circle mx-2">
                                                                </div>
                                                                <i><img class="mx-2" style="height:23px"
                                                                        src="{{ asset('/img/general/guardarVerde.svg') }}"></i>
                                                                <i><img class="mx-2" style="height:23px"
                                                                        src="{{ asset('/img/general/fotoVerde.svg') }}"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12 col-md-6 col-lg-4">
                                                    <div class="card contDocumentos">
                                                        <div class="card-body m-2">

                                                            <div class=" ">
                                                                <input class="form-check-input" type="checkbox"
                                                                    value="" id="flexCheckDefault">
                                                                <label
                                                                    class="form-check-label text-start fs-5 textTitulo mb-2"
                                                                    for="flexCheckDefault">
                                                                    Comprobante de Estudios
                                                                </label>
                                                            </div>
                                                            <div class="contIconosDocumentos d-flex align-items-end">
                                                                <div class="semaforo rounded-circle mx-2">
                                                                </div>
                                                                <div class="semaforo rounded-circle mx-2">
                                                                </div>
                                                                <i><img class="mx-2" style="height:23px"
                                                                        src="{{ asset('/img/general/guardarVerde.svg') }}"></i>
                                                                <i><img class="mx-2" style="height:23px"
                                                                        src="{{ asset('/img/general/fotoVerde.svg') }}"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12 col-md-6 col-lg-4">
                                                    <div class="card contDocumentos">
                                                        <div class="card-body m-2">

                                                            <div class=" ">
                                                                <input class="form-check-input" type="checkbox"
                                                                    value="" id="flexCheckDefault">
                                                                <label
                                                                    class="form-check-label text-start fs-5 textTitulo mb-2"
                                                                    for="flexCheckDefault">
                                                                    Número de Seguro Social
                                                                </label>
                                                            </div>
                                                            <div class="contIconosDocumentos d-flex align-items-end">
                                                                <div class="semaforo rounded-circle mx-2">
                                                                </div>
                                                                <div class="semaforo rounded-circle mx-2">
                                                                </div>
                                                                <i><img class="mx-2" style="height:23px"
                                                                        src="{{ asset('/img/general/guardarVerde.svg') }}"></i>
                                                                <i><img class="mx-2" style="height:23px"
                                                                        src="{{ asset('/img/general/fotoVerde.svg') }}"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12 col-md-6 col-lg-4">
                                                    <div class="card contDocumentos">
                                                        <div class="card-body m-2">

                                                            <div class=" ">
                                                                <input class="form-check-input" type="checkbox"
                                                                    value="" id="flexCheckDefault">
                                                                <label
                                                                    class="form-check-label text-start fs-5 textTitulo mb-2"
                                                                    for="flexCheckDefault">
                                                                    Aviso de Retención de Infonavit
                                                                </label>
                                                            </div>
                                                            <div class="contIconosDocumentos d-flex align-items-end">
                                                                <div class="semaforo rounded-circle mx-2">
                                                                </div>
                                                                <div class="semaforo rounded-circle mx-2">
                                                                </div>
                                                                <i><img class="mx-2" style="height:23px"
                                                                        src="{{ asset('/img/general/guardarVerde.svg') }}"></i>
                                                                <i><img class="mx-2" style="height:23px"
                                                                        src="{{ asset('/img/general/fotoVerde.svg') }}"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12 col-md-6 col-lg-4">
                                                    <div class="card contDocumentos">
                                                        <div class="card-body m-2">

                                                            <div class=" ">
                                                                <input class="form-check-input" type="checkbox"
                                                                    value="" id="flexCheckDefault">
                                                                <label
                                                                    class="form-check-label text-start fs-5 textTitulo mb-2"
                                                                    for="flexCheckDefault">
                                                                    Gestión de Días de Vacaciones
                                                                </label>
                                                            </div>
                                                            <div class="contIconosDocumentos d-flex align-items-end">
                                                                <div class="semaforo rounded-circle mx-2">
                                                                </div>
                                                                <div class="semaforo rounded-circle mx-2">
                                                                </div>
                                                                <i><img class="mx-2" style="height:23px"
                                                                        src="{{ asset('/img/general/guardarVerde.svg') }}"></i>
                                                                <i><img class="mx-2" style="height:23px"
                                                                        src="{{ asset('/img/general/fotoVerde.svg') }}"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12 col-md-6 col-lg-4">
                                                    <div class="card contDocumentos">
                                                        <div class="card-body m-2">

                                                            <div class=" ">
                                                                <input class="form-check-input" type="checkbox"
                                                                    value="" id="flexCheckDefault">
                                                                <label
                                                                    class="form-check-label text-start fs-5 textTitulo mb-2"
                                                                    for="flexCheckDefault">
                                                                    Perfil y Descripción del Puesto
                                                                </label>
                                                            </div>
                                                            <div class="contIconosDocumentos d-flex align-items-end">
                                                                <div class="semaforo rounded-circle mx-2">
                                                                </div>
                                                                <div class="semaforo rounded-circle mx-2">
                                                                </div>
                                                                <i><img class="mx-2" style="height:23px"
                                                                        src="{{ asset('/img/general/guardarVerde.svg') }}"></i>
                                                                <i><img class="mx-2" style="height:23px"
                                                                        src="{{ asset('/img/general/fotoVerde.svg') }}"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12 col-md-6 col-lg-4">
                                                    <div class="card contDocumentos">
                                                        <div class="card-body m-2">

                                                            <div class=" ">
                                                                <input class="form-check-input" type="checkbox"
                                                                    value="" id="flexCheckDefault">
                                                                <label
                                                                    class="form-check-label text-start fs-5 textTitulo mb-2"
                                                                    for="flexCheckDefault">
                                                                    Contrato Firmado
                                                                </label>
                                                            </div>
                                                            <div class="contIconosDocumentos d-flex align-items-end">
                                                                <div class="semaforo rounded-circle mx-2">
                                                                </div>
                                                                <div class="semaforo rounded-circle mx-2">
                                                                </div>
                                                                <i><img class="mx-2" style="height:23px"
                                                                        src="{{ asset('/img/general/guardarVerde.svg') }}"></i>
                                                                <i><img class="mx-2" style="height:23px"
                                                                        src="{{ asset('/img/general/fotoVerde.svg') }}"></i>

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
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
