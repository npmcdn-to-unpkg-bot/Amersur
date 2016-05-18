@extends('layouts.admin')

@section('contenido_admin_title')
    Productos eliminadas
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

                        <div id="progressbar" class="progress progress-striped active">
                                <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
                            </div>

                        <div class="alert alert-dismissable"></div>
                        
                    </div>

                    {!! Form::model(Request::all(), ['route' => 'admin.productos.listsDeletes', 'method' => 'GET']) !!}

                        <table class="table table-striped table-bordered" id="table2">
                            <thead>
                                <tr>
                                    <th>Buscar</th>
                                    <th>Categoría</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="col-md-8">
                                        {!! Form::text('titulo', null, ['class' => 'form-control input-sm', 'placeholder' => 'Registro']) !!}
                                    </td>
                                    <td class="col-md-2">
                                        {!! Form::select('category', ['' => 'Seleccionar'] + $category, null, ['class' => 'form-control input-sm']) !!}
                                    </td>
                                    <td class="text-center col-md-2">
                                        {!! Form::button('<span class="glyphicon glyphicon-search" aria-hidden="true"></span>', ['type' => 'submit', 'class' => 'btn btn-primary']) !!}

                                        <a href="{!! route('admin.productos.listsDeletes') !!}" class="btn btn-danger">
                                            <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    {!! Form::close() !!}                    

                    <table class="table table-striped table-responsive">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Titulo</th>
                                <th class="text-center">Categoría</th>
                                <th class="text-center">Usuario</th>
                                <th class="text-center">Eliminación</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($posts as $item)
                            {{--*/
                            $usuario = $item->userDelete()->user->profile->nombres." ".$item->userDelete()->user->profile->apellidos;
                            /*--}}
                            <tr data-id="{{ $item->id }}" data-title="{{ $item->titulo }}">
                                <td class="text-center">{{ $item->id }}</td>
                                <td>{{ $item->titulo }}</td>
                                <td class="text-center">{{ $item->category->titulo }}</td>
                                <td class="text-center">{{ $usuario }}</td>
                                <td class="text-center">{{ date_format(new DateTime($item->deleted_at), 'd/m/Y H:i')  }}</td>
                                <td class="text-center">
                                    <a title="Eliminar" href="#rowDestroy"class="btn-delete btn default btn-xs red"><i class="fa fa-trash-o"></i></a>
                                    <a title="Restaurar" href="#rowRestore" class="btn-restore btn default btn-xs blue"><i class="fa fa-undo"></i></a>                                    
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="row">

                        <div class="col-md-5 col-sm-12">
                            <div class="dataTables_info" id="table1_info" role="status" aria-live="polite">Total de registros: {{ $posts->total() }}</div>
                        </div>

                        <div class="col-md-7 col-sm-12">
                            <div class="pull-right dataTables_paginate paging_simple_numbers" id="table1_paginate">
                                {!! $posts->appends(Request::all())->render() !!}
                            </div>

                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>

{!! Form::open(['route' => ['admin.productos.listsDeletes.destroy', ':REGISTER'], 'method' => 'DELETE', 'id' => 'FormDeleteRow']) !!}
{!! Form::close() !!}

<div id="rowDestroy" title="Eliminar registro">
  <p>¿Desea eliminar el registro?</p>
  <div id="deleteTitle"></div>
</div>


{!! Form::open(['route' => ['admin.productos.listsDeletes.restore', ':REGISTER'], 'method' => 'POST', 'id' => 'FormRestoreRow']) !!}
{!! Form::close() !!}

<div id="rowRestore" title="Restaurar registro">
  <p>¿Desea restaurar este registro?</p>
  <div id="restoreTitle"></div>
</div>

@stop

{{-- page level scripts --}}
@section('contenido_footer')
<script>
$(document).on("ready", function(){
    $('.alert, #rowDestroy, #rowRestore, #progressbar').hide();

    $(".btn-delete").on("click", function(e){
        e.preventDefault();
        var row = $(this).parents("tr");
        var id = row.data("id");
        var title = row.data("title");
        var form = $("#FormDeleteRow");
        var url = form.attr("action").replace(':REGISTER', id);
        var data = form.serialize();

        $("#rowDestroy #deleteTitle").text(title);

        $( "#rowDestroy" ).dialog({
            resizable: true,
            height: 250,
            modal: false,
            buttons: {
                "Borrar registro": function() {
                    row.fadeOut();

                    $.post(url, data, function(result){
                        $(".alert").show().removeClass('alert-danger').addClass('alert-success').text(result.message);
                    }).fail(function(){
                        $(".alert").show().removeClass('alert-success').addClass('alert-danger').text("Se produjo un error.");
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

    $(".btn-restore").on("click", function(e){
        e.preventDefault();
        var row = $(this).parents("tr");
        var id = row.data("id");
        var title = row.data("title");
        var form = $("#FormRestoreRow");
        var url = form.attr("action").replace(':REGISTER', id);
        var data = form.serialize();

        $("#rowRestore #restoreTitle").text(title);

        $( "#rowRestore" ).dialog({
            resizable: true,
            height: 250,
            modal: false,
            buttons: {
                "Borrar registro": function() {
                    row.fadeOut();

                    $.post(url, data, function(result){
                        $(".alert").show().removeClass('alert-danger').addClass('alert-success').text(result.message);
                    }).fail(function(result){
                        console.log(result);
                        $(".alert").show().removeClass('alert-success').addClass('alert-danger').text("Se produjo un error.");
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
@stop