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
                    
                    <div id="print-content" class="content-print" style="">
                        <div class="table-responsive" style="font-size: 11px">
                            <div class="row">
                                <div class="col-4 text-start">
                                    <img src="{{ asset('/img/maquinariaPrint/Logo q2cem_1.svg') }}" alt="" width="100px;" class="mb-2">    
                                </div>
                                <div class="col-4 text-center">
                                    <img src="{{ asset('/img/maquinariaPrint/Maquinaria.svg') }}" alt="" width="380px;" class="mb-2">    
                                </div>
                                
                                <div class="col-4 text-end">
                                    <img src="{{ asset('/img/maquinariaPrint/Logo q2ces_1.svg') }}" alt="" width="100px;" class="mb-2">    
                                </div>
                            </div>  
                            <table class="table">
                                <thead class="labelTitulo">
                                    <th class="labelTitulo text-center" style=" margin-right: 10px !important;">
                                        <div style="border-radius: 2em; background-color: var(--select); color: #fff;">ID </div></th>
                                    <th class="labelTitulo text-center" style=" margin-right: 10px !important; width: 280px;"> 
                                        <div style="border-radius: 2em; background-color: var(--select); color: #fff;">Equipo </div></th>
                                    <th class="labelTitulo text-center" style=" margin-right: 10px !important; width: 160px;"> 
                                        <div style="border-radius: 2em; background-color: var(--select); color: #fff;">Modelo </div></th>
                                    <th class="labelTitulo text-center" style=" margin-right: 10px !important; width: 160px;"> 
                                        <div style="border-radius: 2em; background-color: var(--select); color: #fff;">Serie - VIN</div></th>
                                    <th class="labelTitulo text-center" style=" margin-right: 10px !important;">
                                        <div style="border-radius: 2em; background-color: var(--select); color: #fff;">Placas </div></th>
                                    <th class="labelTitulo text-center"> 
                                        <div style="border-radius: 2em; background-color: var(--select); color: #fff;">Año </div></th>
                                </thead>
                                
                                <tbody>
                                    @forelse ($maquinaria as $maquina)
                                        <tr>
                                            <td class="text-center"><a
                                                    href="{{ route('maquinaria.vista', $maquina->id) }}"  title="Editar la información de la maquinaría."
                                                    style="color: blue "><div style="border-radius: 2em; border-color: black;
                                                    border-width: 3px;
                                                    border-style: solid; ">{{ $maquina->identificador }}</div></a></td>
                                                    <td class="text-center"><div style="border-radius: 2em; border-color: black;
                                                        border-width: 3px;
                                                        border-style: solid; ">{{ $maquina->nombre }}</div></td>
                                            <td class="text-center"><div style="border-radius: 2em; border-color: black;
                                                border-width: 3px;
                                                border-style: solid; ">{{ $maquina->modelo }}</div></td>
                                            <td class="text-center"><div style="border-radius: 2em; border-color: black;
                                                border-width: 3px;
                                                border-style: solid; ">{{ $maquina->numserie }}</div></td>
                                            <td class="text-center"><div style="border-radius: 2em; border-color: black;
                                                border-width: 3px;
                                                border-style: solid; ">{{ $maquina->placas }}</div></td>
                                            {{--  <td class="text-center">{{ $maquina->submarca }}</td>  --}}
                                            <td class="text-center"><div style="border-radius: 2em; border-color: black;
                                                border-width: 3px;
                                                border-style: solid; ">{{ $maquina->ano }}</div></td>
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
                        <img src="{{ asset('/img/maquinariaPrint/Pie de página_1.svg') }}" alt="" class="mb-2">
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
            visibility: visible !important;
        }
        .print-footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            text-align: center;
        }
        #print-footer, #print-footer * {
            visibility: visible !important;
        }
        @page {
            size: 215.9mm 279.4mm;
            margin-bottom: 0mm;
            margin-top: 0mm;
            margin-right: 0mm;
        }
        body {
            margin-top: -35mm !important;
            padding: 0 !important;
        }
    }

    #print-content {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        text-align: left !important;
        font-family: Arial, sans-serif;
        font-weight: bold;
        align-items: start;
    }

    #main {
        margin-top: 0px !important;
    }
</style>

@endsection
