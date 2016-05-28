@extends('layouts.admin')

@section('contenido_header')
{!! HTML::style('assets/global/plugins/fancybox/jquery.fancybox.css') !!}

{{-- DATETIME PICKER --}}
{!! HTML::style('assets/global/plugins/datetimepicker/jquery.datetimepicker.css') !!}

{{-- SELECT 2 --}}
{!! HTML::style('assets/global/plugins/select2/css/select2.min.css') !!}
{!! HTML::style('assets/global/plugins/select2/css/select2-bootstrap.min.css') !!}
@stop

@section('contenido_admin_title')
    Inmuebles - Editar
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

            {!! Form::model($post, ['route' => ['admin.inmuebles.update', $post->id], 'method' => 'PUT', 'files' => 'true', 'id' => 'formRegister']) !!}

                <div class="col-md-6">

                    <div class="portlet box blue-hoki">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-globe"></i>Descripción del Producto
                            </div>
                        </div>

                        <div class="portlet-body form">

                            <div class="form-body">

                                <div class="form-group">
                                    {!! Form::label('titulo', 'Titulo') !!}
                                    {!! Form::text('titulo', null, ['id' => 'titulo', 'class' => 'form-control']) !!}
                                </div>

                                <div class="form-group">
                                    {!! Form::label('descripcion', 'Descripción') !!}
                                    {!! Form::textarea('descripcion', null, ['class' => 'form-control', 'rows' => '3',
                                    'onkeydown' => 'limitText(this.form.descripcion,this.form.countdown,220);',
                                    'onkeyup' => 'limitText(this.form.descripcion,this.form.countdown,220);']) !!}
                                    <span class="help-block">Caracteres permitidos:
                                        <strong>
                                            <input name="countdown" type="text" style="border:none; background:none;" value="220" size="3" readonly id="countdown">
                                        </strong>
                                    </span>
                                </div>

                                <div class="form-group">
                                    {!! Form::label('contenido', 'Contenido') !!}
                                    {!! Form::textarea('contenido', null, ['class' => 'form-control ckeditor_full']) !!}
                                </div>

                            </div>

                        </div>
                    </div>

                </div>

                <div class="col-md-6">

                    <div class="portlet box blue-hoki">
                        <div class="portlet-title"><div class="caption">Atributos</div></div>

                        <div class="portlet-body form">

                            <div class="form-horizontal">

                                <div class="form-body">

                                    <div class="form-group">
                                        {!! Form::label('tipo', 'Tipo', ['class' => 'col-md-2 control-label']) !!}
                                        <div class="col-md-10">
                                            {!! Form::select('tipo', ['' => 'Seleccionar'] + $category, $post->inmueble_tipo_id, ['class' => 'form-control select2']) !!}
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('moneda', 'Moneda', ['class' => 'col-md-2 control-label']) !!}
                                        <div class="col-md-10">
                                            {!! Form::select('moneda', ['' => 'Seleccionar', 'dolar' => 'Dólar', 'soles' => 'Soles'], $post->moneda, ['class' => 'form-control select2']) !!}
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('area_total', 'Área Total', ['class' => 'col-md-4 control-label text-left']) !!}
                                        <div class="col-md-8">
                                            {!! Form::text('area_total', null, ['class' => 'form-control', 'placeholder' => 'Área Total']) !!}
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('area_construida', 'Área Construida', ['class' => 'col-md-4 control-label text-left']) !!}
                                        <div class="col-md-8">
                                            {!! Form::text('area_construida', null, ['class' => 'form-control', 'placeholder' => 'Área Construida']) !!}
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('precio_alquiler', 'Precio Alquiler', ['class' => 'col-md-4 control-label text-left']) !!}
                                        <div class="col-md-8">
                                            {!! Form::text('precio_alquiler', null, ['class' => 'form-control', 'placeholder' => 'Precio Alquiler']) !!}
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('precio_venta', 'Precio Venta', ['class' => 'col-md-4 control-label text-left']) !!}
                                        <div class="col-md-8">
                                            {!! Form::text('precio_venta', null, ['class' => 'form-control', 'placeholder' => 'Precio Venta']) !!}
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>

                    </div>

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
                            <a href="{{ route('admin.inmuebles.index') }}" class="btn btn-responsive btn-default btn-md">Cancelar</a>
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
{{-- CKEDITOR --}}
{!! HTML::script('assets/global/plugins/ckeditor/ckeditor.js') !!}
{!! HTML::script('assets/global/plugins/ckeditor/adapters/jquery.js') !!}
{!! HTML::script('assets/admin/pages/scripts/ckeditor.js') !!}

{{-- DATETIME PICKER --}}
{!! HTML::script('assets/global/plugins/datetimepicker/jquery.datetimepicker.js') !!}
{!! HTML::script('assets/admin/pages/scripts/datetime.js') !!}

{{-- FANCYBOX --}}
{!! HTML::script('assets/global/plugins/fancybox/jquery.mousewheel-3.0.6.pack.js') !!}
{!! HTML::script('assets/global/plugins/fancybox/jquery.fancybox.js') !!}
{!! HTML::script('assets/admin/pages/scripts/fancybox.js') !!}

{{-- SELECT 2 --}}
{!! HTML::script('assets/global/plugins/select2/js/select2.full.min.js') !!}
{!! HTML::script('assets/pages/scripts/components-select2.js') !!}
@stop