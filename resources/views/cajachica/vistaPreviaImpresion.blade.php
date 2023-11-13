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
                    {{--  <div id="print-header" class="print-header">
                        <div class="row">
                            <div class="col-4 text-start">
                                <img src="{{ asset('/img/maquinariaPrint/Logo q2cem_1.svg') }}" alt="" width="80px;" class="mb-2">    
                            </div>
                            <div class="col-4 text-center">
                                <img src="{{ asset('/img/maquinariaPrint/Maquinaria.svg') }}" alt="" width="290px;" class="mt-2">    
                            </div>
                            
                            <div class="col-4 text-end">
                                <img src="{{ asset('/img/maquinariaPrint/Logo q2ces_1.svg') }}" alt="" width="80px;" class="mb-2">    
                            </div>
                        </div>
                    </div>  --}}
                    {{--  <div id="content-center" class="content-center" style="display: none">
                        <img src="{{ asset('/img/maquinariaPrint/Q de fondo.svg') }}" width="70%" alt="">    
                    </div>  --}}
                    <div id="print-content" class="print-content d-flex align-items-center">
                        <div class="table-responsive" style="font-size: 8px">
                            <div class="row mb-2">
                                <div class="col-4 text-start">
                                    <img src="{{ asset('/img/maquinariaPrint/Logo q2cem_1.svg') }}" alt="" width="75px;" class="mt-1">    
                                </div>
                                <div class="col-4 text-center">
                                    <img src="{{ asset('/img/maquinariaPrint/Caja Chica_1.svg') }}" alt="" width="245px;" class="mt-2" style="margin-right: 355px">    
                                </div>
                                
                                <div class="col-4 text-end">
                                    <img src="{{ asset('/img/maquinariaPrint/Logo q2ces_2.svg') }}" alt="" width="75px;" class="mt-1" style="margin-right: 8px">    
                                </div>
                            </div>
                            <table>
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
                                        <td style="color: #5c7c26;">
                                            <div style="margin-right: 15px !important;border-radius: 1em; border-color: black;
                                            border-width: 1px;
                                            border-style: solid; height: 35px;" class="d-flex justify-content-center align-items-center">{{ \Carbon\Carbon::parse($inicioSemana)->locale('es')->isoFormat('dddd D MMMM') }}
                                            al
                                            {{ \Carbon\Carbon::parse($finSemana)->locale('es')->isoFormat('dddd D MMMM') }}</div>
                                        </td>
                                        <td style="color: #7f7f7f; font-weight: bold">
                                            @if ($saldoFormatted === '0')
                                                
                                            @else
                                                <div style="margin-right: 15px !important;border-radius: 1em; border-color: black;
                                                border-width: 1px;
                                                border-style: solid; height: 35px;" class="d-flex justify-content-center align-items-center">${{ $saldoFormatted }}</div>    
                                            @endif
                                            
                                        </td>
                                        <td style="color: #198754; font-weight: bold">
                                            <div style="margin-right: 15px !important;border-radius: 1em; border-color: black;
                                            border-width: 1px;
                                            border-style: solid; height: 35px;" class="d-flex justify-content-center align-items-center">${{ $ingresoFormatted }}</div>
                                        </td>
                                        <td style="color: #dc3545; font-weight: bold">
                                            <div style="margin-right: 15px !important;border-radius: 1em; border-color: black;
                                            border-width: 1px;
                                            border-style: solid; height: 35px;" class="d-flex justify-content-center align-items-center">${{ $egresoFormatted }}</div>
                                        </td>
                                        <td style="color: #657c26; font-weight: bold">
                                            @if ($saldo === '0')
                                                
                                            @else
                                                <div style="margin-right: 5px !important; border-radius: 1em; border-color: black;
                                                border-width: 1px;
                                                border-style: solid; height: 35px;" class="d-flex justify-content-center align-items-center">${{ $saldo }}</div>    
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="mt-4">
                                <thead class="labelTitulo">
                                    <th class="labelTitulo text-center" style="height: 35px;">
                                        <div class="d-flex justify-content-center align-items-center" style="margin-right: 5px !important;font-size:14px !important; border-radius: 2em; background-color: var(--select); color: #fff; height: 35px;">Día </div></th>
                                    <th class="labelTitulo text-center" style="height: 35px; width: 200px;"> 
                                        <div class="d-flex justify-content-center align-items-center" style="margin-right: 5px !important;font-size:14px !important; border-radius: 2em; background-color: var(--select); color: #fff; height: 35px;">Concepto </div></th>
                                    <th class="labelTitulo text-center" style="height: 35px;"> 
                                        <div class="d-flex justify-content-center align-items-center" style="margin-right: 5px !important;font-size:14px !important; border-radius: 2em; background-color: var(--select); color: #fff; height: 35px;">Nota </div></th>
                                    <th class="labelTitulo text-center" style="height: 35px;"> 
                                        <div class="d-flex justify-content-center align-items-center" style="margin-right: 5px !important;font-size:14px !important; border-radius: 2em; background-color: var(--select); color: #fff; height: 35px;">Cliente </div></th>
                                    <th class="labelTitulo text-center" style="height: 35px;">
                                        <div class="d-flex justify-content-center align-items-center" style="margin-right: 5px !important;font-size:14px !important; border-radius: 2em; background-color: var(--select); color: #fff; height: 35px;">Obra </div></th>
                                    <th class="labelTitulo text-center" style=" height: 35px;"> 
                                        <div class="d-flex justify-content-center align-items-center" style="margin-right: 5px !important;font-size:14px !important; border-radius: 2em; background-color: var(--select); color: #fff; height: 35px;">Equipo </div></th>
                                        <th class="labelTitulo text-center" style="height: 35px; width: 150px;">
                                            <div class="d-flex justify-content-center align-items-center" style="margin-right: 5px !important;font-size:14px !important; border-radius: 2em; background-color: var(--select); color: #fff; height: 35px;">Personal </div></th>
                                        <th class="labelTitulo text-center" style=" height: 35px; width: 150px;"> 
                                            <div class="d-flex justify-content-center align-items-center" style="margin-right: 5px !important;font-size:14px !important; border-radius: 2em; background-color: var(--select); color: #fff; height: 35px;">Cantidad </div></th>
                                </thead>
                                
                                <tbody>
                                    @forelse ($registros as $key => $registro)
                                    @if ($key == 16 || $key == 35 || $key == 54 || $key == 73 || $key == 92 || $key == 111 || $key == 130 || $key == 149 || $key == 168 || $key == 187)
                                        <tr><td id="columnaInvisible" style="visibility: hidden">HDJ</td></tr>
                                        <tr><td id="columnaInvisible2" style="visibility: hidden">HDJ</td></tr>
                                        <tr><td id="columnaInvisible2" style="visibility: hidden">HDJ</td></tr>
                                    @endif
                                        <tr>
                                            <td style="">
                                                @if ($registro->dia)
                                                <div style="margin-right: 5px !important;border-radius: 1em; border-color: black;
                                                border-width: 1px;
                                                border-style: solid; height: 45px;" class="d-flex justify-content-center align-items-center">{{ \Carbon\Carbon::parse($registro->dia)->locale('es')->isoFormat('dddd D MMMM') }}</div>
                                            @else
                                                <div style="border-radius: 1em; border-color: black; margin-right: 5px !important;
                                                border-width: 1px;
                                                border-style: solid; height: 45px;" class="d-flex justify-content-center align-items-center"> - </div>
                                            @endif
                                            </td>
                                            <td style="">
                                                @if ($registro->cnombre)
                                                <div style="margin-right: 5px !important;border-radius: 1em; border-color: black;
                                                border-width: 1px;
                                                border-style: solid; height: 45px;" class="d-flex justify-content-center align-items-center">{{ $registro->cnombre }}</div>
                                            @else
                                                <div style="border-radius: 1em; border-color: black; margin-right: 5px !important;
                                                border-width: 1px;
                                                border-style: solid; height: 45px;" class="d-flex justify-content-center align-items-center"> - </div>
                                            @endif
                                            </td>
                                            <td style="">
                                                @if ($registro->comprobante && $registro->comprobante)
                                                <div style="margin-right: 5px !important;border-radius: 1em; border-color: black;
                                                border-width: 1px;
                                                border-style: solid; height: 45px;" class="d-flex justify-content-center align-items-center">{{ $registro->comprobante ? $registro->comprobante : '---' }}
                                                <br>
                                                {{ $registro->ncomprobante }}</div>
                                            @else
                                                <div style="border-radius: 1em; border-color: black; margin-right: 5px !important;
                                                border-width: 1px;
                                                border-style: solid; height: 45px;" class="d-flex justify-content-center align-items-center"> - </div>
                                            @endif
                                            </td>
                                            <td style="">
                                                @if ($registro->cliente)
                                                <div style="margin-right: 5px !important;border-radius: 1em; border-color: black;
                                                border-width: 1px;
                                                border-style: solid; height: 45px;" class="d-flex justify-content-center align-items-center">{{ $registro->cliente }}</div>
                                            @else
                                                <div style="border-radius: 1em; border-color: black; margin-right: 5px !important;
                                                border-width: 1px;
                                                border-style: solid; height: 45px;" class="d-flex justify-content-center align-items-center"> - </div>
                                            @endif
                                            </td>
                                            <td style="">
                                                @if ($registro->obra)
                                                <div style="margin-right: 5px !important;border-radius: 1em; border-color: black;
                                                border-width: 1px;
                                                border-style: solid; height: 45px;" class="d-flex justify-content-center align-items-center">{{ $registro->obra }}</div>
                                            @else
                                                <div style="border-radius: 1em; border-color: black; margin-right: 5px !important;
                                                border-width: 1px;
                                                border-style: solid; height: 45px;" class="d-flex justify-content-center align-items-center"> - </div>
                                            @endif
                                            </td>
                                            <td style="">
                                                @if ($registro->identificador && $registro->maquinaria)
                                                <div style="margin-right: 5px !important;border-radius: 1em; border-color: black;
                                                border-width: 1px;
                                                border-style: solid; height: 45px;" class="d-flex justify-content-center align-items-center">{{ $registro->identificador }}</div>
                                            @else
                                                <div style="border-radius: 1em; border-color: black; margin-right: 5px !important;
                                                border-width: 1px;
                                                border-style: solid; height: 45px;" class="d-flex justify-content-center align-items-center"> - </div>
                                            @endif
                                            </td>
                                            <td style="">
                                                @if ($registro->pnombre && $registro->pnombre && $registro->papellidoP )
                                                <div style="margin-right: 5px !important;border-radius: 1em; border-color: black;
                                                border-width: 1px;
                                                border-style: solid; height: 45px;" class="d-flex justify-content-center align-items-center">{{ $registro->pnombre ? $registro->pnombre : '---' }}
                                                {{ $registro->papellidoP }}</div>
                                            @else
                                                <div style="border-radius: 1em; border-color: black; margin-right: 5px !important;
                                                border-width: 1px;
                                                border-style: solid; height: 45px;" class="d-flex justify-content-center align-items-center"> - </div>
                                            @endif
                                            </td>

                                            <td class=@switch($registro->tipo)
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
                                                border-style: solid; height: 45px;" class="d-flex justify-content-center align-items-center">$ {{ number_format($registro->cantidad, 2) }}</div></td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="2">Sin Registros.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            
                        </div>
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
            bottom: 7.2mm;
            left: 3mm;
            right: 1mm;
            text-align: center;
            height: 0mm; /* Altura fija para el footer */
            margin-top: 6mm;
        }
        table {
            boder: none;
          }
        #print-footer, #print-footer * {
            visibility: visible !important;
        }
        .print-header {
            position: fixed;
            top: 6mm;
            left: 5mm;
            right: 5mm;
            text-align: center;
        }
        #print-header, #print-header * {
            visibility: visible !important;
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
        @page {
            size: letter;
            margin-bottom: 39px;
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
