@extends('layouts.main', ['activePage' => 'personal', 'titlePage' => __('Detalle Herramienta')])
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-11 align-self-center">
                        <div class="card-body contCart justify-content-center">
                    <div class="card ">
                            <div class="card-header bacTituloPrincipal mb-5">
                                <h2 class="my-3 ms-3 texticonos ">Detalle Herramienta</h2>
                            </div>
                            <form action="#" method="post"class="row alertaGuardar" enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="col-12 col-md-4  my-3">
                                    <div class="text-center mx-auto border vistaFoto mb-4">
                                        <i><img class="imgVista img-fluid"
                                                src="{{ '/img/general/defaultinventario.jpg' }}"></i>

                                        <span class="mi-archivo"> <input class="mb-4 ver" type="file" name="foto"
                                                id="mi-archivo" accept="image/*"></span>
                                        <label for="mi-archivo">
                                            <span>sube imagen</span>
                                        </label>
                                        
                                    </div>
                                    

                                    <div class="col-12 text-center mb-3 ">
                                        <button type="submit" class="btn botonGral" onclick="alertaGuardar()">Guardar</button>
                                    </div>
                                </div>

                                <div class="col-12 col-md-8 my-3 ">
                                    <div class="row alin">
                                        <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                            <label class="labelTitulo">Número del Parte:</label></br>
                                            <input type="text" class="inputCaja" id="" name="calle"
                                                value="">
                                        </div>

                                        <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                            <label class="labelTitulo">Nombre:</label></br>
                                            <input type="text" class="inputCaja" id="nombres" name="nombres"
                                                value="">
                                        </div>

                                        <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                            <label class="labelTitulo">Marca:</label></br>
                                            <input type="text" class="inputCaja" id="apellidoP" name="apellidoP"
                                                value="">
                                        </div>

                                        <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                            <label class="labelTitulo">Modelo:</label></br>
                                            <input type="text" class="inputCaja" id="apellidoM" name="apellidoM"
                                                value="">
                                        </div>

                                        <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                            <label class="labelTitulo">Proovedor:</label></br>
                                            <input type="text" class="inputCaja" id="aler" name="aler"
                                                value="">
                                        </div>

                                        <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                            <label class="labelTitulo">Cantidad a ingresar:</label></br>
                                            <input type="number" step="0.01" min="0.01" class="inputCaja"
                                                id="aler" name="aler" value="">
                                        </div>

                                        <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                            <label class="labelTitulo">Minimo:</label></br>
                                            <input type="number" step="0.01" min="0.01" class="inputCaja"
                                                id="aler" name="aler" value="">
                                        </div>

                                        <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                            <label class="labelTitulo">Maximo:</label></br>
                                            <input type="number" step="0.01" min="0.01" class="inputCaja"
                                                id="aler" name="aler" value="">
                                        </div>

                                        <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                            <label class="labelTitulo">Costo unitario:</label></br>
                                            <input type="number" step="0.01" min="0.01" class="inputCaja"
                                                id="aler" name="aler" value="">
                                        </div>

                                        <div class=" col-12 col-sm-6 col-lg-6 mb-5 ">
                                            <label class="labelTitulo">Tipo:</label></br>
                                            <select class="form-select" aria-label="Default select example" id="sangre"
                                                name="sangre">
                                                {{--  <option value="A+" {{ $personal->sangre == 'A+' ? ' selected' : '' }}>A+
                                                </option>  --}}
                                                <option value="herramienta">Herramienta</option>
                                                <option value="refaccion">Refaccion</option>
                                                <option value="consumible">Consumible</option>

                                            </select>
                                        </div>
                                        
                                        <div class="col-12 text-center mt-5">

                                            <button type="button" class="btn btn-primary botonGral" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                                Mover
                                              </button>

                                        </div>
                                    </div>
                                </div>
                                
                                {{--  <div class="col-12 text-end mb-3 ">
                                    <button type="submit" class="btn botonGral">Guardar</button>
                                </div>  --}}
                            </form>

                            <div class="col-11 align-self-center my-5">
                                <div class="row my-5 pt-5 border-top">
                                    <div class="col-6 col-lg-4 my-5">
                                        <div class="process-container">
                                            <div class="process-inner">
                                            <div class="icon-holder">
                                                <i class=""><img class="mb-4"  style="width: 60px;"src="{{ '/img/equipos/obras.svg' }}"></i>
                                            </div>
                                            <h4 class="textTitulo">Obra Asignada</h4>
                                            <p class="description">This is content and this is actually something.</p>
                                        </div>
                                    </div>
                                </div>


                                    <div class="col-6 col-lg-4 my-5 ">
                                        <div class="process-container">
                                            <div class="process-inner">
                                                <div class="icon-holder">
                                                    <i class=""><img class="mb-4"  style="width: 60px;"src="{{ '/img/equipos/equipo.svg' }}"></i>
                                                </div>
                                                <h4 class="textTitulo">Equipo Asignado</h4>
                                                <p class="description">This is content and this is actually something.</p>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-6 col-lg-4 my-5">
                                        <div class="process-container">
                                            <div class="process-inner">
                                                <div class="icon-holder">
                                                    <i class=""><img class="mb-4"  style="width: 55px;"src="{{ '/img/equipos/calendar.svg' }}"></i>
                                                </div>
                                                <h4 class="textTitulo text-dark ">Fecha de Inicio</h4>
                                                <p class="description bolder">No asignado <br>aún.</p>
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
<!-- Modal -->


<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bacTituloPrincipal mb-3">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Mover</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form class="col-11">
            <label class="labelTitulo">Tipo de movimiento:</label></br>
            <select class="form-select" aria-label="Default select example" id=""  name="">
                <option value="herramienta">Asignar</option>
                <option value="refaccion">Desechar</option>
            </select>

            <label class="labelTitulo mt-3">Origen:</label></br>
            <input type="text" class="inputCaja" id="aler" name="aler" value="">

            <label class="labelTitulo mt-3">Destino:</label></br>
            <input type="text" class="inputCaja" id="aler" name="aler" value="">

            <label class="labelTitulo mt-3">Comentario:</label></br>
            <textarea class="col-12 inputCaja mb-3"  ></textarea>


        </form>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary botonGral mx-auto">Mover</button>
          </div>
      </div>
    </div>
  </div>











@endsection