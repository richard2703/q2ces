@extends('layouts.main', ['activePage' => 'inventario', 'titlePage' => __('Inventario')])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
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
                                <img src="{{ asset('/img/login/logoQcem2.svg') }}" alt="" width="50px;" class="mb-2" style="margin-left: -31px;">
                                <div class="text-start">
                                <p id="fecha-hora"></p>
                                <div><span style="font-weight: 900">Descarga ID: </span> {{ $descarga->id }}</div>
                                <div><span style="font-weight: 900">Equipo Y/O Maquinaria: </span> {{ $descarga->maquinaria_nombre }}</div>
                                <div><span style="font-weight: 900">Litros: </span>{{ $descarga->maquinaria_nombre }}</div>
                                <div><span style="font-weight: 900">KM: </span>{{ $descarga->maquinaria_nombre }}</div>
                                <div><span style="font-weight: 900">Maquinaria: </span>{{ $descarga->maquinaria_nombre }}</div>
                                </div>
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
        let formattedDateTime = now.getDate() + " De " + monthNames[now.getMonth()] + " De " + now.getFullYear() + " A Las " + now.getHours() + ":" + (now.getMinutes() < 10 ? "0" : "") + now.getMinutes();
        document.getElementById("fecha-hora").textContent = formattedDateTime;
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
        #print-content {
        transform: translateY(-220px);
        }
        @page {
            size: 90mm 105mm; /* Tamaño ISO C7 en milímetros */
        }
        body {
            margin: 0;
            padding: 0;
        }
    }
    @media print {
        header {
            display: none !important;
        }
    }
    #print-content {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        text-align: left !important;
        font-family: Arial, sans-serif;
        padding-top: 15px;
        font-size: 13px;
        font-weight: bold;
        align-items: center;
        margin: 0;
    }
</style>
@endsection
