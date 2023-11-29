@extends('layouts.main', ['activePage' => 'mtq', 'titlePage' => __('Inventario Nuevo')])
@section('content')

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bacTituloPrincipal">
                            <h4 class="card-title text-capitalize">Inventario de
                                @if ($tipo === 'consumibles')
                                    Materiales
                                @else
                                    {{ $tipo }}
                                @endif
                            </h4>
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
                            <input type="hidden" name="tipoParaBuscador" id="tipoParaBuscador" value="{{$tipo}}">

                            <div class="row">
                                <div class="col-lg-2 col-sm-6 mt-1 text-right">
                                    <a href="{{ route('inventarioMtq.index', $tipo) }}">
                                        <button class="btn regresar ">
                                            <span class="material-icons">
                                                reply
                                            </span>
                                            Regresar
                                        </button>
                                    </a>
                                </div>

                                <div class="mb-3 col-lg-10 col-sm-6 d-flex justify-content-start">
                                {{--  <p class="subEncabezado text-capitalize">Busca {{$tipo}}:</p>  --}}

                                <div role="search" class="">
                                    <input value="" class="search-submit ">
                                    <input autofocus type="text" class="search-text"
                                        id="search2" name="search2" placeholder="Buscar..."
                                        title="Escriba la(s) palabra(s) a buscar.">
                                </div>
                            </div>
                        </div>
                        <form class="row alertaGuardar" action="{{ route('inventarioMtq.store') }}" method="post"class="row" enctype="multipart/form-data">
                            @csrf
                            <div class="my-2 divBorder">
                                <h1 class="tituloEncabezado text-capitalize mb-2">Carga Masiva Por Buscador</h1>
                            </div>
                            <p id="sinElementosBuscador">No hay ninguna carga masiva agregada, usa el buscador para agregar uno o mas elementos.</p>
                            <div class="col-12  my-3" style="display: none" id="columnasBuscador">
                                <ul class="" id="newRowBuscador">
                                </ul>
                            </div>

                    {{--  <div class="row opcion divBorderItems ">
                        <div class="col-9 pb-3 text-right">
                            <a href="{{ route('inventario.index', $tipo) }}">
                                <button class="btn regresar ">
                                    <span class="material-icons">
                                        reply
                                    </span>
                                    Regresar
                                </button>
                            </a>
                        </div>
                        <div class="col-2 pb-3 text-end">
                            <button type="button" class="btnVerde"
                                onclick="crearItems()">
                            </button>
                        </div>

                        <div class="col-lg-1 my-3 text-end">
                            <button type="button" id="removeRow"
                                class="btnRojo"></button>
                        </div>

                    </div>  --}}




                        {{--  <div class="col-12 text-end mb-3 ">
                            <button type="submit" class="btn botonGral">Guardar</button>
                        </div>  --}}
                        <div class="col-12" id="elementos">
                            <div class="col-12 mb-3 divBorder"></div>
                            <div class="d-flex">
                                <div class="col-6 divBorder">
                                    <h2 class="tituloEncabezado text-capitalize">Agregar Nuevas {{$tipo}}</h2>

                                </div>

                                <div class="col-6 divBorder pb-3 text-end">
                                    <button type="button" class="btnVerde"
                                        onclick="crearNuevoElemento()">
                                    </button>
                                </div>


                            </div>

                                <p id="sinAlta">No hay {{$tipo}} a subir, agrega todas las {{$tipo}} que quieras dar de alta en el inventario.</p>
                        </div>

                        <div class="col-12 text-center m-3 ">
                            <button type="submit" class="btn botonGral"
                                onclick="alertaGuardar()">Guardar</button>
                        </div>
                    </form>
                        </div>
                        {{--  <div class="card-footer mr-auto">
                            {{ $inventarios->links() }}
                        </div>  --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        .custom-file-upload {
            display: inline-block;
            padding: 10px 15px;
            background: #8eb322; /* Color verde */
            color: #fff; /* Color de texto blanco */
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
        }

        .custom-file-upload input {
            display: none; /* Oculta el input file nativo */
        }

        .text-center.mx-auto.border.vistaFoto {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .image-container {
            margin-bottom: 20px; /* Espacio entre la imagen y el botón */
        }

        .button-container {
            text-align: center;
        }
    </style>

    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

    <script>
        function crearNuevoElemento() {
            // Crea un nuevo elemento 'div' con la clase 'opcion'
            var nuevoElemento = $('<div class="opcion">');

            // Agrega el contenido HTML del elemento
            nuevoElemento.html(`<div class="row opcion divBorderItems" id="opc" >

                <div class="col-12 my-3 text-end" id="butonEliminar" >
                    <button type="button" id="removeRow"
                        class="btnRojo"></button>
                </div>
                <div class="col-12 col-md-4  my-3">
                    <div class="text-center mx-auto border vistaFoto mb-4">
                        <div class="image-container">
                            <i><img class="imgVista img-fluid" src="{{ '/img/general/defaultinventario.jpg' }}"></i>
                        </div>
                        <div class="button-container">
                            <label class="custom-file-upload">
                                <input class="mb-4 ver" type="file" name="nuevo[imagen][]" accept="image/*">
                                Subir Imagen
                            </label>
                        </div>
                    </div>

                    {{--  <div class="col-12 text-center mb-3 ">
                        <button type="submit" class="btn botonGral"
                            onclick="alertaGuardar()">Guardar</button>
                    </div>  --}}
                </div>

                <div class="col-12 col-md-8 my-3 ">
                    <div class="row alin">
                        <input type="hidden" name="nuevo[usuarioId][]" class="usuarioId" value="{{ auth()->user()->id }}">
                        <input type="hidden" type="text" class="inputCaja tipoInventario" readonly value="{{ $tipo }}">
                        <input type="hidden" name="nuevo[tipo][]" class="tipoId" value="{{ $tipo }}">

                        <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                            <label class="labelTitulo">Número de Parte: <span>*</span></label></br>
                            <input type="text" class="inputCaja text-right" required class="inputCaja"
                                id="numparte" name="nuevo[numparte][]" value="{{ old('numparte') }}" maxlength="10"
                                step="1" min="0">
                        </div>

                        <div class="col-12 col-sm-6 col-lg-4 mb-3">
                            <label class="labelTitulo">Nombre: <span>*</span></label></br>
                            <input type="text" class="inputCaja" id="nombre" name="nuevo[nombre][]" required
                                value="{{ old('nombre') }}">
                        </div>

                        <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                            <label class="labelTitulo">Marca: <span>*</span></label></br>
                            <select id="marcaId" name="nuevo[marcaId][]" class="form-select" required
                                aria-label="Default select example">
                                <option value="">Seleccione</option>
                                @foreach ($vctMarcas as $item)
                                    <option value="{{ $item->id }}">
                                        {{ $item->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                            <label class="labelTitulo">Módelo: <span>*</span></label></br>
                            <input type="text" class="inputCaja" id="modelo" name="nuevo[modelo][]" required
                                value="{{ old('modelo') }}">
                        </div>

                        <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                            <label class="labelTitulo">Proovedor: <span>*</span></label></br>
                            <select id="proveedorId" name="nuevo[proveedorId][]" class="form-select" required
                                aria-label="Default select example">
                                <option value="">Seleccione</option>
                                @foreach ($vctProveedores as $item)
                                    <option value="{{ $item->id }}">
                                        {{ $item->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                            <label class="labelTitulo">Cantidad: <span>*</span></label></br>
                            <input type="number" step="1" min="1" class="inputCaja text-end"
                                required id="cantidad" name="nuevo[cantidad][]" value="{{ old('cantidad') }}">
                        </div>
                        @if ($tipo == 'materiales')
                            <div class=" col-12 col-sm-6 col-lg-8 mb-3 ">
                                <label class="labelTitulo">Unidad: </label></br>
                                <input type="text" class="inputCaja" name="nuevo[unidad][]" id="unidad"
                                    placeholder="Como se mide, Ej: Kg, Mts2, Sacos..."
                                    value="{{ old('unidad') }}">
                            </div>
                        @else
                            <input type="hidden" name="nuevo[unidad][]" id="unidad" value="">
                        @endif


                        <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                            <label class="labelTitulo">Mínimo:</label></br>
                            <input type="number" step="1" min="1"
                                class="inputCaja text-end" id="reorden" name="nuevo[reorden][]"
                                value="{{ old('reorden') }}">
                        </div>

                        <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                            <label class="labelTitulo">Máximo:</label></br>
                            <input type="number" step="1" min="1"
                                class="inputCaja text-end" id="maximo" name="nuevo[maximo][]"
                                value="{{ old('maximo') }}">
                        </div>

                        <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                            <label class="labelTitulo">Costo Total: <span>*</span></label></br>
                            <input type="number" step="0.01" min="0.01"
                                class="inputCaja text-end" id="valor" name="nuevo[valor][]" required
                                value="{{ old('valor') }}">
                        </div>

                        <!-- PARA USO EXCLUSIVO DE UNIFORMES -->
                        @if ($tipo == 'uniformes')
                            <div class=" col-12 col-sm-6 col-lg-4 mb-5 ">
                                <label class="labelTitulo">Tipo de Uniforme:</label></br>
                                <select id="uniformeTipoId" name="uniformeTipoId" class="form-select"
                                    required aria-label="Default select example" >
                                    <option value="">Seleccione</option>
                                    @foreach ($vctTipos as $item)
                                        <option value="{{ $item->id }}">
                                            {{ $item->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                <label class="labelTitulo">Talla:</label></br>
                                <input type="text" class="inputCaja" id="uniformeTalla"
                                    name="uniformeTalla" value="{{ old('uniformeTalla') }}">
                            </div>

                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                <label class="labelTitulo">Es Retornable:</label></br>
                                <select class="form-select" aria-label="Default select example"
                                    id="uniformeRetornable" name="uniformeRetornable">
                                    <option value="0">No</option>
                                    <option value="1">Sí</option>
                                </select>
                            </div>
                        @endif

                        <!-- PARA USO EXCLUSIVO DE EXTINTORES -->
                        @if ($tipo == 'extintores')
                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                <label class="labelTitulo">Capacidad:</label></br>
                                <input type="text" class="inputCaja" id="extintorCapacidad"
                                    name="extintorCapacidad" value="{{ old('extintorCapacidad') }}">
                            </div>

                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                <label class="labelTitulo">Identificador:</label></br>
                                <input type="text" class="inputCaja" id="extintorCodigo"
                                    name="extintorCodigo" value="{{ old('extintorCodigo') }}">
                            </div>
                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                <label class="labelTitulo">Fecha de Vencimiento:</label></br>
                                <input type="date" class="inputCaja" id="extintorFechaVencimiento"
                                    name="extintorFechaVencimiento"
                                    value="{{ old('extintorFechaVencimiento') }}">
                            </div>

                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                <label class="labelTitulo">Tipo de Extintor:</label></br>
                                <select class="form-select" aria-label="Default select example"
                                    id="extintorTipo" name="extintorTipo">
                                    <option value="A">A
                                    </option>
                                    <option value="B">B
                                    </option>
                                    <option value="C">C
                                    </option>
                                    <option value="D">D
                                    </option>
                                </select>
                            </div>

                            <div class=" col-12 col-sm-6 col-lg-4 mb-3 ">
                                <label class="labelTitulo">Ubicación:</label></br>
                                <input type="text" class="inputCaja" id="extintorUbicacion"
                                    name="extintorUbicacion" value="{{ old('extintorUbicacion') }}">
                            </div>

                            <div class=" col-12 col-sm-6 col-lg-4 mb-5 ">
                                <label class="labelTitulo">Asignado :</label></br>
                                <select id="extintorAsignadoMaquinariaId"
                                    name="extintorAsignadoMaquinariaId" class="form-select"
                                    aria-label="Default select example">
                                    <option value="">Seleccione</option>
                                    @foreach ($vctMaquinaria as $item)
                                        <option value="{{ $item->id }}">
                                            {{ $item->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        @endif
                    </div>
                </div>
            </div>`);

            // Inserta el nuevo elemento en el contenedor '#elementos'
            $('#elementos').append(nuevoElemento);
            const sinAltaDiv = document.getElementById('sinAlta');
                sinAltaDiv.style.display = 'none';
        }

        $(document).on('click', '#removeRow', function() {
            if ($('.opcion').length > 0) {
                $(this).closest('.opcion').remove();
            }
        });
    </script>

    <script>
        /*
        function crearItems() {
            const cantidadDiv = document.getElementById('butonEliminar');
            let clonedElement = $('.opcion:first').clone();
            let clonedInputs = clonedElement.find("input, select");
            clonedElement.find('.no-clone').remove();
            let usuarioIdValue = $('.usuarioId').val();
            let tipoInventarioValue = $('.tipoInventario').val();
            let tipoIdValue = $('.tipoId').val();

            clonedInputs.each(function(index) {
                let fieldClass = $(this).attr("class");
                if (fieldClass === "usuarioId") {
                    $(this).val(usuarioIdValue);
                } else if (fieldClass === "tipoInventario") {
                    $(this).val(tipoInventarioValue);
                } else if (fieldClass === "tipoId") {
                    $(this).val(tipoIdValue);
                } else {
                    $(this).val("");
                }
            });
            clonedElement.appendTo('#elementos');
        }
        */
    </script>

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
        const txtTipo = document.getElementById('tipoParaBuscador');
        let tipo = txtTipo.value;

        $('#search2').autocomplete({

            source: function(request, response) {
                $.ajax({
                    url: "{{ route('search.inventarioMtq') }}",
                    dataType: 'json',
                    data: {
                        term: request.term,
                        tipo: tipo,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },

                    success: function(data) {
                        response(data);
                    }
                });
            },
            minChars: 1,
            width: 402,
            matchContains: "word",
            autoFill: true,
            minLength: 1,
            select: function(event, ui) {
                console.log('ui.item',ui.item);
                // Rellenar los campos con los datos del inventario seleccionado
                const columnasDiv = document.getElementById('columnasBuscador');
                columnasDiv.style.display = 'block';
                const sinElementosDiv = document.getElementById('sinElementosBuscador');
                sinElementosDiv.style.display = 'none';

                crearItemsBuscador(ui.item.id, ui.item.value, ui.item.marca, ui.item.modelo, ui.item.nombre,ui.item.numparte, ui.item.cantidad, ui.item.tipo, ui.item.modelo);
            }

        });
    </script>

    <script type="text/javascript">
        function crearItemsBuscador(inventarioId, value, marca, modelo, nombre, numparte, cantidad, tipo, modelo) {
            /*var html = '';
            html += '<li class="listaMaterialMantenimiento my-3 border-bottom" id="inputFormRow">';
            html += '   <div class="row d-flex pb-4">';
            html += '      <input type="hidden" name="gastoId[]" id="gastoId" value="">';
            html += '      <input type="hidden" name="inventarioId[]" id="inventarioId" value="' + inventarioId + '">';
            html += '      <input type="hidden" name="costo[]" id="costo" value="' + costo + '">';
            html += '      <div class="col-3 ">';
            html += '           <label for="cantidad" class="">Cantidad</label></br></br>';
            html +=
                '           <input type="number" maxlength="2" min="1" required max="99" step="1" class="inputCaja text-right" id="cantidad" placeholder="Ej. 1" name="cantidad[]" value="">';
            html += '      </div>';
            html += '      <div class="col-7">';
            html += '          <label for="descripcion" class="">Descripción</label></br></br>';
            html +=
                '          <textarea rows="3" cols="80" class="form-control form-select" id="descripcion" readonly name="descripcion[]" value="">' +
                descripcion + '</textarea>';
            html += '      </div>';
            html += '      <div class="col-2"></br></br>';
            html += '         <button id="removeRowBuscador" type="button" class="btn btn-danger">Borrar</button>';
            html += '      </div>';
            html += '    </div>';
            html += '</li>';*/

            var html = '';
            html += '<li class="my-3 border-bottom" id="inputFormRow">';
                html += '   <div class="row d-flex pb-4">';
                html += '      <input type="hidden" name="restock[usuarioId][]" class="usuarioId" value="{{ auth()->user()->id }}">'
                html += '      <input type="hidden" name="restock[tipo][]" id="id" value="' + tipo + '">';
                html += '      <input type="hidden" name="restock[id][]" id="id" value="' + inventarioId + '">';

                html += '      <div class="col-6">';
                html += '          <label for="descripcion" class="labelTitulo">Cantidad:*</label></br>';
                html +='           <input type="number" class="inputCaja text-right" id="cantidad" placeholder="Ingresa Cantidad" name="restock[cantidad][]" value="">';
                html += '      </div>';

                html += '      <div class="col-6">';
                html += '          <label for="descripcion" class="labelTitulo">Costo Total:*</label></br>';
                html +='           <input type="number" class="inputCaja text-right" id="Costo" placeholder="Ingresa Costo" name="restock[costo][]" value="">';
                html += '      </div>';

                html += '      <div class="col-6 "></br>';
                html += '           <label for="cantidad" class="labelTitulo">Número Parte:</label></br>';
                html += '      <input class="inputCaja text-right" name="restock[numparte][]" id="numparte" value="' + numparte + '" readonly style="color: gray;">';
                html += '      </div>';

                html += '      <div class="col-6 "></br>';
                html += '           <label for="cantidad" class="labelTitulo">Nombre:</label></br>';
                html += '      <input class="inputCaja text-right" name="restock[nombre][]" id="gastoId" value="' + nombre + '" readonly style="color: gray;">';
                html += '      </div>';

                html += '      <div class="col-6 "></br>';
                html += '          <label for="cantidad" class="labelTitulo">Marca:</label></br>';
                html +='           <input class="inputCaja text-right" id="cantidad" placeholder="Ingresa Marca" name="restock[marca][]" value="'+ marca +'" readonly style="color: gray;">';
                html += '      </div>';

                html += '      <div class="col-6"></br>';
                html += '          <label for="descripcion" class="labelTitulo">Modelo:</label></br>';
                html +='           <input type="number" class="inputCaja text-right" id="Costo" placeholder="Ingresa Costo" value="'+ modelo +'" readonly style="color: gray;>';
                html += '      </div>';

                html += '      <div class="col-12 text-center mt-4"></br>';
                html += '      </div>';
                html += '      <div class="col-12 text-center mt-4"></br>';
                html += '         <button id="removeRowBuscador" type="button" class="btn btn-danger">Borrar</button>';
                html += '      </div>';
                html += '    </div>';
                html += '</li>';

            $('#newRowBuscador').append(html);
        }

        // borrar registro
        $(document).on('click', '#removeRowBuscador', function() {
            $(this).closest('#inputFormRow').remove();
        });
    </script>
@endsection
