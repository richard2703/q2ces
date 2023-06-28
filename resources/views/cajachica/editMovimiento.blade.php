@extends('layouts.main', ['activePage' => 'cajachica', 'titlePage' => __('Caja Chica - Nuevo Movimiento')])
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
                                <form class="row alertaGuardar" action="{{ route('cajachica.update', $cajachica->id) }}"
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

                                        <div class="row">
                                            <div class=" col-12 col-sm-6 col-md-4 mb-3 ">
                                                <label class="labelTitulo">Dia:</label></br>
                                                <input type="date" class="inputCaja" id="dia" name="dia"
                                                    value={{ $cajachica->dia }}>

                                            </div>

                                            <div class=" col-12 col-sm-6 col-md-4 mb-3 ">
                                                <label class="labelTitulo">Concepto:</label></br>
                                                <select id="concepto" name="concepto" class="form-select"
                                                    aria-label="Default select example">
                                                    <option selected>Seleccione</option>
                                                    @forelse ($conceptos as $concepto)
                                                        <option value="{{ $concepto->id }}"
                                                            {{ $cajachica->concepto == $concepto->id ? 'selected' : '' }}>
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
                                                    <option selected>Seleccione</option>
                                                    @forelse ($personal as $persona)
                                                        <option value="{{ $persona->id }}"
                                                            {{ $cajachica->personal == $persona->id ? 'selected' : '' }}>
                                                            {{ $persona->nombres }}
                                                            {{ $persona->apellidoP }}
                                                        </option>
                                                    @empty
                                                    @endforelse
                                                </select>
                                            </div>

                                            <div class=" col-12 col-sm-6 col-md-4 mb-3 ">
                                                <label class="labelTitulo">Comprobante:</label></br>
                                                <select id="comprobante" name="comprobante" class="form-select"
                                                    aria-label="Default select example">
                                                    <option selected>Seleccione</option>
                                                    <option value="1"
                                                        {{ $cajachica->comprobante == 1 ? 'selected' : '' }}>
                                                        Factura
                                                    </option>
                                                    <option value="2"
                                                        {{ $cajachica->comprobante == 2 ? 'selected' : '' }}>
                                                        Vale Q2Ces
                                                    </option>
                                                    <option value="3"
                                                        {{ $cajachica->comprobante == 3 ? 'selected' : '' }}>
                                                        Nota
                                                    </option>
                                                    <option value="4"
                                                        {{ $cajachica->comprobante == 4 ? 'selected' : '' }}>
                                                        Remision
                                                    </option>
                                                </select>
                                            </div>

                                            <div class=" col-12 col-sm-6 col-md-4 mb-3 ">
                                                <label class="labelTitulo">Numero de comprobante:</label></br>
                                                <input type="text" class="inputCaja" id="ncomprobante"
                                                    name="ncomprobante" value={{ $cajachica->ncomprobante }}>
                                            </div>

                                            <div class=" col-12 col-sm-6 col-md-4 mb-3 ">
                                                <label class="labelTitulo">Obra:</label></br>
                                                <select id="obra" name="obra" class="form-select"
                                                    aria-label="Default select example">
                                                    <option selected>Seleccione</option>
                                                    @forelse ($obras as $obra)
                                                        <option value="{{ $obra->id }}"
                                                            {{ $cajachica->obra == $obra->id ? 'selected' : '' }}>
                                                            {{ $obra->nombre }} </option>
                                                    @empty
                                                    @endforelse
                                                </select>
                                            </div>

                                            <div class=" col-12 col-sm-6 col-md-4 mb-3 ">
                                                <label class="labelTitulo">Cliente:</label></br>
                                                <select id="cliente" name="cliente" class="form-select"
                                                    aria-label="Default select example">
                                                    <option value="">
                                                        001-B ingreso caja chica
                                                    </option>
                                                </select>
                                            </div>

                                            <div class=" col-12 col-sm-6 col-md-4 mb-3 ">
                                                <label class="labelTitulo">Equipo:</label></br>
                                                <select id="equipo" name="equipo" class="form-select"
                                                    aria-label="Default select example">
                                                    <option selected>Seleccione</option>
                                                    @forelse ($maquinaria as $maquina)
                                                        <option value="{{ $maquina->id }}"
                                                            {{ $cajachica->equipo == $maquina->id ? 'selected' : '' }}>
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
                                                    <option selected>Seleccione</option>
                                                    <option value="1" {{ $cajachica->tipo == 1 ? 'selected' : '' }}>
                                                        Ingreso </option>
                                                    <option value="2" {{ $cajachica->tipo == 2 ? 'selected' : '' }}>
                                                        Egreso
                                                    </option>
                                                    <option value="3" {{ $cajachica->tipo == 3 ? 'selected' : '' }}>
                                                        Ingreso Servicios
                                                    </option>
                                                    <option value="4" {{ $cajachica->tipo == 4 ? 'selected' : '' }}>
                                                        Pendiente de cobro y/o factura
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
                                                <input type="number" class="inputCaja" id="cantidad" name="cantidad"
                                                    value={{ $cajachica->cantidad }}>
                                            </div>

                                            <div class=" col-12 col-sm-6 col-md-4 mb-3 ">
                                                <label class="labelTitulo">Comentario:</label></br>
                                                <textarea id="comentario" class="inputCaja" name="comentario" rows="5" cols="20">{{ $cajachica->comentario }}</textarea>

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
                            <label class="labelTitulo">Codigo:</label></br>
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
@endsection
