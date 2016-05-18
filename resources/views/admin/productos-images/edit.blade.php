@extends('layouts.admin')

@section('contenido_header')
{!! HTML::style('assets/global/plugins/fancybox/jquery.fancybox.css') !!}
@stop

@section('contenido_admin_title')
    Edición de Foto
@stop

{{-- Page content --}}
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
                        <i class="fa fa-globe"></i> {{ $posts->titulo }}
                    </div>
                </div>

				<div class="portlet-body form">

					{!! Form::model($photo, ['route' => ['admin.gallery.photo.photosUpdate', $posts->id, $photo->id], 'method' => 'PUT', 'class' => 'form-horizontal form-bordered', 'files' => 'true']) !!}

                        <div class="form-group">
                            {!! Form::label('titulo', 'Titulo', ['class' => 'col-md-3 control-label']) !!}
                            <div class="col-md-9">
                                {!! Form::text('titulo', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            {!! Form::label('imagen_actual', 'Imagen actual', ['class' => 'col-md-3 control-label']) !!}
                            <div class="col-md-9">
                                <a class="fancybox" href="/upload/{{ $photo->imagen_carpeta."".$photo->imagen }}" title="{{ $photo->titulo }}">
                                    <img src="/upload/{{ $photo->imagen_carpeta }}200x150/{{ $photo->imagen }}" alt="" />
                                </a>
                                {!! Form::hidden('imagen_actual', $photo->imagen) !!}
                                {!! Form::hidden('imagen_actual_carpeta', $photo->imagen_carpeta) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            {!! Form::label('imagen', 'Imagen', ['class' => 'col-md-3 control-label']) !!}
                            <div class="col-md-9">
                                {!! Form::file('imagen') !!}
                            </div>
                        </div>

                        <!-- Form actions -->
                        <div class="form-group">
                            <div class="col-md-12 text-right">
                                {!! Form::submit('Guardar cambios', ['class' => 'btn btn-responsive btn-primary btn-md']) !!}
                                <a href="{{ route('admin.gallery.photo.photosList', $posts->id) }}" class="btn btn-responsive btn-default btn-md">Cancelar</a>
                            </div>
                        </div>

					{!! Form::close() !!}

				</div>
			</div>

		</div>
		<!--md-6 ends-->
	</div>

@stop

{{-- page level scripts --}}
@section('contenido_footer')
{{-- FANCYBOX --}}
{!! HTML::script('assets/global/plugins/fancybox/jquery.mousewheel-3.0.6.pack.js') !!}
{!! HTML::script('assets/global/plugins/fancybox/jquery.fancybox.js') !!}
{!! HTML::script('assets/admin/pages/scripts/fancybox.js') !!}
@stop