@extends('layouts.main', ['activePage' => 'inventario', 'titlePage' => __('Inventario')])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card" style="margin-top: 100px;">
                    <div class="card-header bacTituloPrincipal">
                        {{-- <p class="card-category">Usuarios registrados</p> --}}
                        Detalles De La Descarga
                    </div>
                    <div class="card-body">
                        <div class="row divBorder">

                            <div class="col-6 text-right">

                                <a href="{{ route('inventario.dashCombustible') }}">
                                    <button class="btn regresar">
                                        <span class="material-icons">
                                            reply
                                        </span>
                                        Regresar
                                    </button>
                                </a>
                            </div>

                            <div class="col-6 pb-3 text-end">
                                @can('inventario_create')
                                    <button type="button" onclick="print()" class="btn botonGral text-capitalize">Volver A Imprimir</button>
                                @endcan
                            </div>
                        </div>
                    </div>
                    <div id="print-content" class="content-print">
                        <img src="{{ asset('/img/login/002-sin-slogan.png') }}" alt="" width="160px;" class="mb-2" style="margin-left: -15px;">
                        
                        <div class="text-start">
                            <img src="{{ asset('/img/login/Header11GenericoGrande.svg') }}" alt="" class="mb-2">
                            <br>
                            <div class="text-center" id="fecha-hora"></div>
                            <p class="text-center" id="hora"></p>
                            <div class="text-center"><span style="font-weight: 1000; font-size: 16px important;">Q2S/COMB-: -- </span> {{ $descarga->id }}</div>
                            <div class="text-center"><span style="font-weight: 1000; font-size: 16px important;">DESPACHADOR: -- </span> {{ $descarga->receptor_nombre }}</div>
                            <div class="text-center"><span style="font-weight: 1000; font-size: 16px important;">EQUIPO DESPACHADO: -- </span> {{ $descarga->servicio_titulo }}</div>
                            <div class="text-center"><span style="font-weight: 1000; font-size: 16px important;">OPERADOR: -- </span> {{ $descarga->operador_nombre }}</div>
                            <div class="text-center"><span style="font-weight: 1000; font-size: 16px important;">EQUIPO Y/O MAQUINARIA: -- </span> {{ $descarga->maquinaria_nombre }}</div>
                            <div class="text-center"><span style="font-weight: 1000; font-size: 16px important;">SOLICITO: -- </span> {{ $descarga->user_nombre }}</div>
                            <div class="text-center"><span style="font-weight: 1000; font-size: 16px important;">LITROS: -- </span>{{ $descarga->litros }}</div>
                            <div class="text-center"><span style="font-weight: 1000; font-size: 16px important;">KM: -- </span>{{ $descarga->km }}</div>
                            <div class="text-center"><span style="font-weight: 1000; font-size: 16px important;">GRASA: -- </span> {{ $descarga->Grasa }}</div>
                            <div class="text-center"><span style="font-weight: 1000; font-size: 16px important;">HIDRAULICO: -- </span> {{ $descarga->hidraulico }}</div>
                            <div class="text-center"><span style="font-weight: 1000; font-size: 16px important;">ANTICONGELANTE: -- </span> {{ $descarga->anticongelante }}</div>
                            <div class="text-center"><span style="font-weight: 1000; font-size: 16px important;">MOTOR: -- </span>{{ $descarga->motor }}</div>
                            <div class="text-center"><span style="font-weight: 1000; font-size: 16px important;">OTRO: -- </span>{{ $descarga->otro }}</div>
                            <div class="text-center"><span style="font-weight: 1000; font-size: 16px important;">DIRECCION: -- </span>{{ $descarga->direccion }}</div>
                            <!--<div class="text-center"><span style="font-weight: 1000; font-size: 16px important;">HORA: -- </span>{{ $descarga->horas }}</div>-->
                            <img src="{{ asset('/img/login/Header2GenericoGrande.svg') }}" alt="" class="mb-2">
                            <div class="text-center"><span style="font-weight: 1000; font-size: 16px important;">HORA SALIDA: -- </span>11:00 pm</div>
                            <div class="text-center"><span style="font-weight: 1000; font-size: 16px important;">HORA LLEGADA: -- </span>2:30 pm</div>
                            <div class="text-center"><span style="font-weight: 1000; font-size: 16px important;">HORARIO: -- </span>8:00 am - 7:30 pm</div>
                            <div class="text-center"><span style="font-weight: 1000; font-size: 16px important;">TOTAL HORAS EXTRAS: -- </span>1.30 hrs</div>
                            <div class="text-center"><span style="font-weight: 1000; font-size: 16px important;">ODOMETRO SALIDA: -- </span>125445.5</div>
                            <div class="text-center"><span style="font-weight: 1000; font-size: 16px important;">ODOMETRO LLEGADA: -- </span>125345.5</div>
                            <p class="text-center"><span style="font-weight: 1000; font-size: 16px important; margin-top: 10px;">OBSERVACIONES: -- </span>EL EQUIPO DE DESPACHO NO FUNCIONO Y SE TUBO QUE UTILIZAR EL PORTATIL</p>
                            <p class="pt-5" style="margin-top: 20px; text-align: center;">
                                ______________________________________<br>
                                Nombre Y Firma De Recibido
                            </p>
                            <img src="{{ asset('/img/login/Header3DescargaGrande.svg') }}" alt="" class="mb-2">
                            <div><span style="font-weight: 1000; font-size: 16px important;">COSTO DE COMBUSTIBLE: -- </span>100.00</div>
                            <div class="text-center"><span style="font-weight: 1000; font-size: 16px important;">COSTO DE FLUIDOS: -- </span> 25.00</div>
                            <div class="text-center"><span style="font-weight: 1000; font-size: 16px important;">TOTAL: -- </span>125.00</div>
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
        font-size: 12px;
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
