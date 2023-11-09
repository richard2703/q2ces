@extends('layouts.main', ['activePage' => 'servicios', 'titlePage' => __('Caja Chica')])
@section('content')
    <div class="content">
        @if ($errors->any())
            <!-- PARA LA CARGA DE LOS ERRORES DE LOS DATOS-->
            <div class="alert alert-danger">
                <p>Listado de errores a corregir</p>
                <ul>
                    @foreach ($errors->all() as $item)
                        <li>{{ $item }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header bacTituloPrincipal">
                                    <h4 class="card-title">Movimientos de Servicios</h4>
                                    {{-- <p class="card-category">Usuarios Registrados</p> --}}
                                </div>
                                <div class="card-body">
                                    @if (session('success'))
                                        <div class="alert alert-success" role="success">
                                            {{ session('success') }}
                                        </div>
                                    @endif
                                    @if (session('faild'))
                                        <div class="alert alert-danger" role="faild">
                                            {{ session('faild') }}
                                        </div>
                                    @endif
                                    <div class="row division">
                                        {{--  <div class="col-12 col-md-4">
                                            <p>Semana del</br> <span
                                                    class="combustibleLitros">{{ \Carbon\Carbon::parse($lunes)->locale('es')->isoFormat('dddd D MMMM') }}
                                                    al
                                                    {{ \Carbon\Carbon::parse($domingo)->locale('es')->isoFormat('dddd D MMMM') }}</span>
                                            </p>
                                        </div>

                                        <div class="col-3 col-md-2 text-center">
                                            <p class="">Semana Pasada</p>
                                            <p class="combustibleLitros fw-semibold text-black-50 ">$
                                                {{ isset($ultimoCorte->saldo) ? number_format($ultimoCorte->saldo, 2) : '0.00' }}
                                            </p>
                                            
                                        </div>
                                        <div class="col-3 col-md-2 text-center">
                                            <p class="">Ingreso</p>
                                            <p class="combustibleLitros fw-semibold text-success">$
                                                {{ number_format($ingreso, 2) }}</p>
                                        </div>
                                        <div class="col-3 col-md-2  text-center">
                                            <p class="">Egreso</p>
                                            <p class="combustibleLitros fw-semibold text-danger">$
                                                {{ number_format($egreso, 2) }}</p>
                                        </div>
                                        <div class="col-3 col-md-2 text-center">
                                            <p class="">Saldo</p>
                                            <p class="combustibleLitros fw-semibold ">$ {{ number_format($saldo, 2) }}
                                            </p>
                                        </div>
                                        <div class="row">
                                            <div class="col-6 text-left">
                                                @can('cajachica_create')
                                                    <button type="button" class="btn botonGral" data-bs-toggle="modal"
                                                        data-bs-target="#modal-reporte">
                                                        Reporte de Movimientos
                                                    </button>
                                                @endcan
                                            </div>

                                            <div class="col-6 d-flex justify-content-end">

                                                @if (date_diff(now(), $domingo->addDays(1))->format('%D%') <= 1 || !isset($ultimoCorte->saldo))
                                                    @can('cajachica_create')
                                                        <form action="{{ route('cajaChica.corte') }}" method="post">
                                                            @csrf
                                                            <input type="hidden" name="fin"
                                                                value={{ $lunes->subDays(1) }}>
                                                            <input type="hidden" name="inicio"
                                                                value={{ $lunes->subDays(6) }}>
                                                            <button type="submit" class="btn botonGral">Corte de
                                                                Caja</button>
                                                        </form>
                                                    @endcan
                                                @else
                                                @endif


                                                @can('cajachica_create')
                                                    <a href="{{ route('cajaChica.create') }}" class="ps-1">
                                                        <button type="button" class="btn botonGral">Nuevo Movimiento</button>
                                                    </a>
                                                @endcan
                                            </div>
                                        </div>  --}}
                                        <div class="row">
                                            <div class="col-6 text-left">
                                            </div>

                                            <div class="col-6 d-flex justify-content-end">

                                                @can('serviciosTrasporte_create')
                                                    <a href="{{ route('serviciosTrasporte.create') }}" class="ps-1">
                                                        <button type="button" class="btn botonGral">Programar Servicio</button>
                                                    </a>
                                                @endcan
                                            </div>
                                        </div>

                                    </div>
                                    <div class="table-responsive mt-2">
                                        <table class="table tablaCenter">
                                            <thead class="labelTitulo">
                                                <tr>
                                                    <th class="labelTitulo">Día</th>
                                                    <th class="labelTitulo">Concepto</th>
                                                    <th class="labelTitulo">Obra</th>
                                                    <th class="labelTitulo">Proyecto</th>
                                                    <th class="labelTitulo">Equipo</th>
                                                    <th class="labelTitulo">Personal</th>
                                                    <th class="labelTitulo">Gasto</th>
                                                    <th class="labelTitulo">Cobro</th>
                                                    <th class="labelTitulo">Estatus</th>
                                                    <th class="labelTitulo text-right" style="width: 130px !important;">
                                                        Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($registros as $registro)
                                                    <tr>
                                                        <td>{{ \Carbon\Carbon::parse($registro->fecha)->locale('es')->isoFormat('dddd D MMMM') }}
                                                        </td>
                                                        <td title={{ $registro->codigo }}>{{ $registro->cnombre }}</td>
                                                        {{--  <td title={{ $registro->ncomprobante }}>
                                                            {{ $registro->comprobante }}
                                                        </td>  --}}
                                                        {{--  <td>1234</td>  --}}
                                                        {{--  <td>{{ $registro->cliente }}</td>  --}}
                                                        <td>{{ $registro->obra ? $registro->obra : '---' }}
                                                            {{ $registro->cliente }}
                                                        </td>
                                                        <td>{{ $registro->proyecto ? $registro->proyecto : '---' }}
                                                            {{ $registro->centroCostos }}
                                                        </td>
                                                        <td>{{ $registro->identificador }} - {{ $registro->maquinaria }}
                                                        </td>
                                                        <td>{{ $registro->pnombre }} {{ $registro->papellidoP }}</td>
                                                        {{--  <td>ingreso</td>  --}}
                                                        <td>$
                                                            {{ number_format($registro->cantidad + $registro->costoMano, 2) }}
                                                            {{--  {{ number_format($registro->cantidad, 2) + number_format($registro->costoServicio, 2) }}  --}}
                                                        </td>
                                                        <td>$
                                                            {{ number_format($registro->costoServicio, 2) }}
                                                            {{--  {{ number_format($registro->cantidad, 2) + number_format($registro->costoServicio, 2) }}  --}}
                                                        </td>
                                                        <td
                                                            class=@switch($registro->estatus)
                                                            @case(1)
                                                                'yellow'
                                                            @break

                                                            @case(2)
                                                                'green'
                                                                
                                                            @break

                                                            @case(3)
                                                                'blue'
                                                            @break
                                                            @case(4)
                                                                'purple'
                                                            @break

                                                            @default
                                                            'red'
                                                        @endswitch>
                                                            @switch($registro->estatus)
                                                                @case(1)
                                                                    Espera
                                                                @break

                                                                @case(2)
                                                                    Hecho
                                                                @break

                                                                @case(3)
                                                                    Cerrado
                                                                    <a href="#" data-bs-toggle="modal" data-bs-target="#pagar"
                                                                        onclick="pagar('{{ $registro->id }}','{{ $registro->cnombre }}','{{ $registro->obra }}','{{ $registro->costoServicio }}')">
                                                                        <i class="far fa-money-bill-alt"
                                                                            style="color: #8caf48;font-size: x-large;"></i>
                                                                    </a>
                                                                @break

                                                                @case(4)
                                                                    Pagado
                                                                @break

                                                                @default
                                                                    Cancelado
                                                            @endswitch
                                                        </td>



                                                        <td class="td-actions text-right">
                                                            @can('serviciosTrasporte_show')
                                                                <a href="{{ route('serviciosTrasporte.show', $registro->id) }}"
                                                                    class="">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="28"
                                                                        height="28" fill="currentColor"
                                                                        class="bi bi-card-text accionesIconos"
                                                                        viewBox="0 0 16 16">
                                                                        <path
                                                                            d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z" />
                                                                        <path
                                                                            d="M3 5.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 8zm0 2.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5z" />
                                                                    </svg>
                                                                </a>
                                                            @endcan
                                                            @can('serviciosTrasporte_edit')
                                                                <a href="{{ route('serviciosTrasporte.edit', $registro->id) }}"
                                                                    class="">
                                                                    <svg xmlns="http://www.w3.org/2000/svg " width="28"
                                                                        height="28" fill="currentColor"
                                                                        class="bi bi-pencil accionesIconos"
                                                                        style="color: black;" viewBox="0 0 16 16">
                                                                        <path
                                                                            d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                                                                    </svg>
                                                                </a>
                                                            @endcan
                                                            {{--  @can('user_destroy')
                                                                <form
                                                                    action="{{ route('serviciosTrasporte.destroy', $registro->id) }}"
                                                                    method="POST" style="display: inline-block;"
                                                                    onsubmit="return confirm('Seguro?')">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button class="btnSinFondo" type="submit" rel="tooltip">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="28"
                                                                            height="28" fill="currentColor"
                                                                            class="bi bi-x-circle" viewBox="0 0 16 16">
                                                                            <path
                                                                                d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                                            <path
                                                                                d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                                                                        </svg>
                                                                    </button>
                                                                </form>
                                                            @endcan  --}}

                                                            @can('servicio_Chofer')
                                                                <a href="#" data-bs-toggle="modal"
                                                                    data-bs-target="#editarItem"
                                                                    onclick="cargaItem('{{ $registro->id }}','{{ $registro->pnombre }}','{{ $registro->papellidoP }}','{{ $registro->comentario }}')">
                                                                    <svg xmlns="http://www.w3.org/2000/svg " width="28"
                                                                        height="28" fill="currentColor"
                                                                        class="bi bi-pencil accionesIconos" viewBox="0 0 16 16">
                                                                        <path
                                                                            d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                                                                    </svg>
                                                                </a>
                                                            @endcan

                                                            @if ($registro->estatus != 1)
                                                                <a href="{{ route('serviciosTrasporte.printTicketChofer', $registro->id) }}"
                                                                    <i class="fas fa-print "
                                                                    style="color: #8caf48;font-size: x-large;"></i>
                                                                </a>
                                                                @can('serviciosTrasporte_show')
                                                                    <a href="{{ route('serviciosTrasporte.printTicketCerrado', $registro->id) }}"
                                                                        <i class="fas fa-print "
                                                                        style="font-size: x-large;"></i>
                                                                    </a>
                                                                @endcan
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
                                    <div class="card-footer mr-auto">
                                        {{ $registros->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--MODALES-->
        <div class="modal fade" id="editarItem" tabindex="-1" aria-labelledby="exampleModalLabelEdit" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bacTituloPrincipal">
                        <h1 class="modal-title fs-5" id="exampleModalLabelEdit">&nbsp Viaje de Servicio </label>
                        </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="row d-flex" action="{{ route('serviciosTrasporte.misServiciosChofer') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <input type="hidden" name="id" value="" id="id">

                            <div class="col-6  mb-3 ">
                                <label class="labelTitulo">Quien Recibe:</label></br>
                                <input type="text" class="inputCaja" id="recibe" name="recibe" value="">
                            </div>

                            <div class="col-6  mb-3 ">
                                <label class="labelTitulo">Odometro: <span>*</span></label></br>
                                <input type="number" class="inputCaja text-right" id="odometro" name="odometro"
                                    maxlength="100000" step="0.01" min="0.01" max="99999" placeholder="ej. 100"
                                    value="">
                            </div>

                            <div class=" col-12  mb-3 ">
                                <label class="labelTitulo">Comentario:</label></br>
                                <textarea id="comentario" class="inputCaja" name="comentario" rows="5" cols="30"></textarea>
                            </div>

                            {{--  <div class=" col-12 col-sm-6  mb-3 ">
                                <label class="labelTitulo">Número Motor:</label></br>
                                <input type="text" class="inputCaja" id="nummotor" placeholder="Ej. NUM0123ABCD"
                                    name="nummotor" value="">
                            </div>

                            <div class=" col-12 col-sm-6  mb-3 ">
                                <label class="labelTitulo">Proximo Mantenimiento:</label></br>
                                <input type="text" class="inputCaja" id="mantenimiento"
                                    placeholder="Kilometraje para proximo mantenimiento" name="mantenimiento" value="">
                            </div>  --}}

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <div id="contenedorBotonGuardar">
                                    <button type="submit" class="btn botonGral" id="btnTareaGuardar"
                                        onclick="alertaGuardar()">Terminar viaje</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="pagar" tabindex="-1" aria-labelledby="exampleModalLabelEdit" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bacTituloPrincipal">
                        <h1 class="modal-title fs-5" id="exampleModalLabelEdit">&nbsp Servicio Pagado? </label>
                        </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="row d-flex" action="{{ route('serviciosTrasporte.pagado') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <input type="hidden" name="id" value="" id="cid">

                            <div class="col-6  mb-3 ">
                                <label class="labelTitulo">Servicio:</label></br>
                                <input type="text" class="inputCaja" id="Cservicio" name="Cservicio" value=""
                                    readonly>
                            </div>

                            <div class="col-6  mb-3 ">
                                <label class="labelTitulo">Obra: </label></br>
                                <input type="text" class="inputCaja" id="Cobra" name="Cobra" value=""
                                    readonly>
                            </div>

                            <div class="col-6  mb-3 ">
                                <label class="labelTitulo">Cobro:</label></br>
                                <input type="text" class="inputCaja text-right" id="Ccobro" name="Ccobro"
                                    value="" readonly>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <div id="contenedorBotonGuardar">
                                    <button type="submit" class="btn botonGral" id="btnTareaGuardar"
                                        onclick="alertaGuardar()">Cobrar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    <script>
        function cargaItem(id, pnombre, papellidoP, comentario) {

            const txtId = document.getElementById('id');
            txtId.value = id;

            const txtRecibe = document.getElementById('recibe');
            txtRecibe.value = pnombre + ' ' + papellidoP;

            //const txtNummotor = document.getElementById('nummotor');
            //txtNummotor.value = nummotor;

            //const txtMantenimiento = document.getElementById('mantenimiento');
            //txtMantenimiento.value = mantenimiento;

            const txtComentarios = document.getElementById('comentario');
            txtComentarios.value = comentario;
        }
    </script>
    {{ $registro->id }}','{{ $registro->cnombre }}','{{ $registro->obra }}','{{ $registro->costoServicio }}
    <script>
        function pagar(id, cnombre, obra, Ccobro) {

            const txtId = document.getElementById('cid');
            txtId.value = id;

            const txtServicio = document.getElementById('Cservicio');
            txtServicio.value = cnombre;

            const txtCobra = document.getElementById('Cobra');
            txtCobra.value = obra;

            const txtCcobro = document.getElementById('Ccobro');
            txtCcobro.value = Ccobro;
        }
    </script>
    <script>
        function Guardado() {
            // alert('test');
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: 'success',
                title: 'Guardado con exito'
            })
        }
        var slug = '1';
        if (slug == 1) {
            Guardado();

        }
    </script>
