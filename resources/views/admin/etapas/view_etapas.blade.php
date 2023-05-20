@php
  use App\Fun;
@endphp

@extends('layouts.adminLayout.admin_design')
@section('content')

      <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">

          <div class="x_title">
            <h2><i class="fa fa-bars"></i> Etapas /<small>Lista</small></h2>

            <div class="clearfix"></div>
          </div>

          <div class="x_content">

            <div class="row">
              <div class="col-sm-12">
                <div class="card-box">

                  <table class="hover table table-striped table-bordered dt-responsive nowrap" id="table" style="width:100%">
                    <thead>
                      <tr>
                        <th>Código</th>
                        <th>Nombre</th>
                        <th>Archivo</th>  
                        <th>Estado</th>
                        <th></th>
                      </tr>
                    </thead>
                  </table>

                </div>
              </div>
            </div>

          </div>

        </div>
      </div>

@endsection

@section('page-js-script')
  @if (session('flash_message'))
    <script>toast('{!! session('flash_message') !!}');</script>
  @endif

<script>

$(function() {
    $('#table').DataTable({
        processing: true,
        //serverSide: true,
        ajax: '{!! route('dataEtapas') !!}',
        columns: [

            {data: 'cod', title: 'Código', searchable: true, className: 'dt-body-right'},
            {data: 'nombre'},
            {data: 'archivo', orderable: false, searchable: false, className: 'dt-body-center'},
            {data: 'estado', orderable: false, searchable: false, className: 'dt-body-center'},
            {data: 'acciones',title: '', orderable: false, searchable: false, className: 'dt-body-center'},
            {data: 'codigo', name: 'codigo', searchable: true, visible: false},

        ],

        language: {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
         },
    });
});


$(document).ready(function() {
    $('#table tbody').on( 'click', '.delReg', function () {
    if (confirm('Está seguro de eliminar el registro ?')) {
        return true;
    }
    return false;
    });
});

</script>


@stop


