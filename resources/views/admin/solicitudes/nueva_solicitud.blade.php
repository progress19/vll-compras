@php
  use App\Fun;
  use Carbon\Carbon;
@endphp

@extends('layouts.adminLayout.admin_design')
@section('content')

      <div class="col-md-10">
        <div class="x_panel animate__animated animate__fadeIn">
          <div class="x_title">
            <h2><i class="fa fa-cart-plus"></i> Solicitudes de compras - Nueva</h2>
            <ul class="nav navbar-right panel_toolbox"></ul>
            <div class="clearfix"></div>
          </div>

          <div class="x_content">

            {{ Form::open([
              'id' => 'add_solicitud',
              'name' => 'add_solicitud',
              'url' => '/admin/nueva-solicitud/',
              'role' => 'form',
              'method' => 'post',
              'files' => true])
            }}

              <div class="col-md-3">
                <div class="form-group">
                  {!! Form::label('titulo', 'Título') !!}
                  {!! Form::text('titulo', null, ['id' => 'titulo', 'class' => 'form-control']) !!}
                </div>
              </div>

              <div class="clearfix"></div>
               
              <div class="col-md-3">
                <div class="form-group">
                  {!! Form::label('sector', 'Centro de costos') !!}
                  {!! Form::select('idSector', $sectores, null, ['id' => 'idSector', 'placeholder' => 'Seleccione Centro de costos...', 'class' => 'form-control select2']) !!}
                </div>
              </div>
              
              <div class="col-md-2">
                <div class="form-group">
                    {!! Form::label('fechaNec', 'Fecha de necesidad') !!}
                    {!! Form::text('fechaNec', Carbon::now()->format('d-m-Y'), [
                        'class' => 'form-control datespicker',
                        'id' => 'fechaNec',
                    ]) !!}
                </div>
              </div>
  
              <div class="clearfix"></div>
              <hr><br>

              <div class="col-12">

                <button type="button" id="botonAddItem" class="btn btn-primary"
                    data-toggle="modal" data-target="#addPlanBoleta" data-boleta="{{-- $boleta->numero --}}"><i
                        class="fa fa-plus"></i> Nuevo item</button>
                <div class="clearfix"></div>

                <table class="hover table table-striped table-bordered dt-responsive nowrap"
                    id="planes_dataTable" style="width:100%">
                    <thead>
                        <tr>
                          <th>Nº</th>
                          <th>Nombre</th>
                          <th>Unidad de medida</th>
                          <th>Cantidad</th>
                          <th>Foto</th>
                          <th>Prioridad</th>
                          <th></th>
                        </tr>
                    </thead>
                </table>

            </div>
              
              <div class="clearfix"></div>
                <div class="col-md-12"><div class="ln_solid"></div>
                <button id="send" type="submit" class="btn btn-primary pull-right"><i class="fa fa-paper-plane" aria-hidden="true"></i> Enviar solicitud</button>
              </div>

            {!! Form::close() !!}

          </div>
        </div>
      </div>

      @include('admin.solicitudes._addItemSolicitud')

@endsection

@section('page-js-script')

<script>

  function mostrarNombreArchivo() {
    var archivo = document.getElementById('archivo').value;
    var nombreArchivo = archivo.split('\\').pop(); // Obtener el nombre del archivo sin la ruta completa
    document.getElementById('nombre-archivo').innerHTML = nombreArchivo;
  }


  $('.datespicker').datepicker({
    format: "dd-mm-yyyy",
    todayBtn: "linked",
    autoclose: true,
    todayHighlight: true,
    startDate: "0d"
    //defaultViewDate: { year: 1977, month: 04, day: 25 }
  });

  $('.select2').select2();

  $('#botonAddItem').click(function(e) {

    $('#nombreItem').val('');
    $('#cantidadItem').val(1);
    $('#descripcionItem').val('');

    var selectMedidaItem = $('#medidaItem');
    var selectPrioridadItem = $('#prioridadItem');

    selectMedidaItem.val(selectMedidaItem.find('option:first').val()).trigger('change');
    selectPrioridadItem.val(selectPrioridadItem.find('option:first').val()).trigger('change');
        
    var boleta = $('#boleta').val();

    var baseUrl = document.getElementById('baseUrl').value;

    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
        }
    })

    $.ajax({
        url: baseUrl + "/getNroPlan/" + boleta,
        method: "post",
        success: function(data) {
            $('#nro').val(data);
        }
    });

});

</script>


@stop

