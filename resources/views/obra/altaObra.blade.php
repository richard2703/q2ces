@extends('layouts.main', ['activePage' => 'obra', 'titlePage' => __('Alta de Obra')])
@section('content')
    <div class="content">
        @if ($errors->any())
            <!-- PARA LA CARGA DE LOS ERRORES DE LOS DATOS-->
            <div class="alert alert-danger">
                <p>Listado de errores a corregir</p>
                <ul>
                    @foreach ($errors->all() as $item)
                        <li>{{ $item }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-11 align-self-start">
                    <div class="card">
                        <div class="card-body contCart">
                            <div class="p-1 align-self-start bacTituloPrincipal">
                                <h2 class="my-3 ms-3 texticonos ">Alta de Obra</h2>
                            </div>

                            <form class="row alertaGuardar" action="{{ route('obras.store') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="col-12   my-5 ">

                                    <div class="row d-flex justify-content-around">
                                        <div class="col-12 col-sm-4 ">
                                            <div class="text-center mx-auto border vistaFoto mb-4">
                                                <i><img class="imgVista img-fluid mb-5" src="{{ asset('/img/general/default.jpg') }}"></i>
                                                <span class="mi-archivo"> <input class="mb-4 ver" type="file" name="foto" id="mi-archivo" accept="image/*"></span>
                                                <label for="mi-archivo">
                                                    <span>sube vista aérea</span>
                                                </label>
                                            </div>
                                        </div>


                                        <div class="col-12 col-sm-4 ">
                                            <div class="text-center mx-auto border vistaFoto mb-4">
                                                <i><img class="imgVista img-fluid mb-5" src="{{ asset('/img/general/default.jpg') }}"></i>
                                                <span class="mi-archivo"> <input class="mb-4 ver" type="file" name="foto" id="mi-archivo2" accept="image/*"></span>
                                                <label for="mi-archivo2">
                                                    <span>sube Logo</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 my-4">
                                    <div class="row">
                                        <div class=" col-12 col-sm-6 col-lg-4 my-3 ">
                                            <label class="labelTitulo">Nombre de la Obra:</label></br>
                                            <input type="text" class="inputCaja" id="nombre" name="nombre"
                                                value="{{ old('nombre') }}">
                                        </div>
                                        <div class=" col-12 col-sm-6  col-lg-4 my-3 ">
                                            <label class="labelTitulo">Tipo:</label></br>
                                            <select class="form-select" aria-label="Default select example" id="tipo"
                                                name="tipo">
                                                <option selected>Seleccione</option>
                                                <option value="Q2Ces">Q2Ces</option>
                                                <option value="Externa">Externa</option>
                                            </select>
                                        </div>
                                        <div class=" col-12 col-sm-6  col-lg-4 my-3 ">
                                            <label class="labelTitulo">Calle:</label></br>
                                            <input type="text" class="inputCaja" id="calle" name="calle"
                                                value="{{ old('calle') }}">
                                        </div>
                                        <div class=" col-12 col-sm-6  col-lg-4 my-3 ">
                                            <label class="labelTitulo">Número:</label></br>
                                            <input type="text" class="inputCaja" id="numero" name="numero"
                                                value="{{ old('numero') }}">
                                        </div>
                                        <div class=" col-12 col-sm-6  col-lg-4 my-3 ">
                                            <label class="labelTitulo">Colonia:</label></br>
                                            <input type="text" class="inputCaja" id="colonia" name="colonia"
                                                value="{{ old('colonia') }}">
                                        </div>
                                        <div class=" col-12 col-sm-6  col-lg-4 my-3 ">
                                            <label class="labelTitulo">Código Postal:</label></br>
                                            <input type="text" class="inputCaja" id="cp" name="cp"
                                                value="{{ old('cp') }}">
                                        </div>
                                        <div class=" col-12 col-sm-6  col-lg-4 my-3 ">
                                            <label class="labelTitulo">Localidad:</label></br>
                                            <input type="text" class="inputCaja" id="ciudad" name="ciudad"
                                                value="{{ old('ciudad') }}">
                                        </div>
                                        <div class=" col-12 col-sm-6  col-lg-4 my-3 ">
                                            <label class="labelTitulo">Estado:</label></br>
                                            <input type="text" class="inputCaja" id="estado" name="estado"
                                                value="{{ old('estado') }}">
                                        </div>
                                    </div>
                                </div>



                                <div class="row card-body" id="elementos">
                                    <div class="row opcion" id="opc">
                                        <div class="col-12 my-5 ">
                                            <div class="">
                                                <h2 class="tituloEncabezado ">Residente Responsable</h2>
                                            </div>
                                            <div class="col-12 divBorder pb-3" style="text-align: right;">
                                                <button type="button" id="removeRow" class="btnRojo"></button>
                                                <button type="button" class="btnVerde" onclick="crearItems()"> </button>
                                            </div>
                                            <div class="row">
                                                <div class=" col-12 col-sm-6 col-lg-4 my-3 ">
                                                    <label class="labelTitulo">Nombre:</label></br>
                                                    <input type="text" class="inputCaja" id="nombre" name="nombre"
                                                        value="{{ old('nombre') }}">
                                                </div>

                                                <div class=" col-12 col-sm-6 col-lg-4 my-3 ">
                                                    <label class="labelTitulo">Empresa:</label></br>
                                                    <input type="text" class="inputCaja" id="nombre" name="nombre"
                                                        value="{{ old('nombre') }}">
                                                </div>

                                                <div class=" col-12 col-sm-6 col-lg-4 my-3 ">
                                                    <label class="labelTitulo">Puesto:</label></br>
                                                    <input type="text" class="inputCaja" id="nombre" name="nombre"
                                                        value="{{ old('nombre') }}">
                                                </div>

                                                <div class=" col-12 col-sm-6 col-lg-4 my-3 ">
                                                    <label class="labelTitulo">Teléfono:</label></br>
                                                    <input type="number" class="inputCaja" id="nombre" name="nombre"
                                                        value="{{ old('nombre') }}">
                                                </div>

                                                <div class=" col-12 col-sm-6 col-lg-4 my-3 ">
                                                    <label class="labelTitulo">Código de Confirmación:</label></br>
                                                    <input type="text" class="inputCaja" id="nombre" name="nombre"
                                                        value="{{ old('nombre') }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
  



                                <div class="row card-body" id="elementosB">
                                    <div class="row opcion" id="opcB">
                                        <div class="col-12 my-5 ">
                                            <div class="">
                                                <h2 class="tituloEncabezado ">Detalle de Obra</h2>
                                            </div>
                                            <div class="col-12 divBorder pb-3" style="text-align: right;">
                                                <button type="button" id="removeRow" class="btnRojo"></button>
                                                <button type="button" class="btnVerde" onclick="crearItemsB()"> </button>
                                            </div>

                                            <div class="row">
                                                <div class=" col-12 col-sm-6 col-lg-4 my-3 ">
                                                    <label class="labelTitulo">Nombre:</label></br>
                                                    <input type="text" class="inputCaja" id="nombre" name="nombre"
                                                        value="{{ old('nombre') }}">
                                                </div>

                                                <div class=" col-12 col-sm-6 col-lg-4 my-3 ">
                                                    <label class="labelTitulo">Equipo:</label></br>
                                                    <input type="text" class="inputCaja" id="nombre" name="nombre"
                                                        value="{{ old('nombre') }}">
                                                </div>

                                                <div class=" col-12 col-sm-6 col-lg-4 my-3 ">
                                                    <label class="labelTitulo">Operador:</label></br>
                                                    <input type="text" class="inputCaja" id="nombre" name="nombre"
                                                        value="{{ old('nombre') }}">
                                                </div>

                                                <div class=" col-12 col-sm-6 col-lg-4 my-3 ">
                                                    <label class="labelTitulo">Combustible:</label></br>
                                                <input class="check" type="checkbox" value="" id="flexCheckDefault">
                                                </div>

                                                <div class=" col-12 col-sm-6 col-lg-4 my-3 ">
                                                    <label class="labelTitulo">Fecha de Inicio:</label></br>
                                                    <input type="date" class="" id="nombre" name="nombre"
                                                        value="{{ old('nombre') }}">
                                                </div>

                                                <div class=" col-12 col-sm-6 col-lg-4 my-3 ">
                                                    <label class="labelTitulo">Fecha de Término:</label></br>
                                                    <input type="date" class="inputCaja" id="nombre" name="nombre"
                                                        value="{{ old('nombre') }}">
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>


                                        <div class="col-12 text-end mb-3 ">
                                            <button type="submit" class="btn botonGral" onclick="alertaGuardar()">Guardar</button>
                                        </div>
                                    </div>
                                </div>
                                

                            </form>

                        </div>




                        

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
crossorigin="anonymous"></script>
<script>
    // agregar registro
    function crearItems() {
        
        $('.opcion:first').clone().find("input").val("").end().appendTo('#elementos');

    }
    // borrar registro
    $(document).on('click', '#removeRow', function() {
        
        $(this).closest('#opc').remove();
    });



    function crearItemsB() {
        
        $('.opcion:first').clone().find("input").val("").end().appendTo('#elementosB');

    }
    // borrar registro
    $(document).on('click', '#removeRow', function() {
        
        $(this).closest('#opcB').remove();
    });
</script>
