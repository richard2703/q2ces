@extends('layouts.main', ['activePage' => 'calendario', 'titlePage' => __('Calendario')])

@section('content')
<div class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">

                <div class="col-md-10 align-self-center">
                    <div class="card">
                        <div class="card-body contCart">
                            <div class="p-1 align-self-start bacTituloPrincipal">     
                                <h2 class="my-3 ms-3 texticonos ">Calendario de Actividades</h2>   
                            </div> 
                            <!-- Esta es la parte para el calendario-->
                            <div class="col-10  mx-auto d-block my-4">   
                                <div class="row d-flex ">
                                    <div class="col-10 col-md-5  mx-auto d-block my-4 ">
                                        <div class="row d-flex border">
                                                <div class="col-4 text-center colIcono p-2">
                                                    <img src="{{ asset('img/equipos/maquinariaPesada.svg') }}" class="mx-auto d-block" width="65%">
                                                </div>
                                                <div class="col-8  p-2">
                                                    <h2 class="text-start fs-5 textTitulo">Maquinaria Pesada</h2>
                                                    <ul>
                                                        <a class="textEquipo" href="{{ url('detalleEquipo', session('id')) }}"><li class="text-start my-3">Retroexcavadora</li></a>
                                                        <a class="textEquipo" href="#"><li class="text-start my-3">Camión de Volteo</li></a>
                                                        <a class="textEquipo" href="#"><li class="text-start my-3">Pipa de Agua</li></a>
                                                        <a class="textEquipo" href="#"><li class="text-start my-3">Camión Orquesta</li></a>
                                                    </ul>
                                                    
                                                </div>
                                        </div>
                                    </div>

                                    
                                </div>
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
                                    <button class="nav-item col-12 col-md-4 BTNbCargaDescarga " 
                                            role="presentation" id="solicitud-tab" data-bs-toggle="tab" 
                                            data-bs-target="#solicitud-tab-pane" type="button" role="tab" 
                                            aria-controls="solicitud-tab-pane" aria-selected="false"> 
                                            Solicitudes
                                    </button>
                                    <button class="nav-item col-12 col-md-4 BTNbCargaDescarga " 
                                            role="presentation" id="profile-tab" data-bs-toggle="tab" 
                                            data-bs-target="#mantenimiento-tab-pane" type="button" role="tab" 
                                            aria-controls="mantenimiento-tab-pane" aria-selected="false"> 
                                            Mantenimientos
                                    </button>
                                </div>
                                
                                <div class="tab-content contentCargas" id="myTabContent">
                                    <!-- Tareas-->
                                    <div class="tab-pane fade show active" id="tareas-tab-pane" role="tabpanel"aria-labelledby="home-tab" tabindex="0">
                                        <div class="row">
                                            
                                            <div class="col-12">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="table-responsive">
                                                            <div class="row border-bottom justify-content-end">
                                                                <div class="col-3 mb-3">

                                                                    <button class="btnSinFondocALENDARIO float-end" data-bs-toggle="modal" data-bs-target="#tareaModal">  
                                                                        <img src="img/calendario/tarea.svg" class="imgBTNcalendario">
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
                                                                    <!--primera línea-->
                                                                    <tr>
                                                                        <td>Lavar Bobcat</td>
                                                                        <td>eIsrael Cruz </td>
                                                                        <td>20/02/2023 </td>
                                                                        <td>23/02/2023 </td>
                                                                        <td class="labelUrgente"> <span >Urgente</span></td>
                                                                        <td class="labelEspera"> <span >En Espera</span></td>
                                                                        <td class="td-actions justify-content-end">
                                                                            <a href="#" class="" data-bs-toggle="modal" data-bs-target="#editarTarea">
                                                                                <svg xmlns="http://www.w3.org/2000/svg " width="28" height="28" fill="currentColor" class="bi bi-pencil accionesIconos" viewBox="0 0 16 16">
                                                                                <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                                                                                </svg>
                                                                            </a>
    
                                                                            <form action="">
                                                                                <button class=" btnSinFondo" type="submit" rel="tooltip">
                                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                                                                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                                                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                                                                                    </svg>
                                                                                </button>
                                                                            </form>
                                                                        </td>
                                                                    </tr>
                                                                    <!--segunda línea-->
                                                                    <tr>
                                                                        <td>Lavar Bobcat</td>
                                                                        <td>eIsrael Cruz </td>
                                                                        <td>20/02/2023 </td>
                                                                        <td>23/02/2023 </td>
                                                                        <td class="labelNecesaria"> <span >Necesaria</span></td>
                                                                        <td class="labelRealizado"> <span >Realizado</span></td>
                                                                        <td class="td-actions justify-content-end">
                                                                            <a href="#" class="" data-bs-toggle="modal" data-bs-target="#editarTarea"
                                                                                onclick="loadCarga ">
                                                                                <svg xmlns="http://www.w3.org/2000/svg " width="28" height="28" fill="currentColor" class="bi bi-pencil accionesIconos" viewBox="0 0 16 16">
                                                                                <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                                                                                </svg>
                                                                            </a>
    
                                                                            <form action="">
                                                                                <button class=" btnSinFondo" type="submit" rel="tooltip">
                                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                                                                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                                                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                                                                                    </svg>
                                                                                </button>
                                                                            </form>
                                                                        </td>
                                                                    </tr>

                                                                    <!--tercera línea-->
                                                                    <tr>
                                                                        <td>Lavar Bobcat</td>
                                                                        <td>eIsrael Cruz </td>
                                                                        <td>20/02/2023 </td>
                                                                        <td>23/02/2023 </td>
                                                                        <td class="labelDeseable"> <span >Deseable</span></td>
                                                                        <td class="labelTerminado"> <span >Terminado</span></td>
                                                                        <td class="td-actions justify-content-end">
                                                                            <a href="#" class="" data-bs-toggle="modal" data-bs-target="#editarTarea"
                                                                                onclick="loadCarga ">
                                                                                <svg xmlns="http://www.w3.org/2000/svg " width="28" height="28" fill="currentColor" class="bi bi-pencil accionesIconos" viewBox="0 0 16 16">
                                                                                <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                                                                                </svg>
                                                                            </a>
    
                                                                            <form action="">
                                                                                <button class=" btnSinFondo" type="submit" rel="tooltip">
                                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                                                                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                                                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                                                                                    </svg>
                                                                                </button>
                                                                            </form>
                                                                        </td>
                                                                    </tr>

                                                                    <!--tercera línea-->
                                                                    <tr>
                                                                        <td>Lavar Bobcat</td>
                                                                        <td>eIsrael Cruz </td>
                                                                        <td>20/02/2023 </td>
                                                                        <td>23/02/2023 </td>
                                                                        <td class="labelDeseable"> <span >Deseable</span></td>
                                                                        <td class="labelTerminado"> <span >Terminado</span></td>
                                                                        <td class="td-actions justify-content-end">
                                                                            <a href="#" class="" data-bs-toggle="modal" data-bs-target="#editarTarea"
                                                                                onclick="loadCarga ">
                                                                                <svg xmlns="http://www.w3.org/2000/svg " width="28" height="28" fill="currentColor" class="bi bi-pencil accionesIconos" viewBox="0 0 16 16">
                                                                                <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                                                                                </svg>
                                                                            </a>
    
                                                                            <form action="">
                                                                                <button class=" btnSinFondo" type="submit" rel="tooltip">
                                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                                                                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                                                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                                                                                    </svg>
                                                                                </button>
                                                                            </form>
                                                                        </td>
                                                                    </tr>
                                                                    <!--cuarta línea-->
                                                                    <tr>
                                                                        <td>Lavar Bobcat</td>
                                                                        <td>eIsrael Cruz </td>
                                                                        <td>20/02/2023 </td>
                                                                        <td>23/02/2023 </td>
                                                                        <td class="labelProrrogable"> <span >Prorrogable</span></td>
                                                                        <td class="labelTerminado"> <span >Terminado</span></td>
                                                                        <td class="td-actions justify-content-end">
                                                                            <a href="#" class="" data-bs-toggle="modal" data-bs-target="#editarTarea"
                                                                                onclick="loadCarga ">
                                                                                <svg xmlns="http://www.w3.org/2000/svg " width="28" height="28" fill="currentColor" class="bi bi-pencil accionesIconos" viewBox="0 0 16 16">
                                                                                <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                                                                                </svg>
                                                                            </a>
    
                                                                            <form action="">
                                                                                <button class=" btnSinFondo" type="submit" rel="tooltip">
                                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                                                                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                                                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                                                                                    </svg>
                                                                                </button>
                                                                            </form>
                                                                        </td>
                                                                    </tr>
                                                                    

                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Solicitudes -->
                                    <div class="tab-pane fade" id="solicitud-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="table-responsive">
                                                            <div class="row border-bottom justify-content-end">
                                                                <div class="col-3 mb-3">
                                                                    <button class="btnSinFondocALENDARIO float-end" data-bs-toggle="modal" data-bs-target="#procesosModal">  
                                                                        <img src="img/calendario/procesosverde.svg" class="imgBTNcalendario">
                                                                        Alta de Procesos
                                                                    </button>
                                                                </div>
                                                                <div class="col-3 mb-3">
                                                                    <button class="btnSinFondocALENDARIO float-end" data-bs-toggle="modal" data-bs-target="#solicitudModal">  
                                                                        <img src="img/calendario/tarea.svg" class="imgBTNcalendario">
                                                                        Nueva Solicitud
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            <table class="table">
                                                                <thead class="labelTitulo">
                                                                    <th class="fw-semibold">Título</th>
                                                                    <th class="fw-semibold">Cantidad</th>
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
                                                                    <tr>
                                                                        <td>Reparación de Motor</td>
                                                                        <td>1</td>
                                                                        <td>Israel Cruz</td>
                                                                        <td>10/05/2023</td>
                                                                        <td>20/05/2023</td>
                                                                        <td class="reparación">Reparación</td>
                                                                        <td class="labelUrgente"><span >Urgente</span></td>
                                                                        <td class="labelEspera"><span>En espera</span></td>
                                                                        <td class="td-actions justify-content-end">
                                                                            <a href="#" class="" data-bs-toggle="modal" data-bs-target="#editarReparacion">
                                                                                <svg xmlns="http://www.w3.org/2000/svg "  width="28" height="28" fill="currentColor" class="bi bi-pencil accionesIconos" viewBox="0 0 16 16">
                                                                                    <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                                                                                </svg>
                                                                            </a>
                                                                            <form action="">
                                                                                
                                                                                <button class=" btnSinFondo" type="submit" rel="tooltip" >
                                                                                    <svg xmlns="http://www.w3.org/2000/svg"  width="28" height="28" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                                                                                        <path  d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                                                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                                                                                    </svg>
                                                                                </button>
                                                                            </form>
                                                                        </td>
                                                                    </tr> 
                                                                    <!--segunda linea-->
                                                                    <tr>
                                                                        <td>Reparación de Motor</td>
                                                                        <td>1</td>
                                                                        <td>Israel Cruz</td>
                                                                        <td>10/05/2023</td>
                                                                        <td>20/05/2023</td>
                                                                        <td>Herramienta</td>
                                                                        <td class="labelNecesaria"><span>Necesaria</Span></td>
                                                                        <td class="labelRealizado"><span>Realizado</span></td>
                                                                        <td class="td-actions justify-content-end">
                                                                            <a href="#" class="" data-bs-toggle="modal" data-bs-target="#editarSolicitud">
                                                                                <svg xmlns="http://www.w3.org/2000/svg "  width="28" height="28" fill="currentColor" class="bi bi-pencil accionesIconos" viewBox="0 0 16 16">
                                                                                    <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                                                                                </svg>
                                                                            </a>
                                                                            <form action="">
                                                                                
                                                                                <button class=" btnSinFondo" type="submit" rel="tooltip" >
                                                                                    <svg xmlns="http://www.w3.org/2000/svg"  width="28" height="28" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                                                                                        <path  d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                                                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                                                                                    </svg>
                                                                                </button>
                                                                            </form>
                                                                        </td>
                                                                    </tr>  
                                                                    
                                                                    <!--tercera linea-->
                                                                    <tr>
                                                                        <td>Reparación de Motor</td>
                                                                        <td>1</td>
                                                                        <td>Israel Cruz</td>
                                                                        <td>10/05/2023</td>
                                                                        <td>20/05/2023</td>
                                                                        <td >Refacción</td>
                                                                        <td class="labelDeseable"><span>Deseable</Span></td>
                                                                        <td class="labelTerminado"><span>Terminado</span></td>
                                                                        <td class="td-actions justify-content-end">
                                                                            <a href="#" class="" data-bs-toggle="modal" data-bs-target="#editarSolicitud">
                                                                                <svg xmlns="http://www.w3.org/2000/svg "  width="28" height="28" fill="currentColor" class="bi bi-pencil accionesIconos" viewBox="0 0 16 16">
                                                                                <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                                                                                </svg>
                                                                            </a>
                                                                            <form action="">
                                                                                <button class=" btnSinFondo" type="submit" rel="tooltip" >
                                                                                    <svg xmlns="http://www.w3.org/2000/svg"  width="28" height="28" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                                                                                    <path  d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                                                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                                                                                    </svg>
                                                                                </button>
                                                                            </form>
                                                                        </td>
                                                                    </tr>


                                                                    <!--cuarta linea-->
                                                                    <tr>
                                                                        <td>Reparación de Motor</td>
                                                                        <td>1</td>
                                                                        <td>Israel Cruz</td>
                                                                        <td>10/05/2023</td>
                                                                        <td>20/05/2023</td>
                                                                        <td>Combustible</td>
                                                                        <td class="labelProrrogable"><span>Prorrogable</Span></td>
                                                                        <td class="labelTerminado"><span>Terminado</span></td>
                                                                        <td class="td-actions justify-content-end">
                                                                            <a href="#" class="" data-bs-toggle="modal" data-bs-target="#editarSolicitud">
                                                                                <svg xmlns="http://www.w3.org/2000/svg "  width="28" height="28" fill="currentColor" class="bi bi-pencil accionesIconos" viewBox="0 0 16 16">
                                                                                    <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                                                                                </svg>
                                                                            </a>
                                                                            <form action="">
                                                                                <button class=" btnSinFondo" type="submit" rel="tooltip" >
                                                                                    <svg xmlns="http://www.w3.org/2000/svg"  width="28" height="28" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                                                                                        <path  d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                                                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                                                                                    </svg>
                                                                                </button>
                                                                            </form>
                                                                        </td>
                                                                    </tr>

                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Mantenimientos-->
                                    <div class="tab-pane fade" id="mantenimiento-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="table-responsive">
                                                            <div class="row border-bottom justify-content-end">
                                                                <div class="col-3 mb-3">

                                                                    <button class="btnSinFondocALENDARIO float-end" data-bs-toggle="modal" data-bs-target="#mantenimientoModal">  
                                                                        <img src="img/calendario/tarea.svg" class="imgBTNcalendario">
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
                                                                    <th class="fw-semibold">Prioridad</th>
                                                                    <th class="fw-semibold">Estado</th>
                                                                    <th class="fw-semibold text-right">Acciones</th>
                                                                </thead>
                                                                <tbody>
                                                                    <!--primera linea-->
                                                                    <tr>
                                                                        <td>CD012</td>
                                                                        <td>Retroexcavadora</td>
                                                                        <td>10/05/2023</td>
                                                                        <td>20/05/2023</td>
                                                                        <td>Corectivo</td>
                                                                        <td class="labelUrgente">Urgente</td>
                                                                        <td class="labelEspera">En espera</td>
                                                                        <td class="td-actions justify-content-end">
                                                                            <a href="#" class="" data-bs-toggle="modal" data-bs-target="#editarMantenimiento">
                                                                                <svg xmlns="http://www.w3.org/2000/svg "  width="28" height="28" fill="currentColor" class="bi bi-pencil accionesIconos" viewBox="0 0 16 16">
                                                                                <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                                                                                </svg>
                                                                            </a>
                                                                            <form action="">
                                                                                <button class=" btnSinFondo" type="submit" rel="tooltip">
                                                                                    <svg xmlns="http://www.w3.org/2000/svg"  width="28" height="28" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                                                                                        <path  d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                                                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                                                                                    </svg>
                                                                                </button>
                                                                            </form>
                                                                        </td>
                                                                    </tr> 
                                                                    
                                                                    <!--segunda linea-->
                                                                    <tr>
                                                                        <td>CD012</td>
                                                                        <td>Retroexcavadora</td>
                                                                        <td>10/05/2023</td>
                                                                        <td>20/05/2023</td>
                                                                        <td>Corectivo</td>
                                                                        <td class="labelNecesaria">Necesaria</td>
                                                                        <td class="labelRealizado">Realizado</td>
                                                                        <td class="td-actions justify-content-end">
                                                                            <a href="#" class="" data-bs-toggle="modal" data-bs-target="#editarMantenimiento">
                                                                                <svg xmlns="http://www.w3.org/2000/svg "  width="28" height="28" fill="currentColor" class="bi bi-pencil accionesIconos" viewBox="0 0 16 16">
                                                                                    <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                                                                                </svg>
                                                                            </a>
                                                                            <form action="">
                                                                                <button class=" btnSinFondo" type="submit" rel="tooltip">
                                                                                    <svg xmlns="http://www.w3.org/2000/svg"  width="28" height="28" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                                                                                        <path  d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                                                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                                                                                    </svg>
                                                                                </button>
                                                                            </form>
                                                                        </td>
                                                                    </tr>

                                                                    <!--tercera linea-->
                                                                    <tr>
                                                                        <td>CD012</td>
                                                                        <td>Retroexcavadora</td>
                                                                        <td>10/05/2023</td>
                                                                        <td>20/05/2023</td>
                                                                        <td>Corectivo</td>
                                                                        <td class="labelDeseable">Deseable</td>
                                                                        <td class="labelRealizado">Realizado</td>
                                                                        <td class="td-actions justify-content-end">
                                                                            <a href="#" class="" data-bs-toggle="modal" data-bs-target="#editarMantenimiento">
                                                                                <svg xmlns="http://www.w3.org/2000/svg "  width="28" height="28" fill="currentColor" class="bi bi-pencil accionesIconos" viewBox="0 0 16 16">
                                                                                    <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                                                                                </svg>
                                                                            </a>
                                                                            <form action="">
                                                                                <button class=" btnSinFondo" type="submit" rel="tooltip">
                                                                                    <svg xmlns="http://www.w3.org/2000/svg"  width="28" height="28" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                                                                                        <path  d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                                                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                                                                                    </svg>
                                                                                </button>
                                                                            </form>
                                                                        </td>
                                                                    </tr>

                                                                    <!--cuarta linea-->
                                                                    <tr>
                                                                        <td>CD012</td>
                                                                        <td>Retroexcavadora</td>
                                                                        <td>10/05/2023</td>
                                                                        <td>20/05/2023</td>
                                                                        <td>Corectivo</td>
                                                                        <td class="labelProrrogable">Prorrogable</td>
                                                                        <td class="labelTerminado">Terminado</td>
                                                                        <td class="td-actions justify-content-end">
                                                                            <a href="#" class="" data-bs-toggle="modal" data-bs-target="#editarMantenimiento">
                                                                                <svg xmlns="http://www.w3.org/2000/svg "  width="28" height="28" fill="currentColor" class="bi bi-pencil accionesIconos" viewBox="0 0 16 16">
                                                                                    <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                                                                                </svg>
                                                                            </a>
                                                                            <form action="">
                                                                                <button class=" btnSinFondo" type="submit" rel="tooltip">
                                                                                    <svg xmlns="http://www.w3.org/2000/svg"  width="28" height="28" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                                                                                        <path  d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                                                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                                                                                    </svg>
                                                                                </button>
                                                                            </form>
                                                                        </td>
                                                                    </tr>

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
<div class="modal fade" id="editarTarea" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bacTituloPrincipal">
            <img src="img/calendario/tareagris.svg" class="imgBTNcalendario">
          <h1 class="modal-title fs-5" id="exampleModalLabel">&nbsp Nueva Tarea</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form class="row d-flex">
                <div class=" col-12 col-sm-6 mb-3 ">
                    <label class="labelTitulo">Título:</label></br>
                    <input type="text" class="inputCaja" id="apellidoP" name="apellidoP" value="{{ old('apellidoP') }}">
                </div>
                <div class=" col-12 col-sm-6 mb-3 ">
                    <label class="labelTitulo">Responsable:</label></br>
                    <select class="form-select form-select-lg mb-3 inputCaja" aria-label=".form-select-lg example">
                    
                        <option value="1">Responsable 1</option>
                        <option value="2">Responsable 2</option>
                        <option value="3">Responsable 3</option>
                      </select>
                    
                </div>
                <div class=" col-12 mb-3 " >
                    <h4 class="labelTitulo mb-2">Prioridad:</h4>
                    <div class="row ">
                        <div class=" col-6  col-lg-3 d-flex mb-3" >
                            <input class="" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                            <div class=" ms-3" > 
                                <label class="form-check-label labelUrgente" for="flexRadioDefault1"> Urgente </label>
                            </div>     
                        </div>

                        <div class=" col-6 col-lg-3 d-flex mb-3" >
                            <input class="" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                            <div class=" ms-3" > 
                                <label class="form-check-label labelNecesaria" for="flexRadioDefault1"> Necesaria </label>
                            </div>     
                        </div>
                        <div class=" col-6  col-lg-3  d-flex mb-3" >
                            <input class="" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                            <div class=" ms-3" > 
                                <label class="form-check-label labelDeseable" for="flexRadioDefault1"> Deseable </label>
                            </div>     
                        </div>
                        <div class=" col-6  col-lg-3  d-flex mb-3" >
                            <input class="" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                            <div class=" ms-3" > 
                                <label class="form-check-label labelProrrogable" for="flexRadioDefault1"> Prorrogable </label>
                            </div>     
                        </div>
                    </div>
                </div>
                <div class=" col-12 col-sm-6 mb-3 ">
                    <label class="labelTitulo">Fecha Inicio:</label></br>
                    <input type="date" class="inputCaja" id="apellidoP" name="apellidoP" value="{{ old('apellidoP') }}">
                </div>
                <div class=" col-12 col-sm-6 mb-3 ">
                    <label class="labelTitulo">Fecha Fin:</label></br>
                    <input type="date" class="inputCaja" id="apellidoP" name="apellidoP" value="{{ old('apellidoP') }}">
                </div>
                <div class=" col-12  mb-3 ">
                    <label class="labelTitulo">Comentarios:</label></br>
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


<!-- Modal Solicitudes-->
<div class="modal fade" id="solicitudModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bacTituloPrincipal">
            <img src="img/calendario/solicitudgris.svg" class="imgBTNcalendario">
          <h1 class="modal-title fs-5" id="exampleModalLabel"> &nbsp Nueva Solicitud</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form class="row d-flex justify-content-center">
                <div class=" col-12 col-sm-6 mb-3 ">
                    <label class="labelTitulo">Título:</label></br>
                    <input type="text" class="inputCaja" id="apellidoP" name="apellidoP" value="{{ old('apellidoP') }}">
                </div>
                <div class=" col-12 col-sm-6 mb-3 ">
                    <label class="labelTitulo">Responsable:</label></br>
                    <select class="form-select form-select-lg mb-3 inputCaja" aria-label=".form-select-lg example">
                    
                        <option value="1">Responsable 1</option>
                        <option value="2">Responsable 2</option>
                        <option value="3">Responsable 3</option>
                      </select>
                    
                </div>
                
                <div class=" col-12 col-sm-6 mb-3 ">
                    <label class="labelTitulo">Fecha Solicitud:</label></br>
                    <input type="date" class="inputCaja" id="apellidoP" name="apellidoP" value="{{ old('apellidoP') }}">
                </div>
                <div class=" col-12 col-sm-6 mb-3 ">
                    <label class="labelTitulo">Fecha Requerimiento:</label></br>
                    <input type="date" class="inputCaja" id="apellidoP" name="apellidoP" value="{{ old('apellidoP') }}">
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
                                <select class="form-select form-select-lg mb-3 inputCaja" aria-label=".form-select-lg example"> 
                                    <option value="1">Reparación 1</option>
                                    <option value="2">Reparación 2</option>
                                    <option value="3">Reparación 3</option>
                                </select>
                            </div>
                            <div class="col-10 my-4 mx-auto">  
                                <label class="labelTitulo">Funcionalidad:</label></br> 
                                <select class="form-select form-select-lg mb-3 inputCaja" aria-label=".form-select-lg example"> 
                                    <option value="1">Atención Inmediata</option>
                                    <option value="2">Atención Media</option>
                                    <option value="3">Atención Baja</option>
                                </select>
                            </div>

                            <div class="col-5 mb-4 mt-5 mx-auto">  
                                <span class="mi-archivo"> <input class="mb-4 ver" type="file" name="foto" id="mi-archivo" accept="image/*"></span>
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
                                <select class="form-select form-select-lg mb-3 inputCaja" aria-label=".form-select-lg example"> 
                                    <option value="1">Desarmadores Planos</option>
                                    <option value="2">Gato hidráulico</option>
                                    <option value="3">Llavesa Allen</option>
                                </select>
                            </div>
                            <div class="col-10 my-4 mb-5 mx-auto">  
                                <label class="labelTitulo">Cantidad:</label></br> 
                                <input type="text" class="inputCaja" id="particular" name="" value="">
                            </div>
                          </div>

                          <!-- refacción-->
                          <div class="carousel-item border">
                            <div class="tituloCarrouselReparacion py-2">
                                <h4 class="text-center"> REFACCIÓN</h4>
                            </div>

                            <div class="col-10 my-4 mx-auto">   
                                <select class="form-select form-select-lg mb-3 inputCaja" aria-label=".form-select-lg example"> 
                                    <option value="1">Filtro de Aire</option>
                                    <option value="2">Refacción 2</option>
                                    <option value="3">Refacción 3</option>
                                </select>
                            </div>
                            <div class="col-10 my-4 mb-5 mx-auto">  
                                <label class="labelTitulo">Cantidad:</label></br> 
                                <input type="text" class="inputCaja" id="particular" name="" value="">
                            </div>
                          </div>

                            <!-- consumible-->
                            <div class="carousel-item border">
                                <div class="tituloCarrouselReparacion py-2">
                                    <h4 class="text-center"> CONSUMIBLE</h4>
                                </div>
                            
                                <div class="col-10 my-4 mx-auto">   
                                    <select class="form-select form-select-lg mb-3 inputCaja" aria-label=".form-select-lg example"> 
                                        <option value="1">Filtro de Aire</option>
                                        <option value="2">Refacción 2</option>
                                        <option value="3">Refacción 3</option>
                                    </select>
                                </div>
                                <div class="col-10 my-4 mb-5 mx-auto">  
                                    <label class="labelTitulo">Cantidad:</label></br> 
                                    <input type="text" class="inputCaja" id="particular" name="" value="">
                                </div>
                            </div>

                            <!-- combustible-->
                            <div class="carousel-item border">
                                <div class="tituloCarrouselReparacion py-2">
                                    <h4 class="text-center"> COMBUSTIBLE</h4>
                                </div>
                                                        
                                 <div class="col-10 my-4 mx-auto">   
                                    <select class="form-select form-select-lg mb-3 inputCaja" aria-label=".form-select-lg example"> 
                                        <option value="1">Diesel</option>
                                        <option value="2">Gasolina</option>
                                        <option value="3">Refacción 3</option>
                                    </select>
                                </div>
                                <div class="col-10 my-4 mb-5 mx-auto">  
                                    <label class="labelTitulo">Litros:</label></br> 
                                    <input type="text" class="inputCaja" id="particular" name="" value="">
                                </div>
                            </div>
                            <button class="carousel-control-prev carouselBoton" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                              </button>
                              <button class="carousel-control-next carouselBoton" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden controlCarouselNext">Next</span>
                              </button>

                        </div>
                       
                    </div>
                    
                </div>
                

                <div class=" col-12 col-lg-6  my-4 ">
                    
                    <div class="row">
                        <h4 class="mb-3">Prioridad</h4>
                        <div class=" col-6   d-flex mb-3" >
                            <input class="" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                            <div class=" ms-3" > 
                                <label class="form-check-label labelUrgente" for="flexRadioDefault1"> Urgente </label>
                            </div>     
                        </div>

                        <div class=" col-6 d-flex mb-3" >
                            <input class="" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                            <div class=" ms-3" > 
                                <label class="form-check-label labelNecesaria" for="flexRadioDefault1"> Necesaria </label>
                            </div>     
                        </div>
                        <div class=" col-6   d-flex mb-3" >
                            <input class="" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                            <div class=" ms-3" > 
                                <label class="form-check-label labelDeseable" for="flexRadioDefault1"> Deseable </label>
                            </div>     
                        </div>
                        <div class=" col-6   d-flex mb-3" >
                            <input class="" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                            <div class=" ms-3" > 
                                <label class="form-check-label labelProrrogable" for="flexRadioDefault1"> Prorrogable </label>
                            </div>     
                        </div>
                    </div>
                    <div class="row">
                        <h4 class="mt-4 mb-3">Estado</h4>
                        <div class=" col-6   d-flex mb-3" >
                            <input class="" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                            <div class=" ms-3" > 
                                <label class="form-check-label labelEspera" for="flexRadioDefault1"> En Espera </label>
                            </div>     
                        </div>

                        <div class=" col-6 d-flex mb-3" >
                            <input class="" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                            <div class=" ms-3" > 
                                <label class="form-check-label labelRealizado" for="flexRadioDefault1"> Realizado </label>
                            </div>     
                        </div>
                        <div class=" col-6   d-flex mb-3" >
                            <input class="" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                            <div class=" ms-3" > 
                                <label class="form-check-label labelTerminado" for="flexRadioDefault1"> Terminado </label>
                            </div>     
                        </div>

                    </div>

                </div>


                <div class=" col-12 col-lg-6  my-4 ">
                    <label class="labelTitulo">Comentarios:</label></br>
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
<div class="modal fade" id="mantenimientoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bacTituloPrincipal">
            <img src="img/calendario/mantenimientogris.svg" class="imgBTNcalendario">
          <h1 class="modal-title fs-5" id="exampleModalLabel">&nbsp Nuevo Mantenimiento</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form class="row d-flex">
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
                <div class=" col-12 col-sm-6 mb-2">
                    <label class="labelTitulo">Título:</label></br>
                    <input type="text" class="inputCaja" id="apellidoP" name="apellidoP" value="">
                </div>
                <div class=" col-12 col-sm-6 mb-3 ">
                    <label class="labelTitulo">Estado:</label></br>
                    <input type="text" class="inputCaja" id="apellidoP" name="apellidoP" value="">
                    <!--<select class="form-select form-select-lg mb-3 inputCaja" aria-label=".form-select-lg example">
                    
                        <option value="1">Responsable 1</option>
                        <option value="2">Responsable 2</option>
                        <option value="3">Responsable 3</option>
                      </select>-->
                    
                </div>
                <div class=" col-12 col-sm-6 mb-3 ">
                    <label class="labelTitulo">Fecha Solicitud:</label></br>
                    <input type="date" class="inputCaja" id="apellidoP" name="apellidoP" value="{{ old('apellidoP') }}">
                </div>
                <div class=" col-12 col-sm-6 mb-3 ">
                    <label class="labelTitulo">Tipo:</label></br>
                    <select class="form-select form-select-lg mb-3 inputCaja" aria-label=".form-select-lg example">
                    
                        <option value="1">Correctivo</option>
                        <option value="2">250</option>
                        <option value="3">500</option>
                        <option value="3">1000</option>
                    </select>
                </div>
                
                <div class=" col-12  mb-3 ">
                    <label class="labelTitulo">Comentarios:</label></br>
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

<!-- Modal Alta de Procesos -->
<div class="modal fade" id="procesosModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bacTituloPrincipal">
            <img src="img/calendario/procesos.svg" class="imgBTNcalendario">
          <h1 class="modal-title fs-5" id="exampleModalLabel">&nbsp Alta de Procesos</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form class="row d-flex">
         
                <div class=" col-12 col-sm-6 mb-2">
                    <label class="labelTitulo">Título:</label></br>
                    <input type="text" class="inputCaja" id="apellidoP" name="apellidoP" value="">
                </div>
                
                <div class=" col-12 col-sm-6 mb-3 ">
                    <label class="labelTitulo">Código:</label></br>
                    <input type="text" class="inputCaja" id="apellidoP" name="apellidoP" value="{{ old('apellidoP') }}">
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

<!-- Modal Editar Reparación-->
<div class="modal fade" id="editarReparacion" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bacTituloPrincipal">
            <img src="img/calendario/tareagris.svg" class="imgBTNcalendario">
          <h1 class="modal-title fs-5" id="exampleModalLabel"> Reparación de Motor </h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form class="row d-flex">
                <div class=" col-12 mb-3 ">

                    <div class="row">

                        <div class=" col-12 col-sm-5 mb-3 ">
                            <div class="text-center mx-auto border  mb-4">
                                <i><img class="img-fluid imgPersonal mb-2"src="{{ asset('/img/general/avatar.jpg') }}"></i>
                                    <span class="mi-archivo">
                                        <input class="mb-4 ver" type="file" name="foto" id="mi-archivo" accept="image/*">
                                    </span>
                                    <label for="mi-archivo">
                                        <span>sube imagen</span>
                                    </label>
                            </div>
                        </div>

                        <div class=" col-12 col-sm-7 mb-3 ">

                            <div>
                                <label class="labelTitulo">Título:</label></br>
                                <input type="text" class="inputCaja" id="apellidoP" name="apellidoP" value="{{ old('apellidoP') }}">
                            </div>
                            <div>
                                <label class="labelTitulo">Responsable:</label></br>
                                <select class="form-select form-select-lg mb-3 inputCaja" aria-label=".form-select-lg example">
                                    <option value="1">Responsable 1</option>
                                    <option value="2">Responsable 2</option>
                                    <option value="3">Responsable 3</option>
                                </select>

                            </div>
                            <div >
                                <label class="labelTitulo">Fecha Inicio:</label></br>
                                <input type="date" class="inputCaja" id="apellidoP" name="apellidoP" value="{{ old('apellidoP') }}">
                            </div>
                            <div>
                                <label class="labelTitulo">Fecha Fin:</label></br>
                                <input type="date" class="inputCaja" id="apellidoP" name="apellidoP" value="{{ old('apellidoP') }}">
                            </div>
                        </div>
                    </div>    
                </div>

                

                <div class=" col-12 mb-3 " >
                    <div class="row">
                        <h4 class="labelTitulo mb-2">Funcionalidad sel Equipo</h4>
                            <div class=" col-6  col-lg-3   d-flex mb-3" >
                                <input class="" type="radio" name="estado" id="estado">
                                <div class=" ms-3" > 
                                    <label class="form-check-label labelUrgente" for="estado"> No Funciona </label>
                                </div>     
                            </div>

                            <div class=" col-6  col-lg-3 d-flex mb-3" >
                                <input class="" type="radio" name="estado" id="estado">
                                <div class=" ms-3" > 
                                        <label class="form-check-label labelDeseable" for="estado"> Funciona Poco </label>
                                </div>     
                            </div>
                            <div class=" col-6  col-lg-3   d-flex mb-3" >
                                <input class="" type="radio" name="estado" id="estado">
                                <div class=" ms-3" > 
                                    <label class="form-check-label labelProrrogable" for="estado"> Funciona </label>
                                </div>     
                            </div>
                    </div>
                    <div class="row ">
                        <h4 class="labelTitulo mb-2">Prioridad de la solicitud:</h4>
                        <div class=" col-6  col-lg-3 d-flex mb-3" >
                            <input class="" type="radio" name="prioridad" id="prioridad">
                            <div class=" ms-3" > 
                                <label class="form-check-label labelUrgente" for="prioridad"> Urgente </label>
                            </div>     
                        </div>

                        <div class=" col-6 col-lg-3 d-flex mb-3" >
                            <input class="" type="radio" name="prioridad" id="prioridad">
                            <div class=" ms-3" > 
                                <label class="form-check-label labelNecesaria" for="prioridad"> Necesaria </label>
                            </div>     
                        </div>
                        <div class=" col-6  col-lg-3  d-flex mb-3" >
                            <input class="" type="radio" name="prioridad" id="prioridad">
                            <div class=" ms-3" > 
                                <label class="form-check-label labelDeseable" for="prioridad"> Deseable </label>
                            </div>     
                        </div>
                        <div class=" col-6  col-lg-3  d-flex mb-3" >
                            <input class="" type="radio" name="prioridad" id="prioridad">
                            <div class=" ms-3" > 
                                <label class="form-check-label labelProrrogable" for="prioridad"> Prorrogable </label>
                            </div>     
                        </div>
                    </div>
 
                    <div class="row">
                        <h4 class="labelTitulo mb-2">Estado de la Solicitud</h4>
                            <div class=" col-6  col-lg-3   d-flex mb-3" >
                                <input class="" type="radio" name="estado" id="estado">
                                <div class=" ms-3" > 
                                    <label class="form-check-label labelEspera" for="estado"> En Espera </label>
                                </div>     
                            </div>

                            <div class=" col-6  col-lg-3 d-flex mb-3" >
                                <input class="" type="radio" name="estado" id="estado">
                                <div class=" ms-3" > 
                                        <label class="form-check-label labelRealizado" for="estado"> Realizado </label>
                                </div>     
                            </div>
                            <div class=" col-6  col-lg-3   d-flex mb-3" >
                                <input class="" type="radio" name="estado" id="estado">
                                <div class=" ms-3" > 
                                    <label class="form-check-label labelTerminado" for="estado"> Terminado </label>
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

<!-- Modal Editar Solicitud-->
<div class="modal fade" id="editarSolicitud" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bacTituloPrincipal">
            <img src="img/calendario/tareagris.svg" class="imgBTNcalendario">
          <h1 class="modal-title fs-5" id="exampleModalLabel"> Desarmador de Cruz </h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form class="row d-flex">

                <div class=" col-12 col-sm-6 mb-2">
                    <label class="labelTitulo">Nombre de la Solicitud:</label></br>
                    <input type="text" class="inputCaja" id="apellidoP" name="" value="">
                </div>
                <div class=" col-12 col-sm-6 mb-3 ">
                    <label class="labelTitulo">Responsable:</label></br>
                    <select class="form-select form-select-lg mb-3 inputCaja" aria-label=".form-select-lg example">
                        <option value="1">Responsable 1</option>
                        <option value="2">Responsable 2</option>
                        <option value="3">Responsable 3</option>
                    </select>
                    
                </div>
                <div class=" col-12 col-sm-6 mb-3 ">
                    <label class="labelTitulo">Fecha Solicitud:</label></br>
                    <input type="date" class="inputCaja" id="apellidoP" name="" value="">
                </div>
                <div class=" col-12 col-sm-6 mb-3 ">
                    <label class="labelTitulo">Fecha Requerimiento:</label></br>
                    <input type="date" class="inputCaja" id="apellidoP" name="" value="">
                </div>
                <div class=" col-12 col-sm-6 mb-3 ">
                    <label class="labelTitulo">Herramienta:</label></br>
                    <select class="form-select form-select-lg mb-3 inputCaja" aria-label=".form-select-lg example">
                        <option value="1">Responsable 1</option>
                        <option value="2">Responsable 2</option>
                        <option value="3">Responsable 3</option>
                    </select>   
                </div>
                <div class=" col-12 col-sm-6 mb-3 ">
                    <label class="labelTitulo">Refacción</label></br>
                    <select class="form-select form-select-lg mb-3 inputCaja" aria-label=".form-select-lg example">
                        <option value="1">Refacción</option>
                        <option value="2">Refacción</option>
                        <option value="3">Refacción</option>
                        <option value="3">Refacción</option>
                    </select>
                </div>
                <div class=" col-12 col-sm-6 mb-3 ">
                    <label class="labelTitulo">Consumible:</label></br>
                    <select class="form-select form-select-lg mb-3 inputCaja" aria-label=".form-select-lg example">
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
                    <select class="form-select form-select-lg mb-3 inputCaja" aria-label=".form-select-lg example">
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
                    <div class=" col-6  col-lg-3 d-flex mb-3" >
                        <input class="" type="radio" name="prioridad" id="prioridad">
                        <div class=" ms-3" > 
                            <label class="form-check-label labelUrgente" for="prioridad"> Urgente </label>
                        </div>     
                    </div>

                    <div class=" col-6 col-lg-3 d-flex mb-3" >
                        <input class="" type="radio" name="prioridad" id="prioridad">
                        <div class=" ms-3" > 
                            <label class="form-check-label labelNecesaria" for="prioridad"> Necesaria </label>
                        </div>     
                    </div>
                    <div class=" col-6  col-lg-3  d-flex mb-3" >
                        <input class="" type="radio" name="prioridad" id="prioridad">
                        <div class=" ms-3" > 
                            <label class="form-check-label labelDeseable" for="prioridad"> Deseable </label>
                        </div>     
                    </div>
                    <div class=" col-6  col-lg-3  d-flex mb-3" >
                        <input class="" type="radio" name="prioridad" id="prioridad">
                        <div class=" ms-3" > 
                            <label class="form-check-label labelProrrogable" for="prioridad"> Prorrogable </label>
                        </div>     
                    </div>
                </div>

                <div class="row mb-4">
                    <h4 class="labelTitulo mb-2">Estado de la Solicitud</h4>
                        <div class=" col-6  col-lg-3   d-flex mb-3" >
                            <input class="" type="radio" name="estado" id="estado">
                            <div class=" ms-3" > 
                                <label class="form-check-label labelEspera" for="estado"> En Espera </label>
                            </div>     
                        </div>

                        <div class=" col-6  col-lg-3 d-flex mb-3" >
                            <input class="" type="radio" name="estado" id="estado">
                            <div class=" ms-3" > 
                                    <label class="form-check-label labelRealizado" for="estado"> Realizado </label>
                            </div>     
                        </div>
                        <div class=" col-6  col-lg-3   d-flex mb-3" >
                            <input class="" type="radio" name="estado" id="estado">
                            <div class=" ms-3" > 
                                <label class="form-check-label labelTerminado" for="estado"> Terminado </label>
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
<!--Modal Editar Mantenimiento-->

<div class="modal fade" id="editarMantenimiento" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bacTituloPrincipal">
            <img src="img/calendario/mantenimientogris.svg" class="imgBTNcalendario">
          <h1 class="modal-title fs-5" id="exampleModalLabel">&nbsp CD012 Retroexcavadora</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form class="row d-flex">
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
                <div class=" col-12 col-sm-6 mb-2">
                    <label class="labelTitulo">Título:</label></br>
                    <input type="text" class="inputCaja" id="apellidoP" name="apellidoP" value="">
                </div>
                <div class=" col-12 col-sm-6 mb-3 ">
                    <label class="labelTitulo">Estado:</label></br>
                    <input type="text" class="inputCaja" id="apellidoP" name="apellidoP" value="">
                    <!--<select class="form-select form-select-lg mb-3 inputCaja" aria-label=".form-select-lg example">
                    
                        <option value="1">Responsable 1</option>
                        <option value="2">Responsable 2</option>
                        <option value="3">Responsable 3</option>
                      </select>-->
                    
                </div>
                <div class=" col-12 col-sm-6 mb-3 ">
                    <label class="labelTitulo">Fecha Solicitud:</label></br>
                    <input type="date" class="inputCaja" id="apellidoP" name="apellidoP" value="{{ old('apellidoP') }}">
                </div>
                <div class=" col-12 col-sm-6 mb-3 ">
                    <label class="labelTitulo">Tipo:</label></br>
                    <select class="form-select form-select-lg mb-3 inputCaja" aria-label=".form-select-lg example">
                    
                        <option value="1">Correctivo</option>
                        <option value="2">250</option>
                        <option value="3">500</option>
                        <option value="3">1000</option>
                    </select>
                </div>
                
                <div class=" col-12  mb-3 ">
                    <label class="labelTitulo">Comentarios:</label></br>
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

@endsection