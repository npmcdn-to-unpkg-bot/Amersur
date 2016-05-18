@extends('layouts.admin')

@section('contenido_header')
{{-- DATETIME PICKER --}}
{!! HTML::style('assets/global/plugins/datetimepicker/jquery.datetimepicker.css') !!}
@stop

@section('contenido_admin_title')
    Videos - Nuevo
@stop

@section('contenido_admin')
<!--main content-->
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
                    <i class="fa fa-globe"></i>Videos - Nuevo
                </div>
            </div>

            <div class="portlet-body form">
                {!! Form::open(['route' => 'admin.gallery.video.store', 'method' => 'POST', 'class' => 'form-horizontal form-bordered', 'files' => 'true']) !!}

                    <div class="form-group">
                        {!! Form::label('titulo', 'Titulo', ['class' => 'col-md-3 control-label']) !!}
                        <div class="col-md-9">
                            {!! Form::text('titulo', null, ['id' => 'titulo', 'class' => 'form-control']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('descripcion', 'Descripción', ['class' => 'col-md-3 control-label']) !!}
                        <div class="col-md-9">
                            {!! Form::textarea('descripcion', null, ['class' => 'form-control', 'rows' => '3',
                            'onkeydown' => 'limitText(this.form.descripcion,this.form.countdown,220);',
                            'onkeyup' => 'limitText(this.form.descripcion,this.form.countdown,220);']) !!}
                            <span class="help-block">Caracteres permitidos:
                                <strong>
                                    <input name="countdown" type="text" style="border:none; background:none;" value="220" size="3" readonly id="countdown">
                                </strong>
                            </span>
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('imagen', 'Imagen', ['class' => 'col-md-3 control-label']) !!}
                        <div class="col-md-9">
                            {!! Form::file('imagen') !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('video', 'Video (Youtube)', ['class' => 'col-md-3 control-label']) !!}
                        <div class="col-md-6">
                            <div class="form-group input-group">
                                <span class="input-group-addon">https://www.youtube.com/watch?v=</span>
                                {!! Form::text('video', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('published_at', 'Fecha de publicación', ['class' => 'col-md-3 control-label']) !!}
                        <div class="col-md-4">
                            {!! Form::text('published_at', date('Y-m-d H:i:s'), ['class' => 'form-control col-md-6 datetimepicker']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('publicar', 'Publicar', ['class' => 'col-md-3 control-label']) !!}
                        <div class="col-md-9">
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

                    <!-- Form actions -->
                    <div class="form-group">
                        <div class="col-md-12 text-right">
                            {!! Form::submit('Guardar', ['class' => 'btn btn-responsive btn-primary btn-md']) !!}
                            <a href="{{ route('admin.gallery.video.index') }}" class="btn btn-responsive btn-default btn-md">Cancelar</a>
                        </div>
                    </div>

                {!! Form::close() !!}
            </div>
        </div>

    </div>
    <!--md-6 ends-->

</div>

@stop

@section('contenido_footer')
{{-- DATETIME PICKER --}}
{!! HTML::script('assets/global/plugins/datetimepicker/jquery.datetimepicker.js') !!}
{!! HTML::script('assets/admin/pages/scripts/datetime.js') !!}
@stop