@extends('layouts.main', ['activePage' => 'inventario', 'titlePage' => __('Inventario')])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card" style="margin-top: 100px;">
                    <div class="card-header bacTituloPrincipal">
                        {{-- <p class="card-category">Usuarios registrados</p> --}}
                        Detalles de la Descarga de Combustible
                    </div>
                    <div class="card-body">
                        <div class="row divBorder">
                            <div class="col-6 text-right">
                                @if ($descarga->tipoCisternaId == null)
                                <a href="{{ route('inventario.dashCombustible') }}">
                                    <button class="btn regresar">
                                        <span class="material-icons">
                                            reply
                                        </span>
                                        Regresar
                                    </button>
                                </a>    
                                @else
                                <a href="{{ route('combustibleTote.index') }}">
                                    <button class="btn regresar">
                                        <span class="material-icons">
                                            reply
                                        </span>
                                        Regresar
                                    </button>
                                </a>
                                @endif
                            </div>

                            <div class="col-6 pb-3 text-end">
                                @can('inventario_create')
                                    <button type="button" onclick="print()" class="btn botonGral text-capitalize">Volver A Imprimir</button>
                                @endcan
                            </div>
                        </div>
                    </div>
                    <div id="print-content" class="content-print">
                        <img src="{{ asset('/img/login/002-sin-slogan.png') }}" alt="" width="200px;" class="mb-2" style="margin-left: -15px;">
                        
                        
                            <img src="{{ asset('/img/login/Header11GenericoGrande.svg') }}" alt="" class="mb-2">

                            <h1 class="text-center" style="font-weight: 1000;">Q2S/COMB-{{ sprintf("%03d", $descarga->descargaDetalleId) }}</h1><br>
                            <div class="text-center" style="font-weight: 1000; ">FECHA DE IMPRESIÓN:</div>
                            <div class="text-center" id="fecha-hora"></div>
                            <p class="text-center" id="hora"></p>
                            <br>
                            
                            <h5 style="font-weight: 1000; text-center">DESPACHADOR:</h5> <div style="font-size:14px;">{{ $descarga->receptor_nombre }}</div>
                            <h5 style="font-weight: 1000; text-center">OPERADOR:</h5> <div style="font-size:14px;">{{ $descarga->operador_nombre }}</div>
                            @if ($descarga->tipoCisternaId == null)
                                <h5 style="font-weight: 1000; text-center">EQUIPO DESPACHADO:</h5><div style="font-size:14px;"> {{ $descarga->despachado_nombre }}</div>
                            @else
                            <h5 style="font-weight: 1000; text-center">EQUIPO DESPACHADO:</h5><div style="font-size:14px;"> {{ $descarga->equipo_nombre }}</div>
                            @endif
                            
                            
                            @if ($descarga->tipoCisternaId == null)
                                <h5 class="text-center" style="font-weight: 1000; ">EQUIPO DESPACHADOR: </h5> <div class="text-center">{{ $descarga->equipo_nombre }}</div>
                            @else
                                <h5 class="text-center" style="font-weight: 1000; ">DESPACHADOR: </h5> <div class="text-center">CISTERNA TOTE</div>
                            @endif
                            <h5 style="font-weight: 1000; text-center">SOLICITO:</h5> <div style="font-size:14px;">{{$descarga->nombreSolicitante}}</div>
                            <h5 style="font-weight: 1000; text-center">KM: {{ $descarga->km }} KM</h5>

                            @if (!empty($descarga->litros))
                                <h5 style="font-weight: 1000; text-center">LITROS: {{ $descarga->litros }} L</h5>
                            @endif

                            @if (!empty($descarga->grasa))
                                <h5 style="font-weight: 1000; text-center">GRASA: {{ $descarga->grasa }} L</h5>
                            @endif

                            @if (!empty($descarga->motor))
                                <h5 style="font-weight: 1000; text-center">ACEITE MOTOR: {{ $descarga->motor }} L</h5>
                            @endif

                            @if (!empty($descarga->anticongelante))
                                <h5 style="font-weight: 1000; text-center">ANTICONGELANTE: {{ $descarga->anticongelante }} L</h5>
                            @endif

                            @if (!empty($descarga->hidraulico))
                                <h5 style="font-weight: 1000; text-center">ACEITE HIDRÁULICO: {{ $descarga->hidraulico }} L</h5>
                            @endif

                            @if (!empty($descarga->direccion))
                                <h5 style="font-weight: 1000; text-center">ACEITE DIRECCIÓN: {{ $descarga->direccion }} L</h5>
                            @endif

                            @if (!empty($descarga->otro))
                                <h5 style="font-weight: 1000; text-center">OTRO: {{ $descarga->otro }} L</h5>
                            @endif
                            
                            @if ($descarga->tipo_solicitud == false)
                                <p class="pt-5" style="margin-top: 20px; text-align: center;">
                                    ______________________________________<br>
                                    Nombre Y Firma De Recibido<br>
                                    <p class="text-center">:{{$descarga->nombreSolicitante}}</p>
                                </p>
                            @endif
                            <!--<div class="text-center"><h5 style="font-weight: 1000; ">HORA DESCARGA: </h5>{{ $descarga->horas }}</div>-->
                            @if ($descarga->tipo_solicitud != false)
                                <img src="{{ asset('/img/login/Header2GenericoGrande.svg') }}" alt="" class="mb-2">
                                {{--  <div class="text-center"><h5 style="font-weight: 1000; ">HORA SALIDA: </h5>11:00 pm</div>  --}}
                                <div class="text-center"><h5 style="font-weight: 1000;   ">FECHA DE DESCARGA:</h5>{{ \Carbon\Carbon::parse($descarga->updated_at)->format( 'Y-m-d' ) }}</div>
                                <div class="text-center"><h5 style="font-weight: 1000; ">HORA LLEGADA: </h5>{{ \Carbon\Carbon::parse($descarga->horaLlegada)->format('h:i A') }}</div>
                                {{--  <div class="text-center"><h5 style="font-weight: 1000; ">HORARIO:</h5>8:00 am - 7:30 pm</div>  --}}
                                {{--  <div class="text-center"><h5 style="font-weight: 1000; ">TOTAL HORAS EXTRAS:</h5>1.30 hrs</div>  --}}
                                {{--  <div class="text-center"><h5 style="font-weight: 1000; ">ODOMETRO CARGA: </h5>125445.5</div>
                                <div class="text-center"><h5 style="font-weight: 1000; ">ODOMETRO LLEGADA: </h5>125345.5</div>  --}}
                                <div class="text-center"><h5 style="font-weight: 1000; ">KM: </h5>{{$descarga->km}}</div>
                                <div class="text-center"><h5 style="font-weight: 1000;  margin-top: 10px;">OBSERVACIONES: </h5>{{$descarga->observaciones}}</div>
                                <p class="pt-5" style="margin-top: 20px; text-align: center;">
                                    ______________________________________<br>
                                    Nombre Y Firma De Recibido<br>
                                    <p class="text-center">:{{$descarga->nombreSolicitante}}</p>
                                </p>
                                <img src="{{ asset('/img/login/Header3DescargaGrande.svg') }}" alt="" class="mb-2">
                                @if ($descarga->tipoCisternaId == null)
                                    <div class="text-center"><h5 style="font-weight: 1000;">COSTO DE COMBUSTIBLE:</h5>${{$ultimaCargaSinTote->precio}}</div>
                                    <div class="text-center"><h5 style="font-weight: 1000; ">COSTO DE TRABAJO:</h5>${{$descarga->costoTrabajo}}</div>
                                    <h5 style="font-weight: 1000; ">TOTAL: $${{($ultimaCargaSinTote->precio*$descarga->litros)+$descarga->costoTrabajo}}</h5>
                                @else
                                    <div class="text-center"><h5 style="font-weight: 1000;">COSTO DE COMBUSTIBLE:</h5>${{$ultimaCarga[0]->ultimoPrecio}}</div>
                                    <div class="text-center"><h5 style="font-weight: 1000; ">COSTO DE TRABAJO:</h5>${{$descarga->costoTrabajo}}</div>
                                    <h5 style="font-weight: 1000; ">TOTAL: $${{($ultimaCarga[0]->ultimoPrecio*$descarga->litros)+$descarga->costoTrabajo}}</h5>
                                @endif
                                
                            @endif
                            
                            <div class="copyright text-center" style="font-size: 10px;">
                                &copy; Copyright <strong><span>Q2Ces</span></strong>. All Rights Reserved
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    window.onload = function () {
        // Obtener la fecha y hora actual
        let now = new Date();
        let monthNames = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
        let dayNames = ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"];
        let formattedDateTime = now.getDate() + " de " + monthNames[now.getMonth()] + " de " + now.getFullYear();
        let formattedHora = "a la Hora:" + now.getHours() + ":" + (now.getMinutes() < 10 ? "0" : "") + now.getMinutes();
        document.getElementById("fecha-hora").textContent = formattedDateTime;
        document.getElementById("hora").textContent = formattedHora;
        window.print();
    };
</script>
<script>
    print(){
        window.print();
    }
</script>

<style>
    @media print {
        body * {
            visibility: hidden;
        }
        #print-content, #print-content * {
            visibility:visible !important;
        }
        
        @page {
            size: 90mm 105mm; /* Tamaño ISO C7 en milímetros */
            margin-top: 0mm; /* Ajustar según sea necesario */
            margin-bottom: 105mm;
        }
        body {
            margin: 0 !important;
            padding: 0 !important;
        }
        .content-print {
            position: absolute;
            bottom: 0mm; /* Ajusta la posición superior según sea necesario */
            top: -35mm;

            /* Otros estilos necesarios */
        }
    }
    #print-content {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        text-align: left !important;
        font-family: Arial, sans-serif;
        padding-top: 15px;
        {{--  font-size: 12px;  --}}
        font-weight: bold;
        align-items: center;
        margin: 0;
    }
    #main {
    margin-top: 0px !important; */
    }

    .headerTicket {
        background-color: black;
        color: white;
        border: 2px solid black;
        align-items: center;
    }
</style>
@endsection
