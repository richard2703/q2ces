@extends('layouts.main', ['activePage' => ' bitacoras', 'titlePage' => __('Editar Bitácoras')])
@section('content')
<div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header bacTituloPrincipal">
                                    <h4 class="card-title">Editar Bitácoras</h4>   
                                </div>
                                <div class="card-body ">   

                                    <div class="col-12 my-4">
                                        <div class="row">
                                            
                                            <div class=" col-12 col-sm-6   my-3 ">
                                                <label class="labelTitulo">Nombre:</label></br><input type="text"
                                                    placeholder="Especifique..." class="inputCaja">
                                            </div>
                                            
                                            <div class=" col-12 col-sm-6   my-3 ">
                                                <label for="exampleFormControlTextarea1" class="form-label">Pon tu comentario</label>
                                                <textarea class="form-select" id="exampleFormControlTextarea1" rows="3"></textarea>
                                            </div>
                                            <div class=" col-12 col-sm-6  col-lg-4  my-3 d-flex align-items-start ">
                                                <div class="form-check  px-3 d-flex align-items-start">
                                                    <input class="mx-2 " type="checkbox" value="" id="flexCheckDefault">
                                                        <p>Nombre: Luces</p>         
                                                </div>
                                            </div>
                                            <div class=" col-12 col-sm-6  col-lg-4  my-3 d-flex align-items-start ">
                                                <div class="form-check  px-3 d-flex align-items-start">
                                                    <input class="mx-2 " type="checkbox" value="" id="flexCheckDefault">
                                                        <p>Nombre: Luces</p>         
                                                </div>
                                            </div>
                                            <div class=" col-12 col-sm-6  col-lg-4  my-3 d-flex align-items-start ">
                                                <div class="form-check  px-3 d-flex align-items-start">
                                                    <input class="mx-2 " type="checkbox" value="" id="flexCheckDefault">
                                                        <p>Nombre: Luces</p>         
                                                </div>
                                            </div>
                                            <div class=" col-12 col-sm-6  col-lg-4  my-3 d-flex align-items-start ">
                                                <div class="form-check  px-3 d-flex align-items-start">
                                                    <input class="mx-2 " type="checkbox" value="" id="flexCheckDefault">
                                                        <p>Nombre: Luces</p>         
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
        </div>
    </div>
@endsection
