@extends('layouts.main', ['activePage' => 'personal', 'titlePage' => __('Detalle Herramienta')])
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
                                <h2 class="my-3 ms-3 texticonos ">Detalle Herramienta</h2>
                            </div>
                            <form action="{{ route('inventario.update', $inventario->id) }}"
                                method="post"class="row alertaGuardar" enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="col-12 col-md-4  my-3">
                                    <div class="text-center mx-auto border vistaFoto mb-4">
                                        <i><img class="imgVista img-fluid"
                                                src="{{ $inventario->imagen == '' ? ' /img/general/default.jpg' : asset('app/public/inventario/' . $inventario->tipo . '/' . $inventario->imagen) }}"></i>

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
                                        <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                            <label class="labelTitulo">Número del Parte:</label></br>
                                            <input type="text" class="inputCaja" id="numparte" name="numparte"
                                                value="{{ $inventario->numparte }}">
                                        </div>

                                        <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                            <label class="labelTitulo">Nombre:</label></br>
                                            <input type="text" class="inputCaja" id="nombres" name="nombre"
                                                value="{{ $inventario->nombre }}">
                                        </div>

                                        <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                            <label class="labelTitulo">Marca:</label></br>
                                            <input type="text" class="inputCaja" id="marca" name="marca"
                                                value="{{ $inventario->marca }}">
                                        </div>

                                        <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                            <label class="labelTitulo">Modelo:</label></br>
                                            <input type="text" class="inputCaja" id="modelo" name="modelo"
                                                value="{{ $inventario->modelo }}">
                                        </div>

                                        <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                            <label class="labelTitulo">Proovedor:</label></br>
                                            <input type="text" class="inputCaja" id="proveedor" name="proveedor"
                                                value="{{ $inventario->proveedor }}">
                                        </div>

                                        <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                            <label class="labelTitulo">Cantidad a ingresar:</label></br>
                                            <input type="number" step="0.01" min="0.01" class="inputCaja"
                                                id="cantidad" name="cantidad" value="{{ $inventario->cantidad }}">
                                        </div>

                                        <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                            <label class="labelTitulo">Minimo:</label></br>
                                            <input type="number" step="0.01" min="0.01" class="inputCaja"
                                                id="reorden" name="reorden" value="{{ $inventario->reorden }}">
                                        </div>

                                        <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                            <label class="labelTitulo">Maximo:</label></br>
                                            <input type="number" step="0.01" min="0.01" class="inputCaja"
                                                id="maximo" name="maximo" value="{{ $inventario->maximo }}">
                                        </div>

                                        <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                            <label class="labelTitulo">Costo unitario:</label></br>
                                            <input type="number" step="0.01" min="0.01" class="inputCaja"
                                                id="valor" name="valor" value="{{ $inventario->Valor }}">
                                        </div>

                                        <div class=" col-12 col-sm-6 col-lg-6 mb-5 ">
                                            <label class="labelTitulo">Tipo:</label></br>
                                            <select class="form-select" aria-label="Default select example"
                                                id="tipo" name="tipo">
                                                <option value="herramientas"
                                                    {{ $inventario->tipo == 'herramientas' ? ' selected' : '' }}>
                                                    Herramienta</option>
                                                <option value="refacciones"
                                                    {{ $inventario->tipo == 'refacciones' ? ' selected' : '' }}>Refaccion
                                                </option>
                                                <option value="consumibles"
                                                    {{ $inventario->tipo == 'consumibles' ? ' selected' : '' }}>Consumible
                                                </option>
                                            </select>
                                        </div>

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
                    <label class="labelTitulo">Tipo de movimiento:</label></br>
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
                                {{ $maquina->nombre . ' / ' . $maquina->modelo . ( $maquina->placas != "" ? ' [' . $maquina->placas . ']' : "") }} </option>
                        @endforeach
                    </select>

                    <label class="labelTitulo mt-3">Destino:</label></br>
                    {{-- <input type="text" class="inputCaja" id="hasta" name="hasta" value=""> --}}
                    <select id="hasta" name="hasta" class="form-select" aria-label="Default select example">
                        @foreach ($vctHasta as $maquina)
                            <option value="{{ $maquina->id }}" {{ $maquina->id == $inventario->id ? ' selected' : '' }}>
                                {{ $maquina->nombre . ' / ' . $maquina->modelo . ( $maquina->placas != "" ? ' [' . $maquina->placas . ']' : "") }} </option>
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
