@extends('layouts.admin')

@section('contenido_admin_title')
    Usuarios
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
                            <a href="{{ route('admin.user.create') }}" class="btn green">
                                Agregar registro
                                <i class="fa fa-plus"></i>
                            </a>
                        </div>

                    </div>

                    <div class="table-toolbar">

                        <div id="progressbar" class="progress progress-striped active">
                            <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
                        </div>

                        @if(Session::has('mensaje'))
                            <div class="alert alert-success">
                                {{ Session::get('mensaje') }}
                            </div>
                        @endif

                        <div id="mensajeAjax" class="alert alert-dismissable"></div>
                        
                    </div>

                    {!! Form::model(Request::all(), ['route' => 'admin.user.index', 'method' => 'GET']) !!}

                        <table class="table table-striped table-bordered" id="table2">
                            <thead>
                                <tr>
                                    <th>Buscar</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="col-md-8">
                                        {!! Form::text('email', null, ['class' => 'form-control input-sm', 'placeholder' => 'Registro']) !!}
                                    </td>
                                    <td class="text-center col-md-4">
                                        {!! Form::button('<span class="glyphicon glyphicon-search" aria-hidden="true"></span>', ['type' => 'submit', 'class' => 'btn btn-primary']) !!}

                                        <a href="{!! route('admin.user.index') !!}" class="btn btn-danger">
                                            <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    {!! Form::close() !!}

                    <table class="table table-striped table-responsive">
                        <thead>
                            <tr class="filters">
                                <th>Nombre</th>
                                <th>Apellidos</th>
                                <th>Email</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($users as $item)
                            <tr>
                        		<td>{{ $item->profile->nombres }}</td>
                				<td>{{ $item->profile->apellidos }}</td>
                				<td>{{ $item->email }}</td>
                				<td>
                                    <div class="btn-group">
                                        <button class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown">
                                            Acciones <i class="fa fa-angle-down"></i>
                                        </button>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="{{ route('admin.user.edit', $item->id) }}">Editar</a></li>
                                            <li><a class="btn-delete" href="#delete">Eliminar</a></li>
                                        </ul>
                                    </div>
                                </td>
                			</tr>
                        @endforeach
                            
                        </tbody>
                    </table>

                    <div class="row">

                        <div class="col-md-5 col-sm-12">
                            <div class="dataTables_info" id="table1_info" role="status" aria-live="polite">Total de registros: {{ $users->total() }}</div>
                        </div>

                        <div class="col-md-7 col-sm-12">
                            <div class="pull-right dataTables_paginate paging_simple_numbers" id="table1_paginate">
                                {!! $users->appends(Request::all())->render() !!}
                            </div>

                        </div>

                    </div>

                </div>
            </div>

        </div>
    </div>

{!! Form::open(['route' => ['admin.user.destroy', ':REGISTER'], 'method' => 'DELETE', 'id' => 'FormDeleteRow']) !!}
{!! Form::close() !!}

<div id="delete" title="Eliminar registro">
  <p>¿Desea eliminar el registro?</p>
  <div id="deleteTitle"></div>
</div>

@endsection

@section('contenido_footer')
    
<script>
$(document).on("ready", function(){
    $('#mensajeAjax, #delete, #progressbar').hide();

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

                    $.user(url, data, function(result){
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