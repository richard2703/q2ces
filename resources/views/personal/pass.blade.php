@extends('layouts.main', ['activePage' => '', 'titlePage' => 'Editar usuario'])
@section('content')
    <div class="content">
        <div class="container-fluid">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bacTituloPrincipal">
                        <h4 class="card-title">Cambio de Contraseña</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4 text-left">
                                <a href="{{ url('home') }}">
                                    <button class="btn regresar">
                                        <span class="material-icons">
                                            reply
                                        </span>
                                        Regresar
                                    </button>
                                </a>
                            </div>
                            <div class="col-8 text-end">
                                {{--  <button data-bs-toggle="modal" data-bs-target="#modalContraseña" type="button"
                                onclick="cargaItem('{{ $user->id }}')" class="btn botonGral">Cambiar Contraseña</button>  --}}
                            </div>

                            <div class="d-flex p-3 divBorder"></div>
                        </div>
                        <form action="{{ route('personal.cuentaUpdate', $user->id) }}" method="post" class="alertaGuardar"
                            enctype="multipart/form-data">
                            @csrf
                            @method('put')

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <label for="name" class="labelTitulo">Nombre:</label>

                                        <input class="inputCaja" type="text" class="form-control" name="name"
                                            placeholder="Ingrese Su Nombre" value="{{ old('name', $user->name) }}" readonly>
                                        @if ($errors->has('name'))
                                            <span class="error text-danger"
                                                for="input-name">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label for="email" class="labelTitulo">Correo:</label>
                                        <input class="inputCaja" type="email" class="form-control" name="email"
                                            placeholder="Ingrese su correo" value="{{ old('email', $user->email) }}"
                                            readonly>
                                        @if ($errors->has('email'))
                                            <span class="error text-danger"
                                                for="input-email">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-12 col-md-6 mt-3">
                                        <label for="username" class="labelTitulo">Contraseña:</label>

                                        <input class="inputCaja" type="password" class="form-control" name="password"
                                            placeholder="Contraseña" value="">
                                        @if ($errors->has('password'))
                                            <span class="error text-danger"
                                                for="input-username">{{ $errors->first('password') }}</span>
                                        @endif
                                    </div>

                                    <div class="col-12 col-md-6 mt-3">
                                        <label for="password" class="labelTitulo">Confirma Contraseña:</label>
                                        <input class="inputCaja" type="password" class="form-control" name="Rpassword"
                                            placeholder="Confirma Contraseña">
                                        @if ($errors->has('Rpassword'))
                                            <span class="error text-danger"
                                                for="input-password">{{ $errors->first('Rpassword') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <!--Footer-->
                            <div class="card-footer d-flex justify-content-center">
                                <button type="submit" class="btn botonGral">Guardar</button>
                            </div>
                            <!--End footer-->

                        </form>
                    </div>
                </div>

            </div>
        </div>

        <style>
            #password[type="password"],
            #newPassword[type="password"] {
                -webkit-text-security: disc !important;
            }

            #password[type="text"],
            #newPassword[type="text"] {
                -webkit-text-security: none !important;
            }

            #eyeIconPassword.crossed,
            #eyeIconNewPassword.crossed {
                text-decoration: line-through;
                color: red;
            }
        </style>
    @endsection
