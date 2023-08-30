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
                                    <h4 class="card-title">Movimientos De Caja Chica</h4>
                                    {{-- <p class="card-category">Usuarios Registrados</p> --}}

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
                                    <div class="col-6 text-end">
                                        <button type="button" class="btn botonGral " data-bs-toggle="modal"
                                        data-bs-target="#modalConcepto">Nuevo Concepto</button>
                                    </div>
                                    {{-- @endcan --}}
                                </div>

                                <form class="alertaGuardar" action="{{ route('cajaChica.store') }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
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
                                                <input type="date" class="inputCaja" id="dia" name="dia"
                                                    required value="{{ old('dia') }}">

                                            </div>

                                            <div class=" col-12 col-sm-6 col-md-4 mb-3 ">
                                                <label class="labelTitulo">Concepto: <span>*</span></label></br>
                                                <select id="concepto" name="concepto" class="form-select" required
                                                    aria-label="Default select example">
                                                    <option selected>Seleccione</option>
                                                    @forelse ($conceptos as $concepto)
                                                        <option value="{{ $concepto->id }}">{{ $concepto->codigo }} -
                                                            {{ $concepto->nombre }}
                                                        </option>
                                                    @empty
                                                    @endforelse
                                                </select>
                                                </select>
                                            </div>

                                            <div class=" col-12 col-sm-6 col-md-4 mb-3 ">
                                                <label class="labelTitulo">Personal: <span>*</span></label></br>
                                                <select id="personal" name="personal" class="form-select" required
                                                    aria-label="Default select example">
                                                    <option selected>Seleccione</option>
                                                    @forelse ($personal as $persona)
                                                        <option value="{{ $persona->id }}">{{ $persona->nombres }}
                                                            {{ $persona->apellidoP }}
                                                        </option>
                                                    @empty
                                                    @endforelse
                                                </select>
                                            </div>

                                            <div class=" col-12 col-sm-6 col-md-4 mb-3 ">
                                                <label class="labelTitulo">Comprobante: <span>*</span></label></br>
                                                <select id="comprobanteId" name="comprobanteId" class="form-select" required
                                                    aria-label="Default select example">
                                                    <option selected>Seleccione</option>
                                                    @foreach ($vctComprobantes as $item)
                                                    <option value="{{ $item->id }}">
                                                        {{ $item->nombre }}
                                                    </option>
                                                @endforeach
                                                </select>
                                            </div>

                                            <div class=" col-12 col-sm-6 col-md-4 mb-3 ">
                                                <label class="labelTitulo">Número De Comprobante:</label></br>
                                                <input type="text" class="inputCaja" id="ncomprobante"
                                                    name="ncomprobante" value="{{ old('ncomprobante') }}">
                                            </div>

                                            <div class=" col-12 col-sm-6 col-md-4 mb-3 ">
                                                <label class="labelTitulo">Obra: <span>*</span></label></br>
                                                <select id="obra" name="obra" class="form-select"
                                                    aria-label="Default select example">
                                                    <option selected>Seleccione</option>
                                                    @forelse ($obras as $obra)
                                                        <option value="{{ $obra->id }}">{{ $obra->nombre }} </option>
                                                    @empty
                                                    @endforelse
                                                </select>
                                            </div>

                                            <div class=" col-12 col-sm-6 col-md-4 mb-3 ">
                                                <label class="labelTitulo">Cliente:</label></br>
                                                <select id="cliente" name="cliente" class="form-select"
                                                    aria-label="Default select example">
                                                    <option selected>Seleccione</option>
                                                    @foreach ($vctClientes as $item)
                                                    <option value="{{ $item->id }}">
                                                        {{ $item->nombre }}
                                                    </option>
                                                @endforeach
                                                </select>
                                            </div>

                                            <div class=" col-12 col-sm-6 col-md-4 mb-3 ">
                                                <label class="labelTitulo">Equipo: <span>*</span></label></br>
                                                <select id="equipo" name="equipo" class="form-select" required
                                                    aria-label="Default select example">
                                                    <option selected>Seleccione</option>
                                                    @forelse ($maquinaria as $maquina)
                                                        <option value="{{ $maquina->id }}">{{ $maquina->identificador }}
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
                                                <label class="labelTitulo">Movimiento: <span>*</span></label></br>
                                                <select id="tipo" name="tipo" class="form-select" required
                                                    aria-label="Default select example">
                                                    <option selected>Seleccione</option>
                                                    <option value="1">
                                                        Ingreso </option>
                                                    <option value="2">
                                                        Egreso
                                                    </option>
                                                    <option value="3">
                                                        Ingreso Servicios
                                                    </option>
                                                    <option value="4">
                                                        Pendiente De Cobro Y/O Factura
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
                                                <label class="labelTitulo">Cantidad: <span>*</span></label></br>
                                                <input type="number" class="inputCaja text-right" id="cantidad" required
                                                    name="cantidad" maxlength="100000" step="0.01" min="0.01"
                                                    pattern="^\d*(\.\d{0,2})?$" max="99999" placeholder="ej. 100"
                                                    value="{{ old('calle') }}">
                                            </div>

                                            <div class=" col-12 col-sm-6 col-md-4 mb-3 ">
                                                <label class="labelTitulo">Comentario:</label></br>
                                                <textarea id="comentario" class="inputCaja" name="comentario" rows="5" cols="20"></textarea>
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
