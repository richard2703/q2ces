@extends('layouts.main', ['activePage' => 'obra', 'titlePage' => __('Detalle de Equipo')])
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
                                                Retroexcabadora
                                            </button>
                                          </h2>
                                          <div id="datosPersonales" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <div class="row mt-3">
                                                    <div class="col-12 col-lg-4  my-3"> 
                                                        <div class="row">

                                                            <div class="col-12" id="visor">
                                                                <img src="{{ asset('img/general/img1.png') }}" class="mx-auto d-block img-fluid" >
                                                            </div>


                                                            <div class="col-12 my-3 d-flex justify-content-around" id="selectores">
                                                                <img onclick="abre(this)" title="'Nereida'." src="{{ asset('img/general/img1.png') }}" class="img-fluid " >
                                                                <img onclick="abre(this)" title="Ricardo Crespo." src="{{ asset('img/general/img2.jpg') }}" class="img-fluid ">
                                                                <img onclick="abre(this)" title="Roberto Cortez." src="{{ asset('img/general/img3.jpg') }}" class="img-fluid ">
                                                                <img onclick="abre(this)" title="Ricardo Cinalli." src="{{ asset('img/general/img4.jpg') }}" class="img-fluid " >
                                                            </div>
                                                        </div>
                                                    
                                                    </div>  
                                                                                        
                                                    <div class="col-12 col-lg-8 ">  

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

                                                                        <button class="btnModal" type="button"  data-bs-toggle="modal" data-bs-target="#agregaTipo">
                                                                            <svg xmlns="http://www.w3.org/2000/svg"  fill="currentColor" class="bi bi-plus-circle-fill btnMas" viewBox="0 0 16 16">
                                                                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
                                                                              </svg>
                                                                          </button>


                                                                        
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
                                                                <label class="labelTitulo">Color:</label></br>
                                                                <input type="text" class="inputCaja" id="" name="calle" value="">
                                                            </div>
                    
                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Año:</label></br>
                                                                <input type="text" class="inputCaja" id="" name="calle" value="">
                                                            </div>
                    
                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Placas:</label></br>
                                                                <input type="text" class="inputCaja" id="" name="calle" value="">
                                                            </div>
                    
                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Capacidad:</label></br>
                                                                <input type="text" class="inputCaja" id="" name="calle" value="">
                                                            </div>
                    
                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Capacidad Tanque:</label></br>
                                                                <input type="text" class="inputCaja" id="" name="calle" value="">
                                                            </div>
                    
                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Ejes:</label></br>
                                                                <input type="text" class="inputCaja" id="" name="calle" value="">
                                                            </div>
                    
                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Rin Delantero:</label></br>
                                                                <input type="text" class="inputCaja" id="" name="calle" value="">
                                                            </div>
                    
                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Rin Trasero:</label></br>
                                                                <input type="text" class="inputCaja" id="" name="calle" value="">
                                                            </div>
                    
                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Llanta Delantera:</label></br>
                                                                <input type="text" class="inputCaja" id="" name="calle" value="">
                                                            </div>
                    
                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Llanta Trasera:</label></br>
                                                                <input type="text" class="inputCaja" id="" name="calle" value="">
                                                            </div>
                    
                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Combustible:</label></br>
                                                                <input type="text" class="inputCaja" id="" name="calle" value="">
                                                            </div>
                    
                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Aceite Motor:</label></br>
                                                                <input type="text" class="inputCaja" id="" name="calle" value="">
                                                            </div>
                    
                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Aceite Transmisión:</label></br>
                                                                <input type="text" class="inputCaja" id="" name="calle" value="">
                                                            </div>
                    
                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Aceite Dirección:</label></br>
                                                                <input type="text" class="inputCaja" id="" name="calle" value="">
                                                            </div>
                    
                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Aceite Hidráulico:</label></br>
                                                                <input type="text" class="inputCaja" id="" name="calle" value="">
                                                            </div>
                    
                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Filtro Aceite:</label></br>
                                                                <input type="text" class="inputCaja" id="" name="calle" value="">
                                                            </div>
                    
                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Filtro Aire:</label></br>
                                                                <input type="text" class="inputCaja" id="" name="calle" value="">
                                                            </div>
                    
                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Bujías:</label></br>
                                                                <input type="text" class="inputCaja" id="" name="calle" value="">
                                                            </div>
                    
                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <label class="labelTitulo">Horómetro Inicial:</label></br>
                                                                <input type="text" class="inputCaja" id="" name="calle" value="">
                                                            </div>
                    
                                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                                <div class="row align-items-end">
                                                                    <div class="col-8">
                                                                        <label class="labelTitulo">Kilometraje / Millaje Inicial:</label></br>
                                                                        <input type="text" class="inputCaja" id="" name="calle" value="">
                       
                                                                    </div>
                                                                    <div class="col-4">
                                                                        <select class="form-select" aria-label="Default select example">
                                                                            <option selected>Seleccione</option>
                                                                                <option value="1">km</option>
                                                                                <option value="2">ml</option>
                                                                        </select>
                                                                    </div> 
                                                                </div>   
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
                                                                                        Factura
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
                                                                                        Verificación
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
                                                                                        Manual de Uso
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
                                                                                        Registro
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
                                                                                        Tarjeta de Circulación
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
                                                                                        Ficha Técnica del Proveedor
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
                                                                                        Seguros
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
                                                                                        Permosos Especiales
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
<script src="https://code.jquery.com/jquery-2.1.3.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/@accessible360/accessible-slick@1.0.1/slick/slick.min.js" ></script>



<script>
    function abre(T) {
        var ruta = T.src.replace("/s90-Ic42/","/s590-Ic42/"); 
        document.querySelector("#visor img").src = ruta; 
        }      
</script>

<!-- Modal -->
<div class="modal fade" id="agregaTipo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Agrega un nuevo tipo</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          ...
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>