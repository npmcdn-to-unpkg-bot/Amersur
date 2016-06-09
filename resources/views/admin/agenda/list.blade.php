@extends('layouts.admin')

@section('contenido_admin_title')
	Agenda
@stop

@section('contenido_admin')

	<div class="row">
		<div class="col-lg-12">

			<div class="portlet box blue-hoki">
				
				<div class="portlet-title">
					<div class="caption">
                        <i class="fa fa-globe"></i>Registros
                    </div>
				</div>

				<div class="portlet-body">

                    <div class="table-toolbar">

                        <div class="btn-group">
                            <a href="{{ route('admin.agenda.create') }}" class="btn green">
                                Agregar registro
                                <i class="fa fa-plus"></i>
                            </a>
                        </div>

                    </div>

                    <div class="table-toolbar">

                        <div id="progressbar" class="progress progress-striped active">
                            <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
                        </div>

                        @include('flash::message')

                        <div id="mensajeAjax" class="alert alert-dismissable"></div>
                        
                    </div>

                    <table class="table table-striped table-responsive">
                        <thead>
                            <tr>
                                <th>Nombrew</th>
                                <th>Apellidos</th>
                                <th>Email</th>
                                <th>Teléfono</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($rows as $item)
                            {{--*/
                            $row_id = $item->id;
                            $row_nombres = $item->nombres;
                            $row_apellidos = $item->apellidos;
                            $row_nombre_completo = $item->nombre_completo;
                            $row_email = $item->email;
                            $row_telefono = $item->telefono
                            /*--}}
                            <tr data-id="{{ $row_id }}" data-title="{{ $row_nombre_completo }}">
                                <td>{{ $row_nombres }}</td>
                                <td>{{ $row_apellidos }}</td>
                                <td>{{ $row_email }}</td>
                                <td>{{ $row_telefono }}</td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <button class="btn btn-default btn-xs dropdown-toggle" type="button" data-toggle="dropdown">
                                            Acciones <i class="fa fa-angle-down"></i>
                                        </button>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="{{ route('admin.agenda.edit', $row_id) }}">Editar</a></li>
                                            <li><a href="#delete" class="btn-delete">Eliminar</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="row">

                        <div class="col-md-5 col-sm-12">
                            <div class="dataTables_info" id="table1_info" role="status" aria-live="polite">Total de registros: {{ $rows->total() }}</div>
                        </div>

                        <div class="col-md-7 col-sm-12">
                            <div class="pull-right dataTables_paginate paging_simple_numbers" id="table1_paginate">
                                {!! $rows->appends(Request::all())->render() !!}
                            </div>

                        </div>

                    </div>

				</div>
			</div>
		</div>
	</div>

{!! Form::open(['route' => ['admin.agenda.destroy', ':REGISTER'], 'method' => 'DELETE', 'id' => 'FormDeleteRow']) !!}
{!! Form::close() !!}

<div class="modal-view" id="delete" title="Eliminar registro">
  <p>¿Desea eliminar el registro?</p>
  <div id="deleteTitle"></div>
</div>

@endsection

@section('contenido_footer')
	
<script>
$(document).on("ready", function(){
    $('#mensajeAjax, .modal-view, #progressbar').hide();

    $(".btn-delete").on("click", function(e){
        e.preventDefault();
        var row = $(this).parents("tr");
        var id = row.data("id");
        var title = row.data("title");
        var form = $("#FormDeleteRow");
        var url = form.attr("action").replace(':REGISTER', id);
        var data = form.serialize();

        $("#delete #deleteTitle").text(title);

        $( "#delete" ).dialog({
            resizable: true,
            height: 250,
            modal: false,
            buttons: {
                "Borrar registro": function() {
                    row.fadeOut();

                    $.post(url, data, function(result){
                        $("#mensajeAjax").show().removeClass('alert-danger').addClass('alert-success').text(result.message);
                    }).fail(function(){
                        $("#mensajeAjax").show().removeClass('alert-success').addClass('alert-danger').text("Se produjo un error al eliminar el registro");
                        row.show();
                    });

                    $(this).dialog("close");
                },
                Cancel: function() {
                    $(this).dialog("close");
                }
            }
        });

    });

});
</script>

@endsection