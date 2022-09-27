@extends('layouts.main', ['activePage' => 'obra', 'titlePage' => __('Alta de Equipo')])
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-11 align-self-start">
                    <div class="card">
                        <div class="card-body contCart"> 
                            <form class="row">
                                <div class="p-1 align-self-start bacTituloPrincipal">
                                    <h2 class="my-3 ms-3 texticonos ">Alta de Accesorios</h2>
                                </div>
                                    <div class="row mt-3">
                                        <div class="col-12 col-md-4  my-3"> 
                                            <div class="text-center mx-auto border vistaFoto mb-4">
                                                <i><img class="imgVista img-fluid mb-5" src="{{ asset('/img/general/vistaAerea.jpg') }}"></i>
                                                 <input class="mb-4" type="file" name="logo" id=" ">
                                            </div>
                                        </div>  
                                                                                        
                                        <div class="col-12 col-md-8 ">  
                                            <div class="row">
                                                <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                    <label class="labelTitulo">Nombre:</label></br>
                                                    <input type="text" class="inputCaja" id="" name="calle" value="">
                                                </div>
                                                                    
                                                <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                    <label class="labelTitulo">Categoría:</label></br>
                                                    <input type="text" class="inputCaja" id="" name="calle" value="">
                                                </div>
                                                                    
                                                <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                    <div class="row align-items-end">
                                                        <div class="col-8">
                                                            <label class="labelTitulo">Tipo:</label></br>
                                                             <select class="form-select" aria-label="Default select example">
                                                                <option selected>Seleccione</option>
                                                                    <option value="1">Maquinaria Pesada</option>
                                                                    <option value="2">Equipo ligero</option>
                                                                    <option value="1">Movimiento de Tierras</option>
                                                            </select>
                       
                                                        </div>
                                                        <div class="col-4">
                                                            <svg xmlns="http://www.w3.org/2000/svg"  fill="currentColor" class="bi bi-plus-circle-fill btnMas" viewBox="0 0 16 16">
                                                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
                                                            </svg>
                                                        </div> 
                                                    </div>   
                                                </div>
                                                                    
                                                <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                    <label class="labelTitulo">Uso:</label></br>
                                                    <input type="text" class="inputCaja" id="" name="calle" value="">
                                                </div>
                    
                                                <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                    <label class="labelTitulo">Marca:</label></br>
                                                        <input type="text" class="inputCaja" id="" name="calle" value="">
                                                </div>
                    
                                                <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                    <label class="labelTitulo">Sub Marca:</label></br>
                                                    <input type="text" class="inputCaja" id="" name="calle" value="">
                                                </div>
                    
                                                <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                    <label class="labelTitulo">Modelo:</label></br>
                                                    <input type="text" class="inputCaja" id="" name="calle" value="">
                                                </div>
                    
                                                <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                    <label class="labelTitulo">Motor:</label></br>
                                                    <input type="text" class="inputCaja" id="" name="calle" value="">
                                                </div>
                    
                                                <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                    <label class="labelTitulo">Número Motor:</label></br>
                                                    <input type="text" class="inputCaja" id="" name="calle" value="">
                                                </div>
                    
                                                <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                    <label class="labelTitulo">Número Serie:</label></br>
                                                    <input type="text" class="inputCaja" id="" name="calle" value="">
                                                </div>
                    
                                                <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                    <label class="labelTitulo">Número VIN:</label></br>
                                                    <input type="text" class="inputCaja" id="" name="calle" value="">
                                                </div>

                                                <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                    <label class="labelTitulo">Obra Asignada:</label></br>
                                                    <input type="text" class="inputCaja" id="" name="calle" value="">
                                                </div>

                                                <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                    <label class="labelTitulo">Operador Asignado:</label></br>
                                                    <input type="text" class="inputCaja" id="" name="calle" value="">
                                                </div>
                                                
                                            </div>
                                        </div>

                                        <div class="col-12 text-end mb-3 ">
                                        <button type="submit" class="btn botonGral">Guardar</button>
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
