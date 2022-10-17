@extends('layouts.main', ['activePage' => 'equipos', 'titlePage' => __('Lista de Accesorios')])
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header bacTituloPrincipal">
                                    <h4 class="card-title">Accesorios</h4>
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
                                            <a href="{{ route('accesorios.create') }}">
                                                <button type="button" class="btn botonGral">Añadir Accesorio</button>
                                            </a>
                                            {{-- @endcan --}}
                                        </div>
                                    </div>


                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col" class="tablaTitulos fw-bolder">Imagen</th>
                                                <th scope="col" class="tablaTitulos fw-bolder">Nombre</th>
                                                <th scope="col" class="tablaTitulos fw-bolder">Maquinaria</th>
                                                <th scope="col" class="tablaTitulos fw-bolder text-right">Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($accesorios as $accesorio)
                                                <tr>
                                                    <th scope="row"><img style="width: 100px;"
                                                            src="{{ $accesorio->foto == '' ? ' /img/general/default.jpg' : '/storage/accesorio/' . $accesorio->foto }}">
                                                    </th>
                                                    <td>{{ $accesorio->nombre }}</td>
                                                    <td>{{ $accesorio->apellidoP }}</td>

                                                    <td class="td-actions text-right">
                                                        {{-- @can('user_show') --}}
                                                        <a href="{{ route('accesorios.show', $accesorio->id) }}"
                                                            class="btn btn-info"><i class="material-icons">person</i></a>
                                                        {{-- @endcan --}}
                                                        {{-- @can('user_edit') --}}
                                                        <a href="{{ route('users.edit', $accesorio->id) }}"
                                                            class="btn btn-warning"><i class="material-icons">edit</i></a>
                                                        {{-- @endcan --}}
                                                        {{-- @can('user_destroy') --}}
                                                        <form action="{{ route('users.delete', $accesorio->id) }}"
                                                            method="POST" style="display: inline-block;"
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
                                            @empty
                                                <tr>
                                                    <td colspan="2">Sin registros.</td>
                                                </tr>
                                            @endforelse

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
    <script src="{{ asset('js/alertas.js') }}"></script>
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
