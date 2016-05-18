@extends('layouts.admin')

@section('contenido_admin_title')
    Categorías - Editar
@stop

@section('contenido_admin')

    <div class="row">
        <!--row starts-->
        <div class="col-lg-12">

            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <button class="close" data-close="alert"></button>
                    <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                    </ul>
                </div>
            @endif

            <!--basic form starts-->
            <div class="portlet box blue-hoki">

                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-globe"></i>Categorías - Editar
                    </div>
                </div>

                <div class="portlet-body form">
                    {!! Form::model($category, ['route' => ['admin.category.update', $category->id], 'method' => 'PUT', 'class' => 'form-horizontal form-bordered', 'files' => 'true']) !!}

                            <div class="form-group">
                                {!! Form::label('titulo', 'Titulo', ['class' => 'col-md-3 control-label']) !!}
                                <div class="col-md-9">
                                    {!! Form::text('titulo', null, ['class' => 'form-control']) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="slug_url" class="col-md-3 control-label"><i class="fa fa-spinner fa-pulse progressUrl"></i> URL</label>
                                <div class="col-md-7">
                                    {!! Form::text('slug_url', null, ['id' => 'url', 'class' => 'form-control']) !!}                            
                                </div>
                                <div class="col-md-2">
                                    <a id="reloadUrl" href="#" class="btn default"> Generar nuevo URL</a>
                                </div>
                            </div>

                            <div class="form-group">
                                {!! Form::label('publicar', 'Publicar', ['class' => 'col-md-3 control-label']) !!}
                                <div class="col-md-9">
                                    <label class="checkbox-inline">
                                        {!! Form::radio('publicar', '1', null,  ['id' => 'publicar']) !!}
                                        Si
                                    </label>
                                    <label class="checkbox-inline">
                                        {!! Form::radio('publicar', '0', null,  ['id' => 'publicar']) !!}
                                        No
                                    </label>
                                </div>
                            </div>

                            <!-- Form actions -->
                            <div class="form-group">
                                <div class="col-md-12 text-right">
                                    {!! Form::submit('Guardar cambios', ['class' => 'btn btn-responsive btn-primary btn-md']) !!}
                                    <a href="{{ route('admin.category.index') }}" class="btn btn-responsive btn-default btn-md">Cancelar</a>
                                </div>
                            </div>

                    {!! Form::close() !!}
                </div>
            </div>

        </div>
        <!--md-6 ends-->

    </div>

{!! Form::open(['route' => 'admin.post.slugUrl', 'method' => 'POST', 'id' => 'formUrl']) !!}
    
    {!! Form::text('ajaxTitulo', null, ['id' => 'ajaxTitulo']) !!}

{!! Form::close() !!}

@stop

@section('contenido_footer')
{{-- URL --}}
<script>
$(document).on("ready", function(){
    $(".progressUrl").hide();
    $("#formUrl").hide();

    $("#reloadUrl").on("click", function(){
        generateUrl();
    });

    function generateUrl(){

        var titulo = $("#titulo").val();
        $("#ajaxTitulo").attr('value', titulo);

        var form = $("#formUrl");
        var url = form.attr('action');
        var data = form.serialize();

        $.ajax({
            type: "POST",
            url: url,
            data: data,
            beforeSend: function(){ 
                $(".progressUrl").show();
            },
            success: function(result){
                $(".progressUrl").hide();
                $('input[name=slug_url]').attr('value', result.url);
            }
        }).fail(function(result){
            console.log(result);
            $(".progressUrl").hide();
        });
    }

});
</script>

@stop