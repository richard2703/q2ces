@extends('layouts.main', ['activePage' => 'maquinaria', 'titlePage' => __('Lista de Maquinaria')])
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header bacTituloPrincipal">
                                    <h4 class="card-title">Maquinaria</h4>
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
                                    <div class="row">
                                        <div class="col-12 text-right">
                                            {{-- @can('user_create') --}}
                                            <a href="{{ route('maquinaria.create') }}">
                                                <button type="button" class="btn botonGral">Añadir Maquina</button>
                                            </a>
                                            {{-- @endcan --}}
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead class="labelTitulo">
                                                <th>ID</th>
                                                <th>Marca</th>
                                                <th>Modelo</th>
                                                <th>Categoria </th>
                                                <th>Uso</th>
                                                <th>placas</th>
                                                <th class="text-right">Acciones</th>
                                            </thead>
                                            <tbody>
                                                @forelse ($maquinaria as $maquina)
                                                    <tr>
                                                        <td>{{ $maquina->id }}</td>
                                                        <td>{{ $maquina->marca }}</td>
                                                        <td>{{ $maquina->modelo }}</td>
                                                        <td>{{ $maquina->categoria }}</td>
                                                        <td>{{ $maquina->uso }}</td>
                                                        <td>{{ $maquina->placas }}</td>

                                                        <td class="td-actions text-right">
                                                            {{-- @can('user_show') --}}
                                                            <a href="{{ route('maquinaria.show', $maquina->id) }}"
                                                                class="btn btn-info"><i
                                                                    class="material-icons">person</i></a>
                                                            {{-- @endcan --}}
                                                            {{-- @can('user_edit') --}}
                                                            <a href="{{ route('users.edit', $maquina->id) }}"
                                                                class="btn btn-warning"><i
                                                                    class="material-icons">edit</i></a>
                                                            {{-- @endcan --}}
                                                            {{-- @can('user_destroy') --}}
                                                            <form action="{{ route('users.delete', $maquina->id) }}"
                                                                method="POST" style="display: inline-block;"
                                                                onsubmit="return confirm('Seguro?')">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button class="btn btn-danger" type="submit"
                                                                    rel="tooltip">
                                                                    <i class="material-icons">close</i>
                                                                </button>
                                                            </form>
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
@endsection
