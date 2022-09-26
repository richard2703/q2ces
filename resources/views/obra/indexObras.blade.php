@extends('layouts.main', ['activePage' => 'obra', 'titlePage' => __('Lista de Obras')])
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header bacTituloPrincipal">
                                    <h4 class="card-title">Obras</h4>
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
                                            <a href="{{ route('obras.create') }}">
                                                <button type="button" class="btn botonGral">Añadir Obra</button>
                                            </a>
                                            {{-- @endcan --}}
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead class="labelTitulo">
                                                <th>ID</th>
                                                <th>Nombre</th>
                                                <th>Ciudad</th>
                                                <th>Residente</th>
                                                <th>Telefono</th>
                                                <th>Estatus</th>
                                                <th class="text-right">Acciones</th>
                                            </thead>
                                            <tbody>
                                                @foreach ($obras as $obra)
                                                    <tr>
                                                        <td>{{ $obra->id }}</td>
                                                        <td>{{ $obra->nombre }}</td>
                                                        <td>{{ $obra->ciudad }}</td>
                                                        <td>{{ $obra->residente }}</td>
                                                        <td>{{ $obra->telefono }}</td>
                                                        <td>{{ $obra->estatus }}</td>

                                                        <td class="td-actions text-right">
                                                            {{-- @can('user_show') --}}
                                                            <a href="{{ route('obras.show', $obra->id) }}"
                                                                class="btn btn-info"><i
                                                                    class="material-icons">person</i></a>
                                                            {{-- @endcan --}}
                                                            {{-- @can('user_edit') --}}
                                                            <a href="{{ route('users.edit', $obra->id) }}"
                                                                class="btn btn-warning"><i
                                                                    class="material-icons">edit</i></a>
                                                            {{-- @endcan --}}
                                                            {{-- @can('user_destroy') --}}
                                                            <form action="{{ route('users.delete', $obra->id) }}"
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
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="card-footer mr-auto">
                                    {{ $obras->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
