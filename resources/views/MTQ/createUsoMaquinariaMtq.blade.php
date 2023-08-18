@extends('layouts.main', ['activePage' => 'mtq', 'titlePage' => __('MTQ')])
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bacTituloPrincipal">
                            <h4 class="card-title"> Registro de Uso MTQ</h4>
                        </div>

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
                                <div class="col-4 text-left">
                                    <a href="{{ route('uso.index') }}">
                                        <button class="btn regresar">
                                            <span class="material-icons">
                                                reply
                                            </span>
                                            Regresar
                                        </button>
                                    </a>
                                </div>
                                <div class="col-8 align-end">
                                    @can('maquinaria_mtq_create')
                                        <button data-bs-toggle="modal" data-bs-target="#nuevoItem" type="button"
                                            class="btn botonGral">Registrar Uso</button>
                                    @endcan
                                </div>

                                <div class="d-flex p-3 divBorder"></div>
                            </div>
                            <form action="{{ route('uso.store') }}" method="post">
                                @csrf
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead class="labelTitulo">
                                            <th class="labelTitulo text-center" style="width:150px">Número Económico</th>
                                            <th class="labelTitulo text-center">Equipo</th>
                                            <th class="labelTitulo text-center">Marca</th>
                                            <th class="labelTitulo text-center">Modelo</th>
                                            <th class="labelTitulo text-center">Placas</th>
                                            <th class="labelTitulo text-center">Km. Actual</th>
                                            <th class="labelTitulo text-center">Nuevo Km.</th>
                                        </thead>
                                        <tbody>
                                            @forelse ($maquinaria as $maquina)
                                                <tr>
                                                    <td class="text-center">{{ $maquina->identificador }}</td>
                                                    <td class="text-center">{{ $maquina->nombre }}</td>
                                                    <td class="text-center">{{ $maquina->marca }}</td>
                                                    <td class="text-center">{{ $maquina->modelo }}</td>
                                                    <td class="text-center">{{ $maquina->placas }}</td>
                                                    <td class="text-center">{{ number_format($maquina->kilometraje) }}</td>
                                                    <td class="text-center">
                                                        <input type="hidden" name="id[]" value="{{ $maquina->id }}">
                                                        <input class="inputCaja" min="{{ $maquina->kilometraje }}"
                                                            type="number" name="valor[]" id=""
                                                            style="width: -webkit-fill-available;">
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="2">Sin registros.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                <div class="text-center pb-2">
                                    {{--  {{ $maquinaria->links() }}  --}}
                                    <button type="submit" class="btn botonGral" id="btnTareaGuardar"
                                        onclick="alertaGuardar()">Guardar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Nueva Equipos MTQ-->
    <div class="modal fade" id="nuevoItem" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bacTituloPrincipal">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">&nbsp Nueva Equipos MTQ</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row d-flex" action="{{ route('uso.store') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf

                        {{--  <input type="hidden" name="maquinariaId" id="maquinariaId" value="" required>  --}}

                        <div class=" col-12 mb-3 ">
                            <label class="labelTitulo">Buscador:<span>*</span></label></br>
                            <input type="text" class="inputCaja" id="search" name="search"
                                value="{{ old('identificador') }}" placeholder="ej: MT-00">
                        </div>

                        <div class=" col-12 col-sm-6 mb-3 ">
                            <label class="labelTitulo">Numero Económico:<span>*</span></label></br>
                            <input type="text" class="inputCaja" name="identificador" value="{{ old('identificador') }}"
                                placeholder="ej: MT-00" readonly id="identificador">
                        </div>

                        <div class=" col-12 col-sm-6 mb-3 ">
                            <label class="labelTitulo">Equipo:<span>*</span></label></br>
                            <input type="text" class="inputCaja" name="nombre" value="{{ old('nombre') }}" readonly
                                id="nombre">
                        </div>
                        <div class=" col-12 col-sm-6 mb-3 ">
                            <label class="labelTitulo">Marca:<span>*</span></label></br>
                            <input type="text" class="inputCaja" name="marca" value="{{ old('marca') }}" readonly
                                id="marca">
                        </div>

                        <div class=" col-12 col-sm-6 mb-3 ">
                            <label class="labelTitulo">Modelo:<span>*</span></label></br>
                            <input type="text" class="inputCaja" name="modelo" value="{{ old('modelo') }}" required
                                id="modelo">
                        </div>

                        <div class=" col-12 col-sm-6 mb-3 ">
                            <label class="labelTitulo">Uso actual:</label></br>
                            <input type="text" class="inputCaja" name="placas" value="" readonly
                                id="kilometraje">
                        </div>

                        <div class=" col-12 col-sm-6  mb-3 ">
                            <label class="labelTitulo">Nuevo Uso:</label></br>
                            <input type="hidden" name="id[]" value="" id="idmaq">
                            <input type="text" class="inputCaja" placeholder="Ej. NS01234ABCD" name="valor[]"
                                value="{{ old('numserie') }}" id="valor">
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

    <style>
        /* Estilos personalizados para alinear el botón de hacia la derecha */
        .align-end {
            display: flex !important;
            justify-content: flex-end !important;
        }

        @media only screen and (max-width: 500px) {
            .align-end button {
                width: 120px !important;
            }
        }
    </style>

    <script>
        function cargaItem(id, identificador, nombre, marca, modelo, submarca, ano, color, placas, numserie, nummotor, img,
            modalTipo) {

            const txtId = document.getElementById('id');
            txtId.value = id;

            const contenedorBotonGuardar = document.getElementById('contenedorBotonGuardar');
            const contenedorBotonSubirImagen = document.getElementById('contenedorBotonSubirImagen');
            if (modalTipo) {
                contenedorBotonSubirImagen.style.display = 'none';
            } else {
                contenedorBotonSubirImagen.style.display = 'block';
            }

            if (modalTipo) {
                contenedorBotonGuardar.style.display = 'none';
            } else {
                contenedorBotonGuardar.style.display = 'block';
            }

            const tituloModal = document.getElementById('tituloModal');
            if (modalTipo) {
                tituloModal.textContent = 'Ver';
            } else {
                tituloModal.textContent = 'Editar';
            }

            const txtIdentificador = document.getElementById('identificador');
            txtIdentificador.value = identificador;
            txtIdentificador.readOnly = modalTipo;

            const txtNombre = document.getElementById('nombre');
            txtNombre.value = nombre;
            txtNombre.readOnly = modalTipo;

            const txtMarca = document.getElementById('marca');
            txtMarca.value = marca;
            txtMarca.readOnly = modalTipo;

            const txtModelo = document.getElementById('modelo');
            txtModelo.value = modelo;
            txtModelo.readOnly = modalTipo;

            const txtSubmarca = document.getElementById('submarca');
            txtSubmarca.value = submarca;
            txtSubmarca.readOnly = modalTipo;

            const txtAno = document.getElementById('ano');
            txtAno.value = ano;
            txtAno.readOnly = modalTipo;

            const txtColor = document.getElementById('color');
            txtColor.value = color;
            txtColor.readOnly = modalTipo;

            const txtPlacas = document.getElementById('placas');
            txtPlacas.value = placas;
            txtPlacas.readOnly = modalTipo;

            const txtNumserie = document.getElementById('numserie');
            txtNumserie.value = numserie;
            txtNumserie.readOnly = modalTipo;

            const txtNummotor = document.getElementById('nummotor');
            txtNummotor.value = nummotor;
            txtNummotor.readOnly = modalTipo;

            const imagenVista = document.getElementById('fotoImg');
            console.log('imagen 1', img);
            if (img != "" && img != null) {
                imagenVista.src = "{{ asset('/storage/maquinaria/') }}/" + identificador + "/" + img;
            } else {
                imagenVista.src = "{{ asset('/img/general/default.jpg') }}"
            }
            // Obtener todos los campos del formulario
            const campos = document.querySelectorAll('input[type="text"], textarea');

            // Aplicar color gris a los campos con readonly
            campos.forEach((campo) => {
                if (modalTipo) {
                    campo.readOnly = true;
                    campo.style.color = 'grey';
                } else {
                    campo.readOnly = false;
                    campo.style.color = 'initial';
                }
            });
        }
    </script>

    <script src="{{ asset('js/alertas.js') }}"></script>

    <script>
        function Guardado() {
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
        var slug = '{{ Session::get('message') }}';
        if (slug == 1) {
            Guardado();

        }
    </script>

    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E="
        crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script>
        var curso = ['html', 'hola', 'hi'];

        $('#search').autocomplete({

            source: function(request, response) {
                $.ajax({
                    url: "{{ route('search.equiposMTQ') }}",

                    dataType: 'json',
                    data: {
                        term: request.term,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        response(data);
                    }
                });
            },
            minChars: 1,
            width: 402,
            matchContains: "word",
            autoFill: true,
            minLength: 1,
            select: function(event, ui) {

                // Rellenar los campos con los datos de la persona seleccionada
                $('#identificador').val(ui.item.identificador);
                $('#nombre').val(ui.item.nombre);
                $('#marca').val(ui.item.marca);
                $('#modelo').val(ui.item.modelo);
                $('#kilometraje').val(ui.item.kilometraje);
                $('#idmaq').val(ui.item.id);
                // $('#numserie').val(ui.item.numserie);
                // $('#placas').val(ui.item.placas);
            }

        });

        $('#search2').autocomplete({

            source: function(request, response) {
                $.ajax({
                    url: "{{ route('search.materialMantenimiento') }}",

                    dataType: 'json',
                    data: {
                        term: request.term,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        response(data);
                    }
                });
            },
            minChars: 1,
            width: 402,
            matchContains: "word",
            autoFill: true,
            minLength: 1,
            select: function(event, ui) {
                // Rellenar los campos con los datos del inventario seleccionado
                crearItems(ui.item.id, ui.item.value);

                // $('#inventarioId').val(ui.item.id);
                // $('#descripcion').val(ui.item.value);
            }

        });
    </script>
@endsection
