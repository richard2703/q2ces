@extends('layouts.main', ['activePage' => 'inventario', 'titlePage' => __('Inventario')])
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                {{--  <div id="searchData" data-tipo="{{ $search }}">{{$search}}</div>  --}}
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header bacTituloPrincipal">
                                    <h4 class="card-title text-capitalize">Inventario de {{ $tipo }}</h4>
                                    {{-- <p class="card-category">Usuarios registrados</p> --}}
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
                                        <div class="col-4 pb-3 text-right">
                                            <a href="{{ route('inventario.dash') }}">
                                                <button class="btn regresar">
                                                    <span class="material-icons">
                                                        reply
                                                    </span>
                                                    Regresar
                                                </button>
                                            </a>
                                        </div>

                                        <div class="col-4 text-center">
                                            <button type="button" class="btn botonGral text-capitalize" id="toggleButton" data-bs-toggle="collapse" data-bs-target="#searchFilters">
                                                <i class="fas fa-list"></i> Filtros <i class="fas fa-arrow-down" style="margin-left: 10px"></i>
                                            </button>
                                        </div>

                                        <div class="col-4 text-end">
                                            @can('inventario_create')
                                                <a href="{{ route('inventario.create', $tipo) }}">
                                                    <button type="button" class="btn botonGral text-capitalize">Añadir al
                                                        Inventario</button>
                                                </a>
                                            @endcan
                                        </div>
                                    </div>
                                    <div class="collapse" id="searchFilters">
                                        <h2 class="tituloEncabezado text-center mt-3">Buscador y Filtros Aplicados:</h2>
                                        <form action="{{ route('inventario.index', $tipo) }}" method="GET" id="filterForm">
                                            <div class="row">
                                                <div class="col-12 mb-3">
                                                    <div class="input-group" style="border: none;
                                                    box-shadow: none;">
                                                        <div class="input-group-prepend">
                                                            <button type="submit" class="btn" style="background: #727176; color: white; border-top-right-radius: 0;
                                                            border-bottom-right-radius: 0;"><i class="fas fa-search"></i></button>
                                                        </div>
                                                        <input type="text" class="form-control border-right-0" name="search" value="{{$search}}" placeholder="Buscar por nombre, marca, modelo o numero de parte...">
                                                        <div class="input-group-append">
                                                            <button class="btn btn-danger clear-input" style="border-top-left-radius: 0;
                                                            border-bottom-left-radius: 0;" type="submit">
                                                                <i class="fas fa-times"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row divBorder pb-4">
                                                <div class="col-12 col-sm-6 col-lg-6 text-center">
                                                    <div class="input-group">
                                                        <label class="labelTitulo p-2">Estatus: </label>
                                                        <select name="estatus" id="estatus" style="background: #727176; color: white; font-weight: bold;" class="form-control">
                                                            <option value="5" style="font-weight: bold;" {{ request('estatus') == '5' ? 'selected' : '' }}>En Stock</option>
                                                            <option value="6" style="font-weight: bold;" {{ request('estatus') == '6' ? 'selected' : '' }}>Sin Stock</option>
                                                            <option value="1" style="font-weight: bold;" {{ request('estatus') == '1' ? 'selected' : '' }}>Activos</option>
                                                            <option value="2" style="font-weight: bold;" {{ request('estatus') == '2' ? 'selected' : '' }}>Baja</option>
                                                            <option value="3" style="font-weight: bold;" {{ request('estatus') == '3' ? 'selected' : '' }}>Inactivos</option>
                                                            <option value="4" style="font-weight: bold;" {{ request('estatus') == '4' ? 'selected' : '' }}>Eliminados</option>
                                                            <option value="0" style="font-weight: bold;" {{ request('estatus') == '0' ? 'selected' : '' }}>Todos</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6 col-lg-6 text-center">
                                                    <div class="input-group">
                                                        <label class="labelTitulo p-2">Marcas: </label>
                                                        <select name="marca" id="marca" style="background: #727176; color: white; font-weight: bold;" class="form-control">
                                                            <option value="" style="font-weight: bold;">Sin Filtro</option>
                                                            @foreach($marcas as $id => $nombre)
                                                                <option value="{{ $id }}" style="font-weight: bold;" {{ request('marca') == $id ? 'selected' : '' }}>{{ $nombre }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-12 text-center mt-5">
                                                    <button class="btn botonGral text-capitalize" type="submit"> <i class="fas fa-solid fa-upload" style="margin-right: 5px"></i> Aplicar Filtros
                                                    </button>
                                                </div>
                                            </div>
                                            
                                            
                                        </form>
                                    </div>
                                    
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead class="labelTitulo">
                                                <th class="labelTitulo text-center">Imagen</th>
                                                <th class="labelTitulo text-center">No. Parte</th>
                                                <th class="labelTitulo text-center">Nombre</th>
                                                <th class="labelTitulo text-center">Marca</th>
                                                <th class="labelTitulo text-center">Modelo</th>
                                                <th class="labelTitulo text-center" style="width: 150px;">Existencias</th>
                                                <th class="labelTitulo text-center" style="width: 65px;">Min.</th>
                                                <th class="labelTitulo text-center" style="width: 65px;">Máx.</th>
                                                <th class="labelTitulo text-center">Estatus</th>
                                                <th class="labelTitulo text-center" style="width: 120px;">Acciones</th>
                                            </thead>
                                            <tbody class="text-capitalize">
                                                @if (is_null($inventarios) == false)
                                                    @forelse ($inventarios as $inventario)
                                                        <tr>
                                                            <td class="text-center"><img class=""
                                                                    style="width: 100px;"
                                                                    src="{{ $inventario->imagen == '' ? '/img/general/defaultinventario.jpg' : '/storage/inventario/' . $inventario->tipo . '/' . $inventario->imagen }}">
                                                            </td>
                                                            <td class="text-center align-middle">{{ $inventario->numparte }}
                                                            </td>
                                                            <td class="text-center align-middle">{{ $inventario->nombre }}
                                                            </td>
                                                            <td class="text-center align-middle">{{ $inventario->nombre_marca }}
                                                            </td>
                                                            <td class="text-center align-middle">{{ $inventario->modelo }}
                                                            </td>
                                                            <td class="text-center align-middle">{{ $inventario->cantidad }}
                                                            </td>
                                                            <td class="text-center align-middle">{{ $inventario->reorden }}
                                                            </td>
                                                            <td class="text-center align-middle">{{ $inventario->maximo }}
                                                            </td>
                                                            <td class="text-center align-middle">{{ $inventario->nombre_estatus }}</td>
                                                            <td class="td-actions text-center align-middle">
                                                                @can('inventario_restock')
                                                                    <a href="#" data-bs-toggle="modal"
                                                                        data-bs-target="#modal-entrada"
                                                                        onclick="cargar('{{ $inventario->nombre }}','{{ $inventario->imagen }}','{{ $inventario->tipo }}','{{ $inventario->id }}',1)">
                                                                        <i class="fas fa-sign-in-alt iconoTablas"
                                                                            title="Entradas"></i>
                                                                    </a>
                                                                @endcan
                                                                @can('inventario_show')
                                                                <a href="{{ route('inventario.show', $inventario->id) }}">
                                                                        
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="28"
                                                                            height="28" fill="currentColor"
                                                                            class="bi bi-card-text accionesIconos"
                                                                            viewBox="0 0 16 16">
                                                                            <path
                                                                                d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z" />
                                                                            <path
                                                                                d="M3 5.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 8zm0 2.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5z" />
                                                                        </svg>
                                                                        
                                                                    </a>
                                                                @endcan
                                                                @can('inventario_edit')
                                                                <a href="{{ route('inventario.edit', $inventario->id) }}">
                                                                        <svg xmlns="http://www.w3.org/2000/svg " width="28"
                                                                            height="28" fill="currentColor"
                                                                            class="bi bi-pencil accionesIconos" viewBox="0 0 16 16">
                                                                            <path
                                                                                d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                                                                        </svg>
                                                                        
                                                                    </a>
                                                                @endcan

                                                                @can('inventario_restock')
                                                                    <a href="#" data-bs-toggle="modal"
                                                                        data-bs-target="#modal-entrada"
                                                                        onclick="cargar('{{ $inventario->nombre }}','{{ $inventario->imagen }}','{{ $inventario->tipo }}','{{ $inventario->id }}',2)">
                                                                        <i class="fas fa-sign-out-alt iconoTablas"
                                                                            title="Salidas"></i>
                                                                    </a>
                                                                @endcan
                                                                @can('inventario_destroy')
                                                                <form action="{{ route('inventario.destroy', $inventario->id) }}"
                                                                    method="POST" style="display: inline-block;"
                                                                    onsubmit="return confirm('¿Estás seguro que deseas eliminar este registro?')">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button class="btnSinFondo" type="submit"  rel="tooltip">
                                                                        <svg xmlns="http://www.w3.org/2000/svg"  width="28" height="28"  fill="currentColor"  class="bi bi-x-circle"  viewBox="0 0 16 16">
                                                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                                            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                                                                        </svg>
                                                                    </button>
                                                                </form>
                                                                @endcan
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="2">Sin registros.</td>
                                                        </tr>
                                                    @endforelse
                                                @else
                                                    <tr>
                                                        <td colspan="2">Sin registros.</td>
                                                    </tr>
                                                @endif

                                            </tbody>
                                        </table>
                                        <div id="results">
                                            <!-- Aquí se mostrarán los resultados de la búsqueda -->
                                        </div>                                        
                                    </div>
                                </div>
                                <div class="card-footer mr-auto">
                                    @if (is_null($inventarios) == false)
                                    {{ $inventarios->links() }}
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- //Modales --}}
    <div class="modal fade" id="modal-entrada" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-entrada"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="col-12">
                    <div class="card ">
                        <form action="{{ route('inventario.movimiento', 0) }}" method="post">
                            @csrf
                            {{--  @method('put')  --}}
                            <div class="modal-header bacTituloPrincipal">
                                <h2 class="titulos text-capitalize"><span id="tituloModal">Editar</span> </h2>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="row  card-body">
                                <div class="row card-body" style="text-align: center;">
                                    {{--  <input type="hidden" name="productoid" id="productoid" value="">  --}}
                                    <input type="hidden" name="inventarioId" id="inventarioId" value="">
                                    <input type="hidden" name="usuarioId" id="usuarioId" value="{{ auth()->user()->id }}">
                                    <input type="hidden" name="movimiento" id="movimientoTipo">

                                    <div class="col-12 ">
                                        <img style="width: 100px;" id="imagenM">
                                    </div>
                                    <div class="col-12 border-bottom mb-3 labelTitulo">
                                        <h3 class="titulos hSub h3 " id="nombreM"> </h3>
                                    </div>
                                    <div class="col-12" id="cantidad">
                                        <label class="labelTitulo" for="">Cantidad:</label></br>
                                        <input class="inputCaja" type="number" step="0.01" min="0.01"
                                            name="cantidad" value="" required></br>
                                    </div>
                                    <div class="col-12 col-lg-6" id="costo">
                                        <label class="labelTitulo" for="">Costo Total:</label></br>
                                        <input class="inputCaja" type="number" step="0.01" min="0.01"
                                            name="costo" value="" id="costoInput"></br>
                                    </div>

                                    <div class="col-12" id="comentario">
                                        <label for="comentario" class="labelTitulo mt-3">Comentario:</label></br>
                                        <textarea class="form-control-textarea border-green" name="comentario" rows="3"
                                            placeholder="Agregar Comentario..."></textarea>
                                        <label class="labelTitulo" for=""></label> </br>
                                    </div>

                                </div>
                            </div>
                            <div class="col-12  mb-3 d-flex  justify-content-center align-self-end">
                                <button type="submit" class="btn botonGral ">Guardar</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/alertas.js') }}"></script>
    <script src="https://cdn.lordicon.com/qjzruarw.js"></script>

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
    <script>
        function cargar(nombre, img, tipo, id, mov) {
            const imagen = document.getElementById('imagenM');
            if (img !== '') {
                imagen.src = '/storage/inventario/' + tipo + '/' + img;
            } else {
                imagen.src = '/img/general/defaultinventario.jpg';
            }

            const p = document.getElementById('nombreM');
            p.innerText = nombre;

            const movimiento = document.getElementById('movimientoTipo');
            movimiento.value = mov;

            const inventarioId = document.getElementById('inventarioId');
            inventarioId.value = id;

            const costoTotalDiv = document.getElementById('costo');
            const costoTotalInput = document.getElementById('costoInput');
            const comentarioTextarea = document.getElementById('comentario');
            const cantidadDiv = document.getElementById('cantidad');

            const tituloModal = document.getElementById('tituloModal');

            if (mov == 1) {
                costoTotalInput.setAttribute('required', 'required');
                tituloModal.textContent = 'Entrada';
                costoTotalDiv.style.display = 'block';
                comentarioTextarea.style.display = 'none';
                cantidadDiv.classList.remove('col-12');
                cantidadDiv.classList.add('col-6');

            } else {
                costoTotalInput.removeAttribute('required');
                tituloModal.textContent = 'Salida';
                costoTotalDiv.style.display = 'none';
                comentarioTextarea.style.display = 'block';
                cantidadDiv.classList.remove('col-6');
                cantidadDiv.classList.add('col-12');

            }
        }
    </script>
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
        var slug = '{{ Session::get('message') }}';
        if (slug == 1) {
            Guardado();

        }
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const input = document.querySelector('input[name="search"]');
            const clearButton = document.querySelector('.clear-input');
        
            // Limpiar el texto del input al hacer clic en el botón de limpiar
            clearButton.addEventListener('click', function() {
                input.value = '';
            });
        });
        </script>

    <script>
       $(document).ready(function() {
            //var tipo = $('#tipoData').data('tipo'); // Obtener el valor de la variable PHP $tipo

            /*var typingTimer;
            var doneTypingInterval = 1000; // tiempo de espera después de terminar de escribir
    
            $('#search').on('keyup', function() {
                clearTimeout(typingTimer);
                typingTimer = setTimeout(doneTyping, doneTypingInterval);
            });
    
            function doneTyping() {
                // Realizar la solicitud AJAX con el valor del campo de búsqueda
                var searchQuery = $('#search').val();
    
                $.ajax({
                    type: 'GET',
                    url: '/inventario/' + tipo, // Utiliza el valor de $tipo
                    data: {
                        search: searchQuery
                    },
                    success: function(response) {
                        // Actualizar la parte de la página que muestra los resultados
                        $('#results').html(response);
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            }*/
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggleButton = document.getElementById('toggleButton');
            const searchFilters = document.getElementById('searchFilters');
    
            // Cambiar icono cuando el colapsable se muestra o se oculta
            searchFilters.addEventListener('shown.bs.collapse', function() {
                toggleButton.innerHTML = `<i class="fas fa-list"></i> Filtros <i class="fas fa-arrow-up" style="margin-left: 10px"></i>`;
            });
    
            searchFilters.addEventListener('hidden.bs.collapse', function() {
                toggleButton.innerHTML = `<i class="fas fa-list"></i> Filtros <i class="fas fa-arrow-down" style="margin-left: 10px"></i>`;
            });
        });
    </script>

    <style>
        input{
            border: #5C7C26 1px solid !important;
            border-radius: .375rem;
            font-size: 1em !important;
        }
        
        input:active,
        input:focus{
            box-shadow: 2px 2px 10px 2px #F7C90D !important;
        }
    </style>
@endsection
