@php
  use App\Fun;
  use Carbon\Carbon;
@endphp

@extends('layouts.adminLayout.admin_design')
@section('content')

      <div class="col-md-10">
        <div class="x_panel animate__animated animate__fadeIn">
          <div class="x_title">
            <h2><i class="fa fa-cart-plus"></i> Solicitud de Compra - Editar</h2>
            <ul class="nav navbar-right panel_toolbox"></ul>
            <div class="clearfix"></div>
          </div>

          <div class="x_content">

            {{ Form::open([
              'id' => 'edit_solicitud',
              'name' => 'edit_solicitud',
              'url' => '/admin/editar-solicitud/'.$solicitud->id,
              'role' => 'form',
              'method' => 'post',
              'files' => true])
            }}

              @csrf

              <div class="col-md-1">
                <div class="form-group">
                  {!! Form::label('id', 'N°') !!}
                  {!! Form::text('id', $solicitud->id, ['id' => 'id', 'class' => 'form-control', 'readonly' => 'readonly']) !!}
                </div>
              </div>

              <div class="col-md-2">
                <div class="form-group">
                  {!! Form::label('fecha', 'Fecha') !!}
                  {!! Form::text('fecha', Carbon::parse($solicitud->fecha)->format('d-m-Y'), ['id' => 'fechaNec', 'class' => 'form-control', 'readonly' => 'readonly']) !!}
                </div>
              </div>

              <div class="col-md-3">
                <div class="form-group">
                  {!! Form::label('estado', 'Estado') !!}
                  {!! Form::select('estado', Fun::getStatusSolicitudList(), $solicitud->estado, ['id' => 'medidaItem', 'class' => 'form-control select2']); !!}
                </div>
              </div>  

              <div class="clearfix"></div>

              <div class="col-md-6">
                <div class="form-group">
                  {!! Form::label('titulo', 'Título') !!}
                  {!! Form::text('titulo', $solicitud->titulo, ['id' => 'titulo', 'class' => 'form-control', 'readonly' => 'readonly']) !!}
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  {!! Form::label('sector', 'Centro de costos') !!}
                  {!! Form::text('sector', $solicitud->sector->nombre, ['id' => 'sector', 'class' => 'form-control', 'readonly' => 'readonly']) !!}
                </div>
              </div>

              <div class="col-md-2">
                <div class="form-group">
                  {!! Form::label('fechaNec', 'Fecha de necesidad') !!}
                  {!! Form::text('fechaNec', Carbon::parse($solicitud->fechaNec)->format('d-m-Y'), ['id' => 'fechaNec', 'class' => 'form-control', 'readonly' => 'readonly']) !!}
                </div>
              </div>
                  
              <div class="clearfix"></div>
              <hr><br>

              <div class="col-12">

                <div class="clearfix"></div>

                <table class="hover table table-striped table-bordered dt-responsive nowrap" id="items_dataTable" style="width:100%">
                    <thead>
                        <tr>
                          <th>Nº</th>
                          <th>Nombre</th>
                          <th>Unidad de medida</th>
                          <th>Cantidad</th>
                          <th>Foto</th>
                          <th>Prioridad</th>
                        </tr>
                    </thead>
                </table>

              </div>
              
              <div class="clearfix"></div>
                <div class="col-md-12"><div class="ln_solid"></div>
                <button id="send" type="submit" class="btn btn-primary pull-right"><i class="fa fa-refresh" aria-hidden="true"></i> Actualizar solicitud</button>
              </div>

            {!! Form::close() !!}

          </div>
        </div>
      </div>

      @include('admin.solicitudes._editItemSolicitud')

@endsection

@section('page-js-script')

<script>
    
  $(document).ready(function() { $('select').select2({ width: '100%' }); }); 
  
  $.ajaxSetup({ headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')}});

  $(function() {
    $('#items_dataTable').DataTable({
        processing: true,
        //serverSide: true,
        pageLength: 50,
        paging: false,
        lengthChange: false,

        ajax: {
          url: '{!! route('dataItemsEdit') !!}',
          type: 'POST',
          data: {
            'solicitud': {!! $solicitud->id !!}
          },
        },
        columns: [
            {data: 'numero_raw', className: 'dt-body-center'},
            {data: 'nombre'},
            {data: 'medida_raw'},
            {data: 'cantidad'},
            {data: 'foto_raw'},
            {data: 'prioridad_raw'},
        ],
        order: [[0, 'asc']],
        //language: { "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json" },
    });
  });

  /* EDIT ITEM CALL MODAL */

  $(function() {

    $('#modal_editItemSolicitud').on('show.bs.modal', function(e) {

        var idItemSolicitud = $(e.relatedTarget).data('id');
        $(e.currentTarget).find('input[name="id"]').val(idItemSolicitud);
        
        var baseUrl = document.getElementById('baseUrl').value;

        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content') } })

        $.ajax({
            url: baseUrl + "/getItemSolicitud/" + idItemSolicitud,
            method: "post",
            success: function(data) {
            
              $(e.currentTarget).find('input[name="nombreItemEdit"]').val(data.nombre);
              $(e.currentTarget).find('input[name="cantidadItemEdit"]').val(data.cantidad);
              $(e.currentTarget).find('textarea[name="descripcionItemEdit"]').val(data.descripcion);

              $('#medidaItemEdit').val(data.idUnidad).trigger('change');
              $('#medidaItemEdit').select2({ disabled: true });

              $('#prioridadItemEdit').val(data.idPrioridad).trigger('change');
              $('#prioridadItemEdit').select2({ disabled: true });

              var srcFoto = baseUrl + '/fotos/' + data.foto;
              $('#modalImageItem').attr('src', srcFoto);
              
              /*<img src="'.url('/').'/fotos/'.$item->foto.'" style="max-height:50px;border-radius: 5px;">*/


            }
        });

    });

});

</script>

@stop

