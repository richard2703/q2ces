@extends('layouts.main', ['activePage' => ' grupos', 'titlePage' => __('Nuevo Grupo')])
@section('content')
    <div class="content">
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
                                    <form action="{{ route('grupo.store') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="col-12 my-4">
                                            <div class="row">

                                                <div class=" col-12 col-sm-6  col-lg-12 my-6 ">
                                                    <label class="labelTitulo">Nombre: <span>*</span></label></br>
                                                    <input type="text" required maxlength="250" id="nombre" name="nombre"
                                                        placeholder="Especifique el nombre del grupo." class="inputCaja">
                                                </div>

                                                <div class=" col-12 col-sm-6  col-lg-12 my-6 ">
                                                    <label for="exampleFormControlTextarea1" class="labelTitulo">Descripción
                                                        del grupo de tareas: <span>*</span></label>
                                                    <textarea class="form-select" id="exampleFormControlTextarea1" rows="3" maxlength="1000" required  id="comentario" name="comentario"
                                                        placeholder="Escribe aquí tus comentarios sobre el grupo."></textarea>
                                                </div>

                                                <input type="hidden" name="activa" id="activa" value="1">


                                                <div class="col-12 text-center mt-5 pt-5">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal"><a
                                                            href="{{ url('/bitacoras/grupos') }}">Regresar</a></button>
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