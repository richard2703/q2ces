@extends('layouts.main', ['activePage' => 'inventario', 'titlePage' => __('index')])
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header bacTituloPrincipal">
                                    <h4 class="card-title">Inventario</h4>
                                    {{-- <p class="card-category">Usuarios registrados</p> --}}
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
                                    <div class="row">
                                        <div class="col-12 text-right">
                                            {{-- @can('user_create') --}}
                                            <a href="{{ route('inventario.create') }}">
                                                <button type="button" class="btn botonGral">Nuevo</button>
                                            </a>
                                            {{-- @endcan --}}
                                        </div>
                                    </div>


                                    <table class="table-responsive">
                                        <thead class="labelTitulo">
                                            <tr>
                                                <th scope="col" class="tablaTitulos fw-bolder">Imagen</th>
                                                <th scope="col" class="tablaTitulos fw-bolder">Nombre</th>
                                                <th scope="col" class="tablaTitulos fw-bolder">Taller</th>
                                                <th scope="col" class="tablaTitulos fw-bolder">Maquinaria</th>
                                                <th scope="col" class="tablaTitulos fw-bolder text-right">Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {{--  @forelse ($accesorios as $accesorio)  --}}
                                            <tr>
                                                <th scope="row"><img
                                                        style="width: 100px;"src="{{ '/img/general/defaultinventario.jpg' }}">
                                                    {{--  src="{{ $accesorio->foto == '' ? ' /img/general/default.jpg' : '/storage/accesorio/' . $accesorio->foto }}">  --}} </th>
                                                <td> desarmador</td>
                                                <td> 5 </td>
                                                <td> 1 </td>
                                                <td class="td-actions text-right">
                                                    {{-- @can('user_show') --}}
                                                    <a href="#" class="btn btn-info" title="Editar"><i
                                                            class="material-icons">person</i></a>
                                                    {{-- @endcan --}}
                                                    {{-- @can('user_edit') --}}

                                                    <a href="#" class="btn btn-warning" title="Resurtir"
                                                        data-bs-toggle="modal" data-bs-target="#modal-cliente"><i
                                                            class="material-icons">edit</i></a>
                                                    {{-- @endcan --}}
                                                    {{-- @can('user_destroy') --}}
                                                    <form action="#" method="POST" style="display: inline-block;"
                                                        onsubmit="return confirm('Seguro?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger" type="submit" rel="tooltip">
                                                            <i class="material-icons">close</i>
                                                        </button>
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
                                        <input class="inputCaja" type="number" step="0.01" min="0.01" id=""
                                            name="calleNum" value="" required></br>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <label class="labelTitulo" for="">Costo unitario:</label></br>
                                        <input class="inputCaja" type="number" step="0.01" min="0.01" id=""
                                            name="colonia" value="" required></br>
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
