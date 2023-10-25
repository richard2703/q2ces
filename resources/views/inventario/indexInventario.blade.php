@extends('layouts.main', ['activePage' => 'inventario', 'titlePage' => __('Inventario')])
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
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
                                        <div class="col-6 text-right">
                                            <a href="{{ route('inventario.dash') }}">
                                                <button class="btn regresar">
                                                    <span class="material-icons">
                                                        reply
                                                    </span>
                                                    Regresar
                                                </button>
                                            </a>
                                        </div>

                                        <div class="col-6 pb-3 text-end">
                                            @can('inventario_create')
                                                <a href="{{ route('inventario.create', $tipo) }}">
                                                    <button type="button" class="btn botonGral text-capitalize">Añadir al
                                                        Inventario</button>
                                                </a>
                                            @endcan
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead class="labelTitulo">
                                                <th class="labelTitulo text-center">Imagen</th>
                                                <th class="labelTitulo text-center">No. Parte</th>
                                                <th class="labelTitulo text-center">Nombre</th>
                                                <th class="labelTitulo text-center" style="width: 150px;">Existencias</th>
                                                <th class="labelTitulo text-center">Min.</th>
                                                <th class="labelTitulo text-center">Máx.</th>
                                                <th class="labelTitulo text-center" style="width: 120px;">Acciones</th>
                                            </thead>
                                            <tbody class="text-capitalize">
                                                @forelse ($inventarios as $inventario)
                                                    <tr>
                                                        <td class="text-center"><img class="" style="width: 100px;"
                                                                src="{{ $inventario->imagen == '' ? '/img/general/defaultinventario.jpg' : '/storage/inventario/' . $inventario->tipo . '/' . $inventario->imagen }}">
                                                        </td>
                                                        <td class="text-center align-middle">{{ $inventario->numparte }}
                                                        </td>
                                                        <td class="text-center align-middle">{{ $inventario->nombre }}</td>
                                                        <td class="text-center align-middle">{{ $inventario->cantidad }}
                                                        </td>
                                                        <td class="text-center align-middle">{{ $inventario->reorden }}</td>
                                                        <td class="text-center align-middle">{{ $inventario->maximo }}</td>
                                                        <td class="td-actions text-center align-middle">
                                                            @can('inventario_restock')
                                                                <a href="#" data-bs-toggle="modal"
                                                                    data-bs-target="#modal-entrada"
                                                                    onclick="cargar('{{ $inventario->nombre }}','{{ $inventario->imagen }}','{{ $inventario->tipo }}','{{ $inventario->id }}',1)">
                                                                    <i class="fas fa-sign-in-alt iconoTablas"
                                                                        title="Entradas"></i>
                                                                </a>
                                                            @endcan
                                                            @can('inventario_edit')
                                                                <a href="{{ route('inventario.show', $inventario->id) }}"
                                                                    <button type="button" title="Detalles">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="28"
                                                                        height="28" fill="currentColor"
                                                                        class="bi bi-card-text accionesIconos"
                                                                        viewBox="0 0 16 16">
                                                                        <path
                                                                            d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z" />
                                                                        <path
                                                                            d="M3 5.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 8zm0 2.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5z" />
                                                                    </svg>
                                                                    </button>
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
                                    {{ $inventarios->links() }}
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
                        <form action="{{ route('inventario.movimiento', $inventario->id) }}" method="post">
                            @csrf
                            {{--  @method('put')  --}}
                            <div class="modal-header bacTituloPrincipal">
                                <h2 class="titulos text-capitalize"><span id="tituloModal">Editar</span> </h2>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="row  card-body">
                                <div class="row card-body" style="text-align: center;">
                                    {{--  <input type="hidden" name="productoid" id="productoid" value="">  --}}
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
                                        <textarea class="form-control-textarea border-green" name="comentario" rows="3" placeholder="Agregar Comentario..."></textarea>
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
@endsection
