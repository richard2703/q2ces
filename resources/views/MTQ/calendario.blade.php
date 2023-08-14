@extends('layouts.main', ['activePage' => 'mtq', 'titlePage' => __('Calendario MTQ')])
@section('content')

    <head>
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.5/main.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.5/locales/es.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.5/main.css">

        <!-- Bootstrap CSS v5.2.1 -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    </head>
    {{--  comentario para actualizar  --}}
    <div class="content">
        <div class="container-fluid">

            <div id='calendar'></div>

            <!-- Modal Body-->
            <div class="modal fade" id="modalEvento" tabindex="-1" aria-labelledby="modalTitleId" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bacTituloPrincipal">
                            <h5 class="modal-title fs-5" id="modalTitleId">Añadir Evento</h5>
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

                                    <div class="mb-3">
                                        <label for="title" class="labelTitulo">Mantenimiento:</label>
                                        <select name="title" id="title" required class="form-select">
                                            <option value="Seleccione">Seleccione</option>
                                            <option value="Reparacion">Reparacion</option>
                                            <option value="Afinacion">Afinacion</option>
                                            <option value="Revision">Revision</option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="fecha" class="labelTitulo">Fecha:</label>
                                        <input type="date" class="inputCaja" name="fecha" id="fecha"
                                            aria-describedby="helpId" placeholder="Fecha">
                                    </div>

                                    <div class="mb-3">
                                        <label for="hora" class="labelTitulo">Hora De Llegada:</label>
                                        <input type="time" class="inputCaja" name="hora" id="hora"
                                            aria-describedby="helpId" placeholder="Fecha">
                                    </div>

                                    <div class="mb-3">
                                        <label for="descripcion" class="labelTitulo">Descripción</label>
                                        <textarea class="form-control border-green" name="descripcion" id="descripcion" rows="3"
                                            placeholder="Especifique..."></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="color" class="labelTitulo">Estatus</label>
                                        <input type="color" class="inputCaja" name="color" id="color"
                                            aria-describedby="helpId" placeholder="Color">
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
    <style>
        .fc-toolbar {
            text-transform: capitalize;
        }

        .fc-scroller {
            text-transform: capitalize;
        }

        .fc-daygrid-day-top {
            justify-content: center;
        }

        #calendar {
            border: 2px solid #f7cd22;
            /* Cambia el color y el grosor del borde según tus preferencias */
            border-radius: 10px;
            /* Opcional: Añadir esquinas redondeadas */
            padding: 10px;
            /* Opcional: Agregar espacio interno alrededor del calendario */
        }

        .fc-day,
        .fc-view-harness {
            border: 1px solid #5c7c26 !important;
            /* Cambia el color y el grosor del borde según tus preferencias */

        }

        .fc {
            border: 2px solid #e74c3c;
            /* Cambia el color y el grosor del borde según tus preferencias */
            border-radius: 10px;
            /* Opcional: Añadir esquinas redondeadas */
            padding: 20px;
            /* Opcional: Agregar espacio interno alrededor del calendario */
        }

        .fc-daygrid-dot-event .fc-event-title {
            font-weight: normal;
        }

        .fc-daygrid-day-top a {
            color: black !important;
            text-decoration: none;
            cursor: pointer;
            font-size: 18px !important;

        }

        .fc .fc-col-header-cell-cushion {
            color: white !important;
            text-decoration: none;
            font-size: 18px !important;
        }

        .fc-theme-standard th {
            /*border: 2px solid #5c7c26 !important;*/
            background-color: #5c7c26 !important;
            /* padding-top: -1px; */
            padding-left: -5px !important;
            border-right: 1px solid #5c7c26 !important;
        }

        .fc-button .fc-button-active {
            background: #5c7c26 !important;
        }

        .fc .fc-button-primary:not(:disabled):active,
        .fc .fc-button-primary:not(:disabled).fc-button-active {
            background-color: #8eb322;
            /* Cambia el color de fondo del botón activo */
            border-color: #5c7c26;
            /* Cambia el color del borde del botón activo */
            color: #ffffff;
            /* Cambia el color del texto del botón activo */
        }

        .fc .fc-scrollgrid-liquid {
            border-top: none;
            border-left: none;
        }

        /* Estilos para botones inactivos */
        .fc-button:not(.fc-button-active) {
            background-color: #5c7c26;
            border-color: #5c7c26;
            color: #ffffff;
        }

        .fc .fc-button:hover {
            background-color: #8eb322;
            border-color: #5c7c26;
            color: #ffffff;
        }

        .fc-direction-ltr .fc-toolbar>*> :not(:first-child) {
            color: #fff !important;
            color: var(--fc-button-text-color, #fff) !important;
            background-color: #2C3E50 !important;
            background-color: var(--fc-button-bg-color, #727176) !important;
            border-color: #2C3E50 !important;
            border-color: var(--fc-button-border-color, #2C3E50) !important;
        }

        .fc-event {
            margin-bottom: 4px;
            /* Ajusta este valor según tus preferencias */
        }

        /* .fc .fc-daygrid-day-frame {
                position: relative;
                min-height: 100% !important;
            } */

        /* .fc-daygrid-day-events {
                padding-bottom: -20px;
            } */
        .fc .fc-daygrid-more-link {
            font-size: 16px;
            /* Tamaño de fuente personalizado */
            font-weight: bold;
            /* Negritas */
            justify-content: center;
            display: flex;
        }

        .fc .fc-daygrid-day.fc-day-today {
            background-color: rgba(255, 220, 40, 0.15);
            background-color: var(--fc-today-bg-color, rgba(255, 220, 40, 0.15));
            border: 2px solid #f7cd22 !important;
        }

        .single-day-event {
            border-top: 2px solid blue;
            /* Cambia el estilo de la línea según tus preferencias */
            border-bottom: 2px solid blue;
            /* Agrega un borde inferior para mejorar la apariencia */
            color: white;
            pointer-events: none;
            font-weight: bold;
        }
    </style>
@endsection
<script></script>
<!-- Bootstrap JavaScript Libraries -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        let modalEvento = new bootstrap.Modal(document.getElementById('modalEvento'), {
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

            if (
                start.getFullYear() === end.getFullYear() &&
                start.getMonth() === end.getMonth() &&
                start.getDate() === end.getDate()
            ) {
                // Agrega la clase "single-day-event" al evento
                // evento.className = 'single-day-event';
                // evento.allDay = true;
                // Agrega el atributo data-color al objeto evento
                // evento.extendedProps: {
                // backgroundColor: '#f7c90d'
                // },
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
                    eventMaxStack: 2
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
                //alert("DATE: " + informacion.dateStr);
                document.getElementById('fecha').value = informacion.dateStr;
                document.getElementById('color').value = '#f7c90d';
                modalEvento.show();

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
            }
            // right: 'dayGridMonth,timeGridWeek,listWeek'
        });
        if (window.innerWidth > 1200) {
            calendar.setOption('contentHeight', 700);
        }
        calendar.render();
    });
</script>
