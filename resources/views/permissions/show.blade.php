@extends('layouts.main', ['activePage' => 'usuarios', 'titlePage' => 'Ver Permiso'])
@section('content')
    <div class="content">
        <div class="container-fluid">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bacTituloPrincipal">
                        <h4 class="card-title">Ver Permiso</h4>
                    </div>
                    <!--body-->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4 text-left">
                                <a href="{{ url('permissions') }}">
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
                        <div class="row">


                            <div class="card-body">
                                <div class="row mb-3">
                                    <label for="name" class="labelTitulo col-sm-2 col-form-label">Nombre:</label>
                                    <div class="col-sm-7">
                                        <input type="text" class="inputCaja" name="name"
                                            value="{{ old('name', $permission->name) }}" autofocus readonly>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="apodo" class="labelTitulo col-sm-2 col-form-label">Apodo Del
                                        Permiso:</label>
                                    <div class="col-sm-7">
                                        <div class="form-group">
                                            <input type="text" class="inputCaja" name="apodo"
                                                placeholder="Ingresa Apodo..." required
                                                value="{{ old('apodo', $permission->apodo) }}" readonly>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="comentario" class="labelTitulo col-sm-2 col-form-label">Comentario:</label>
                                    <div class="col-sm-7">
                                        <div class="form-group">
                                            <textarea class="form-select form-control-textarea border-green" name="comentario" rows="3" maxlength="1000"
                                                placeholder="Escribe Aquí Tus Comentarios..." readonly>{{ old('comentario', $permission->comentario) }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{--  <div class="card-footer">
                                        <div class="button-container">
                                            <button class="btn btn-sm btn-primary">Editar</button>
                                        </div>
                                    </div>  --}}


                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <style>
        select[readonly],
        input[readonly],
        textarea[readonly] {
            color: grey;
            cursor: no-drop;
        }
    </style>
@endsection
