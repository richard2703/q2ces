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
</head>
    <div class="content">
    <div class="row">
        <div class="col-4 text-left mb-1" style="margin-left: 12px">
            <a href="{{ url('dashMtq') }}" id="regresarId">
                <button class="btn regresar" style="background-color: var(--select);
                color: #fff;
                display: inline-flex;">
                    <span class="material-icons">
                        reply
                    </span>
                    Regresar
                </button>
            </a>
            </div>
            <div class="col-8 text-end mb-1" style="margin-left: -25px">
                @can('maquinaria_mtq_create')
                    <button data-bs-toggle="modal" data-bs-target="#modalEvento" type="button"
                        class="btn botonGral">Añadir
                        Evento</button>
                @endcan
            </div>
        </div>
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
                        <form action="{{route('calendarioMtq.store')}}" method="post">
                            @csrf
                            @method('post')
                            <!-- <div class="mb-3">
                              <label for="id" class="form-label">ID:</label>
                              <input type="text"
                                class="form-control" name="id" id="id" aria-describedby="helpId" placeholder="ID">
                            </div> -->

                            <input type="hidden" name="title">
                            <input type="hidden" name="maquinariaId">

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
                                    <input autofocus type="text" class="inputCaja" id="numeconomico" name="numeconomico"
                                        placeholder="Del Equipo..." readonly>
                                </div>

                                <div class="mb-3 col-6">
                                    <label for="title" class="labelTitulo">Placas:</label>
                                    <input autofocus type="text" class="inputCaja" id="placas" name="placas"
                                        placeholder="Placas Equipo..." readonly>
                                </div>

                                <div class="mb-3 col-6">
                                    <label for="title" class="labelTitulo">Marca:</label>
                                    <input autofocus type="text" class="inputCaja" id="marca" name="marca"
                                        placeholder="Marca Equipo..." readonly>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="title" class="labelTitulo">Mantenimiento:</label>
                                <select name="mantenimiento" id="titleSelect" required class="form-select">
                                    <option value="">Seleccione</option>
                                    @foreach ($servicios as $item)
                                        <option value="{{ $item->id }}" data-color="{{ $item->color }}">
                                            {{ $item->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                            <label for="color" class="labelTitulo">Color:</label>
                                <div id="colorBox" class="color-box w-100" style="margin-left:-0.5px"></div>
                            </div>

                            <div class="row">
                            <div class="mb-3 col-6">
                              <label for="fecha" class="labelTitulo">Fecha De Llegada:</label>
                              <input type="date"
                                class="inputCaja" name="fecha" id="fecha" aria-describedby="helpId" placeholder="Fecha">
                            </div>

                            <div class="mb-3 col-6">
                              <label for="hora" class="labelTitulo">Hora De Llegada:</label>
                              <input type="time"
                                class="inputCaja" name="hora" id="hora" aria-describedby="helpId" placeholder="Fecha">
                            </div>
                            </div>
                            
                            <div class="mb-3">
                              <label for="descripcion" class="labelTitulo">Descripción:</label>
                              <textarea class="form-control-textarea border-green" name="descripcion" id="descripcion" rows="3" placeholder="Especifique..."></textarea>
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
        <div class="modal fade" id="modalEventoEdit" tabindex="-1" aria-labelledby="modalTitleId" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bacTituloPrincipal">
                        <h5 class="modal-title fs-5" id="modalTitleId">Editar Evento</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                        <form action="{{route('calendarioMtq.store')}}" method="post">
                            @csrf
                            @method('post')
                            <!-- <div class="mb-3">
                              <label for="id" class="form-label">ID:</label>
                              <input type="text"
                                class="form-control" name="id" id="id" aria-describedby="helpId" placeholder="ID">
                            </div> -->

                            <input type="hidden" id="title" name="title">
                            <input type="hidden" id="maquinariaId" name="maquinariaId">

                            <div class="mb-3" role="search">
                                <label for="title" class="labelTitulo">Buscador:</label>
                                <input autofocus type="text" class="inputCaja" id="searchSEdit" name="search"
                                    placeholder="Buscar Equipo..." title="Escriba la(s) palabra(s) a buscar.">
                            </div>

                            <div class="row">
                                <div class="mb-3 col-6">
                                    <label for="title" class="labelTitulo">Nombre:</label>
                                    <input autofocus type="text" class="inputCaja" id="nombreEdit" name="nombre"
                                        placeholder="Nombre Equipo..." readonly>
                                </div>

                                <div class="mb-3 col-6">
                                    <label for="title" class="labelTitulo">Número Economico:</label>
                                    <input autofocus type="text" class="inputCaja" id="numeconomicoEdit" name="numeconomico"
                                        placeholder="Del Equipo..." readonly>
                                </div>

                                <div class="mb-3 col-6">
                                    <label for="title" class="labelTitulo">Placas:</label>
                                    <input autofocus type="text" class="inputCaja" id="placasEdit" name="placas"
                                        placeholder="Placas Equipo..." readonly>
                                </div>

                                <div class="mb-3 col-6">
                                    <label for="title" class="labelTitulo">Marca:</label>
                                    <input autofocus type="text" class="inputCaja" id="marcaEdit" name="marca"
                                        placeholder="Marca Equipo..." readonly>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="title" class="labelTitulo">Mantenimiento:</label>
                                <select name="mantenimiento" id="titleSelectEdit" required class="form-select">
                                    <option value="">Seleccione</option>
                                    @foreach ($servicios as $item)
                                        <option value="{{ $item->id }}" data-color="{{ $item->color }}">
                                            {{ $item->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                            <label for="color" class="labelTitulo">Color:</label>
                                <div id="colorBoxEdit" class="color-box w-100" style="margin-left:-0.5px"></div>
                            </div>

                            <div class="row">
                                <div class="mb-3 col-6">
                                <label for="fecha" class="labelTitulo">Fecha De Llegada:</label>
                                <input type="date"
                                    class="inputCaja" name="fecha" id="fechaEdit" aria-describedby="helpId" placeholder="Fecha">
                                </div>

                                <div class="mb-3 col-6">
                                <label for="hora" class="labelTitulo">Hora De Llegada:</label>
                                <input type="time"
                                    class="inputCaja" name="hora" id="horaEdit" aria-describedby="helpId" placeholder="Fecha">
                                </div>
                            </div>

                            <div class="row">
                                <div class="mb-3 col-6">
                                <label for="fecha" class="labelTitulo">Fecha De Salida:</label>
                                <input type="date"
                                    class="inputCaja" name="fechaSalida" id="fechaSalida" aria-describedby="helpId" placeholder="Fecha">
                                </div>

                                <div class="mb-3 col-6">
                                <label for="hora" class="labelTitulo">Hora De Salida:</label>
                                <input type="time"
                                    class="inputCaja" name="horaSalida" id="horaSalida" aria-describedby="helpId" placeholder="Fecha">
                                </div>
                            </div>
                            
                            <div class="mb-3">
                              <label for="descripcion" class="labelTitulo">Descripción:</label>
                              <textarea class="form-control-textarea border-green" name="descripcion" id="descripcionEdit" rows="3" placeholder="Especifique..."></textarea>
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
        .color-box {
            width: 30px; /* Ajusta el ancho según tus preferencias */
            height: 30px; /* Ajusta la altura según tus preferencias */
            display: inline-block;
            vertical-align: middle;
            margin-left: 10px; /* Ajusta el margen según tus preferencias */
            border: 1px solid #ccc;
        }
        .fc-toolbar { text-transform: capitalize; }
        .fc-scroller { text-transform: capitalize; }
        .fc-daygrid-day-top {
            justify-content: center;
        }
        #calendar {
            border: 2px solid #f7cd22; /* Cambia el color y el grosor del borde según tus preferencias */
            border-radius: 10px; /* Opcional: Añadir esquinas redondeadas */
            padding: 10px; /* Opcional: Agregar espacio interno alrededor del calendario */
        }
        .fc-day, .fc-view-harness {
            border: 1px solid #5c7c26 !important; /* Cambia el color y el grosor del borde según tus preferencias */
            
        }
        .fc {
            border: 2px solid #e74c3c; /* Cambia el color y el grosor del borde según tus preferencias */
            border-radius: 10px; /* Opcional: Añadir esquinas redondeadas */
            padding: 20px; /* Opcional: Agregar espacio interno alrededor del calendario */
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
        .fc-theme-standard th{
            /*border: 2px solid #5c7c26 !important;*/
            background-color: #5c7c26 !important;
            /* padding-top: -1px; */
            padding-left: -5px !important;
            border-right: 1px solid #5c7c26 !important;
        }
        .fc-button .fc-button-active{
            background: #5c7c26 !important;
        }
        .fc .fc-button-primary:not(:disabled):active, .fc .fc-button-primary:not(:disabled).fc-button-active {
            background-color: #8eb322; /* Cambia el color de fondo del botón activo */
            border-color: #5c7c26; /* Cambia el color del borde del botón activo */
            color: #ffffff; /* Cambia el color del texto del botón activo */
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
        .fc-direction-ltr .fc-toolbar > * > :not(:first-child) {
            color: #fff !important;
            color: var(--fc-button-text-color, #fff) !important;
            background-color: #2C3E50 !important;
            background-color: var(--fc-button-bg-color, #727176) !important;
            border-color: #2C3E50 !important;
            border-color: var(--fc-button-border-color, #2C3E50) !important;
        }
        .fc-event {
            margin-bottom: 4px; /* Ajusta este valor según tus preferencias */
        }
        /* .fc .fc-daygrid-day-frame {
            position: relative;
            min-height: 100% !important;
        } */

        /* .fc-daygrid-day-events {
            padding-bottom: -20px;
        } */
        .fc .fc-daygrid-more-link {
            font-size: 16px; /* Tamaño de fuente personalizado */
            font-weight: bold; /* Negritas */
            justify-content: center ;
            display: flex;   
        }
        .fc .fc-daygrid-day.fc-day-today {
            background-color: rgba(255, 220, 40, 0.15);
            background-color: var(--fc-today-bg-color, rgba(255, 220, 40, 0.15));
            border: 2px solid #f7cd22 !important;
        }
        .single-day-event {
        border-top: 2px solid blue; /* Cambia el estilo de la línea según tus preferencias */
        border-bottom: 2px solid blue; /* Agrega un borde inferior para mejorar la apariencia */
        color: white;
        pointer-events:none;
        font-weight: bold;
        }
        #regresarId:hover button{
            color: black !important;
        }
    </style>
    
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
console.log(ui.item);
        // Rellenar los campos con los datos de la persona seleccionada
        $('#maquinariaId').val(ui.item.id);

        // $('#descripcion').val(ui.item.value);
        $('#title').val(ui.item.placas);
        $('#nombre').val(ui.item.nombre);
        $('#marca').val(ui.item.marca);
        // $('#modelo').val(ui.item.modelo);
        $('#numeconomico').val(ui.item.identificador);
        $('#placas').val(ui.item.placas);
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
    let modalEvento = new bootstrap.Modal(document.getElementById('modalEvento'), { keyboard: false });
    let modalEventoEdit = new bootstrap.Modal(document.getElementById('modalEventoEdit'), { keyboard: false });
    
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
        evento.extendedProps = {
            backgroundColor: evento.color
        };
        // Agrega la información de estilo al evento
        // evento.styleInfo = {
        //     backgroundColor: evento.color
        // };
        
    }
    }

    console.log('$eventosJson',eventosJson);
    var calendar = new FullCalendar.Calendar(calendarEl, {
        
        // height: 850,
    dayMaxEventRows: true, // for all non-TimeGrid views
    views: {
            timeGrid: {
                dayMaxEventRows: 5,
            },
            week: {
                eventMaxStack: 1,
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
        dateClick:function(informacion){
            //alert("DATE: " + informacion.dateStr);
            document.getElementById('fecha').value = informacion.dateStr;
            //document.getElementById('color').value= '#f7c90d';
            modalEvento.show();
            
        },
        eventClick:function(informacion){
            modalEventoEdit.show();
            
            recuperarDatosEvento(informacion.event);
        },
        events: eventosJson,
        
        dayHeaderFormat: { weekday: 'long', capitalized: true },
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
        calendar.setOption('contentHeight', 770);
    }
    calendar.render();
    });
</script>

<script>
    function recuperarDatosEvento(evento){
        //console.log('info Modal', evento);
        let fecha = evento._instance.range.start;
        let fechaObj = new Date(fecha);
        let fechaFormateada = fechaObj.toISOString().split("T")[0];
        let horaFormateada = fechaObj.toLocaleTimeString("en-US", { timeZone: "America/Mexico_City", hour12: false });
        //fechaEdit = evento._def.extendedProps.fecha;
        let fechaEdit = evento._instance.range.end;
        let fechaEditObj = new Date(fechaEdit);
        let fechaEditFormateada = fechaEditObj.toISOString().split("T")[0];
        let horaEditFormateada = fechaEditObj.toLocaleTimeString("es-MX", { hour12: false });
        console.log('fecha',horaFormateada);
        
        document.getElementById('fechaEdit').value = fechaFormateada;
        document.getElementById('horaEdit').value = horaFormateada;
        document.getElementById('fechaSalida').value = fechaEditFormateada;
        document.getElementById('horaSalida').value = horaEditFormateada;
        //fechaEdit = evento._def.extendedProps.fecha;
        document.getElementById('descripcionEdit').value = evento._def.extendedProps.descripcion;
    }
</script>

<script>
document.addEventListener("DOMContentLoaded", function() {
    var titleSelect = document.getElementById("titleSelect");
    var colorBox = document.getElementById("colorBox");

    titleSelect.addEventListener("change", function() {
        var selectedColor = this.options[this.selectedIndex].getAttribute("data-color");
        colorBox.style.backgroundColor = selectedColor;
    });

    var titleSelectEdit = document.getElementById("titleSelectEdit");
    var colorBoxEdit = document.getElementById("colorBoxEdit");

    titleSelectEdit.addEventListener("change", function() {
        var selectedColor = this.options[this.selectedIndex].getAttribute("data-color");
        colorBoxEdit.style.backgroundColor = selectedColor;
    });
});
</script>
@endsection
    



