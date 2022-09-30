@extends('layouts.main', ['activePage' => 'equipos', 'titlePage' => __('Lista de Accesorios')])
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header bacTituloPrincipal">
                                    <h4 class="card-title">Accesorios</h4>
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
                                                <button type="button" class="btn botonGral">Añadir Accesorio</button>
                                            </a>
                                            {{-- @endcan --}}
                                        </div>
                                    </div>


                                    <table class="table">
                                        <thead>
                                          <tr>
                                            <th scope="col" class="tablaTitulos fw-bolder">Imagen</th>
                                            <th scope="col" class="tablaTitulos fw-bolder">Nombre</th>
                                            <th scope="col" class="tablaTitulos fw-bolder">Maquinaria</th>
                                            <th scope="col" class="tablaTitulos fw-bolder text-right">Acciones</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <tr>
                                            <th scope="row"><img style="width: 100px;" src="{{ asset('/img/accesorios/barredora.jpg') }}"></th>
                                            <td>Barredora</td>
                                            <td>Bobcat</th>
                                            <td class="text-right">Acciones</td>
                                          </tr>
                                          <tr>
                                            <th scope="row"><img style="width: 100px;" src="{{ asset('/img/accesorios/rastrillo.jpg') }}"></th>
                                            <td>Barredora</td>
                                            <td>Bobcat</td>
                                            <td class="text-right">Acciones</td>
                                          </tr>
                                          
                                        </tbody>
                                      </table>



                                    
                                </div>
                                <div class="card-footer mr-auto">
                                    |
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
