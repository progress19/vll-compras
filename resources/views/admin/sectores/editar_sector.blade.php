@extends('layouts.adminLayout.admin_design')
@section('content')

      <div class="col-md-6">
        <div class="x_panel animate__animated animate__fadeIn">
          <div class="x_title">
            <h2><i class="fa fa-building-o"></i> Centros de costos<small>/ Editar</small></h2>
            <ul class="nav navbar-right panel_toolbox"></ul>
            <div class="clearfix"></div>
          </div>

          <div class="x_content">

            {{ Form::open([
              'id' => 'edit_sector',
              'name' => 'edit_sector',
              'url' => '/admin/editar-sector/'.$sector->id,
              'role' => 'form',
              'method' => 'post',
              'files' => true]) }}

              <div class="col-md-5">
                <div class="form-group">
                  {!! Form::label('nombre', 'Nombre') !!}
                  {!! Form::text('nombre', $sector->nombre, ['id' => 'nombre', 'class' => 'form-control']) !!}
                </div>
              </div>

              <div class="clearfix"></div>
              
              <div class="col-md-3">
                <div class="form-group">
                  {!! Form::label('estado', 'Estado') !!}
                  {!! Form::select('estado', array('1' => 'Activado', '0' => 'Desactivado'), $sector->estado, ['id' => 'estado', 'class' => 'form-control']); !!}
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


@stop

