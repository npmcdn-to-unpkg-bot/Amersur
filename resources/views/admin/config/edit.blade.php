@extends('layouts.admin')

@section('contenido_admin_title')
    Configuración
@stop

@section('contenido_admin')
<div class="row">
	<!--row starts-->
	<div class="col-lg-12">

        @include('flash::message')

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
                    <i class="fa fa-globe"></i>Configuración
                </div>
            </div>

			<div class="portlet-body form">
				{!! Form::model($config, ['route' => 'admin.config.update', 'method' => 'PUT', 'class' => 'form-horizontal form-bordered', 'files' => 'true']) !!}

                    <div class="form-group">
                        {!! Form::label('titulo', 'Titulo', ['class' => 'col-md-3 control-label']) !!}
                        <div class="col-md-9">
                            {!! Form::text('titulo', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('dominio', 'Dominio', ['class' => 'col-md-3 control-label']) !!}
                        <div class="col-md-9">
                            {!! Form::text('dominio', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('email', 'Email', ['class' => 'col-md-3 control-label']) !!}
                        <div class="col-md-3">
                            {!! Form::text('email', null, ['class' => 'form-control']) !!}
                        </div>
                        <div class="col-md-6">
                            <span>El email que se agregue en este campo, se utilizará para que los usuarios puedan enviar sus mensajes mediante los formularios que hay en la página.</span>
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('description', 'Descripción', ['class' => 'col-md-3 control-label']) !!}
                        <div class="col-md-9">
                            {!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => '3',
                            'onkeydown' => 'limitText(this.form.description,this.form.countdown,220);',
                            'onkeyup' => 'limitText(this.form.description,this.form.countdown,220);']) !!}
                            <span class="help-block">Caracteres permitidos:
                                <strong>
                                    <input name="countdown" type="text" style="border:none; background:none;" value="220" size="3" readonly id="countdown">
                                </strong>
                            </span>
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('keywords', 'Palabras clave', ['class' => 'col-md-3 control-label']) !!}
                        <div class="col-md-9">
                            {!! Form::textarea('keywords', null, ['class' => 'form-control', 'rows' => '3']) !!}
                        </div>
                    </div>

                    <!-- Form actions -->
                    <div class="form-group">
                        <div class="col-md-12 text-right">
                            {!! Form::submit('Guardar cambios', ['class' => 'btn btn-responsive btn-primary btn-md']) !!}
                        </div>
                    </div>

				{!! Form::close() !!}
			</div>
		</div>

	</div>
	<!--md-6 ends-->

</div>

@stop