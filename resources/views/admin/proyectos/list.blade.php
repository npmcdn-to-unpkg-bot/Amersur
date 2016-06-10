@extends('layouts.admin')

@section('contenido_admin_title')
	Proyectos
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
                            <a href="{{ route('admin.proyectos.create') }}" class="btn green">
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
                                <th>Titulo</th>
                                <th class="text-center">Publicar</th>
                                <th class="text-center">Fecha Publicación</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($rows as $item)
                            {{--*/
                            $row_id = $item->id;
                            $row_titulo = $item->titulo;
                            $row_fecha = convertirFecha($item->published_at);
                            /*--}}
                            <tr data-id="{{ $row_id }}" data-title="{{ $row_titulo }}">
                                <td>{{ $row_titulo }}</td>
                                <td class="text-center">
                                    <a id="publicar-{{ $item->id }}" href="#" data-method="put" class="btn-publicar">
                                        {!! $item->publicar ? '<span class="badge badge-success badge-roundless">SI</span>' : '<span class="badge badge-default badge-roundless">NO</span>' !!}
                                    </a>
                                </td>
                                <td class="text-center">{{ $row_fecha }}</td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <button class="btn btn-default btn-xs dropdown-toggle" type="button" data-toggle="dropdown">
                                            Acciones <i class="fa fa-angle-down"></i>
                                        </button>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="{{ route('admin.proyectos.edit', $item->id) }}">Editar</a></li>
                                            <li><a href="#delete" class="btn-delete">Eliminar</a></li>
                                            <li class="divider"></li>
                                            <li><a href="{{ route('admin.proyectos.img.list', $item->id) }}">Imagenes</a></li>
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

{!! Form::open(['route' => ['admin.proyectos.destroy', ':REGISTER'], 'method' => 'DELETE', 'id' => 'FormDeleteRow']) !!}
{!! Form::close() !!}

<div class="modal-view" id="delete" title="Eliminar registro">
  <p>¿Desea eliminar el registro?</p>
  <div id="deleteTitle"></div>
</div>

{!! Form::open(['route' => ['admin.proyectos.publicar', ':REGISTER'], 'method' => 'PUT', 'id' => 'FormPublicarRow']) !!}
{!! Form::close() !!}

<div class="modal-view" id="publicar" title="Cambiar estado">
    <p>¿Desea cambiar el estado de Publicar?</p>
    <div id="publicarTitle"></div>
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

    $(".btn-publicar").on("click", function(e){
        e.preventDefault();
        var row = $(this).parents("tr");
        var id = row.data("id");
        var title = row.data("title");
        var form = $("#FormPublicarRow");
        var url = form.attr("action").replace(':REGISTER', id);
        var data = form.serialize();

        $("#publicar #publicarTitle").text(title);

        $( "#publicar" ).dialog({
            resizable: true,
            height: 250,
            modal: false,
            buttons: {
                "Modificar estado": function() {

                    $.post(url, data, function(result){
                        if(result.estado == 1){
                            $("#publicar-"+id+" span").removeClass('badge-default').addClass('badge-success').text('SI');
                        }else if(result.estado == 0){
                            $("#publicar-"+id+" span").removeClass('badge-success').addClass('badge-default').text('NO');
                        }
                    }).fail(function(){
                        $("#mensajeAjax").show().removeClass('alert-success').addClass('alert-danger').text("Se produjo un error");
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