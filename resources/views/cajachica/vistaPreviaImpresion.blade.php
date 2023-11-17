@extends('layouts.main', ['activePage' => 'inventario', 'titlePage' => __('Inventario')])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card" >
                    <div class="card-header bacTituloPrincipal">
                        {{-- <p class="card-category">Usuarios registrados</p> --}}
                        Vista Previa de Impresion de Caja Chica
                    </div>
                    <div class="card-body">
                        <div class="row divBorder">
                            <div class="col-6 text-right">
                                <button class="btn regresar" onclick="goBack()">
                                    <span class="material-icons">
                                        reply
                                    </span>
                                    Regresar
                                </button>
                            </div>

                            <div class="col-6 pb-3 text-end">
                                @can('inventario_create')
                                    <button type="button" onclick="print()" class="btn botonGral text-capitalize">Volver A Imprimir</button>
                                @endcan
                            </div>
                        </div>
                    </div>

                    <div id="content-center" class="content-center" style="display: none">
                        <img src="{{ asset('/img/maquinariaPrint/Q de fondo.svg') }}" width="70%" alt="">    
                    </div>
                        
                    <div id="print-content" class="print-content d-flex align-items-center">
                        <div class="table-responsive" style="font-size: 8px">
                            
                            <div id="print-header" class="print-header">
                                <div class="row">
                                    <div class="col-4 text-start">
                                        <img src="{{ asset('/img/maquinariaPrint/Logo q2cem_1.svg') }}" alt="" width="75px;" class="mt-1">    
                                    </div>
                                    <div class="col-4 text-center">
                                        <img src="{{ asset('/img/maquinariaPrint/Caja Chica_1.svg') }}" alt="" width="230px; margin-top: 3px" class="mt-2" style="margin-right: 355px">    
                                    </div>
                                    
                                    <div class="col-4 text-end">
                                        <img src="{{ asset('/img/maquinariaPrint/Logo q2ces_2.svg') }}" alt="" width="75px;" class="mt-1" style="margin-right: 8px">    
                                    </div>
                                </div>      
                            </div>
                            
                            <table style="margin-top: 65px">
                                
                                <thead class="labelTitulo">
                                    <th class="labelTitulo text-center" style="height: 35px; width: 400px;">
                                        <div class="d-flex justify-content-center align-items-center" style="margin-right: 15px !important;font-size:14px !important; border-radius: 2em; background-color: var(--select); color: #fff; height: 35px;">Período: </div></th>
                                    <th class="labelTitulo text-center" style="height: 35px; width: 150px;"> 
                                        @if ($saldoFormatted === '0')
                                        @else
                                        <div class="d-flex justify-content-center align-items-center" style="margin-right: 15px !important;font-size:14px !important; border-radius: 2em; background-color: var(--select); color: #fff; height: 35px;">Semana Pasada </div>
                                        @endif
                                        </th>
                                    <th class="labelTitulo text-center" style="height: 35px; width: 150px;"> 
                                        <div class="d-flex justify-content-center align-items-center" style="margin-right: 15px !important;font-size:14px !important; border-radius: 2em; background-color: var(--select); color: #fff; height: 35px;">Ingreso </div></th>
                                    <th class="labelTitulo text-center" style="height: 35px; width: 150px;"> 
                                        <div class="d-flex justify-content-center align-items-center" style="margin-right: 15px !important;font-size:14px !important; border-radius: 2em; background-color: var(--select); color: #fff; height: 35px;">Egreso </div></th>
                                    <th class="labelTitulo text-center" style="height: 35px; width: 150px;">
                                        @if ($saldo === '0')
                                        @else
                                        <div class="d-flex justify-content-center align-items-center" style="margin-right: 5px !important; font-size:14px !important; border-radius: 2em; background-color: var(--select); color: #fff; height: 35px;">Saldo </div>
                                        @endif
                                        </th>
                                </thead>
                                
                                <tbody>
                                    <tr>
                                        <td style="color: #5c7c26; font-weight: bold">
                                            <div style="margin-right: 15px !important;border-radius: 1em; border-color: black;
                                            border-width: 1px;
                                            border-style: solid; height: 25px; font-size:10px" class="d-flex justify-content-center align-items-center">{{ \Carbon\Carbon::parse($inicioSemana)->locale('es')->isoFormat('dddd D MMMM') }}
                                            al
                                            {{ \Carbon\Carbon::parse($finSemana)->locale('es')->isoFormat('dddd D MMMM') }}</div>
                                        </td>
                                        <td style="color: #7f7f7f; font-weight: bold">
                                            @if ($saldoFormatted === '0')
                                                
                                            @else
                                                <div style="margin-right: 15px !important;border-radius: 1em; border-color: black;
                                                border-width: 1px; font-size: 12px !important;
                                                border-style: solid; height: 25px;" class="d-flex justify-content-center align-items-center">${{ $saldoFormatted }}</div>    
                                            @endif
                                            
                                        </td>
                                        <td style="color: #198754; font-weight: bold">
                                            <div style="margin-right: 15px !important;border-radius: 1em; border-color: black; font-size: 12px !important;
                                            border-width: 1px;
                                            border-style: solid; height: 25px;" class="d-flex justify-content-center align-items-center">${{ $ingresoFormatted }}</div>
                                        </td>
                                        <td style="color: #dc3545; font-weight: bold">
                                            <div style="margin-right: 15px !important;border-radius: 1em; border-color: black; font-size: 12px !important;
                                            border-width: 1px;
                                            border-style: solid; height: 25px;" class="d-flex justify-content-center align-items-center">${{ $egresoFormatted }}</div>
                                        </td>
                                        <td style="color: #657c26; font-weight: bold">
                                            @if ($saldo === '0')
                                                
                                            @else
                                                <div style="margin-right: 5px !important; border-radius: 1em; border-color: black; font-size: 12px !important;
                                                border-width: 1px;
                                                border-style: solid; height: 25px;" class="d-flex justify-content-center align-items-center">${{ $saldo }}</div>    
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="mt-3">
                                <thead class="labelTitulo">
                                    <th class="labelTitulo text-center" style="height: 25px;">
                                        <div class="d-flex justify-content-center align-items-center" style="margin-right: 5px !important;font-size:14px !important; border-radius: 2em; background-color: var(--select); color: #fff; height: 25px;">Día </div></th>
                                    <th class="labelTitulo text-center" style="height: 25px; width: 200px;"> 
                                        <div class="d-flex justify-content-center align-items-center" style="margin-right: 5px !important;font-size:14px !important; border-radius: 2em; background-color: var(--select); color: #fff; height: 25px;">Concepto </div></th>
                                    <th class="labelTitulo text-center" style="height: 25px;"> 
                                        <div class="d-flex justify-content-center align-items-center" style="margin-right: 5px !important;font-size:14px !important; border-radius: 2em; background-color: var(--select); color: #fff; height: 25px;">Nota </div></th>
                                    <th class="labelTitulo text-center" style="height: 25px;"> 
                                        <div class="d-flex justify-content-center align-items-center" style="margin-right: 5px !important;font-size:14px !important; border-radius: 2em; background-color: var(--select); color: #fff; height: 25px;">Cliente </div></th>
                                    <th class="labelTitulo text-center" style="height: 25px;">
                                        <div class="d-flex justify-content-center align-items-center" style="margin-right: 5px !important;font-size:14px !important; border-radius: 2em; background-color: var(--select); color: #fff; height: 25px;">Obra </div></th>
                                    <th class="labelTitulo text-center" style=" height: 25px;"> 
                                        <div class="d-flex justify-content-center align-items-center" style="margin-right: 5px !important;font-size:14px !important; border-radius: 2em; background-color: var(--select); color: #fff; height: 25px;">Equipo </div></th>
                                    <th class="labelTitulo text-center" style="height: 25px; width: 150px;">
                                        <div class="d-flex justify-content-center align-items-center" style="margin-right: 5px !important;font-size:14px !important; border-radius: 2em; background-color: var(--select); color: #fff; height: 25px;">Personal </div></th>
                                    <th class="labelTitulo text-center" style=" height: 25px; width: 150px;"> 
                                        <div class="d-flex justify-content-center align-items-center" style="margin-right: 5px !important;font-size:14px !important; border-radius: 2em; background-color: var(--select); color: #fff; height: 25px;">Cantidad </div></th>
                                </thead>
                                
                                <tbody>
                                    @php
                                        $totalRegistros = count($registros) - 1;
                                    @endphp
                                    @forelse ($registros as $key => $registro)
                                    @if ($key == $totalRegistros)
                                    
                                    <style>
                                        /* Estilos para la última página al imprimir */
                                        @media print {
                                            .print-content {
                                                margin-bottom: -40mm !important;
                                            }
                                        }

                                    </style>
                                    
                                    @endif
                                    
                                    @if ($key == 21 || $key == 44 || $key == 67 || $key == 90 || $key == 113 || $key == 136 || $key == 159 || $key == 182 || $key == 205 || $key == 228 || $key == 251 || $key == 274 || $key == 297 || $key == 320 || $key == 343 || $key == 366 || $key == 389 || $key == 412)
                                            
                                        </tbody>
                                    </table>
                                    <div class="page mt-1" style="margin-left: 90mm; font-weight: 500 !important; font-size: 14px !important; border-radius: 2em; background-color: #f7c90d; color: var(--select); height: 20px;" ></div>
                                        <br><br><br><br>
                                        <br>
                                        
                                    @endif
                                    @if ($key == 21 || $key == 44 || $key == 67 || $key == 90 || $key == 113 || $key == 136 || $key == 159 || $key == 182 || $key == 205 || $key == 228 || $key == 251 || $key == 274 || $key == 297 || $key == 320 || $key == 343 || $key == 366 || $key == 389 || $key == 412)
                                    <table class="mt-3">
                                                <thead class="labelTitulo">
                                                    <th class="labelTitulo text-center" style="height: 25px;">
                                                        <div class="d-flex justify-content-center align-items-center" style="margin-right: 5px !important;font-size:14px !important; border-radius: 2em; background-color: var(--select); color: #fff; height: 25px;">Día</div></th>
                                                    <th class="labelTitulo text-center" style="height: 25px; width: 200px;"> 
                                                        <div class="d-flex justify-content-center align-items-center" style="margin-right: 5px !important;font-size:14px !important; border-radius: 2em; background-color: var(--select); color: #fff; height: 25px;">Concepto </div></th>
                                                    <th class="labelTitulo text-center" style="height: 25px;">
                                                        <div class="d-flex justify-content-center align-items-center" style="margin-right: 5px !important;font-size:14px !important; border-radius: 2em; background-color: var(--select); color: #fff; height: 25px;">Nota </div></th>
                                                    <th class="labelTitulo text-center" style="height: 25px;"> 
                                                        <div class="d-flex justify-content-center align-items-center" style="margin-right: 5px !important;font-size:14px !important; border-radius: 2em; background-color: var(--select); color: #fff; height: 25px;">Cliente </div></th>
                                                    <th class="labelTitulo text-center" style="height: 25px;">
                                                        <div class="d-flex justify-content-center align-items-center" style="margin-right: 5px !important;font-size:14px !important; border-radius: 2em; background-color: var(--select); color: #fff; height: 25px;">Obra </div></th>
                                                    <th class="labelTitulo text-center" style=" height: 25px;"> 
                                                        <div class="d-flex justify-content-center align-items-center" style="margin-right: 5px !important;font-size:14px !important; border-radius: 2em; background-color: var(--select); color: #fff; height: 25px;">Equipo </div></th>
                                                    <th class="labelTitulo text-center" style="height: 25px; width: 150px;">
                                                        <div class="d-flex justify-content-center align-items-center" style="margin-right: 5px !important;font-size:14px !important; border-radius: 2em; background-color: var(--select); color: #fff; height: 25px;">Personal </div></th>
                                                    <th class="labelTitulo text-center" style=" height: 25px; width: 150px;"> 
                                                        <div class="d-flex justify-content-center align-items-center" style="margin-right: 5px !important;font-size:14px !important; border-radius: 2em; background-color: var(--select); color: #fff; height: 25px;">Cantidad </div></th>
                                                        
                                                </thead>
                                                
                                        <tbody>
                                            
                                    @endif
                                        <tr>
                                            <td style="">
                                                @if ($registro->dia)
                                                <div style="margin-right: 5px !important;border-radius: 1em; border-color: black;
                                                border-width: 1px;
                                                border-style: solid; height: 31px; margin-top: 3px" class="d-flex justify-content-center align-items-center">{{ \Carbon\Carbon::parse($registro->dia)->locale('es')->isoFormat('dddd D MMMM') }} {{$key}}</div>
                                            @else
                                                <div style="border-radius: 1em; border-color: black; margin-right: 5px !important;
                                                border-width: 1px;
                                                border-style: solid; height: 31px; margin-top: 3px" class="d-flex justify-content-center align-items-center"> - </div>
                                            @endif
                                            </td>
                                            <td style="">
                                                @if ($registro->cnombre)
                                                <div style="margin-right: 5px !important;border-radius: 1em; border-color: black;
                                                border-width: 1px;
                                                border-style: solid; height: 31px; margin-top: 3px" class="d-flex justify-content-center align-items-center">{{ $registro->cnombre }}</div>
                                            @else
                                                <div style="border-radius: 1em; border-color: black; margin-right: 5px !important;
                                                border-width: 1px;
                                                border-style: solid; height: 31px; margin-top: 3px" class="d-flex justify-content-center align-items-center"> - </div>
                                            @endif
                                            </td>
                                            <td style="">
                                                @if ($registro->comprobante && $registro->comprobante)
                                                <div style="margin-right: 5px !important;border-radius: 1em; border-color: black;
                                                border-width: 1px;
                                                border-style: solid; height: 31px; margin-top: 3px" class="d-flex justify-content-center align-items-center">{{ $registro->comprobante ? $registro->comprobante : '---' }}
                                                <br>
                                                {{ $registro->ncomprobante }}</div>
                                            @else
                                                <div style="border-radius: 1em; border-color: black; margin-right: 5px !important;
                                                border-width: 1px;
                                                border-style: solid; height: 31px; margin-top: 3px" class="d-flex justify-content-center align-items-center"> - </div>
                                            @endif
                                            </td>
                                            <td style="">
                                                @if ($registro->cliente)
                                                <div style="margin-right: 5px !important;border-radius: 1em; border-color: black;
                                                border-width: 1px;
                                                border-style: solid; height: 31px; margin-top: 3px" class="d-flex justify-content-center align-items-center">{{ $registro->cliente }}</div>
                                            @else
                                                <div style="border-radius: 1em; border-color: black; margin-right: 5px !important;
                                                border-width: 1px;
                                                border-style: solid; height: 31px; margin-top: 3px" class="d-flex justify-content-center align-items-center"> - </div>
                                            @endif
                                            </td>
                                            <td style="">
                                                @if ($registro->obra)
                                                <div style="margin-right: 5px !important;border-radius: 1em; border-color: black;
                                                border-width: 1px;
                                                border-style: solid; height: 31px; margin-top: 3px" class="d-flex justify-content-center align-items-center">{{ $registro->obra }}</div>
                                            @else
                                                <div style="border-radius: 1em; border-color: black; margin-right: 5px !important;
                                                border-width: 1px;
                                                border-style: solid; height: 31px; margin-top: 3px" class="d-flex justify-content-center align-items-center"> - </div>
                                            @endif
                                            </td>
                                            <td style="">
                                                @if ($registro->identificador && $registro->maquinaria)
                                                <div style="margin-right: 5px !important;border-radius: 1em; border-color: black;
                                                border-width: 1px;
                                                border-style: solid; height: 31px; margin-top: 3px" class="d-flex justify-content-center align-items-center">{{ $registro->identificador }}</div>
                                            @else
                                                <div style="border-radius: 1em; border-color: black; margin-right: 5px !important;
                                                border-width: 1px;
                                                border-style: solid; height: 31px; margin-top: 3px" class="d-flex justify-content-center align-items-center"> - </div>
                                            @endif
                                            </td>
                                            <td style="">
                                                @if ($registro->pnombre && $registro->pnombre && $registro->papellidoP )
                                                <div style="margin-right: 5px !important;border-radius: 1em; border-color: black;
                                                border-width: 1px;
                                                border-style: solid; height: 31px; margin-top: 3px" class="d-flex justify-content-center align-items-center">{{ $registro->pnombre ? $registro->pnombre : '---' }}
                                                {{ $registro->papellidoP }}</div>
                                            @else
                                                <div style="border-radius: 1em; border-color: black; margin-right: 5px !important;
                                                border-width: 1px;
                                                border-style: solid; height: 31px; margin-top: 3px" class="d-flex justify-content-center align-items-center"> - </div>
                                            @endif
                                            </td>

                                            <td style="font-size: 12px" class=@switch($registro->tipo)
                                                @case(1)
                                                    'green'
                                                @break

                                                @case(2)
                                                    'red'
                                                @break

                                                @case(3)
                                                    'blue'
                                                @break

                                                @default
                                                    ''
                                            @endswitch
                                                title=@switch($registro->tipo)
                                                @case(1)
                                                    'Ingreso'
                                                @break

                                                @case(2)
                                                    'Egreso'
                                                @break

                                                @case(3)
                                                    'Ingreso de servicios'
                                                @break

                                                @case(4)
                                                    'Pendiente de Cobro Y/O factura'
                                                @break

                                                @default
                                            @endswitch>
                                                <div style="margin-right: 5px !important;border-radius: 1em; border-color: black;
                                                border-width: 1px;
                                                border-style: solid; height: 31px; margin-top: 3px" class="d-flex justify-content-center align-items-center">$ {{ number_format($registro->cantidad, 2) }}</div></td>
                                        </tr>
                                        
                                    @empty
                                        <tr>
                                            <td colspan="2">Sin Registros.</td>
                                        </tr>
                                    @endforelse
                                    @php
                                        $numeroTotal = $totalRegistros;
                                        $numeroACaber = 23;

                                        $vecesQueCabe = floor($numeroTotal / $numeroACaber);
                                        $faltante = $numeroACaber - ($numeroTotal % $numeroACaber);
                                        $var = ($numeroTotal % $numeroACaber);
                                        $faltante -= 3;
                                        if ($faltante == -2)
                                            $faltante = 22;
                                        if ($faltante == -1)
                                            $faltante = 23;
                                    @endphp
                                    
                                </tbody>
                            </table>
                            
                        </div>
                        
                        @for ($i = 0; $i <$faltante; $i++)
                                    <tr>
                                        <div style="border-radius: 1em; border-color: white; color: white; margin-right: 5px !important;
                                                border-width: 1px;
                                                border-style: solid; height: 31px; margin-top: 3px; visibility: hidden" class="d-flex justify-content-center align-items-center"> - </div>
                                    </tr>
                                    @endfor
                        @if ($key == $totalRegistros)
                        {{--  <div>{{$var}}, Total:{{$numeroTotal}}Faltantes: {{$faltante}}</div>  --}}
                            <div class="page mt-1" id="ultimoNumPage" style="font-weight: 500 !important; font-size: 14px !important; border-radius: 2em; background-color: #f7c90d; color: var(--select); height: 20px; "></div>
                        @endif
                    </div>
                    
                    <br>
                    <div id="print-footer" class="print-footer">
                        <img src="{{ asset('/img/maquinariaPrint/Pie de página_1.svg') }}">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function goBack() {
        window.history.back();
    }
  
</script>
<script>
        // Detectar cuándo se está imprimiendo
        window.onbeforeprint = function() {
            document.getElementById('ultimoNumPage').style.display = 'block';
        };
    
        // Ocultar el pie de página después de la impresión
        window.onafterprint = function() {
            document.getElementById('ultimoNumPage').style.display = 'none';
        };
    
</script>
<script>
    print(){
        window.print();
    }
</script>
<style>
    ::-webkit-scrollbar {
        display: none;
    }
    .centered-text {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 50%;
    }
</style>

<style>
    .page-break {
        page-break-after: always;
    }
    
</style>
<script>
    const totalPages = document.querySelectorAll('.page').length;
    document.documentElement.style.setProperty('--total-pages', totalPages);
</script>
<style>
    :root {
        --total-pages: 0;
      }
      
      html {
        box-sizing: border-box;
      }
      
      body {
        counter-reset: page-counter 0 total-pages var(--total-pages);
      }
      
      .page {

        min-height: 10px;
        width: 8vw;
        margin-bottom:1rem;
        bottom: 7.2mm;
        left: 3mm;
        right: 1mm;
        display: block;
      }
      
      .page::before {
        counter-increment: page-counter 1;
        content: counter(page-counter) " de " counter(total-pages);
      }
</style>
    
<style>
    @media print {
        body * {
            visibility: hidden;
        }
        #print-content * {
            visibility: visible !important;
        }
        #columnaInvisible {
            visibility: hidden !important;
        }
        #columnaInvisible2 {
            visibility: hidden !important;
        }
        #print-content, #print-content {
            margin-left: -6mm;
            margin-right: -10mm;
        }
        #print-footer {
            position: fixed;
            bottom: 6.9mm;
            left: 3mm;
            right: 1mm;
            text-align: center;
            height: 0mm; /* Altura fija para el footer */
            margin-top: 8mm;
        }
        table {
            boder: none;
          }
        #print-footer, #print-footer * {
            visibility: visible !important;
        }
        .print-header {
            position: fixed;
            text-align: center;
        }
        #print-header, #print-header * {
            visibility: visible !important;
        }
        #ultimoNumPage{
            
            
            {{--  top: 15.9mm !important;  --}}
            {{--  left: 3mm !important;  --}}
            {{--  right: 1mm !important;  --}}
        }
        .content-center {
            position: fixed;
            top: 50%;
            left: 0;
            right: 0;
            transform: translateY(-50%);
            text-align: center;
        }
        #content-center, #content-center * {
            visibility: visible !important;
            display: inline-block !important;
        }
        
        body {
            margin-top: -65mm !important;
            padding: 0 !important;
        }
    }

    #print-content {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        text-align: center !important;
        font-family: 'Montserrat', sans-serif !important;
        align-items: start;
    }

    #main {
        margin-top: 80px !important;
    }
</style>

@endsection