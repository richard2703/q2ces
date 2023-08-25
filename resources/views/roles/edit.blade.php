@extends('layouts.main', ['activePage' => 'roles', 'titlePage' => 'Editar Rol'])
@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
          <div class="card">
            <!--Header-->
            <div class="card-header bacTituloPrincipal">
              <h4 class="card-title">Editar Rol</h4>
            </div>
            <!--End header-->
            <!--Body-->
            <div class="card-body">
              <div class="row">

                <div class="col-4 text-left">
                  <a href="{{ route('roles.index') }}">
                    <button class="btn regresar" type="button">
                        <span class="material-icons">
                            reply
                        </span>
                        Regresar
                    </button>
                  </a>
                </div>
                <div class="col-8 d-flex justify-content-end">
                </div>

                <div class="d-flex p-3 divBorder"></div>
              </div>
              <form method="POST" action="{{ route('roles.update', $role->id) }}" class="form-horizontal">
                @csrf
                @method('PUT')
              <div class="row mt-3">
                <label for="name" class="col-sm-2 col-form-label labelTitulo">Nombre Del Rol:</label>
                <div class="col-sm-7">
                  <div class="form-group">
                    <input type="text" class="form-control inputCaja" name="name" value="{{ old('name', $role->name) }}" autocomplete="off" autofocus>
                  </div>
                </div>
              </div>
              <div class="row mt-2">
                <label for="name" class="col-sm-2 col-form-label labelTitulo">Permisos:</label>
                <div class="col-sm-8">
                  <div class="form-group">
                      <div class="row">
                        @foreach ($permissions as $id => $permission)
                            <div class="col-md-4 col-12 mb-2">
                                <div class="form-check">
                                    <label class="form-check-label">
                                      <input class="form-check-input permission-checkbox is-invalid align-self-end" type="checkbox" name="permissions[]"
                                      value="{{ $id }}" {{ $role->permissions->contains($id) ? 'checked' : '' }}>
                                        {{ $permission }}
                                        <span class="form-check-sign">
                                            <span class="check"></span>
                                        </span>
                                        
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    
                  </div>
                </div>
              </div>
            </div>
            <!--End body-->
            <!--Footer-->
            <div class="card-footer d-flex justify-content-center">
              <button type="submit" class="btn botonGral">Guardar</button>
            </div>
          </div>
          <!--End footer-->
        </form>
      </div>
    </div>
  </div>
</div>
@endsection