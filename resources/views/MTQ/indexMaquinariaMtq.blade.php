@extends('layouts.main', ['activePage' => 'mtq', 'titlePage' => __('Mtqs')])
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header bacTituloPrincipal">
                                    <h4 class="card-title"> Maquinaria Mtq's</h4>
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
                                        <a href="{{ url('dashMtq') }}">
                                            <button class="btn regresar">
                                                <span class="material-icons">
                                                    reply
                                                </span>
                                                Regresar
                                            </button>
                                        </a>    
                                    </div>
                                    <div class="col-8 text-end">
                                    @can('maquinaria_create')
                                        <button  data-bs-toggle="modal" data-bs-target="#nuevoItem" 
                                        type="button" class="btn botonGral">Añadir Maquinaria MTQ</button>
                                    @endcan
                                    </div>
                                    <div class="d-flex p-3 divBorder"></div>
                                    </div>
                                    
                                    <div class="table-responsive">
                                    <table class="table">
                                        <thead class="labelTitulo">
                                            <th class="labelTitulo text-center">Número Económico</th>
                                            <th class="labelTitulo text-center">Equipo</th>
                                            <th class="labelTitulo text-center">Marca</th>
                                            <th class="labelTitulo text-center">Modelo</th>
                                            <th class="labelTitulo text-center">Sub Marca</th>
                                            <th class="labelTitulo text-center">Año</th>
                                            <th class="labelTitulo text-center">Color</th>
                                            <th class="labelTitulo text-center">Placas</th>
                                            <th class="labelTitulo text-center">VIN</th>
                                            <th class="labelTitulo text-center">Número de Motor</th>
                                            <th class="labelTitulo text-center" style="width:120px">Acciones</th>
                                        </thead>
                                        <tbody>
                                            @forelse ($maquinaria as $maquina)
                                                <tr>
                                                    <td class="text-center">{{ $maquina->identificador }}</td>
                                                    <td class="text-center">{{ $maquina->nombre }}</td>
                                                    <td class="text-center">{{ $maquina->marca }}</td>
                                                    <td class="text-center">{{ $maquina->modelo }}</td>
                                                    <td class="text-center">{{ $maquina->submarca }}</td>
                                                    <td class="text-center">{{ $maquina->ano }}</td>
                                                    <td class="text-center">{{ $maquina->color }}</td>
                                                    <td class="text-center">{{ $maquina->placas }}</td>
                                                    <td class="text-center">{{ $maquina->numserie }}</td>
                                                    <td class="text-center">{{ $maquina->nummotor }}</td>

                                                    <td class="td-actions text-center">
                                                        {{-- @can('user_show') --}}
                                                        {{-- <a href="{{ route('maquinaria.show', $maquina->id) }}"  class="">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-card-text accionesIconos" viewBox="0 0 16 16">
                                                                <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                                                                <path d="M3 5.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 8zm0 2.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5z"/>
                                                            </svg>
                                                        </a> --}}
                                                        {{-- @endcan --}}
                                                        @can('maquinaria_edit')
                                                            <a href="#" data-bs-toggle="modal" data-bs-target="#editarItem"
                                                                onclick="cargaItem('{{ $maquina->nombre }}','{{ $maquina->marca }}','{{ $maquina->modelo }}','{{ $maquina->submarca }}','{{ $maquina->ano }}','{{ $maquina->color }}','{{ $maquina->placas }}','{{ $maquina->numserie }}','{{ $maquina->identificador }}','{{ $maquina->nummotor }}',)">
                                                                <svg xmlns="http://www.w3.org/2000/svg " width="28"
                                                                    height="28" fill="currentColor"
                                                                    class="bi bi-pencil accionesIconos" viewBox="0 0 16 16">
                                                                    <path
                                                                        d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                                                                </svg>
                                                            </a>
                                                        @endcan
                                                        {{-- @can('user_destroy') --}}
                                                        {{-- <form action="{{ route('maquinaria.delete', $maquina->id) }}"
                                                            method="POST" style="display: inline-block;"
                                                            onsubmit="return confirm('Seguro?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btnSinFondo" type="submit" rel="tooltip">
                                                                <svg xmlns="http://www.w3.org/2000/svg"  width="28" height="28"  fill="currentColor"  class="bi bi-x-circle"  viewBox="0 0 16 16">
                                                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                                                                </svg>
                                                            </button>
                                                        </form> --}}
                                                        {{-- @endcan --}}
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
        </div>
    </div>

    <!-- Modal Nueva Tarea-->
    <div class="modal fade" id="nuevoItem" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bacTituloPrincipal">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">&nbsp Nueva Maquinaria Mtq</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row d-flex" action="{{ route('puesto.store') }}" method="post">
                        @csrf
                        {{-- <input type="hidden" name="userId" id="userId" value="{{ $usuario->id }}"> --}}

                    <div class="row d-flex justify-content-center">
                        <div class="col-12 col-sm-6 align-items-center">
                            <div class="text-center mx-auto border vistaFoto mb-4">
                                <i><img class="imgVista img-fluid mb-5" src="{{ asset('/img/general/default.jpg') }}"></i>
                                <span class="mi-archivo">
                                    <input class="mb-4 ver" type="file" name="foto" id="mi-archivo2" accept="image/*">
                                </span>
                                <label for="mi-archivo2">
                                    <span>sube Imagen</span>
                                </label>
                            </div>
                        </div>
                    </div>                        

                    <div class=" col-12 col-sm-6 mb-3 ">
                        <label class="labelTitulo">Numero Económico*:</label></br>
                        <input type="text" class="inputCaja"
                            id="identificador" name="identificador"
                            value="{{ old('identificador') }}"
                            placeholder="ej: MT-00">
                    </div>

                    <div class=" col-12 col-sm-6 mb-3 ">
                        <label class="labelTitulo">Equipo:<span>*</span></label></br>
                        <input type="text" class="inputCaja" id="nombre" name="nombre"
                            value="{{ old('nombre') }}" required placeholder="Especifique...">
                    </div>
                    <div class=" col-12 col-sm-6 mb-3 ">
                        <label class="labelTitulo">Marca:</label></br>
                        <input type="text" class="inputCaja" id="marca"
                            placeholder="Especifique..." name="marca"
                            value="{{ old('marca') }}">
                    </div>


                    <div class=" col-12 col-sm-6 mb-3 ">
                        <label class="labelTitulo">Modelo:</label></br>
                        <input type="text" class="inputCaja" id="modelo"
                            placeholder="Especifique..." name="modelo"
                            value="{{ old('modelo') }}">
                    </div>

                    <div class=" col-12 col-sm-6 mb-3 ">
                        <label class="labelTitulo">Sub Marca:</label></br>
                        <input type="text" class="inputCaja" id="submarca"
                            placeholder="Especifique..." name="submarca"
                            value="{{ old('submarca') }}">
                    </div>

                    <div class="col-12 col-sm-6 mb-3 ">
                        <label class="labelTitulo">Año:</label></br>
                        <input type="number" class="inputCaja" id="ano"
                            maxlength="4" placeholder="Ej. 2000" name="ano"
                            value="{{ old('ano') }}">
                    </div>

                    <div class=" col-12 col-sm-6 mb-3 ">
                        <label class="labelTitulo">Color:</label></br>
                        <input type="text" class="inputCaja" id="color"
                            placeholder="Ej. Amarillo" name="color"
                            value="{{ old('color') }}">
                    </div>

                    <div class=" col-12 col-sm-6 mb-3 ">
                        <label class="labelTitulo">Placas:</label></br>
                        <input type="text" class="inputCaja" id="placas"
                            placeholder="Ej. JAL-0000" name="placas"
                            value="{{ old('placas') }}">
                    </div>

                    <div class=" col-12 col-sm-6  mb-3 ">
                        <label class="labelTitulo">Número Serie -VIN:</label></br>
                        <input type="text" class="inputCaja" id="numserie"
                            placeholder="Ej. NS01234ABCD" name="numserie"
                            value="{{ old('numserie') }}">
                    </div>

                    <div class=" col-12 col-sm-6  mb-3 ">
                        <label class="labelTitulo">Número Motor:</label></br>
                        <input type="text" class="inputCaja" id="nummotor"
                            placeholder="Ej. NUM0123ABCD" name="nummotor"
                            value="{{ old('nummotor') }}">
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

    <!-- Modal Editar  Tarea-->
    <div class="modal fade" id="editarItem" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bacTituloPrincipal">

                    <h1 class="modal-title fs-5" id="exampleModalLabel">&nbsp Editar Maquinaria Mtq</label>
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row d-flex" action="{{ route('maquinaria.update', 0) }}" method="post">
                        @csrf
                        @method('put')
                        <div class="row d-flex justify-content-center">
                            <div class="col-12 col-sm-6 align-items-center">
                                <div class="text-center mx-auto border vistaFoto mb-4">
                                    <i><img class="imgVista img-fluid mb-5" src="{{ asset('/img/general/default.jpg') }}"></i>
                                    <span class="mi-archivo">
                                        <input class="mb-4 ver" type="file" name="foto" id="mi-archivo2" accept="image/*">
                                    </span>
                                    <label for="mi-archivo2">
                                        <span>sube Imagen</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="puestoId" id="puestoId" value="">
                        <div class=" col-12 col-sm-6 mb-3 ">
                            <label class="labelTitulo">Numero Económico:</label></br>
                            <input type="text" class="inputCaja"
                                id="identificador" name="identificador"
                                value=""
                                placeholder="ej: MT-00">
                        </div>

                        <div class=" col-12 col-sm-6  mb-3 ">
                            <label class="labelTitulo">Equipo:</label></br>
                            <input type="text" class="inputCaja" id="nombre"
                                placeholder="Especifique..." required name="nombre"
                                value="">
                        </div>

                        <div class=" col-12 col-sm-6  mb-3 ">
                            <label class="labelTitulo">Marca:</label></br>
                            <input type="text" class="inputCaja" id="marca"
                                placeholder="Especifique..." name="marca"
                                value="">
                        </div>


                        <div class=" col-12 col-sm-6 mb-3 ">
                            <label class="labelTitulo">Modelo:</label></br>
                            <input type="text" class="inputCaja" id="modelo"
                                placeholder="Especifique..." name="modelo"
                                value="">
                        </div>

                        <div class=" col-12 col-sm-6 mb-3 ">
                            <label class="labelTitulo">Sub Marca:</label></br>
                            <input type="text" class="inputCaja" id="submarca"
                                placeholder="Especifique..." name="submarca"
                                value="">
                        </div>

                        <div class=" col-12 col-sm-6 mb-3 ">
                            <label class="labelTitulo">Año:</label></br>
                            <input type="text" class="inputCaja" id="ano"
                                maxlength="4" placeholder="Ej. 2000" name="ano"
                                value="">
                        </div>

                        <div class=" col-12 col-sm-6 mb-3 ">
                            <label class="labelTitulo">Color:</label></br>
                            <input type="text" class="inputCaja" id="color"
                                placeholder="Ej. Amarillo" name="color"
                                value="">
                        </div>

                        <div class=" col-12 col-sm-6 mb-3 ">
                            <label class="labelTitulo">Placas:</label></br>
                            <input type="text" class="inputCaja" id="placas"
                                placeholder="Ej. JAL-0000" name="placas"
                                value="">
                        </div>

                        <div class="col-12 col-sm-6 mb-3 ">
                            <label class="labelTitulo">Número Serie -VIN:</label></br>
                            <input type="text" class="inputCaja" id="numserie"
                                placeholder="Ej. NS01234ABCD" name="numserie"
                                value="">
                        </div>

                        <div class=" col-12 col-sm-6  mb-3 ">
                            <label class="labelTitulo">Número Motor:</label></br>
                            <input type="text" class="inputCaja" id="nummotor"
                                placeholder="Ej. NUM0123ABCD" name="nummotor"
                                value="">
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn botonGral" id="btnTareaGuardar">Guardar cambios</button>
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
