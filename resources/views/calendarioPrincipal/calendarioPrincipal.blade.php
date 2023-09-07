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
            <div class="col-4 text-left mb-1" style="margin-left: 12px">
                {{--  <a href="{{ url('dashMtq') }}" id="regresarId">
                    <button class="btn regresar"
                        style="background-color: var(--select);
                color: #fff;
                display: inline-flex;">
                        <span class="material-icons">
                            reply
                        </span>
                        Regresar
                    </button>
                </a>  --}}
            </div>
            <div class="col-8 text-end mb-1" style="margin-left: -25px">
                @can('calendarioMtq_create')
                    <button data-bs-toggle="modal" data-bs-target="#myModal" type="button" class="btn botonGral">Añadir
                        Mantenimiento</button>
                    {{--  <button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-primary py-2 px-4">Click Here !</button>  --}}
                @endcan
            </div>
        </div>
        <div class="container-fluid">

            <div id='calendar'></div>

            <!-- Modal Body-->
            {{--  <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="modalTitleId" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header bacTituloPrincipal">
                            <h5 class="modal-title fs-5" id="modalTitleId">Añadir Mantenimiento</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid">
                                <form action="{{ route('calendarioMtq.store') }}" method="post">
                                    @csrf
                                    @method('post')
                                    <!-- <div class="mb-3">
                                                                      <label for="id" class="form-label">ID:</label>
                                                                      <input type="text"
                                                                        class="form-control" name="id" id="id" aria-describedby="helpId" placeholder="ID">
                                                                    </div> -->

                                    <input type="hidden" name="maquinariaId" id="maquinariaId">
                                    <input type="hidden" id="colorBoxHidden" name="color" value="">

                                    <div class="mb-3" role="search">
                                        <label for="title" class="labelTitulo">Buscador:</label>
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
                                            <label for="title" class="labelTitulo">Número Economico:</label>
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
                                        <label for="title" class="labelTitulo">Mantenimiento*:</label>
                                        <select name="mantenimientoId" id="titleSelect" required class="form-select">
                                            <option value="">Seleccione</option>
                                            @foreach ($tiposMantenimiento as $item)
                                                <option value="{{ $item->id }}" data-color="{{ $item->color }}">
                                                    {{ $item->nombre }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-3 col-6">
                                        <label for="title" class="labelTitulo">Estado De La Solicitud*:</label>
                                        <select name="estatus" id="estadoSelect" required class="form-select">
                                            <option value="">Seleccione</option>
                                            <option value="1">En Espera</option>
                                            <option value="2">Realizado</option>
                                            <option value="3">Terminado</option>
                                        </select>
                                    </div>
                                </div>
                                    <div class="mb-3">
                                        <label for="color" class="labelTitulo">Color:</label>
                                        <div id="colorBox" class="color-box w-100" style="margin-left:-0.5px"></div>
                                    </div>

                                    <div class="row">
                                        <div class="mb-3 col-6">
                                            <label for="fecha" class="labelTitulo">Fecha De Llegada:</label>
                                            <input type="date" class="inputCaja" name="fecha" id="fecha"
                                                aria-describedby="helpId" placeholder="Fecha">
                                        </div>

                                        <div class="mb-3 col-6">
                                            <label for="hora" class="labelTitulo">Hora De Llegada:</label>
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
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn botonGral">Guardar</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>  --}}

            <!-- Modal Body-->
            {{--  <div class="modal fade" id="myModalEdit" tabindex="-1" aria-labelledby="modalTitleId"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header bacTituloPrincipal">
                            <h5 class="modal-title fs-5" id="modalTitleId">&nbsp <span id="tituloModal">Ver Mantenimiento
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid">
                                <form action="{{ route('calendarioMtq.update', 0) }}" method="post">
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
                                            <label for="title" class="labelTitulo">Buscador:</label>
                                            <input autofocus type="text" class="inputCaja" id="searchSEdit"
                                                name="search" placeholder="Buscar Equipo..."
                                                title="Escriba la(s) palabra(s) a buscar." readonly>
                                        </div>
                                        <div class="col-1 mt-4">
                                            @can('calendarioMtq_edit')
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
                                            <label for="title" class="labelTitulo">Número Economico:</label>
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
                                            <input autofocus type="text" class="inputCaja" id="marcaEdit"
                                                name="marca" placeholder="Marca Equipo..." readonly>
                                        </div>
                                    

                                    <div class="mb-3 col-6">
                                        <label for="title" class="labelTitulo">Mantenimiento*:</label>
                                        <select name="mantenimientoId" id="titleSelectEdit" required class="form-select"
                                            readonly>
                                            <option value="" readonly>Seleccione</option>
                                            @foreach ($tiposMantenimiento as $item)
                                                <option value="{{ $item->id }}" data-color="{{ $item->color }}"
                                                    readonly>
                                                    {{ $item->nombre }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-3 col-6">
                                        <label for="title" class="labelTitulo">Estado De La Solicitud*:</label>
                                        <select name="estatus" id="estadoSelect" required class="form-select">
                                            <option value="">Seleccione</option>
                                            <option value="1">En Espera</option>
                                            <option value="2">Realizado</option>
                                            <option value="3">Terminado</option>
                                        </select>
                                    </div>
                                </div>

                                    <div class="mb-3">
                                        <label for="color" class="labelTitulo">Color:</label>
                                        <div id="colorBoxEdit" class="color-box w-100" style="margin-left:-0.5px"></div>
                                    </div>

                                    <div class="row">
                                        <div class="mb-3 col-6">
                                            <label for="fecha" class="labelTitulo">Fecha De Llegada:</label>
                                            <input type="date" class="inputCaja" name="fecha" id="fechaEdit"
                                                aria-describedby="helpId" placeholder="Fecha" readonly>
                                        </div>

                                        <div class="mb-3 col-6">
                                            <label for="hora" class="labelTitulo">Hora De Llegada:</label>
                                            <input type="time" class="inputCaja" name="hora" id="horaEdit"
                                                aria-describedby="helpId" placeholder="Fecha" readonly>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="mb-3 col-6">
                                            <label for="fecha" class="labelTitulo">Fecha De Salida:</label>
                                            <input type="date" class="inputCaja" name="fechaSalida" id="fechaSalida"
                                                aria-describedby="helpId" placeholder="Fecha" readonly>
                                        </div>

                                        <div class="mb-3 col-6">
                                            <label for="hora" class="labelTitulo">Hora De Salida:</label>
                                            <input type="time" class="inputCaja" name="horaSalida" id="horaSalida"
                                                aria-describedby="helpId" placeholder="Fecha" readonly>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="descripcion" class="labelTitulo">Descripción:</label>
                                        <textarea class="form-control-textarea border-green" name="descripcion" id="descripcionEdit" rows="3"
                                            placeholder="Especifique..." readonly></textarea>
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
            </div>  --}}

        <!-- Modal-->
        <div id="myModal" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true" class="modal fade text-left">
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
                                            <label for="title" class="labelTitulo">Número Economico:</label>
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
                                        <label for="title" class="labelTitulo">Mantenimiento*:</label>
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
                                        <label for="title" class="labelTitulo">Estado De La Solicitud*:</label>
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
                                            <label for="fecha" class="labelTitulo">Fecha De Llegada:</label>
                                            <input type="date" class="inputCaja" name="fecha" id="fecha"
                                                aria-describedby="helpId" placeholder="Fecha">
                                        </div>

                                        <div class="mb-3 col-6">
                                            <label for="hora" class="labelTitulo">Hora De Llegada:</label>
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
                                            placeholder="Título De Tarea..." title="Escriba El Título De La Tarea.">
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
                                        <label for="prioridad" class="labelTitulo">Prioridad*:</label>
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
                                        <label for="title" class="labelTitulo">Estado De La Solicitud*:</label>
                                        <select name="estadoId" id="estadoSelectTarea" required class="form-select">
                                            <option value="1" selected>En Espera</option>
                                        </select>
                                    </div>
                                
                                    <div class="mb-3">
                                        <label for="color" class="labelTitulo">Color:</label>
                                        <div id="colorBoxTarea" class="color-box w-100" style="margin-left:-0.5px"></div>
                                    </div>
                                    <div class="mb-3 col-6">
                                        <label for="fecha" class="labelTitulo">Fecha De Llegada:</label>
                                        <input type="date" class="inputCaja" name="fechaTarea" id="fechaTarea"
                                            aria-describedby="helpId" placeholder="Fecha">
                                    </div>
    
                                    <div class="mb-3 col-6">
                                        <label for="hora" class="labelTitulo">Hora De Llegada:</label>
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
                                            placeholder="Título De Solicitud..." title="Escriba El Título De La Solicitud.">
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
                                            <label for="title" class="labelTitulo">Número Economico:</label>
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
                                        <label for="prioridad" class="labelTitulo">Prioridad*:</label>
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
                                        <label for="title" class="labelTitulo">Estado De La Solicitud*:</label>
                                        <select name="estadoId" id="estadoSelectSolicitud" required class="form-select">
                                            <option value="1" selected>En Espera</option>
                                        </select>
                                    </div>

                                    <div class="mb-3 col-6">
                                        <label for="title" class="labelTitulo">Funcionalidad Del Equipo*:</label>
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
                                        <label for="fecha" class="labelTitulo">Fecha De Llegada:</label>
                                        <input type="date" class="inputCaja" name="fechaSolicitud" id="fechaSolicitud"
                                            aria-describedby="helpId" placeholder="Fecha">
                                    </div>
    
                                    <div class="mb-3 col-6">
                                        <label for="hora" class="labelTitulo">Hora De Llegada:</label>
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
                                    <h4 style="color:#5c7c26 !important; margin-top: 10px; font-weight: bold;">Añadir Tipos A La Solicitud</h4>

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
        </div>
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
                    url: "{{ route('search.equiposMTQ') }}",
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
                // $('#modelo').val(ui.item.modelo);
                $('#numeconomico').val(ui.item.identificador);
                $('#placas').val(ui.item.placas);
            }
        });
        $('#searchSolicitudes').autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: "{{ route('search.equiposMTQ') }}",
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
                $('#maquinariaIdSolicitud').val(ui.item.id);
                // $('#descripcion').val(ui.item.value);
                $('#nombreSolicitud').val(ui.item.nombre);
                $('#marcaSolicitud').val(ui.item.marca);
                // $('#modelo').val(ui.item.modelo);
                $('#numeconomicoSolicitud').val(ui.item.identificador);
                $('#placasSolicitud').val(ui.item.placas);
            }
        });
        $('#searchSEdit').autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: "{{ route('search.equiposMTQ') }}",
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
                $('#numeconomicoEdit').val(ui.item.identificador);
                $('#placasEdit').val(ui.item.placas);
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
        document.addEventListener('DOMContentLoaded', function() {
            let myModal = new bootstrap.Modal(document.getElementById('myModal'), {
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

                if (
                    start.getFullYear() === end.getFullYear() &&
                    start.getMonth() === end.getMonth() &&
                    start.getDate() === end.getDate()
                ) {
                    // Agrega la clase "single-day-event" al evento
                    // evento.className = 'single-day-event';
                    // evento.allDay = true;
                    // Agrega el atributo data-color al objeto evento
                    evento.extendedProps = {
                        backgroundColor: evento.color
                    };
                    // Agrega la información de estilo al evento
                    // evento.styleInfo = {
                    //     backgroundColor: evento.color
                    // };

                }
            }

            console.log('$eventosJson', eventosJson);
            var calendar = new FullCalendar.Calendar(calendarEl, {
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
                    var permissionName = 'calendarioMtq_create';
                    fetch(`/check-permission/${permissionName}`)
                        .then(response => response.json())
                        .then(data => {
                            if (data.hasPermission) {
                                document.getElementById('fecha').value = informacion.dateStr;
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
                    var permissionName = 'calendarioMtq_show';
                    fetch(`/check-permission/${permissionName}`)
                        .then(response => response.json())
                        .then(data => {
                            if (data.hasPermission) {
                                myModalEdit.show();
                                recuperarDatosEvento(informacion.event);
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
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
    crossorigin="anonymous"></script>

    <script>
        function crearItemsReparacion() {
            $('.opcReparacion:first').clone().find("input").val("").end().appendTo('#reparacion_campos');
        }

        // Borrar registro
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

        // Borrar registro
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

        // Borrar registro
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
        
          .modal-header {
            display: flex;
            justify-content: space-between;
          }
          
          .modal-header .tabs {
            flex: 1;
            text-align: center; /* Opcional: centrar contenido horizontalmente */
          }
          
          .modal-header {
            display: grid;
            grid-template-columns: repeat(3, 1fr); /* 4 columnas con el mismo ancho */
            gap: 1px; /* Espacio entre columnas */
            align-items: center; /* Alinea verticalmente en el centro */
          }
          
          /* Opcional: Estilos adicionales para las columnas activas */
          .modal-header .tabs.active {
            color: #5c7c26;
            font-weight: 1000 !important;
            border-radius: 5px;
          }
        .line {
            background-color: #f7cd22;
            height: 2px;
            width: 100%;
        }
        
        @media screen and (max-width: 768px) {
            .tabs h6 {
                font-size: 12px;
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
        function recuperarDatosEvento(evento) {
            //console.log('info Modal', evento);

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
            document.getElementById('fechaSalida').value = fechaEditFormateada;
            document.getElementById('horaSalida').value = formattedTimeEdit;
            //fechaEdit = evento._def.extendedProps.fecha;

            document.getElementById('titleSelectEdit').value = evento._def.extendedProps.mantenimientoId;
            document.getElementById("colorBoxEdit").style.backgroundColor = evento._def.ui.backgroundColor;
            document.getElementById('descripcionEdit').value = evento._def.extendedProps.descripcion;

            let marca = evento._def.extendedProps.marca;
            let nombre = evento._def.extendedProps.nombre;
            let numeconomico = evento._def.extendedProps.numeconomico;
            let placas = evento._def.extendedProps.placas;

            document.getElementById('marcaEdit').value = marca;
            document.getElementById('nombreEdit').value = nombre;
            document.getElementById('numeconomicoEdit').value = numeconomico;
            document.getElementById('placasEdit').value = placas;
            //document.getElementById('searchSEdit').value =  'Equipo ' . nombre . ', Marca ' . marca . ', N. ECO. ' . numeconomico . ', Placas ' .  placas;
            document.getElementById('id').value = evento._def.publicId;
            // document.getElementById('editarCampos').id =  "editarCampos" + evento._def.publicId;
        }
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let titleSelect = document.getElementById("titleSelect");
            let colorBox = document.getElementById("colorBox");
            let color = document.getElementById("colorBoxHidden");
            let colorEdit = document.getElementById("colorBoxHiddenEdit");

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

            titleSelectEdit.addEventListener("change", function() {
                let selectedColor = this.options[this.selectedIndex].getAttribute("data-color");
                colorBoxEdit.style.backgroundColor = selectedColor;
                colorEdit.value = selectedColor;
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
                            .id !== 'placasEdit' && campo.id !== 'marcaEdit') {
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
