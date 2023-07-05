@extends('layouts.main', ['activePage' => 'bitacoras', 'activeItem' => 'bitacoras'])
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header bacTituloPrincipal">
                                    <h4 class="card-title">Bitácoras</h4>

                                </div>
                                <div class="card-body">

                                    <!--<div class="alert alert-success" role="success">
                                                        
                                                    </div>
                                                
                                                    <div class="alert alert-danger" role="faild">
                                                        
                                                    </div>-->

                                    <div class="row">
                                        <div class="col-12 text-right">

                                            <a href="{{ url('/nuevoBitacora') }}">
                                                <!--Agregar ruta-->
                                                <button type="button" class="btn botonGral">Nuevo Registro</button>
                                            </a>

                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead class="labelTitulo">
                                                <tr>
                                                    <th class="labelTitulo">Nombre</th>
                                                    <th class="labelTitulo">Comentario</th>
                                                    <th class="labelTitulo text-right">Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <tr>
                                                    <td>RE-214 </td>

                                                    <td>It is a long established fact that a reader will be distracted by
                                                        the readable content of a page when looking </td>

                                                    <td class="td-actions text-right">

                                                        <a href="{{ url('/editarBitacora') }}" class="">
                                                            <svg xmlns="http://www.w3.org/2000/svg " width="28"
                                                                height="28" fill="currentColor" title="Editar"
                                                                class="bi bi-pencil accionesIconos" viewBox="0 0 16 16">
                                                                <path
                                                                    d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                                                            </svg>
                                                        </a>

                                                        <form action="" method="POST" style="display: inline-block;"
                                                            onsubmit="return confirm('Seguro?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btnSinFondo" type="submit" rel="tooltip">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="28"
                                                                    height="28" fill="currentColor" title="Eliminar"
                                                                    class="bi bi-x-circle" viewBox="0 0 16 16">
                                                                    <path
                                                                        d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                                    <path
                                                                        d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                                                                </svg>
                                                            </button>
                                                        </form>
                                                        {{-- @endcan --}}
                                                    </td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
