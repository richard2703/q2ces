@extends('layouts.main', ['activePage' => 'checklist', 'titlePage' => __('Nueva Tarea Check List')])
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header bacTituloPrincipal">
                                    <h4 class="card-title">Detalle de CheckList</h4>

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
                                            <a href="{{ route('checkList.index') }}">
                                                <button class="btn regresar">
                                                    <span class="material-icons">
                                                        reply
                                                    </span>
                                                    Regresar
                                                </button>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="row mt-3">


                                        <div class="col-12 col-md-8 ">

                                            <div class="row alin">
                                                <div class=" col-12  ">
                                                    <label class="labelTitulo">Equipo:
                                                        <span>*</span></label></br>
                                                    <input type="text" class="inputCaja" id="nombre" readonly
                                                        disabled="true" required name="nombre"
                                                        value="{{ $checkList->maquinaria }}">
                                                </div>


                                                <div class=" col-12   ">
                                                    <label class="labelTitulo">Bitácora:</label></br>
                                                    <input type="text" class="inputCaja" id="marca" name="marca"
                                                        readonly disabled="true" value="{{ $checkList->bitacora }}">
                                                </div>


                                                <div class=" col-12 col-sm-6 col-lg-6 mb-3 ">
                                                    <label class="labelTitulo">Usuario:</label></br>
                                                    <input type="text" class="inputCaja" id="modelo" name="modelo"
                                                        readonly disabled="true" value="{{ $checkList->usuario }}">
                                                </div>

                                                <div class=" col-12 col-sm-6 col-lg-6 mb-3 ">
                                                    <label class="labelTitulo">Registrada:</label></br>
                                                    <input type="text" class="inputCaja" id="submarca" readonly
                                                        disabled="true" name="submarca"
                                                        value="{{ $checkList->registrada }}">
                                                </div>

                                            </div>

                                        </div>
                                        <div class="d-flex p-3">
                                            <div class="col-12" id="elementos">
                                                <div class="d-flex">
                                                    <div class="col-12 divBorder">
                                                        <h2 class="tituloEncabezado ">Detalle</h2>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead class="labelTitulo">
                                                {{-- <tr>
                                                    <th class="labelTitulo">Tarea</th>
                                                    <th class="labelTitulo">Resultado</th>
                                                </tr> --}}
                                            </thead>
                                            <tbody>
                                                <?php
                                                $strNombreGrupo = '';
                                                $intCont = 0;
                                                $blnNuevaSeccion = false;
                                                $objPresentacion = new checkListPresentacion();
                                                ?>
                                                @forelse ($records as $item)
                                                    <?php
                                                    if ($strNombreGrupo == '') {
                                                        //*** es la primera vez
                                                        $strNombreGrupo = $item->grupo;
                                                        $blnNuevaSeccion = true;
                                                    } elseif ($strNombreGrupo != $item->grupo) {
                                                        $strNombreGrupo = $item->grupo;
                                                        $blnNuevaSeccion = true;
                                                    } else {
                                                        $blnNuevaSeccion = false;
                                                    }

                                                    ?>
                                                    @if ($blnNuevaSeccion == true)
                                                        <tr>
                                                            <th class="labelTitulo" colspan="2">Sección
                                                                {{ $strNombreGrupo }}</th>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Tarea</strong></td>
                                                            <td><strong>Resultado</strong></td>
                                                        </tr>
                                                    @endif

                                                    <tr>
                                                        <td>{{ $item->tarea }} </td>
                                                        <td>
                                                            {{-- <?php //echo $objPresentacion->getControlByTarea($item->tareaId, $item->resultado, $intCont); ?> --}}
                                                            <p class="text">{{ $item->resultado }} </p>
                                                        </td>
                                                        </td>
                                                    </tr>

                                                    <?php
                                                    $intCont += 1;
                                                    ?>
                                                @empty
                                                    <tr>
                                                        <td colspan="4">Sin registros.</td>
                                                    </tr>
                                                @endforelse
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
