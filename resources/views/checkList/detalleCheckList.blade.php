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


                                        <div class="col-12 ">

                                            <div class="row alin">

                                                <div class=" col-12 col-sm-8  col-lg-8 my-1  ">
                                                    <label class="labelTitulo">Bitácora:</label></br>
                                                    <input type="text" class="inputCaja" id="bitacora1" name="bitacora1"
                                                        readonly disabled="true" value="{{ $checkList->bitacora }}">
                                                </div>

                                                <div class=" col-12 col-sm-4  col-lg-4 my-1  ">
                                                    <label class="labelTitulo">Código:</label></br>
                                                    <input type="text" class="inputCaja" id="marca" name="marca"
                                                        readonly disabled="true"
                                                        value="{{ $bitacora->codigo . ' V' . $bitacora->version }}">
                                                </div>

                                                <div class=" col-12 col-sm-8  col-lg-8 my-1  ">
                                                    <label class="labelTitulo">Equipo:
                                                        <span>*</span></label></br>
                                                    <input type="text" class="inputCaja" id="maquinaria1" readonly
                                                        disabled="true" required name="maquinaria1"
                                                        value="{{ $checkList->maquinaria }}">
                                                </div>

                                                <div class=" col-12 col-sm-4  col-lg-4 my-1 ">

                                                    <label class="labelTitulo">Uso de la Maquinaría:
                                                    </label></br>
                                                    <input type="number" class="inputCaja text-end" placeholder="Ej. 1000"
                                                        value="{{ $checkList->usoKom }}" step="1" min="0"
                                                        disabled="true" tabindex="0" id="usoKom" name="usoKom">
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


                                                <div class=" col-12">
                                                    <label class="labelTitulo">Comentarios:</label></br>
                                                    <textarea class="form-control" placeholder="Escribe tu comentario aquí sobre la revisión del CheckList" id="comentario"
                                                        readonly disabled="true" name="comentario" spellcheck="true">{{ $checkList->comentario }}</textarea>
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

                                    @php
                                        $strNombreGrupo = '';
                                        $intCont = 1;
                                        $intGroup = 1;
                                        $blnNuevaSeccion = false;
                                        $objPresentacion = new checkListPresentacion();
                                        /*** directorio contenedor de su información */
                                        $strMaquinaria = str_pad($checkList->identificador, 4, '0', STR_PAD_LEFT);
                                        //*** folio consecutivo del checklist */
                                        $intFolioCheckList = str_pad($checkList->id, 4, '0', STR_PAD_LEFT);
                                        //*** codigo y version de bitacora */
                                        $strBitacora = str_replace(' ', '_', trim($checkList->codigo) . '_v' . trim($checkList->version));

                                        $pathImagen = '/storage/maquinaria/' . $strMaquinaria . '/checkList/' . $strBitacora;
                                        // dd($pathImagen);
                                    @endphp

                                    <div class="card col-12">
                                        <div class="card-body contCart">
                                            <div class="accordion my-3" id="accordionExample">

                                                @forelse ($grupos as $item)
                                                    @if ($intGroup == 1)
                                                        <div class="accordion-item" style="margin-top: -20px;"
                                                            id="AccordionPrincipal">
                                                            <h2 class="accordion-header " id="headingOne">
                                                                <button class="accordion-button bacTituloPrincipal"
                                                                    type="button" data-bs-toggle="collapse"
                                                                    data-bs-target="#{{ str_replace(' ', '_', $item->grupo) }}"
                                                                    aria-expanded="true" aria-controls="collapseOne">
                                                                    @php echo $objPresentacion->getImagenGrupoTareasControl($item->grupoId, 32); @endphp
                                                                    &nbsp;
                                                                    Sección de {{ $item->grupo }}
                                                                </button>
                                                            </h2>

                                                            <div id="{{ str_replace(' ', '_', $item->grupo) }}"
                                                                class="accordion-collapse collapse show"
                                                                aria-labelledby="headingOne"
                                                                data-bs-parent="#accordionExample">
                                                                <div class="accordion-body">

                                                                    <div class="row mt-1 d-flex">
                                                                        <div class="col-12">
                                                                            <div class="row d-flex p-1 divBorder">
                                                                                <div class="col-6 ">
                                                                                    <label
                                                                                        class="labelTitulo">Tarea</label>
                                                                                </div>
                                                                                <div class="col-6">
                                                                                    <label
                                                                                        class="labelTitulo">Resultado</label>
                                                                                </div>
                                                                            </div>

                                                                            @forelse ($records as $tarea)
                                                                                @if ($item->grupoId == $tarea->grupoId)
                                                                                    <div class="row">
                                                                                        <div class="col-4">
                                                                                            <div class="screenChecklists">
                                                                                                @php echo $objPresentacion->getImagenTareaControl($tarea->tareaId, 32, false); @endphp
                                                                                                &nbsp;
                                                                                                {{ $tarea->tarea }}
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-2 td-actions text-center">
                                                                                            @php echo $objPresentacion->getImagenTipoTareaControl($tarea->tareaTipoValor, 32, false);  @endphp
                                                                                            @php
                                                                                                if (is_null($tarea->ruta) == false) {
                                                                                                    echo "<a class='img-mouse'><i class='fas fa-camera'> </i></a>";
                                                                                                    echo '<input class="img-a-mostrar" type="image" width="300" id="image' . $tarea->tareaId . '" alt="Imagen" src="' . asset($pathImagen . '/' . $tarea->ruta) . '" />';
                                                                                                }
                                                                                            @endphp
                                                                                        </div>
                                                                                        <div class="col-6 text-left">
                                                                                            {{ $tarea->resultado }}
                                                                                        </div>
                                                                                    </div>
                                                                                @endif
                                                                                <?php
                                                                                $intCont += 1;
                                                                                ?>
                                                                            @empty
                                                                                <div class="row">
                                                                                    <div class="col-12">
                                                                                        class="labelTitulo">Sin
                                                                                        registros</label>
                                                                                    </div>
                                                                                </div>
                                                                            @endforelse

                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div class="accordion-item" id="AccordionSecondary">
                                                            <h2 class="accordion-header" id="headingThree">
                                                                <button class="accordion-button bacTituloPrincipal"
                                                                    type="button" data-bs-toggle="collapse"
                                                                    data-bs-target="#{{ str_replace(' ', '_', $item->grupo) }}"
                                                                    aria-expanded="true" aria-controls="collapseOne">
                                                                    @php echo $objPresentacion->getImagenGrupoTareasControl($item->grupoId, 32); @endphp
                                                                    &nbsp;
                                                                    Sección de {{ $item->grupo }}
                                                                </button>
                                                            </h2>
                                                            <div id="{{ str_replace(' ', '_', $item->grupo) }}"
                                                                class="accordion-collapse collapse"
                                                                aria-labelledby="headingThree"
                                                                data-bs-parent="#accordionExample">
                                                                <div class="accordion-body">

                                                                    <div class="row mt-3 d-flex">
                                                                        <div class="col-12">

                                                                            <div class="row mt-1 d-flex">
                                                                                <div class="col-12">
                                                                                    <div class="row d-flex p-1 divBorder">
                                                                                        <div class="col-6">
                                                                                            <label
                                                                                                class="labelTitulo">Tarea</label>
                                                                                        </div>
                                                                                        <div class="col-6">
                                                                                            <label
                                                                                                class="labelTitulo">Resultado</label>
                                                                                        </div>
                                                                                    </div>

                                                                                    @forelse ($records as $tarea)
                                                                                        @if ($item->grupoId == $tarea->grupoId)
                                                                                            <div class="row">
                                                                                                <div class="col-4">
                                                                                                    <div class="screenChecklists">
                                                                                                        @php echo $objPresentacion->getImagenTareaControl($tarea->tareaId, 32, false); @endphp
                                                                                                        &nbsp;
                                                                                                        {{ $tarea->tarea }}
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="col-2 td-actions text-center">
                                                                                                    @php echo $objPresentacion->getImagenTipoTareaControl($tarea->tareaTipoValor, 32, false);  @endphp
                                                                                                    @php
                                                                                                        if (is_null($tarea->ruta) == false) {
                                                                                                            echo "<a class='img-mouse'><i class='fas fa-camera'> </i></a>";
                                                                                                            echo '<input class="img-a-mostrar" type="image" width="300" id="image' . $tarea->tareaId . '" alt="Imagen" src="' . asset($pathImagen . '/' . $tarea->ruta) . '" />';
                                                                                                        }
                                                                                                    @endphp
                                                                                                </div>
                                                                                                <div class="col-6 text-left">
                                                                                                    {{ $tarea->resultado }}
                                                                                                </div>
                                                                                            </div>
                                                                                        @endif
                                                                                        <?php
                                                                                        $intCont += 1;
                                                                                        ?>
                                                                                    @empty
                                                                                        <div class="row">
                                                                                            <div class="col-12">
                                                                                                <label
                                                                                                    class="labelTitulo">Sin
                                                                                                    registros</label>
                                                                                                </p>
                                                                                            </div>
                                                                                        </div>
                                                                                    @endforelse

                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    @php
                                                        $intGroup += 1;
                                                    @endphp

                                                @empty
                                                @endforelse

                                            </div>
                                        </div>
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

    <style>
        .img-mouse {
            background: #5c7c26;
            color: #fff;
            padding: 5px;
            border-radius: 5px;
        }

        .img-a-mostrar {
            display: none;
        }

        /* Aquí está la magia que no me funciona*/
        .img-mouse:hover+.img-a-mostrar {
            display: block !important;
            /* activamos la imágen y hasta le ruego con un !important */
        }
    </style>
@endsection
