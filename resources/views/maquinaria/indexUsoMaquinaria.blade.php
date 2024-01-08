@extends('layouts.main', ['activePage' => 'maquinaria', 'titlePage' => __('MTQ')])
@section('content')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/calendarMtq.css') }}">

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bacTituloPrincipal">
                            <h4 class="card-title">Uso Equipos</h4>
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
                            <div class="row divBorder">

                                <div class="col-12 pb-3 text-end">
                                    {{--  @can('calendario_mtq_create_mantenimiento')
                                        <button data-bs-toggle="modal" data-bs-target="#modalEvento" type="button"
                                            style="height: 40px" class="btn botonGral ">Agregar Mantenimiento</button>
                                    @endcan  --}}
                                    @can('maquinaria_mtq_update_uso_bloque')
                                        <a href="{{ route('maquinaria.createQ2cesUso') }}">
                                            <button type="button" class="btn botonGral">Registrar Uso</button>
                                        </a>
                                    @endcan
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="labelTitulo">
                                        <th class="labelTitulo text-center">N.E.</th>
                                        <th class="labelTitulo text-center">Equipo</th>
                                        <th class="labelTitulo text-center">Marca</th>
                                        <th class="labelTitulo text-center">Modelo</th>
                                        <th class="labelTitulo text-center">Placas</th>
                                        <th class="labelTitulo text-center">Ultimo</th>
                                        <th class="labelTitulo text-center">Tipo</th>
                                        <th class="labelTitulo text-center">Uso Actual</th>
                                        <th class="labelTitulo text-center no-wrap">Km para Mantenimiento</th>
                                        <th class="labelTitulo text-center no-wrap">Próximo Mantenimiento</th>
                                        <th class="labelTitulo text-center" style="width:120px">Acciones</th>
                                    </thead>
                                    <tbody>
                                        @php
                                            $blnExiste = false;
                                            $strSinUso = '---';
                                        @endphp
                                        @forelse ($maquinaria as $maquina)
                                            <tr>
                                                <td class="text-center">{{ $maquina->identificador }}</td>
                                                <td class="text-center">{{ $maquina->nombre_maquinaria }}</td>
                                                <td class="text-center">{{ $maquina->nombre_marca }}</td>
                                                <td class="text-center">{{ $maquina->modelo }}</td>
                                                <td class="text-center">{{ $maquina->placas }}</td>
                                                <td class="text-center">{{ $maquina->ultima_fecha_mantenimiento }}</td>
                                                <td class="text-center">{{ $maquina->tipoMantenimiento }}</td>
                                                <td class="text-center">{{ number_format($maquina->kilometraje) }}</td>
                                                <td class="text-center">
                                                    {{ number_format($maquina->mantenimiento - $maquina->kilometraje) }}
                                                </td>
                                                <td class="text-center">{{ number_format($maquina->mantenimiento) }}</td>

                                                <td class="td-actions text-center ">
                                                    @can('maquinaria_mtq_edit')
                                                        <a href="#" data-bs-toggle="modal" data-bs-target="#editarItem"
                                                            onclick="cargaItem('{{ $maquina->id }}','{{ $maquina->identificador }}','{{ $maquina->nombre_maquinaria }}','{{ $maquina->id_marca }}','{{ $maquina->modelo }}','{{ $maquina->kilometraje }}','{{ false }}')">
                                                            <svg xmlns="http://www.w3.org/2000/svg " width="28"
                                                                height="28" fill="currentColor"
                                                                class="bi bi-pencil accionesIconos" viewBox="0 0 16 16">
                                                                <path
                                                                    d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                                                            </svg>
                                                        </a>
                                                    @endcan
                                                    @can('maquinaria_mtq_edit')
                                                        <a href="#" data-bs-toggle="modal"
                                                            data-bs-target="#editarMantenimiento"
                                                            onclick="cargaMantenimiento('{{ $maquina->id }}','{{ $maquina->mantenimiento }}')">
                                                            <i class="fas fa-wrench"
                                                                style="color: #8caf48;font-size: x-large;"></i>
                                                        </a>
                                                    @endcan

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
                        </div>
                        <div class="card-footer mr-auto">
                            {{ $maquinaria->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Nueva Equipos MTQ-->
    <div class="modal fade" id="editarItem" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bacTituloPrincipal">
                    <h1 class="modal-title fs-5" id="tituloModal">&nbsp Nueva Equipos MTQ</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row d-flex" action="{{ route('uso.store', 0) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('post')

                        <div class=" col-12 col-sm-6 mb-3 " style="display: none">
                            <label class="labelTitulo">Número Económico:<span>*</span></label></br>
                            <input type="text" class="inputCaja" name="identificador" id="identificador"
                                value="{{ old('identificador') }}" placeholder="ej: MT-00" readonly id="identificador">
                        </div>

                        <div class=" col-12 col-sm-6 mb-3 " style="display: none">
                            <label class="labelTitulo">Equipo:<span>*</span></label></br>
                            <input type="text" class="inputCaja" name="nombre" id="nombre"
                                value="{{ old('nombre') }}" readonly id="nombre">
                        </div>

                        <div class="col-12 col-sm-6 mb-3" style="display: none">
                            <label for="title" class="labelTitulo">Marca:</label>
                            <select name='marca' class="form-select" id="marca" placeholder="Marca Equipo..."
                                readonly>
                                <option value="">Seleccione</option>
                                @foreach ($marca as $item)
                                    <option value="{{ $item->id }}">
                                        {{ $item->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class=" col-12 col-sm-6 mb-3 " style="display: none">
                            <label class="labelTitulo">Modelo:<span>*</span></label></br>
                            <input type="text" class="inputCaja" name="modelo" id="modelo"
                                value="{{ old('modelo') }}" required id="modelo">
                        </div>

                        <div class=" col-12 col-sm-6 mb-3 ">
                            <label class="labelTitulo">Uso actual:</label></br>
                            <input type="text" class="inputCaja" name="km" value="" readonly
                                id="km">
                        </div>

                        @can('maquinaria_mtq_update_uso')
                            <div class=" col-12 col-sm-6  mb-3 ">
                                <label class="labelTitulo">Edicion de Uso:</label></br>
                                <input type="hidden" name="id[]" id="id" value="" id="idmaq">
                                <input type="text" class="inputCaja" placeholder="Ej. NS01234ABCD" name="valor[]"
                                    value="{{ old('numserie') }}" id="valor">
                            </div>
                        @endcan

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn botonGral">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Mantenimiento MTQ-->
    <div class="modal fade" id="editarMantenimiento" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bacTituloPrincipal">
                    <h1 class="modal-title fs-5" id="tituloModal">&nbsp Editar Mantenimiento MTQ</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row d-flex" action="{{ route('uso.mantenimiento') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="mId" id="mId" value="">

                        <div class=" col-12 col-sm-6 mb-3 ">
                            <label class="labelTitulo">Proximo Mantenimiento:</label></br>
                            <input type="text" class="inputCaja" name="Rmantenimiento" value="" readonly
                                id="Rmantenimiento">
                        </div>

                        <div class=" col-12 col-sm-6  mb-3 ">
                            <label class="labelTitulo">Edicion de Proximo Mantenimiento:</label></br>
                            <input type="number" class="inputCaja" id="mantenimiento" name="mantenimiento"
                                value="">
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


    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E="
        crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

    <script>
        $('#searchS').autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: "{{ route('search.equiposMTQ') }}",
                    dataType: 'json',
                    data: {
                        term: request.term,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        var limitedResults = data.slice(0, 16);
                        response(limitedResults);
                    }
                });
            },
            minChars: 1,
            width: 402,
            matchContains: "word",
            autoFill: true,
            minLength: 1,
            select: function(event, ui) {
                console.log('ui', ui.item);
                // Rellenar los campos con los datos de la persona seleccionada
                $('#MmaquinariaId').val(ui.item.id);
                // $('#descripcion').val(ui.item.value);
                $('#Mnombre').val(ui.item.nombre);
                $('#Mmarca').val(ui.item.marca);
                // $('#modelo').val(ui.item.modelo);
                $('#Mnumeconomico').val(ui.item.identificador);
                $('#Mplacas').val(ui.item.placas);
            }
        });
        document.addEventListener("DOMContentLoaded", function() {
            let titleSelect = document.getElementById("titleSelect");
            let colorBox = document.getElementById("colorBox");
            let color = document.getElementById("colorBoxHidden");
            let colorEdit = document.getElementById("colorBoxHiddenEdit");

            titleSelect.addEventListener("change", function() {
                let selectedColor = this.options[this.selectedIndex].getAttribute("data-color");
                colorBox.style.backgroundColor = selectedColor;

                console.log('selectedColor', selectedColor)
                color.value = selectedColor;
            });

            let titleSelectEdit = document.getElementById("titleSelectEdit");
            let colorBoxEdit = document.getElementById("colorBoxEdit");

            titleSelectEdit.addEventListener("change", function() {
                let selectedColor = this.options[this.selectedIndex].getAttribute("data-color");
                colorBoxEdit.style.backgroundColor = selectedColor;
                colorEdit.value = selectedColor;
            });
        });
    </script>

    <script>
        function cargaItem(id, identificador, nombre, marca, modelo, km, modalTipo) {
            console.log(id);

            const txtId = document.getElementById('id');
            txtId.value = id;

            const contenedorBotonGuardar = document.getElementById('contenedorBotonGuardar');
            const contenedorBotonSubirImagen = document.getElementById('contenedorBotonSubirImagen');


            //if (modalTipo) {
            //    contenedorBotonGuardar.style.display = 'none';
            //} else {
            //    contenedorBotonGuardar.style.display = 'block';
            // }

            const tituloModal = document.getElementById('tituloModal');
            if (modalTipo) {
                tituloModal.textContent = 'Ver';
            } else {
                tituloModal.textContent = 'Nuevo Uso Al Equipo';
            }

            const txtIdentificador = document.getElementById('identificador');
            txtIdentificador.value = identificador;
            //txtIdentificador.readOnly = modalTipo;

            const txtNombre = document.getElementById('nombre');
            txtNombre.value = nombre;
            //txtNombre.readOnly = modalTipo;

            const txtMarca = document.getElementById('marca');
            txtMarca.value = marca;
            //txtMarca.readOnly = modalTipo;

            const txtModelo = document.getElementById('modelo');
            txtModelo.value = modelo;
            //txtModelo.readOnly = modalTipo;

            const txtkm = document.getElementById('km');
            txtkm.value = km;
            //txtkm.readOnly = modalTipo;

            const txtValor = document.getElementById('valor');
            txtValor.value = km;
            txtValor.readOnly = modalTipo;

            // Obtener todos los campos del formulario
            const campos = document.querySelectorAll('input[type="text"], textarea');

            // Aplicar color gris a los campos con readonly
            campos.forEach((campo) => {
                if (modalTipo) {
                    //campo.readOnly = true;
                    campo.style.color = 'grey';
                } else {
                    //ampo.readOnly = false;
                    campo.style.color = 'initial';
                }
            });
        }
    </script>
    <script>
        function cargaMantenimiento(id, mantenimiento) {

            const txtId = document.getElementById('mId');
            txtId.value = id;

            const txtMantenimiento = document.getElementById('Rmantenimiento');
            txtMantenimiento.value = mantenimiento;

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
                    url: "{{ route('search.equipos') }}",

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
                $('#maquinariaId').val(ui.item.id);
                $('#descripcion').val(ui.item.value);
                $('#titulo').val('Mantenimiento ' + ui.item.nombre);
                // $('#nombre').val(ui.item.nombre);
                $('#marca').val(ui.item.marca);
                // $('#modelo').val(ui.item.modelo);
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
