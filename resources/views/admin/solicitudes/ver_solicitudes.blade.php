@php
  use App\Fun;
@endphp

@extends('layouts.adminLayout.admin_design')
@section('content')

  <div class="col-md-12 col-sm-12 ">
    <div class="x_panel animate__animated animate__fadeIn">

      <div class="x_title">
        <h2><i class="fa fa-cart-plus"></i> Solicitudes de compras - Lista</h2>
        <div class="clearfix"></div>
      </div>

      <div class="x_content">
        <div class="row">
          <div class="col-sm-12">
            <div class="card-box">

              <table class="hover table table-striped table-bordered dt-responsive nowrap" id="table" style="width:100%">
                <thead>
                  <tr>
                    <th>N°</th>
                    <th>Fecha</th>
                    <th>Usuario</th>
                    <th>Centro de costos</th>
                    <th>Título</th>
                    <th>Fec. necesidad</th>
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
        pageLength: 50,
        ajax: '{!! route('dataSolicitudes') !!}',
        columns: [
            {data: 'numero_raw'},
            {data: 'fecha_raw'},
            {data: 'usuario_raw'},
            {data: 'sector_raw'},
            {data: 'titulo_raw'},
            {data: 'fechaNec_raw'},
            {data: 'estado', orderable: false, searchable: false, className: 'dt-body-center'},
            {data: 'acciones',title: '', orderable: false, searchable: false, className: 'dt-body-center'},
            //{data: 'nombre', name: 'nombre', searchable: true, visible: false},
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



