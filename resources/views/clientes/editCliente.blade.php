@extends('layouts.main', ['activePage' => 'obras', 'titlePage' => __('Alta de Clietes')])
@section('content')
    <div class="content">
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
            <div class="justify-content-center">
                <div class="card">
                    <div class="card-header bacTituloPrincipal">
                        <h4 class="card-title">Editar Cliente</h4>
                        {{-- <p class="card-category">Usuarios registrados</p> --}}
                    </div>
                    <div class="card-body">
                        <div class="row">

                            <div class="d-flex p-3 divBorder">
                                <div class="col-12 ">
                                    <a href="{{ route('clientes.index') }}">
                                        <button class="btn regresar">
                                            <span class="material-icons">
                                                reply
                                            </span>
                                            Regresar
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <form class="alertaGuardar" action="{{ route('clientes.update', $cliente->id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="row mt-3 ">
                                <div class="col-12 col-sm-4 ">
                                    <div class="text-center mx-auto border mb-4">
                                        <i><img class="imgVista img-fluid "
                                                src="{{ $cliente->logo == '' ? '/img/general/default.jpg' : asset('/storage/clientes/' . str_pad($cliente->id, 4, '0', STR_PAD_LEFT) . '/' . $cliente->logo) }}"></i>
                                        <span class="mi-archivo"> <input class="mb-4 ver" type="file" name="logo"
                                                id="mi-archivo" accept="image/*"></span>
                                        <label for="mi-archivo">
                                            <span>Subir Logo</span>
                                        </label>
                                    </div>
                                    <div class="text-center mx-auto border mb-4">

                                        <span class="mi-archivo2"> <input class="mb-4 ver" type="file" name="fiscal"
                                                id="mi-archivo2" accept="application/pdf,"></span>
                                        <label for="mi-archivo2">
                                            <span>Subir Constancia fiscal</span>
                                        </label>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-8 ">
                                    <div class="row">
                                        <div class=" col-12 col-sm-6 col-lg-4 my-3 ">
                                            <label class="labelTitulo">Nombre Comercial: <span>*</span></label></br>
                                            <input type="text" class="inputCaja" id="nombre" name="nombre" required
                                                placeholder="Especifique..." value="{{ $cliente->nombre }}">
                                        </div>
                                        <div class=" col-12 col-sm-6  col-lg-4 my-3 ">
                                            <label class="labelTitulo">Razon Social: <span>*</span></label></br>
                                            <input type="text" class="inputCaja" id="rasonSocial" name="razonSocial"
                                                required placeholder="Especifique..." value="{{ $cliente->razonSocial }}">
                                        </div>
                                        <div class=" col-12 col-sm-6  col-lg-4 my-3 ">
                                            <label class="labelTitulo">RFC: </label></br>
                                            <input type="number" class="inputCaja" id="rfc" name="rfc"
                                                placeholder="Especifique..." value="{{ $cliente->rfc }}">
                                        </div>
                                        <div class=" col-12 col-sm-6  col-lg-4 my-3 ">
                                            <label class="labelTitulo">Calle: <span>*</span></label></br>
                                            <input type="text" class="inputCaja" id="calle" name="calle" required
                                                placeholder="Especifique..." value="{{ $cliente->calle }}">
                                        </div>
                                        <div class=" col-12 col-sm-6  col-lg-4 my-3 ">
                                            <label class="labelTitulo">N. Exterior:</label></br>
                                            <input type="text" class="inputCaja" id="exterior" name="exterior"
                                                value="{{ $cliente->exterior }}">
                                        </div>
                                        <div class=" col-12 col-sm-6  col-lg-4 my-3 ">
                                            <label class="labelTitulo">N. Interior: <span>*</span></label></br>
                                            <input type="text" class="inputCaja" id="interior" name="interior" required
                                                placeholder="Especifique..." value="{{ $cliente->interior }}">
                                        </div>
                                        <div class=" col-12 col-sm-6  col-lg-4 my-3 ">
                                            <label class="labelTitulo">Código Postal:</label></br><input type="number"
                                                maxlength="5" step="1" min="00000" max="99999"
                                                placeholder="ej. 44100" class="inputCaja" id="cp" name="cp"
                                                value="{{ $cliente->cp }}">
                                        </div>
                                        <div class=" col-12 col-sm-6  col-lg-4 my-3 ">
                                            <label class="labelTitulo">Estado: <span>*</span></label></br>
                                            <input type="text" class="inputCaja" id="estado" name="estado"
                                                required placeholder="Especifique..." value="{{ $cliente->estado }}">
                                        </div>
                                        <div class=" col-12 col-sm-6  col-lg-4 my-3 ">
                                            <label class="labelTitulo">Ciudad: <span>*</span></label></br>
                                            <input type="text" class="inputCaja" id="ciudad" name="ciudad"
                                                required placeholder="Especifique..." value="{{ $cliente->ciudad }}">
                                        </div>
                                        <div class=" col-12 col-sm-6  col-lg-4 my-3 ">
                                            <label class="labelTitulo">Colonia: <span>*</span></label></br>
                                            <input type="text" class="inputCaja" id="colonia" name="colonia"
                                                required placeholder="Especifique..." value="{{ $cliente->colonia }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 text-end mb-3 ">
                                    <div class="mb-5" id="spinner-container"></div>
                                    <button type="submit" class="btn botonGral"
                                        onclick="alertaGuardar()">Guardar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
        crossorigin="anonymous"></script>
    <script>
        // agregar registro
        function crearItems() {

            $('.opcion:first').clone().find("input").val("").end().appendTo('#elementos');

        }
        // borrar registro
        $(document).on('click', '#removeRow', function() {

            $(this).closest('#opc').remove();
        });

        function crearItemsB() {

            $('.opcionB:first').clone().find("input").val("").end().appendTo('#elementosB');

        }
        // borrar registro
        $(document).on('click', '#removeRow', function() {

            $(this).closest('#opcB').remove();
        });
    </script>
@endsection
