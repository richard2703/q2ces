@extends('layouts.main', ['activePage' => 'inventario', 'titlePage' => __('Inventario')])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card" >
                    <div class="card-header bacTituloPrincipal">
                        {{-- <p class="card-category">Usuarios registrados</p> --}}
                        Vista Previa de Impresion de Maquinaria
                    </div>
                    <div class="card-body">
                        <div class="row divBorder">

                            <div class="col-6 text-right">
                                    
                                <a href="{{ route('maquinaria.index') }}">
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
                        <div class="table-responsive" style="font-size: 12px">
                            <div class="row mb-2">
                                <div class="col-4 text-start">
                                    <img src="{{ asset('/img/maquinariaPrint/Logo q2cem_1.svg') }}" alt="" width="75px;" class="mt-1">    
                                </div>
                                <div class="col-4 text-center">
                                    <img src="{{ asset('/img/maquinariaPrint/Maquinaria-01.png') }}" alt="" width="245px;" class="mt-2" style="margin-right: 355px">    
                                </div>
                                
                                <div class="col-4 text-end">
                                    <img src="{{ asset('/img/maquinariaPrint/Logo q2ces_2.svg') }}" alt="" width="75px;" class="mt-1" style="margin-right: 8px">    
                                </div>
                            </div>
                            <table>
                                <thead class="labelTitulo">
                                    <th class="labelTitulo text-center" style="height: 35px;">
                                        <div class="d-flex justify-content-center align-items-center" style="margin-right: 5px !important;font-size:14px !important; border-radius: 2em; background-color: var(--select); color: #fff; height: 35px;">ID </div></th>
                                    <th class="labelTitulo text-center" style="height: 35px; width: 300px;"> 
                                        <div class="d-flex justify-content-center align-items-center" style="margin-right: 5px !important;font-size:14px !important; border-radius: 2em; background-color: var(--select); color: #fff; height: 35px;">Equipo </div></th>
                                    <th class="labelTitulo text-center" style="height: 35px; width: 160px;"> 
                                        <div class="d-flex justify-content-center align-items-center" style="margin-right: 5px !important;font-size:14px !important; border-radius: 2em; background-color: var(--select); color: #fff; height: 35px;">Modelo </div></th>
                                    <th class="labelTitulo text-center" style="height: 35px; width: 170px;"> 
                                        <div class="d-flex justify-content-center align-items-center" style="margin-right: 5px !important;font-size:14px !important; border-radius: 2em; background-color: var(--select); color: #fff; height: 35px;">Serie - VIN</div></th>
                                    <th class="labelTitulo text-center" style="height: 35px; width: 120px;">
                                        <div class="d-flex justify-content-center align-items-center" style="margin-right: 5px !important;font-size:14px !important; border-radius: 2em; background-color: var(--select); color: #fff; height: 35px;">Placas </div></th>
                                    <th class="labelTitulo text-center" style=" height: 35px;"> 
                                        <div class="d-flex justify-content-center align-items-center" style="margin-right: 5px !important;font-size:14px !important; border-radius: 2em; background-color: var(--select); color: #fff; height: 35px;">Año </div></th>
                                </thead>
                                
                                <tbody>
                                    @forelse ($maquinaria as $key => $maquina)
                                    @if ($key == 23 || $key == 47 || $key == 71 || $key == 95)
                                        <tr><td id="columnaInvisible" style="visibility: hidden">HDJ</td></tr>
                                        <tr><td id="columnaInvisible2" style="visibility: hidden">HDJ</td></tr>
                                    @endif
                                        <tr>
                                            <td style="">
                                                @if ($maquina->identificador)
                                                <a
                                                    href="{{ route('maquinaria.vista', $maquina->id) }}"  title="Editar la información de la maquinaría."
                                                    style="color: blue "><div style="margin-right: 5px !important;border-radius: 1em; border-color: black;
                                                    border-width: 1px;
                                                    border-style: solid; height: 35px;" class="d-flex justify-content-center align-items-center">{{ $maquina->identificador }}</div></a>
                                            @else
                                                <div style="border-radius: 1em; border-color: black; margin-right: 5px !important;
                                                border-width: 1px;
                                                border-style: solid; height: 35px;" class="d-flex justify-content-center align-items-center"> - </div>
                                            @endif
                                            </td>
                                            <td style="">
                                                @if ($maquina->nombre)
                                                <div style="margin-right: 5px !important;border-radius: 1em; border-color: black;
                                                border-width: 1px;
                                                border-style: solid; height: 35px;" class="d-flex justify-content-center align-items-center">{{ $maquina->nombre }}</div>
                                            @else
                                                <div style="border-radius: 1em; border-color: black; margin-right: 5px !important;
                                                border-width: 1px;
                                                border-style: solid; height: 35px;" class="d-flex justify-content-center align-items-center"> - </div>
                                            @endif
                                            </td>
                                            <td style="">
                                                @if ($maquina->modelo)
                                                <div style="margin-right: 5px !important;border-radius: 1em; border-color: black;
                                                border-width: 1px;
                                                border-style: solid; height: 35px;" class="d-flex justify-content-center align-items-center">{{ $maquina->modelo }}</div>
                                            @else
                                                <div style="border-radius: 1em; border-color: black; margin-right: 5px !important;
                                                border-width: 1px;
                                                border-style: solid; height: 35px;" class="d-flex justify-content-center align-items-center"> - </div>
                                            @endif
                                            </td>
                                            <td style="">
                                                @if ($maquina->numserie)
                                                <div style="margin-right: 5px !important;border-radius: 1em; border-color: black;
                                                border-width: 1px;
                                                border-style: solid; height: 35px;" class="d-flex justify-content-center align-items-center">{{ $maquina->numserie }}</div>
                                            @else
                                                <div style="border-radius: 1em; border-color: black; margin-right: 5px !important;
                                                border-width: 1px;
                                                border-style: solid; height: 35px;" class="d-flex justify-content-center align-items-center"> - </div>
                                            @endif
                                            </td>
                                            <td style="">
                                                @if ($maquina->placas)
                                                <div style="margin-right: 5px !important;border-radius: 1em; border-color: black;
                                                border-width: 1px;
                                                border-style: solid; height: 35px;" class="d-flex justify-content-center align-items-center">{{ $maquina->placas }}</div>
                                            @else
                                                <div style="border-radius: 1em; border-color: black; margin-right: 5px !important;
                                                border-width: 1px;
                                                border-style: solid; height: 35px;" class="d-flex justify-content-center align-items-center"> - </div>
                                            @endif
                                            </td>
                                            {{--  <td class="text-center">{{ $maquina->submarca }}</td>  --}}
                                            <td style="">
                                                @if ($maquina->ano)
                                                <div style="margin-right: 5px !important;border-radius: 1em; border-color: black;
                                                border-width: 1px;
                                                border-style: solid; height: 35px;" class="d-flex justify-content-center align-items-center">{{ $maquina->ano }}</div>
                                            @else
                                                <div style="border-radius: 1em; border-color: black; margin-right: 5px !important;
                                                border-width: 1px;
                                                border-style: solid; height: 35px;" class="d-flex justify-content-center align-items-center"> - </div>
                                            @endif
                                            </td>
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
                    <div id="print-footer" class="print-footer">
                        <img src="{{ asset('/img/maquinariaPrint/Pie de página_1.svg') }}">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    print(){
        window.print();
    }
</script>
<style>
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
