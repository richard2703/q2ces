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
                    <div id="content-center" class="content-center" style="display: none">
                        <img src="{{ asset('/img/maquinariaPrint/Q de fondo.svg') }}" width="70%" alt="">    
                    </div>
                    <div id="print-content" class="print-content d-flex align-items-center">
                        <div class="table-responsive" style="font-size: 10px">
                            <div id="print-header" class="print-header">
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
                            </div>
                            
                            <table style="margin-top: 65px">
                                <thead class="labelTitulo">
                                    <th class="labelTitulo text-center" style="height: 28px;">
                                        <div class="d-flex justify-content-center align-items-center" style="margin-right: 5px !important;font-size:14px !important; border-radius: 2em; background-color: var(--select); color: #fff; height: 28px;">ID </div></th>
                                    <th class="labelTitulo text-center" style="height: 28px; width: 300px;"> 
                                        <div class="d-flex justify-content-center align-items-center" style="margin-right: 5px !important;font-size:14px !important; border-radius: 2em; background-color: var(--select); color: #fff; height: 28px;">Equipo </div></th>
                                    <th class="labelTitulo text-center" style="height: 28px; width: 160px;"> 
                                        <div class="d-flex justify-content-center align-items-center" style="margin-right: 5px !important;font-size:14px !important; border-radius: 2em; background-color: var(--select); color: #fff; height: 28px;">Modelo </div></th>
                                    <th class="labelTitulo text-center" style="height: 28px; width: 170px;"> 
                                        <div class="d-flex justify-content-center align-items-center" style="margin-right: 5px !important;font-size:14px !important; border-radius: 2em; background-color: var(--select); color: #fff; height: 28px;">Serie - VIN</div></th>
                                    <th class="labelTitulo text-center" style="height: 28px; width: 120px;">
                                        <div class="d-flex justify-content-center align-items-center" style="margin-right: 5px !important;font-size:14px !important; border-radius: 2em; background-color: var(--select); color: #fff; height: 28px;">Placas </div></th>
                                    <th class="labelTitulo text-center" style=" height: 28px;"> 
                                        <div class="d-flex justify-content-center align-items-center" style="margin-right: 5px !important;font-size:14px !important; border-radius: 2em; background-color: var(--select); color: #fff; height: 28px;">Año </div></th>
                                </thead>
                                
                                <tbody>
                                    @php
                                        $totalRegistros = count($maquinaria) - 1;
                                    @endphp
                                    @forelse ($maquinaria as $key => $maquina)
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
                                    
                                    @if ($key == 25 || $key == 50 || $key == 75 || $key == 100 || $key == 125 || $key == 150 || $key == 175 || $key == 200 || $key == 205 || $key == 228 || $key == 251 || $key == 274 || $key == 297 || $key == 320 || $key == 343 || $key == 366 || $key == 389 || $key == 412)
                                            
                                        </tbody>
                                    </table>
                                    <div class="page mt-1" style="margin-left: 90mm; font-weight: 500 !important; font-size: 14px !important; border-radius: 2em; background-color: #f7c90d; color: var(--select); height: 20px;" ></div>
                                        <br><br><br><br>
                                        <br>
                                        
                                    @endif
                                    @if ($key == 25 || $key == 50 || $key == 75 || $key == 100 || $key == 125 || $key == 150 || $key == 175 || $key == 200 || $key == 205 || $key == 228 || $key == 251 || $key == 274 || $key == 297 || $key == 320 || $key == 343 || $key == 366 || $key == 389 || $key == 412)
                                    <table class="">
                                        <thead class="labelTitulo">
                                            <th class="labelTitulo text-center" style="height: 28px;">
                                                <div class="d-flex justify-content-center align-items-center" style="margin-right: 5px !important;font-size:14px !important; border-radius: 2em; background-color: var(--select); color: #fff; height: 28px;">ID </div></th>
                                            <th class="labelTitulo text-center" style="height: 28px; width: 300px;"> 
                                                <div class="d-flex justify-content-center align-items-center" style="margin-right: 5px !important;font-size:14px !important; border-radius: 2em; background-color: var(--select); color: #fff; height: 28px;">Equipo </div></th>
                                            <th class="labelTitulo text-center" style="height: 28px; width: 160px;"> 
                                                <div class="d-flex justify-content-center align-items-center" style="margin-right: 5px !important;font-size:14px !important; border-radius: 2em; background-color: var(--select); color: #fff; height: 28px;">Modelo </div></th>
                                            <th class="labelTitulo text-center" style="height: 28px; width: 170px;"> 
                                                <div class="d-flex justify-content-center align-items-center" style="margin-right: 5px !important;font-size:14px !important; border-radius: 2em; background-color: var(--select); color: #fff; height: 28px;">Serie - VIN</div></th>
                                            <th class="labelTitulo text-center" style="height: 28px; width: 120px;">
                                                <div class="d-flex justify-content-center align-items-center" style="margin-right: 5px !important;font-size:14px !important; border-radius: 2em; background-color: var(--select); color: #fff; height: 28px;">Placas </div></th>
                                            <th class="labelTitulo text-center" style=" height: 28px;"> 
                                                <div class="d-flex justify-content-center align-items-center" style="margin-right: 5px !important;font-size:14px !important; border-radius: 2em; background-color: var(--select); color: #fff; height: 28px;">Año </div></th>
                                        </thead>
                                                
                                        <tbody>
                                            
                                    @endif
                                        <tr>
                                            <td style="">
                                                @if ($maquina->identificador)
                                                <a
                                                    href="{{ route('maquinaria.vista', $maquina->id) }}"  title="Editar la información de la maquinaría."
                                                    style="color: black "><div style="margin-right: 5px !important;border-radius: 1em; border-color: black;
                                                    border-width: 1px;
                                                    border-style: solid; height: 28px; margin-top: 3px" class="d-flex justify-content-center align-items-center">{{ $maquina->identificador }}</div></a>
                                            @else
                                                <div style="border-radius: 1em; border-color: black; margin-right: 5px !important;
                                                border-width: 1px;
                                                border-style: solid; height: 28px; margin-top: 3px" class="d-flex justify-content-center align-items-center"> - </div>
                                            @endif
                                            </td>
                                            <td style="">
                                                @if ($maquina->nombre)
                                                <div style="margin-right: 5px !important;border-radius: 1em; border-color: black;
                                                border-width: 1px;
                                                border-style: solid; height: 28px; margin-top: 3px" class="d-flex justify-content-center align-items-center">{{ $maquina->nombre }}</div>
                                            @else
                                                <div style="border-radius: 1em; border-color: black; margin-right: 5px !important;
                                                border-width: 1px;
                                                border-style: solid; height: 28px; margin-top: 3px" class="d-flex justify-content-center align-items-center"> - </div>
                                            @endif
                                            </td>
                                            <td style="">
                                                @if ($maquina->modelo)
                                                <div style="margin-right: 5px !important;border-radius: 1em; border-color: black;
                                                border-width: 1px;
                                                border-style: solid; height: 28px; margin-top: 3px" class="d-flex justify-content-center align-items-center">{{ $maquina->modelo }}</div>
                                            @else
                                                <div style="border-radius: 1em; border-color: black; margin-right: 5px !important;
                                                border-width: 1px;
                                                border-style: solid; height: 28px; margin-top: 3px" class="d-flex justify-content-center align-items-center"> - </div>
                                            @endif
                                            </td>
                                            <td style="">
                                                @if ($maquina->numserie)
                                                <div style="margin-right: 5px !important;border-radius: 1em; border-color: black;
                                                border-width: 1px;
                                                border-style: solid; height: 28px; margin-top: 3px" class="d-flex justify-content-center align-items-center">{{ $maquina->numserie }}</div>
                                            @else
                                                <div style="border-radius: 1em; border-color: black; margin-right: 5px !important;
                                                border-width: 1px;
                                                border-style: solid; height: 28px; margin-top: 3px" class="d-flex justify-content-center align-items-center"> - </div>
                                            @endif
                                            </td>
                                            <td style="">
                                                @if ($maquina->placas)
                                                <div style="margin-right: 5px !important;border-radius: 1em; border-color: black;
                                                border-width: 1px;
                                                border-style: solid; height: 28px; margin-top: 3px" class="d-flex justify-content-center align-items-center">{{ $maquina->placas }}</div>
                                            @else
                                                <div style="border-radius: 1em; border-color: black; margin-right: 5px !important;
                                                border-width: 1px;
                                                border-style: solid; height: 28px; margin-top: 3px" class="d-flex justify-content-center align-items-center"> - </div>
                                            @endif
                                            </td>
                                            {{--  <td class="text-center">{{ $maquina->submarca }}</td>  --}}
                                            <td style="">
                                                @if ($maquina->ano)
                                                <div style="margin-right: 5px !important;border-radius: 1em; border-color: black;
                                                border-width: 1px;
                                                border-style: solid; height: 28px; margin-top: 3px" class="d-flex justify-content-center align-items-center">{{ $maquina->ano }}</div>
                                            @else
                                                <div style="border-radius: 1em; border-color: black; margin-right: 5px !important;
                                                border-width: 1px;
                                                border-style: solid; height: 28px; margin-top: 3px" class="d-flex justify-content-center align-items-center"> - </div>
                                            @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="2">Sin Registros.</td>
                                        </tr>
                                    @endforelse
                                    @php
                                        $numeroTotal = $totalRegistros;
                                        $numeroACaber = 25;

                                        $vecesQueCabe = floor($numeroTotal / $numeroACaber);
                                        $faltante = $numeroACaber - ($numeroTotal % $numeroACaber);
                                        $var = ($numeroTotal % $numeroACaber);
                                        $faltante -= 3;
                                        if ($faltante == 0)
                                            $faltante = 24;
                                        if ($faltante == 1)
                                            $faltante = 25;
                                        if ($faltante == -1)
                                            $faltante = 23;
                                        if ($faltante == -2)
                                            $faltante = 22;
                                        if ($faltante == 25)
                                            $faltante = 0;
                                        if ($faltante == 24)
                                            $faltante = -1;
                                        if ($faltante == 23)
                                            $faltante = -2;
                                        if ($faltante == 22)
                                            $faltante = -3;
                                    @endphp
                                </tbody>
                            </table>
                            
                        </div>
                        @for ($i = 0; $i <$faltante+3; $i++)
                            <tr>
                                <div style="border-radius: 1em; border-color: white; color: white; margin-right: 5px !important;
                                border-width: 1px;
                                border-style: solid; height: 28px; margin-top: 3px" class="d-flex justify-content-center align-items-center"> - </div>
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
        margin-top: 7mm;
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
        margin-top: -63mm !important;
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
