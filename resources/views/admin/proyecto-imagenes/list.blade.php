@extends('layouts.admin')

@section('contenido_header')
{!! HTML::style('assets/global/plugins/fancybox/jquery.fancybox.css') !!}
@stop

@section('contenido_admin_title')
    Imagenes
@stop

@section('contenido_admin')

    <div class="row">
        <div class="col-lg-12">

            <div class="portlet box blue-hoki borderNone">

                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-globe"></i> {{ $posts->titulo }}
                    </div>
                </div>

                <div class="portlet-body">   

                    <div class="table-toolbar">

                        <div class="btn-group">
                            <a href="{{ route('admin.proyectos.img.create', $posts->id) }}" class="btn green">
                                Agregar registro
                                <i class="fa fa-plus"></i>
                            </a>
                        </div>

                    </div>

                    <div class="table-toolbar">

                        @if(Session::has('mensaje'))
                            <div class="alert alert-success">
                                {{ Session::get('mensaje') }}
                            </div>
                        @endif

                        <div id="mensajeAjax" class="alert alert-dismissable">
                            <button type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <span></span>
                        </div>
                        
                    </div>

                    <div class="table-toolbar">

                        {!! Form::open(['route' => ['admin.proyectos.img.order', $posts->id], 'method' => 'POST', 'id' => 'FormOrder']) !!}

                        <ul id="listPhotos" class="unstyled">

                            @foreach($photos as $item)
                            {{-- */
                            $imagen = "/upload/".$item->imagen_carpeta.$item->imagen;
                            $imagenThumb = "/upload/".$item->imagen_carpeta."100x100/".$item->imagen;
                            /* --}}

                            <li data-id="{{ $item->id }}" data-title="{{ $item->titulo }}" class="col-lg-2 col-md-3 col-xs-6 col-sm-3 gallery-border">

                                <input type="hidden" name="listPhoto[]" value="{{ $item->id }}">
                                
                                <img height="100" width="100" src="{{ $imagenThumb }}" class="gallery-style" alt="Image">

                                <div class="slider-options">
                                    <a class="photos-move handle" title="Mover">
                                        <span class="glyphicon glyphicon-move"></span>
                                    </a>

                                    <a class="fancybox" href="{{ $imagen }}" title="{{ $item->titulo }}">
                                        <span class="glyphicon glyphicon-zoom-in"></span>
                                    </a>

                                    <a class="btn-delete" href="#delete" title="Eliminar">
                                        <span class="glyphicon glyphicon-remove"></span>
                                    </a>
                                </div>

                            </li>

                            @endforeach

                        </ul>

                        {!! Form::close() !!}

                    </div>

                </div>
            </div>
        </div>
    </div>

{!! Form::open(['route' => ['admin.proyectos.img.delete', $posts->id, ':REGISTER'], 'method' => 'DELETE', 'id' => 'FormDeleteRow']) !!}
{!! Form::close() !!}

<div id="delete" title="Eliminar registro">
  <p>¿Desea eliminar el registro?</p>
  <div id="deleteTitle"></div>
</div>

@stop

@section('contenido_footer')
<script>
$(document).on("ready", function(){
    $('#mensajeAjax, #delete').hide();

    $("#listPhotos").sortable({

        handle : '.handle',
        serialize: { key: 'listPhoto' },
        revert: true,
        
        stop: function(evt, ui){

            var form = $("#FormOrder");
            var url = form.attr('action');
            var data = form.serialize();
            
            $.ajax({
                url: url,
                data: data,
                type: 'POST',
                success: function(success) {
                    $("#mensajeAjax").show().removeClass('alert-danger').addClass('alert-success').text('Los cambios se realizaron con éxito.');
                }, error: function (xhr, textStatus, thrownError) {
                    console.log(xhr);
                    $("#mensajeAjax").show().removeClass('alert-success').addClass('alert-danger').text("Se produjo un error.");
                }
            });
        }
    });

    $(".btn-delete").on("click", function(e){
        e.preventDefault();
        var row = $(this).parents("li");
        var id = row.data("id");
        var title = row.data("title");
        var form = $("#FormDeleteRow");
        var url = form.attr("action").replace(':REGISTER', id);
        var data = form.serialize();

        console.log(url);

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
                    }).fail(function(data){
                        console.log(data);
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

{{-- FANCYBOX --}}
{!! HTML::script('assets/global/plugins/fancybox/jquery.mousewheel-3.0.6.pack.js') !!}
{!! HTML::script('assets/global/plugins/fancybox/jquery.fancybox.js') !!}
{!! HTML::script('assets/admin/pages/scripts/fancybox.js') !!}
@stop