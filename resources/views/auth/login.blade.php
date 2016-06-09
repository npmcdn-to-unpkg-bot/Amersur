@extends('layouts.auth')

@section('contenido_body')
<!-- BEGIN LOGIN FORM -->
{!! Form::open(['method' => 'POST', 'route' => 'auth.login', 'class' => 'login-form']) !!}

    <h3 class="form-title">Accede a tu cuenta</h3>

    @include('flash::message')

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

    <div class="form-group">
        <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
        <label class="control-label visible-ie8 visible-ie9">Email</label>
        <div class="input-icon">
            <i class="fa fa-user"></i>
            {!! Form::email('email', null, ['class' => 'form-control placeholder-no-fix', 'autocomplete' => 'off', 'placeholder' => 'Email']) !!}
        </div>
    </div>
    <div class="form-group">
        <label class="control-label visible-ie8 visible-ie9">Contraseña</label>
        <div class="input-icon">
            <i class="fa fa-lock"></i>
            {!! Form::password('password', ['class' => 'form-control placeholder-no-fix', 'autocomplete' => 'off', 'placeholder' => 'Contraseña']) !!}
        </div>
    </div>
    <div class="form-actions">
        <label class="checkbox">
        <input type="checkbox" name="remember" value="1"/> Recuerdame </label>
        <button type="submit" class="btn blue pull-right">Login <i class="m-icon-swapright m-icon-white"></i></button>
    </div>

{!! Form::close() !!}
<!-- END LOGIN FORM -->
@stop