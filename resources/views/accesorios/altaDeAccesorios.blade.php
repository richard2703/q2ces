@extends('layouts.main', ['activePage' => 'maquinaria', 'titlePage' => __('Alta de Accesorios')])
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
                        <div class="ml-3">
                                    <div class="p-1 align-self-start bacTituloPrincipal">
                                        <h2 class="my-3 ms-3 texticonos">Alta de Accesorios</h2>
                                    </div>
                                    <div>
                                    <div class="col-4 text-left mt-3" style="margin-left:20px">
                                    <a href="{{ route('accesorios.index') }}">
                                        <button class="btn regresar">
                                            <span class="material-icons">
                                                reply
                                            </span>
                                            Regresar
                                        </button>
                                    </a>    
                                    </div>
                                    <div class="d-flex p-3 divBorder" style="margin-top:-15px">
                                    </div>
                                    </div>
                            <form class="alertaGuardar" action="{{ route('accesorios.store') }}"
                                method="post"class="row" enctype="multipart/form-data">
                                @csrf
                                
                                
                                <div class="row mt-3">
                                    <div class="col-12 col-md-4  my-3">
                                        <div class="text-center mx-auto border vistaFoto mb-4">
                                            <i><img class="imgVista img-fluid mb-2"
                                                    src="{{ asset('/img/general/default.jpg') }}"></i>
                                            <span class="mi-archivo"> <input class="mb-4 ver " type="file" name="foto"
                                                    id="mi-archivo" accept="image/*"></span>
                                            <label for="mi-archivo">
                                                <span class="">sube imagen</span>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-8 ">
                                        <div class="row">
                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                <label class="labelTitulo">Accesorio: <span>*</span></label></br>
                                                <input type="text" class="inputCaja" id="nombre" name="nombre" placeholder="Especifique..." required
                                                    value="{{ old('nombre') }}">
                                            </div>

                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                <label class="labelTitulo">Año:</label></br>
                                                <input type="number" class="inputCaja" id="ano" maxlength="4"
                                                    placeholder="Ej. 2000" name="ano" value="{{ old('ano') }}">
                                            </div>

                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                <label class="labelTitulo">Marca:</label></br>
                                                <input type="text" class="inputCaja" id="marca" name="marca" placeholder="Especifique..."
                                                    value="{{ old('marca') }}">
                                            </div>


                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                <label class="labelTitulo">Número Serie:</label></br>
                                                <input type="text" class="inputCaja" id="serie" name="serie" placeholder="Especifique..."
                                                    value="{{ old('serie') }}">
                                            </div>

                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                <label class="labelTitulo">Modelo:</label></br>
                                                <input type="text" class="inputCaja" id="modelo" name="modelo" placeholder="Especifique..."
                                                    value="{{ old('modelo') }}">
                                            </div>

                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                <label class="labelTitulo">Color:</label></br>
                                                <input type="text" class="inputCaja" id="color" name="color" placeholder="Especifique..."
                                                    value="{{ old('color') }}">
                                            </div>

                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                <label class="labelTitulo">Maquinaria Asignada:</label></br>
                                                <select id="maquinariaId" name="maquinariaId" class="form-select"
                                                    aria-label="Default select example">
                                                    <option value="">Seleccione</option>
                                                    @foreach ($vctMaquinaria as $maquina)
                                                        <option value="{{ $maquina->id }}">
                                                            {{ $maquina->identificador . ' ' . $maquina->nombre }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 text-end mb-3 ">
                                        <button type="submit" class="btn botonGral"
                                            onclick="alertaGuardar()">Guardar</button>
                                    </div>
                                </div>
                            </form>
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
@endsection
