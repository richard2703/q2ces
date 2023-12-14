@extends('layouts.main', ['activePage' => 'inventario', 'titlePage' => __('Inventario')])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bacTituloPrincipal">
                        {{-- <p class="card-category">Usuarios registrados</p> --}}
                        Detalles de la Carga de Combustible
                    </div>
                    <div class="card-body">
                        <div class="row divBorder">

                            <div class="col-6 text-right">

                                @if ($carga->tipoCisternaId == null)
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
                    <div id="print-content" class="content-print" style="">
                        <img src="{{ asset('/img/login/002-sin-slogan.png') }}" alt="" width="180px;" class="mb-2" style="margin-left: -15px;">
                        
                        <div class="text-start">
                            @if ($carga->tipoCisternaId == null)
                                <img width="300px;" src="{{ asset('/img/login/Header1CargaGrande.svg') }}" alt="" class="mb-2">
                            @else
                                <img width="300px;" src="{{ asset('/img/login/Header6GenericoGrande.svg') }}" alt="" class="mb-2">
                            @endif
                            
                             <br>
                            <h1 class="text-center" style="font-weight: 1000;">Q2S/COMB-{{ sprintf("%03d", $carga->id) }}</h1> <br>
                            <h5 class="text-center" style="font-weight: 1000; ">FECHA DE IMPRESIÓN:</h5>
                            <div class="text-center" id="fecha-hora"></div>
                            <p class="text-center" id="hora"></p>
                            <br><br>
                            {{--  <div class="text-center"><h5 style="font-weight: 1000; ">SOLICITO: ...</h5> {{$solicitante['nombreSolicitante']}}</div>  --}}
                            <div class="text-center"><h5 style="font-weight: 1000;   ">LITROS:  </h5>{{ number_format($carga->litros, 2) }}                                LTS</div>
                            <div class="text-center"><h5 style="font-weight: 1000;   ">COSTO COMBUSTIBLE:</h5>${{ number_format($carga->precio, 2) }}                            </div>
                            <!--<div class="text-center"><h5 style="font-weight: 1000;   ">HORA DE DESPACHO:  ...</h5>{{ $carga->horas }}</div>-->
                            <h5 class="text-center" style="font-weight: 1000; ">TOTAL:  ${{ number_format($carga->precio * $carga->litros, 2) }}</h5>
                            
                            <img width="300px;" src="{{ asset('/img/login/Header2GenericoGrande.svg') }}" alt="" class="mb-2">
                            <div class="text-center"><h5 style="font-weight: 1000;   ">OPERADOR:</h5>{{ $carga->operador_nombre }}</div>
                            @if ($carga->tipoCisternaId != null)
                            <div class="text-center"><h5 style="font-weight: 1000;   ">EQUIPO DESPACHADO:</h5> Cisterna Tote</div>
                            @endif
                              
                            <div class="text-center"><h5 style="font-weight: 1000;   ">EQUIPO Y/O MAQUINARIA:</h5> {{ $carga->maquinaria_nombre }}</div>
                              
                            <div class="text-center"><h5 style="font-weight: 1000;   ">FECHA DE CARGA:</h5>{{ \Carbon\Carbon::parse($carga->updated_at)->format( 'Y-m-d' ) }}</div>
                            <div class="text-center"><h5 style="font-weight: 1000;   ">HORA DE CARGA:</h5>{{ substr($carga->horaLlegadaCarga, 0, 5) }}</div>
                            {{--  <div class="text-center"><h5 style="font-weight: 1000; ">HORA SALIDA:</h5>11:00 pm</div>  --}}
                            {{--  <div class="text-center"><h5 style="font-weight: 1000; ">HORA LLEGADA:</h5>{{ \Carbon\Carbon::parse($solicitante['horaLlegada'])->format('h:i A') }}</div>  --}}
                            {{--  <div class="text-center"><h5 style="font-weight: 1000; ">HORARIO:</h5>8:00 am - 7:30 pm</div>  --}}
                            {{--  <div class="text-center"><h5 style="font-weight: 1000; ">TOTAL HORAS EXTRAS:</h5>1.30 hrs</div>  --}}
                            <div class="text-center"><h5 style="font-weight: 1000;   ">KILOMETRAJE DE CARGA:</h5>{{$carga->kilometraje}} / {{$carga->maquinaria_kom}}</div>
                            {{--  <div class="text-center"><h5 style="font-weight: 1000; ">ODOMETRO LLEGADA:</h5>125345.5</div>  --}}
                            <div class="text-center"><h5 style="font-weight: 1000;  margin-top: 10px;  ">OBSERVACIONES:</h5>{{ $carga->comentario }}</div>
                            <p class="pt-5" style="margin-top: 20px; text-align: center;">
                                ______________________________________<br>
                                Nombre y Firma de Recibido<br>
                            </p>
                            <br>
                            {{--  <img width="300px;" src="{{ asset('/img/login/Header3DescargaGrande.svg') }}" alt="" class="mb-2">  --}}
                            {{--  <div><h5 style="font-weight: 1000; ">COSTO DE COMBUSTIBLE: ...</h5>100.00</div>  --}}
                            {{--  <div class="text-center"><h5 style="font-weight: 1000; ">COSTO DE TRABAJO: ...</h5>{{$solicitante['costoTrabajo']}}</div>  --}}
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
        
        {{--  @page {
            size: 90mm 105mm; /* Tamaño ISO C7 en milímetros */
            margin-bottom: 0mm;
            margin-top: 0mm;
        }  --}}
        body {
            margin-top: -80mm !important;
            padding: 0 !important;
        }
        .print-content {
            max-height: 100vh;
            /* Establece una altura máxima en la altura de la ventana gráfica */
            page-break-inside: avoid;
            /* Evita saltos de página dentro del elemento .ticket */
        }
        
    }
    #print-content {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        text-align: left !important;
        font-family: Arial, sans-serif;
        font-weight: bold;
        align-items: center;
    }
    #main {
    margin-top: 0px !important; */
    }
    
</style>
@endsection
