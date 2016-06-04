@extends('layouts.admin')

@section('contenido_header')
    {{-- SELECT 2 --}}
    {!! HTML::style('assets/global/plugins/select2/css/select2.min.css') !!}
    {!! HTML::style('assets/global/plugins/select2/css/select2-bootstrap.min.css') !!}
@stop

@section('contenido_admin_title')
    Slider - Nuevo
@stop

@section('contenido_admin')
            <!--main content-->
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

                {!! Form::open(['route' => 'admin.slider.store', 'method' => 'POST', 'files' => 'true', 'id' => 'formRegister']) !!}

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
                                    {!! Form::label('descripcion', 'Descripción') !!}
                                    {!! Form::textarea('descripcion', null, ['class' => 'form-control', 'rows' => '4',
                                    'onkeydown' => 'limitText(this.form.descripcion,this.form.countdown,220);',
                                    'onkeyup' => 'limitText(this.form.descripcion,this.form.countdown,220);']) !!}
                                    <span class="help-block">Caracteres permitidos:
                                        <strong>
                                            <input name="countdown" type="text" style="border:none; background:none;" value="220" size="3" readonly id="countdown">
                                        </strong>
                                    </span>
                                </div>

                                <div class="form-group">
                                    {!! Form::label('imagen', 'Imagen') !!}
                                    {!! Form::file('imagen') !!}
                                    <span class="help-block">Tamaño de imagen: 1400px x 700px</span>
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
                                        {!! Form::label('moneda', 'Moneda', ['class' => 'col-md-3 control-label']) !!}
                                        <div class="col-md-9">
                                            {!! Form::select('moneda', ['' => 'Seleccionar', 'dolar' => 'Dólar', 'soles' => 'Soles'], [], ['class' => 'form-control select2']) !!}
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('precio', 'Precio', ['class' => 'col-md-3 control-label text-left']) !!}
                                        <div class="col-md-9">
                                            {!! Form::text('precio', null, ['class' => 'form-control']) !!}
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('enlace', 'Enlace', ['class' => 'col-md-3 control-label text-left']) !!}
                                        <div class="col-md-9">
                                            {!! Form::text('enlace', null, ['class' => 'form-control']) !!}
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

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <div class="col-md-12 text-right">
                            {!! Form::submit('Guardar', ['class' => 'btn btn-responsive btn-primary btn-md']) !!}
                            <a href="{{ route('admin.slider.index') }}" class="btn btn-responsive btn-default btn-md">Cancelar</a>
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
    {{-- SELECT 2 --}}
    {!! HTML::script('assets/global/plugins/select2/js/select2.full.min.js') !!}
    {!! HTML::script('assets/pages/scripts/components-select2.js') !!}
@stop