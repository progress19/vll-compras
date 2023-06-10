@php
  use App\Fun;
  use Carbon\Carbon;
@endphp

<!-- modals EDIT Item -->
      <div class="modal fade bs-example-modal-lg" id="modal_editItemSolicitud" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          
          <div class="modal-content">

            {{ Form::open(array('id' => 'edit_etapaBoleta', 'role' => 'form')) }}

            <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel"><i class="fa fa-bars"></i> Editar item</h4>
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
              </button>
            </div>

            <div class="modal-body">

              {{ Form::hidden('id', null) }}
              {{ Form::hidden('boleta', null) }}
              {{ Form::hidden('baseUrl', url('/'), array('id' => 'baseUrl')) }}
                
              <div class="col-md-5">
                <div class="form-group">
                  {!! Form::label('nombreItem', 'Nombre') !!}
                  {!! Form::text('nombreItemEdit', null, ['id' => 'nombreItemEdit', 'class' => 'form-control', 'readonly' => 'readonly']) !!}
                </div>
              </div>
      
              <div class="col-md-3">
                <div class="form-group">
                  {!! Form::label('medidaItem', 'Unidad de medida') !!}
                  {!! Form::select('medidaItemEdit', Fun::getUnidadesDeMedida(), null, ['id' => 'medidaItemEdit', 'class' => 'form-control select2']); !!}
                </div>
              </div>  
              
              <div class="col-md-2">
                <div class="form-group">
                  {!! Form::label('cantidadItem', 'Cantidad') !!}
                  {!! Form::text('cantidadItemEdit', null, ['id' => 'cantidadItemEdit', 'class' => 'form-control', 'readonly' => 'readonly']) !!}
                </div>
              </div>
      
              <div class="col-md-2">
                <div class="form-group">
                  {!! Form::label('prioridadItem', 'Prioridad') !!}
                  {!! Form::select('prioridadItemEdit', Fun::getPrioridades(), null, ['id' => 'prioridadItemEdit', 'class' => 'form-control select2']); !!}
                </div>
              </div>  
      
              <div class="col-md-12">
                <div class="form-group">
                  {!! Form::label('descripcionItem', 'Descripción') !!}
                  <textarea name="descripcionItemEdit" id="descripcionItemEdit" class="form-control" rows="50" cols="100" style="height: 150px;" readonly="readonly"></textarea>
                </div>
              </div>
             
              {{-- 
              <div class="col-md-12">
                <div class="form-group">
                  {!! Form::label('foto', 'Foto') !!}
                  <label for="archivo" class="custom-file-upload">Seleccionar foto</label>
                  {!! Form::file('foto', ['id' => 'archivo', 'class' => 'form-control', 'style' => 'display:none;', 'onchange' => 'mostrarNombreArchivo()']) !!}
                  <span id="nombre-archivo"></span>
                </div>
              </div>
              --}}

              <div class="col-md-7">
                <div class="form-group">
                  <img id="modalImageItem" class="img-fluid" src="" style="max-height:600px; border-radius: 5px;">
                </div>
              </div>
      
            <div class="clearfix"></div>

            </div> <!-- modal body -->

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-close"></i> Cerrar</button>
              {{--<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Guardar</button>--}}
            </div>

            {!! Form::close() !!}

          </div>
        </div>
      </div>