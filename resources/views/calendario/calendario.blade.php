@extends('layouts.main', ['activePage' => 'calendario', 'titlePage' => __('Calendario')])
<?php
$objCalendar = new Calendario();
$mesAnterior= $objCalendar->getMesAnterior($intMes,$intAnio);
$mesSiguiente= $objCalendar->getMesSiguiente($intMes,$intAnio);

?>
@section('content')
    <div class="content">
        @if ($errors->any())
            <div class="alert alert-danger">
                <!-- PARA LA CARGA DE LOS ERRORES DE LOS DATOS-->
                <p>Listado de errores a corregir</p>
                <ul>
                    @foreach ($errors->all() as $item)
                        <li>{{ $item }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12 align-self-center">
                    <div class="card">
                        <div class="card-body contCart">
                            <div class="p-1 align-self-start bacTituloPrincipal">
                                <h2 class="my-3 ms-3 texticonos "> Calendario De Actividades</h2>
                            </div>
                            <!-- Esta es la parte para el calendario-->
                            <div class="col-11  mx-auto d-block my-4">
                                <div class="row d-flex ">

                                    <div class="container-fluid">
                                        <header>
                                            <h4 class="display-4 mb-4 text-center">{{ ucwords(trans($objCalendar->getNameMonth($intMes))) }}  {{ $intAnio }}</h4>
                                            <div class="row d-flex  d-flex align-items-start">
                                                <div class="col-12 col-md-6 d-flex">
                                                    <div class="mx-3"><img src="/img/calendario/tarea.svg" alt="Tarea" title="Tarea" width="25px" class="botonIconoPrincipal"> Tarea</div>
                                                    <div class="mx-3"><img src="/img/calendario/solicitud.svg" alt="Solicitud" title="Solicitud" width="25px" class="botonIconoPrincipal"> Solicitud</div>
                                                    <div class="mx-3"><img src="/img/calendario/mantenimiento.svg" alt="Mantenimiento" title="Mantenimiento" width="25px" class="botonIconoPrincipal"> Mantenimiento</div>
                                                </div>


                                                 <!-- Un mes atras del cargado -->
                                                 <div class="col-12 col-lg-6 d-flex align-items-center justify-content-end ">
                                                    <div class="">
                                                        <span>
                                                            <a href="{{ url('calendario/'.$mesAnterior['year'].'/'.$mesAnterior['month']) }}" class="" title="Ir al mes anterior">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                                        fill="currentColor" class="bi bi-caret-left-fill"
                                                                        viewBox="0 0 16 16">
                                                                        <path d="m3.86 8.753 5.482 4.796c.646.566 1.658.106 1.658-.753V3.204a1 1 0 0 0-1.659-.753l-5.48 4.796a1 1 0 0 0 0 1.506z" />
                                                                </svg>

                                                            </a>
                                                                <!-- Para el mes en curso -->
                                                        </span>
                                                        <span>
                                                                <a href="{{ url('calendario/') }}" class="display-4 mb-4 text-end fs-4" title="Ir al mes en curso"><b>Hoy Es {{ date('d M Y') }}</b>
                                                        </span>

                                                            <!-- Un mes adelante del cargado -->
                                                        <a href="{{ url('calendario/'.$mesSiguiente['year'].'/'.$mesSiguiente['month']) }}" class=" " title="Ir al mes siguiente">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-right-fill" viewBox="0 0 16 16">
                                                                <path  d="m12.14 8.753-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z" />
                                                            </svg>
                                                        </a>

                                                    </div>
                                                    <div class="ms-4 ">
                                                        <button type="button" class="botonSinFondo mx-2"title="Clic para marcar la asistencia en otro día."
                                                            data-bs-toggle="modal" data-bs-target="#modal-cliente">
                                                            <img style="width: 30px;"src="{{ '/img/inventario/reestock.svg' }}">
                                                            <p class="botonTitulos mt-2">Otro Día</p>
                                                        </button>
                                                    </div>
                                                </div>

                                            </div>
                                            <?php

                                            $iCw = 1;
                                            $aDays = $objCalendar->getDaysInMonth($intMes, $intAnio);
                                            $iDaysMonth = count($aDays);
                                            ?>
                                        </header>
                                    </div>
                                    <hr>
                                    <?php

                                    $sRow = '';
                                    $sTable = '';
                                    $dteToday = date('Y-m-d');


                                    $sTable .= '<div class="container-fluid">';
                                    $sTable .= $objCalendar->getDaysWeekCalendar(); //*** cabecera de los días de la semana
                                    foreach ($aDays as $iDay => $currentDay) {
                                        $content = '';
                                        $strEstiloHoy = ($dteToday == $currentDay ? 'style="box-shadow: 2px 2px 10px 2px #F7C90D; "':"");
                                        // $sResult = "<h2>$iDay</h2>";
                                        // $sResult .= "<div style='float: right;'> ";
                                        // $sResult .= $content;
                                        // $sResult .= '</div>';
                                        // dd($vctEventos);

                                        //*** trabajamos las tarea registradas
                                        if($vctTasks->isEmpty()==false){
                                            foreach($vctTasks as $tarea){
                                                if($tarea->fechaFin === $currentDay){

                                                    $content .=  '<a href="#" class="label'. $tarea->prioridad . ' event d-block p-1 pl-2 pr-2 mb-1 rounded text-truncate small text-white"  data-bs-toggle="modal" data-bs-target="#editarTarea"
                                                    onclick="loadTarea(\'' . $tarea->id .
                                                    '\',\'' . $tarea->titulo .
                                                    '\',\'' . $tarea->responsableId .
                                                    '\',\'' . $tarea->prioridadId .
                                                    '\',\'' . $tarea->estadoId .
                                                    '\',\'' . $tarea->comentario .
                                                    '\',\'' .  \Carbon\Carbon::parse($tarea->fechaInicio)->format('d/m/Y') .
                                                    '\',\'' . \Carbon\Carbon::parse($tarea->fechaFin)->format('d/m/Y') .
                                                    '\')"  title="' . $tarea->titulo . ': '. ($tarea->comentario? $tarea->comentario :"Sin comentarios") . '">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" style="height: 10px;"><defs><style>.cls-1{fill:#fff;}</style></defs><g id="Capa_2" data-name="Capa 2"><g id="Capa_8" data-name="Capa 8"><path id="Trazado_2166" data-name="Trazado 2166" class="cls-1" d="M30,17.76V12.24H25.37a10.75,10.75,0,0,0-1.09-2.62l3.28-3.28-3.9-3.9L20.38,5.72a10.75,10.75,0,0,0-2.62-1.09V0H12.24V4.63A10.75,10.75,0,0,0,9.62,5.72L6.34,2.44l-3.9,3.9L5.72,9.62a10.75,10.75,0,0,0-1.09,2.62H0v5.52H4.63a10.75,10.75,0,0,0,1.09,2.62L2.44,23.66l3.9,3.9,3.28-3.28a10.75,10.75,0,0,0,2.62,1.09V30h5.52V25.37a10.34,10.34,0,0,0,2.62-1.08l3.28,3.28,3.9-3.9-3.28-3.28a10.75,10.75,0,0,0,1.09-2.62ZM15,21.41A6.41,6.41,0,1,1,21.41,15h0A6.41,6.41,0,0,1,15,21.41Z"/></g></g></svg>&nbsp;&nbsp;'
                                                    . $tarea->titulo .
                                                     '</a>';
                                                    //  dd($content);
                                                }
                                            }
                                        }
                                         //*** trabajamos las solicitudes registradas
                                        if($vctSolicitudes->isEmpty()==false){
                                            foreach($vctSolicitudes as $solicitud){
                                                if($solicitud->fechaRequerimiento === $currentDay){

                                                    $content .=  '<a href="#" class="label'. $solicitud->prioridad . ' event d-block p-1 pl-2 pr-2 mb-1 rounded text-truncate small text-white"  data-bs-toggle="modal" data-bs-target="#editarTarea"
                                                        title="' . $solicitud->titulo . ': '. ($solicitud->comentario? $solicitud->comentario :"Sin comentarios") . '">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" style="height: 10px;"><defs><style>.cls-1{fill:#fff;}</style></defs><g id="Capa_2" data-name="Capa 2"><g id="Capa_8" data-name="Capa 8"><g id="Grupo_1867" data-name="Grupo 1867"><path id="Trazado_2134" data-name="Trazado 2134" class="cls-1" d="M9,30H0L3.93,14.52,0,0H9L13,15.75Z"/><path id="Trazado_2135" data-name="Trazado 2135" class="cls-1" d="M26.07,30H17L21,14.52,17,0h9L30,15.75Z"/></g></g></g></svg>&nbsp;&nbsp;'
                                                    . $solicitud->titulo .
                                                     '</a>';
                                                    //  dd($content);
                                                }
                                            }
                                        }


                                        //*** trabajamos los eventos registrados
                                        if($vctEventos->isEmpty()==false){
                                            foreach($vctEventos as $evento){
                                                if($evento->fechaFin === $currentDay){
                                                    $content .=  '<a href="#" class="label'. $evento->prioridad . ' event d-block p-1 pl-2 pr-2 mb-1 rounded text-truncate small text-white"  data-bs-toggle="modal" data-bs-target="#verEvento"
                                                        onclick="loadEvento(\'' . $evento->id .
                                                    '\',\'' . $evento->titulo .
                                                    '\',\'' . $evento->comentario .
                                                    '\')"title="' . $evento->titulo . ': '. ($evento->comentario? $evento->comentario :"Sin comentarios") . '">
                                                       <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" style="height: 10px;"><defs><style>.cls-1{fill:#fff;fill-rule:evenodd;}</style></defs><g id="Capa_2" data-name="Capa 2"><g id="Capa_8" data-name="Capa 8"><path id="Trazado_2136" data-name="Trazado 2136" class="cls-1" d="M.53,7.29A1.34,1.34,0,0,1,.28,5.41a1.18,1.18,0,0,1,.25-.25A1.83,1.83,0,0,1,3,5.16l4,3.34a1.35,1.35,0,0,1,.23,1.9,1.25,1.25,0,0,1-.23.23,1.68,1.68,0,0,1-1.39.61,1.58,1.58,0,0,1-1.21-.61Z"/><path id="Trazado_2137" data-name="Trazado 2137" class="cls-1" d="M23.24,10.93a1.49,1.49,0,0,1-.15-2.12.75.75,0,0,1,.15-.16l3.82-3.34a1.83,1.83,0,0,1,2.42,0,1.51,1.51,0,0,1,.15,2.13l-.15.15-3.81,3.34a2,2,0,0,1-1.22.46A1.64,1.64,0,0,1,23.24,10.93Z"/><path id="Trazado_2138" data-name="Trazado 2138" class="cls-1" d="M13.36,6.23V1.52a1.75,1.75,0,0,1,3.46,0V6.23a1.73,1.73,0,0,1-3.46,0Z"/><path id="Trazado_2139" data-name="Trazado 2139" class="cls-1" d="M4.16,30H26V20.35H22a6.15,6.15,0,0,0,.87-3V16.7c0-3.8-3.64-6.83-7.8-6.83-4.34,0-8,3-8,6.83v.61a6.26,6.26,0,0,0,.87,3H4.16Z"/></g></g></svg>&nbsp;&nbsp;'
                                                    . $evento->titulo .
                                                     '</a>';
                                                    //  dd($content);
                                                }

                                            }
                                        }

                                        //*** trabajamos los mantenimientos registrados
                                        if($vctMantenimientos->isEmpty()==false){
                                            foreach($vctMantenimientos as $mantto){
                                                if($mantto->fechaInicio === $currentDay){
                                                    $content .=  '<a href="#" class="label'. $mantto->estado . ' event d-block p-1 pl-2 pr-2 mb-1 rounded text-truncate small text-white"  data-bs-toggle="modal" data-bs-target="#editarEvento"
                                                        title="' .  ($mantto->comentario? $mantto->comentario :"Sin comentarios") . '">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" style="height: 10px;"><defs><style>.cls-1{fill:#fff;fill-rule:evenodd;}</style></defs><g id="Capa_2" data-name="Capa 2"><g id="Capa_8" data-name="Capa 8"><g id="Grupo_1868" data-name="Grupo 1868"><path id="Trazado_2131" data-name="Trazado 2131" class="cls-1" d="M30,17.06a2.87,2.87,0,0,0-.44-1.54c0-.13,0-.26-.1-.39l-3.11-6v0c-1-2.52-2.62-4.83-6.55-4.83H16.05a5.16,5.16,0,0,1,.1,1.88H19.8c2.07,0,3.16.9,4.25,3.51l2.24,3.59a7.23,7.23,0,0,0-2.4-.34h-11l0,5.17h4.29c.49,0,.92.3.92.65s-.43.68-.92.68H12.89v3.64h9.68v2.73a1.74,1.74,0,0,0,1.9,1.55h3.67A1.74,1.74,0,0,0,30,25.78V20.27a.87.87,0,0,0-.17-.52,2,2,0,0,0,.17-.81Zm-4.2,2.56h-4c-.82,0-1.42-.47-1.42-1.07s.61-1,1.42-1h4a1.08,1.08,0,1,1,.54,2.09,1,1,0,0,1-.54,0Z"/><path id="Trazado_2132" data-name="Trazado 2132" class="cls-1" d="M14.56,4.72h0c0-2-1.46-3.77-3.66-4.72V4.36L7.31,5.9,3.65,4.36V0C1.46,1,0,2.72,0,4.72s1.64,4,4,4.81V27.46a2.34,2.34,0,0,0,1,1.81A4.28,4.28,0,0,0,7.43,30c1.89,0,3.41-1.13,3.47-2.54l-.06-18c2.26-.91,3.72-2.72,3.72-4.72Z"/></g></g></g></svg>&nbsp;&nbsp;'
                                                    . $mantto->titulo .
                                                     '</a>';
                                                    //  dd($content);
                                                }

                                            }
                                        }


                                        $sResult = ' <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate" '. $strEstiloHoy .' style="height: 110px;">';
                                        $sResult .= '   <h5 class="row align-items-center">';
                                        $sResult .= '       <span class="date col-1">' . $iDay . '  </span>';
                                        $sResult .= '       <small class="col d-sm-none text-center text-muted">Friday</small>';
                                        $sResult .= '       <span class="col-1"></span>';
                                        $sResult .= '   </h5>';
                                        $sResult .= '    ' . $content . ' ';
                                        $sResult .= '</div>';

                                        // dd($sResult);

                                        if ($iCw == 1) {
                                            $sRow .= '<div class="row border border-right-0 border-bottom-0" >';
                                        }

                                        if ($iDay == 1) {
                                            $sRow .= $objCalendar->getStartWeek($currentDay);
                                            $iCw += $objCalendar->getDayOnWeek($currentDay);
                                            $sRow .=  $sResult ;
                                        } elseif ($iDay == $iDaysMonth) {
                                            $sRow .=  $sResult;
                                            $sRow .= $objCalendar->getEndWeek($currentDay);
                                        } else {
                                            $sRow .=  $sResult ;
                                        }

                                        if ($iCw == 7) {
                                            $iCw = 1;
                                            $sRow .= '</div>';
                                        } else {
                                            $iCw += 1;
                                        }
                                    }

                                    $sTable .= $sRow;
                                    $sTable .= '</div>';

                                    echo $sTable;
                                    ?>

                                    </>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--Espacio para index Tareas Solicitudes y Mantenimientos-->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <!-- <div class="card-header bacTituloPrincipal">                                                                                                                                                    </div>-->
                                <div class="card-body mb-3">
                                    <div class="nav nav-tabs justify-content-evenly" id="myTab" role="tablist">

                                        <button class=" nav-item col-12 col-md-4 BTNbCargaDescarga py-3 border-0 active "
                                            role="presentation" id="tareas-tab" data-bs-toggle="tab"
                                            data-bs-target="#tareas-tab-pane" type="button" role="tab"
                                            aria-controls="tareas-tab-pane" aria-selected="true">
                                            Tareas
                                        </button>
                                        <button class="nav-item col-12 col-md-4 BTNbCargaDescarga " role="presentation"
                                            id="solicitud-tab" data-bs-toggle="tab" data-bs-target="#solicitud-tab-pane"
                                            type="button" role="tab" aria-controls="solicitud-tab-pane"
                                            aria-selected="false">
                                            Solicitudes
                                        </button>
                                        <button class="nav-item col-12 col-md-4 BTNbCargaDescarga " role="presentation"
                                            id="profile-tab" data-bs-toggle="tab" data-bs-target="#mantenimiento-tab-pane"
                                            type="button" role="tab" aria-controls="mantenimiento-tab-pane"
                                            aria-selected="false">
                                            Mantenimientos
                                        </button>
                                    </div>

                                    <div class="tab-content contentCargas" id="myTabContent">
                                        <!-- Tareas-->
                                        <div class="tab-pane fade show active" id="tareas-tab-pane"
                                            role="tabpanel"aria-labelledby="home-tab" tabindex="0">
                                            <div class="row">

                                                <div class="col-12">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <div class="table-responsive">
                                                                <div class="row border-bottom justify-content-end">
                                                                    <div class="col-3 mb-3">

                                                                        <button class="btnSinFondocALENDARIO float-end"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#nuevaTarea">
                                                                            <img src="img/calendario/tarea.svg"
                                                                                class="imgBTNcalendario">
                                                                            Nueva Tarea
                                                                        </button>

                                                                    </div>
                                                                </div>
                                                                <table class="table">
                                                                    <thead class="labelTitulo">
                                                                        <th class="fw-semibold">Tarea</th>
                                                                        <th class="fw-semibold">Responsable</th>
                                                                        <th class="fw-semibold">Fecha Inicio</th>
                                                                        <th class="fw-semibold">Fecha Fin</th>
                                                                        <th class="fw-semibold">Prioridad</th>
                                                                        <th class="fw-semibold">Estado</th>
                                                                        <th class="fw-semibold text-right">Acciones</th>
                                                                    </thead>
                                                                    <tbody>

                                                                        @forelse ($vctTasks as $tarea)
                                                                            <tr>
                                                                                <td>{{ $tarea->titulo }}</td>
                                                                                <td>{{ $tarea->responsable }}</td>
                                                                                <td>{{ \Carbon\Carbon::parse($tarea->fechaInicio)->format('Y-m-d') }}
                                                                                </td>
                                                                                <td>{{ \Carbon\Carbon::parse($tarea->fechaFin)->format('Y-m-d') }}
                                                                                </td>
                                                                                <td class="label{{ $tarea->prioridad }}">
                                                                                    <span>{{ $tarea->prioridad }}</span>
                                                                                </td>
                                                                                <td class="label{{ $tarea->estado }}">
                                                                                    <span>{{ $tarea->estado }}</span>
                                                                                </td>
                                                                                <td class="td-actions justify-content-end">
                                                                                    <a href="#" class=""
                                                                                        data-bs-toggle="modal"
                                                                                        data-bs-target="#editarTarea"
                                                                                        onclick="loadTarea(
                                                                                                    '{{ $tarea->id }}'
                                                                                                    ,'{{ $tarea->titulo }}'
                                                                                                    ,'{{ $tarea->responsableId }}'
                                                                                                    ,'{{ $tarea->prioridadId }}'
                                                                                                    ,'{{ $tarea->estadoId }}'
                                                                                                    ,'{{ $tarea->comentario }}'
                                                                                                    ,'{{ \Carbon\Carbon::parse($tarea->fechaInicio)->format('d/m/Y') }}'
                                                                                                    ,'{{ \Carbon\Carbon::parse($tarea->fechaFin)->format('d/m/Y') }}'
                                                                                                )">
                                                                                        <svg xmlns="http://www.w3.org/2000/svg "
                                                                                            width="28" height="28"
                                                                                            fill="currentColor"
                                                                                            class="bi bi-pencil accionesIconos"
                                                                                            viewBox="0 0 16 16">
                                                                                            <path
                                                                                                d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                                                                                        </svg>
                                                                                    </a>

                                                                                    <form action="">
                                                                                        <button class=" btnSinFondo"
                                                                                            type="submit" rel="tooltip">
                                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                                width="28"
                                                                                                height="28"
                                                                                                fill="currentColor"
                                                                                                class="bi bi-x-circle"
                                                                                                viewBox="0 0 16 16">
                                                                                                <path
                                                                                                    d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                                                                <path
                                                                                                    d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                                                                                            </svg>
                                                                                        </button>
                                                                                    </form>
                                                                                </td>
                                                                            </tr>
                                                                        @empty
                                                                            <tr>
                                                                                <td colspan="7">
                                                                                    Sin Tareas Registradas
                                                                                </td>
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
                                        <!-- Solicitudes -->
                                        <div class="tab-pane fade" id="solicitud-tab-pane" role="tabpanel"
                                            aria-labelledby="profile-tab" tabindex="0">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <div class="table-responsive">
                                                                <div class="row border-bottom justify-content-end">
                                                                    <div class="col-3 mb-3">
                                                                        <button class="btnSinFondocALENDARIO float-end"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#procesosModal">
                                                                            <img src="img/calendario/procesosverde.svg"
                                                                                class="imgBTNcalendario">
                                                                            Alta De Procesos
                                                                        </button>
                                                                    </div>
                                                                    <div class="col-3 mb-3">
                                                                        <button class="btnSinFondocALENDARIO float-end"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#solicitudModal">
                                                                            <img src="img/calendario/tarea.svg"
                                                                                class="imgBTNcalendario">
                                                                            Nueva Solicitud
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                                <table class="table">
                                                                    <thead class="labelTitulo">
                                                                        <th class="fw-semibold">Título</th>
                                                                        {{-- <th class="fw-semibold">Cantidad</th> --}}
                                                                        <th class="fw-semibold">Solicitante</th>
                                                                        <th class="fw-semibold">Fecha Solicitud</th>
                                                                        <th class="fw-semibold">Fecha Requerimiento</th>
                                                                        <th class="fw-semibold">Tipo</th>
                                                                        <th class="fw-semibold">Prioridad</th>
                                                                        <th class="fw-semibold">Estado</th>
                                                                        <th class="fw-semibold text-right">Acciones</th>
                                                                    </thead>
                                                                    <tbody>
                                                                        <!--primera linea-->
                                                                        @forelse($vctSolicitudes as $solicitud)
                                                                        <tr>
                                                                            <td>{{ $solicitud->servicio }}</td>
                                                                            {{-- <td>1</td> --}}
                                                                            <td>{{ $solicitud->usuario }}</td>
                                                                            <td>{{ $solicitud->fechaSolicitud }}</td>
                                                                            <td>{{ $solicitud->fechaRequerimiento }}</td>
                                                                            <td class="reparación">Reparación</td>
                                                                            <td class="label{{ $solicitud->prioridad }}"><span>{{ $solicitud->prioridad }}</span>
                                                                            </td>
                                                                            <td class="label{{ $solicitud->estado }}"><span>{{ $solicitud->estado }}</span>
                                                                            </td>
                                                                            <td class="td-actions justify-content-end">
                                                                                <a href="#" class=""
                                                                                    data-bs-toggle="modal"
                                                                                    data-bs-target="#editarReparacion">
                                                                                    <svg xmlns="http://www.w3.org/2000/svg "
                                                                                        width="28" height="28"
                                                                                        fill="currentColor"
                                                                                        class="bi bi-pencil accionesIconos"
                                                                                        viewBox="0 0 16 16">
                                                                                        <path
                                                                                            d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                                                                                    </svg>
                                                                                </a>
                                                                                <form action="">

                                                                                    <button class=" btnSinFondo"
                                                                                        type="submit" rel="tooltip">
                                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                                            width="28" height="28"
                                                                                            fill="currentColor"
                                                                                            class="bi bi-x-circle"
                                                                                            viewBox="0 0 16 16">
                                                                                            <path
                                                                                                d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                                                            <path
                                                                                                d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                                                                                        </svg>
                                                                                    </button>
                                                                                </form>
                                                                            </td>
                                                                        </tr>
                                                                        @empty
                                                                        <tr>
                                                                            <td colspan="7">
                                                                                Sin solicitudes registradas
                                                                            </td>
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
                                        <!-- Mantenimientos-->
                                        <div class="tab-pane fade" id="mantenimiento-tab-pane" role="tabpanel"
                                            aria-labelledby="profile-tab" tabindex="0">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <div class="table-responsive">
                                                                <div class="row border-bottom justify-content-end">
                                                                    <div class="col-3 mb-3">

                                                                        <button class="btnSinFondocALENDARIO float-end"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#mantenimientoModal">
                                                                            <img src="img/calendario/tarea.svg"
                                                                                class="imgBTNcalendario">
                                                                            Nuevo Mantenimiento
                                                                        </button>

                                                                    </div>
                                                                </div>
                                                                <table class="table">
                                                                    <thead class="labelTitulo">
                                                                        <th class="fw-semibold">ID</th>
                                                                        <th class="fw-semibold">Equipo</th>
                                                                        <th class="fw-semibold">Último Mantenimiento</th>
                                                                        <th class="fw-semibold">Próximo Mantenimiento</th>
                                                                        <th class="fw-semibold">Tipo</th>
                                                                        {{-- <th class="fw-semibold">Prioridad</th> --}}
                                                                        <th class="fw-semibold">Estado</th>
                                                                        <th class="fw-semibold text-right">Acciones</th>
                                                                    </thead>
                                                                    <tbody>
                                                                        <!--primera linea-->
                                                                            @forelse ($vctMantenimientos as $mantto )
                                                                            <tr>
                                                                                <td>{{ $mantto->maquinariaCodigo }}</td>
                                                                                <td>{{ $mantto->maquinaria }}</td>
                                                                                <td>{{ $mantto->fechaInicio }}</td>
                                                                                <td>{{ $mantto->fechaReal }}</td>
                                                                                <td>{{ $mantto->tipo }}</td>
                                                                                {{-- <td class="labelUrgente">Urgente</td> --}}
                                                                                <td class="label{{ $mantto->estado }}">{{ $mantto->estado }}</td>
                                                                                <td class="td-actions justify-content-end">
                                                                                    <a href="#" class=""
                                                                                        data-bs-toggle="modal"
                                                                                        data-bs-target="#editarMantenimiento"
                                                                                        onclick="loadMantenimiento(
                                                                                            '{{ $mantto->id }}'
                                                                                            ,'{{ $mantto->titulo }}'
                                                                                            ,'{{ $mantto->estadoId }}'
                                                                                            ,'{{ $mantto->comentario }}'
                                                                                            ,'{{ $mantto->tipo }}'
                                                                                            // ,'{{ \Carbon\Carbon::parse($mantto->fechaInicio)->format('d/m/Y') }}'
                                                                                            // ,'{{ \Carbon\Carbon::parse($mantto->fechaFin)->format('d/m/Y') }}'
                                                                                        )">
                                                                                        <svg xmlns="http://www.w3.org/2000/svg "
                                                                                            width="28" height="28"
                                                                                            fill="currentColor"
                                                                                            class="bi bi-pencil accionesIconos"
                                                                                            viewBox="0 0 16 16">
                                                                                            <path
                                                                                                d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                                                                                        </svg>
                                                                                    </a>
                                                                                    <form action="">
                                                                                        <button class=" btnSinFondo"
                                                                                            type="submit" rel="tooltip">
                                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                                width="28" height="28"
                                                                                                fill="currentColor"
                                                                                                class="bi bi-x-circle"
                                                                                                viewBox="0 0 16 16">
                                                                                                <path
                                                                                                    d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                                                                <path
                                                                                                    d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                                                                                            </svg>
                                                                                        </button>
                                                                                    </form>
                                                                                </td>
                                                                            </tr>
                                                                            @empty
                                                                            <tr>
                                                                                <td colspan="7">
                                                                                    Sin mantenimientos registrados
                                                                                </td>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>




        <!-- Modal Nueva Tarea-->
        <div class="modal fade" id="nuevaTarea" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bacTituloPrincipal">
                        <img src="img/calendario/tareagris.svg" class="imgBTNcalendario">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">&nbsp Nueva Tarea</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="row d-flex" action="{{ route('tareas.store') }}" method="post">
                            @csrf
                            <input type="hidden" name="userId" id="userId" value="{{ auth()->user()->id }}">
                            <div class=" col-12 col-sm-6 mb-3 ">
                                <label class="labelTitulo">Título:<span>*</span></label></br>
                                <input type="text" class="inputCaja" id="titulo" name="titulo"
                                    value="{{ old('titulo') }}" required placeholder="Especifique...">
                            </div>
                            <div class=" col-12 col-sm-6 mb-3 ">
                                <label class="labelTitulo">Responsable:</label></br>
                                <select class="form-select form-select-lg mb-3 inputCaja"
                                    aria-label=".form-select-lg example" name="responsable" id="responsable">

                                    <option value="">Seleccione</option>
                                    @foreach ($personal as $item)
                                        <option value="{{ $item->id }}">
                                            {{ $item->nombres . ' ' . $item->apellidoP }}
                                        </option>
                                    @endforeach
                                </select>

                            </div>
                            <div class=" col-12 my-3 py-4  fondoVerde ">
                                <h4 class="labelTitulo mb-2">Prioridad:</h4>
                                <div class="row">
                                    <div class=" col-6  col-lg-3 d-flex mb-3">
                                        <input class="" type="radio" name="prioridadId" id="flexRadioDefault1"
                                            value="1">
                                        <div class=" ms-3">
                                            <label class="form-check-label labelUrgente" for="flexRadioDefault1"> Urgente
                                            </label>
                                        </div>
                                    </div>

                                    <div class=" col-6 col-lg-3 d-flex mb-3">
                                        <input class="" type="radio" name="prioridadId" id="flexRadioDefault1"
                                            value="2">
                                        <div class=" ms-3">
                                            <label class="form-check-label labelNecesaria" for="flexRadioDefault1">
                                                Necesaria
                                            </label>
                                        </div>
                                    </div>
                                    <div class=" col-6  col-lg-3  d-flex mb-3">
                                        <input class="" type="radio" name="prioridadId" id="flexRadioDefault1"
                                            value="3">
                                        <div class=" ms-3">
                                            <label class="form-check-label labelDeseable" for="flexRadioDefault1">
                                                Deseable
                                            </label>
                                        </div>
                                    </div>
                                    <div class=" col-6  col-lg-3  d-flex mb-3">
                                        <input class="" type="radio" name="prioridadId" id="flexRadioDefault1"
                                            value="4">
                                        <div class=" ms-3">
                                            <label class="form-check-label labelProrrogable" for="flexRadioDefault1">
                                                Prorrogable </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class=" col-12 my-3 py-4 fondoVerde">
                                <h4 class="labelTitulo mb-2">Estado de la Solicitud</h4>
                                <div class="row">
                                    <div class=" col-6  col-lg-3   d-flex mb-3">
                                        <input class="" type="radio" name="estadoId" id="estadoId" value="1">
                                        <div class=" ms-3">
                                            <label class="form-check-label labelEspera" for="estadoId"> En Espera </label>
                                        </div>
                                    </div>
                                    <div class=" col-6  col-lg-3 d-flex mb-3">
                                        <input class="" type="radio" name="estadoId" id="estadoId" value="2">
                                        <div class=" ms-3">
                                            <label class="form-check-label labelRealizado" for="estadoId"> Realizado </label>
                                        </div>
                                    </div>
                                    <div class=" col-6  col-lg-3   d-flex mb-3">
                                        <input class="" type="radio" name="estadoId" id="estadoId" value="3">
                                        <div class=" ms-3">
                                            <label class="form-check-label labelTerminado" for="estadoId"> Terminado </label>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class=" col-12 col-sm-6 mb-3 ">
                                <label class="labelTitulo">Fecha Inicio:</label></br>
                                <input type="date" class="inputCaja" id="fechaInicio" name="fechaInicio"
                                    value="{{ old('fechaInicio') }}">
                            </div>
                            <div class=" col-12 col-sm-6 mb-3 ">
                                <label class="labelTitulo">Fecha Fin:</label></br>
                                <input type="date" class="inputCaja" id="fechaFin" name="fechaFin"
                                    value="{{ old('fechaFin') }}">
                            </div>
                            <div class=" col-12  mb-3 ">
                                <label class="labelTitulo">Comentarios:</label></br>
                                <textarea class="form-control" placeholder="Escribe tu comentario aquí" id="floatingTextarea" name="comentario" spellcheck="true"></textarea>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn botonGral">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <!-- Modal Editar  Tarea-->
        <div class="modal fade" id="editarTarea" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bacTituloPrincipal">
                        <img src="img/calendario/tareagris.svg" class="imgBTNcalendario">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">&nbsp <label id="tareaLblTitulo"></label>
                        </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="row d-flex" action="{{ route('tareas.update') }}" method="post">
                            @csrf
                            @method('put')
                            <input type="hidden" name="tareaId" id="tareaId" value="">
                            <div class=" col-12 col-sm-6 mb-3 ">
                                <label class="labelTitulo">Título:</label></br>
                                <input type="text" class="inputCaja" id="tareaTitulo" name="tareaTitulo"
                                    value="">
                            </div>
                            <div class=" col-12 col-sm-6 mb-3 ">
                                <label class="labelTitulo">Responsable:</label></br>
                                <select class="form-select form-select-lg mb-3 inputCaja" name="tareaResponsableId"
                                    id="tareaResponsableId" aria-label=".form-select-lg example">
                                    <option value="">Seleccione</option>
                                    @foreach ($personal as $item)
                                        <option value="{{ $item->id }}">
                                            {{ $item->nombres . ' ' . $item->apellidoP }}
                                        </option>
                                    @endforeach
                                </select>

                            </div>
                            <div class=" col-12 mb-3 ">
                                <h4 class="labelTitulo mb-2">Prioridad:</h4>
                                <div class="row ">
                                    <div class=" col-6  col-lg-3 d-flex mb-3">
                                        <input class="" type="radio" name="tareaPrioridadId" value="1"
                                            id="tareaPrioridadId1">
                                        <div class=" ms-3">
                                            <label class="form-check-label labelUrgente" for="tareaPrioridadId1"> Urgente
                                            </label>
                                        </div>
                                    </div>
                                    <div class=" col-6 col-lg-3 d-flex mb-3">
                                        <input class="" type="radio" name="tareaPrioridadId" value="2"
                                            id="tareaPrioridadId2">
                                        <div class=" ms-3">
                                            <label class="form-check-label labelNecesaria" for="tareaPrioridadId2">
                                                Necesaria
                                            </label>
                                        </div>
                                    </div>
                                    <div class=" col-6  col-lg-3  d-flex mb-3">
                                        <input class="" type="radio" name="tareaPrioridadId" value="3"
                                            id="tareaPrioridadId3">
                                        <div class=" ms-3">
                                            <label class="form-check-label labelDeseable" for="tareaPrioridadId3">
                                                Deseable
                                            </label>
                                        </div>
                                    </div>
                                    <div class=" col-6  col-lg-3  d-flex mb-3">
                                        <input class="" type="radio" name="tareaPrioridadId" value="4"
                                            id="tareaPrioridadId4">
                                        <div class=" ms-3">
                                            <label class="form-check-label labelProrrogable" for="tareaPrioridadId4">
                                                Prorrogable </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <h4 class="labelTitulo mb-2">Estado de la Solicitud</h4>
                                <div class=" col-6  col-lg-3   d-flex mb-3">
                                    <input class="" type="radio" name="tareaEstadoId" id="tareaEstadoId1" value="1">
                                    <div class=" ms-3">
                                        <label class="form-check-label labelEspera" for="tareaEstadoId1"> En Espera
                                        </label>
                                    </div>
                                </div>

                                <div class=" col-6  col-lg-3 d-flex mb-3">
                                    <input class="" type="radio" name="tareaEstadoId" id="tareaEstadoId2" value="2">
                                    <div class=" ms-3">
                                        <label class="form-check-label labelRealizado" for="tareaEstadoId2"> Realizado
                                        </label>
                                    </div>
                                </div>
                                <div class=" col-6  col-lg-3   d-flex mb-3">
                                    <input class="" type="radio" name="tareaEstadoId" id="tareaEstadoId3" value="3">
                                    <div class=" ms-3">
                                        <label class="form-check-label labelTerminado" for="tareaEstadoId3"> Terminado
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class=" col-12 col-sm-6 mb-3 ">
                                <label class="labelTitulo">Fecha Inicio:</label></br>
                                <input type="datetime" class="inputCaja" id="tareaFechaInicio" name="tareaFechaInicio" value="" required pattern="\d{2}/\d{2}/\d{4}" placeholder="dd/mm/yyyy" />
                            </div>
                            <div class=" col-12 col-sm-6 mb-3 ">
                                <label class="labelTitulo">Fecha Fin:</label></br>
                                <input type="datetime" class="inputCaja" id="tareaFechaFin" name="tareaFechaFin" value="" required pattern="\d{2}/\d{2}/\d{4}" placeholder="dd/mm/yyyy"/>
                            </div>
                            <div class=" col-12  mb-3 ">
                                <label class="labelTitulo">Comentarios:</label></br>
                                <textarea class="form-control" placeholder="Escribe tu comentario aquí" id="tareaComentario" id="tareaComentario"
                                    name="tareaComentario"></textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn botonGral" id="btnTareaGuardar">Guardar cambios</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Solicitudes-->
        <div class="modal fade" id="solicitudModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-lg">
                <div class="modal-content">
                    <div class="modal-header bacTituloPrincipal">
                        <img src="img/calendario/solicitudgris.svg" class="imgBTNcalendario">
                        <h1 class="modal-title fs-5" id="exampleModalLabel"> &nbsp Nueva Solicitud</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="row d-flex justify-content-center" action="{{ route('solicitudes.store') }}" method="post">
                                @csrf

                        <input type="hidden" name="fechaSolicitud" id="fechaSolicitud" value="{{ date('Y-m-d') }}">
                        <input type="hidden" name="userId" id="userId" value="{{  auth()->user()->id }}">

                            <div class=" col-12 mb-3 ">
                                <label class="labelTitulo">Título:</label></br>
                                <input type="text" class="inputCaja" id="titulo" name="titulo"
                                    value="{{ old('titulo') }}">
                            </div>
                            <div class=" col-12 col-sm-6 mb-3 ">
                                <label class="labelTitulo">Responsable:</label></br>
                                <select class="form-select form-select-lg mb-3 inputCaja" name="responsable" id="responsable"
                                    aria-label=".form-select-lg example">
                                    <option value="">Seleccione</option>
                                    @foreach ($personal as $item)
                                        <option value="{{ $item->id }}">
                                            {{ $item->nombres . ' ' . $item->apellidoP }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class=" col-12 col-sm-6 mb-3 ">
                                <label class="labelTitulo">Fecha Requerimiento:</label></br>
                                <input type="date" class="inputCaja" id="fechaRequerimiento" name="fechaRequerimiento"
                                    value="{{ old('fechaRequerimiento') }}">
                            </div>

                            <div class=" col-12 mb-3 ">
                                <label class="labelTitulo">Maquinaría:</label></br>
                                <select class="form-select form-select-lg mb-3 inputCaja"  id="maquinariaId" name="maquinariaId"
                                    aria-label=".form-select-lg example">
                                    <option value="">Seleccione</option>
                                    @foreach ($maquinaria as $item)
                                        <option value="{{ $item->id }}">
                                            {{ $item->identificador . ' ' . $item->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- carrousel de solicitudes-->
                            <div class=" col-10  pb-5 my-4">
                                <div id="carouselExampleIndicators" class="carousel slide">
                                    <div class="carousel-inner">
                                        <!-- reparación-->
                                        <div class="carousel-item active border">
                                            <div class="tituloCarrouselReparacion py-2">
                                                <h4 class="text-center"> REPARACIÓN</h4>
                                            </div>

                                            <div class="col-10 my-4 mx-auto">
                                                <select class="form-select form-select-lg mb-3 inputCaja"  id="servicioId" name="servicioId"
                                                    aria-label=".form-select-lg example">
                                                    <option value="">Seleccione</option>
                                                    @foreach ($vctProcesos as $item)
                                                        <option value="{{ $item->id }}">
                                                            {{ $item->codigo . ' ' . $item->nombre }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-10 my-4 mx-auto">
                                                <label class="labelTitulo">Funcionalidad:</label></br>
                                                <select class="form-select form-select-lg mb-3 inputCaja" id="funcionalidadId" name="funcionalidadId"
                                                    aria-label=".form-select-lg example">
                                                    <option value="1">Atención Inmediata</option>
                                                    <option value="2">Atención Media</option>
                                                    <option value="3">Atención Baja</option>
                                                </select>
                                            </div>

                                            <div class="col-5 mb-4 mt-5 mx-auto">
                                                <span class="mi-archivo"> <input class="mb-4 ver" type="file"
                                                        name="foto" id="mi-archivo" accept="image/*"></span>
                                                <label for="mi-archivo">
                                                    <span>sube imagen</span>
                                                </label>
                                            </div>


                                        </div>

                                        <!-- herramienta-->
                                        <div class="carousel-item border">
                                            <div class="tituloCarrouselReparacion py-2">
                                                <h4 class="text-center"> HERRAMIENTA</h4>
                                            </div>

                                            <div class="col-10 my-4 mx-auto">
                                                <select class="form-select form-select-lg mb-3 inputCaja"  id="herramientaId" name="herramientaId"
                                                    aria-label=".form-select-lg example">
                                                    <option value="">Seleccione</option>
                                                    @foreach ($vctHerramientas as $item)
                                                        <option value="{{ $item->id }}">
                                                            {{ $item->nombre . ' ['. $item->cantidad . ']'  }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-10 my-4 mb-5 mx-auto">
                                                <label class="labelTitulo">Cantidad:</label></br>
                                                <input type="number" maxlength="4" step="1" min="0" max="9999" placeholder="ej. 1" class="inputCaja text-right" id="herramientaCantidad" name="herramientaCantidad"
                                                    value="">
                                            </div>
                                        </div>

                                        <!-- refacción-->
                                        <div class="carousel-item border">
                                            <div class="tituloCarrouselReparacion py-2">
                                                <h4 class="text-center"> REFACCIÓN</h4>
                                            </div>

                                            <div class="col-10 my-4 mx-auto">
                                                <select class="form-select form-select-lg mb-3 inputCaja"  id="refaccionId" name="refaccionId"
                                                    aria-label=".form-select-lg example">
                                                    <option value="">Seleccione</option>
                                                    @foreach ($vctRefacciones as $item)
                                                        <option value="{{ $item->id }}">
                                                            {{ $item->nombre . ' ['. $item->cantidad . ']'  }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-10 my-4 mb-5 mx-auto">
                                                <label class="labelTitulo">Cantidad:</label></br>
                                                <input type="number" maxlength="4" step="1" min="0" max="9999" placeholder="ej. 1" class="inputCaja text-right" id="refaccionCantidad" name="refaccionCantidad"
                                                    value="">
                                            </div>
                                        </div>

                                        <!-- consumible-->
                                        <div class="carousel-item border">
                                            <div class="tituloCarrouselReparacion py-2">
                                                <h4 class="text-center"> CONSUMIBLE</h4>
                                            </div>

                                            <div class="col-10 my-4 mx-auto">
                                                <select class="form-select form-select-lg mb-3 inputCaja"  id="consumibleId" name="consumibleId"
                                                    aria-label=".form-select-lg example">
                                                    <option value="">Seleccione</option>
                                                    @foreach ($vctConsumibles as $item)
                                                        <option value="{{ $item->id }}">
                                                            {{ $item->nombre . ' ['. $item->cantidad . ']'  }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-10 my-4 mb-5 mx-auto">
                                                <label class="labelTitulo">Cantidad:</label></br>
                                                <input type="number" maxlength="4" step="1" min="0" max="9999" placeholder="ej. 1" class="inputCaja text-right" id="consumibleCantidad" name="consumibleCantidad"
                                                    value="">
                                            </div>
                                        </div>

                                        <!-- combustible-->
                                        <div class="carousel-item border">
                                            <div class="tituloCarrouselReparacion py-2">
                                                <h4 class="text-center"> COMBUSTIBLE</h4>
                                            </div>

                                            <div class="col-10 my-4 mx-auto">
                                                <select class="form-select form-select-lg mb-3 inputCaja" id="combustibleId" name="combustibleId"
                                                    aria-label=".form-select-lg example">
                                                    <option value="">Seleccione</option>
                                                    @foreach ($vctCombustibles as $item)
                                                    <option value="{{ $item->id }}">
                                                        {{ $item->nombre   }}
                                                    </option>
                                                @endforeach
                                                </select>
                                            </div>
                                            <div class="col-10 my-4 mb-5 mx-auto">
                                                <label class="labelTitulo">Litros:</label></br>
                                                <input type="number" maxlength="4" step="1" min="0" max="9999" placeholder="ej. 100" class="inputCaja text-right" id="combustibleCantidad" name="combustibleCantidad"
                                                    value="">
                                            </div>
                                        </div>
                                        <button class="carousel-control-prev carouselBoton" type="button"
                                            data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Previous</span>
                                        </button>
                                        <button class="carousel-control-next carouselBoton" type="button"
                                            data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden controlCarouselNext">Next</span>
                                        </button>

                                    </div>

                                </div>

                            </div>


                            <div class=" col-12 my-3 py-2 fondoVerde">
                                <div class="row">
                                    <h4 class="labelTitulomb-3">Prioridad</h4>
                                    <div class=" col-3   d-flex mb-2">
                                        <input class="" type="radio" name="prioridadId" id="prioridadId1"  value="1">
                                        <div class=" ms-3">
                                            <label class="form-check-label labelUrgente" for="prioridadId1"> Urgente
                                            </label>
                                        </div>
                                    </div>

                                    <div class=" col-3 d-flex mb-2">
                                        <input class="" type="radio" name="prioridadId" id="prioridadId2"  value="2">
                                        <div class=" ms-3">
                                            <label class="form-check-label labelNecesaria" for="prioridadId2">
                                                Necesaria
                                            </label>
                                        </div>
                                    </div>
                                    <div class=" col-3   d-flex mb-2">
                                        <input class="" type="radio" name="prioridadId" id="prioridadId3" value="3">
                                        <div class=" ms-3">
                                            <label class="form-check-label labelDeseable" for="prioridadId3">
                                                Deseable
                                            </label>
                                        </div>
                                    </div>
                                    <div class=" col-3   d-flex mb-2">
                                        <input class="" type="radio" name="prioridadId" id="prioridadId4" value="4">
                                        <div class=" ms-3">
                                            <label class="form-check-label labelProrrogable" for="prioridadId4">
                                                Prorrogable </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class=" col-12 my-3 py-2 fondoVerde">
                                <div class="row">
                                    <h4 class="labelTitulo mt-4 mb-3">Estado</h4>
                                    <div class=" col-4   d-flex mb-2">
                                        <input class="" type="radio" name="estadoId" id="estadoId1"  value="1">
                                        <div class=" ms-3">
                                            <label class="form-check-label labelEspera" for="estadoId1"> En Espera
                                            </label>
                                        </div>
                                    </div>

                                    <div class=" col-4 d-flex mb-2">
                                        <input class="" type="radio" name="estadoId" id="estadoId2"  value="2">
                                        <div class=" ms-3">
                                            <label class="form-check-label labelRealizado" for="estadoId2">
                                                Realizado
                                            </label>
                                        </div>
                                    </div>
                                    <div class=" col-4   d-flex mb-2">
                                        <input class="" type="radio" name="estadoId" id="estadoId3"  value="3">
                                        <div class=" ms-3">
                                            <label class="form-check-label labelTerminado" for="estadoId3">
                                                Terminado
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class=" col-12 my-3 py-2 fondoVerde">
                                <div class="row">
                                    <h4 class="labelTitulo mb-2">Funcionalidad del Equipo</h4>
                                    <div class=" col-4    d-flex mb-4">
                                        <input class="" type="radio" name="funcionalidad" id="funcionalidad1"  value="1">
                                        <div class=" ms-3">
                                            <label class="form-check-label labelUrgente" for="funcionalidad1"> No Funciona
                                            </label>
                                        </div>
                                    </div>

                                    <div class=" col-4   d-flex mb-4">
                                        <input class="" type="radio" name="funcionalidad" id="funcionalidad2" value="2">
                                        <div class=" ms-3">
                                            <label class="form-check-label labelDeseable" for="funcionalidad2"> Funciona Poco
                                            </label>
                                        </div>
                                    </div>
                                    <div class=" col-4    d-flex mb-4">
                                        <input class="" type="radio" name="funcionalidad" id="funcionalidad3" value="3">
                                        <div class=" ms-3">
                                            <label class="form-check-label labelProrrogable" for="funcionalidad3"> Funciona
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class=" col-12  mb-3 ">
                                    <label class="labelTitulo">Comentarios:</label></br>
                                    <textarea class="form-control" placeholder="Escribe tu comentario aquí" id="comentario" name="comentario" spellcheck="true"></textarea>
                                </div>
                            </div>

                        </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn botonGral">Guardar</button>
                            </div>


                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Editar Solicitud-->
        <div class="modal fade" id="editarSolicitud" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-lg">
                <div class="modal-content">
                    <div class="modal-header bacTituloPrincipal">
                        <img src="img/calendario/tareagris.svg" class="imgBTNcalendario">
                        <h1 class="modal-title fs-5" id="exampleModalLabel"> Desarmador de Cruz </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="row d-flex">

                            <div class=" col-12  mb-2">
                                <label class="labelTitulo">Nombre de la Solicitud:</label></br>
                                <input type="text" class="inputCaja" id="apellidoP" name="" value="">
                            </div>
                            <div class=" col-12 col-sm-6 mb-3 ">
                                <label class="labelTitulo">Responsable:</label></br>
                                <select class="form-select form-select-lg mb-3 inputCaja"
                                    aria-label=".form-select-lg example">
                                    <option value="1">Responsable 1</option>
                                    <option value="2">Responsable 2</option>
                                    <option value="3">Responsable 3</option>
                                </select>

                            </div>

                            <div class=" col-12 col-sm-6 mb-3 ">
                                <label class="labelTitulo">Fecha Requerimiento:</label></br>
                                <input type="date" class="inputCaja" id="apellidoP" name="" value="">
                            </div>
                            <div class=" col-12 col-sm-6 mb-3 ">
                                <label class="labelTitulo">Herramienta:</label></br>
                                <select class="form-select form-select-lg mb-3 inputCaja"
                                    aria-label=".form-select-lg example">
                                    <option value="1">Responsable 1</option>
                                    <option value="2">Responsable 2</option>
                                    <option value="3">Responsable 3</option>
                                </select>
                            </div>
                            <div class=" col-12 col-sm-6 mb-3 ">
                                <label class="labelTitulo">Refacción</label></br>
                                <select class="form-select form-select-lg mb-3 inputCaja"
                                    aria-label=".form-select-lg example">
                                    <option value="1">Refacción</option>
                                    <option value="2">Refacción</option>
                                    <option value="3">Refacción</option>
                                    <option value="3">Refacción</option>
                                </select>
                            </div>
                            <div class=" col-12 col-sm-6 mb-3 ">
                                <label class="labelTitulo">Consumible:</label></br>
                                <select class="form-select form-select-lg mb-3 inputCaja"
                                    aria-label=".form-select-lg example">
                                    <option value="1">Consumible</option>
                                    <option value="2">Consumible</option>
                                    <option value="3">Consumible</option>
                                </select>
                            </div>
                            <div class=" col-12 col-sm-6 mb-3 ">
                                <label class="labelTitulo">cantidad:</label></br>
                                <input type="text" class="inputCaja" id="apellidoP" name="" value="">
                            </div>
                            <div class=" col-12 col-sm-6 mb-3 ">
                                <label class="labelTitulo">Combustible:</label></br>
                                <select class="form-select form-select-lg mb-3 inputCaja"
                                    aria-label=".form-select-lg example">
                                    <option value="1">Diesel</option>
                                    <option value="2">Gasolina</option>

                                </select>
                            </div>
                            <div class=" col-12 col-sm-6 mb-3 ">
                                <label class="labelTitulo">Litros:</label></br>
                                <input type="text" class="inputCaja" id="apellidoP" name="" value="">
                            </div>

                            <div class="row ">
                                <h4 class="labelTitulo mb-2">Prioridad de la solicitud:</h4>
                                <div class=" col-6  col-lg-3 d-flex mb-3">
                                    <input class="" type="radio" name="prioridad" id="prioridad">
                                    <div class=" ms-3">
                                        <label class="form-check-label labelUrgente" for="prioridad"> Urgente </label>
                                    </div>
                                </div>

                                <div class=" col-6 col-lg-3 d-flex mb-3">
                                    <input class="" type="radio" name="prioridad" id="prioridad">
                                    <div class=" ms-3">
                                        <label class="form-check-label labelNecesaria" for="prioridad"> Necesaria </label>
                                    </div>
                                </div>
                                <div class=" col-6  col-lg-3  d-flex mb-3">
                                    <input class="" type="radio" name="prioridad" id="prioridad">
                                    <div class=" ms-3">
                                        <label class="form-check-label labelDeseable" for="prioridad"> Deseable </label>
                                    </div>
                                </div>
                                <div class=" col-6  col-lg-3  d-flex mb-3">
                                    <input class="" type="radio" name="prioridad" id="prioridad">
                                    <div class=" ms-3">
                                        <label class="form-check-label labelProrrogable" for="prioridad"> Prorrogable
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <h4 class="labelTitulo mb-2">Estado de la Solicitud</h4>
                                <div class=" col-6  col-lg-3   d-flex mb-3">
                                    <input class="" type="radio" name="estado" id="estado">
                                    <div class=" ms-3">
                                        <label class="form-check-label labelEspera" for="estado"> En Espera </label>
                                    </div>
                                </div>

                                <div class=" col-6  col-lg-3 d-flex mb-3">
                                    <input class="" type="radio" name="estado" id="estado">
                                    <div class=" ms-3">
                                        <label class="form-check-label labelRealizado" for="estado"> Realizado
                                        </label>
                                    </div>
                                </div>
                                <div class=" col-6  col-lg-3   d-flex mb-3">
                                    <input class="" type="radio" name="estado" id="estado">
                                    <div class=" ms-3">
                                        <label class="form-check-label labelTerminado" for="estado"> Terminado
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <h4 class="labelTitulo mb-2">Funcionalidad del Equipo</h4>
                                <div class=" col-6  col-lg-3   d-flex mb-3">
                                    <input class="" type="radio" name="estado" id="estado">
                                    <div class=" ms-3">
                                        <label class="form-check-label labelUrgente" for="estado"> No Funciona
                                        </label>
                                    </div>
                                </div>

                                <div class=" col-6  col-lg-3 d-flex mb-3">
                                    <input class="" type="radio" name="estado" id="estado">
                                    <div class=" ms-3">
                                        <label class="form-check-label labelDeseable" for="estado"> Funciona Poco
                                        </label>
                                    </div>
                                </div>
                                <div class=" col-6  col-lg-3   d-flex mb-3">
                                    <input class="" type="radio" name="estado" id="estado">
                                    <div class=" ms-3">
                                        <label class="form-check-label labelProrrogable" for="estado"> Funciona
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class=" col-12 col-lg-6 mb-3 ">
                                <label class="labelTitulo">Comentarios:</label></br>
                                <textarea class="form-control" placeholder="Escribe tu comentario aquí" id="floatingTextarea"></textarea>
                            </div>
                            <div class=" col-12 col-lg-6  mb-3 ">
                                <label class="labelTitulo">Comentarios Anteriores:</label></br>
                                <textarea class="form-control" placeholder="Escribe tu comentario aquí" id="floatingTextarea"></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn botonGral">Save changes</button>
                    </div>
                </div>
            </div>
        </div>


        <!-- Modal Nuevo Mantenimiento -->
        <div class="modal fade" id="mantenimientoModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bacTituloPrincipal">
                        <img src="img/calendario/mantenimientogris.svg" class="imgBTNcalendario">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">&nbsp Nuevo Mantenimiento</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="row d-flex" action="{{ route('mantenimientos.store') }}" method="post">
                        @csrf

                        <input type="hidden" name="fechaInicio" id="fechaInicio" value="{{ date('Y-m-d') }}">
                        <input type="hidden" name="personalId" id="personalId" value="{{  auth()->user()->id }}">

                            <div class="col-12 mb-5 pb-5">
                                <div class="searchBox mb-5">
                                    <input class="searchInput "type="text" name="" placeholder="Buscar">
                                    <button class="searchButton" href="#">
                                        <i class="material-icons">
                                            search
                                        </i>
                                    </button>
                                </div>

                            </div>
                            <div class=" col-12 mb-2">
                                <label class="labelTitulo">Título:</label></br>
                                <input type="text" class="inputCaja" id="titulo" name="titulo"
                                    value="">
                            </div>

                            <div class=" col-12 mb-3 ">
                                <label class="labelTitulo">Maquinaría:</label></br>
                                <select class="form-select form-select-lg mb-3 inputCaja"  id="maquinariaId" name="maquinariaId"
                                    aria-label=".form-select-lg example">
                                    <option value="">Seleccione</option>
                                    @foreach ($maquinaria as $item)
                                        <option value="{{ $item->id }}">
                                            {{ $item->identificador . ' ' . $item->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class=" col-12 col-sm-6 mb-3 ">
                                <div class="row mb-4">
                                    <h4 class="labelTitulo mb-2">Estado de la Solicitud</h4>
                                    <div class=" col-6    d-flex mb-3">
                                        <input class="" type="radio" name="estadoId" id="estadoId1" value="1">
                                        <div class=" ms-3">
                                            <label class="form-check-label labelEspera" for="estadoId1"> En Espera
                                            </label>
                                        </div>
                                    </div>

                                    <div class=" col-6  d-flex mb-3">
                                        <input class="" type="radio" name="estadoId" id="estadoId2" value="2">
                                        <div class=" ms-3">
                                            <label class="form-check-label labelRealizado" for="estadoId2"> Realizado
                                            </label>
                                        </div>
                                    </div>
                                    <div class=" col-6    d-flex mb-3">
                                        <input class="" type="radio" name="estadoId" id="estadoId3" value="3">
                                        <div class=" ms-3">
                                            <label class="form-check-label labelTerminado" for="estadoId3"> Terminado
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class=" col-12 col-sm-6 mb-3 ">
                                <label class="labelTitulo">Tipo:</label></br>
                                <select class="form-select form-select-lg mb-3 inputCaja" name="tipo" id="tipo"
                                    aria-label=".form-select-lg example">
                                    <option value="">Seleccione</option>
                                    <option value="Correctivo">Correctivo</option>
                                    <option value="250">250</option>
                                    <option value="500">500</option>
                                    <option value="1000">1000</option>
                                </select>
                            </div>

                            <div class=" col-12  mb-3 ">
                                <label class="labelTitulo">Comentarios:</label></br>
                                <textarea class="form-control" placeholder="Escribe tu comentario aquí" id="floatingTextarea" id="comentario" name="comentario" spellcheck="true"></textarea>
                            </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn botonGral">Guardar</button>
                    </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!--Modal Editar Mantenimiento-->

        <div class="modal fade" id="editarMantenimiento" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bacTituloPrincipal">
                        <img src="img/calendario/mantenimientogris.svg" class="imgBTNcalendario">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">&nbsp <label id="manttoLblTitulo"></label></h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="row d-flex" action="{{ route('mantenimientos.update',1) }}" method="post">
                            @csrf
                            @method('put')
                            <input type="hidden" name="manttoId" id="manttoId" value="">
                            <div class="col-12 mb-5 pb-5">
                                <div class="searchBox mb-5">
                                    <input class="searchInput "type="text" name="" placeholder="Buscar">
                                    <button class="searchButton" href="#">
                                        <i class="material-icons">
                                            search
                                        </i>
                                    </button>
                                </div>

                            </div>
                            <div class=" col-12  mb-2">
                                <label class="labelTitulo">Título:</label></br>
                                <input type="text" class="inputCaja" id="manttoTitulo" name="manttoTitulo"
                                    value="">
                            </div>
                            <div class=" col-12 col-sm-6 mb-3 ">
                                <div class="row mb-4">
                                    <h4 class="labelTitulo mb-2">Estado de la Solicitud</h4>
                                    <div class=" col-6    d-flex mb-3">
                                        <input class="" type="radio" name="manttoEstadoId" id="manttoEstadoId1" value="1">
                                        <div class=" ms-3">
                                            <label class="form-check-label labelEspera" for="manttoEstadoId1"> En Espera
                                            </label>
                                        </div>
                                    </div>

                                    <div class=" col-6   d-flex mb-3">
                                        <input class="" type="radio" name="manttoEstadoId" id="manttoEstadoId2" value="2">
                                        <div class=" ms-3">
                                            <label class="form-check-label labelRealizado" for="manttoEstadoId2"> Realizado
                                            </label>
                                        </div>
                                    </div>
                                    <div class=" col-6    d-flex mb-3">
                                        <input class="" type="radio" name="manttoEstadoId" id="manttoEstadoId3" value="3">
                                        <div class=" ms-3">
                                            <label class="form-check-label labelTerminado" for="manttoEstadoId3"> Terminado
                                            </label>
                                        </div>
                                    </div>
                                </div>


                            </div>

                            <div class=" col-12 col-sm-6 mb-3 ">
                                <label class="labelTitulo">Tipo:</label></br>
                                <select class="form-select form-select-lg mb-3 inputCaja" name="manttoTipoId"  id="manttoTipoId"
                                    aria-label=".form-select-lg example">

                                    <option value="">Seleccione</option>
                                    <option value="Correctivo">Correctivo</option>
                                    <option value="250">250</option>
                                    <option value="500">500</option>
                                    <option value="1000">1000</option>
                                </select>
                            </div>

                            <div class=" col-12  mb-3 ">
                                <label class="labelTitulo">Comentarios:</label></br>
                                <textarea class="form-control" placeholder="Escribe tu comentario aquí" name="manttoComentario"  id="manttoComentario"></textarea>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <button type="submit" id="btnManttoGuardar" class="btn botonGral">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <!-- Modal Alta de Procesos -->
        <div class="modal fade" id="procesosModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bacTituloPrincipal">
                        <img src="img/calendario/procesos.svg" class="imgBTNcalendario">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">&nbsp Alta de Procesos</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                            <form class="row d-flex" action="{{ route('reparaciones.store') }}" method="post">
                                @csrf

                            <div class=" col-12 col-sm-6 mb-2">
                                <label class="labelTitulo">Título:</label></br>
                                <input type="text" class="inputCaja" id="nombre" name="nombre" maxlength="200"
                                    value="">
                            </div>

                            <div class=" col-12 col-sm-6 mb-3 ">
                                <label class="labelTitulo">Código:</label></br>
                                <input type="text" class="inputCaja" id="codigo" name="codigo" maxlength="8"
                                    value="{{ old('apellidoP') }}">
                            </div>

                            <div class=" col-12 col-lg-12 mb-3 ">
                                <label class="labelTitulo">Comentarios:</label></br>
                                <textarea class="form-control" placeholder="Escribe tu comentario aquí" name="comentario" id="comentario" spellcheck="true"></textarea>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn botonGral">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Editar Reparación-->
        <div class="modal fade" id="editarReparacion" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bacTituloPrincipal">
                        <img src="img/calendario/tareagris.svg" class="imgBTNcalendario">
                        <h1 class="modal-title fs-5" id="exampleModalLabel"> Reparación de Motor </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="row d-flex">
                            <div class=" col-12 mb-3 ">

                                <div class="row">

                                    <div class=" col-12 col-sm-5 mb-3 ">
                                        <div class="text-center mx-auto border  mb-4">
                                            <i><img
                                                    class="img-fluid imgPersonal mb-2"src="{{ asset('/img/general/avatar.jpg') }}"></i>
                                            <span class="mi-archivo">
                                                <input class="mb-4 ver" type="file" name="foto"
                                                    id="mi-archivo" accept="image/*">
                                            </span>
                                            <label for="mi-archivo">
                                                <span>sube imagen</span>
                                            </label>
                                        </div>
                                    </div>

                                    <div class=" col-12 col-sm-7 mb-3 ">

                                        <div>
                                            <label class="labelTitulo">Título:</label></br>
                                            <input type="text" class="inputCaja" id="apellidoP" name="apellidoP"
                                                value="{{ old('apellidoP') }}">
                                        </div>
                                        <div>
                                            <label class="labelTitulo">Responsable:</label></br>
                                            <select class="form-select form-select-lg mb-3 inputCaja"
                                                aria-label=".form-select-lg example">
                                                <option value="1">Responsable 1</option>
                                                <option value="2">Responsable 2</option>
                                                <option value="3">Responsable 3</option>
                                            </select>

                                        </div>
                                        <div>
                                            <label class="labelTitulo">Fecha Inicio:</label></br>
                                            <input type="date" class="inputCaja" id="apellidoP" name="apellidoP"
                                                value="{{ old('apellidoP') }}">
                                        </div>
                                        <div>
                                            <label class="labelTitulo">Fecha Fin:</label></br>
                                            <input type="date" class="inputCaja" id="apellidoP" name="apellidoP"
                                                value="{{ old('apellidoP') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <div class=" col-12 mb-3 ">
                                <div class="row">
                                    <h4 class="labelTitulo mb-2">Funcionalidad del Equipo</h4>
                                    <div class=" col-6  col-lg-3   d-flex mb-3">
                                        <input class="" type="radio" name="estado" id="estado">
                                        <div class=" ms-3">
                                            <label class="form-check-label labelUrgente" for="estado"> No Funciona
                                            </label>
                                        </div>
                                    </div>

                                    <div class=" col-6  col-lg-3 d-flex mb-3">
                                        <input class="" type="radio" name="estado" id="estado">
                                        <div class=" ms-3">
                                            <label class="form-check-label labelDeseable" for="estado"> Funciona Poco
                                            </label>
                                        </div>
                                    </div>
                                    <div class=" col-6  col-lg-3   d-flex mb-3">
                                        <input class="" type="radio" name="estado" id="estado">
                                        <div class=" ms-3">
                                            <label class="form-check-label labelProrrogable" for="estado"> Funciona
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row ">
                                    <h4 class="labelTitulo mb-2">Prioridad de la solicitud:</h4>
                                    <div class=" col-6  col-lg-3 d-flex mb-3">
                                        <input class="" type="radio" name="prioridad" id="prioridad">
                                        <div class=" ms-3">
                                            <label class="form-check-label labelUrgente" for="prioridad"> Urgente
                                            </label>
                                        </div>
                                    </div>

                                    <div class=" col-6 col-lg-3 d-flex mb-3">
                                        <input class="" type="radio" name="prioridad" id="prioridad">
                                        <div class=" ms-3">
                                            <label class="form-check-label labelNecesaria" for="prioridad"> Necesaria
                                            </label>
                                        </div>
                                    </div>
                                    <div class=" col-6  col-lg-3  d-flex mb-3">
                                        <input class="" type="radio" name="prioridad" id="prioridad">
                                        <div class=" ms-3">
                                            <label class="form-check-label labelDeseable" for="prioridad"> Deseable
                                            </label>
                                        </div>
                                    </div>
                                    <div class=" col-6  col-lg-3  d-flex mb-3">
                                        <input class="" type="radio" name="prioridad" id="prioridad">
                                        <div class=" ms-3">
                                            <label class="form-check-label labelProrrogable" for="prioridad">
                                                Prorrogable
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <h4 class="labelTitulo mb-2">Estado de la Solicitud</h4>
                                    <div class=" col-6  col-lg-3   d-flex mb-3">
                                        <input class="" type="radio" name="estado" id="estado">
                                        <div class=" ms-3">
                                            <label class="form-check-label labelEspera" for="estado"> En Espera
                                            </label>
                                        </div>
                                    </div>

                                    <div class=" col-6  col-lg-3 d-flex mb-3">
                                        <input class="" type="radio" name="estado" id="estado">
                                        <div class=" ms-3">
                                            <label class="form-check-label labelRealizado" for="estado"> Realizado
                                            </label>
                                        </div>
                                    </div>
                                    <div class=" col-6  col-lg-3   d-flex mb-3">
                                        <input class="" type="radio" name="estado" id="estado">
                                        <div class=" ms-3">
                                            <label class="form-check-label labelTerminado" for="estado"> Terminado
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class=" col-12 col-lg-6 mb-3 ">
                                <label class="labelTitulo">Comentarios:</label></br>
                                <textarea class="form-control" placeholder="Escribe tu comentario aquí" id="floatingTextarea"></textarea>
                            </div>
                            <div class=" col-12 col-lg-6  mb-3 ">
                                <label class="labelTitulo">Comentarios Anteriores:</label></br>
                                <textarea class="form-control" placeholder="Escribe tu comentario aquí" id="floatingTextarea"></textarea>
                            </div>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn botonGral">Save changes</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Ver Evento -->
        <div class="modal fade" id="verEvento" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bacTituloPrincipal">
                        <img src="img/calendario/tareagris.svg" class="imgBTNcalendario">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">&nbsp <label id="eventoLblTitulo"></label>
                        </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="row d-flex" action=" " method="post">
                            @csrf
                            @method('put')
                            <input type="hidden" name="eventoId" id="eventoId" value="">
                            <div class=" col-12 col-sm-12 mb-3 ">
                                <label class="labelTitulo">Título:</label></br>
                                <input type="text" class="inputCaja" id="eventoTitulo" name="eventoTitulo" readonly="true"
                                    value="">
                            </div>


                            <div class=" col-12  mb-3 ">
                                <label class="labelTitulo">Comentarios:</label></br>
                                <textarea class="form-control" placeholder="Comentario..." id="eventoComentario" id="eventoComentario" readonly="true"
                                    name="eventoComentario"></textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>

    <div class="modal fade" id="modal-cliente" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-cliente"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="col-12">
                    <div class="card ">
                        <form action="{{ url('asistencia/otrodia/') }}" method="post">

                            <div class="card-header bacTituloPrincipal ">
                                <div class="nav-tabs-navigation">
                                    <div class="nav-tabs-wrapper">
                                        <span class="nav-tabs-title">
                                            <h2 class="titulos">Seleccionar Otro Día</h2>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="row  card-body">
                                <div class="row card-body" style=" text-align: center;">
                                    <input type="hidden" name="productoid" id="productoid" value="">

                                    <div class="col-12 col-lg-6">
                                        <input type="date" class="inputCaja" id="fechaAsistencia"
                                            name="fechaAsistencia"
                                            value=""></br>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12  mb-3 d-flex  justify-content-center align-self-end">
                                <button  class="btn botonGral ">Ir</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

        <!-- Carga tarea en modal -->
        <script>
            function loadTarea(id, titulo, responsableId, prioridadId , estadoId, comentarios, fechaInicio, fechaFin  ) {

                const txtId = document.getElementById('tareaId');
                txtId.value = id;

                const txtTitulo = document.getElementById('tareaTitulo');
                txtTitulo.value = titulo;

                const lblTitulo = document.getElementById('tareaLblTitulo');
                lblTitulo.innerText = titulo;

                const lstTskResponsable = document.getElementById('tareaResponsableId').value = responsableId;
                const lstTskPrioridad = document.getElementById('tareaPrioridadId' + prioridadId).checked = true;
                const lstTskEstado = document.getElementById('tareaEstadoId' + estadoId).checked = true;

                const txtComentario = document.getElementById('tareaComentario');
                txtComentario.innerText = comentarios;

                const dteFechaInicio = document.getElementById('tareaFechaInicio').value = fechaInicio;
                const dteFechaFin = document.getElementById('tareaFechaFin').value = fechaFin;

                if(estadoId==3){
                    txtTitulo.disabled = true;
                    txtComentario.disabled = true;

                    document.getElementById('tareaResponsableId').disabled = true;

                    document.getElementById('tareaPrioridadId1').disabled = true;
                    document.getElementById('tareaPrioridadId2').disabled = true;
                    document.getElementById('tareaPrioridadId3').disabled = true;
                    document.getElementById('tareaPrioridadId4').disabled = true;

                    document.getElementById('tareaEstadoId1').disabled = true;
                    document.getElementById('tareaEstadoId2').disabled = true;
                    document.getElementById('tareaEstadoId3').disabled = true;

                   document.getElementById('tareaFechaInicio').disabled = true;
                   document.getElementById('tareaFechaFin').disabled = true;

                    document.getElementById('btnTareaGuardar').disabled = true;

                }
            }
        </script>
        <!-- Carga evento en modal -->
    <script>
        function loadEvento(id, titulo, comentarios  ) {

            const txtId = document.getElementById('eventoId');
            txtId.value = id;

            const txtTitulo = document.getElementById('eventoTitulo');
            txtTitulo.value = titulo;

            const lblTitulo = document.getElementById('eventoLblTitulo');
            lblTitulo.innerText = titulo;

            const txtComentario = document.getElementById('eventoComentario');
            txtComentario.innerText = comentarios;

        }
    </script>

<script>
    function loadMantenimiento(id, titulo, estadoId, comentarios, tipoId /*, fechaInicio, fechaFin*/  ) {

        const txtId = document.getElementById('manttoId');
        txtId.value = id;

        const txtTitulo = document.getElementById('manttoTitulo');
        txtTitulo.value = titulo;

        const lblTitulo = document.getElementById('manttoLblTitulo');
        lblTitulo.innerText = titulo;

        const lstTipo = document.getElementById('manttoTipoId').value = tipoId;
        const lstTskEstado = document.getElementById('manttoEstadoId' + estadoId).checked = true;

        const txtComentario = document.getElementById('manttoComentario');
        txtComentario.innerText = comentarios;

        // const dteFechaInicio = document.getElementById('tareaFechaInicio').value = fechaInicio;
        // const dteFechaFin = document.getElementById('tareaFechaFin').value = fechaFin;

        if(estadoId==3){
            txtTitulo.disabled = true;
            txtComentario.disabled = true;

            document.getElementById('manttoTipoId').disabled = true;

        //     document.getElementById('tareaPrioridadId1').disabled = true;
        //     document.getElementById('tareaPrioridadId2').disabled = true;
        //     document.getElementById('tareaPrioridadId3').disabled = true;
        //     document.getElementById('tareaPrioridadId4').disabled = true;

            document.getElementById('manttoEstadoId1').disabled = true;
            document.getElementById('manttoEstadoId2').disabled = true;
            document.getElementById('manttoEstadoId3').disabled = true;

        //    document.getElementById('tareaFechaInicio').disabled = true;
        //    document.getElementById('tareaFechaFin').disabled = true;

            document.getElementById('btnManttoGuardar').disabled = true;

        }
    }
</script>

        <script type="application/javascript">
        jQuery('input[type=file]').change(function(){
         var filename = jQuery(this).val().split('\\').pop();
         var idname = jQuery(this).attr('id');
         console.log(jQuery(this));
         console.log(filename);
         console.log(idname);
         jQuery('span.'+idname).next().find('span').html(filename);
        });
        </script>
    @endsection
