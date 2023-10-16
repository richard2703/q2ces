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
                        <img src="{{ asset('/img/login/002-sin-slogan.png') }}" alt="" width="180px;" class="mb-2" style="margin-left: -15px;">
                        
                            @if ($descarga->tipoCisternaId == null)
                                <img width="300px;" src="{{ asset('/img/login/Header11GenericoGrande.svg') }}" alt="" class="mb-2">
                            @else
                                <img width="300px;" src="{{ asset('/img/login/Header4GenericoGrande.svg') }}" alt="" class="mb-2">
                            @endif
            
                            <h1 class="text-center" style="font-weight: 1000;">Q2S/COMB-{{ sprintf("%03d", $descarga->id) }}</h1><br>
                            <div class="text-center" style="font-weight: 1000; ">FECHA DE IMPRESIÓN:</div>
                            <div class="text-center" id="fecha-hora"></div>
                            <p class="text-center" id="hora"></p>

                            <br>
                            @if ($descarga->tipoCisternaId == null)
                                @if ($descarga->nombre_cliente)
                                <h6 class="text-center" style="font-weight: 1000; ">CLIENTE: </h6> <div style="font-size:14px;">{{ $descarga->nombre_cliente }}</div>    
                                @else
                                    <h6 class="text-center" style="font-weight: 1000; ">CLIENTE: </h6> <div style="font-size:14px;">SIN CLIENTE</div>    
                                @endif
                                <br>
                                @if ($descarga->obras_nombre)
                                    <h6 class="text-center" style="font-weight: 1000; ">OBRA: </h6> <div style="font-size:14px;">{{ $descarga->obras_nombre }}</div>
                                @else
                                    <h6 class="text-center" style="font-weight: 1000; ">OBRA: </h6> <div style="font-size:14px;">SIN OBRA</div>    
                                @endif
                            @endif
                            
                            <h6 class="text-center" style="font-weight: 1000; ">DESPACHADOR: </h6> <div style="font-size:14px;">{{ $descarga->receptor_nombre }}</div>
                            <h6 class="text-center" style="font-weight: 1000; ">OPERADOR: </h6> <div style="font-size:14px;">{{ $descarga->operador_nombre }}</div>
                            @if ($descarga->tipoCisternaId == null)
                                <h6 style="font-weight: 1000; text-center">EQUIPO DESPACHADO:</h6><div class="text-center" style="font-size:14px;"> {{ $descarga->despachado_nombre }}</div>
                            @else
                            <h6 style="font-weight: 1000; text-center">EQUIPO DESPACHADO:</h6><div class="text-center" style="font-size:14px;"> {{ $descarga->equipo_nombre }}</div>
                            @endif
                            
                            @if ($descarga->tipoCisternaId == null)
                                <h6 class="text-center" style="font-weight: 1000; ">EQUIPO DESPACHADOR: </h6> <div class="text-center">{{ $descarga->equipo_nombre }}</div>
                            @else
                                {{--  <h6 class="text-center" style="font-weight: 1000; ">EQUIPO DESPACHADOR: </h6> <div class="text-center">CISTERNA TOTE</div>  --}}
                            @endif
                            
                            <h6 class="text-center" style="font-weight: 1000; ">SOLICITO: </h6> <div style="font-size:16px;">{{$solicitante['nombreSolicitante']}}</div>
                            @if ($descarga->tipoCisternaId == null)
                                <h6 style="font-weight: 1000;" class="text-center">LITROS COMBUSTIBLE: </h6> <div class="text-center" style="font-size:16px;"> @if ($descarga->litros) 
                                    {{ $descarga->litros }} LTS/KG </div> <div class="text-center" style="font-size:16px;"> 
                                        @if ($cliente != false) 
                                    costo: ${{$ultimaCargaSinTote->precio}} Total: ${{($descarga->litros*$ultimaCargaSinTote->precio)}} </div>
                                    @endif
                                @else
                                    0 </div> <div class="text-center" style="font-size:14px;"> 
                                @endif 
                                    
                            @else
                                <h6 style="font-weight: 1000;" class="text-center">LITROS COMBUSTIBLE: </h6> <div class="text-center" style="font-size:16px;"> @if ($descarga->litros) 
                                    {{ $descarga->litros }} LTS/KG </div> <div class="text-center" style="font-size:16px;"> 
                                        @if ($cliente != false) 
                                        costo: ${{$ultimaCarga[0]->ultimoPrecio}} Total: ${{($descarga->litros*$ultimaCarga[0]->ultimoPrecio)}} </div>
                                        @endif
                                @else
                                    0 </div> <div class="text-center" style="font-size:14px;"> 
                                @endif 
                                   
                            @endif
                            
                            <h6 style="font-weight: 1000;" class="text-center">GRASA PARA AUTO: </h6> <div class="text-center" style="font-size:16px;"> @if ($descarga->grasa) 
                                {{ $descarga->grasa }} LTS/KG </div> <div class="text-center" style="font-size:16px;"> 
                                    @if ($cliente != false) 
                                costo: ${{ $descarga->grasaUnitario }} Total: ${{($descarga->grasa*$descarga->grasaUnitario)}} </div> <br> <br>
                                @endif
                            @else
                                0 </div> <div class="text-center" style="font-size:14px;"> 
                            @endif 
                                
                            <h6 style="font-weight: 1000;" class="text-center">ACEITE MOTOR: </h6> <div class="text-ce6ter"> @if ($descarga->motor) 
                                {{ $descarga->motor }} LTS/KG </div>  
                                @if ($cliente != false) 
                            costo: ${{ $descarga->mototUnitario }} Total: ${{($descarga->motor*$descarga->mototUnitario)}}
                            @endif
                            @else
                                0 </div>  
                            @endif 
                            
                            <h6 style="font-weight: 1000;" class="text-center">ANTICONGELANTE: </h6> <div class="text-ce6ter"> @if ($descarga->anticongelante) 
                                {{ $descarga->anticongelante }} LTS/KG </div> 
                                @if ($cliente != false) 
                            costo: ${{ $descarga->anticongelanteUnitario }} Total: ${{($descarga->anticongelante*$descarga->anticongelanteUnitario)}}
                            @endif 
                            @else
                                0 </div>  
                            @endif 
                            
                            <h6 style="font-weight: 1000;" class="text-center">ACEITE HIDRÁULICO: </h6> <div class="text-ce6ter"> @if ($descarga->hidraulico) 
                                {{ $descarga->hidraulico }} LTS/KG </div>  
                                @if ($cliente != false) 
                            costo: ${{ $descarga->hidraulicoUnitario }} Total: ${{($descarga->hidraulico*$descarga->hidraulicoUnitario)}}
                            @endif
                            @else
                                0 </div>  
                            @endif 
                            
                            <h6 style="font-weight: 1000;" class="text-center">ACEITE DIRECCIÓN: </h6> <div class="text-ce6ter"> @if ($descarga->direccion) 
                                {{$descarga->direccion}} LTS/KG  </div>  
                                @if ($cliente != false) 
                            costo: ${{ $descarga->direccionUnitario }} Total: ${{($descarga->direccion*$descarga->direccionUnitario)}}
                            @endif
                            @else
                                0  </div>  
                            @endif
                            

                            @php
                            $totalProductosSinTote =
                            (isset($descarga->grasa) ? $descarga->grasa * (isset($descarga->grasaUnitario) ? $descarga->grasaUnitario : 0) : 0) +
                            (isset($descarga->motor) ? $descarga->motor * (isset($descarga->mototUnitario) ? $descarga->mototUnitario : 0) : 0) +
                            (isset($descarga->anticongelante) ? $descarga->anticongelante * (isset($descarga->anticongelanteUnitario) ? $descarga->anticongelanteUnitario : 0) : 0) +
                            (isset($descarga->hidraulico) ? $descarga->hidraulico * (isset($descarga->hidraulicoUnitario) ? $descarga->hidraulicoUnitario : 0) : 0) +
                            (isset($descarga->direccion) ? $descarga->direccion * (isset($descarga->direccionUnitario) ? $descarga->direccionUnitario : 0) : 0);

    
                            
                            $totalProductos =
                                            ($descarga->grasa*$descarga->grasaUnitario) +
                                            ($descarga->motor*$descarga->mototUnitario) +
                                            ($descarga->anticongelante*$descarga->anticongelanteUnitario) +
                                            ($descarga->hidraulico*$descarga->hidraulicoUnitario) +
                                            ($descarga->direccion*$descarga->direccionUnitario);    
                            @endphp

                            @if ($descarga->tipoCisternaId != null)
                                <img width="300px;" src="{{ asset('/img/login/Header2GenericoGrande.svg') }}" alt="" class="mb-2">
                                @if ($descarga->kilometrajeNuevo != null)
                                    <div class="text-center"><h6 style="font-weight: 1000; ">KILOMETRAJE ACTUAL: </h6></div>{{$descarga->kilometrajeNuevo}}  {{$descarga->equipo_kom}}
                                @else
                                    <div class="text-center"><h6 style="font-weight: 1000; ">KILOMETRAJE ACTUAL: </h6></div>No Habia Un Kilometraje Anterior.
                                @endif
                                <div class="text-center"><h6 style="font-weight: 1000;  margin-top: 10px;">OBSERVACIONES: </h6>{{$solicitante['observaciones']}}</div>
                                <br><br>
                                <img width="300px;" src="{{ asset('/img/login/Header3DescargaGrande.svg') }}" alt="" class="mb-2">
                                <div class="text-center"><h6 style="font-weight: 1000;">COSTO DE COMBUSTIBLE:</h6>${{ number_format($ultimaCarga[0]->ultimoPrecio * $descarga->litros, 2) }}</div>
                                <h6 style="font-weight: 1000; ">COSTO DE FLUIDOS: </h6> ${{number_format($totalProductos,2)}}
                                <h6 style="font-weight: 1000; ">TOTAL: ${{number_format(($ultimaCarga[0]->ultimoPrecio*$descarga->litros)+$totalProductos, 2)}}</h6>
                            @endif

                            @if (!empty($descarga->otro))
                                <h6 style="font-weight: 1000;" class="text-center">OTRO: {{ $descarga->otro }} L</h6>
                            @endif
                            
                            @if ($cliente == false)
                                @if ($descarga->tipoCisternaId == null)
                                <p class="pt-5" style="margin-top: 20px; text-align: center;">
                                    ______________________________________<br>
                                    Nombre Y Firma De Recibido<br>
                                    <p class="text-center">:{{$solicitante['nombreSolicitante']}}</p>
                                </p>
                                @endif
                            @endif
                            <!--<div class="text-center"><h6 style="font-weight: 1000; ">HORA DESCARGA: </h6>{{ $descarga->horas }}</div>-->
                            @if ($cliente != false)
                                <br>
                                <img width="300px;" src="{{ asset('/img/login/Header2GenericoGrande.svg') }}" alt="" class="mb-2">
                                {{--  <div class="text-center"><h6 style="font-weight: 1000; ">HORA SALIDA:...</h6>11:00 pm</div>  --}}
                                <br> <br>
                                <div class="text-center"><h6 style="font-weight: 1000;   ">FECHA DE DESCARGA:</h6>{{ \Carbon\Carbon::parse($descarga->fechaLlegada)->format( 'Y-m-d' ) }}</div>
                                <div class="text-center"><h6 style="font-weight: 1000; ">HORA LLEGADA: </h6>{{ \Carbon\Carbon::parse($solicitante['horaLlegada'])->format('h:i A') }}</div>
                                {{--  <div class="text-center"><h6 style="font-weight: 1000; ">HORARIO: </h6>8:00 am - 7:30 pm</div>  --}}
                                {{--  <div class="text-center"><h6 style="font-weight: 1000; ">TOTAL HORAS EXTRAS: </h6>1.30 hrs</div>  --}}
                                {{--  <div class="text-center"><h6 style="font-weight: 1000; ">ODOMETRO CARGA: </h6>125445.5</div>  --}}
                                @if (isset($descarga->odometro))
                                <div class="text-center"><h6 style="font-weight: 1000; ">ODOMETRO SALIDA: </h6></div>{{$descarga->odometro}}  {{$descarga->despachado_kom}}
                                <div class="text-center"><h6 style="font-weight: 1000; ">ODOMETRO LLEGADA: </h6></div>{{$descarga->odometroNuevo}} {{$descarga->despachado_kom}}
                                @endif
                                <br>
                                <div class="text-center"><h6 style="font-weight: 1000; ">KILOMETRAJE SALIDA: </h6>{{$descarga->kilometrajeAnterior}} {{$descarga->equipo_kom}} </div>
                                @if ($descarga->kilometrajeAnterior != null)
                                <div class="text-center"><h6 style="font-weight: 1000; ">KILOMETRAJE LLEGADA: </h6></div>{{$descarga->kilometrajeNuevo}}  {{$descarga->equipo_kom}}
                                @else
                                    <div class="text-center"><h6 style="font-weight: 1000; ">KILOMETRAJE LLEGADA: </h6></div>No Habia Un Kilometraje Anterior.
                                @endif
                                <div class="text-center"><h6 style="font-weight: 1000; ">TOTAL KM/MI: </h6></div>{{$descarga->kilometrajeNuevo-$descarga->kilometrajeAnterior}} {{$descarga->equipo_kom}}
                                
                                <div class="text-center"><h6 style="font-weight: 1000;  margin-top: 10px;">OBSERVACIONES: </h6>{{$solicitante['observaciones']}}</div>
                                @if ($descarga->tipoCisternaId == null)
                                <p class="pt-5" style="margin-top: 20px; text-align: center;">
                                    ______________________________________<br>
                                    Nombre Y Firma De Recibido<br>
                                    <p class="text-center">:{{$solicitante['nombreSolicitante']}}</p>
                                </p>
                                @endif
                                <img width="300px;" src="{{ asset('/img/login/Header3DescargaGrande.svg') }}" alt="" class="mb-2">
                                <div class="text-center"><h6 style="font-weight: 1000; ">COSTO DE TRABAJO:</h6>${{ number_format($solicitante['costoTrabajo'], 2) }}</div>
                                @if ($descarga->tipoCisternaId == null)
                                    <div class="text-center"><h6 style="font-weight: 1000;">COSTO DE COMBUSTIBLE:</h6>${{ number_format($ultimaCargaSinTote->precio * $descarga->litros, 2) }}</div>
                                    <h6 style="font-weight: 1000; ">COSTO DE FLUIDOS: </h6> ${{number_format($totalProductosSinTote, 2)}}
                                    <h6 style="font-weight: 1000; ">TOTAL: ${{number_format(($ultimaCargaSinTote->precio*$descarga->litros)+$solicitante['costoTrabajo']+$totalProductosSinTote, 2)}}</h6>
                                @else
                                    <div class="text-center"><h6 style="font-weight: 1000;">COSTO DE COMBUSTIBLE:</h6>${{ number_format($ultimaCarga[0]->ultimoPrecio * $descarga->litros, 2) }}</div>
                                    <h6 style="font-weight: 1000; ">COSTO DE FLUIDOS: </h6> ${{number_format($totalProductos,2)}}
                                    <h6 style="font-weight: 1000; ">TOTAL: ${{number_format(($ultimaCarga[0]->ultimoPrecio*$descarga->litros)+$solicitante['costoTrabajo']+$totalProductos, 2)}}</h6>
                                @endif
                            @endif
                            <br>
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
            margin-bottom: 0mm;
            margin-top: 0mm;
        }
        body {
            margin-top: -115mm !important;
            padding: 0 !important;
        }
    }
    #print-content {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        text-align: left !important;
        font-family: Arial, sans-serif;
        padding-top: 15px;
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
        align-items: center;
    }
</style>
@endsection
