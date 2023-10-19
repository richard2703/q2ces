@extends('layouts.main', ['activePage' => 'maquinaria', 'titlePage' => __('Alta de Accesorios')])
@section('content')
    <div class="content">
        <?php
        $objValida = new Validaciones();
        ?>
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
            <div class="row justify-content-center">
                <div class="col-12 align-self-start">
                    <div class="card">
                        <div class="card-body contCart">
                        <div class="ml-3">
                                    <div class="p-1 align-self-start bacTituloPrincipal">
                                        <h2 class="my-3 ms-3 texticonos">Alta de Residentes</h2>
                                    </div>
                                    <div>
                                    <div class="col-4 text-left mt-3" style="margin-left:20px">
                                    <a href="{{ route('residentes.index') }}">
                                        <button class="btn regresar">
                                            <span class="material-icons">
                                                reply
                                            </span>
                                            Regresar
                                        </button>
                                    </a>    
                                    </div>
                                    <div class="d-flex p-3 divBorder" style="margin-top:-15px">
                                    </div>
                                    </div>
                            <form action="{{ route('residentes.store') }}"
                                method="post"class="row alertaGuardar" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="userId" id="userId" value="{{ auth()->user()->id }}">
                                
                                <div class="row mt-3" style="padding-left: 40px">
                                    <div class=" col-12 col-sm-6 mb-3 pr-3">
                                        <label class="labelTitulo">Nombre:<span>*</span></label></br>
                                        <input type="text" class="inputCaja" name="nombre" required value="{{ old('nombre') }}"
                                            required placeholder="Especifique...">
                                    </div>
                                    {{--  <div class=" col-12 col-sm-6 mb-3 ">
                                        <label class="labelTitulo">Empresa:<span>*</span></label></br>
                                        <input type="text" class="inputCaja" id="empresa" name="empresa" required
                                            value="{{ old('empresa') }}" required placeholder="Especifique...">
                                    </div>  --}}
            
                                    <div class=" col-12 col-sm-6 mb-3 ">
                                        <label class="labelTitulo">E-mail</label></br>
                                        <input type="email" class="inputCaja" required placeholder="ej. elcorreo@delresponsable.com"
                                            min="6" name="email" value="{{ old('email') }}">
                                    </div>
            
                                    <div class=" col-12 col-sm-6 mb-3 ">
                                        <label class="labelTitulo">Teléfono:</label></br>
                                        <input type="tel" placeholder="ej. 00-0000-0000" class="inputCaja"
                                            name="telefono"value="{{ old('telefono') }}">
                                    </div>
            
                                    {{--  <div class=" col-12 col-sm-6 mb-3 ">
                                        <label class="labelTitulo">Puesto:<span>*</span></label></br>
                                        <input type="text" class="inputCaja" id="puesto" name="puesto" required
                                            value="{{ old('puesto') }}" required placeholder="Especifique...">
                                    </div>  --}}
            
                                    <div class=" col-12 col-sm-6 mb-3 ">
                                        <label class="labelTitulo">Obra: <span>*</span></label></br>
                                        <select name="obraId" class="form-select" aria-label="Default select example">
                                            <option value="">Seleccione</option>
                                            @foreach ($vctObras as $item)
                                                <option value="{{ $item->id }}">
                                                    {{ $item->nombre }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
            
                                    @can('residente_mtq_assign_vehiculo')
                                        {{--  <div class=" col-12 col-sm-6 mb-3 ">
                                            <label class="labelTitulo">Auto: <span></span></label></br>
                                            <select name="autoId" class="form-select" aria-label="Default select example">
                                                <option value="">Seleccione</option>
                                                @foreach ($maquinaria as $item)
                                                    <option value="{{ $item->id }}">
                                                        {{ $item->identificador }} {{ $item->nombre }} {{ $item->modelo }} {{ $item->placas }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>  --}}
                                    @endcan

                                    <div class="d-flex p-3">
                                        <div class="col-12" id="elementos">
                                            <div class="d-flex">
                                                <div class="col-6 divBorder">
                                                    <h2 class="tituloEncabezado ">Vehículos</h2>
                                                </div>
                                                <div class="col-6 divBorder pb-3 text-end">
                                                    <button type="button" class="btnVerde"
                                                        onclick="crearItems()">
                                                    </button>
                                                </div>
                                            </div>

                                            <div class="row opcion divBorderItems" id="opc">

                                                    <div class=" col-9 mb-3 ">
                                                        <label class="labelTitulo mt-2">Auto: <span></span></label></br>
                                                        <select name="autoIdR[]" class="form-select" aria-label="Default select example">
                                                            <option value="">Seleccione</option>
                                                            @foreach ($maquinaria as $item)
                                                                <option value="{{ $item->id }}">
                                                                    {{ $item->identificador }} {{ $item->nombre }} {{ $item->modelo }} {{ $item->placas }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                <div class="col-lg-2 my-3 text-center pt-3">
                                                    <span class="material-icons"
                                                        style="font-size:40px; color: green">
                                                        no_crash
                                                    </span>
                                                </div>
                                                <div class="col-lg-1 my-3 text-end">
                                                    <button type="button" id="removeRow"
                                                        class="btnRojo"></button>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                       
                                    <div class="col-12 text-center mb-3 mt-3">
                                        <button type="submit" class="btn botonGral"
                                            onclick="alertaGuardar()">Guardar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
    
    <script src="{{ asset('js/cardArchivos.js') }}"></script>

    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
    crossorigin="anonymous"></script>

    <script>
        function crearItems() {
            $('.opcion:first').clone().find("input").val("").end().appendTo('#elementos');
        }
    
        // Borrar registro
        $(document).on('click', '#removeRow', function() {
            if ($('.opcion').length > 1) {
                $(this).closest('.opcion').remove();
            }
        });
    </script>
@endsection