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
                                                <div class="col-12">
                                                    <label class="labelTitulo">Equipo:
                                                        <span>*</span></label></br>
                                                    <input type="text" class="inputCaja" id="nombre" readonly
                                                        disabled="true" required name="nombre"
                                                        value="{{ $checkList->maquinaria }}">
                                                </div>


                                                <div class="col-12">
                                                    <label class="labelTitulo">Bitácora:</label></br>
                                                    <input type="text" class="inputCaja" id="marca" name="marca"
                                                        readonly disabled="true" value="{{ $checkList->bitacora }}">
                                                </div>

                                                <div class=" col-12">
                                                    <label class="labelTitulo">Comentarios:</label></br>
                                                    <textarea class="form-control" placeholder="Escribe tu comentario aquí sobre la revisión del CheckList" id="comentario"
                                                        readonly disabled="true" name="comentario" spellcheck="true">{{ $checkList->comentario }}</textarea>
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
                                                /*** directorio contenedor de su información */
                                                $strMaquinaria = str_pad($checkList->identificador, 4, '0', STR_PAD_LEFT);
                                                //*** folio consecutivo del checklist */
                                                $intFolioCheckList = str_pad($checkList->id, 4, '0', STR_PAD_LEFT);
                                                //*** codigo y version de bitacora */
                                                $strBitacora = str_replace(' ', '_', trim($checkList->codigo) . '_v' . trim($checkList->version));

                                                $pathImagen = '/storage/maquinaria/' . $strMaquinaria . '/checkList/' . $strBitacora;
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
                                                            @php
                                                                if (is_null($item->ruta) == false) {
                                                                    echo '<input type="image" width="100" id="image'.$item->tareaId.'" alt="Imagen" src="'. asset( $pathImagen . '/' . $item->ruta) . '" />';
                                                                }
                                                            @endphp
                                                            <p class="text">{{ $item->resultado }} </p>
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

                                <div class="col-12 text-center m-3 pt-2">
                                    <a href="{{ route('checkList.index') }}">
                                        <button type="button" class="btn btn-danger">Regresar</button>
                                    </a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
