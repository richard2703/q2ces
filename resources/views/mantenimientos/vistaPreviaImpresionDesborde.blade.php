@extends('layouts.main', ['activePage' => ( $blnEsMtq == true ? 'mtq' : 'mantenimiento'), 'titlePage' => __('Inventario')])
@section('content')
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card" >
                    <div class="card-header bacTituloPrincipal">
                        {{-- <p class="card-category">Usuarios registrados</p> --}}
                        {{ $maquinaria->compania == 'mtq' ? 'MTQ' : '' }} Vista Previa de Impresion de Mantenimiento
                    </div>
                    <div class="card-body">
                        <div class="row divBorder">
                            <div class="col-6 text-right">
                                <a href="{{ $maquinaria->compania == 'mtq' ? route('mantenimientos.indexMtq'):  route('mantenimientos.index') }}">
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
                    <div id="print-content" class="print-content d-flex align-items-center">
                        <div class="row">
                            <div class="col-2 text-start">
                                <img src="{{ asset('/img/maquinariaPrint/Logo q2cem.svg') }}" alt="" width="95px;" class="mt-1" style="margin-left: 95px">
                            </div>
                            <div class="col-8 mr-3" style="margin-left: -10px">
                                <div class="row">
                                    <div class="col text-center">
                                        <h2 style="color: #a6ce34; font-weight: bold">Q2S, S.A de C.V.</h2>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col text-center">
                                        <div class="copyright" style="font-size: 9px; font-weight: bold; color: #727176">
                                            Oficina: José María Herédia No. 2387. Colonia Lomas de Guevara. Guadalajara, Jalisco. México C.P. 44657. Tel: 33-3640-2290. <br>
                                            Taller: San Juan de los Lagos No. 1788. Colonia Hogares de Nuevo México. C.P. 45138. Tel: 33-3857-4027. www.q2ces.com
                                            <div id="lineInvisible" style="visibility: hidden">.......................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="container" style="margin-top: -20px">
                                    <div class="row justify-content-center">
                                        <div class="col text-center" style="max-width: 550px;">
                                            <div class="d-flex align-items-center p-2 justify-content-center" style="font-weight: 500 !important; font-size: 16px !important; border-radius: 2em; background-color: #727176; color: white; height: 20px !important;">
                                                BITÁCORA DE MANTENIMIENTO DE MAQUINARIA Y EQUIPO
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-2 text-end mt-2" style="margin-left: -40px">
                                <div class="d-flex align-items-center p-2 justify-content-center" style="font-weight: 500 !important; font-size: 20px !important; background-color: #727176; color: black; height: 25px !important; width: 120px !important;">
                                    <b>FOLIO</b>
                                </div>
                                <div class="d-flex align-items-center p-1 justify-content-center" style="font-weight: 500 !important; font-size: 20px !important; border-width: 1px; border-style: solid; border-color: #727176; color: red; width: 120px !important; height: 40px !important;">
                                    M-{{ str_pad($mantenimiento->id, 4, '0', STR_PAD_LEFT) }}
                                </div>
                            </div>

                        </div>
                        <div class="col-12" style="margin-top: 5px; margin-right: 10px;">
                            <div class="d-flex align-items-center p-1 justify-content-center" style="font-weight: 500 !important; font-size: 8px !important; border-radius: 2em;border-width: 1px; border-style: solid; border-color: #727176; background-color: white; color: black; height: 45px !important;">
                                <div class="d-flex align-items-center justify-content-center custom-section grey-section" style="margin-left: -5px;">
                                    <b>Equipo:</b>
                                </div>
                                <div class="d-flex align-items-center justify-content-center custom-section white-section" style="border: none">

                                    <b style="{{ strlen(trans($maquinaria->nombre)) > 16 ? 'font-size: 7px;' : '' }}">{{ $maquinaria->nombre }}</b>
                                </div>

                                <div class="d-flex align-items-center justify-content-center custom-section grey-section" style="width: 50px">
                                    <b>VIN:</b>
                                </div>
                                <div class="d-flex align-items-center justify-content-center custom-section white-section" style="border: none; width: 110px">
                                    <b>{{$maquinaria->numserie}}</b>
                                </div>

                                <div class="d-flex align-items-center justify-content-center custom-section grey-section">
                                    <b>MARCA:</b>
                                </div>
                                <div class="d-flex align-items-center justify-content-center custom-section white-section" style="border: none; width: 95px">
                                    <b style="{{ strlen(trans($maquinaria->nombre)) > 16 ? 'font-size: 7px;' : '' }}">{{$maquinaria->marca}}</b>
                                </div>

                                <div class="d-flex align-items-center justify-content-center custom-section grey-section">
                                    <b>MODELO:</b>
                                </div>
                                <div class="d-flex align-items-center justify-content-center custom-section white-section" style="border: none">
                                    <b style="{{ strlen(trans($maquinaria->nombre)) > 16 ? 'font-size: 7px;' : '' }}">{{$maquinaria->modelo}}</b>
                                </div>

                                <div class="d-flex align-items-center justify-content-center custom-section grey-section" style="width: 60px">
                                    <b>AÑO:</b>
                                </div>
                                <div class="d-flex align-items-center justify-content-center custom-section white-section" style="border: none; width: 40px">
                                    <b>{{$maquinaria->ano}}</b>
                                </div>

                                <div class="d-flex align-items-center justify-content-center custom-section grey-section">
                                    <b>PLACAS:</b>
                                </div>
                                <div class="d-flex align-items-center justify-content-center custom-section white-section" style="border: none; width: 60px">
                                    <b>{{$maquinaria->placas}}</b>
                                </div>

                                <div class="d-flex align-items-center justify-content-center custom-section grey-section" style="width: 95px">
                                    <b>N/ECONÓMICO:</b>
                                </div>
                                <div class="d-flex align-items-center justify-content-center custom-section white-section" style="border: none">
                                    <b>{{$maquinaria->identificador}}</b>
                                </div>

                            </div>

                        </div>

                        <div class="col-12 " style="margin-top: 5px; margin-right: 10px;">

                            <table class="d-flex align-items-center justify-content-center" style="font-size: 12px; width: auto; height: auto; border-spacing: 0px !important;">
                                <tbody>
                                    <tr style="border: 1px solid #727176;">
                                        <td rowspan="2" class="text-white" style="height: 5px; background-color: #727176; width: 10px; font-weight: 500 !important;"><b>Fecha <br> DD/MM/AA</b></td>
                                        <td rowspan="2" class="" style="width: 10px; border: 1px solid #727176; font-weight: 600 !important;">HOROMETRO <br> KM/MILLAS</td>
                                        <th colspan="4" class="text-white" style="background-color: #727176; height: 10px; font-weight: 500 !important;"><b>DESCRIPCIÓN DE MANTENIMIENTO REALIZADO</b></th>
                                    </tr>
                                    <tr style="border: 1px solid #727176;">
                                        @if ($mecanico == "false")
                                            <th scope="col" style="width: 500px; font-weight: 600 !important;">MATERIAL y/o MANO DE OBRA</th>
                                            <th scope="col" class="text-white" style="background-color: #727176; height: 10px !important; font-weight: 500 !important;"><b> CANTIDAD</b></th>
                                            <th scope="col" style="width: 15px !important; font-weight: 600 !important;">COSTO</th>
                                            <th scope="col" class="text-white" style="  background-color: #727176; height: 10px !important; font-weight: 500 !important;"><b>IMPORTE</b></th>
                                        @else
                                            <th scope="col" style="width: 700px; font-weight: 600 !important;" >MATERIAL y/o MANO DE OBRA</th>
                                            <th scope="col" class="text-white" style="   background-color: #727176; height: 10px !important; font-weight: 500 !important;"><b> CANTIDAD</b></th>
                                        @endif
                                    </tr>
                                    <tr style="border: 1px solid #727176;">
                                        @php
                                            $gastosCount = count($gastos);
                                            $fechaInicioFormateada = date('d/m/y', strtotime($mantenimiento->fechaInicio));
                                        @endphp

                                        <th rowspan="2" scope="rowgroup" style="vertical-align: middle; border: 1px solid #727176; font-weight: 600 !important;">{{$fechaInicioFormateada}}</th>
                                        <th rowspan="2" scope="rowgroup" style="vertical-align: middle; border: 1px solid #727176; font-weight: 600 !important;">{{$maquinaria->kilometraje}}</th>

                                        @if ($gastos->isNotEmpty())
                                            @if ($mecanico == "false")
                                                <td style="border: 1px solid #727176; font-weight: 600 !important;">Materiales Totales</td>
                                                <td style="border: 1px solid #727176; font-weight: 600 !important;">{{ $totalMateriales }}</td>
                                                <td style="border: 1px solid #727176; font-weight: 600 !important;">${{ $totalCostoMateriales }}</td>
                                                <td style="border: 1px solid #727176; font-weight: 600 !important;">${{ $totalImporteMateriales }}</td>
                                            @else
                                                <td style="border: 1px solid #727176; font-weight: 600 !important;">Materiales Totales</td>
                                                <td style="border: 1px solid #727176; font-weight: 600 !important;">{{ $totalMateriales }}</td>
                                            @endif
                                        @endif
                                    </tr>

                                    <tr style="border: 1px solid #727176;">

                                        @if ($gastos->isNotEmpty())
                                            @if ($mecanico == "false")
                                                <td style="border: 1px solid #727176; font-weight: 600 !important;">Mano de Obra Totales</td>
                                                <td style="border: 1px solid #727176; font-weight: 600 !important;">{{ $totalManoObra }}</td>
                                                <td style="border: 1px solid #727176; font-weight: 600 !important;">${{ $totalCostoManoObra }}</td>
                                                <td style="border: 1px solid #727176; font-weight: 600 !important;">${{ $totalImporteManoObra }}</td>
                                            @else
                                                <td style="border: 1px solid #727176; font-weight: 600 !important;">Materiales Totales</td>
                                                <td style="border: 1px solid #727176; font-weight: 600 !important;">{{ $totalManoObra }}</td>
                                            @endif
                                        @endif
                                    </tr>



                                    {{--  @forelse ($gastos->slice(1) as $key => $item)
                                    <!-- Tu lógica actual para mostrar los registros -->
                                    <tr style="border: 1px solid #727176; font-weight: 600 !important;">
                                        @if ($mecanico == "false")
                                            <td style="border: 1px solid #727176;">{{$item->concepto}}</td>
                                            <td style="border: 1px solid #727176;">{{ number_format($item->cantidad, 2) }}</td>
                                            <td style="border: 1px solid #727176;">${{ number_format($item->costo, 2) }}</td>
                                            <td style="border: 1px solid #727176;">${{ number_format($item->total, 2) }}</td>
                                        @else
                                            <td style="border: 1px solid #727176;">{{$item->concepto}}</td>
                                            <td style="border: 1px solid #727176;">{{ number_format($item->cantidad, 2) }}</td>
                                        @endif
                                    </tr>
                                    @empty
                                    @endforelse

                                    @for ($i = $gastos->count() + 1; $i <= 20; $i++)
                                        <!-- Completa con filas vacías hasta llegar a 20 -->
                                        <tr>
                                            <td style="border: 1px solid #727176;">-</td>
                                            <td style="border: 1px solid #727176;">-</td>
                                            <td style="border: 1px solid #727176;">-</td>
                                            <td style="border: 1px solid #727176;">-</td>
                                        </tr>
                                    @endfor  --}}

                                    <tr style="border: 1px solid #727176;">
                                        @if ($mecanico == "false")
                                        <th scope="col" colspan="3" style="border-right: 1px solid black; font-weight: 500"> {{ $mantenimiento->comentario }}</th>
                                        <td class="text-white" style="background-color: #727176; border: 1px solid black; padding: 5px; font-weight: bold !important; border-right: 1px solid black;">
                                            SUB-TOTAL <br>
                                            <span style="border-top: 1px solid black; display: block; padding-top: 5px;">I.V.A.</span>
                                            <span style="border-top: 1px solid black; display: block; padding-top: 5px;">TOTAL</span>
                                        </td>
                                        <td class="text-white" style="background-color: #727176; border: 1px solid black; padding: 5px; font-weight: bold !important;">
                                            <br>
                                            <span style="border-top: 1px solid black; display: block; border-bottom: 1px solid black; display: block; padding-top: 5px;">{{ 16 }}%</span>
                                            <br>
                                        </td>
                                        <td class="text-white" style="background-color: #727176; border: 1px solid black; padding: 5px; font-weight: bold !important;">
                                            $ {{number_format($mantenimiento->subtotal, 2, '.', ',')}}<br>
                                            <span style="border-top: 1px solid black; display: block; padding-top: 5px;">$ {{number_format($mantenimiento->iva, 2, '.', ',')}}<br></span>
                                            <span style="border-top: 1px solid black; display: block; padding-top: 5px;">$ {{number_format($mantenimiento->costo, 2, '.', ',')}}</span>
                                        </td>
                                        @else
                                            <th scope="col" colspan="6" style="border-right: 1px solid black; font-weight: 500; height: 75px;">{{ $mantenimiento->comentario }}</th>
                                        @endif
                                    </tr>

                                    <tr style="border: 1px solid #727176; font-weight: 900">
                                        <th style="border: 1px solid #727176;" scope="col" colspan="3"> LA PRESENTE BITÁCORA AMPARA EL ULTIMO MANTENIMIENTO REALIZADO EL</b></th>
                                        <th style="border: 1px solid #727176;" scope="col" colspan="3">{{ isset($mantenimiento->fechaReal) ? $mantenimiento->fechaReal : "" }}</th>
                                    </tr>

                                    <tr style="border: 1px solid #727176; font-weight: 900">
                                        <th style="border: 1px solid #727176;" scope="col" colspan="3"> PRÓXIMOS SERVICIOS PROGRAMADOS </th>
                                        <th style="border: 1px solid #727176;" scope="col" colspan="3"> {{$mantenimiento->mantenimientoPrint}} </th>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="mt-2" style="display: flex; flex-direction: column; align-items: center;">
                                <!-- Primera sección de imágenes -->
                                <div style="display: flex; flex-wrap: wrap; justify-content: space-between;">
                                    @php
                                        $fotosPorFila = 3;
                                        $totalFilas = 3;
                                        $fotosSeccion = array_slice($fotos, 0, $fotosPorFila * $totalFilas);
                                        $fotosFaltantes = $fotosPorFila * $totalFilas - count($fotosSeccion);
                                    @endphp

                                    @foreach ($fotosSeccion as $foto)
                                        <div style="width: calc(33.33% - 8px); height: 180px; margin: 3px; border: 1px solid #727176; padding: 3px; overflow: hidden;">
                                            <img src="{{ empty($foto['ruta']) ? '/img/general/default.jpg' : asset('/storage/maquinaria/' . str_pad($maquinaria['identificador'], 4, '0', STR_PAD_LEFT) . '/mantenimientos/' . $mantenimiento->codigo . '/' . $foto['ruta']) }}" style="height: 100%; object-fit: cover;">
                                        </div>
                                    @endforeach

                                    @for ($i = 0; $i < $fotosFaltantes; $i++)
                                        <div style="width: calc(33.33% - 8px); height: 180px; margin: 3px; border: 1px solid #727176; padding: 3px; overflow: hidden;">
                                            <img src="/img/general/default.jpg" style="height: 100%; object-fit: cover;">
                                        </div>
                                    @endfor
                                </div>

                                <!-- Tercera sección de imágenes -->
                                <div class="mt-1" style="display: flex; justify-content: space-between;">
                                    <!-- Imagen 9 -->
                                    <div style="margin-top: 3px; width: 30%; height: 261px; border: 1px solid #727176; text-align: center; font-size:8px">
                                        <div class="mt-1"><b>SELLO DE TALLER</b></div>
                                    </div>

                                    @if(count($fotos) >= 10 && !empty($fotos[9]['ruta']))
                                        <div style="width: 783px; height: 261px; margin: 3px; border: 1px solid #727176; padding: 3px; overflow: hidden;">
                                            <img class="img-fluid" src="{{ asset('/storage/maquinaria/' . str_pad($maquinaria->identificador, 4, '0', STR_PAD_LEFT) . '/mantenimientos/' . $mantenimiento->codigo . '/' . $fotos[9]['ruta']) }}" style="height: 100%; object-fit: cover;">
                                        </div>
                                    @else
                                        <div style="width: 783px; height: 261px; margin: 3px; border: 1px solid #727176; padding: 3px; overflow: hidden;">
                                            <img class="img-fluid" src="/img/general/default.jpg" style="height: 100%; object-fit: cover;">
                                        </div>
                                    @endif

                                    <!-- Sello de oficina -->
                                    <div style="margin-top: 3px; width: 30%; height: 261px; border: 1px solid #727176; text-align: center; font-size:8px">
                                        <div class="mt-1"><b>SELLO DE OFICINA</b></div>
                                    </div>
                                </div>

                            </div>

                        <div class="row d-flex align-items-center justify-content-center" style="margin-top: -20px">
                            <div class="col-3">
                                <div style="margin-top: 20px; text-align: center; font-size: 9px;">
                                    <b>
                                        <p>VO.BO</p>
                                        <div class="pt-2">
                                            _____________________________________________<br>
                                            COORDINADOR TALLER<br>
                                    </b>

                                        <div style="font-size: 14px">
                                            @if ($mantenimiento->coordTaller)
                                                {{ $mantenimiento->coordTaller }}
                                            @else
                                                No Seleccionado
                                            @endif
                                            </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div style="margin-top: 20px; text-align: center; font-size: 9px;">
                                    <b>
                                        <p>AUDITORIA INTERNA</p>
                                        <div class="pt-2">
                                            _____________________________________________<br>
                                            COORDINADOR OPERACIONES<br>
                                    </b>

                                        <div style="font-size: 14px">
                                            @if ($mantenimiento->coordOperaciones)
                                                {{ $mantenimiento->coordOperaciones }}
                                            @else
                                                No Seleccionado
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div style="margin-top: 20px; text-align: center; font-size: 9px;">
                                    <b>
                                        <p>REVISÓ</p>
                                        <div class="pt-2">
                                            _____________________________________________<br>
                                            MECÁNICO<br>
                                    </b>

                                        <div style="font-size: 14px">
                                            @if ($mantenimiento->mecanico)
                                                {{ $mantenimiento->mecanico }}
                                            @else
                                                No Seleccionado
                                            @endif

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div style="margin-top: 20px; text-align: center; font-size: 9px;">
                                    <b>
                                        <p>RECIBIÓ</p>
                                        <div class="pt-2">
                                            _____________________________________________<br>
                                            RESPONSABLE DEL EQUIPO<br>
                                    </b>
                                        <div style="font-size: 14px">
                                            @if ($mantenimiento->responsable)
                                                {{ $mantenimiento->responsable }}
                                            @else
                                                No Seleccionado
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2 text-start">
                                <img src="{{ asset('/img/maquinariaPrint/Logo q2cem.svg') }}" alt="" width="95px;" class="mt-1" style="margin-left: 15px">
                            </div>
                            <div class="col-8 mr-3" style="margin-left: -10px">
                                <div class="row">
                                    <div class="col text-center">
                                        <h2 style="color: #a6ce34; font-weight: bold">Q2S, S.A de C.V.</h2>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col text-center">
                                        <div class="copyright" style="font-size: 9px; font-weight: bold; color: #727176">
                                            Oficina: José María Herédia No. 2387. Colonia Lomas de Guevara. Guadalajara, Jalisco. México C.P. 44657. Tel: 33-3640-2290. <br>
                                            Taller: San Juan de los Lagos No. 1788. Colonia Hogares de Nuevo México. C.P. 45138. Tel: 33-3857-4027. www.q2ces.com
                                            <div id="lineInvisible" style="visibility: hidden">.......................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="container" style="margin-top: -20px">
                                    <div class="row justify-content-center">
                                        <div class="col text-center" style="max-width: 550px;">
                                            <div class="d-flex align-items-center p-2 justify-content-center" style="font-weight: 500 !important; font-size: 16px !important; border-radius: 2em; background-color: #727176; color: white; height: 20px !important;">
                                                BITÁCORA DE MANTENIMIENTO DE MAQUINARIA Y EQUIPO
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-2 text-end mt-2" style="margin-left: 10px">
                                <div class="d-flex align-items-center p-2 justify-content-center" style="font-weight: 500 !important; font-size: 20px !important; background-color: #727176; color: black; height: 25px !important; width: 120px !important;">
                                    <b>FOLIO</b>
                                </div>
                                <div class="d-flex align-items-center p-1 justify-content-center" style="font-weight: 500 !important; font-size: 20px !important; border-width: 1px; border-style: solid; border-color: #727176; color: red; width: 120px !important; height: 40px !important;">
                                    M-{{ str_pad($mantenimiento->id, 4, '0', STR_PAD_LEFT) }}
                                </div>
                            </div>

                        </div>
                        <div class="col-12" style="margin-top: 5px; margin-right: 10px;">
                            <div class="d-flex align-items-center p-1 justify-content-center" style="font-weight: 500 !important; font-size: 8px !important; border-radius: 2em;border-width: 1px; border-style: solid; border-color: #727176; background-color: white; color: black; height: 45px !important;">
                                <div class="d-flex align-items-center justify-content-center custom-section grey-section" style="margin-left: -5px;">
                                    <b>Equipo:</b>
                                </div>
                                <div class="d-flex align-items-center justify-content-center custom-section white-section" style="border: none">

                                    <b style="{{ strlen(trans($maquinaria->nombre)) > 16 ? 'font-size: 7px;' : '' }}">{{ $maquinaria->nombre }}</b>
                                </div>

                                <div class="d-flex align-items-center justify-content-center custom-section grey-section" style="width: 50px">
                                    <b>VIN:</b>
                                </div>
                                <div class="d-flex align-items-center justify-content-center custom-section white-section" style="border: none; width: 110px">
                                    <b>{{$maquinaria->numserie}}</b>
                                </div>

                                <div class="d-flex align-items-center justify-content-center custom-section grey-section">
                                    <b>MARCA:</b>
                                </div>
                                <div class="d-flex align-items-center justify-content-center custom-section white-section" style="border: none; width: 95px">
                                    <b style="{{ strlen(trans($maquinaria->nombre)) > 16 ? 'font-size: 7px;' : '' }}">{{$maquinaria->marca}}</b>
                                </div>

                                <div class="d-flex align-items-center justify-content-center custom-section grey-section">
                                    <b>MODELO:</b>
                                </div>
                                <div class="d-flex align-items-center justify-content-center custom-section white-section" style="border: none">
                                    <b style="{{ strlen(trans($maquinaria->nombre)) > 16 ? 'font-size: 7px;' : '' }}">{{$maquinaria->modelo}}</b>
                                </div>

                                <div class="d-flex align-items-center justify-content-center custom-section grey-section" style="width: 60px">
                                    <b>AÑO:</b>
                                </div>
                                <div class="d-flex align-items-center justify-content-center custom-section white-section" style="border: none; width: 40px">
                                    <b>{{$maquinaria->ano}}</b>
                                </div>

                                <div class="d-flex align-items-center justify-content-center custom-section grey-section">
                                    <b>PLACAS:</b>
                                </div>
                                <div class="d-flex align-items-center justify-content-center custom-section white-section" style="border: none; width: 60px">
                                    <b>{{$maquinaria->placas}}</b>
                                </div>

                                <div class="d-flex align-items-center justify-content-center custom-section grey-section" style="width: 95px">
                                    <b>N/ECONÓMICO:</b>
                                </div>
                                <div class="d-flex align-items-center justify-content-center custom-section white-section" style="border: none">
                                    <b>{{$maquinaria->identificador}}</b>
                                </div>

                            </div>

                        </div>

                        <table class="d-flex align-items-center justify-content-center mt-1"  style="font-size: 12px; width: auto; height: auto; border-spacing: 0px !important; margin-block-end: 10px">
                        <tbody>
                            <tr style="border: 1px solid #727176;">
                                <td rowspan="2" class="text-white" style="height: 5px; background-color: #727176; width: 10px; font-weight: 500 !important;"><b>Fecha <br> DD/MM/AA</b></td>
                                <td rowspan="2" class="" style="width: 10px; border: 1px solid #727176; font-weight: 600 !important;">HOROMETRO <br> KM/MILLAS</td>
                                <th colspan="4" class="text-white" style="background-color: #727176; height: 10px; font-weight: 500 !important;"><b>DESCRIPCIÓN DE MANTENIMIENTO REALIZADO</b></th>
                            </tr>
                            <tr style="border: 1px solid #727176;">
                                @if ($mecanico == "false")
                                    <th scope="col" style="width: 500px; font-weight: 600 !important;">MATERIAL y/o MANO DE OBRA</th>
                                    <th scope="col" class="text-white" style="background-color: #727176; height: 10px !important; font-weight: 500 !important;"><b> CANTIDAD</b></th>
                                    <th scope="col" style="width: 15px !important; font-weight: 600 !important;">COSTO</th>
                                    <th scope="col" class="text-white" style="  background-color: #727176; height: 10px !important; font-weight: 500 !important;"><b>IMPORTE</b></th>
                                @else
                                    <th scope="col" style="width: 700px; font-weight: 600 !important;" >MATERIAL y/o MANO DE OBRA</th>
                                    <th scope="col" class="text-white" style="   background-color: #727176; height: 10px !important; font-weight: 500 !important;"><b> CANTIDAD</b></th>
                                @endif
                            </tr>
                            <tr style="border: 1px solid #727176;">
                                @php
                                    $fechaInicioFormateada = date('d/m/y', strtotime($mantenimiento->fechaInicio));
                                @endphp

                                @if ($gastosCount <= 47)
                                @php
                                    $espaciosBlanco = 44;
                                @endphp
                                @else
                                    @php
                                        $espaciosBlanco = 52;
                                    @endphp
                                @endif

                                <th rowspan="{{$espaciosBlanco + 1}}" scope="rowgroup" style="vertical-align: middle; border: 1px solid #727176; font-weight: 600 !important;">{{$fechaInicioFormateada}}</th>
                                <th rowspan="{{$espaciosBlanco + 1}}" scope="rowgroup" style="vertical-align: middle; border: 1px solid #727176; font-weight: 600 !important;">{{$maquinaria->kilometraje}}</th>

                                @if ($gastos->isNotEmpty())
                                    @if ($mecanico == "false")
                                        <td style="border: 1px solid #727176; font-weight: 600 !important;">{{$gastos[0]->concepto}}, @if ($gastos[0]->marca)
                                            Marca: {{$gastos[0]->marca}},
                                        @else

                                        @endif
                                        @if ($gastos[0]->modelo)
                                            Modelo: {{$gastos[0]->modelo}}
                                        @else

                                        @endif
                                       </td>
                                        <td style="border: 1px solid #727176; font-weight: 600 !important;">{{ number_format($gastos[0]->cantidad, 2) }}</td>

                                        <td style="border: 1px solid #727176; font-weight: 600 !important;">$ {{number_format($gastos[0]->costo, 2, '.', ',')}}</td>
                                        <td style="border: 1px solid #727176; font-weight: 600 !important;">$ {{number_format($gastos[0]->total, 2, '.', ',')}}</td>
                                    @else
                                        <td style="border: 1px solid #727176; font-weight: 600 !important;">{{$gastos[0]->concepto}},
                                            @if ($gastos[0]->marca)
                                            Marca: {{$gastos[0]->marca}},
                                        @else

                                        @endif
                                        @if ($gastos[0]->modelo)
                                            Modelo: {{$gastos[0]->modelo}}
                                        @else

                                        @endif</td>
                                        <td style="border: 1px solid #727176; font-weight: 600 !important;">{{ number_format($gastos[0]->cantidad, 2) }}</td>
                                    @endif
                                @endif
                            </tr>

                            @forelse ($gastos->slice(1) as $key => $item)
                            <!-- Tu lógica actual para mostrar los registros -->
                            <tr style="border: 1px solid #727176; font-weight: 600 !important;">
                                @if ($mecanico == "false")
                                    <td style="border: 1px solid #727176;">{{$item->concepto}} @if ($item->marca)
                                        , Marca: {{$item->marca}},
                                    @else

                                    @endif
                                    @if ($item->modelo)
                                        Modelo: {{$item->modelo}}
                                    @else

                                    @endif
                                    </td>
                                    <td style="border: 1px solid #727176;">{{ number_format($item->cantidad, 2) }}</td>
                                    <td style="border: 1px solid #727176;">${{ number_format($item->costo, 2, '.', ',') }}</td>
                                    <td style="border: 1px solid #727176;">${{ number_format($item->total, 2, '.', ',') }}</td>
                                @else
                                    <td style="border: 1px solid #727176;">{{$item->concepto}}
                                        @if ($item->marca)
                                        , Marca: {{$item->marca}},
                                    @else

                                    @endif
                                    @if ($item->modelo)
                                        Modelo: {{$item->modelo}}
                                    @else

                                    @endif</td>
                                    <td style="border: 1px solid #727176;">{{ number_format($item->cantidad, 2) }}</td>
                                @endif
                            </tr>
                            @empty
                            @endforelse

                            @for ($i = $gastos->count(); $i <= $espaciosBlanco; $i++)
                                <!-- Completa con filas vacías hasta llegar a 45 -->
                                @if ($mecanico == "false")
                                <tr>
                                    <td style="border: 1px solid #727176;">-</td>
                                    <td style="border: 1px solid #727176;">-</td>
                                    <td style="border: 1px solid #727176;">-</td>
                                    <td style="border: 1px solid #727176;">-</td>
                                </tr>
                                @else
                                <tr>
                                    <td style="border: 1px solid #727176;">-</td>
                                    <td style="border: 1px solid #727176;">-</td>
                                </tr>
                                @endif
                            @endfor

                            <tr style="border: 1px solid #727176;">
                                @if ($mecanico == "false")
                                <th scope="col" colspan="3" style="border-right: 1px solid black; font-weight: 500"> {{ $mantenimiento->comentario }}</th>
                                <td class="text-white" style="background-color: #727176; border: 1px solid black; padding: 5px; font-weight: bold !important; border-right: 1px solid black;">
                                    SUB-TOTAL <br>
                                    <span style="border-top: 1px solid black; display: block; padding-top: 5px;">I.V.A.</span>
                                    <span style="border-top: 1px solid black; display: block; padding-top: 5px;">TOTAL</span>
                                </td>
                                <td class="text-white" style="background-color: #727176; border: 1px solid black; padding: 5px; font-weight: bold !important;">
                                    <br>
                                    <span style="border-top: 1px solid black; display: block; border-bottom: 1px solid black; display: block; padding-top: 5px;">{{ 16 }}%</span>
                                    <br>
                                </td>
                                <td class="text-white" style="background-color: #727176; border: 1px solid black; padding: 5px; font-weight: bold !important;">
                                    $ {{number_format($mantenimiento->subtotal, 2, '.', ',')}}<br>
                                    <span style="border-top: 1px solid black; display: block; padding-top: 5px;">$ {{number_format($mantenimiento->iva, 2, '.', ',')}}<br></span>
                                    <span style="border-top: 1px solid black; display: block; padding-top: 5px;">$ {{number_format($mantenimiento->costo, 2, '.', ',')}}</span>
                                </td>
                                @else
                                    <th scope="col" colspan="6" style="border-right: 1px solid black; font-weight: 500; height: 75px;">{{ $mantenimiento->comentario }}</th>
                                @endif
                            </tr>

                            <tr style="border: 1px solid #727176; font-weight: 900">
                                <th style="border: 1px solid #727176;" scope="col" colspan="3"> LA PRESENTE BITÁCORA AMPARA EL ULTIMO MANTENIMIENTO REALIZADO EL</b></th>
                                <th style="border: 1px solid #727176;" scope="col" colspan="3">{{ isset($mantenimiento->fechaReal) ? $mantenimiento->fechaReal : "" }}</th>
                            </tr>

                            <tr style="border: 1px solid #727176; font-weight: 900">
                                <th style="border: 1px solid #727176;" scope="col" colspan="3"> PRÓXIMOS SERVICIOS PROGRAMADOS </th>
                                <th style="border: 1px solid #727176;" scope="col" colspan="3"> {{$mantenimiento->mantenimientoPrint}} </th>
                            </tr>
                        </tbody>
                        </table>
                        </div>

                    </div>
                    <br>


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
.page-break {
    page-break-after: always;
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
</style>



<style>
@media print {
    body * {
        visibility: hidden;

    }
    body {
        background: white;
    }
    #print-content * {
        visibility: visible !important;
    }
    #lineInvisible{
        visibility: hidden !important;
    }
    #print-content, #print-content {
        margin-left: -6mm;
        margin-right: -10mm;
        margin-top: -68mm !important;
    }

    body {
        {{--  margin-top: -63mm !important;  --}}
        padding: 0 !important;
    }
     /* Oculta el contenido después de la primera página */
     @page {
        size: letter;
        margin: 5mm;
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
    {{--  margin-top: 80px !important;  --}}
}


.custom-section {
    font-weight: 500 !important;
    font-size: 10px !important;
    border-radius: 2em;
    border-width: 1px;
    border-style: solid;
    border-color: #727176;
    color: white;
    height: 45px !important;
    width: calc(100% / 14);
    text-align: center;
    margin: 0;
    padding: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
}

.grey-section {
    background-color: #727176;
}

.white-section {
    color: black;
}
</style>

@endsection
