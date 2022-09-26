@extends('layouts.main', ['activePage' => 'obra', 'titlePage' => __('Vista de Obra')])
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-11 align-self-start">
                    <div class="card">
                        <div class="card-body contCart">
                            <div class="p-1 align-self-start bacTituloPrincipal">     
                                <h2 class="my-3 ms-3 texticonos ">Vista de Obra</h2>   
                            </div> 
                            <form class="row">

                                <div class="col-12 col-md-4  my-3 align-self-center"> 
                                    <div class="text-center mx-auto mb-2 border vistaFoto ">
                                        <i><img class="imgVista" src="{{ asset('/img/general/vistaAerea.jpg') }}"></i>
                                    </div>
                                </div>  
                                    
                                <div class="col-12 col-md-8 my-3">  
                                    <div class="row">
                                        <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                            <label class="labelTitulo">Nombre:</label></br>
                                            <input type="text" class="inputCaja" id="" name="calle" value="">
                                        </div>

                                        <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                            <label class="labelTitulo">Categoría:</label></br>
                                                <select class="form-select" aria-label="Default select example">
                                                    <option selected>Chica</option>
                                                    <option value="1">Mediana</option>
                                                    <option value="1">Grande</option>
                                                    <option value="1">Extra Grande</option>
                                                </select>
                                        </div>
                                        


                                    </div>
                                </div>

                                <div class="col-12 text-end mb-3 ">
                                    <i><img  src="{{ asset('img/login/logoQcem2.svg') }}" class="vistaLogo"></i>
                                </div>

                            </form>
                            
                        </div>   
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
