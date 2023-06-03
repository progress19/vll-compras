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
                    data-toggle="modal" data-target="#addItemSolicitud" data-boleta="{{-- $boleta->numero --}}"><i
                        class="fa fa-plus"></i> Nuevo item</button>
                <div class="clearfix"></div>

                <table class="hover table table-striped table-bordered dt-responsive nowrap" id="items_dataTable" style="width:100%">
                    <thead>
                        <tr>
                          <th>Nº</th>
                          <th>Nombre</th>
                          {{--<th>Unidad de medida</th>
                          <th>Cantidad</th>
                          <th>Foto</th>
                          <th>Prioridad</th>--}}
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

    $(document).on('click', '.delete-item', function() {
        
      var itemId = $(this).data('id');
        
        // Realizar la solicitud AJAX para eliminar el item
        $.ajax({
            url: '{!! route('deleteItemSesion') !!}',
            type: 'POST',
            data: {
                itemId: itemId
            },
            dataType: 'json',
            success: function(response) {

              $('#items_dataTable').DataTable().ajax.reload();

                if (response.success) {
                    // Item eliminado correctamente, puedes realizar alguna acción adicional si lo deseas
                } else {
                    // No se pudo eliminar el item, manejar el error si es necesario
                }
            },
            error: function(xhr, status, error) {
                // Manejar el error de la solicitud AJAX si es necesario
            }
        });
    });


    $(function() {
      $('#items_dataTable').DataTable({
          processing: true,
          //serverSide: true,
          pageLength: 50,
          ajax: '{!! route('dataItems') !!}',
          columns: [
            
              {data: 'numero'},
              {data: 'nombre'},
              {data: 'acciones',title: '', orderable: false, searchable: false, className: 'dt-body-center'},
              
          ],
          order: [[0, 'asc']],
          language: {
              "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
          },
      });
    });


  /* item-solicitud add_item */

  $("#add_item").validate({
      event: "blur",
      rules: {
          'nombreItem': "required",
      },
      messages: {
        'nombreItem': "Por favor ingrese nombre.",
      },
      debug: true,errorElement: "label",

      submitHandler: function(form) {

        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')}});

        // Obtener los valores del formulario
        var formData = new FormData(form);

        // Obtener la foto seleccionada por el usuario
        var foto = $('#archivo')[0].files[0];

        // Agregar la foto al objeto FormData
        formData.append('foto', foto);

        // Realizar la llamada AJAX para subir la foto al servidor
        $.ajax({
          url: "upload-image",
          method: "POST",
          data: formData,
          contentType: false,
          processData: false,
          success: function(response) {
            // Obtener el nombre de la foto subida desde la respuesta del servidor
            var nombreFoto = response.nombreFoto;

            // Obtener los demás valores del formulario
            var otherData = $('#add_item').serializeArray();

            // Crear un objeto con los valores del formulario
            var item = {};
            for (var i = 0; i < otherData.length; i++) {
              item[otherData[i].name] = otherData[i].value;
            }

            // Agregar el nombre de la foto al objeto item
            item.foto = nombreFoto;

            // Agregar el objeto item a la sesión
            $.ajax({
              url: "add-itemSesion",
              method: "POST",
              data: {item: item},
              success: function(response) {
                $('#addItemSolicitud').modal('toggle');
                toast('Item agregado...');
                $('#items_dataTable').DataTable().ajax.reload();
                //$('#cuotasPago_dataTable').DataTable().clear().destroy();
                //console.log(item);
              }
            });
          }
        });
      }

  });

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

  $('#addItemSolicitud').on('hidden.bs.modal', function() {
    $('#planes_dataTable').DataTable().ajax.reload();
  });

  $('#botonAddItem').click(function(e) {

    $('#nombreItem').val('');
    $('#cantidadItem').val(1);
    $('#descripcionItem').val('');
    $('#archivo').val('');

    var selectMedidaItem = $('#medidaItem');
    var selectPrioridadItem = $('#prioridadItem');

    selectMedidaItem.val(selectMedidaItem.find('option:first').val()).trigger('change');
    selectPrioridadItem.val(selectPrioridadItem.find('option:first').val()).trigger('change');
        
    //var boleta = $('#boleta').val();

    //var baseUrl = document.getElementById('baseUrl').value;

    /*    
    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
        }
    })

    $.ajax({
        url: "/getNroPlan/" + boleta,
        method: "post",
        success: function(data) {
            $('#nro').val(data);
        }
    });
    */

});

</script>


@stop

