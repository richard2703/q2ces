@extends('layouts.main', ['activePage' => 'mtq', 'titlePage' => __('Calendario MTQ')])
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
            <div class="col-6 text-left mb-1" style="margin-left: 12px">
                <span>
                    <div class="display-8 text-start" title="Ir al periodo en curso" style="color: #5C7C26;"><b>CALENDARIO:
                            Servicios MTQ</b></div>
                </span>
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
            <div class="col-6 text-end mb-1" style="margin-left: -25px">
                @can('calendario_mtq_create')
                    <button data-bs-toggle="modal" data-bs-target="#modalEvento" type="button" class="btn botonGral">Añadir
                        Mantenimiento</button>
                @endcan
            </div>
        </div>
        <div class="container-fluid">

            <div id='calendar'></div>

            <!-- Modal Body-->
            <div class="modal fade" id="modalEvento" tabindex="-1" aria-labelledby="modalTitleId" aria-hidden="true">
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
                                    <input type="hidden" name="userId" value="{{ auth()->user()->id }}">

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
                                            <select name='marca' class="form-select" id="marca"
                                                placeholder="Marca Equipo..." readonly>
                                                <option value="">Seleccione</option>
                                                @foreach ($marca as $item)
                                                    <option value="{{ $item->id }}">
                                                        {{ $item->nombre }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">

                                        <div class="mb-3 col-6">
                                            <label for="title" class="labelTitulo">Mantenimiento:</label>
                                            <select name="tipoMantenimientoId" id="titleSelect" required
                                                class="form-select">
                                                <option value="">Seleccione</option>
                                                @foreach ($servicios as $item)
                                                    <option value="{{ $item->id }}" data-color="{{ $item->color }}">
                                                        {{ $item->nombre }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="mb-3 col-6">
                                            <label for="color" class="labelTitulo">Color:</label>
                                            <div id="colorBox" class="color-box w-100" style="margin-left:-0.5px"></div>
                                        </div>
                                    </div>

                                    <div class="row">

                                        <div class="mb-3 col-6">
                                            <label class="labelTitulo">Responsable:</label></br>
                                            <select class="form-select form-select-lg mb-3 inputCaja" name="residenteId"
                                                id="responsable" aria-label=".form-select-lg example">
                                                <option value="">Seleccione</option>
                                                @foreach ($personal as $item)
                                                    <option value="{{ $item->id }}">
                                                        {{ $item->nombre . ' ' . $item->apellidoP }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="mb-3 col-6">
                                            <label for="title" class="labelTitulo">Estado de la Solicitud*:</label>
                                            <select name="estadoId" id="estadoSelectMantenimiento" required
                                                class="form-select">
                                                <option value="1" selected>En Espera</option>
                                            </select>
                                        </div>
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
            </div>

            <!-- Modal Body-->
            <div class="modal fade" id="modalEventoEdit" tabindex="-1" aria-labelledby="modalTitleId"
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
                                            @can('calendario_mtq_edit')
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

                                        <div class="col-12 col-sm-6 mb-3">
                                            <label for="title" class="labelTitulo">Marca:</label>
                                            <select name='marca' class="form-select" id="marcaEdit"
                                                placeholder="Marca Equipo..." readonly>
                                                <option value="">Seleccione</option>
                                                @foreach ($marca as $item)
                                                    <option value="{{ $item->id }}">
                                                        {{ $item->nombre }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="mb-3 col-6">
                                                <label for="title" class="labelTitulo">Mantenimiento:</label>
                                                <select name="tipoMantenimientoId" id="titleSelectEdit" required
                                                    class="form-select" readonly>
                                                    <option value="" readonly>Seleccione</option>
                                                    @foreach ($servicios as $item)
                                                        <option value="{{ $item->id }}"
                                                            data-color="{{ $item->color }}" readonly>
                                                            {{ $item->nombre }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="mb-3 col-6">
                                                <label for="color" class="labelTitulo">Color:</label>
                                                <div id="colorBoxEdit" class="color-box w-100"
                                                    style="margin-left:-0.5px"></div>
                                            </div>
                                        </div>

                                    <div class="row">

                                        <div class="mb-3 col-6">
                                            <label class="labelTitulo">Responsable:</label></br>
                                            <select class="form-select form-select-lg mb-3 inputCaja" name="residenteId"
                                                id="responsable" aria-label=".form-select-lg example">
                                                <option value="">Seleccione</option>
                                                @foreach ($personal as $item)
                                                    <option value="{{ $item->id }}">
                                                        {{ $item->nombre . ' ' . $item->apellidoP }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="mb-3 col-6">
                                            <label for="title" class="labelTitulo">Estado de la Solicitud*:</label>
                                            <select name="estadoId" id="estadoSelectMantenimiento" required
                                                class="form-select">
                                                <option value="1" selected>En Espera</option>
                                            </select>
                                        </div>
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
                                                <input type="date" class="inputCaja" name="fechaSalida"
                                                    id="fechaSalida" aria-describedby="helpId" placeholder="Fecha"
                                                    readonly>
                                            </div>

                                            <div class="mb-3 col-6">
                                                <label for="hora" class="labelTitulo">Hora De Salida:</label>
                                                <input type="time" class="inputCaja" name="horaSalida"
                                                    id="horaSalida" aria-describedby="helpId" placeholder="Fecha"
                                                    readonly>
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
                    console.log('UI', ui.item);
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
                let modalEvento = new bootstrap.Modal(document.getElementById('modalEvento'), {
                    keyboard: false
                });
                let modalEventoEdit = new bootstrap.Modal(document.getElementById('modalEventoEdit'), {
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
                    evento.title = evento.nombreServicio + ' ' + evento.title;

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
                        var permissionName = 'calendario_mtq_create';
                        fetch(`/check-permission/${permissionName}`)
                            .then(response => response.json())
                            .then(data => {
                                if (data.hasPermission) {
                                    document.getElementById('fecha').value = informacion.dateStr;
                                    modalEvento.show();
                                } else {
                                    alertaNoPermission();
                                }
                            })
                            .catch(error => {
                                console.error("Error al verificar permisos:", error);
                            });

                    },
                    eventClick: function(informacion) {
                        var permissionName = 'calendario_mtq_show';
                        fetch(`/check-permission/${permissionName}`)
                            .then(response => response.json())
                            .then(data => {
                                if (data.hasPermission) {
                                    modalEventoEdit.show();
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

                document.getElementById('titleSelectEdit').value = evento._def.extendedProps.tipoMantenimientoId;
                // console.log("Evento: " ,  evento._def.extendedProps.tipoMantenimientoId);
                document.getElementById("colorBoxEdit").style.backgroundColor = evento._def.ui.backgroundColor;
                document.getElementById('descripcionEdit').value = evento._def.extendedProps.descripcion;

                let marca = evento._def.extendedProps.marcaId;
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

                titleSelect.addEventListener("change", function() {
                    let selectedColor = this.options[this.selectedIndex].getAttribute("data-color");
                    colorBox.style.backgroundColor = selectedColor;

                    console.log('selectedColor', selectedColor)
                    color.value = selectedColor;
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
    @endsection
