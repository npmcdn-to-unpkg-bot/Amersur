@extends('layouts.admin')

@section('contenido_header')
{{-- FancyBox --}}
{!! HTML::style('assets/global/plugins/fancybox/jquery.fancybox.css') !!}
@stop

@section('contenido_admin_title')
    Proyectos - Editar
@stop

@section('contenido_admin')
<div class="row">
	<!--row starts-->
	<div class="col-lg-12">

        <div class="row">

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

            {!! Form::model($row, ['route' => ['admin.proyectos.update', $row->id], 'method' => 'PUT', 'files' => 'true', 'id' => 'formRegister']) !!}

                <div class="col-md-6">

                    <div class="portlet box blue-hoki">
                        <div class="portlet-title"><div class="caption">Descripción</div></div>

                        <div class="portlet-body form">

                            <div class="form-body">

                                <div class="form-group">
                                    {!! Form::label('titulo', 'Titulo') !!}
                                    {!! Form::text('titulo', null, ['id' => 'titulo', 'class' => 'form-control']) !!}
                                </div>

                                <div class="form-group">
                                    {!! Form::label('contenido', 'Contenido') !!}
                                    {!! Form::textarea('contenido', null, ['class' => 'form-control ckeditor_full']) !!}
                                </div>

                                <div class="form-group">
                                    {!! Form::label('enlace', 'Enlace') !!}
                                    {!! Form::text('enlace', null, ['id' => 'titulo', 'class' => 'form-control']) !!}
                                </div>

                            </div>

                        </div>
                    </div>

                </div>

                <div class="col-md-6">

                    <div class="portlet box blue-hoki">
                        <div class="portlet-title"><div class="caption">Opciones</div></div>

                        <div class="portlet-body form">

                            <div class="form-horizontal">

                                <div class="form-body">

                                    <div class="form-group">
                                        {!! Form::label('publicar', 'Publicar', ['class' => 'col-md-2 control-label']) !!}
                                        <div class="col-md-10">
                                            <div class="radio-list">
                                                <label class="radio-inline">
                                                    {!! Form::radio('publicar', '1', null,  ['id' => 'publicar']) !!}
                                                    Si
                                                </label>
                                                <label class="radio-inline">
                                                    {!! Form::radio('publicar', '0', null,  ['id' => 'publicar']) !!}
                                                    No
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('published_at', 'Fecha de publicación', ['class' => 'col-md-4 control-label']) !!}
                                        <div class="col-md-8">
                                            {!! Form::text('published_at', date('Y-m-d H:i:s'), ['class' => 'form-control datetimepicker']) !!}
                                        </div>
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="col-md-12">

                    <div class="form-group">
                        <div class="col-md-12 text-right">
                            {!! Form::submit('Guardar cambios', ['class' => 'btn btn-responsive btn-primary btn-md']) !!}
                            <a href="{{ route('admin.proyectos.index') }}" class="btn btn-responsive btn-default btn-md">Cancelar</a>
                        </div>
                    </div>

                </div>

            {!! Form::close() !!}

        </div>

	</div>
	<!--md-6 ends-->

</div>
@stop

@section('contenido_footer')
{{-- FANCYBOX --}}
{!! HTML::script('assets/global/plugins/fancybox/jquery.mousewheel-3.0.6.pack.js') !!}
{!! HTML::script('assets/global/plugins/fancybox/jquery.fancybox.js') !!}
{!! HTML::script('assets/admin/pages/scripts/fancybox.js') !!}

{{-- CKEDITOR --}}
{!! HTML::script('assets/global/plugins/ckeditor/ckeditor.js') !!}
{!! HTML::script('assets/global/plugins/ckeditor/adapters/jquery.js') !!}
{!! HTML::script('assets/admin/pages/scripts/ckeditor.js') !!}
@stop