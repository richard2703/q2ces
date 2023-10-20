@extends('layouts.main', ['activePage' => 'roles', 'titlePage' => 'Roles'])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
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
                            <form method="POST" action="{{ route('roles.store') }}" class="form-horizontal">
                                @csrf
                                <div class="row mt-3">
                                    <label for="name" class="col-sm-2 col-form-label labelTitulo">Nombre Del
                                        rol:</label>
                                    <div class="col-sm-7">
                                        <div class="form-group">
                                            <input type="text" class="form-control inputCaja" name="name"
                                                autocomplete="off" autofocus>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <label for="name" class="col-sm-2 col-form-label labelTitulo">Permisos:</label>
                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <div class="row">
                                                <?php
                                                // $strNombreGrupo = '';
                                                // $intCont = 0;
                                                // $blnNuevaSeccion = false;
                                                ?>
                                                @foreach ($permissions as $id => $permission)
                                                    <?php
                                                    //     $vctPermiso=explode("_", $permission);
                                                    //   if ($strNombreGrupo == '') {
                                                    //       //*** es la primera vez
                                                    //       $strNombreGrupo = $vctPermiso[0].'<br>';
                                                    //       $blnNuevaSeccion = true;
                                                    //   } elseif ($strNombreGrupo != $vctPermiso[0]) {
                                                    //       $strNombreGrupo = $vctPermiso[0];
                                                    //       $blnNuevaSeccion = true;
                                                    //   } else {
                                                    //       $blnNuevaSeccion = false;
                                                    //   }
                                                    ?>
                                                    <div class="col-md-4 col-12 mb-2">
                                                        <div class="form-check">

                                                            <label class="form-check-label">
                                                                <input
                                                                    class="form-check-input permission-checkbox is-invalid align-self-end"
                                                                    type="checkbox" name="permissions[]"
                                                                    value="{{ $id }}">
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
                        </div>

                        <div class="card-footer d-flex justify-content-center">
                            <button type="submit" class="btn botonGral">Guardar</button>
                        </div>

                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
