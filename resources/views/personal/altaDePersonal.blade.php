@extends('layouts.main', ['activePage' => 'personal', 'titlePage' => __('Alta de Personal')])
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                    <div class="col-11 align-self-start">
                        <div class="card">
                            <div class="card-body contCart"> 
                                <form class="row">
                                    <div class="accordion my-3" id="accordionExample">

                                        <div class="accordion-item">
                                          <h2 class="accordion-header " id="headingOne">
                                            <button class="accordion-button bacTituloPrincipal" type="button" data-bs-toggle="collapse" data-bs-target="#datosPersonales" aria-expanded="true" aria-controls="collapseOne">
                                              Datos Personales
                                            </button>
                                          </h2>
                                          <div id="datosPersonales" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <div class="row mt-3">
                                                    <div class="col-12 col-md-4  "> 
                                                        <div class="text-center mx-auto border vistaFoto mb-4">
                                                            <i><img class="imgVista img-fluid mb-5" src="{{ asset('/img/general/vistaAerea.jpg') }}"></i>
                                                            <input class="mb-4" type="file" name="logo" id=" ">
                                                        </div>
                                                    </div>  
                                                                                        
                                                    <div class="col-12 col-md-8 ">  
                                                        <div class="row">
                                                                                                
                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Número del Empleado:</label></br>
                                                                <input type="text" class="inputCaja" id="" name="calle" value="">
                                                            </div>
                                                
                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Nombre(s):</label></br>
                                                                <input type="text" class="inputCaja" id="" name="calle" value="">
                                                            </div>
                                                
                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Apellido Paterno:</label></br>
                                                                <input type="text" class="inputCaja" id="" name="calle" value="">
                                                            </div>
                                                
                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Apellio Materno:</label></br>
                                                                <input type="text" class="inputCaja" id="" name="calle" value="">
                                                            </div>
                                                
                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Fecha de Nacimiento:</label></br>
                                                                <input type="text" class="inputCaja" id="" name="calle" value="">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Lugar de Nacimiento:</label></br>
                                                                <input type="text" class="inputCaja" id="" name="calle" value="">
                                                            </div>
                                                
                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Edad:</label></br>
                                                                <input type="text" class="inputCaja" id="" name="calle" value="">
                                                            </div>
                                                
                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">CURP:</label></br>
                                                                <input type="text" class="inputCaja" id="" name="calle" value="">
                                                            </div>
                                                
                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">RFC:</label></br>
                                                                <input type="text" class="inputCaja" id="" name="calle" value="">
                                                            </div>
                                                
                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Sexo:</label></br>
                                                                <input type="text" class="inputCaja" id="" name="calle" value="">
                                                            </div>
                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Folio INE:</label></br>
                                                                <input type="text" class="inputCaja" id="" name="calle" value="">
                                                            </div>
                                                
                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Núm. Licencia (Automovilista / Chofer):</label></br>
                                                                <input type="text" class="inputCaja" id="" name="calle" value="">
                                                            </div>
                                                
                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Cédula Profesional Federal:</label></br>
                                                                <input type="text" class="inputCaja" id="" name="calle" value="">
                                                            </div>
                                                
                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Cédula Profesional Estatal:</label></br>
                                                                <input type="text" class="inputCaja" id="" name="calle" value="">
                                                            </div>
                                                
                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Hijos:</label></br>
                                                                <input type="text" class="inputCaja" id="" name="calle" value="">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Estado Civil:</label></br>
                                                                <input type="text" class="inputCaja" id="" name="calle" value="">
                                                            </div>
                                                
                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Tipo de Sangre:</label></br>
                                                                <input type="text" class="inputCaja" id="" name="calle" value="">
                                                            </div>
                                                
                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Alergias:</label></br>
                                                                <input type="text" class="inputCaja" id="" name="calle" value="">
                                                            </div>
                                                
                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Profesión:</label></br>
                                                                <input type="text" class="inputCaja" id="" name="calle" value="">
                                                            </div>
                                                
                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Teléfono de Casa:</label></br>
                                                                <input type="text" class="inputCaja" id="" name="calle" value="">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Celular:</label></br>
                                                                <input type="text" class="inputCaja" id="" name="calle" value="">
                                                            </div>
                                                
                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Correo Electrónico Personal:</label></br>
                                                                <input type="text" class="inputCaja" id="" name="calle" value="">
                                                            </div>
                                                
                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Correo Electrónico Empresa:</label></br>
                                                                <input type="text" class="inputCaja" id="" name="calle" value="">
                                                            </div>                                                
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                          </div>
                                        </div>

                                        <div class="accordion-item">
                                          <h2 class="accordion-header" id="headingTwo">
                                            <button class="accordion-button bacTituloPrincipal" type="button" data-bs-toggle="collapse" data-bs-target="#direcciones" aria-expanded="true" aria-controls="collapseOne">
                                              Direcciones
                                            </button>
                                          </h2>
                                          <div id="direcciones" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <div class="row mt-3">

                                                    <div class="col-12 col-lg-6 border-end">  
                                                        <div class="row">

                                                            <div class=" col-12  mb-3 border-bottom">
                                                                <h2 class="text-start fs-5 textTitulo mb-2">Física</h2>
                                                            </div>
                                                          
                                                            <div class=" col-12 col-sm-6  mb-3 ">
                                                                <label class="labelTitulo">Calle y Número:</label></br>
                                                                <input type="text" class="inputCaja" id="" name="calle" value="">
                                                            </div>
                                                
                                                            <div class=" col-12 col-sm-6  mb-3 ">
                                                                <label class="labelTitulo">Número Exterior:</label></br>
                                                                <input type="text" class="inputCaja" id="" name="calle" value="">
                                                            </div>
                                                
                                                            <div class=" col-12 col-sm-6  mb-3 ">
                                                                <label class="labelTitulo">Número Interior:</label></br>
                                                                <input type="text" class="inputCaja" id="" name="calle" value="">
                                                            </div>

                                                            <div class=" col-12 col-sm-6  mb-3 ">
                                                                <label class="labelTitulo">Entre las Calles:</label></br>
                                                                <input type="text" class="inputCaja" id="" name="calle" value="">
                                                            </div>
                                                
                                                            <div class=" col-12 col-sm-6  mb-3 ">
                                                                <label class="labelTitulo">Colonia:</label></br>
                                                                <input type="text" class="inputCaja" id="" name="calle" value="">
                                                            </div>
                                                
                                                            <div class=" col-12 col-sm-6  mb-3 ">
                                                                <label class="labelTitulo">Código Postal:</label></br>
                                                                <input type="text" class="inputCaja" id="" name="calle" value="">
                                                            </div>

                                                            <div class=" col-12 col-sm-6  mb-3 ">
                                                                <label class="labelTitulo">Localidad:</label></br>
                                                                <input type="text" class="inputCaja" id="" name="calle" value="">
                                                            </div>
                                                
                                                            <div class=" col-12 col-sm-6  mb-3 ">
                                                                <label class="labelTitulo">Municipio:</label></br>
                                                                <input type="text" class="inputCaja" id="" name="calle" value="">
                                                            </div>

                                                            <div class=" col-12 col-sm-6  mb-3 ">
                                                                <label class="labelTitulo">Entidad Federativa:</label></br>
                                                                <input type="text" class="inputCaja" id="" name="calle" value="">
                                                            </div>

                                                            <div class=" col-12 col-sm-6  mb-3 ">
                                                                <label class="labelTitulo">Casa Propia o Rentada:</label></br>
                                                                <input type="text" class="inputCaja" id="" name="calle" value="">
                                                            </div>
                                                
                                                        </div>
                                                    </div>  
                                                                                        
                                                    <div class="col-12 col-lg-6 ">  
                                                        <div class="row">

                                                            <div class=" col-12  mb-3 border-bottom">
                                                                <h2 class="text-start fs-5 textTitulo mb-2">Fiscal</h2>
                                                            </div>
                                                          
                                                            <div class=" col-12 col-sm-6  mb-3 ">
                                                                <label class="labelTitulo">Calle y Número:</label></br>
                                                                <input type="text" class="inputCaja" id="" name="calle" value="">
                                                            </div>
                                                
                                                            <div class=" col-12 col-sm-6  mb-3 ">
                                                                <label class="labelTitulo">Número Exterior:</label></br>
                                                                <input type="text" class="inputCaja" id="" name="calle" value="">
                                                            </div>
                                                
                                                            <div class=" col-12 col-sm-6  mb-3 ">
                                                                <label class="labelTitulo">Número Interior:</label></br>
                                                                <input type="text" class="inputCaja" id="" name="calle" value="">
                                                            </div>

                                                            <div class=" col-12 col-sm-6  mb-3 ">
                                                                <label class="labelTitulo">Entre las Calles:</label></br>
                                                                <input type="text" class="inputCaja" id="" name="calle" value="">
                                                            </div>
                                                
                                                            <div class=" col-12 col-sm-6  mb-3 ">
                                                                <label class="labelTitulo">Colonia:</label></br>
                                                                <input type="text" class="inputCaja" id="" name="calle" value="">
                                                            </div>
                                                
                                                            <div class=" col-12 col-sm-6  mb-3 ">
                                                                <label class="labelTitulo">Código Postal:</label></br>
                                                                <input type="text" class="inputCaja" id="" name="calle" value="">
                                                            </div>

                                                            <div class=" col-12 col-sm-6  mb-3 ">
                                                                <label class="labelTitulo">Localidad:</label></br>
                                                                <input type="text" class="inputCaja" id="" name="calle" value="">
                                                            </div>
                                                
                                                            <div class=" col-12 col-sm-6  mb-3 ">
                                                                <label class="labelTitulo">Municipio:</label></br>
                                                                <input type="text" class="inputCaja" id="" name="calle" value="">
                                                            </div>
                                                            <div class=" col-12 col-sm-6  mb-3 ">
                                                                <label class="labelTitulo">Entidad Federativa:</label></br>
                                                                <input type="text" class="inputCaja" id="" name="calle" value="">
                                                            </div>
                                                
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                          </div>
                                        </div>

                                        <div class="accordion-item">
                                          <h2 class="accordion-header" id="headingThree">
                                            <button class="accordion-button bacTituloPrincipal" type="button" data-bs-toggle="collapse" data-bs-target="#datosFamiliares" aria-expanded="true" aria-controls="collapseOne">
                                              Datos Familiares
                                            </button>
                                          </h2>
                                          <div id="datosFamiliares" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <div class="row mt-3">

                                                    <div class="col-12 col-lg-6 border-end">  
                                                        <div class="row">

                                                            <div class=" col-12  mb-3 border-bottom">
                                                                <h2 class="text-start fs-5 textTitulo mb-2">Personales</h2>
                                                            </div>
                                                          
                                                            <div class=" col-12 col-sm-6  mb-3 ">
                                                                <label class="labelTitulo">Nombre del Padre:</label></br>
                                                                <input type="text" class="inputCaja" id="" name="calle" value="">
                                                            </div>
                                                
                                                            <div class=" col-12 col-sm-6  mb-3 ">
                                                                <label class="labelTitulo">Nombre e la Madre:</label></br>
                                                                <input type="text" class="inputCaja" id="" name="calle" value="">
                                                            </div>
                                                
                                                            <div class=" col-12 col-sm-6  mb-3 ">
                                                                <label class="labelTitulo">En Caso de Accidente Avisar A:</label></br>
                                                                <input type="text" class="inputCaja" id="" name="calle" value="">
                                                            </div>

                                                            <div class=" col-12 col-sm-6  mb-3 ">
                                                                <label class="labelTitulo">Teléfono:</label></br>
                                                                <input type="text" class="inputCaja" id="" name="calle" value="">
                                                            </div>
                                                
                                                            <div class=" col-12 col-sm-6  mb-3 ">
                                                                <label class="labelTitulo">Correo Electrónico:</label></br>
                                                                <input type="text" class="inputCaja" id="" name="calle" value="">
                                                            </div>

                                                            <div class=" col-12 col-sm-6  mb-3 ">
                                                                <label class="labelTitulo">Calle y Número:</label></br>
                                                                <input type="text" class="inputCaja" id="" name="calle" value="">
                                                            </div>

                                                            <div class=" col-12 col-sm-6  mb-3 ">
                                                                <label class="labelTitulo">Colonia:</label></br>
                                                                <input type="text" class="inputCaja" id="" name="calle" value="">
                                                            </div>
                                                
                                                            <div class=" col-12 col-sm-6  mb-3 ">
                                                                <label class="labelTitulo">Código Postal:</label></br>
                                                                <input type="text" class="inputCaja" id="" name="calle" value="">
                                                            </div>

                                                            <div class=" col-12 col-sm-6  mb-3 ">
                                                                <label class="labelTitulo">Localidad:</label></br>
                                                                <input type="text" class="inputCaja" id="" name="calle" value="">
                                                            </div>
                                                
                                                            <div class=" col-12 col-sm-6  mb-3 ">
                                                                <label class="labelTitulo">Municipio:</label></br>
                                                                <input type="text" class="inputCaja" id="" name="calle" value="">
                                                            </div>

                                                            <div class=" col-12 col-sm-6  mb-3 ">
                                                                <label class="labelTitulo">Entidad Federativa:</label></br>
                                                                <input type="text" class="inputCaja" id="" name="calle" value="">
                                                            </div>
                                                
                                                        </div>
                                                    </div>  
                                                                                        
                                                    <div class="col-12 col-lg-6 ">  
                                                        <div class="row">

                                                            <div class=" col-12  mb-3 border-bottom">
                                                                <h2 class="text-start fs-5 textTitulo mb-2">Beneficiario</h2>
                                                            </div>
                                                          
                                                            <div class=" col-12 col-sm-6  mb-3 ">
                                                                <label class="labelTitulo">Nombre del Padre:</label></br>
                                                                <input type="text" class="inputCaja" id="" name="calle" value="">
                                                            </div>
                                                
                                                            <div class=" col-12 col-sm-6  mb-3 ">
                                                                <label class="labelTitulo">Nombre e la Madre:</label></br>
                                                                <input type="text" class="inputCaja" id="" name="calle" value="">
                                                            </div>
                                                
                                                            <div class=" col-12 col-sm-6  mb-3 ">
                                                                <label class="labelTitulo">En Caso de Accidente Avisar A:</label></br>
                                                                <input type="text" class="inputCaja" id="" name="calle" value="">
                                                            </div>

                                                            <div class=" col-12 col-sm-6  mb-3 ">
                                                                <label class="labelTitulo">Teléfono:</label></br>
                                                                <input type="text" class="inputCaja" id="" name="calle" value="">
                                                            </div>
                                                
                                                            <div class=" col-12 col-sm-6  mb-3 ">
                                                                <label class="labelTitulo">Correo Electrónico:</label></br>
                                                                <input type="text" class="inputCaja" id="" name="calle" value="">
                                                            </div>

                                                            <div class=" col-12 col-sm-6  mb-3 ">
                                                                <label class="labelTitulo">Calle y Número:</label></br>
                                                                <input type="text" class="inputCaja" id="" name="calle" value="">
                                                            </div>

                                                            <div class=" col-12 col-sm-6  mb-3 ">
                                                                <label class="labelTitulo">Colonia:</label></br>
                                                                <input type="text" class="inputCaja" id="" name="calle" value="">
                                                            </div>
                                                
                                                            <div class=" col-12 col-sm-6  mb-3 ">
                                                                <label class="labelTitulo">Código Postal:</label></br>
                                                                <input type="text" class="inputCaja" id="" name="calle" value="">
                                                            </div>

                                                            <div class=" col-12 col-sm-6  mb-3 ">
                                                                <label class="labelTitulo">Localidad:</label></br>
                                                                <input type="text" class="inputCaja" id="" name="calle" value="">
                                                            </div>
                                                
                                                            <div class=" col-12 col-sm-6  mb-3 ">
                                                                <label class="labelTitulo">Municipio:</label></br>
                                                                <input type="text" class="inputCaja" id="" name="calle" value="">
                                                            </div>

                                                            <div class=" col-12 col-sm-6  mb-3 ">
                                                                <label class="labelTitulo">Entidad Federativa:</label></br>
                                                                <input type="text" class="inputCaja" id="" name="calle" value="">
                                                            </div>
                                                
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                          </div>
                                        </div>

                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingThree">
                                              <button class="accordion-button bacTituloPrincipal" type="button" data-bs-toggle="collapse" data-bs-target="#datosNomina" aria-expanded="true" aria-controls="collapseOne">
                                                Datos de Nómina
                                              </button>
                                            </h2>
                                            <div id="datosNomina" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                              <div class="accordion-body">
                                                  <div class="row mt-3">
  
                                                      <div class="col-12 border-end">  
                                                          <div class="row">
                                                              <div class=" col-12 col-sm-6 col-lg-3 mb-3 ">
                                                                <label class="labelTitulo">Número de Nómina:</label></br>
                                                                <input type="text" class="inputCaja" id="" name="calle" value="">
                                                            </div>
                                                            
                                                              <div class=" col-12 col-sm-6 col-lg-3  mb-3 ">
                                                                  <label class="labelTitulo">Número de IMSS:</label></br>
                                                                  <input type="text" class="inputCaja" id="" name="calle" value="">
                                                              </div>
                                                  
                                                              <div class=" col-12 col-sm-6 col-lg-3  mb-3 ">
                                                                  <label class="labelTitulo">Número de Clínica de IMSS:</label></br>
                                                                  <input type="text" class="inputCaja" id="" name="calle" value="">
                                                              </div>
                                                  
                                                              <div class=" col-12 col-sm-6 col-lg-3  mb-3 ">
                                                                  <label class="labelTitulo">Crédito Infonavit:</label></br>
                                                                  <input type="text" class="inputCaja" id="" name="calle" value="">
                                                              </div>
  
                                                              <div class=" col-12 col-sm-6 col-lg-3 mb-3 ">
                                                                  <label class="labelTitulo">Afore:</label></br>
                                                                  <input type="text" class="inputCaja" id="" name="calle" value="">
                                                              </div>
                                                  
                                                              <div class=" col-12 col-sm-6 col-lg-3 mb-3 ">
                                                                  <label class="labelTitulo">Pago (Semanal/quincenal):</label></br>
                                                                  <select class="form-select" aria-label="Default select example">
                                                                      <option selected>Semanal</option>
                                                                      <option value="1">Quincenal</option>
                                                                    </select>
                                                              </div>

                                                              <div class=" col-12 col-sm-6 col-lg-3 mb-3 ">
                                                                <label class="labelTitulo">Cantidad:</label></br>
                                                                <input type="text" class="inputCaja" id="" name="calle" value="">
                                                            </div>
  
                                                              <div class=" col-12 col-sm-6 col-lg-3 mb-3 ">
                                                                  <label class="labelTitulo">Número Tarjeta Nómina:</label></br>
                                                                  <input type="text" class="inputCaja" id="" name="calle" value="">
                                                              </div>
  
                                                              <div class=" col-12 col-sm-6 col-lg-3 mb-3 ">
                                                                  <label class="labelTitulo">Banco:</label></br>
                                                                  <input type="text" class="inputCaja" id="" name="calle" value="">
                                                              </div>
                                                  
                                                              <div class=" col-12 col-sm-6 col-lg-3 mb-3 ">
                                                                  <label class="labelTitulo">Puesto:</label></br>
                                                                  <input type="text" class="inputCaja" id="" name="calle" value="">
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
                                                                  <input type="text" class="inputCaja" id="" name="calle" value="">
                                                              </div>
  
                                                              <div class=" col-12 col-sm-6 col-lg-3 mb-3 ">
                                                                  <label class="labelTitulo">Días Trabajados (Años/Meses):</label></br>
                                                                  <input type="text" class="inputCaja" id="" name="calle" value="">
                                                              </div>

                                                              <div class=" col-12 col-sm-6 col-lg-3 mb-3 ">
                                                                <label class="labelTitulo">Días de Derecho a Vacaciones:</label></br>
                                                                <input type="text" class="inputCaja" id="" name="calle" value="">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-3 mb-3 ">
                                                                <label class="labelTitulo">Vacaciones Tomadas en el Año:</label></br>
                                                                <input type="text" class="inputCaja" id="" name="calle" value="">
                                                            </div>
                                                
                                                            <div class=" col-12 col-sm-6 col-lg-3 mb-3 ">
                                                                <label class="labelTitulo">Días Restantes de Vacaciones:</label></br>
                                                                <input type="text" class="inputCaja" id="" name="calle" value="">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-3 mb-3 ">
                                                                <label class="labelTitulo">Días Laborables:</label></br>
                                                                <input type="text" class="inputCaja" id="" name="calle" value="">
                                                            </div>


                                                            <div class=" col-12 col-sm-6 col-lg-3 mb-3 ">
                                                                <label class="labelTitulo">Horario:</label></br>
                                                                <input type="text" class="inputCaja" id="" name="calle" value="">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-3 mb-3 ">
                                                                <label class="labelTitulo">Jefe Inmediato:</label></br>
                                                                <input type="text" class="inputCaja" id="" name="calle" value="">
                                                            </div>
                                                
                                                            <div class=" col-12 col-sm-6 col-lg-3 mb-3 ">
                                                                <label class="labelTitulo">Obra o Lugar de Trabajo:</label></br>
                                                                <input type="text" class="inputCaja" id="" name="calle" value="">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-3 mb-3 ">
                                                                <label class="labelTitulo">Sueldo Neto:</label></br>
                                                                <input type="text" class="inputCaja" id="" name="calle" value="">
                                                            </div>
                                                  
                                                          </div>
                                                      </div>  
                                                                                          

                                                  </div>
                                              </div>
                                            </div>
                                        </div>

                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingThree">
                                              <button class="accordion-button bacTituloPrincipal" type="button" data-bs-toggle="collapse" data-bs-target="#uniforme" aria-expanded="true" aria-controls="collapseOne">
                                                Uniforme
                                              </button>
                                            </h2>
                                            <div id="uniforme" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
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
                                                                <label class="labelTitulo">EPP Arnes y Línea de Vida:</label></br>
                                                                <input type="text" class="inputCaja" id="" name="calle" value="">
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
                                                                  <input type="text" class="inputCaja" id="" name="calle" value="">
                                                              </div>
  
                                                              <div class=" col-12 col-sm-6 col-lg-3 mb-3 ">
                                                                <label class="labelTitulo">Credencial:</label></br>
                                                                <input type="text" class="inputCaja" id="" name="calle" value="">
                                                              </div>
                                                        </div>
                                                    </div>  
                                                                                          

                                                  </div>
                                              </div>
                                            </div>
                                        </div>

                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingThree">
                                              <button class="accordion-button bacTituloPrincipal" type="button" data-bs-toggle="collapse" data-bs-target="#equipoAsignado" aria-expanded="true" aria-controls="collapseOne">
                                                Equipo Asignado
                                              </button>
                                            </h2>
                                            <div id="equipoAsignado" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <div class="row mt-3">
  
                                                        <div class="col-12 border-end">  
                                                          <div class="row">

                                                            <div class=" col-12 col-sm-6 col-lg-3 mb-3 ">
                                                                <label class="labelTitulo">Automóvil 1 Asignado:</label></br>
                                                                <input type="text" class="inputCaja" id="" name="calle" value="">
                                                            </div>

                                                            <div class=" col-12 col-sm-6 col-lg-3 mb-3 ">
                                                                <label class="labelTitulo">Automóvil 2 Asignado:</label></br>
                                                                <input type="text" class="inputCaja" id="" name="calle" value="">
                                                            </div>

                                                              <div class=" col-12 col-sm-6 col-lg-3 mb-3 ">
                                                                  <label class="labelTitulo">Equipo de Cómputo:</label></br>
                                                                  <input type="text" class="inputCaja" id="" name="calle" value="">
                                                              </div>
  
                                                              <div class=" col-12 col-sm-6 col-lg-3 mb-3 ">
                                                                <label class="labelTitulo">Número de Serie:</label></br>
                                                                <input type="text" class="inputCaja" id="" name="calle" value="">
                                                              </div>

                                                              <div class=" col-12 col-sm-6 col-lg-3 mb-3 ">
                                                                <label class="labelTitulo">Accesorios:</label></br>
                                                                <input type="text" class="inputCaja" id="" name="calle" value="">
                                                              </div>

                                                              <div class=" col-12 col-sm-6 col-lg-3 mb-3 ">
                                                                <label class="labelTitulo">Radio Cominicación:</label></br>
                                                                <input type="text" class="inputCaja" id="" name="calle" value="">
                                                              </div>

                                                              <div class=" col-12 col-sm-6 col-lg-3 mb-3 ">
                                                                <label class="labelTitulo">Número de Serie:</label></br>
                                                                <input type="text" class="inputCaja" id="" name="calle" value="">
                                                              </div>

                                                              <div class=" col-12 col-sm-6 col-lg-3 mb-3 ">
                                                                <label class="labelTitulo">Cargador Radio Núm. de Serie:</label></br>
                                                                <input type="text" class="inputCaja" id="" name="calle" value="">
                                                              </div>

                                                              <div class=" col-12 col-sm-6 col-lg-3 mb-3 ">
                                                                <label class="labelTitulo">Teléfono Celular:</label></br>
                                                                <input type="text" class="inputCaja" id="" name="calle" value="">
                                                              </div>

                                                        </div>
                                                    </div>  
                                                                                          

                                                  </div>
                                              </div>
                                            </div>
                                        </div>

                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingThree">
                                              <button class="accordion-button bacTituloPrincipal" type="button" data-bs-toggle="collapse" data-bs-target="#documentos" aria-expanded="true" aria-controls="collapseOne">
                                                Documentos
                                              </button>
                                            </h2>
                                            <div id="documentos" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <div class="row mt-3">
  
                                                        <div class="col-12">     
                                                            <div class="row">

                                                                <div class="col-12 col-md-6 col-lg-4">
                                                                    <div class="card contDocumentos">
                                                                        <div class="card-body m-2">

                                                                            <div class=" ">
                                                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                                                                <label class="form-check-label text-start fs-5 textTitulo mb-2" for="flexCheckDefault">
                                                                                        Solicitud o Curriculum Vitae
                                                                                </label>
                                                                            </div>  
                                                                            <div class="contIconosDocumentos d-flex align-items-end">
                                                                                <div class="semaforo rounded-circle mx-2"></div>
                                                                                <div class="semaforo rounded-circle mx-2"></div>
                                                                                <i><img class="mx-2" style="height:23px" src="{{ asset('/img/general/guardarVerde.svg') }}"></i>
                                                                                <i><img class="mx-2" style="height:23px" src="{{ asset('/img/general/fotoVerde.svg') }}"></i>
        
                                                                            </div>


                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-12 col-md-6 col-lg-4">
                                                                    <div class="card contDocumentos">
                                                                        <div class="card-body m-2">

                                                                            <div class=" ">
                                                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                                                                <label class="form-check-label text-start fs-5 textTitulo mb-2" for="flexCheckDefault">
                                                                                        Acta de Nacimiento
                                                                                </label>
                                                                            </div>  
                                                                            <div class="contIconosDocumentos d-flex align-items-end">
                                                                                <div class="semaforo rounded-circle mx-2"></div>
                                                                                <div class="semaforo rounded-circle mx-2"></div>
                                                                                <i><img class="mx-2" style="height:23px" src="{{ asset('/img/general/guardarVerde.svg') }}"></i>
                                                                                <i><img class="mx-2" style="height:23px" src="{{ asset('/img/general/fotoVerde.svg') }}"></i>
        
                                                                            </div>


                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-12 col-md-6 col-lg-4">
                                                                    <div class="card contDocumentos">
                                                                        <div class="card-body m-2">

                                                                            <div class=" ">
                                                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                                                                <label class="form-check-label text-start fs-5 textTitulo mb-2" for="flexCheckDefault">
                                                                                        INE
                                                                                </label>
                                                                            </div>  
                                                                            <div class="contIconosDocumentos d-flex align-items-end">
                                                                                <div class="semaforo rounded-circle mx-2"></div>
                                                                                <div class="semaforo rounded-circle mx-2"></div>
                                                                                <i><img class="mx-2" style="height:23px" src="{{ asset('/img/general/guardarVerde.svg') }}"></i>
                                                                                <i><img class="mx-2" style="height:23px" src="{{ asset('/img/general/fotoVerde.svg') }}"></i>
        
                                                                            </div>


                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-12 col-md-6 col-lg-4">
                                                                    <div class="card contDocumentos">
                                                                        <div class="card-body m-2">

                                                                            <div class=" ">
                                                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                                                                <label class="form-check-label text-start fs-5 textTitulo mb-2" for="flexCheckDefault">
                                                                                        CURP
                                                                                </label>
                                                                            </div>  
                                                                            <div class="contIconosDocumentos d-flex align-items-end">
                                                                                <div class="semaforo rounded-circle mx-2"></div>
                                                                                <div class="semaforo rounded-circle mx-2"></div>
                                                                                <i><img class="mx-2" style="height:23px" src="{{ asset('/img/general/guardarVerde.svg') }}"></i>
                                                                                <i><img class="mx-2" style="height:23px" src="{{ asset('/img/general/fotoVerde.svg') }}"></i>
        
                                                                            </div>


                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-12 col-md-6 col-lg-4">
                                                                    <div class="card contDocumentos">
                                                                        <div class="card-body m-2">

                                                                            <div class=" ">
                                                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                                                                <label class="form-check-label text-start fs-5 textTitulo mb-2" for="flexCheckDefault">
                                                                                        Licencia (Automovilista / Chofer)
                                                                                </label>
                                                                            </div>  
                                                                            <div class="contIconosDocumentos d-flex align-items-end">
                                                                                <div class="semaforo rounded-circle mx-2"></div>
                                                                                <div class="semaforo rounded-circle mx-2"></div>
                                                                                <i><img class="mx-2" style="height:23px" src="{{ asset('/img/general/guardarVerde.svg') }}"></i>
                                                                                <i><img class="mx-2" style="height:23px" src="{{ asset('/img/general/fotoVerde.svg') }}"></i>
        
                                                                            </div>


                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-12 col-md-6 col-lg-4">
                                                                    <div class="card contDocumentos">
                                                                        <div class="card-body m-2">

                                                                            <div class=" ">
                                                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                                                                <label class="form-check-label text-start fs-5 textTitulo mb-2" for="flexCheckDefault">
                                                                                        Cédula Profesional
                                                                                </label>
                                                                            </div>  
                                                                            <div class="contIconosDocumentos d-flex align-items-end">
                                                                                <div class="semaforo rounded-circle mx-2"></div>
                                                                                <div class="semaforo rounded-circle mx-2"></div>
                                                                                <i><img class="mx-2" style="height:23px" src="{{ asset('/img/general/guardarVerde.svg') }}"></i>
                                                                                <i><img class="mx-2" style="height:23px" src="{{ asset('/img/general/fotoVerde.svg') }}"></i>
        
                                                                            </div>


                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-12 col-md-6 col-lg-4">
                                                                    <div class="card contDocumentos">
                                                                        <div class="card-body m-2">

                                                                            <div class=" ">
                                                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                                                                <label class="form-check-label text-start fs-5 textTitulo mb-2" for="flexCheckDefault">
                                                                                        Constancia de Situación Fiscal
                                                                                </label>
                                                                            </div>  
                                                                            <div class="contIconosDocumentos d-flex align-items-end">
                                                                                <div class="semaforo rounded-circle mx-2"></div>
                                                                                <div class="semaforo rounded-circle mx-2"></div>
                                                                                <i><img class="mx-2" style="height:23px" src="{{ asset('/img/general/guardarVerde.svg') }}"></i>
                                                                                <i><img class="mx-2" style="height:23px" src="{{ asset('/img/general/fotoVerde.svg') }}"></i>
        
                                                                            </div>


                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-12 col-md-6 col-lg-4">
                                                                    <div class="card contDocumentos">
                                                                        <div class="card-body m-2">

                                                                            <div class=" ">
                                                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                                                                <label class="form-check-label text-start fs-5 textTitulo mb-2" for="flexCheckDefault">
                                                                                        Comprobante de Domicilio
                                                                                </label>
                                                                            </div>  
                                                                            <div class="contIconosDocumentos d-flex align-items-end">
                                                                                <div class="semaforo rounded-circle mx-2"></div>
                                                                                <div class="semaforo rounded-circle mx-2"></div>
                                                                                <i><img class="mx-2" style="height:23px" src="{{ asset('/img/general/guardarVerde.svg') }}"></i>
                                                                                <i><img class="mx-2" style="height:23px" src="{{ asset('/img/general/fotoVerde.svg') }}"></i>
        
                                                                            </div>


                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-12 col-md-6 col-lg-4">
                                                                    <div class="card contDocumentos">
                                                                        <div class="card-body m-2">

                                                                            <div class=" ">
                                                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                                                                <label class="form-check-label text-start fs-5 textTitulo mb-2" for="flexCheckDefault">
                                                                                        Carta de no Antecedentes Penales
                                                                                </label>
                                                                            </div>  
                                                                            <div class="contIconosDocumentos d-flex align-items-end">
                                                                                <div class="semaforo rounded-circle mx-2"></div>
                                                                                <div class="semaforo rounded-circle mx-2"></div>
                                                                                <i><img class="mx-2" style="height:23px" src="{{ asset('/img/general/guardarVerde.svg') }}"></i>
                                                                                <i><img class="mx-2" style="height:23px" src="{{ asset('/img/general/fotoVerde.svg') }}"></i>
        
                                                                            </div>


                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-12 col-md-6 col-lg-4">
                                                                    <div class="card contDocumentos">
                                                                        <div class="card-body m-2">

                                                                            <div class=" ">
                                                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                                                                <label class="form-check-label text-start fs-5 textTitulo mb-2" for="flexCheckDefault">
                                                                                        Cartas de Recomendación
                                                                                </label>
                                                                            </div>  
                                                                            <div class="contIconosDocumentos d-flex align-items-end">
                                                                                <div class="semaforo rounded-circle mx-2"></div>
                                                                                <div class="semaforo rounded-circle mx-2"></div>
                                                                                <i><img class="mx-2" style="height:23px" src="{{ asset('/img/general/guardarVerde.svg') }}"></i>
                                                                                <i><img class="mx-2" style="height:23px" src="{{ asset('/img/general/fotoVerde.svg') }}"></i>
        
                                                                            </div>


                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-12 col-md-6 col-lg-4">
                                                                    <div class="card contDocumentos">
                                                                        <div class="card-body m-2">

                                                                            <div class=" ">
                                                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                                                                <label class="form-check-label text-start fs-5 textTitulo mb-2" for="flexCheckDefault">
                                                                                        DC3
                                                                                </label>
                                                                            </div>  
                                                                            <div class="contIconosDocumentos d-flex align-items-end">
                                                                                <div class="semaforo rounded-circle mx-2"></div>
                                                                                <div class="semaforo rounded-circle mx-2"></div>
                                                                                <i><img class="mx-2" style="height:23px" src="{{ asset('/img/general/guardarVerde.svg') }}"></i>
                                                                                <i><img class="mx-2" style="height:23px" src="{{ asset('/img/general/fotoVerde.svg') }}"></i>
        
                                                                            </div>


                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-12 col-md-6 col-lg-4">
                                                                    <div class="card contDocumentos">
                                                                        <div class="card-body m-2">

                                                                            <div class=" ">
                                                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                                                                <label class="form-check-label text-start fs-5 textTitulo mb-2" for="flexCheckDefault">
                                                                                        Exámen Médico
                                                                                </label>
                                                                            </div>  
                                                                            <div class="contIconosDocumentos d-flex align-items-end">
                                                                                <div class="semaforo rounded-circle mx-2"></div>
                                                                                <div class="semaforo rounded-circle mx-2"></div>
                                                                                <i><img class="mx-2" style="height:23px" src="{{ asset('/img/general/guardarVerde.svg') }}"></i>
                                                                                <i><img class="mx-2" style="height:23px" src="{{ asset('/img/general/fotoVerde.svg') }}"></i>
        
                                                                            </div>


                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-12 col-md-6 col-lg-4">
                                                                    <div class="card contDocumentos">
                                                                        <div class="card-body m-2">

                                                                            <div class=" ">
                                                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                                                                <label class="form-check-label text-start fs-5 textTitulo mb-2" for="flexCheckDefault">
                                                                                        Prueba Antidoping
                                                                                </label>
                                                                            </div>  
                                                                            <div class="contIconosDocumentos d-flex align-items-end">
                                                                                <div class="semaforo rounded-circle mx-2"></div>
                                                                                <div class="semaforo rounded-circle mx-2"></div>
                                                                                <i><img class="mx-2" style="height:23px" src="{{ asset('/img/general/guardarVerde.svg') }}"></i>
                                                                                <i><img class="mx-2" style="height:23px" src="{{ asset('/img/general/fotoVerde.svg') }}"></i>
        
                                                                            </div>


                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-12 col-md-6 col-lg-4">
                                                                    <div class="card contDocumentos">
                                                                        <div class="card-body m-2">

                                                                            <div class=" ">
                                                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                                                                <label class="form-check-label text-start fs-5 textTitulo mb-2" for="flexCheckDefault">
                                                                                        Comprobante de Estudios
                                                                                </label>
                                                                            </div>  
                                                                            <div class="contIconosDocumentos d-flex align-items-end">
                                                                                <div class="semaforo rounded-circle mx-2"></div>
                                                                                <div class="semaforo rounded-circle mx-2"></div>
                                                                                <i><img class="mx-2" style="height:23px" src="{{ asset('/img/general/guardarVerde.svg') }}"></i>
                                                                                <i><img class="mx-2" style="height:23px" src="{{ asset('/img/general/fotoVerde.svg') }}"></i>
        
                                                                            </div>


                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-12 col-md-6 col-lg-4">
                                                                    <div class="card contDocumentos">
                                                                        <div class="card-body m-2">

                                                                            <div class=" ">
                                                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                                                                <label class="form-check-label text-start fs-5 textTitulo mb-2" for="flexCheckDefault">
                                                                                        Número de Seguro Social
                                                                                </label>
                                                                            </div>  
                                                                            <div class="contIconosDocumentos d-flex align-items-end">
                                                                                <div class="semaforo rounded-circle mx-2"></div>
                                                                                <div class="semaforo rounded-circle mx-2"></div>
                                                                                <i><img class="mx-2" style="height:23px" src="{{ asset('/img/general/guardarVerde.svg') }}"></i>
                                                                                <i><img class="mx-2" style="height:23px" src="{{ asset('/img/general/fotoVerde.svg') }}"></i>
        
                                                                            </div>


                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-12 col-md-6 col-lg-4">
                                                                    <div class="card contDocumentos">
                                                                        <div class="card-body m-2">

                                                                            <div class=" ">
                                                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                                                                <label class="form-check-label text-start fs-5 textTitulo mb-2" for="flexCheckDefault">
                                                                                        Aviso de Retención de Infonavit
                                                                                </label>
                                                                            </div>  
                                                                            <div class="contIconosDocumentos d-flex align-items-end">
                                                                                <div class="semaforo rounded-circle mx-2"></div>
                                                                                <div class="semaforo rounded-circle mx-2"></div>
                                                                                <i><img class="mx-2" style="height:23px" src="{{ asset('/img/general/guardarVerde.svg') }}"></i>
                                                                                <i><img class="mx-2" style="height:23px" src="{{ asset('/img/general/fotoVerde.svg') }}"></i>
        
                                                                            </div>


                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-12 col-md-6 col-lg-4">
                                                                    <div class="card contDocumentos">
                                                                        <div class="card-body m-2">

                                                                            <div class=" ">
                                                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                                                                <label class="form-check-label text-start fs-5 textTitulo mb-2" for="flexCheckDefault">
                                                                                        Gestión de Días de Vacaciones
                                                                                </label>
                                                                            </div>  
                                                                            <div class="contIconosDocumentos d-flex align-items-end">
                                                                                <div class="semaforo rounded-circle mx-2"></div>
                                                                                <div class="semaforo rounded-circle mx-2"></div>
                                                                                <i><img class="mx-2" style="height:23px" src="{{ asset('/img/general/guardarVerde.svg') }}"></i>
                                                                                <i><img class="mx-2" style="height:23px" src="{{ asset('/img/general/fotoVerde.svg') }}"></i>
        
                                                                            </div>


                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-12 col-md-6 col-lg-4">
                                                                    <div class="card contDocumentos">
                                                                        <div class="card-body m-2">

                                                                            <div class=" ">
                                                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                                                                <label class="form-check-label text-start fs-5 textTitulo mb-2" for="flexCheckDefault">
                                                                                        Perfil y Descripción del Puesto
                                                                                </label>
                                                                            </div>  
                                                                            <div class="contIconosDocumentos d-flex align-items-end">
                                                                                <div class="semaforo rounded-circle mx-2"></div>
                                                                                <div class="semaforo rounded-circle mx-2"></div>
                                                                                <i><img class="mx-2" style="height:23px" src="{{ asset('/img/general/guardarVerde.svg') }}"></i>
                                                                                <i><img class="mx-2" style="height:23px" src="{{ asset('/img/general/fotoVerde.svg') }}"></i>
        
                                                                            </div>


                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-12 col-md-6 col-lg-4">
                                                                    <div class="card contDocumentos">
                                                                        <div class="card-body m-2">

                                                                            <div class=" ">
                                                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                                                                <label class="form-check-label text-start fs-5 textTitulo mb-2" for="flexCheckDefault">
                                                                                        Contrato Firmado
                                                                                </label>
                                                                            </div>  
                                                                            <div class="contIconosDocumentos d-flex align-items-end">
                                                                                <div class="semaforo rounded-circle mx-2"></div>
                                                                                <div class="semaforo rounded-circle mx-2"></div>
                                                                                <i><img class="mx-2" style="height:23px" src="{{ asset('/img/general/guardarVerde.svg') }}"></i>
                                                                                <i><img class="mx-2" style="height:23px" src="{{ asset('/img/general/fotoVerde.svg') }}"></i>
        
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
                                    <div class="col-12 text-center mb-3 ">
                                        <button type="submit" class="btn botonGral">Guardar</button>
                                    </div>

                                
                                </form>    
                            </div>   
                        </div>
                    </div>
            </div>
        </div>
    </div>
@endsection
