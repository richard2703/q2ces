@extends('layouts.main', ['activePage' => 'servicios', 'titlePage' => __('Caja Chica - Nuevo Movimiento')])
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
                                    <h4 class="card-title">Movimientos de Servicios</h4>
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
                                        {{-- @can('user_create') --}}
                                    </div>
                                    {{-- <div class="col-6 text-end">
                                        <button type="button" class="btn botonGral " data-bs-toggle="modal"
                                        data-bs-target="#modalConcepto">Nuevo Concepto</button>
                                    </div> --}}
                                    {{-- @endcan --}}
                                </div>

                                <form class="alertaGuardar" action="{{ route('serviciosTrasporte.store') }}" method="post"
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
                                                <input type="date" class="inputCaja" id="dia" name="fecha"
                                                    required value="{{ old('dia') }}">

                                            </div>

                                            <div class=" col-12 col-sm-6 col-md-4 mb-3 ">
                                                <label class="labelTitulo">Concepto: <span>*</span></label></br>
                                                <select id="concepto" name="conceptoId" class="form-select" required
                                                    aria-label="Default select example" onchange="obras()">
                                                    <option selected value="">Seleccione</option>
                                                    @forelse ($conceptos as $concepto)
                                                        <option value="{{ $concepto->id }}">{{ $concepto->codigo }} -
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
                                                        <option value="{{ $persona->id }}">{{ $persona->nombres }}
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
                                                        <option value="{{ $persona->id }}">{{ $persona->nombres }}
                                                            {{ $persona->apellidoP }}
                                                        </option>
                                                    @empty
                                                    @endforelse
                                                </select>
                                            </div>

                                            <div class=" col-12 col-sm-6 col-md-4 mb-3 ">
                                                <label class="labelTitulo">Obra: </label></br>
                                                <select id="obra" name="obraId" class="form-select"
                                                    aria-label="Default select example">
                                                    <option selected value="">Seleccione</option>
                                                    @forelse ($obras as $obra)
                                                        <option value="{{ $obra->id }}">{{ $obra->nombre }} </option>
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
                                                        <option value="{{ $maquina->id }}">{{ $maquina->identificador }}
                                                            - {{ $maquina->nombre }}
                                                        </option>
                                                    @empty
                                                    @endforelse
                                                </select>
                                            </div>

                                            <div class=" col-12 col-sm-6 col-md-4 mb-3 ">
                                                <label class="labelTitulo">Trabajo y/o Servicio:</label></br>
                                                <textarea id="servicio" class="inputCaja" name="servicio" rows="5" cols="20"></textarea>
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



    <script>
        function obras() {
            const conceptoId = document.getElementById('concepto').value;
            const ListaSeleccionar = document.getElementById('obra');

            var url = '{{ route('serviciosTrasporte.obrasXconcepto', ':conceptoId') }}';
            url = url.replace(':conceptoId', conceptoId);

            console.log(url); //serviciosTrasporte.obrasXconcepto
            fetch(url)
                .then(response => response.json())
                .then(data => {
                    // Actualiza las opciones en el select "item"
                    console.log(data);
                    ListaSeleccionar.innerHTML = '';
                    data.forEach(item => {
                        console.log(item);
                        var option = document.createElement('option');
                        option.value = item.id;
                        option.textContent = item.nombre;
                        ListaSeleccionar.appendChild(option);
                    });

                });


        };
    </script>

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
