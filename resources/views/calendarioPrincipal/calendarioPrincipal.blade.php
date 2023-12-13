@extends('layouts.main', ['activePage' => 'calendario', 'titlePage' => __('Calendario')])
@section('content')

    <head>
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.5/main.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.5/locales/es.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.5/main.css">
        <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E="
            crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
        <!-- Bootstrap CSS v5.2.1 -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
        <!-- CSS Personalizado MTQ -->
        <link rel="stylesheet" type="text/css" href="{{ asset('css/calendarMtq.css') }}">
    </head>

    <div class="content">
        <div class="row">
            <label class="labelTitulo" style="padding-left: 1.50rem !important">Tipo de Evento: </label>
            <div class="col-4 text-left mb-1" style="margin-left: 12px">
                <select id="filtroTipoEvento" class="filtroTipoEvento">
                    <option value="todos" selected>Todos</option>
                    <option value="EventoImportante">Eventos Importantes</option>
                    <option value="ExpiranDocumentos">Expiración de Documentos</option>
                    <option value="DiaFeriado">Días Feriados</option>
                    <option value="actividades">Actividades</option>
                    <option value="solicitud">Solicitudes</option>
                </select>
            </div>
            <div class="col-4">
                <span>
                    <div
                        class="display-8 text-start tituloPrincipalCentrado" title="Ir al periodo en curso" style="color: #5C7C26; font-size: 24px"><b>CALENDARIO: GENERAL Q2CES</b></div>
                </span>
            </div>
            <div class="col-4 text-end mb-1" style="margin-left: -25px;">
                @can('calendarioPrincipal_create')
                    <button data-bs-toggle="modal" data-bs-target="#myModal" type="button" class="btn botonGral">Añadir
                        al Calendario</button>
                    @php
                        $anoActual = date('Y');
                    @endphp
                    {{--  <button onclick="generarDiasFeriados({{$anoActual}})" type="button" class="btn botonGral">Generar Dias Feriados del Año Actual</button>  --}}
                @endcan
            </div>
        </div>
        <div class="container-fluid">

            <div id='calendar'></div>

            <!-- Modal Body-->
            <div class="modal fade" id="myModalEditMantenimiento" tabindex="-1" aria-labelledby="modalTitleId"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header bacTituloPrincipal">
                            <h5 class="modal-title fs-5" id="modalTitleId">&nbsp <span id="tituloModal">Ver Mantenimiento
                            </h5>
                            <button type="button" class="btn-close align-self-end" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            <div class="container-fluid">
                                <form action="{{ route('calendarioPrincipal.update', 0) }}" method="post">
                                    @csrf
                                    @method('put')
                                    <!-- <div class="mb-3">
                                        <label for="id" class="form-label">ID:</label>
                                        <input type="text"
                                        class="form-control" name="id" id="id" aria-describedby="helpId" placeholder="ID">
                                    </div> -->
                                    <input type="hidden" name="id" value="" id="id">
                                    <input type="hidden" id="maquinariaIdEdit" name="maquinariaId">
                                    <input type="hidden" id="colorBoxHiddenEdit" name="color" value="">

                                    <div class="row">
                                        <div class="mb-3 col-11" role="search">
                                            <label for="title" class="labelTitulo">Buscador Equipo:</label>
                                            <input autofocus type="text" class="inputCaja" id="searchSEdit"
                                                name="search" placeholder="Buscar Equipo..."
                                                title="Escriba la(s) palabra(s) a buscar." readonly>
                                        </div>
                                        <div class="col-1 mt-4">
                                            @can('calendarioPrincipal_edit')
                                                <div id="editarCampos">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28"
                                                        fill="currentColor" class="bi bi-pencil accionesIconos"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                                                    </svg>
                                                </div>
                                            @endcan
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="mb-3 col-6">
                                            <label for="title" class="labelTitulo">Nombre:</label>
                                            <input autofocus type="text" class="inputCaja" id="nombreEdit"
                                                name="nombre" placeholder="Nombre Equipo..." readonly>
                                        </div>

                                        <div class="mb-3 col-6">
                                            <label for="title" class="labelTitulo">Número Económico:</label>
                                            <input autofocus type="text" class="inputCaja" id="numeconomicoEdit"
                                                name="numeconomico" placeholder="Del Equipo..." readonly>
                                        </div>

                                        <div class="mb-3 col-6">
                                            <label for="title" class="labelTitulo">Placas:</label>
                                            <input autofocus type="text" class="inputCaja" id="placasEdit"
                                                name="placas" placeholder="Placas Equipo..." readonly>
                                        </div>

                                        <div class="mb-3 col-6">
                                            <label for="title" class="labelTitulo">Marca:</label>
                                                <select name='marca'
                                                class="form-select" id="marcaEdit" placeholder="Marca Equipo..." readonly>
                                                <option value="">Seleccione</option>
                                                @foreach ($marca as $item)
                                                    <option value="{{ $item->id }}">
                                                        {{ $item->nombre }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                    <div class="mb-3">
                                        <label for="title" class="labelTitulo">Mantenimiento:</label>
                                        <select name="tipoMantenimientoId" id="titleSelectEdit" required class="form-select"
                                            readonly>
                                            <option value="">Seleccione</option>
                                                @foreach ($tiposMantenimiento as $item)
                                                    <option value="{{ $item->id }}" data-color="{{ $item->color }}">
                                                        {{ $item->nombre }}
                                                    </option>
                                                @endforeach
                                        </select>
                                    </div>

                                    <div class="col-12 col-sm-6 mb-3 ">
                                        <label class="labelTitulo">Responsable:</label></br>
                                        <select readonly class="form-select form-select-lg mb-3 inputCaja" name="personalId" id="responsableEdit"
                                            aria-label=".form-select-lg example">
                                            <option value="">Seleccione</option>
                                            @foreach ($personal as $item)
                                                <option value="{{ $item->id }}">
                                                    {{ $item->nombres . ' ' . $item->apellidoP }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-12 col-sm-6 mb-3">
                                        <label for="title" class="labelTitulo">Estado de la Solicitud*:</label>
                                        <select readonly name="estadoId" id="estadoSelectMantenimiento" required class="form-select">
                                            <option value="1" selected>En Espera</option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="color" class="labelTitulo">Color:</label>
                                        <div id="colorBoxEdit" class="color-box w-100" style="margin-left:-0.5px"></div>
                                    </div>


                                        <div class="mb-3 col-6">
                                            <label for="fecha" class="labelTitulo">Fecha de Llegada:</label>
                                            <input type="date" class="inputCaja" name="fecha" id="fechaEdit"
                                                aria-describedby="helpId" placeholder="Fecha" readonly>
                                        </div>

                                        <div class="mb-3 col-6">
                                            <label for="hora" class="labelTitulo">Hora de Llegada:</label>
                                            <input type="time" class="inputCaja" name="hora" id="horaEdit"
                                                aria-describedby="helpId" placeholder="Fecha" readonly>
                                        </div>

                                        <div class="mb-3 col-6">
                                            <label for="fecha" class="labelTitulo">Fecha de Salida:</label>
                                            <input type="date" class="inputCaja" name="fechaSalida" id="fechaSalida"
                                                aria-describedby="helpId" placeholder="Fecha" readonly>
                                        </div>

                                        <div class="mb-3 col-6">
                                            <label for="hora" class="labelTitulo">Hora de Salida:</label>
                                            <input type="time" class="inputCaja" name="horaSalida" id="horaSalida"
                                                aria-describedby="helpId" placeholder="Fecha" readonly>
                                        </div>

                                    <div class="mb-3">
                                        <label for="descripcion" class="labelTitulo">Descripción:</label>
                                        <textarea class="form-control-textarea border-green" name="descripcion" id="descripcionEdit" rows="3"
                                            placeholder="Especifique..." readonly></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <div id="contenedorBotonGuardar" style="display:none">
                                <button type="submit" class="btn botonGral">Guardar</button>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Modal Edit Solicitud-->
            <div class="modal fade" id="myModalEditSolicitud" tabindex="-1" aria-labelledby="modalTitleId"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header bacTituloPrincipal">
                            <h5 class="modal-title fs-5" id="modalTitleIdSolicitud">&nbsp <span id="tituloModal">Ver Solicitud
                            </h5>
                            <button type="button" class="btn-close align-self-end" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            <div class="container-fluid">
                                <form action="{{ route('solicitudes.update', 0) }}" method="post">
                                    @csrf
                                    @method('put')
                                    <!-- <div class="mb-3">
                                        <label for="id" class="form-label">ID:</label>
                                        <input type="text"
                                        class="form-control" name="id" id="id" aria-describedby="helpId" placeholder="ID">
                                    </div> -->
                                    <input type="hidden" name="id" value="" id="idSolicitud">
                                    <input type="hidden" name="solicitudIdDetalle" value="" id="solicitudIdDetalle">
                                    <input type="hidden" id="maquinariaIdEditSolicitud" name="maquinariaId">
                                    <input type="hidden" id="colorBoxHiddenSolicitudEdit" name="color" value="">

                                    <div class="row">

                                        <div class="col-11 mb-3">
                                            <label for="title" class="labelTitulo">Título:</label>
                                            <input autofocus type="text" class="inputCaja" name="title" id="titleEditSolicitud"
                                                placeholder="Título de Tarea..." title="Escriba El Título de la Tarea." readonly>
                                        </div>
                                        <div class="col-1 mt-4">
                                            @can('calendarioPrincipal_edit')
                                                <div id="editarCamposSolicitud">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28"
                                                        fill="currentColor" class="bi bi-pencil accionesIconos"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                                                    </svg>
                                                </div>
                                            @endcan
                                        </div>
                                        <div class="mb-3 col-12" role="search">
                                            <label for="title" class="labelTitulo">Buscador Equipo:</label>
                                            <input autofocus type="text" class="inputCaja" id="searchSEditSolicitud"
                                                name="search" placeholder="Buscar Equipo..."
                                                title="Escriba la(s) palabra(s) a buscar." readonly>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="mb-3 col-6">
                                            <label for="title" class="labelTitulo">Nombre:</label>
                                            <input autofocus type="text" class="inputCaja" id="nombreEditSolicitud"
                                                name="nombre" placeholder="Nombre Equipo..." readonly>
                                        </div>

                                        <div class="mb-3 col-6">
                                            <label for="title" class="labelTitulo">Número Económico:</label>
                                            <input autofocus type="text" class="inputCaja" id="numeconomicoEditSolicitud"
                                                name="numeconomico" placeholder="Del Equipo..." readonly>
                                        </div>

                                        <div class="mb-3 col-6">
                                            <label for="title" class="labelTitulo">Placas:</label>
                                            <input autofocus type="text" class="inputCaja" id="placasEditSolicitud"
                                                name="placas" placeholder="Placas Equipo..." readonly>
                                        </div>

                                        <div class="mb-3 col-6">
                                            <label for="title" class="labelTitulo">Marca:</label>
                                                <select name='marca'
                                                class="form-select" id="marcaEditSolicitud" placeholder="Marca Equipo..." readonly>
                                                <option value="">Seleccione</option>
                                                @foreach ($marca as $item)
                                                    <option value="{{ $item->id }}">
                                                        {{ $item->nombre }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-12 col-sm-6 mb-3">
                                            <label for="prioridad" class="labelTitulo">Prioridad: * </label>
                                        <select name="prioridad" readonly id="prioridadEditSolicitud" required class="form-select">
                                            <option value="">Seleccione</option>
                                                <option value="Urgente">
                                                    Urgente
                                                </option>
                                                <option value="Necesaria">
                                                    Necesaria
                                                </option>
                                                <option value="Deseable">
                                                    Deseable
                                                </option>
                                                <option value="Prorrogable">
                                                    Prorrogable
                                                </option>
                                        </select>
                                        </div>

                                    <div class="col-12 col-sm-6 mb-3 ">
                                        <label class="labelTitulo">Responsable:</label></br>
                                        <select readonly class="form-select form-select-lg mb-3 inputCaja" name="personalId" id="responsableEditSolicitud"
                                            aria-label=".form-select-lg example">
                                            <option value="">Seleccione</option>
                                            @foreach ($personal as $item)
                                                <option value="{{ $item->id }}">
                                                    {{ $item->nombres . ' ' . $item->apellidoP }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-12 col-sm-6 mb-3">
                                        <label for="title" class="labelTitulo">Estado de la Solicitud*:</label>
                                        <select readonly name="estadoId" id="estadoSelectMantenimiento" required class="form-select">
                                            <option value="1" selected>En Espera</option>
                                        </select>
                                    </div>
                                    <div class="mb-3 col-12 col-sm-6">
                                        <label for="title" class="labelTitulo">Funcionalidad del Equipo*:</label>
                                        <select readonly name="funcionalidad" id="funcionalidadSolicitud" required class="form-select">
                                            <option value="">Seleccione</option>
                                            <option value="No Funciona" selected>No Funciona</option>
                                            <option value="Funciona Poco" selected>Funciona Poco</option>
                                            <option value="Funciona" selected>Funciona</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="color" class="labelTitulo">Color:</label>
                                        <div id="colorBoxEditSolicitud" class="color-box w-100" style="margin-left:-0.5px"></div>
                                    </div>


                                        <div class="mb-3 col-6">
                                            <label for="fecha" class="labelTitulo">Fecha de Inicio del Requerimiento:</label>
                                            <input type="date" class="inputCaja" name="fecha" id="fechaEditSolicitud"
                                                aria-describedby="helpId" placeholder="Fecha" readonly>
                                        </div>

                                        <div class="mb-3 col-6">
                                            <label for="hora" class="labelTitulo">Hora de Inicio del Requerimiento:</label>
                                            <input type="time" class="inputCaja" name="hora" id="horaEditSolicitud"
                                                aria-describedby="helpId" placeholder="Fecha" readonly>
                                        </div>

                                        <div class="mb-3 col-6">
                                            <label for="fecha" class="labelTitulo">Fecha de Fin del Requerimiento:</label>
                                            <input type="date" class="inputCaja" name="fechaSalida" id="fechaSalidaSolicitud"
                                                aria-describedby="helpId" placeholder="Fecha" readonly>
                                        </div>

                                        <div class="mb-3 col-6">
                                            <label for="hora" class="labelTitulo">Hora de Fin del Requerimiento:</label>
                                            <input type="time" class="inputCaja" name="horaSalida" id="horaSalidaSolicitud"
                                                aria-describedby="helpId" placeholder="Fecha" readonly>
                                        </div>

                                    <div class="mb-3">
                                        <label for="descripcion" class="labelTitulo">Descripción:</label>
                                        <textarea class="form-control-textarea border-green" name="descripcion" id="descripcionEditSolicitud" rows="3"
                                            placeholder="Especifique..." readonly></textarea>
                                    </div>
                                    <div class="mb-3 text-center" id="solicitudDetalleSeccion">
                                        <div id="labelReparacion" style="display: none; background:#5c7c26 !important; color:white">
                                            <h3 style="font-weight: bold !important;">Reparaciónes</h3>
                                        </div>

                                        <div id="labelReparacionCombustible" style="display: none; background:#5c7c26 !important; color:white">
                                            <h3 style="font-weight: bold !important;">Combustibles</h3>
                                        </div>

                                        <div id="labelReparacionHerramienta" style="display: none; background:#5c7c26 !important; color:white">
                                            <h3 style="font-weight: bold !important;">Herramientas</h3>
                                        </div>

                                        <div id="labelReparacionRefaccion" style="display: none; background:#5c7c26 !important; color:white">
                                            <h3 style="font-weight: bold !important;">Refacciónes</h3>
                                        </div>
                                        <div class="line"></div>
                                        <div id="detalleSolicitud"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <div id="contenedorBotonGuardarSolicitud" style="display:none">
                                <button type="submit" class="btn botonGral">Guardar</button>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="myModalEditActividad" tabindex="-1" aria-labelledby="modalTitleActividadId"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header bacTituloPrincipal">
                            <h5 class="modal-title fs-5" id="modalTitleId">&nbsp <span id="tituloModalActividad">Ver Actividad
                            </h5>
                            <button type="button" class="btn-close align-self-end" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            <div class="container-fluid">
                                <form action="{{ route('actividades.update', 0) }}" method="post">
                                    @csrf
                                    @method('put')
                                    <!-- <div class="mb-3">
                                        <label for="id" class="form-label">ID:</label>
                                        <input type="text"
                                        class="form-control" name="id" id="id" aria-describedby="helpId" placeholder="ID">
                                    </div> -->
                                    <input type="hidden" name="id" value="" id="idTareaModal">
                                    <input type="hidden" id="colorBoxHiddenEditTarea" name="color" value="">

                                    <div class="row">
                                        <input type="hidden" id="colorBoxHiddenTareaEdit" name="color" value="">
                                        <div class="col-12 col-sm-6 mb-3">
                                            <label for="title" class="labelTitulo">Título:</label>
                                            <input autofocus type="text" class="inputCaja" name="title" id="titleEditTarea"
                                                placeholder="Título de Tarea..." title="Escriba El Título de la Tarea." readonly>
                                        </div>

                                        <div class="col-11 col-sm-5 mb-3">
                                            <label for="prioridad" class="labelTitulo">Prioridad: * </label>
                                        <select name="prioridad" readonly id="prioridadEditTarea" required class="form-select">
                                            <option value="">Seleccione</option>
                                                <option value="Urgente">
                                                    Urgente
                                                </option>
                                                <option value="Necesaria">
                                                    Necesaria
                                                </option>
                                                <option value="Deseable">
                                                    Deseable
                                                </option>
                                                <option value="Prorrogable">
                                                    Prorrogable
                                                </option>
                                        </select>
                                        </div>

                                        <div class="col-1 mt-4">
                                            @can('calendarioPrincipal_edit')
                                                <div id="editarCamposTarea">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28"
                                                        fill="currentColor" class="bi bi-pencil accionesIconos"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                                                    </svg>
                                                </div>
                                            @endcan
                                        </div>
                                    </div>

                                    <div class="row">

                                    <div class="col-12 col-sm-6 mb-3 ">
                                        <label class="labelTitulo">Responsable:</label></br>
                                        <select readonly class="form-select form-select-lg mb-3 inputCaja" name="personalId" id="responsableEditTarea"
                                            aria-label=".form-select-lg example">
                                            <option value="">Seleccione</option>
                                            @foreach ($personal as $item)
                                                <option value="{{ $item->id }}">
                                                    {{ $item->nombres . ' ' . $item->apellidoP }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-12 col-sm-6 mb-3">
                                        <label for="title" class="labelTitulo">Estado de la Solicitud*:</label>
                                        <select readonly name="estadoId" id="estadoIdTarea" required class="form-select">
                                            <option value="1" selected>En Espera</option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="color" class="labelTitulo">Color:</label>
                                        <div id="colorBoxEditTarea" class="color-box w-100" style="margin-left:-0.5px"></div>
                                    </div>

                                    <div class="mb-3 col-6">
                                        <label for="fecha" class="labelTitulo">Fecha de Inicio para la tarea:</label>
                                        <input type="date" class="inputCaja" name="fecha" id="fechaEditTarea"
                                            aria-describedby="helpId" placeholder="Fecha" readonly>
                                    </div>

                                    <div class="mb-3 col-6">
                                        <label for="hora" class="labelTitulo">Hora de Inicio para la tarea:</label>
                                        <input type="time" class="inputCaja" name="hora" id="horaEditTarea"
                                            aria-describedby="helpId" placeholder="Fecha" readonly>
                                    </div>

                                    <div class="mb-3 col-6">
                                        <label for="fecha" class="labelTitulo">Fecha de Termino para la tarea:</label>
                                        <input type="date" class="inputCaja" name="fechaSalida" id="fechaSalidaTarea"
                                            aria-describedby="helpId" placeholder="Fecha" readonly>
                                    </div>

                                    <div class="mb-3 col-6">
                                        <label for="hora" class="labelTitulo">Hora de Termino para la tarea:</label>
                                        <input type="time" class="inputCaja" name="horaSalida" id="horaSalidaTarea"
                                            aria-describedby="helpId" placeholder="Fecha" readonly>
                                    </div>

                                    <div class="mb-3">
                                        <label for="descripcion" class="labelTitulo">Descripción:</label>
                                        <textarea class="form-control-textarea border-green" name="descripcion" id="descripcionEditTarea" rows="3"
                                            placeholder="Especifique..." readonly></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <div id="contenedorBotonGuardarTarea" style="display:none">
                                <button type="submit" class="btn botonGral">Guardar</button>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="myModalEditEventoImportante" tabindex="-1" aria-labelledby="modalTitleEventoImportanteId"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header bacTituloPrincipal">
                            <h5 class="modal-title fs-5" id="modalTitleId">&nbsp <span id="tituloModalEventoImportante">Ver Evento Importante
                            </h5>
                            <button type="button" class="btn-close align-self-end" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            <div class="container-fluid">
                                <form action="{{ route('eventosImportantes.update', 0) }}" method="post">
                                    @csrf
                                    @method('put')
                                    <!-- <div class="mb-3">
                                        <label for="id" class="form-label">ID:</label>
                                        <input type="text"
                                        class="form-control" name="id" id="id" aria-describedby="helpId" placeholder="ID">
                                    </div> -->
                                    <input type="hidden" name="id" value="" id="idEventoImportanteModal">
                                    <input type="hidden" id="colorBoxHiddenEditEventoImportante" name="color" value="">

                                    <div class="row">
                                        <input type="hidden" id="colorBoxHiddenEventoImportanteEdit" name="color" value="">
                                        <div class="col-11 mb-3">
                                            <label for="title" class="labelTitulo">Título:</label>
                                            <input autofocus type="text" class="inputCaja" name="title" id="titleEditEventoImportante"
                                                placeholder="Título de EventoImportante..." title="Escriba El Título de la EventoImportante." readonly>
                                        </div>

                                        <div class="col-1 mt-4">
                                            @can('calendarioPrincipal_edit')
                                                <div id="editarCamposEventoImportante">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28"
                                                        fill="currentColor" class="bi bi-pencil accionesIconos"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                                                    </svg>
                                                </div>
                                            @endcan
                                        </div>
                                    </div>

                                    <div class="row">

                                    <div class="mb-3">
                                        <label for="color" class="labelTitulo">Color:</label>
                                        <div id="colorBoxEditEventoImportante" class="color-box w-100" style="margin-left:-0.5px; background: #8a8a8a"></div>
                                    </div>

                                        <div class="mb-3 col-6">
                                            <label for="fecha" class="labelTitulo">Fecha Inicio:</label>
                                            <input type="date" class="inputCaja" name="fecha" id="fechaEditEventoImportante"
                                                aria-describedby="helpId" placeholder="Fecha" readonly>
                                        </div>

                                        <div class="mb-3 col-6">
                                            <label for="hora" class="labelTitulo">Hora Inicio:</label>
                                            <input type="time" class="inputCaja" name="hora" id="horaEditEventoImportante"
                                                aria-describedby="helpId" placeholder="Fecha" readonly>
                                        </div>

                                        <div class="mb-3 col-6">
                                            <label for="fecha" class="labelTitulo">Fecha Termino:</label>
                                            <input type="date" class="inputCaja" name="fechaSalida" id="fechaSalidaEventoImportante"
                                                aria-describedby="helpId" placeholder="Fecha" readonly>
                                        </div>

                                        <div class="mb-3 col-6">
                                            <label for="hora" class="labelTitulo">Hora Termino:</label>
                                            <input type="time" class="inputCaja" name="horaSalida" id="horaSalidaEventoImportante"
                                                aria-describedby="helpId" placeholder="Fecha" readonly>
                                        </div>

                                    <div class="mb-3">
                                        <label for="descripcion" class="labelTitulo">Descripción:</label>
                                        <textarea class="form-control-textarea border-green" name="descripcion" id="descripcionEditEventoImportante" rows="3"
                                            placeholder="Especifique..." readonly></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <div id="contenedorBotonGuardarEventoImportante" style="display:none">
                                <button type="submit" class="btn botonGral">Guardar</button>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="myModalEditExpiranDocumentos" tabindex="-1" aria-labelledby="modalTitleExpiranDocumentosId"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header bacTituloPrincipal">
                            <h5 class="modal-title fs-5" id="modalTitleId">&nbsp <span id="tituloModalExpiranDocumentos">Expiración de Documento
                            </h5>
                            <button type="button" class="btn-close align-self-end" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            <div class="container-fluid">
                                <form method="post">
                                    @csrf
                                    @method('put')
                                    <!-- <div class="mb-3">
                                        <label for="id" class="form-label">ID:</label>
                                        <input type="text"
                                        class="form-control" name="id" id="id" aria-describedby="helpId" placeholder="ID">
                                    </div> -->
                                    <input type="hidden" name="id" value="" id="idExpiranDocumentosModal">
                                    <input type="hidden" id="colorBoxHiddenEditExpiranDocumentos" name="color" value="">

                                    <div class="row">
                                        <input type="hidden" id="colorBoxHiddenExpiranDocumentosEdit" name="color" value="">

                                        <div class="col-12 mb-3">
                                            <label for="title" class="labelTitulo">Título:</label>
                                            <input autofocus type="text" class="inputCaja" name="title" id="titleEditExpiranDocumentos"
                                                placeholder="Título de ExpiranDocumentos..." title="Escriba El Título de la ExpiranDocumentos." readonly>
                                        </div>

                                        <div class="mb-3 col-12">
                                            <label for="fecha" class="labelTitulo">Fecha Expiración:</label>
                                            <input type="date" class="inputCaja" name="fecha" id="fechaEditExpiranDocumentos"
                                                aria-describedby="helpId" placeholder="Fecha" readonly>
                                        </div>

                                        <div class="mb-3 col-12" style="display: none" id="nombreEditExpiranDocumentosHidden">
                                            <label for="title" class="labelTitulo">Nombre Equipo:</label>
                                            <input autofocus type="text" class="inputCaja" id="nombreEditExpiranDocumentos"
                                                name="nombre" placeholder="Nombre Equipo..." readonly>
                                        </div>

                                        <div class="mb-3 col-6" style="display: none" id="numeconomicoEditExpiranDocumentosHidden">
                                            <label for="title" class="labelTitulo">Número Económico:</label>
                                            <input autofocus type="text" class="inputCaja" id="numeconomicoEditExpiranDocumentos"
                                                name="numeconomico" placeholder="Del Equipo..." readonly>
                                        </div>

                                        <div class="mb-3 col-6" style="display: none" id="placasEditExpiranDocumentosHidden">
                                            <label for="title" class="labelTitulo">Placas:</label>
                                            <input autofocus type="text" class="inputCaja" id="placasEditExpiranDocumentos"
                                                name="placas" placeholder="Placas Equipo..." readonly>
                                        </div>

                                        <div class="mb-3 col-12" style="display: none" id="nombreUsuarioEditExpiranDocumentosHidden">
                                            <label for="title" class="labelTitulo">Nombre Usuario:</label>
                                            <input autofocus type="text" class="inputCaja" id="nombreUsuarioEditExpiranDocumentos"
                                                name="personalNombre" placeholder="Nombre Usuario..." readonly>
                                        </div>

                                        <div class="mb-3 col-6" style="display: none" id="emailEditExpiranDocumentosHidden">
                                            <label for="title" class="labelTitulo">Email:</label>
                                            <input autofocus type="text" class="inputCaja" id="emailEditExpiranDocumentos"
                                                placeholder="Email Usuario..." readonly>
                                        </div>

                                        <div class="mb-3 col-6" style="display: none" id="celularEditExpiranDocumentosHidden">
                                            <label for="title" class="labelTitulo">Telefono:</label>
                                            <input autofocus type="text" class="inputCaja" id="celularEditExpiranDocumentos"
                                                placeholder="Telefono Usuario..." readonly>
                                        </div>

                                        {{--  <div class="col-1 mt-4">
                                            @can('calendarioPrincipal_edit')
                                                <div id="editarCamposExpiranDocumentos">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28"
                                                        fill="currentColor" class="bi bi-pencil accionesIconos"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                                                    </svg>
                                                </div>
                                            @endcan
                                        </div>  --}}
                                    </div>

                                    <div class="row">

                                    <div class="mb-3">
                                        <label for="color" class="labelTitulo">Color:</label>
                                        <div id="colorBoxEditExpiranDocumentos" class="color-box w-100" ></div>
                                    </div>

                                        

                                        <div class="mb-3 col-6" style="display: none">
                                            <label for="hora" class="labelTitulo">Hora Inicio:</label>
                                            <input type="time" class="inputCaja" name="hora" id="horaEditExpiranDocumentos"
                                                aria-describedby="helpId" placeholder="Fecha" readonly>
                                        </div>

                                        <div class="mb-3 col-12" style="display: none">
                                            <label for="fecha" class="labelTitulo">Fecha Termino:</label>
                                            <input type="date" class="inputCaja" name="fechaSalida" id="fechaSalidaExpiranDocumentos"
                                                aria-describedby="helpId" placeholder="Fecha" readonly>
                                        </div>

                                        <div class="mb-3 col-6" style="display: none">
                                            <label for="hora" class="labelTitulo">Hora Termino:</label>
                                            <input type="time" class="inputCaja" name="horaSalida" id="horaSalidaExpiranDocumentos"
                                                aria-describedby="helpId" placeholder="Fecha" readonl y>
                                        </div>

                                        <div class="mb-3 col-12">
                                            <label for="hora" class="labelTitulo">Ir al Registro:</label>
                                            <p class="textTitulo my-2">
                                                <a style="color: blue; text-decoration: underline;" id="linkExpiranDocumentos">
                                                </a>
                                            
                                            </p>
                                        </div>

                                    <div class="mb-3">
                                        <label for="descripcion" class="labelTitulo">Descripción:</label>
                                        <textarea class="form-control-textarea border-green" name="descripcion" id="descripcionEditExpiranDocumentos" rows="3"
                                            placeholder="Especifique..." readonly></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <div id="contenedorBotonGuardarExpiranDocumentos" style="display:none">

                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="myModalEditDiaFeriado" tabindex="-1" aria-labelledby="modalTitleDiaFeriadoId"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header bacTituloPrincipal">
                            <h5 class="modal-title fs-5" id="modalTitleId">&nbsp <span id="tituloModalDiaFeriado">Día Feriado
                            </h5>
                            <button type="button" class="btn-close align-self-end" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            <div class="container-fluid">
                                <form method="post">
                                    @csrf
                                    @method('put')
                                    <!-- <div class="mb-3">
                                        <label for="id" class="form-label">ID:</label>
                                        <input type="text"
                                        class="form-control" name="id" id="id" aria-describedby="helpId" placeholder="ID">
                                    </div> -->
                                    <input type="hidden" name="id" value="" id="idDiaFeriadoModal">
                                    <input type="hidden" id="colorBoxHiddenEditDiaFeriado" name="color" value="">

                                    <div class="row">
                                        <input type="hidden" id="colorBoxHiddenDiaFeriadoEdit" name="color" value="">

                                        <div class="col-12 mb-3">
                                            <label for="title" class="labelTitulo">Título:</label>
                                            <input autofocus type="text" class="inputCaja" name="title" id="titleEditDiaFeriado"
                                                placeholder="Título de DiaFeriado..." title="Escriba El Título de la DiaFeriado." readonly>
                                        </div>

                                        <div class="mb-3 col-12">
                                            <label for="fecha" class="labelTitulo">Fecha:</label>
                                            <input type="date" class="inputCaja" name="fecha" id="fechaEditDiaFeriado"
                                                aria-describedby="helpId" placeholder="Fecha" readonly>
                                        </div>

                                        {{--  <div class="col-1 mt-4">
                                            @can('calendarioPrincipal_edit')
                                                <div id="editarCamposExpiranDocumentos">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28"
                                                        fill="currentColor" class="bi bi-pencil accionesIconos"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                                                    </svg>
                                                </div>
                                            @endcan
                                        </div>  --}}
                                    </div>

                                    <div class="row">

                                    <div class="mb-3">
                                        <label for="color" class="labelTitulo">Color:</label>
                                        <div id="colorBoxEditDiaFeriado" class="color-box w-100"></div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="descripcion" class="labelTitulo">Descripción:</label>
                                        <textarea class="form-control-textarea border-green" name="descripcion" id="descripcionEditDiaFeriado" rows="3"
                                            placeholder="Especifique..." readonly></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <div id="contenedorBotonGuardarExpiranDocumentos" style="display:none">

                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>

        <!-- Modal-->
        <div id="myModal" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true" class="modal fade text-left">
            <div role="document" class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header-multiple row d-flex justify-content-between mx-1 mx-sm-3 mb-0 pb-0 border-0 mt-3" style="font-size: 25px; font-weight: 500; color:#727176;">
                        <div class="tabs" id="tab01">
                            <h6 class=""><img src="/img/calendario/mantenimiento.svg" alt="Mantenimiento" title="Mantenimiento" width="20px" class="botonIconoPrincipal mb-1"> Mantenimientos</h6>
                        </div>
                        <div class="tabs active" id="tab02">
                            <h6 class=""><img src="/img/calendario/tarea.svg" alt="Tarea" title="Tarea" width="20px" class="botonIconoPrincipal mb-1"> Tarea</h6>
                        </div>
                        <div class="tabs" id="tab03">
                            <h6 class=""><img src="/img/calendario/solicitud.svg" alt="Solicitud" title="Solicitud" width="20px" class="botonIconoPrincipal mb-1"> Solicitud</h6>
                        </div>
                        <div class="tabs" id="tab04">
                            <h6 class=""><img src="/img/calendario/Eventos importantes-01.svg" alt="Eventos" title="Eventos" width="20px" class="botonIconoPrincipal mb-1"> Eventos</h6>
                        </div>
                        <button type="button" class="btn-close mb-2" style="margin-left: 10px;" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="line" style="background-color:#CFD8DC;"></div>
                    <div class="modal-body p-0">
                        <fieldset id="tab011">
                            <div class="text-center" style="color:#5C7C26; margin-top: 10px; font-weight: bold;">
                                <h4 class="" style="color:#5C7C26; margin-top: 10px; font-weight: bold;">Añadir Mantenimiento</h4>
                            </div>
                            <div class="line"></div>
                            <form action="{{ route('calendarioPrincipal.store') }}" method="post">
                            <div class="container-fluid mt-1">
                                    @csrf
                                    @method('post')
                                    <!-- <div class="mb-3">
                                        <label for="id" class="form-label">ID:</label>
                                        <input type="text"
                                        class="form-control" name="id" id="id" aria-describedby="helpId" placeholder="ID">
                                    </div> -->
                                    <input type="hidden" name="tipo" value="En Espera">
                                    <input type="hidden" name="userId" value="{{auth()->user()->id}}">
                                    <input type="hidden" name="maquinariaId" id="maquinariaId">
                                    <input type="hidden" name="identificador" id="identificador">
                                    <input type="hidden" id="colorBoxHidden" name="color" value="">

                                    <div class="mb-3" role="search">
                                        <label for="title" class="labelTitulo">Buscador Equipo:</label>
                                        <input autofocus type="text" class="inputCaja" id="searchS" name="search"
                                            placeholder="Buscar Equipo..." title="Escriba la(s) palabra(s) a buscar.">
                                    </div>

                                    <div class="row">
                                        <div class="mb-3 col-6">
                                            <label for="title" class="labelTitulo">Nombre:</label>
                                            <input autofocus type="text" class="inputCaja" id="nombre" name="nombre"
                                                placeholder="Nombre Equipo..." readonly>
                                        </div>

                                        <div class="mb-3 col-6">
                                            <label for="title" class="labelTitulo">Número Económico:</label>
                                            <input autofocus type="text" class="inputCaja" id="numeconomico"
                                                name="numeconomico" placeholder="Del Equipo..." readonly>
                                        </div>

                                        <div class="mb-3 col-6">
                                            <label for="title" class="labelTitulo">Placas:</label>
                                            <input autofocus type="text" class="inputCaja" id="placas" name="placas"
                                                placeholder="Placas Equipo..." readonly>
                                        </div>

                                        <div class="mb-3 col-6">
                                            <label for="title" class="labelTitulo">Marca:</label>
                                                <select id="marca"
                                                name="marca"
                                                class="form-select"  placeholder="Marca Equipo..." readonly>
                                                <option value="">Seleccione</option>
                                                @foreach ($marca as $item)
                                                    <option value="{{ $item->id }}">
                                                        {{ $item->nombre }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>


                                    <div class="mb-3 col-6">
                                        <label for="title" class="labelTitulo">Mantenimiento: * </label>
                                        <select name="tipoMantenimientoId" id="titleSelect" required class="form-select">
                                            <option value="">Seleccione</option>
                                            @foreach ($tiposMantenimiento as $item)
                                                <option value="{{ $item->id }}" data-color="{{ $item->color }}">
                                                    {{ $item->nombre }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-12 col-sm-6 mb-3 ">
                                        <label class="labelTitulo">Responsable:</label></br>
                                        <select class="form-select form-select-lg mb-3 inputCaja" name="personalId" id="responsable"
                                            aria-label=".form-select-lg example">
                                            <option value="">Seleccione</option>
                                            @foreach ($personal as $item)
                                                <option value="{{ $item->id }}">
                                                    {{ $item->nombres . ' ' . $item->apellidoP }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3 col-6">
                                        <label for="title" class="labelTitulo">Estado de la Solicitud*:</label>
                                        <select name="estadoId" id="estadoSelectMantenimiento" required class="form-select">
                                            <option value="1" selected>En Espera</option>
                                        </select>
                                    </div>
                                </div>
                                    <div class="mb-3">
                                        <label for="color" class="labelTitulo">Color:</label>
                                        <div id="colorBox" class="color-box w-100" style="margin-left:-0.5px"></div>
                                    </div>

                                    <div class="row">
                                        <div class="mb-3 col-6">
                                            <label for="fecha" class="labelTitulo">Fecha de Llegada:</label>
                                            <input type="date" class="inputCaja" name="fecha" id="fecha"
                                                aria-describedby="helpId" placeholder="Fecha">
                                        </div>

                                        <div class="mb-3 col-6">
                                            <label for="hora" class="labelTitulo">Hora de Llegada:</label>
                                            <input type="time" class="inputCaja" name="hora" id="hora"
                                                aria-describedby="helpId" placeholder="Fecha">
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="descripcion" class="labelTitulo">Descripción:</label>
                                        <textarea class="form-control-textarea border-green" name="descripcion" id="descripcion" rows="3"
                                            placeholder="Especifique..."></textarea>
                                    </div>

                            </div>
                            <div class="line"></div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn botonGral">Guardar</button>
                            </div>
                        </form>
                        </fieldset>
                        <fieldset class="show" id="tab021">
                            <div class="text-center" style="color:#5C7C26; margin-top: 10px; font-weight: bold;">
                                <h4 class="" style="color:#5C7C26; margin-top: 10px; font-weight: bold;">Añadir Tarea</h4>
                            </div>

                            <div class="line"></div>
                            <form action="{{ route('actividades.store') }}" method="post">
                            <div class="container-fluid mt-1">
                                @csrf
                                @method('post')
                                <div class="row">
                                    <input type="hidden" id="colorBoxHiddenTarea" name="color" value="">
                                    <input type="hidden" name="tipo" value="En Espera">
                                    <input type="hidden" name="userId" value="{{auth()->user()->id}}">
                                    <div class="col-12 col-sm-6 mb-3">
                                        <label for="title" class="labelTitulo">Título:</label>
                                        <input autofocus type="text" class="inputCaja" name="title"
                                            placeholder="Título de Tarea..." title="Escriba El Título de la Tarea.">
                                    </div>
                                    <div class="col-12 col-sm-6 mb-3 ">
                                        <label class="labelTitulo">Responsable:</label></br>
                                        <select class="form-select form-select-lg mb-3 inputCaja" name="personalId" id="responsable"
                                            aria-label=".form-select-lg example">
                                            <option value="">Seleccione</option>
                                            @foreach ($personal as $item)
                                                <option value="{{ $item->id }}">
                                                    {{ $item->nombres . ' ' . $item->apellidoP }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3 col-6">
                                        <label for="prioridad" class="labelTitulo">Prioridad: *</label>
                                        <select name="prioridad" id="prioridadSelect" required class="form-select">
                                            <option value="">Seleccione</option>
                                                <option value="Urgente">
                                                    Urgente
                                                </option>
                                                <option value="Necesaria">
                                                    Necesaria
                                                </option>
                                                <option value="Deseable">
                                                    Deseable
                                                </option>
                                                <option value="Prorrogable">
                                                    Prorrogable
                                                </option>
                                        </select>
                                    </div>

                                    <div class="mb-3 col-6">
                                        <label for="title" class="labelTitulo">Estado de la Solicitud*:</label>
                                        <select name="estadoId" id="estadoSelectTarea" required class="form-select">
                                            <option value="1" selected>En Espera</option>
                                        </select>
                                    </div>
                                    @foreach($eventosCalendarioTipos as $evento)
                                        @if($evento['tipoEvento'] === 'actividades')
                                            @php $color = $evento['color']; @endphp
                                        @endif
                                    @endforeach
                                    <div class="mb-3">
                                        <label for="color" class="labelTitulo">Color:</label>
                                        <div id="colorBoxTarea" class="color-box w-100" style="margin-left:-0.5px; background-color: {{ $color ?? '#FFFFFF' }}"></div>
                                    </div>
                                    <div class="mb-3 col-6">
                                        <label for="fecha" class="labelTitulo">Fecha de Inicio Para la Tarea:</label>
                                        <input type="date" class="inputCaja" name="fechaTarea" id="fechaTarea"
                                            aria-describedby="helpId" placeholder="Fecha">
                                    </div>

                                    <div class="mb-3 col-6">
                                        <label for="hora" class="labelTitulo">Hora de Inicio Para la Tarea:</label>
                                        <input type="time" class="inputCaja" name="horaTarea" id="horaTarea"
                                            aria-describedby="helpId" placeholder="Fecha">
                                    </div>


                                    <div class="mb-3">
                                        <label for="descripcion" class="labelTitulo">Descripción:</label>
                                        <textarea class="form-control-textarea border-green" name="descripcion" id="descripcionTarea" rows="3"
                                            placeholder="Especifique..."></textarea>
                                    </div>
                                </div>

                            </div>
                            <div class="line"></div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn botonGral">Guardar</button>
                            </div>
                        </form>
                        </fieldset>
                        <fieldset id="tab031">
                            <div class="text-center" style="color:#5C7C26; margin-top: 10px; font-weight: bold;">
                                <h4 class="" style="color:#5C7C26; margin-top: 10px; font-weight: bold;">Añadir Solicitud</h4>
                            </div>

                            <div class="line"></div>
                            <form action="{{ route('solicitudes.store') }}" method="post">
                            <input type="hidden" name="tipo" value="En Espera">
                            <input type="hidden" name="userId" value="{{auth()->user()->id}}">
                            <input type="hidden" name="maquinariaId" id="maquinariaIdSolicitud">
                            <input type="hidden" id="colorBoxHidden" name="color" value="">
                            <div class="container-fluid mt-1">
                                @csrf
                                @method('post')
                                <div class="row">
                                    <input type="hidden" id="colorBoxHiddenSolicitud" name="color" value="">
                                    <input type="hidden" name="tipo" value="En Espera">
                                    <input type="hidden" name="userId" value="{{auth()->user()->id}}">
                                    <div class="col-12 mb-3">
                                        <label for="title" class="labelTitulo">Título:</label>
                                        <input autofocus type="text" class="inputCaja" name="title"
                                            placeholder="Título de Solicitud..." title="Escriba El Título de la Solicitud.">
                                    </div>

                                    <div class="mb-3" role="search">
                                        <label for="title" class="labelTitulo">Buscador Equipo:</label>
                                        <input autofocus type="text" class="inputCaja" id="searchSolicitudes" name="search"
                                            placeholder="Buscar Equipo..." title="Escriba la(s) palabra(s) a buscar.">
                                    </div>

                                        <div class="mb-3 col-6">
                                            <label for="title" class="labelTitulo">Nombre:</label>
                                            <input autofocus type="text" class="inputCaja" id="nombreSolicitud" name="nombre"
                                                placeholder="Nombre Equipo..." readonly>
                                        </div>

                                        <div class="mb-3 col-6">
                                            <label for="title" class="labelTitulo">Número Económico:</label>
                                            <input autofocus type="text" class="inputCaja" id="numeconomicoSolicitud"
                                                name="numeconomico" placeholder="Del Equipo..." readonly>
                                        </div>

                                        <div class="mb-3 col-6">
                                            <label for="title" class="labelTitulo">Placas:</label>
                                            <input autofocus type="text" class="inputCaja" id="placasSolicitud" name="placas"
                                                placeholder="Placas Equipo..." readonly>
                                        </div>

                                        <div class="mb-3 col-6">
                                            <label for="title" class="labelTitulo">Marca:</label>
                                            <select name='marca'
                                                class="form-select" id="marcaSolicitud" placeholder="Marca Equipo..." readonly>
                                                <option value="">Seleccione</option>
                                                @foreach ($marca as $item)
                                                    <option value="{{ $item->id }}">
                                                        {{ $item->nombre }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    <div class="mb-3 col-6">
                                        <label for="prioridad" class="labelTitulo">Prioridad: *</label>
                                        <select name="prioridad" id="prioridadSelectSolicitud" required class="form-select">
                                            <option value="">Seleccione</option>
                                                <option value="Urgente">
                                                    Urgente
                                                </option>
                                                <option value="Necesaria">
                                                    Necesaria
                                                </option>
                                                <option value="Deseable">
                                                    Deseable
                                                </option>
                                                <option value="Prorrogable">
                                                    Prorrogable
                                                </option>
                                        </select>
                                    </div>

                                    <div class="col-12 col-sm-6 mb-3 ">
                                        <label class="labelTitulo">Responsable:</label></br>
                                        <select class="form-select form-select-lg mb-3 inputCaja" name="personalId" id="responsable"
                                            aria-label=".form-select-lg example">
                                            <option value="">Seleccione</option>
                                            @foreach ($personal as $item)
                                                <option value="{{ $item->id }}">
                                                    {{ $item->nombres . ' ' . $item->apellidoP }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-3 col-6">
                                        <label for="title" class="labelTitulo">Estado de la Solicitud*:</label>
                                        <select name="estadoId" id="estadoSelectSolicitud" required class="form-select">
                                            <option value="1" selected>En Espera</option>
                                        </select>
                                    </div>

                                    <div class="mb-3 col-6">
                                        <label for="title" class="labelTitulo">Funcionalidad del Equipo*:</label>
                                        <select name="funcionalidad" id="estadoSelectSolicitud" required class="form-select">
                                            <option value="">Seleccione</option>
                                            <option value="No Funciona" selected>No Funciona</option>
                                            <option value="Funciona Poco" selected>Funciona Poco</option>
                                            <option value="Funciona" selected>Funciona</option>
                                        </select>
                                    </div>

                                    @foreach($eventosCalendarioTipos as $evento)
                                        @if($evento['tipoEvento'] === 'solicitud')
                                            @php $colorSolicitud = $evento['color']; @endphp
                                        @endif
                                    @endforeach

                                    <div class="mb-3">
                                        <label for="color" class="labelTitulo">Color:</label>
                                        <div id="colorBoxSolicitud" class="color-box w-100" style="margin-left:-0.5px; background-color: {{ $colorSolicitud ?? '#FFFFFF' }}"></div>
                                    </div>
                                    <div class="mb-3 col-6">
                                        <label for="fecha" class="labelTitulo">Fecha de Inicio del Requerimiento:</label>
                                        <input type="date" class="inputCaja" name="fechaSolicitud" id="fechaSolicitud"
                                            aria-describedby="helpId" placeholder="Fecha">
                                    </div>

                                    <div class="mb-3 col-6">
                                        <label for="hora" class="labelTitulo">Hora de Inicio del Requerimiento:</label>
                                        <input type="time" class="inputCaja" name="horaSolicitud" id="horaSolicitud"
                                            aria-describedby="helpId" placeholder="Fecha">
                                    </div>


                                    <div class="mb-3">
                                        <label for="descripcion" class="labelTitulo">Descripción:</label>
                                        <textarea class="form-control-textarea border-green" name="descripcion" id="descripcionSolicitud" rows="3"
                                            placeholder="Especifique..."></textarea>
                                    </div>
                                </div>

                                <div class="mb-3 text-center">
                                    <h4 style="color:#5c7c26 !important; margin-top: 10px; font-weight: bold;">Añadir Tipos A la Solicitud</h4>

                                    <div class="form-check form-check-inline">
                                        <input type="radio" name="tipo_solicitud" class="form-check-input is-invalid align-self-end mb-2" value="reparacion" id="checkbox_reparacion" required>
                                        <label for="checkbox_reparacion">Reparación</label><br>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input type="radio" name="tipo_solicitud" class="form-check-input is-invalid align-self-end mb-2" value="combustible" id="checkbox_combustible">
                                        <label for="checkbox_combustible">Combustible</label><br>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input type="radio" name="tipo_solicitud" class="form-check-input is-invalid align-self-end mb-2" value="herramienta" id="checkbox_herramienta">
                                        <label for="checkbox_herramienta">Herramienta</label><br>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input type="radio" name="tipo_solicitud" class="form-check-input is-invalid align-self-end mb-2" value="refaccion" id="checkbox_refaccion">
                                        <label for="checkbox_refaccion">Refacción</label><br>
                                    </div>
                                </div>

                                <!-- Campos tipo de solicitud -->
                                <div id="reparacion_campos" class="campos-solicitud" style="display: none;">
                                    <div class="row">
                                        <div class="col-12 pb-3 text-end">
                                            <button type="button" class="btnVerde"
                                                onclick="crearItemsReparacion()">
                                            </button>
                                        </div>
                                        <div class="opcReparacion">
                                            <div class="row">
                                                <div class="line mb-2"></div>
                                                <div class="mb-3 col-11">
                                                    <label for="reparacion" class="labelTitulo">Reparación:</label>
                                                    <input type="text" class="inputCaja" name="reparacionSolicitud[]" id="reparacionSolicitud"
                                                        aria-describedby="helpId" placeholder="Reparacion">
                                                </div>
                                                <div class="col-1 my-3 text-end">
                                                    <button type="button" id="removeRowReparacion"
                                                    class="btnRojo"></button>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="comentarioReparacion" class="labelTitulo">Comentario:</label>
                                                    <textarea class="form-control-textarea border-green" name="comentarioReparacion[]" id="comentarioReparacion" rows="3"
                                                        placeholder="Especifique..."></textarea>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div id="combustible_campos" class="campos-solicitud" style="display: none;">
                                    <div class="row">
                                        <div class="col-12 pb-3 text-end">
                                            <button type="button" class="btnVerde"
                                                onclick="crearItemsCombustible()">
                                            </button>
                                        </div>
                                        <div class="opcCombustible">
                                            <div class="row">
                                                <div class="line mb-2"></div>
                                                <div class="mb-3 col-6">
                                                    <label for="litros" class="labelTitulo">Litros:</label>
                                                    <input type="number" class="inputCaja" name="litros[]" id="litrosSolicitud"
                                                        aria-describedby="helpId" placeholder="Litros">
                                                </div>
                                                <div class="mb-3 col-5">
                                                    <label for="carga" class="labelTitulo">Tipo: *</label>
                                                    <select name="carga[]" id="carga" required class="form-select">
                                                        <option value="carga" selected>Carga</option>
                                                    </select>
                                                </div>
                                                <div class="col-1 my-3 text-end">
                                                    <button type="button" id="removeRowCombustible"
                                                        class="btnRojo"></button>
                                                    </div>

                                                <div class="mb-3">
                                                    <label for="comentarioCombustible" class="labelTitulo">Comentario:</label>
                                                    <textarea class="form-control-textarea border-green" name="comentarioCombustible[]" id="comentarioCombustible" rows="3"
                                                        placeholder="Especifique..."></textarea>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </div>

                                <div id="herramienta_campos" class="campos-solicitud" style="display: none;">
                                    <div class="row">
                                        <div class="col-12 pb-3 text-end">
                                            <button type="button" class="btnVerde"
                                                onclick="crearItemsHerramienta()">
                                            </button>
                                        </div>
                                        <div class="opcHerramienta">
                                            <div class="row">
                                                <div class="line mb-2"></div>
                                                <div class="mb-3 col-6">
                                                    <label for="cantidad" class="labelTitulo">Herramienta:</label>
                                                    <select name="herramientaNombre[]" id="herramientaNombre" class="form-select">
                                                        <option value="" >Seleccione</option>
                                                        @foreach ($herramientas as $item)
                                                            <option value="{{ $item->id }}">
                                                                {{ $item->nombre }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mb-3 col-5">
                                                    <label for="cantidad" class="labelTitulo">Cantidad:</label>
                                                    <input type="number" class="inputCaja" name="cantidadHerramienta[]" id="cantidadSolicitudHerramienta"
                                                        aria-describedby="helpId" placeholder="Cantidad">
                                                </div>
                                                <div class="col-1 my-3 text-end">
                                                    <button type="button" id="removeRowHerramienta"
                                                        class="btnRojo"></button>
                                                    </div>
                                                <div class="mb-3">
                                                    <label for="comentarioHerramienta" class="labelTitulo">Comentario:</label>
                                                    <textarea class="form-control-textarea border-green" name="comentarioHerramienta[]" id="comentarioHerramienta" rows="3"
                                                        placeholder="Especifique..."></textarea>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </div>

                                <div id="refaccion_campos" class="campos-solicitud" style="display: none;">
                                    <div class="row">
                                        <div class="col-12 pb-3 text-end">
                                            <button type="button" class="btnVerde"
                                                onclick="crearItemsRefaccion()">
                                            </button>
                                        </div>
                                        <div class="opcRefaccion">
                                            <div class="row">
                                                <div class="line mb-2"></div>
                                                <div class="mb-3 col-6">
                                                    <label for="refaccion" class="labelTitulo">Refacción:</label>
                                                    <select name="refaccionNombre[]" id="refaccionNombre" class="form-select">
                                                        <option value="" >Seleccione</option>
                                                        @foreach ($refacciones as $item)
                                                            <option value="{{ $item->id }}">
                                                                {{ $item->nombre }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="mb-3 col-5">
                                                    <label for="cantidad" class="labelTitulo">Cantidad:</label>
                                                    <input type="number" class="inputCaja" name="cantidadRefaccion[]" id="cantidadSolicitudRefaccion"
                                                        aria-describedby="helpId" placeholder="Cantidad">
                                                </div>
                                                <div class="col-1 my-3 text-end">
                                                    <button type="button" id="removeRowRefaccion"
                                                        class="btnRojo"></button>
                                                    </div>
                                                <div class="mb-3">
                                                    <label for="comentarioRefaccion" class="labelTitulo">Comentario:</label>
                                                    <textarea class="form-control-textarea border-green" name="comentarioRefaccion[]" id="comentarioRefaccion" rows="3"
                                                        placeholder="Especifique..."></textarea>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="line"></div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn botonGral">Guardar</button>
                            </div>
                        </form>
                        </fieldset>
                        <fieldset id="tab041">
                            <div class="text-center" style="color:#5C7C26; margin-top: 10px; font-weight: bold;">
                                <h4 class="" style="color:#5C7C26; margin-top: 10px; font-weight: bold;">Añadir Evento Importante</h4>
                            </div>

                            <div class="line"></div>
                            <form action="{{ route('eventosImportantes.store') }}" method="post">
                            <div class="container-fluid mt-1">
                                @csrf
                                @method('post')
                                <div class="row">
                                    <input type="hidden" id="colorBoxHiddenEventoImportante" name="color" value="#8a8a8a">
                                    {{--  <input type="hidden" name="tipo" value="En Espera">  --}}
                                    <input type="hidden" name="userId" value="{{auth()->user()->id}}">
                                    <div class="col-12 mb-3">
                                        <label for="title" class="labelTitulo">Título:</label>
                                        <input autofocus type="text" class="inputCaja" name="title"
                                            placeholder="Título de Evento Importante..." title="Escriba El Título del Evento Importante.">
                                    </div>

                                    @foreach($eventosCalendarioTipos as $evento)
                                        @if($evento['tipoEvento'] === 'EventoImportante')
                                            @php $colorEventoImportante = $evento['color']; @endphp
                                        @endif
                                    @endforeach

                                    <div class="mb-3">
                                        <label for="color" class="labelTitulo">Color:</label>
                                        
                                        <div id="colorBoxEventoImportante" class="color-box w-100" style="margin-left:-0.5px; background-color: {{ $colorEventoImportante ?? '#FFFFFF' }}"></div>
                                    </div>
                                    <div class="mb-3 col-6">
                                        <label for="fecha" class="labelTitulo">Fecha Inicio:</label>
                                        <input type="date" class="inputCaja" name="fechaEventoImportante" id="fechaEventoImportante"
                                            aria-describedby="helpId" placeholder="Fecha">
                                    </div>

                                    <div class="mb-3 col-6">
                                        <label for="hora" class="labelTitulo">Hora Inicio:</label>
                                        <input type="time" class="inputCaja" name="horaEventoImportante" id="horaEventoImportante"
                                            aria-describedby="helpId" placeholder="Fecha">
                                    </div>

                                    <div class="mb-3 col-6">
                                        <label for="fecha" class="labelTitulo">Fecha Termino:</label>
                                        <input type="date" class="inputCaja" name="fechaEventoImportanteEdit" id="fechaEventoImportanteEdit"
                                            aria-describedby="helpId" placeholder="Fecha">
                                    </div>

                                    <div class="mb-3 col-6">
                                        <label for="hora" class="labelTitulo">Hora Termino:</label>
                                        <input type="time" class="inputCaja" name="horaEventoImportanteEdit" id="horaEventoImportanteEdit"
                                            aria-describedby="helpId" placeholder="Fecha">
                                    </div>

                                    <div class="mb-3">
                                        <label for="descripcion" class="labelTitulo">Descripción:</label>
                                        <textarea class="form-control-textarea border-green" name="descripcion" id="descripcionEventoImportante" rows="3"
                                            placeholder="Especifique..."></textarea>
                                    </div>
                                </div>

                            </div>
                            <div class="line"></div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn botonGral">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal-->
        {{--  <div id="myModalEdit" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true" class="modal fade text-left">
            <div role="document" class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header row d-flex justify-content-between mx-1 mx-sm-3 mb-0 pb-0 border-0" style="font-size: 25px; font-weight: 500; color:#727176;">
                        <div class="tabs" id="tab01">
                            <h6 class=""><img src="/img/calendario/mantenimiento.svg" alt="Mantenimiento" title="Mantenimiento" width="20px" class="botonIconoPrincipal mb-1"> Mantenimientos</h6>
                        </div>
                        <div class="tabs active" id="tab02">
                            <h6 class=""><img src="/img/calendario/tarea.svg" alt="Tarea" title="Tarea" width="20px" class="botonIconoPrincipal mb-1"> Tarea</h6>
                        </div>
                        <div class="tabs" id="tab03">
                            <h6 class=""><img src="/img/calendario/solicitud.svg" alt="Solicitud" title="Solicitud" width="20px" class="botonIconoPrincipal mb-1"> Solicitud</h6>
                        </div>
                        <button type="button" class="btn-close mb-2" style="margin-left: 10px;" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="line" style="background-color:#CFD8DC;"></div>
                    <div class="modal-body p-0">
                        <fieldset id="tab011">
                            <div class="text-center" style="color:#5C7C26; margin-top: 10px; font-weight: bold;">
                                <h4 class="" style="color:#5C7C26; margin-top: 10px; font-weight: bold;">Añadir Mantenimiento</h4>
                            </div>
                            <div class="line"></div>
                            <form action="{{ route('calendarioPrincipal.store') }}" method="post">
                            <div class="container-fluid mt-1">
                                    @csrf
                                    @method('post')
                                    <!-- <div class="mb-3">
                                        <label for="id" class="form-label">ID:</label>
                                        <input type="text"
                                        class="form-control" name="id" id="id" aria-describedby="helpId" placeholder="ID">
                                    </div> -->
                                    <input type="hidden" name="tipo" value="En Espera">
                                    <input type="hidden" name="userId" value="{{auth()->user()->id}}">
                                    <input type="hidden" name="maquinariaId" id="maquinariaId">
                                    <input type="hidden" id="colorBoxHidden" name="color" value="">

                                    <div class="mb-3" role="search">
                                        <label for="title" class="labelTitulo">Buscador Equipo:</label>
                                        <input autofocus type="text" class="inputCaja" id="searchS" name="search"
                                            placeholder="Buscar Equipo..." title="Escriba la(s) palabra(s) a buscar.">
                                    </div>

                                    <div class="row">
                                        <div class="mb-3 col-6">
                                            <label for="title" class="labelTitulo">Nombre:</label>
                                            <input autofocus type="text" class="inputCaja" id="nombre" name="nombre"
                                                placeholder="Nombre Equipo..." readonly>
                                        </div>

                                        <div class="mb-3 col-6">
                                            <label for="title" class="labelTitulo">Número Económico:</label>
                                            <input autofocus type="text" class="inputCaja" id="numeconomico"
                                                name="numeconomico" placeholder="Del Equipo..." readonly>
                                        </div>

                                        <div class="mb-3 col-6">
                                            <label for="title" class="labelTitulo">Placas:</label>
                                            <input autofocus type="text" class="inputCaja" id="placas" name="placas"
                                                placeholder="Placas Equipo..." readonly>
                                        </div>

                                        <div class="mb-3 col-6">
                                            <label for="title" class="labelTitulo">Marca:</label>
                                            <input autofocus type="text" class="inputCaja" id="marca"
                                                name="marca" placeholder="Marca Equipo..." readonly>
                                        </div>


                                    <div class="mb-3 col-6">
                                        <label for="title" class="labelTitulo">Mantenimiento: *</label>
                                        <select name="tipoMantenimientoId" id="titleSelect" required class="form-select">
                                            <option value="">Seleccione</option>
                                            @foreach ($tiposMantenimiento as $item)
                                                <option value="{{ $item->id }}" data-color="{{ $item->color }}">
                                                    {{ $item->nombre }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-12 col-sm-6 mb-3 ">
                                        <label class="labelTitulo">Responsable:</label></br>
                                        <select class="form-select form-select-lg mb-3 inputCaja" name="personalId" id="responsable"
                                            aria-label=".form-select-lg example">
                                            <option value="">Seleccione</option>
                                            @foreach ($personal as $item)
                                                <option value="{{ $item->id }}">
                                                    {{ $item->nombres . ' ' . $item->apellidoP }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3 col-6">
                                        <label for="title" class="labelTitulo">Estado de la Solicitud*:</label>
                                        <select name="estadoId" id="estadoSelectMantenimiento" required class="form-select">
                                            <option value="1" selected>En Espera</option>
                                        </select>
                                    </div>
                                </div>
                                    <div class="mb-3">
                                        <label for="color" class="labelTitulo">Color:</label>
                                        <div id="colorBox" class="color-box w-100" style="margin-left:-0.5px"></div>
                                    </div>

                                    <div class="row">
                                        <div class="mb-3 col-6">
                                            <label for="fecha" class="labelTitulo">Fecha de Llegada:</label>
                                            <input type="date" class="inputCaja" name="fecha" id="fecha"
                                                aria-describedby="helpId" placeholder="Fecha">
                                        </div>

                                        <div class="mb-3 col-6">
                                            <label for="hora" class="labelTitulo">Hora de Llegada:</label>
                                            <input type="time" class="inputCaja" name="hora" id="hora"
                                                aria-describedby="helpId" placeholder="Fecha">
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="descripcion" class="labelTitulo">Descripción:</label>
                                        <textarea class="form-control-textarea border-green" name="descripcion" id="descripcion" rows="3"
                                            placeholder="Especifique..."></textarea>
                                    </div>

                            </div>
                            <div class="line"></div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn botonGral">Guardar</button>
                            </div>
                        </form>
                        </fieldset>
                        <fieldset class="show" id="tab021">
                            <div class="text-center" style="color:#5C7C26; margin-top: 10px; font-weight: bold;">
                                <h4 class="" style="color:#5C7C26; margin-top: 10px; font-weight: bold;">Añadir Tarea</h4>
                            </div>

                            <div class="line"></div>
                            <form action="{{ route('actividades.store') }}" method="post">
                            <div class="container-fluid mt-1">
                                @csrf
                                @method('post')
                                <div class="row">
                                    <input type="hidden" id="colorBoxHiddenTarea" name="color" value="">
                                    <input type="hidden" name="tipo" value="En Espera">
                                    <input type="hidden" name="userId" value="{{auth()->user()->id}}">
                                    <div class="col-12 col-sm-6 mb-3">
                                        <label for="title" class="labelTitulo">Título:</label>
                                        <input autofocus type="text" class="inputCaja" name="title"
                                            placeholder="Título de Tarea..." title="Escriba El Título de la Tarea.">
                                    </div>
                                    <div class="col-12 col-sm-6 mb-3 ">
                                        <label class="labelTitulo">Responsable:</label></br>
                                        <select class="form-select form-select-lg mb-3 inputCaja" name="personalId" id="responsable"
                                            aria-label=".form-select-lg example">
                                            <option value="">Seleccione</option>
                                            @foreach ($personal as $item)
                                                <option value="{{ $item->id }}">
                                                    {{ $item->nombres . ' ' . $item->apellidoP }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3 col-6">
                                        <label for="prioridad" class="labelTitulo">Prioridad: *</label>
                                        <select name="prioridad" id="prioridadSelect" required class="form-select">
                                            <option value="">Seleccione</option>
                                                <option value="Urgente" data-color="#ff0000">
                                                    Urgente
                                                </option>
                                                <option value="Necesaria" data-color="#ffa500">
                                                    Necesaria
                                                </option>
                                                <option value="Deseable" data-color="#ffff00">
                                                    Deseable
                                                </option>
                                                <option value="Prorrogable" data-color="#a6ce34">
                                                    Prorrogable
                                                </option>
                                        </select>
                                    </div>

                                    <div class="mb-3 col-6">
                                        <label for="title" class="labelTitulo">Estado de la Solicitud*:</label>
                                        <select name="estadoId" id="estadoSelectTarea" required class="form-select">
                                            <option value="1" selected>En Espera</option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="color" class="labelTitulo">Color:</label>
                                        <div id="colorBoxTarea" class="color-box w-100" style="margin-left:-0.5px"></div>
                                    </div>
                                    <div class="mb-3 col-6">
                                        <label for="fecha" class="labelTitulo">Fecha de Llegada:</label>
                                        <input type="date" class="inputCaja" name="fechaTarea" id="fechaTarea"
                                            aria-describedby="helpId" placeholder="Fecha">
                                    </div>

                                    <div class="mb-3 col-6">
                                        <label for="hora" class="labelTitulo">Hora de Llegada:</label>
                                        <input type="time" class="inputCaja" name="horaTarea" id="horaTarea"
                                            aria-describedby="helpId" placeholder="Fecha">
                                    </div>


                                    <div class="mb-3">
                                        <label for="descripcion" class="labelTitulo">Descripción:</label>
                                        <textarea class="form-control-textarea border-green" name="descripcion" id="descripcionTarea" rows="3"
                                            placeholder="Especifique..."></textarea>
                                    </div>
                                </div>

                            </div>
                            <div class="line"></div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn botonGral">Guardar</button>
                            </div>
                        </form>
                        </fieldset>
                        <fieldset id="tab031">
                            <div class="text-center" style="color:#5C7C26; margin-top: 10px; font-weight: bold;">
                                <h4 class="" style="color:#5C7C26; margin-top: 10px; font-weight: bold;">Añadir Solicitud</h4>
                            </div>

                            <div class="line"></div>
                            <form action="{{ route('solicitudes.store') }}" method="post">
                            <input type="hidden" name="tipo" value="En Espera">
                            <input type="hidden" name="userId" value="{{auth()->user()->id}}">
                            <input type="hidden" name="maquinariaId" id="maquinariaIdSolicitud">
                            <input type="hidden" id="colorBoxHidden" name="color" value="">
                            <div class="container-fluid mt-1">
                                @csrf
                                @method('post')
                                <div class="row">
                                    <input type="hidden" id="colorBoxHiddenSolicitud" name="color" value="">
                                    <input type="hidden" name="tipo" value="En Espera">
                                    <input type="hidden" name="userId" value="{{auth()->user()->id}}">
                                    <div class="col-12 mb-3">
                                        <label for="title" class="labelTitulo">Título:</label>
                                        <input autofocus type="text" class="inputCaja" name="title"
                                            placeholder="Título de Solicitud..." title="Escriba El Título de la Solicitud.">
                                    </div>

                                    <div class="mb-3" role="search">
                                        <label for="title" class="labelTitulo">Buscador Equipo:</label>
                                        <input autofocus type="text" class="inputCaja" id="searchSolicitudes" name="search"
                                            placeholder="Buscar Equipo..." title="Escriba la(s) palabra(s) a buscar.">
                                    </div>

                                        <div class="mb-3 col-6">
                                            <label for="title" class="labelTitulo">Nombre:</label>
                                            <input autofocus type="text" class="inputCaja" id="nombreSolicitud" name="nombre"
                                                placeholder="Nombre Equipo..." readonly>
                                        </div>

                                        <div class="mb-3 col-6">
                                            <label for="title" class="labelTitulo">Número Económico:</label>
                                            <input autofocus type="text" class="inputCaja" id="numeconomicoSolicitud"
                                                name="numeconomico" placeholder="Del Equipo..." readonly>
                                        </div>

                                        <div class="mb-3 col-6">
                                            <label for="title" class="labelTitulo">Placas:</label>
                                            <input autofocus type="text" class="inputCaja" id="placasSolicitud" name="placas"
                                                placeholder="Placas Equipo..." readonly>
                                        </div>

                                        <div class="mb-3 col-6">
                                            <label for="title" class="labelTitulo">Marca:</label>
                                            <input autofocus type="text" class="inputCaja" id="marcaSolicitud"
                                                name="marca" placeholder="Marca Equipo..." readonly>
                                        </div>
                                    <div class="mb-3 col-6">
                                        <label for="prioridad" class="labelTitulo">Prioridad: *</label>
                                        <select name="prioridad" id="prioridadSelectSolicitud" required class="form-select">
                                            <option value="">Seleccione</option>
                                                <option value="Urgente" data-color="#ff0000">
                                                    Urgente
                                                </option>
                                                <option value="Necesaria" data-color="#ffa500">
                                                    Necesaria
                                                </option>
                                                <option value="Deseable" data-color="#ffff00">
                                                    Deseable
                                                </option>
                                                <option value="Prorrogable" data-color="#a6ce34">
                                                    Prorrogable
                                                </option>
                                        </select>
                                    </div>

                                    <div class="mb-3 col-6">
                                        <label for="title" class="labelTitulo">Estado de la Solicitud*:</label>
                                        <select name="estadoId" id="estadoSelectSolicitud" required class="form-select">
                                            <option value="1" selected>En Espera</option>
                                        </select>
                                    </div>

                                    <div class="mb-3 col-6">
                                        <label for="title" class="labelTitulo">Funcionalidad del Equipo*:</label>
                                        <select name="funcionalidad" id="estadoSelectSolicitud" required class="form-select">
                                            <option value="">Seleccione</option>
                                            <option value="No Funciona" selected>No Funciona</option>
                                            <option value="Funciona Poco" selected>Funciona Poco</option>
                                            <option value="Funciona" selected>Funciona</option>
                                        </select>
                                    </div>

                                    <div class="col-12 col-sm-6 mb-3 ">
                                        <label class="labelTitulo">Responsable:</label></br>
                                        <select class="form-select form-select-lg mb-3 inputCaja" name="personalId" id="responsable"
                                            aria-label=".form-select-lg example">
                                            <option value="">Seleccione</option>
                                            @foreach ($personal as $item)
                                                <option value="{{ $item->id }}">
                                                    {{ $item->nombres . ' ' . $item->apellidoP }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="color" class="labelTitulo">Color:</label>
                                        <div id="colorBoxSolicitud" class="color-box w-100" style="margin-left:-0.5px"></div>
                                    </div>
                                    <div class="mb-3 col-6">
                                        <label for="fecha" class="labelTitulo">Fecha de Llegada:</label>
                                        <input type="date" class="inputCaja" name="fechaSolicitud" id="fechaSolicitud"
                                            aria-describedby="helpId" placeholder="Fecha">
                                    </div>

                                    <div class="mb-3 col-6">
                                        <label for="hora" class="labelTitulo">Hora de Llegada:</label>
                                        <input type="time" class="inputCaja" name="horaSolicitud" id="horaSolicitud"
                                            aria-describedby="helpId" placeholder="Fecha">
                                    </div>


                                    <div class="mb-3">
                                        <label for="descripcion" class="labelTitulo">Descripción:</label>
                                        <textarea class="form-control-textarea border-green" name="descripcion" id="descripcionSolicitud" rows="3"
                                            placeholder="Especifique..."></textarea>
                                    </div>
                                </div>

                                <div class="mb-3 text-center">
                                    <h4 style="color:#5c7c26 !important; margin-top: 10px; font-weight: bold;">Añadir Tipos A la Solicitud</h4>

                                    <div class="form-check form-check-inline">
                                        <input type="radio" name="tipo_solicitud" class="form-check-input is-invalid align-self-end mb-2" value="reparacion" id="checkbox_reparacion">
                                        <label for="checkbox_reparacion">Reparación</label><br>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input type="radio" name="tipo_solicitud" class="form-check-input is-invalid align-self-end mb-2" value="combustible" id="checkbox_combustible">
                                        <label for="checkbox_combustible">Combustible</label><br>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input type="radio" name="tipo_solicitud" class="form-check-input is-invalid align-self-end mb-2" value="herramienta" id="checkbox_herramienta">
                                        <label for="checkbox_herramienta">Herramienta</label><br>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input type="radio" name="tipo_solicitud" class="form-check-input is-invalid align-self-end mb-2" value="refaccion" id="checkbox_refaccion">
                                        <label for="checkbox_refaccion">Refacción</label><br>
                                    </div>
                                </div>

                                <!-- Campos tipo de solicitud -->
                                <div id="reparacion_campos" class="campos-solicitud" style="display: none;">
                                    <div class="row">
                                        <div class="col-12 pb-3 text-end">
                                            <button type="button" class="btnVerde"
                                                onclick="crearItemsReparacion()">
                                            </button>
                                        </div>
                                        <div class="opcReparacion">
                                            <div class="row">
                                                <div class="line"></div>
                                                <div class="mb-3 col-11">
                                                    <label for="reparacion" class="labelTitulo">Reparación:</label>
                                                    <input type="text" class="inputCaja" name="reparacionSolicitud[]" id="reparacionSolicitud"
                                                        aria-describedby="helpId" placeholder="Reparacion">
                                                </div>
                                                <div class="col-1 my-3 text-end">
                                                    <button type="button" id="removeRowReparacion"
                                                    class="btnRojo"></button>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="comentarioReparacion" class="labelTitulo">Comentario:</label>
                                                    <textarea class="form-control-textarea border-green" name="comentarioReparacion[]" id="comentarioReparacion" rows="3"
                                                        placeholder="Especifique..."></textarea>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div id="combustible_campos" class="campos-solicitud" style="display: none;">
                                    <div class="row">
                                        <div class="col-12 pb-3 text-end">
                                            <button type="button" class="btnVerde"
                                                onclick="crearItemsCombustible()">
                                            </button>
                                        </div>
                                        <div class="opcCombustible">
                                            <div class="row">
                                                <div class="line"></div>
                                                <div class="mb-3 col-6">
                                                    <label for="litros" class="labelTitulo">Litros:</label>
                                                    <input type="number" class="inputCaja" name="litrosSolicitud" id="litrosSolicitud"
                                                        aria-describedby="helpId" placeholder="Litros">
                                                </div>
                                                <div class="mb-3 col-5">
                                                    <label for="carga" class="labelTitulo">Tipo: *</label>
                                                    <select name="carga[]" id="carga" required class="form-select">
                                                        <option value="carga" selected>Carga</option>
                                                    </select>
                                                </div>
                                                <div class="col-1 my-3 text-end">
                                                    <button type="button" id="removeRowCombustible"
                                                        class="btnRojo"></button>
                                                    </div>

                                                <div class="mb-3">
                                                    <label for="comentarioTarea" class="labelTitulo">Comentario:</label>
                                                    <textarea class="form-control-textarea border-green" name="comentarioTarea[]" id="comentarioTarea" rows="3"
                                                        placeholder="Especifique..."></textarea>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </div>

                                <div id="herramienta_campos" class="campos-solicitud" style="display: none;">
                                    <div class="row">
                                        <div class="col-12 pb-3 text-end">
                                            <button type="button" class="btnVerde"
                                                onclick="crearItemsHerramienta()">
                                            </button>
                                        </div>
                                        <div class="opcHerramienta">
                                            <div class="row">
                                                <div class="line"></div>
                                                <div class="mb-3 col-6">
                                                    <label for="cantidad" class="labelTitulo">Herramienta:</label>
                                                    <select name="herramientaNombre[]" id="herramientaNombre" class="form-select">
                                                        <option value="" >Seleccione</option>
                                                        @foreach ($herramientas as $item)
                                                            <option value="{{ $item->id }}">
                                                                {{ $item->nombre }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mb-3 col-5">
                                                    <label for="cantidad" class="labelTitulo">Cantidad:</label>
                                                    <input type="number" class="inputCaja" name="cantidadSolicitudHerramienta[]" id="cantidadSolicitudHerramienta"
                                                        aria-describedby="helpId" placeholder="Cantidad">
                                                </div>
                                                <div class="col-1 my-3 text-end">
                                                    <button type="button" id="removeRowHerramienta"
                                                        class="btnRojo"></button>
                                                    </div>
                                                <div class="mb-3">
                                                    <label for="comentarioHerramienta" class="labelTitulo">Comentario:</label>
                                                    <textarea class="form-control-textarea border-green" name="comentarioHerramienta[]" id="comentarioHerramienta" rows="3"
                                                        placeholder="Especifique..."></textarea>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </div>

                                <div id="refaccion_campos" class="campos-solicitud" style="display: none;">
                                    <div class="row">
                                        <div class="col-12 pb-3 text-end">
                                            <button type="button" class="btnVerde"
                                                onclick="crearItemsRefaccion()">
                                            </button>
                                        </div>
                                        <div class="opcRefaccion">
                                            <div class="row">
                                                <div class="line"></div>
                                                <div class="mb-3 col-6">
                                                    <label for="refaccion" class="labelTitulo">Refacción:</label>
                                                    <select name="refaccionNombre[]" id="refaccionNombre" class="form-select">
                                                        <option value="" >Seleccione</option>
                                                        @foreach ($refacciones as $item)
                                                            <option value="{{ $item->id }}">
                                                                {{ $item->nombre }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="mb-3 col-5">
                                                    <label for="cantidad" class="labelTitulo">Cantidad:</label>
                                                    <input type="number" class="inputCaja" name="cantidadSolicitudRefaccion[]" id="cantidadSolicitudRefaccion"
                                                        aria-describedby="helpId" placeholder="Cantidad">
                                                </div>
                                                <div class="col-1 my-3 text-end">
                                                    <button type="button" id="removeRowRefaccion"
                                                        class="btnRojo"></button>
                                                    </div>
                                                <div class="mb-3">
                                                    <label for="comentarioRefaccion" class="labelTitulo">Comentario:</label>
                                                    <textarea class="form-control-textarea border-green" name="comentarioRefaccion[]" id="comentarioRefaccion" rows="3"
                                                        placeholder="Especifique..."></textarea>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="line"></div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn botonGral">Guardar</button>
                            </div>
                        </form>
                        </fieldset>
                    </div>

                </div>
            </div>
        </div>  --}}
    </div>
</div>

            <!--<div class="row">
                                                        <div class="col-md-12">
                                                            <div class="card">
                                                                <div class="card-header bacTituloPrincipal">
                                                                    <h4 class="card-title">Calendario MTQ</h4>

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

                                                                            <a href="{{ url('dashMtq') }}">
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
                                                            </div>
                                                        </div>
                                                    </div> -->
        </div>
    </div>

    <script>
        $('#searchS').autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: "{{ route('search.equiposCalendario') }}",
                    dataType: 'json',
                    data: {
                        term: request.term,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        var limitedResults = data.slice(0, 16);
                        response(limitedResults);
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
                // $('#descripcion').val(ui.item.value);
                $('#nombre').val(ui.item.nombre);
                $('#marca').val(ui.item.marca);
                $('#numeconomico').val(ui.item.numserie);
                $('#placas').val(ui.item.placas);
                $('#identificador').val(ui.item.identificador);
            }
        });

        $('#searchMantenimientoEdit').autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: "{{ route('search.equiposCalendario') }}",
                    dataType: 'json',
                    data: {
                        term: request.term,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        var limitedResults = data.slice(0, 16);
                        response(limitedResults);
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
                $('#maquinariaIdMantenimiento').val(ui.item.id);
                // $('#descripcion').val(ui.item.value);
                $('#nombreMantenimiento').val(ui.item.nombre);
                $('#marcaMantenimiento').val(ui.item.marca);
                // $('#modelo').val(ui.item.modelo);
                $('#numeconomicoMantenimiento').val(ui.item.numserie);
                $('#placasMantenimiento').val(ui.item.placas);
            }
        });

        $('#searchSolicitudes').autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: "{{ route('search.equiposCalendario') }}",
                    dataType: 'json',
                    data: {
                        term: request.term,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        var limitedResults = data.slice(0, 16);
                        response(limitedResults);
                    }
                });
            },
            minChars: 1,
            width: 402,
            matchContains: "word",
            autoFill: true,
            minLength: 1,
            select: function(event, ui) {
                console.log('ui',ui.item);
                // Rellenar los campos con los datos de la persona seleccionada
                $('#maquinariaIdSolicitud').val(ui.item.id);
                // $('#descripcion').val(ui.item.value);
                $('#nombreSolicitud').val(ui.item.nombre);
                $('#marcaSolicitud').val(ui.item.marca);
                // $('#modelo').val(ui.item.modelo);
                $('#numeconomicoSolicitud').val(ui.item.numserie);
                $('#placasSolicitud').val(ui.item.placas);
            }
        });
        $('#searchSEdit').autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: "{{ route('search.equiposCalendario') }}",
                    dataType: 'json',
                    data: {
                        term: request.term,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        var limitedResults = data.slice(0, 16);
                        response(limitedResults);
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
                $('#maquinariaIdEdit').val(ui.item.id);
                // $('#descripcion').val(ui.item.value);
                $('#nombreEdit').val(ui.item.nombre);
                $('#marcaEdit').val(ui.item.marca);
                // $('#modelo').val(ui.item.modelo);
                $('#numeconomicoEdit').val(ui.item.numserie);
                $('#placasEdit').val(ui.item.placas);
            }
        });
        $('#searchSEditSolicitud').autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: "{{ route('search.equiposCalendario') }}",
                    dataType: 'json',
                    data: {
                        term: request.term,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        var limitedResults = data.slice(0, 16);
                        response(limitedResults);
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
                $('#maquinariaIdEditSolicitud').val(ui.item.id);
                // $('#descripcion').val(ui.item.value);
                $('#nombreEditSolicitud').val(ui.item.nombre);
                $('#marcaEditSolicitud').val(ui.item.marca);
                // $('#modelo').val(ui.item.modelo);
                $('#numeconomicoEditSolicitud').val(ui.item.numserie);
                $('#placasEditSolicitud').val(ui.item.placas);
            }
        });
    </script>

    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
        integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/luxon@2.0.2/build/global/luxon.min.js"></script>

    <script>
        var calendar;
        document.addEventListener('DOMContentLoaded', function() {
            let myModal = new bootstrap.Modal(document.getElementById('myModal'), {
                keyboard: false
            });
            //let myModalEdit = new bootstrap.Modal(document.getElementById('myModalEdit'), {
              //  keyboard: false
            //});
            let myModalEditMantenimiento = new bootstrap.Modal(document.getElementById('myModalEditMantenimiento'), {
                keyboard: false
            });

            let myModalEditActividad = new bootstrap.Modal(document.getElementById('myModalEditActividad'), {
                keyboard: false
            });

            let myModalEditSolicitud = new bootstrap.Modal(document.getElementById('myModalEditSolicitud'), {
                keyboard: false
            });

            let myModalEditEventoImportante = new bootstrap.Modal(document.getElementById('myModalEditEventoImportante'), {
                keyboard: false
            });

            let myModalEditExpiranDocumentos = new bootstrap.Modal(document.getElementById('myModalEditExpiranDocumentos'), {
                keyboard: false
            });

            let myModalEditDiaFeriado = new bootstrap.Modal(document.getElementById('myModalEditDiaFeriado'), {
                keyboard: false
            });

            var calendarEl = document.getElementById('calendar');
            var eventosJson = {!! $eventosJson !!};
            // Agregar la clase single-day-event a los eventos con la misma fecha (ignorando la hora)
            for (var i = 0; i < eventosJson.length; i++) {
                var evento = eventosJson[i];
                // evento.textColor = evento.color;
                var start = new Date(evento.start);
                var end = new Date(evento.end);
                evento.backgroundColor = evento.color;
                evento.title = evento.nombreServicio != undefined ? evento.nombreServicio + ' ' + evento.title : evento.title;
                //console.log('end',evento.end);
                //if (end == null) {
                 //   console.log('HOLA');
                   // evento.className = 'no-end-event';
                    // evento.allDay = true;
                    // Agrega el atributo data-color al objeto evento
                    // Agrega la información de estilo al evento
                    // evento.styleInfo = {
                    //     backgroundColor: evento.color
                    // };

                //}
                if(evento.tipoEvento == 'DiaFeriado'){
                    evento.allDay = true
                }
            }

            console.log('$eventosJson', eventosJson);
            calendar = new FullCalendar.Calendar(calendarEl, {
                // height: 850,
                dayMaxEventRows: true, // for all non-TimeGrid views
                views: {
                    timeGrid: {
                        dayMaxEventRows: 5,
                    },
                    week: {
                        eventMaxStack: 1,
                        titleFormat: {
                            month: 'long',
                            year: 'numeric',
                            day: 'numeric'
                        }
                    },
                    day: {
                        eventMaxStack: 5,
                    }
                },

                eventMaxStack: true,
                initialView: 'dayGridMonth',
                locale: 'es',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                dateClick: function(informacion) {
                    let permissionName = 'calendarioPrincipal_create';
                    fetch(`/check-permission/${permissionName}`)
                        .then(response => response.json())
                        .then(data => {
                            if (data.hasPermission) {
                                document.getElementById('fecha').value = informacion.dateStr;
                                document.getElementById('fechaTarea').value = informacion.dateStr;
                                document.getElementById('fechaSolicitud').value = informacion.dateStr;
                                myModal.show();

                            } else {
                                alertaNoPermission();
                            }
                        })
                        .catch(error => {
                            console.error("Error al verificar permisos:", error);
                        });

                },
                eventClick: function(informacion) {
                    let permissionName = 'calendarioPrincipal_show';
                    fetch(`/check-permission/${permissionName}`)
                    .then(response => response.json())
                    .then(data => {
                        console.log('Vista Manteniemiento', data);
                        if (data.hasPermission) {
                            if(informacion.event._def.extendedProps.tipoEvento == 'mantenimiento'){
                                myModalEditMantenimiento.show();
                                recuperarDatosEvento(informacion.event);
                            }else if(informacion.event._def.extendedProps.tipoEvento == 'actividades'){
                                myModalEditActividad.show();
                                recuperarDatosEventoActividad(informacion.event);
                                //myModalEdit.show();
                            }else if(informacion.event._def.extendedProps.tipoEvento == 'solicitud'){
                                myModalEditSolicitud.show();
                                recuperarDatosEventoSolicitud(informacion.event);
                            }else if(informacion.event._def.extendedProps.tipoEvento == 'EventoImportante'){
                                myModalEditEventoImportante.show();
                                recuperarDatosEventoEventoImportante(informacion.event);
                            }
                            else if(informacion.event._def.extendedProps.tipoEvento == 'ExpiranDocumentos'){
                                myModalEditExpiranDocumentos.show();
                                recuperarDatosEventoExpiranDocumentos(informacion.event);
                            }
                            else if(informacion.event._def.extendedProps.tipoEvento == 'DiaFeriado'){
                                myModalEditDiaFeriado.show();
                                recuperarDatosEventoDiaFeriado(informacion.event);
                            }

                        } else {
                            alertaNoPermission();
                        }
                    })
                    .catch(error => {
                        console.error("Error al verificar permisos:", error);
                    });

                },
                events: eventosJson,

                dayHeaderFormat: {
                    weekday: 'long',
                    capitalized: true
                },
                datesSet: function(info) {
                    console.log('Vista cambió a:', info.view.type);
                    // if (info.view.type === 'timeGridDay') {
                    //     calendar.setOption('views', {
                    //         timeGrid: {
                    //             eventMaxStack: 10
                    //         }
                    //     });
                    // } else {
                    //     calendar.setOption('views', {
                    //         timeGrid: {
                    //             eventMaxStack: 2
                    //         }
                    //     });
                    // }
                },
                // right: 'dayGridMonth,timeGridWeek,listWeek'
                eventTimeFormat: { // like '14:30:00'
                    hour: '2-digit',
                    minute: '2-digit',
                    hour12: true
                },
                slotLabelFormat: {
                    hour: 'numeric',
                    minute: '2-digit',
                    meridiem: 'short'
                }

            });
            if (window.innerWidth > 1200) {
                calendar.setOption('contentHeight', 770);
            }
            calendar.render();
        });
    </script>

    <script>
        const filtroTipoEvento = document.getElementById('filtroTipoEvento');
        var eventosJson = {!! $eventosJson !!};
        // Manejar evento de cambio en el select
        filtroTipoEvento.addEventListener('change', function() {
            const selectedTipoEvento = this.value;

            // Filtrar eventos basados en el tipo seleccionado
            const eventosFiltrados = eventosJson.filter(evento => {
                return selectedTipoEvento === 'todos' || evento.tipoEvento === selectedTipoEvento;
            });
            actualizarEventos(eventosFiltrados);
            
        });
    </script>

    <script>
        function actualizarEventos(eventos) {
            calendar.removeAllEvents(); // Eliminar todos los eventos actuales
            calendar.addEventSource(eventos); // Agregar los nuevos eventos
            calendar.refetchEvents(); // Actualizar la vista con los nuevos eventos
        }
    </script>

    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
    crossorigin="anonymous"></script>

    <script>
        function crearItemsReparacion() {
            $('.opcReparacion:first').clone().find("input").val("").end().appendTo('#reparacion_campos');
        }

        $(document).on('click', '#removeRowReparacion', function() {
            if ($('.opcReparacion').length > 1) {
                $(this).closest('.opcReparacion').remove();
            }
        });
    </script>

    <script>
        function crearItemsCombustible() {
            $('.opcCombustible:first').clone().find("input").val("").end().appendTo('#combustible_campos');
        }

        // Borrar registro
        $(document).on('click', '#removeRowCombustible', function() {
            if ($('.opcCombustible').length > 1) {
                $(this).closest('.opcCombustible').remove();
            }
        });
    </script>

    <script>
        function crearItemsHerramienta() {
            $('.opcHerramienta:first').clone().find("input").val("").end().appendTo('#herramienta_campos');
        }

        $(document).on('click', '#removeRowHerramienta', function() {
            if ($('.opcHerramienta').length > 1) {
                $(this).closest('.opcHerramienta').remove();
            }
        });
    </script>

    <script>
        function crearItemsRefaccion() {
            $('.opcRefaccion:first').clone().find("input").val("").end().appendTo('#refaccion_campos');
        }

        $(document).on('click', '#removeRowRefaccion', function() {
            if ($('.opcRefaccion').length > 1) {
                $(this).closest('.opcRefaccion').remove();
            }
        });
    </script>

    <style>
        body {
            color: #000;
            overflow-x: hidden;
            height: 100%;

            background-repeat: no-repeat;
        }

        .container {
            margin: 200px auto;
        }

        fieldset {
            display: none;
        }

        fieldset.show {
            display: block;
        }

        select:focus, input:focus {
            -moz-box-shadow: none !important;
            -webkit-box-shadow: none !important;
            box-shadow: none !important;
            border: 1px solid #a6ce34 !important;
            outline-width: 0 !important;
            font-weight: 400;
        }

        button:focus {
            -moz-box-shadow: none !important;
            -webkit-box-shadow: none !important;
            box-shadow: none !important;
            outline-width: 0;
        }

        .tabs {
            margin: 2px 5px 0px 5px;
            padding-bottom: 10px;
            cursor: pointer;
        }

        .tabs:hover, .tabs.active {
            border-bottom: 5px solid #a6ce34;
        }

        a:hover {
            text-decoration: none;
            color: #5c7c26;
        }

        .box {
            margin-bottom: 10px;
            border-radius: 5px;
            padding: 10px;
        }

          .modal-header-multiple {
            display: flex;
            justify-content: space-between;
          }

          .modal-header-multiple .tabs {
            flex: 1;
            text-align: center; /* Opcional: centrar contenido horizontalmente */

          }

          .modal-header-multiple {
            display: grid;
            grid-template-columns: repeat(3, 1fr); /* 4 columnas con el mismo ancho */
            gap: 1px; /* Espacio entre columnas */
            align-items: center; /* Alinea verticalmente en el centro */
          }

          /* Opcional: Estilos adicionales para las columnas activas */
          .modal-header-multiple .tabs.active {
            color: #5c7c26;
            font-weight: 1000 !important;
            border-radius: 5px;
          }
        .line {
            background-color: #f7cd22;
            height: 2px;
            width: 100%;
        }
        .filtroTipoEvento{
            font-weight: bold;
            background-color: #5c7c26;
            color: white;
        }

        .filtroTipoEvento option {
            font-weight: bold;
            background-color: #5c7c26;
            color: white;
        }

        /* Estilos para la opción seleccionada y en foco */
        .filtroTipoEvento option:checked:focus {
            font-weight: bold;
            background-color: #5c7c26;
            color: white;
        }

        .filtroTipoEvento:focus {
            font-weight: bold;
            background-color: #5c7c26;
            color: white;
        }

        @media screen and (max-width: 768px) {
            .tabs h6 {
                font-size: 12px;
            }
            .filtroTipoEvento{
                font-size: 12px !important;
                white-space: nowrap !important;
            }
            .tituloPrincipalCentrado{
                font-size: 12px !important;
                white-space: nowrap !important;
            }
        }

        .radio-buttons input[type="radio"] {
            display: inline-block !important;
            margin-right: 10px !important; /* Espacio entre los radio buttons */
        }
                
        
    </style>

    <script>
        $(document).ready(function(){

            $(".tabs").click(function(){

                $(".tabs").removeClass("active");
                $(".tabs h6").removeClass("font-weight-bold");
                $(".tabs h6").addClass("text-muted");
                $(this).children("h6").removeClass("text-muted");
                $(this).children("h6").addClass("font-weight-bold");
                $(this).addClass("active");

                current_fs = $(".active");

                next_fs = $(this).attr('id');
                next_fs = "#" + next_fs + "1";

                $("fieldset").removeClass("show");
                $(next_fs).addClass("show");

                current_fs.animate({}, {
                    step: function() {
                        current_fs.css({
                            'display': 'none',
                            'position': 'relative'
                        });
                        next_fs.css({
                            'display': 'block'
                        });
                    }
                });
            });

            });
    </script>

    <script>
        function generarDiasFeriados(anoActual) {
            const url = `https://api.generadordni.es/v2/holidays/holidays?country=MX&year=${anoActual}`;
            fetch(url)
            .then(response => response.json())
            .then(data => {
                enviarDatosAlControlador( data );
            })
            .catch(error => {
                console.error(error);
            });
        }

        function enviarDatosAlControlador(data) {
            fetch('/generarDiasFeriados', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}', // Asegúrate de tener el token CSRF válido
                },
                body: JSON.stringify({ days: data }), // Envia los datos al controlador en formato JSON
            })
            .then(response => {
                // Maneja la respuesta del controlador si es necesario
                console.log('Datos enviados al controlador');
            })
            .catch(error => {
                console.error(error);
            });
        }

        function recuperarDatosEvento(evento) {
            console.log('info Modal', evento);

            let fecha = evento._instance.range.start;
            let fechaObj = new Date(fecha);
            let fechaFormateada = fechaObj.toISOString().split("T")[0];
            let horaFormateada = fechaObj.toLocaleTimeString("es-MX", {
                hour12: false
            });
            let stringFecha = fechaFormateada + ' ' + horaFormateada;
            // Convertir al objeto DateTime con formato personalizado
            var startObj = luxon.DateTime.fromFormat(stringFecha, "yyyy-MM-dd HH:mm:ss");

            // Restar 6 horas
            var start6Hours = startObj.plus({
                hours: 6
            });

            // Obtener la hora local de México
            var startLocal = start6Hours.setZone("America/Mexico_City").toLocal();
            var formattedTime = startLocal.toFormat("HH:mm:ss");
            // var horaModal = startLocal.c.
            console.log('start', startLocal);
            console.log('fechaObj', fechaObj);
            //fechaEdit = evento._def.extendedProps.fecha;
            let fechaEdit = evento._instance.range.end;
            let fechaEditObj = new Date(fechaEdit);
            let fechaEditFormateada = evento._def.extendedProps.estatus != 0 ? fechaEditObj.toISOString().split("T")[0] :
                null;
            let horaEditFormateada = fechaEditObj.toLocaleTimeString("es-MX", {
                hour12: false
            });
            let stringFechaEdit = fechaEditFormateada + ' ' + horaEditFormateada;
            // Convertir al objeto DateTime con formato personalizado
            var startObjEdit = luxon.DateTime.fromFormat(stringFechaEdit, "yyyy-MM-dd HH:mm:ss");

            // Restar 6 horas
            var start6HoursEdit = startObjEdit.plus({
                hours: 6
            });

            // Obtener la hora local de México
            var startLocalEdit = start6HoursEdit.setZone("America/Mexico_City").toLocal();
            var formattedTimeEdit = startLocalEdit.toFormat("HH:mm:ss");
            console.log('fechaSalida', evento);


            document.getElementById('fechaEdit').value = fechaFormateada;

            document.getElementById('horaEdit').value = formattedTime;
            // if(fechaSalida)
            if(evento._def.hasEnd){
                console.log('FEHCASSSSSS EDITADA');
                console.log('fechaEditFormateada',fechaEditFormateada);
                console.log('fechaEditFormateada',formattedTimeEdit);
                document.getElementById('fechaSalida').value = fechaEditFormateada;
                document.getElementById('horaSalida').value = formattedTimeEdit;
            }else{
                console.log('FEHCASSSSSS NO EDITADA');
            }

            //fechaEdit = evento._def.extendedProps.fecha;

            document.getElementById('titleSelectEdit').value = evento._def.extendedProps.tipoMantenimientoId;
            document.getElementById('responsableEdit').value = evento._def.extendedProps.personalId;
            document.getElementById("colorBoxEdit").style.backgroundColor = evento._def.ui.backgroundColor;
            document.getElementById('descripcionEdit').value = evento._def.extendedProps.descripcion;

            let marca = evento._def.extendedProps.marcaId;
            let nombre = evento._def.extendedProps.nombre;
            let numeconomico = evento._def.extendedProps.numeconomico;
            let placas = evento._def.extendedProps.placas;

            console.log('marca',marca);
            console.log('nombre',nombre);
            console.log('numeconomico',numeconomico);
            console.log('placas',placas);
            console.log('evento', evento);

            document.getElementById('marcaEdit').value = marca;
            document.getElementById('nombreEdit').value = nombre;
            document.getElementById('numeconomicoEdit').value = numeconomico;
            document.getElementById('placasEdit').value = placas;
            //document.getElementById('searchSEdit').value =  'Equipo ' . nombre . ', Marca ' . marca . ', N. ECO. ' . numeconomico . ', Placas ' .  placas;
            document.getElementById('id').value = evento._def.publicId;
            // document.getElementById('editarCampos').id =  "editarCampos" + evento._def.publicId;
        }

        function recuperarDatosEventoActividad(evento) {
            console.log('info Modal', evento);

            let fecha = evento._instance.range.start;
            let fechaObj = new Date(fecha);
            let fechaFormateada = fechaObj.toISOString().split("T")[0];
            let horaFormateada = fechaObj.toLocaleTimeString("es-MX", {
                hour12: false
            });
            let stringFecha = fechaFormateada + ' ' + horaFormateada;
            // Convertir al objeto DateTime con formato personalizado
            var startObj = luxon.DateTime.fromFormat(stringFecha, "yyyy-MM-dd HH:mm:ss");

            // Restar 6 horas
            var start6Hours = startObj.plus({
                hours: 6
            });

            // Obtener la hora local de México
            var startLocal = start6Hours.setZone("America/Mexico_City").toLocal();
            var formattedTime = startLocal.toFormat("HH:mm:ss");
            // var horaModal = startLocal.c.
            console.log('start', startLocal);
            console.log('fechaObj', fechaObj);
            //fechaEdit = evento._def.extendedProps.fecha;
            let fechaEdit = evento._instance.range.end;
            let fechaEditObj = new Date(fechaEdit);
            let fechaEditFormateada = evento._def.extendedProps.estatus != 0 ? fechaEditObj.toISOString().split("T")[0] :
                null;
            let horaEditFormateada = fechaEditObj.toLocaleTimeString("es-MX", {
                hour12: false
            });
            let stringFechaEdit = fechaEditFormateada + ' ' + horaEditFormateada;
            // Convertir al objeto DateTime con formato personalizado
            var startObjEdit = luxon.DateTime.fromFormat(stringFechaEdit, "yyyy-MM-dd HH:mm:ss");

            // Restar 6 horas
            var start6HoursEdit = startObjEdit.plus({
                hours: 6
            });

            // Obtener la hora local de México
            var startLocalEdit = start6HoursEdit.setZone("America/Mexico_City").toLocal();
            var formattedTimeEdit = startLocalEdit.toFormat("HH:mm:ss");
            console.log('fechaSalida', evento);


            document.getElementById('fechaEditTarea').value = fechaFormateada;

            document.getElementById('horaEditTarea').value = formattedTime;
            // if(fechaSalida)
            if(evento._def.hasEnd){
                console.log('FEHCASSSSSS EDITADA');
                console.log('fechaEditFormateada',fechaEditFormateada);
                console.log('fechaEditFormateada',formattedTimeEdit);
                document.getElementById('fechaSalidaTarea').value = fechaEditFormateada;
                document.getElementById('horaSalidaTarea').value = formattedTimeEdit;
            }else{
                console.log('FEHCASSSSSS NO EDITADA');
            }

            //fechaEdit = evento._def.extendedProps.fecha;
            console.log('evento._def.extendedProps.title', evento._def.title);
            document.getElementById('titleEditTarea').value = evento._def.title;
            document.getElementById('prioridadEditTarea').value = evento._def.extendedProps.actividad_prioridad;
            document.getElementById('estadoIdTarea').value = evento._def.extendedProps.estadoId;
            document.getElementById('responsableEditTarea').value = evento._def.extendedProps.personalId;
            document.getElementById("colorBoxEditTarea").style.backgroundColor = evento._def.ui.backgroundColor;
            document.getElementById('descripcionEditTarea').value = evento._def.extendedProps.descripcion;

            //document.getElementById('searchSEdit').value =  'Equipo ' . nombre . ', Marca ' . marca . ', N. ECO. ' . numeconomico . ', Placas ' .  placas;
            document.getElementById('idTareaModal').value = evento._def.publicId;
            // document.getElementById('editarCampos').id =  "editarCampos" + evento._def.publicId;
        }

        function recuperarDatosEventoSolicitud(evento) {
            console.log('info Modal', evento);

            let fecha = evento._instance.range.start;
            let fechaObj = new Date(fecha);
            let fechaFormateada = fechaObj.toISOString().split("T")[0];
            let horaFormateada = fechaObj.toLocaleTimeString("es-MX", {
                hour12: false
            });
            let stringFecha = fechaFormateada + ' ' + horaFormateada;
            // Convertir al objeto DateTime con formato personalizado
            var startObj = luxon.DateTime.fromFormat(stringFecha, "yyyy-MM-dd HH:mm:ss");

            // Restar 6 horas
            var start6Hours = startObj.plus({
                hours: 6
            });

            // Obtener la hora local de México
            var startLocal = start6Hours.setZone("America/Mexico_City").toLocal();
            var formattedTime = startLocal.toFormat("HH:mm:ss");
            // var horaModal = startLocal.c.
            console.log('start', startLocal);
            console.log('fechaObj', fechaObj);
            //fechaEdit = evento._def.extendedProps.fecha;
            let fechaEdit = evento._instance.range.end;
            let fechaEditObj = new Date(fechaEdit);
            let fechaEditFormateada = evento._def.extendedProps.estatus != 0 ? fechaEditObj.toISOString().split("T")[0] :
                null;
            let horaEditFormateada = fechaEditObj.toLocaleTimeString("es-MX", {
                hour12: false
            });
            let stringFechaEdit = fechaEditFormateada + ' ' + horaEditFormateada;
            // Convertir al objeto DateTime con formato personalizado
            var startObjEdit = luxon.DateTime.fromFormat(stringFechaEdit, "yyyy-MM-dd HH:mm:ss");

            // Restar 6 horas
            var start6HoursEdit = startObjEdit.plus({
                hours: 6
            });

            // Obtener la hora local de México
            var startLocalEdit = start6HoursEdit.setZone("America/Mexico_City").toLocal();
            var formattedTimeEdit = startLocalEdit.toFormat("HH:mm:ss");
            console.log('fechaSalida', evento);


            document.getElementById('fechaEditSolicitud').value = fechaFormateada;

            document.getElementById('horaEditSolicitud').value = formattedTime;
            // if(fechaSalida)
            if(evento._def.hasEnd){
                console.log('FEHCASSSSSS EDITADA');
                console.log('fechaEditFormateada',fechaEditFormateada);
                console.log('fechaEditFormateada',formattedTimeEdit);
                document.getElementById('fechaSalidaSolicitud').value = fechaEditFormateada;
                document.getElementById('horaSalidaSolicitud').value = formattedTimeEdit;
            }else{
                console.log('FEHCASSSSSS NO EDITADA');
            }

            //fechaEdit = evento._def.extendedProps.fecha;
            document.getElementById('titleEditSolicitud').value = evento._def.title;
            document.getElementById('prioridadEditSolicitud').value = evento._def.extendedProps.solicitud_prioridad;
            document.getElementById('funcionalidadSolicitud').value = evento._def.extendedProps.funcionalidad;
            document.getElementById('responsableEditSolicitud').value = evento._def.extendedProps.personalId;
            document.getElementById("colorBoxEditSolicitud").style.backgroundColor = evento._def.ui.backgroundColor;
            document.getElementById('descripcionEditSolicitud').value = evento._def.extendedProps.descripcion;

            let marca = evento._def.extendedProps.marcaId;
            let nombre = evento._def.extendedProps.nombre;
            let numeconomico = evento._def.extendedProps.numeconomico;
            let placas = evento._def.extendedProps.placas;

            console.log('marca',marca);
            console.log('nombre',nombre);
            console.log('numeconomico',numeconomico);
            console.log('placas',placas);
            console.log('evento', evento);

            document.getElementById('marcaEditSolicitud').value = marca;
            document.getElementById('nombreEditSolicitud').value = nombre;
            document.getElementById('numeconomicoEditSolicitud').value = numeconomico;
            document.getElementById('placasEditSolicitud').value = placas;
            //document.getElementById('searchSEdit').value =  'Equipo ' . nombre . ', Marca ' . marca . ', N. ECO. ' . numeconomico . ', Placas ' .  placas;
            document.getElementById('idSolicitud').value = evento._def.publicId;

            let labelReparacion = document.getElementById('labelReparacion');
            let labelReparacionCombustible = document.getElementById('labelReparacionCombustible');
            let labelReparacionHerramienta = document.getElementById('labelReparacionHerramienta');
            let labelReparacionRefaccion = document.getElementById('labelReparacionRefaccion');

            let solicitudId = evento._def.extendedProps.solicitudesId;
            document.getElementById('solicitudIdDetalle').value = solicitudId;
            console.log('SOLICITUD ID que se envia al fetch',solicitudId);
            const container = document.getElementById('detalleSolicitud');
            fetch(`/solicitud-detalle/${solicitudId}`)
            .then(response => response.json())
            .then(data => {
                console.log('data',data);
                if (data && data.length > 0) {
                    // Supongamos que 'data' contiene los detalles de la solicitud
                    const modalContenedor = document.getElementById('detalleSolicitud');

                    // Construye el contenido que deseas agregar al modal
                    let contenidoModal = `<div class="text-end">
                        <h5 style="color:#5c7c26 !important; margin-top: 10px; font-weight: bold;" class="text-center">Modificar los Registros en la Solicitud</h5>
                        <button type="button" class="btnVerde"
                            onclick="${data[0].tipo == 'refaccion' ? 'crearItemsRefaccion()' : data[0].tipo == 'reparacion' ? 'crearItemsReparacion()' : data[0].tipo == 'herramienta' ? 'crearItemsHerramienta()' : data[0].tipo == 'herramienta' ? 'crearItemsHerramienta()' : 'crearItemsCombustible()'}">
                        </button>

                    </div>`;
                    switch (data[0].tipo) {
                        case 'reparacion':
                            labelReparacion.style.display = 'block';
                            labelReparacionHerramienta.style.display = 'none';
                            labelReparacionCombustible.style.display = 'none';
                            labelReparacionRefaccion.style.display = 'none';
                            break;
                        case 'combustible':
                            labelReparacionCombustible.style.display = 'block';
                            labelReparacion.style.display = 'none';
                            labelReparacionHerramienta.style.display = 'none';
                            labelReparacionRefaccion.style.display = 'none';
                            break;
                        case 'herramienta':
                            labelReparacionHerramienta.style.display = 'block';
                            labelReparacionCombustible.style.display = 'none';
                            labelReparacion.style.display = 'none';
                            labelReparacionRefaccion.style.display = 'none';
                            break;
                        case 'refaccion':
                            labelReparacionRefaccion.style.display = 'block';
                            labelReparacionHerramienta.style.display = 'none';
                            labelReparacionCombustible.style.display = 'none';
                            labelReparacion.style.display = 'none';
                            break;
                    }

                    // Suponiendo que 'data' es una matriz de detalles
                    data.forEach(detalle => {
                        console.log('detalle.tipo',detalle);
                        if(detalle.tipo == 'refaccion'){
                            contenidoModal += `<div id="refaccion_campos" class="campos-solicitud">
                                <div class="row">
                                    <div class="opcRefaccion text-start">
                                        <div class="row">
                                            <div class="line mb-2"></div>
                                            <input type="hidden" name="detalleTipo[]" value="${detalle.tipo}">
                                            <input type="hidden" name="idRefaccion[]" value="${detalle.id}">
                                            <div class="mb-3 col-6">
                                                <label for="refaccion" class="labelTitulo">Refacción:</label>
                                                <select name="refaccionNombre[]" id="refaccionNombre${detalle.id}" class="form-select">
                                                    @foreach ($refacciones as $item)
                                                        <option value="{{ $item->id }}">
                                                            {{ $item->nombre }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="mb-3 col-5">
                                                <label for="cantidad" class="labelTitulo">Cantidad:</label>
                                                <input type="number" class="inputCaja detalleSolicitud" name="cantidadRefaccion[]" id="cantidadSolicitudRefaccion"
                                                    aria-describedby="helpId" placeholder="Cantidad" value="${detalle.cantidad}">
                                            </div>

                                            <div class="col-1" style="margin-left: -5px;"><button type="button" id="removeRowRefaccion"
                                                class="btnRojo"></button></div>

                                            <div class="mb-3">
                                                <label for="comentarioRefaccion" class="labelTitulo">Comentario:</label>
                                                <textarea class="form-control-textarea border-green" name="comentarioRefaccion[]" id="comentarioRefaccion" rows="3"
                                                    placeholder="Especifique...">${detalle.comentario}</textarea>
                                            </div>
                                    </div>
                                </div>
                            </div>`;


                        }
                        if(detalle.tipo == 'herramienta'){
                            contenidoModal += `<div id="herramienta_campos" class="campos-solicitud">
                                <div class="row">

                                    <div class="opcHerramienta text-start">
                                        <div class="row">
                                            <div class="line mb-2"></div>
                                            <input type="hidden" name="detalleTipo[]" value="${detalle.tipo}">
                                            <input type="hidden" name="idHerramienta[]" value="${detalle.id}">
                                            <div class="mb-3 col-6">
                                                <label for="herramienta" class="labelTitulo">Herramienta:</label>
                                                <select name="herramientaNombre[]" id="herramientaNombre${detalle.id}" class="form-select">
                                                    @foreach ($herramientas as $item)
                                                        <option value="{{ $item->id }}">
                                                            {{ $item->nombre }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="mb-3 col-5">
                                                <label for="cantidad" class="labelTitulo">Cantidad:</label>
                                                <input type="number" class="inputCaja" name="cantidadHerramienta[]" id="cantidadSolicitudHerramienta"
                                                    aria-describedby="helpId" placeholder="Cantidad" value="${detalle.cantidad}">
                                            </div>

                                            <div class="col-1" style="margin-left: -5px;"><button type="button" id="removeRowHerramienta"
                                                class="btnRojo"></button></div>

                                            <div class="mb-3">
                                                <label for="comentarioHerramienta" class="labelTitulo">Comentario:</label>
                                                <textarea class="form-control-textarea border-green" name="comentarioHerramienta[]" id="comentarioHerramienta" rows="3"
                                                    placeholder="Especifique...">${detalle.comentario}</textarea>
                                            </div>
                                    </div>
                                </div>
                            </div>`;

                        }
                        if(detalle.tipo == 'reparacion'){
                            contenidoModal += `<div id="reparacion_campos" class="campos-solicitud">
                                <div class="row">

                                    <div class="opcReparacion text-start">
                                        <div class="row">
                                            <div class="line mb-2"></div>
                                            <input type="hidden" name="detalleTipo[]" value="${detalle.tipo}">
                                            <input type="hidden" name="idReparacion[]" value="${detalle.id}">
                                            <div class="mb-3 col-11">
                                                <label for="reparacion" class="labelTitulo">Reparación:</label>
                                                <input type="text" class="inputCaja" name="reparacionSolicitud[]" id="reparacionSolicitud"
                                                    aria-describedby="helpId" placeholder="Reparacion" value="${detalle.reparacion}">
                                            </div>

                                            <div class="col-1" style="margin-left: -5px;"><button type="button" id="removeRowReparacion"
                                                class="btnRojo"></button></div>

                                            <div class="mb-3">
                                                <label for="comentarioReparacion" class="labelTitulo">Comentario:</label>
                                                <textarea class="form-control-textarea border-green" name="comentarioReparacion[]" id="comentarioReparacion" rows="3"
                                                    placeholder="Especifique...">${detalle.comentario}</textarea>
                                            </div>
                                    </div>
                                </div>
                            </div>`;
                        }

                        if(detalle.tipo == 'combustible'){
                            contenidoModal += `<div id="combustible_campos" class="campos-solicitud">
                                <div class="row">

                                    <div class="opcCombustible text-start">
                                        <div class="row">
                                            <div class="line mb-2"></div>
                                            <input type="hidden" name="detalleTipo[]" value="${detalle.tipo}">
                                            <input type="hidden" name="idCombustible[]" value="${detalle.id}">
                                            <div class="mb-3 col-6">
                                                <label for="litros" class="labelTitulo">Litros:</label>
                                                <input type="number" class="inputCaja" name="litros[]" id="litrosSolicitud"
                                                    aria-describedby="helpId" placeholder="Litros" value="${detalle.litros}">
                                            </div>
                                            <div class="mb-3 col-5">
                                                <label for="carga" class="labelTitulo">Tipo*:</label>
                                                <select name="carga[]" id="carga" required class="form-select">
                                                    <option value="carga" selected>Carga</option>
                                                </select>
                                            </div>

                                            <div class="col-1 my-3 text-end">
                                                <button type="button" id="removeRowCombustible"
                                                    class="btnRojo"></button>
                                                </div>

                                            <div class="mb-3">
                                                <label for="comentarioCombustible" class="labelTitulo">Comentario:</label>
                                                <textarea class="form-control-textarea border-green" name="comentarioCombustible[]" id="comentarioCombustible" rows="3"
                                                    placeholder="Especifique...">${detalle.comentario}</textarea>
                                            </div>
                                    </div>
                                </div>
                            </div>`;

                        }

                    });
                    contenidoModal += '</div>';
                    modalContenedor.innerHTML = contenidoModal;

                    data.forEach( item => {
                        if(item.tipo == 'refaccion'){
                        const selectRefaccion = document.getElementById(`refaccionNombre${item.id}`);
                        console.log('selectRefaccion',selectRefaccion);
                        for (let i = 0; i < selectRefaccion.options.length; i++) {
                            if (selectRefaccion.options[i].value == item.inventarioId) {
                                // selectRefaccion.options[i].selected = true;
                                selectRefaccion.selectedIndex = i;
                            }
                        }

                        } else if(item.tipo == 'herramienta'){
                            const selectHerramienta = document.getElementById(`herramientaNombre${item.id}`);
                            console.log('selectHerramienta',selectHerramienta);
                            for (let i = 0; i < selectHerramienta.options.length; i++) {
                                if (selectHerramienta.options[i].value == item.inventarioId) {
                                    // selectHerramienta.options[i].selected = true;
                                    selectHerramienta.selectedIndex = i;
                                }
                            }
                        }
                    });


                } else {
                    console.log('NO HAY DETALLE para esa solicitud');
                }

            });
            let myModalEditSolicitud = new bootstrap.Modal(document.getElementById('myModalEditSolicitud'), {
                keyboard: false
            });
            myModalEditSolicitud.show();
        }

        function recuperarDatosEventoEventoImportante(evento) {
            console.log('info Modal', evento);

            let fecha = evento._instance.range.start;
            let fechaObj = new Date(fecha);
            let fechaFormateada = fechaObj.toISOString().split("T")[0];
            let horaFormateada = fechaObj.toLocaleTimeString("es-MX", {
                hour12: false
            });
            let stringFecha = fechaFormateada + ' ' + horaFormateada;
            // Convertir al objeto DateTime con formato personalizado
            var startObj = luxon.DateTime.fromFormat(stringFecha, "yyyy-MM-dd HH:mm:ss");

            // Restar 6 horas
            var start6Hours = startObj.plus({
                hours: 6
            });

            // Obtener la hora local de México
            var startLocal = start6Hours.setZone("America/Mexico_City").toLocal();
            var formattedTime = startLocal.toFormat("HH:mm:ss");
            // var horaModal = startLocal.c.
            console.log('start', startLocal);
            console.log('fechaObj', fechaObj);
            //fechaEdit = evento._def.extendedProps.fecha;
            let fechaEdit = evento._instance.range.end;
            let fechaEditObj = new Date(fechaEdit);
            console.log('AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA', fechaEditObj.toISOString().split("T")[0]);
            let fechaEditFormateada = fechaEditObj.toISOString().split("T")[0];
            let horaEditFormateada = fechaEditObj.toLocaleTimeString("es-MX", {
                hour12: false
            });
            let stringFechaEdit = fechaEditFormateada + ' ' + horaEditFormateada;
            // Convertir al objeto DateTime con formato personalizado
            var startObjEdit = luxon.DateTime.fromFormat(stringFechaEdit, "yyyy-MM-dd HH:mm:ss");

            // Restar 6 horas
            var start6HoursEdit = startObjEdit.plus({
                hours: 6
            });

            // Obtener la hora local de México
            var startLocalEdit = start6HoursEdit.setZone("America/Mexico_City").toLocal();
            var formattedTimeEdit = startLocalEdit.toFormat("HH:mm:ss");
            console.log('fechaSalida', evento);

            document.getElementById('fechaEditEventoImportante').value = fechaFormateada;            
            document.getElementById('horaEditEventoImportante').value = formattedTime;
            
            // if(fechaSalida)
            if(evento._def.hasEnd){
                console.log('FEHCASSSSSS EDITADA');
                console.log('fechaEditFormateada',fechaEditFormateada);
                console.log('fechaEditFormateada',formattedTimeEdit);
                document.getElementById('fechaSalidaEventoImportante').value = fechaEditFormateada;
                document.getElementById('horaSalidaEventoImportante').value = formattedTimeEdit;
            }else{
                console.log('FEHCASSSSSS NO EDITADA');
            }

            //fechaEdit = evento._def.extendedProps.fecha;
            console.log('evento._def.extendedProps.title', evento._def.title);
            document.getElementById('titleEditEventoImportante').value = evento._def.title;
            document.getElementById("colorBoxEditEventoImportante").style.backgroundColor = evento._def.ui.backgroundColor;
            document.getElementById('descripcionEditEventoImportante').value = evento._def.extendedProps.descripcion;

            //document.getElementById('searchSEdit').value =  'Equipo ' . nombre . ', Marca ' . marca . ', N. ECO. ' . numeconomico . ', Placas ' .  placas;
            document.getElementById('idEventoImportanteModal').value = evento._def.publicId;
            // document.getElementById('editarCampos').id =  "editarCampos" + evento._def.publicId;
        }

        function recuperarDatosEventoExpiranDocumentos(evento) {
            console.log('info Modal', evento);

            let fecha = evento._instance.range.start;
            let fechaObj = new Date(fecha);
            let fechaFormateada = fechaObj.toISOString().split("T")[0];
            let horaFormateada = fechaObj.toLocaleTimeString("es-MX", {
                hour12: false
            });
            let stringFecha = fechaFormateada + ' ' + horaFormateada;
            // Convertir al objeto DateTime con formato personalizado
            var startObj = luxon.DateTime.fromFormat(stringFecha, "yyyy-MM-dd HH:mm:ss");

            // Restar 6 horas
            var start6Hours = startObj.plus({
                hours: 6
            });

            // Obtener la hora local de México
            var startLocal = start6Hours.setZone("America/Mexico_City").toLocal();
            var formattedTime = startLocal.toFormat("HH:mm:ss");
            // var horaModal = startLocal.c.
            console.log('start', startLocal);
            console.log('fechaObj', fechaObj);
            //fechaEdit = evento._def.extendedProps.fecha;
            let fechaEdit = evento._instance.range.end;
            let fechaEditObj = new Date(fechaEdit);
            console.log('AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA', fechaEditObj.toISOString().split("T")[0]);
            let fechaEditFormateada = fechaEditObj.toISOString().split("T")[0];
            let horaEditFormateada = fechaEditObj.toLocaleTimeString("es-MX", {
                hour12: false
            });
            let stringFechaEdit = fechaEditFormateada + ' ' + horaEditFormateada;
            // Convertir al objeto DateTime con formato personalizado
            var startObjEdit = luxon.DateTime.fromFormat(stringFechaEdit, "yyyy-MM-dd HH:mm:ss");

            // Restar 6 horas
            var start6HoursEdit = startObjEdit.plus({
                hours: 6
            });

            // Obtener la hora local de México
            var startLocalEdit = start6HoursEdit.setZone("America/Mexico_City").toLocal();
            var formattedTimeEdit = startLocalEdit.toFormat("HH:mm:ss");
            console.log('fechaSalida', evento);

            document.getElementById('fechaEditExpiranDocumentos').value = fechaFormateada;            
            document.getElementById('horaEditExpiranDocumentos').value = formattedTime;
            
            // if(fechaSalida)
            if(evento._def.hasEnd){
                console.log('FEHCASSSSSS EDITADA');
                console.log('fechaEditFormateada',fechaEditFormateada);
                console.log('fechaEditFormateada',formattedTimeEdit);
                document.getElementById('fechaSalidaExpiranDocumentos').value = fechaEditFormateada;
                document.getElementById('horaSalidaExpiranDocumentos').value = formattedTimeEdit;
            }else{
                console.log('FEHCASSSSSS NO EDITADA');
            }

            //fechaEdit = evento._def.extendedProps.fecha;
            console.log('evento._def.extendedProps.title', evento._def.title);
            document.getElementById('titleEditExpiranDocumentos').value = evento._def.title;
            document.getElementById("colorBoxEditExpiranDocumentos").style.backgroundColor = evento._def.ui.backgroundColor;
            document.getElementById('descripcionEditExpiranDocumentos').value = evento._def.extendedProps.descripcion;

            let nombre = evento._def.extendedProps.nombre;
            let numeconomico = evento._def.extendedProps.numeconomico;
            let placas = evento._def.extendedProps.placas;

            let nombrePersonal = evento._def.extendedProps.personalNombre + evento._def.extendedProps.personalApellidoP;
            let email = evento._def.extendedProps.email;
            let celular = evento._def.extendedProps.celular;

            console.log('marca',marca);
            console.log('nombre',nombre);
            console.log('numeconomico',numeconomico);
            console.log('placas',placas);
            console.log('evento', evento);

            if(evento._def.extendedProps.maquinariaId != null){
                var enlace = document.getElementById('linkExpiranDocumentos');
                enlace.innerHTML = evento._def.extendedProps.nombre;
                enlace.href =  'maquinaria/' + evento._def.extendedProps.maquinariaId;
                document.getElementById('nombreEditExpiranDocumentosHidden').style.display = 'block';
                document.getElementById('numeconomicoEditExpiranDocumentosHidden').style.display = 'block';
                document.getElementById('placasEditExpiranDocumentosHidden').style.display = 'block';
                document.getElementById('nombreUsuarioEditExpiranDocumentosHidden').style.display = 'none';
                document.getElementById('emailEditExpiranDocumentosHidden').style.display = 'none';
                document.getElementById('celularEditExpiranDocumentosHidden').style.display = 'none';
            }
            if(evento._def.extendedProps.personalId != null){
                var enlace = document.getElementById('linkExpiranDocumentos');
                enlace.innerHTML = nombrePersonal;
                enlace.href = 'personal/' + evento._def.extendedProps.personalId;
                document.getElementById('nombreEditExpiranDocumentosHidden').style.display = 'none';
                document.getElementById('numeconomicoEditExpiranDocumentosHidden').style.display = 'none';
                document.getElementById('placasEditExpiranDocumentosHidden').style.display = 'none';
                document.getElementById('nombreUsuarioEditExpiranDocumentosHidden').style.display = 'block';
                document.getElementById('emailEditExpiranDocumentosHidden').style.display = 'block';
                document.getElementById('celularEditExpiranDocumentosHidden').style.display = 'block';
            }

            document.getElementById('nombreEditExpiranDocumentos').value = nombre;
            document.getElementById('numeconomicoEditExpiranDocumentos').value = numeconomico;
            document.getElementById('placasEditExpiranDocumentos').value = placas;

            document.getElementById('nombreUsuarioEditExpiranDocumentos').value = nombrePersonal;
            document.getElementById('emailEditExpiranDocumentos').value = email;
            document.getElementById('celularEditExpiranDocumentos').value = celular;

            //document.getElementById('searchSEdit').value =  'Equipo ' . nombre . ', Marca ' . marca . ', N. ECO. ' . numeconomico . ', Placas ' .  placas;
            document.getElementById('idExpiranDocumentosModal').value = evento._def.publicId;
            // document.getElementById('editarCampos').id =  "editarCampos" + evento._def.publicId;
        }

        
        function recuperarDatosEventoDiaFeriado(evento) {
            let fecha = evento._instance.range.start;
            let fechaObj = new Date(fecha);
            let fechaFormateada = fechaObj.toISOString().split("T")[0];
            let horaFormateada = fechaObj.toLocaleTimeString("es-MX", {
                hour12: false
            });
            let stringFecha = fechaFormateada + ' ' + horaFormateada;
            // Convertir al objeto DateTime con formato personalizado
            var startObj = luxon.DateTime.fromFormat(stringFecha, "yyyy-MM-dd HH:mm:ss");

            // Restar 6 horas
            var start6Hours = startObj.plus({
                hours: 6
            });

            // Obtener la hora local de México
            var startLocal = start6Hours.setZone("America/Mexico_City").toLocal();
            var formattedTime = startLocal.toFormat("HH:mm:ss");
            // var horaModal = startLocal.c.
            console.log('start', startLocal);
            console.log('fechaObj', fechaObj);
            //fechaEdit = evento._def.extendedProps.fecha;
            let fechaEdit = evento._instance.range.end;
            let fechaEditObj = new Date(fechaEdit);
            console.log('AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA', fechaEditObj.toISOString().split("T")[0]);
            let fechaEditFormateada = fechaEditObj.toISOString().split("T")[0];
            let horaEditFormateada = fechaEditObj.toLocaleTimeString("es-MX", {
                hour12: false
            });
            let stringFechaEdit = fechaEditFormateada + ' ' + horaEditFormateada;
            // Convertir al objeto DateTime con formato personalizado
            var startObjEdit = luxon.DateTime.fromFormat(stringFechaEdit, "yyyy-MM-dd HH:mm:ss");

            // Restar 6 horas
            var start6HoursEdit = startObjEdit.plus({
                hours: 6
            });

            // Obtener la hora local de México
            var startLocalEdit = start6HoursEdit.setZone("America/Mexico_City").toLocal();
            var formattedTimeEdit = startLocalEdit.toFormat("HH:mm:ss");
            console.log('fechaSalida', evento);

            document.getElementById('fechaEditDiaFeriado').value = fechaFormateada;
            
            /* if(fechaSalida)
            //if(evento._def.hasEnd){
            //    console.log('FEHCASSSSSS EDITADA');
            //    console.log('fechaEditFormateada',fechaEditFormateada);
            //    console.log('fechaEditFormateada',formattedTimeEdit);
                document.getElementById('fechaSalidaDiaFeriado').value = fechaEditFormateada;
                document.getElementById('horaSalidaDiaFeriado').value = formattedTimeEdit;
            }else{
                console.log('FEHCASSSSSS NO EDITADA');
            }*/

            //fechaEdit = evento._def.extendedProps.fecha;
            console.log('evento._def.extendedProps.title', evento._def.title);
            document.getElementById('titleEditDiaFeriado').value = evento._def.title;
            document.getElementById('descripcionEditDiaFeriado').value = evento._def.extendedProps.descripcion;
            document.getElementById("colorBoxEditDiaFeriado").style.backgroundColor = evento._def.ui.backgroundColor;
            
            //document.getElementById('searchSEdit').value =  'Equipo ' . nombre . ', Marca ' . marca . ', N. ECO. ' . numeconomico . ', Placas ' .  placas;
            document.getElementById('idDiaFeriadoModal').value = evento._def.publicId;
            // document.getElementById('editarCampos').id =  "editarCampos" + evento._def.publicId;
        }
        /*<div id="reparacion_campos" class="campos-solicitud" style="display: none;">
            <div class="row">
                <div class="col-12 pb-3 text-end">
                    <button type="button" class="btnVerde"
                        onclick="crearItemsReparacion()">
                    </button>
                </div>
                <div class="opcReparacion">
                    <div class="row">
                        <div class="line"></div>
                        <div class="mb-3 col-11">
                            <label for="reparacion" class="labelTitulo">Reparación:</label>
                            <input type="text" class="inputCaja" name="reparacionSolicitud[]" id="reparacionSolicitud"
                                aria-describedby="helpId" placeholder="Reparacion">
                        </div>
                        <div class="col-1 my-3 text-end">
                            <button type="button" id="removeRowReparacion"
                            class="btnRojo"></button>
                        </div>

                    </div>
                </div>

            </div>
        </div>

        <div id="combustible_campos" class="campos-solicitud" style="display: none;">
            <div class="row">
                <div class="col-12 pb-3 text-end">
                    <button type="button" class="btnVerde"
                        onclick="crearItemsCombustible()">
                    </button>
                </div>
                <div class="opcCombustible">
                    <div class="row">
                        <div class="line"></div>
                        <div class="mb-3 col-6">
                            <label for="litros" class="labelTitulo">Litros:</label>
                            <input type="number" class="inputCaja" name="litrosSolicitud" id="litrosSolicitud"
                                aria-describedby="helpId" placeholder="Litros">
                        </div>
                        <div class="mb-3 col-5">
                            <label for="carga" class="labelTitulo">Tipo*:</label>
                            <select name="carga[]" id="carga" required class="form-select">
                                <option value="carga" selected>Carga</option>
                            </select>
                        </div>
                        <div class="col-1 my-3 text-end">
                            <button type="button" id="removeRowCombustible"
                                class="btnRojo"></button>
                            </div>

                        <div class="mb-3">
                            <label for="comentarioTarea" class="labelTitulo">Comentario:</label>
                            <textarea class="form-control-textarea border-green" name="comentarioTarea[]" id="comentarioTarea" rows="3"
                                placeholder="Especifique..."></textarea>
                        </div>
                    </div>

                </div>

            </div>
        </div>

        <div id="herramienta_campos" class="campos-solicitud" style="display: none;">
            <div class="row">
                <div class="col-12 pb-3 text-end">
                    <button type="button" class="btnVerde"
                        onclick="crearItemsHerramienta()">
                    </button>
                </div>
                <div class="opcHerramienta">
                    <div class="row">
                        <div class="line"></div>
                        <div class="mb-3 col-6">
                            <label for="cantidad" class="labelTitulo">Herramienta:</label>
                            <select name="herramientaNombre[]" id="herramientaNombre" class="form-select">
                                <option value="" >Seleccione</option>
                                @foreach ($herramientas as $item)
                                    <option value="{{ $item->id }}">
                                        {{ $item->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3 col-5">
                            <label for="cantidad" class="labelTitulo">Cantidad:</label>
                            <input type="number" class="inputCaja" name="cantidadSolicitudHerramienta[]" id="cantidadSolicitudHerramienta"
                                aria-describedby="helpId" placeholder="Cantidad">
                        </div>
                        <div class="col-1 my-3 text-end">
                            <button type="button" id="removeRowHerramienta"
                                class="btnRojo"></button>
                            </div>
                        <div class="mb-3">
                            <label for="comentarioHerramienta" class="labelTitulo">Comentario:</label>
                            <textarea class="form-control-textarea border-green" name="comentarioHerramienta[]" id="comentarioHerramienta" rows="3"
                                placeholder="Especifique..."></textarea>
                        </div>
                    </div>

                </div>

            </div>
        </div>

        */
        // document.getElementById('editarCampos').id =  "editarCampos" + evento._def.publicId;
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let titleSelect = document.getElementById("titleSelect");
            let colorBox = document.getElementById("colorBox");
            let color = document.getElementById("colorBoxHidden");

            let prioridadSelect = document.getElementById("prioridadSelect");
            let colorBoxTarea = document.getElementById("colorBoxTarea");
            let colorTarea = document.getElementById("colorBoxHiddenTarea");

            let prioridadSelectSolicitud = document.getElementById("prioridadSelectSolicitud");
            let colorBoxSolicitud = document.getElementById("colorBoxSolicitud");
            let colorSolicitud = document.getElementById("colorBoxHiddenSolicitud");


            titleSelect.addEventListener("change", function() {
                let selectedColor = this.options[this.selectedIndex].getAttribute("data-color");
                colorBox.style.backgroundColor = selectedColor;

                console.log('selectedColor', selectedColor)
                color.value = selectedColor;
            });

            prioridadSelect.addEventListener("change", function() {
                let selectedColorTarea = this.options[this.selectedIndex].getAttribute("data-color");
                colorBoxTarea.style.backgroundColor = selectedColorTarea;

                console.log('selectedColorTarea', selectedColorTarea)
                colorTarea.value = selectedColorTarea;
            });

            prioridadSelectSolicitud.addEventListener("change", function() {
                let selectedColorSolicitud = this.options[this.selectedIndex].getAttribute("data-color");
                colorBoxSolicitud.style.backgroundColor = selectedColorSolicitud;

                console.log('selectedColorSolicitud', selectedColorSolicitud)
                colorSolicitud.value = selectedColorSolicitud;
            });

            let titleSelectEdit = document.getElementById("titleSelectEdit");
            let colorBoxEdit = document.getElementById("colorBoxEdit");
            let colorEdit = document.getElementById("colorBoxHiddenEdit");

            titleSelectEdit.addEventListener("change", function() {
                let selectedColor = this.options[this.selectedIndex].getAttribute("data-color");
                colorBoxEdit.style.backgroundColor = selectedColor;
                colorEdit.value = selectedColor;
            });

            let prioridadTareaEdit = document.getElementById("prioridadEditTarea");
            let colorBoxEditTarea = document.getElementById("colorBoxEditTarea");
            let colorBoxHiddenTareaEdit = document.getElementById("colorBoxHiddenTareaEdit");

            prioridadTareaEdit.addEventListener("change", function() {
                let selectedColor = this.options[this.selectedIndex].getAttribute("data-color");
                colorBoxEditTarea.style.backgroundColor = selectedColor;
                colorBoxHiddenTareaEdit.value = selectedColor;
            });

            let prioridadSolicitudEdit = document.getElementById("prioridadEditSolicitud");
            let colorBoxEditSolicitud = document.getElementById("colorBoxEditSolicitud");
            let colorBoxHiddenSolicitudEdit = document.getElementById("colorBoxHiddenSolicitudEdit");

            prioridadSolicitudEdit.addEventListener("change", function() {
                let selectedColor = this.options[this.selectedIndex].getAttribute("data-color");
                colorBoxEditSolicitud.style.backgroundColor = selectedColor;
                colorBoxHiddenSolicitudEdit.value = selectedColor;
            });

        });
    </script>

    <script>
        let vista = false;
        document.addEventListener('DOMContentLoaded', function() {
            let idModal = document.getElementById('id');
            let editarCamposLink = document.getElementById('editarCampos' + idModal.value);
            let campos = document.querySelectorAll('.inputCaja, .form-select, .form-control-textarea');
            const tituloModal = document.getElementById('tituloModal');
            const contenedorBotonGuardar = document.getElementById('contenedorBotonGuardar');
            console.log('editarCamposLink', editarCamposLink);
            editarCamposLink.addEventListener('click', function(event) {

                event.stopPropagation();
                if (!vista) {
                    editarCamposLink.innerHTML = `
            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-card-text accionesIconos" viewBox="0 0 16 16">
                    <path d="M3 5.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 8zm0 2.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5z"/>
                    <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                </svg>
            `;
                    tituloModal.textContent = 'Editar Mantenimiento';
                    contenedorBotonGuardar.style.display = 'block';
                    vista = true;
                    campos.forEach(function(campo) {
                        if (campo.id !== 'nombreEdit' && campo.id !== 'numeconomicoEdit' && campo
                            .id !== 'placasEdit' && campo.id !== 'marcaEdit' && campo.id !== 'fechaSalida' && campo.id !== 'horaSalida') {
                            campo.removeAttribute('readonly');
                        }
                        if (campo.id !== 'nombreEdit' || campo.id !== 'numeconomicoEdit' || campo
                            .id !== 'placasEdit' || campo.id !== 'marcaEdit') {
                            campo.style.color = 'initial';
                        }
                    });

                } else {
                    vista = false;
                    editarCamposLink.innerHTML = `
            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-pencil accionesIconos" viewBox="0 0 16 16">
                <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
            </svg>
            `;
                    tituloModal.textContent = 'Ver Mantenimiento';
                    contenedorBotonGuardar.style.display = 'none';
                    campos.forEach(function(campo) {
                        if (campo.id !== 'nombreEdit' && campo.id !== 'numeconomicoEdit' && campo
                            .id !== 'placasEdit' && campo.id !== 'marcaEdit') {
                            campo.setAttribute('readonly', 'readonly');
                        }
                        if (campo.id !== 'nombreEdit' || campo.id !== 'numeconomicoEdit' || campo
                            .id !== 'placasEdit' || campo.id !== 'marcaEdit') {
                            campo.style.color = 'gray';
                        }
                    });
                }

            });

        });
    </script>

    <script>
        let vistaTarea = false;
        document.addEventListener('DOMContentLoaded', function() {
            let idModal = document.getElementById('idTareaModal');
            let editarCamposLink = document.getElementById('editarCamposTarea' + idModal.value);
            let campos = document.querySelectorAll('.inputCaja, .form-select, .form-control-textarea');
            const tituloModal = document.getElementById('tituloModalActividad');
            const contenedorBotonGuardarTarea = document.getElementById('contenedorBotonGuardarTarea');
            console.log('editarCamposLink', editarCamposLink);
            editarCamposLink.addEventListener('click', function(event) {

                event.stopPropagation();
                if (!vistaTarea) {
                    editarCamposLink.innerHTML = `
            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-card-text accionesIconos" viewBox="0 0 16 16">
                    <path d="M3 5.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 8zm0 2.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5z"/>
                    <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                </svg>
            `;
                    tituloModal.textContent = 'Editar Actividad';
                    contenedorBotonGuardarTarea.style.display = 'block';
                    vistaTarea = true;
                    campos.forEach(function(campo) {
                        campo.removeAttribute('readonly');
                        campo.style.color = 'initial';
                    });

                } else {
                    vistaTarea = false;
                    editarCamposLink.innerHTML = `
            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-pencil accionesIconos" viewBox="0 0 16 16">
                <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
            </svg>
            `;
                    tituloModal.textContent = 'Ver Actividad';
                    contenedorBotonGuardarTarea.style.display = 'none';
                    campos.forEach(function(campo) {
                        campo.setAttribute('readonly', 'readonly');
                        campo.style.color = 'gray';
                    });
                }

            });

        });
    </script>

    <script>
        let vistaEventoImportante = false;
        document.addEventListener('DOMContentLoaded', function() {
            let idModal = document.getElementById('idEventoImportanteModal');
            let editarCamposLink = document.getElementById('editarCamposEventoImportante' + idModal.value);
            let campos = document.querySelectorAll('.inputCaja, .form-select, .form-control-textarea');
            const tituloModal = document.getElementById('tituloModalActividad');
            const contenedorBotonGuardarEventoImportante = document.getElementById('contenedorBotonGuardarEventoImportante');
            console.log('editarCamposLink', editarCamposLink);
            editarCamposLink.addEventListener('click', function(event) {

                event.stopPropagation();
                if (!vistaEventoImportante) {
                    editarCamposLink.innerHTML = `
            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-card-text accionesIconos" viewBox="0 0 16 16">
                    <path d="M3 5.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 8zm0 2.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5z"/>
                    <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                </svg>
            `;
                    tituloModal.textContent = 'Editar Actividad';
                    contenedorBotonGuardarEventoImportante.style.display = 'block';
                    vistaEventoImportante = true;
                    campos.forEach(function(campo) {
                        campo.removeAttribute('readonly');
                        campo.style.color = 'initial';
                    });

                } else {
                    vistaEventoImportante = false;
                    editarCamposLink.innerHTML = `
            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-pencil accionesIconos" viewBox="0 0 16 16">
                <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
            </svg>
            `;
                    tituloModal.textContent = 'Ver Actividad';
                    contenedorBotonGuardarEventoImportante.style.display = 'none';
                    campos.forEach(function(campo) {
                        campo.setAttribute('readonly', 'readonly');
                        campo.style.color = 'gray';
                    });
                }

            });

        });
    </script>

    <script>
        let vistaSolicitud = false;
        document.addEventListener('DOMContentLoaded', function() {
            let idModal = document.getElementById('idSolicitud');
            let editarCamposLink = document.getElementById('editarCamposSolicitud' + idModal.value);
            let campos = document.querySelectorAll('.inputCaja, .form-select, .form-control-textarea');
            let detalleSolicitud = document.querySelectorAll('.detalleSolicitud');

            const tituloModal = document.getElementById('modalTitleIdSolicitud');
            const contenedorBotonGuardar = document.getElementById('contenedorBotonGuardarSolicitud');
            console.log('editarCamposLink', editarCamposLink);
            editarCamposLink.addEventListener('click', function(event) {

                event.stopPropagation();
                if (!vistaSolicitud) {
                    editarCamposLink.innerHTML = `
            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-card-text accionesIconos" viewBox="0 0 16 16">
                    <path d="M3 5.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 8zm0 2.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5z"/>
                    <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                </svg>
            `;
                    tituloModal.textContent = 'Editar Solicitud';
                    contenedorBotonGuardar.style.display = 'block';
                    vistaSolicitud = true;
                    campos.forEach(function(campo) {
                        if (campo.id !== 'nombreEditSolicitud' && campo.id !== 'numeconomicoEditSolicitud' && campo
                            .id !== 'placasEditSolicitud' && campo.id !== 'marcaEditSolicitud') {
                            campo.removeAttribute('readonly');
                        }
                        if (campo.id !== 'nombreEditSolicitud' || campo.id !== 'numeconomicoEditSolicitud' || campo
                            .id !== 'placasEditSolicitud' || campo.id !== 'marcaEditSolicitud') {
                            campo.style.color = 'initial';
                        }
                    });
                    /*camposDetalleSolicitud.forEach(function(campo) {
                        campo.removeAttribute('readonly');
                        campo.style.color = 'initial';
                    });*/

                } else {
                    vistaSolicitud = false;
                    editarCamposLink.innerHTML = `
            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-pencil accionesIconos" viewBox="0 0 16 16">
                <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
            </svg>
            `;
                    tituloModal.textContent = 'Ver Solicitud';
                    contenedorBotonGuardar.style.display = 'none';
                    campos.forEach(function(campo) {
                        if (campo.id !== 'nombreEditSolicitud' && campo.id !== 'numeconomicoEditSolicitud' && campo
                            .id !== 'placasEditSolicitud' && campo.id !== 'marcaEditSolicitud') {
                            campo.setAttribute('readonly', 'readonly');
                        }
                        if (campo.id !== 'nombreEditSolicitud' || campo.id !== 'numeconomicoEditSolicitud' || campo
                            .id !== 'placasEditSolicitud' || campo.id !== 'marcaEditSolicitud') {
                            campo.style.color = 'gray';
                        }
                    });
                }

            });

        });
    </script>

    <script>
        // Obtén los checkboxes y los campos específicos
        const checkboxes = document.querySelectorAll('input[name="tipo_solicitud"]');
        const reparacionCampos = document.getElementById('reparacion_campos');
        const combustibleCampos = document.getElementById('combustible_campos');
        const herramientaCampos = document.getElementById('herramienta_campos');
        const refaccionCampos = document.getElementById('refaccion_campos');

        // Escucha el evento de cambio en los checkboxes
        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                // Oculta todos los campos primero
                reparacionCampos.style.display = 'none';
                combustibleCampos.style.display = 'none';
                herramientaCampos.style.display = 'none';
                refaccionCampos.style.display = 'none';

                // Muestra solo los campos correspondientes al checkbox seleccionado
                if (checkbox.checked) {
                    console.log('hola', checkbox.value);
                    switch (checkbox.value) {
                        case 'reparacion':
                            reparacionCampos.style.display = 'block';
                            break;
                        case 'combustible':
                            combustibleCampos.style.display = 'block';
                            break;
                        case 'herramienta':
                            herramientaCampos.style.display = 'block';
                            break;
                        case 'refaccion':
                            refaccionCampos.style.display = 'block';
                            break;
                        // Agrega más casos si tienes otros tipos de solicitud
                    }
                }
            });
        });
    </script>
@endsection
