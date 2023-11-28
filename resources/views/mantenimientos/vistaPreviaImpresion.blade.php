@extends('layouts.main', ['activePage' => 'inventario', 'titlePage' => __('Inventario')])
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card" >
                    <div class="card-header bacTituloPrincipal">
                        {{-- <p class="card-category">Usuarios registrados</p> --}}
                        Vista Previa de Impresion del Mantenimiento
                    </div>
                    <div class="card-body">
                        <div class="row divBorder">
                            <div class="col-6 text-right">  
                                <a href="{{ route('mantenimientos.index') }}">
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
                                    <button type="button" onclick="print()" class="btn botonGral text-capitalize">Imprimir</button>
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
                        <div class="row">
                            <div class="col-2 text-start">
                                <img src="{{ asset('/img/maquinariaPrint/Logo q2cem.svg') }}" alt="" width="75px;" class="mt-1">    
                            </div>
                            <div class="col-8" style="margin-left: -10px">
                                <div class="row">
                                    <div class="col text-center">
                                        <h3 style="color: #a6ce34; font-weight: bold">Q2S, S.A de C.V.</h3>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col text-center">
                                        <div class="copyright" style="font-size: 7px; font-weight: bold; color: #727176">
                                            Oficina: José María Herédia No. 2387. Colonia Lomas de Guevara. Guadalajara, Jalisco. México C.P. 44657. Tel: 33-3640-2290. <br>
                                            Taller: San Juan de los Lagos No. 1788. Colonia Hogares de Nuevo México. C.P. 45138. Tel: 33-3857-4027. www.q2ces.com <br>
                                            <div id="lineInvisible" style="visibility: hidden">.................................................................................................................................................................................................................................................................................................</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col text-center" style="margin-top: -15px">
                                        <div class="d-flex align-items-center p-2 justify-content-center" style="font-weight: 500 !important; font-size: 14px !important; border-radius: 2em; background-color: #727176; color: white; height: 20px !important;">
                                            BITÁCORA DE MANTENIMIENTO DE MAQUINARIA Y EQUIPO
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-2 text-end mt-2" >
                                <div class="d-flex align-items-center p-2 justify-content-center" style="font-weight: 500 !important; font-size: 12px !important; background-color: #727176; color: black; height: 20px !important;">
                                    <b>FOLIO</b>
                                </div>
                                <div class="d-flex align-items-center p-1 justify-content-center" style="font-weight: 500 !important; font-size: 12px !important;border-width: 1px; border-style: solid; border-color: #727176; color: red; height: 20px !important;">
                                    M-20923
                                    
                                </div>
                            </div>


                        </div>   
                        <div class="col-12" style="margin-top: 5px; margin-right: 10px;">
                            <div class="d-flex align-items-center p-1 justify-content-center" style="font-weight: 500 !important; font-size: 8px !important; border-radius: 2em;border-width: 1px; border-style: solid; border-color: #727176; background-color: white; color: black; height: 20px !important;">
                                <div class="d-flex align-items-center justify-content-center custom-section grey-section" style="margin-left: -30px;">
                                    <b>Equipo:</b>
                                </div>
                                <div class="d-flex align-items-center justify-content-center custom-section white-section" style="border: none">
                                    Seat Ibitza
                                </div>

                                <div class="d-flex align-items-center justify-content-center custom-section grey-section" style="width: 50px">
                                    <b>VIN:</b>
                                </div>
                                <div class="d-flex align-items-center justify-content-center custom-section white-section" style="border: none; width: 90px">
                                    VSSMK46J8CR033104
                                </div>

                                <div class="d-flex align-items-center justify-content-center custom-section grey-section">
                                    <b>MARCA:</b>
                                </div>
                                <div class="d-flex align-items-center justify-content-center custom-section white-section" style="border: none">
                                    Nissan Kicks
                                </div>

                                <div class="d-flex align-items-center justify-content-center custom-section grey-section">
                                    <b>MODELO:</b>
                                </div>
                                <div class="d-flex align-items-center justify-content-center custom-section white-section" style="border: none">
                                    Ibitza
                                </div>

                                <div class="d-flex align-items-center justify-content-center custom-section grey-section" style="width: 30px">
                                    <b>AÑO:</b>
                                </div>
                                <div class="d-flex align-items-center justify-content-center custom-section white-section" style="border: none; width: 30px">
                                    2029
                                </div>

                                <div class="d-flex align-items-center justify-content-center custom-section grey-section">
                                    <b>PLACAS:</b>
                                </div>
                                <div class="d-flex align-items-center justify-content-center custom-section white-section" style="border: none">
                                    Seat JJM6231
                                </div>

                                <div class="d-flex align-items-center justify-content-center custom-section grey-section" style="width: 65px">
                                    <b>N/ECONÓMICO:</b>
                                </div>
                                <div class="d-flex align-items-center justify-content-center custom-section white-section" style="border: none">
                                    MTQ-1000
                                </div>

                            </div>
                            
                        </div>  
                        
                        <div class="col-12 " style="margin-top: 5px; margin-right: 10px;">
                            <table class="d-flex align-items-center justify-content-center"  style="font-weight: bold; font-size: 8px; width: auto; height: auto; border-spacing: 0px !important;">
                                <tbody>
                                    <tr style="border: 1px solid #727176; ">
                                        <td rowspan="2" class="text-white" style="height: 5px; background-color: #727176; width: 10px;"><b>Fecha <br> DD/MM/AA</b></td>
                                        <td rowspan="2" class="" style="width: 10px; border: 1px solid #727176;">HOROMETRO <br> KM/MILLAS</td>
                                        <th colspan="4" class="text-white" style="background-color: #727176; height: 10px;  "><b>DESCRIPCIÓN DE MANTENIMIENTO REALIZADO</b></th>
                                    </tr>
                                    <tr style="border: 1px solid #727176;">
                                        @if ($mecanico == "false")
                                            <th scope="col" style="width: 500px;">MATERIAL y/o MANO DE OBRA</th>
                                            <th scope="col" class="text-white" style="   background-color: #727176; height: 10px !important"><b> CANTIDAD</b></th>
                                            <th scope="col" style="width: 15px !important   ">COSTO</th>
                                            <th scope="col" class="text-white" style="  background-color: #727176; height: 10px !important"><b>IMPORTE</b></th>    
                                        @else
                                            <th scope="col" style="width: 700px;">MATERIAL y/o MANO DE OBRA</th>
                                            <th scope="col" class="text-white" style="   background-color: #727176; height: 10px !important"><b> CANTIDAD</b></th>
                                        @endif
                                    </tr>
                                    <tr style="border: 1px solid #727176;">
                                        <th rowspan="18" scope="rowgroup" style="vertical-align: middle; border: 1px solid #727176;">20/07/23</th>
                                        <th rowspan="18" scope="rowgroup" style="vertical-align: middle; border: 1px solid #727176;">2263979</th>
                                        @if ($mecanico == "false")
                                            <td style="border: 1px solid #727176;">56</td>
                                            <td style="border: 1px solid #727176;">22</td>
                                            <td style="border: 1px solid #727176;">43</td>
                                            <td style="border: 1px solid #727176;">72</td>    
                                        @else
                                            <td style="border: 1px solid #727176;">56</td>
                                            <td style="border: 1px solid #727176;">22</td>
                                        
                                        @endif
                                        
                                    </tr>
                                    <tr style="border: 1px solid #727176; ">
                                        @if ($mecanico == "false")
                                            <td style="border: 1px solid #727176;">56</td>
                                            <td style="border: 1px solid #727176;">22</td>
                                            <td style="border: 1px solid #727176;">43</td>
                                            <td style="border: 1px solid #727176;">72</td>    
                                        @else
                                            <td style="border: 1px solid #727176;">56</td>
                                            <td style="border: 1px solid #727176;">22</td>
                                        
                                        @endif
                                    </tr>
                                    <tr style="border: 1px solid #727176; ">
                                        @if ($mecanico == "false")
                                        <td style="border: 1px solid #727176;">56</td>
                                        <td style="border: 1px solid #727176;">22</td>
                                        <td style="border: 1px solid #727176;">43</td>
                                        <td style="border: 1px solid #727176;">72</td>    
                                    @else
                                        <td style="border: 1px solid #727176;">56</td>
                                        <td style="border: 1px solid #727176;">22</td>
                                    
                                    @endif
                                    </tr>
                                    <tr style=" border: 1px solid #727176;">
                                        
                                        @if ($mecanico == "false")
                                            <td style="border: 1px solid #727176;">56</td>
                                            <td style="border: 1px solid #727176;">22</td>
                                            <td style="border: 1px solid #727176;">43</td>
                                            <td style="border: 1px solid #727176;">72</td>    
                                        @else
                                            <td style="border: 1px solid #727176;">56</td>
                                            <td style="border: 1px solid #727176;">22</td>
                                        
                                        @endif
                                    </tr>
                                    <tr style="border: 1px solid #727176; ">
                                        @if ($mecanico == "false")
                                            <td style="border: 1px solid #727176;">56</td>
                                            <td style="border: 1px solid #727176;">22</td>
                                            <td style="border: 1px solid #727176;">43</td>
                                            <td style="border: 1px solid #727176;">72</td>    
                                        @else
                                            <td style="border: 1px solid #727176;">56</td>
                                            <td style="border: 1px solid #727176;">22</td>
                                        
                                        @endif
                                    </tr>
                                    <tr style=" border: 1px solid #727176;">
                                        
                                        @if ($mecanico == "false")
                                            <td style="border: 1px solid #727176;">56</td>
                                            <td style="border: 1px solid #727176;">22</td>
                                            <td style="border: 1px solid #727176;">43</td>
                                            <td style="border: 1px solid #727176;">72</td>    
                                        @else
                                            <td style="border: 1px solid #727176;">56</td>
                                            <td style="border: 1px solid #727176;">22</td>
                                        
                                        @endif
                                    </tr>
                                    <tr style="border: 1px solid #727176; ">
                                        @if ($mecanico == "false")
                                            <td style="border: 1px solid #727176;">56</td>
                                            <td style="border: 1px solid #727176;">22</td>
                                            <td style="border: 1px solid #727176;">43</td>
                                            <td style="border: 1px solid #727176;">72</td>    
                                        @else
                                            <td style="border: 1px solid #727176;">56</td>
                                            <td style="border: 1px solid #727176;">22</td>
                                        
                                        @endif
                                    </tr>
                                    <tr style="border: 1px solid #727176; ">
                                        @if ($mecanico == "false")
                                            <td style="border: 1px solid #727176;">56</td>
                                            <td style="border: 1px solid #727176;">22</td>
                                            <td style="border: 1px solid #727176;">43</td>
                                            <td style="border: 1px solid #727176;">72</td>    
                                        @else
                                            <td style="border: 1px solid #727176;">56</td>
                                            <td style="border: 1px solid #727176;">22</td>
                                        
                                        @endif
                                    </tr>
                                    <tr style=" border: 1px solid #727176;">
                                        
                                        @if ($mecanico == "false")
                                            <td style="border: 1px solid #727176;">56</td>
                                            <td style="border: 1px solid #727176;">22</td>
                                            <td style="border: 1px solid #727176;">43</td>
                                            <td style="border: 1px solid #727176;">72</td>    
                                        @else
                                            <td style="border: 1px solid #727176;">56</td>
                                            <td style="border: 1px solid #727176;">22</td>
                                        
                                        @endif
                                    </tr>
                                    <tr style="border: 1px solid #727176; ">
                                        @if ($mecanico == "false")
                                            <td style="border: 1px solid #727176;">56</td>
                                            <td style="border: 1px solid #727176;">22</td>
                                            <td style="border: 1px solid #727176;">43</td>
                                            <td style="border: 1px solid #727176;">72</td>    
                                        @else
                                            <td style="border: 1px solid #727176;">56</td>
                                            <td style="border: 1px solid #727176;">22</td>
                                        
                                        @endif
                                    </tr>
                                    <tr style=" border: 1px solid #727176;">
                                        
                                        @if ($mecanico == "false")
                                            <td style="border: 1px solid #727176;">56</td>
                                            <td style="border: 1px solid #727176;">22</td>
                                            <td style="border: 1px solid #727176;">43</td>
                                            <td style="border: 1px solid #727176;">72</td>    
                                        @else
                                            <td style="border: 1px solid #727176;">56</td>
                                            <td style="border: 1px solid #727176;">22</td>
                                        
                                        @endif
                                    </tr>

                                    <tr style="border: 1px solid #727176; ">
                                        @if ($mecanico == "false")
                                            <td style="border: 1px solid #727176;">56</td>
                                            <td style="border: 1px solid #727176;">22</td>
                                            <td style="border: 1px solid #727176;">43</td>
                                            <td style="border: 1px solid #727176;">72</td>    
                                        @else
                                            <td style="border: 1px solid #727176;">56</td>
                                            <td style="border: 1px solid #727176;">22</td>
                                        
                                        @endif
                                    </tr>
                                    <tr style=" border: 1px solid #727176;">
                                        
                                        @if ($mecanico == "false")
                                            <td style="border: 1px solid #727176;">56</td>
                                            <td style="border: 1px solid #727176;">22</td>
                                            <td style="border: 1px solid #727176;">43</td>
                                            <td style="border: 1px solid #727176;">72</td>    
                                        @else
                                            <td style="border: 1px solid #727176;">56</td>
                                            <td style="border: 1px solid #727176;">22</td>
                                        
                                        @endif
                                    </tr>
                                    <tr style="border: 1px solid #727176; ">
                                        @if ($mecanico == "false")
                                            <td style="border: 1px solid #727176;">56</td>
                                            <td style="border: 1px solid #727176;">22</td>
                                            <td style="border: 1px solid #727176;">43</td>
                                            <td style="border: 1px solid #727176;">72</td>    
                                        @else
                                            <td style="border: 1px solid #727176;">56</td>
                                            <td style="border: 1px solid #727176;">22</td>
                                        
                                        @endif
                                    </tr>
                                    <tr style=" border: 1px solid #727176;">
                                        
                                        @if ($mecanico == "false")
                                            <td style="border: 1px solid #727176;">56</td>
                                            <td style="border: 1px solid #727176;">22</td>
                                            <td style="border: 1px solid #727176;">43</td>
                                            <td style="border: 1px solid #727176;">72</td>    
                                        @else
                                            <td style="border: 1px solid #727176;">56</td>
                                            <td style="border: 1px solid #727176;">22</td>
                                        
                                        @endif
                                    </tr>

                                    <tr style=" border: 1px solid #727176;">
                                        
                                        @if ($mecanico == "false")
                                            <td style="border: 1px solid #727176;">56</td>
                                            <td style="border: 1px solid #727176;">22</td>
                                            <td style="border: 1px solid #727176;">43</td>
                                            <td style="border: 1px solid #727176;">72</td>    
                                        @else
                                            <td style="border: 1px solid #727176;">56</td>
                                            <td style="border: 1px solid #727176;">22</td>
                                        
                                        @endif
                                    </tr>
                                    <tr style="border: 1px solid #727176; ">
                                        @if ($mecanico == "false")
                                            <td style="border: 1px solid #727176;">56</td>
                                            <td style="border: 1px solid #727176;">22</td>
                                            <td style="border: 1px solid #727176;">43</td>
                                            <td style="border: 1px solid #727176;">72</td>    
                                        @else
                                            <td style="border: 1px solid #727176;">56</td>
                                            <td style="border: 1px solid #727176;">22</td>
                                        
                                        @endif
                                    </tr>
                                    <tr style=" border: 1px solid #727176;">
                                        
                                        @if ($mecanico == "false")
                                            <td style="border: 1px solid #727176;">56</td>
                                            <td style="border: 1px solid #727176;">22</td>
                                            <td style="border: 1px solid #727176;">43</td>
                                            <td style="border: 1px solid #727176;">72</td>    
                                        @else
                                            <td style="border: 1px solid #727176;">56</td>
                                            <td style="border: 1px solid #727176;">22</td>
                                        
                                        @endif
                                    </tr>

                                    <tr style="border: 1px solid #727176;">
                                        @if ($mecanico == "false")
                                        <th scope="col" colspan="3" style="border-right: 1px solid black;"> Lorem ipsum dolor sit amet consectetur, sapiente odit! Accusamus est, excepturi, dignissimos consequuntur eum inventore veritatis consequatur nam sint culpa sequi repudiandae!</th>
                                        <td class="text-white" style="background-color: #727176; border: 1px solid black; padding: 5px; font-weight: bold !important; border-right: 1px solid black;">
                                            SUB-TOTAL <br> 
                                            <span style="border-top: 1px solid black; display: block; padding-top: 5px;">I.V.A.</span>
                                            <span style="border-top: 1px solid black; display: block; padding-top: 5px;">TOTAL</span>
                                        </td>
                                        <td class="text-white" style="background-color: #727176; border: 1px solid black; padding: 5px; font-weight: bold !important;">
                                            <br> 
                                            <span style="border-top: 1px solid black; display: block; border-bottom: 1px solid black; display: block; padding-top: 5px;">16%</span>
                                            <br>
                                        </td>
                                        <td class="text-white" style="background-color: #727176; border: 1px solid black; padding: 5px; font-weight: bold !important;">
                                            $9,389.30<br>
                                            <span style="border-top: 1px solid black; display: block; padding-top: 5px;">$1,520.29</span>
                                            <span style="border-top: 1px solid black; display: block; padding-top: 5px;">$10,891.51</span>
                                        </td>
                                        @else
                                            <th scope="col" colspan="6" style="border-right: 1px solid black;">No Entra Lorem ipsum dolor sit amet consectetur, sapiente odit! Accusamus est, excepturi, dignissimos consequuntur eum inventore veritatis consequatur nam sint culpa sequi repudiandae!</th>
                                        @endif
                                    </tr>

                                    <tr style="border: 1px solid #727176; ">
                                        <th style="border: 1px solid #727176;" scope="col" colspan="3"> <b> LA PRESENTE BITÁCORA AMPARA EL ULTIMO MANTENIMIENTO REALIZADO EL</b></th>
                                        <th style="border: 1px solid #727176;" scope="col" colspan="3"> <b> 20/07/23 </b></th>
                                    </tr>

                                    <tr style="border: 1px solid #727176; ">
                                        <th style="border: 1px solid #727176;" scope="col" colspan="3"> <b> PRÓXIMOS SERVICIOS PROGRAMADOS </b></th>
                                        <th style="border: 1px solid #727176;" scope="col" colspan="3"> <b> 09/02/24 </b></th>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="mt-2" style="display: flex; flex-direction: column; align-items: center;">
                                <!-- Primera sección de imágenes -->
                                <div style="display: flex; justify-content: space-between;">
                                    <div style="width: 195px; height: 100px; margin: 3px; border: 1px solid #727176; padding: 3px; overflow: hidden;">
                                        <img src="{{ asset('/img/general/default.jpg') }}" style="height: 100%; object-fit: cover;" >
                                    </div>
                                    
                                    <div style="width: 195px; height: 100px; margin: 3px; border: 1px solid #727176; padding: 3px; overflow: hidden;">
                                        <img src="{{ asset('/img/general/default.jpg') }}" style="height: 100%; object-fit: cover;" >
                                    </div>
                                    <div style="width: 195px; height: 100px; margin: 3px; border: 1px solid #727176; padding: 3px; overflow: hidden;">
                                        <img src="{{ asset('/img/general/default.jpg') }}" style="height: 100%; object-fit: cover;" >
                                    </div>
                                    <div style="width: 195px; height: 100px; margin: 3px; border: 1px solid #727176; padding: 3px; overflow: hidden;">
                                        <img src="{{ asset('/img/general/default.jpg') }}" style="height: 100%; object-fit: cover;" >
                                    </div>
                                </div>
                                <!-- Segunda sección de imágenes -->
                                <div style="display: flex; justify-content: space-between;">
                                    <div style="width: 195px; height: 100px; margin: 3px; border: 1px solid #727176; padding: 3px; overflow: hidden;">
                                        <img src="{{ asset('/img/general/default.jpg') }}" style="height: 100%; object-fit: cover;" >
                                    </div>
                                    <div style="width: 195px; height: 100px; margin: 3px; border: 1px solid #727176; padding: 3px; overflow: hidden;">
                                        <img src="{{ asset('/img/general/default.jpg') }}" style="height: 100%; object-fit: cover;" >
                                    </div>
                                    <div style="width: 195px; height: 100px; margin: 3px; border: 1px solid #727176; padding: 3px; overflow: hidden;">
                                        <img src="{{ asset('/img/general/RecursoTest.png') }}" style="height: 100%; object-fit: cover;" >
                                    </div>
                                    <div style="width: 195px; height: 100px; margin: 3px; border: 1px solid #727176; padding: 3px; overflow: hidden;">
                                        <img src="{{ asset('/img/general/RecursoTest.png') }}" style="height: 100%; object-fit: cover;" >
                                    </div>
                                </div>

                                <!-- Tercera sección de sellos y imagenes -->
                                <div class="mt-1" style="display: flex; justify-content: space-between;">      
                                    <div style="margin-top: 3px; width: 30%; height: 165px; border: 1px solid #727176; text-align: center; font-size:8px"><div class="mt-1"><b>SELLO DE TALLER</b></div></div>
                                    
                                    <div style="width: 320px; height: 165px; margin: 3px; border: 1px solid #727176; padding: 3px; overflow: hidden;">
                                        <img class="img-fluid" src="{{ asset('/img/general/default.jpg') }}" style="height: 100%; object-fit: cover;">
                                    </div>
                                    
                                    <div style="width: 320px; height: 165px; margin: 3px; border: 1px solid #727176; padding: 3px; overflow: hidden;">
                                        <img class="img-fluid" src="{{ asset('/img/general/RecursoTest.png') }}" style="height: 100%; object-fit: cover;">
                                    </div>      
                                    <div style="margin-top: 3px; width: 30%; height: 165px; border: 1px solid #727176; text-align: center; font-size:8px"><div class="mt-1"><b>SELLO DE OFICINA</b></div></div>
                                </div>
                            </div>

                        <div class="row d-flex align-items-center justify-content-center" style="margin-top: -20px">
                            <div class="col-3">
                                <div style="margin-top: 20px; text-align: center; font-size: 9px; font-weight: bold">
                                    <p>VO.BO</p>
                                    <div class="pt-4">
                                        _________________________________<br>
                                        COORDINADOR TALLER<br>
                                        Edgar Villalobos Gómez
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div style="margin-top: 20px; text-align: center; font-size: 9px; font-weight: bold">
                                    <p>AUDITORIA INTERNA</p>
                                    <div class="pt-4">
                                        _________________________________<br>
                                        COORDINADOR OPERACIONES<br>
                                        José Israel López López
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div style="margin-top: 20px; text-align: center; font-size: 9px; font-weight: bold">
                                    <p>REVISÓ</p>
                                    <div class="pt-4">
                                        _________________________________<br>
                                        MECÁNICO<br>
                                        Eduardo Navarrete Haro
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div style="margin-top: 20px; text-align: center; font-size: 9px; font-weight: bold">
                                    <p>RECIBIÓ</p>
                                    <div class="pt-4">
                                        _________________________________<br>
                                        RESPONSABLE DEL EQUIPO<br>
                                        Jesús Esparza Serna
                                    </div>
                                </div>
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
print(){
    window.print();
}
</script>


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
    #lineInvisible{
        visibility: hidden !important;
    }
    #print-content, #print-content {
        margin-left: -6mm;
        margin-right: -10mm;
        margin-top: -58mm !important;
    }
    
    body {
        {{--  margin-top: -63mm !important;  --}}
        padding: 0 !important;
        margin: 0;
    }

    /* Define el contenido para la primera página */
    @page {
        size: letter; /* Define el tamaño de la página (A4 es un ejemplo) */
        margin: 0; /* Elimina los márgenes para la página */
    }

    /* Define que solo la primera página será impresa */
    @page :first {
        margin: 0; /* Elimina los márgenes para la primera página */
        size: A4; /* Define el tamaño de la página */
        /* Puedes añadir más estilos específicos si es necesario */
    }

    /* Oculta todo el contenido después de la primera página */
    @page :first + * {
        display: none;
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
    font-size: 7px !important;
    border-radius: 2em;
    border-width: 1px;
    border-style: solid;
    border-color: #727176;
    color: white;
    height: 20px !important;
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
