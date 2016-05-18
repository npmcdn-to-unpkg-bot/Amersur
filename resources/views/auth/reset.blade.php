@extends('layouts.auth')

@section('contenido_body')
<!-- BEGIN FORGOT PASSWORD FORM -->
{!! Form::open(['method' => 'POST', 'url' => 'login-password/reset', 'class' => 'forget-form']) !!}
    <input type="hidden" name="token" value="{{ $token }}">

	<h3>Restablecer contraseña</h3>

	@if(count($errors) > 0)
		<div class="alert alert-danger">
			<button class="close" data-close="alert"></button>
			<ul>
				@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
	@endif

	<p>Introduzca su dirección de correo electrónico y su nueva contraseña</p>
	<div class="form-group">
		<div class="input-icon">
			<i class="fa fa-envelope"></i>
			{!! Form::email('email', null, ['class' => 'form-control placeholder-no-fix', 'autocomplete' => 'off', 'placeholder' => 'Email']) !!}
		</div>
	</div>

    <div class="form-group">
        <label class="control-label visible-ie8 visible-ie9">Contraseña</label>
        <div class="input-icon">
            <i class="fa fa-lock"></i>
            {!! Form::password('password', ['id' => 'register_password', 'class' => 'form-control placeholder-no-fix', 'autocomplete' => 'off', 'placeholder' => 'Contraseña']) !!}
        </div>
    </div>

    <div class="form-group">
        <label class="control-label visible-ie8 visible-ie9">Repita su Contraseña</label>
        <div class="controls">
            <div class="input-icon">
                <i class="fa fa-check"></i>
                {!! Form::password('password_confirmation', ['class' => 'form-control placeholder-no-fix', 'autocomplete' => 'off', 'placeholder' => 'Repita su Contraseña']) !!}
            </div>
        </div>
    </div>

	<div class="form-actions">
		<a class="btn" href="{{ route('auth.login') }}"><i class="m-icon-swapleft"></i>Iniciar sesión</a>
		<button type="submit" class="btn blue pull-right">Enviar <i class="m-icon-swapright m-icon-white"></i></button>
	</div>

{!! Form::close() !!}
<!-- END FORGOT PASSWORD FORM -->
@stop