@php
  use App\Fun;
  use Carbon\Carbon;
@endphp

@extends('layouts.adminLayout.admin_design')
@section('content')

      <div class="col-md-12">
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
              'url' => '/admin/agregar-solicitud/',
              'role' => 'form',
              'method' => 'post',
              'files' => true])
            }}

              <div class="col-md-4">
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
              
                <div class="col-md-3">
                  <div class="form-group">
                    {!! Form::label('estado', 'Estado') !!}
                    {!! Form::select('estado', array('1' => 'Activado', '0' => 'Desactivado'), null, ['id' => 'estado', 'class' => 'form-control']); !!}
                  </div>
                </div>   

                <div class="col-md-12"><div class="ln_solid"></div>
                <button id="send" type="submit" class="btn btn-success pull-right"><i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar</button>
              </div>

            {!! Form::close() !!}

          </div>
        </div>
      </div>

@endsection

@section('page-js-script')

<script>

  $('.datespicker').datepicker({
    format: "dd-mm-yyyy",
    todayBtn: "linked",
    autoclose: true,
    todayHighlight: true,
    startDate: "0d"
    //defaultViewDate: { year: 1977, month: 04, day: 25 }
  });

  $('.select2').select2();

</script>


@stop

