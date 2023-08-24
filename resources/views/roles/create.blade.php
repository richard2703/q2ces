@extends('layouts.main', ['activePage' => 'roles', 'titlePage' => 'Roles'])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <form method="POST" action="{{ route('roles.store') }}" class="form-horizontal">
          @csrf
          <div class="card">
            <!--Header--> 
            <div class="card-header bacTituloPrincipal">
              <h4 class="card-title">Crear Rol</h4>
            </div>
            <!--End header-->
            <!--Body-->
            <div class="card-body">
              <div class="row">

                <div class="col-4 text-left">
                  <a href="{{ route('roles.index') }}">
                    <button class="btn regresar">
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
              <div class="row mt-2">
                <label for="name" class="col-sm-2 col-form-label labelTitulo">Nombre del rol:</label>
                <div class="col-sm-7">
                  <div class="form-group">
                    <input type="text" class="form-control inputCaja" name="name" autocomplete="off" autofocus>
                  </div>
                </div>
              </div>
              <div class="row">
                <label for="name" class="col-sm-2 col-form-label labelTitulo">Permisos:</label>
                <div class="col-sm-7">
                  <div class="form-group">
                    <div class="tab-content">
                      <div class="tab-pane active">
                        <table class="table">
                          <tbody>
                            @foreach ($permissions as $id => $permission)
                            <tr>
                              <td>
                                <div class="form-check">
                                  <label class="form-check-label">
                                    <input class="form-check-input is-invalid align-self-end"
                                    type="checkbox" type="checkbox" name="permissions[]"
                                      value="{{ $id }}">
                                    <span class="form-check-sign">
                                      <span class="check"></span>
                                    </span>
                                  </label>
                                  {{ $permission }}
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

            <!--End body-->

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