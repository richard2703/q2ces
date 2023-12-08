@extends('layouts.main', ['activePage' => 'mantenimiento', 'titlePage' => __('Nuevo Mantenimiento')])
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
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">

                                <div class="card-header bacTituloPrincipal">
                                    <h4 class="card-title">Editar {{ $mantenimiento->compania == 'mtq' ? 'MTQ' : '' }}
                                        {{ $mantenimiento->titulo }}</h4>
                                </div>

                                <div class="col-12 col-md-2 mt-4" style="margin-left:20px">
                                    <a href="{{ route('mantenimientos.index') }}">
                                        <button class="btn regresar">
                                            <span class="material-icons">
                                                reply
                                            </span>
                                            Regresar
                                        </button>
                                    </a>
                                </div>
                                <div class="d-flex p-3 divBorder w-100" style="margin-top:-10px"></div>
                                <div class="card-body ">

                                    <form class="row alertaGuardar" id="formulario"
                                        action="{{ route('mantenimientos.update', $mantenimiento->id) }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('put')
                                        <input type="hidden" name="maquinariaId" id="maquinariaId" value="">
                                        <input type="hidden" name="identificador" id="identificador"
                                            value="{{ $maquinaria->identificador }}">
                                        <input type="hidden" name="titulo" id="titulo"
                                            value="{{ $mantenimiento->titulo }}">
                                        <input type="hidden" name="compania" id="compania"
                                            value="{{ $mantenimiento->compania == 'mtq' ? 'mtq' : 'q2ces' }}">

                                        <div class="col-12 my-4">
                                            <div class="row">
                                                <input type="hidden" name="mantenimientoId" id="mantenimientoId"
                                                    value="{{ $mantenimiento->id }}">

                                                <input type="hidden" name="maquinariaId" id="maquinariaId"
                                                    value="{{ $mantenimiento->maquinariaId }}">

                                                <input type="hidden" name="residenteId" id="residenteId"
                                                    value="{{ $mantenimiento->residenteId }}">

                                                <input type="hidden" name="personalId" id="personalId"
                                                    value="{{ $mantenimiento->personalId }}">

                                                <div class=" col-12 col-sm-6 col-lg-12 my-3 ">
                                                    <label class="labelTitulo">Indicaciones para el Mantenimiento:
                                                    </label></br>
                                                    <textarea rows="2" cols="80" class="form-control" id="comentario" name="comentario" readonly>{{ $mantenimiento->comentario }}</textarea>
                                                </div>

                                                <div class=" col-12 col-sm-6  col-lg-4 my-3 ">
                                                    <label class="labelTitulo">Fecha de Inicio: </label></br>
                                                    <input type="date" class="inputCaja" placeholder="Especifique..."
                                                        {{ $mantenimiento->estadoId < 3 ? '' : 'readonly' }} readonly
                                                        id="fechaInicio" name="fechaInicio"
                                                        value="{{ $mantenimiento->fechaInicio }}">
                                                </div>

                                                <div class=" col-12 col-sm-6  col-lg-4 my-3 ">
                                                    <label class="labelTitulo">Tipo:</label></br>

                                                    <select id="tipoMantenimientoId" name="tipoMantenimientoId" required
                                                        {{ $mantenimiento->estadoId < 3 ? '' : 'disabled="false"' }}
                                                        class="form-select form-select-lg mb-3 inputCaja"
                                                        aria-label="Default select example">
                                                        <option value="">Seleccione</option>
                                                        @foreach ($vctTipos as $item)
                                                            <option value="{{ $item->id }}"
                                                                {{ $mantenimiento->tipoMantenimientoId == $item->id ? ' selected' : '' }}>
                                                                {{ $item->nombre }}
                                                            </option>
                                                        @endforeach
                                                    </select>

                                                </div>

                                                <div class=" col-12 col-sm-6  col-lg-4 my-3 ">
                                                    <label class="labelTitulo">Código: </label></br>
                                                    <input type="text" class="inputCaja text-end" readonly
                                                        disabled="true" value="{{ $mantenimiento->codigo }}"
                                                        placeholder="Ej. 1" id="codigo" name="codigo">
                                                </div>

                                                <div class=" col-12 col-sm-6  col-lg-4 my-3 ">
                                                    <label class="labelTitulo">Estatus:</label></br>
                                                    <select class="form-select form-select-lg mb-3 inputCaja"
                                                        {{ $mantenimiento->estadoId < 3 ? '' : 'disabled="false"' }}
                                                        name="estadoId" id="estadoId" aria-label=".form-select-lg example">

                                                        <option value="">Seleccione</option>
                                                        <option value="1"
                                                            {{ $mantenimiento->estadoId == 1 ? ' selected' : '' }}>En
                                                            Espera
                                                        </option>
                                                        <option value="2"
                                                            {{ $mantenimiento->estadoId == 2 ? ' selected' : '' }}>
                                                            Realizando
                                                        </option>
                                                        <option value="3"
                                                            {{ $mantenimiento->estadoId == 3 ? ' selected' : '' }}>
                                                            Terminado
                                                        </option>
                                                    </select>
                                                </div>


                                                <div class=" col-12 col-sm-6  col-lg-4 my-3 ">

                                                    <label class="labelTitulo">Uso de la Maquinaría: </label></br>
                                                    <input type="number" class="inputCaja text-end"
                                                        placeholder="Ej. 1000" value="{{ $mantenimiento->usoKom }}"
                                                        step="1" min="0" id="usoKom"
                                                        {{ $mantenimiento->estadoId < 3 ? '' : 'disabled="false"' }}
                                                        name="usoKom">
                                                </div>


                                            </div>
                                        </div>

                                        <div class="col-12 divBorder">
                                            <h2 class="tituloEncabezado">Detalle del Mantenimiento</h2></br></br>
                                        </div>

                                        <div class=" col-12 col-sm-6  col-lg-4 my-3 ">
                                            <label class="labelTitulo">Subtotal: </label></br>
                                            <input type="text" class="inputCaja text-end" readonly
                                                value="{{ $mantenimiento->subtotal }}" placeholder="Ej. 1"
                                                id="subtotal" name="subtotal">
                                        </div>

                                        <div class=" col-12 col-sm-6  col-lg-4 my-3 ">
                                            <label class="labelTitulo">Iva: </label></br>
                                            <input type="text" class="inputCaja text-end" readonly
                                                value="{{ $mantenimiento->iva }}" placeholder="Ej. 1" id="iva"
                                                name="iva">
                                        </div>
                                        <div class=" col-12 col-sm-6  col-lg-4 my-3 ">
                                            <label class="labelTitulo">Total: </label></br>
                                            <input type="text" class="inputCaja text-end" readonly
                                                value="{{ $mantenimiento->costo }}" placeholder="Ej. 1" id="total"
                                                name="total">
                                        </div>

                                        <!--Espacio para asignacion de grupos de tareas y maquinaria-->
                                        <div class="col-12 my-4">
                                            <div class="row">
                                                <div class="card">
                                                    <div class="card-body mb-3">


                                                        <div class="nav nav-tabs justify-content-evenly" id="myTab"
                                                            role="tablist">
                                                            <button
                                                                class=" nav-item col-12 col-md-4 BTNbCargaDescarga py-3 border-0 active "
                                                                role="presentation" id="home-tab" data-bs-toggle="tab"
                                                                data-bs-target="#home-tab-pane" type="button"
                                                                role="tab" aria-controls="home-tab-pane"
                                                                aria-selected="true">Material</button>
                                                            <button class="nav-item col-12 col-md-4 BTNbCargaDescarga "
                                                                role="presentation" id="profile-tab" data-bs-toggle="tab"
                                                                data-bs-target="#profile-tab-pane" type="button"
                                                                role="tab" aria-controls="profile-tab-pane"
                                                                aria-selected="false">Mano de Obra</button>
                                                            <button class="nav-item col-12 col-md-4 BTNbCargaDescarga "
                                                                role="presentation" id="image-tab" data-bs-toggle="tab"
                                                                data-bs-target="#image-tab-pane" type="button"
                                                                role="tab" aria-controls="image-tab-pane"
                                                                aria-selected="false">Fotografías</button>
                                                        </div>

                                                        <div class="tab-content contentCargas" id="myTabContent">
                                                            <div class="tab-pane fade show active" id="home-tab-pane"
                                                                role="tabpanel" aria-labelledby="home-tab"
                                                                tabindex="0">

                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="card">
                                                                            <div class="card-body">
                                                                                <div class="row d-flexpb-4">

                                                                                    @if ($mantenimiento->estadoId < 3)
                                                                                        <div class="row">
                                                                                            <div class="col-12">
                                                                                                <p class="subEncabezado">
                                                                                                    Busca un Material
                                                                                                </p>
                                                                                            </div>
                                                                                            <div class="col-12 mt-3">
                                                                                                <div class=" col-12 col-sm-6"
                                                                                                    role="search"
                                                                                                    class="">
                                                                                                    <select
                                                                                                        class="form-select form-select-lg mb-3 inputCaja"
                                                                                                        name="filter"
                                                                                                        id="filter"
                                                                                                        aria-label=".form-select-lg example">

                                                                                                        <option
                                                                                                            value="">
                                                                                                            Seleccione
                                                                                                        </option>
                                                                                                        <option
                                                                                                            value="consumibles">
                                                                                                            Consumibles
                                                                                                        </option>
                                                                                                        <option
                                                                                                            value="herramientas">
                                                                                                            Herramientas
                                                                                                        </option>
                                                                                                        <option
                                                                                                            value="refacciones">
                                                                                                            Refacciones
                                                                                                        </option>
                                                                                                    </select>
                                                                                                </div>
                                                                                                <div class=" col-12 col-sm-6"
                                                                                                    role="search"
                                                                                                    class="">
                                                                                                    <input value=""
                                                                                                        class="search-submit ">
                                                                                                    <input autofocus
                                                                                                        type="text"
                                                                                                        class="text"
                                                                                                        id="search2"
                                                                                                        name="search2"
                                                                                                        placeholder="Buscar..."
                                                                                                        title="Escriba la(s) palabra(s) a buscar.">
                                                                                                    <input type="button"
                                                                                                        onclick="clearInput('search2')"
                                                                                                        class="btn botonGral"
                                                                                                        value="Borrar">
                                                                                                </div>
                                                                                            </div>

                                                                                        </div>
                                                                                    @endif
                                                                                </div>

                                                                                <div class="my-4 divBorder">
                                                                                    <h3 class="subEncabezado mb-3">
                                                                                        Listado de Material para el
                                                                                        Mantenimiento
                                                                                    </h3>
                                                                                </div>


                                                                                <div class=" col-12  my-3 ">
                                                                                    <ul class="" id="newRow">

                                                                                        <li class="listaMaterialMantenimiento my-3 border-bottom"
                                                                                            id="encabezado">
                                                                                            <div class="row d-flex pb-4">
                                                                                                <div class="col-2 ">
                                                                                                    <label
                                                                                                        class="">Cantidad</label>
                                                                                                </div>
                                                                                                <div class="col-2 ">
                                                                                                    <label
                                                                                                        class="">P.U.</label>
                                                                                                </div>
                                                                                                <div class="col-8">
                                                                                                    <label
                                                                                                        class="">Descripción</label>
                                                                                                </div>
                                                                                            </div>
                                                                                        </li>

                                                                                        @forelse ($gastos as $item)
                                                                                            @if (strtoupper(str_replace(' ', '', trim($item->seccion))) != 'MANODEOBRA')
                                                                                                <li class="listaMaterialMantenimiento my-3 border-bottom"
                                                                                                    id="inputFormRow">
                                                                                                    <div
                                                                                                        class="row d-flex pb-4">

                                                                                                        <input
                                                                                                            type="hidden"
                                                                                                            name="seccion[]"
                                                                                                            id="seccion"
                                                                                                            value="{{ $item->seccion }}">
                                                                                                        <input
                                                                                                            type="hidden"
                                                                                                            name="concepto[]"
                                                                                                            id="concepto"
                                                                                                            value="{{ $item->concepto }}">
                                                                                                        <input
                                                                                                            type="hidden"
                                                                                                            name="numeroParte[]"
                                                                                                            id="numeroParte"
                                                                                                            value="{{ $item->numeroParte }}">

                                                                                                        <input
                                                                                                            type="hidden"
                                                                                                            name="manoObraId[]"
                                                                                                            id="manoObraId"
                                                                                                            value="">

                                                                                                        <input
                                                                                                            type="hidden"
                                                                                                            name="gastoId[]"
                                                                                                            id="gastoId"
                                                                                                            value="{{ $item->id != null ? $item->id : 0 }}">

                                                                                                        <input
                                                                                                            type="hidden"
                                                                                                            name="inventarioId[]"
                                                                                                            id="inventarioId"
                                                                                                            value="{{ $item->inventarioId }}">

                                                                                                        <input
                                                                                                            type="hidden"
                                                                                                            name="costo[]"
                                                                                                            id="costo"
                                                                                                            value="{{ $item->costo }}">

                                                                                                        <div
                                                                                                            class="col-2 ">

                                                                                                            @if ($mantenimiento->estadoId != 3)
                                                                                                                <input
                                                                                                                    onblur="sumarItems()"
                                                                                                                    onchange="sumarItems()"
                                                                                                                    type="number"
                                                                                                                    maxlength="2"
                                                                                                                    min="1"
                                                                                                                    required
                                                                                                                    max="99"
                                                                                                                    step="1"
                                                                                                                    class="inputCaja text-end text-end"
                                                                                                                    id="cantidad"
                                                                                                                    placeholder="Ej. 1"
                                                                                                                    name="cantidad[]"
                                                                                                                    value="{{ $item->cantidad }}">
                                                                                                            @else
                                                                                                                <input
                                                                                                                    type="text"
                                                                                                                    readonly
                                                                                                                    required
                                                                                                                    class="inputCaja text-end"
                                                                                                                    id="cantidad"
                                                                                                                    placeholder="Ej. 1"
                                                                                                                    name="cantidad[]"
                                                                                                                    value="{{ $item->cantidad }}">
                                                                                                            @endif
                                                                                                        </div>

                                                                                                        <div
                                                                                                            class="col-2 ">
                                                                                                            <input
                                                                                                                type="text"
                                                                                                                readonly
                                                                                                                required
                                                                                                                class="inputCaja text-end"
                                                                                                                id="precioUnitario"
                                                                                                                placeholder="Ej. 1"
                                                                                                                name="precioUnitario[]"
                                                                                                                value="$ {{ $item->valor }}">
                                                                                                        </div>

                                                                                                        <div
                                                                                                            class="col-8">

                                                                                                            <textarea rows="2" cols="80" class="form-control form-select" id="descripcion" readonly
                                                                                                                name="descripcion[]" value="">{{ $item->articulo . ', Marca: ' . $item->marca . ', Modelo: ' . $item->modelo }} </textarea>
                                                                                                        </div>

                                                                                                        @if ($mantenimiento->estadoId < 3)
                                                                                                            <div
                                                                                                                class="col-2">
                                                                                                                <button
                                                                                                                    id="removeRow"
                                                                                                                    type="button"
                                                                                                                    class="btn btn-danger">Borrar</button>
                                                                                                            </div>
                                                                                                        @endif
                                                                                                    </div>
                                                                                                </li>
                                                                                            @endif


                                                                                        @empty
                                                                                            <li>Sin registros.</li>
                                                                                        @endforelse

                                                                                    </ul>
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>

                                                            <div class="tab-pane fade" id="profile-tab-pane"
                                                                role="tabpanel" aria-labelledby="profile-tab"
                                                                tabindex="0">

                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="card">
                                                                            <div class="card-body">
                                                                                <div class="row d-flex">

                                                                                    @if ($mantenimiento->estadoId < 3)
                                                                                        <div class="row d-flex">
                                                                                            <div
                                                                                                class="col-12 col-md-6  mt-3 ">
                                                                                                <p class="subEncabezado">
                                                                                                    Busca un Mano de Obra
                                                                                                </p>
                                                                                                <div class="mb-4 mt-0"
                                                                                                    role="search"
                                                                                                    class="">
                                                                                                    <input value=""
                                                                                                        class="search-submit ">
                                                                                                    <input autofocus
                                                                                                        type="text"
                                                                                                        class="text"
                                                                                                        id="search3"
                                                                                                        name="search3"
                                                                                                        placeholder="Buscar..."
                                                                                                        title="Escriba la(s) palabra(s) a buscar.">
                                                                                                    <input type="button"
                                                                                                        onclick="clearInput('search3')"
                                                                                                        class="btn botonGral"
                                                                                                        value="Borrar">
                                                                                                </div>
                                                                                            </div>

                                                                                        </div>
                                                                                    @endif

                                                                                    <div class="my-4 divBorder">
                                                                                        <h3 class="subEncabezado mb-3">
                                                                                            Listado de Mano de Obra para el
                                                                                            Mantenimiento
                                                                                        </h3>
                                                                                    </div>

                                                                                    <div class=" col-12  my-3 ">
                                                                                        <ul class=""
                                                                                            id="newRowMano">

                                                                                            <li class="listaMaterialMantenimiento my-3 border-bottom"
                                                                                                id="encabezado">
                                                                                                <div
                                                                                                    class="row d-flex pb-4">
                                                                                                    <div class="col-2 ">
                                                                                                        <label
                                                                                                            class="">Cantidad</label>
                                                                                                    </div>
                                                                                                    <div class="col-2 ">
                                                                                                        <label
                                                                                                            class="">Costo</label>
                                                                                                    </div>
                                                                                                    <div class="col-6">
                                                                                                        <label
                                                                                                            class="">Descripción</label>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </li>

                                                                                            @forelse ($gastos as $item)
                                                                                                @if (strtoupper(str_replace(' ', '', trim($item->seccion))) == 'MANODEOBRA')
                                                                                                    <li class="listaMaterialMantenimiento my-3 border-bottom"
                                                                                                        id="inputFormRowMano">
                                                                                                        <div
                                                                                                            class="row d-flex pb-4">

                                                                                                            <input
                                                                                                                type="hidden"
                                                                                                                name="seccion[]"
                                                                                                                id="seccion"
                                                                                                                value="{{ $item->seccion }}">

                                                                                                            <input
                                                                                                                type="hidden"
                                                                                                                name="manoObraId[]"
                                                                                                                id="manoObraId"
                                                                                                                value="{{ $item->manoObraId }}">
                                                                                                            <input
                                                                                                                type="hidden"
                                                                                                                name="concepto[]"
                                                                                                                id="concepto"
                                                                                                                value="{{ $item->concepto }}">
                                                                                                            <input
                                                                                                                type="hidden"
                                                                                                                name="numeroParte[]"
                                                                                                                id="numeroParte"
                                                                                                                value="{{ $item->numeroParte }}">

                                                                                                            <input
                                                                                                                type="hidden"
                                                                                                                name="gastoId[]"
                                                                                                                id="gastoId"
                                                                                                                value="{{ $item->id != null ? $item->id : 0 }}">

                                                                                                            <input
                                                                                                                type="hidden"
                                                                                                                name="inventarioId[]"
                                                                                                                id="inventarioId"
                                                                                                                value="{{ $item->inventarioId }}">

                                                                                                            <input
                                                                                                                type="hidden"
                                                                                                                name="costo[]"
                                                                                                                id="costo"
                                                                                                                value="{{ $item->costo }}">

                                                                                                            <div
                                                                                                                class="col-2 ">
                                                                                                                @if ($mantenimiento->estadoId < 3)
                                                                                                                    <input
                                                                                                                        onblur="sumarItems()"
                                                                                                                        onchange="sumarItems()"
                                                                                                                        type="number"
                                                                                                                        maxlength="2"
                                                                                                                        min="1"
                                                                                                                        required
                                                                                                                        max="99"
                                                                                                                        step="1"
                                                                                                                        class="inputCaja text-end"
                                                                                                                        id="cantidad"
                                                                                                                        placeholder="Ej. 1"
                                                                                                                        name="cantidad[]"
                                                                                                                        value="{{ $item->cantidad }}">
                                                                                                                @else
                                                                                                                    <input
                                                                                                                        type="text"
                                                                                                                        readonly
                                                                                                                        required
                                                                                                                        class="inputCaja text-end"
                                                                                                                        id="cantidad"
                                                                                                                        placeholder="Ej. 1"
                                                                                                                        name="cantidad[]"
                                                                                                                        value="{{ $item->cantidad }}">
                                                                                                                @endif
                                                                                                            </div>

                                                                                                            <div
                                                                                                                class="col-2 ">
                                                                                                                <input
                                                                                                                        onblur="sumarItems()"
                                                                                                                        onchange="sumarItems()"
                                                                                                                        type="number"
                                                                                                                        maxlength="10"
                                                                                                                        min="1"
                                                                                                                        required
                                                                                                                        max="99999999"
                                                                                                                        step="1"
                                                                                                                        class="inputCaja text-end"
                                                                                                                        id="precioUnitario"
                                                                                                                        placeholder="Ej. 1"
                                                                                                                        name="precioUnitario[]"
                                                                                                                        value="{{ $item->costo }}">
                                                                                                                {{-- <input
                                                                                                                    type="text"
                                                                                                                    readonly
                                                                                                                    required
                                                                                                                    class="inputCaja text-end"
                                                                                                                    id="precioUnitario"
                                                                                                                    placeholder="Ej. 1"
                                                                                                                    name="precioUnitario[]"
                                                                                                                    value="$ {{ $item->costo }}"> --}}
                                                                                                            </div>

                                                                                                            <div
                                                                                                                class="col-6">
                                                                                                                <textarea rows="2" cols="80" class="form-control form-select" id="descripcion" readonly
                                                                                                                    name="descripcion[]" value="">{{ $item->concepto . ', Código: ' . $item->numeroParte }} </textarea>
                                                                                                            </div>

                                                                                                            @if ($mantenimiento->estadoId < 3)
                                                                                                                <div
                                                                                                                    class="col-2">
                                                                                                                    <button
                                                                                                                        id="removeRowMano"
                                                                                                                        type="button"
                                                                                                                        class="btn btn-danger">Borrar</button>
                                                                                                                </div>
                                                                                                            @endif
                                                                                                        </div>
                                                                                                    </li>
                                                                                                @endif
                                                                                            @empty
                                                                                                <li>Sin registros.</li>
                                                                                            @endforelse

                                                                                        </ul>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>

                                                            </div>
                                                            <div class="tab-pane fade" id="image-tab-pane"
                                                                role="tabpanel" aria-labelledby="image-tab"
                                                                tabindex="0">

                                                                <div class="row">
                                                                    <div class="d-md-flex p-3">
                                                                        <div class="col-12 col-md-12 px-2 ">
                                                                            <div class="text-center mx-auto border  mb-4">

                                                                                <div class="col-12 contFotoMaquinaria"
                                                                                    id="visor">
                                                                                    <img src="{{ empty($fotos[0]) ? '/img/general/default.jpg' : asset('/storage/maquinaria/' . str_pad($maquinaria->identificador, 4, '0', STR_PAD_LEFT) . '/mantenimientos/' . $mantenimiento->codigo . '/' . $fotos[0]->ruta) }}"
                                                                                        class="mx-auto d-block img-fluid imgMaquinaria">
                                                                                </div>
                                                                                {{-- '/public/maquinaria/' . $pathMaquinaria. '/mantenimientos/'. $mantto->codigo --}}
                                                                                <div class="col-12 my-3 d-flex justify-content-start"
                                                                                    id="selectores">
                                                                                    @if (is_null($fotos) == false)
                                                                                        @forelse ($fotos as $foto)
                                                                                            <img onclick="abre(this)"
                                                                                                title="'{{ $maquinaria->nombre }}'."
                                                                                                src="{{ asset('/storage/maquinaria/' . str_pad($maquinaria->identificador, 4, '0', STR_PAD_LEFT) . '/mantenimientos/' . $mantenimiento->codigo . '/' . $foto->ruta) }}"
                                                                                                class="img-fluid mb-5"
                                                                                                id="img{{ $foto->id }}"
                                                                                                style="margin-right:3px; z-index: 2">
                                                                                            <div class="form-group"
                                                                                                style="z-index: 9999 !important">
                                                                                                <div
                                                                                                    class="divButtonImage">
                                                                                                    <button type="button"
                                                                                                        class="btn btn-secondary btn-sm buttonImage"
                                                                                                        id="btnDelete{{ $foto->id }}"
                                                                                                        onclick="esconde_div('{{ $foto->id }}','{{ $fotos }}', (this));">X</button>
                                                                                                </div>
                                                                                            </div>
                                                                                        @empty
                                                                                        @endforelse
                                                                                    @endif
                                                                                </div>

                                                                                @php
                                                                                    $numFotosPermitidas = 0;
                                                                                    $numFotosCargadas = count($fotos);
                                                                                    $maxNumFotos = 10;
                                                                                    $numFotosPermitidas = $maxNumFotos - $numFotosCargadas;
                                                                                @endphp

                                                                                @if ($numFotosPermitidas > 0)
                                                                                    <span class="mi-archivo">
                                                                                        <input class="mb-4 ver "
                                                                                            type="file" name="ruta[]"
                                                                                            id="mi-archivo"
                                                                                            accept="image/*" multiple
                                                                                            data-max="{{ $numFotosPermitidas }}">
                                                                                    </span>
                                                                                    <label for="mi-archivo">
                                                                                        <span class="">Sube Imagen
                                                                                            (Puedes subir hasta
                                                                                            {{ $numFotosPermitidas }}
                                                                                            más)</span>
                                                                                    </label>
                                                                                @else
                                                                                    <label for="mi-archivo"
                                                                                        style="background-color: crimson; cursor: initial;">
                                                                                        <span class="">No puedes
                                                                                            subir más imágenes, <br>ya has
                                                                                            alcanzado el
                                                                                            límite de 10.</span>
                                                                                    </label>
                                                                                @endif
                                                                            </div>

                                                                            <div class="text-center mx-auto border  mb-4">

                                                                            </div>


                                                                            <input type="hidden"
                                                                                name="arrayFotosPersistente"
                                                                                id="arrayFotosPersistente" value="">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>


                                                        </div>

                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 divBorder">
                                            <h2 class="tituloEncabezado">Información de Control</h2></br></br>
                                        </div>

                                        <div class=" col-12 col-sm-6  col-lg-6 my-2 ">
                                            <label class="labelTitulo">Coordinador de Taller:</label></br>

                                            <select id="coordTaller" name="coordTaller"
                                                {{ $mantenimiento->estadoId < 3 ? '' : 'disabled="false"' }}
                                                class="form-select form-select-lg mb-3 inputCaja"
                                                aria-label="Default select example">
                                                {{-- <option value="">Seleccione</option> --}}
                                                @foreach ($vctCoordinadores as $item)
                                                    <option value="{{ $item->nombreCompleto }}"
                                                        {{ $mantenimiento->coordTaller == $item->nombreCompleto ? ' selected' : '' }}>
                                                        {{ $item->personal }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class=" col-12 col-sm-6  col-lg-6 my-2 ">
                                            <label class="labelTitulo">Coordinador de Operaciones:</label></br>

                                            <select id="coordOperaciones" name="coordOperaciones"
                                                {{ $mantenimiento->estadoId < 3 ? '' : 'disabled="false"' }}
                                                class="form-select form-select-lg mb-3 inputCaja"
                                                aria-label="Default select example">
                                                {{-- <option value="">Seleccione</option> --}}
                                                @foreach ($vctCoordinadoresA as $item)
                                                    <option value="{{ $item->nombreCompleto }}"
                                                        {{ $mantenimiento->coordOperaciones == $item->nombreCompleto ? ' selected' : '' }}>
                                                        {{ $item->personal }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class=" col-12 col-sm-6  col-lg-6 my-1 ">
                                            <label class="labelTitulo">Mecánico:</label></br>

                                            <select id="mecanico" name="mecanico"
                                                {{ $mantenimiento->estadoId < 3 ? '' : 'disabled="false"' }}
                                                class="form-select form-select-lg mb-3 inputCaja"
                                                aria-label="Default select example">
                                                <option value="">Seleccione</option>
                                                @foreach ($vctMecanicos as $item)
                                                    <option value="{{ $item->nombreCompleto }}"
                                                        {{ $mantenimiento->mecanico == $item->nombreCompleto ? ' selected' : '' }}>
                                                        {{ $item->personal }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class=" col-12 col-sm-6  col-lg-6 my-1 ">
                                            <label class="labelTitulo">Responsable del Equipo:</label></br>

                                            <select id="responsable" name="responsable"
                                                {{ $mantenimiento->estadoId < 3 ? '' : 'disabled="false"' }}
                                                class="form-select form-select-lg mb-3 inputCaja"
                                                aria-label="Default select example">
                                                <option value="">Seleccione</option>
                                                @if ($mantenimiento->compania == 'mtq')
                                                    @foreach ($vctResidentes as $item)
                                                        <option value="{{ $item->nombre . ' ' . $item->apellido }}"
                                                            {{ $mantenimiento->responsable == $item->nombre . ' ' . $item->apellido ? ' selected' : '' }}>
                                                            {{ $item->nombre . ' ' . $item->apellido }}
                                                        </option>
                                                    @endforeach
                                                @else
                                                    @foreach ($vctResponsables as $item)
                                                        <option value="{{ $item->nombreCompleto }}"
                                                            {{ $mantenimiento->responsable == $item->nombreCompleto ? ' selected' : '' }}>
                                                            {{ $item->personal }}
                                                        </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>

                                        <div class="col-12 text-center">
                                            <label class="labelTitulo">Observaciones:</label></br>
                                            <textarea rows="2" cols="80" class="form-control"
                                                {{ $mantenimiento->estadoId < 3 ? '' : 'disabled="false"' }}
                                                placeholder="Escribe tus observaciones y comentarios sobre la ejecución del mantenimiento aquí."
                                                name="observaciones" id="observaciones">{{ $mantenimiento->observaciones }}</textarea>
                                        </div>

                                        <div class="col-12 text-center mt-1 pt-1">
                                            <a href="{{ route('mantenimientos.index') }}">
                                                <button class="btn regresar" name="guardar" value="0">
                                                    <span class="material-icons">
                                                        reply
                                                    </span>
                                                    Regresar
                                                </button>
                                            </a>
                                            @if ($mantenimiento->estadoId < 3)
                                                <button type="submit" name="guardar" value="1"
                                                    class="btn botonGral">Guardar</button>

                                                <button type="submit" name="guardar" value="2"
                                                    class="btn   btn-warning"
                                                    title="Clic para terminar el Mantenimiento">Terminar</button>
                                            @endif
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E="
        crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    {{-- <script src="{{ asset('vendor/jquery-ui/jquery-ui.min.js') }}"></script> --}}

    <script>
        function clearInput(controlId) {
            var getValue = document.getElementById(controlId);
            if (getValue.value != "") {
                getValue.value = "";
                getValue.focus();
            }
        }

        function sumarItems() {

            let arrCantidad = document.getElementsByName('cantidad[]');
            let arrValor = document.getElementsByName('costo[]');
            let decSubtotal = 0;
            let decIva = 0;
            let decTotal = 0;

            for (var i = 0; i < arrCantidad.length; i++) {
                let intCantidad = parseFloat(document.getElementsByName('cantidad[]')[i].value).toFixed(2);
                let intValor = parseFloat(document.getElementsByName('costo[]')[i].value).toFixed(2);
                decSubtotal += intCantidad * intValor;
                console.log(intCantidad + ' x ' + intValor + ' = ' + (intCantidad * intValor));
            }

            decIva = decSubtotal * 0.16;
            decTotal =  decSubtotal + decIva ;

            console.log('Subtotal: ' + decSubtotal);
            console.log('Iva: ' + decIva);
            console.log('Total: ' + decTotal);

            var txtSubtotal = document.getElementById('subtotal');
            txtSubtotal.value = parseFloat(decSubtotal).toFixed(2);

            var txtIva = document.getElementById('iva');
            txtIva.value = parseFloat(decIva).toFixed(2);

            var txtTotal = document.getElementById('total');
            txtTotal.value = parseFloat(decTotal).toFixed(2);

        }


        var curso = ['html', 'hola', 'hi'];

        $('#search').autocomplete({

            source: function(request, response) {
                $.ajax({
                    url: "{{ route('search.equipos') }}",

                    dataType: 'json',
                    data: {
                        term: request.term,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        response(data);
                    }
                });
            },
            minChars: 1,
            width: 402,
            matchContains: "word",
            autoFill: true,
            minLength: 1,
            select: function(event, ui) {

                // Rellenar los campos con los datos de la persona seleccionada
                $('#maquinariaId').val(ui.item.id);
                $('#nombre').val(ui.item.nombre);
                $('#marca').val(ui.item.marca);
                $('#modelo').val(ui.item.modelo);
                $('#numserie').val(ui.item.numserie);
                $('#placas').val(ui.item.placas);
                $('#titulo').val(ui.item.nombre);
            }

        });

        const ListaSeleccionar = document.getElementById('filter');

        $('#search2').autocomplete({

            source: function(request, response) {


                $.ajax({
                    url: "{{ route('search.materialMantenimiento') }}",

                    dataType: 'json',
                    data: {
                        term: request.term,
                        filter: ListaSeleccionar.value,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        response(data);
                    }
                });
            },
            minChars: 1,
            width: 402,
            matchContains: "word",
            autoFill: true,
            minLength: 1,
            select: function(event, ui) {
                // Rellenar los campos con los datos del inventario seleccionado
                crearItems(ui.item.id, ui.item.value, ui.item.nombre, ui.item.numparte, ui.item.valor, ui.item
                    .tipo);

                // $('#inventarioId').val(ui.item.id);
                // $('#descripcion').val(ui.item.value);
            }

        });

        $('#search3').autocomplete({

            source: function(request, response) {
                $.ajax({
                    url: "{{ route('search.manoDeObra') }}",

                    dataType: 'json',
                    data: {
                        term: request.term,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        response(data);
                    }
                });
            },
            minChars: 1,
            width: 402,
            matchContains: "word",
            autoFill: true,
            minLength: 1,
            select: function(event, ui) {
                // Rellenar los campos con los datos del inventario seleccionado
                crearItemMano(ui.item.id, ui.item.value, ui.item.nombre, ui.item.numparte, ui.item.valor, ui
                    .item
                    .tipo);

                // $('#inventarioId').val(ui.item.id);
                // $('#descripcion').val(ui.item.value);
            }

        });
    </script>

    <script type="text/javascript">
        function crearItems(inventarioId, descripcion, concepto, numparte, costo, tipo) {
            var html = '';
            html += '<li class="listaMaterialMantenimiento my-3 border-bottom" id="inputFormRow">';
            html += '   <div class="row d-flex pb-4">';
            html += '      <input type="hidden" name="gastoId[]" id="gastoId" value="">';
            html += '      <input type="hidden" name="inventarioId[]" id="inventarioId" value="' + inventarioId + '">';
            html += '      <input type="hidden" name="manoObraId[]" id="manoObraId" value="">';
            html += '      <input type="hidden" name="costo[]" id="costo" value="' + costo + '">';
            html += '      <input type="hidden" name="seccion[]" id="seccion" value="' + tipo + '">';
            html += '      <input type="hidden" name="concepto[]" id="concepto" value="' + concepto + '">';
            html += '      <input type="hidden" name="numeroParte[]" id="numeroParte" value="' + numparte + '">';
            html += '      <div class="col-2 ">';
            html +=
                '           <input type="number" maxlength="2" min="1" required max="99" step="1" class="inputCaja text-end" id="cantidad" placeholder="Ej. 1" name="cantidad[]" value="" onchange="sumarItems()" onblur="sumarItems()">';
            html += '      </div>';
            html += '      <div class="col-2 ">';
            html +=
                '           <input type="text" class="inputCaja text-end" id="precioUnitario" placeholder="Ej. 1" name="precioUnitario[]" value="$ ' +
                costo + '">';
            html += '      </div>';
            html += '      <div class="col-6">';
            html +=
                '          <textarea rows="2" cols="80" class="form-control form-select" id="descripcion" readonly name="descripcion[]" value="">' +
                descripcion + '</textarea>';
            html += '      </div>';
            html += '      <div class="col-2">';
            html += '         <button id="removeRow" type="button" class="btn btn-danger">Borrar</button>';
            html += '      </div>';
            html += '    </div>';
            html += '</li>';

            $('#newRow').append(html);
        }


        // borrar registro
        $(document).on('click', '#removeRow', function() {
            $(this).closest('#inputFormRow').remove();
            sumarItems();
        });
    </script>

    <script type="text/javascript">
        function crearItemMano(inventarioId, descripcion, concepto, numparte, costo, tipo) {
            var html = '';
            html += '<li class="listaMaterialMantenimiento my-3 border-bottom" id="inputFormRowMano">';
            html += '   <div class="row d-flex pb-4">';
            html += '      <input type="hidden" name="gastoId[]" id="gastoId" value="">';
            html += '      <input type="hidden" name="inventarioId[]" id="inventarioId" value="">';
            html += '      <input type="hidden" name="manoObraId[]" id="manoObraId" value="' + inventarioId + '">';
            html += '      <input type="hidden" name="costo[]" id="costo" value="' + costo + '">';
            html += '      <input type="hidden" name="seccion[]" id="seccion" value="' + tipo + '">';
            html += '      <input type="hidden" name="concepto[]" id="concepto" value="' + concepto + '">';
            html += '      <input type="hidden" name="numeroParte[]" id="numeroParte" value="' + numparte + '">';
            html += '      <div class="col-2 ">';
            html +=
                '           <input type="number" maxlength="2" min="1" required max="99" step="1" class="inputCaja text-end" id="cantidad" placeholder="Ej. 1" name="cantidad[]" value="" onchange="sumarItems()" onblur="sumarItems()" >';
            html += '      </div>';
            html += '      <div class="col-2 ">';
            html +=
                '           <input type="text" class="inputCaja text-end" id="precioUnitario" placeholder="Ej. 1" name="precioUnitario[]" value="$ ' +
                costo + '">';
            html += '      </div>';

            html += '      <div class="col-6">';
            html +=
                '          <textarea rows="2" cols="80" class="form-control form-select" id="descripcion" readonly name="descripcion[]" value="">' +
                descripcion + '</textarea>';
            html += '      </div>';
            html += '      <div class="col-2">';
            html += '         <button id="removeRowMano" type="button" class="btn btn-danger">Borrar</button>';
            html += '      </div>';
            html += '    </div>';
            html += '</li>';

            $('#newRowMano').append(html);
        }


        // borrar registro
        $(document).on('click', '#removeRowMano', function() {
            $(this).closest('#inputFormRowMano').remove();
            sumarItems();
        });
    </script>

    <script>
        function abre(T) {
            var ruta = T.src.replace("/s90-Ic42/", "/s590-Ic42/");
            document.querySelector("#visor img").src = ruta;
        }
    </script>

    <style>
        /* Macbook Pro / laptop */
        @media only screen and (min-width: 992px) and (max-width: 1440px) {

            /*ALta maquinaria*/
            .inputNumberKilometrajeEdit {
                width: 35%;
            }

            .inputKilometrajeEdit {
                width: 65%;
                font-size: 11px;
            }
        }
    </style>

    <script src="{{ asset('js/cardArchivos.js') }}"></script>

    <script>
        function deleteImage(id, fotos, button) {
            console.log('ID de imagen', id);
            let jsonFotos = JSON.parse(fotos);
            console.log('Fotos', jsonFotos);
            var childDiv = document.getElementById('selectores').firstChild;

            //var parentDiv = button.parentNode.parentNode.parentNode;

            var childDiv = button.parentNode.parentNode.parentNode;

            // Modificar el selector para que coincida con la clase de la imagen
            var imageElement = childDiv.querySelector("img.img-fluid");
            var parentDivButton = button.parentNode.parentNode;
            var imageId = imageElement.id;
            console.log('imageElement', imageElement);

            // Cambiar la imagen que se muestra
            if (imageElement) {

            }
        }

        // Inicializar arrayFotosPersistente
        let arrayFotosPersistente = [];

        // Función para inicializar el arreglo persistente con el arreglo original
        // function inicializarArrayFotos(fotos) {
        //     arrayFotosPersistente = JSON.parse(fotos);
        //     console.log('HOLA',arrayFotosPersistente);
        // }

        function esconde_div(id, fotos, button) {

            console.log('fotos', fotos);
            let arrayFotos = JSON.parse(fotos);
            const index = arrayFotos.findIndex((foto) => foto.id == id);

            // Si se encontró el objeto con el id coincidente, eliminarlo del array
            if (index !== -1) {
                arrayFotosPersistente.push(arrayFotos[index]);

            } else {
                console.log('El id no se encontró en arrayFotosPersistente.');
            }
            console.log('arrayFotosPersistente', arrayFotosPersistente);
            var parentDiv = button.parentNode.parentNode.parentNode;
            // Modificar el selector para que coincida con la clase de la imagen
            var imageElement = parentDiv.querySelector("img.img-fluid");
            var deleteButton = document.getElementById('btnDelete' + id);
            var imageElement = document.getElementById("img" + id);


            // Ocultar el elemento padre
            imageElement.style.visibility = "hidden";
            deleteButton.style.visibility = "hidden";

            const arrayFotosPersistenteHidden = document.getElementById('arrayFotosPersistente');
            arrayFotosPersistenteHidden.value = JSON.stringify(arrayFotosPersistente);
        }
        // $.ajax({
        //     type: 'put',
        //     url: '/maquinaria/imagen/delete',
        //     data: {
        //         "_token": "{{ csrf_token() }}",
        //         "id": id
        //     },
        //     success: function(data) {
        //         console.log('Funciona');
        //     },
        //     error: function() {
        //         console.log('Error');
        //     }
        // });
    </script>

@endsection
