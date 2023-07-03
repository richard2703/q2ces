@extends('layouts.main', ['activePage' => 'checklist', 'titlePage' => __('NuevaTarea Check List')])
@section('content')
<div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header bacTituloPrincipal">
                                    <h4 class="card-title">Tareas de Check List</h4>
                                   
                                </div>
                                <div class="card-body">
                                    
                                        <!--<div class="alert alert-success" role="success">
                                            
                                        </div>
                                    
                                        <div class="alert alert-danger" role="faild">
                                            
                                        </div>-->
                                    
                                    <div class="row">
                                        <div class="col-12 text-right">    
                                            <!--<a href="{{ url('/nuevoMantenimiento') }}">Agregar ruta--> 
                                            <button type="button" class="btn botonGral" data-bs-toggle="modal" data-bs-target="#nuevaTarea">Registro de Tarea</button>   
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead class="labelTitulo">
                                                <tr>
                                                    <th class="labelTitulo">Categoría</th>
                                                    <th class="labelTitulo">Nombre</th>
                                                    <th class="labelTitulo">Ubicación</th>
                                                    <th class="labelTitulo">Tipo</th>
                                                    <th class="labelTitulo">Comentario</th>
                                                    <th class="labelTitulo text-right">Acciones</th>
                                                </tr>   
                                            </thead>
                                            <tbody>
                                             
                                                    <tr>
                                                        <td>RE-214 </td>
                                                        <td>Retroexcabadora </td>
                                                        
                                                        <td>Taller</td>
                                                        
                                                        <td>Tipo A</td>
                                                        <td>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur sagittis elit nec lacinia maximus. Nunc eu ex lobortis, tincidunt purus nec, rhoncus est. Mauris sodales condimentum lectus sed porttitor.Tipo A</td>

                                                        <td class="td-actions d-flex text-right">
                                                           
                                                            <button class="btnSinFondo" type="submit" data-bs-toggle="modal" data-bs-target="#EditarTarea">
                                                                <svg xmlns="http://www.w3.org/2000/svg "  width="28" height="28" fill="currentColor" title="Editar" class="bi bi-pencil accionesIconos"  viewBox="0 0 16 16">
                                                                <path  d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                                                                </svg>
                                                            </button>
                                                           
                                                            <form action=""
                                                                method="POST" style="display: inline-block;"
                                                                onsubmit="return confirm('Seguro?')">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button class="btnSinFondo" type="submit" rel="tooltip">
                                                                    <svg xmlns="http://www.w3.org/2000/svg"  width="28" height="28"  fill="currentColor"  title="Eliminar" class="bi bi-x-circle"  viewBox="0 0 16 16">
                                                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                                                                    </svg>
                                                                </button>
                                                            </form>
                                                            {{-- @endcan --}}
                                                        </td>
                                                    </tr>
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!--MODAL-->
<!--Nuevo registro de Tarea Check List-->
<div class="modal fade" id="nuevaTarea" tabindex="-1" aria-labelledby="nuevaTareaModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="nuevaTareaModalLabel">Nuevo registro de Tarea</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
          <div class="mb-3">
            <label for="recipient-name" class="labelTitulo">Categoría:</label>
            <select class="form-select" id="floatingSelect" aria-label="Floating label select example">
                <option selected>Selecciona una opción</option>
                <option value="1">Categoría Uno</option>
                <option value="2">Categoría Dos</option>
                <option value="3">Categoría Tres</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="message-text" class="labelTitulo">Nombre:</label>
            <input type="text" class="inputCaja" id="" required="" name="" value="">    
          </div>
          <div class="mb-3">
            <label for="recipient-name" class="labelTitulo">Ubicación:</label>
            <select class="form-select" id="floatingSelect" aria-label="Floating label select example">
                <option selected>Selecciona una opción</option>
                <option value="1">Ubicación Uno</option>
                <option value="2">Ubicación Dos</option>
                <option value="3">Ubicación Tres</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="recipient-name" class="labelTitulo">Tipo:</label>
            <select class="form-select" id="floatingSelect" aria-label="Floating label select example">
                <option selected>Selecciona una opción</option>
                <option value="1">Ubicación Uno</option>
                <option value="2">Ubicación Dos</option>
                <option value="3">Ubicación Tres</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Pon tu comentario</label>
            <textarea class="form-select" id="exampleFormControlTextarea1" rows="3"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Regresar</button>
        <button type="button" class="btn botonGral">Guardar</button>
      </div>
    </div>
  </div>
</div>

<!--Editar Tarea Check List-->
<div class="modal fade" id="EditarTarea" tabindex="-1" aria-labelledby="EditarTareaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="nuevaTareaModalLabel">Editar Tarea</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form>
            <div class="mb-3">
              <label for="recipient-name" class="labelTitulo">Categoría:</label>
              <select class="form-select" id="floatingSelect" aria-label="Floating label select example">
                  <option selected>Selecciona una opción</option>
                  <option value="1">Categoría Uno</option>
                  <option value="2">Categoría Dos</option>
                  <option value="3">Categoría Tres</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="message-text" class="labelTitulo">Nombre:</label>
              <input type="text" class="inputCaja" id="" required="" name="" value="">    
            </div>
            <div class="mb-3">
              <label for="recipient-name" class="labelTitulo">Ubicación:</label>
              <select class="form-select" id="floatingSelect" aria-label="Floating label select example">
                  <option selected>Selecciona una opción</option>
                  <option value="1">Ubicación Uno</option>
                  <option value="2">Ubicación Dos</option>
                  <option value="3">Ubicación Tres</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="recipient-name" class="labelTitulo">Tipo:</label>
              <select class="form-select" id="floatingSelect" aria-label="Floating label select example">
                  <option selected>Selecciona una opción</option>
                  <option value="1">Ubicación Uno</option>
                  <option value="2">Ubicación Dos</option>
                  <option value="3">Ubicación Tres</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="exampleFormControlTextarea1" class="form-label">Pon tu comentario</label>
              <textarea class="form-select" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Regresar</button>
          <button type="button" class="btn botonGral">Guardar</button>
        </div>
      </div>
    </div>
  </div>








    

@endsection
