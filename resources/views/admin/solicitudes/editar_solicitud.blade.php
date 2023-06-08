@php
  use App\Fun;
  use Carbon\Carbon;
@endphp

@extends('layouts.adminLayout.admin_design')
@section('content')

      <div class="col-md-8">
        <div class="x_panel animate__animated animate__fadeIn">
          <div class="x_title">
            <h2><i class="fa fa-building-o"></i> Centros de costos<small>/ Editar</small></h2>
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

              <div class="col-md-6">
                <div class="form-group">
                  {!! Form::label('titulo', 'Título') !!}
                  {!! Form::text('titulo', $solicitud->titulo, ['id' => 'titulo', 'class' => 'form-control']) !!}
                </div>
              </div>
               
              <div class="col-md-4">
                <div class="form-group">
                  {!! Form::label('sector', 'Centro de costos') !!}
                  {!! Form::select('idSector', $sectores, $solicitud->idSector, ['id' => 'idSector', 'placeholder' => 'Seleccione Centro de costos...', 'class' => 'form-control select2']) !!}
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
                    data-toggle="modal" data-target="#addItemSolicitud" data-boleta="{{-- $boleta->numero --}}"><i
                        class="fa fa-plus"></i> Nuevo item</button>
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


@stop

