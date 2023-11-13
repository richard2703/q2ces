@extends('layouts.main', ['activePage' => 'maquinaria', 'titlePage' => __('Lista de Distribución de CheckLists de Maquinaría')])
@section('content')
    <div class="content">
        <?php
        $objValida = new Validaciones();
        ?>
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
            <div class="row justify-content-center">
                <div class="col-12 align-self-center">
                    <div class="card">
                        <div class="card-header bacTituloPrincipal">
                            <h4 class="card-title">CheckList Asignados a Maquinaría</h4>
                            {{-- <p class="card-category">Usuarios Registrados</p> --}}
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
                                <div class="d-flex p-3 divBorder">


                                    <div class="col-6 text-left">

                                        <form action="{{ route('maquinaria.checkLists') }}" method="GET" id="filterForm">
                                            <div class="input-group">
                                                <label class="labelTitulo p-2">Maquinaría: </label>
                                                <select name="estatus" id="estatus"
                                                    style="background: #727176; color: white; font-weight: bold;"
                                                    class="form-control"
                                                    onchange="document.getElementById('filterForm').submit();">
                                                    <option selected value="0">Todos</option>
                                                    @foreach ($vctMaquinaria as $item)
                                                        <option value="{{ $item->id }}" style="font-weight: bold;"
                                                            {{ request('estatus') == $item->id ? 'selected' : '' }}>
                                                            {{ $item->maquinaria }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-6 text-end">
                                        <a href="{{ route('maquinaria.index') }}">
                                            <button class="btn regresar">
                                                <span class="material-icons">
                                                    reply
                                                </span>
                                                Regresar
                                            </button>
                                        </a>
                                        @can('maquinaria_create')
                                            <button class="btn botonGral float-end" data-bs-toggle="modal"
                                                data-bs-target="#nuevoItem">
                                                Añadir Maquinaría
                                            </button>
                                        @endcan
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead class="labelTitulo">
                                            <th class="labelTitulo text-center">Maquinaría</th>
                                            <th class="labelTitulo text-center">CheckList</th>
                                            <th class="labelTitulo text-center">Frecuencia</th>
                                            <th class="labelTitulo text-center" style="width:40px">Acciones</th>
                                        </thead>
                                        <tbody>
                                            @forelse ($vctRecords as $item)
                                                <tr>
                                                    <td class="text-center">
                                                        <a href="{{ route('maquinaria.vista', $item->maquinariaId) }}"
                                                            title="Editar la información de la maquinaría."
                                                            style="color: blue">{{ $item->maquinaria }}</a>
                                                    </td>
                                                    <td class="text-center"
                                                        style="{{ $item->bitacoraId <= 0 ? 'font-weight: bold; color: red;' : '' }}">
                                                        {{ $item->bitacora != '' ? $item->bitacora : 'Sin Asignar' }}</td>
                                                    <td class="text-center"
                                                        style="{{ $item->frecuenciaId <= 0 ? 'font-weight: bold; color: red;' : '' }}">
                                                        {{ $item->frecuenciaId != '' ? $item->frecuencia : 'Sin Asignar' }}
                                                    </td>

                                                    <td>
                                                        @if ($item->bitacoraEquiposId > 0)
                                                            @can('maquinaria_destroy')
                                                                <form
                                                                    action="{{ route('maquinaria.destroyCheckList', [$item->bitacoraEquiposId]) }}"
                                                                    method="POST" style="display: inline-block;"
                                                                    onsubmit="return confirm('¿Seguro?')">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button class="btnSinFondo" type="submit" rel="tooltip"
                                                                        title="Eliminar la referencia de este CheckList con el Equipo">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="28"
                                                                            height="28" fill="currentColor"
                                                                            class="bi bi-x-circle" viewBox="0 0 16 16">
                                                                            <path
                                                                                d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                                            <path
                                                                                d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                                                                        </svg>
                                                                    </button>
                                                                </form>
                                                            @endcan
                                                        @endif
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="2">Sin Registros.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card-footer d-flex justify-content-center">
                                {{ $vctRecords->links() }}
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
                            <h1 class="modal-title fs-5" id="exampleModalLabel">&nbsp Nuevo Puesto</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form class="row d-flex" action="{{ route('maquinaria.storeCheckList') }}" method="post">
                                @csrf
                                {{-- <input type="hidden" name="userId" id="userId" value="{{ $usuario->id }}"> --}}


                                <div class=" col-12 col-sm-6 mb-3 ">
                                    <label class="labelTitulo">Maquinaría:
                                        <span>*</span></label></br>
                                    <select id="maquinariaId" name="maquinariaId" class="form-select" required
                                        aria-label="Default select example">
                                        <option value="">Seleccione</option>
                                        @foreach ($vctMaquinaria as $item)
                                            <option value="{{ $item->id }}">
                                                {{ $item->maquinaria }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class=" col-12 col-sm-6 mb-3 ">
                                    <label class="labelTitulo">Bitácora:
                                        <span>*</span></label></br>
                                    <select id="bitacoraId" name="bitacoraId" class="form-select" required
                                        aria-label="Default select example">
                                        <option value="">Seleccione</option>
                                        @foreach ($vctBitacoras as $item)
                                            <option value="{{ $item->id }}">
                                                {{ $item->bitacora }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Cerrar</button>
                                    <button type="submit" class="btn botonGral">Guardar</button>
                                </div>
                            </form>
                        </div>
                    </div>
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
        var slug = '{{ Session::get('message') }}';
        if (slug == 1) {
            Guardado();

        }
    </script>
@endsection
