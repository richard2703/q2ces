@extends('layouts.main', ['activePage' => 'obra', 'titlePage' => __('Vista de Personal')])
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-11 align-self-start">
                    <div class="card">
                        <div class="card-body contCart">
                            <div class="p-1 align-self-start bacTituloPrincipal">     
                                <h2 class="my-3 ms-3 texticonos ">Vista de Personal</h2>   
                            </div> 
                            <form class="row">

                                <div class="col-12 col-md-4  my-3"> 
                                    <div class="text-center mx-auto border vistaFoto mb-4">
                                        <i><img class="imgVista img-fluid" src="{{ asset('/img/general/vistaAerea.jpg') }}"></i>
                                    </div>
                                </div>  
                                    
                                <div class="col-12 col-md-8 my-3">  
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
                                            <label class="labelTitulo">Tipo de Sangre:</label></br>
                                            <input type="text" class="inputCaja" id="" name="calle" value="">
                                        </div>

                                        <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                            <label class="labelTitulo">Alergias:</label></br>
                                            <input type="text" class="inputCaja" id="" name="calle" value="">
                                        </div>

                                        <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                            <label class="labelTitulo">Correo Electrónico Empresa:</label></br>
                                            <input type="text" class="inputCaja" id="" name="calle" value="">
                                        </div>

                                        <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                            <label class="labelTitulo">Celular:</label></br>
                                            <input type="text" class="inputCaja" id="" name="calle" value="">
                                        </div>

                                        <div class=" col-12 col-sm-6 col-lg-3 mb-3 ">
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
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class=" col-12 col-sm-6  mb-3 ">
                                            <p class="textTitulo my-2">Obra Asignada: <span>Parque Metropolitano</span></p>
                                            <p class="textTitulo my-2">Equipo Asignado: <span>Parque Retroexcabadora</span></p>
                                            <p class="textTitulo my-2">Fecha de Inicio: <span>25 / 28 / 2022</span></p>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-12 text-end mb-3 ">
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
