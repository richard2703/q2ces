@extends('layouts.main', ['activePage' => 'personal', 'titlePage' => __('Equipo Nuevo')])
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
                <div class="col-11 align-self-center">
                    <div class="card">
                        <div class="card-body contCart">
                            <div class="p-1 align-self-start bacTituloPrincipal">
                                <h2 class="my-3 ms-3 texticonos ">Equipo Nuevo</h2>
                            </div>
                            <form class="row alertaGuardar" action="{{ route('inventario.store') }}"
                                method="post"class="row" enctype="multipart/form-data">
                                @csrf
                                <div class="col-12 col-md-4  my-3">
                                    <div class="text-center mx-auto border vistaFoto mb-4">
                                        <i><img class="imgVista img-fluid"
                                                src="{{ '/img/general/defaultinventario.jpg' }}"></i>

                                        <span class="mi-archivo"> <input class="mb-4 ver" type="file" name="imagen"
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
                                            <input type="text" class="inputCaja" id="numparte" name="numparte"
                                                value="{{ old('numparte')}}">
                                        </div>

                                        <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                            <label class="labelTitulo">Nombre:</label></br>
                                            <input type="text" class="inputCaja" id="nombre" name="nombre"
                                                value="{{ old('nombre')}}">
                                        </div>

                                        <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                            <label class="labelTitulo">Marca:</label></br>
                                            <input type="text" class="inputCaja" id="marca" name="marca"
                                                value="{{ old('marca')}}">
                                        </div>

                                        <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                            <label class="labelTitulo">Modelo:</label></br>
                                            <input type="text" class="inputCaja" id="modelo" name="modelo"
                                                value="{{ old('modelo')}}">
                                        </div>

                                        <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                            <label class="labelTitulo">Proovedor:</label></br>
                                            <input type="text" class="inputCaja" id="proveedor" name="proveedor"
                                                value="{{ old('proveedor')}}">
                                        </div>

                                        <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                            <label class="labelTitulo">Cantidad a ingresar:</label></br>
                                            <input type="number" step="0.01" min="0.01" class="inputCaja text-end"
                                                id="cantidad" name="cantidad" value="{{ old('cantidad')}}">
                                        </div>

                                        <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                            <label class="labelTitulo">Minimo:</label></br>
                                            <input type="number" step="0.01" min="0.01" class="inputCaja text-end"
                                                id="reorden" name="reorden" value="{{ old('reorden')}}">
                                        </div>

                                        <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                            <label class="labelTitulo">Maximo:</label></br>
                                            <input type="number" step="0.01" min="0.01" class="inputCaja text-end"
                                                id="maximo" name="maximo" value="{{ old('maximo')}}">
                                        </div>

                                        <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                            <label class="labelTitulo">Costo unitario:</label></br>
                                            <input type="number" step="0.01" min="0.01" class="inputCaja text-end"
                                                id="valor" name="valor" value="{{ old('valor')}}">
                                        </div>

                                        <div class=" col-12 col-sm-6 col-lg-6 mb-3 ">
                                            <label class="labelTitulo">Tipo:</label></br>
                                            <select class="form-select" aria-label="Default select example"
                                                id="tipo" name="tipo">
                                                {{--  <option value="A+" {{ $personal->sangre == 'A+' ? ' selected' : '' }}>A+
                                                </option>  --}}
                                                <option value="herramientas">Herramienta</option>
                                                <option value="refacciones">Refaccion</option>
                                                <option value="consumibles">Consumible</option>
                                                <option value="uniformes">Uniformes</option>
                                                <option value="extintores">Extintores</option>

                                            </select>
                                        </div>


                                    </div>
                                </div>

                                {{--  <div class="col-12 text-end mb-3 ">
                                    <button type="submit" class="btn botonGral">Guardar</button>
                                </div>  --}}
                            </form>

                           <!-- <div class="col-11 my-5">
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


                                    <div class="col-6 col-lg-4 my-5">
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

                            </div>-->
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

<style>




</style>


@endsection
