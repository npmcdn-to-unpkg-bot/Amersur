@extends('layouts.admin')

@section('contenido_header')
{{-- FancyBox --}}
{!! HTML::style('assets/global/plugins/fancybox/jquery.fancybox.css') !!}
@stop

@section('contenido_admin_title')
    Proyectos - Editar
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

            {!! Form::model($row, ['route' => ['admin.proyectos.update', $row->id], 'method' => 'PUT', 'files' => 'true', 'id' => 'formRegister']) !!}

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
                                    {!! Form::textarea('descripcion', null, ['class' => 'form-control']) !!}
                                </div>

                            </div>

                        </div>
                    </div>

                </div>

                <div class="col-md-6">

                    <div class="portlet box blue-hoki">
                        <div class="portlet-title"><div class="caption">Imagen</div></div>

                        <div class="portlet-body form">

                            <div class="form-body">

                                <div class="form-group">
                                    {!! Form::file('imagen') !!}
                                </div>

                                <div class="form-group">
                                    {!! Form::label('imagen_actual', 'Imagen actual', ['class' => 'control-label']) !!}
                                    @if($row->imagen <> "")
                                        <a class="fancybox" href="/upload/{{ $row->imagen_carpeta."".$row->imagen }}" title="{{ $row->titulo }}">
                                            <img src="/upload/{{ $row->imagen_carpeta }}200x100/{{ $row->imagen }}" alt="" />
                                        </a>
                                    @else
                                        No hay imagen
                                    @endif
                                    {!! Form::hidden('imagen_actual', $row->imagen) !!}
                                    {!! Form::hidden('imagen_actual_carpeta', $row->imagen_carpeta) !!}
                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="col-md-12">

                    <div class="form-group">
                        <div class="col-md-12 text-right">
                            {!! Form::submit('Guardar cambios', ['class' => 'btn btn-responsive btn-primary btn-md']) !!}
                            <a href="{{ route('admin.proyectos.index') }}" class="btn btn-responsive btn-default btn-md">Cancelar</a>
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
{{-- FANCYBOX --}}
{!! HTML::script('assets/global/plugins/fancybox/jquery.mousewheel-3.0.6.pack.js') !!}
{!! HTML::script('assets/global/plugins/fancybox/jquery.fancybox.js') !!}
{!! HTML::script('assets/admin/pages/scripts/fancybox.js') !!}
@stop