@extends('layouts.main', ['activePage' => 'usuarios', 'titlePage' => 'Detalles Del Usuario'])
@section('content')
    <div class="content">
        <div class="container-fluid">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bacTituloPrincipal">
                        <h4 class="card-title">Ver Usuario</h4>
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
                            <div class="col-8 text-end">
                                
                            </div>

                            <div class="d-flex p-3 divBorder"></div>
                        </div>
                            {{--  <div class="d-md-flex p-3">
                                <div class="col-12 col-md-4 px-2 ">
                                    <div class="text-center mx-auto border  mb-4">
                                        <i><img class="imgPersonal img-fluid"
                                                src="{{ $user->foto == '' ? ' /img/general/default.jpg' : asset('/storage/user/' . str_pad($user->id, 4, '0', STR_PAD_LEFT) . '/' . $user->foto) }}"></i>

                                        <span class="mi-archivo"> <input class="mb-4 ver" type="file" name="foto"
                                                id="mi-archivo" accept="image/*"></span>
                                        <label for="mi-archivo">
                                            <span>Sube Imagen</span>
                                        </label>
                                    </div>
                                </div>

                                <div class="col-12 col-md-8 px-2">
                                    <div class="row alin">
                                        <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                            <label class="labelTitulo">Número de Empleado:</label></br>
                                            <input type="text" class="inputCaja" id="numEmpleado" name="numEmpleado"
                                                value="">
                                        </div>

                                        <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                            <label class="labelTitulo">Nombre(s): <span>*</span></label></br>
                                            <input type="text" class="inputCaja" id="nombres" name="nombres" required
                                                value="{{ $user->name }}">
                                        </div>

                                        <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                            <label class="labelTitulo">Apellido Paterno: <span>*</span></label></br>
                                            <input type="text" class="inputCaja" id="apellidoP" name="apellidoP" required
                                                value="{{ $user->apellidoP }}">
                                        </div>

                                        <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                            <label class="labelTitulo">Apellio Materno:</label></br>
                                            <input type="text" class="inputCaja" id="apellidoM" name="apellidoM"
                                                value="{{ $user->apellidoM }}">
                                        </div>

                                        <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                            <label class="labelTitulo">Tipo de Sangre:</label></br>
                                            <select class="form-select" aria-label="Default select example" id="sangre"
                                                name="sangre">
                                                <option value="A+" {{ $user->sangre == 'A+' ? ' selected' : '' }}>A+
                                                </option>
                                                <option value="A-"{{ $user->sangre == 'A-' ? ' selected' : '' }}>A-
                                                </option>
                                                <option value="B+"{{ $user->sangre == 'B+' ? ' selected' : '' }}>B+
                                                </option>
                                                <option value="B-"{{ $user->sangre == 'B-' ? ' selected' : '' }}>B-
                                                </option>
                                                <option value="AB+"{{ $user->sangre == 'AB+' ? ' selected' : '' }}>
                                                    AB+</option>
                                                <option value="AB-"{{ $user->sangre == 'AB-' ? ' selected' : '' }}>
                                                    AB-</option>
                                                <option value="O+"{{ $user->sangre == 'O+' ? ' selected' : '' }}>O+
                                                </option>
                                                <option value="O-"{{ $user->sangre == 'O-' ? ' selected' : '' }}>O-
                                                </option>
                                            </select>
                                        </div>

                                        <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                            <label class="labelTitulo">Alergias:</label></br>
                                            <input type="text" class="inputCaja" id="aler" name="aler"
                                                value="{{ $user->aler }}">
                                        </div>

                                        <div class=" col-12 col-sm-6 mb-3 ">
                                            <label class="labelTitulo">Correo Electrónico Empresa:</label></br>
                                            <input type="text" class="inputCaja" id="mailEmpresarial"
                                                name="mailEmpresarial" value="{{ $user->email }}">
                                        </div>

                                        <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                            <label class="labelTitulo">Celular:</label></br>
                                            <input type="text" class="inputCaja" id="celular" name="celular"
                                                value="{{ $user->celular }}">
                                        </div>

                                    </div>
                                </div>
                            </div>  --}}
                            <div class="card-body">
                                <div class="row mt-3 d-flex justify-content-end">
                                    <div class="col-12 col-md-6 px-2 ">
                                        <div class="text-center mx-auto border  mb-4">
                                            <i><img class="imgPersonal img-fluid"
                                                    src="{{ $user->foto == '' ? ' /img/general/default.jpg' : asset('/storage/user/' . str_pad($user->id, 4, '0', STR_PAD_LEFT) . '/' . $user->foto) }}"></i>
    
                                            <span class="mi-archivo"> <input class="mb-4 ver" type="file" name="foto"
                                                    id="mi-archivo" accept="image/*"></span>
                                            
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <div class="tab-content">
                                                <div class="tab-pane active">
                                                    <table class="table">
                                                        <tbody>
                                                            <label for="roles"
                                                                class="labelTitulo col-sm-2 col-form-label d-flex align-items-center mb-3"
                                                                style="">Roles:</label>
                                                            @foreach ($roles as $id => $role)
                                                                <tr>
                                                                    <td>
                                                                        <div class="form-check" style="color: grey !important">
                                                                            <label class="form-check-label">
                                                                                <input
                                                                                    class="form-check-input is-invalid align-self-end"
                                                                                    type="checkbox" name="roles[]"
                                                                                    value="{{ $id }}" disabled
                                                                                    {{ $user->roles->contains($id) ? 'checked' : '' }}>
                                                                                <span class="form-check-sign">
                                                                                    <span class="check"
                                                                                        value=""></span>
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
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <label for="name" class="labelTitulo">Nombre:</label>

                                        <input class="inputCaja" type="text" class="form-control" name="name"
                                            placeholder="Ingrese Su Nombre" value="{{ old('name', $user->name) }}" autofocus
                                            required readonly>
                                        @if ($errors->has('name'))
                                            <span class="error text-danger"
                                                for="input-name">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label for="email" class="labelTitulo">Correo:</label>
                                        <input class="inputCaja" type="email" class="form-control" name="email"
                                            placeholder="Ingrese su correo" value="{{ old('email', $user->email) }}"
                                            required readonly>
                                        @if ($errors->has('email'))
                                            <span class="error text-danger"
                                                for="input-email">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-12 col-md-6 mt-3">
                                        <label for="username" class="labelTitulo">Nombre De
                                            Usuario:</label>

                                        <input class="inputCaja" type="text" class="form-control" name="username"
                                            placeholder="Ingrese su nombre de usuario"
                                            value="{{ old('username', $user->username) }}" readonly>
                                        @if ($errors->has('username'))
                                            <span class="error text-danger"
                                                for="input-username">{{ $errors->first('username') }}</span>
                                        @endif
                                    </div>

                                    <div class="col-12 col-md-6 mt-3">
                                        <label for="password" class="labelTitulo">Contraseña:</label>
                                        <input class="inputCaja" type="password" class="form-control" name="password"
                                            placeholder="Contraseña" readonly>
                                        @if ($errors->has('password'))
                                            <span class="error text-danger"
                                                for="input-password">{{ $errors->first('password') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>

            </div>
        </div>
        <style>
            select[readonly], input[readonly], textarea[readonly]{
              color: grey !important;
              cursor:no-drop;
            }
          </style>
    @endsection