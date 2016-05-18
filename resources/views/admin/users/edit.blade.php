@extends('layouts.admin')

@section('contenido_admin_title')
    Usuarios - Editar
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

            <div class="tabbable tabbable-custom">

                <ul class="nav nav-tabs">
                    <li class="active">
                        <a href="#datos" data-toggle="tab">
                            <i class="livicon" data-name="notebook" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
                            Datos personales
                        </a>
                    </li>

                    <li>
                        <a href="#clave" data-toggle="tab">
                            <i class="livicon" data-name="key" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
                            Cambiar contraseña
                        </a>
                    </li>
                </ul>

                <div  class="tab-content">

                    <div id="datos" class="tab-pane fade active in">

                        {!! Form::model($user->profile, ['route' => ['admin.user.update', $user->id], 'method' => 'PUT', 'class' => 'form-horizontal form-bordered']) !!}

                            <div class="form-group">
                                {!! Form::label('nombre', 'Nombre', ['class' => 'col-md-3 control-label']) !!}
                                <div class="col-md-9">
                                    {!! Form::text('nombre', null, ['class' => 'form-control']) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                {!! Form::label('apellidos', 'Apellidos', ['class' => 'col-md-3 control-label']) !!}
                                <div class="col-md-9">
                                    {!! Form::text('apellidos', null, ['class' => 'form-control']) !!}
                                </div>
                            </div>

                            <!-- Form actions -->
                            <div class="form-group">
                                <div class="col-md-12 text-right">
                                    {!! Form::submit('Guardar cambios', ['class' => 'btn btn-responsive btn-primary btn-md']) !!}
                                    <a href="@{{ route('admin.user.profile') }}" class="btn btn-responsive btn-default btn-md">Cancelar</a>
                                </div>
                            </div>

                        {!! Form::close() !!}

                    </div>

                    <div id="clave" class="tab-pane fade">
                        <div class="row">
                            <div class="col-md-12 pd-top">

                                {!! Form::open(['route' => ['admin.user.updatePassword', $user->id], 'method' => 'post', 'class' => 'form-horizontal']) !!}

                                    <div class="form-body">

                                        <div class="form-group">

                                            {!! Form::label('password', 'Contraseña *', ['class' => 'col-md-3 control-label']) !!}

                                            <div class="col-md-9">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="livicon" data-name="key" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
                                                    </span>
                                                    {!! Form::password('password', ['class' => 'form-control']) !!}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            {!! Form::label('password_confirmation', 'Confirmar contraseña *', ['class' => 'col-md-3 control-label']) !!}
                                            <div class="col-md-9">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="livicon" data-name="key" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
                                                    </span>
                                                    {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="form-actions">
                                        <div class="col-md-offset-3 col-md-9">
                                            <button type="submit" class="btn btn-primary">Cambiar contraseña</button>
                                        </div>
                                    </div>

                                {!! Form::close() !!}

                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>

@stop