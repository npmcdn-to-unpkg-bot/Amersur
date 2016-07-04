@extends('layouts.admin')

@section('contenido_admin_title')
    Tipos de Inmueble
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
                            <a href="{{ route('admin.inmueble-tipos.create') }}" class="btn green">
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
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $item)
                            <tr data-id="{{ $item->id }}" data-title="{{ $item->titulo }}">
                                <td>{{ $item->titulo }}</td>
                                <td class="text-center">
                                    <a title="Editar" href="{{ route('admin.inmueble-tipos.edit', $item->id) }}" class="btn default btn-xs blue"><i class="fa fa-edit"></i></a>
                                    <a title="Eliminar" href="#delete"class="btn-delete btn default btn-xs red"><i class="fa fa-trash-o"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="row">

                        <div class="col-md-5 col-sm-12">
                            <div class="dataTables_info" id="table1_info" role="status" aria-live="polite">Total de registros: {{ $categories->total() }}</div>
                        </div>

                        <div class="col-md-7 col-sm-12">
                            <div class="pull-right dataTables_paginate paging_simple_numbers" id="table1_paginate">
                                {!! $categories->appends(Request::all())->render() !!}
                            </div>

                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>

{!! Form::open(['route' => ['admin.inmueble-tipos.destroy', ':REGISTER'], 'method' => 'DELETE', 'id' => 'FormDeleteRow']) !!}
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
                    
                    $.post(url, data, function(result){
                        row.fadeOut();
                        $("#mensajeAjax").show().removeClass('alert-danger').addClass('alert-success').text(result.message);
                    }).fail(function(result){
                        console.log(result)
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