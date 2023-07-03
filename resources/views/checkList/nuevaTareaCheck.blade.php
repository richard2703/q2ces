@extends('layouts.main', ['activePage' => ' checkList', 'titlePage' => __('Agregar Nuevo Registro de Revision')])
@section('content')
<div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                        <div class="card">
                                <div class="card-header bacTituloPrincipal">
                                    <h4 class="card-title">Agregar Nuevo Registro de Revisión</h4>   
                                </div>
                                <div class="card-body ">   

                                    <div class="col-12 my-4">
                                        <div class="row">
                                        
                                            <div class=" col-12 col-sm-6  col-lg-4 my-3 ">
                                            <label for="recipient-name" class="labelTitulo">Categoría:</label>
                                            <select class="form-select" id="floatingSelect" aria-label="Floating label select example">
                                                <option selected>Selecciona una opción</option>
                                                <option value="1">Categoría Uno</option>
                                                <option value="2">Categoría Dos</option>
                                                <option value="3">Categoría Tres</option>
                                            </select>
                                            </div>
                                            <div class=" col-12 col-sm-6  col-lg-4 my-3 ">
                                                <label class="labelTitulo">Nombre:</label></br><input type="text" placeholder="Especifique..." class="inputCaja">
                                            </div>
                                            <div class=" col-12 col-sm-6  col-lg-4 my-3 ">
                                                <label class="labelTitulo">Ubicación: </label></br>
                                                <select class="form-select" id="floatingSelect" aria-label="Floating label select example">
                                                    <option selected>Selecciona una opción</option>
                                                    <option value="1">Ubicación Uno</option>
                                                    <option value="2">Ubicación Dos</option>
                                                    <option value="3">Ubicación Tres</option>
                                                </select>
                                            </div>
                                            <div class=" col-12 col-sm-6  col-lg-4 my-3 ">
                                                <label class="labelTitulo">Tipo: </label></br>
                                                <select class="form-select" id="floatingSelect" aria-label="Floating label select example">
                                                    <option selected>Selecciona una opción</option>
                                                    <option value="1">Tipo Uno</option>
                                                    <option value="2">Tipo Dos</option>
                                                    <option value="3">Tipo Tres</option>
                                                </select>
                                            </div>
                                            <div class=" col-12 col-sm-6  col-lg-4 my-3 ">
                                            <label for="exampleFormControlTextarea1" class="form-label">Pon tu comentario</label>
                                            <textarea class="form-select" id="exampleFormControlTextarea1" rows="3"></textarea>
                                            </div>
                                            
                                           
                                        </div>
                                    </div>

                                    
                                   
                                        
                                       
                                    
                                    
                                    <div class="col-12 text-center mt-5 pt-5">
                                        <button type="submit" class="btn botonGral" >Guardar</button>
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
