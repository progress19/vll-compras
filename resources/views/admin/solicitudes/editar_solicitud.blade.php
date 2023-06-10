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
              'id' => 'add_solicitud',
              'name' => 'add_solicitud',
              'url' => '/admin/editar-solicitud/',
              'role' => 'form',
              'method' => 'post',
              'files' => true])
            }}

              @csrf

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



@endsection

@section('page-js-script')

<script>

  $.ajaxSetup({ headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')}});

  $(function() {
    $('#items_dataTable').DataTable({
        processing: true,
        //serverSide: true,
        pageLength: 50,
        paging: false,
        lengthChange: false,
       // ajax: '{!! route('dataItemsEdit') !!}',

        ajax: {
          url: '{!! route('dataItemsEdit') !!}',
          type: 'POST',
          data: {
            'solicitud': {!! $solicitud->id !!}
          },
        },

        columns: [
            {data: 'numero'},
            {data: 'nombre'},
            {data: 'medida'},
            {data: 'cantidad'},
            {data: 'foto'},
            {data: 'prioridad'},
            {data: 'acciones',title: '', orderable: false, searchable: false, className: 'dt-body-center'},
        ],
        order: [[0, 'asc']],
        language: { "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json" },
    });
  });
</script>

@stop

