@extends('layouts.admin')

@section('contenido_admin_title')
    Usuario - Nuevo
@stop

@section('contenido_admin')

<div class="row">

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

        <div class="portlet box blue-hoki">

            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-globe"></i>Usuario - Nuevo
                </div>
            </div>

            <div class="portlet-body form">

                {!! Form::open(['route' => 'admin.user.store', 'method' => 'post', 'class' => 'form-horizontal form-bordered']) !!}

                    <div class="form-group">
                        {!! Form::label('nombre', 'Nombre', ['class' => 'col-md-3 control-label']) !!}
                        <div class="col-md-9">
                            {!! Form::text('nombre', null, ['class' => 'form-control required']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('apellidos', 'Apellidos', ['class' => 'col-md-3 control-label']) !!}
                        <div class="col-md-9">
                            {!! Form::text('apellidos', null, ['class' => 'form-control required']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('email', 'Email', ['class' => 'col-md-3 control-label']) !!}
                        <div class="col-md-9">
                            {!! Form::email('email', null, ['class' => 'form-control required']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('password', 'Contraseña', ['class' => 'col-md-3 control-label']) !!}
                        <div class="col-md-9">
                            {!! Form::password('password', ['class' => 'form-control required']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('password_confirmation', 'Confirmar contraseña', ['class' => 'col-md-3 control-label']) !!}
                        <div class="col-md-9">
                            {!! Form::password('password_confirmation', ['class' => 'form-control required']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('type', 'Rol', ['class' => 'col-md-3 control-label']) !!}
                        <div class="col-md-9">
                            {!! Form::select('type', ['' => 'Seleccionar rol', 'admin' => 'Administrador', 'editor' => 'Editor'], '', ['class' => 'form-control required']) !!}
                        </div>
                    </div>

                    <!-- Form actions -->
                    <div class="form-group">
                        <div class="col-md-12 text-right">
                            {!! Form::submit('Guardar', ['class' => 'btn btn-responsive btn-primary btn-md']) !!}
                            <a href="{{ route('admin.user.index') }}" class="btn btn-responsive btn-default btn-md">Cancelar</a>
                        </div>
                    </div>

                {!! Form::close() !!}
                <!-- END FORM WIZARD WITH VALIDATION -->

            </div>
        </div>
    </div>
</div>

@stop