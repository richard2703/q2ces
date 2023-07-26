@extends('layouts.main', ['activePage' => 'personal', 'titlePage' => __('Detalle {{ ucfirst($inventario->tipo) }}')])
@section('content')
    <div class="content">
        @if ($errors->any())
            <div class="alert alert-danger">
                <!-- PARA LA CARGA DE LOS ERRORES DE LOS DATOS-->
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
                    <div class="card-body contCart justify-content-center">
                        <div class="card ">
                            <div class="card-header bacTituloPrincipal mb-5">
                                <h2 class="my-3 ms-3 texticonos ">Detalle {{ ucfirst($inventario->tipo) }}</h2>
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

                            <form action="{{ route('inventario.update', $inventario->id) }}"
                                method="post"class="row alertaGuardar" enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="col-12 col-md-4  my-3">
                                    <div class="text-center mx-auto border vistaFoto mb-4">
                                        <i><img class="imgVista img-fluid"
                                                src="{{ $inventario->imagen == '' ? ' /img/general/default.jpg' : '/storage/inventario/' . $inventario->tipo . '/' . $inventario->imagen }}"></i>

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
                                        <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                            <label class="labelTitulo">Número de Parte: <span>*</span></label></br>
                                            <input type="text" class="inputCaja" id="numparte" name="numparte" required
                                                value="{{ $inventario->numparte }}">
                                        </div>

                                        <div class=" col-12 col-sm-6 col-lg-8 mb-3 ">
                                            <label class="labelTitulo">Nombre: <span>*</span></label></br>
                                            <input type="text" class="inputCaja" id="nombres" name="nombre" required
                                                value="{{ $inventario->nombre }}">
                                        </div>

                                        <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                            <label class="labelTitulo">Marca: <span>*</span></label></br>
                                            <select id="marcaId" name="marcaId" class="form-select" required
                                                aria-label="Default select example">
                                                <option value="">Seleccione</option>
                                                @foreach ($vctMarcas as $item)
                                                    <option value="{{ $item->id }}"
                                                        {{ $inventario->marcaId == $item->id ? ' selected' : '' }}>
                                                        {{ $item->nombre }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                            <label class="labelTitulo">Modelo:</label></br>
                                            <input type="text" class="inputCaja" id="modelo" name="modelo"
                                                value="{{ $inventario->modelo }}">
                                        </div>

                                        <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                            <label class="labelTitulo">Proveedor: <span>*</span></label></br>
                                            <select id="proveedorId" name="proveedorId" class="form-select" required
                                                aria-label="Default select example">
                                                <option value="">Seleccione</option>
                                                @foreach ($vctProveedores as $item)
                                                    <option value="{{ $item->id }}"
                                                        {{ $inventario->proveedorId == $item->id ? ' selected' : '' }}>
                                                        {{ $item->nombre }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                            <label class="labelTitulo">Cantidad: <span>*</span></label></br>
                                            <input type="number" step="1" min="1" class="inputCaja text-end"
                                                required id="cantidad" name="cantidad"
                                                value="{{ $inventario->cantidad }}">
                                        </div>

                                        <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                            <label class="labelTitulo">Mínimo:</label></br>
                                            <input type="number" step="1" min="1" class="inputCaja text-end"
                                                id="reorden" name="reorden" value="{{ $inventario->reorden }}">
                                        </div>

                                        <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                            <label class="labelTitulo">Máximo:</label></br>
                                            <input type="number" step="1" min="1" class="inputCaja text-end"
                                                id="maximo" name="maximo" value="{{ $inventario->maximo }}">
                                        </div>

                                        <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                            <label class="labelTitulo">Costo Unitario: <span>*</span></label></br>
                                            <input type="number" step="0.01" min="0.01"
                                                class="inputCaja text-end" required id="valor" name="valor"
                                                value="{{ $inventario->valor }}">
                                        </div>

                                        <div class=" col-12 col-sm-6 col-lg-6 mb-5 ">

                                            <input type="hidden" name="tipo" value="{{ $inventario->tipo }}">

                                            <label class="labelTitulo">Tipo:</label></br>
                                            <select class="form-select" aria-label="Default select example"
                                                id="tipo" name="tipo" disabled="false">
                                                <option value="herramientas"
                                                    {{ $inventario->tipo == 'herramientas' ? ' selected' : '' }}>
                                                    Herramientas</option>
                                                <option value="refacciones"
                                                    {{ $inventario->tipo == 'refacciones' ? ' selected' : '' }}>Refacciones
                                                </option>
                                                <option value="consumibles"
                                                    {{ $inventario->tipo == 'consumibles' ? ' selected' : '' }}>Consumibles
                                                </option>
                                                <option value="uniformes"
                                                    {{ $inventario->tipo == 'uniformes' ? ' selected' : '' }}>Uniformes
                                                </option>
                                                <option value="extintores"
                                                    {{ $inventario->tipo == 'extintores' ? ' selected' : '' }}>Extintores
                                                </option>
                                                <option value="servicios"
                                                    {{ $inventario->tipo == 'servicios' ? ' selected' : '' }}>Servicios
                                                </option>
                                            </select>
                                        </div>
                                        <!-- PARA USO EXCLUSIVO DE UNIFORMES -->
                                        @if ($inventario->tipo == 'uniformes')
                                            <div class=" col-12 col-sm-6 col-lg-4 mb-5 ">
                                                <label class="labelTitulo">Tipo de Uniforme:</label></br>
                                                <select id="uniformeTipoId" name="uniformeTipoId" class="form-select"
                                                    required aria-label="Default select example">
                                                    <option value="">Seleccione</option>
                                                    @foreach ($vctTipos as $item)
                                                        <option value="{{ $item->id }}"
                                                            {{ $item->id == $inventario->uniformeTipoId ? ' selected' : '' }}>
                                                            {{ $item->nombre }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                <label class="labelTitulo">Talla:</label></br>
                                                <input type="text" class="inputCaja" id="uniformeTalla"
                                                    name="uniformeTalla" value="{{ $inventario->uniformeTalla }}">
                                            </div>

                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                <label class="labelTitulo">Es Retornable:</label></br>
                                                <select class="form-select" aria-label="Default select example"
                                                    id="uniformeRetornable" name="uniformeRetornable">
                                                    <option value="0"
                                                        {{ $inventario->uniformeRetornable <= 0 ? ' selected' : '' }}>No
                                                    </option>
                                                    <option value="1"
                                                        {{ $inventario->uniformeRetornable == 1 ? ' selected' : '' }}>Sí
                                                    </option>
                                                </select>
                                            </div>
                                        @endif

                                        <!-- PARA USO EXCLUSIVO DE EXTINTORES -->
                                        @if ($inventario->tipo == 'extintores')
                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                <label class="labelTitulo">Capacidad:</label></br>
                                                <input type="text" class="inputCaja" id="extintorCapacidad"
                                                    name="extintorCapacidad"
                                                    value="{{ $inventario->extintorCapacidad }}">
                                            </div>

                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                <label class="labelTitulo">Identificador:</label></br>
                                                <input type="text" class="inputCaja" id="extintorCodigo"
                                                    name="extintorCodigo" value="{{ $inventario->extintorCodigo }}">
                                            </div>
                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                <label class="labelTitulo">Fecha de Vencimiento:</label></br>
                                                <input type="date" class="inputCaja" id="extintorFechaVencimiento"
                                                    name="extintorFechaVencimiento"
                                                    value="{{ $inventario->extintorFechaVencimiento }}">
                                            </div>

                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                <label class="labelTitulo">Tipo de Extintor:</label></br>
                                                <select class="form-select" aria-label="Default select example"
                                                    id="extintorTipo" name="extintorTipo">
                                                    <option value="A"
                                                        {{ $inventario->extintorTipo = 'A' ? ' selected' : '' }}>A
                                                    </option>
                                                    <option value="B"
                                                        {{ $inventario->extintorTipo == 'B' ? ' selected' : '' }}>B
                                                    </option>
                                                    <option value="C"
                                                        {{ $inventario->extintorTipo == 'C' ? ' selected' : '' }}>C
                                                    </option>
                                                    <option value="D"
                                                        {{ $inventario->extintorTipo == 'D' ? ' selected' : '' }}>D
                                                    </option>
                                                </select>
                                            </div>

                                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                                <label class="labelTitulo">Ubicación:</label></br>
                                                <input type="text" class="inputCaja" id="extintorUbicacion"
                                                    name="extintorUbicacion"
                                                    value="{{ $inventario->extintorUbicacion }}">
                                            </div>

                                            <div class=" col-12 col-sm-6 col-lg-4 mb-5 ">
                                                <label class="labelTitulo">Asignado :</label></br>
                                                <select id="extintorAsignadoMaquinariaId" name="extintorAsignadoMaquinariaId" class="form-select"
                                                      aria-label="Default select example">
                                                    <option value="">Seleccione</option>
                                                    @foreach ($vctMaquinaria as $item)
                                                        <option value="{{ $item->id }}"
                                                            {{ $item->id == $inventario->extintorAsignadoMaquinariaId ? ' selected' : '' }}>
                                                            {{ $item->nombre }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        @endif



                                        <div class="col-12 text-center mt-5">

                                            <button type="button" class="btn btn-primary botonGral"
                                                data-bs-toggle="modal" data-bs-target="#staticBackdrop">
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
                                                    <i class=""><img class="mb-4"
                                                            style="width: 60px;"src="{{ '/img/equipos/obras.svg' }}"></i>
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
                                                    <i class=""><img class="mb-4"
                                                            style="width: 60px;"src="{{ '/img/equipos/equipo.svg' }}"></i>
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
                                                    <i class=""><img class="mb-4"
                                                            style="width: 55px;"src="{{ '/img/equipos/calendar.svg' }}"></i>
                                                </div>
                                                <h4 class="textTitulo text-dark ">Fecha de Inicio</h4>
                                                <p class="description bolder">No Asignado <br>aún.</p>
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
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bacTituloPrincipal mb-3">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Mover</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="col-11" action="{{ route('inventario.mover', $inventario->id) }}" method="post">
                    @csrf
                    @method('put')
                    <input type="hidden" name="productoId" id="productoId" value="{{ $inventario->id }}">
                    <input type="hidden" name="productoTipo" id="productoTipo" value="{{ $inventario->tipo }}">
                    <label class="labelTitulo">Tipo de Movimiento:</label></br>
                    <select class="form-select" aria-label="Default select example" id="tipo" name="tipo">
                        <option value="asignar">Asignar</option>
                        <option value="desechar">Desechar</option>
                    </select>

                    <label class="labelTitulo mt-3">Cantidad:</label></br>
                    <input type="number" step="0.01" min="0.01" class="inputCaja" id="cantidad"
                        name="cantidad" value="">

                    <label class="labelTitulo mt-3">Origen:</label></br>
                    {{-- <input type="text" class="inputCaja" id="desde" name="desde" value=""> --}}
                    <select id="desde" name="desde" class="form-select" aria-label="Default select example">
                        @foreach ($vctDesde as $maquina)
                            <option value="{{ $maquina->id }}" {{ $maquina->id == $inventario->id ? ' selected' : '' }}>
                                {{ $maquina->nombre . ' / ' . $maquina->modelo . ($maquina->placas != '' ? ' [' . $maquina->placas . ']' : '') }}
                            </option>
                        @endforeach
                    </select>

                    <label class="labelTitulo mt-3">Destino:</label></br>
                    {{-- <input type="text" class="inputCaja" id="hasta" name="hasta" value=""> --}}
                    <select id="hasta" name="hasta" class="form-select" aria-label="Default select example">
                        @foreach ($vctHasta as $maquina)
                            <option value="{{ $maquina->id }}" {{ $maquina->id == $inventario->id ? ' selected' : '' }}>
                                {{ $maquina->nombre . ' / ' . $maquina->modelo . ($maquina->placas != '' ? ' [' . $maquina->placas . ']' : '') }}
                            </option>
                        @endforeach
                    </select>

                    <label class="labelTitulo mt-3">Comentario:</label></br>
                    <textarea class="col-12 inputCaja mb-3" id="comentarios" name="comentarios"></textarea>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary botonGral mx-auto">Mover</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
