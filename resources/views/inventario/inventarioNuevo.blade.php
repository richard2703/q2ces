@extends('layouts.main', ['activePage' => 'personal', 'titlePage' => __('Inventario Nuevo')])
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
                                <h2 class="my-3 ms-3 texticonos ">Inventario Nuevo</h2>
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
                                        <button type="submit" class="btn botonGral"
                                            onclick="alertaGuardar()">Guardar</button>
                                    </div>
                                </div>

                                <div class="col-12 col-md-8 my-3 ">
                                    <div class="row alin">

                                        <div class=" col-12 col-sm-6 col-lg-8 mb-3 ">
                                            <label class="labelTitulo">Tipo:</label></br>
                                            <input type="text" class="inputCaja" id="tipoInventario" name="tipoInventario" readonly disabled="true"
                                                value="{{ $tipo }}">
                                        </div>

                                        <input type="hidden" name="tipo" value="{{ $tipo }}">

                                        <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                            <label class="labelTitulo">Número del Parte:</label></br>
                                            <input type="text" class="inputCaja" id="numparte" name="numparte"
                                                value="{{ old('numparte') }}">
                                        </div>

                                        <div class=" col-12 col-sm-6 col-lg-8 mb-3 ">
                                            <label class="labelTitulo">Nombre: <span>*</span></label></br>
                                            <input type="text" class="inputCaja" id="nombre" name="nombre"
                                                value="{{ old('nombre') }}">
                                        </div>

                                        <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                            <label class="labelTitulo">Marca:</label></br>
                                            <input type="text" class="inputCaja" id="marca" name="marca"
                                                value="{{ old('marca') }}">
                                        </div>

                                        <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                            <label class="labelTitulo">Modelo:</label></br>
                                            <input type="text" class="inputCaja" id="modelo" name="modelo"
                                                value="{{ old('modelo') }}">
                                        </div>

                                        <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                            <label class="labelTitulo">Proovedor:</label></br>
                                            <input type="text" class="inputCaja" id="proveedor" name="proveedor"
                                                value="{{ old('proveedor') }}">
                                        </div>

                                        <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                            <label class="labelTitulo">Cantidad a ingresar: <span>*</span></label></br>
                                            <input type="number" step="1" min="1" class="inputCaja text-end"
                                                id="cantidad" name="cantidad" value="{{ old('cantidad') }}">
                                        </div>

                                        <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                            <label class="labelTitulo">Minimo:</label></br>
                                            <input type="number" step="1" min="1" class="inputCaja text-end"
                                                id="reorden" name="reorden" value="{{ old('reorden') }}">
                                        </div>

                                        <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                            <label class="labelTitulo">Maximo:</label></br>
                                            <input type="number" step="1" min="1" class="inputCaja text-end"
                                                id="maximo" name="maximo" value="{{ old('maximo') }}">
                                        </div>

                                        <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                            <label class="labelTitulo">Costo unitario: <span>*</span></label></br>
                                            <input type="number" step="0.01" min="0.01"
                                                class="inputCaja text-end" id="valor" name="valor"
                                                value="{{ old('valor') }}">
                                        </div>

                                        @if ($tipo == 'uniformes')
                                            <div class=" col-12 col-sm-6 col-lg-4 mb-5 ">
                                                <label class="labelTitulo">Tipo de Uniforme:</label></br>
                                                <select id="uniformeTipoId" name="uniformeTipoId" class="form-select"
                                                    required aria-label="Default select example">
                                                    <option value="">Seleccione</option>
                                                    @foreach ($vctTipos as $item)
                                                        <option value="{{ $item->id }}">
                                                            {{ $item->nombre }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                <label class="labelTitulo">Talla:</label></br>
                                                <input type="text" class="inputCaja" id="uniformeTalla"
                                                    name="uniformeTalla" value="{{ old('uniformeTalla') }}">
                                            </div>

                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                <label class="labelTitulo">Es Retornable:</label></br>
                                                <select class="form-select" aria-label="Default select example"
                                                    id="uniformeRetornable" name="uniformeRetornable">
                                                    <option value="0">No</option>
                                                    <option value="1">Sí</option>
                                                </select>
                                            </div>
                                        @endif

                                        @if ($tipo == 'extintores')
                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                <label class="labelTitulo">Capacidad:</label></br>
                                                <input type="text" class="inputCaja" id="extintorCapacidad"
                                                    name="extintorCapacidad" value="{{ old('extintorCapacidad') }}">
                                            </div>

                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                <label class="labelTitulo">Identificador:</label></br>
                                                <input type="text" class="inputCaja" id="extintorCodigo"
                                                    name="extintorCodigo" value="{{ old('extintorCodigo') }}">
                                            </div>
                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                <label class="labelTitulo">Fecha de vencimiento:</label></br>
                                                <input type="date" class="inputCaja" id="extintorFechaVencimiento"
                                                    name="extintorFechaVencimiento"
                                                    value="{{ old('extintorFechaVencimiento') }}">
                                            </div>
                                        @endif

                                    </div>
                                </div>

                                {{--  <div class="col-12 text-end mb-3 ">
                                    <button type="submit" class="btn botonGral">Guardar</button>
                                </div>  --}}
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
