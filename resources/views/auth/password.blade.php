@extends('layouts.auth')

@section('contenido_body')
<!-- BEGIN FORGOT PASSWORD FORM -->
{!! Form::open(['method' => 'POST', 'route' => 'auth.login.password', 'class' => 'forget-form']) !!}

	<h3>¿Se te olvidó tu contraseña?</h3>

    @if(session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

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

	<p>Introduzca su dirección de correo electrónico para restablecer la contraseña.</p>
	<div class="form-group">
		<div class="input-icon">
			<i class="fa fa-envelope"></i>
			{!! Form::email('email', null, ['class' => 'form-control placeholder-no-fix', 'autocomplete' => 'off', 'placeholder' => 'Email']) !!}
		</div>
	</div>
	<div class="form-actions">
		<a class="btn" href="{{ route('auth.login') }}"><i class="m-icon-swapleft"></i>Iniciar sesión</a>
		<button type="submit" class="btn blue pull-right">Enviar <i class="m-icon-swapright m-icon-white"></i></button>
	</div>

{!! Form::close() !!}
<!-- END FORGOT PASSWORD FORM -->
@stop