@extends('layouts.main', ['activePage' => 'cajaChica', 'titlePage' => __('Caja Chica')])
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
                                    <h4 class="card-title">Corte de Caja Chica</h4>
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
                                        <div class="col-12 col-md-4">
                                            <p>Semana del</br> <span
                                                    class="combustibleLitros">{{ \Carbon\Carbon::parse($lunes)->locale('es')->isoFormat('dddd D MMMM') }}
                                                    al
                                                    {{ \Carbon\Carbon::parse($domingo)->locale('es')->isoFormat('dddd D MMMM') }}</span>
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
                                            <div class="col-12 text-end">
                                                @can('cajachica_create')
                                                    <form action="{{ route('cajaChica.cerrar') }}" method="post"
                                                        class="advertencia">
                                                        @csrf
                                                        <input type="hidden" name="fin" value={{ $domingo }}>
                                                        <input type="hidden" name="inicio" value={{ $lunes }}>
                                                        <button type="submit" class="btn botonGral"
                                                            onClick=advertencia()>Cerrar Corte</button>
                                                    </form>
                                                @endcan


                                            </div>


                                        </div>

                                    </div>
                                    <div class="table-responsive mt-2">
                                        <table class="table tablaCenter">
                                            <thead class="labelTitulo">
                                                <tr>
                                                    <th class="labelTitulo">Día</th>
                                                    <th class="labelTitulo" style="width: 120px !important;">Concepto</th>
                                                    <th class="labelTitulo" style="width: 160px !important;">Comprobante
                                                    </th>
                                                    {{--  <th class="labelTitulo">N. Comprobante</th>  --}}
                                                    <th class="labelTitulo">Cliente</th>
                                                    <th class="labelTitulo">Obra</th>
                                                    <th class="labelTitulo">Equipo</th>
                                                    <th class="labelTitulo" style="width: 130px !important;">Personal</th>
                                                    {{--  <th class="labelTitulo">Tipo</th>  --}}
                                                    <th class="labelTitulo" style="width: 130px !important;">Cantidad</th>
                                                    <th class="labelTitulo text-right" style="width: 130px !important;">
                                                        Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($registros as $registro)
                                                    <tr>
                                                        <td>{{ \Carbon\Carbon::parse($registro->dia)->locale('es')->isoFormat('dddd D MMMM') }}
                                                        </td>
                                                        <td title={{ $registro->codigo }}>{{ $registro->cnombre }}</td>
                                                        <td title={{ $registro->ncomprobante }}>
                                                            {{ $registro->comprobante }}
                                                        </td>
                                                        {{--  <td>1234</td>  --}}
                                                        <td>{{ $registro->cliente }}</td>
                                                        <td>{{ $registro->obra ? $registro->obra : '---' }}</td>
                                                        <td>{{ $registro->identificador }} - {{ $registro->maquinaria }}
                                                        </td>
                                                        <td>{{ $registro->pnombre }} {{ $registro->papellidoP }}</td>
                                                        {{--  <td>ingreso</td>  --}}
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
                                                            $ {{ number_format($registro->cantidad, 2) }}</td>
                                                        <td class="td-actions text-right">
                                                            @can('cajachica_show')
                                                                <a href="{{ route('cajaChica.show', $registro->id) }}"
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
                                                            @can('cajachica_edit')
                                                                <a href="{{ route('cajaChica.edit', $registro->id) }}"
                                                                    class="">
                                                                    <svg xmlns="http://www.w3.org/2000/svg " width="28"
                                                                        height="28" fill="currentColor"
                                                                        class="bi bi-pencil accionesIconos" viewBox="0 0 16 16">
                                                                        <path
                                                                            d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                                                                    </svg>
                                                                </a>
                                                            @endcan
                                                            {{-- @can('user_destroy') --}}
                                                            {{-- <form action="{{ route('maquinaria.delete', $maquina->id) }}"
                                                                method="POST" style="display: inline-block;"
                                                                onsubmit="return confirm('Seguro?')">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button class="btnSinFondo" type="submit" rel="tooltip">
                                                                    <svg xmlns="http://www.w3.org/2000/svg"  width="28" height="28"  fill="currentColor"  class="bi bi-x-circle"  viewBox="0 0 16 16">
                                                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                                                                    </svg>
                                                                </button>
                                                            </form> --}}
                                                            {{-- @endcan --}}
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="2">Sin Registros.</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>

                                        </table>
                                        {{--  <table class="table tablaCenter">
                                            <thead class="labelTitulo">
                                                <tr>
                                                    <th class="labelTitulo" style="width: 130px !important;">Personal</th>
                                                    <th class="labelTitulo">Ingreso</th>
                                                    <th class="labelTitulo">Egreso</th>
                                                    <th class="labelTitulo">Saldo</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($registros as $registro)
                                                    <tr>
                                                        <td>{{ $registro->pnombre }} {{ $registro->papellidoP }}</td>
                                                        <td>{{ $registro->total_ingresos }}</td>
                                                        <td>{{ $registro->total_egresos }}</td>
                                                        <td>{{ $registro->total_ingresos - $registro->total_egresos }}</td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="2">Sin Registros.</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>  --}}
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

@endsection
<script>
    function advertencia() {

        $('.advertencia').submit(function(e) {
            e.preventDefault();

            Swal.fire({
                title: 'Estas seguro?',
                text: "¡Cerrado el corte, no se puedra hacer modificar de movimientos en ese periodo!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Cancelar',
                confirmButtonText: 'Si, Cerrarlo!'
            }).then((result) => {
                if (result.isConfirmed) {
                    mostrarSpinner(true);
                    this.submit();
                }
            })

        })
    }

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
