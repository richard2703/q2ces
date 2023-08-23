@extends('layouts.main', ['activePage' => 'usuarios', 'titlePage' => 'Nuevo usuario'])
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bacTituloPrincipal">
                        <h4 class="card-title">Crear Usuario</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4 text-left">
                                <a href="{{ url('usuarios') }}">
                                    <button class="btn regresar">
                                        <span class="material-icons">
                                            reply
                                        </span>
                                        Regresar
                                    </button>
                                </a>
                            </div>

                            <div class="d-flex p-3 divBorder"></div>
                        </div>
                        <form action="{{ route('users.store') }}" method="post" class="form-horizontal">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <label for="name" class="labelTitulo">Nombre:</label>

                                        <input class="inputCaja" type="text" class="form-control" name="name"
                                            placeholder="Ingrese Su Nombre" value="{{ old('name') }}" autofocus required>
                                        @if ($errors->has('name'))
                                            <span class="error text-danger"
                                                for="input-name">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-6">
                                        <label for="email" class="labelTitulo">Correo:</label>
                                        <input class="inputCaja" type="email" class="form-control" name="email"
                                            placeholder="Ingrese su correo" value="{{ old('email') }}" required>
                                        @if ($errors->has('email'))
                                            <span class="error text-danger"
                                                for="input-email">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-6 mt-3">
                                        <label for="username" class="labelTitulo">Nombre De
                                            Usuario:</label>

                                        <input class="inputCaja" type="text" class="form-control" name="username"
                                            placeholder="Ingrese su nombre de usuario" value="{{ old('username') }}">
                                        @if ($errors->has('username'))
                                            <span class="error text-danger"
                                                for="input-username">{{ $errors->first('username') }}</span>
                                        @endif
                                    </div>

                                    <div class="col-6 mt-3">
                                        <label for="password" class="labelTitulo">Contraseña:</label>
                                        <input class="inputCaja" type="password" class="form-control" name="password"
                                            placeholder="Contraseña" required>
                                        @if ($errors->has('password'))
                                            <span class="error text-danger"
                                                for="input-password">{{ $errors->first('password') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row mt-3 d-flex justify-content-end">
                                    <label for="roles"
                                        class="labelTitulo col-sm-2 col-form-label d-flex align-items-center mb-3"
                                        style="justify-content: flex-end !important;">Roles:</label>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <div class="tab-content">
                                                <div class="tab-pane active">
                                                    <table class="table">
                                                        <tbody>
                                                            @foreach ($roles as $id => $role)
                                                                <tr>
                                                                    <td>
                                                                        <div class="form-check">
                                                                            <label class="form-check-label">
                                                                                <input
                                                                                    class="form-check-input is-invalid align-self-end"
                                                                                    type="checkbox" name="roles[]"
                                                                                    value="{{ $id }}">
                                                                                <span class="form-check-sign">
                                                                                    <span class="check"></span>
                                                                                </span>
                                                                            </label>
                                                                            {{ $role }}
                                                                        </div>

                                                                    </td>


                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--Footer-->
                            <div class="card-footer d-flex justify-content-center">
                                <button type="submit" class="btn botonGral">Guardar</button>
                            </div>
                            <!--End footer-->
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
