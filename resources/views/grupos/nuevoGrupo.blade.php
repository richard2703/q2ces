@extends('layouts.main', ['activePage' => ' grupos', 'titlePage' => __('Nuevo Grupo')])
@section('content')
<div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header bacTituloPrincipal">
                                    <h4 class="card-title">Nuevo Registro de Grupo</h4>   
                                </div>
                                <div class="card-body ">   

                                    <div class="col-12 my-4">
                                        <div class="row">
                                            
                                            <div class=" col-12 col-sm-6  col-lg-4 my-3 ">
                                                <label class="labelTitulo">Nombre:</label></br><input type="text"
                                                    placeholder="Especifique..." class="inputCaja">
                                            </div>
                                            <div class=" col-12 col-sm-6  col-lg-4 my-3 ">
                                                <label for="recipient-name" class="labelTitulo">Tipo:</label>
                                                    <select class="form-select" id="floatingSelect" aria-label="Floating label select example">
                                                        <option selected>Selecciona una opción</option>
                                                        <option value="1">Ubicación Uno</option>
                                                        <option value="2">Ubicación Dos</option>
                                                        <option value="3">Ubicación Tres</option>
                                                    </select>
                                            </div>

                                            
                                            <div class=" col-12 col-sm-6  col-lg-4 my-3 ">
                                                <label for="exampleFormControlTextarea1" class="form-label">Pon tu comentario</label>
                                                <textarea class="form-select" id="exampleFormControlTextarea1" rows="3"></textarea>
                                            </div>

                                            <div class=" col-12 col-sm-6  col-lg-4  my-3 d-flex align-items-start ">
                                                <div class="form-check  px-3 d-flex align-items-start">
                                                    <input class="mx-2 " type="checkbox" value="" id="flexCheckDefault">
                                                        <ul>
                                                            <li>Nombre: Luces</li>
                                                            <li>Ubicación: Taller</li>
                                                            <li>Tipo: tipo 1</li>
                                                            <li>Categoría: Categoría 1</li>
                                                        </ul>
                                                </div>
                                            </div>
                                            <div class=" col-12 col-sm-6  col-lg-4  my-3 d-flex align-items-start ">
                                                <div class="form-check  px-3 d-flex align-items-start">
                                                    <input class="mx-2 " type="checkbox" value="" id="flexCheckDefault">
                                                        <ul>
                                                            <li>Nombre: Luces</li>
                                                            <li>Ubicación: Taller</li>
                                                            <li>Tipo: tipo 1</li>
                                                            <li>Categoría: Categoría 1</li>
                                                        </ul>
                                                </div>
                                            </div>
                                            <div class=" col-12 col-sm-6  col-lg-4  my-3 d-flex align-items-start ">
                                                <div class="form-check  px-3 d-flex align-items-start">
                                                    <input class="mx-2 " type="checkbox" value="" id="flexCheckDefault">
                                                        <ul>
                                                            <li>Nombre: Luces</li>
                                                            <li>Ubicación: Taller</li>
                                                            <li>Tipo: tipo 1</li>
                                                            <li>Categoría: Categoría 1</li>
                                                        </ul>
                                                </div>
                                            </div>

                                           

                                            <div class="col-12 text-center mt-5 pt-5">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><a href="{{ url('/indexGrupos') }}">Regresar</a></button>
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
        </div>
</div>
@endsection
