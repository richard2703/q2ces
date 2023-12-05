@extends('layouts.main', ['activePage' => 'cajaChica', 'titlePage' => __('Caja Chica - Nuevo Movimiento')])
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
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header bacTituloPrincipal">
                                    <h4 class="card-title">Actualizas Movimiento de Servicios</h4>
                                    {{-- <p class="card-category">Usuarios Registrados</p> --}}

                                </div>

                                <div class="d-flex p-3 divBorder">
                                    <div class="col-6 ">
                                        <a href="{{ route('serviciosTrasporte.index') }}">
                                            <button class="btn regresar">
                                                <span class="material-icons">
                                                    reply
                                                </span>
                                                Regresar
                                            </button>
                                        </a>
                                    </div>
                                    @can('user_create')
                                        <div class="col-6 text-end">
                                            @if ($serviciosTrasporte->cajachica != 1)
                                                <form action="{{ route('serviciosTrasporte.cajaChica') }}" method="POST"
                                                    style="display: inline-block;" onsubmit="return confirm('Seguro?')">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $serviciosTrasporte->id }}">
                                                    <button class="btn botonGral " type="submit" rel="tooltip">
                                                        Enviar a Caja Chica
                                                    </button>
                                                </form>
                                            @else
                                                <span class="combustibleLitros">Movimiento Registrado en Caja
                                                    Chica</span>
                                            @endif

                                        </div>
                                    @endcan
                                </div>

                                <form class="alertaGuardar"
                                    action="{{ route('serviciosTrasporte.update', $serviciosTrasporte->id) }}"
                                    method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method('put')
                                    <div class="card-body">
                                        @if (session('success'))
                                            <div class="alert alert-success" role="success">
                                                {{ session('success') }}
                                            </div>
                                        @endif
                                        @if (session('faild'))
                                            <div class="alert alert-danger" role="faild">
                                                {{ session('faild') }}
                                            </div>
                                        @endif
                                        <div class="row pt-3">
                                            <div class=" col-12 col-sm-6 col-md-4 mb-3 ">
                                                <label class="labelTitulo">Día: <span>*</span></label></br>
                                                <input type="date" class="inputCaja" id="dia" name="fecha"
                                                    required value="{{ $serviciosTrasporte->fecha }}">

                                            </div>

                                            <div class=" col-12 col-sm-6 col-md-4 mb-3 ">
                                                <label class="labelTitulo">Concepto: <span>*</span></label></br>
                                                <select id="concepto" name="conceptoServicioTrasporteId"
                                                    class="form-select" required aria-label="Default select example">
                                                    <option selected value="">Seleccione</option>
                                                    @forelse ($conceptos as $concepto)
                                                        <option value="{{ $concepto->id }}"
                                                            {{ $serviciosTrasporte->conceptoId == $concepto->id ? 'selected' : '' }}>
                                                            {{ $concepto->codigo }} -
                                                            {{ $concepto->nombre }}
                                                        </option>
                                                    @empty
                                                    @endforelse
                                                </select>
                                            </div>

                                            <div class=" col-12 col-sm-6 col-md-4 mb-3 ">
                                                <label class="labelTitulo">Operador: <span>*</span></label></br>
                                                <select id="personal" name="personalId" class="form-select" required
                                                    aria-label="Default select example">
                                                    <option selected value="">Seleccione</option>
                                                    @forelse ($personal as $persona)
                                                        <option value="{{ $persona->id }}"
                                                            {{ $serviciosTrasporte->personalId == $persona->id ? 'selected' : '' }}>
                                                            {{ $persona->nombres }}
                                                            {{ $persona->apellidoP }}
                                                        </option>
                                                    @empty
                                                    @endforelse
                                                </select>
                                            </div>

                                            <div class=" col-12 col-sm-6 col-md-4 mb-3 ">
                                                <label class="labelTitulo">Maniobrista: <span>*</span></label></br>
                                                <select id="maniobristaId" name="maniobristaId" class="form-select"
                                                    aria-label="Default select example">
                                                    <option selected value="">Seleccione</option>
                                                    @forelse ($personal as $persona)
                                                        <option value="{{ $persona->id }}"
                                                            {{ $serviciosTrasporte->maniobristaId == $persona->id ? 'selected' : '' }}>
                                                            {{ $persona->nombres }}
                                                            {{ $persona->apellidoP }}
                                                        </option>
                                                    @empty
                                                    @endforelse
                                                </select>
                                            </div>

                                            <div class=" col-12 col-sm-6 col-md-4 mb-3 ">
                                                <label class="labelTitulo">Equipo: <span>*</span></label></br>
                                                <select id="equipo" name="equipoId" class="form-select" required
                                                    aria-label="Default select example">
                                                    <option selected value="">Seleccione</option>
                                                    @forelse ($maquinaria as $maquina)
                                                        <option value="{{ $maquina->id }}"
                                                            {{ $serviciosTrasporte->equipoId == $maquina->id ? 'selected' : '' }}>
                                                            {{ $maquina->identificador }}
                                                            - {{ $maquina->nombre }}
                                                        </option>
                                                    @empty
                                                    @endforelse
                                                </select>
                                            </div>

                                            <div class=" col-12 col-sm-6 col-md-4 mb-3 ">
                                                <label class="labelTitulo">Odometro: <span>*</span></label></br>
                                                <input type="number" class="inputCaja text-right" id="odometro"
                                                    name="odometro" maxlength="100000" step="0.01" min="0.01"
                                                    max="99999" placeholder="ej. 100"
                                                    value="{{ $serviciosTrasporte->odometro }}">
                                            </div>

                                            <div class=" col-12 col-sm-6 col-md-4 mb-3 ">
                                                <label class="labelTitulo">Obra: </label></br>
                                                <select id="obra" name="obraId" class="form-select"
                                                    aria-label="Default select example">
                                                    <option selected value="">Seleccione</option>
                                                    @forelse ($obras as $obra)
                                                        <option value="{{ $obra->id }}"
                                                            {{ $serviciosTrasporte->obraId == $obra->id ? 'selected' : '' }}>
                                                            {{ $obra->nombre }} </option>
                                                    @empty
                                                    @endforelse
                                                </select>
                                            </div>

                                            <div class=" col-12 col-sm-6 col-md-4 mb-3 ">
                                                <label class="labelTitulo">Almacen/Tiradero: <span>*</span></label></br>
                                                <select id="almacenId" name="almacenId" class="form-select" required
                                                    aria-label="Default select example">
                                                    <option selected value="">Seleccione</option>
                                                    @forelse ($almacenes as $almacen)
                                                        <option value="{{ $almacen->id }}"
                                                            {{ $serviciosTrasporte->almacenId == $almacen->id ? 'selected' : '' }}>
                                                            {{ $almacen->nombre }}
                                                        </option>
                                                    @empty
                                                    @endforelse
                                                </select>
                                            </div>

                                            <div class=" col-12 col-sm-6 col-md-4 mb-3 ">
                                                <label class="labelTitulo">Quien Recibe: </label></br>
                                                <input class="inputCaja" type="text" name="recibe"
                                                    value="{{ $serviciosTrasporte->recibe }}">
                                            </div>

                                            <div class=" col-12 col-sm-6 col-md-4 mb-3 ">
                                                <label class="labelTitulo">Hora Entrega: </label></br>
                                                <input class="inputCaja" type="time" name="horaEntrega"
                                                    value="{{ $serviciosTrasporte->horaEntrega }}">
                                            </div>

                                            <div class=" col-12 col-sm-6 col-md-4 mb-3 ">
                                                <label class="labelTitulo">Hora Llegada: </label></br>
                                                <input class="inputCaja" type="time" name="horaLlegada"
                                                    value="{{ $serviciosTrasporte->horaLlegada }}">
                                            </div>

                                            <div class=" col-12 col-sm-6 col-md-4 mb-3 ">
                                                <label class="labelTitulo">Costo Material: <span>*</span></label></br>
                                                <input type="number" class="inputCaja text-right" id="cantidad"
                                                    name="cantidad" maxlength="100000" step="0.01" min="0.01"
                                                    max="99999" placeholder="ej. 100"
                                                    value="{{ $serviciosTrasporte->cantidad }}">
                                            </div>

                                            {{--  <div class=" col-12 col-sm-6 col-md-4 mb-3 ">
                                                <label class="labelTitulo">Costo Material: <span>*</span></label></br>
                                                <input type="number" class="inputCaja text-right" id="costoMaterial"
                                                    name="costoMaterial" maxlength="100000" step="0.01"
                                                    min="0.01" max="99999" placeholder="ej. 100"
                                                    value="{{ $serviciosTrasporte->costoMaterial }}">
                                            </div>  --}}
                                            <div class=" col-12 col-sm-6 col-md-4 mb-3 ">
                                                <label class="labelTitulo">Costo Servicio: <span>*</span></label></br>
                                                <input type="number" class="inputCaja text-right" id="costoServicio"
                                                    name="costoServicio" maxlength="100000" step="0.01"
                                                    min="0.00" max="99999" placeholder="ej. 100"
                                                    value="{{ $serviciosTrasporte->costoServicio }}">
                                            </div>
                                            <div class=" col-12 col-sm-6 col-md-4 mb-3 ">
                                                <label class="labelTitulo">Costo Mano de Obra: <span>*</span></label></br>
                                                <input type="number" class="inputCaja text-right" id="costoMano"
                                                    name="costoMano" maxlength="100000" step="0.01" min="0.00"
                                                    max="99999" placeholder="ej. 100"
                                                    value="{{ $serviciosTrasporte->costoMano }}">
                                            </div>


                                            <div class=" col-12 col-sm-6 col-md-4 mb-3 ">
                                                <label class="labelTitulo">Estatus:</label></br>
                                                <select id="estatus" name="estatus" class="form-select"
                                                    aria-label="Default select example">
                                                    <option
                                                        value="1"{{ $serviciosTrasporte->estatus == 1 ? 'selected' : '' }}>
                                                        Espera</option>
                                                    <option
                                                        value="2"{{ $serviciosTrasporte->estatus == 2 ? 'selected' : '' }}>
                                                        Hecho</option>
                                                    <option
                                                        value="3"{{ $serviciosTrasporte->estatus == 3 ? 'selected' : '' }}>
                                                        Cerrado</option>
                                                    <option
                                                        value="0"{{ $serviciosTrasporte->estatus == 0 ? 'selected' : '' }}>
                                                        Cancelado</option>

                                                </select>
                                            </div>

                                            <div class=" col-12 col-sm-6 col-md-4 mb-3 ">
                                                <label class="labelTitulo">Trabajo y/o Servicio:</label></br>
                                                <textarea id="servicio" class="inputCaja" name="servicio" rows="5" cols="20">{{ $serviciosTrasporte->servicio }}</textarea>
                                            </div>

                                            <div class=" col-12 col-sm-6 col-md-4 mb-3 ">
                                                <label class="labelTitulo">Comentario:</label></br>
                                                <textarea id="comentario" class="inputCaja" name="comentario" rows="5" cols="20">{{ $serviciosTrasporte->comentario }}</textarea>
                                            </div>

                                        </div>

                                    </div>
                                    @if ($serviciosTrasporte->cajachica != 1)
                                        <div class="col-12 text-center mb-3 ">
                                            <button type="submit" class="btn botonGral"
                                                onclick="test()">Guardar</button>
                                        </div>
                                    @endif

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--  Modales
    <div class="modal fade" id="modalConcepto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bacTituloPrincipal">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">&nbsp Nuevo Concepto</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row d-flex" action="{{ route('conceptos.store') }}" method="post">
                        @csrf
                        <div class=" col-12 col-sm-6  mb-3 ">
                            <label class="labelTitulo">Código:</label></br>
                            <input type="text" class="inputCaja" id="codigo" name="codigo"
                                value="{{ old('comentario') }}">
                        </div>
                        <div class=" col-12 col-sm-6  mb-3 ">
                            <label class="labelTitulo">Nombre:</label></br>
                            <input type="text" class="inputCaja" id="nombre" name="nombre"
                                value="{{ old('comentario') }}">
                        </div>
                        <div class=" col-12  mb-3 ">
                            <label class="labelTitulo">Comentario:</label></br>
                            <textarea id="comentario" class="inputCaja" name="comentario" rows="5" cols="20"></textarea>

                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn botonGral">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>  --}}
@endsection
<script>
    function Guardado() {
        // alert('test');
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        Toast.fire({
            icon: 'success',
            title: 'Guardado con exito'
        })
    }
    var slug = '1';
    if (slug == 1) {
        Guardado();

    }
</script>
