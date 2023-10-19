@extends('layouts.main', ['activePage' => 'cajaChica', 'titlePage' => __('Caja Chica - Nuevo Movimiento')])
@section('content')
    @inject('carbon', 'Carbon\Carbon')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header bacTituloPrincipal">
                                    <h4 class="card-title"> Editar Movimientos de Caja Chica</h4>
                                    {{-- <p class="card-category">Usuarios registrados</p> --}}
                                </div>
                                <div class="d-flex p-3 divBorder">
                                    <div class="col-6 ">
                                        <a href="{{ route('cajaChica.index') }}">
                                            <button class="btn regresar">
                                                <span class="material-icons">
                                                    reply
                                                </span>
                                                Regresar
                                            </button>
                                        </a>
                                        {{-- @can('user_create') --}}
                                    </div>
                                </div>
                                <form class="alertaGuardar" action="{{ route('cajaChica.update', $cajaChica->id) }}"
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
                                                <label class="labelTitulo">Día:</label></br>
                                                <input type="date" class="inputCaja" id="dia" name="dia"
                                                    value={{ $cajaChica->dia }}>

                                            </div>

                                            <div class=" col-12 col-sm-6 col-md-4 mb-3 ">
                                                <label class="labelTitulo">Concepto:</label></br>
                                                <select id="concepto" name="concepto" class="form-select" required
                                                    aria-label="Default select example">
                                                    <option value="" selected>Seleccione</option>
                                                    @forelse ($conceptos as $concepto)
                                                        <option value="{{ $concepto->id }}"
                                                            {{ $cajaChica->concepto == $concepto->id ? 'selected' : '' }}>
                                                            {{ $concepto->codigo }} -
                                                            {{ $concepto->nombre }}
                                                        </option>
                                                    @empty
                                                    @endforelse

                                                </select>
                                            </div>

                                            <div class=" col-12 col-sm-6 col-md-4 mb-3 ">
                                                <label class="labelTitulo">Personal:</label></br>
                                                <select id="personal" name="personal" class="form-select"
                                                    aria-label="Default select example">
                                                    <option value=""selected>Seleccione</option>
                                                    @forelse ($personal as $persona)
                                                        <option value="{{ $persona->id }}"
                                                            {{ $cajaChica->personal == $persona->id ? 'selected' : '' }}>
                                                            {{ $persona->nombres }}
                                                            {{ $persona->apellidoP }}
                                                        </option>
                                                    @empty
                                                    @endforelse
                                                </select>
                                            </div>

                                            <div class=" col-12 col-sm-6 col-md-4 mb-3 ">
                                                <label class="labelTitulo">Comprobante:</label></br>
                                                <select id="comprobanteId" name="comprobanteId" class="form-select"
                                                    aria-label="Default select example">
                                                    <option value="" selected>Seleccione</option>
                                                    @foreach ($vctComprobantes as $item)
                                                        <option value="{{ $item->id }}"
                                                            {{ $cajaChica->comprobanteId == $item->id ? 'selected' : '' }}>
                                                            {{ $item->nombre }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class=" col-12 col-sm-6 col-md-4 mb-3 ">
                                                <label class="labelTitulo">Número de Comprobante:
                                                    <span>*</span></label></br>
                                                <input type="number" class="inputCaja text-right" id="ncomprobante"
                                                    required name="ncomprobante" maxlength="100000" step="1"
                                                    min="1" pattern="^\d*(\.\d{0,2})?$" max="99999"
                                                    placeholder="ej. 100" value="{{ $cajaChica->ncomprobante }}">
                                            </div>

                                            <div class=" col-12 col-sm-6 col-md-4 mb-3 ">
                                                <label class="labelTitulo">Obra:</label></br>
                                                <select id="obra" name="obra" class="form-select"
                                                    aria-label="Default select example">
                                                    <option value="" selected>Seleccione</option>
                                                    @forelse ($obras as $obra)
                                                        <option value="{{ $obra->id }}"
                                                            {{ $cajaChica->obra == $obra->id ? 'selected' : '' }}>
                                                            {{ $obra->nombre }} </option>
                                                    @empty
                                                    @endforelse
                                                </select>
                                            </div>

                                            <div class=" col-12 col-sm-6 col-md-4 mb-3 ">
                                                <label class="labelTitulo">Cliente:</label></br>
                                                <select id="cliente" name="cliente" class="form-select"
                                                    aria-label="Default select example">
                                                    @foreach ($vctClientes as $item)
                                                        <option value="{{ $item->id }}"
                                                            {{ $cajaChica->cliente == $item->id ? 'selected' : '' }}>
                                                            {{ $item->nombre }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class=" col-12 col-sm-6 col-md-4 mb-3 ">
                                                <label class="labelTitulo">Equipo:</label></br>
                                                <select id="equipo" name="equipo" class="form-select"
                                                    aria-label="Default select example">
                                                    <option value="" selected>Seleccione</option>
                                                    @forelse ($maquinaria as $maquina)
                                                        <option value="{{ $maquina->id }}"
                                                            {{ $cajaChica->equipo == $maquina->id ? 'selected' : '' }}>
                                                            {{ $maquina->identificador }}
                                                            - {{ $maquina->nombre }}
                                                        </option>
                                                    @empty
                                                    @endforelse

                                                    {{--  @foreach ($vctTiposHoras as $tipo)
												<option value="{{ $tipo->id }}"
													{{ $item->tipoHoraExtraId == $tipo->id ? ' selected' : '' }}>
													{{ $tipo->nombre }}
												</option>
											@endforeach  --}}
                                                </select>
                                            </div>
                                            <div class=" col-12 col-sm-6 col-md-4 mb-3 ">
                                                <label class="labelTitulo">Movimiento:</label></br>
                                                <select id="tipo" name="tipo" class="form-select"
                                                    aria-label="Default select example">
                                                    <option value="" selected>Seleccione</option>
                                                    <option value="1" {{ $cajaChica->tipo == 1 ? 'selected' : '' }}>
                                                        Ingreso </option>
                                                    <option value="2" {{ $cajaChica->tipo == 2 ? 'selected' : '' }}>
                                                        Egreso
                                                    </option>
                                                    <option value="3" {{ $cajaChica->tipo == 3 ? 'selected' : '' }}>
                                                        Ingreso Servicios
                                                    </option>
                                                    <option value="4" {{ $cajaChica->tipo == 4 ? 'selected' : '' }}>
                                                        Pendiente de Cobro Y/O Factura
                                                    </option>

                                                    {{--  @foreach ($vctTiposHoras as $tipo)
												<option value="{{ $tipo->id }}"
													{{ $item->tipoHoraExtraId == $tipo->id ? ' selected' : '' }}>
													{{ $tipo->nombre }}
												</option>
											@endforeach  --}}
                                                </select>
                                            </div>

                                            <div class=" col-12 col-sm-6 col-md-4 mb-3 ">
                                                <label class="labelTitulo">Cantidad:</label></br>
                                                <input type="number" class="inputCaja text-right" id="cantidad"
                                                    name="cantidad" maxlength="100000" step="0.01" min="1"
                                                    max="99999" placeholder="ej. 100"
                                                    value={{ $cajaChica->cantidad }}>
                                            </div>

                                            <div class=" col-12 col-sm-6 col-md-4 mb-3 ">
                                                <label class="labelTitulo">Comentario:</label></br>
                                                <textarea id="comentario" class="inputCaja" name="comentario" rows="5" cols="20">{{ $cajaChica->comentario }}</textarea>

                                            </div>

                                        </div>

                                    </div>
                                    <div class="col-12 text-center mb-3 ">
                                        <button type="submit" class="btn botonGral" onclick="test()">Guardar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--  Modales  --}}
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
    </div>
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
