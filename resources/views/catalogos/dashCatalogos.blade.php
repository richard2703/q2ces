@extends('layouts.main', ['activePage' => 'equipos', 'titlePage' => __('Dashboard Catálogos')])
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12 align-self-center">
                    <div class="card">
                        <div class="card-body">
                            <div class="row d-flex ">

                                @can('catalogos_show')
                                    <div class="col-12 col-md-6 col-lg-3 text-center my-4">
                                        <a href="{{ route('catalogoPuestos.index') }}" class="">
                                            <img src="/img/catalogos/puestos.svg" alt="Puestos" title="Puestos" width="30%"
                                                class="botonIconoPrincipal">
                                            <p class="mt-4 texticonos">Puestos</p>
                                        </a>
                                    </div>

                                    <div class="col-12 col-md-6 col-lg-3 text-center my-4">
                                        <a href="{{ route('catalogoPuestosNivel.index') }}" class="">
                                            <img src="/img/catalogos/nivelPuestos.svg" alt="Nivel de Puestos"
                                                title="Nivel de Puestos" width="30%" class="botonIconoPrincipal">
                                            <p class="mt-4 texticonos">Nivel De Puestos</p>
                                        </a>
                                    </div>

                                    <div class="col-12 col-md-6 col-lg-3 text-center my-4">
                                        <a href="{{ route('catalogoCategoriasTareas.index') }}" class="">
                                            <img src="/img/catalogos/categoriasDeTareas.svg" alt="Categoría de tareas"
                                                title="Categoría de tareas" width="30%" class="botonIconoPrincipal">
                                            <p class="mt-4 texticonos">Categoría De Tareas</p>
                                        </a>
                                    </div>

                                    <div class="col-12 col-md-6 col-lg-3 text-center my-4">
                                        <a href="{{ route('catalogoTiposTareas.index') }}" class="">
                                            <img src="/img/catalogos/tiposDeTarea.svg" alt="Tipos de tareas"
                                                title="Tipos de tareas" width="30%" class="botonIconoPrincipal">
                                            <p class="mt-4 texticonos">Tipos De Tareas</p>
                                        </a>
                                    </div>

                                    <div class="col-12 col-md-6 col-lg-3 text-center my-4">
                                        <a href="{{ route('catalogoUbicacionesTareas.index') }}" class="">
                                            <img src="/img/catalogos/ubicacionesTareas.svg" alt="Ubicaciones de tareas"
                                                title="Ubicaciones de tareas" width="30%" class="botonIconoPrincipal">
                                            <p class="mt-4 texticonos">Ubicaciones De Tareas</p>
                                        </a>
                                    </div>

                                    <div class="col-12 col-md-6 col-lg-3 text-center my-4">
                                        <a href="{{ route('catalogoCategoriasMaquinaria.index') }}" class="">
                                            <img src="/img/catalogos/categoriasDeMaquinaria.svg" alt="Categoría de Maquinaría"
                                                title="Categorias de Maquinaría" width="30%" class="botonIconoPrincipal">
                                            <p class="mt-4 texticonos">Categorias De Maquinaría</p>
                                        </a>
                                    </div>

                                    <div class="col-12 col-md-6 col-lg-3 text-center my-4">
                                        <a href="{{ route('catalogoTiposMaquinaria.index') }}" class="">
                                            <img src="/img/catalogos/tiposUsoMaquinaria.svg" alt="Tipos de Uso de Maquinaría"
                                                title="Tipos de Uso de tareas" width="30%" class="botonIconoPrincipal">
                                            <p class="mt-4 texticonos">Tipos De Uso De Maquinaría</p>
                                        </a>
                                    </div>

                                    <div class="col-12 col-md-6 col-lg-3 text-center my-4">
                                        <a href="{{ route('catalogoTipoUniforme.index') }}" class="">
                                            <img src="/img/catalogos/tiposDeUniforme.svg" alt="Tipos de Uniforme"
                                                title="Tipos de Uniforme" width="30%" class="botonIconoPrincipal">
                                            <p class="mt-4 texticonos">Tipos De Uniforme</p>
                                        </a>
                                    </div>

                                    <div class="col-12 col-md-6 col-lg-3 text-center my-4">
                                        <a href="{{ route('catalogoMarca.index') }}" class="">
                                            <img src="/img/catalogos/marcas.svg" alt="Marcas" title="Marcas" width="30%"
                                                class="botonIconoPrincipal">
                                            <p class="mt-4 texticonos">Marcas</p>
                                        </a>
                                    </div>

                                    <div class="col-12 col-md-6 col-lg-3 text-center my-4">
                                        <a href="{{ route('catalogoProveedor.index') }}" class="">
                                            <img src="/img/catalogos/proveedores.svg" alt="Proveedores" title="Proveedores"
                                                width="30%" class="botonIconoPrincipal">
                                            <p class="mt-4 texticonos">Proveedores</p>
                                        </a>
                                    </div>

                                    <div class="col-12 col-md-6 col-lg-3 text-center my-4">
                                        <a href="{{ route('catalogoProveedorCategoria.index') }}" class="">
                                            <img src="/img/catalogos/categoriasProveedores.svg"
                                                alt="Categorías de Proveedores" title="Categorías de Proveedores"
                                                width="30%" class="botonIconoPrincipal">
                                            <p class="mt-4 texticonos">Categorías De Proveedores</p>
                                        </a>
                                    </div>

                                    <div class="col-12 col-md-6 col-lg-3 text-center my-4">
                                        <a href="{{ route('catalogoTipoRefaccion.index') }}" class="">
                                            <img src="/img/catalogos/tiposDeRefaccion.svg" alt="Tipos de Refacción"
                                                title="Tipos de Refacción" width="30%" class="botonIconoPrincipal">
                                            <p class="mt-4 texticonos">Tipos De Refacción</p>
                                        </a>
                                    </div>

                                    <div class="col-12 col-md-6 col-lg-3 text-center my-4">
                                        <a href="{{ route('catalogoTiposEquipo.index') }}" class="">
                                            <img src="/img/catalogos/tiposDeEquipo.svg" alt="Tipos de Equipo"
                                                title="Tipos de Refacción" width="30%" class="botonIconoPrincipal">
                                            <p class="mt-4 texticonos">Tipos De Equipo</p>
                                        </a>
                                    </div>

                                    <div class="col-12 col-md-6 col-lg-3 text-center my-4">
                                        <a href="{{ route('catalogoRefacciones.index') }}" class="">
                                            <img src="/img/catalogos/refaccionesPorMaquinaria.svg" alt="Refacciones"
                                                title="Refacciones" width="30%" class="botonIconoPrincipal">
                                            <p class="mt-4 texticonos">Refacciones Por Maquinaría</p>
                                        </a>
                                    </div>

                                    <div class="col-12 col-md-6 col-lg-3 text-center my-4">
                                        <a href="{{ route('tiposDocs.index') }}" class="">
                                            <img src="/img/inventario/TIPOS DE DOCUMENTOS-01.svg" alt="Tipos Docs"
                                                title="Tipos Docs" width="30%" class="botonIconoPrincipal">
                                            <p class="mt-4 texticonos">Tipos De Documentos</p>
                                        </a>
                                    </div>

                                    <div class="col-12 col-md-6 col-lg-3 text-center my-4">
                                        <a href="{{ route('docs.index') }}" class="">
                                            <img src="/img/inventario/ADMINISTRACIÓN DE DOCUMENTOS-01.svg" alt="Manage Docs"
                                                title="Manage Docs" width="30%" class="botonIconoPrincipal">
                                            <p class="mt-4 texticonos">Administración De Documentos</p>
                                        </a>
                                    </div>

                                    <div class="col-12 col-md-6 col-lg-3 text-center my-4">
                                        <a href="{{ route('tiposServicios.index') }}" class="">
                                            <img src="/img/inventario/TIPOS DE SERVICIOS-01.svg" alt="Lugares"
                                                title="Lugares" width="30%" class="botonIconoPrincipal">
                                            <p class="mt-4 texticonos">Tipos De Servicios</p>
                                        </a>
                                    </div>

                                    <div class="col-12 col-md-6 col-lg-3 text-center my-4">
                                        <a href="{{ route('lugares.index') }}" class="">
                                            <img src="/img/inventario/LUGARES-01.svg" alt="Lugares" title="Lugares"
                                                width="30%" class="botonIconoPrincipal">
                                            <p class="mt-4 texticonos">Lugares</p>
                                        </a>
                                    </div>

                                    <div class="col-12 col-md-6 col-lg-3 text-center my-4">
                                        <a href="{{ route('ubicaciones.index') }}" class="">
                                            <img src="/img/inventario/UBICACIONES-01.svg" alt="Ubicaciones"
                                                title="Ubicaciones" width="30%" class="botonIconoPrincipal">
                                            <p class="mt-4 texticonos">Ubicaciones</p>
                                        </a>
                                    </div>

                                    <div class="col-12 col-md-6 col-lg-3 text-center my-4">
                                        <a href="{{ route('serviciosMtq.index') }}" class="">
                                            <img src="/img/inventario/SERVICIOS MTQ-01.svg" alt="Servicios MTQ"
                                                title="Servicios MTQ" width="30%" class="botonIconoPrincipal">
                                            <p class="mt-4 texticonos">Servicios MTQ</p>
                                        </a>
                                    </div>

                                    <div class="col-12 col-sm-6 col-md-3 text-center my-4">
                                        <a href="{{ route('catalogoTipoHorasExtra.index') }}" class="">
                                            <img src="/img/catalogos/horasextra.svg" alt="Horas Extras" title="Horas Extras"
                                                width="30%" class="botonIconoPrincipal">
                                            <p class="mt-4 texticonos">Horas Extras</p>
                                        </a>
                                    </div>

                                    <div class="col-12 col-sm-6 col-md-3 text-center my-4">
                                        <a href="{{ route('catalogoTiposValorTarea.index') }}" class="">
                                            <img src="/img/catalogos/valordetareas.svg" alt="Tipos de Valor de Tarea"
                                                title="Tipos de Valor de Tarea" width="30%" class="botonIconoPrincipal">
                                            <p class="mt-4 texticonos">Tipos de Valor de Tarea</p>
                                        </a>
                                    </div>

                                    <div class="col-12 col-sm-6 col-md-3 text-center my-4">
                                        <a href="{{ route('catalogoConceptos.index') }}" class="">
                                            <img src="/img/catalogos/conceptos.svg" alt="Conceptos" title="Conceptos"
                                                width="30%" class="botonIconoPrincipal">
                                            <p class="mt-4 texticonos">Conceptos</p>
                                        </a>
                                    </div>

                                    <div class="col-12 col-sm-6 col-md-3 text-center my-4">
                                        <a href="{{ route('catalogoComprobantes.index') }}" class="">
                                            <img src="/img/catalogos/comprobantes.svg" alt="Comprobantes"
                                                title="Comprobantes" width="30%" class="botonIconoPrincipal">
                                            <p class="mt-4 texticonos">Comprobantes</p>
                                        </a>
                                    </div>

                                    <div class="col-12 col-sm-6 col-md-3 text-center my-4">
                                        <a href="{{ route('catalogoTiposMantenimiento.index') }}" class="">
                                            <img src="/img/catalogos/tiposmantenimientos.svg" alt="Tipos de Mantenimiento"
                                                title="Tipos de Mantenimiento" width="30%" class="botonIconoPrincipal">
                                            <p class="mt-4 texticonos">Tipos de Mantenimiento</p>
                                        </a>
                                    </div>
                                @endcan


                            </div>
                        </div>
                        <!--Footer-->
                        <div class="card-footer mr-auto">
                        </div>
                        <!--End footer-->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
