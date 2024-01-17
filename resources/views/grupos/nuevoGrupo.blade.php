@extends('layouts.main', ['activePage' => ' grupos', 'titlePage' => __('Nuevo Grupo')])
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
                                    <h4 class="card-title">Nuevo Registro de Grupo</h4>
                                </div>
                                <div class="card-body ">
                                    <div class="row">
                                        <div class="d-flex p-3 divBorder">
                                            <div class="col-12 text-start">
                                                <a href="{{ url('/bitacoras/grupos') }}">
                                                    <button class="btn regresar">
                                                        <span class="material-icons">
                                                            reply
                                                        </span>
                                                        Regresar
                                                    </button>
                                                </a>
                                            </div>
                                        </div>
                                        <form action="{{ route('grupo.store') }}" method="post"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="col-12 my-4">
                                                <div class="row">

                                                    <div class="col-8">

                                                        <div class=" col-12 col-sm-6  col-lg-12 my-6 ">
                                                            <label class="labelTitulo">Nombre: <span>*</span></label></br>
                                                            <input type="text" required maxlength="250" id="nombre"
                                                                name="nombre"
                                                                placeholder="Especifique el nombre del grupo."
                                                                class="inputCaja">
                                                        </div>

                                                        <div class=" col-12 col-sm-6  col-lg-12 my-6 mt-2 pt-2">
                                                            <label for="exampleFormControlTextarea1"
                                                                class="labelTitulo">Descripción
                                                                del Grupo de Tareas: <span>*</span></label>
                                                            <textarea class="form-select" id="exampleFormControlTextarea1" rows="3" maxlength="1000" required id="comentario"
                                                                name="comentario" placeholder="Escribe aquí tus comentarios sobre el grupo."></textarea>
                                                        </div>
                                                    </div>

                                                    <div class="col-4">

                                                        <div class="text-center mx-auto border mb-4">
                                                            <i><img class="imgVista img-fluid "
                                                                    src="{{ asset('/img/general/default.jpg') }}"></i>
                                                            <span class="mi-archivo">
                                                                <input class="mb-4 ver" type="file" name="imagen"
                                                                    id="mi-archivo" accept="image/*"></span>
                                                            <label for="mi-archivo">
                                                                <span>Subir Icono</span>
                                                            </label>
                                                        </div>
                                                        <input type="hidden" name="activa" id="activa" value="1">
                                                    </div>


                                                    <div class="col-12 text-center mt-5 pt-5">
                                                        <a href="{{ url('/bitacoras/grupos') }}">
                                                            <button type="button" class="btn btn-danger">Cancelar</button>
                                                        </a>
                                                        <button type="submit" class="btn botonGral">Guardar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
            crossorigin="anonymous"></script>

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
