@php
  use App\Fun;
  use Carbon\Carbon;
@endphp

<!-- modals -->
<!-- modal nuevo Item solicitud -->
<div class="modal fade bs-example-modal-lg" id="addItemSolicitud" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">

    <div class="modal-content">
      
      {{ Form::open(array('id' => 'add_item', 'role' => 'form','files' => true, 'enctype' => 'multipart/form-data', 'method' => 'POST')) }}

      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-bars"></i> Nuevo item</h4>
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
        </button>
      </div>

      <div class="modal-body">

        {{-- Form::hidden('boleta', $boleta->numero, array('id' => 'boleta')) --}}
        {{ Form::hidden('baseUrl', url('/'), array('id' => 'baseUrl')) }}
        
        <div class="col-md-1">
          <div class="form-group">
            {!! Form::text('nro', 2, array('readonly','class' => 'form-control','id' => 'nro')) !!}      
          </div>
        </div>

        <div class="clearfix"></div>

        <div class="col-md-5">
          <div class="form-group">
            {!! Form::label('nombreItem', 'Nombre') !!}
            {!! Form::text('nombreItem', null, ['id' => 'nombreItem', 'class' => 'form-control']) !!}
          </div>
        </div>

        <div class="col-md-3">
          <div class="form-group">
            {!! Form::label('medidaItem', 'Unidad de medida') !!}
            {!! Form::select('medidaItem', Fun::getUnidadesDeMedida(), null, ['id' => 'medidaItem', 'class' => 'form-control select2']); !!}
          </div>
        </div>  
        
        <div class="col-md-2">
          <div class="form-group">
            {!! Form::label('cantidadItem', 'Cantidad') !!}
            {!! Form::text('cantidadItem', 1, ['id' => 'cantidadItem', 'class' => 'form-control']) !!}
          </div>
        </div>

        <div class="col-md-2">
          <div class="form-group">
            {!! Form::label('prioridadItem', 'Prioridad') !!}
            {!! Form::select('prioridadItem', Fun::getPrioridades(), null, ['id' => 'prioridadItem', 'class' => 'form-control select2']); !!}
          </div>
        </div>  

        <div class="col-md-12">
          <div class="form-group">
            <textarea name="descripcionItem" id="descripcionItem" class="form-control" rows="50" cols="100" style="height: 150px;"></textarea>
          </div>
        </div>
       
        <div class="col-md-12">
          <div class="form-group">
            {!! Form::label('foto', 'Foto') !!}
            <label for="archivo" class="custom-file-upload">Seleccionar foto</label>
            {!! Form::file('foto', ['id' => 'archivo', 'class' => 'form-control', 'style' => 'display:none;', 'onchange' => 'mostrarNombreArchivo()']) !!}
            <span id="nombre-archivo"></span>
          </div>
        </div>

      <div class="clearfix"></div>

      </div> <!-- modal body -->

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-close"></i> Cancelar</button>
        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Agregar item</button>
      </div>

      {!! Form::close() !!}

    </div>
  </div>
</div>