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
                                <h2 class="my-3 ms-3 texticonos ">Inventario Nuevo {{ ucfirst($tipo) }}</h2>
                            </div>

                            <div class="row">
                                <div class="col-12 text-right">
                                    <a href="{{ route('inventario.dash') }}"
                                        title="Regresa a la vista de consulta de inventario.">
                                        <button class="btn regresar">
                                            <span class="material-icons">
                                                reply
                                            </span>
                                            Regresar
                                        </button>
                                    </a>

                                </div>
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
                                            <span>Sube Imagen</span>
                                        </label>
                                    </div>

                                    <div class="col-12 text-center mb-3 ">
                                        <button type="submit" class="btn botonGral"
                                            onclick="alertaGuardar()">Guardar</button>
                                    </div>
                                </div>

                                <div class="col-12 col-md-8 my-3 ">
                                    <div class="row alin">
                                        <input type="hidden" name="usuarioId" id="usuarioId" value="{{  auth()->user()->id }}">

                                        <div class=" col-12 col-sm-6 col-lg-8 mb-3 ">
                                            <label class="labelTitulo">Tipo:</label></br>
                                            <input type="text" class="inputCaja" id="tipoInventario"
                                                name="tipoInventario" readonly disabled="true" value="{{ $tipo }}">
                                        </div>

                                        <input type="hidden" name="tipo" value="{{ $tipo }}">

                                        <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                            <label class="labelTitulo">Número de Parte: <span>*</span></label></br>
                                            <input type="number" class="inputCaja text-right" required class="inputCaja"
                                                id="numparte" name="numparte" value="{{ old('numparte') }}" maxlength="10"
                                                step="1" min="0">
                                        </div>

                                        <div class=" col-12 col-sm-6 col-lg-8 mb-3 ">
                                            <label class="labelTitulo">Nombre: <span>*</span></label></br>
                                            <input type="text" class="inputCaja" id="nombre" name="nombre" required
                                                value="{{ old('nombre') }}">
                                        </div>

                                        <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                            <label class="labelTitulo">Marca: <span>*</span></label></br>
                                            <select id="marcaId" name="marcaId" class="form-select" required
                                                aria-label="Default select example">
                                                <option value="">Seleccione</option>
                                                @foreach ($vctMarcas as $item)
                                                    <option value="{{ $item->id }}">
                                                        {{ $item->nombre }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                            <label class="labelTitulo">Modelo: <span>*</span></label></br>
                                            <input type="text" class="inputCaja" id="modelo" name="modelo" required
                                                value="{{ old('modelo') }}">
                                        </div>

                                        <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                            <label class="labelTitulo">Proovedor: <span>*</span></label></br>
                                            <select id="proveedorId" name="proveedorId" class="form-select" required
                                                aria-label="Default select example">
                                                <option value="">Seleccione</option>
                                                @foreach ($vctProveedores as $item)
                                                    <option value="{{ $item->id }}">
                                                        {{ $item->nombre }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                            <label class="labelTitulo">Cantidad: <span>*</span></label></br>
                                            <input type="number" step="1" min="1" class="inputCaja text-end"
                                                required id="cantidad" name="cantidad" value="{{ old('cantidad') }}">
                                        </div>

                                        <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                            <label class="labelTitulo">Mínimo:</label></br>
                                            <input type="number" step="1" min="1"
                                                class="inputCaja text-end" id="reorden" name="reorden"
                                                value="{{ old('reorden') }}">
                                        </div>

                                        <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                            <label class="labelTitulo">Máximo:</label></br>
                                            <input type="number" step="1" min="1"
                                                class="inputCaja text-end" id="maximo" name="maximo"
                                                value="{{ old('maximo') }}">
                                        </div>

                                        <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                            <label class="labelTitulo">Costo Unitario: <span>*</span></label></br>
                                            <input type="number" step="0.01" min="0.01"
                                                class="inputCaja text-end" id="valor" name="valor" required
                                                value="{{ old('valor') }}">
                                        </div>

                                        <!-- PARA USO EXCLUSIVO DE UNIFORMES -->
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

                                        <!-- PARA USO EXCLUSIVO DE EXTINTORES -->
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
                                                <label class="labelTitulo">Fecha de Vencimiento:</label></br>
                                                <input type="date" class="inputCaja" id="extintorFechaVencimiento"
                                                    name="extintorFechaVencimiento"
                                                    value="{{ old('extintorFechaVencimiento') }}">
                                            </div>

                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                <label class="labelTitulo">Tipo de Extintor:</label></br>
                                                <select class="form-select" aria-label="Default select example"
                                                    id="extintorTipo" name="extintorTipo">
                                                    <option value="A">A
                                                    </option>
                                                    <option value="B">B
                                                    </option>
                                                    <option value="C">C
                                                    </option>
                                                    <option value="D">D
                                                    </option>
                                                </select>
                                            </div>

                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                <label class="labelTitulo">Ubicación:</label></br>
                                                <input type="text" class="inputCaja" id="extintorUbicacion"
                                                    name="extintorUbicacion" value="{{ old('extintorUbicacion') }}">
                                            </div>

                                            <div class=" col-12 col-sm-6 col-lg-4 mb-5 ">
                                                <label class="labelTitulo">Asignado :</label></br>
                                                <select id="extintorAsignadoMaquinariaId"
                                                    name="extintorAsignadoMaquinariaId" class="form-select"
                                                    aria-label="Default select example">
                                                    <option value="">Seleccione</option>
                                                    @foreach ($vctMaquinaria as $item)
                                                        <option value="{{ $item->id }}">
                                                            {{ $item->nombre }}
                                                        </option>
                                                    @endforeach
                                                </select>
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
