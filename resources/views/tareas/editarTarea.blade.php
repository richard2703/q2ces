@extends('layouts.main', ['activePage' => ' bitacoras', 'titlePage' => __('Editar Tarea')])
@section('content')
    <div class="content">
        @if ($errors->any())
            <div class="alert alert-danger">
                <!-- PARA LA CARGA DE LOS ERRORES DE LOS DATOS-->
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
                                    <h4 class="card-title">Editar Tarea</h4>
                                </div>
                                <div class="card-body ">

                                    <form class="row alertaGuardar" action="{{ route('tarea.update', $tarea->id) }}"
                                        method="post" enctype="multipart/form-data">
                                        @csrf
                                        @method('put')
                                        <div class="col-12 my-4">
                                            <div class="row">
                                                <input type="hidden" name="tareaId" id="tareaId"
                                                    value="{{ $tarea->id }}">
                                                <div class=" col-12 col-sm-6  col-lg-12 my-6 ">
                                                    <label class="labelTitulo">Nombre: <span>*</span></label></br>

                                                    <input type="text" required maxlength="250" id="nombre"
                                                        name="nombre" value="{{ $tarea->nombre }}"
                                                        placeholder="Especifique el nombre de la bitácora."
                                                        class="inputCaja">
                                                </div>

                                                <div class=" col-12 col-sm-6  col-lg-12 my-6 ">
                                                    <label for="exampleFormControlTextarea1" class="labelTitulo">Descripción
                                                        de la Tarea: <span>*</span></label>
                                                    <textarea class="form-select" id="exampleFormControlTextarea1" rows="3" maxlength="1000" required id="comentario"
                                                        name="comentario" placeholder="Escribe aquí tus comentarios sobre la bitácora.">{{ $tarea->comentario }}</textarea>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-4 col-sm-3  col-lg-4 my-3">
                                                    <label for="recipient-name" class="labelTitulo">Categoría:
                                                        <span>*</span></label>
                                                    <select class="form-select" id="floatingSelect"
                                                        aria-label="Floating label select example" required id="categoriaId"
                                                        name="categoriaId">
                                                        <option selected value="">Selecciona una opción</option>
                                                        @foreach ($vctCategorias as $item)
                                                            <option value="{{ $item->id }}"
                                                                {{ $item->id == $tarea->categoriaId ? ' selected' : '' }}>
                                                                {{ $item->nombre }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-4 col-sm-3  col-lg-4 my-3">
                                                    <label for="recipient-name" class="labelTitulo">Ubicación:
                                                        <span>*</span></label>
                                                    <select class="form-select" id="floatingSelect"
                                                        aria-label="Floating label select example" required id="ubicacionId"
                                                        name="ubicacionId">
                                                        <option selected value="">Selecciona una opción</option>
                                                        @foreach ($vctUbicaciones as $item)
                                                            <option value="{{ $item->id }}"
                                                                {{ $item->id == $tarea->ubicacionId ? ' selected' : '' }}>
                                                                {{ $item->nombre }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-4 col-sm-3  col-lg-4 my-3">
                                                    <label for="recipient-name" class="labelTitulo">Tipo:
                                                        <span>*</span></label>
                                                    <select class="form-select" id="floatingSelect"
                                                        aria-label="Floating label select example" required id="tipoId"
                                                        name="tipoId">
                                                        <option selected value="">Selecciona una opción</option>
                                                        @foreach ($vctTipos as $item)
                                                            <option value="{{ $item->id }}"
                                                                {{ $item->id == $tarea->tipoId ? ' selected' : '' }}>
                                                                {{ $item->nombre }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="col-8 col-sm-4  col-lg-4 my-3">
                                                    <label class="labelTitulo">Tipo de Valor a Capturar:</label></br>
                                                    <select class="form-select" aria-label="Default select example"
                                                        onchange="configurar()" id="tipoValorId" name="tipoValorId">
                                                        <option selected value="">Selecciona una opción</option>
                                                        @foreach ($vctTipoValor as $item)
                                                            <option value="{{ $item->id }}"
                                                                {{ $item->id == $tarea->tipoValorId ? ' selected' : '' }}>
                                                                {{ $item->nombre }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-4 col-sm-3  col-lg-4 my-3">
                                                    <label class="labelTitulo">Requiere Imagen:</label></br>
                                                    <select class="form-select" aria-label="Default select example"
                                                        id="requiereImagen" name="requiereImagen">
                                                        <option value="0"
                                                            {{ $tarea->requiereImagen == 0 ? ' selected' : '' }}>
                                                            No</option>
                                                        <option value="1"
                                                            {{ $tarea->requiereImagen == 1 ? ' selected' : '' }}>Sí
                                                        </option>
                                                    </select>
                                                </div>

                                                <div class="col-4 col-sm-3  col-lg-4 my-3">
                                                    <label class="labelTitulo">Activa:</label></br>
                                                    <select class="form-select" aria-label="Default select example"
                                                        id="activa" name="activa">
                                                        <option value="0"
                                                            {{ $tarea->activa == 0 ? ' selected' : '' }}>No</option>
                                                        <option value="1"
                                                            {{ $tarea->activa == 1 ? ' selected' : '' }}>Sí</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 my-4 divBorder ">
                                            <div class="row">
                                                <h2 class="tituloEncabezado ">Configuración</h2>
                                            </div>
                                        </div>
                                        <div class="col-12 my-4">
                                            <div class="row">
                                                <div class=" col-12 col-sm-6  col-lg-12 my-6 ">
                                                    <label class="labelTitulo">Leyenda (Se muestra como ToolTip):
                                                        <span></span></label></br>

                                                    <input type="text" maxlength="200" id="leyenda" name="leyenda"
                                                        value="{{ $tarea->leyenda }}"
                                                        placeholder="Especifique el texto de la leyenda."
                                                        class="inputCaja">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row" id="divRequiereUnidad">
                                            <div class=" col-4  mb-3 ">
                                                <label class="labelTitulo">Require Usar Unidad de Medida:
                                                    <span></span></label></br>
                                                <input class="form-check-input is-invalid align-self-end mb-2"
                                                    name='requiereUnidadMedida' type="checkbox" id="requiereUnidadMedida"
                                                    <?php echo $tarea->requiereUnidadMedida == 1 ? 'checked' : ''; ?> style="font-size: 20px;">
                                            </div>

                                            <fieldset class=" col-8  mb-6 " id="requiereUnidadValor">
                                                <div class="row">

                                                    <div class=" col-8  mb-6 ">
                                                        <label class="labelTitulo">Unidad:</label></br>
                                                        <input type="text" maxlength="128" id="unidadMedida"
                                                            name="unidadMedida" value="{{ $tarea->unidadMedida }}"
                                                            placeholder="Especifique el nombre de unidad de medida o simbolo, Ej. Kilogramos o kg ."
                                                            class="inputCaja">
                                                    </div>
                                                </div>
                                            </fieldset>
                                        </div>

                                        <div class="row" id="divRequiereLimites">
                                            <div class=" col-4  mb-3 ">
                                                <label class="labelTitulo">Require Usar Limites: <span></span></label></br>
                                                <input class="form-check-input is-invalid align-self-end mb-2"
                                                    name='requiereLimites' type="checkbox" id="requiereLimites"
                                                    <?php echo $tarea->requiereLimites == 1 ? 'checked' : ''; ?> style="font-size: 20px;">
                                            </div>

                                            <fieldset class=" col-8  mb-6 " id="requiereLimites">
                                                <div class="row">
                                                    <div class=" col-4  mb-3 ">
                                                        <label class="labelTitulo">Valor mínimo:</label></br>
                                                        <input type="number" class="inputCaja text-end"
                                                            id="limiteInferior" maxlength="3" min="0"
                                                            step="1" max="999" placeholder="Ej. 0"
                                                            name="limiteInferior" value="{{ $tarea->limiteInferior }}">
                                                    </div>

                                                    <div class=" col-4  mb-3 ">
                                                        <label class="labelTitulo">Valor Máximo:</label></br>
                                                        <input type="number" class="inputCaja text-end"
                                                            id="limiteSuperior" maxlength="3" min="0"
                                                            step="1" max="1000000" placeholder="Ej. 100"
                                                            name="limiteSuperior" value="{{ $tarea->limiteSuperior }}">
                                                    </div>
                                                </div>

                                            </fieldset>
                                        </div>

                                        <div class="row" id="divRequiereEscala">
                                            <div class=" col-4  mb-3 ">
                                                <label class="labelTitulo">Require Usar Escala: <span></span></label></br>
                                                <input class="form-check-input is-invalid align-self-end mb-2"
                                                    <?php echo $tarea->requiereEscala == 1 ? 'checked' : ''; ?> name='requiereEscala' type="checkbox"
                                                    id="requiereEscala" style="font-size: 20px;">
                                            </div>

                                            <fieldset class=" col-8  mb-6 " id="requiereEscala">
                                                <div class="row">

                                                    <div class=" col-4  mb-3 ">
                                                        <label class="labelTitulo">Valor mínimo:</label></br>
                                                        <input type="number" class="inputCaja text-end"
                                                            id="limiteInferiorEscala" maxlength="3" min="0"
                                                            step="1" max="999" placeholder="Ej. 0"
                                                            name="limiteInferiorEscala"
                                                            value="{{ $tarea->limiteInferiorEscala }}">
                                                    </div>

                                                    <div class=" col-4  mb-3 ">
                                                        <label class="labelTitulo">Valor Máximo:</label></br>
                                                        <input type="number" class="inputCaja text-end"
                                                            id="limiteSuperiorEscala" maxlength="3" min="0"
                                                            step="1" max="1000000" placeholder="Ej. 100"
                                                            name="limiteSuperiorEscala"
                                                            value="{{ $tarea->limiteSuperiorEscala }}">
                                                    </div>
                                                </div>
                                            </fieldset>
                                        </div>

                                        <div class="row" id="divRequierePeriodo">
                                            <div class=" col-4  mb-3 ">
                                                <label class="labelTitulo">Require Usar Periodo de Tiempo:
                                                    <span></span></label></br>
                                                <input class="form-check-input is-invalid align-self-end mb-2"
                                                    <?php echo $tarea->requierePeriodo == 1 ? 'checked' : ''; ?> name='requierePeriodo' type="checkbox"
                                                    id="requierePeriodo" style="font-size: 20px;">
                                            </div>

                                            <fieldset class=" col-8  mb-6 " id="requiereEscala">
                                                <div class="row">

                                                    <div class=" col-4  mb-3 ">
                                                        <label class="labelTitulo">Días Anteriores:</label></br>
                                                        <input type="number" class="inputCaja text-end"
                                                            id="fechaInicial" maxlength="3" min="0"
                                                            step="1" max="999" placeholder="Ej. 0"
                                                            name="fechaInicial" value="{{ $tarea->fechaInicial }}">
                                                    </div>

                                                    <div class=" col-4  mb-3 ">
                                                        <label class="labelTitulo">Días Posteriores:</label></br>
                                                        <input type="number" class="inputCaja text-end" id="fechaFinal"
                                                            maxlength="3" min="0" step="1" max="1000000"
                                                            placeholder="Ej. 100" name="fechaFinal"
                                                            value="{{ $tarea->fechaFinal }}">
                                                    </div>
                                                </div>
                                            </fieldset>
                                        </div>

                                        <div class="col-12 my-4  ">
                                            <div class="row">
                                                <div class="col-12 text-center mt-5 pt-5">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal"><a
                                                            href="{{ url('/bitacoras/tareas/') }}">Regresar</a></button>
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
        function configurar() {

            const listaSeleccion = document.getElementById('tipoValorId');

            // const chkUnidad = document.getElementById('requiereUnidadMedida');
            // const chkLimites = document.getElementById('requiereLimites');
            // const chkEscala = document.getElementById('requiereEscala');
            // const chkPeriodo = document.getElementById('requierePeriodo');

            const txtUnidad = document.getElementById('unidadMedida');

            console.log(listaSeleccion.value);

            switch (listaSeleccion.value) {
                case '1':
                    /* es para la etiqueta*/
                    console.log('En etiqueta');
                    txtUnidad.value = "";
                    txtUnidad.readonly = true;

                    document.getElementById("requiereUnidadMedida").checked = off;

                    break;

                default:
                    break;
            }

        };
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
