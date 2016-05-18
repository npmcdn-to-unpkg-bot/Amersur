@extends('layouts.admin')

@section('contenido_header')
@stop

@section('contenido_admin_title')
    Slider
@stop

@section('contenido_admin')
<div class="row">
	<!--row starts-->
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

		<!--basic form starts-->
		<div class="portlet box blue-hoki">

            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-globe"></i>Slider
                </div>
            </div>

			<div class="portlet-body form">
				{!! Form::model($post, ['route' => ['admin.slider.update', $post->id], 'method' => 'PUT', 'class' => 'form-horizontal form-bordered', 'files' => 'true']) !!}

                    <div class="form-group">
                        {!! Form::label('header', 'Header', ['class' => 'col-md-3 control-label']) !!}
                        <div class="col-md-9">
                            {!! Form::textarea('header', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('body', 'Body', ['class' => 'col-md-3 control-label']) !!}
                        <div class="col-md-9">
                            {!! Form::textarea('body', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('footer', 'Footer', ['class' => 'col-md-3 control-label']) !!}
                        <div class="col-md-9">
                            {!! Form::textarea('footer', null, ['class' => 'form-control']) !!}
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

@section('contenido_footer')
@stop