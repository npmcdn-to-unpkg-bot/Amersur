@extends('layouts.admin')

@section('contenido_header')
@stop

@section('contenido_admin_title')
    Agenda - Nuevo
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

            {!! Form::open(['route' => 'admin.agenda.store', 'method' => 'POST', 'files' => 'true', 'id' => 'formRegister']) !!}

                <div class="col-md-6">

                    <div class="portlet box blue-hoki">
                        <div class="portlet-title"><div class="caption">Datos Personales</div></div>

                        <div class="portlet-body form">

                            <div class="form-body">

                                <div class="form-group">
                                    {!! Form::label('nombres', 'Nombres') !!}
                                    {!! Form::text('nombres', null, ['id' => 'titulo', 'class' => 'form-control']) !!}
                                </div>

                                <div class="form-group">
                                    {!! Form::label('apellidos', 'Apellidos') !!}
                                    {!! Form::text('apellidos', null, ['id' => 'titulo', 'class' => 'form-control']) !!}
                                </div>



                            </div>

                        </div>
                    </div>

                    <div class="portlet box blue-hoki">
                        <div class="portlet-title"><div class="caption">Datos de Contacto</div></div>

                        <div class="portlet-body form">

                            <div class="form-horizontal">

                                <div class="form-body">

                                    <div class="form-group">
                                        {!! Form::label('email', 'Email', ['class' => 'col-md-2 control-label text-left']) !!}
                                        <div class="col-md-10">
                                            {!! Form::email('email', null, ['class' => 'form-control']) !!}
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('telefono', 'Teléfono', ['class' => 'col-md-2 control-label text-left']) !!}
                                        <div class="col-md-10">
                                            {!! Form::text('telefono', null, ['class' => 'form-control']) !!}
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('direccion', 'Dirección', ['class' => 'col-md-2 control-label text-left']) !!}
                                        <div class="col-md-10">
                                            {!! Form::text('direccion', null, ['class' => 'form-control']) !!}
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>

                    </div>

                </div>

                <div class="col-md-6">

                    <div class="portlet box blue-hoki">
                        <div class="portlet-title"><div class="caption">Nota</div></div>

                        <div class="portlet-body form">

                            <div class="form-body">

                                <div class="form-group">
                                    {!! Form::textarea('nota', null, ['class' => 'form-control', 'rows' => '8']) !!}
                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <div class="col-md-12 text-right">
                            {!! Form::submit('Guardar', ['class' => 'btn btn-responsive btn-primary btn-md']) !!}
                            <a href="{{ route('admin.agenda.index') }}" class="btn btn-responsive btn-default btn-md">Cancelar</a>
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
@stop