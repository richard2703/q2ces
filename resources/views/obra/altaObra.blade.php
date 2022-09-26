@extends('layouts.main', ['activePage' => 'obra', 'titlePage' => __('Alta de Obra')])
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-11 align-self-start">
                    <div class="card">
                        <div class="card-body contCart">
                            <div class="p-1 align-self-start bacTituloPrincipal">
                                <h2 class="my-3 ms-3 texticonos ">Alta de Obra</h2>
                            </div>

                            <form class="row" action="{{ route('obras.store') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="col-12   my-5 ">

                                    <div class="row d-flex">
                                        <div class="col-12 col-sm-6 ">
                                            <div class="text-center mx-auto mb-2 border altalogo">
                                                Logo de la Empresa
                                            </div>
                                            <input class="mb-4" type="file" name="logo" id=" ">
                                            <br>
                                        </div>


                                        <div class="col-12 col-sm-6 ">
                                            <div class="text-center mx-auto mb-2 border altaEmpresaFoto">
                                                Foto Aérea de la Empresa
                                            </div>
                                            <input class="mb-4" type="file" name="foto" id=" ">
                                        </div>
                                    </div>


                                </div>

                                <div class="col-12   ">
                                    <div class="row">
                                        <div class=" col-12 col-sm-6 col-lg-4 my-3 ">
                                            <label class="labelTitulo">Nombre de la Obra:</label></br>
                                            <input type="text" class="inputCaja" id="nombre" name="nombre"
                                                value="">
                                        </div>
                                        <div class=" col-12 col-sm-6  col-lg-4 my-3 ">
                                            <label class="labelTitulo">Tipo:</label></br>
                                            <select class="form-select" aria-label="Default select example" id="tipo"
                                                name="tipo">
                                                <option selected>Seleccione</option>
                                                <option value="Q2Ces">Q2Ces</option>
                                                <option value="Externa">Externa</option>
                                            </select>
                                        </div>
                                        <div class=" col-12 col-sm-6  col-lg-4 my-3 ">
                                            <label class="labelTitulo">Calle:</label></br>
                                            <input type="text" class="inputCaja" id="calle" name="calle"
                                                value="">
                                        </div>
                                        <div class=" col-12 col-sm-6  col-lg-4 my-3 ">
                                            <label class="labelTitulo">Número:</label></br>
                                            <input type="text" class="inputCaja" id="numero" name="numero"
                                                value="">
                                        </div>
                                        <div class=" col-12 col-sm-6  col-lg-4 my-3 ">
                                            <label class="labelTitulo">Colonia:</label></br>
                                            <input type="text" class="inputCaja" id="colonia" name="colonia"
                                                value="">
                                        </div>
                                        <div class=" col-12 col-sm-6  col-lg-4 my-3 ">
                                            <label class="labelTitulo">Código Postal:</label></br>
                                            <input type="text" class="inputCaja" id="cp" name="cp"
                                                value="">
                                        </div>
                                        <div class=" col-12 col-sm-6  col-lg-4 my-3 ">
                                            <label class="labelTitulo">Localidad:</label></br>
                                            <input type="text" class="inputCaja" id="ciudad" name="ciudad"
                                                value="">
                                        </div>
                                        <div class=" col-12 col-sm-6  col-lg-4 my-3 ">
                                            <label class="labelTitulo">Estado:</label></br>
                                            <input type="text" class="inputCaja" id="estado" name="estado"
                                                value="">
                                        </div>
                                    </div>
                                </div>
                        </div>

                        <div class="col-12 text-end mb-3 ">
                            <button type="submit" class="btn botonGral">Guardar</button>
                        </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
