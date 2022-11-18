@extends('layouts.main', ['activePage' => 'inventario', 'titlePage' => __('Inventario Herramientas')])
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-11">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header bacTituloPrincipal">
                                    <h4 class="card-title">Inventario Herramientas</h4>
                                    {{-- <p class="card-category">Usuarios registrados</p> --}}
                                </div>
                                <div class="card-body table-responsive">
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
                                    <div class="row justify-content-end">
                                        <div class="col-2 text-center mb-5">
                                            {{-- @can('user_create') --}}
                                            <a href="{{ route('inventario.create') }}">
                                                <button type="button" class="botonSinFondo "><img
                                                        style="width: 30px;"src="{{ '/img/inventario/nuevo.svg' }}"></button>
                                            </a>
                                            <p>Nuevo</p>

                                            {{-- @endcan --}}
                                        </div>
                                    </div>


                                    <table class="table-responsive">
                                        <thead class="labelTitulo">
                                            <tr class="">
                                                <th scope="col" class="tablaTitulos fw-bolder">Imagen</th>
                                                <th scope="col" class="tablaTitulos fw-bolder">Nombre</th>
                                                <th scope="col" class="tablaTitulos fw-bolder">Taller</th>
                                                <th scope="col" class="tablaTitulos fw-bolder">Maquinaria</th>
                                                <th scope="col" class="tablaTitulos fw-bolder text-right">Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {{--  @forelse ($accesorios as $accesorio)  --}}
                                            <tr class=" border-top border-bottom">
                                                <th scope="row"><img class="my-4"
                                                        style="width: 100px;"src="{{ '/img/general/defaultinventario.jpg' }}">
                                                    {{--  src="{{ $accesorio->foto == '' ? ' /img/general/default.jpg' : '/storage/accesorio/' . $accesorio->foto }}">  --}} </th>
                                                <td> desarmador</td>
                                                <td> 5 </td>
                                                <td> 1 </td>
                                                <td class="td-actions justify-content-end d-flex">
                                                    {{-- @can('user_show') --}}
                                                    <div class="col-5">
                                                        <button type="button" class="botonSinFondo mx-2"title="Resurtir"
                                                            data-bs-toggle="modal" data-bs-target="#modal-cliente"><img
                                                                style="width: 30px;"src="{{ '/img/inventario/reestock.svg' }}"></button>
                                                        <p class="botonTitulos mt-2">Resurtir</p>
                                                    </div>
                                                    {{-- @endcan --}}
                                                    {{-- @can('user_edit') --}}
                                                    <div class="col-5">
                                                        <a href="{{ url('detalleHerramienta') }}">
                                                        <button type="button" class="botonSinFondo mx-2"title="Detalle">
                                                            <img style="width: 30px;"src="{{ '/img/inventario/detalle.svg' }}">
                                                        </button>
                                                    </a>
                                                        <p class="botonTitulos mt-2">Detalle</p>
                                                    </div>
                                                    {{-- @endcan --}}
                                                    {{-- @endcan --}}
                                                    {{-- @can('user_destroy') --}}
                                                    <form action="#" method="POST" style="display: inline-block;"
                                                        onsubmit="return confirm('Seguro?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <!--<button class="btn btn-danger" type="submit" rel="tooltip">
                                                                <i class="material-icons">close</i>
                                                            </button>-->
                                                    </form>
                                                    {{-- @endcan --}}
                                                </td>
                                            </tr>
                                            {{--  @empty  --}}
                                            {{--  <tr>
                                                    <td colspan="2">Sin registros.</td>
                                                </tr>
                                            @endforelse  --}}

                                        </tbody>
                                    </table>




                                </div>
                                <div class="card-footer mr-auto">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- //Modales --}}
    <div class="modal fade" id="modal-cliente" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-cliente"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="col-12">
                    <div class="card ">
                        <form action="#" method="post">
                            @csrf
                            @method('put')
                            <div class="card-header bacTituloPrincipal ">
                                <div class="nav-tabs-navigation">
                                    <div class="nav-tabs-wrapper">
                                        <span class="nav-tabs-title">
                                            <h2 class="titulos">Restock </h2>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="row  card-body">
                                <div class="row card-body" style="
                                text-align: center;">
                                    <input type="hidden" name="id" value="">
                                    <div class="col-12 ">
                                        <img style="width: 100px;"src="{{ '/img/general/defaultinventario.jpg' }}">
                                    </div>
                                    <div class="col-12 border-bottom mb-3 labelTitulo">
                                        <h3 class="titulos hSub h3 ">Nombre producto</h3>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <label class="labelTitulo" for="">Cantidad:</label></br>
                                        <input class="inputCaja" type="number" step="0.01" min="0.01"
                                            id="" name="calleNum" value="" required></br>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <label class="labelTitulo" for="">Costo unitario:</label></br>
                                        <input class="inputCaja" type="number" step="0.01" min="0.01"
                                            id="" name="colonia" value="" required></br>
                                    </div>

                                </div>
                            </div>
                            <div class="col-12  mb-3 d-flex  justify-content-center align-self-end">
                                <button type="submit" class="btn botonGral ">Guardar</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/alertas.js') }}"></script>
    <script src="https://cdn.lordicon.com/qjzruarw.js"></script>

    <script type="application/javascript">
        jQuery('input[type=file]').change(function(){
         var filename = jQuery(this).val().split('\\').pop();
         var idname = jQuery(this).attr('id');
         console.log(jQuery(this));
         console.log(filename);
         console.log(idname);
         jQuery('span.'+idname).next().find('span').html(filename);
        });
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
        var slug = '{{ Session::get('message') }}';
        if (slug == 1) {
            Guardado();

        }
    </script>
@endsection
